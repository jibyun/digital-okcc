@extends('admin.layouts.master')

@section('styles')
{{-- Chosen user interface for autocomplete input --}}
<link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class='container p-4'>
    <h4>{{ __('messages.adm_title.user') }}</h4>
    <div id="toolbar">
        <button class="btn btn-info mr-1" type="button" title="Create" data-toggle="modal" data-target="#create-item">
            <i class="fa fa-user mr-1" aria-hidden="true"></i>{{ __('messages.adm_button.register') }}
        </button>
        @include('admin.includes.export')
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
            data-row-style="rowStyle"
            data-show-columns="true">
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
            $('#createMemberCombo').val('').trigger('chosen:updated');
            $('#createPrivilegeCombo').val('').trigger('chosen:updated');
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

        function fillMemberCombo(memberCombo, members) {
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

        function fillPrivilegeCombo(privilegeCombo, privileges) {
            privilegeCombo.empty();
            var html = '<option value=""></option>';
            $.each(privileges, function( index, privilege ) {
                html += '<option value="' + privilege['idx'] + '">' + privilege['label'] + '</option>';
            });
            privilegeCombo.prepend(html);
            // The following options are available to pass into Chosen on instantiation.
            privilegeCombo.chosen({
                case_sensitive_search: false,
                search_contains: true, // Setting this option to true allows matches starting from anywhere within a word. 
                no_results_text: "Oops, nothing found!",
                placeholder_text_single: "Select a user privilege",
            });
        }

        // fill autocomplete list of members and privilege
        function getDataforCombo() {
            var deferreds = [];
            deferreds.push(
                $.ajax({
                    dataType: 'json',
                    url: listURL + '?table=members',
                    success: function(data) { 
                        fillMemberCombo($('#createMemberCombo'), data['members']);
                        fillMemberCombo($('#editMemberCombo'), data['members']);
                    },
                })
            );
            deferreds.push(
                $.ajax({
                    dataType: 'json',
                    url: listURL + '?table=privileges',
                    success: function(data) { 
                        fillPrivilegeCombo($('#createPrivilegeCombo'), data['privileges']);
                        fillPrivilegeCombo($('#editPrivilegeCombo'), data['privileges']);
                    },
                })
            );
            $.when.apply($, deferreds).then( function() {
            }).fail(function(e){
                toastr.error('Error occured! Please Save again. message:' + e.message, 'Failed');
            });
        }

        initTable();
        getDataforCombo();
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
                member_id: $('#createMemberCombo').val(),
                privilege_id: $('#createPrivilegeCombo').val() 
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
                member_id: $('#editMemberCombo').val(),
                member_name: $('#editMemberCombo option:selected').text(),
                privilege_id: $('#editPrivilegeCombo').val(),
                privilege_name: $('#editPrivilegeCombo option:selected').text(),
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
                name: $("#deleteBody").find("span[name='name']").text(),
                email: $("#deleteBody").find("span[name='email']").text() + "__DELETED USER!!!",
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
                // VERY IMPORTANT!!! If you use chosen, when you want to change a selection, you have to add .trigger('chosen:updated')
                $('#editMemberCombo').val(rec.member_id).trigger('chosen:updated');
                $('#editPrivilegeCombo').val(rec.privilege_id).trigger('chosen:updated');
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

    {{-- Chosen user interface CDN for autocomplete input --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.min.js"></script>
    
    {{-- export EXCEL, PDF, PNG, JSON --}}
    <script src="{{ asset('js/export.js') }}"></script>
@endsection