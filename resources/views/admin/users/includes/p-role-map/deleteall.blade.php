<div class="modal draggable fade" id="deleteall-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">{{ __('messages.adm_title.delete', ['name' => 'All Relation']) }}</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #303030; color: #ffcc00; font-size: 1.3em;">
                <div class="container col-sm-11" id="deleteBody">
                    {!! trans('messages.adm_table.confirm_mesg') !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><span class="fa fa-times mr-1"></span>{{ __('messages.adm_table.cancel_btn') }}</button>
                <button type="button" class="btn crud-all btn-danger"><span class="fa fa-thumbs-o-down mr-1"></span>{{ __('messages.adm_table.delete_btn') }}</button>
            </div>
        </div>
    </div>
</div>