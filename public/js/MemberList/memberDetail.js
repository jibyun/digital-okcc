var memberUrl='okcc/member/getMember';
var codesURL = 'okcc/member/getCategory';
var memberEditUrl='okcc/member/edit';
var saveIndex; // Row index of the table
var currentMemberId; // Current member Id
var current_member;

$( function() {
    $( "#tabs" ).tabs();

  
    //Get member info by bt_table clicked
    $('#bt_table').on('click-cell.bs.table', function (field, column, row, rec) {

        currentMemberId = Number(rec.id);
        GetMemberInfo(currentMemberId);
      
        
    });


    //Get member info by bt_table clicked
    $('#family_table').on('click-cell.bs.table', function (field, column, row, rec) {

        currentMemberId = Number(rec.id);
        GetMemberInfo(currentMemberId);
      
        
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
    var table = $('#family_table');
    var tableColumn = [{
        field: 'english_name',
        width: '20%',
        title: 'english_name',
        color:'blue'
    }, {
        field: 'relation_txt',
        width: '20%',
        title: 'relation'
    },{
        field: 'id',
        visible:false
    }];
    
   

    table.bootstrapTable({
        columns: tableColumn,
        pagination: false
                
    });

    table.bootstrapTable('load', familys);
}

function fillWork(works){
    var table = $('#work_table');
    var tableColumn = [{
        field: 'id',
        visible:false
    },{
        field: 'department_txt',
        width: '40%',
        title: 'Department',
        color:'blue'
    }, {
        field: 'code_by_position_id.txt',
        width: '40%',
        title: 'Position'
    },{
        field: 'is_manager_txt',
        width: '20%',
        title: 'IsManager'
    }];
    
   

    table.bootstrapTable({
        columns: tableColumn,
        pagination: false
                
    });

    table.bootstrapTable('load', works);
}

function openShowPanel(member) {
   
    fillShowPanel(member);
    fillFamily(member.familys);
    fillHistory(member.member_histories);
    fillVisit(member.visits);
    fillWork(member.member_department_maps); 
}



function fillData(parentId,rec){
    var parentElement = $("#"+parentId);
    
    for(var item in rec)
    {
      parentElement.find("[name='"+item+"']").text(rec[item]);     
    }

}

function GetMemberInfo(memberId)
{
    var url=memberUrl+"/"+memberId;
    restApiCall(url, "GET", null, memberGetSuccess, null);
    
}


