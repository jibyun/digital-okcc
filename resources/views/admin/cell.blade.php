@extends('admin.layouts.master')

@section('content')

<div class='container p-4'>
    <h4>{{ __('messages.adm_title.cell_organizer') }}</h4>
    <div class="pt-2">
        <nav aria-label="Page navigation">
            <ul id="cell_menu" class="pagination pagination-sm">

            </ul>
        </nav>
    </div>

    <table  id="table" class="table table-striped table-bordered" 
            data-side-pagination="client"
            data-pagination="true" 
            data-page-list="[5, 10, 25, 50, 100, ALL]" 
            data-mobile-responsive="true" 
            data-click-to-select="true" 
            data-filter-control="true" 
            data-row-style="rowStyle">
        <thead>
            <tr>
                <th data-field="id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.id') }}</th>
                <th data-field="first_name" data-filter-control="select" data-sortable="true" scope="col">{{ __('messages.adm_table.first_name') }}</th>
                <th data-field="middle_name" data-filter-control="select" data-sortable="true" scope="col" data-visible="false">{{ __('messages.adm_table.middle_name') }}</th>
                <th data-field="last_name" data-filter-control="select" data-sortable="true" scope="col">{{ __('messages.adm_table.last_name') }}</th>
                <th data-field="kor_name" data-filter-control="select" data-sortable="true" scope="col">{{ __('messages.adm_table.kor_name') }}</th>
                <th data-field="dob" data-filter-control="select" data-sortable="true" scope="col">{{ __('messages.adm_table.dob') }}</th>
                <th data-field="gender" data-width="60px" data-filter-control="select" data-sortable="false" scope="col">{{ __('messages.adm_table.gender') }}</th>
                <th data-field="email" data-filter-control="select" data-sortable="false" scope="col">{{ __('messages.adm_table.email') }}</th>
                <th data-field="tel_home" data-filter-control="select" data-sortable="false" scope="col">{{ __('messages.adm_table.tel_home') }}</th>
                <th data-field="tel_cell" data-filter-control="select" data-sortable="false" scope="col">{{ __('messages.adm_table.tel_cell') }}</th>
                <th data-field="tel_office" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.tel_office') }}</th>
                <th data-field="address" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.address') }}</th>
                <th data-field="postal_code" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.postal') }}</th>
                <th data-field="register_at" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.register_at') }}</th>
                <th data-field="baptism_at" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.baptism_at') }}</th>
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
    {{-- for Toast --}}
    <script type="text/javascript">
        toastr.options.progressBar = true;
        toastr.options.timeOut = 5000; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it
    </script>
    <script type="text/javascript">
        const CELL_CATEGORY = 10;
        const CODE_URL = "{!! route('admin.code.getCodesByCategoryIds') !!}";




  
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

        // compute height of the table and return 
        function getHeight() {
            $(window).height() - $('h4').outerHeight(true); // table height
        }

        function initTable() {
            $table.bootstrapTable({
                height: getHeight(),
                columns: [ { align: 'center' },{ align: 'left' },{ align: 'left' },{ align: 'left' },{ align: 'center' },{ align: 'center' }, // last: dob
                    { align: 'center' },{ align: 'left' },{ align: 'left' },{ align: 'left' },{ align: 'left' },{ align: 'left' }, // last: address
                    { align: 'center' },{ align: 'center' },{ align: 'center' } ]
            });
            // whenever being changed window's size, table's size should be also changed
            $(window).resize(function () {
                $table.bootstrapTable('resetView', {
                    height: getHeight()
                });
            });
        }

        // Reload data from server and refresh table
        function reloadList($department_id) {
            $url = ( $department_id === 999999 ? "{!! route('admin.member-dept-trees.getmembers-notassigned') !!}" : "{!! route('admin.member-dept-trees.getmembers-department') !!}" + '?department_id=' + $department_id );
            $.ajax({ dataType: 'json', url: $url,
                success: function(data) { // What to do if we succeed
                    $table.bootstrapTable( 'load', { data: data['members'] } );
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error( 'Fail to get data from server: ' + JSON.stringify(jqXHR), 'Failed!' );
                }
            });
        } 

        function createSelection( codeData ) {
            initTable();
            $('#cell_menu').empty();
            var html = '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Select Cell</a></li>';
            $.each(codeData, function( index, codes ) {
                html += '<li class="page-item" value=' + codes['id'] + '><a class="page-link" href="#">' + (index + 1) + '</a></li>';
            });
            html += '<li class="page-item" value=999999><a class="page-link" href="#">Not Assigned</a></li>';
            $('#cell_menu').prepend(html);

            $('#cell_menu li').click( function(e) {
                e.preventDefault();
                $(this).addClass('active').siblings().removeClass('active');
                reloadList($(this).val());
            });

            $('#cell_menu li:nth-child(2)').click();
        }

        $.ajax({ dataType: 'JSON', url: CODE_URL + '?category_id[]=' + CELL_CATEGORY,
            success: function(data) { 
                createSelection( data['codes'][0] );
            }, 
            fail: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                toastr.error("Fail to get data from server: " + JSON.stringify(jqXHR), 'Failed');
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
                var showId = $("#deleteBody");
                showId.find("span[name='txt']").text(rec.txt + '(' + rec.kor_txt + ')' );
                showId.find("span[name='fieldName']").text(rec.fieldName);
                showId.find("span[name='memo']").html(rec.memo);
                showId.find("span[name='enable']").text( rec.enabled === 1 ? "Enabled" : "Disabled" );
                // Open Bootstrap Model without Button Click
                $("#delete-item").modal('show');
            } else {
                var showId = $("#showBody");
                showId.find("span[name='txt']").text(rec.txt + '(' + rec.kor_txt + ')' );
                showId.find("span[name='fieldName']").text(rec.fieldName);
                showId.find("span[name='memo']").html(rec.memo);
                showId.find("span[name='enable']").text( rec.enabled === 1 ? "Enabled" : "Disabled" );
                // Open Bootstrap Model without Button Click
                $("#show-item").modal('show');
            }
        });

        // 테이블의 Row를 클릭하면 발생하는 이벤트를 핸들한다: Bootstrap Table에서 Index를 구하기 위한 유일한 방법(Maybe)
        $table.on('click-row.bs.table', function (e, row, $element) {
            saveIndex = $element.index();
        });
    </script>

    </script>
    {{-- export EXCEL, PDF, PNG, JSON --}}
    <script src="{{ asset('js/export.js') }}"></script>
@endsection