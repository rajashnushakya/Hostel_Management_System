$(document).ready(function(){
    $('.log-btn').click(function(){
        $('.log-status').addClass('wrong-entry');
       $('.alert').fadeIn(500);
       setTimeout( "$('.alert').fadeOut(1500);",3000 );
    });
    $('.form-control').keypress(function(){
        $('.log-status').removeClass('wrong-entry');
    });

});

document.addEventListener('DOMContentLoaded', function() {
    var closeLink = document.getElementById('closeLink');

    // Function to handle clicking the close icon
    function closeAndRedirect(event) {
        event.preventDefault(); // Prevent the default action of the link
        // Add any additional code here to close the current page or perform other actions

        // Redirect to the specified page after a delay (optional)
        setTimeout(function() {
            window.location.href = closeLink.getAttribute('href');
        }, 100); // Adjust the delay as needed
    }

    // Attach the event listener to the close icon
    closeLink.addEventListener('click', closeAndRedirect);
});
