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

toastr.options.timeOut = 2500; // How long the toast will display without user interaction
toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it
toastr.options.closeButton = true;

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

function errorMessage( jqXHR ) { // jqXHR.status, jqXHR.statusText, jqXHR.responseText
    toastr.error( i18n.messages.adm_message.request + jqXHR.status + '<br/>' + i18n.messages.adm_message.status_text + jqXHR.statusText, i18n.messages.adm_message.fail_title ).attr('style', 'width: 500px !important');
}

function validationMessage( errors ) {
    var message = '';
    for (var i=0; i < errors.length; i++) {
        message += errors[i] + ( i < errors.length -1 ? '<br/>' : '' );
    } 
    toastr.error( message, i18n.messages.adm_message.fail_title ).attr('style', 'width: 500px !important');
}

function exceptionMessage( status, errors ) {
    toastr.error( i18n.messages.adm_message.exception + status + '<br/>' + i18n.messages.adm_message.status_text + errors, i18n.messages.adm_message.fail_title ).attr('style', 'width: 500px !important');
}

function saveErrorMessage() {
    toastr.error( i18n.messages.adm_message.save_error, i18n.messages.adm_message.fail_title ).attr('style', 'width: 500px !important');
}

function nomoreDataMessage() {
    toastr.warning( i18n.messages.adm_message.nomore_add, i18n.messages.adm_message.warn_title ).attr('style', 'width: 500px !important');
}

function nomoreDeleteMessage() {
    toastr.error( i18n.messages.adm_message.nomore_delete, i18n.messages.adm_message.fail_title ).attr('style', 'width: 500px !important');
}

function selectMemberMessage() {
    toastr.warning( i18n.messages.adm_message.select_member, i18n.messages.adm_message.warn_title ).attr('style', 'width: 500px !important');
}

function saveSuccessMessage() {
    toastr.success( i18n.messages.adm_message.save_success, i18n.messages.adm_message.success_title ).attr('style', 'width: 500px !important');
}

function sendSuccessMessage() {
    toastr.success( i18n.messages.adm_message.send_success, i18n.messages.adm_message.success_title ).attr('style', 'width: 500px !important');
}

function deleteSuccessMessage() {
    toastr.success( i18n.messages.adm_message.delete_success, i18n.messages.adm_message.success_title ).attr('style', 'width: 500px !important');
}

function orderSuccessMessage() {
    toastr.success( i18n.messages.adm_message.arrange_success, i18n.messages.adm_message.success_title ).attr('style', 'width: 500px !important');
}

function orderErrorMessage() {
    toastr.error( i18n.messages.adm_message.arrange_error, i18n.messages.adm_message.fail_title ).attr('style', 'width: 500px !important');
}
