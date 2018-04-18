<div class="modal fade" id="delete-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">Delete Mapping</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <div class="container col-sm-11" id="deleteBody">
                    <div class="row py-2">
                        <div class="col-sm-3 text-right py-2">Parent Member Name</div>
                        <div class="col-sm-9 rounded bg-light py-2"><span class="align-middle" name="parent_txt"></span></div>
                    </div>
                    <div class="row py-2">
                        <div class="col-sm-3 text-right py-2">Child Member Name</div>
                        <div class="col-sm-9 rounded bg-light py-2"><span class="align-middle" name="child_txt"></span></div>
                    </div>
                    <div class="row py-2">
                        <div class="col-sm-3 text-right py-2">Relation</div>
                        <div class="col-sm-9 rounded bg-light py-2"><span class="align-middle" name="relation"></span></div>
                    </div>
                    <div class="row py-3">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 text-right pr-0">
                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><span class="fa fa-times"></span> Cancel</button>
                            <button type="button" class="btn crud-delete btn-danger"><span class="fa fa-thumbs-o-down"></span> Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>