{{--Member History Create/Update form--}}
<div class="modal fade" id="memberHistoryDialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title">{{ __('messages.memberdetail.history_createtitle') }}</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="frmHistory">
                    @csrf
                    {{-- Hidden field for ID --}}
                    <input type="hidden" id="history_id" name="history_id" />
                    {{-- Hidden field for Member Id --}}
                    <input type="hidden" id="history_memberId" name="history_memberId" />
                    {{-- Title --}}
                    <div class="form-group row">
                        <label for="history_title" class="col-sm-2 col-form-label s1-font-size text-right pr-0">
                            {{ __('messages.memberdetail.history_title') }}
                        </label>
                        <div class="col-sm-10 text-left">
                            <input type="text" class="form-control" id="history_title" name="history_title" 
                                placeholder="{{ __('messages.memberdetail.history_title') }}" />
                        </div>
                    </div>

                    {{-- Start Date --}}
                    <div class="form-group row">
                        <label for="history_started_at" class="col-sm-2 col-form-label s1-font-size text-right pr-0">
                            {{ __('messages.memberdetail.history_startdate') }}
                        </label>
                        <div class="input-group date col-sm-10" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" id="history_started_at" data-target="#history_started_at" name="history_started_at"
                                placeholder="{{ __('messages.memberdetail.history_dateformat') }}" />
                            <div class="input-group-append" data-target="#history_started_at" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    {{-- End Date --}}
                    <div class="form-group row">
                        <label for="history_finished_at" class="col-sm-2 col-form-label s1-font-size text-right pr-0">
                            {{ __('messages.memberdetail.history_enddate') }}
                        </label>
                        <div class="input-group date col-sm-10" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" id="history_finished_at" data-target="#history_finished_at" name="history_finished_at"
                                placeholder="{{ __('messages.memberdetail.history_dateformat') }}" />
                            <div class="input-group-append" data-target="#history_finished_at" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>


                    {{-- Note --}}
                    <div class="form-group">
                        <label>{{ __('messages.memberdetail.history_memo') }}</label>
                        <textarea id="history_memo" rows="6" class="form-control" placeholder="{{ __('messages.memberdetail.history_memo') }}"></textarea>
                    </div>

                    {{-- Buttons --}}
                    <div class="form-group text-right">
                        <button type="submit" id = "btnMemberHistorySave" class="btn">{{ __('messages.common.save') }}</button>
                        <button type="button" class="btn" data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>