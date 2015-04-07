<?php
	//get receiver details
	if($receiver->num_rows() > 0)
	{
		$row = $receiver->row();
		$receiver_username = $row->user_username;
		$first_name = $row->first_name;
		if(empty($row->user_thumb))
        {
            $receiver_thumb = "http://placehold.it/350x150";
        }
        else
        {
            $receiver_thumb = $this->profile_image_location.$row->user_thumb;

        }
		$receiver_id = $row->user_id;
	}
	
	//get user details
	if($sender->num_rows() > 0)
	{
		$row = $sender->row();
		$user_username = $row->user_username;
		if(empty($row->user_thumb))
        {
            $user_thumb = "http://placehold.it/350x150";
        }
        else
        {
            $user_thumb = $this->profile_image_location.$row->user_thumb;

        }
		$user_id = $row->user_id;
	}

// var_dump($messages);

if(is_array($messages))
{
	$total_messages = count($messages);
	$last = $total_messages - 1;
	
	for($r = $last; $r >= 0; $r--)
	{
		$message_data = $messages[$r];
		$sender = $message_data->user_id;
		$receiver = $message_data->receiver_id;
		$created = $message_data->created;
		$user_message_details = $this->profile_model->convert_smileys($message_data->user_message_details, $smiley_location);
		
		$difference = $this->messages_model->dateDiff($created, $time2 = date("Y-m-d H:i:s"));
		//if I am the one receiving align left
		if($receiver == $user_id)
		{
			echo 
			'
				
				<div class="media">
	                <div class="media-left">
	                    <a href="#">
	                        <img src="'.$receiver_thumb.'" width="60" height="60" alt="woman" class="img-circle"  />
	                    </a>
	                </div>
	                <div class="media-body message">
	                    <div class="panel panel-default">
	                        <div class="panel-heading panel-heading-white">
	                            <div class="pull-right">
	                                <small class="text-muted">'.$difference.'</small>
	                            </div>
	                            <a href="#">'.$first_name.'.</a>
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
	                                <small class="text-muted">'.$difference.'</small>
	                            </div>
	                            <a href="#">Me</a>
	                        </div>
	                        <div class="panel-body">
	                            '.$user_message_details.'
	                        </div>
	                    </div>
	                </div>
	                <div class="media-right">
	                    <img src="'.$user_thumb.'" width="60" height="60" alt="" class="img-circle" />
	                </div>
	            </div>
			';
		}
	}
}
?>
            
<div class="center-align" id="send_error"></div>
    
	