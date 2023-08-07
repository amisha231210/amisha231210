<?php
    require_once( str_replace('//','/',dirname(__FILE__).'/') .'../../../../wp-config.php');
    global $wpdb;
    $table_name = $wpdb->prefix . 'redirect_page';
    $sql = "SELECT * FROM $table_name";
    $results = $wpdb->get_results($sql);
    $count = 0;
    
    foreach($results as $row){
        $count++;
        ?>
        <tr>
            <td> <?php echo $count;?></td>
            <td class ="delete_record"><?php echo $row->url;?><br>
        <span class="delete"  data-did = '<?php echo $row->id;?>' >delete</span> /
        <span class="edit" data-eid = '<?php echo $row->id;?>' >Edit</span> 
        <span class=" del disable_<?php echo $row->id;?>" data-id = '<?php echo $row->id;?>' style = "display:none;" >disable</span>
        <span class="add  enable_<?php echo $row->id;?>" data-id = '<?php echo $row->id;?>' style = "display:none;" >enable</span>
            <div class=' Update update_form_<?php echo $row->id;?>' style = "display:none;">
                <form method="post" id ="updateform_<?php echo $row->id;?>">
                <input type="hidden" class="id_<?php echo $row->id;?>" name="id" value="<?php echo $row->id;?>" />
                        <div>
                            <label>Tittle</label>
                            <input type="text" class="tittle_<?php echo $row->id;?>" name="title" value="<?php echo $row->title;?>" placeholder="Describe the purpose of this redirect (optional)" />
                        </div><br>
                        <div>
                            <label>Source URL</label>
                            <input type="text" class="url_<?php echo $row->id;?>" name="url" value="<?php echo $row->url;?>" placeholder="The relative URL you want to redirect from" />
                        </div><br>
                        <div>
                            <label>Action_code</label>
                            <?php $value = $row->action_code;?>
                            <select class = "selected_<?php echo $row->id;?>" name="action_code">
                                <option value="301"<?php if ($value == '301'){ echo "selected"; } ?> >301 - Moved Permanently</option>
                                <option value="302" <?php if ($value == '302'){ echo "selected"; } ?> >302 - Found</option>
                                <option value="303" <?php if ($value == '303'){ echo "selected"; } ?> >303 - See Other</option>
                                <option value="304" <?php if ($value == '304'){ echo "selected"; } ?> >304 - Not Modified</option>
                                <option value="307" <?php if ($value == '307'){ echo "selected"; } ?> >307 - Temporary Redirect</option>
                                <option value="308"<?php if ($value == '308'){ echo "selected"; } ?> >308 - Permanent Redirect</option>
                            </select>
                        </div><br>
                        <div>
                            <label>Action_type</label>
                            <?php $value = $row->action_type;?>
                            <select class="action_type_<?php echo $row->id;?>" name="action_type">
                                <option value="URL" <?php if ($value == 'URL'){ echo "selected"; } ?> >URL</option>
                                <option value="URL-login" <?php if ($value == 'URL-login'){ echo "selected"; } ?> >URL and login</option>
                            </select>
                        </div><br>
                        <div>
                            <label>action_url</label>
                            <input type="text" class="action_url_<?php echo $row->id;?>" name="action_url" value="<?php echo $row->action_url;?>" placeholder="The target URL you want to redirect, or auto-complete on post name or permalink." />
                        </div><br>
                        <input type="submit" class="submit_<?php echo $row->id;?>" value="Update" name="Update" />
                    </form>
            </div> 
                

        </td>
            <td><?php echo $row->action_code;?></td>
            <td><?php echo $row->last_access;?></td>

        </tr>
        <?php
    }   
 ?>
