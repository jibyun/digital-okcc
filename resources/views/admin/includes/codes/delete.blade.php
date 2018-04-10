<div class="modal fade" id="delete-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">Delete Code</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <div class="container" id="deleteBody">
                    <div class="row">
                        <div class="col-sm-3">Code Name</div>
                        <div class="col-sm-9"><label name="txt"></label> (<label name="kor_txt"></label>)</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">Category Name</div>
                        <div class="col-sm-9"><label name="category_name"></label> (<label name="category_id"></label>)</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">Menu Enabled</div>
                        <div class="col-sm-9"><label name="enable"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">Remark</div>
                        <div class="col-sm-9"><label name="memo"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-times"></span> Cancel</button>
                            <button type="button" class="btn crud-delete btn-danger"><span class="fa fa-thumbs-o-down"></span> Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>