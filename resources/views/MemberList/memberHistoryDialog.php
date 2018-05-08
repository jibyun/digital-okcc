
<div class="modal fade" id="memberHistoryDialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title">{{ __('messages.memberlist.savetoexcel') }}</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="frmHistory">
                    @csrf
                    <div class="form-group row">
                        <label>{{ __('messages.memberlist.history_title') }}</label>
                        <input type="text" class="form-control" id="txt" placeholder="Title">
                    </div>
                    <div class="form-group row">
                        <label>detail</label>
                        <textarea class="form-control" placeholder="Details"></textarea>
                    </div>
                    {{-- Buttons --}}
                    <div class="form-group text-right">
                        <button type="submit" class="btn">ok</button>
                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>