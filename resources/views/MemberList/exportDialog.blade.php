{{-- Export Dialog --}}
<div class="modal fade" id="exportDialog">
    <div class="modal-dialog">
        <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">Modal Heading</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="POST" action="{{ route('memberlist.export') }}">
            @csrf
            <!-- Modal body -->
            <div class="form-group modal-body">
                <input type="text" name="fileName" class="form-control" placeholder="Filename" >
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button id="btnExport" type="submit" class="btn btn-secondary" >Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
        
      </div>
    </div>
</div>