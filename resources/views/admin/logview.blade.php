@extends('admin.layouts.master')

@section('styles')
    {{-- chosen user interface for autocomplete input --}}
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
    {{-- Tempus Dominus Bootstrap 4: The plugin provide a robust date and time picker designed to integrate into your Bootstrap project. https://tempusdominus.github.io/bootstrap-4/ --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endsection

@section('content')
<div class='container p-4'>
    <span class="h4-font-size pr-3">{{ __('messages.adm_title.log') }}</span><span id="contentTitle" class="h6-font-size"></span>
    <div id="toolbar" class="form-inline">
        <div class="mr-2" style="width: 130px;">
            <select id="log" class="form-control" name="log" data-placeholder="Select a Log">
            </select>
        </div>
        <div class="mr-2" style="width: 140px;">
            <select id="user" class="form-control" name="user" data-placeholder="Select a User">
            </select>
        </div>
        <div class="input-group date mr-2" id="from" data-target-input="nearest" style="width: 150px;">
            <input type="text" class="form-control datetimepicker-input" data-target="#from" name="from" placeholder="From: YYYY-MM-DD" />
            <div class="input-group-append" data-target="#from" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
        <div id="test"></div>
        <div class="input-group date mr-2" id="to" data-target-input="nearest" style="width: 150px;">
            <input type="text" class="form-control datetimepicker-input" data-target="#to" name="to" placeholder="To: YYYY-MM-DD" />
            <div class="input-group-append" data-target="#to" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
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
            data-show-columns="true" >
        <thead>
            <tr>
                <th data-field="id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">Id</th>
                <th data-field="created_at" data-width="150px" data-filter-control="select" data-sortable="true" scope="col" data-visible="true">Created</th>
                <th data-field="code_id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">Code Id</th>
                <th data-field="code_name" data-width="100px" data-filter-control="select" data-sortable="true" scope="col" data-visible="true">Kind</th>
                <th data-field="user_id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">User Id</th>
                <th data-field="user_name" data-width="150px" data-filter-control="select" data-sortable="true" scope="col" data-visible="true">User</th>
                <th data-field="memo" data-filter-control="select" data-sortable="false" scope="col" data-visible="true" data-escape="true">Memo</th>
            </tr>
        </thead>
    </table>
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
        const baseURL = "{!! route('admin.log.get') !!}";

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        /* initialize bootstrap table */

        // row style
        function rowStyle(row, index) {
            return { css: { "padding": "0px 10px" } };
        }

        // compute height of the table and return 
        function getHeight() { $(window).height() - $('h4').outerHeight(true); }

        // Initialize main table
        $table.bootstrapTable({
            height: getHeight(),
            columns: [ { align: 'center' },{ align: 'center' },{ align: 'center' },{ align: 'left' },{ align: 'center' },{ align: 'left' },
                { align: 'left' }]
        });
        // whenever being changed window's size, table's size should be also changed
        $(window).resize(function () {
            $table.bootstrapTable('resetView', { height: getHeight() });
        });

        function fillCombo($element, codeData, kind) {
            $element.empty();
            var html = '<option value="">ALL ' + kind.toUpperCase() + '</option>';
            $.each(codeData, function( index, codes ) {
                html += '<option value="' + codes['id'] + '">' + ( kind === 'user' ? codes['name'] : codes['txt'] )  + '</option>';
            });
            $element.prepend(html);
            // The following options are available to pass into Chosen on instantiation.
            $element.chosen({
                case_sensitive_search: false,
                search_contains: true, // Setting this option to true allows matches starting from anywhere within a word. 
                no_results_text: "Oops, nothing found!",
                placeholder_text_single: "Please Select One!",
            });
        }

        $.ajax({ dataType: 'json', url: "{!! route('admin.code.getCodesByCategoryIds') !!}" + '?category_id[]=11',
            success: function(data) { 
                fillCombo( $('#log'), data['codes'][0], "log" );
            }, 
            fail: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                toastr.error("Fail to get data from server: " + JSON.stringify(jqXHR), 'Failed');
            }
        });

        $.ajax({ dataType: 'json', url: "{!! route('admin.users.get-users') !!}" + '?table=users',
            success: function(data) { 
                fillCombo( $('#user'), data['users'], "user" );
            }, 
            fail: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                toastr.error("Fail to get data from server: " + JSON.stringify(jqXHR), 'Failed');
            }
        });

        // reload data from server and refresh table
        function reloadList() {
            var from = $("#from").find('input[name=from]').val();
            var to = $("#to").find('input[name=to]').val();
            var log = $('#log').val() ? $('#log').val() : '';
            var user = $('#user').val() ? $('#user').val() : '';
            $.ajax({ dataType: 'json', url: baseURL + '?from=' + from + '&to=' + to + '&code_id=' + log + '&user_id=' + user,
                success: function(data) { 
                    $table.bootstrapTable( 'load', { data: data['logs'] } );
                }, 
                fail: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error("Fail to get data from server: " + JSON.stringify(jqXHR), 'Failed');
                }
            });
        } 

        $("#log").change( function(e) {  reloadList(); });
        $("#user").change( function(e) { reloadList(); });

       // set date picker up
        $( function () {
            $('#from').datetimepicker({ format: 'YYYY-MM-DD', date: new Date() });
            $('#to').datetimepicker({ format: 'YYYY-MM-DD', date: new Date() });
            
            $('#from').on("change.datetimepicker", function(e) { reloadList(); });
            $('#to').on("change.datetimepicker", function(e) { reloadList(); });

            reloadList();
        });

    </script>
    
    {{-- chosen user interface CDN for autocomplete input --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.min.js"></script>
    {{-- Tempus Dominus Bootstrap 4: The plugin provide a robust date and time picker designed to integrate into your Bootstrap project. https://tempusdominus.github.io/bootstrap-4/ --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    
    {{-- export EXCEL, PDF, PNG, JSON --}}
    <script src="{{ asset('js/export.js') }}"></script>
@endsection