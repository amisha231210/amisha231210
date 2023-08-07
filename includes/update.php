<?php
    require_once( str_replace('//','/',dirname(__FILE__).'/') .'../../../../wp-config.php');
    global $wpdb;
    $table_name = $wpdb->prefix . 'redirect_page';

        $Edit_id = $_POST['Eid'];
        $Edit_tittle = $_POST['Etittle'];
        $Edit_url = $_POST['Eurl'];
        $Edit_selected = $_POST['Eselected'];
        $Edit_action_type = $_POST['Eaction_type'];
        $Edit_action_url = $_POST['Eaction_url'];
        $current_date = date("Y-m-d H:i:s");

        $data = array(

            'id' =>  $Edit_id ,
            'title' =>  $Edit_tittle ,
            'url' =>  $Edit_url ,
            'action_code' =>  $Edit_selected ,
            'action_type' =>  $Edit_action_type ,
            'action_url' =>  $Edit_action_url ,
            'last_access' => $current_date
        );
       // print_r($data);
        $result = $wpdb->update($table_name, $data, array('id' => $Edit_id));

        if($result){
            echo "1";
        }

?>