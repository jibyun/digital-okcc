<div class="modal fade" id="add-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">Add Roles</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <table  id="addTable" class="table table-dark table-bordered table-hover table-responsive-md table-striped" 
                        data-side-pagination="client"
                        data-pagination="true" 
                        data-page-list="[5, 10, 25, 50, 100, ALL]" 
                        data-mobile-responsive="true" 
                        data-click-to-select="true" 
                        data-filter-control="true" 
                        data-row-style="addTableRowStyle">
                    <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true"></th>
                            <th data-field="id" data-sortable="false" scope="col" data-visible="false">Id</th>
                            <th data-field="txt" data-width="35%" data-filter-control="select" data-sortable="false" scope="col">Role Name</th>
                            <th data-field="memo" data-sortable="false" scope="col" data-escape="true">Memo</th>
                        </tr>
                    </thead>
                </table>
                {{-- Buttons --}}
                <div class="form-group text-right py-3">
                    <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><span class="fa fa-times"></span> Cancel</button>
                    <button type="button" class="btn add-roles btn-info"><span class="fa fa-check"></span> Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>