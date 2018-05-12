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

toastr.options.progressBar = false;
toastr.options.timeOut = 3000; // How long the toast will display without user interaction
toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it

function errorMessage( jqXHR ) { // jqXHR.status, jqXHR.statusText, jqXHR.responseText
    toastr.error( i18n.messages.adm_message.request + jqXHR.status + '<br/>' + i18n.messages.adm_message.status_text + jqXHR.statusText, i18n.messages.adm_message.fail_title );
}

function validationMessage( errors ) {
    var message = '';
    for (var i=0; i < errors.length; i++) {
        message += errors[i] + ( i < errors.length -1 ? ' : ' : '' );
    } 
    toastr.error( message, i18n.messages.adm_message.fail_title );
}

function exceptionMessage( status, errors ) {
    toastr.error( i18n.messages.adm_message.exception + status + '<br/>' + i18n.messages.adm_message.status_text + errors, i18n.messages.adm_message.fail_title );
}

function saveErrorMessage() {
    toastr.error( i18n.messages.adm_message.save_error, i18n.messages.adm_message.fail_title );
}

function nomoreDataMessage() {
    toastr.warning( i18n.messages.adm_message.nomore_add, i18n.messages.adm_message.warn_title );
}

function nomoreDeleteMessage() {
    toastr.error( i18n.messages.adm_message.nomore_delete, i18n.messages.adm_message.fail_title );
}

function selectMemberMessage() {
    toastr.warning( i18n.messages.adm_message.select_member, i18n.messages.adm_message.warn_title );
}

function saveSuccessMessage() {
    toastr.success( i18n.messages.adm_message.save_success, i18n.messages.adm_message.success_title );
}

function deleteSuccessMessage() {
    toastr.success( i18n.messages.adm_message.delete_success, i18n.messages.adm_message.success_title );
}

function orderSuccessMessage() {
    toastr.success( i18n.messages.adm_message.arrange_success, i18n.messages.adm_message.success_title );
}

function orderErrorMessage() {
    toastr.error( i18n.messages.adm_message.arrange_error, i18n.messages.adm_message.fail_title );
}
