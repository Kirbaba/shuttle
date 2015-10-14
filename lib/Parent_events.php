<?php


class Parent_events {
    function upload_img($id, $photo)
    {
        global $wpdb;
        $data['id_event'] = $id;
        $uploaddir = TM_DIR . '/img_parent/';
        $count = count($_FILES['kv_multiple_attachments']['name']);
        for($i=0;$i<$count;$i++){
            $uploadfile = $uploaddir . basename($photo['kv_multiple_attachments']['name'][$i]);
            copy($photo['kv_multiple_attachments']['tmp_name'][$i], $uploadfile);
            $data['images'] = $photo['kv_multiple_attachments']['name'][$i];
            $wpdb->insert( 'parent', $data );
        }
    }

    function get_img_event(){
        global $wpdb;
        $result = $wpdb->get_results("SELECT id_event FROM parent");
        $res_arr = [];
        foreach($result as $v){
            $res_arr[]=$v->id_event;
        }
        $result = array_unique($res_arr);
        return $result;
    }

    function delite_img($id){
        global $wpdb;
        $wpdb->delete( 'parent', array( 'id_event' => $id ) );
    }

    function get_parent_img($id){
        global $wpdb;
        $result = $wpdb->get_results("SELECT images FROM parent WHERE id_event=$id");
        $res_arr = [];
        foreach($result as $res){
            $res_arr[] = $res->images;
        }
        return $res_arr;
    }
} 