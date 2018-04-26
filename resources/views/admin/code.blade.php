@extends('admin.layouts.master')

@section('content')

<div class='container p-4'>
    <h4>{{ __('messages.adm_title.title', ['title' => 'Code']) }}</h4>
    
    <div id="toolbar">
        <div class='form-inline'>
            <select id='categoriesCombo' class="form-group form-control mr-2" style="width: 150px">
            </select>
            <button class="form-group form-control btn btn-info mr-2" type="button" title="Create" id='create-button'>
                <i class="fa fa-user mr-1" aria-hidden="true"></i>{{ __('messages.adm_button.create') }}
            </button>
            <button class="form-group btn btn-warning btn-modal-target mr-2" type="button" title="Make Display Order" onclick="showOrder();">
                <i class="fa fa-sort-amount-asc mr-1" aria-hidden="true"></i>{{ __('messages.adm_button.order') }}
            </button>  
            @include('admin.includes.export', [ 'router' => 'admin.export.codes' ])                  
        </div>
    </div>

    <table  id="table" class="table table-striped table-bordered" 
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
                <th data-field="sysmetic" data-visible="false" data-searchable="false">{{ __('messages.adm_table.sysmetic') }}</th>
                <th data-field="txt" data-width="20%" data-sortable="true">{{ __('messages.adm_table.code_name') }}</th>
                <th data-field="kor_txt" data-width="20%" data-sortable="true">{{ __('messages.adm_table.code_kname') }}</th>
                <th data-field="enabled" data-width="7%" data-formatter="enabledFormatter" data-searchable="false">{{ __('messages.adm_table.enable') }}</th>
                <th data-field="memo" data-sortable="true">{{ __('messages.adm_table.memo') }}</th>
                <th data-field="order" data-sortable="true" data-visible="false" data-searchable="false">{{ __('messages.adm_table.order') }}</th>
                <th data-field="edit" data-width="3%" data-formatter="editFormatter" data-searchable="false" data-events="editEvents">{{ __('messages.adm_table.edit_btn') }}</th>
                <th data-field="delete" data-width="3%" data-formatter="deleteFormatter" data-searchable="false" data-events="deleteEvents">{{ __('messages.adm_table.del_btn') }}</th>
            </tr>
        </thead>
    </table>

    @include('admin.includes.codes.create')
    @include('admin.includes.codes.edit')
    @include('admin.includes.codes.show')
    @include('admin.includes.codes.delete')
    @include('admin.includes.codes.order')

</div>
{{-- End Container --}}
@endsection

@section('scripts')

    <script type="text/javascript">
        var url = "{!! route('admin.codes.index') !!}";
        var saveIndex; // Row index of the table
        var saveId; // Primary key of codes
        var maxOrder; // Max Order number
        var maxId; // Max Id: it must be need when create a code
        var currentCategoryId; // current id selected in categories combo box
        var codes; // cached codes
        var displayOrder; // display order using changing order
        var $table = $('#table');

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        // Row Style
        function rowStyle(row, index) {
            return { css: { "padding": "0px 10px" } };
        }

        // 리스트 테이블의 초기화: Enabled 컬럼이 1이면 Enabled를 0이면 Disabled로 표시한다.
        function enabledFormatter(value, row, index) {
            if (value === 1) { return 'Enabled'; } else { return 'Disabled'; }
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

        // compute height of the table and return 
        function getHeight() {
            $(window).height() - $('h4').outerHeight(true); // table height
        }

        function initTable() {
            $table.bootstrapTable({
                height: getHeight(),
                columns: [ {},{},{ align: 'left' },{ align: 'left' },{ align: 'center' },{ align: 'left' }, {}, { align: 'center', clickToSelect: false }, { align: 'center', clickToSelect: false }]
            });
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
                url: url + '?category_id=' + currentCategoryId,
                success: function(data) { // What to do if we succeed
                    if (data['codes'].length > 0) {
                        if (data['max_order'].length != 0) { maxOrder = ++data['max_order']; } else { maxOrder = 1; }
                        maxId = ++data['max_id'];
                        codes = data['codes'];
                        $table.bootstrapTable( 'load', { data: codes } );
                    } else {
                        maxOrder = 1;
                        maxId = currentCategoryId * 10000 + 1;
                        codes = '';
                        $table.bootstrapTable( 'removeAll' );
                    } 
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error( 'Fail to get data from server: ' + JSON.stringify(jqXHR), 'Failed!' );
                }
            });
        } 

        function buildCategoriesCombo(categories) {
            var html = '';
            var $combo = $("#categoriesCombo");
            for (var i=0; i < categories.length; i++) {
                html += '<option value="' + categories[i]['id'] + '" ' + (i===0 ? 'selected' : '') + '>' + 
                    categories[i]['txt'] + '</option>';
            }
            $combo.append(html);    
            
            // whenever change category combo 
            $combo.change( function () {
                $("select option:selected").each( function() {
                    currentCategoryId = $(this).val();
                    reloadList();
                });
            }).click( function() {
                // make the combo only one selection is possible
                if ($('select option').length == 1) {
                    $('select').change();
                }
            });      
        }

        // Get list from server and show
        function getInitList() {
            initTable();
            // get categories table to ID="categoriesCombo"
            $.ajax({
                dataType: 'json',
                url: "{!! route('admin.categories.index') !!}",
                success: function(data) { // What to do if we succeed
                    var categories = data['categories'];
                    currentCategoryId = categories[0]['id'];
                    buildCategoriesCombo(categories);
                    reloadList();
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error( 'Fail to get data from server: ' + JSON.stringify(jqXHR), 'Failed!' );
                }
            });
        }  

        // 이 페이지가 처음 로드될 때 데이터를 읽어 표시한다.
        getInitList();

        // Create 후 Submit 버튼을 눌렀다
        $(".crud-submit").click(function(e){
            e.preventDefault();
            var formId = $("#create-item");
            var form_action = formId.find("form").attr("action");

            var postData = { 
                id: maxId, 
                code_category_id: currentCategoryId, 
                txt: formId.find("input[name='txt']").val(), 
                kor_txt: formId.find("input[name='kor_txt']").val(), 
                order: maxOrder, 
                enabled: Number(formId.find("input[name='enable']:checked").val()), // 숫자 변화 꼭 해야 함 
                memo: formId.find("textarea[name='memo']").val(), 
                sysmetic: 0 
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

        // Edit 후 Submit 버튼을 눌렀다
        $(".crud-update").click(function(e){
            e.preventDefault();
            var formId = $("#edit-item");
            var form_action = formId.find("form").attr("action");

            var postData = { 
                code_category_id: currentCategoryId, 
                txt: formId.find("input[name='txt']").val(), 
                kor_txt: formId.find("input[name='kor_txt']").val(), 
                order: formId.find("input[name='order']").val(), 
                enabled: Number(formId.find("input[name='enable']:checked").val()), // 숫자 변화 꼭 해야 함 
                memo: formId.find("textarea[name='memo']").val(), 
                sysmetic: 0
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
                $.each(displayOrder, function(index, dOrder) {
                    if (index !== dOrder - 1) {
                        var code = codes[dOrder-1];
                        code['order'] = index;
                        deferreds.push(
                            $.ajax({
                                dataType: 'json',
                                method: 'PUT',
                                url: url + '/' +  code['id'],
                                data: code,
                            })
                        );
                    }
                });
                $.when.apply($, deferreds).then( function() {
                    toastr.success('Display order was successfully re-arranged.', 'Success');
                    $(".modal").modal('hide'); // hide model form
                    reloadList();
                    displayOrder = '';
                }).fail(function(){
                    toastr.error( 'Fail to save data to server!', 'Failed!' );
                });
            }
        });

        $('#create-button').click( function(e) {
            $("#create-item").modal('show').draggable({ handle: ".modal-header" });
        });

        // 테이블의 Column을 클릭하면 발생하는 이벤트를 핸들한다.
        $table.on('click-cell.bs.table', function (field, column, row, rec) {
            saveId = Number(rec.id);
            if (column === 'edit') {
                var form = $("#edit-item");
                form.find("input[name='txt']").val(rec.txt);
                form.find("input[name='kor_txt']").val(rec.kor_txt);
                form.find("input[name='enable'][value='" + rec.enabled + "']").prop('checked', true);
                form.find("textarea[name='memo']").val(rec.memo);
                form.find("input[name='order']").val(rec.order);
                form.find("#editForm").attr("action", url + '/' + rec.id);
                $("#edit-item").modal('show').draggable({ handle: ".modal-header" });
            } else if (column === 'delete') {
                var showId = $("#deleteBody");
                showId.find("span[name='txt']").text(rec.txt + '(' + rec.kor_txt + ')' );
                showId.find("span[name='category_name']").text( $('#categoriesCombo').find('option:selected').text() + '(' + $('#categoriesCombo').find('option:selected').val() + ')' );
                showId.find("span[name='memo']").html(rec.memo);
                showId.find("span[name='enable']").text( rec.enabled === 1 ? "Enabled" : "Disabled" );
                // Open Bootstrap Model without Button Click
                $("#delete-item").modal('show').draggable({ handle: ".modal-header" });
            } else {
                var showId = $("#showBody");
                showId.find("span[name='txt']").text(rec.txt + '(' + rec.kor_txt + ')' );
                showId.find("span[name='category_name']").text( $('#categoriesCombo').find('option:selected').text() + '(' + $('#categoriesCombo').find('option:selected').val() + ')' );
                showId.find("span[name='memo']").html(rec.memo);
                showId.find("span[name='enable']").text( rec.enabled === 1 ? "Enabled" : "Disabled" );
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
    <script type="text/javascript">
        // give #workTable drag-and-drop feature
        $('#workTable').find('tbody').sortable();
        function showOrder() {
            $('#workTbody').load("{!! route('admin.code.getCodes') !!}", function() {
                displayOrder = '';
                $('#make-order').modal({show:true}).draggable({ handle: ".modal-header" });
            });
        }
    </script>

    @endsection