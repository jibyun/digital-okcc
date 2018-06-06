var memberUrl='okcc/member/getMember';
var codesURL = 'okcc/member/getCategory';
var memberEditUrl='okcc/member/edit';
var saveIndex; // Row index of the table
var currentMemberId; // Current member Id
var familyMember;
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
    $.unblockUI();
    current_member = JSON.parse(response.data);
    openShowPanel(current_member);   
    memberDetailSelectHandler();
    
}

function memberFamilyGetSuccess(response) {
    $.unblockUI();
    familyMember = JSON.parse(response.data);
    fillData("memberBasicInfoDialog",familyMember);  
    $('#memberBasicInfoDialog').modal('show');
    
    
}



function fillFamily(familys){
    
    $('#spanFamilys').children().remove();
    var otherFamilis=0;
    for(var i= 0; i < familys.length; i++) {
        var item = familys[i];
        var con=' '+otherFamilis>0?", ":"";

        if(item.id==currentMemberId) continue;
        otherFamilis++;
        $('#spanFamilys').append($('<a/>', {
            text: con+item.english_name+'('+item.relation_txt+')',
            style: "display:inline-block;color:blue;",
            id: 'family_' + item.id,
            onclick:'GetFamilyInfo('+item.id+');'
        }))
        
    }
  

}



function fillWork(departments){
   
    $('#spanWorks').children().remove();
        $('#spanWorks').append($('<span/>', {
            text: departments,
            style: "display:inline-block;"
         }));
}

function openShowPanel(member) {
   
    fillShowPanel(member);
    fillFamily(member.familys);
    fillHistory(member.member_histories);
    fillVisit(member.visits);
    fillWork(member.departments); 
}



function fillData(parentId,rec){
    var parentElement = $("#"+parentId);
    
    for(var item in rec)
    {
      parentElement.find("[name='"+item+"']").text(rec[item]);     
    }

}

function SubInfoView(id)
{
    $('#divVisit').hide();
    $('#divHistory').hide();
    $('#divBasic').hide();
    $('#'+id).show();
}

function GetMemberInfo(memberId)
{
    var url=memberUrl+"/"+memberId;
    restApiCall(url, "GET", null, memberGetSuccess, null);
    
}

function GetFamilyInfo(memberId)
{
    var url=memberUrl+"/"+memberId;
    restApiCall(url, "GET", null, memberFamilyGetSuccess, null);
    
}




