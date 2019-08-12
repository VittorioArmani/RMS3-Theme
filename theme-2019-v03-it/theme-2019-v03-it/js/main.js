jQuery(document).ready(function($){

    /*Load details to template_page*/
    $('#open-features').on('click', function(){
        var data = {
            'id' : $(this).attr('data-id')
        }

        $(this).text('Loading...');
        $.ajax({
            type: 'POST',
            url: window.su + 'themes/theme-2019-v03-it/components/default/get_details.php',
            data: data,
            success: function(data){
                if (data){
                    console.log(data);
                    $.each(JSON.parse(data), function(k, v){
                        $('#viewdetails').append(v);
                    });
                    $('#viewdetails').css({'display':'block'});
                    $('#open-features').hide();
                }
            }
        });
    });
    /*End load details*/
    
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
});

    /* form */
    $popupForm = $('#request-form');
    $obj_data = {};
    $('.send-button').click(function () {
        $popupForm.validate({
            onkeyup: false,
            submitHandler: function () {
                var name = $(".input-name").val(),
                    email = $(".input-email").val(),
                    phone = $(".input-phone").val();
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
				/*$('.confirm-block').hide();*/
                $('.loader-wrapper').show();
                $.ajax({
                    type: "POST",
                    url: window.su + 'themes/theme-2019-v03-it/ajax.php',
                    data: data,
                    success: function (data) {
                        $(".form-answer").empty();
                        $obj_data = $.parseJSON(data);
                        $('.send-button').hide();
                        $('.loader-wrapper').hide();
                        $('.form-answer').show();
                        if(!$obj_data.error) {
                            $('.form-answer').append('Thank you for your order!<br/>We\'ll contact you as soon as possible!');
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
            },
            errorClass: "notvalid",
            messages: {
                'email': {
                    email: "Please, enter your e-mail.",
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
            rules: {
                'email': {
                    email: true,
                    required: true
                },
                'name': {
                    required: true,
                    minlength: 3
                },
                'phone': {
                    required: true,
                    minlength: 3,
                    /*number: true*/
                }
            }
        });
    });
});


(function($){
    $(document).ready(function(){
        $('body').on('click', 'a.details-button',onAjaxGetImages);

        function onAjaxGetImages(e){
            e.preventDefault();

            var data = $(this).data('content');

            console.log( data );

            $.ajax({
                type: 'POST',
                url: window.location,
                data: {
                    'part_content': data
                },
                beforeSend: function(){
                    $('a.details-button').addClass('loading');
                },
                success: function (data) {
                    $('a.details-button').replaceWith( data );
                },
                complete: function( data ){
                },
                error: function (data) {
                }
            });
        }
    });
})(jQuery);