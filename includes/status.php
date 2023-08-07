<?php
    require_once(str_replace('//','/',dirname(__FILE__).'/') .'../../../../wp-config.php');
    global $wpdb;
    $table_name = $wpdb->prefix . 'redirect_page';
    
    $Id = $_POST['sId'];
    
    $query = $wpdb->prepare("SELECT status FROM $table_name WHERE id = %d", $Id);
    $status = $wpdb->get_var($query);
    
    if ($status !== null) {
        $result = $wpdb->update( $table_name,array('status' => 0), array('id' => $Id) );
         if ($result){
            echo 'status is disable';
         }
    } else {
        echo "No record found.";
    }
    

?>

      
   
