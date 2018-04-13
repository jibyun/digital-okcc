<div class="modal fade" id="delete-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">Delete Category</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <div class="container" id="deleteBody">
                <div class="row">
                        <div class="col-sm-3 text-right">User Name</div>
                        <div class="col-sm-9"><label name="name"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 text-right">Email</div>
                        <div class="col-sm-9"><label name="email"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 text-right">Member</div>
                        <div class="col-sm-9"><label name="member_name"></label> (<label name="member_id"></label>)</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 text-right">Privilege</div>
                        <div class="col-sm-9"><label name="privilege_name"></label> (<label name="privilege_id"></label>)</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 text-right">
                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><span class="fa fa-times"></span> Cancel</button>
                            <button type="button" class="btn crud-delete btn-danger"><span class="fa fa-thumbs-o-down"></span> Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>