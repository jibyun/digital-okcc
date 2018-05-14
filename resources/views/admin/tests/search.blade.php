@extends('admin.layouts.master')

@section('styles')
    <style>
        .fixed-table-toolbar .bs-bars,
        .fixed-table-toolbar .search,
        .fixed-table-toolbar .columns {
            position: relative;
            margin-top: 10px;
            margin-bottom: 10px;
            line-height: 34px;
        }
        .fixed-table-toolbar .columns {
            width: 55px;
        }
        .fixed-table-toolbar .search {
            width: 200px;
        }
        .fixed-table-toolbar .bs-bars {
            min-width: 0;
            width: calc(100% - 265px);
            text-align: left;
        }
    </style>
@endsection

@section('content')
<div class='container p-4'>
    <h4>{{ __('messages.adm_title.title', ['title' => 'Dynamic Search']) }}</h4>
    <div id="toolbar">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary">Left</button>
            <button type="button" class="btn btn-secondary">Middle</button>
            <button type="button" class="btn btn-secondary">Right</button>
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
                <th data-field="id">{{ __('messages.adm_table.id') }}</th>
                <th data-field="txt">{{ __('messages.adm_table.category_name') }}</th>
                <th data-field="kor_txt">{{ __('messages.adm_table.category_kname') }}</th>
                <th data-field="enabled">{{ __('messages.adm_table.enable') }}</th>
                <th data-field="fieldName">{{ __('messages.adm_table.field_name') }}</th>
                <th data-field="memo">{{ __('messages.adm_table.memo') }}</th>
                <th data-field="order">{{ __('messages.adm_table.order') }}</th>
                <th data-field="edit">{{ __('messages.adm_table.edit_btn') }}</th>
                <th data-field="delete">{{ __('messages.adm_table.del_btn') }}</th>
            </tr>
        </thead>
    </table>

    @include('admin.members.includes.categories.create')
    @include('admin.members.includes.categories.edit')
    @include('admin.members.includes.categories.show')
    @include('admin.members.includes.categories.delete')
    @include('admin.members.includes.categories.order')

</div>
{{-- End Container --}}
@endsection

@section('scripts')
    <script type="text/javascript">
        var url = "{!! route('admin.categories.index') !!}";
        var saveIndex; // Row index of the table
        var saveId; // Primary key of categories
        var maxOrder; // Max Order number
        var categories; // cached categories
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

        $table.bootstrapTable({
            height: getHeight(),
            columns: [ 
                    { field: 'id', visible: false, searchable: false },
                    { field: 'txt', visible: true, searchable: true },
                    { field: 'kor_txt', visible: true, searchable: true },
                    { field: 'enabled', visible: false, searchable: false },
                    { field: 'fieldName', visible: true, searchable: true },
                    { field: 'memo', visible: true, searchable: true },
                    { field: 'order', visible: false, searchable: false },
                    { field: 'edit', visible: true, searchable: true, formatter: "editFormatter", events: "editEvents"}, 
                    { field: 'delete', visible: true, searchable: true, formatter: "deleteFormatter", events: "deleteEvents" }
            ],
            onColumnSwitch: function ( field, checked) {

            },
        });
        // whenever being changed window's size, table's size should be also changed
        $(window).resize(function () {
            $table.bootstrapTable('resetView', {
                height: getHeight()
            });
        });











        // Dynamic Search Control for ONLY Visible Column --- 이 모듈만 추가하면 됨
        // 항상 검색에서 제외할 컬럼 또한 이곳에 지정하면 됨
        $table.on('column-switch.bs.table', function (e, field, checked) {
            var columns = $table.bootstrapTable('getVisibleColumns');
            $.each(columns, function(index, data) {
                data['searchable'] = true;
            });
            columns = $table.bootstrapTable('getHiddenColumns');
            $.each(columns, function(index, data) {
                data['searchable'] = false;
            });
            //------------------ ADJUST BY BUG ----------------------------------------------
            // 아래가 없어도 되야하며, 적어도 review를 해주면 되야하지만 안됨 그래서 편법으로 해당 컬럼을 한번 더 Toggle 해 줌
            if (checked === true) {
                $table.bootstrapTable('hideColumn', field);
                $table.bootstrapTable('showColumn', field);
            } else {
                $table.bootstrapTable('showColumn', field);
                $table.bootstrapTable('hideColumn', field);
            }
        });
        // End of Dynamic Search Control















        function createTable() {
            reloadList();
            $table.bootstrapTable('refresh');
        }

        // Reload data from server and refresh table
        function reloadList() {
            $.ajax({ dataType: 'json', timeout: 3000, url: url })
            .done ( function(data, textStatus, jqXHR) { 
                maxOrder = data['max_order'];
                categories = data['categories'];
                $table.bootstrapTable( 'load', { data: categories } );
            }) 
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        }  

        // Get list from server and show
        function getInitList() {
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
                kor_txt: formId.find("input[name='kor_txt']").val(), 
                order: ++maxOrder, 
                enabled: Number(formId.find("input[name='enable']:checked").val()), 
                fieldName: formId.find("input[name='fieldName']").val(), 
                memo: formId.find("textarea[name='memo']").val() 
            };

            $.ajax({ dataType: 'json', timeout: 3000, method:'POST', data: postData, url: form_action })
            .done ( function(data) {
                if (data.code == 'validation') {
                    validationMessage( data.errors );
                } else if (data.code == 'exception') {
                    exceptionMessage( data.status, data.errors );
                } else {
                    saveSuccessMessage();
                    $table.bootstrapTable("append", postData); // Add input data to table
                    $('#createForm')[0].reset(); // Clear create form 
                    $(".modal").modal('hide'); // hide model form
                    reloadList();
                }
            })
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        });

        // Edit 후 Submit 버튼을 눌렀다
        $(".crud-update").click(function(e){
            e.preventDefault();
            var formId = $("#edit-item");

            var postData = { 
                txt: formId.find("input[name='txt']").val(), 
                kor_txt: formId.find("input[name='kor_txt']").val(), 
                order: formId.find("input[name='order']").val(), 
                enabled: Number(formId.find("input[name='enable']:checked").val()), 
                fieldName: formId.find("input[name='fieldName']").val(), 
                memo: formId.find("textarea[name='memo']").val() 
            };

            $.ajax({ dataType: 'json', timeout: 3000, method:'PUT', data: postData, url: url + '/' + saveId })
            .done ( function(data) {
                if (data.code == 'validation') {
                    validationMessage( data.errors );
                } else if (data.code == 'exception') {
                    exceptionMessage( data.status, data.errors );
                } else {
                    saveSuccessMessage();
                    $table.bootstrapTable('updateRow', {index: saveIndex, row: postData});
                    $('#editForm')[0].reset(); // Clear create form 
                    $(".modal").modal('hide'); // hide model form
                    reloadList();
                }
            })
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        });

        // Delete 버튼을 눌렀다.
        $("body").on("click", ".crud-delete", function() {
            $.ajax({ dataType: 'json', timeout: 3000, method:'delete', url: url + '/' + saveId })
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
                    orderSuccessMessage();
                    $(".modal").modal('hide'); // hide model form
                    reloadList();
                    displayOrder = '';
                })
                .fail( function() {
                    orderErrorMessage();
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
                form.find("input[name='fieldName']").val(rec.fieldName);
                form.find("input[name='enable'][value='" + rec.enabled + "']").prop('checked', true);
                form.find("textarea[name='memo']").val(rec.memo);
                form.find("input[name='order']").val(rec.order);
                $("#edit-item").modal('show').draggable({ handle: ".modal-header" });
            } else if (column === 'delete') {
                // Open Bootstrap Model without Button Click
                $("#delete-item").modal('show').draggable({ handle: ".modal-header" });
            } else {
                var showId = $("#showBody");
                showId.find("span[name='txt']").text(rec.txt + '(' + rec.kor_txt + ')' );
                showId.find("span[name='fieldName']").text(rec.fieldName);
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
            $('#workTbody').load("{!! route('admin.categories.getCategories') !!}", function() {
                displayOrder = '';
                $('#make-order').modal({show:true}).draggable({ handle: ".modal-header" });
            });
        }

    </script>

    @endsection