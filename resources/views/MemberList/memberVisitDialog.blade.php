{{--Member Visit Create/Update form--}}
<div class="modal fade" id="memberVisitDialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title">{{ __('messages.memberdetail.visit_createtitle') }}</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="frmVisit">
                    @csrf
                    {{-- Hidden field for ID --}}
                    <input type="hidden" id="visit_id" name="visit_id" />
                    {{-- Hidden field for Member Id --}}
                    <input type="hidden" id="visit_memberId" name="visit_memberId" />
                    {{-- Title --}}
                    <div class="form-group row">
                        <label for="visit_title" class="col-sm-2 col-form-label s1-font-size text-right pr-0">
                            {{ __('messages.memberdetail.visit_title') }}
                        </label>
                        <div class="col-sm-10 text-left">
                            <input type="text" class="form-control" id="visit_title" name="visit_title" 
                                placeholder="{{ __('messages.memberdetail.visit_title') }}" />
                        </div>
                    </div>

                    {{-- Visit Date --}}
                    <div class="form-group row">
                        <label for="visit_visited_at" class="col-sm-2 col-form-label s1-font-size text-right pr-0">
                            {{ __('messages.memberdetail.visit_visited_at') }}
                        </label>
                        <div class="input-group date col-sm-10" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" id="visit_visited_at" data-target="#visit_visited_at" name="visit_visited_at"
                                placeholder="{{ __('messages.common.dateformat') }}" />
                            <div class="input-group-append" data-target="#visit_visited_at" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    {{-- Paster of Visitation --}}
                    <div class="form-group row">
                        <label for="visit_pastor" class="col-sm-2 col-form-label s1-font-size text-right pr-0">
                            {{ __('messages.memberdetail.visit_pastor') }}
                        </label>
                        <div class="col-sm-10 text-left">
                            <input type="text" class="form-control" id="visit_pastor" name="visit_pastor" 
                                placeholder="{{ __('messages.memberdetail.visit_pastor') }}" />
                        </div>
                    </div>


                    {{-- Note --}}
                    <div class="form-group">
                        <label>{{ __('messages.memberdetail.history_memo') }}</label>
                        <textarea id="visit_memo" rows="6" class="form-control" placeholder="{{ __('messages.memberdetail.visit_memo') }}"></textarea>
                    </div>

                    {{-- Buttons --}}
                    <div class="form-group text-right">
                        <button type="submit" id = "btnMemberVisitSave" class="btn">{{ __('messages.common.save') }}</button>
                        <button type="button" class="btn" data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>