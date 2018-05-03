{{-- Create & Edit --}}
<div id="editPanel" class="container collapse px-0">
    <div class="container row border border-secondary rounded py-3 mx-0" style="background-color: #303030;">
        <div class="col-sm-7 col-md-7">
            <div class="row">
                <div class="col-sm-3 col-md-3 text-left pl-0">
                    <div id="photoPlace" class="mb-2">
                        <input type="text" class="form-control" id="photo_filename" name="photo_filename" hidden>
                        <img name="photo" src="{{ asset('images/photo.png') }}" alt="Photo (150*150)" class="rounded border boder-dark">
                    </div>
                    <button id="getPhotoButton" class="btn btn-secondary" type="button" title="Get Photo" style="width:150px">
                        <i class="fa fa-check mr-2" aria-hidden="true"></i>{{ __('messages.adm_table.upload_btn') }}
                    </button>
                </div>
                <div id="leftAccordion" class="col-sm-9 col-md-9">
                    <div class="card">
                        <div id="leftHeadingOne" class="card-header py-0">
                            <button class="btn btn-link pl-0" data-toggle="collapse" data-target="#leftCollapseOne" aria-expanded="true" aria-controls="leftCollapseOne">
                                <i class="fa fa-fw fa-info-circle mr-2"></i>{{ __('messages.adm_table.essential_field') }}
                            </button>
                        </div>
                        <div id="leftCollapseOne" class="collapse my-0 show" aria-labelledby="leftHeadingOne" data-parent="#leftAccordion" style="background-color: #c0c0c0">
                            <div class="card-body">
                                {{--  first name  --}}
                                <div class="form-group row">
                                    <label for="first_name" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.first_name') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="{{ __('messages.adm_table.first_name') }}">
                                    </div>
                                </div>
                                {{--  middle name  --}}
                                <div class="form-group row">
                                    <label for="middle_name" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.middle_name') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="{{ __('messages.adm_table.middle_name') }}">
                                    </div>
                                </div>
                                {{--  last name  --}}
                                <div class="form-group row">
                                    <label for="last_name" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.last_name') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="{{ __('messages.adm_table.last_name') }}">
                                    </div>
                                </div>
                                {{--  korean name  --}}
                                <div class="form-group row">
                                    <label for="kor_name" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.kor_name') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <input type="text" class="form-control" id="kor_name" name="kor_name" placeholder="{{ __('messages.adm_table.kor_name') }}">
                                    </div>
                                </div>
                                {{--  Gender  --}}
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.gender') }}</label>
                                    <div class="btn-group col-sm-9">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="gender" id="genderM" value="M" checked>{{ __('messages.adm_table.male') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="gender" id="genderF" value="F">{{ __('messages.adm_table.female') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{--  Householder --}}
                                <div class="form-group row">
                                    <label for="primary" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.primary') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-control form-checkbox py-1 mb-0">
                                            <input type="checkbox" class="form-control-input my-2" id="primary" name="primary">
                                            <label class="form-control-label mb-0" for="primary">&nbsp;&nbsp;{{ __('messages.adm_table.checkif_householder') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div id="leftHeadingTwo" class="card-header py-0">
                            <button class="btn btn-link collapsed pl-0" data-toggle="collapse" data-target="#leftCollapseTwo" aria-expanded="true" aria-controls="leftCollapseTwo">
                                <i class="fa fa-fw fa-clock-o mr-2"></i>{{ __('messages.adm_table.date_field') }}
                            </button>
                        </div>
                        <div id="leftCollapseTwo" class="collapse" aria-labelledby="leftHeadingTwo" data-parent="#leftAccordion" style="background-color: #c0c0c0">
                            <div class="card-body">
                                {{-- Birthdate --}}
                                <div class="form-group row">
                                    <label for="dob" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.dob') }}</label>
                                    <div class="input-group date col-sm-9" id="dob" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#dob" name="dob" placeholder="{{ __('messages.adm_table.date_ph') }}" />
                                        <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Baptism Date --}}
                                <div class="form-group row">
                                    <label for="baptism_at" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.baptism_at') }}</label>
                                    <div class="input-group date col-sm-9" id="baptism_at" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#baptism_at" name="baptism_at" placeholder="{{ __('messages.adm_table.date_ph') }}" />
                                        <div class="input-group-append" data-target="#baptism_at" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Register Date --}}
                                <div class="form-group row">
                                    <label for="register_at" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.register_at') }}</label>
                                    <div class="input-group date col-sm-9" id="register_at" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#register_at" name="register_at" placeholder="{{ __('messages.adm_table.date_ph') }}" />
                                        <div class="input-group-append" data-target="#register_at" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-5 col-md-5">
            <div class="row">
                <div id="rightAccordion" class="col-sm-12 col-md-12 text-left px-0">
                    <div class="card">
                        <div id="rightHeadingOne" class="card-header py-0">
                            <button class="btn btn-link pl-0" data-toggle="collapse" data-target="#rightCollapseOne" aria-expanded="true" aria-controls="rightCollapseOne">
                                <i class="fa fa-fw fa-envelope-o mr-2"></i>{{ __('messages.adm_table.contact_field') }}
                            </button>
                        </div>
                        <div id="rightCollapseOne" class="collapse my-0 show" aria-labelledby="rightHeadingOne" data-parent="#rightAccordion" style="background-color: #c0c0c0">
                            <div class="card-body">
                                {{-- Email --}}
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.email') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('messages.adm_table.email') }}">
                                    </div>
                                </div>
                                {{--  Home phone --}}
                                <div class="form-group row">
                                    <label for="tel_home" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.tel_home') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <input type="text" class="form-control" id="tel_home" name="tel_home" placeholder="{{ __('messages.adm_table.tel_home') }}">
                                    </div>
                                </div>
                                {{--  Cell phone --}}
                                <div class="form-group row">
                                    <label for="tel_cell" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.tel_cell') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <input type="text" class="form-control" id="tel_cell" name="tel_cell" placeholder="{{ __('messages.adm_table.tel_cell') }}">
                                    </div>
                                </div>
                                {{--  Office phone --}}
                                <div class="form-group row">
                                    <label for="tel_office" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.tel_office') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <input type="text" class="form-control" id="tel_office" name="tel_office" placeholder="{{ __('messages.adm_table.tel_office') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div id="rightHeadingTwo" class="card-header py-0">
                            <button class="btn btn-link pl-0" data-toggle="collapse" data-target="#rightCollapseTwo" aria-expanded="true" aria-controls="rightCollapseTwo">
                                <i class="fa fa-fw fa-home mr-2"></i>{{ __('messages.adm_table.address_field') }}
                            </button>
                        </div>
                        <div id="rightCollapseTwo" class="collapse my-0" aria-labelledby="rightHeadingTwo" data-parent="#rightAccordion" style="background-color: #c0c0c0">
                            <div class="card-body">
                                {{-- Postal Code --}}
                                <div class="form-group row">
                                    <label for="postal_code" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.postal') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="{{ __('messages.adm_table.postal') }}">
                                    </div>
                                </div>
                                {{-- Address --}}
                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.address') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="{{ __('messages.adm_table.address') }}">
                                    </div>
                                </div>
                                {{-- City  --}}
                                <div class="form-group row">
                                    <label for="city" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.city_name') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <select id="selectCityCombo" class="form-control" name="city" data-placeholder="{{ __('messages.adm_table.select_city') }}">
            
                                        </select>
                                    </div>
                                </div>
                                {{-- Province --}}
                                <div class="form-group row">
                                    <label for="province" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.province_name') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <select id="selectProvinceCombo" class="form-control" name="province" data-placeholder="{{ __('messages.adm_table.select_province') }}">
            
                                        </select>
                                    </div>
                                </div>
                                {{-- Country --}}
                                <div class="form-group row">
                                    <label for="country" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.country_name') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <select id="selectCountryCombo" class="form-control" name="country" data-placeholder="{{ __('messages.adm_table.select_country') }}">
            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div id="rightHeadingThree" class="card-header py-0">
                            <button class="btn btn-link pl-0" data-toggle="collapse" data-target="#rightCollapseThree" aria-expanded="true" aria-controls="rightCollapseThree">
                                <i class="fa fa-fw fa-tag mr-2"></i>{{ __('messages.adm_table.status_field') }}
                            </button>
                        </div>
                        <div id="rightCollapseThree" class="collapse my-0" aria-labelledby="rightHeadingThree" data-parent="#rightAccordion" style="background-color: #c0c0c0">
                            <div class="card-body">
                                {{-- Member Status --}}
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.status_name') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <select id="selectStatusCombo" class="form-control" name="status" data-placeholder="{{ __('messages.adm_table.select_status') }}">
            
                                        </select>
                                    </div>
                                </div>
                                {{-- Baptism Status --}}
                                <div class="form-group row">
                                    <label for="level" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.level_name') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <select id="selectLevelCombo" class="form-control" name="level" data-placeholder="{{ __('messages.adm_table.select_level') }}">
            
                                        </select>
                                    </div>
                                </div>
                                {{-- Duty --}}
                                <div class="form-group row">
                                    <label for="duty" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.duty_name') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <select id="selectDutyCombo" class="form-control" name="duty" data-placeholder="{{ __('messages.adm_table.select_duty') }}">
            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 mb-3 ml-3 mr-0">
                <div class="col-12 pr-0 text-right">
                    <button id="cancelEditButton" class="btn btn-secondary" type="button" title="Cancel">
                        <i class="fa fa-times mr-2" aria-hidden="true"></i>{{ __('messages.adm_table.cancel_btn') }}
                    </button>
                    <button id="saveRecordButton" class="btn btn-primary ml-2" type="button" title="Save Changes">
                        <i class="fa fa-check mr-2" aria-hidden="true"></i>{{ __('messages.adm_table.save_btn') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End of Create & Edit --}}