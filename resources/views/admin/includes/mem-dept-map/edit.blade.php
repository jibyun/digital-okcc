<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">Edit Work History</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <form id="editForm" class="px-3" action='' method="PUT">
                    {{--  Method Spoofing: Always put below two lines for updating a form
                            HTML forms do not support PUT, PATCH or DELETE actions. So, when defining PUT, PATCH or  
                            DELETE routes that are called from an HTML form, you will need to add a hidden _method field to the form.  --}}
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {{-- Department  --}}
                    <div class="form-group row">
                        <label for="departments" class="col-sm-3 col-form-label text-right">Department</label>
                        <div class="col-sm-9">
                            <select id="editDepartmentCombo" class="form-control" name="departments" data-placeholder="Select a Department">

                            </select>
                        </div>
                    </div>
                    {{-- Position  --}}
                    <div class="form-group row">
                        <label for="positions" class="col-sm-3 col-form-label text-right">Position</label>
                        <div class="col-sm-9">
                            <select id="editPositionCombo" class="form-control" name="positions" data-placeholder="Select a Position">

                            </select>
                        </div>
                    </div>
                    {{-- Start Date --}}
                    <div class="form-group row">
                        <label for="started_at" class="col-sm-3 col-form-label text-right">Start Date</label>
                        <div class="input-group date col-sm-9" id="editStartDate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#editStartDate" name="started_at" placeholder="YYYY-MM-DD" />
                            <div class="input-group-append" data-target="#editStartDate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    {{-- End Date --}}
                    <div class="form-group row">
                        <label for="finished_at" class="col-sm-3 col-form-label text-right">End Date</label>
                        <div class="input-group date col-sm-9" id="editEndDate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#editEndDate" name="finished_at" placeholder="YYYY-MM-DD" />
                            <div class="input-group-append" data-target="#editEndDate" data-toggle="datetimepicker">
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
                        <button type="submit" class="btn crud-update btn-info"><span class="fa fa-check"></span> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>