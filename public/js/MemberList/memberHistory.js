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
    // TODO:validation check

    var paramData = {
        member_id: currentMemberId,
        started_at: $('#history_started_at').val(),
        finished_at: $('#history_finished_at').val(),
        title: $('#history_title').val(),
        memo: $('#history_memo').val(),
        // TODO update real user id
        updated_by: 1
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
    var tableData = JSON.parse(response.data);
    var table = $('#history_table');
    table.bootstrapTable('load', tableData.history);
}

function createHistoryBtnClickHandler(e) {
    resetHistoryForm();
}

function resetHistoryForm() {
    $('#frmHistory')[0].reset();
    $('#history_id').val('');
    $('#history_memberId').val('');
}

