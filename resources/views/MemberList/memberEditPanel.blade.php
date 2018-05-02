{{-- Create & Edit --}}
<div class="collapse" id="editPanel">
        <form id="editForm" action="" method="">
            <div class="container p-0 mx-0 my-2 row border border-secondary rounded" style="background-color: #303030;">
                <div class="col-md-7 p-0">
                    <div class="row m-3">
                        <div class="col-sm-4 mr-3 p-0 text-left">
                            <div id="photoPlace" class="mb-2">
                                <input type="text" class="form-control" id="photo_filename" name="photo_filename" hidden>
                                <img name="photo" src="images/photo.png" alt="Photo (151*151)" class="rounded border boder-dark">
                            </div>
                            <button id="getPhotoButton" class="btn btn-secondary" type="button" title="Get Photo" style="width:150px">
                                <i class="fa fa-check mr-2" aria-hidden="true"></i> Upload Photo
                            </button>
                        </div>
                        <div class="col-sm p-3 rounded" style="background-color: #c0c0c0">
                            {{--  first name  --}}
                            <div class="form-group row">
                                <label for="first_name" class="col-sm-4 col-form-label s1-font-size text-left pr-0">First Name</label>
                                <div class="col-sm-8 text-left">
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                                </div>
                            </div>
                            {{--  middle name  --}}
                            <div class="form-group row">
                                <label for="middle_name" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Middle Name</label>
                                <div class="col-sm-8 text-left">
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name">
                                </div>
                            </div>
                            {{--  last name  --}}
                            <div class="form-group row">
                                <label for="last_name" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Last Name</label>
                                <div class="col-sm-8 text-left">
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                                </div>
                            </div>
                            {{--  korean name  --}}
                            <div class="form-group row">
                                <label for="kor_name" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Korean Name</label>
                                <div class="col-sm-8 text-left">
                                    <input type="text" class="form-control" id="kor_name" name="kor_name" placeholder="Korean Name">
                                </div>
                            </div>
                            {{--  Gender  --}}
                            <div class="form-group row">
                                <label for="gender" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Gender</label>
                                <div class="btn-group col-sm-8">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="gender" id="genderM" value="M" checked>Male
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="gender" id="genderF" value="F">Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- Birthdate --}}
                            <div class="form-group row">
                                <label for="dob" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Birthdate</label>
                                <div class="input-group date col-sm-8" id="dob" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#dob" name="dob" placeholder="YYYY-MM-DD" />
                                    <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            {{-- Baptism Date --}}
                            <div class="form-group row">
                                <label for="baptism_at" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Baptism Date</label>
                                <div class="input-group date col-sm-8" id="baptism_at" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#baptism_at" name="baptism_at" placeholder="YYYY-MM-DD" />
                                    <div class="input-group-append" data-target="#baptism_at" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            {{-- Register Date --}}
                            <div class="form-group row">
                                <label for="register_at" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Register Date</label>
                                <div class="input-group date col-sm-8" id="register_at" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#register_at" name="register_at" placeholder="YYYY-MM-DD" />
                                    <div class="input-group-append" data-target="#register_at" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            {{--  Home phone --}}
                            <div class="form-group row">
                                <label for="tel_home" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Home Phone</label>
                                <div class="col-sm-8 text-left">
                                    <input type="text" class="form-control" id="tel_home" name="tel_home" placeholder="Home Phone">
                                </div>
                            </div>
                            {{--  Cell phone --}}
                            <div class="form-group row">
                                <label for="tel_cell" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Cell Phone</label>
                                <div class="col-sm-8 text-left">
                                    <input type="text" class="form-control" id="tel_cell" name="tel_cell" placeholder="Cell Phone">
                                </div>
                            </div>
                            {{--  Office phone --}}
                            <div class="form-group row">
                                <label for="tel_office" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Office Phone</label>
                                <div class="col-sm-8 text-left">
                                    <input type="text" class="form-control" id="tel_office" name="tel_office" placeholder="Office Phone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-3">
                        <div class="col-12 text-left pr-0">
                        </div>
                    </div>
                </div>
                <div class="col-md-5 pl-0">
                    <div class="row my-3 mx-0 py-3 rounded" style="background-color: #c0c0c0">
                        <div class="pr-3 col-sm">
                            {{-- Email --}}
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Email</label>
                                <div class="col-sm-8 text-left">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                </div>
                            </div>
                            <hr/>
                            {{-- Postal Code --}}
                            <div class="form-group row">
                                <label for="postal_code" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Postal Code</label>
                                <div class="col-sm-8 text-left">
                                    <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code">
                                </div>
                            </div>
                            {{-- Address --}}
                            <div class="form-group row">
                                <label for="address" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Address</label>
                                <div class="col-sm-8 text-left">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                                </div>
                            </div>
                            {{-- City  --}}
                            <div class="form-group row">
                                <label for="city" class="col-sm-4 col-form-label s1-font-size text-left pr-0">City</label>
                                <div class="col-sm-8 text-left">
                                    <select id="selectCityCombo" class="form-control" name="city_id" data-placeholder="Select a City">
        
                                    </select>
                                </div>
                            </div>
                            {{-- Province --}}
                            <div class="form-group row">
                                <label for="province" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Province</label>
                                <div class="col-sm-8 text-left">
                                    <select id="selectProvinceCombo" class="form-control" name="province_id" data-placeholder="Select a Province">
        
                                    </select>
                                </div>
                            </div>
                            {{-- Country --}}
                            <div class="form-group row">
                                <label for="country" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Country</label>
                                <div class="col-sm-8 text-left">
                                    <select id="selectCountryCombo" class="form-control" name="country_id" data-placeholder="Select a Country">
        
                                    </select>
                                </div>
                            </div>
                            <hr/>
                            {{-- Member Status --}}
                            <div class="form-group row">
                                <label for="status" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Member Status</label>
                                <div class="col-sm-8 text-left">
                                    <select id="selectStatusCombo" class="form-control" name="status_id" data-placeholder="Select a Member Status">
        
                                    </select>
                                </div>
                            </div>
                            {{-- Baptism Status --}}
                            <div class="form-group row">
                                <label for="level" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Baptism Status</label>
                                <div class="col-sm-8 text-left">
                                    <select id="selectLevelCombo" class="form-control" name="level_id" data-placeholder="Select a Baptism Status">
        
                                    </select>
                                </div>
                            </div>
                            {{-- Duty --}}
                            <div class="form-group row">
                                <label for="duty" class="col-sm-4 col-form-label s1-font-size text-left pr-0">Duty</label>
                                <div class="col-sm-8 text-left">
                                    <select id="selectDutyCombo" class="form-control" name="duty_id" data-placeholder="Select a Duty">
        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 mb-3 ml-3 mr-0">
                        <div class="col-12 pr-0 text-left">
                            <button id="cancelEditButton" class="btn btn-secondary" type="button" title="Cancel">
                                <i class="fa fa-times mr-2" aria-hidden="true"></i> Close
                            </button>
                            <button id="saveEditButton" class="btn btn-primary ml-2" type="button" title="Save Changes">
                                <i class="fa fa-check mr-2" aria-hidden="true"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- End of Create & Edit --}}