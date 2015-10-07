$(document).ready(function ($) {
    $.ajax({
        type:'POST',
        url:ajaxurl,
        data:'action=load_main',
        success:function(data){
         //   console.log(data);
            $('.current-num').html(data);
        }
    });

    //выбор главного слайда
    $(document).on('click', '.choose-main', function(){
        var num = $(this).attr('data-value');
        console.log(num);
        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=choose_main&num=' + num,
            success:function(data){
                //   console.log(data);
                $('.current-num').html(data);
            }
        });
    });

    $(document).on('click', '.media-upload', function() {
        var par = $(this).parent();
        var send_attachment_bkp = wp.media.editor.send.attachment;
        wp.media.editor.send.attachment = function(props, attachment) {
            par.children('.media').attr('src', attachment.url);
            par.children('.media-img').val(attachment.url);
//                jQuery('.custom_media_id').val(attachment.id);
            wp.media.editor.send.attachment = send_attachment_bkp;
        }
        wp.media.editor.open();
        return false;
    });

    var count = "";

    //Добавление слайда
    $(document).on('click', '.add-slide', function(){
        count = $('.slide').length;

        if(count<6){
            $(".slide-banner-section").append('<div class="col-lg-12 slide">' +
                ' <p> <input type="text" placeholder="Ссылка на событие" class="slide-link" name="slide-link"> </p>' +
                ' <p> <button class="btn btn-info media-upload">Выбрать изображение</button>' +
                ' <img src="" alt="" class="media">' +
                ' <input type="hidden" class="media-img" name="slide-img" ></p><p> ' +
                ' <button class="btn btn-success save-slide" >Сохранить слайд</button>' +
                ' <button class="btn btn-warning add-slide">Добавить слайд</button>' +
                ' </p> </div>');
            count++;
        }else{
            alert("Количество слайдов не может быть больше 6!");
        }

    });
    //удаление слайда
    $(document).on('click', '.del-slide', function(){
        var num = $(this).attr('data-num');
        if(num != undefined){
            var block = $(this).parent().parent();
            $.ajax({
                type:'POST',
                url:ajaxurl,
                data:'action=delete_slide&num='+num,
                success:function(data){
                    console.log(data);
                    alert("Слайд удален!");
                }
            });
            block.remove();
            count--;
        }

    });
    //сохранение слайда
    $(document).on('click', '.save-slide', function(){
        var block = $(this).parent().parent();

        console.log(block);

        var num = block.attr('data-num');

        var link = block.children().children('[name="slide-link"]').val();
        var img = block.children().children('[name="slide-img"]').val();

        console.log(link);
        console.log(img);
        console.log(num);

        if(num == null){
            $.ajax({
                type:'POST',
                url:ajaxurl,
                data:'action=save_slide&link='+link+'&img='+img,
                success:function(data){
                    console.log(data);
                    alert("Слайд добавлен и сохранен!");
                    location.reload();
                }
            });
        }else{
            $.ajax({
                type:'POST',
                url:ajaxurl,
                data:'action=update_slide&link='+link+'&img='+img+'&num='+num,
                success:function(data){
                    console.log(data);
                    alert("Слайд обновлен!");
                }
            });
        }
    });

    //сохранение верхнего банера в 1м варианте
    $(document).on('click', '.save-top-banner', function(){
        var block = $(this).parent().parent();
        var link = block.children().children('[name="top-banner-link"]').val();
        var img = block.children().children('[name="top-banner-img"]').val();

        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=save_top_banner&link='+link+'&img='+img,
            success:function(data){
                console.log(data);
               alert("Сохранено!");
            }
        });
    });

    //сохранение нижнего банера в 1м варианте
    $(document).on('click', '.save-bot-banner', function(){
        var block = $(this).parent().parent();
        var link = block.children().children('[name="bot-banner-link"]').val();
        var img = block.children().children('[name="bot-banner-img"]').val();

        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=save_bot_banner&link='+link+'&img='+img,
            success:function(data){
                console.log(data);
                alert("Сохранено!");
            }
        });
    });

    //сохранение левого банера во 2м варианте
    $(document).on('click', '.save-left-banner', function(){
        var block = $(this).parent().parent();
        var link = block.children().children('[name="left-banner-link"]').val();
        var img = block.children().children('[name="left-banner-img"]').val();

        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=save_left_banner&link='+link+'&img='+img,
            success:function(data){
                console.log(data);
                alert("Сохранено!");
            }
        });
    });

    //сохранение правого банера во 2м варианте
    $(document).on('click', '.save-right-banner', function(){
        var block = $(this).parent().parent();
        var link = block.children().children('[name="right-banner-link"]').val();
        var img = block.children().children('[name="right-banner-img"]').val();

        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=save_right_banner&link='+link+'&img='+img,
            success:function(data){
                console.log(data);
                alert("Сохранено!");
            }
        });
    });

    //сохранение банера в 3м варианте
    $(document).on('click', '.save-big-banner', function(){
        var block = $(this).parent().parent();
        var link = block.children().children('[name="big-banner-link"]').val();
        var img = block.children().children('[name="big-banner-img"]').val();

        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=save_big_banner&link='+link+'&img='+img,
            success:function(data){
                console.log(data);
                alert("Сохранено!");
            }
        });
    });

    //добавить партнера
    $(document).on('click', '.add-partner', function(){
        $('.partners-list').append('<li class="list-group-item"> ' +
            '<div class="row"> ' +
            '<div class="col-lg-5"> ' +
            '<img src="" alt="" class="partner-img media"> ' +
            '<button class="btn btn-info media-upload"><span class="glyphicon glyphicon-picture"> Выбрать изображение</span></button> ' +
            '<input type="hidden" class="media-img" name="partner-img"> ' +
            '</div> ' +
            '<div class="col-lg-5"> ' +
            '<input type="text" placeholder="Ссылка на партнера" name="partner-link"> ' +
            '</div> ' +
            '<div class="col-lg-1"> ' +
            '<button class="btn btn-success save-partner"><span class="glyphicon glyphicon-floppy-disk"></span></button> ' +
            '</div> ' +
            '<div class="col-lg-1"> ' +
            '</div> ' +
            '</div> ' +
            '</li>');
    });

    //сохранениа партнера
    $(document).on('click', '.save-partner', function(){
        var block = $(this).parent().parent();

        console.log(block);

        var num = block.parent().attr('data-num');

        var link = block.children().children('[name="partner-link"]').val();
        var img = block.children().children('[name="partner-img"]').val();

        console.log(link);
        console.log(img);
        console.log(num);

        if(num == null){
            $.ajax({
                type:'POST',
                url:ajaxurl,
                data:'action=save_partner&link='+link+'&img='+img,
                success:function(data){
                    console.log(data);
                    alert("Партнер добавлен и сохранен!");
                    location.reload();
                }
            });
        }else{
            $.ajax({
                type:'POST',
                url:ajaxurl,
                data:'action=update_partner&link='+link+'&img='+img+'&num='+num,
                success:function(data){
                    console.log(data);
                    alert("Партнер обновлен!");
                }
            });
        }
    });
    //удаление слайда
    $(document).on('click', '.del-partner', function(){
        var num = $(this).attr('data-num');
        if(num != undefined){
            var block = $(this).parent().parent().parent();
            $.ajax({
                type:'POST',
                url:ajaxurl,
                data:'action=delete_partner&num='+num,
                success:function(data){
                    console.log(data);
                    alert("Партнер удален!");
                }
            });
            block.remove();
        }

    });

    $(document).on('click','#add_artist',function(){
        $("#add_artist").parent().append('<input type="text" name="extra[artist][]" id="" value=""><a href="#" id="delArtist">Del</a><br />');

        return false;
    });

    $(document).on('click','#add_circs_entry',function(){
        $("#add_circs_entry").parent().append('<p>Название условия: <input type="text" name="extra[circs_entry_key][]" id="" value=""/>Условие: <input type="text" name="extra[circs_entry_value][]" id="" value=""/> <a href="#" id="del_circs_entry">Del</a></p><br/>');
        return false;
    });

    $(document).on('click','#delArtist',function(){
        $(this).prev().remove();
        $(this).remove();
        return false;
    });

    $(document).on('click','#del_circs_entry',function(){
        $(this).parent().remove();
        $(this).remove();
        return false;
    });

    $(document).on('change','#date',function(){
        var date = $(this).val();
        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=get_event_admin&date=' + date,
            success:function(data){
                if (data !=="null"){
                    var obj = jQuery.parseJSON(data);
                    $('#id_event').val(obj.ID);
                    $('.oneEvent').html('<p>В этот день мероприятие: ' + obj.post_title + '</p><label> Добавьте все файлы здесь: <input type="file" name="kv_multiple_attachments[]" multiple="multiple" > </label> <input type="submit" name="uploadimg" value="Загрузить" >');
                }
                else{
                    $('.oneEvent').html('<p>В этот день мероприятий нет</p>');
                }

            }
        });

    });
});