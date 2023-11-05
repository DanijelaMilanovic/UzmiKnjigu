$(document).ready(function() {
    $(document).on('click', '#navbarMain .nav-link', function () {

        console.log("REGISTRUJE");
        $('#navbarMain .nav-link').each(function() {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
    });
});