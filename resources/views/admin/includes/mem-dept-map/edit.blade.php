<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">{{ __('messages.adm_title.edit', ['name' => 'Volunteering']) }}</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <form id="editForm" class="px-3" action='' method="PUT">
                    @csrf
                    {{-- Department  --}}
                    <div class="form-group row">
                        <label for="departments" class="col-sm-3 col-form-label text-right">{{ __('messages.adm_table.dept_name') }}</label>
                        <div class="col-sm-9">
                            <select id="editDepartmentCombo" class="form-control" name="departments" data-placeholder="{{ __('messages.adm_table.select_department') }}">

                            </select>
                        </div>
                    </div>
                    {{-- Position  --}}
                    <div class="form-group row">
                        <label for="positions" class="col-sm-3 col-form-label text-right">{{ __('messages.adm_table.position_name') }}</label>
                        <div class="col-sm-9">
                            <select id="editPositionCombo" class="form-control" name="positions" data-placeholder="{{ __('messages.adm_table.select_position') }}">

                            </select>
                        </div>
                    </div>
                    {{--  Enabled  --}}
                    <div class="form-group row">
                        <label for="enabled" class="col-sm-3 col-form-label text-right">{{ __('messages.adm_table.enable') }}</label>
                        <div class="btn-group col-sm-9">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="enabled" id="enabled1" value="1" checked>{{ __('messages.adm_table.enable_input') }}
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="enabled" id="enabled2" value="0">{{ __('messages.adm_table.disable_input') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    {{--  Manager  --}}
                    <div class="form-group row">
                        <label for="manager" class="col-sm-3 col-form-label text-right">{{ __('messages.adm_table.manager') }}</label>
                        <div class="btn-group col-sm-9">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="manager" id="manager1" value="1" checked>{{ __('messages.adm_table.manager_input') }}
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="manager" id="manager2" value="0">{{ __('messages.adm_table.nomanager_input') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <div class="col-sm-3 text-right py-2">{{ __('messages.adm_table.updated_by_name') }}</div>
                        <div class="col-sm-8 rounded bg-light py-2" style="margin-left: 20px"><span class="align-middle" name="users"></span></div>
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