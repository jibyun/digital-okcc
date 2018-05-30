{{--Member History Create/Update form--}}
<div class="modal fade" id="memberBasicInfoDialog" >
        <div class="modal-dialog">
            <div class="modal-content" style="width:850px;">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h6 id="basicInfo_dialog_title" class="modal-title">Family Info</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                        <div class="container p-0 mx-0 my-2 row border border-secondary rounded" style="background-color: khaki;font-size:12px">
                                <div class="col-md-6 p-0">
                                    <div class="row m-3">
                                        <div class="col-sm-4 p-0 text-left">
                                            <img width="150" height="150" class="rounded border boder-secondary" alt="Photo (150*150)" src="images/photo.png">
                                        </div>
                                        <div class="col-sm-8 py-2 px-3 rounded bg-white" style="height: 150px; ">
                                            <span class="h6-font-size pr-3" name="english_name"></span><span name="kor_name"></span><br>
                                            <hr class="my-1">
                                            <span class="px-2"><i class="fa fa-fw fa-birthday-cake" aria-hidden="true"></i><span name="dob"> </span></span>(<span name="gender"></span>)<br>
                                            <span class="px-2"><i class="fa fa-fw fa-envelope-o" aria-hidden="true"></i><span name="email"> </span></span><br>
                                            <span class="px-2"><i class="fa fa-fw fa-phone" aria-hidden="true"></i><span name="tel_home"> </span></span><span><i class="fa fa-fw fa-mobile" aria-hidden="true"></i><span name="tel_cell"> </span></span><br>
                                            <span class="px-2"><i class="fa fa-fw fa-building" aria-hidden="true"></i><span name="tel_office"> </span></span><br>
                                        </div>
                                    </div>
                                    <div class="row m-3">
                                        <div class="col-12 text-right pr-0">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 p-0">
                                    <div class="row m-3 py-2 rounded bg-white" style="height: 150px;">
                                        <div class="col-sm-11">
                                            <span class="pl-2"><i class="fa fa-fw fa-home" aria-hidden="true"></i><span class="pl-2" name="address"></span></span>&nbsp;<span name="city_txt"></span>&nbsp;<span name="province_txt"></span>.&nbsp;<span name="country_txt"></span>&nbsp;<span name="postal_code"></span><br>
                                            <hr class="my-2">
                                            <span class="px-2"><i class="fa fa-fw fa-calendar" aria-hidden="true"></i><span name="baptism_at"> </span></span><span name="register_at"></span><br>
                                            <span class="px-2"><i class="fa fa-fw fa-tint" aria-hidden="true"></i><span name="status_txt"> </span></span><br>
                                            <span class="px-2"><i class="fa fa-fw fa-tint" aria-hidden="true"></i><span name="level_txt"> </span></span><br>
                                            <span class="px-2"><i class="fa fa-fw fa-tint" aria-hidden="true"></i><span name="duty_txt"> </span></span><br>
                                        </div>
                                    </div>
         
                                    <div class="text-right" style="padding:0 20px 10px 0">
                                            <button type="button" class="btn" data-dismiss="modal">Close</button>
                                           
                                        </div>   
                                </div>
                                
                            </div>
                </div>
            </div>
        </div>
    </div>