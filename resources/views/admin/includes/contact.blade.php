<div class="modal fade" id="contact-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">@lang('messages.adm_title.contact')</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <form id="contactForm" class="px-3" action="{{ route('admin.send.contactemail') }}" method="post">
                    @csrf
                    {{--  Full name  --}}
                    <div class="form-group row">
                        <label for="full-name" class="col-sm-3 col-form-label text-right">@lang('messages.adm_table.full_name'): </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="full-name" name="full-name" placeholder="@lang('messages.adm_table.full_name')">
                        </div>
                    </div>
                    {{--  Email Address  --}}
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label text-right">@lang('messages.adm_table.email'): </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" placeholder="@lang('messages.adm_table.email')">
                        </div>
                    </div>
                    {{--  Message  --}}
                    <div class="form-group row">
                        <label for="content" class="col-sm-3 col-form-label text-right">@lang('messages.adm_table.message')</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="content" name="content" placeholder="@lang('messages.adm_table.message')" rows="8"></textarea>
                        </div>
                    </div>
                    {{-- Buttons --}}
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><span class="fa fa-times mr-1"></span>@lang('messages.adm_table.cancel_btn')</button>
                        <button type="button" class="btn contact-email-ok btn-info"><span class="fa fa-check mr-1"></span>@lang('messages.adm_table.send_btn')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>