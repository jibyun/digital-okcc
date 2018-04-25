$(document).ready(function () {
    // toggle sidebar when button clicked
    $('.sidebar-toggle').on('click', function () {
        $('.sidebar').toggleClass('toggled');
    });

    // auto-expand submenu if an item is active
    var active = $('.sidebar .active');

    if (active.length && active.parent('.collapse').length) {
        var parent = active.parent('.collapse');

        parent.prev('a').attr('aria-expanded', true);
        parent.addClass('show');
    }

    // TODO: Need to enhanced
    /*
    if(typeof USER_ROLES !== 'undefined' !== undefined && USER_ROLES.indexOf("FINANCE_ACCESS_ROLE") > -1) {
        $('#menu_finance').show();
    }
    if(typeof USER_ROLES !== 'undefined' !== undefined && USER_ROLES.indexOf("INVENTORY_ACCESS_ROLE") > -1) {
        $('#menu_inventory').show();
    }*/
});

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("topButton").style.display = "block";
    } else {
        document.getElementById("topButton").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

/**
 * Call Restful API
 * @param {*} url  url 
 * @param {*} method method type
 * @param {*} param params
 * @param {*} successFunc success function
 * @param {*} failureFunc failure function
 */
function restApiCall(url, method, param, successFunc, failureFunc){
    $.ajax({
        url: url,
        type: method,
        // At this moment, we set "json" as default
        datatype: "json",
        param: param,
        success: successFunc,
        fail: failureFunc
    });
}