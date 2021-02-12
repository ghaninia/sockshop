/*

Style   : MobApp Script JS
Version : 1.0
Author  : Surjith S M
URI     : https://surjithctly.in/

Copyright © All rights Reserved 

*/

$(function() {
    "use strict";

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
    /*-----------------------------------
     * OWL CAROUSEL
     *-----------------------------------*/
    var $testimonialsDiv = $('.testimonials');
    if ($testimonialsDiv.length && $.fn.owlCarousel) {
        $testimonialsDiv.owlCarousel({
            nav: false,
            dots: true,
            navText: ['<span class="ti-arrow-left"></span>', '<span class="ti-arrow-right"></span>'] ,
            responsiveClass:true,
            responsive:{
            0:{
                items:1,
                    nav:true
            },
            600:{
                items:3,
                nav:true,
                dots: true
            }
        }
        });
    }

    var $galleryDiv = $('.img-gallery');
    if ($galleryDiv.length && $.fn.owlCarousel) {
        $galleryDiv.owlCarousel({
            nav: false,
            center: true,
            loop: true,
            autoplay: true,
            dots: true,
            navText: ['<span class="ti-arrow-left"></span>', '<span class="ti-arrow-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 3
                }
            }
        });
    }

}); /* End Fn */

function regexCheck(url){
    const  regex = /^(https:\/\/(www\.)?instagram.com\/p\/.+)$/i;
    return regex.test(url) ;
}
function regexTvCheck(url){
    const  regex = /^(https:\/\/(www\.)?instagram.com\/tv\/.+)$/i;
    return regex.test(url) ;
}

$("input[name='phonenumber']").each(function(){
   var regex = /^[۱۲۳۴۵۶۷۸۹۰]+$/ ;
   $(this).keyup(function(){
    var value = $(this).val() ;
    if( regex.test(value) ){
        alert("لطفا کیبورد خود را به انگلیسی تغییر دهید . این فیلد به حروف فارسی حساس است")
    }
   });
});

$(function(){
    $("form").submit(function(e){
        if ( $(this).find("input.instaPostUrl").length > 0 )
        {
            var field = $("input.instaPostUrl" , this ) ;
            var url = field.val()  ;
            if( !regexCheck(url) )
            {
              
                e.preventDefault();
        
                field.addClass("border-danger");
                alert("نشانی آدرس به درستی وارد نشده است.");
                
                field.keydown(function(){
                    $(this).removeClass("border-danger") ;
                })
            }else {
                return true 
            }
        }
        
        if ( $(this).find("input.instaPostUrlTv").length > 0 )
        {
            var field = $("input.instaPostUrlTv" , this ) ;
            var url = field.val()  ;
            if( !regexTvCheck(url) )
            {
              
                e.preventDefault();
        
                field.addClass("border-danger");
                alert("نشانی آدرس به درستی وارد نشده است.");
                
                field.keydown(function(){
                    $(this).removeClass("border-danger") ;
                })
            }else {
                return true 
            }
        }
        
    }) ;    
}) ;


var data = {
    token : $("meta[name='csrf-token']").attr('content') ,
};
//* FORM SECURITY *//
$(function () {
    $("form.security").validator().submit(function (e) {
        var form = $(this) ;
        var formData = new FormData($(this)[0]);
        if (!e.isDefaultPrevented()) {
            e.preventDefault() ;
            NProgress.start() ;
            var action = $(this).attr('action') ;
            $.ajax({
                url : action ,
                type : "POST" ,
                dataType : "json" ,
                data : formData ,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                headers : {
                    "X-CSRF-TOKEN" : data.token
                } ,
                error : function (jqXHR, exception ) {
                    var status = jqXHR.status;
                    if(status == 429) //Too Many Attempts.
                    {
                        Snackbar.show({
                            text: jqXHR.responseJSON.message  ,
                            pos: 'bottom-right',
                            showAction: false ,
                            actionText: "Dismiss",
                            duration: 3000,
                            textColor: '#fff',
                            backgroundColor: '#383838' ,
                            showAction: false
                        });
                    }
                    if(status == 422) // validate error
                    {
                        response = jqXHR.responseJSON.errors ;
                        for(i in response)
                        {
                            var input = $("[name='"+i+"']" , form ) ;
                            var formgroup = input.closest(".form-group");
                            formgroup.addClass('has-error has-danger') ;
                            setTimeout(function () {
                                Snackbar.show({
                                    text: response[i] ,
                                    pos: 'bottom-right',
                                    showAction: false ,
                                    actionText: "Dismiss",
                                    duration: 3000,
                                    textColor: '#fff',
                                    backgroundColor: '#383838',
                                    showAction: false
                                });
                            },100) ;
                        }
                    }
                } ,
                success : function (response) {
                    if(response.status == true)
                        Snackbar.show({
                            text: response.message ,
                            pos: 'bottom-center',
                            showAction: false ,
                            actionText: "Dismiss",
                            duration: 3000,
                            textColor: '#fff',
                            backgroundColor: '#383838',
                            showAction: false
                        });
                    $('input' , form).val("") ;
                }
            });
            NProgress.done() ;
        }
    });
});


const img = document.getElementById('item');
const circles = document.querySelectorAll('.circle');

img.onclick = function() {
    for (var circle of circles) {
        circle.classList.toggle('circle');
    }
}

img.onmouseout = img.onmouseover = function() {
    for (var circle of circles) {
        circle.classList.toggle('paused');
    }
}
