@extends('admin.layouts.master')

@section('styles')
    {{-- chosen user interface for autocomplete input --}}
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class='container p-4'>
    <h4>{{ __('messages.adm_title.title', ['title' => 'Family Tree']) }}</h4>
    <div id="toolbar">
        <div class='form-inline py-2'>
            <div class='mr-2' style="width: 300px;">
                <select id='membersCombo' class="form-group form-control mr-2" style="width: 300px;" data-placeholder="{{ __('messages.adm_table.select_member') }}">
                </select>
            </div>
            <button id="pop" class="form-group form-control btn btn-secondary mr-2" type="button" data-placement="right" data-toggle="popover" data-trigger="focus" data-title="Describe" data-content="">
                <i class="fa fa-question" aria-hidden="true"></i>
            </button>
            <button class="form-group form-control btn btn-info mr-2" type="button" title="Add Family" onclick="addChild();">
                <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('messages.adm_button.add_family') }}
            </button>
            <button class="form-group btn btn-danger btn-modal-target mr-2" type="button" title="Clear All" onclick="clearAll();">
                <i class="fa fa-times mr-1" aria-hidden="true"></i>{{ __('messages.adm_button.clear_all') }}
            </button> 
            @include('admin.includes.export', [ 'router' => 'admin.export.familytrees' ])     
        </div>
    </div>

    <table  id="mainTable" class="table table-striped table-bordered" 
            data-side-pagination="client"
            data-pagination="true" 
            data-page-list="[5, 10, 25, ALL]" 
            data-row-style="rowStyle"
            >
        <thead>
            <tr>
                <th data-field="id" data-visible="false" data-searchable="false">{{ __('messages.adm_table.id') }}</th>
                <th data-field="child_id" data-visible="false" data-searchable="false">{{ __('messages.adm_table.child_id') }}</th>
                <th data-field="child_name" data-width="25%">{{ __('messages.adm_table.child_name') }}</th>
                <th data-field="child_birth" data-width="10%">{{ __('messages.adm_table.dob') }}</th>
                <th data-field="child_gender" data-width="5%">{{ __('messages.adm_table.gender') }}</th>
                <th data-field="child_email">{{ __('messages.adm_table.email') }}</th>
                <th data-field="child_relation_id" data-visible="false" data-searchable="false">{{ __('messages.adm_table.relation_id') }}</th>
                <th data-field="child_relation_name" data-width="20%">{{ __('messages.adm_table.relation_name') }}</th>
                <th data-field="delete" data-width="3%" data-formatter="deleteFormatter" data-events="deleteEvents" data-searchable="false">{{ __('messages.adm_table.del_btn') }}</th>
            </tr>
        </thead>
    </table>

    @include('admin.members.includes.family-tree.add')
    @include('admin.members.includes.family-tree.show')
    @include('admin.members.includes.family-tree.delete')
    @include('admin.members.includes.family-tree.deleteall')

</div>
{{-- End Container --}}
@endsection

@section('scripts')
    <script type="text/javascript">
        const $table = $('#mainTable');
        const $addTable = $('#addTable');
        const $combo = $("#membersCombo");
        const $popover = $("#pop");
        const RELATION_CODE = 3 // family relation id in categories table
        const memberListURL = "{!! route('admin.users.get-users') !!}";
        const codesUrl = "{!! route('admin.codes.index') !!}";
        const familyTreesUrl = "{!! route('admin.family-trees.index') !!}";
        const getCodesNotInChild = "{!! route('admin.family-trees.getcodes-notin-child') !!}"

        var parentList; // all items for combo box
        var relationList; // all family relation code list from codes
        var currentParentId; // current selected parent code id in parentList combo box
        var currentParentName; // current selected parent code name in parentList combo box
        var saveId
        var childLists;

        /* initialize Main table */

        // compute height of the table and return 
        function getHeight() {
            $(window).height() - $('h4').outerHeight(true); // table height
        }

        // Row Style of main table
        function rowStyle(row, index) {
            return { css: { "padding": "0px 10px" } };
        }

        // compose the column for delete button
        function deleteFormatter(value, row, index) {
            return [
                '<a href="#"><span class="text-danger h6-font-size"><i class="fa fa-fw fa-times-circle" aria-hidden="true"></i></span></a>'
            ].join('');
        }

        $table.bootstrapTable({
            height: getHeight(),
            columns: [ {},{},{ align: 'left' },{ align: 'center' },{ align: 'center' },{ align: 'left' },{},{ align: 'left' },{ align: 'center', clickToSelect: false }]
        });
        $(window).resize(function () {
            $table.bootstrapTable('resetView', {
                height: getHeight()
            });
        });

        $popover.popover({
            title: 'Member Summary',
            html: true
        });

        function setPopover(memberId) {
            $.each(parentList, function( index, member ) {
                if (member['idx'] == memberId) {
                    var html = "Name: " + currentParentName + "<br/>";
                    html += "성명: " + member['kor_name'] + "<br/>";
                    html += "Home Phone: " + member['tel_home'] + "<br/>";
                    html += "Office Phone: " + member['tel_office'] + "<br/>";
                    $popover.attr('data-content', html);
                }
            });
        }

        /* main processes */

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        // fill member combo
        function fillMemberCombo(memberCombo, members) {
            memberCombo.empty();
            var html = '<option></option>';
            $.each(members, function( index, member ) {
                html += '<option value="' + member['idx'] + '">' + member['label'] + '</option>';
            });
            memberCombo.prepend(html);
            // The following options are available to pass into Chosen on instantiation.
            memberCombo.chosen({
                case_sensitive_search: false,
                search_contains: true, // Setting this option to true allows matches starting from anywhere within a word. 
                no_results_text: "Oops, nothing found!",
                placeholder_text_single: "Select a correct Member",
            });
            // whenever changing selection of combo box
            memberCombo.chosen().change( function () {
                currentParentId = $(this).val();
                currentParentName = $(this).find("option:selected").text();
                setPopover(currentParentId);
                reloadList();
            }); 
        }

        // fill autocomplete list of members
        $.ajax({ dataType: 'json', timeout: 3000, url: memberListURL + '?table=householders' })
        .done ( function(data, textStatus, jqXHR) { 
            parentList = data['members'];
            fillMemberCombo($combo, data['members']);
        }) 
        .fail ( function(jqXHR, textStatus, errorThrown) { 
            errorMessage( jqXHR );
        });

        // Get list from server and fill combobox
        $.ajax({ dataType: 'json', timeout: 3000, url: codesUrl + '?category_id=' + RELATION_CODE })
        .done ( function(data, textStatus, jqXHR) { 
            relationList = data['codes'];
            fillAddRelationCombo($('#addRelationCombo'), relationList);
        }) 
        .fail ( function(jqXHR, textStatus, errorThrown) { 
            errorMessage( jqXHR );
        });

        function fillAddMemberCombo(memberCombo, members) {
            memberCombo.empty();
            var html = '<option value=""></option>';
            $.each(members, function( index, member ) {
                html += '<option value="' + member['idx'] + '">' + member['label'] + '</option>';
            });
            memberCombo.prepend(html);
            // The following options are available to pass into Chosen on instantiation.
            memberCombo.chosen({
                case_sensitive_search: false,
                search_contains: true, // Setting this option to true allows matches starting from anywhere within a word. 
                no_results_text: "Oops, nothing found!",
                placeholder_text_single: "Select a correct Member",
            });
        }

        function fillAddRelationCombo(relationCombo, relations) {
            relationCombo.empty();
            var html = '<option value=""></option>';
            $.each(relations, function( index, relation ) {
                html += '<option value="' + relation['id'] + '">' + relation['txt'] + '</option>';
            });
            relationCombo.prepend(html);
            // The following options are available to pass into Chosen on instantiation.
            relationCombo.chosen({
                case_sensitive_search: false,
                search_contains: true, // Setting this option to true allows matches starting from anywhere within a word. 
                no_results_text: "Oops, nothing found!",
                placeholder_text_single: "Select a Relation",
            });
        }

        // Reload data from server and refresh table
        function reloadList() {
            $('#addMemberCombo').val('').trigger('chosen:updated');
            $('#addRelationCombo').val('').trigger('chosen:updated');
            $.ajax({ dataType: 'json', timeout: 3000, url: familyTreesUrl + '?parent_id=' + currentParentId })
            .done ( function(data, textStatus, jqXHR) { 
                if (data['result'].length > 0) {
                    $table.bootstrapTable( 'load', { data: data['result'] } );
                } else {
                    $table.bootstrapTable( 'removeAll' );
                } 
                childLists = data['result'];
            }) 
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        } 

        // click addChild button
        function addChild() {
            if (currentParentId) {
                $.ajax({ dataType: 'json', timeout: 3000, url: memberListURL + '?table=family' })
                .done ( function(data) {
                    fillAddMemberCombo($('#addMemberCombo'), data["members"]);
                    $('#add-item').modal({show:true}).draggable({ handle: ".modal-header" });
                })
                .fail ( function(jqXHR, textStatus, errorThrown) { 
                    errorMessage( jqXHR );
                });
            }
        }

        // Create 후 Submit 버튼을 눌렀다
        $(".crud-submit").click(function(e){
            e.preventDefault();
            const formId = $("#add-item");
            const form_action = formId.find("form").attr("action");
            const memberCombo = $('#addMemberCombo');
            const relationCombo = $('#addRelationCombo');
            var child_birth;
            var child_gender;
            var child_email;

            var postData = { 
                member_pri_id: currentParentId, 
                member_sub_id: memberCombo.val(), 
                relation_id: relationCombo.val(), 
            };

            for (var i=0; i < parentList.length; i++) {
                if (parentList[i]['id'] === memberCombo.val()) {
                    child_birth = parent[i]['dob'];
                    child_gender = parent[i]['gender'];
                    child_email = parent[i]['email'];
                    break;
                }
            }

            var tableData = {
                child_id: memberCombo.val(),
                child_name: memberCombo.find('option:selected').text(),
                child_birth: child_birth,
                child_gender: child_gender,
                child_email: child_email,
                child_relation_id: relationCombo.val(),
                child_relation_name: relationCombo.find('option:selected').text(),
            }

            $.ajax({ dataType: 'json', timeout: 3000, method:'POST', data: postData, url: form_action })
            .done ( function(data) {
                if (data.code == 'validation') {
                    validationMessage( data.errors );
                } else if (data.code == 'exception') {
                    exceptionMessage( data.status, data.errors );
                } else {
                    saveSuccessMessage();
                    $table.bootstrapTable("append", tableData); // Add input data to table
                    $('#addForm')[0].reset(); // Clear create form 
                    $(".modal").modal('hide'); // hide model form
                    reloadList();
                }
            })
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        });    

        
        // Delete button was pressed
        $(".crud-delete").click(function(e){
            event.preventDefault();
            $.ajax({ dataType: 'json', timeout: 3000, method:'delete', url: familyTreesUrl + '/' + saveId })
            .done ( function(data) {
                if (data.code == 'exception') {
                    exceptionMessage( data.status, data.errors );
                } else {
                    deleteSuccessMessage();
                    $table.bootstrapTable('remove', {field: 'id', values: [saveId]});
                    $(".modal").modal('hide'); // hide model form
                    reloadList();
                }
            })
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        });

        // Delete all button was pressed
        $(".crud-all").click(function(e){
            event.preventDefault();
            if (childLists) { // if selected items are more than one?
                var deferreds = [];
                $.each(childLists, function(index, item) {
                    deferreds.push(
                        $.ajax({ dataType: 'json', type:'delete', timeout: 3000, url: familyTreesUrl + '/' + item['id'] })
                    );
                });
                $.when.apply($, deferreds).then( function() {
                    saveSuccessMessage();
                    $(".modal").modal('hide'); // hide model form
                    reloadList();
                }).fail(function(e){
                    deleteSuccessMessage();
                });
            }
        });

        // Delete all
        function clearAll() {
            var deleteId = $("#deleteAllBody");
            deleteId.empty();
            if (childLists.length > 0) { // if selected items are more than one?
                var html = "";
                $.each(childLists, function(index, item) {
                    html += '<div class="row py-2">';
                    html += '<div class="rounded bg-light py-2 col-sm-12"><span class="align-middle" name="child_name">' + item['child_name'] + ' (' + item['child_id'] + ')</span></div>';
                    html += '</div>';
                });
                $("#deleteAllBody").prepend(html);
                // Open Bootstrap Model without Button Click
                $("#deleteall-item").modal('show').draggable({ handle: ".modal-header" });
            } else {
                toastr.error('There is nothing to delete.', 'Failed');
            }
        }
        
        // 테이블의 Column을 클릭하면 발생하는 이벤트를 핸들한다.
        $table.on('click-cell.bs.table', function (field, column, row, rec) {
            saveId = Number(rec.id);
            if (column === 'delete') {
                // Open Bootstrap Model without Button Click
                $("#delete-item").modal('show').draggable({ handle: ".modal-header" });
            } else {
                var dispId = $("#showBody");
                dispId.find("span[name='parent_txt']").text(currentParentName + ' (' + currentParentId + ')');
                dispId.find("span[name='child_txt']").text(rec.child_name + ' (' + rec.child_id + ')');
                dispId.find("span[name='relation']").text(rec.child_relation_name + ' (' + rec.child_relation_id + ')');
                // Open Bootstrap Model without Button Click
                $("#show-item").modal('show').draggable({ handle: ".modal-header" });
            }
        });

        // 테이블의 Row를 클릭하면 발생하는 이벤트를 핸들한다: Bootstrap Table에서 Index를 구하기 위한 유일한 방법(Maybe)
        $table.on('click-row.bs.table', function (e, row, $element) {
            saveIndex = $element.index();
        });   
    </script>
    
    {{-- chosen user interface CDN for autocomplete input --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.min.js"></script>
    {{-- to implement make display order --}}
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>

@endsection