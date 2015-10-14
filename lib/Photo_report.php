<?php


class Photo_report
{
    function upload_img($id, $photo, $video)
    {
        global $wpdb;
        $data['id_event'] = $id;

        foreach($video as $v){
            $data['video'] = $v;
            $wpdb->insert( 'video_report', $data );
        }

        $uploaddir = TM_DIR . '/img_events/';
        $uploadfile = $uploaddir . basename($photo['img_oblogka']['name']);
        copy($photo['img_oblogka']['tmp_name'], $uploadfile);
        $data['images'] = $photo['img_oblogka']['name'];
        unset($data['video']);
        $wpdb->insert( 'cover_report', $data );

        $count = count($_FILES['kv_multiple_attachments']['name']);
        for($i=0;$i<$count;$i++){
            $uploadfile = $uploaddir . basename($photo['kv_multiple_attachments']['name'][$i]);
            copy($photo['kv_multiple_attachments']['tmp_name'][$i], $uploadfile);
            $data['images'] = $photo['kv_multiple_attachments']['name'][$i];
            $wpdb->insert( 'photo_report', $data );
        }
    }

    function get_img_event(){
        global $wpdb;
        $result = $wpdb->get_results("SELECT id_event FROM photo_report");
        $res_arr = [];
        foreach($result as $v){
            $res_arr[]=$v->id_event;
        }
        $result = array_unique($res_arr);
        return $result;
    }


    function delite_img($id){
        global $wpdb;
        $wpdb->delete( 'photo_report', array( 'id_event' => $id ) );
        $wpdb->delete( 'video_report', array( 'id_event' => $id ) );
        $wpdb->delete( 'cover_report', array( 'id_event' => $id ) );
    }

    function get_img_report($id){
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM photo_report WHERE id_event=$id");
        return $result;
    }

    function get_video_report($id){
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM video_report WHERE id_event=$id");
        return $result;
    }

    function get_date_post($id){
        $date = get_post_meta($id, 'date', TRUE);
        return $date;
    }

    function get_empty_report($id){
        global $wpdb;

        $result = $wpdb->get_results("SELECT * FROM photo_report WHERE id_event=$id");
        if(empty($result)){
            return 0;
        }
        else{
            return 1;
        }
    }

    function get_cover_report($id){
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM cover_report WHERE id_event=$id");
        return $result[0]->images;
    }
} 