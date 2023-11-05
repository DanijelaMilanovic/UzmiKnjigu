/**
 * helper skripta za responsive Formu
 */
jQuery(document).ready(function($) {
    $(document).ready(function() {
        $(window).resize(function() {
            if ($(window).width() < 769) {
                $(".line-box").appendTo($("form"));
                $(".social-media").appendTo($("form"));
            };
            if ($(window).width() > 769) {
                $(".line-box").appendTo($(".row"));
                $(".social-media").appendTo($(".row"));
            };
        });
    });
});
