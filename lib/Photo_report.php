<?php


class Photo_report
{
    function upload_img($id, $photo)
    {
        global $wpdb;

        $data['id_event'] = $id;
        $uploaddir = TM_DIR . '/img_events/';
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
    }

    function get_img_report($id){
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM photo_report WHERE id_event=$id");
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
} 