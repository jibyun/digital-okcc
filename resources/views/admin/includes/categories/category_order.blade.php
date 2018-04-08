<div class="modal fade" id="make-order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="myModalLabel">
                <label class="modal-title h6-font-size" style="font-weight: 600">Make Display Order</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0e0e0;">
                <div class="container text-center">
                    {{ }}
                    <table id='workTable' class="table table-bordered pagin-table">
                        <thead>
                            <tr>
                                <th width="50px">No</th>
                                <th>Name</th>
                                <th width="220px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Hardik Savani</td>
                                <td><a href="" class="btn btn-danger">Delete</a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Rajesh Savani</td>
                                <td><a href="" class="btn btn-danger">Delete</a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Haresh Patel</td>
                                <td><a href="" class="btn btn-danger">Delete</a></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Vimal Patel</td>
                                <td><a href="" class="btn btn-danger">Delete</a></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Harshad Pathak</td>
                                <td><a href="" class="btn btn-danger">Delete</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{-- Buttons --}}
                <div class="form-group text-right">
                    <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><span class="fa fa-times"></span> Cancel</button>
                    <button type="submit" class="btn crud-update btn-info"><span class="fa fa-check"></span> Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>