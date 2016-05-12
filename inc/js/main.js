jQuery.noConflict();
jQuery(document).ready(function($) {
    /*
        Superfish menu
     */
    jQuery('ul.sf-menu').superfish({
        delay: 1000, // one second delay on mouseout
        animation: {
            opacity: 'show',
            height: 'show'
        }, // fade-in and slide-down animation
        speed: 'fast', // faster animation speed
        autoArrows: false // disable generation of arrow mark-up
    });


    /*
        Scroll to
     */
    jQuery("[data-scrollto]").click(function() {
        // extract id from data-scrollto
        var selector = jQuery(this).attr("data-scrollto");

        // scroll to id extracted from var selector
        jQuery('html, body').animate({
            scrollTop: jQuery("#" + selector).offset().top
        }, 1000);
    });
});