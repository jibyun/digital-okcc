
// Javascript for MemberList

var sideMenuTree;
var categoryUrl = 'okcc/memberList/categories';
var searchUrl = 'okcc/memberList/search';

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
        // TODO : Implement action.
        //console.log(AuthUser);
        loadTable("okcc/memberList/memberList");
        
    });

    // search button click
    $("#btnSearch").button().click(function(){
        var url = searchUrl + "/" + $("#inputSearch").val();
        restApiCall(url, "GET", null, memberListSuccess, null);
    });
    
    var table = $('#mainTable');
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
});

function loadTable(url) {
    restApiCall(url, "GET", null, memberListSuccess, null);
}

function memberListSuccess(response) {
    var tableData = JSON.parse(response.data);
    var table = $('#mainTable');
    table.bootstrapTable('load', tableData);
}