
// Javascript for MemberList

var sideMenuTree;
var categoryUrl = 'okcc/memberList/categories';
var searchUrl = 'okcc/memberList/search';
var memberListUrl = 'okcc/memberList/memberList';
var memberListSettingsUrl = 'okcc/memberList/settings';

$(document).ready(function () {

    // Handler register
    // Member Details top menu click event handler
    $('#menu_member_detail').on('click', memberDetailSelectHandler);
    // Member Details basic info click event handler
    $('#menu_member_detail_basic').on('click', memberDetailBasicSelectHandler);
    // Member Details history click event handler
    $('#menu_member_detail_history').on('click', memberDetailHistorySelectHandler);
    // Member Details visit click event handler
    $('#menu_member_detail_visit').on('click', memberDetailVisitSelectHandler);

    // Show member category side bar as a default
    // TODO: move to function.
    $('#sideMenuCategory').show();
    $('#sideMenuProfile').hide();
    $('#sideMenuMemberDetail').hide();

    var onSuccessFunc = function (response) {
        sideMenuTree.render(response.data);
        sideMenuTree.expandAll();
    };
    
    sideMenuTree = $('#sideMenuCategory').tree({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        dataSource: { url: categoryUrl, success: onSuccessFunc },
        icons: {
            expand: '<i class="fa fa-chevron-right"></i>',
            collapse: '<i class="fa fa-chevron-down"></i>'
        }
    });

    sideMenuTree.on('select', function (e, node, id) {
        var data = sideMenuTree.getDataById(id);
        treeSelectionChanged(id, data);
    });

    // search button click
    $("#btnSearch").button().click(function(){
        searchMember($("#inputSearch").val());
    });

    // search button click
    $("#inputSearch").keypress(function(e) {
        if (e.which === 13) {
            $(this).attr("disabled", "disabled");
            searchMember($("#inputSearch").val());
            $(this).removeAttr("disabled");
        }
    });
    
    

    // Get LandingPage bookmark
    restApiCall(memberListSettingsUrl, "GET", null, settingsSuccess, null);
    showLandingContent();
});

/**
 * Member Detail menu select handler
 * It will hide all other side menus and show member details menu
 * @param {object} obj 
 */
function memberDetailSelectHandler(obj) {
    $('#sideMenuCategory').hide();
    $('#sideMenuProfile').hide();
    $('#sideMenuMemberDetail').show();
}

/**
 * Search member by given string
 * 
 * @param {string} searchString 
 */
function searchMember(searchString) {
    // TODO: Unselect tree, update title
    //updateTitle($('#pageTitle'), "Search Result");
    var url = searchUrl + "/" + searchString;
    restApiCall(url, "GET", null, memberListSuccess, null);
}

function loadTable(url) {
    restApiCall(url, "GET", null, memberListSuccess, null);
}

function memberListSuccess(response) {
    var tableData = JSON.parse(response.data);
    var table = $('#bt_table');
    table.bootstrapTable('load', tableData);
    showMainConent();
}

/**
 * Retrieve Settings Success handler
 */
function settingsSuccess(response) {
    var settingsData = JSON.parse(response.data);
    var bookmarkData = settingsData.bookmark;
    var columnInfoData = settingsData.columninfos;
    for (var i = 0; i < bookmarkData.length; i++) {
        var element = bookmarkData[i];
        console.log(element);
        $('#LandingContent').append($('<div/>', {
            text: element.text,
            class: "card-header p-2",
            id: 'bookmarkCard_' + element.code
        }));
        $('#LandingContent').append($('<div/>', {
            class: "card-body",
            id: 'bookmarkCardBody_' + element.code
        }));
        for(var j = 0; j < element.children.length; j++) {
            var item = element.children[j];
            var parentid = 'bookmarkCardBody_' + element.code;
            $('#'+parentid).append($('<button/>', {
                text: item.text,
                class: "btn btn-success m-3",
                id: 'bookmarkBtn_' + item.code,
                value: item.code,
                click: bookmarkBtnClickHandler
            }));
        }
    }

    initializeTable(columnInfoData);
}

function bookmarkBtnClickHandler(obj) {
    var btnObjText = document.getElementById(this.id).innerHTML;
    var btnObjValue =document.getElementById(this.id).value;
    var jsonString = '{"text": "' + btnObjText + '", "code":' + btnObjValue +'}';
    var data = JSON.parse(jsonString);
    treeSelectionChanged(this.id, data)
}

function initializeTable(columnInfo) {
    var table = $('#bt_table');
    table.bootstrapTable({
        //TODO: need to update column
        columns: columnInfo,
        pagination: true,
        pageSize: 10,
        showColumns: true
    });
}

function updateTitle(obj, title) {
    obj.text(title);
}

function showLandingContent() {
    $('#MainContent').hide();
    $('#LandingContent').show();
}

function showMainConent() {
    $('#LandingContent').hide();
    $('#MainContent').show();
}

function treeSelectionChanged(id, data) {
    updateTitle($('#pageTitle'), data.text);
    loadTable(memberListUrl + "/" + data.code);
}

/**
 * Member Detail menu select handler
 * It will hide all other side menus and show member details menu
 * @param {object} obj 
 */
function memberDetailSelectHandler(obj) {
    $('#sideMenuCategory').hide();
    $('#sideMenuProfile').hide();
    $('#sideMenuMemberDetail').show();
}

/**
 * It will show member detail main contents
 * and member basic info
 * 
 * @param {object} obj 
 */
function memberDetailBasicSelectHandler(obj) {
    $('#divMainPanel').hide();
    $('#divMemberDetailPanel').show();
}

/**
 * It will show member detail main contents
 * and member history info
 * 
 * @param {object} obj 
 */
function memberDetailHistorySelectHandler(obj) {
    $('#divMainPanel').hide();
    $('#divMemberDetailPanel').show();
}

/**
 * It will show member detail main contents
 * and member visit info
 * 
 * @param {object} obj 
 */
function memberDetailVisitSelectHandler(obj) {
    $('#divMainPanel').hide();
    $('#divMemberDetailPanel').show();
}