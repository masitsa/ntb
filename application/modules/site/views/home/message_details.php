<?php
	//get receiver details
	if($receiver->num_rows() > 0)
	{
		$row = $receiver->row();
		$receiver_username = $row->client_username;
		$receiver_thumb = $profile_image_location.$row->client_thumb;
		$receiver_id = $row->client_id;
	}
	
	//get client details
	if($sender->num_rows() > 0)
	{
		$row = $sender->row();
		$client_username = $row->client_username;
		$client_thumb = $profile_image_location.$row->client_thumb;
		$client_id = $row->client_id;
	}

var_dump($messages);

if(is_array($messages))
{
	$total_messages = count($messages);
	
	for($r = 0; $r < $total_messages; $r++)
	{
		$message_data = $messages[$r];
		$sender = $message_data->client_id;
		$receiver = $message_data->receiver_id;
		$created = $message_data->created;
		$client_message_details = $this->profile_model->convert_smileys($message_data->client_message_details, $smiley_location);
		
		//if I am the one receiving align left
		if($receiver == $client_id)
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
	                            '.$client_message_details.'
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
	                            '.$client_message_details.'
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
    
	