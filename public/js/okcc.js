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
        // TODO: hide it in admin page
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

function menuSuccess(data, textStatus) {
    $.unblockUI();
    const $top = $("#topMenu");
    $.each( data.menu, function ( index, top ) {
        $top.append( getTopMenuItem( top.key, top.data[0] ) ); // create TOP menu of header
    });
    // toggle sidebar when button clicked
    $('.sidebar-toggle').on('click', function () {
        $('.sidebar').toggleClass('toggled');
    });
}

function menuFailure(jqXHR, textStatus, errorThrown) {
    $.unblockUI();
    errorMessage( jqXHR );
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
    $.blockUI({message: ''});
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        url: url,
        type: method,
        timeout: 1200,
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
    $.unblockUI();
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

function getTopMenuItem(key, itemData) {
    if(typeof USER_ROLES !== 'undefined' !== undefined && USER_ROLES.includes(itemData.roles) === true) {
        const item = $("<li class='nav-item rounded px-2'>").append(
            $("<a>", {
                'class': 'nav-link',
                'href': (itemData.route) ? itemData.route : '#' + itemData.text,
                'html': itemData.text,
            })
        );
        item.attr('name', key);
        if (hasLocation(key)) { 
            item.addClass( 'active' ); 
            // Create Side menu
            const $sidemenu = $("#sidemenu");
            $sidemenu.append( getSideMenuItem( itemData ) ); // create TOP menu of header
        }
        return item;
    } else {
        return;
    }
};

function getSideMenuItem(itemData) {
    var item = $("<li>").append(
        $("<a>", {
            'href': itemData.sub_menu ? ('#' + itemData.text) : (itemData.route ? itemData.route : '#' + itemData.text),
            'html': '<i class="fa fa-fw ' + itemData.icon + ' mr-1"></i>' + itemData.text,
            'data-toggle': (itemData.sub_menu) ? 'collapse' : '',
        })
    );
    if ( itemData.sub_menu ) {
        var subList = $("<ul>").attr('id', itemData.text).attr('aria-expanded', false).addClass('list-unstyled collapse');
        itemData.isOpened ? subList.addClass('show') : '';
        $.each( itemData.sub_menu, function ( index, submenu ) {
            subList.append( getSideMenuItem( submenu ) );
        });
        item.append(subList);
    } else {
        if (itemData.route) {
            urlRoute = itemData.route.replace(/^https?:\/\//,'');
            urlPage = location.href.replace(/^https?:\/\//,'');
            if (urlRoute == urlPage) {
                item.addClass('active');
            }
        }
        if(!USER_ROLES.includes(itemData.roles)) {
            item.hide();
        }
    }
    return item;
};

function hasLocation($menuStr = '/') {
    return window.location.pathname.includes($menuStr);
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