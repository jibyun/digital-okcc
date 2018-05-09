<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">Edit User</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <form id="editForm" class="px-3" action='' method="PUT">
                    @csrf
                    {{--  User name  --}}
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('messages.adm_table.user_name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('messages.adm_table.user_name') }}">
                        </div>
                    </div>
                    {{-- Email  --}}
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label text-right">{{ __('messages.adm_table.email') }}</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('messages.adm_table.email') }}">
                        </div>
                    </div>
                    {{-- Member  --}}
                    <div class="form-group row">
                        <label for="members" class="col-sm-3 col-form-label text-right">{{ __('messages.adm_table.member_name') }}</label>
                        <div class="col-sm-9">
                            <select id="editMemberCombo" class="form-control" name="members" data-placeholder="{{ __('messages.adm_table.select_member') }}">
                            </select>
                        </div>
                    </div>
                    {{-- Privilege  --}}
                    <div class="form-group row">
                        <label for="privileges" class="col-sm-3 col-form-label text-right">{{ __('messages.adm_table.privilege_name') }}</label>
                        <div class="col-sm-9">
                            <select id="editPrivilegeCombo" class="form-control" name="privileges" data-placeholder="{{ __('messages.adm_table.select_privilege') }}">
                            </select>
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