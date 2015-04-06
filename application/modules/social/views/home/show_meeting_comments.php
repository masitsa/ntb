<?php 

$query = $this->social_model->get_all_meeting_comments($meeting_id);
if($query->num_rows() > 0)
{
	foreach ($query->result() as $key) {
		# code...
		$agenda_comment_id = $key->agenda_comment_id;
		$agenda_comment_description = $key->agenda_comment_description;
		$agenda_comment_user = $key->agenda_comment_user;
		$agenda_comment_email = $key->agenda_comment_email;
		$comment_created = $key->comment_created;

		$difference = $this->messages_model->dateDiff($comment_created, $time2 = date("Y-m-d H:i:s"));
		
		echo '
		<div class="media">
		    <div class="media-body message">
		        <div class="panel panel-default">
		            <div class="panel-heading panel-heading-white">
		                <div class="pull-right">
		                    <small class="text-muted">'.$difference.'</small>
		                </div>
		                <a href="#">'.$agenda_comment_user.'</a>
		            </div>
		            <div class="panel-body">
		                '.$agenda_comment_description.'
		            </div>
		        </div>
		    </div>
		</div>
		';
	}
}
else
{

}

?>

