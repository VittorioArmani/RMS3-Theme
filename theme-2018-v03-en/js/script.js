function include(scriptUrl) {
    document.write('<script src="' + scriptUrl + '"></script>');
}

function isIE() {
    var myNav = navigator.userAgent.toLowerCase();
    return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
};

/* cookie.JS
 ========================================================*/
include(FRONTEND_DIR + '/js/jquery.cookie.js');

/* Easing library
 ========================================================*/
include(FRONTEND_DIR + '/js/jquery.easing.1.3.js');

/* TM Livechat
 ========================================================*/
include(FRONTEND_DIR + '/js/tm-livechat.min.js');

/* Stick up menus
 ========================================================*/
;
(function ($) {
    var o = $('html');
    if (o.hasClass('desktop')) {
        include(FRONTEND_DIR + '/js/tmstickup.js');

        $(document).ready(function () {
            $('#stuck_container').TMStickUp({})
        });
    }
})(jQuery);

/* RD-Navbar
 ========================================================*/
;
(function ($) {
    include(FRONTEND_DIR + '/js/jquery.rd-navbar.min.js');
    $(document).ready(function () {
        $(".rd-navbar").RDNavbar({
           responsive: {
             0: {
                layout: 'rd-navbar-static', //'rd-navbar-fixed' - Sticky panel 
                deviceLayout: "rd-navbar-fixed", //'rd-navbar-static' - Normal panel 
                stickUp: false
             },
             768: {
                layout: 'rd-navbar-static', //'rd-navbar-fixed' - Sticky panel 
                deviceLayout: "rd-navbar-fixed", //'rd-navbar-static' - Normal panel 
                stickUp: false
             },
             1200: {
                layout: 'rd-navbar-static', //'rd-navbar-fixed' - Sticky panel 
                stickUp: false // turn on Sticky panel 
               // stickUp: false // turn off Sticky panel 
             }
          }
        }); // Additional options
        if ($(".rd-navbar").attr("data-body-class")) {
            document.body.className += ' ' + $(".rd-navbar").attr("data-body-class");
        }
    });
})(jQuery);

/* Slider
 ========================================================*/
;
(function ($) {
    include(FRONTEND_DIR + '/js/swiper.min.js');
    $(document).ready(function () {
        var swiper = new Swiper('.slider-block', {
          loop:true,
          autoplay: {
            delay: 5000,
            disableOnInteraction: false,
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        });
        var swiper_2 = new Swiper('.swiper-featured', {
          slidesPerView: 4,
          spaceBetween: 0,
          autoHeight: true,
          simulateTouch: false,
          slidesPerGroup: 4,
          loop: false,
          loopFillGroupWithBlank: false,
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
          breakpoints: {
            1024: {
              slidesPerView: 4,
              slidesPerGroup:4,
            },
            768: {
              slidesPerView: 3,
              slidesPerGroup: 3,
            },
            640: {
              slidesPerView: 2,
              slidesPerGroup: 2,
            },
            320: {
              slidesPerView: 1,
              slidesPerGroup: 1,
            }
          }
        });
        /*var swiper_3 = new Swiper('.swiper-testi', {
          slidesPerView: 3,
          spaceBetween: 0,
          autoHeight: true,
          slidesPerGroup: 3,
          loop: true,
          loopFillGroupWithBlank: true,
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
          breakpoints: {
            1024: {
              slidesPerView: 3,
              slidesPerGroup:3,
            },
            768: {
              slidesPerView: 2,
              slidesPerGroup: 2,
            },
            640: {
              slidesPerView: 2,
              slidesPerGroup: 2,
            },
            470: {
              slidesPerView: 1,
              slidesPerGroup: 1,
            }
          }
        });*/
    });
})(jQuery);

/* EqualHeights
 ========================================================*/
;
(function ($) {
    var o = $('[data-equal-group]');
    if (o.length > 0) {
        include(FRONTEND_DIR + '/js/jquery.equalheights.js');
    }
})(jQuery);

/* SMOOTH SCROLLIG
 ========================================================*/
;
(function ($) {
    var o = $('html');
    if (o.hasClass('desktop')) {
        include(FRONTEND_DIR + '/js/jquery.mousewheel.min.js');
        include(FRONTEND_DIR + '/js/jquery.simplr.smoothscroll.min.js');

        $(document).ready(function () {
            $.srSmoothscroll({
                step: 150,
                speed: 800
            });
        });
    }
})(jQuery);

/* Copyright Year
 ========================================================*/
;
(function ($) {
    var currentYear = (new Date).getFullYear();
    $(document).ready(function () {
        $("#copyright-year").text((new Date).getFullYear());
    });
})(jQuery);



/* Google Map
 ========================================================*/
;
(function ($) {
    var o = document.getElementById("google-map");
    if (o) {
        include('//maps.google.com/maps/api/js?sensor=false');
        include(FRONTEND_DIR + '/js/jquery.rd-google-map.js');

        $(document).ready(function () {
            var o = $('#google-map');
            if (o.length > 0) {
                o.googleMap();
            }
        });
    }
})
(jQuery);

/* WOW
 ========================================================*/
;
(function ($) {
    var o = $('html');

    if ((navigator.userAgent.toLowerCase().indexOf('msie') == -1 ) || (isIE() && isIE() > 9)) {
        if (o.hasClass('desktop')) {
            include(FRONTEND_DIR + '/js/wow.js');

            $(document).ready(function () {
                new WOW().init();
            });
        }
    }
})(jQuery);

/* Contact Form
 ========================================================*/
;
(function ($) {
    var o = $('#contact-form');
    if (o.length > 0) {
        include(FRONTEND_DIR + '/js/modal.js');
        include(FRONTEND_DIR + '/js/TMForm.js');

        if($('#contact-form .recaptcha').length > 0){
        	include('//www.google.com/recaptcha/api/js/recaptcha_ajax.js');
        }
    }
})(jQuery);

/* Orientation tablet fix
 ========================================================*/
$(function () {
    // IPad/IPhone
    var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]'),
        ua = navigator.userAgent,

        gestureStart = function () {
            viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0";
        },

        scaleFix = function () {
            if (viewportmeta && /iPhone|iPad/.test(ua) && !/Opera Mini/.test(ua)) {
                viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
                document.addEventListener("gesturestart", gestureStart, false);
            }
        };

    scaleFix();
    // Menu Android
    if (window.orientation != undefined) {
        var regM = /ipod|ipad|iphone/gi,
            result = ua.match(regM);
        if (!result) {
            $('.sf-menus li').each(function () {
                if ($(">ul", this)[0]) {
                    $(">a", this).toggle(
                        function () {
                            return false;
                        },
                        function () {
                            window.location.href = $(this).attr("href");
                        }
                    );
                }
            })
        }
    }
});
var ua = navigator.userAgent.toLocaleLowerCase(),
    regV = /ipod|ipad|iphone/gi,
    result = ua.match(regV),
    userScale = "";
if (!result) {
    userScale = ",user-scalable=0"
}
document.write('<meta name="viewport" content="width=device-width,initial-scale=1.0' + userScale + '">');

/* Owl Carousel
========================================================*/
;(function ($) {
    var o = $('.owl-carousel');
    if (o.length > 0) {
        include(FRONTEND_DIR + '/js/owl.carousel.min.js');
        $(document).ready(function () {
            o.owlCarousel({
                margin: 30,
                smartSpeed: 450,
                loop: true,
                dots: true,
                dotsEach: 1,
                nav: false,
                navClass: ['owl-prev fa fa-angle-left', 'owl-next fa fa-angle-right'],
                responsive: {
                    0: { items: 1 },
                    768: { items: 1},
                    980: { items: 1}
                }
            });
        });
    }
})(jQuery);



var detectCountOfRows = function() {
    var windowWidth = $(window).width();
    if (windowWidth > 1200) {
        return 4;
    } else if (windowWidth <= 1200 && windowWidth > 991) {
        return 3;
    } else if (windowWidth <= 991 && windowWidth > 768) {
        return 2;
    }
    return 1;
};


$(document).ready(function(){
    fixHeight = function(selector) {
        $(selector).css('height', 'auto');
        var countOfRows = detectCountOfRows();
        var maxHeight = 0;
        var counter = 1;
        var temp = [];
        var countElements = $(selector).length;
        $(selector).each(function() {
            if ($(this).height() > maxHeight) {
                maxHeight = $(this).height();
            }
            temp.push($(this));
            if (counter % countOfRows == 0 || (counter == countElements) /* <= 3*/ ) {
                $.each(temp, function(index, element) {
                    element.height(maxHeight);
                });
                temp.length = 0;
            }
            counter++;
        });
    }
    fixHeight(".template dl:nth-child(3)");
    if ($(".template").length) {
        fixHeight(".template .template_info dl:nth-child(3)");
    }

});

$(window).resize(function() {
    fixHeight(".template .template_info dl:nth-child(3)");
});
// site preloader -- also uncomment the div in the header and the css style for #preloader
$(document).ready(function() {  
  setTimeout(function() {
    $('#ctn-preloader').addClass('loaded');
    // Una vez haya terminado el preloader aparezca el scroll
    $('body').removeClass('no-scroll-y');

    if ($('#ctn-preloader').hasClass('loaded')) {
      // Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
      $('#preloader').delay(400).queue(function() {
        $(this).remove();
      });
    }
  }, 1000);
});

