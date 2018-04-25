@extends('admin.layouts.master')

@section('styles')
    {{-- chosen user interface for autocomplete input --}}
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
    {{-- Tempus Dominus Bootstrap 4: The plugin provide a robust date and time picker designed to integrate into your Bootstrap project. https://tempusdominus.github.io/bootstrap-4/ --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    {{-- Croppie is a fast, easy to use image cropping plugin with tons of configuration options! https://foliotek.github.io/Croppie/ --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css" />
@endsection

@section('content')
<div class='container p-4'>
    <span class="h4-font-size pr-3">{{ __('messages.adm_title.title', ['title' => 'Member']) }}</span><span id="contentTitle" class="h6-font-size"></span>
    @include('admin.includes.members.show')
    @include('admin.includes.members.edit')
    <div id="toolbar">
        <button id="createNewRecord" class="btn btn-info mr-1" type="button" title="Create">
            <i class="fa fa-fw fa-user mr-1" aria-hidden="true"></i>{{ __('messages.adm_button.create_member') }}
        </button>
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
            data-show-columns="true">
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
                <th data-field="city_id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.city_id') }}</th>
                <th data-field="city_name" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.city_name') }}</th>
                <th data-field="province_id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.province_id') }}</th>
                <th data-field="province_name" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.province_name') }}</th>
                <th data-field="country_id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.country_id') }}</th>
                <th data-field="country_name" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.country_name') }}</th>
                <th data-field="status_id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.status_id') }}</th>
                <th data-field="status_name" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.status_name') }}</th>
                <th data-field="level_id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.level_id') }}</th>
                <th data-field="level_name" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.level_name') }}</th>
                <th data-field="duty_id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.duty_id') }}</th>
                <th data-field="duty_name" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.duty_name') }}</th>
                <th data-field="photo" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.photo') }}</th>
                <th data-field="primary" data-filter-control="select" data-formatter="primaryFormatter" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.primary') }}</th>
                <th data-field="register_at" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.register_at') }}</th>
                <th data-field="baptism_at" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">{{ __('messages.adm_table.baptism_at') }}</th>
                <th data-field="clone" data-width="45px" data-formatter="cloneFormatter" data-events="cloneEvents">{{ __('messages.adm_table.clone_btn') }}</th>
                <th data-field="edit" data-width="45px" data-formatter="editFormatter" data-events="editEvents">{{ __('messages.adm_table.edit_btn') }}</th>
                <th data-field="delete" data-width="45px" data-formatter="deleteFormatter" data-events="deleteEvents">{{ __('messages.adm_table.del_btn') }}</th>
            </tr>
        </thead>
    </table>
</div>
@include('admin.includes.members.crop')
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
        const codesURL = "{!! route('admin.codes.index') !!}";
        const membesURL = "{!! route('admin.members.index') !!}";

        var statusCodeLists = new Array(); // Member Status Code List
        var dutyCodeLists = new Array(); // Duty Code List
        var levelCodeLists = new Array(); // Baptism Status Code List
        var cityCodeLists = new Array(); // City Code List
        var provinceCodeLists = new Array(); // Province Code List
        var countryCodeLists = new Array(); // Country Code List
        var memberLists = new Array(); // Member List
        var saveIndex; // Row index of the table
        var saveId; // Primary key of the table

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

        function fillCombo($element, codeData, kind) {
            $element.empty();
            var html = '<option value=""></option>';
            $.each(codeData, function( index, codes ) {
                html += '<option value="' + codes['id'] + '">' + ( kind === 'province' ? codes['kor_txt'] + ' (' + codes['txt'] + ')' : codes['txt'] )  + '</option>';
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

        $.ajax({
            dataType: 'json',
            url: "{!! route('admin.code.getCodesByCategoryIds') !!}" + '?category_id[]=1&category_id[]=2&category_id[]=4&category_id[]=6&category_id[]=7&category_id[]=8',
            success: function(data) { 
                fillCombo( $('#selectStatusCombo'), data['codes'][0], "select" );
                fillCombo( $('#selectDutyCombo'), data['codes'][1], "duty" );
                fillCombo( $('#selectLevelCombo'), data['codes'][2], "level" );
                fillCombo( $('#selectCityCombo'), data['codes'][3], "city" );
                fillCombo( $('#selectProvinceCombo'), data['codes'][4], "province" );
                fillCombo( $('#selectCountryCombo'), data['codes'][5], "country" );
            }, 
            fail: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                toastr.error("Fail to get data from server: " + JSON.stringify(jqXHR), 'Failed');
            }
        });

        // reload data from server and refresh table
        function reloadList() {
            $.ajax({ dataType: 'json', url: membesURL,
                success: function(data) { 
                    memberLists = data['members'];
                    $table.bootstrapTable( 'load', { data: memberLists } );
                }, 
                fail: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error("Fail to get data from server: " + JSON.stringify(jqXHR), 'Failed');
                }
            });
        } 

        reloadList();

        function fillPostData() {
            var form = $("#editForm");
            return {
                first_name: form.find("input[name='first_name']").val(),
                middle_name: form.find("input[name='middle_name']").val(),
                last_name: form.find("input[name='last_name']").val(),
                kor_name: form.find("input[name='kor_name']").val(),
                gender: form.find("input[name='gender']:checked").val(),
                dob: form.find("input[name='dob']").val(),
                baptism_at: form.find("input[name='baptism_at']").val(),
                register_at: form.find("input[name='register_at']").val(),
                tel_home: form.find("input[name='tel_home']").val(),
                tel_cell: form.find("input[name='tel_cell']").val(),
                tel_office: form.find("input[name='tel_office']").val(),
                email: form.find("input[name='email']").val(),
                postal_code: form.find("input[name='postal_code']").val(),
                address: form.find("input[name='address']").val(),
                photo: $("#photo_filename").val(),
                city_id: $('#selectCityCombo').val(),
                city_name: $('#selectCityCombo option:selected').text(),
                province_id: $('#selectProvinceCombo').val(),
                province_name: $('#selectProvinceCombo option:selected').text(),
                country_id: $('#selectCountryCombo').val(),
                country_name: $('#selectCountryCombo option:selected').text(),
                status_id: $('#selectStatusCombo').val(),
                status_name: $('#selectStatusCombo option:selected').text(),
                level_id: $('#selectLevelCombo').val(),
                level_name: $('#selectLevelCombo option:selected').text(),
                duty_id: $('#selectDutyCombo').val(),
                duty_name: $('#selectDutyCombo option:selected').text(),
                primary: (form.find("input[name='primary']").prop('checked') ? 1 : 0),
            };
        }

        function doPutOrPost(method, postData) {
            var url = ( method === "POST" ) ? "{!! route('admin.members.store') !!}" : "{{ route('admin.members.index') }}" + '/' + saveId; 
            $.ajax({ dataType: 'json', method: method, data: postData, url: url, 
                success: function(data) {
                    if (data.errors) {
                        var message = '';
                        for (i=0; i < data.errors.length; i++) {
                            message += data.errors[i] + (i < data.errors.length -1 ? ' | ' : '');
                        } 
                        toastr.error(message, data.message);
                    } else {
                        toastr.success(data.message, 'Success');
                        if ( method === "POST" ) {
                            $table.bootstrapTable("append", postData);
                        } else {
                            $table.bootstrapTable('updateRow', {index: saveIndex, row: postData});
                        }
                        $("#editPanel").collapse("hide");
                        $('#contentTitle').text("");
                        reloadList();
                    }
                }
            });
        }

        $("#saveRecordButton").click( function(e) {
            e.preventDefault();
            var postData = fillPostData();
            var parameter = $('#saveRecordButton').hasClass('store') ? "POST" : "PUT";
            doPutOrPost(parameter, postData);
        });

        // delete record but I will just add 'DELETED' to email address 
        $("#deleteRecordButton").click( function(e) {
            e.preventDefault();
            var form = $("#editForm");
            form.find("input[name='first_name']").val(form.find("input[name='first_name']").val() + "__DELETED__");
            $('#selectStatusCombo').val(19999);
            var postData = fillPostData();
            doPutOrPost('PUT', postData);
            $("#showPanel").collapse("hide");
            $('#contentTitle').text("");
        });

        function fillEditPanel( rec ) {
            var form = $("#editForm");
            // if profile image is existed?
            if ( rec.photo ) {
                $.ajax({
                    url: "{!! asset('uploads/" + rec.photo + "') !!}",
                    type:'HEAD',
                    success: function() {
                        form.find('img').attr('src', "{!! asset('uploads/" + rec.photo + "') !!}");
                    },
                    error: function() {
                        form.find('img').attr('src', "{!! asset('images/photo.png') !!}");
                    }
                });
            }
            $("#photo_filename").val(rec.photo);
            form.find("input[name='first_name']").val(rec.first_name);
            form.find("input[name='middle_name']").val(rec.middle_name);
            form.find("input[name='last_name']").val(rec.last_name);
            form.find("input[name='kor_name']").val(rec.kor_name);
            form.find("input[name='gender'][value='" + rec.gender + "']").prop('checked', true);
            form.find("input[name='dob']").val(rec.dob);
            form.find("input[name='primary']").prop('checked', ( rec.primary ? true : false )); 
            form.find("input[name='baptism_at']").val(rec.baptism_at);
            form.find("input[name='register_at']").val(rec.register_at);
            form.find("input[name='tel_home']").val(rec.tel_home);
            form.find("input[name='tel_cell']").val(rec.tel_cell);
            form.find("input[name='tel_office']").val(rec.tel_office);
            form.find("input[name='email']").val(rec.email);
            form.find("input[name='postal_code']").val(rec.postal_code);
            form.find("input[name='address']").val(rec.address);
            $('#selectStatusCombo').val(rec.status_id).trigger('chosen:updated');
            $('#selectDutyCombo').val(rec.duty_id).trigger('chosen:updated'); 
            $('#selectLevelCombo').val(rec.level_id).trigger('chosen:updated');
            $('#selectCityCombo').val(rec.city_id).trigger('chosen:updated');
            $('#selectProvinceCombo').val(rec.province_id).trigger('chosen:updated');
            $('#selectCountryCombo').val(rec.country_id).trigger('chosen:updated');
        }

        function fillEditPanelForClone( rec ) {
            var form = $("#editForm");
            $('#editForm')[0].reset();

            form.find("input[name='last_name']").val(rec.last_name);
            form.find("input[name='gender'][value='" + rec.gender + "']").prop('checked', true);
            form.find("input[name='tel_home']").val(rec.tel_home);
            form.find("input[name='postal_code']").val(rec.postal_code);
            form.find("input[name='address']").val(rec.address);
            $('#selectCityCombo').val(rec.city_id).trigger('chosen:updated');
            $('#selectProvinceCombo').val(rec.province_id).trigger('chosen:updated');
            $('#selectCountryCombo').val(rec.country_id).trigger('chosen:updated');
            form.find('img').attr('src', "{{ asset('images/photo.png') }}");

            $('#selectStatusCombo').val('10001').trigger('chosen:updated'); // Member
            $('#selectDutyCombo').val('29999').trigger('chosen:updated'); // Layman
            $('#selectLevelCombo').val('49999').trigger('chosen:updated'); // Unbaptized
        }

        function fillShowPanel(rec) {
            var panel = $("#showPanel");
            if ( rec.photo ) {
                $.ajax({
                    url: "{!! asset('uploads/" + rec.photo + "') !!}",
                    type:'HEAD',
                    success: function() {
                        panel.find('img').attr('src', "{!! asset('uploads/" + rec.photo + "') !!}");
                    },
                    error: function() {
                        panel.find('img').attr('src', "{{ asset('images/photo.png') }}");
                    }
                });
            }
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
            panel.find("span[name='baptism_at']").text(' Baptism: ' + (!rec.baptism_at ? '' : rec.baptism_at));
            panel.find("span[name='register_at']").text('Register: ' + (!rec.register_at ? '' : rec.register_at));
            panel.find("span[name='status']").text(' Member Status: ' + rec.status_name);
            panel.find("span[name='level']").text(' Baptism Status: ' + rec.level_name);
            panel.find("span[name='duty']").text(' Duty: ' + rec.duty_name);
        }

        function openEditPanel(reason, rec) {
            if ($("#editPanel").is(":hidden")) { // if editPanel is closed
                $("#showPanel").collapse("hide");
                $("#editPanel").collapse("show");
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
                    $('#editForm')[0].reset();
                    $("#photoPlace").find('img').attr('src', "{{ asset('images/photo.png') }}");
                    // TODO: 정확한 데이터가 확정되면 디폴트 값을 넣는다
                    $('#selectStatusCombo').val('10001').trigger('chosen:updated');
                    $('#selectDutyCombo').val('29999').trigger('chosen:updated'); 
                    $('#selectLevelCombo').val('49999').trigger('chosen:updated');
                    $('#selectCityCombo').val($('#selectCityCombo option:contains("Ottawa")').val()).trigger('chosen:updated');
                    $('#selectProvinceCombo').val($('#selectProvinceCombo option:contains("ON")').val()).trigger('chosen:updated');
                    $('#selectCountryCombo').val($('#selectCountryCombo option:contains("Canada")').val()).trigger('chosen:updated');
                    $('#saveRecordButton').removeClass('store update').addClass('store');
                }
            }
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
            e.preventDefault();
            $("#editPanel").collapse("hide");
            $('#contentTitle').text("");
        });

        // click close button on show collasped div
        $("#closeShowPanel").click(function(e) {
            e.preventDefault();
            $("#showPanel").collapse("hide");
            $('#contentTitle').text("");
        });

        // click create new record
        $("#createNewRecord").click(function(e) {
            e.preventDefault();
            openEditPanel("create", null);
        });

        // 테이블의 Column을 클릭하면 발생하는 이벤트를 핸들한다.
        $table.on('click-cell.bs.table', function (field, column, row, rec) {
            saveId = Number(rec.id);
            if (column === 'edit' || column === "clone") {
                openEditPanel(column, rec);
            } else { // delete and show
                if (column === "delete") {
                    fillEditPanel(rec);
                }
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
            e.preventDefault();
            $("#crop-item").modal('show');
        });

        var $uploadCrop;

        $('#crop-item').on('shown.bs.modal', function () {
            $uploadCrop = $('#upload-photo').croppie({
                viewport: { width: 150, height: 150, type: 'square' },
                boundary: { width: 250, height: 250 }
            });
            $uploadCrop.croppie('bind', { url: "{{ asset('images/photo.png') }}" });
        });

        $('#upload-file').on('change', function () { 
            var reader = new FileReader();
            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                });
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('.upload-result').on('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                $.ajax({
                    url: "{!! route('admin.photo-crop.post') !!}",
                    type: "POST",
                    data: {"image":resp},
                    success: function (data) {
                        $("#photoPlace").find('img').attr('src', "{!! asset('uploads/" + data.filename + "') !!}");
                        $('#photo_filename').val(data.filename);
                        $("#crop-item").modal('hide');
                    }
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

    {{-- export EXCEL, PDF, PNG, JSON --}}
    <script src="{{ asset('js/export.js') }}"></script>
@endsection