
// Javascript for MemberList

var sideMenuTree;
var categoryUrl = 'api/okcc/memberList/categories';

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
        loadTable("api/okcc/memberList/memberList");
        
    });
});

function loadTable(url) {
    restApiCall(url, "GET", null, memberListSuccess, null);
}

function memberListSuccess(response) {
    var tableData = JSON.parse(response.data);
    var table = $('#mainTable');
    table.bootstrapTable({
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
        data: tableData,
        pagination: true,
        pageSize: 10
    });
}