window.$ = window.jQuery = require('jquery');
slick = require("slick-carousel");
window.axios = require('axios');
const Nprogress = require("nprogress");
const toastr = require("toastr");
require("./plugins/wave")
require("bootstrap");

$(function () {
    "use strict";

    $(document).on("submit", "form", function (e) {
        var F = e.target;
        if (!F.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            F.classList.add("was-validated");
        }
    });

    toastr.options = {
        timeOut: 1000,
        progressBar: true,
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
        showDuration: 200,
        hideDuration: 200,
        positionClass: "toast-top-left",
        rtl: true,
        onHidden: null
    };

    function stepMessage(errors, length, step = 0, callback = null) {
        // if( step == length ){
        // callback(errors) ;
        // }
        if (length > step) {
            var KEY = Object.keys(errors)[step];
            var ERR = errors[KEY][0];
            toastr.error(ERR, null, {
                onHidden: function () {
                    stepMessage(errors, length, step + 1);
                    if (callback != null) {
                        callback(errors);
                    }

                }
            });
        }
    }

    function __sucessMessage(response, callback) {
        const { ok, msg } = response;
        if (ok && msg.length) {
            return toastr.success(msg, null, {
                onHidden: function () {
                    callback(response);
                }
            });
        } else {
            return callback(response);
        }
    }


    function __errorMessage(err, callback = null) {
        const { ok, msg } = err.response.data;
        if (msg && ok == false) {
            toastr.error(msg, null, {
                onHidden: function () {
                    callback != null ? callback(msg) : null;
                }
            });
        } else {
            const { errors, message } = err.response.data
            if (errors != undefined) {
                stepMessage(errors, Object.keys(errors).length, 0, callback);
            } else {
                toastr.error(message, null, {
                    onHidden: function () {
                        callback != null ? callback(message) : null;
                    }
                });
            }
        }
    }

    function PostFormResponse(action, formData = null, success, failed = null) {
        Nprogress.start();
        axios.post(action, formData).then(function (response) {
            const { data } = response;
            Nprogress.done();
            return success(data);
        }).catch(function (errors) {
            Nprogress.done();
            return failed ? failed(errors) : null;
        });
    }


    $(".tracking").each(function () {
        var wrapper = $(this),
            content = $(".content");

        $("form", wrapper).submit(function (e) {
            e.preventDefault();
            var form = $(this),
                btn = $("button", form) ,
                captcha = $(".captcha img" , form ) ,
                action = $(this).attr('action') ,
                data = new FormData(form[0]);
            if (form[0].checkValidity()) {
                btn.prop('disabled', true);
                PostFormResponse(action, data,
                    function (response) {
                        const { content : context  } = response;
                        content.removeClass("hidden").html( context );
                        btn.prop('disabled', false );
                        captcha.click() ;
                    },
                    function (errors) {
                        __errorMessage(errors , function(){
                            content.html("").addClass("hidden") ;
                            btn.prop('disabled', false );
                            captcha.click() ;
                        });
                    }
                );
            }
        });
    });


    $(".form-group.captcha img").click(function () {
        var wrapper = $(this).closest(".form-group");
        $('input[name="captcha"]', wrapper).val("");
        var src = $(this).attr("src").split("?")[0];
        $(this).attr("src", src + '?' + Math.floor(Math.random() * 100));
    });

    $(".accordion-container").each(function () {
        var wrapper = $(this);
        $(".title", wrapper).click(function (e) {
            e.preventDefault();
            var set = $(this).closest('.set');
            if (!set.hasClass('active')) {
                wrapper.find(".active").removeClass('active');
                set.addClass('active');
            }
        });
    })

    $(".redirect").each(function () {
        var url = $(this).data("url");
        setTimeout(() => {
            window.location.href = url;
        }, 500);
    })

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(".slick").slick({
        rtl: true,
        dots: false,
        infinite: true,
        lazyLoad: 'ondemand',
    });



    $(".features").each(function (e) {
        var wrapper = $(this);
        $(".feature").hover(function (e) {
            if (!$(this).hasClass("active")) {
                wrapper.find(".active").removeClass("active");
                $(this).addClass("active");
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
    $(window).on('scroll', function () {
        menuscroll();
    });
    /*-----------------------------------
     * NAVBAR CLOSE ON CLICK
     *-----------------------------------*/

    $('.navbar-nav > li:not(.dropdown) > a').on('click', function () {
        $('.navbar-collapse').collapse('hide');
    });
    /*
     * NAVBAR TOGGLE BG
     *-----------------*/
    var siteNav = $('#navbar');
    siteNav.on('show.bs.collapse', function (e) {
        $(this).parents('.nav-menu').addClass('menu-is-open');
    })
    siteNav.on('hide.bs.collapse', function (e) {
        $(this).parents('.nav-menu').removeClass('menu-is-open');
    })

    /*-----------------------------------
     * ONE PAGE SCROLLING
     *-----------------------------------*/
    // Select all links with hashes
    $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').not('[data-toggle="tab"]').on('click', function (event) {
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
                }, 1000, function () {
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
