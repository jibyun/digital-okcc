
// Javascript for MemberList

var sideMenuTree;
var categoryUrl = 'okcc/memberList/categories';
var searchUrl = 'okcc/memberList/search';
var memberListUrl = 'okcc/memberList/memberList';
var memberListBookmarkUrl = 'okcc/memberList/bookmark';

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
        var url = searchUrl + "/" + $("#inputSearch").val();
        restApiCall(url, "GET", null, memberListSuccess, null);
    });
    
    var table = $('#mc_table');
    table.bootstrapTable({
        //TODO: need to update column
        columns: [{
            field: 'id',
            title: 'Item ID'
        }, {
            field: 'first_name',
            title: 'First Name'
        }, {
            field: 'kor_name',
            title: 'Korean Name'
        }, {
            field: 'address',
            title: 'Address'
        }],
        pagination: true,
        pageSize: 10
    });

    // Get LandingPage bookmark
    restApiCall(memberListBookmarkUrl, "GET", null, bookmarkSuccess, null);
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

function loadTable(url) {
    restApiCall(url, "GET", null, memberListSuccess, null);
}

function memberListSuccess(response) {
    var tableData = JSON.parse(response.data);
    var table = $('#mc_table');
    table.bootstrapTable('load', tableData);
}

/**
 * Retrieve Bookmark Success handler
 */
function bookmarkSuccess(response) {
    var bookmarkData = JSON.parse(response.data);
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
}

function bookmarkBtnClickHandler(obj) {
    var btnObjText = document.getElementById(this.id).innerHTML;
    var btnObjValue =document.getElementById(this.id).value;
    var jsonString = '{"text": "' + btnObjText + '", "code":' + btnObjValue +'}';
    var data = JSON.parse(jsonString);
    treeSelectionChanged(this.id, data)
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
    showMainConent();

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