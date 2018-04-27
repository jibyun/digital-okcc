<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">{{ __('messages.adm_title.add', ['name' => 'Child Department']) }}</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <table  id="createTable" class="table table-dark table-bordered table-hover table-responsive-md table-striped px-3" 
                        data-side-pagination="client"
                        data-pagination="true" 
                        data-page-list="[5, 10, 25, 50, ALL]" 
                        data-click-to-select="true" 
                        data-row-style="addTableRowStyle">
                    <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true"></th>
                            <th data-field="id" data-visible="false">{{ __('messages.adm_table.id') }}</th>
                            <th data-field="txt" data-width="35%" >{{ __('messages.adm_table.code_name') }}</th>
                            <th data-field="memo">{{ __('messages.adm_table.memo') }}</th>
                        </tr>
                    </thead>
                </table>
                {{-- Buttons --}}
                <div class="form-group text-right py-3">
                    <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><span class="fa fa-times mr-1"></span>{{ __('messages.adm_table.cancel_btn') }}</button>
                    <button type="button" class="btn crud-submit btn-info"><span class="fa fa-check mr-1"></span>{{ __('messages.adm_table.save_btn') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>