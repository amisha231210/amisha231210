<?php
    require_once( str_replace('//','/',dirname(__FILE__).'/') .'../../../../wp-config.php');
        global $wpdb;
        $table_name = $wpdb->prefix . 'redirect_page';
        //echo $table_name;
        $url_ID = $_POST['urlId'];
        //echo $url_ID;
        $data = array(
                'id' => $url_ID
        );
       $result =  $wpdb->delete($table_name, $data);
       if($result){
        echo '1';
       }else{
        echo '0';
       }