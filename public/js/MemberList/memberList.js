
// Javascript for MemberList

var sideMenuTree;
var categoryUrl = 'okcc/memberList/categories';
var searchUrl = 'okcc/memberList/search';
var memberListUrl = 'okcc/memberList/memberList';

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
    showMainConent();
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