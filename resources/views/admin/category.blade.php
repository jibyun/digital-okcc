@extends('admin.layouts.master')

@section('content')
<div class='container p-4'>
    <h4>Category List</h4>
    <div id="toolbar">
        <button class="btn btn-info mr-1" type="button" title="Create" data-toggle="modal" data-target="#create-item">
            <i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Create
        </button>
        {{-- TODO: 추후 Excel과 PDF Export 기능이 추가되면 disabled 를 삭제한다 --}}
        <button id="export" class="btn btn-default mr-1" type="button" title="Export Excel" disabled>
            <i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;&nbsp;Export Excel
        </button>
        <button id="export" class="btn btn-default mr-1" type="button" title="Export PDF" disabled>
            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;&nbsp;Export PDF
        </button>
        <button class="btn btn-warning btn-modal-target mr-1" type="button" title="Make Display Order" onclick="showOrder();">
            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>&nbsp;&nbsp;Make Diaplay Order
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
                <th data-field="txt" data-width="20%" data-filter-control="select" data-sortable="true" scope="col">Category Name</th>
                <th data-field="kor_txt" data-width="15%" data-filter-control="select" data-sortable="true" scope="col">카테고리명</th>
                <th data-field="enabled" data-width="10%" data-formatter="enabledFormatter" data-filter-control="select" scope="col">Enable</th>
                <th data-field="fieldName" data-filter-control="select" data-sortable="true" scope="col">Field Name</th>
                <th data-field="memo" data-filter-control="select" data-sortable="true" scope="col" data-visible="false">Memo</th>
                <th data-field="order" data-filter-control="select" data-sortable="true" scope="col" data-visible="false">Sort Order</th>
                <th data-field="edit" data-width="3%" data-formatter="editFormatter" data-events="editEvents">EDIT</th>
                <th data-field="delete" data-width="3%" data-formatter="deleteFormatter" data-events="deleteEvents">DEL.</th>
            </tr>
        </thead>
    </table>

    @include('admin.includes.categories.create')
    @include('admin.includes.categories.edit')
    @include('admin.includes.categories.show')
    @include('admin.includes.categories.delete')
    @include('admin.includes.categories.order')

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
        var url = "{!! route('admin.categories.index') !!}";
        var saveIndex; // Row index of the table
        var saveId; // Primary key of categories
        var maxOrder; // Max Order number
        var categories; // cached categories
        var displayOrder; // display order using changing order
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

        // 리스트 테이블의 초기화: Enabled 컬럼이 1이면 Enabled를 0이면 Disabled로 표시한다.
        function enabledFormatter(value, row, index) {
            if (value === 1) { return 'Enabled'; } else { return 'Disabled'; }
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
                columns: [ {},{},{},{ align: 'center' },{},{},{},{ align: 'center', clickToSelect: false }, { align: 'center', clickToSelect: false }]
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
                    maxOrder = data['max_order'];
                    categories = data['categories'];
                    $table.bootstrapTable( 'load', { data: categories } );
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error("can't get categories data from server: " + JSON.stringify(jqXHR), Failed);
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
            var txt = formId.find("input[name='txt']").val();
            var kor_txt = formId.find("input[name='kor_txt']").val();
            var enable = Number(formId.find("input[name='enable']:checked").val()); // 숫자 변화 꼭 해야 함
            var fieldName = formId.find("input[name='fieldName']").val();
            var memo = CKEDITOR.instances['ckeditor-create'].getData();
            var order = ++maxOrder;
            var postData = { txt:txt, kor_txt:kor_txt, order:order, enabled:enable, fieldName:fieldName, memo:memo };

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
            var txt = formId.find("input[name='txt']").val();
            var kor_txt = formId.find("input[name='kor_txt']").val();
            var enable = Number(formId.find("input[name='enable']:checked").val()); // 숫자변화 꼭 해야 함!!!
            var fieldName = formId.find("input[name='fieldName']").val();
            var memo = CKEDITOR.instances['ckeditor-edit'].getData();
            var order = formId.find("input[name='order']").val();
            var changed = { "txt": txt, "kor_txt": kor_txt, "enabled": enable, "fieldName":fieldName, "memo": memo, "order": order };

            $.ajax({
                dataType: 'json',
                method: 'PUT',
                url: form_action,
                data: changed,
                success: function(data) {
                    if (data.errors) {
                        var message = '';
                        for (i=0; i < data.errors.length; i++) {
                            message += data.errors[i] + (i < data.errors.length -1 ? ' | ' : '');
                        } 
                        toastr.error(message, data.message);
                    } else {
                        toastr.success(data.message, 'Success');
                        $table.bootstrapTable('updateRow', {index: saveIndex, row: changed});
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

        // display order를 바꿀 때마다 발생한다. (drar & drop)
        $(function() {
            $('#workTbody').sortable({
               update: function(event, ui) {
                  displayOrder = $(this).sortable('toArray');
               }
            });
         });

        // Save button was pressed after changing display order.
        $(".make-order").click(function(e){
            if (displayOrder) { // 한번이라도 순서를 바꿨으면?
                var deferreds = [];
                displayOrder.shift(); // sortable method로 리턴 받은 데이터의 배열 첫 항목이 비어있다.

                // Async Ajax loop: https://stackoverflow.com/questions/18424712/how-to-loop-through-ajax-requests-inside-a-jquery-when-then-statment/18425082
                $.each(displayOrder, function(index, dOrder){
                    if (index !== dOrder - 1) {
                        var category = categories[dOrder-1];
                        category['order'] = index;
                        deferreds.push(
                            $.ajax({
                                dataType: 'json',
                                method: 'PUT',
                                url: url + '/' +  category['id'],
                                data: category,
                            })
                        );
                    }
                });

                $.when.apply($, deferreds).then(function(){
                    toastr.success('Display order was successfully re-arranged.', 'Success');
                    $(".modal").modal('hide'); // hide model form
                    reloadList();
                    displayOrder = '';
                }).fail(function(){
                    toastr.error('Error occured! Please Save again.', 'Failed');
                });
            }
        });

        // 테이블의 Column을 클릭하면 발생하는 이벤트를 핸들한다.
        $table.on('click-cell.bs.table', function (field, column, row, rec) {
            saveId = Number(rec.id);
            if (column === 'edit') {
                var form = $("#edit-item");
                form.find("input[name='txt']").val(rec.txt);
                form.find("input[name='kor_txt']").val(rec.kor_txt);
                form.find("input[name='fieldName']").val(rec.fieldName);
                form.find("input[name='enable'][value='" + rec.enabled + "']").prop('checked', true);
                CKEDITOR.instances['ckeditor-edit'].setData(rec.memo);
                form.find("input[name='order']").val(rec.order);
                form.find("#editForm").attr("action", url + '/' + rec.id);
            } else if (column === 'delete') {
                var deleteId = $("#deleteBody");
                deleteId.find("label[name='txt']").text(rec.txt);
                deleteId.find("label[name='kor_txt']").text(rec.kor_txt);
                deleteId.find("label[name='fieldName']").text(rec.fieldName);
                deleteId.find("label[name='memo']").html(rec.memo);
                deleteId.find("label[name='enable']").text( rec.enabled === 1 ? "Enabled" : "Disabled" );
                // Open Bootstrap Model without Button Click
                $("#delete-item").modal('show');
            } else {
                var showId = $("#showBody");
                showId.find("label[name='txt']").text(rec.txt);
                showId.find("label[name='kor_txt']").text(rec.kor_txt);
                showId.find("label[name='fieldName']").text(rec.fieldName);
                showId.find("label[name='memo']").html(rec.memo);
                showId.find("label[name='enable']").text( rec.enabled === 1 ? "Enabled" : "Disabled" );
                // Open Bootstrap Model without Button Click
                $("#show-item").modal('show');
            }
        });

        // 테이블의 Row를 클릭하면 발생하는 이벤트를 핸들한다: Bootstrap Table에서 Index를 구하기 위한 유일한 방법(Maybe)
        $table.on('click-row.bs.table', function (e, row, $element) {
            saveIndex = $element.index();
        });
    </script>

    {{-- to implement make display order --}}
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        // give #workTable drag-and-drop feature
        $('#workTable').find('tbody').sortable();
        function showOrder() {
            $('#workTbody').load("{!! route('admin.categories.getCategories') !!}", function() {
                displayOrder = '';
                $('#make-order').modal({show:true});
            });
        }
        
    </script>
    @endsection