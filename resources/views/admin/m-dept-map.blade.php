@extends('admin.layouts.master')

@section('styles')
    {{-- chosen user interface for autocomplete input --}}
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
    {{-- Tempus Dominus Bootstrap 4: The plugin provide a robust date and time picker designed to integrate into your Bootstrap project. https://tempusdominus.github.io/bootstrap-4/ --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endsection

@section('content')

<div class='container p-4'>
    <h4>{{ __('messages.adm_title.title', ['title' => 'Department Enrollment']) }}</h4>
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
                <button class="form-group form-control btn btn-info mr-2" type="button" title="Add Career" onclick="addChild();">
                    <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('messages.adm_button.add_career') }}
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
                <th data-field="id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.id') }}</th>
                <th data-field="department_id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.dept_id') }}</th>
                <th data-field="department_name" data-filter-control="select" scope="col">{{ __('messages.adm_table.dept_name') }}</th>
                <th data-field="position_id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.position_id') }}</th>
                <th data-field="position_name" data-filter-control="select" scope="col">{{ __('messages.adm_table.position_name') }}</th>
                <th data-field="enabled" data-width="7%" data-formatter="enabledFormatter" data-filter-control="select" scope="col">{{ __('messages.adm_table.enable') }}</th>
                <th data-field="started_at" data-width="10%" data-filter-control="select" scope="col">{{ __('messages.adm_table.start_at') }}</th>
                <th data-field="finished_at" data-width="10%" data-filter-control="select" scope="col">{{ __('messages.adm_table.finished_at') }}</th>
                <th data-field="updated_by" data-filter-control="select" scope="col" data-visible="false">{{ __('messages.adm_table.updated_by') }}</th>
                <th data-field="updated_by_name" data-filter-control="select" scope="col">{{ __('messages.adm_table.updated_by_name') }}</th>
                <th data-field="edit" data-width="3%" data-formatter="editFormatter" data-events="editEvents">{{ __('messages.adm_table.edit_btn') }}</th>
                <th data-field="delete" data-width="3%" data-formatter="deleteFormatter" data-events="deleteEvents">{{ __('messages.adm_table.del_btn') }}</th>
            </tr>
        </thead>
    </table>

    @include('admin.includes.mem-dept-map.add')
    @include('admin.includes.mem-dept-map.edit')
    @include('admin.includes.mem-dept-map.show')
    @include('admin.includes.mem-dept-map.delete')

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
            if (value === 1) { return 'Enabled'; } else { return 'Disabled'; }
        }

        // Row Style of main table
        function rowStyle(row, index) {
            return { css: { "padding": "0px 10px" } };
        }

        // compose the column for edit button 
        function editFormatter(value, row, index) {
            return [
                '<a href="#" data-toggle="modal" data-target="#edit-item"><span class="text-primary h6-font-size"><i class="fa fa-fw fa-check-circle" aria-hidden="true"></i></span></a>'
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
                columns: [ {},{},{ align: 'left' },{},{ align: 'left' },{ align: 'center' },{ align: 'center' },{ align: 'center' },{ align: 'center', clickToSelect: false }]
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
        function getCodeList( category_id ) {
            $.ajax({
                dataType: 'json',
                url: codesUrl + '?category_id=' + category_id,
                success: function(data) { // What to do if we succeed
                    category_id === DEPARTMENT_CODE ? departmentList = data['codes'] : positionList = data['codes'];
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error("can't get department data from server: " + JSON.stringify(jqXHR), 'Failed');
                }
            });
        }  

        // get current user info
        function getCurrentInfo() {
            $.ajax({
                dataType: 'json',
                url: "{!! route('admin.users.get-current-users') !!}",
                success: function(data) { 
                    userName = data['user']['name'];
                    userId = data['user']['id'];
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error("can't get member data from server: " + JSON.stringify(jqXHR), 'Failed');
                }
            });
        }

        // Reload data from server and refresh table
        function reloadList() {
            $('#addDepartmentCombo').val('').trigger('chosen:updated');
            $('#addPositionCombo').val('').trigger('chosen:updated');
            $.ajax({
                dataType: 'json',
                url: memDeptTreesUrl + '?parent_id=' + currentParentId,
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
                $('#add-item').modal({show:true});
            } else {
                toastr.warning("Select a Member first!", 'Warning');
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
                started_at: formId.find("input[name='started_at']").val(),
                finished_at: formId.find("input[name='finished_at']").val(),
                updated_by: userId,
                updated_by_name: userName,
            };

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
                        $table.bootstrapTable("append", postData); // Add input data to table
                        $('#addForm')[0].reset(); // Clear create form 
                        $(".modal").modal('hide'); // hide model form
                        reloadList();
                    }
                }
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
                started_at: formId.find("input[name='started_at']").val(),
                finished_at: formId.find("input[name='finished_at']").val(),
                updated_by: userId,
                updated_by_name: userName,
            };

            $.ajax({
                dataType: 'json',
                method: 'PUT',
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
                        $table.bootstrapTable('updateRow', {index: saveIndex, row: postData});
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
                url: memDeptTreesUrl + '/' + saveId,
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
                form.find("input[name='started_at']").val(rec.started_at);
                form.find("input[name='finished_at']").val(rec.finished_at);
                form.find("span[name='users']").text(rec.updated_by_name + ' -> ' + userName );
                form.find("#editForm").attr("action", memDeptTreesUrl + '/' + rec.id);
            } else if (column === 'delete') {
                var dispId = $("#deleteBody");
                dispId.find("span[name='department_name']").text(rec.department_name + ' (' + rec.department_id + ')');
                dispId.find("span[name='position_name']").text(rec.position_name + ' (' + rec.position_id + ')');
                dispId.find("span[name='started_at']").text(rec.started_at);
                dispId.find("span[name='finished_at']").text(rec.finished_at);
                dispId.find("span[name='enabled']").text( rec.enabled === 1 ? "Enabled" : "Disabled" );
                dispId.find("span[name='updated_by']").text(rec.updated_by_name + ' (' + rec.updated_by + ')');
                // Open Bootstrap Model without Button Click
                $("#delete-item").modal('show');
            } else {
                var dispId = $("#showBody");
                dispId.find("span[name='department_name']").text(rec.department_name + ' (' + rec.department_id + ')');
                dispId.find("span[name='position_name']").text(rec.position_name + ' (' + rec.position_id + ')');
                dispId.find("span[name='started_at']").text(rec.started_at);
                dispId.find("span[name='finished_at']").text(rec.finished_at);
                dispId.find("span[name='enabled']").text( rec.enabled === 1 ? "Enabled" : "Disabled" );
                dispId.find("span[name='updated_by']").text(rec.updated_by_name + ' (' + rec.updated_by + ')');
                // Open Bootstrap Model without Button Click
                $("#show-item").modal('show');
            }
        });

        // 테이블의 Row를 클릭하면 발생하는 이벤트를 핸들한다: Bootstrap Table에서 Index를 구하기 위한 유일한 방법(Maybe)
        $table.on('click-row.bs.table', function (e, row, $element) {
            saveIndex = $element.index();
        }); 

        $(function () {
            $('#addStartDate').datetimepicker({ format: 'YYYY-MM-DD' });
            $('#addEndDate').datetimepicker({ format: 'YYYY-MM-DD' });
            $('#editStartDate').datetimepicker({ format: 'YYYY-MM-DD' });
            $('#editEndDate').datetimepicker({ format: 'YYYY-MM-DD' });
        });
        
    </script>
    
    {{-- chosen user interface CDN for autocomplete input --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.min.js"></script>
    {{-- Tempus Dominus Bootstrap 4: The plugin provide a robust date and time picker designed to integrate into your Bootstrap project. https://tempusdominus.github.io/bootstrap-4/ --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    
    {{-- export EXCEL, PDF, PNG, JSON --}}
    <script src="{{ asset('js/export.js') }}"></script>
@endsection