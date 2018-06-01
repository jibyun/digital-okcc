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

    // Display the Admin page
    if (hasRole("ADMIN_ACCESS_ROLE") === true) {
        $('#userDropdownMenu').prepend($('<a href="admin" class="dropdown-item">' + 
                                        '<i class="fa fa-cog fa-lg mr-2"></i>' + i18n.messages.top_menu.admin + '</a>'));
    }

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

// This is toastr options.  The positionClass doesn't work.
toastr.options.progressBar = false;
toastr.options.timeOut = 3000; // How long the toast will display without user interaction
toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it

function hasRole(roleName) {
    if(typeof USER_ROLES !== 'undefined' !== undefined && USER_ROLES.includes(roleName) === true) {
        return true;
    } else {
        return false;
    }
}

/**
 * Call Restful API
 * @param {*} url  url 
 * @param {*} method method type
 * @param {*} param params
 * @param {*} successFunc success function
 * @param {*} failureFunc failure function
 */
function restApiCall(url, method, param, successFunc, failureFunc) {
    if (failureFunc == null) {
        failureFunc = restCallFailureHandler;
    }
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        url: url,
        type: method,
        // At this moment, we set "json" as default
        datatype: "json",
        data: param,
        success: successFunc,
        error: failureFunc
    });
}

/**
 * 
 * @param {*} response 
 * @param {*} status 
 * @param {*} err 
 */
function restCallFailureHandler(response, status, err) {
    // TOOD: Message handling.
    switch (response.status) {
        case 404:
            toastr.error( response.responseJSON.data, 'Not Found' );
            break;
        case 403:
            break;
        case 400:
            toastr.error( response.responseJSON.data, 'Bad Request' );
            break;
        default:
            toastr.error( response.responseJSON.data, 'Internal Error' );
            break;
    }
}

function showConfirmMessage(title, message, buttonTitle, handler) {
    $('#confirmDialog_Title').text(title);
    $('#confirmDialog_Message').text(message);
    $('#confirmDialog_btn').text(buttonTitle);
    $('#confirmDialog_btn').on('click', handler);
    $('#confirmDialog').modal('show');
}

// Contact Email Modal -----------------------
$('.contact-email').on( 'click', function(e) {
    $("#contact-email").modal('show').draggable({ handle: ".modal-header" });
});

$(".contact-email-ok").on( 'click', function(e) {
    e.preventDefault();
    const formId = $("#contactForm");
    const formAction = formId.attr("action");
    const postData = { 
        'full_name': formId.find("input[name='full-name']").val(),
        'email': formId.find("input[name='email']").val(),
        'content': formId.find("textarea[name='content']").val(), 
    };
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({ dataType: 'json', timeout: 3000, method:'POST', data: postData, url: formAction })
    .done ( function(data) {
        if (data.code == 'validation') {
            validationMessage( data.errors );
        } else if (data.code == 'exception') {
            exceptionMessage( data.status, data.errors );
        } else {
            sendSuccessMessage();
            formId[0].reset(); // Clear create form 
            $(".modal").modal('hide'); // hide model form
        }
    })
    .fail ( function(jqXHR, textStatus, errorThrown) { 
        errorMessage( jqXHR );
    });
});
// End of Contact Email Modal