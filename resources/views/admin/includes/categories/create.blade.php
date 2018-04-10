<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">Create Category</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <form id="createForm" action="{{ route('admin.categories.store') }}" method="post">
                    @csrf
                    {{--  Category name  --}}
                    <div class="form-group row">
                        <label for="txt" class="col-sm-3 col-form-label text-right">Category Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="txt" name="txt" placeholder="Category Name">
                        </div>
                    </div>
                    {{--  카테고리명  --}}
                    <div class="form-group row">
                        <label for="kor_txt" class="col-sm-3 col-form-label text-right">카테고리명</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kor_txt" name="kor_txt" placeholder="카테고리명">
                        </div>
                    </div>
                    {{--  Enabled  --}}
                    <div class="form-group row">
                        <label for="enable" class="col-sm-3 col-form-label text-right">Menu Enabled</label>
                        <div class="btn-group col-sm-9">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="enable" id="enabled1" value="1" checked>Enable
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="enable" id="enabled2" value="0">Disable
                                </label>
                            </div>
                        </div>
                    </div>
                    {{--  Remark  --}}
                    <div class="form-group row">
                        <label for="memo" class="col-sm-3 col-form-label text-right">Remark</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="ckeditor-create" name="memo" placeholder="Memo"></textarea>
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