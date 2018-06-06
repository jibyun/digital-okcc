
// Javascript for MemberList

var sideMenuTree;
var currentTitle = '';
var currentSelectedCode = '';
var showMemberStatusCombo = false;
var allMemberCode = '0000';
var searchMemberCode = '9999';
var categoryUrl = 'okcc/memberList/categories';
var searchUrl = 'okcc/memberList/search';
var memberListUrl = 'okcc/memberList/memberList';
var memberListSettingsUrl = 'okcc/memberList/settings';
var memberListExportUrl = 'okcc/memberList/export';

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
    // Member Status Combobox change event handler
    $('#cmbMemberStatus').on('change', memberStatusComboChangeHandler);
    // Export button click event handler
    $('#btnExport').on('click', exportBtnClickHandler);
    // Save As Excel button click event handler
    $('#btnSaveAsExcel').on('click', saveAsExportBtnClickHandler);
    // Search button click event handler
    $("#btnSearch").on('click', searchBtnClickHandler);
    // Search Input keypress event handler
    $("#inputSearch").on('keypress', searchInputKeypressHandler);

    // This is override function
    gj.tree.methods.displayClickHandler = newDisplayClickHandler;
    

    // Show member category side bar as a default
    // TODO: move to function.
    $('#sideMenuCategory').show();
    $('#sideMenuProfile').hide();
    $('#sideMenuMemberDetail').hide();

    
    sideMenuTree = $('#sideMenuCategory').tree({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        dataSource: { url: categoryUrl, success: updateCategoryTree },
        icons: {
            expand: '<i class="fa fa-chevron-right"></i>',
            collapse: '<i class="fa fa-chevron-down"></i>'
        }
    });

    sideMenuTree.on('select', function (e, node, id) {
        var data = sideMenuTree.getDataById(id);
        treeSelectionChanged(id, data);
    });

    // Get LandingPage bookmark
    restApiCall(memberListSettingsUrl, "GET", null, settingsSuccess, null);
    showLandingContent();
});

/**
 * Update Tree
 * 
 * @param response JSON string contains category info
 */
function updateCategoryTree(response) {
    sideMenuTree.render(response.data);
    sideMenuTree.expandAll();
}

/**
 * Search Button Click event handler
 */
function searchBtnClickHandler() {
    searchMember($("#inputSearch").val());
}

/**
 * Search Input keypress event handler
 * 
 * @param {} e 
 */
function searchInputKeypressHandler(e) {
    if (e.which === 13) {
        $(this).attr("disabled", "disabled");
        searchMember($("#inputSearch").val());
        $(this).removeAttr("disabled");
    }
}


/**
 * Search member by given string
 * 
 * @param {string} searchString 
 */
function searchMember(searchString) {
    // Unselect tree, update title
    sideMenuTree.unselectAll();
    updateTitle($('#pageTitle'), i18n.messages.memberlist.search_result);
    var url = searchUrl + "/" + searchString;
    currentSelectedCode = searchMemberCode;
    showMemberStatusCombo = false;
    restApiCall(url, "GET", null, memberListSuccess, null);
}

function loadTable(code, url) {
    currentSelectedCode = code;
    restApiCall(url, "GET", null, memberListSuccess, null);
}

function memberListSuccess(response) {
    $.unblockUI();
    var tableData = JSON.parse(response.data);
    var table = $('#bt_table');
    table.bootstrapTable('load', tableData.members);
    // Update manager info
    $('#member_header_panel').text(tableData.managerInfo);
    showMainConent();
}

/**
 * Retrieve Settings Success handler
 */
function settingsSuccess(response) {
    $.unblockUI();
    var settingsData = JSON.parse(response.data);
    var bookmarkData = settingsData.bookmark;
    var columnInfoData = settingsData.columninfos;
    var memberStatusListData = settingsData.memberStatus;
    for (var i = 0; i < bookmarkData.length; i++) {
        var element = bookmarkData[i];
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

    // Set member status combo
    // Clear existing item
    $("#cmbMemberStatus").empty()
    // Add the empty(for all member)
    $('#cmbMemberStatus').append( new Option(i18n.messages.memberlist.allmember, allMemberCode));
    $.each(memberStatusListData, function(i, el) 
    { 
        $('#cmbMemberStatus').append( new Option(el.txt,el.id) );
    });

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
        showColumns: true,
        search: true,
        searchOnEnterKey: true,
        toolbar: '#member_table_toolbar',
    });
}

function updateTitle(obj, title) {
    obj.text(title);
    currentTitle = title;
}

function showLandingContent() {
    $('#MainContent').hide();
    $('#LandingContent').show();
}

function showMainConent() {
    $('#LandingContent').hide();
    $('#MainContent').show();
    $('#member_table_toolbar').show();
    if (showMemberStatusCombo === true) {
        $("#cmbMemberStatus").show();
    } else {
        $("#cmbMemberStatus").hide();
    }

    memberListViewHandler();
}

function treeSelectionChanged(id, data) {
    // Remove any string in search box and update title
    $("#inputSearch").val('')
    updateTitle($('#pageTitle'), data.text);
    // This is the special case for all member.
    if (data.code === allMemberCode) {
        showMemberStatusCombo = true;
        loadTable(allMemberCode, memberListUrl);
    } else {
        showMemberStatusCombo = false;
        loadTable(data.code, memberListUrl + "/" + data.code);
    }
}

function memberStatusComboChangeHandler() {
    var selectCode = this.value;
    if (selectCode === allMemberCode) {
        showMemberStatusCombo = true;
        loadTable(allMemberCode, memberListUrl);
    } else {
        showMemberStatusCombo = true;
        loadTable(selectCode, memberListUrl + "/" + selectCode);
    }
}

function exportBtnClickHandler(e) {
    e.preventDefault();
    var params = '';
    params += '?filename=' + $('#txtFileName').val();
    params += '&code=' + currentSelectedCode;
    params += '&search=' + $("#inputSearch").val();

    window.location.href = memberListExportUrl + params;
}

/**
 * Save As Export button click handler
 * Set the default filename in the input box
 */
function saveAsExportBtnClickHandler() {
    var d = new Date();
    var fileName = currentTitle.replace(' ', '_') + '_' + d.getFullYear() + d.getMonth() + d.getDay() + '_' +
                                                          d.getHours() + d.getMinutes() + d.getSeconds() + '.xlsx';
    $('#txtFileName').val(fileName);
}

function exportSuccess(response) {
    console.log(response);
}

function memberListViewHandler() {
    $('#sideMenuCategory').show();
    $('#sideMenuProfile').show();
    $('#sideMenuMemberDetail').hide();

    $('#divMainPanel').show();
    $('#divMemberDetailPanel').hide();
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

    $('#divMainPanel').hide();
    $('#divMemberDetailPanel').show();
    SubInfoView('divBasic');
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
    SubInfoView('divBasic');
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
    SubInfoView('divHistory');
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
    SubInfoView('divVisit');
}


/**
 * This is overriden function from bootstrap tree
 * It do not unselect when node is clicked again.
 * @param {tree control}  
 */
function newDisplayClickHandler($tree) {
    return function (e) {
        var $display = $(this),
            $node = $display.closest('li'),
            cascade = $tree.data().cascadeSelection;
        if ($node.attr('data-selected') === 'true') {
            //gj.tree.methods.unselect($tree, $node, cascade);
            // Do nothing.
        } else {
            var $nodeId = $node.data('id');
            var $nodeData = $tree.getDataById($nodeId);
            if ($nodeData.selectable === true) {
                if ($tree.data('selectionType') === 'single') {
                    gj.tree.methods.unselectAll($tree);
                }
                gj.tree.methods.select($tree, $node, cascade);
            }
        }
    }
}
