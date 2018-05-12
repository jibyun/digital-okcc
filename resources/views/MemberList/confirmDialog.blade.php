{{-- Export Dialog --}}
<div class="modal fade" id="confirmDialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h6 id="confirmDialog_Title" class="modal-title">{{ __('messages.common.confirmation') }}</h6>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
            <!-- Modal body -->
            <div class="form-group modal-body">
                <label id='confirmDialog_Message'></label>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button id="confirmDialog_btn" type="button" class="btn" data-dismiss="modal">
                    </button>
                <button type="button" class="btn" data-dismiss="modal">
                    {{ __('messages.common.cancel') }}</button>
            </div>
      </div>
    </div>
</div>