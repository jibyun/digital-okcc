<div class="modal fade" id="add-item" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">{{ __('messages.adm_title.add', ['name' => 'Relation']) }}</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <form id="addForm" class="px-3" action="{{ route('admin.family-trees.store') }}" method="post">
                    @csrf
                    {{-- Member  --}}
                    <div class="form-group row">
                        <label for="members" class="col-sm-3 col-form-label text-right">{{ __('messages.adm_table.member_name') }}</label>
                        <div class="col-sm-9">
                            <select id="addMemberCombo" class="form-control" name="members" data-placeholder="{{ __('messages.adm_table.select_member') }}">

                            </select>
                        </div>
                    </div>
                    {{-- Relation  --}}
                    <div class="form-group row">
                        <label for="relations" class="col-sm-3 col-form-label text-right">{{ __('messages.adm_table.relation_name') }}</label>
                        <div class="col-sm-9">
                            <select id="addRelationCombo" class="form-control" name="relations" data-placeholder="{{ __('messages.adm_table.select_relation') }}">

                            </select>
                        </div>
                    </div>
                    {{-- Buttons --}}
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><span class="fa fa-times mr-1"></span>{{ __('messages.adm_table.cancel_btn') }}</button>
                        <button type="submit" class="btn crud-submit btn-info"><span class="fa fa-check mr-1"></span>{{ __('messages.adm_table.save_btn') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>