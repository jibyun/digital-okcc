// Member History URL
var memberHistoryUrl = 'okcc/memberList/memberHistory';

$( function() {
    // Create member history button click event handler
    $('#btnCreateHistory').on('click', createHistoryBtnClickHandler);
    // Save member history button click event handler
    $('#btnMemberHistorySave').on('click', saveHistoryBtnClickHandler);
    // History table cell click handler
    $('#history_table').on('click-cell.bs.table', historyTableCellClickHandler);
    // History table cell click handler
    $('#history_table').on('click-row.bs.table', historyTableRowClickHandler);
    $('#history_title').on('input', historyValidationInputHandler);
    $('#history_started_at').on('input', historyValidationInputHandler);
    $('#history_finished_at').on('input', historyValidationInputHandler);
    
    $('#history_started_at').datetimepicker({ format: 'YYYY-MM-DD' });
    $('#history_finished_at').datetimepicker({ format: 'YYYY-MM-DD' });
    

});
  
function fillHistory(historys){
    var table = $('#history_table');
    var tableColumn = [{
        field: 'started_at',
        width: '10%',
        title: i18n.messages.memberdetail.history_startdate
    }, {
        field: 'finished_at',
        width: '10%',
        title: i18n.messages.memberdetail.history_enddate
    }, {
        field: 'title',
        title: i18n.messages.memberdetail.history_title,
        formatter: "titleFormatter"
    }];
    
    // TODO: need to change to true
    if (hasRole("MEMBER_HISTORY_EDIT_ROLE") === false) {
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
        toolbar: '#member_history_toolbar',
        detailView: true,
        detailFormatter: "detailViewFormatter"
    });

    table.bootstrapTable('load', historys);
}

// Set the column for edit button 
/**
 * Member History Edit column formatter
 * @param {*} value 
 * @param {*} row 
 * @param {*} index 
 */
function editFormatter(value, row, index) {
    var html = [];
    html.push('<a href="#">' + i18n.messages.memberdetail.history_edit + '</a>');
    return html.join('');
}

// Set the column for delete button 
/**
 * Member History Edit column formatter
 * @param {*} value 
 * @param {*} row 
 * @param {*} index 
 */
function deleteFormatter(value, row, index) {
    var html = [];
    html.push('<a href="#">' + i18n.messages.memberdetail.history_delete + '</a>');
    return html.join('');
}

function titleFormatter(value, row, index) {
    //return i18n.messages.memberdetail.history_delete;
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
 * History table cell click handler
 */
function historyTableCellClickHandler(field, column, row, rec) {
    if (column === 'edit') {
        $('#history_id').val(rec.id);
        $('#history_memberId').val(currentMemberId);
        $('#history_title').val(rec.title);
        $('#history_started_at').val(rec.started_at);
        $('#history_finished_at').val(rec.finished_at);
        $('#history_memo').val(rec.memo);
        $('#history_dialog_title').text(i18n.messages.memberdetail.history_updatetitle);
        $('#btnMemberHistorySave').removeAttr('disabled');
        $('#memberHistoryDialog').modal('show');
    } else if (column === 'delete') {
        $('#history_id').val(rec.id);
        showConfirmMessage("Delete Member History", "Do you want to delete the item?", "Delete", historyDeleteHandler)
    }
}

function historyTableRowClickHandler(e, row, $tr, field) {
    var table = $('#history_table');
    if (field === 'title') {
        if ($tr.next().is('tr.detail-view')) {
            table.bootstrapTable('collapseRow', $tr.data('index'));
        } else {
            table.bootstrapTable('expandRow', $tr.data('index'));
        }
    }
}

/**
 * Save Member History button handler.
 * It will handle both create/update
 * 
 */
function saveHistoryBtnClickHandler(e) {
    var historyUrl = memberHistoryUrl;
    e.preventDefault();

    var paramData = {
        member_id: currentMemberId,
        started_at: $('#history_started_at').val(),
        finished_at: $('#history_finished_at').val(),
        title: $('#history_title').val(),
        memo: $('#history_memo').val(),
        updated_by: USER_ID
    };

    var method = 'POST';
    // Check Create or Update
    var history_id = $('#history_id').val();
    if (history_id.trim().length != 0) {
        method = "PUT";
        paramData.id = history_id;
        historyUrl = memberHistoryUrl + '/' + history_id;
    }

    restApiCall(historyUrl, method, paramData, memberHistorySuccessHandler, null);
}

function memberHistorySuccessHandler(response) {
    $.unblockUI();
    $('#memberHistoryDialog').modal('hide');
    toastr.success( response.data );
    resetHistoryForm();
    reloadMemberHistory();
}

function historyDeleteHandler() {
    var history_id = $('#history_id').val();
    restApiCall(memberHistoryUrl + '/' + history_id, "DELETE", null, memberHistorySuccessHandler, null);
}

function reloadMemberHistory() {
    restApiCall(memberHistoryUrl + '/' + currentMemberId, "GET", null, retrieveMemberHistorySuccessHandler, null);
}

function retrieveMemberHistorySuccessHandler(response) {
    $.unblockUI();
    var tableData = JSON.parse(response.data);
    var table = $('#history_table');
    table.bootstrapTable('load', tableData.history);
}

function createHistoryBtnClickHandler(e) {
    $('#history_dialog_title').text(i18n.messages.memberdetail.history_createtitle);
    resetHistoryForm();
}

function resetHistoryForm() {
    $('#frmHistory')[0].reset();
    $('#history_id').val('');
    $('#history_memberId').val('');
    $('#btnMemberHistorySave').prop("disabled", true);
}

function historyValidationInputHandler () {
    var error = memberHistoryValidation();
    if (error == true) {
        $('#btnMemberHistorySave').prop("disabled", true);
    } else {
        $('#btnMemberHistorySave').removeAttr('disabled');
    }
}

function memberHistoryValidation() {
    var error_flag = false;
    // check title
    var title = $('#history_title').val();
    var title_error = $('#history_title_error');
	if (title.trim()) {
		title_error.removeClass("validation_error_show").addClass("validation_error");
    } else {
        title_error.removeClass("validation_error").addClass("validation_error_show");
        error_flag = true;
    }

    // check start date
    var started_at = $('#history_started_at').val();
    var started_error = $('#history_startdate_error');
	if (started_at.trim()) {
		started_error.removeClass("validation_error_show").addClass("validation_error");
    } else {
        started_error.removeClass("validation_error").addClass("validation_error_show");
        error_flag = true;
    }

    // check finished date
    var finished_at = $('#history_finished_at').val();
    var finished_error = $('#history_finisheddate_error');
    var date_start = Date.parse(started_at);
    var date_finished = Date.parse(finished_at);
	if (!finished_at || date_start <= date_finished) {
		finished_error.removeClass("validation_error_show").addClass("validation_error");
    } else {
        finished_error.removeClass("validation_error").addClass("validation_error_show");
        error_flag = true;
    }

    return error_flag;
}

