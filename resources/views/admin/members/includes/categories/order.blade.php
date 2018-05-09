<div class="modal fade" id="make-order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">{{ __('messages.adm_title.order') }}</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <div class="container text-center">
                    <table id='workTable' class="table table-dark table-bordered table-striped table-sm s1-font-size">
                        <thead>
                            <tr>
                                <th width="80px">{{ __('messages.adm_table.order') }}</th>
                                <th>{{ __('messages.adm_table.category_name') }}</th>
                            </tr>
                        </thead>
                        <tbody id="workTbody">
                            {{-- will be put Dynamic Row in --}}
                        </tbody>
                    </table>
                </div>
                {{-- Buttons --}}
                <div class="form-group text-right">
                    <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><span class="fa fa-times mr-1"></span>{{ __('messages.adm_table.cancel_btn') }}</button>
                    <button type="submit" class="btn make-order btn-info mr-3"><span class="fa fa-check mr-1"></span>{{ __('messages.adm_table.save_btn') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>