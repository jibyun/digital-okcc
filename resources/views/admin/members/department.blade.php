@extends('admin.layouts.master')

@section('styles')
    {{-- IMPORTANT: OVERRIDE of selected row in Bootstrap table --}}
    <style>
        #leftTable .selected td, #rightTable .selected td {
            background-color: #031023 !important;
            color: cornsilk;
        }
        .pagination-info, .pagination-detail {
            display: none
        }
        .dropdown-toggle::after {
            display:none
        }
    </style>
@endsection

@section('content')

<div class='container p-4'>
    <h4>{{ __('messages.adm_title.dept_organizer') }}</h4>

    <div class="row">
        <div class="col-sm-5">
            <div id="leftToolbar">
                <div class='form-inline'>
                    <label class="form-control" style="background-color: #3366ff; color: #ffffff;">{{ __('messages.adm_table.allmember_label') }}</label>
                </div>
            </div>
            <table id="leftTable" class="table table-striped table-hover table-responsive-md table-bordered" 
                    data-toolbar="#leftToolbar"
                    data-side-pagination="client"
                    data-search="true" 
                    data-search-on-enter-key="true"
                    data-pagination="true" 
                    data-click-to-select="true" 
                    data-row-style="leftRowStyle"
                    >
                <thead>
                    <tr>
                        <th data-field="state" data-checkbox="true" class='p-1'></th>
                        <th data-field="id" data-visible="false" data-searchable="false">@lang('messages.adm_table.id')</th>
                        <th data-field="first_name" data-sortable="true">@lang('messages.adm_table.first_name')</th>
                        <th data-field="last_name" data-sortable="true">@lang('messages.adm_table.last_name')</th>
                        <th data-field="kor_name" data-sortable="true">@lang('messages.adm_table.kor_name')</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col-sm-2 py-5 px-4" style="height: 400px;">
            <div class="row dropdown">
                <button type="button" class="btn btn-warning mt-5 form-control dropdown-toggle" title="To the Right" id="toRightMemberDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('messages.adm_table.member_btn')<i class="fa fa-arrow-right ml-2"></i></button>
                <div id="toRightMember" class="dropdown-menu" aria-labelledby="toRightMemberDropdown">

                </div>
            </div>
            <div class="row dropdown">
                <button type="button" class="btn btn-success mt-2 form-control dropdown-toggle" title="To the Right" id="toRightManagerDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('messages.adm_table.manager_btn')<i class="fa fa-arrow-right ml-2"></i></button>
                <div id="toRightManager" class="dropdown-menu" aria-labelledby="toRightManagerDropdown">

                </div>
            </div>
            <div class="row">
                <button type="button" class="toLeft btn btn-info mt-5 form-control" title="To the Left"><i class="fa fa-arrow-left mr-2"></i>@lang('messages.adm_table.leave_btn')</button>
            </div>
        </div>
        <div class="col-sm-5">
            <div id="rightToolbar" class="row py-2">
                <div class='form-inline col-sm-6'>
                    <select id='rightCombo' class="form-group form-control" style="width: 250px">
                    </select>
                </div>
                <div class='form-inline col-sm-6 justify-content-end'>
                    <label class="form-control" style="background-color:#039023; color: #ffffff;">@lang('messages.adm_table.assigned_label')</label>
                </div>
            </div>
            <table id="rightTable" class="table table-striped table-hover table-responsive-md table-bordered" 
                    data-side-pagination="client"
                    data-click-to-select="true" 
                    data-pagination="true" 
                    data-row-style="rightRowStyle"
                    >
                <thead>
                    <tr>
                        <th data-field="state" data-checkbox="true" class='p-1'></th>
                        <th data-field="id" data-visible="false" data-searchable="false">@lang('messages.adm_table.id')</th>
                        <th data-field="first_name" data-sortable="true">@lang('messages.adm_table.first_name')</th>
                        <th data-field="last_name" data-sortable="true">@lang('messages.adm_table.last_name')</th>
                        <th data-field="kor_name" data-sortable="true">@lang('messages.adm_table.kor_name')</th>
                        <th data-field="xid" data-visible="false" data-searchable="false"></th>
                        <th data-field="manager" data-visible="false" data-searchable="false"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

</div>
{{-- End Container --}}
@endsection

@section('scripts')
    <script type="text/javascript">
        const DEPT_CATEGORY_ID = '{{ config('app.admin.deptCategoryId') }}';
        const POSITION_CATEGORY_ID = '{{ config('app.admin.positionCategoryId') }}';
        const NOT_ASSIGN = 999999;
        const MANAGER_POSITION_IDs = '{{ config('app.admin.deptManagerPositionId') }}'; 
        const DEFAULT_POSITION_IDs = '{{ config('app.admin.deptMemberPositionId') }}';
        const CODE_URL = "{!! route('admin.code.getCodesByCategoryIds') !!}";
        const $leftTable = $('#leftTable');
        const $rightTable = $('#rightTable');
        var saveDepartmentId;

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        // Row Style
        function leftRowStyle(row, index) {
            return {css: { "padding": "0px 10px" }};
        }
        function rightRowStyle(row, index) {
            var rowData = {
                css: { "padding": "0px 10px", "background-color": ( row.manager == 1 ? "#ffff50" : "" ) }
            }
            return rowData;
        }
        
        // compute height of the table and return 
        function getHeight() {
            $(window).height() - $('h4').outerHeight(true); // table height
        }

        // Initialize bootstrap table
        $leftTable.bootstrapTable({
            height: getHeight(),
            columns: [ {},{},{ align: 'left' },{ align: 'left' },{ align: 'center' }]
        });
        $rightTable.bootstrapTable({
            height: getHeight(),
            columns: [ {},{},{ align: 'left' },{ align: 'left' },{ align: 'center' },{}]
        });
        $(window).resize(function () {
            $leftTable.bootstrapTable('resetView', { height: getHeight() });
            $rightTable.bootstrapTable('resetView', { height: getHeight() });
        });

        // Reload data from server and refresh table
        var reloadList = function ( $department_id, $sub_department_id ) {
            var $url, $table;
            if ( $department_id === NOT_ASSIGN ) {
                $url = "{!! route('admin.member-dept-trees.getmembers-notbelongin_dept') !!}" + "?department_id=" + $sub_department_id;
                $table = $leftTable
            } else {
                $url = "{!! route('admin.member-dept-trees.getmembers-department') !!}" + '?department_id=' + $department_id;
                $table = $rightTable
            }
            $.ajax({ dataType: 'json', timeout: 3000, url: $url })
            .done ( function(data, textStatus, jqXHR) { 
                $table.bootstrapTable( 'load', { data: data['members'] } );
            }) 
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        } 

        var initLoadData = function() {
            var deferreds = [];
            deferreds.push (
                $.ajax({ dataType: 'json', timeout: 3000, url: "{!! route('admin.users.get-current-users') !!}" })
                .done ( function(data, textStatus, jqXHR) { 
                    userName = data['user']['name'];
                    userId = data['user']['id'];
                })
            );
            deferreds.push (
                $.ajax({ dataType: 'json', timeout: 3000, url: CODE_URL + '?category_id[]=' + POSITION_CATEGORY_ID })
                .done ( function(data, textStatus, jqXHR) { 
                    $('#toRightManager').empty();   
                    $('#toRightMember').empty();
                    $.each( data['codes'][0], function( index, code ) {
                        const codeString = '' + code.id;
                        if ( MANAGER_POSITION_IDs.includes(codeString) || DEFAULT_POSITION_IDs.includes(codeString) ) {
                            const selector = MANAGER_POSITION_IDs.includes(codeString) ? $('#toRightManager') : $('#toRightMember');
                            selector.append(
                                $("<a>", {
                                    'class': 'toRight dropdown-item',
                                    'href': '#',
                                    'html': code.txt + ' (' + code.kor_txt + ')',
                                    'code': code.id,
                                    'manager': (MANAGER_POSITION_IDs.includes(codeString) ? 1 : 0),
                                })
                            );
                        } 
                    });   
                    $('.toRight').on( "click", function() { 
                        toRightClick( $(this).attr('code'), $(this).attr('manager') );
                    });              
                })
            );
            deferreds.push (
                $.ajax({ dataType: 'json', timeout: 3000, url: CODE_URL + '?category_id[]=' + DEPT_CATEGORY_ID })
                .done ( function(data, textStatus, jqXHR) { 
                    var html = '';
                    $('#rightCombo').empty();
                    $.each( data['codes'][0], function( index, code ) {
                        var selectStr = "";
                        if ( index === 0 ) {
                            selectStr = 'selected';
                            saveDepartmentId = code.id;
                        }
                        html += '<option value=' + code.id + ' ' + selectStr + '>' + code.txt + ' (' + code.kor_txt + ')</option>';
                    });
                    $('#rightCombo').prepend(html);
                    $('#rightCombo').on('change', function() {
                        reloadList( this.value );
                        saveDepartmentId = this.value;
                        reloadList( NOT_ASSIGN, saveDepartmentId );
                    })
                    // Load initial data
                    reloadList( NOT_ASSIGN, $('#rightCombo').find('option:selected').val() );
                    reloadList( $('#rightCombo').find('option:selected').val() );
                })
            );
            $.when.apply( $, deferreds ).then( function() {
            }).fail( function(jqXHR, textStatus, errorThrown) {
                errorMessage( jqXHR );
            });
        }

        initLoadData();

        function toRightClick( position_id, manager ) {
            const selection = $leftTable.bootstrapTable('getSelections');
            if (selection.length > 0) { // if selected items are more than one?
                var deferreds = [];
                var errorCount = 0;
                $.each( selection, function( index, item ) {
                    var postData = { 
                        member_id: item.id,
                        department_id: saveDepartmentId, 
                        position_id: position_id, 
                        manager: manager,
                        enabled: 1,
                        updated_by: userId,
                        updated_by_name: userName
                    };
                    deferreds.push (
                        $.ajax({ dataType: 'json', method:'POST', timeout: 3000, data: postData, url: "{{ route('admin.member-dept-trees.store') }}" })
                        .done ( function(data) {
                            if (data.code == 'validation') {
                                validationMessage( data.errors );
                                errorCount++;
                            } else if (data.code == 'exception') {
                                exceptionMessage( data.status, data.errors );
                                errorCount++;
                            } else {
                                $leftTable.bootstrapTable('remove', {field: 'id', values: [item.id]});
                            }
                        })
                    );
                });
                
                $.when.apply( $, deferreds ).then( function() {
                    if ( errorCount === 0 ) {
                        saveSuccessMessage();
                    }
                    reloadList(saveDepartmentId);
                }).fail( function(jqXHR, textStatus, errorThrown) {
                    errorMessage( jqXHR );
                });
            }
        }

        $('.toLeft').click( function() {
            const selection = $rightTable.bootstrapTable('getSelections');
            if (selection.length > 0) { // if selected items are more than one?
                var deferreds = [];
                var errorCount = 0;
                $.each( selection, function( index, item ) {
                    var tableData = {
                        id: item.id,
                        first_name: item.first_name, 
                        last_name: item.last_name, 
                        kor_name: item.kor_name
                    };
                    deferreds.push (
                        $.ajax({ dataType: 'json', method:'delete', timeout: 3000, url: "{!! route('admin.member-dept-trees.index') !!}" + '/' + item.xid })
                        .done ( function(data) {
                            if (data.code == 'exception') {
                                exceptionMessage( data.status, data.errors );
                                errorCount++;
                            } else {
                                $leftTable.bootstrapTable("append", tableData); 
                                $rightTable.bootstrapTable('remove', {field: 'id', values: [item.id]});
                            }
                        })
                    );
                });
                                
                $.when.apply( $, deferreds ).then( function() {
                    if ( errorCount === 0 ) {
                        saveSuccessMessage();
                    }
                }).fail( function(jqXHR, textStatus, errorThrown) {
                    errorMessage( jqXHR );
                });
            }
        });

    </script>
@endsection