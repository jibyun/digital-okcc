@extends('admin.layouts.master')

@section('styles')
    {{-- IMPORTANT: OVERRIDE of selected row in Bootstrap table --}}
    <style>
        #addTable .selected td{
            background-color:#031023 !important;
            color: cornsilk;
        }
    </style>
@endsection

@section('content')

<div class='container p-4'>
    <h4>Configure Privileges</h4>
    <div id="toolbar">
        <div class='form-inline'>
            <select id='privilegesCombo' class="form-group form-control mr-3">
            </select>
            <button id="pop" class="form-group form-control btn btn-secondary mr-2" type="button" data-placement="right" data-toggle="popover" data-trigger="focus" title="Describe" data-content="">
                <i class="fa fa-question" aria-hidden="true"></i>
            </button>
            <button class="form-group form-control btn btn-info mr-2" type="button" title="Add Roles" onclick="addRoles();">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add Roles
            </button>
            <button class="form-group btn btn-danger btn-modal-target mr-2" type="button" title="Clear All" onclick="clearAll();">
                <i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Clear All
            </button>                    
        </div>
    </div>

    <table  id="mainTable" class="table table-striped table-bordered" 
            data-toolbar="#toolbar"
            data-side-pagination="client"
            data-search="true" 
            data-pagination="true" 
            data-page-list="[5, 10, 25, 50, 100, ALL]" 
            data-mobile-responsive="true" 
            data-click-to-select="true" 
            data-filter-control="true" 
            data-row-style="rowStyle">
        <thead>
            <tr>
                <th data-field="id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">Id</th>
                <th data-field="role_id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">Role Id</th>
                <th data-field="role_txt" data-width="20%" data-filter-control="select" data-sortable="true" scope="col">Role Name</th>
                <th data-field="role_memo" data-filter-control="select" data-sortable="true" scope="col" data-escape="true">Memo</th>
                <th data-field="delete" data-width="3%" data-formatter="deleteFormatter" data-events="deleteEvents">Del</th>
            </tr>
        </thead>
    </table>

    @include('admin.includes.p-role-map.add')
    @include('admin.includes.p-role-map.show')
    @include('admin.includes.p-role-map.delete')
    @include('admin.includes.p-role-map.deleteall')
    <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
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
        // variables
        var $table = $('#mainTable');
        var $addTable = $('#addTable');
        var $combo = $("#privilegesCombo");
        var privileges; // all items for combo box
        var currentPrivilegeId; // current selected id in combo box
        var currentPrivilegeTxt; // current selected text in combo box
        var privilegeRoleMaps;
        const privilegesRolesUrl = "{!! route('admin.p-role-map.index') !!}";
        const privilegesRolesPostUrl = "{!! route('admin.p-role-map.store') !!}";
        const privilegesUrl = "{!! route('admin.privileges.index') !!}";
        const getRolesNotInMap = "{!! route('admin.roles.getroles-notin-map') !!}"

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
                columns: [ {},{},{ align: 'left' },{ align: 'left' }, { align: 'center', clickToSelect: false }]
            });
            $(window).resize(function () {
                $table.bootstrapTable('resetView', {
                    height: getHeight()
                });
            });
        }

        /* Intialize add roles table */

        // Row Style of add table
        function addTableRowStyle(row, index) {
            return { css: { "padding": "0px 10px" } };
        }

        $addTable.bootstrapTable({
            height: getHeight(),
            columns: [ {},{},{ align: 'left' },{ align: 'left' } ]
        });

        $("#pop").popover();
        function setPopover(index) {
            $('#pop').attr('title', privileges[index]['txt']);
            currentPrivilegeTxt = privileges[index]['txt'];
            $('#pop').attr('data-content', $.parseHTML(privileges[index]['memo'])); //TODO: change HTML
        }

        /* main processes */

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        function buildPrivilegesCombo() {
            var html = '';
            for (var i=0; i < privileges.length; i++) {
                html += '<option value="' + privileges[i]['id'] + '" ' + (i===0 ? 'selected' : '') + '>' + 
                    privileges[i]['txt'] + '</option>';
            }
            $combo.append(html);    
            
            // whenever change category combo 
            $combo.change( function () {
                $("select option:selected").each( function() {
                    currentPrivilegeId = $(this).val();
                    reloadList();
                    for (var i=0; i < privileges.length; i++) {
                        if (currentPrivilegeId == privileges[i]['id']) {
                            setPopover(i);
                            break;
                        }
                    }
                });
            }).click( function() {
                // make the combo only one selection is possible
                if ($('select option').length == 1) {
                    $('select').change();
                }
            });      
        }

        // Get list from server and fill combobox
        function getInitList() {
            initTable();
            $.ajax({
                dataType: 'json',
                url: privilegesUrl,
                success: function(data) { // What to do if we succeed
                    privileges = data['privileges'];
                    currentPrivilegeId = privileges[0]['id'];
                    setPopover(0);
                    buildPrivilegesCombo();
                    reloadList();
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error("can't get privilege data from server: " + JSON.stringify(jqXHR), Failed);
                }
            });
        }  

        // Reload data from server and refresh table
        function reloadList() {
            $.ajax({
                dataType: 'json',
                url: privilegesRolesUrl + '?privilege_id=' + currentPrivilegeId,
                success: function(data) { // What to do if we succeed
                    if (data['result'].length > 0) {
                        $table.bootstrapTable( 'load', { data: data['result'] } );
                    } else {
                        $table.bootstrapTable( 'removeAll' );
                    } 
                    privilegeRoleMaps = data['result'];
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error("can't get data from server: " + JSON.stringify(jqXHR), 'Failed');
                }
            });
        } 

        getInitList();

        // click addRole button
        function addRoles() {
            $.ajax({
                dataType: 'json',
                method:'GET',
                url: getRolesNotInMap + '?privilege_id=' + currentPrivilegeId,
                success: function(data) {
                    if (data.length < 1) {
                        toastr.error('There are no more data to add!', 'Warning');
                    } else {
                        $addTable.bootstrapTable( 'load', { data: data["roles"] } );
                        $('#add-item').modal({show:true});
                    }
                }
            });
        }

        // Save button was pressed after selecting roles to add.
        $(".add-roles").click(function(e){
            event.preventDefault();
            var selection = $addTable.bootstrapTable('getSelections');
            if (selection) { // if selected items are more than one?
                var deferreds = [];
                // Async Ajax loop: https://stackoverflow.com/questions/18424712/how-to-loop-through-ajax-requests-inside-a-jquery-when-then-statment/18425082
                $.each(selection, function(index, item) {
                    var data = {
                        privilege_id: currentPrivilegeId, 
                        role_id: item['id'],
                    };
                    deferreds.push(
                        $.ajax({
                            dataType: 'json',
                            method: 'POST',
                            url: privilegesRolesPostUrl,
                            data: data
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

        // Delete button was pressed
        $(".crud-delete").click(function(e){
            event.preventDefault();
            $.ajax({
                dataType: 'json',
                type:'delete',
                url: privilegesRolesUrl + '/' + saveId,
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
            if (privilegeRoleMaps) { // if selected items are more than one?
                var deferreds = [];
                $.each(privilegeRoleMaps, function(index, item) {
                    deferreds.push(
                        $.ajax({
                            dataType: 'json',
                            type:'delete',
                            url: privilegesRolesUrl + '/' + item['id'],
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
            if (privilegeRoleMaps.length > 0) { // if selected items are more than one?
                var html = "";
                $.each(privilegeRoleMaps, function(index, item) {
                    html += '<div class="row py-2">';
                    html += '<div class="rounded bg-light py-2 col-sm-12"><span class="align-middle" name="role_name">' + item['role_txt'] + ' (' + item['role_id'] + ')</span></div>';
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
                dispId.find("span[name='privilege_txt']").text(currentPrivilegeTxt + ' (' + currentPrivilegeId + ')');
                dispId.find("span[name='role_txt']").text(rec.role_txt + ' (' + rec.role_id + ')');
                // Open Bootstrap Model without Button Click
                $("#delete-item").modal('show');
            } else {
                var dispId = $("#showBody");
                dispId.find("span[name='privilege_txt']").text(currentPrivilegeTxt + ' (' + currentPrivilegeId + ')');
                dispId.find("span[name='role_txt']").text(rec.role_txt + ' (' + rec.role_id + ')');
                // Open Bootstrap Model without Button Click
                $("#show-item").modal('show');
            }
        });

        // 테이블의 Row를 클릭하면 발생하는 이벤트를 핸들한다: Bootstrap Table에서 Index를 구하기 위한 유일한 방법(Maybe)
        $table.on('click-row.bs.table', function (e, row, $element) {
            saveIndex = $element.index();
        });
    </script>

@endsection