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
                    {{--  Method Spoofing: Always put below two lines for updating a form
                            HTML forms do not support PUT, PATCH or DELETE actions. So, when defining PUT, PATCH or  
                            DELETE routes that are called from an HTML form, you will need to add a hidden _method field to the form.  --}}
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {{--  User name  --}}
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">User Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" placeholder="User Name">
                        </div>
                    </div>
                    {{-- Email  --}}
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label text-right">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                    </div>
                    {{-- Member  --}}
                    <div class="form-group row">
                        <label for="members" class="col-sm-3 col-form-label text-right">Members</label>
                        <div class="col-sm-9">
                            <select id="editMemberCombo" class="form-control" name="members" data-placeholder="Select Correct Member">
                            </select>
                        </div>
                    </div>
                    {{-- Privilege  --}}
                    <div class="form-group row">
                        <label for="privileges" class="col-sm-3 col-form-label text-right">Privileges</label>
                        <div class="col-sm-9">
                            <select id="editPrivilegeCombo" class="form-control" name="privileges" data-placeholder="Select Privilege">
                            </select>
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