
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .label{
            margin-right: 60px;
            margin-left: 10px;
        }
       
        .delete {
            color: #2271b1;
        }
        .edit {
            color: #2271b1;
        }
        .del {
            color: #2271b1;
        }
        .add{
            color: #2271b1;
        }
    </style>
</head>
    <body>
        <h4 class="error-msg"></h4>

            <table class="table table-striped table-bordered" >
                <thead>
                    <tr>
                    <th style = 'width:10%'>ID</th>
                        <th style = 'width:40%'>Url</th>
                        <th style = 'width:25%'>Code</th>
                        <th style = 'width:25%'>Last_acess</th>
                    </tr>
                </thead>
                
                <tbody id = "showtable">
                <td class = "error"></td>
                </tbody>
            </table>

        <form method="post" id = "insert_form" >
        <h1>Add new redirection</h1>
            <div class="mb-3 mt-3">
                <label class = "label" >Tittle</label>
                <input type="text"  class = "title w-25 " name="title" value="" placeholder="Describe the purpose of this redirect (optional)" required />
            </div>
            <div class="mb-3 mt-3">
                <label class = "label">Source URL</label>
                <input type="text" class = "url w-25" name="url" value="" placeholder="The relative URL you want to redirect from" required />
            </div>
            <div class="mb-3 mt-3">
                <label class = "label">Action_code</label>
                <select name="action_code" class = "action_code"  required>
                    <option value="301">301 - Moved Permanently</option>
                    <option value="302">302 - Found</option>
                    <option value="303">303 - See Other</option>
                    <option value="304">304 - Not Modified</option>
                    <option value="307">307 - Temporary Redirect</option>
                    <option value="308">308 - Permanent Redirect</option>
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label class = "label">Action_type</label>
                <select name="action_type" class="action_type" required>
                    <option value="URL">URL</option>
                    <option value="URL-login">URL and login</option>
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label class = "label">action_url</label>
                <input type="text" class = "action_url w-25" name="action_url" value="" placeholder="The target URL you want to redirect, or auto-complete on post name or permalink."  required />
            </div>
            <input type="submit" value="Add_Redirect" name="Add_Redirect" />
        </form>
      
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
             show_table();
            $('#insert_form').on('submit',function(e){
                e.preventDefault();
                var Itittle = $('.title').val();
                var Iurl = $('.url').val();
                var Iaction_code = $('.action_code').val();
                var Iaction_type = $('.action_type').val();
                var Iaction_url = $('.action_url').val();
                // alert(Itittle);
                // alert(Iurl);
                // alert(Iaction_code);
                // alert(Iaction_type);
                // alert(Iaction_url);
                $.ajax({
                        url: '<?php echo plugin_dir_url( __FILE__ );?>insert.php',
                        type: 'POST',
                        data: { tittle : Itittle,
                                url : Iurl,
                                action_code : Iaction_code,
                                action_type : Iaction_type,
                                action_url : Iaction_url,
                        
                                },
                        success: function(response) {
                            console.log(response);
                            if(response){
                                show_table();
                                $('#insert_form').trigger("reset");
                            // $('.error-msg').html(response); 
                            }else{
                            $('.error-msg').html('Error in inserting data');  
                            }

                        }
                    });




            });


            function show_table(){
                $.ajax({
                        url: '<?php echo plugin_dir_url( __FILE__ );?>show_form.php',
                        type: 'GET',
                        success: function(response) {
                            //console.log(response);
                            if(response){
                                $('#showtable').html(response);
                            }else{
                                $('.error').text('no record found');
                            }
                        }
                    });
                }

            $(document).on('click','.delete',function(){
            
                if (confirm('Are you sure?')) {
                    var row = this;
                    var id = $(this).attr("data-did");
                    $.ajax({
                        url: '<?php echo plugin_dir_url( __FILE__ );?>delete.php',
                        type: 'POST',
                        data: { urlId : id },
                        success: function(response) {
                            console.log(response);
                            if(response == 1){
                                $(row).closest('tr').css('background','grey');
                                    $(row).closest('tr').fadeOut(300,function(){
                                    $(this).remove();
                                    });
                                    $('.error').text('Nothing to display');
                            }else{
                                    alert('Invalid ID.');
                                }
                        }
                    });
                }
            });

            
            
                $(document).on('click','.edit', function() {
                var id = $(this).data("eid");
                $('.update_form_' + id).toggle();
                $('#updateform_' + id).on('submit',function(e){
                        e.preventDefault();
                        var Uid = $('.id_' + id).val();
                        var tittle = $('.tittle_' + id).val();
                        var url = $('.url_' + id).val();
                        var selected = $('.selected_' + id).val();
                        var action_type = $('.action_type_' + id).val();
                        var action_url = $('.action_url_' + id).val();
                    // alert(Uid);
                        // alert(url);
                        // alert(selected);
                        // alert(action_type);
                        // alert(action_url);
                        $.ajax({
                        url: '<?php echo plugin_dir_url( __FILE__ );?>update.php',
                        type: 'POST',
                        data: { Eid : id ,
                                Etittle : tittle,
                                Eurl : url ,
                                Eselected : selected,
                                Eaction_type : action_type,
                                Eaction_url : action_url
                            },
                        success: function(response) {
                            console.log(response);
                            if(response){
                                $('.update_form_' + id).hide ();
                                show_table();

                                
                            }
                        }
                    });

                    });
                
                });

                $disable_redirect = true;
                $(document).on('click','.del',function(){
                    
                    var id = $(this).attr("data-id");
                    //alert(id);
                    
                    $disable_redirect = !$disable_redirect;
                    $.ajax({
                        url: '<?php echo plugin_dir_url( __FILE__ );?>status.php',
                        type: 'POST',
                        data: {
                            sId : id ,
                            },
                        success: function(response) {
                        
                            $(".enable_" + id ).show();
                            $(".disable_" + id ).hide();

                        }
                    });
                });


            

        </script> 
    </body>
</html>


