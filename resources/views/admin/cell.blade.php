@extends('admin.layouts.master')

@section('content')

<div class='container p-4'>
    <h4>{{ __('messages.adm_title.cell_organizer') }}</h4>
    <div class="pt-2">
        <nav aria-label="Page navigation">
            <ul id="from_menu" class="pagination pagination-sm">

            </ul>
        </nav>
    </div>

    @include('admin.includes.cells.select')

    <table  id="table" class="table table-striped table-bordered" 
            data-side-pagination="client"
            data-pagination="true" 
            data-page-list="[5, 10, 25, 50, ALL]" 
            data-click-to-select="true" 
            data-row-style="rowStyle">
        <thead>
            <tr>
                <th data-field="id" data-visible="false" data-searchable="false">{{ __('messages.adm_table.id') }}</th>
                <th data-field="first_name" data-sortable="true">{{ __('messages.adm_table.first_name') }}</th>
                <th data-field="middle_name" data-sortable="true" data-visible="false" data-searchable="false">{{ __('messages.adm_table.middle_name') }}</th>
                <th data-field="last_name" data-sortable="true">{{ __('messages.adm_table.last_name') }}</th>
                <th data-field="kor_name" data-sortable="true">{{ __('messages.adm_table.kor_name') }}</th>
                <th data-field="dob" data-sortable="true">{{ __('messages.adm_table.dob') }}</th>
                <th data-field="gender" data-width="60px" data-sortable="true" data-searchable="false">{{ __('messages.adm_table.gender') }}</th>
                <th data-field="email">{{ __('messages.adm_table.email') }}</th>
                <th data-field="tel_home">{{ __('messages.adm_table.tel_home') }}</th>
                <th data-field="tel_cell">{{ __('messages.adm_table.tel_cell') }}</th>
                <th data-field="tel_office" data-visible="false" data-searchable="false">{{ __('messages.adm_table.tel_office') }}</th>
                <th data-field="address" data-visible="false" data-searchable="false">{{ __('messages.adm_table.address') }}</th>
                <th data-field="postal_code" data-visible="false" data-searchable="false">{{ __('messages.adm_table.postal') }}</th>
                <th data-field="register_at" data-visible="false" data-searchable="false">{{ __('messages.adm_table.register_at') }}</th>
                <th data-field="baptism_at" data-visible="false" data-searchable="false">{{ __('messages.adm_table.baptism_at') }}</th>
                <th data-field="xid" data-visible="false" data-searchable="false"></th>
            </tr>
        </thead>
    </table>
</div>
{{-- End Container --}}
@endsection

@section('scripts')

    <script type="text/javascript">
        const CELL_CATEGORY = 10;
        const NOT_ASSIGN = 999999;
        const DEFAULT_POSITION = 120012; // TODO: 코드 등록할 때 구역원 코드를 만들어 대치한다. 예) 125000
        const CODE_URL = "{!! route('admin.code.getCodesByCategoryIds') !!}";
        const $table = $('#table');
        var saveId // id of member_department_maps
        var saveMemberId;
        var sourceId, targetId; // department(cell) id 
        var userId, userName;

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        // get user id and name
        $.ajax({ dataType: 'json', url: "{!! route('admin.users.get-current-users') !!}",
            success: function(data) { 
                userName = data['user']['name'];
                userId = data['user']['id'];
            }, 
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                toastr.error("can't get member data from server: " + JSON.stringify(jqXHR), 'Failed');
            }
        });

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
                    { align: 'center' },{ align: 'center' },{ align: 'center' },{} ]
            });
            // whenever being changed window's size, table's size should be also changed
            $(window).resize(function () {
                $table.bootstrapTable('resetView', {
                    height: getHeight()
                });
            });
        }

        // Reload data from server and refresh table
        function reloadList( $department_id ) {
            $url = ( $department_id === NOT_ASSIGN ? "{!! route('admin.member-dept-trees.getmembers-notassigned') !!}" : "{!! route('admin.member-dept-trees.getmembers-department') !!}" + '?department_id=' + $department_id );
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
            $('#from_menu').empty();
            $('#to_menu').empty();
            var source = '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Source Cell</a></li>';
            var target = '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Target Cell</a></li>';
            $.each(codeData, function( index, codes ) {
                source += '<li class="page-item" value="' + codes['id'] + '" data-toggle="tooltip" data-placement="top" title="' + codes['kor_txt'] + '"><a class="page-link" href="#">' + (index + 1) + '</a></li>';
                target += '<li class="page-item" value="' + codes['id'] + '" data-toggle="tooltip" data-placement="top" title="' + codes['kor_txt'] + '"><a class="page-link" href="#">' + (index + 1) + '</a></li>';
            });
            source += '<li class="page-item" value=' + NOT_ASSIGN + ' data-toggle="tooltip" data-placement="top" title="구역미정"><a class="page-link" href="#">Not Assigned</a></li>';
            target += '<li class="page-item" value=' + NOT_ASSIGN + ' data-toggle="tooltip" data-placement="top" title="구역미정"><a class="page-link" href="#">Not Assigned</a></li>';
            $('#from_menu').prepend(source);
            $('#to_menu').prepend(target);

            $('li').tooltip();

            $('#from_menu li').click( function(e) {
                e.preventDefault();
                $(this).addClass('active').siblings().removeClass('active');
                sourceId = $(this).val();
                reloadList($(this).val());
            });

            $('#from_menu li:nth-child(2)').click();
            
            $('#to_menu li').click( function(e) {
                e.preventDefault();
                $(this).addClass('active').siblings().removeClass('active');
                targetId = $(this).val();
                moveCell(sourceId, targetId);
                reloadList(sourceId);
                $("#showPanel").collapse("hide");
            });
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
            saveId = Number(rec.xid);
            saveMemberId = rec.id;
            if ($("#showPanel").is( ":hidden" )) {
                $('#to_menu li').removeClass('active');
                $("#showPanel").collapse("show");
            }
        });

        function moveCell( source, target ) {
            if ( source != target ) {
                if ( source === NOT_ASSIGN ) { // INSERT
                    createRecord( target );
                } else if ( target === NOT_ASSIGN ) { // DEKETE
                    deleteRecord();
                } else { // UPDATE
                    updateRecord( target );
                }
            }
        }

        function createRecord( department_id ) {
            var postData = { 
                member_id: saveMemberId,
                department_id: department_id, 
                position_id: DEFAULT_POSITION, 
                enabled: 1,
                updated_by: userId,
                updated_by_name: userName,
            };
            $.ajax({ dataType: 'json', method:'POST', data: postData, url: "{{ route('admin.member-dept-trees.store') }}",
                success: function(data) {
                    if (data.errors) {
                        var message = '';
                        for (i=0; i < data.errors.length; i++) {
                            message += data.errors[i] + (i < data.errors.length -1 ? ' | ' : '');
                        } 
                        toastr.error(message, data.message);
                    } else {
                        $table.bootstrapTable('remove', {field: 'id', values: [saveMemberId]});
                        toastr.success(data.message, 'Success');
                    }
                }
            });
        }

        function updateRecord( department_id ) {
            var postData = { 
                member_id: saveMemberId,
                department_id: department_id, 
                position_id: DEFAULT_POSITION, 
                enabled: 1,
                updated_by: userId,
                updated_by_name: userName,
            };
            $.ajax({ dataType: 'json', method:'PUT', data: postData, url: "{!! route('admin.member-dept-trees.index') !!}" + '/' + saveId,
                success: function(data) {
                    if (data.errors) {
                        var message = '';
                        for (i=0; i < data.errors.length; i++) {
                            message += data.errors[i] + (i < data.errors.length -1 ? ' | ' : '');
                        } 
                        toastr.error(message, data.message);
                    } else {
                        $table.bootstrapTable('remove', {field: 'id', values: [saveMemberId]});
                        toastr.success(data.message, 'Success');
                    }
                }
            });
        }

        function deleteRecord() {
            $.ajax({ dataType: 'json', method:'DELETE', url: "{!! route('admin.member-dept-trees.index') !!}" + '/' + saveId,
                success: function(data) {
                    if (data.errors) {
                        toastr.error(data.errors, data.message);
                    } else {
                        $table.bootstrapTable('remove', {field: 'id', values: [saveMemberId]});
                        toastr.success(data.message, 'Success');
                    }
                }
            });
        }
    </script>

@endsection