
// Javascript for MemberList

var sideMenuTree;
var categoryUrl = 'okcc/memberList/categories';
var searchUrl = 'okcc/memberList/search';
var memberListUrl = 'okcc/memberList/memberList';

$(document).ready(function () {

    var onSuccessFunc = function (response) {
        sideMenuTree.render(response.data);
        sideMenuTree.expandAll();
    };
    
    sideMenuTree = $('#sideMenu').tree({
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