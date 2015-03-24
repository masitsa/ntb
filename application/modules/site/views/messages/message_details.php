<?php
	//get receiver details
	if($receiver->num_rows() > 0)
	{
		$row = $receiver->row();
		$receiver_username = $row->user_username;
		$receiver_thumb = base_url()."assets/themes/themekit/images/people/110/male.png";//$profile_image_location.$row->user_thumb;
		$receiver_id = $row->user_id;
	}
	
	//get user details
	if($sender->num_rows() > 0)
	{
		$row = $sender->row();
		$user_username = $row->user_username;
		$user_thumb = base_url()."assets/themes/themekit/images/people/110/male.png";//$profile_image_location.$row->user_thumb;
		$user_id = $row->user_id;
	}

// var_dump($messages);

if(is_array($messages))
{
	$total_messages = count($messages);
	
	for($r = 0; $r < $total_messages; $r++)
	{
		$message_data = $messages[$r];
		$sender = $message_data->user_id;
		$receiver = $message_data->receiver_id;
		$created = $message_data->created;
		$user_message_details = $this->profile_model->convert_smileys($message_data->user_message_details, $smiley_location);
		
		//if I am the one receiving align left
		if($receiver == $user_id)
		{
			echo 
			'
				
				<div class="media">
	                <div class="media-left">
	                    <a href="#">
	                        <img src="'.$receiver_thumb.'" width="60" alt="woman" class="media-object" />
	                    </a>
	                </div>
	                <div class="media-body message">
	                    <div class="panel panel-default">
	                        <div class="panel-heading panel-heading-white">
	                            <div class="pull-right">
	                                <small class="text-muted">2 min ago</small>
	                            </div>
	                            <a href="#">Mary D.</a>
	                        </div>
	                        <div class="panel-body">
	                            '.$user_message_details.'
	                        </div>
	                    </div>
	                </div>
	            </div>
			';
		}
		
		//align right
		else
		{
			echo 
			'
				<div class="media">
	                <div class="media-body message">
	                    <div class="panel panel-default">
	                        <div class="panel-heading panel-heading-white">
	                            <div class="pull-right">
	                                <small class="text-muted">10 min ago</small>
	                            </div>
	                            <a href="#">Me</a>
	                        </div>
	                        <div class="panel-body">
	                            '.$user_message_details.'
	                        </div>
	                    </div>
	                </div>
	                <div class="media-right">
	                    <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/male.png" width="60" alt="" class="media-object" />
	                </div>
	            </div>
			';
		}
	}
}
?>
            
<div class="center-align" id="send_error"></div>
    
	