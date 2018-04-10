@extends('admin.layouts.master')

@section('content')

<div class='container p-4'>
    <h4>Configure Privileges</h4>
    <div id="toolbar">
        <div class='form-inline'>
            <select id='privilegesCombo' class="form-group form-control mr-3">
            </select>
            <button id="pop" class="form-group form-control btn btn-secondary mr-2" type="button" data-placement="right" data-toggle="popover" data-trigger="focus" title="Describe" data-content="">
                <i class="fa fa-question" aria-hidden="true"></i>
            </button>
            <button class="form-group form-control btn btn-info mr-2" type="button" title="Add Roles" onclick="addRoles();">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add Roles
            </button>
            <button class="form-group btn btn-danger btn-modal-target mr-2" type="button" title="Clear All" onclick="clearAll();">
                <i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Clear All
            </button>                    
        </div>
    </div>

    <table  id="mainTable" class="table table-striped s1-font-size" 
            data-toolbar="#toolbar"
            data-side-pagination="client"
            data-search="true" 
            data-pagination="true" 
            data-page-list="[5, 10, 25, 50, 100, ALL]" 
            data-mobile-responsive="true" 
            data-click-to-select="true" 
            data-filter-control="true" 
            data-row-style="rowStyle">
        <thead>
            <tr>
                <th data-field="id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">Id</th>
                <th data-field="role_id" data-filter-control="select" data-sortable="false" scope="col" data-visible="false">Role Id</th>
                <th data-field="role_txt" data-width="20%" data-filter-control="select" data-sortable="true" scope="col">Role Name</th>
                <th data-field="role_memo" data-filter-control="select" data-sortable="true" scope="col">Memo</th>
                <th data-field="delete" data-width="3%" data-formatter="deleteFormatter" data-events="deleteEvents">DEL.</th>
            </tr>
        </thead>
    </table>

    @include('admin.includes.codes.create')
    @include('admin.includes.codes.edit')
    @include('admin.includes.codes.show')
    @include('admin.includes.codes.delete')
    @include('admin.includes.codes.order')

</div>
{{-- End Container --}}
@endsection

@section('scripts')
    <script type="text/javascript">
        // variables
        var $table = $('#mainTable');
        var $combo = $("#privilegesCombo");
        var privileges; // all items for combo box
        var currentPrivilegeId; // current selected id in combo box
        var privilegesRolesUrl = "{!! route('admin.p-role-map.index') !!}";
        var privilegesUrl = "{!! route('admin.privileges.index') !!}";



        var saveIndex; // Row index of the table
        var saveId; // Primary key of codes
        var maxOrder; // Max Order number
        var maxId; // Max Id: it must be need when create a code
        var codes; // cached codes
        var displayOrder; // display order using changing order
        
        // define toast options
        toastr.options.progressBar = true;
        toastr.options.timeOut = 5000; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it

        /* initialize Main table */

        // compute height of the table and return 
        function getHeight() {
            $(window).height() - $('h4').outerHeight(true); // table height
        }

        // Row Style of main table
        function rowStyle(row, index) {
            return {
                classes: 'font-weight-normal',
                css: { "color": "black", "padding": "0 10px" }
            };
        }

        // compose the column for delete button on the main table
        function deleteFormatter(value, row, index) {
            return [
                '<a href="#"><H5><span class="badge badge-danger"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></span></H5></a>'
            ].join('');
        }

        function initTable() {
            $table.bootstrapTable({
                height: getHeight(),
                columns: [ {},{},{},{}, { align: 'center', clickToSelect: false }]
            });
            $(window).resize(function () {
                $table.bootstrapTable('resetView', {
                    height: getHeight()
                });
            });
        }

        /* configure popover button */

        $("#pop").popover();
        function setPopover(index) {
            $('#pop').attr('title', privileges[index]['txt']);
            $('#pop').attr('data-content', privileges[index]['memo']); //TODO: change HTML
        }

        /* main processes */

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        function buildPrivilegesCombo() {
            var html = '';
            for (var i=0; i < privileges.length; i++) {
                html += '<option value="' + privileges[i]['id'] + '" ' + (i===0 ? 'selected' : '') + '>' + 
                    privileges[i]['txt'] + '</option>';
            }
            $combo.append(html);    
            
            // whenever change category combo 
            $combo.change( function () {
                $("select option:selected").each( function() {
                    currentPrivilegeId = $(this).val();
                    reloadList();
                    for (var i=0; i < privileges.length; i++) {
                        if (currentPrivilegeId == privileges[i]['id']) {
                            setPopover(i);
                            break;
                        }
                    }
                });
            }).click( function() {
                // make the combo only one selection is possible
                if ($('select option').length == 1) {
                    $('select').change();
                }
            });      
        }

        // Get list from server and fill combobox
        function getInitList() {
            initTable();
            $.ajax({
                dataType: 'json',
                url: privilegesUrl,
                success: function(data) { // What to do if we succeed
                    privileges = data['privileges'];
                    currentPrivilegeId = privileges[0]['id'];
                    setPopover(0);
                    buildPrivilegesCombo();
                    reloadList();
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error("can't get privilege data from server: " + JSON.stringify(jqXHR), Failed);
                }
            });
        }  

        // Reload data from server and refresh table
        function reloadList() {
            $.ajax({
                dataType: 'json',
                url: privilegesRolesUrl + '?privilege_id=' + currentPrivilegeId,
                success: function(data) { // What to do if we succeed
                    if (data['p_role_maps'].length > 0) {
                        $table.bootstrapTable( 'load', { data: data['p_role_maps'] } );
                    } else {
                        $table.bootstrapTable( 'removeAll' );
                    } 
                }, 
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    toastr.error("can't get data from server: " + JSON.stringify(jqXHR), 'Failed');
                }
            });
        } 

        getInitList();







        // Create 후 Submit 버튼을 눌렀다
        $(".crud-submit").click(function(e){
            e.preventDefault();
            var formId = $("#create-item");
            var form_action = formId.find("form").attr("action");

            var postData = { 
                id: maxId, 
                code_category_id: currentCategoryId, 
                txt: formId.find("input[name='txt']").val(), 
                kor_txt: formId.find("input[name='kor_txt']").val(), 
                order: maxOrder, 
                enabled: Number(formId.find("input[name='enable']:checked").val()), // 숫자 변화 꼭 해야 함 
                memo: CKEDITOR.instances['ckeditor-create'].getData(), 
                sysmetic: 0 
            };

            $.ajax({
                dataType: 'json',
                method:'POST',
                url: form_action,
                data: postData,
                success: function(data) {
                    if (data.errors) {
                        var message = '';
                        for (i=0; i < data.errors.length; i++) {
                            message += data.errors[i] + (i < data.errors.length -1 ? ' | ' : '');
                        } 
                        toastr.error(message, data.message);
                    } else {
                        toastr.success(data.message, 'Success');
                        $table.bootstrapTable("append", postData); // Add input data to table
                        $('#createForm')[0].reset(); // Clear create form 
                        CKEDITOR.instances['ckeditor-create'].setData(''); // clear textarea
                        $(".modal").modal('hide'); // hide model form
                        reloadList();
                    }
                }
            });
        });

        // Edit 후 Submit 버튼을 눌렀다
        $(".crud-update").click(function(e){
            e.preventDefault();
            var formId = $("#edit-item");
            var form_action = formId.find("form").attr("action");

            var postData = { 
                code_category_id: currentCategoryId, 
                txt: formId.find("input[name='txt']").val(), 
                kor_txt: formId.find("input[name='kor_txt']").val(), 
                order: formId.find("input[name='order']").val(), 
                enabled: Number(formId.find("input[name='enable']:checked").val()), // 숫자 변화 꼭 해야 함 
                memo: CKEDITOR.instances['ckeditor-edit'].getData(), 
                sysmetic: 0
            };

            $.ajax({
                dataType: 'json',
                method: 'PUT',
                url: form_action,
                data: postData,
                success: function(data) {
                    if (data.errors) {
                        var message = '';
                        for (i=0; i < data.errors.length; i++) {
                            message += data.errors[i] + (i < data.errors.length -1 ? ' | ' : '');
                        } 
                        toastr.error(message, data.message);
                    } else {
                        toastr.success(data.message, 'Success');
                        $table.bootstrapTable('updateRow', {index: saveIndex, row: postData});
                        $('#editForm')[0].reset(); // Clear create form 
                        CKEDITOR.instances['ckeditor-edit'].setData(''); // clear textarea
                        $(".modal").modal('hide'); // hide model form
                        reloadList();
                    }
                }
            });
        });

        // Delete 버튼을 눌렀다.
        $("body").on("click", ".crud-delete", function() {
            $.ajax({
                dataType: 'json',
                type:'delete',
                url: url + '/' + saveId,
                success: function(data) {
                    if (data.errors) {
                        toastr.error(data.errors, data.message);
                    } else {
                        toastr.success(data.message, 'Success');
                        $table.bootstrapTable('remove', {field: 'id', values: [saveId]});
                        $(".modal").modal('hide'); // hide model form
                        reloadList();
                    }
                }
            });
        });

        // 테이블의 Column을 클릭하면 발생하는 이벤트를 핸들한다.
        $table.on('click-cell.bs.table', function (field, column, row, rec) {
            saveId = Number(rec.id);
            if (column === 'edit') {
                var form = $("#edit-item");
                form.find("input[name='txt']").val(rec.txt);
                form.find("input[name='kor_txt']").val(rec.kor_txt);
                form.find("input[name='enable'][value='" + rec.enabled + "']").prop('checked', true);
                CKEDITOR.instances['ckeditor-edit'].setData(rec.memo);
                form.find("input[name='order']").val(rec.order);
                form.find("#editForm").attr("action", url + '/' + rec.id);
            } else if (column === 'delete') {
                var deleteId = $("#deleteBody");
                deleteId.find("label[name='txt']").text(rec.txt);
                deleteId.find("label[name='kor_txt']").text(rec.kor_txt);
                deleteId.find("label[name='category_id']").text($('#privilegesCombo').find('option:selected').val());
                deleteId.find("label[name='category_name']").text($('#privilegesCombo').find('option:selected').text());
                deleteId.find("label[name='memo']").html(rec.memo);
                deleteId.find("label[name='enable']").text( rec.enabled === 1 ? "Enabled" : "Disabled" );
                // Open Bootstrap Model without Button Click
                $("#delete-item").modal('show');
            } else {
                var showId = $("#showBody");
                showId.find("label[name='txt']").text(rec.txt);
                showId.find("label[name='kor_txt']").text(rec.kor_txt);
                showId.find("label[name='category_id']").text($('#privilegesCombo').find('option:selected').val());
                showId.find("label[name='category_name']").text($('#privilegesCombo').find('option:selected').text());
                showId.find("label[name='memo']").html(rec.memo);
                showId.find("label[name='enable']").text( rec.enabled === 1 ? "Enabled" : "Disabled" );
                // Open Bootstrap Model without Button Click
                $("#show-item").modal('show');
            }
        });

        // 테이블의 Row를 클릭하면 발생하는 이벤트를 핸들한다: Bootstrap Table에서 Index를 구하기 위한 유일한 방법(Maybe)
        $table.on('click-row.bs.table', function (e, row, $element) {
            saveIndex = $element.index();
        });
    </script>

    {{-- to implement make display order --}}
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        // give #workTable drag-and-drop feature
        $('#workTable').find('tbody').sortable();
        function showOrder() {
            $('#workTbody').load("{!! route('admin.code.getCodes') !!}", function() {
                displayOrder = '';
                $('#make-order').modal({show:true});
            });
        }
        
    </script>
@endsection