<div class="modal fade" id="crop-item" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">{{ __('messages.adm_title.upload_photo') }}</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="upload-photo" style="width:100%"></div>
                    </div>
                    <div class="col-sm-12">
                        <input type="file" id="upload-file" class="form-control mb-2">
                        <button class="btn btn-success upload-result form-control"><i class="fa fa-upload mr-3" aria-hidden="true"></i>
                            {{ __('messages.adm_table.upload_btn') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>