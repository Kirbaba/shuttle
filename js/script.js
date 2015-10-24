$(document).ready(function() { // вся мaгия пoсле зaгрузки стрaницы
    initSlider();
    var options = {
        horizontal: 1,
        itemNav: 'centered',
        smart: 1,
        activateOn: 'click',
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        startAt: 1,
        scrollBar: $('.scrollbar'),
        scrollBy: 1,
        speed: 300,
        elasticBounds: 1,
        easing: 'easeOutExpo',
        dragHandle: 1,
        dynamicHandle: 1,
        clickBar: 1
    };
    $('#centered').sly(options);
    $('a#go').click( function(event){ // лoвим клик пo ссылки с id="go"
        event.preventDefault(); // выключaем стaндaртную рoль элементa
        $('#overlay').fadeIn(400, // снaчaлa плaвнo пoкaзывaем темную пoдлoжку
            function(){ // пoсле выпoлнения предъидущей aнимaции
                $('#modal_form')
                    .css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
                    .animate({opacity: 1}, 200); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз
            });
    });
    /* Зaкрытие мoдaльнoгo oкнa, тут делaем тo же сaмoе нo в oбрaтнoм пoрядке */
    $('#modal_close, #overlay').click( function(){ // лoвим клик пo крестику или пoдлoжке
        $('#modal_form')
            .animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
            function(){ // пoсле aнимaции
                $(this).css('display', 'none'); // делaем ему display: none;
                $('#overlay').fadeOut(400); // скрывaем пoдлoжку
            }
        );
    });

    $('.leave_order').click(function(){
        var nameproduct = $(this).attr('name-tovar');
        $('#orderProduct').attr('nameProduct',nameproduct);
    });

    $('#buttomOrder').click(function(){
        var nameproduct = $('#orderProduct').attr('nameproduct');
        var name = $('#nameOrder').val();
        var telephone = $('#telephoneOrder').val();
        var email = $('#emailOrder').val();
        $.ajax({
            url: ajaxurl, //url, к которому обращаемся
            type: "POST",
            data: "action=order&nameproduct=" + nameproduct + "&name=" + name + "&tel=" + telephone + "&email=" + email, //данные, которые передаем. Обязательно для action указываем имя нашего хука
            success: function(data){
                alert('Ваш заказ сделан. В ближайшее время с вами свяжутся. Спасибо.')
            }
        });
        $('#nameOrder').val('');
        $('#telephoneOrder').val('');
        $('#emailOrder').val('');
        $('#modal_form')
            .animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
            function(){ // пoсле aнимaции
                $(this).css('display', 'none'); // делaем ему display: none;
                $('#overlay').fadeOut(400); // скрывaем пoдлoжку
            }
        );



    });

    $('#buttonFeedback').click(function(){
        var name = $('#nameFeedback').val();
        var telephone = $('#telephoneFeedback').val();
        var email = $('#emailFeedback').val();

     //   console.log(name);
      //  console.log(telephone);
       // console.log(email);

        $.ajax({
            type: "POST",
            url: ajaxurl, //url, к которому обращаемся
            data: "action=feedback&name=" + name + "&phone=" + telephone + "&email=" + email, //данные, которые передаем. Обязательно для action указываем имя нашего хука
            success: function(data){
               // alert('Ваш заказ сделан. В ближайшее время с вами свяжутся. Спасибо.')
               // console.log(data);
               /*  alert(data);*/
            }
        });

        $('#nameFeedback').val('');
        $('#telephoneFeedback').val('');
        $('#emailFeedback').val('');
        $('#modal_form')
            .animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
            function(){ // пoсле aнимaции
                $(this).css('display', 'none'); // делaем ему display: none;
                $('#overlay').fadeOut(400); // скрывaем пoдлoжку
            }
        );
    });

    $(document).on('click','.events-page__head--but',function(){
        $('.events-page__head--but').removeClass('activeTab');
        $(this).addClass('activeTab');
       /* var postId = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: ajaxurl, //url, к которому обращаемся
            data: "action=show_report&id=" + postId, //данные, которые передаем. Обязательно для action указываем имя нашего хука
            success: function(data){
                // alert('Ваш заказ сделан. В ближайшее время с вами свяжутся. Спасибо.')
                 $('.events-page__box').html(data);
                *//**//*  alert(data);*//**//*
            }
        });*/
    });

    /*  $(document).on('click','#descriptionEvent',function(){
        $('.events-page__head--but').removeClass('activeTab');
        $(this).addClass('activeTab');
    });*/


    $(".selectDay").hover(function() {
            $(this).children(".popup_block").stop(true,true)
                .animate({opacity: "show", top: "20",left: "-80"}, "slow");
        }, function() {
            $(this).children(".popup_block").stop(true,true)
                .animate({opacity: "hide", top: "-85"}, "normal");
        });


    $(document).on('click','.photo_report_events_img',function(){
        var postId = $('.postIdEvents').attr('post-id');
        var imgId = $(this).attr('count');
        imgId = parseInt(imgId, 10);
        
        $.ajax({
            type: "POST",
            url: ajaxurl, //url, к которому обращаемся
            data: "action=slider_events&id=" + postId + "&img=" +imgId, //данные, которые передаем. Обязательно для action указываем имя нашего хука
            success: function(data){
                $('.event-page-photo').html(data);
                $('.slick-codepen').delay(1000).slick({
                    slidesToScroll: 1,
                    asNavFor: '.slider-nav',
                    draggable: true,
                    accessibility: false,
                    centerMode: true,
                    variableWidth: true,
                    slidesToShow: 1,
                    arrows: true,
                    dots: false,
                    swipeToSlide: true,
                    infinite: false,
                    initialSlide:imgId,
                    autoplay:true
                });
                $('.slider-nav').slick({
                    slidesToShow: 9,
                    slidesToScroll: 1,
                    asNavFor: '.slick-codepen',
                    dots: false,
                    centerMode: false,
                    focusOnSelect: true,
                    initialSlide:imgId
                });
            }
        });
        return false;
    });



});

function initSlider(){
    $('.wedding__box--item--img').slick();
}

