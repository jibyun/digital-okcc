// Member Visit URL
var memberVisitUrl = 'okcc/memberList/memberVisit';

$( function() {
    // Create member Visit button click event handler
    $('#btnCreateVisit').on('click', createVisitBtnClickHandler);
    // Save member Visit button click event handler
    $('#btnMemberVisitSave').on('click', saveVisitBtnClickHandler);
    // Visit table cell click handler
    $('#visit_table').on('click-cell.bs.table', visitTableCellClickHandler);
    // Visit table cell click handler
    $('#visit_table').on('click-row.bs.table', visitTableRowClickHandler);
    $('#visit_title').on('input', visitValidationInputHandler);
    $('#visit_visited_at').on('input', visitValidationInputHandler);
    
    $('#visit_visited_at').datetimepicker({ format: 'YYYY-MM-DD' });

});
  
function fillVisit(visits){
    var table = $('#visit_table');
    var tableColumn = [{
        field: 'visited_at',
        width: '15%',
        title: i18n.messages.memberdetail.visit_visited_at
    }, {
        field: 'title',
        title: i18n.messages.memberdetail.visit_title,
        formatter: "titleFormatter"
    }];
    
    // TODO: need to change to true
    if (hasRole("MEMBER_VISIT_EDIT_ROLE") === false) {
        tableColumn.push({
            field: 'edit',
            width: '5%',
            searchable: false,
            formatter: "editFormatter"
         });
         tableColumn.push({
            field: 'delete',
            width: '5%',
            searchable: false,
            formatter: "deleteFormatter"
         });
    }

    table.bootstrapTable({
        columns: tableColumn,
        pagination: false,
        search: true,
        searchOnEnterKey: true,
        toolbar: '#member_visit_toolbar',
        detailView: true,
        detailFormatter: "detailViewFormatter"
    });

    table.bootstrapTable('load', visits);
}

// Set the column for edit button 
/**
 * Member Visit Edit column formatter
 * @param {*} value 
 * @param {*} row 
 * @param {*} index 
 */
function editFormatter(value, row, index) {
    var html = [];
    html.push('<a href="#">' + i18n.messages.memberdetail.visit_edit + '</a>');
    return html.join('');
}

// Set the column for delete button 
/**
 * Member Visit Edit column formatter
 * @param {*} value 
 * @param {*} row 
 * @param {*} index 
 */
function deleteFormatter(value, row, index) {
    var html = [];
    html.push('<a href="#">' + i18n.messages.memberdetail.visit_delete + '</a>');
    return html.join('');
}

function titleFormatter(value, row, index) {
    //return i18n.messages.memberdetail.visit_delete;
    var html = [];
    html.push('<a href="#">' + value + '</a>');
    return html.join('');
}

function detailViewFormatter(index, rec) {
    var html = [];
    html.push(rec.memo);
    return html.join('');
}

/**
 * Visit table cell click handler
 */
function visitTableCellClickHandler(field, column, row, rec) {
    if (column === 'edit') {
        $('#visit_id').val(rec.id);
        $('#visit_memberId').val(currentMemberId);
        $('#visit_title').val(rec.title);
        $('#visit_started_at').val(rec.started_at);
        $('#visit_paster').val(rec.paster_visitation);
        $('#visit_memo').val(rec.memo);
        $('#visit_dialog_title').text(i18n.messages.memberdetail.visit_updatetitle);
        $('#btnMemberVisitSave').removeAttr('disabled');
        $('#memberVisitDialog').modal('show');
    } else if (column === 'delete') {
        $('#visit_id').val(rec.id);
        showConfirmMessage("Delete Member Visit", "Do you want to delete the item?", "Delete", visitDeleteHandler)
    }
}

function visitTableRowClickHandler(e, row, $tr, field) {
    var table = $('#visit_table');
    if (field === 'title') {
        if ($tr.next().is('tr.detail-view')) {
            table.bootstrapTable('collapseRow', $tr.data('index'));
        } else {
            table.bootstrapTable('expandRow', $tr.data('index'));
        }
    }
}

/**
 * Save Member Visit button handler.
 * It will handle both create/update
 * 
 */
function saveVisitBtnClickHandler(e) {
    var visitUrl = memberVisitUrl;
    e.preventDefault();

    var paramData = {
        member_id: currentMemberId,
        started_at: $('#visit_started_at').val(),
        paster_visitation: $('#visit_paster').val(),
        title: $('#visit_title').val(),
        memo: $('#visit_memo').val(),
        updated_by: USER_ID
    };

    var method = 'POST';
    // Check Create or Update
    var visit_id = $('#visit_id').val();
    if (visit_id.trim().length != 0) {
        method = "PUT";
        paramData.id = visit_id;
        visitUrl = memberVisitUrl + '/' + visit_id;
    }

    restApiCall(visitUrl, method, paramData, memberVisitSuccessHandler, null);
}

function memberVisitSuccessHandler(response) {
    $.unblockUI();
    $('#memberVisitDialog').modal('hide');
    toastr.success( response.data );
    resetVisitForm();
    reloadMemberVisit();
}

function visitDeleteHandler() {
    var visit_id = $('#visit_id').val();
    restApiCall(memberVisitUrl + '/' + visit_id, "DELETE", null, memberVisitSuccessHandler, null);
}

function reloadMemberVisit() {
    restApiCall(memberVisitUrl + '/' + currentMemberId, "GET", null, retrieveMemberVisitSuccessHandler, null);
}

function retrieveMemberVisitSuccessHandler(response) {
    $.unblockUI();
    var tableData = JSON.parse(response.data);
    var table = $('#visit_table');
    table.bootstrapTable('load', tableData.visit);
}

function createVisitBtnClickHandler(e) {
    $('#visit_dialog_title').text(i18n.messages.memberdetail.visit_createtitle);
    resetVisitForm();
}

function resetVisitForm() {
    $('#frmVisit')[0].reset();
    $('#visit_id').val('');
    $('#visit_memberId').val('');
    $('#btnMemberVisitSave').prop("disabled", true);
}

function visitValidationInputHandler () {
    var error = memberVisitValidation();
    if (error == true) {
        $('#btnMemberVisitSave').prop("disabled", true);
    } else {
        $('#btnMemberVisitSave').removeAttr('disabled');
    }
}

function memberVisitValidation() {
    var error_flag = false;
    // check title
    var title = $('#visit_title').val();
    var title_error = $('#visit_title_error');
	if (title.trim()) {
		title_error.removeClass("validation_error_show").addClass("validation_error");
    } else {
        title_error.removeClass("validation_error").addClass("validation_error_show");
        error_flag = true;
    }

    // check visit date
    var visited_at = $('#visit_visited_at').val();
    var visited_error = $('#visit_visited_error');
	if (visited_at.trim()) {
		visited_error.removeClass("validation_error_show").addClass("validation_error");
    } else {
        visited_error.removeClass("validation_error").addClass("validation_error_show");
        error_flag = true;
    }
    return error_flag;
}
