@extends('admin.layouts.master')

@section('content')

<div class='container p-5'>
    <h4>Category List</h4>
    <div id="toolbar">
        <button class="btn btn-info mr-2" type="button" title="Create" data-toggle="modal" data-target="#create-item">
            <i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Create
        </button>
        {{-- TODO: 추후 Excel과 PDF Export 기능이 추가되면 disabled 를 삭제한다 --}}
        <button id="export" class="btn btn-default" type="button" title="Export Excel" disabled>
            <i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;&nbsp;Export Excel
        </button>
        <button id="export" class="btn btn-default" type="button" title="Export PDF" disabled>
            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;&nbsp;Export PDF
        </button>
    </div>

    @include('admin.includes.messages')

    <table id="table" class="table table-striped s1-font-size" data-side-pagination="client"
        data-search="true" data-pagination="true" data-page-size="10" data-page-list="[5, 10, 25, 50, 100, ALL]" 
        data-mobile-responsive="true" data-click-to-select="true" data-filter-control="true" data-toolbar="#toolbar"
        data-row-style="rowStyle">
        <thead>
            <tr>
                <th data-field="id" data-filter-control="select" data-sortable="true" scope="col" data-visible="false">Id</th>
                <th data-field="txt" data-filter-control="select" data-sortable="true" scope="col">Category Name</th>
                <th data-field="kor_txt" data-filter-control="select" data-sortable="true" scope="col">카테고리명</th>
                <th data-field="enabled" data-formatter="enabledFormatter" data-filter-control="select" scope="col">Enable</th>
                <th data-field="memo" data-filter-control="select" data-sortable="true" scope="col">Memo</th>
                <th data-field="order" data-filter-control="select" data-sortable="true" scope="col" data-visible="false">Sort Order</th>
                <th data-field="edit" data-formatter="editFormatter" data-events="editEvents">EDIT</th>
                <th data-field="delete" data-formatter="deleteFormatter" data-events="deleteEvents">DEL.</th>
            </tr>
        </thead>
    </table>

    @include('admin.includes.categories.category_create')
    @include('admin.includes.categories.category_edit')
    @include('admin.includes.categories.category_show')
    @include('admin.includes.categories.category_delete')

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
        var url = "{!! route('categories.index') !!}";
        var saveIndex; // Row index of the table
        var saveId; // Primary key of categories
        var maxOrder; // Max Order number

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

        // Refresh bootstrap table with given Json data
        function refreshTable(data) {
            $('#table').bootstrapTable({
                data: data,
                columns: [ {},{},{},{ align: 'center' },{}, {}, { align: 'center', clickToSelect: false }, { align: 'center', clickToSelect: false }]
            });
        }
        
        // Get list from server
        function getList() {
            $.ajax({
                dataType: 'json',
                url: url,
                success: function(data) { // What to do if we succeed
                    maxOrder = data['max_order'];
                    refreshTable(data['categories']);
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        }  
        
        // 이 페이지가 처음 로드될 때 데이터를 읽어 표시한다.
        getList();

        // Create 후 Submit 버튼을 눌렀다
        $(".crud-submit").click(function(e){
            e.preventDefault();
            var formId = $("#create-item");
            var form_action = formId.find("form").attr("action");
            var txt = formId.find("input[name='txt']").val();
            var kor_txt = formId.find("input[name='kor_txt']").val();
            var enable = Number(formId.find("input[name='enable']:checked").val()); // 숫자 변화 꼭 해야 함
            var memo = CKEDITOR.instances['ckeditor-create'].getData();
            var order = ++maxOrder;

            $.ajax({
                dataType: 'json',
                method:'POST',
                url: form_action,
                data:{txt:txt, kor_txt:kor_txt, order:order, enabled:enable, memo:memo},
                success: function(response) {
                    $('#table').bootstrapTable("append", response); // Add input data to table
                    $('#createForm')[0].reset(); // Clear create form 
                    CKEDITOR.instances['ckeditor-create'].setData('');
                    $(".modal").modal('hide'); // hide model form
                    getList();
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
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
            var memo = CKEDITOR.instances['ckeditor-edit'].getData();
            var order = formId.find("input[name='order']").val();
            var changed = { "txt": txt, "kor_txt": kor_txt, "enabled": enable, "memo": memo, "order": order };
            $('#table').bootstrapTable('updateRow', {index: saveIndex, row: changed});
  
            $.ajax({
                dataType: 'json',
                method: 'PUT',
                url: form_action,
                data: changed,
                success: function(response) {
                    $('#editForm')[0].reset(); // Clear create form 
                    CKEDITOR.instances['ckeditor-edit'].setData('');
                    $(".modal").modal('hide'); // hide model form
                    getList();
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        });

        // Delete 버튼을 눌렀다.
        $("body").on("click", ".crud-delete", function() {
            $.ajax({
                dataType: 'json',
                type:'delete',
                url: url + '/' + saveId,
                success: function(response) {
                    $('#table').bootstrapTable('remove', {field: 'id', values: [saveId]});
                    $(".modal").modal('hide'); // hide model form
                    getList();
                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        });

        // 테이블의 Column을 클릭하면 발생하는 이벤트를 핸들한다.
        $('#table').on('click-cell.bs.table', function (field, column, row, rec) {
            saveId = Number(rec.id);
            if (column === 'edit') {
                var form = $("#edit-item");
                form.find("input[name='txt']").val(rec.txt);
                form.find("input[name='kor_txt']").val(rec.kor_txt);

                form.find("input[name='enable'][value='" + rec.enabled + "']").prop('checked', true);
                CKEDITOR.instances['ckeditor-edit'].setData(rec.memo);
                form.find("input[name='order']").val(rec.order);
                form.find("#editForm").attr("action", url + '/' + rec.id);
            } else if (column === 'delete') {
                var deleteId = $("#deleteBody");
                deleteId.find("label[name='txt']").text(rec.txt);
                deleteId.find("label[name='kor_txt']").text(rec.kor_txt);
                deleteId.find("label[name='memo']").html(rec.memo);
                deleteId.find("label[name='enable']").text( rec.enabled === 1 ? "Enabled" : "Disabled" );
                // Open Bootstrap Model without Button Click
                $("#delete-item").modal('show');
            } else {
                var showId = $("#showBody");
                showId.find("label[name='txt']").text(rec.txt);
                showId.find("label[name='kor_txt']").text(rec.kor_txt);
                showId.find("label[name='memo']").html(rec.memo);
                showId.find("label[name='enable']").text( rec.enabled === 1 ? "Enabled" : "Disabled" );
                // Open Bootstrap Model without Button Click
                $("#show-item").modal('show');
            }
        });

        // 테이블의 Row를 클릭하면 발생하는 이벤트를 핸들한다: Bootstrap Table에서 Index를 구하기 위한 유일한 방법(Maybe)
        $('#table').on('click-row.bs.table', function (e, row, $element) {
            saveIndex = $element.index();
        });
    </script>

@endsection