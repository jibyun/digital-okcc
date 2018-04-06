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
        data-search="true" data-pagination="true" data-page-size="15" data-page-list="[5, 15, 30, 50]" 
        data-mobile-responsive="true" data-click-to-select="true" data-filter-control="true" data-toolbar="#toolbar">
        <thead>
            <tr>
                <th data-field="txt" data-filter-control="select" data-sortable="true" scope="col">Category Name</th>
                <th data-field="kor_txt" data-filter-control="select" data-sortable="true" scope="col">카테고리명</th>
                <th data-field="enabled" data-filter-control="select" scope="col">Enable</th>
                <th data-field="memo" data-filter-control="select" data-sortable="true" scope="col">Memo</th>
                <th data-field="order" data-filter-control="select" data-sortable="true" scope="col">Sort Order</th>
                <th data-field="edit" data-formatter="editFormatter" data-events="editEvents">EDIT</th>
                <th data-field="delete" data-formatter="deleteFormatter" data-events="deleteEvents">DEL.</th>
            </tr>
        </thead>
    </table>

    @include('admin.includes.category_create')
    @include('admin.includes.category_edit')

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
        var saveIndex;

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        function editFormatter(value, row, index) {
            return [
                '<button class="btn btn-primary btn-sm" type="button" title="Edit" data-toggle="modal" data-target="#edit-item">' +
                            '<i class="fa fa-cog" aria-hidden="true"></i></button>'
            ].join('');
        }

        function deleteFormatter(value, row, index) {
            return [
                '<button class="btn btn-danger btn-sm" type="button" title="Delete" >' +
                            '<i class="fa fa-trash-o" aria-hidden="true"></i></button>'
            ].join('');
        }

        // Refresh bootstrap table with given Json data
        function refreshTable(data) {
            $('#table').bootstrapTable({
                data: data,
                columns: [ {},{},{ align: 'center' },{},{ align: 'center' }, { align: 'center', clickToSelect: false }, { align: 'center', clickToSelect: false }]
            });
        }
        
        // Get list from server
        function getList(url) {
            $.ajax({
                dataType: 'json',
                url: url,
                success: function(response) { // What to do if we succeed
                    refreshTable(response);
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        }  
        
        // 이 페이지가 처음 로드될 때 데이터를 읽어 표시한다.
        getList(url);

        // Create 후 Submit 버튼을 눌렀다
        $(".crud-submit").click(function(e){
            e.preventDefault();
            var formId = $("#create-item");
            var form_action = formId.find("form").attr("action");
            var txt = formId.find("input[name='txt']").val();
            var kor_txt = formId.find("input[name='kor_txt']").val();
            var enabled = formId.find("input[name='enable']:checked").val();
            var memo = CKEDITOR.instances['ckeditor-create'].getData();
            var order = formId.find("input[name='order']").val();

            $.ajax({
                dataType: 'json',
                method:'POST',
                url: form_action,
                data:{txt:txt, kor_txt:kor_txt, order:order, enabled:enabled, memo:memo},
                success: function(response) {
                    $('#table').bootstrapTable("append", response); // Add input data to table
                    $('#createForm')[0].reset(); // Clear create form 
                    CKEDITOR.instances['ckeditor-create'].setData('');
                    $(".modal").modal('hide'); // hide model form
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
            var enabled = formId.find("input[name='enable']:checked").val();
            var memo = CKEDITOR.instances['ckeditor-edit'].getData();
            var order = formId.find("input[name='order']").val();
            var changed = { "txt": txt, "kor_txt": kor_txt, "enabled": enabled, "memo": memo, "order": order };
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
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        });

        $('#table').on('click-cell.bs.table', function (field, column, row, rec) {
            if (column === 'edit') {
                var form = $("#edit-item");
                form.find("input[name='txt']").val(rec.txt);
                form.find("input[name='kor_txt']").val(rec.kor_txt);
                form.find("input[id='#enable" + rec.enabled + "']").checked = true;
                CKEDITOR.instances['ckeditor-edit'].setData(rec.memo);
                form.find("input[name='order']").val(rec.order);
                form.find("#editForm").attr("action", url + '/' + rec.id);
            } else if (column === 'delete') {
                alert("click delete column: " + rec.id);
            } else {
                alert('row: ');
            }
        });

        $('#table').on('click-row.bs.table', function (e, row, $element) {
            saveIndex = $element.index();
        });
    </script>

@endsection