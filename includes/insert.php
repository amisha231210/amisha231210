<?php
  require_once( str_replace('//','/',dirname(__FILE__).'/') .'../../../../wp-config.php');
  global $wpdb;
  $table_name = $wpdb->prefix . 'redirect_page';

  
 
  $tittle = $_POST['tittle'];
  $url = $_POST['url'];
  $action_code = $_POST['action_code'];
  $action_type = $_POST['action_type'];
  $action_url = $_POST['action_url'];
  $current_date = date("Y-m-d H:i:s");

  $data = array(
           'title' => $tittle,
           'url' => $url,
           'action_code' => $action_code,
           'action_type' => $action_type,
           'action_url' => $action_url,
           'status' => 1 ,
           'last_access' => $current_date
       );
       $result = $wpdb->insert($table_name, $data);
       if($result){
        echo '1';
       }

?>