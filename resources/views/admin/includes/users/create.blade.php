<div class="modal fade" id="create-item" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">Register User</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <form id="createForm" class="px-3" action="{{ route('register') }}" method="post">
                    @csrf
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
                            <input id="memberId" hidden>
                            <input type="text" class="form-control autocomplete" id="membersCombo" name="members" placeholder="Members">
                        </div>
                    </div>
                    {{-- Privilege  --}}
                    <div class="form-group row">
                        <label for="privileges" class="col-sm-3 col-form-label text-right">Privilege</label>
                        <div class="col-sm-9">
                            <input id="privilegeId" hidden>
                            <input type="text" class="form-control autocomplete" id="privileges" name="privileges" placeholder="Privilege">
                        </div>
                    </div>
                    {{-- Buttons --}}
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><span class="fa fa-times"></span> Cancel</button>
                        <button type="submit" class="btn crud-register btn-info"><span class="fa fa-check"></span> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>