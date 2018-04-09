@extends('admin.layouts.master')

@section('content')
<div class='container p-4'>
    <h4>Role List</h4>
    <div id="toolbar">
        <button class="btn btn-info mr-1" type="button" title="Create" data-toggle="modal" data-target="#create-item">
            <i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Create
        </button>
    </div>

    <table  id="table" class="table table-striped s1-font-size" 
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
                <th data-field="id" data-filter-control="select" data-sortable="true" scope="col" data-visible="false">Id</th>
                <th data-field="txt" data-width="15%" data-filter-control="select" data-sortable="true" scope="col">Role Name</th>
                <th data-field="memo" data-filter-control="select" data-sortable="true" scope="col">Memo</th>
                <th data-field="edit" data-width="3%" data-formatter="editFormatter" data-events="editEvents">EDIT</th>
                <th data-field="delete" data-width="3%" data-formatter="deleteFormatter" data-events="deleteEvents">DEL.</th>
            </tr>
        </thead>
    </table>

    @include('admin.includes.roles.create')
    @include('admin.includes.roles.edit')
    @include('admin.includes.roles.show')
    @include('admin.includes.roles.delete')

</div>
{{-- End Container --}}
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
    <script type="text/javascript"> 
        CKEDITOR.replace( 'ckeditor-create' ); 
        CKEDITOR.replace( 'ckeditor-edit' );
    </script>

    <script type="text/javascript">
        var url = "{!! route('roles.index') !!}";
        var saveIndex; // Row index of the table
        var saveId; // Primary key of roles
        var roles; // cached roles
        var $table = $('#table');

        toastr.options.progressBar = true;
        toastr.options.timeOut = 5000; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        // Row Style
        function rowStyle(row, index) {
            return {
                classes: 'font-weight-normal',
                css: { "color": "black", "padding": "0 10px" }
            };
        }

        // 리스트 테이블의 초기화: Edit 컬럼의 버튼을 구성한다.
        function editFormatter(value, row, index) {
            return [
                '<a href="#" data-toggle="modal" data-target="#edit-item"><H5><span class="badge badge-info"><i class="fa fa-pencil" aria-hidden="true"></i></span></H5></a>'
            ].join('');
        }

        // 리스트 테이블의 초기화: Delete 컬럼의 버튼을 구성한다.
        function deleteFormatter(value, row, index) {
            return [
                '<a href="#"><H5><span class="badge badge-danger"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></span></H5></a>'
            ].join('');
        }

        // compute height of the table and return 
        function getHeight() {
            $(window).height() - $('h4').outerHeight(true); // table height
        }

        function initTable() {
            $table.bootstrapTable({
                height: getHeight(),
                columns: [ {},{},{}, { align: 'center', clickToSelect: false }, { align: 'center', clickToSelect: false }]
            });
            // whenever being changed window's size, table's size should be also changed
            $(window).resize(function () {
                $table.bootstrapTable('resetView', {
                    height: getHeight()
                });
            });
        }

        // Reload data from server and refresh table
        function reloadList() {
            $.ajax({
                dataType: 'json',
                url: url,
                success: function(data) { // What to do if we succeed
                    roles = data['roles'];
                    $table.bootstrapTable( 'load', { data: roles } );
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error("can't get roles data from server: " + JSON.stringify(jqXHR), Failed);
                }
            });
        }  

        // Get list from server and show
        function getInitList() {
            initTable();
            reloadList();
        }  

        // 이 페이지가 처음 로드될 때 데이터를 읽어 표시한다.
        getInitList();

        // Create 후 Submit 버튼을 눌렀다
        $(".crud-submit").click(function(e){
            e.preventDefault();
            var formId = $("#create-item");
            var form_action = formId.find("form").attr("action");

            var postData = { 
                txt: formId.find("input[name='txt']").val(), 
                memo: CKEDITOR.instances['ckeditor-create'].getData(), 
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
                        CKEDITOR.instances['ckeditor-create'].setData('');
                        $(".modal").modal('hide'); // hide model form
                        reloadList();
                    }
                }
            });
        });

        // Edit 후 Submit 버튼을 눌렀다
        $(".crud-update").click(function(e){
            e.preventDefault();
            var formId = $("#edit-item");
            var form_action = formId.find("form").attr("action");

            var postData = { 
                txt: formId.find("input[name='txt']").val(), 
                memo: CKEDITOR.instances['ckeditor-edit'].getData(), 
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
                        CKEDITOR.instances['ckeditor-edit'].setData('');
                        $(".modal").modal('hide'); // hide model form
                        reloadList();
                    }
                }
            });
        });

        // Delete 버튼을 눌렀다.
        $("body").on("click", ".crud-delete", function() {
            $.ajax({
                dataType: 'json',
                type:'delete',
                url: url + '/' + saveId,
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
                form.find("input[name='txt']").val(rec.txt);
                CKEDITOR.instances['ckeditor-edit'].setData(rec.memo);
                form.find("#editForm").attr("action", url + '/' + rec.id);
            } else if (column === 'delete') {
                var deleteId = $("#deleteBody");
                deleteId.find("label[name='txt']").text(rec.txt);
                deleteId.find("label[name='memo']").html(rec.memo);
                // Open Bootstrap Model without Button Click
                $("#delete-item").modal('show');
            } else {
                var showId = $("#showBody");
                showId.find("label[name='txt']").text(rec.txt);
                showId.find("label[name='memo']").html(rec.memo);
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