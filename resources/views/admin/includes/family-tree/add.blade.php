<div class="modal fade" id="add-item" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">Create Relation</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <form id="addForm" class="px-3" action="{{ route('admin.family-trees.store') }}" method="post">
                    @csrf
                    {{-- Member  --}}
                    <div class="form-group row">
                        <label for="members" class="col-sm-3 col-form-label text-right">Members</label>
                        <div class="col-sm-9">
                            <select id="addMemberCombo" class="form-control" name="members" data-placeholder="Select Correct Member">

                            </select>
                        </div>
                    </div>
                    {{-- Relation  --}}
                    <div class="form-group row">
                        <label for="relations" class="col-sm-3 col-form-label text-right">Relation</label>
                        <div class="col-sm-9">
                            <select id="addRelationCombo" class="form-control" name="relations" data-placeholder="Select Relation">

                            </select>
                        </div>
                    </div>
                    {{-- Buttons --}}
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><span class="fa fa-times"></span> Cancel</button>
                        <button type="submit" class="btn crud-submit btn-info"><span class="fa fa-check"></span> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>