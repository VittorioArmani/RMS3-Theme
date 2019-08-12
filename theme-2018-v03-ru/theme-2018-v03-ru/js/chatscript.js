var userAgent = navigator.userAgent.toLowerCase();
tmrmsBrowser = {
    Version: (userAgent.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [])[1],
    Chrome: /chrome/.test(userAgent),
    Safari: /webkit/.test(userAgent),
    Opera: /opera/.test(userAgent),
    IE: /msie/.test(userAgent) && !/opera/.test(userAgent),
    Mozilla: /mozilla/.test(userAgent) && !/(compatible|webkit)/.test(userAgent)
};

// Fix search query
function fixSearchQuery(searchKeyword) {
    searchKeyword = jQuery.trim(searchKeyword);
    if (searchKeyword) {
        searchKeyword = searchKeyword.toLowerCase();
        var searchKeywordArr = searchKeyword.split(' ');

        if (searchKeywordArr.length > 1) {
            var excludeKeywords = new Array('template', 'templates', 'theme', 'themes');
            var sDiff = new Array();
            jQuery.grep(searchKeywordArr, function(el) {
                if (jQuery.inArray(el, excludeKeywords) == -1) sDiff.push(el);
            });

            if (sDiff.length > 0) searchKeyword = sDiff.join(' ');
        }
    }

    return searchKeyword;
}



function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}



jQuery(document).bind('click',function(e){
 if (jQuery(e.target).closest('.wiz-more').length) return;
 jQuery('.wiz-categories').css('display','none');
});

jQuery( document ).ready(function($) {
    //$.mobile.loading( 'show', { theme: "b", text: "", textonly: false});
    jQuery('#payment_page').parent('iframe').css('height', '1604px');
    if (navigator.userAgent.toLowerCase().indexOf('firefox') != -1) {
        jQuery('html').removeClass('ie9');
        if(jQuery(document).width() == 1024){
            jQuery('.livechat').css('top', '366px');
        }
    }
    var ua = navigator.userAgent.toLowerCase();
  if (ua.indexOf('safari') != -1) {
    if (ua.indexOf('chrome') > -1) {
    } else {
     jQuery('html').removeClass('ie9');

        jQuery('.wiz-arrow').addClass('ios-arrow');

        if(jQuery(document).width() < 435){
            jQuery('.searchform').css('width',jQuery('.container').width()-520);
        }
        if(jQuery(document).width() > 993 && jQuery(document).width() < 1400){
            jQuery('.searchform').css('width',jQuery('.container').width()-420);
        }
        if(jQuery(document).width() > 993){
            jQuery('.searchform').css('width',jQuery('.container').width()-520);
        }
    }
  }

    jQuery("a").each(function(){
          jQuery(this).attr("rel","external");
    });
    $("body").on("click", function() {
    });



  if(jQuery(document).width() <= 1024){
      jQuery('.img-block img').unwrap();
      jQuery('.img-block a').hide();
      jQuery('.img-block').on('tap', function(){
          jQuery(this).children('a').show();
      });
  }
    var home = jQuery('body.home').length;
    var templ = jQuery('body.page-template').length;
    if(!templ){
        jQuery('.menu-wrapper').css('display', 'block');
    }
    var firstChild = jQuery('.main-menu .menu[id*="menu-"]').find(':first-child').get(0);

    if(home){
        jQuery(firstChild).addClass('white');
        jQuery(firstChild).children('a').addClass('gray');
        jQuery(firstChild).children('ul').addClass('before-menu');
        jQuery('.breadcrumbs').css('marginTop', '112px');
        jQuery('.breadcrumbs').css('marginBottom', '23px');
    }else{
        jQuery(firstChild).removeClass('white');
        jQuery(firstChild).children('a').removeClass('gray');
        jQuery(firstChild).children('ul').removeClass('before-menu');
        jQuery('.breadcrumbs').css('marginTop', '35px');
    }


    jQuery('.tab-pane').children('span').each(function(){
        if(jQuery(this).text() == 'This theme is widgetized'){
            jQuery(this).addClass('file-text');
        }
    });

    if(home){
       jQuery('.menu-wrapper ul.menu > li:first-child ul').css('opacity','1');
        jQuery('.menu-wrapper ul.menu > li:first-child ul').css('display', 'block');
       }else{
           jQuery('.menu-wrapper ul.menu > li:first-child ul').css('opacity','0');
        jQuery('.menu-wrapper ul.menu > li:first-child ul').css('display', 'none');
       }
       jQuery('.menu-wrapper ul.menu > li.large ul').css('opacity','0');
       jQuery('.menu-wrapper ul.menu > li.large ul').css('display','none');


var myTimeout;
jQuery('.menu-wrapper ul.menu > li.large').on('mouseenter',function() {
   var el = jQuery(this);
   var el = jQuery(this);
   var amount = el.children('ul').find('.amount');
   jQuery(firstChild).removeClass('white');
   amount.css('display', 'block');
    myTimeout = setTimeout(function() {
        el.children('ul').animate({
                'opacity':'1'
            },80);
//            el.children('ul').css('opacity','1');
            el.children('ul').css('display','block');
    }, 100);
}).on('mouseleave',function() {
    var el = jQuery(this);
    var el = jQuery(this);
    var amount = el.children('ul').find('.amount');
    clearTimeout(myTimeout);
   // myTimeout = setTimeout(function() {
        amount.css('display', 'none');
        el.children('ul').animate({
                'opacity':'0'
            },80);
//            el.children('ul').css('opacity','0');
            el.children('ul').css('display','none');
  //  }, 160);
     if(home){

    jQuery(firstChild).delay(2000).addClass('white');
    jQuery('.menu-wrapper ul.menu > li:first-child .sub-menu').css('display', 'block').delay(2000);
    jQuery('.menu-wrapper ul.menu > li:first-child .sub-menu').animate({
                'opacity':'1'
            },80);

     }
});

    if(!home){
   jQuery('.menu-wrapper ul.menu > li:first-child').on('mouseenter',function() {
   var el = jQuery(this);

    myTimeout = setTimeout(function() {
        el.children('ul').animate({
                'opacity':'1'
            },80);
            el.children('ul').css('display','block');
    }, 100);
}).on('mouseleave',function() {


    var el = jQuery(this);
     clearTimeout(myTimeout);

    myTimeout = setTimeout(function() {
        el.children('ul').animate({
                'opacity':'0'
            },80);
            el.children('ul').css('display','none');
    }, 60);
});
    }

    if(tmrmsBrowser.Mozilla) {
        jQuery('.wiz-button button').css('letterSpacing','-0.03em');
        jQuery('.wiz-more').css('paddingLeft','49px');
    }



    if(!templ){
        jQuery('.livechat').draggable();

    }
    jQuery('.chat-name').on('input', function(){
        jQuery(this).css('color','#333');
    })
    jQuery('.chat-mail').on('input', function(){
        jQuery(this).css('color','#333');
    })
    jQuery('.chat-close .chat-header').on('click', function(){
        jQuery('.chat-close').css('display','none');
        jQuery('.livechat').css('display', 'block');

            jQuery("input[name='nick']").focus();

    });
    jQuery('.chat-btn-close').on('click', function(){
        jQuery('.chat-close').css('display','block');
        jQuery('.livechat').css('display', 'none');
    });

    if(jQuery(document).width() < 435){
        jQuery('.description').remove();
        jQuery('.sub-menu').remove();
    }


jQuery(document).keyup(function(e){

    if(e.keyCode === 27){
        jQuery('#myCarousel strong').removeClass('hide');
        jQuery('#myModal #myCarousel').remove();
        jQuery('body').removeClass('scroll-stop');
    }
});
    jQuery('#myButtonFullscreen').on('hover', function(){
       jQuery('strong').addClass('car-strong');
    }).on('mouseleave', function(){
        jQuery('strong').removeClass('car-strong');
    });

     jQuery('#myModal .btn-danger').on('click', function(){
         jQuery('body').removeClass('scroll-stop');
         jQuery('#myCarousel strong').removeClass('hide');
         jQuery('#myModal #myCarousel').remove();

     });


     jQuery('body').on('click', function(e){ // close on-click in no-modal area
        if(jQuery(e.target).hasClass('item')){
            jQuery('#myModal #myCarousel').remove();
            jQuery('#myModal').modal('hide');
            jQuery('body').removeClass('scroll-stop');
        }
     });

     jQuery('body').keydown(function(e) {
          if (e.keyCode == 27) {
              jQuery('body').removeClass('scroll-stop');
            jQuery('#myModal #myCarousel').remove();
            jQuery('#myModal').modal('hide');
          }
      });



      jQuery('#myButtonFullscreen').on('click', function(){
          jQuery('body').addClass('scroll-stop');
         jQuery('#myModal').removeClass('hide');
        var car = jQuery('.template-image-wrapper #myCarousel').clone();
        car.appendTo(jQuery('.template-image-wrapper'));
         jQuery('.carousel-control.left').addClass('zindex-max');
         jQuery('.carousel-control.right').addClass('zindex-max');
         jQuery('#myCarousel strong').addClass('hide');

     });
     if(!templ){
        jQuery('#myTab a:first').tab('show');
     };


jQuery('.social-share a.popup').on('click', function(e){
    e.preventDefault();
    window.open(jQuery(this).attr("href"), "", "height=300, width=700, top=300, left=300, scrollbars=0");
    return false;
});

function iedetection() {
            var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");

            if (msie > 0)      // If Internet Explorer, return version number
                var ie = parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
            else                 // If another browser, return false
                ie = false;

            return ie;
        }

var bad = iedetection();

   /********wizard************/
   if(home){
   jQuery('.wizard_container').addClass('wiz-display');
   jQuery('.wizard_container').removeClass('wiz-hide');
   jQuery('.wiz-steps').children("div").attr('data-name', 'wiz-step').hide();
   jQuery('.wiz-close').hide();
   jQuery('.wiz-pos').hide();
   jQuery('.wiz-try').hide();
   jQuery('.wiz-button').show();
   jQuery('.wiz-categories').hide();

   jQuery('.wiz-btn').on('click', function(e){
      e.preventDefault();
      e.stopPropagation();
      jQuery('.wizard').hide();
      jQuery('.wiz-steps').show();
      jQuery('.wiz-step-4').show();
      if(!bad){
       jQuery('.wiz-step-4').animate({
                            'opacity': '1'
                        },300);
      }else{
          jQuery('.wizard_container section.wiz-steps div.wiz-step-4').addClass('alpha1');
          jQuery('.wiz-step-4').css('opacity','1');
      }
      jQuery('.wiz-close').show();
      jQuery('.wiz-pos').attr('data-pos', '4');
   });
   jQuery('.wiz-pos').on('mouseenter', function() {
        jQuery(this).removeClass('wiz-clicked');
    });
    jQuery('.wiz-pos').on('click', function() {
        jQuery(this).addClass('wiz-clicked');
        more = 0;
        jQuery('.wiz-down-img').removeClass('img-scaleY');
        var curr = parseInt(jQuery(this).attr('data-pos'));
        if(curr == 6 || curr == 2){
            jQuery(".wiz-step-" + curr + " .wiz-btn-yes").removeClass('active-yes');
            jQuery(".wiz-step-" + curr + " .wiz-btn-no").removeClass('active-no');
            jQuery(".wiz-step-" + curr + "").hide();
            curr = 4;
            jQuery('.wiz-pos').hide();
            jQuery('.wiz-pos').attr('data-pos', curr);
            jQuery(".wiz-step-" + curr + "").show();
            jQuery(".wiz-step-" + curr + "").animate({
                            'opacity': '1'
                        },300);
            jQuery(".wiz-step-" + curr + " .wiz-btn-yes").addClass('active-yes');
            jQuery(".wiz-step-" + curr + " .wiz-btn-no").addClass('active-no');
        }
        if(curr == 7 || curr == 3){
            jQuery(".wiz-step-" + curr + " .wiz-btn-yes").removeClass('active-yes');
            jQuery(".wiz-step-" + curr + " .wiz-btn-no").removeClass('active-no');
            jQuery(".wiz-step-" + curr + "").hide();
            curr = curr-1;
            jQuery('.wiz-pos').show();
            jQuery('.wiz-pos').attr('data-pos', curr);
            jQuery(".wiz-step-" + curr + "").show();
            jQuery(".wiz-step-" + curr + "").animate({
                            'opacity': '1'
                        },300);
            jQuery(".wiz-step-" + curr + " .wiz-btn-yes").addClass('active-yes');
            jQuery(".wiz-step-" + curr + " .wiz-btn-no").addClass('active-no');
        }
        if(curr == 5 || curr == 1 || curr == 0){
            jQuery(".wiz-step-" + curr + " .wiz-btn-yes").removeClass('active-yes');
            jQuery(".wiz-step-" + curr + " .wiz-btn-no").removeClass('active-no');
            jQuery(".wiz-step-" + curr + "").hide();
            curr = curr+1;
            jQuery('.wiz-pos').show();
            jQuery('.wiz-pos').attr('data-pos', curr);
            jQuery(".wiz-step-" + curr + "").show();
            jQuery(".wiz-step-" + curr + "").animate({
                            'opacity': '1'
                        },300);
            jQuery(".wiz-step-" + curr + " .wiz-btn-yes").addClass('active-yes');
            jQuery(".wiz-step-" + curr + " .wiz-btn-no").addClass('active-no');
        }
    });

    jQuery('.wiz-steps').on('click', '.wiz-btn-yes.active-yes', function() {
        var curr = parseInt(jQuery('.wiz-pos').attr('data-pos'));
        jQuery(".wiz-step-" + curr + " .wiz-btn-yes").removeClass('active-yes');
        jQuery(".wiz-step-" + curr + " .wiz-btn-no").removeClass('active-no');
        jQuery(".wiz-step-" + curr + "").hide();
        jQuery(".wiz-step-" + curr + "").animate({
                            'opacity': '1'
                        },300);
        if (curr == 4) {
            curr = 6;
        } else {
            curr = curr + 1;
        }
        jQuery('.wiz-pos').show();
        jQuery('.wiz-pos').attr('data-pos', curr);
        jQuery(".wiz-step-" + curr + "").show();
        jQuery(".wiz-step-" + curr + "").animate({
                            'opacity': '1'
                        },300);
        jQuery(".wiz-step-" + curr + " .wiz-btn-yes").addClass('active-yes');
        jQuery(".wiz-step-" + curr + " .wiz-btn-no").addClass('active-no');
    });

    jQuery('.wiz-steps').on('click','.wiz-btn-no.active-no', function() {
        var curr = parseInt(jQuery('.wiz-pos').attr('data-pos'));
        jQuery(".wiz-step-" + curr + " .wiz-btn-yes").removeClass('active-yes');
        jQuery(".wiz-step-" + curr + " .wiz-btn-no").removeClass('active-no');
        jQuery(".wiz-step-" + curr + "").hide();
        if (curr == 4) {
            curr = 2;
        } else {
            curr = curr - 1;
        }
        jQuery('.wiz-pos').show();
        jQuery('.wiz-pos').attr('data-pos', curr);
        jQuery(".wiz-step-" + curr + "").show();
        jQuery(".wiz-step-" + curr + "").animate({
                            'opacity': '1'
                        },300);
        jQuery(".wiz-step-" + curr + " .wiz-btn-yes").addClass('active-yes');
        jQuery(".wiz-step-" + curr + " .wiz-btn-no").addClass('active-no');
    });
    var more = 0;
   jQuery('.wiz-steps').on('click', '.wiz-more', function() {
       var curr = parseInt(jQuery('.wiz-pos').attr('data-pos'));
       more++;
        var isEven = function(someNumber) {
        return (someNumber % 2 === 0) ? true : false;
    };
     if (isEven(more) === false) {
      jQuery(".wiz"+curr+"").show();
      jQuery("img.wiz-down-img").addClass('img-scaleY');
     }else{
      jQuery(".wiz"+curr+"").hide();
      jQuery("img.wiz-down-img").removeClass('img-scaleY');
     }
   });

   jQuery('.wiz-close').on('click', function(){
       var wizardContainer = jQuery('.wizard_container');
       var choosenProducts = jQuery('.choosen-products');
       var choosenProductsHeightIncrement = wizardContainer.height() + 40;
       wizardContainer.removeClass('wiz-display').hide();
       choosenProducts.css({
           'marginTop' : '-40',
           'min-height' : '+=' + choosenProductsHeightIncrement
       });
   });
   jQuery('.wiz-try').on('click', function(){
       jQuery('.wizard_container').css('height', '180px');
       jQuery('.choosen-products').removeClass('current');
       jQuery('.choosen-products').addClass('old');
       jQuery('.wiz-arrow').css('top', '180px');
       jQuery('.wiz-pos').hide();
       jQuery('.wiz-try').hide();
       jQuery(".wiz-step-8").hide();
       jQuery(".wiz-step-4").show();
       jQuery(".wiz-step-4").animate({
                            'opacity': '1'
                        },300);
       jQuery('.wiz-pos').attr('data-pos', '4');
       jQuery(".wiz-step-4 .wiz-btn-yes").addClass('active-yes');
        jQuery(".wiz-step-4 .wiz-btn-no").addClass('active-no');
   });

   jQuery('.wiz-steps').on('click','.wiz-category', function() {
       var curr = parseInt(jQuery('.wiz-pos').attr('data-pos'));
       jQuery('.wizard_container').css('height', '110px');
       jQuery('.wiz-arrow').css('top', '110px');
       jQuery(".wiz-step-" + curr + "").hide();
       jQuery('.choosen-products.old').remove();

       if(bad){
           jQuery('.wiz-steps').css('marginBottom','12px');
       }
       jQuery(".wiz-step-8").show();
       jQuery(".wiz-step-8").animate({
                            'opacity': '1'
                        },400);
       jQuery('.wiz-pos').hide();
       jQuery('.wiz-try').show();
       var catId = parseInt(jQuery(this).attr('data-id'));
       sendAjaxProducts(catId);
       jQuery('.choosen-products').addClass('current');
   });

   function sendAjaxProducts(catId){

            jQuery.ajax({
             url : sysvar.adminajax,
             data: {
                     'action' : 'show_choosen_templates',
                     'id' : catId
                   },
                   type: 'POST',
             success: function(data){
                 jQuery('.main-products').remove();
                 jQuery('.main-pagination').remove();
                 jQuery('.template-title').remove();
                 jQuery('#smt').remove();
                 jQuery(data).insertBefore(jQuery('.hFooter'));
                  jQuery('a').attr("rel", "external");

                var choosenProducts = jQuery('.choosen-products');
                var footer = jQuery('footer');
                choosenProducts.css('min-height', footer.offset().top - choosenProducts.offset().top + parseFloat(footer.css('padding-top')) + 'px');
             },
             error: function(data){
               alert('hoi!');
             }
         });
        }
   }
   /********end wizard*************/
   var search = jQuery('body.search').length;
if(search){
    jQuery('.wizard_container').addClass('hide');
    jQuery('.templ-found').css('display', 'none');
    jQuery('.search-result').css('display', 'block');
}

    var count = parseInt(jQuery('.show-more-btn').attr('data-count'));
    var value = parseInt(jQuery('.show-more-btn').attr('data-amount'));

    if (count < value ) jQuery('.show-more-btn').css('display','none');
//
if (jQuery(window).width() < 1024){
    jQuery(document).on('vmousedown','.show-more-btn' ,function(){
            jQuery(".show-more-btn").css("background","#333333");
        }).on('vmouseup', function(){
            jQuery(".show-more-btn").css("background","#bf5252");
        });
        }



    jQuery('.show-more-btn').on('click',function(e){
        ctsShowMoreButtonToggleOff();

        e.preventDefault();
        e.stopPropagation();

        var value = parseInt(jQuery(this).attr('data-amount'));
        var type = jQuery(this).attr('data-type');

        switch(type){
            case 'all': sendAjaxAll(); break;
            case 'type': sendAjaxType(); break;
            case 'cat': sendAjaxCat(); break;
            case 'cats-type': sendAjaxCatsType(); break;
            case 'search': sendAjaxSearch(); break;
            case 'cod': sendAjaxCod(); break;
            case 'fech': sendAjaxFech(); break;
            case 'author': sendAjaxAuthor(); break;
            case 'prop': sendAjaxProperties(); break;
            case 'popular': sendAjaxPopular(); break;
        }

        function sendAjaxAll(){
            jQuery.ajax({
             url : sysvar.adminajax,
             data: {
                     'action' : 'show_more_templates',
                     'paged' : value
                   },
                   type: 'POST',
             success: function(data){
                value++;
                jQuery('.show-more-btn').attr('data-amount', value);
                jQuery(data).insertBefore(jQuery('#smt'));
                 jQuery('a').attr("rel", "external");

                  var count = parseInt(jQuery('.show-more-btn').attr('data-count'));
                  if(count < value ){
                    jQuery('.show-more-btn').css('display','none');
                  } else {
                    ctsShowMoreButtonToggleOn();
                  }
             }
         });
        }
function sendAjaxType(){
            var slug = jQuery('.show-more-btn').attr('data-slug');
            jQuery.ajax({
             url : sysvar.adminajax,
             data: {
                     'action' : 'show_more_templates_by_type',
                     'paged' : value,
                     'slug' : slug
                   },
                   type: 'POST',
             success: function(data){
                value++;
                jQuery('.show-more-btn').attr('data-amount', value);
                jQuery(data).insertBefore(jQuery('#smt'));
                 jQuery('a').attr("rel", "external");

                  var count = parseInt(jQuery('.show-more-btn').attr('data-count'));
                  if(count < value ){
                    jQuery('.show-more-btn').css('display','none');
                  } else {
                    ctsShowMoreButtonToggleOn();
                  }
             }
         });
        }
        function sendAjaxCat(){
            var slug = jQuery('.show-more-btn').attr('data-slug'),
                exclude_post = jQuery('.show-more-btn').attr('data-exclude-post');

            jQuery.ajax({
             url : sysvar.adminajax,
             data: {
                     'action' : 'show_more_templates_by_category',
                     'paged' : value,
                     'slug' : slug,
                     'exclude_post': exclude_post
                   },
                   type: 'POST',
             success: function(data){
                value++;
                jQuery('.show-more-btn').attr('data-amount', value);
                jQuery(data).insertBefore(jQuery('#smt'));
                 jQuery('a').attr("rel", "external");

                  var count = parseInt(jQuery('.show-more-btn').attr('data-count'));
                  if(count < value ){
                    jQuery('.show-more-btn').css('display','none');
                  } else {
                    ctsShowMoreButtonToggleOn();
                  }
             }
         });
        }

        function sendAjaxCatsType(){
            var
                catIds = jQuery('.show-more-btn').attr('data-cat-ids'),
                typeId = jQuery('.show-more-btn').attr('data-type-id'),
                filtered = jQuery('.show-more-btn').attr('data-filtered'),
                exclude_post = jQuery('.show-more-btn').attr('data-exclude-post');

            jQuery.ajax({
             url : sysvar.adminajax,
             data: {
                     'action' : 'show_more_templates_by_categories_type',
                     'paged' : value,
                     'cat_ids' : catIds,
                     'type_id' : typeId,
                     'filtered' : filtered,
                     'exclude_post': exclude_post
                   },
                   type: 'POST',
             success: function(data){
                value++;
                jQuery('.show-more-btn').attr('data-amount', value);
                jQuery(data).insertBefore(jQuery('#smt'));
                 jQuery('a').attr("rel", "external");

                  var count = parseInt(jQuery('.show-more-btn').attr('data-count'));
                  if(count < value ){
                    jQuery('.show-more-btn').css('display','none');
                  } else {
                    ctsShowMoreButtonToggleOn();
                  }
             }
         });
        }

        function sendAjaxSearch() {
            var keyword = $('.show-more-btn').attr('data-keyword');
            jQuery.ajax({
                url: sysvar.adminajax,
                data: {
                    'action': 'show_more_templates_by_keyword',
                    'paged': value,
                    'keyword': keyword
                },
                type: 'POST',
                success: function(data) {
                    value++;
                    $('.show-more-btn').attr('data-amount', value);
                    $(data).insertBefore(jQuery('#smt'));
                     jQuery('a').attr("rel", "external");
                    var count = parseInt($('.show-more-btn').attr('data-count'));
                    if(count < value){
                      jQuery('.show-more-btn').css('display', 'none');
                    } else {
                      ctsShowMoreButtonToggleOn();
                    }
                }
            });
        }
        function sendAjaxCod(){
            var slug = jQuery('.show-more-btn').attr('data-slug');
            jQuery.ajax({
             url : sysvar.adminajax,
             data: {
                     'action' : 'show_more_templates_by_cod',
                     'paged' : value,
                     'slug' : slug
                   },
                   type: 'POST',
             success: function(data){
                value++;
                jQuery('.show-more-btn').attr('data-amount', value);
                jQuery(data).insertBefore(jQuery('#smt'));
                 jQuery('a').attr("rel", "external");

                  var count = parseInt(jQuery('.show-more-btn').attr('data-count'));
                  if(count < value ){
                    jQuery('.show-more-btn').css('display','none');
                  } else {
                    ctsShowMoreButtonToggleOn();
                  }
             }
         });
        }
        function sendAjaxFech(){
            var slug = jQuery('.show-more-btn').attr('data-slug');
            jQuery.ajax({
             url : sysvar.adminajax,
             data: {
                     'action' : 'show_more_templates_by_fech',
                     'paged' : value,
                     'slug' : slug
                   },
                   type: 'POST',
             success: function(data){
                value++;
                jQuery('.show-more-btn').attr('data-amount', value);
                jQuery(data).insertBefore(jQuery('#smt'));
                 jQuery('a').attr("rel", "external");

                  var count = parseInt(jQuery('.show-more-btn').attr('data-count'));
                  if(count < value ){
                    jQuery('.show-more-btn').css('display','none');
                  } else {
                    ctsShowMoreButtonToggleOn();
                  }
             }
         });
        }
        function sendAjaxAuthor(){
            var slug = jQuery('.show-more-btn').attr('data-slug');
            jQuery.ajax({
             url : sysvar.adminajax,
             data: {
                     'action' : 'show_more_templates_by_author',
                     'paged' : value,
                     'slug' : slug
                   },
                   type: 'POST',
             success: function(data){
                value++;
                jQuery('.show-more-btn').attr('data-amount', value);
                jQuery(data).insertBefore(jQuery('#smt'));
                 jQuery('a').attr("rel", "external");

                  var count = parseInt(jQuery('.show-more-btn').attr('data-count'));
                  if(count < value ){
                    jQuery('.show-more-btn').css('display','none');
                  } else {
                    ctsShowMoreButtonToggleOn();
                  }
             }
         });
        }
        function sendAjaxProperties(){
            var slug = jQuery('.show-more-btn').attr('data-slug');
            jQuery.ajax({
             url : sysvar.adminajax,
             data: {
                     'action' : 'show_more_templates_by_prop',
                     'paged' : value,
                     'slug' : slug
                   },
                   type: 'POST',
             success: function(data){
                value++;
                jQuery('.show-more-btn').attr('data-amount', value);
                jQuery(data).insertBefore(jQuery('#smt'));

                 jQuery('a').attr("rel", "external");
                  var count = parseInt(jQuery('.show-more-btn').attr('data-count'));
                  if(count < value ){
                    jQuery('.show-more-btn').css('display','none');
                  } else {
                    ctsShowMoreButtonToggleOn();
                  }
             }
         });
        }

        function sendAjaxPopular(){
            jQuery.ajax({
             url : sysvar.adminajax,
             data: {
                     'action' : 'show_more_templates_by_popularity',
                     'paged' : value
                   },
                   type: 'POST',
             success: function(data){
                value++;
                jQuery('.show-more-btn').attr('data-amount', value);
                jQuery(data).insertBefore(jQuery('#smt'));
                 jQuery('a').attr("rel", "external");

                  var count = parseInt(jQuery('.show-more-btn').attr('data-count'));
                  if(count < value ){
                    jQuery('.show-more-btn').css('display','none');
                  } else {
                    ctsShowMoreButtonToggleOn();
                  }
             }
         });
        }

    });

jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 100) jQuery('#back-to-top').fadeIn();
    else jQuery('#back-to-top').fadeOut(400);
});
jQuery('#back-to-top').click(function () {
    jQuery('body,html').animate({
        scrollTop: 0
    }, 800);
    return false;
});
if(device.tablet()){
    jQuery('.sub-menu').addClass('hidden');
    jQuery('.white ul').addClass('hidden');
    jQuery('.white ul').css('opacity','0');

}
if(device.mobile() || device.tablet()){
    jQuery('.price span').removeClass('hidden');
    jQuery('.price-box').addClass('mob-margin');
}

if(device.mobile && ua.indexOf('chrome') < -1){
    jQuery('.wiz-arrow').addClass('ios-arrow');

}
var myForm = document.getElementById('chat-form');
if (myForm) {
    myForm.onsubmit = function() {
        var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=570,height=620,left = 312,top = 234');
        this.target = 'Popup_Window';
        jQuery('.chat-close').css('display','block');
        jQuery('.livechat').css('display', 'none');
    };
}

if (bad && jQuery(document).width() <= 1280){
    jQuery('body').css('background-color', '#ebebeb');
}

function ctsShowMoreButtonToggleOff() {
    jQuery('#show-more-button').addClass('show-more-overlay').attr('disabled', 'disabled');
}

function ctsShowMoreButtonToggleOn() {
    jQuery('#show-more-button').removeClass('show-more-overlay').removeAttr('disabled');
}

setTimeout(function(){
  $(".livechat").css("display", "block");
$("#small").css("display", "none");
}, 15000);
setTimeout(function(){
  $(".chat-header").css("background-color", "#FF1B06");
}, 4000);
setTimeout(function(){
  $(".chat-header").css("background-color", "#298DDA");
}, 4300);
setTimeout(function(){
  $(".chat-header").css("background-color", "#FF1B06");
}, 5000);
setTimeout(function(){
  $(".chat-header").css("background-color", "#298DDA");
}, 5300);
setTimeout(function(){
  $(".chat-header").css("background-color", "#FF1B06");
}, 9000);
setTimeout(function(){
  $(".chat-header").css("background-color", "#298DDA");
}, 9300);

});