jQuery(document).ready(function($){
    (function(){
        var urls = [];
        $(".template-screenshots #fullscreen_preview_block iframe").each(function(){
            //urls.push($(this).attr('src'));
            if ($(this).attr('src').split('.').pop() == 'jpg') {
                $(this).hide();
            }
        })
    })()
    var offset = 300,
        offset_opacity = 1200,
        scroll_top_duration = 700,
        $back_to_top = $('.toTop');
    $(window).scroll(function(){
        ( $(this).scrollTop() > offset ) ? $back_to_top.css('opacity', 1) : $back_to_top.css('opacity', 0);
        if( $(this).scrollTop() > offset_opacity ) {
            $back_to_top.addClass('cd-fade-out');
        }
    });
    $("#request-form").validate({
        errorClass: "notvalid",
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            email: {
                email: true,
                required: true
            },
            phone: {
                required: true,
                minlength: 3,
                /*number: true*/
            },
        },
        messages: {
            'email': {
                email: "Please, enter your E-mail.",
                required: "The field is required."
            },
            'name': {
                required: "Please, enter your name.",
                    minlength: "3 symbols minimum"
            },
            'phone': {
                required: "Please, enter your phone number",
                minlength: "3 symbols minimum",
                number: "Only digits."
            }
        },
        debug: true,
        onkeyup: false
    });
    $back_to_top.on('click', function(event){
        event.preventDefault();
        $('body,html').animate({
                scrollTop: 0
            }, scroll_top_duration
        );
    });
    $(".fancybox").fancybox({
        padding: 0,
        margin: 0,
        autoHeight : true,
        afterClose: function() {
            $('.form-answer').empty();
        }
    });
    $(".order").click(function(){
       var id = $(this).data("id");
      window.order_id_template = id;
      console.log(window.order_id_template);
    });
    /* form */
    $popupForm = $("#request-form");
    $obj_data = {};
    $(".send-button").click(function () {
        if($("#request-form").valid()){
            var name = $(".input-name").val();
            var email = $(".input-email").val();
            var phone = $(".input-phone").val();
            var data = {
                'app': 'send-email',
                'name': name,
                'email': email,
                'phone': phone,
                'id_template': window.order_id_template,
                'we': window.we
            };
            console.log(data);
            $('.send-button').hide();
            $('.loader-wrapper').show();
            $.ajax({
                type: "POST",
                url: window.su + 'themes/theme-2019-v03-it/ajax.php',
                data: data,
                success: function (data) {
                    $(".form-answer").empty();
                    $obj_data = $.parseJSON(data);
                    $('.send-button').hide();
					/*$('.confirm-block').hide();*/
                    $('.loader-wrapper').hide();
                    $('.form-answer').show();
                    if(!$obj_data.error) {
                        $('.form-answer').append('Grazie per il tuo ordine!<br/>Ti contatteremo al più presto!');
                    } else {
                        $('.form-answer').append('Error!<br/>Please, fill out the form once again');
                    }
                },
                error: function (data) {
                    $('.send-button').show();
                    $('.loader-wrapper').hide();
                    $('.form-answer').append('Error!<br/>Please, fill out the form once again');
                }
            });
        }
    });
});