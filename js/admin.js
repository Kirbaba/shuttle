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
                    console.log(obj);
                    $('#id_event').val(obj.ID);
                    $('.oneEvent').html('<h4>В этот день мероприятие: ' + obj.post_title + '</h4> <p>' +
                    '<div class="row"><p><button class="btn btn-default multiSelectVid">Выберите видео</button></p></div> <div class="row"><div class="multipleVid"></div><button class="btn btn-success" name="photo_report_save">Сохранить фотоотчет</button></div>');
                }
                else{
                    $('.oneEvent').html('<h4>В этот день мероприятий нет</h4>');
                }

            }
        });

    });

    $(document).on('click','#videoadd',function(){
        $('.vidos').append('<input type="text" name="video[]" id="" placeholder="Вставте ссылку на видео"/><br />');
    });

    $(document).on('change','#dateparent',function(){
        var date = $(this).val();
        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=get_event_admin&date=' + date,
            success:function(data){
                if (data !=="null"){
                    var obj = jQuery.parseJSON(data);
                    $('#id_event').val(obj.ID);
                    $('.oneEvent').html('<p>В этот день мероприятие: ' + obj.post_title + '</p><label> Добавьте все файлы здесь: <input type="file" name="kv_multiple_attachments[]" multiple="multiple" > </label> <br / ><div class="vidos"></div><br /><input type="submit" name="uploadimg" value="Загрузить" >');
                }
                else{
                    $('.oneEvent').html('<p>В этот день мероприятий нет</p>');
                }

            }
        });

    });


    /*--------------------BANKET----------------------------*/
    $(document).on('click','.save-banket-video',function(){
        var block = $(this).parent();
        var video = block.children('[name="main-video"]').val();
        console.log(video);
        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=banketSave&video='+video,
            success:function(data){
                alert("Видео успешно сохранено!");
            }
        });
    });
    $(document).on('click','.save-hall-name',function(){
        var hallId = $(this).attr('data-num');
        var block = $(this).parent().parent();
        var title = block.children('[name="hall-name"]').val();

        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=banketSave&hallTitle='+title+'&hallId='+hallId,
            success:function(data){
                alert("Заголовок успешно сохранен!");
                location.reload();
            }
        });
    });
    $(document).on('click','.save-hall-description',function(){
        var hallId = $(this).attr('data-num');
        var block = $(this).parent().parent();
        var description = block.children('[name="hall-description"]').val();

        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=banketSave&hallDescription='+description+'&hallId='+hallId,
            success:function(data){
                alert("Описание успешно сохранено!");
                //location.reload();
            }
        });
    });
    $(document).on('click','.save-hall-people',function(){
        var hallId = $(this).attr('data-num');
        var block = $(this).parent().parent();
        var description = block.children('[name="hall-people"]').val();

        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=banketSave&hallPeople='+description+'&hallId='+hallId,
            success:function(data){
                alert("Количество людей успешно сохранено!");
             //   location.reload();
            }
        });
    });
    $(document).on('click','.save-hall-folio',function(){
        var block = $(this).parent().parent().parent();
        var imgId = block.attr('data-num');
        var hallId = block.parent().attr('data-hall');
        var imgUrl = block.children().children().children('[name="hall-folio-img"]').val();

        console.log(hallId);
        console.log(imgId);
        console.log(imgUrl);
        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=banketFolioSave&hallId='+hallId+'&imgId='+imgId+'&imgUrl='+imgUrl,
            success:function(data){
                alert("Изображение успешно сохранено!");
                //location.reload();
            }
        });
    });
    $(document).on('click','.del-hall-folio',function(){
        var delId = $(this).attr('data-num');
        var block = $(this).parent().parent().parent();

        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=banketFolioSave&delId='+delId,
            success:function(data){
                alert("Изображение успешно удалено!");
                block.remove();
                //location.reload();
            }
        });
    });
    $(document).on('click','.add-folio-item',function(){
        var block = $(this).parent();

        block.children('.hall-folio-list').append(' <li class="list-group-item" data-num="new"> ' +
        '<div class="row"> ' +
        '<div class="col-lg-6"> ' +
        '<img src="" alt="" class="hall-folio-img media"> ' +
        '<button class="btn btn-info media-upload"><span class="glyphicon glyphicon-picture"> Выбрать изображение</span></button>' +
        '<input type="hidden" class="media-img" name="hall-folio-img" value=""> ' +
        '</div> ' +
        '<div class="col-lg-1"> ' +
        '<button class="btn btn-success save-hall-folio"><span class="glyphicon glyphicon-floppy-disk"></span></button> ' +
        '</div> ' +
        '<div class="col-lg-1"> ' +
        '</div> ' +
        '</div> ' +
        '</li>');
    });
    $(document).on('click','.save-program-name',function(){
        var programId = $(this).attr('data-num');
        var block = $(this).parent().parent();
        var title = block.children('[name="program-name"]').val();

        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=banketSave&programTitle='+title+'&programId='+programId,
            success:function(data){
                alert("Заголовок успешно сохранен!");
                location.reload();
            }
        });
    });
    $(document).on('click','.save-program-description',function(){
        var programId = $(this).attr('data-num');
        var block = $(this).parent().parent();
        var description = block.children('[name="program-description"]').val();

        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=banketSave&programDescription='+description+'&programId='+programId,
            success:function(data){
                alert("Описание успешно сохранено!");
                location.reload();
            }
        });
    });

    /*----------------END BANKET----------------------------*/

    /*var custom_uploader;
    $(document).on('click','.multiSelectImg', function(e){
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: true
        });
        custom_uploader.on('select', function() {
            var selection = custom_uploader.state().get('selection');
            selection.map( function( attachment ) {
                attachment = attachment.toJSON();
                $(".multipleImg").append("<div class='photo_report_img_wr'><img class='photo_report_img' src=" +attachment.url+"><input type='hidden' name='kv_multiple_attachments_img[]' id='' value='"+attachment.url+"'/><span class='dell'>x</span></div>");
            });
        });
        custom_uploader.open();
    });*/
    var custom_videouploader;
    $(document).on('click','.multiSelectVid', function(e){
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_videouploader) {
            custom_videouploader.open();
            return;
        }
        //Extend the wp.media object
        custom_videouploader = wp.media.frames.file_frame = wp.media({
            title: 'Выберите видео',
            button: {
                text: 'Выберите видеофайлы'
            },
            multiple: true
        });
        custom_videouploader.on('select', function() {
            var selection = custom_videouploader.state().get('selection');
            selection.map( function( attachment ) {
                attachment = attachment.toJSON();
                $(".multipleVid").append("<div class='photo_report_vid_wr'><video src='"+attachment.url+"' width='320' height='240' preload></video><input type='hidden' name='kv_multiple_attachments_vid[]' id='' value='"+attachment.url+"'/><span class='dell delFromBlock'>x</span></div>");
            });
        });
        custom_videouploader.open();
    });

    /*jQuery('.selectCover').click(function() {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        wp.media.editor.send.attachment = function(props, attachment) {
            jQuery('.selectCover').attr('src', attachment.url);
            jQuery('.selectCover').val(attachment.url);
// jQuery('.custom_media_id').val(attachment.id);
            wp.media.editor.send.attachment = send_attachment_bkp;
        }
        wp.media.editor.open();
        return false;
    });*/

    //удаление видео из базы
    $(document).on('click','.delFromBlock', function(){
        var block = $(this).parent();
        block.remove();
    });

    $(document).on('click','.delFromDb', function(){
        var id = $(this).attr('data-id');
        var block = $(this).parent();
        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=deleteVideo&id='+id,
            success:function(data){
                //   console.log(data);
                block.remove();
            }
        });
    })
});


jQuery(document).ready(function ($) {
    jQuery('.custom_media_upload1').click(function() {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        wp.media.editor.send.attachment = function(props, attachment) {
            jQuery('.custom_media_image1').attr('src', attachment.url);
            jQuery('.custom_media_url1').val(attachment.url);
// jQuery('.custom_media_id').val(attachment.id);
            wp.media.editor.send.attachment = send_attachment_bkp;
        }
        wp.media.editor.open();
        return false;
    });

    jQuery('.custom_media_upload2').click(function() {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        wp.media.editor.send.attachment = function(props, attachment) {
            jQuery('.custom_media_image2').attr('src', attachment.url);
            jQuery('.custom_media_url2').val(attachment.url);
// jQuery('.custom_media_id').val(attachment.id);
            wp.media.editor.send.attachment = send_attachment_bkp;
        }
        wp.media.editor.open();
        return false;
    });

    jQuery('.custom_media_upload3').click(function() {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        wp.media.editor.send.attachment = function(props, attachment) {
            jQuery('.custom_media_image3').attr('src', attachment.url);
            jQuery('.custom_media_url3').val(attachment.url);
// jQuery('.custom_media_id').val(attachment.id);
            wp.media.editor.send.attachment = send_attachment_bkp;
        }
        wp.media.editor.open();
        return false;
    });

    jQuery('.custom_media_upload4').click(function() {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        wp.media.editor.send.attachment = function(props, attachment) {
            jQuery('.custom_media_image4').attr('src', attachment.url);
            jQuery('.custom_media_url4').val(attachment.url);
// jQuery('.custom_media_id').val(attachment.id);
            wp.media.editor.send.attachment = send_attachment_bkp;
        }
        wp.media.editor.open();
        return false;
    });

    jQuery('.custom_media_upload5').click(function() {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        wp.media.editor.send.attachment = function(props, attachment) {
            jQuery('.custom_media_image5').attr('src', attachment.url);
            jQuery('.custom_media_url5').val(attachment.url);
// jQuery('.custom_media_id').val(attachment.id);
            wp.media.editor.send.attachment = send_attachment_bkp;
        }
        wp.media.editor.open();
        return false;
    });

    $(document).on('change','#date_hall_fame',function(){
        var date = $(this).val();
        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:'action=get_event_admin&date=' + date,
            success:function(data){
                if (data !=="null"){
                    var obj = jQuery.parseJSON(data);
                    //$('#id_event').val(obj.ID);
                    $('.oneEvent').html('<p>В этот день мероприятие: ' + obj.post_title + '</p><a href="#" id-event="' + obj.ID + '" class="add_events_hall_fame">Добавить</a>');
                }
                else{
                    $('.oneEvent').html('<p>В этот день мероприятий нет</p>');
                }

            }
        });
    });

    $(document).on('click','.add_events_hall_fame',function(){
        var inpVal = $('#id_event_hall_fame').val();
        var idEvent = $(this).attr('id-event');
        console.log(inpVal);
        console.log(idEvent);
        if(inpVal != ''){
            $('#id_event_hall_fame').val(inpVal + ',' + idEvent);
        }
        else{
            $('#id_event_hall_fame').val(idEvent);
        }
        return false;
    });

});


