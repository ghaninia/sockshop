window.$ = window.jQuery = require('jquery');
slick = require("slick-carousel") ;
require("./plugins/wave")
require("bootstrap");


$(function() {
    "use strict";

    $(".redirect").each(function(){
        var url = $(this).data("url") ;
        setTimeout(() => {
            window.location.href = url ;
        }, 500 );
    })

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    }) ;

    $(".slick").slick({
        rtl : true ,
        dots : false ,
        infinite: true,
        lazyLoad: 'ondemand',
    });

    $(document).on("submit", "form", function (e) {
        var F = e.target;
        if (!F.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            F.classList.add("was-validated");
        }
    });

    $(".features").each(function(e){
        var wrapper = $(this) ;
        $(".feature").hover(function(e){
            if(!$(this).hasClass("active")){
                wrapper.find(".active").removeClass("active") ;
                $(this).addClass("active") ;
            }
        })
    });

    /*-----------------------------------
     * FIXED  MENU - HEADER
     *-----------------------------------*/
    function menuscroll() {
        var $navmenu = $('.nav-menu');
        if ($(window).scrollTop() > 50) {
            $navmenu.addClass('is-scrolling');
        } else {
            $navmenu.removeClass("is-scrolling");
        }
    }
    menuscroll();
    $(window).on('scroll', function() {
        menuscroll();
    });
    /*-----------------------------------
     * NAVBAR CLOSE ON CLICK
     *-----------------------------------*/

    $('.navbar-nav > li:not(.dropdown) > a').on('click', function() {
        $('.navbar-collapse').collapse('hide');
    });
    /*
     * NAVBAR TOGGLE BG
     *-----------------*/
    var siteNav = $('#navbar');
    siteNav.on('show.bs.collapse', function(e) {
        $(this).parents('.nav-menu').addClass('menu-is-open');
    })
    siteNav.on('hide.bs.collapse', function(e) {
        $(this).parents('.nav-menu').removeClass('menu-is-open');
    })

    /*-----------------------------------
     * ONE PAGE SCROLLING
     *-----------------------------------*/
    // Select all links with hashes
    $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').not('[data-toggle="tab"]').on('click', function(event) {
        // On-page links
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            // Figure out element to scroll to
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            // Does a scroll target exist?
            if (target.length) {
                // Only prevent default if animation is actually gonna happen
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000, function() {
                    // Callback after animation
                    // Must change focus!
                    var $target = $(target);
                    $target.focus();
                    if ($target.is(":focus")) { // Checking if the target was focused
                        return false;
                    } else {
                        $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                        $target.focus(); // Set focus again
                    };
                });
            }
        }
    });
});
