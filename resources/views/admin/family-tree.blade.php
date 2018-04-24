@extends('admin.layouts.master')

@section('styles')
    {{-- chosen user interface for autocomplete input --}}
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class='container p-4'>
    <h4>{{ __('messages.adm_title.family_tree') }}</h4>
    <div id="toolbar">
        <div class='row py-2'>
            <div class="col-sm-3">
                <select id='membersCombo' class="form-group form-control mr-3" style="width: 70%;" data-placeholder="Select Correct Member">
                </select>
            </div>
            <div class="form-inline">
                <button id="pop" class="form-group form-control btn btn-secondary mr-2" type="button" data-placement="right" data-toggle="popover" data-trigger="focus" data-title="Describe" data-content="">
                    <i class="fa fa-question" aria-hidden="true"></i>
                </button>
                <button class="form-group form-control btn btn-info mr-2" type="button" title="Add Family" onclick="addChild();">
                    <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('messages.adm_button.add_family') }}
                </button>
                <button class="form-group btn btn-danger btn-modal-target mr-2" type="button" title="Clear All" onclick="clearAll();">
                    <i class="fa fa-times mr-1" aria-hidden="true"></i>{{ __('messages.adm_button.clear_all') }}
                </button> 
                @include('admin.includes.export') 
            </div>
        </div>
    </div>

    <table  id="mainTable" class="table table-striped table-bordered" 
            data-side-pagination="client"
            data-pagination="true" 
            data-page-list="[5, 10, 25, 50, ALL]" 
            data-mobile-responsive="true" 
            data-click-to-select="true" 
            data-filter-control="true" 
            data-row-style="rowStyle">
        <thead>
            <tr>
                <th data-field="id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">Id</th>
                <th data-field="child_id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">Child Id</th>
                <th data-field="child_name" data-width="25%" data-filter-control="select" scope="col">Name</th>
                <th data-field="child_birth" data-width="10%" data-filter-control="select" scope="col">Birthdate</th>
                <th data-field="child_gender" data-width="5%" data-filter-control="select" scope="col">Gender</th>
                <th data-field="child_email" data-filter-control="select" scope="col">Email</th>
                <th data-field="child_relation_id" data-filter-control="select" scope="col" data-visible="false">Relation Id</th>
                <th data-field="child_relation_name" data-width="20%" data-filter-control="select" scope="col">Relation</th>
                <th data-field="delete" data-width="3%" data-formatter="deleteFormatter" data-events="deleteEvents">Del</th>
            </tr>
        </thead>
    </table>

    @include('admin.includes.family-tree.add')
    @include('admin.includes.family-tree.show')
    @include('admin.includes.family-tree.delete')
    @include('admin.includes.family-tree.deleteall')

</div>
{{-- End Container --}}
@endsection

@section('scripts')
    {{-- for Toast --}}
    <script type="text/javascript">
        toastr.options.progressBar = true;
        toastr.options.timeOut = 5000; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it
    </script>
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

        function initTable() {
            $table.bootstrapTable({
                height: getHeight(),
                columns: [ {},{},{ align: 'left' },{ align: 'center' },{ align: 'center' },{ align: 'left' },{},{ align: 'left' },{ align: 'center', clickToSelect: false }]
            });
            $(window).resize(function () {
                $table.bootstrapTable('resetView', {
                    height: getHeight()
                });
            });
        }

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
        function getDataforCombo() {
            $.ajax({
                dataType: 'json',
                url: memberListURL + '?table=members',
                success: function(data) { 
                    parentList = data['members'];
                    fillMemberCombo($combo, data['members']);
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error("can't get member data from server: " + JSON.stringify(jqXHR), 'Failed');
                }
            });
        }

        // Get list from server and fill combobox
        function getRelationList() {
            $.ajax({
                dataType: 'json',
                url: codesUrl + '?category_id=' + RELATION_CODE,
                success: function(data) { // What to do if we succeed
                    relationList = data['codes'];
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error("can't get department data from server: " + JSON.stringify(jqXHR), 'Failed');
                }
            });
        }  

        // Reload data from server and refresh table
        function reloadList() {
            $('#addMemberCombo').val('').trigger('chosen:updated');
            $('#addRelationCombo').val('').trigger('chosen:updated');
            $.ajax({
                dataType: 'json',
                url: familyTreesUrl + '?parent_id=' + currentParentId,
                success: function(data) { // What to do if we succeed
                    if (data['result'].length > 0) {
                        $table.bootstrapTable( 'load', { data: data['result'] } );
                    } else {
                        $table.bootstrapTable( 'removeAll' );
                    } 
                    childLists = data['result'];
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error("can't get data from server: " + JSON.stringify(jqXHR), 'Failed');
                }
            });
        } 

        initTable();
        getRelationList();
        getDataforCombo();

        function fillAddMemberCombo(memberCombo, members) {
            memberCombo.empty();
            var html = '<option value=""></option>';
            $.each(members, function( index, member ) {
                var fullName;
                if (!member['first_name'] && !member['last_name']) {
                    fullName = member['kor_name'];
                } else {
                    fullName = !member['first_name'] ? member['last_name'] : member['first_name'] + ' ' + member['last_name'];
                }
                html += '<option value="' + member['id'] + '">' + fullName + '</option>';
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

        // click addChild button
        function addChild() {
            if (currentParentId) {
                $.ajax({
                    dataType: 'json',
                    method:'GET',
                    url: getCodesNotInChild + '?parent_id=' + currentParentId,
                    success: function(data) {
                        if (data.length < 1) {
                            toastr.error('There are no more data to add!', 'Warning');
                        } else {
                            fillAddMemberCombo($('#addMemberCombo'), data["members"]);
                            fillAddRelationCombo($('#addRelationCombo'), relationList);
                            $('#add-item').modal({show:true});
                        }
                    }
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

            $.ajax({
                dataType: 'json',
                method:'POST',
                url: form_action,
                data: postData,
                success: function(data) {
                    if (data.errors) {
                        var message = '';
                        for (i=0; i < data.errors.length; i++) {
                            message += data.errors[i] + (i < data.errors.length -1 ? ' | ' : '');
                        } 
                        toastr.error(message, data.message);
                    } else {
                        toastr.success(data.message, 'Success');
                        $table.bootstrapTable("append", tableData); // Add input data to table
                        $('#addForm')[0].reset(); // Clear create form 
                        $(".modal").modal('hide'); // hide model form
                        reloadList();
                    }
                }
            });
        });    

        
        // Delete button was pressed
        $(".crud-delete").click(function(e){
            event.preventDefault();
            $.ajax({
                dataType: 'json',
                type:'delete',
                url: familyTreesUrl + '/' + saveId,
                success: function(data) {
                    if (data.errors) {
                        toastr.error(data.errors, data.message);
                    } else {
                        toastr.success(data.message, 'Success');
                        $table.bootstrapTable('remove', {field: 'id', values: [saveId]});
                        $(".modal").modal('hide'); // hide model form
                        reloadList();
                    }
                }
            });
        });

        // Delete all button was pressed
        $(".crud-all").click(function(e){
            event.preventDefault();
            if (childLists) { // if selected items are more than one?
                var deferreds = [];
                $.each(childLists, function(index, item) {
                    deferreds.push(
                        $.ajax({
                            dataType: 'json',
                            type:'delete',
                            url: familyTreesUrl + '/' + item['id'],
                        })
                    );
                });
                $.when.apply($, deferreds).then( function() {
                    toastr.success('Data was successfully saved.', 'Success');
                    $(".modal").modal('hide'); // hide model form
                    reloadList();
                }).fail(function(e){
                    toastr.error('Error occured! Please Save again.' + deferreds.length + ' message:' + e.message, 'Failed');
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
                $("#deleteall-item").modal('show');
            } else {
                toastr.error('There is nothing to delete.', 'Failed');
            }
        }
        
        // 테이블의 Column을 클릭하면 발생하는 이벤트를 핸들한다.
        $table.on('click-cell.bs.table', function (field, column, row, rec) {
            saveId = Number(rec.id);
            if (column === 'delete') {
                var dispId = $("#deleteBody");
                dispId.find("span[name='parent_txt']").text(currentParentName + ' (' + currentParentId + ')');
                dispId.find("span[name='child_txt']").text(rec.child_name + ' (' + rec.child_id + ')');
                dispId.find("span[name='relation']").text(rec.child_relation_name + ' (' + rec.child_relation_id + ')');
                // Open Bootstrap Model without Button Click
                $("#delete-item").modal('show');
            } else {
                var dispId = $("#showBody");
                dispId.find("span[name='parent_txt']").text(currentParentName + ' (' + currentParentId + ')');
                dispId.find("span[name='child_txt']").text(rec.child_name + ' (' + rec.child_id + ')');
                dispId.find("span[name='relation']").text(rec.child_relation_name + ' (' + rec.child_relation_id + ')');
                // Open Bootstrap Model without Button Click
                $("#show-item").modal('show');
            }
        });

        // 테이블의 Row를 클릭하면 발생하는 이벤트를 핸들한다: Bootstrap Table에서 Index를 구하기 위한 유일한 방법(Maybe)
        $table.on('click-row.bs.table', function (e, row, $element) {
            saveIndex = $element.index();
        });   
    </script>
    
    {{-- chosen user interface CDN for autocomplete input --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.min.js"></script>

    {{-- export EXCEL, PDF, PNG, JSON --}}
    <script src="{{ asset('js/export.js') }}"></script>
@endsection