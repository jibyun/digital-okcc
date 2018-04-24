<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">{{ __('messages.adm_title.edit', ['name' => 'Category']) }}</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <form id="editForm" class="px-3" action='' method="PUT">
                    @csrf
                    {{--  Category name  --}}
                    <div class="form-group row">
                        <label for="txt" class="col-sm-3 col-form-label text-right">{{ __('messages.adm_table.category_name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="txt" placeholder="{{ __('messages.adm_table.category_name') }}">
                        </div>
                    </div>
                    {{--  카테고리명  --}}
                    <div class="form-group row">
                        <label for="kor_txt" class="col-sm-3 col-form-label text-right">{{ __('messages.adm_table.category_kname') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kor_txt" placeholder="{{ __('messages.adm_table.category_kname') }}">
                        </div>
                    </div>
                    {{--  order: hidden  --}}
                    <div class="form-group row" style="display: none">
                        <label for="order" class="col-sm-3 col-form-label text-right">Diaplay Order</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="order" placeholder='Diaplay Order'>
                        </div>
                    </div>
                    {{--  Enabled  --}}
                    <div class="form-group row">
                        <label for="enable" class="col-sm-3 col-form-label text-right">{{ __('messages.adm_table.enable') }}</label>
                        <div class="btn-group col-sm-9">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="enable" id="enabled1" value="1" checked>{{ __('messages.adm_table.enable_input') }}
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="enable" id="enabled2" value="0">{{ __('messages.adm_table.disable_input') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    {{--  Field name  --}}
                    <div class="form-group row">
                        <label for="fieldName" class="col-sm-3 col-form-label text-right">{{ __('messages.adm_table.field_name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fieldName" name="fieldName" placeholder="{{ __('messages.adm_table.field_name') }}">
                        </div>
                    </div>
                    {{--  Remark  --}}
                    <div class="form-group row">
                        <label for="memo" class="col-sm-3 col-form-label text-right">{{ __('messages.adm_table.memo') }}</label>
                        <div class="col-sm-9">
                            <textarea id="ckeditor-edit" class="form-control" name="memo" placeholder="{{ __('messages.adm_table.memo') }}"></textarea>
                        </div>
                    </div>
                    {{-- Buttons --}}
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><span class="fa fa-times mr-1"></span>{{ __('messages.adm_table.cancel_btn') }}</button>
                        <button type="submit" class="btn crud-update btn-info"><span class="fa fa-check mr-1"></span>{{ __('messages.adm_table.save_btn') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>