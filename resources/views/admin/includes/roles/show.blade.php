<div class="modal fade" id="show-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">{{ __('messages.adm_title.show', ['name' => 'Role']) }}</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <div class="container col-sm-11" id="showBody">
                    @include('admin.includes.roles.disp')
                    <div class="row py-3">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 text-right pr-0"><button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <span class="fa fa-times mr-1"></span>{{ __('messages.adm_table.close_btn') }}</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>