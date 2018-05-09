@extends('admin.layouts.master')

@section('styles')
    {{-- chosen user interface for autocomplete input --}}
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class='container p-4'>
    <h4>{{ __('messages.adm_title.title', ['title' => 'Department Enrollment']) }}</h4>
    <div id="toolbar">
        <div class='form-inline py-2'>
            <div class='mr-2' style="width: 200px;">
                <select id='membersCombo' class="form-group form-control mr-2" style="width: 200px;" data-placeholder="{{ __('messages.adm_table.select_member') }}">
                </select>
            </div>
            <button id="pop" class="form-group form-control btn btn-secondary mr-2" type="button" data-placement="right" data-toggle="popover" data-trigger="focus" data-title="Describe" data-content="">
                <i class="fa fa-question" aria-hidden="true"></i>
            </button>
            <button class="form-group form-control btn btn-info mr-2" type="button" title="Add Career" onclick="addChild();">
                <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('messages.adm_button.add_career') }}
            </button>
            @include('admin.includes.export', [ 'router' => 'admin.export.memdeptmaps' ])     
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
                <th data-field="department_id" data-visible="false" data-searchable="false">{{ __('messages.adm_table.dept_id') }}</th>
                <th data-field="department_name">{{ __('messages.adm_table.dept_name') }}</th>
                <th data-field="position_id" data-visible="false" data-searchable="false">{{ __('messages.adm_table.position_id') }}</th>
                <th data-field="position_name">{{ __('messages.adm_table.position_name') }}</th>
                <th data-field="enabled" data-width="7%" data-formatter="enabledFormatter" data-searchable="false">{{ __('messages.adm_table.enable') }}</th>
                <th data-field="manager" data-formatter="managerFormatter" data-searchable="false">{{ __('messages.adm_table.manager') }}</th>
                <th data-field="updated_by" data-visible="false" data-searchable="false">{{ __('messages.adm_table.updated_by') }}</th>
                <th data-field="updated_by_name">{{ __('messages.adm_table.updated_by_name') }}</th>
                <th data-field="edit" data-width="3%" data-formatter="editFormatter" data-events="editEvents" data-searchable="false">{{ __('messages.adm_table.edit_btn') }}</th>
                <th data-field="delete" data-width="3%" data-formatter="deleteFormatter" data-events="deleteEvents" data-searchable="false">{{ __('messages.adm_table.del_btn') }}</th>
            </tr>
        </thead>
    </table>

    @include('admin.members.includes.mem-dept-map.add')
    @include('admin.members.includes.mem-dept-map.edit')
    @include('admin.members.includes.mem-dept-map.show')
    @include('admin.members.includes.mem-dept-map.delete')

</div>
{{-- End Container --}}
@endsection

@section('scripts')
    <script type="text/javascript">
        const $table = $('#mainTable');
        const $combo = $("#membersCombo");
        const $popover = $("#pop");
        const DEPARTMENT_CODE = 5; // department id in categories table
        const POSITION_CODE = 12; // position id in categories table
        const memberListURL = "{!! route('admin.users.get-users') !!}";
        const codesUrl = "{!! route('admin.codes.index') !!}";
        const memDeptTreesUrl = "{!! route('admin.member-dept-trees.index') !!}";
        const getCodesNotInChild = "{!! route('admin.member-dept-trees.getcodes-notin-child') !!}";

        var parentList; // all items for combo box
        var departmentList; // all department code list from codes
        var positionList; // all position code list from codes
        var currentParentId; // current selected parent code id in parentList combo box
        var currentParentName; // current selected parent code name in parentList combo box
        var saveId;
        var childLists;
        var userId, userName;

        /* initialize Main table */

        // compute height of the table and return 
        function getHeight() {
            $(window).height() - $('h4').outerHeight(true); // table height
        }

        // column(name: enabled) initialize: display 'Enabled' or 'Disabled' instead of '1' or '0'
        function enabledFormatter(value, row, index) {
            if (value === 1) { return '{{ __('messages.adm_table.enable_input') }}'; } else { return '{{ __('messages.adm_table.disable_input') }}'; }
        }

        function managerFormatter(value, row, index) {
            if (value === 1) { return '{{ __('messages.adm_table.manager_input') }}'; } else { return '{{ __('messages.adm_table.nomanager_input') }}'; }
        }
        // Row Style of main table
        function rowStyle(row, index) {
            return { css: { "padding": "0px 10px" } };
        }

        // compose the column for edit button 
        function editFormatter(value, row, index) {
            return [
                '<a href="#"><span class="text-primary h6-font-size"><i class="fa fa-fw fa-check-circle" aria-hidden="true"></i></span></a>'
            ].join('');
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
                columns: [ {},{},{ align: 'left' },{},{ align: 'left' },{ align: 'center' },{ align: 'center', clickToSelect: false }]
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
            $.ajax({ dataType: 'json', timeout: 3000, url: memberListURL + '?table=members' })
            .done ( function(data, textStatus, jqXHR) { 
                parentList = data['members'];
                fillMemberCombo($combo, data['members']);
            }) 
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        }

        // Get list from server and fill combobox
        function getCodeList( category_id ) {
            $.ajax({ dataType: 'json', timeout: 3000, url: codesUrl + '?category_id=' + category_id })
            .done ( function(data, textStatus, jqXHR) { 
                category_id === DEPARTMENT_CODE ? departmentList = data['codes'] : positionList = data['codes'];
            }) 
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        }  

        // get current user info
        function getCurrentInfo() {
            $.ajax({ dataType: 'json', timeout: 3000, url: "{!! route('admin.users.get-current-users') !!}" })
            .done ( function(data, textStatus, jqXHR) { 
                userName = data['user']['name'];
                userId = data['user']['id'];
            }) 
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        }

        // Reload data from server and refresh table
        function reloadList() {
            $('#addDepartmentCombo').val('').trigger('chosen:updated');
            $('#addPositionCombo').val('').trigger('chosen:updated');
            $.ajax({ dataType: 'json', timeout: 3000, url: memDeptTreesUrl + '?parent_id=' + currentParentId })
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

        function fillCodeCombo(comboBox, lists) {
            comboBox.empty();
            var html = '<option value=""></option>';
            $.each(lists, function( index, list ) {
                html += '<option value="' + list['id'] + '">' + list['txt'] + '</option>';
            });
            comboBox.prepend(html);
            // The following options are available to pass into Chosen on instantiation.
            comboBox.chosen({
                case_sensitive_search: false,
                search_contains: true, // Setting this option to true allows matches starting from anywhere within a word. 
                no_results_text: "Oops, nothing found!",
                placeholder_text_single: "Select a Relation",
            });
        }

        initTable();
        getCodeList(DEPARTMENT_CODE);
        getCodeList(POSITION_CODE);
        getDataforCombo();
        getCurrentInfo();

        // click addChild button
        function addChild() {
            if (currentParentId) {
                fillCodeCombo($('#addDepartmentCombo'), departmentList);
                fillCodeCombo($('#addPositionCombo'), positionList);
                $('#add-item').find('span[name=users]').text(userName);
                $('#add-item').modal({show:true}).draggable({ handle: ".modal-header" });
            } else {
                selectMemberMessage();
            }
        }

        // Create 후 Submit 버튼을 눌렀다
        $(".crud-submit").click(function(e){
            e.preventDefault();
            const formId = $("#add-item");
            const form_action = formId.find("form").attr("action");

            var postData = { 
                member_id: currentParentId,
                department_id: $('#addDepartmentCombo').val(), 
                department_name: $('#addDepartmentCombo').find('option:selected').text(), 
                position_id: $('#addPositionCombo').val(), 
                position_name: $('#addPositionCombo').find('option:selected').text(),
                enabled: Number(formId.find("input[name='enabled']:checked").val()),
                manager: Number(formId.find("input[name='manager']:checked").val()),
                updated_by: userId,
                updated_by_name: userName,
            };

            $.ajax({ dataType: 'json', timeout: 3000, method:'POST', data: postData, url: form_action })
            .done ( function(data) {
                if (data.code == 'validation') {
                    validationMessage( data.errors );
                } else if (data.code == 'exception') {
                    exceptionMessage( data.status, data.errors );
                } else {
                    saveSuccessMessage();
                    $table.bootstrapTable("append", postData); // Add input data to table
                    $('#addForm')[0].reset(); // Clear create form 
                    $(".modal").modal('hide'); // hide model form
                    reloadList();
                }
            })
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        });    

         $(".crud-update").click(function(e){
            e.preventDefault();
            var formId = $("#edit-item");
            var form_action = formId.find("form").attr("action");

            var postData = { 
                member_id: currentParentId,
                department_id: $('#editDepartmentCombo').val(), 
                department_name: $('#editDepartmentCombo').find('option:selected').text(), 
                position_id: $('#editPositionCombo').val(), 
                position_name: $('#editPositionCombo').find('option:selected').text(),
                enabled: Number(formId.find("input[name='enabled']:checked").val()),
                manager: Number(formId.find("input[name='manager']:checked").val()),
                updated_by: userId,
                updated_by_name: userName,
            };

            $.ajax({ dataType: 'json', timeout: 3000, method:'PUT', data: postData, url: memDeptTreesUrl + '/' + saveId })
            .done ( function(data) {
                if (data.code == 'validation') {
                    validationMessage( data.errors );
                } else if (data.code == 'exception') {
                    exceptionMessage( data.status, data.errors );
                } else {
                    saveSuccessMessage();
                    $table.bootstrapTable('updateRow', {index: saveIndex, row: postData});
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
            $.ajax({ dataType: 'json', timeout: 3000, method:'delete', url: memDeptTreesUrl + '/' + saveId })
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

        $('#create-button').click( function(e) {
            $("#create-item").modal('show').draggable({ handle: ".modal-header" });
        });

        // 테이블의 Column을 클릭하면 발생하는 이벤트를 핸들한다.
        $table.on('click-cell.bs.table', function (field, column, row, rec) {
            saveId = Number(rec.id);
            if (column === 'edit') {
                var form = $("#edit-item");
                fillCodeCombo($('#editDepartmentCombo'), departmentList);
                fillCodeCombo($('#editPositionCombo'), positionList);
                $('#editDepartmentCombo').val(rec.department_id).trigger('chosen:updated');
                $('#editPositionCombo').val(rec.position_id).trigger('chosen:updated');
                form.find("input[name='enabled'][value='" + rec.enabled + "']").prop('checked', true);
                form.find("input[name='manager'][value='" + rec.manager + "']").prop('checked', true);
                form.find("span[name='users']").text(rec.updated_by_name + ' -> ' + userName );
                $("#edit-item").modal('show').draggable({ handle: ".modal-header" });
            } else if (column === 'delete') {
                // Open Bootstrap Model without Button Click
                $("#delete-item").modal('show').draggable({ handle: ".modal-header" });
            } else {
                var dispId = $("#showBody");
                dispId.find("span[name='department_name']").text(rec.department_name + ' (' + rec.department_id + ')');
                dispId.find("span[name='position_name']").text(rec.position_name + ' (' + rec.position_id + ')');
                dispId.find("span[name='enabled']").text( rec.enabled === 1 ? "{{ __('messages.adm_table.enable_input') }}" : "{{ __('messages.adm_table.disable_input') }}" );
                dispId.find("span[name='manager']").text( rec.manager === 1 ? "{{ __('messages.adm_table.manager_input') }}" : "{{ __('messages.adm_table.nomanager_input') }}" );
                dispId.find("span[name='updated_by']").text(rec.updated_by_name + ' (' + rec.updated_by + ')');
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