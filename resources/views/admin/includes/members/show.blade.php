{{-- Show & Delete --}}
<div class="collapse" id="showPanel">
    <div class="container p-0 mx-0 my-2 row border border-secondary rounded" style="background-color: khaki;">
        <div class="col-md-6 p-0">
            <div class="row m-3">
                <div class="col-sm-4 p-0 text-left">
                    <img src="{{ asset('images/photo.png') }}" alt="Photo (150*150)" class="rounded border boder-secondary" width="150px" height="150px">
                </div>
                <div class="col-sm-8 py-2 px-3 rounded bg-white" style="height: 150px">
                    <span class="h6-font-size pr-3" name="eng_name"></span><span name="kor_name"></span><br/>
                    <hr class="my-1"/>
                    <span class="px-2"><i class="fa fa-fw fa-birthday-cake" aria-hidden="true"></i><span name="birthdate"></span></span>(<span name="gender"></span>)<span name="primary" class="ml-2"></span><br/>
                    <span class="px-2"><i class="fa fa-fw fa-envelope-o" aria-hidden="true"></i><span name="email"></span></span><br/>
                    <span class="px-2"><i class="fa fa-fw fa-phone" aria-hidden="true"></i><span name="tel_home"></span></span><span><i class="fa fa-fw fa-mobile" aria-hidden="true"></i><span name="tel_cell"></span></span><br/>
                    <span class="px-2"><i class="fa fa-fw fa-building" aria-hidden="true"></i><span name="tel_office"></span></span><br/>
                </div>
            </div>
            <div class="row m-3">
                <div class="col-12 text-right pr-0">
                </div>
            </div>
        </div>
        <div class="col-md-6 p-0">
            <div class="row m-3 py-2 rounded bg-white" style="height:150px;">
                <div class="col-sm-11">
                    <span class="pl-2"><i class="fa fa-fw fa-home" aria-hidden="true"></i><span class="pl-2" name="address"></span></span>&nbsp;<span name="city"></span>&nbsp;<span name="province"></span>.&nbsp;<span name="country"></span>&nbsp;<span name="postal_code"></span><br/>
                    <hr class="my-2"/>
                    <span class="px-2"><i class="fa fa-fw fa-calendar" aria-hidden="true"></i><span name="baptism_at"></span></span><span name="register_at"></span><br/>
                    <span class="px-2"><i class="fa fa-fw fa-tint" aria-hidden="true"></i><span name="status"></span></span><br/>
                    <span class="px-2"><i class="fa fa-fw fa-tint" aria-hidden="true"></i><span name="level"></span></span><br/>
                    <span class="px-2"><i class="fa fa-fw fa-tint" aria-hidden="true"></i><span name="duty"></span></span><br/>
                </div>
            </div>
            <div class="row m-3">
                <div class="col-12 pr-0 text-right">
                    <button id="closeShowPanel" class="btn btn-secondary" type="button" title="{{ __('messages.adm_table.close_panel_btn') }}">
                        <i class="fa fa-times mr-2" aria-hidden="true"></i>{{ __('messages.adm_table.close_panel_btn') }}
                    </button>
                    <button id="deleteRecordButton" class="btn btn-danger ml-2" type="button" title="{{ __('messages.adm_table.delete_member_btn') }}">
                        <i class="fa fa-thumbs-o-down mr-2" aria-hidden="true"></i>{{ __('messages.adm_table.delete_member_btn') }}
                    </button>
                </div>
            </div>
        </div>
            
    </div>
</div>
{{-- End of Show & Delete --}}