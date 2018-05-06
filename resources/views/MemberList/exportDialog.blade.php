{{-- Export Dialog --}}
<div class="modal fade" id="exportDialog">
    <div class="modal-dialog">
        <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
            <h6 class="modal-title">{{ __('messages.memberlist.savetoexcel') }}</h6>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
            <!-- Modal body -->
            <div class="form-group modal-body">
                <label>{{ __('messages.memberlist.filename') }}</label>
                <input id="txtFileName" type="text" name="fileName" class="form-control" >
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button id="btnExport" type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('messages.memberlist.save') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('messages.memberlist.cancel') }}</button>
            </div>
      </div>
    </div>
</div>