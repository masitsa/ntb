<?php
    //get receiver details
    if(!isset($receiver))
    {
        
    }
    else
    {
        if($receiver->num_rows() > 0)
        {
            $row = $receiver->row();
            $receiver_username = $row->user_username;
            $receiver_id = $row->user_id;
        }
    }
?>

    <?php echo smiley_js(); ?>
 <div class="container-fluid">
    <div class="media messages-container media-clearfix-xs-min media-grid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default" style="padding:10px;">
                    <div class="media-left">
                        <div class="messages-list">
                            <div class="panel panel-default">
                                <ul class="list-group">
                                    <?php
                                    if ($users->num_rows() > 0)
                                    {
                                        $count = $page;
                                        
                                        foreach ($users->result() as $row)
                                        {
                                            $user_id = $row->user_id;
                                            $user_first_name = $row->first_name;
                                            $user_last_name = $row->other_names;
                                            $user_username = $row->user_username;
                                            if(empty($row->user_thumb))
                                            {
                                                $receiver_thumb = "http://placehold.it/350x150";
                                            }
                                            else
                                            {
                                                $receiver_thumb = $this->profile_image_location.$row->user_thumb;

                                            }
                                            $name = $user_first_name." ".$user_last_name;
                                            $count++;
                                            
                                            echo '
                                                <li class="list-group-item ">
                                                    <a href="'.base_url().'messages/'.$user_username.'">
                                                        <div class="media">
                                                            <div class="media-left">
                                                                <img src="'.$receiver_thumb.'" width="50" height="50" alt="" class="img-circle"/>
                                                            </div>
                                                            <div class="media-body">
                                                                <span class="date">Today</span>
                                                                <span class="user">'.$name.'</span>
                                                                <div class="message">Are we ok to meet...</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                ';
                                        }
                                    }
                                        ?>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                    if(isset($receiver))
                    {
                    ?>
                    <div class="media-body">
                            <div class="panel panel-default share">
                             <?php
                                echo form_open('site/messages/message_profile', array('class' => 'send_message2', 'id' => 'compose_message'));
                                echo form_hidden('receiver_id', $receiver_id);
                            ?>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary" href="#">
                                            <i class="fa fa-envelope"></i> Send
                                        </button>
                                        
                                         <!-- <i class="fa fa-envelope"></i><input name="submit" class="btn btn-primary" value="Send " type="submit"> -->
                                    </div>
                                    <input type="text" name="user_message_details" id="instant_message" class="form-control share-text" placeholder="Write message..." />
                                    <!-- <textarea name="client_message_details" id="instant_message2" class="form-control input"  size="20" placeholder="Enter message" required="required"></textarea> -->
                                    <div class="input-group-btn">
                                        <a class="btn btn-info" href="javascript:hideshow(document.getElementById('adiv'))">
                                         Smilies
                                        </a>
                                     </div>
                                </div>
                            </div>
                 
                            <script type="text/javascript">
                            function hideshow(which){
                            if (!document.getElementById)
                            return
                            if (which.style.display=="block")
                            which.style.display="none"
                            else
                            which.style.display="block"
                            }
                            </script>
                             
                            <div id="adiv" style=" display: none">
                                <?php echo $smiley_table;?>
                            </div>
                                
                        <?php echo form_close();?>
                        <div id="view_message">
                        <?php echo $this->load->view('messages/message_details');?>
                        </div>
                     
                    </div>
                <?php
                }
                else
                {
                    ?>
                    <div class="media-body">
                            <div class="alert alert-info">
                            <h4>Notice:</h4>
                                <p>Click on one of the people in the left navigation to view messages.</p>
                            </div>
                        
                    </div>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>