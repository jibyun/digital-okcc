var memberUrl='okcc/member/getMember';
var codesURL = 'okcc/member/getCategory';
var memberEditUrl='okcc/member/edit';
var saveIndex; // Row index of the table
var saveId; // Primary key of the table
var current_member;

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$( function() {

    $( "#tabs" ).tabs();

    // select box data setting
    var url=codesURL+ '?category_id[]=1&category_id[]=2&category_id[]=4&category_id[]=6&category_id[]=7&category_id[]=8';
    restApiCall(url, "GET",null,catesuccess , null);
    

    //Get member info by bt_table clicked
    $('#bt_table').on('click-cell.bs.table', function (field, column, row, rec) {

        saveId = Number(rec.id);
        var url=memberUrl+"/"+saveId;

      
        restApiCall(url, "GET", null, memberGetSuccess, null);
        
    });

    $('#bt_table').on('click-row.bs.table', function (e, row, $element) {
        saveIndex = $element.index();
    });

    // To List
    $("#ToListBtn").click(function(){
        memberListBackHandler();
    });
    

    // click edit button 
    $("#editMemberBtn").click(function(e){
        var url=memberUrl+"/"+saveId;
        restApiCall(url, "GET", null, editMemberGetSuccess, null);
       
       
    });

     // click close button on editpanel
    $("#cancelEditButton").click(function(e) {
        $("#showPanel").collapse("show");
        $("#editPanel").collapse("hide");
       
    });

    // click save button on editpanel
    $("#saveEditButton").click(function(e) {
        var url = memberEditUrl+'/'+saveId; 
            doPost(url, fillPostData());

    });

    // click delete button on showpanel
    $("#delMemberButton").click( function(e) {
        if(confirm("Do you delete this?"))
        {
             //To do delete
             
            $("#ToListBtn").click();
            $('#bt_table').bootstrapTable('remove', {field: 'id', values: [saveId]});
        }
       
    });
    
    $('#dob').datetimepicker({ format: 'YYYY-MM-DD' });
    $('#baptism_at').datetimepicker({ format: 'YYYY-MM-DD' });
    $('#register_at').datetimepicker({ format: 'YYYY-MM-DD' });

});
  

function fillShowPanel(rec) {
   fillData("showPanel",rec);
}

function fillEditPanel( rec ) {
    fillData("editForm",rec);
}

function memberGetSuccess(response) {
    
    current_member = JSON.parse(response.data);
    openShowPanel(current_member);   
    memberDetailSelectHandler();
}

function editMemberGetSuccess(response) {
    
    current_member = JSON.parse(response.data);
    fillEditPanel(current_member);
    $("#showPanel").collapse("hide");
    $("#editPanel").collapse("show");
}



function fillFamily(primarys){

    var familys=null;
    $('#tabs-1').children().remove();
    if(primarys.length>0)
    {
        familys=primarys[0].family_maps;
        for(var i= 0; i < familys.length; i++) {
            var item = familys[i];
            var parentid = 'family_' + i;
          
            $('#tabs-1').append($('<ul/>', {
                class: "list-unstyled",
                id: parentid
            }));

            $('#'+parentid).append($('<li/>', {
                text: item.member_by_child_id.english_name,
                style: "display:inline-block;width:20%",
                id: 'familyName_' + i
            })).append($('<li/>', {
                text: item.code_by_relation_id.txt,
                style: "display:inline-block;width:40%",
                id: 'relation_' + i
            }));
            
        }
    }
    else{
        $('#tabs-1').append($('<ul/>', {
        })).append($('<li/>', {
            text: 'There is no data.',
            style: "display:inline-block;width:100%"
        }));
    }
   
}

function fillHistory(historys){
    $('#tabs-2').children().remove();
    if(historys.length>0)
    {
        for(var i= 0; i < historys.length; i++) {
            var item = historys[i];
            var parentid = 'history_' + i;
          
            $('#tabs-2').append($('<ul/>', {
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
        $('#tabs-2').append($('<ul/>', {
        })).append($('<li/>', {
            text: 'There is no data.',
            style: "display:inline-block;width:100%"
        }));
    }
    
    
}

function fillVisit(visits){
    $('#tabs-3').children().remove();
    if(visits.length>0)
    {
        for(var i= 0; i < visits.length; i++) {
            var item = visits[i];
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
        $('#tabs-3').append($('<ul/>', {
        })).append($('<li/>', {
            text: 'There is no data.',
            style: "display:inline-block;width:100%"
        }));
    }
}

function fillWork(works){
    $('#tabs-4').children().remove();
    if(works.length>0)
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
    fillFamily(member.family_primary_map);
    fillHistory(member.member_histories);
    fillVisit(member.visits);
    // fillWork(member.work); 
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
      var selector=parentElement.find("[name='"+item+"']");
      if($(selector).is("span"))
        selector.text(rec[item]);
      else selector.val(rec[item]);

      if($(selector).is("select"))
      selector.trigger('chosen:updated');
      
    }

}

function fillPostData() {
    var form = $("#editForm");
        event.preventDefault();
      
        var result={};
        $.map(form.serializeArray(), function(n, i){
            result[n['name']] = n['value'];
        });
       
    return result;
}


function doPost(url, postData) {
   
    $.ajax({ dataType: 'json', method:'POST' ,data: postData, url: url, 
        success: function(data) {
            if (data.errors) {
                var message = '';
                if(data.errors.errorInfo && data.errors.errorInfo.length>2)
                    message = data.errors.errorInfo[2];
                
                toastr.error(message, data.message);
            } else {
                toastr.success(data.message, 'Success');
                fillShowPanel(data.member);
                $('#bt_table').bootstrapTable('updateRow', {index: saveIndex, row: data.member});
                

            }
        }
    });
}


