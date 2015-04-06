<?php 
if($meeting_id == NULL)
{

}
else
{
	$meeting_detail = $this->events_model->get_event_name($meeting_id);
	if ($meeting_detail->num_rows() > 0)
	{
	    foreach ($meeting_detail->result() as $row)
	    {
	        $meeting_id = $row->meeting_id;
	        $meeting_date = $row->meeting_date;
	        $meeting_status = $row->meeting_status;
	        $end_date = $row->end_date;
	        $country_id = $row->country_id;
	        $country_name = $row->country_name;

	        $event_type_id = $row->event_type_id;
	        $event_type_name = $row->event_type_name;
	        $agency_id = $row->agency_id;

	        $agency_name = $row->agency_name;
	        $location = $row->location;
	        $subject = $row->subject;
	        $parent_meeting = $row->parent_meeting;
	        // get the parent meeting name
	        $meeting_name = $this->events_model->get_parent_meeting_name($parent_meeting);
	        // get the parent meeting ends

	        // 


	        $meeting_date = date('j M Y',strtotime($meeting_date));
	        $end_date = date('j M Y',strtotime($end_date));
	    }
	}
	$attendee_det = $this->social_model->get_attendee_detail($email_address,$meeting_id);
	if($attendee_det->num_rows() > 0)
	{
		foreach ($attendee_det->result() as $key) {
			# code...
			$attendee_first_name = $key->attendee_first_name;
		}
	}
	else
	{
			$attendee_first_name = '';
			$attendee_title = '';
		
	}
	?>
	<div class="container-fluid">
    <div class="media messages-container media-clearfix-xs-min media-grid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default" style="padding:10px;">
	                 <div class="panel-heading panel-heading-gray">
	                 	<h4>Subject : <?php echo $subject;?></h4>
				         <p><span>Event Dates : </span> <?php echo $meeting_date;?> - <?php echo $end_date;?></p>
				          <p><span>Event type :</span> <?php echo $event_type_name;?>, <span>Agency :</span> <?php echo $agency_name;?></p>
				         <p><span>Country :</span> <?php echo $country_name;?>,<span> Location : <span/><?php echo $location;?></p>
			        </div>
			        <div class="panel-body">
	                	<div class="row">
	                		<div class="col-sm-12">
	                		<?php 
	                		if($meeting_id == NULL)
	                		{

	                		}
	                		else
	                		{
	                			echo $this->load->view('site/events/show_agenda');
	                		}
	                		?>

	                		</div>
	                	</div>

	                	<div class="media">
			                
			               <div class="media-body">
			               	<h5>Post Comment</h5>
                            <div class="panel panel-default share">

				      	 		 <form enctype="multipart/form-data" meeting_id="<?php echo $meeting_id;?>" action="<?php echo base_url();?>save-meeting-comment/<?php echo $meeting_id;?>"  id = "meeting_agenda_comment_form" method="post">
	                                <div class="input-group">
	                                    <div class="input-group-btn">
	                                        <button class="btn btn-primary" href="#">
	                                            <i class="fa fa-envelope"></i> Send
	                                        </button>
	                                        
	                                         <!-- <i class="fa fa-envelope"></i><input name="submit" class="btn btn-primary" value="Send " type="submit"> -->
	                                    </div>
	                                    <input type="hidden" name='attendee_first_name' value="<?php echo $attendee_first_name?>">
	                                    <input type="hidden" name="attendee_email" value="<?php echo $email_address;?>">
	                                    <input type="text" name="attendee_comment" id="attendee_comment" class="form-control share-text" placeholder="Write message..." />
	                                 </div>
	                             </form>
	                         </div>
	                          <div id="view_message">

			                        <!-- ajax function for all the comments -->
			                        <div id="comments"></div>
			                        <!-- end of the ajax function for the comments -->
			                 </div>
			               </div>
			            </div>
		            </div>
                </div>
           	</div>
        </div>
    </div>
</div>
	<?php
}


?>


<script type="text/javascript">
$(document).ready(function(){
  meeting_comments(<?php echo $meeting_id;?>);
});
function meeting_comments(meeting_id)
{
	var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }

    var url = "<?php echo base_url();?>meeting-comments/"+meeting_id;

            
    if(XMLHttpRequestObject) {
        
        var obj = document.getElementById("comments");
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
                obj.innerHTML = XMLHttpRequestObject.responseText;
               
             
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}

</script>