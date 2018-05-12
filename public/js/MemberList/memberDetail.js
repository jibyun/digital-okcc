var memberUrl='okcc/member/getMember';
var codesURL = 'okcc/member/getCategory';
var memberEditUrl='okcc/member/edit';
// Member History URL
var memberHistoryUrl = 'okcc/memberList/memberHistory';
var saveIndex; // Row index of the table
var currentMemberId; // Current member Id
var current_member;

$( function() {
    // Create member history button click event handler
    $('#btnCreateHistory').on('click', createHistoryBtnClickHandler);
    // Save member history button click event handler
    $('#btnMemberHistorySave').on('click', saveHistoryBtnClickHandler);
    // History table cell click handler
    $('#history_table').on('click-cell.bs.table', historyTableCellClickHandler);
    

    $( "#tabs" ).tabs();

    // select box data setting
    var url=codesURL+ '?category_id[]=1&category_id[]=2&category_id[]=4&category_id[]=6&category_id[]=7&category_id[]=8';
    restApiCall(url, "GET",null,catesuccess , null);
    

    //Get member info by bt_table clicked
    $('#bt_table').on('click-cell.bs.table', function (field, column, row, rec) {

        currentMemberId = Number(rec.id);
        var url=memberUrl+"/"+currentMemberId;

      
        restApiCall(url, "GET", null, memberGetSuccess, null);
        
    });

    $('#bt_table').on('click-row.bs.table', function (e, row, $element) {
        saveIndex = $element.index();
    });

    // To List
    $("#ToListBtn").click(function(){
        memberListViewHandler();
    });
    
    
    $('#dob').datetimepicker({ format: 'YYYY-MM-DD' });
    $('#baptism_at').datetimepicker({ format: 'YYYY-MM-DD' });
    $('#register_at').datetimepicker({ format: 'YYYY-MM-DD' });

    $('#history_started_at').datetimepicker({ format: 'YYYY-MM-DD' });
    $('#history_finished_at').datetimepicker({ format: 'YYYY-MM-DD' });

});
  

function fillShowPanel(rec) {
   fillData("showPanel",rec);
}



function memberGetSuccess(response) {
    
    current_member = JSON.parse(response.data);
    openShowPanel(current_member);   
    memberDetailSelectHandler();
}


function fillFamily(familys){

   
    $('#tabs-family').children().remove();
    if(familys!=null && familys.length>0)
    {
        for(var i= 0; i < familys.length; i++) {
            var item = familys[i];
            var parentid = 'family_' + i;
          
            $('#tabs-family').append($('<ul/>', {
                class: "list-unstyled",
                id: parentid
            }));

            $('#'+parentid).append($('<li/>', {
                text: item.english_name,
                style: "display:inline-block;width:20%",
                id: 'familyName_' + i
            })).append($('<li/>', {
                text: item.relation_txt,
                style: "display:inline-block;width:40%",
                id: 'relation_' + i
            }));
            
        }
    }
    else{
        $('#tabs-family').append($('<ul/>', {
        })).append($('<li/>', {
            text: 'There is no data.',
            style: "display:inline-block;width:100%"
        }));
    }
   
}

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
        title: i18n.messages.memberdetail.history_title
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
        toolbar: '#member_history_toolbar'
    });

    table.bootstrapTable('load', historys);
    /*$('#tabs-history').children().remove();
    if(historys.length>0)
    {
        for(var i= 0; i < historys.length; i++) {
            var item = historys[i];
            var parentid = 'history_' + i;
          
            $('#tabs-history').append($('<ul/>', {
                class: "list-unstyled",
                id: parentid
            }));
            $('#'+parentid).append($('<li/>', {
                text: item.started_at,
                style: "display:inline-block;width:20%",
                id: 'histroy_start_' + i
            })).append($('<li/>', {
                text: item.title,
                style: "display:inline-block;width:40%",
                id: 'history_title_' + i
            }));
        }
    }
    else{
        $('#tabs-history').append($('<ul/>', {
        })).append($('<li/>', {
            text: 'There is no data.',
            style: "display:inline-block;width:100%"
        }));
    }*/
}

// Set the column for edit button 
/**
 * Member History Edit column formatter
 * @param {*} value 
 * @param {*} row 
 * @param {*} index 
 */
function editFormatter(value, row, index) {
    return i18n.messages.memberdetail.history_edit;
}

// Set the column for delete button 
/**
 * Member History Edit column formatter
 * @param {*} value 
 * @param {*} row 
 * @param {*} index 
 */
function deleteFormatter(value, row, index) {
    return i18n.messages.memberdetail.history_delete;
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


function fillVisit(visits){
    $('#tabs-visit').children().remove();
    if(visits.length>0)
    {
        for(var i= 0; i < visits.length; i++) {
            var item = visits[i];
            var parentid = 'visit_' + i;
        
            $('#tabs-visit').append($('<ul/>', {
                class: "list-unstyled",
                id: parentid
            }));

            
            $('#'+parentid).append($('<li/>', {
                text: item.visited_at,
                style: "display:inline-block;width:20%",
                id: 'visit_start_' + i
            })).append($('<li/>', {
                text: item.title,
                style: "display:inline-block;width:40%",
                id: 'visit_title_' + i
            })).append($('<li/>', {
                text: item.user.name,
                style: "display:inline-block;width:20%",
                id: 'visit_user_name_' + i
            }));
        }
    }
    else{
        $('#tabs-visit').append($('<ul/>', {
        })).append($('<li/>', {
            text: 'There is no data.',
            style: "display:inline-block;width:100%"
        }));
    }
}

function fillWork(works){
    $('#tabs-4').children().remove();
    if(works!=null && works.length>0)
    {
        for(var i= 0; i < works.length; i++) {
            var item = works[i];
            var parentid = 'visit_' + i;
        
            $('#tabs-3').append($('<ul/>', {
                class: "list-unstyled",
                id: parentid
            }));

            $('#'+parentid).append($('<li/>', {
                text: item.visited_at,
                style: "display:inline-block;width:20%",
                id: 'visit_start_' + i
            })).append($('<li/>', {
                text: item.title,
                style: "display:inline-block;width:40%",
                id: 'visit_title_' + i
            })).append($('<li/>', {
                text: item.user.name,
                style: "display:inline-block;width:20%",
                id: 'visit_user_name_' + i
            }));
        }
    }
    else{
        $('#tabs-4').append($('<ul/>', {
        })).append($('<li/>', {
            text: 'There is no data.',
            style: "display:inline-block;width:100%"
        }));
    }
}
function openShowPanel(member) {
   
    fillShowPanel(member);
    fillFamily(member.familys);
    fillHistory(member.member_histories);
    fillVisit(member.visits);
    fillWork(member.work); 
}

function catesuccess(response) {
   
    var category = JSON.parse(response.data);
   
        fillCombo( $('#selectStatusCombo'), category[0].codes, "select" );
        fillCombo( $('#selectDutyCombo'), category[1].codes, "duty" );
        fillCombo( $('#selectLevelCombo'), category[2].codes, "level" );
        fillCombo( $('#selectCityCombo'), category[3].codes, "city" );
        fillCombo( $('#selectProvinceCombo'), category[4].codes, "province" );
        fillCombo( $('#selectCountryCombo'), category[5].codes, "country" );
    
}

function fillCombo($element, codeData, kind) {
    $element.empty();
    var html = '<option value=""></option>';
    $.each(codeData, function( index, codes ) {
        html += '<option value="' + codes['id'] + '">' + ( kind === 'province' ? codes['kor_txt'] + ' (' + codes['txt'] + ')' : codes['txt'] )  + '</option>';
    });
    $element.prepend(html);
    // The following options are available to pass into Chosen on instantiation.
    $element.chosen({
        case_sensitive_search: false,
        search_contains: true, // Setting this option to true allows matches starting from anywhere within a word. 
        no_results_text: "Oops, nothing found!",
        placeholder_text_single: "Please Select One!",
    });
}

function fillData(parentId,rec){
    var parentElement = $("#"+parentId);
    
    for(var item in rec)
    {
      parentElement.find("[name='"+item+"']").text(rec[item]);     
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

