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
    <h4>{{ __('messages.adm_title.title', ['title' => 'Privilege Mapping']) }}</h4>
    <div id="toolbar">
        <div class='form-inline'>
            <select id='privilegesCombo' class="form-group form-control mr-2" style="width: 180px">
            </select>
            <button id="pop" class="form-group form-control btn btn-secondary mr-2" type="button" data-placement="right" data-toggle="popover" data-trigger="focus" title="Describe" data-content="">
                <i class="fa fa-question" aria-hidden="true"></i>
            </button>
            <button class="form-group form-control btn btn-info mr-2" type="button" title="Add Roles" onclick="addRoles();">
                <i class="fa fa-plus mr-1" aria-hidden="true"></i>{{ __('messages.adm_button.add_role') }}
            </button>
            <button class="form-group btn btn-danger btn-modal-target mr-2" type="button" title="Clear All" onclick="clearAll();">
                <i class="fa fa-times mr-1" aria-hidden="true"></i>{{ __('messages.adm_button.clear_all') }}
            </button>    
            @include('admin.includes.export', [ 'router' => 'admin.export.privilegerolemaps' ])               
        </div>
    </div>

    <table  id="mainTable" class="table table-striped table-bordered" 
            data-toolbar="#toolbar"
            data-side-pagination="client"
            data-search="true" 
            data-search-on-enter-key="true"
            data-pagination="true" 
            data-page-list="[5, 10, 25, ALL]" 
            data-row-style="rowStyle"
            data-show-columns="true"
            >
        <thead>
            <tr>
                <th data-field="id" data-visible="false" data-searchable="false">{{ __('messages.adm_table.id') }}</th>
                <th data-field="role_id" data-visible="false" data-searchable="false">{{ __('messages.adm_table.role_id') }}</th>
                <th data-field="role_txt" data-width="20%" data-sortable="true">{{ __('messages.adm_table.role_name') }}</th>
                <th data-field="role_memo" data-sortable="true">{{ __('messages.adm_table.memo') }}</th>
                <th data-field="delete" data-width="3%" data-formatter="deleteFormatter" data-events="deleteEvents" data-searchable="false">{{ __('messages.adm_table.del_btn') }}</th>
            </tr>
        </thead>
    </table>

    @include('admin.includes.p-role-map.add')
    @include('admin.includes.p-role-map.show')
    @include('admin.includes.p-role-map.delete')
    @include('admin.includes.p-role-map.deleteall')
</div>
{{-- End Container --}}
@endsection

@section('scripts')
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
            $.ajax({ dataType: 'json', timeout: 3000, url: privilegesUrl })
            .done ( function(data, textStatus, jqXHR) { 
                privileges = data['privileges'];
                currentPrivilegeId = privileges[0]['id'];
                setPopover(0);
                buildPrivilegesCombo();
                reloadList();
            }) 
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        }  

        // Reload data from server and refresh table
        function reloadList() {
            $.ajax({ dataType: 'json', timeout: 3000, url: privilegesRolesUrl + '?privilege_id=' + currentPrivilegeId })
            .done ( function(data, textStatus, jqXHR) { 
                if (data['result'].length > 0) {
                    $table.bootstrapTable( 'load', { data: data['result'] } );
                } else {
                    $table.bootstrapTable( 'removeAll' );
                } 
                privilegeRoleMaps = data['result'];
            }) 
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        } 

        getInitList();

        // click addRole button
        function addRoles() {
            $.ajax({ dataType: 'json', timeout: 3000, method:'GET', url: getRolesNotInMap + '?privilege_id=' + currentPrivilegeId })
            .done ( function(data) {
                if (data.length < 1) {
                    nomoreDataError();
                } else {
                    $addTable.bootstrapTable( 'load', { data: data["roles"] } );
                    $('#add-item').modal({show:true}).draggable({ handle: ".modal-header" });
                }
            })
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        }

        // Save button was pressed after selecting roles to add.
        $(".crud-submit").click(function(e){
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
                        $.ajax({ dataType: 'json', method: 'POST', data: data, timeout: 3000, url: privilegesRolesPostUrl })
                    );
                });
                $.when.apply($, deferreds).then( function() {
                    saveSuccessMessage();
                    $(".modal").modal('hide'); // hide model form
                    reloadList();
                }).fail(function(e){
                    saveErrorMessage();
                });
            }
        });

        // Delete button was pressed
        $(".crud-delete").click(function(e){
            event.preventDefault();
            $.ajax({ dataType: 'json', timeout: 3000, method:'delete', url: privilegesRolesUrl + '/' + saveId })
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
            if (privilegeRoleMaps) { // if selected items are more than one?
                var deferreds = [];
                $.each(privilegeRoleMaps, function(index, item) {
                    deferreds.push(
                        $.ajax({ dataType: 'json', type:'delete', timeout: 3000, url: privilegesRolesUrl + '/' + item['id'] })
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
            if (privilegeRoleMaps.length > 0) { // if selected items are more than one?
                var html = "";
                $.each(privilegeRoleMaps, function(index, item) {
                    html += '<div class="row py-2">';
                    html += '<div class="rounded bg-light py-2 col-sm-12"><span class="align-middle" name="role_name">' + item['role_txt'] + ' (' + item['role_id'] + ')</span></div>';
                    html += '</div>';
                });
                $("#deleteAllBody").prepend(html);
                // Open Bootstrap Model without Button Click
                $("#deleteall-item").modal('show').draggable({ handle: ".modal-header" });
            } else {
                nomoreDeleteError();
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
                dispId.find("span[name='privilege_txt']").text(currentPrivilegeTxt + ' (' + currentPrivilegeId + ')');
                dispId.find("span[name='role_txt']").text(rec.role_txt + ' (' + rec.role_id + ')');
                // Open Bootstrap Model without Button Click
                $("#show-item").modal('show').draggable({ handle: ".modal-header" });
            }
        });

        // 테이블의 Row를 클릭하면 발생하는 이벤트를 핸들한다: Bootstrap Table에서 Index를 구하기 위한 유일한 방법(Maybe)
        $table.on('click-row.bs.table', function (e, row, $element) {
            saveIndex = $element.index();
        });
    </script>
    {{-- to implement make display order --}}
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>

@endsection