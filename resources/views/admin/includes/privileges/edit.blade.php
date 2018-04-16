<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">Edit Privilege</label>
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
                        {{--  Privilege name  --}}
                        <div class="form-group row">
                            <label for="txt" class="col-sm-3 col-form-label text-right">Privilege Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="txt" placeholder="Privilege Name">
                            </div>
                        </div>
                        {{--  Remark  --}}
                        <div class="form-group row">
                            <label for="memo" class="col-sm-3 col-form-label text-right">Remark</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="ckeditor-edit" name="memo" placeholder="Memo"></textarea>
                            </div>
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