@extends('admin.layouts.master')

@section('styles')
    {{-- chosen user interface for autocomplete input --}}
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
    {{-- Tempus Dominus Bootstrap 4: The plugin provide a robust date and time picker designed to integrate into your Bootstrap project. https://tempusdominus.github.io/bootstrap-4/ --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    {{-- Croppie is a fast, easy to use image cropping plugin with tons of configuration options! https://foliotek.github.io/Croppie/ --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css" />
    <style>
        .card {
            border-width: 0;
        }
        .card-header {
            background-color: darkolivegreen;
            color: antiquewhite;
        }
        .btn-link {
            color: antiquewhite;
            text-decoration: none !important
        }
        .btn-link:hover {
            text-decoration: none;
            color: orange;
        }
    </style>
@endsection

@section('content')
<div class='container p-4'>
    <span class="h4-font-size pr-3">{{ __('messages.adm_title.title', ['title' => 'Member']) }}</span><span id="contentTitle" class="h6-font-size"></span>
    @include('admin.members.includes.members.show')
    @include('admin.members.includes.members.edit')
    <div id="toolbar">
        <button id="createNewRecord" class="btn btn-info mr-1" type="button" title="Create">
            <i class="fa fa-fw fa-user mr-1" aria-hidden="true"></i>{{ __('messages.adm_button.create_member') }}
        </button>
        @include('admin.includes.export', [ 'router' => 'admin.export.members' ])  
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
                <th data-field="first_name" data-sortable="true">{{ __('messages.adm_table.first_name') }}</th>
                <th data-field="middle_name" data-sortable="true" data-visible="false" data-searchable="false">{{ __('messages.adm_table.middle_name') }}</th>
                <th data-field="last_name"  data-sortable="true">{{ __('messages.adm_table.last_name') }}</th>
                <th data-field="kor_name" data-sortable="true">{{ __('messages.adm_table.kor_name') }}</th>
                <th data-field="dob" data-sortable="true">{{ __('messages.adm_table.dob') }}</th>
                <th data-field="gender" data-width="60px" data-sortable="true" data-searchable="false">{{ __('messages.adm_table.gender') }}</th>
                <th data-field="email">{{ __('messages.adm_table.email') }}</th>
                <th data-field="tel_home">{{ __('messages.adm_table.tel_home') }}</th>
                <th data-field="tel_cell">{{ __('messages.adm_table.tel_cell') }}</th>
                <th data-field="tel_office" data-visible="false" data-searchable="false">{{ __('messages.adm_table.tel_office') }}</th>
                <th data-field="address" data-visible="false" data-searchable="false">{{ __('messages.adm_table.address') }}</th>
                <th data-field="postal_code" data-visible="false" data-searchable="false">{{ __('messages.adm_table.postal') }}</th>
                <th data-field="city_id" data-visible="false" data-searchable="false">{{ __('messages.adm_table.city_id') }}</th>
                <th data-field="city_name" data-visible="false" data-searchable="false">{{ __('messages.adm_table.city_name') }}</th>
                <th data-field="province_id" data-visible="false" data-searchable="false">{{ __('messages.adm_table.province_id') }}</th>
                <th data-field="province_name" data-visible="false" data-searchable="false">{{ __('messages.adm_table.province_name') }}</th>
                <th data-field="country_id" data-visible="false" data-searchable="false">{{ __('messages.adm_table.country_id') }}</th>
                <th data-field="country_name" data-visible="false" data-searchable="false">{{ __('messages.adm_table.country_name') }}</th>
                <th data-field="status_id" data-visible="false" data-searchable="false">{{ __('messages.adm_table.status_id') }}</th>
                <th data-field="status_name" data-visible="false" data-searchable="false">{{ __('messages.adm_table.status_name') }}</th>
                <th data-field="level_id" data-visible="false" data-searchable="false">{{ __('messages.adm_table.level_id') }}</th>
                <th data-field="level_name" data-visible="false" data-searchable="false">{{ __('messages.adm_table.level_name') }}</th>
                <th data-field="duty_id" data-visible="false" data-searchable="false">{{ __('messages.adm_table.duty_id') }}</th>
                <th data-field="duty_name" data-visible="false" data-searchable="false">{{ __('messages.adm_table.duty_name') }}</th>
                <th data-field="photo" data-visible="false" data-searchable="false">{{ __('messages.adm_table.photo') }}</th>
                <th data-field="primary" data-formatter="primaryFormatter" data-visible="false" data-searchable="false">{{ __('messages.adm_table.primary') }}</th>
                <th data-field="register_at" data-visible="false" data-searchable="false">{{ __('messages.adm_table.register_at') }}</th>
                <th data-field="baptism_at" data-visible="false" data-searchable="false">{{ __('messages.adm_table.baptism_at') }}</th>
                <th data-field="clone" data-width="45px" data-formatter="cloneFormatter" data-events="cloneEvents" data-searchable="false">{{ __('messages.adm_table.clone_btn') }}</th>
                <th data-field="edit" data-width="45px" data-formatter="editFormatter" data-events="editEvents" data-searchable="false">{{ __('messages.adm_table.edit_btn') }}</th>
                <th data-field="delete" data-width="45px" data-formatter="deleteFormatter" data-events="deleteEvents" data-searchable="false">{{ __('messages.adm_table.del_btn') }}</th>
            </tr>
        </thead>
    </table>
</div>
@include('admin.members.includes.members.crop')
@include('admin.members.includes.members.delete')
{{-- End Container --}}
@endsection

@section('scripts')

    <script type="text/javascript">
        const STATUS_CATEGORY_ID = '{{ config('app.admin.statusCategoryId') }}';
        const OFFICER_CATEGORY_ID = '{{ config('app.admin.officerCategoryId') }}';
        const BAPTISM_CATEGORY_ID = '{{ config('app.admin.baptismCategoryId') }}';
        const CITY_CATEGORY_ID = '{{ config('app.admin.cityCategoryId') }}';
        const PROVINCE_CATEGORY_ID = '{{ config('app.admin.privinceCategoryId') }}';
        const COUNTRY_CATEGORY_ID = '{{ config('app.admin.countryCategoryId') }}';

        const DELETED_MEMBER = '{{ config('app.admin.deletedMember') }}'; 
        const MEMBER_STATUS = '{{ config('app.admin.memberStatus') }}'; 
        const LAYMAN_STATUS = '{{ config('app.admin.laymanStatus') }}'; 
        const UNBAPTIZED_STATUS = '{{ config('app.admin.unbaptizedStatus') }}'; 
        const PHOTO_BASE64 = '{{ asset('images/photo.png') }}';
        const $table = $('#table');
        const $editPanel = $('#editPanel');
        const codesURL = "{!! route('admin.codes.index') !!}";
        const membesURL = "{!! route('admin.members.index') !!}";
        const host = location.hostname;

        var statusCodeLists = new Array(); // Member Status Code List
        var dutyCodeLists = new Array(); // Duty Code List
        var levelCodeLists = new Array(); // Baptism Status Code List
        var cityCodeLists = new Array(); // City Code List
        var provinceCodeLists = new Array(); // Province Code List
        var countryCodeLists = new Array(); // Country Code List
        var memberLists = new Array(); // Member List
        var saveIndex; // Row index of the table
        var saveId; // Primary key of the table
        var uploadCrop;
        var photoPath = (host && host.includes('office.okcc.ca')) ? "{{ asset('storage/app/public/uploads/') }}" : "{{ asset('storage/uploads/') }}";

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        /* initialize bootstrap table */

        // row style
        function rowStyle(row, index) {
            return { css: { "padding": "0px 10px" } };
        }

        function primaryFormatter(value, row, index) {
            if (value === 1) { return 'True'; } else { return 'False'; }
        }

        // compose the column for clone button 
        function cloneFormatter(value, row, index) {
            return [
                '<a href="#"><span class="h6-font-size" style="color: #ff6600;"><i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i></span></a>'
            ].join('');
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
        function getHeight() { $(window).height() - $('h4').outerHeight(true); }

        // Initialize main table
        $table.bootstrapTable({
            height: getHeight(),
            columns: [ { align: 'center' },{ align: 'left' },{ align: 'left' },{ align: 'left' },{ align: 'center' },{ align: 'center' }, // last: dob
                { align: 'center' },{ align: 'left' },{ align: 'left' },{ align: 'left' },{ align: 'left' },{ align: 'left' }, // last: address
                { align: 'center' },{ align: 'center' },{ align: 'left' },{ align: 'center' },{ align: 'left' },{ align: 'center' },{ align: 'left' }, // last: country
                { align: 'center' },{ align: 'left' },{ align: 'center' },{ align: 'left' },{ align: 'center' },{ align: 'left' }, // last: duty
                { align: 'left' },{ align: 'center' },{ align: 'center' },{ align: 'center' }, // last: baptism_at
                { align: 'center', clickToSelect: false }, { align: 'center', clickToSelect: false }, { align: 'center', clickToSelect: false }]
        });
        // whenever being changed window's size, table's size should be also changed
        $(window).resize(function () {
            $table.bootstrapTable('resetView', { height: getHeight() });
        });

        $table.on('column-switch.bs.table', function (e, field, checked) {
            var columns = $table.bootstrapTable('getVisibleColumns');
            $.each(columns, function(index, data) {
                data['searchable'] = true;
            });
            columns = $table.bootstrapTable('getHiddenColumns');
            $.each(columns, function(index, data) {
                data['searchable'] = false;
            });
            //------------------ ADJUST BY BUG
            if (checked === true) {
                $table.bootstrapTable('hideColumn', field);
                $table.bootstrapTable('showColumn', field);
            } else {
                $table.bootstrapTable('showColumn', field);
                $table.bootstrapTable('hideColumn', field);
            }
        });

        function fillCombo($element, codeData, kind) {
            $element.empty();
            var html = '';
            $.each(codeData, function( index, codes ) {
                if ( kind === 'province' ) {
                    html += '<option value=' + codes['id'] + '>' + codes['kor_txt'] + ' (' + codes['txt'] + ')' + '</option>';
                } else if ( kind === 'duty' || kind === 'level' || kind === 'status' ) {
                    html += '<option value=' + codes['id'] + '>' + codes['txt'] + ' (' + codes['kor_txt'] + ')</option>';    
                } else {
                    html += '<option value=' + codes['id'] + '>' + codes['txt'] + '</option>';
                }
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

        $.ajax({ dataType: 'json', timeout: 3000, url: "{!! route('admin.code.getCodesByCategoryIds') !!}" + 
            '?category_id[]=' + STATUS_CATEGORY_ID + '&category_id[]=' + OFFICER_CATEGORY_ID + '&category_id[]=' + BAPTISM_CATEGORY_ID +
            '&category_id[]=' + CITY_CATEGORY_ID + '&category_id[]=' + PROVINCE_CATEGORY_ID + '&category_id[]=' + COUNTRY_CATEGORY_ID })
        .done ( function(data, textStatus, jqXHR) { 
            fillCombo( $('#selectStatusCombo'), data['codes'][0], "status" );
            fillCombo( $('#selectDutyCombo'), data['codes'][1], "duty" );
            fillCombo( $('#selectLevelCombo'), data['codes'][2], "level" );
            fillCombo( $('#selectCityCombo'), data['codes'][3], "city" );
            fillCombo( $('#selectProvinceCombo'), data['codes'][4], "province" );
            fillCombo( $('#selectCountryCombo'), data['codes'][5], "country" );
            uploadCrop = $('#upload-photo').croppie({
                viewport: { width: 150, height: 150, type: 'square' },
                boundary: { width: 250, height: 250 }
            });
            uploadCrop.croppie('bind', { url: "{{ asset('images/photo.png') }}" });
        }) 
        .fail ( function(jqXHR, textStatus, errorThrown) { 
            errorMessage( jqXHR );
        });

        // reload data from server and refresh table
        function reloadList() {
            $.ajax({ dataType: 'json', timeout: 3000, url: membesURL })
            .done ( function(data, textStatus, jqXHR) { 
                memberLists = data['members'];
                $table.bootstrapTable( 'load', { data: memberLists } );
            }) 
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        } 

        reloadList();

        function fillPostData() {
            return {
                first_name: $editPanel.find("input[name='first_name']").val(),
                middle_name: $editPanel.find("input[name='middle_name']").val(),
                last_name: $editPanel.find("input[name='last_name']").val(),
                kor_name: $editPanel.find("input[name='kor_name']").val(),
                gender: $editPanel.find("input[name='gender']:checked").val(),
                dob: $editPanel.find("input[name='dob']").val(),
                baptism_at: $editPanel.find("input[name='baptism_at']").val(),
                register_at: $editPanel.find("input[name='register_at']").val(),
                tel_home: $editPanel.find("input[name='tel_home']").val(),
                tel_cell: $editPanel.find("input[name='tel_cell']").val(),
                tel_office: $editPanel.find("input[name='tel_office']").val(),
                email: $editPanel.find("input[name='email']").val(),
                postal_code: $editPanel.find("input[name='postal_code']").val(),
                address: $editPanel.find("input[name='address']").val(),
                photo: $editPanel.find("#photo_filename").val(),
                city_id: $editPanel.find('#selectCityCombo').val(),
                city_name: $editPanel.find('#selectCityCombo option:selected').text(),
                province_id: $editPanel.find('#selectProvinceCombo').val(),
                province_name: $editPanel.find('#selectProvinceCombo option:selected').text(),
                country_id: $editPanel.find('#selectCountryCombo').val(),
                country_name: $editPanel.find('#selectCountryCombo option:selected').text(),
                status_id: $editPanel.find('#selectStatusCombo').val(),
                status_name: $editPanel.find('#selectStatusCombo option:selected').text(),
                level_id: $editPanel.find('#selectLevelCombo').val(),
                level_name: $editPanel.find('#selectLevelCombo option:selected').text(),
                duty_id: $editPanel.find('#selectDutyCombo').val(),
                duty_name: $editPanel.find('#selectDutyCombo option:selected').text(),
                primary: ($editPanel.find("input[name='primary']").prop('checked') ? 1 : 0),
            };
        }

        function doPutOrPost(method, postData) {
            var url = ( method === "POST" ) ? "{!! route('admin.members.store') !!}" : "{{ route('admin.members.index') }}" + '/' + saveId; 
            $.ajax({ dataType: 'json', timeout: 3000, method:method, data: postData, url: url })
            .done ( function(data) {
                if (data.code == 'validation') {
                    validationMessage( data.errors );
                } else if (data.code == 'exception') {
                    exceptionMessage( data.status, data.errors );
                } else {
                    saveSuccessMessage();
                    if ( method === "POST" ) {
                        $table.bootstrapTable("append", postData);
                    } else {
                        $table.bootstrapTable('updateRow', {index: saveIndex, row: postData});
                    }
                    $("#editPanel").collapse("hide");
                    $('#contentTitle').text("");
                    reloadList();
                }
            })
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        }

        $("#saveRecordButton").click( function() {
            var postData = fillPostData();
            var parameter = $editPanel.find('#saveRecordButton').hasClass('store') ? "POST" : "PUT";
            doPutOrPost(parameter, postData);
        });

        // delete record but I will just add 'DELETED' to email address 
        $(".crud-delete").click( function() {
            $.ajax({ dataType: 'json', timeout: 3000, method:'delete', url: membesURL + '/' + saveId })
            .done ( function(data) {
                if (data.code == 'exception') {
                    exceptionMessage( data.status, data.errors );
                } else {
                    deleteSuccessMessage();
                    $table.bootstrapTable('remove', {field: 'id', values: [saveId]});
                    $(".modal").modal('hide'); // hide model form
                    $('#contentTitle').text("");
                    reloadList();
                }
            })
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        });

        function fillEditPanel( rec ) {
            $editPanel.find("img[name='photo']").attr('src', (rec.photo) ? photoPath + '/' + rec.photo : PHOTO_BASE64);
            $editPanel.find("#photo_filename").val(rec.photo);
            $editPanel.find("input[name='first_name']").val(rec.first_name);
            $editPanel.find("input[name='middle_name']").val(rec.middle_name);
            $editPanel.find("input[name='last_name']").val(rec.last_name);
            $editPanel.find("input[name='kor_name']").val(rec.kor_name);
            $editPanel.find("input[name='gender'][value='" + rec.gender + "']").prop('checked', true);
            $editPanel.find("input[name='dob']").val(rec.dob);
            $editPanel.find("input[name='primary']").prop('checked', ( rec.primary ? true : false )); 
            $editPanel.find("input[name='baptism_at']").val(rec.baptism_at);
            $editPanel.find("input[name='register_at']").val(rec.register_at);
            $editPanel.find("input[name='tel_home']").val(rec.tel_home);
            $editPanel.find("input[name='tel_cell']").val(rec.tel_cell);
            $editPanel.find("input[name='tel_office']").val(rec.tel_office);
            $editPanel.find("input[name='email']").val(rec.email);
            $editPanel.find("input[name='postal_code']").val(rec.postal_code);
            $editPanel.find("input[name='address']").val(rec.address);
            $editPanel.find('#selectStatusCombo').val(rec.status_id).trigger('chosen:updated');
            $editPanel.find('#selectDutyCombo').val(rec.duty_id).trigger('chosen:updated'); 
            $editPanel.find('#selectLevelCombo').val(rec.level_id).trigger('chosen:updated');
            $editPanel.find('#selectCityCombo').val(rec.city_id).trigger('chosen:updated');
            $editPanel.find('#selectProvinceCombo').val(rec.province_id).trigger('chosen:updated');
            $editPanel.find('#selectCountryCombo').val(rec.country_id).trigger('chosen:updated');
        }

        function fillEditPanelForClone( rec ) {
            clearNormalFields();
            $editPanel.find("input[name='last_name']").val(rec.last_name);
            $editPanel.find("input[name='gender'][value='" + rec.gender + "']").prop('checked', true);
            $editPanel.find("input[name='tel_home']").val(rec.tel_home);
            $editPanel.find("input[name='postal_code']").val(rec.postal_code);
            $editPanel.find("input[name='address']").val(rec.address);
            $editPanel.find("input[name='gender'][value='M']").prop('checked', true);
            $editPanel.find("input[name='primary']").prop('checked', false); 
            $editPanel.find('#selectCityCombo').val(rec.city_id).trigger('chosen:updated');
            $editPanel.find('#selectProvinceCombo').val(rec.province_id).trigger('chosen:updated');
            $editPanel.find('#selectCountryCombo').val(rec.country_id).trigger('chosen:updated');
            $editPanel.find('#selectStatusCombo').val( MEMBER_STATUS ).trigger('chosen:updated'); // Member
            $editPanel.find('#selectDutyCombo').val( LAYMAN_STATUS).trigger('chosen:updated'); // Layman
            $editPanel.find('#selectLevelCombo').val( UNBAPTIZED_STATUS ).trigger('chosen:updated'); // Unbaptized
        }

        function fillShowPanel(rec) {
            var panel = $("#showPanel");

            panel.find("img").attr('src', (rec.photo) ? photoPath + '/' + rec.photo : PHOTO_BASE64);
            panel.find("span[name='eng_name']").text((!rec.first_name ? '' : rec.first_name) + ' ' + (!rec.middle_name ? '' : rec.middle_name) + ' ' + (!rec.last_name ? '' : rec.last_name));
            panel.find("span[name='kor_name']").text(!rec.kor_name ? '' : rec.kor_name);
            panel.find("span[name='birthdate']").text(' ' + (!rec.dob ? '' : rec.dob));
            panel.find("span[name='primary']").text(' ' + (rec.primary ? '{{ __('messages.adm_table.primary') }}' : ''));
            panel.find("span[name='gender']").text(rec.gender == 'F' ? '{{ __('messages.adm_table.female') }}' : '{{ __('messages.adm_table.male') }}');
            panel.find("span[name='email']").text(' ' + (!rec.email ? '' : rec.email));
            panel.find("span[name='tel_home']").text(' ' + (!rec.tel_home ? '' : rec.tel_home));
            panel.find("span[name='tel_cell']").text(' ' + (!rec.tel_cell ? '' : rec.tel_cell));
            panel.find("span[name='tel_office']").text(' ' + (!rec.tel_office ? '' : rec.tel_office));
            panel.find("span[name='address']").text((!rec.address ? '' : rec.address));
            panel.find("span[name='city']").text(rec.city_name);
            panel.find("span[name='province']").text(rec.province_name);
            panel.find("span[name='country']").text(rec.country_name);
            panel.find("span[name='postal_code']").text((!rec.postal_code ? '' : rec.postal_code));
            panel.find("span[name='baptism_at']").text( ' @lang('messages.adm_table.baptism_at'): ' + (!rec.baptism_at ? '' : rec.baptism_at));
            panel.find("span[name='register_at']").text( '@lang('messages.adm_table.register_at'): ' + (!rec.register_at ? '' : rec.register_at));
            panel.find("span[name='status']").text( ' @lang('messages.adm_table.status_name'): ' + rec.status_name);
            panel.find("span[name='level']").text(' @lang('messages.adm_table.level_name'): ' + rec.level_name);
            panel.find("span[name='duty']").text(' @lang('messages.adm_table.duty_name'): ' + rec.duty_name);
        }

        function openEditPanel(reason, rec) {
            if ($("#editPanel").is(":hidden")) { // if editPanel is closed
                $("#showPanel").collapse("hide");
                $("#editPanel").collapse("show");
                $('#leftCollapseOne').collapse("show");
                $('#rightCollapseOne').collapse("show");
                if (reason === "edit") {
                    $('#contentTitle').text("> Editing...");
                    fillEditPanel(rec);
                    $('#saveRecordButton').removeClass('store update').addClass('update');
                } else if (reason === "clone") {
                    var form = $("#editForm");
                    $('#contentTitle').text("> Cloning...");
                    fillEditPanelForClone(rec);
                    $('#saveRecordButton').removeClass('store update').addClass('store');
                } else {
                    $('#contentTitle').text("> Creating...");
                    clearNormalFields();
                    clearSpecialFields();
                    $('#saveRecordButton').removeClass('store update').addClass('store');
                }
            }
        }

        function clearNormalFields() { 
            $editPanel.find('input:text').val(''); 
            $editPanel.find("input[name='email']").val('');
            $editPanel.find("img[name='photo']").attr('src', PHOTO_BASE64);
        }

        function clearSpecialFields() {
            $editPanel.find("input[name='gender'][value='M']").prop('checked', true);
            $editPanel.find("input[name='primary']").prop('checked', true); 
            $editPanel.find('#selectStatusCombo').val(MEMBER_STATUS).trigger('chosen:updated');
            $editPanel.find('#selectDutyCombo').val(LAYMAN_STATUS).trigger('chosen:updated'); 
            $editPanel.find('#selectLevelCombo').val(UNBAPTIZED_STATUS).trigger('chosen:updated');
            $editPanel.find('#selectCityCombo').val($('#selectCityCombo option:contains("Ottawa")').val()).trigger('chosen:updated');
            $editPanel.find('#selectProvinceCombo').val($('#selectProvinceCombo option:contains("ON")').val()).trigger('chosen:updated');
            $editPanel.find('#selectCountryCombo').val($('#selectCountryCombo option:contains("Canada")').val()).trigger('chosen:updated');
        }

        function openShowPanel(reason, rec) {
            if ($("#editPanel").is( ":hidden" )) {
                fillShowPanel(rec);
                $("#editPanel").collapse("hide");
                $("#showPanel").collapse("show");
                if (reason === "delete") {
                    $('#deleteRecordButton').show();
                    $('#contentTitle').text("> Deleting...");
                } else {
                    $('#deleteRecordButton').hide();
                    $('#contentTitle').text("> Searching...");
                }
            }
        }

        // click close button on edit collasped div
        $("#cancelEditButton").click(function(e) {
            $("#editPanel").collapse("hide");
            $('#contentTitle').text("");
        });

        // click close button on show collasped div
        $("#closeShowPanel").click(function(e) {
            $("#showPanel").collapse("hide");
            $('#contentTitle').text("");
        });

        // click create new record
        $("#createNewRecord").click(function(e) {
            openEditPanel("create", null);
        });

        // 테이블의 Column을 클릭하면 발생하는 이벤트를 핸들한다.
        $table.on('click-cell.bs.table', function (field, column, row, rec) {
            saveId = Number(rec.id);
            if (column === 'edit' || column === "clone") {
                openEditPanel(column, rec);
            } else if (column === 'delete') { 
                $("#delete-item").modal('show').draggable({ handle: ".modal-header" });
            } else {
                openShowPanel(column, rec);
            }
        });

        // 테이블의 Row를 클릭하면 발생하는 이벤트를 핸들한다: Bootstrap Table에서 Index를 구하기 위한 유일한 방법(Maybe)
        $table.on('click-row.bs.table', function (e, row, $element) {
            saveIndex = $element.index();
        });
 
        /* functions for uploading photos */
        // click close button on edit collasped div
        $("#getPhotoButton").click(function(e) {
            $("#crop-item").modal('show').draggable({ handle: ".modal-header" });
        });

        $('#upload-file').on('change', function () { 
            var reader = new FileReader();
            reader.onload = function (e) {
                uploadCrop.croppie('bind', {
                    url: e.target.result
                });
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('.upload-result').on('click', function (ev) {
            uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                $.ajax({ dataType: 'json', timeout: 3000, method:'POST', data: {"image":resp}, url: "{!! route('admin.photo-crop.post') !!}" })
                .done ( function(data) {
                    $editPanel.find('img[name="photo"]').attr('src', photoPath + '/' + data.filename);
                    $editPanel.find('#photo_filename').val(data.filename);
                    $("#crop-item").modal('hide');
                })
                .fail ( function(jqXHR, textStatus, errorThrown) { 
                    errorMessage( jqXHR );
                });
            });
        }); 
 
       // set date picker up
        $(function () {
            $('#dob').datetimepicker({ format: 'YYYY-MM-DD' });
            $('#baptism_at').datetimepicker({ format: 'YYYY-MM-DD' });
            $('#register_at').datetimepicker({ format: 'YYYY-MM-DD' });
        });
        
    </script>
    
    {{-- chosen user interface CDN for autocomplete input --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.min.js"></script>

    {{-- Tempus Dominus Bootstrap 4: The plugin provide a robust date and time picker designed to integrate into your Bootstrap project. https://tempusdominus.github.io/bootstrap-4/ --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>

    {{-- Croppie is a fast, easy to use image cropping plugin with tons of configuration options! https://foliotek.github.io/Croppie/ --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>

    {{-- to implement make display order --}}
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>

@endsection