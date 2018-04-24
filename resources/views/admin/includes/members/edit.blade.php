{{-- Create & Edit --}}
<div class="collapse" id="editPanel">
    <form id="editForm" action="" method="">
        <div class="container p-0 mx-0 my-2 row border border-secondary rounded" style="background-color: #303030;">
            <div class="col-md-7 p-0">
                <div class="row m-3">
                    <div class="col-sm-3 mr-3 p-0 text-left">
                        <div id="photoPlace" class="mb-2">
                            <input type="text" class="form-control" id="photo_filename" name="photo_filename" hidden>
                            <img name="photo" src="{{ asset('images/photo.png') }}" alt="Photo (150*150)" class="rounded border boder-dark">
                        </div>
                        <button id="getPhotoButton" class="btn btn-secondary" type="button" title="Get Photo" style="width:150px">
                            <i class="fa fa-check mr-2" aria-hidden="true"></i>{{ __('messages.adm_table.upload_btn') }}
                        </button>
                    </div>
                    <div class="col-sm p-3 rounded" style="background-color: #c0c0c0">
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
                <div class="row m-3">
                    <div class="col-12 text-right pr-0">
                    </div>
                </div>
            </div>
            <div class="col-md-5 pl-0">
                <div class="row my-3 mx-0 py-3 rounded" style="background-color: #c0c0c0">
                    <div class="pr-3 col-sm">
                        {{-- Email --}}
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label s1-font-size text-right pr-0">{{ __('messages.adm_table.email') }}</label>
                            <div class="col-sm-9 text-left">
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('messages.adm_table.email') }}">
                            </div>
                        </div>
                        <hr/>
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
                        <hr/>
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
    </form>
</div>
{{-- End of Create & Edit --}}