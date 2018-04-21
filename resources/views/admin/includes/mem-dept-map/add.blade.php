<div class="modal fade" id="add-item" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">Create Work History</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <form id="addForm" class="px-3" action="{{ route('admin.member-dept-trees.store') }}" method="post">
                    @csrf
                    {{-- Department  --}}
                    <div class="form-group row">
                        <label for="departments" class="col-sm-3 col-form-label text-right">Department</label>
                        <div class="col-sm-9">
                            <select id="addDepartmentCombo" class="form-control" name="departments" data-placeholder="Select a Department">

                            </select>
                        </div>
                    </div>
                    {{-- Position  --}}
                    <div class="form-group row">
                        <label for="positions" class="col-sm-3 col-form-label text-right">Position</label>
                        <div class="col-sm-9">
                            <select id="addPositionCombo" class="form-control" name="positions" data-placeholder="Select a Position">

                            </select>
                        </div>
                    </div>
                    {{-- Start Date --}}
                    <div class="form-group row">
                        <label for="started_at" class="col-sm-3 col-form-label text-right">Start Date</label>
                        <div class="input-group date col-sm-9" id="addStartDate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#addStartDate" name="started_at" placeholder="YYYY-MM-DD" />
                            <div class="input-group-append" data-target="#addStartDate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    {{-- End Date --}}
                    <div class="form-group row">
                        <label for="finished_at" class="col-sm-3 col-form-label text-right">End Date</label>
                        <div class="input-group date col-sm-9" id="addEndDate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#addEndDate" name="finished_at" placeholder="YYYY-MM-DD" />
                            <div class="input-group-append" data-target="#addEndDate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    {{--  Enabled  --}}
                    <div class="form-group row">
                        <label for="enabled" class="col-sm-3 col-form-label text-right">Enabled</label>
                        <div class="btn-group col-sm-9">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="enabled" id="enabled1" value="1" checked>Enable
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="enabled" id="enabled2" value="0">Disable
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <div class="col-sm-3 text-right py-2">Updated By</div>
                        <div class="col-sm-8 rounded bg-light py-2" style="margin-left: 20px"><span class="align-middle" name="users"></span></div>
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