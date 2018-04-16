@extends('admin.layouts.master')

@section('styles')
{{-- jQuery user interface for autocomplete input --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<style>
    /* CSS for autocomplete */
    .ui-autocomplete {
        max-height: 300px;

        position: absolute;
        z-index: 99999 !important;
        cursor: default;
        padding: 0;
        margin-top: 2px;
        list-style: none;
        background-color: #ffffff;
        border: 1px solid #ccc -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    .ui-autocomplete>li {
        padding: 3px 20px;
    }
    .ui-autocomplete>li.ui-state-focus {
        background-color: #DDD;
    }
    .ui-helper-hidden-accessible {
        display: none;
    }
</style>
@endsection

@section('content')
<div class='container p-4'>
    <h4>User List</h4>
    <div id="toolbar">
        <button class="btn btn-info mr-1" type="button" title="Create" data-toggle="modal" data-target="#create-item">
            <i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Register User
        </button>
    </div>

    <table  id="table" class="table table-striped table-bordered" 
            data-toolbar="#toolbar"
            data-side-pagination="client"
            data-search="true" 
            data-pagination="true" 
            data-page-list="[5, 10, 25, ALL]" 
            data-mobile-responsive="true" 
            data-click-to-select="true" 
            data-filter-control="true" 
            data-row-style="rowStyle">
        <thead>
            <tr>
                <th data-field="id" scope="col" data-visible="false">Id</th>
                <th data-field="name" data-width="25%" data-filter-control="select" data-sortable="true" scope="col">User Name</th>
                <th data-field="email" data-width="43%" data-filter-control="select" data-sortable="true" scope="col">Email</th>
                <th data-field="member_id" scope="col" data-visible="false">Member Id</th>
                <th data-field="member_name" scope="col" data-visible="false">Member Name</th>
                <th data-field="privilege_id" scope="col" data-visible="false">Privilege Id</th>
                <th data-field="privilege_name" data-filter-control="select" data-sortable="true" scope="col">Privilege</th>
                <th data-field="edit" data-width="3%" data-formatter="editFormatter" data-events="editEvents">Edit</th>
                <th data-field="delete" data-width="3%" data-formatter="deleteFormatter" data-events="deleteEvents">Del</th>
            </tr>
        </thead>
    </table>

    @include('admin.includes.users.create')
    @include('admin.includes.users.edit')
    @include('admin.includes.users.show')
    @include('admin.includes.users.delete')

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
        const $table = $('#table');
        const listURL = "{!! route('admin.users.get-users') !!}";
        const basicURL = "{!! route('admin.users.index') !!}";
        var users;
        var saveIndex; // Row index of the table
        var saveId; // Primary key of the table

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        /* initialize bootstrap table */

        // row style
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

        // compute height of the table and return 
        function getHeight() {
            $(window).height() - $('h4').outerHeight(true); // table height
        }

        function initTable() {
            $table.bootstrapTable({
                height: getHeight(),
                columns: [ {},{ align: 'left' },{ align: 'left' },{},{},{},{ align: 'left' }, { align: 'center', clickToSelect: false }, { align: 'center', clickToSelect: false }]
            });
            // whenever being changed window's size, table's size should be also changed
            $(window).resize(function () {
                $table.bootstrapTable('resetView', {
                    height: getHeight()
                });
            });
        }

        // reload data from server and refresh table
        function reloadList() {
            $.ajax({
                dataType: 'json',
                url: listURL + '?table=users',
                success: function(data) { 
                    users = data['users'];
                    $table.bootstrapTable( 'load', { data: users } );
                }, 
                fail: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error("Fail to get data from server: " + JSON.stringify(jqXHR), 'Failed');
                }
            });
        } 

        // fill autocomplete list of members and privilege
        function fillAutocompleteList() {
            var deferreds = [];
            deferreds.push(
                $.ajax({
                    dataType: 'json',
                    url: listURL + '?table=members',
                    success: function(data) { 
                        $("#membersCombo").autocomplete({
                            source: data['members'],
                            select: function(event, ui) { $('#memberId').val(ui.item.idx); }
                        });
                        $("#membersComboEdit").autocomplete({
                            source: data['members'],
                            select: function(event, ui) { $('#memberIdEdit').val(ui.item.idx); }
                        });
                    },
                })
            );
            deferreds.push(
                $.ajax({
                    dataType: 'json',
                    url: listURL + '?table=privileges',
                    success: function(data) { 
                        $("#privilegesEdit").autocomplete({
                            source: data['privileges'],
                            select: function(event, ui) { $('#privilegeIdEdit').val(ui.item.idx); }
                        });
                        $("#privileges").autocomplete({
                            source: data['privileges'],
                            select: function(event, ui) { $('#privilegeId').val(ui.item.idx); }
                        });
                    },
                })
            );
            $.when.apply($, deferreds).then( function() {
            }).fail(function(e){
                toastr.error('Error occured! Please Save again. message:' + e.message, 'Failed');
            });
        }

        initTable();
        fillAutocompleteList();
        reloadList();


        // pressed save register button
        $(".crud-register").click(function(e){
            e.preventDefault();
            var formId = $("#create-item");
            var form_action = formId.find("form").attr("action");
            var postData = {
                name: formId.find("input[name='name']").val(),
                email: formId.find("input[name='email']").val(),
                password: 'password',
                member_id: $('#memberId').val(),
                privilege_id: $('#privilegeId').val() 
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
                        $('#createForm')[0].reset(); // Clear create form 
                        $(".modal").modal('hide'); // hide model form
                        reloadList();
                    }
                }
            });
        });

        // press save button to edit
        $(".crud-update").click(function(e){
            e.preventDefault();
            var formId = $("#edit-item");
            var form_action = formId.find("form").attr("action");
            var postData = {
                name: formId.find("input[name='name']").val(),
                email: formId.find("input[name='email']").val(),
                member_id: $('#memberIdEdit').val(),
                member_name: formId.find("input[name='members']").val(),
                privilege_id: $('#privilegeIdEdit').val(),
                privilege_name: formId.find("input[name='privileges']").val(),
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
                        $('#editForm')[0].reset(); // Clear create form 
                        $(".modal").modal('hide'); // hide model form
                        reloadList();
                    }
                }
            });
        });

        // delete record but I will just add 'DELETED' to email address 
        $(".crud-delete").click(function(e){
            e.preventDefault();
            var formId = $("#edit-item");
            var form_action = formId.find("form").attr("action");
            var postData = {
                name: $("#deleteBody").find("label[name='name']").text(),
                email: $("#deleteBody").find("label[name='email']").text() + "__DELETED USER!!!",
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
                        $('#editForm')[0].reset(); // Clear create form 
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
                form.find("input[name='name']").val(rec.name);
                form.find("input[name='email']").val(rec.email);
                form.find("input[id='member_id']").val(rec.member_id);
                form.find("input[id='privilege_id']").val(rec.privilege_id);
                form.find("input[name='members']").val(rec.member_name);
                form.find("input[name='privileges']").val(rec.privilege_name);
                form.find("#editForm").attr("action", basicURL + '/' + rec.id);
            } else if (column === 'delete') {
                var dispId = $("#deleteBody");
                dispId.find("span[name='name']").text(rec.name);
                dispId.find("span[name='email']").text(rec.email);
                dispId.find("span[name='member_name']").text(rec.member_name + ' (' + rec.member_id + ')');
                dispId.find("span[name='privilege_name']").text(rec.privilege_name + ' (' + rec.privilege_id + ')');
                $("#edit-item").find("#editForm").attr("action", basicURL + '/' + rec.id);
                // Open Bootstrap Model without Button Click
                $("#delete-item").modal('show');
            } else {
                var dispId = $("#showBody");
                dispId.find("span[name='name']").text(rec.name);
                dispId.find("span[name='email']").text(rec.email);
                dispId.find("span[name='member_name']").text(rec.member_name + ' (' + rec.member_id + ')');
                dispId.find("span[name='privilege_name']").text(rec.privilege_name + ' (' + rec.privilege_id + ')');
                // Open Bootstrap Model without Button Click
                $("#show-item").modal('show');
            }
        });

        // 테이블의 Row를 클릭하면 발생하는 이벤트를 핸들한다: Bootstrap Table에서 Index를 구하기 위한 유일한 방법(Maybe)
        $table.on('click-row.bs.table', function (e, row, $element) {
            saveIndex = $element.index();
        });
    </script>

    {{-- jQuery user interface CDN for autocomplete input --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@endsection