
$(document).ready( function () {
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

    // Hide Finance and Inventory menu as a default
    // TODO: Those are visible depends on the privilege
    $('#menu_finance').hide();
    $('#menu_inventory').hide();
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

toastr.options.progressBar = false;
toastr.options.timeOut = 3000; // How long the toast will display without user interaction
toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it

function errorMessage( jqXHR ) { // jqXHR.status, jqXHR.statusText, jqXHR.responseText
    toastr.error( 'Request Status: ' + jqXHR.status + '<br/> Status Text: ' + jqXHR.statusText, 'Failed!' );
}

function validationMessage( errors ) {
    var message = '';
    for (i=0; i < data.errors.length; i++) {
        message += data.errors[i] + ( i < data.errors.length -1 ? ' : ' : '' );
    } 
    toastr.error( message, 'Validation Failled!' );
}

function exceptionMessage( status, errors ) {
    toastr.error( 'Exception Status: ' + status + ' Status Text: ' + errors, 'Error Exception!' );
}

function saveSuccessMessage() {
    toastr.success( 'The item was successfully saved.', 'Saved!' );
}

function deleteSuccessMessage() {
    toastr.success( 'The item was successfully deleted.', 'Deleted!' );
}

function orderSuccessMessage() {
    toastr.success('Display order was successfully re-arranged.', 'Success');
}

function orderErrorMessage() {
    toastr.error( 'Fail to save data to server!', 'Failed!' );
}
