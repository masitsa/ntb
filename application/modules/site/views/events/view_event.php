 <?php
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

// follwo up actions start

// check if there is a follow up meeting
   $check_follow = $this->events_model->check_for_followup_meetings($meeting_id);
// end of checking 

 if($check_follow > 0)
 {
 	$button_front = '<a href="'.base_url().'view-meeting/'.$check_follow.'" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-long-arrow-right"></i> Next child meeting</a>';
 	$button_back = '<a href="'.base_url().'all-events" class="btn btn-info btn-sm"><i class="fa fa-fw fa-mail-reply"></i> Back to events list</a>';
 	$previous_followup = $this->events_model->check_for_prev_followup_meetings_parent($check_follow);
	if($previous_followup > 0)
	{

 		// since there is a next get the previous one
		// means that there is a previous followup
		$button_back .= '<a href="'.base_url().'view-meeting/'.$previous_followup.'" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-long-arrow-left"></i> Prev child meeting</a>'; 
	}
	else
	{
		$button_back .= '';
	}
 }
 else
 {

 	$button_front = '';
 	$button_back = '<a href="'.base_url().'all-events" class="btn btn-info btn-sm"><i class="fa fa-fw fa-mail-reply"></i> Back to events list</a>';
 }

// check if this is a follow up meeting
  $check_if_followup = $this->events_model->check_if_followup_meetings($meeting_id);

 if($check_if_followup > 0 )
 {
 	// parent_id == $checkoiffollowup

 	// get the next and previous follow up
 	// get the next 
 	 $next_followup = $this->events_model->check_for_followup_meetings($check_if_followup);

 	if($next_followup > 0 and $next_followup != $meeting_id)
 	{
 		$button_front = '';
 		$button_front = '<a href="'.base_url().'view-meeting/'.$next_followup.'" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-long-arrow-right"></i> Next child meeting</a>';
 		$button_back = '<a href="'.base_url().'view-meeting/'.$check_if_followup.'" class="btn btn-info btn-sm"><i class="fa fa-fw fa-mail-reply"></i> Back to parent meeting</a>';
 		// since there is a next get the previous one
 		$previous_followup = $this->events_model->check_for_prev_followup_meetings($next_followup,$check_if_followup);
 		if($previous_followup > 0)
 		{
 			// means that there is a previous followup
 			$button_back .= '<a href="'.base_url().'view-meeting/'.$previous_followup.'" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-long-arrow-left"></i> Prev child meeting</a>'; 
 		}
 		else
 		{
 			$button_back .= '';
 		}
 	}
 	else
 	{
 		$button_front = '';
 		$button_back = '';
 		$button_back = '<a href="'.base_url().'view-meeting/'.$check_if_followup.'" class="btn btn-info btn-sm"><i class="fa fa-fw fa-mail-reply"></i> Back to parent event</a>';

 	}
 	// previous follow up 
 	
 }
 else
 {

 }
// end of checking 

// end of follow up actions 
?>


 <div class="container-fluid">
	<div class="row" style="margin-bottom:5px">
	 	<div class="col-md-12 col-lg-12">
	 		<div class="pull-left">
	 		 <?php echo $button_back;?>
	 		 
	 		</div>
	 		<div class="pull-right">
	 			<?php echo $button_front;?>
	 			<a class="btn btn-success btn-sm"  data-toggle="modal" data-target=".add-event"><i class="fa fa-fw fa-plus-square"></i> Add a follow meeting</a>
	 				<div class="modal fade add-event" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg">
					    <div class="modal-content">
					      
							 <div class="modal-header">
					            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					            <div class="hgroup title">
					                 <h4>Creating a follow-up meeting for <?php echo $subject;?></h4>
					            </div>
					        </div>

							 <form enctype="multipart/form-data" product_id="" action="<?php echo base_url();?>add-event"  id = "product_review_form" method="post">
					      		

					            <div class="modal-body">
					            	<!-- <div class="row">
					            		 <div class="col-sm-12">
						            		 <div class="form-group margin-none">
			                                    <label for="reservationtime">Meeting Dates:</label>
			                                    <div class="input-group">
			                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			                                        <input type="text" name="reservation" id="reservationtime" class="form-control" value="07-10-2014 1:00 PM - 07-10-2014 1:30 PM" />
			                                    </div>
			                                </div>
			                              </div>
					            	</div> -->
					                <div class="row">

					                    <div class="col-sm-6">
					                        <div class="control-group">
					                            <label class="control-label">Meeting Date</label>
					                            <div class="controls">
													<div class='input-group date' >
														<input type='text' id='datepicker' name="meeting_date" class="form-control" />
														<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
													</div>
					                            </div>
					                        </div>

					                    </div>

					                    <div class="col-sm-6">
					                        <div class="control-group">
					                            <label class="control-label">End Date</label>
					                            <div class="controls">
													<div class='input-group date' >
														<input type='text' id='datepicker2' name="end_date" class="form-control" />
														<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
													</div>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					                <div class="row">
					                    <div class="col-sm-6">
					                        <div class="control-group">
					                            <label for="review_text" class="control-label">Parent meeting</label>
					                            <div class="controls">
					                            	<select class="form-control" name="meeting_id">
					                            		<option value="<?php echo $meeting_id;?>"><?php echo $subject;?></option>
					                              		  	
					                              </select>	  
					                            </div>
					                        </div>

					                    </div>
					                    <div class="col-sm-6">
					                        <div class="control-group">
					                            <label for="review_text" class="control-label">Events Type</label>
					                            <div class="controls">
					                            	<select class="form-control" name="event_type_id">
					                              		<?php
					                              		//if users exist display them
														if ($event_types->num_rows() > 0)
														{
															foreach ($event_types->result() as $evt)
															{
																$event_type_id = $evt->event_type_id;
																$event_type_name = $evt->event_type_name;
																?>
																<option value="<?php echo $event_type_id;?>"><?php echo $event_type_name;?></option>
																<?php
															}
														}
					                              		?>     	
					                              </select>	  
					                            </div>
					                        </div>

					                    </div>
					                </div>

					                <div class="row">
					                    <div class="col-sm-6">
					                        <div class="control-group">
					                            <label for="review_author_name" class="control-label">Country</label>
					                            <div class="controls">
					                             <select class="form-control" name="country_id">
					                              		<?php
					                              		//if users exist display them
														if ($countries->num_rows() > 0)
														{
															foreach ($countries->result() as $cont)
															{
																$country_id = $cont->country_id;
																$country_name = $cont->country_name;
																?>
																<option value="<?php echo $country_id;?>"><?php echo $country_name;?></option>
																<?php
															}
														}
					                              		?>     	
					                              </select>
					                            </div>
					                        </div>
					                    </div>

					                    <div class="col-sm-6">
					                        <div class="control-group">
					                            <label for="review_author_email" class="control-label">Agency</label>
					                            <div class="controls">
													<select class="form-control" name="agency_id">
					                              		<?php
					                              		//if users exist display them
														if ($agencies->num_rows() > 0)
														{
															foreach ($agencies->result() as $agents)
															{
																$agency_id = $agents->agency_id;
																$agency_name = $agents->agency_name;
																?>
																<option value="<?php echo $agency_id;?>"><?php echo $agency_name;?></option>
																<?php
															}
														}
					                              		?>     	
					                              </select>	                            
					                             </div>
					                        </div>
					                    </div>
					                </div>

					                
					                  <div class="row">
					                    <div class="col-sm-6">
					                        <div class="control-group">
					                            <label for="review_text" class="control-label">Location</label>
					                            <div class="controls">
					                            	<input type="text" class="form-control col-md-12" name="location">
					                            </div>
					                        </div>

					                    </div>
					                    <div class="col-sm-6">
					                        <div class="control-group">
					                            <label for="review_text" class="control-label">Subject</label>
					                            <div class="controls">
					                            	<input type="text" class="form-control col-md-12" name="subject">
					                            </div>
					                        </div>

					                    </div>
					                </div>

					            </div>

					            <div class="modal-footer">
					                <div class="pull-right">
					                    <button class="btn btn-primary" type="submit" onclick="">Submit Meeting info</button>
					                </div>
					            </div>                         
						</form>
		 
					    </div>
					  </div>
					</div>
	 		</div>
	 	</div>
	</div>
	<div class="row">
	 	<div class="col-md-12 col-lg-12">
		 	<div class="panel panel-default">
			 	<div class="modal-header">
				    <div class="hgroup title">
				         <h4>Subject : <?php echo $subject;?></h4>
				         <p><span>Event Dates : </span> <?php echo $meeting_date;?> - <?php echo $end_date;?></p>
				          <p><span>Event type :</span> <?php echo $event_type_name;?>, <span>Agency :</span> <?php echo $agency_name;?></p>
				         <p><span>Country :</span> <?php echo $country_name;?>,<span> Location : <span/><?php echo $location;?></p>
				         <p><span>Parent Meeting :</span> <?php echo $meeting_name;?></p>
				    </div>
				</div>
				<div class="modal-body">
				    <div role="tabpanel">

				      <!-- Nav tabs -->
				      <ul class="nav nav-tabs" role="tablist">
				      	<li role="presentation" class="active"><a href="#agenda" aria-controls="agenda" role="tab" data-toggle="tab">Meeting Agenda</a></li>
				        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Convenors</a></li>
				        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Attendees</a></li>
				        <li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Meeting Minutes</a></li>
				        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Action points</a></li>
				        <li role="presentation"><a href="#attachments" aria-controls="attachments" role="tab" data-toggle="tab">Attachments</a></li>
				      	<li role="presentation"><a href="#followups" aria-controls="followups" role="tab" data-toggle="tab">Follow up meetings</a></li>

				      </ul>


				      <!-- Tab panes -->
				      <div class="tab-content">
				      	 <div role="tabpanel" class="tab-pane active" id="agenda">
				      	 	 <form enctype="multipart/form-data" meeting_id="<?php echo $meeting_id;?>" action="<?php echo base_url();?>save-meeting-agenda-comment/<?php echo $meeting_id;?>"  id = "meeting_agenda_form" method="post">

				                <div class="row">
				                    <div class="col-sm-12">
				                    	<!-- javascript model -->
                        				<?php echo $this->load->view('show_agenda');?>
				                    	<!-- end of this script -->
				                    </div>
				                </div>
				                <div class="row">
				                     <div class="col-sm-12">
				                        <div class="control-group">
				                        <label for="review_text" class="control-label"></label>

				                            <div class="controls">
				                                <div class="pull-right">
				                                    <button class="btn btn-primary btn-sm" type="submit">Edit meeting details</button>
				                                      <!-- <a hred="#" class="btn btn-large btn-success btn-sm" onclick="save_meeting_notes(<?php echo $meeting_id;?>)">Save Nurse Notes</a> -->
				                                </div>
				                            </div>
				                        </div>

				                    </div>
				                </div>
				             </form>
				      	 </div>
				        <div role="tabpanel" class="tab-pane" id="home">
				           <form enctype="multipart/form-data" meeting_id="<?php echo $meeting_id;?>" action="<?php echo base_url();?>save-meeting-notes/<?php echo $meeting_id;?>"  id = "meeting_notes_form" method="post">

				                <div class="row">
				                    <div class="col-sm-12">
				                    	<!-- javascript model -->
                        				<?php echo $this->load->view('show_minutes');?>
				                    	<!-- end of this script -->
				                    </div>
				                </div>
				                <div class="row">
				                     <div class="col-sm-12">
				                        <div class="control-group">
				                        <label for="review_text" class="control-label"></label>

				                            <div class="controls">
				                                <div class="pull-right">
				                                    <button class="btn btn-primary btn-sm" type="submit">Edit meeting details</button>
				                                      <!-- <a hred="#" class="btn btn-large btn-success btn-sm" onclick="save_meeting_notes(<?php echo $meeting_id;?>)">Save Nurse Notes</a> -->
				                                </div>
				                            </div>
				                        </div>

				                    </div>
				                </div>
				             </form>
				         </div>
				        <div role="tabpanel" class="tab-pane" id="profile">
				        	<!-- facilitators div -->
				        	<div id='facilitators'></div>
				        	<!-- facilitators div -->
				        </div>
				        <div role="tabpanel" class="tab-pane" id="messages">
				           
				        <!-- attendees div  -->
				        	<div id='attendees'></div>
				        <!-- end of attendees div -->
				        </div>
				        <div role="tabpanel" class="tab-pane" id="settings">
		   			      <!-- action points -->
		   			      	<div id="action_points"></div>
		   			      <!-- end of action points -->
				        </div>
				        <div role="tabpanel" class="tab-pane" id="attachments">
				            <!-- meeting attachments -->
				            	<div id="attachments"></div>
				            <!-- meeting attachments -->
				        </div>
				         <div role="tabpanel" class="tab-pane" id="followups">
				         	<div class="row">
				                <div class="col-sm-12">
				                	<?php echo $this->load->view('show_follow_up_meetings');?>
				                </div>
				            </div>
				         </div>
				      </div>

				    </div>
				</div>
		 	</div>
		</div>
	</div>
</div>
<script text="javascript">

$(document).ready(function(){
  meeting_facilitator(<?php echo $meeting_id;?>);
  meeting_attendees(<?php echo $meeting_id;?>);
  meeting_action_points(<?php echo $meeting_id;?>);
  meeting_attachments(<?php echo $meeting_id;?>);
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  $(function() {
    $( "#datepicker2" ).datepicker();
  });
});

function meeting_facilitator(meeting_id){

    var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }

    var url = "<?php echo base_url();?>meeting-facilitators/"+meeting_id;

            
    if(XMLHttpRequestObject) {
        
        var obj = document.getElementById("facilitators");
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
                obj.innerHTML = XMLHttpRequestObject.responseText;
               
             
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}
function meeting_attachments(meeting_id){

    var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }

    var url = "<?php echo base_url();?>meeting-attachments/"+meeting_id;

            
    if(XMLHttpRequestObject) {
        
        var obj = document.getElementById("attachments");
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
                obj.innerHTML = XMLHttpRequestObject.responseText;
               
             
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}
function meeting_attendees(meeting_id)
{
	var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }

    var url = "<?php echo base_url();?>meeting-attendees/"+meeting_id;
    // window.alert(url);
            
    if(XMLHttpRequestObject) {
        
        var obj = document.getElementById("attendees");
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
                obj.innerHTML = XMLHttpRequestObject.responseText;
               
             
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}
function meeting_action_points(meeting_id)
{
	var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }

    var url = "<?php echo base_url();?>meeting-action-points/"+meeting_id;
    // window.alert(url);
            
    if(XMLHttpRequestObject) {
        
        var obj = document.getElementById("action_points");
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
                obj.innerHTML = XMLHttpRequestObject.responseText;
               
             
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}

function deactivate_facilitator(facilitator_id,meeting_id)
{
	var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = "<?php echo base_url();?>deactivate-facilitator/"+facilitator_id+"/"+meeting_id;
    if(XMLHttpRequestObject) {
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                meeting_facilitator(meeting_id);
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}
function activate_facilitator(facilitator_id,meeting_id)
{
	var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = "<?php echo base_url();?>activate-facilitator/"+facilitator_id+"/"+meeting_id;
    if(XMLHttpRequestObject) {
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                meeting_facilitator(meeting_id);
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}
function delete_facilitator(facilitator_id,meeting_id)
{
	var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = "<?php echo base_url();?>delete-facilitator/"+facilitator_id+"/"+meeting_id;
    if(XMLHttpRequestObject) {
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                meeting_facilitator(meeting_id);
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}

function deactivate_attendee(attendee_id,meeting_id)
{
	var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = "<?php echo base_url();?>deactivate-attendee/"+attendee_id+"/"+meeting_id;
    if(XMLHttpRequestObject) {
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                meeting_attendees(meeting_id);
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}
function activate_attendee(attendee_id,meeting_id)
{
	var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = "<?php echo base_url();?>activate-attendee/"+attendee_id+"/"+meeting_id;
    if(XMLHttpRequestObject) {
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                meeting_attendees(meeting_id);
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}
function delete_attendee(attendee_id,meeting_id)
{
	var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = "<?php echo base_url();?>delete-attendee/"+attendee_id+"/"+meeting_id;
    if(XMLHttpRequestObject) {
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                meeting_attendees(meeting_id);
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}
// start of action point actions
function deactivate_action_point(action_point_id,meeting_id)
{
	var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = "<?php echo base_url();?>deactivate-action-point/"+action_point_id+"/"+meeting_id;
    if(XMLHttpRequestObject) {
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                meeting_action_points(meeting_id);
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}
function activate_action_point(action_point_id,meeting_id)
{
	var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = "<?php echo base_url();?>activate-action-point/"+action_point_id+"/"+meeting_id;
    if(XMLHttpRequestObject) {
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                meeting_action_points(meeting_id);
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}
function delete_action_point(action_point_id,meeting_id)
{
	var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = "<?php echo base_url();?>delete-action-point/"+action_point_id+"/"+meeting_id;
    if(XMLHttpRequestObject) {
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                meeting_action_points(meeting_id);
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}
// end of action points actions

// start of attachments actions
function deactivate_attachment(attachment_id,meeting_id)
{
	var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = "<?php echo base_url();?>deactivate-attachment/"+attachment_id+"/"+meeting_id;

    if(XMLHttpRequestObject) {
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                meeting_attachments(meeting_id);
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}
function activate_attachment(attachment_id,meeting_id)
{
	var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = "<?php echo base_url();?>activate-attachment/"+attachment_id+"/"+meeting_id;
    if(XMLHttpRequestObject) {
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                meeting_attachments(meeting_id);
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}
function delete_attachment(attachment_id,meeting_id)
{
	var XMLHttpRequestObject = false;
        
    if (window.XMLHttpRequest) {
    
        XMLHttpRequestObject = new XMLHttpRequest();
    } 
        
    else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = "<?php echo base_url();?>delete-attachment/"+attachment_id+"/"+meeting_id;
    if(XMLHttpRequestObject) {
                
        XMLHttpRequestObject.open("GET", url);
                
        XMLHttpRequestObject.onreadystatechange = function(){
            
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                meeting_attachments(meeting_id);
            }
        }
                
        XMLHttpRequestObject.send(null);
    }
}
// end of attachment actions
</script>
  <!-- jQuery UI -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/themes/bluish/"?>style/jquery-ui.css"> 
  <!-- Calendar -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/themes/bluish/"?>style/fullcalendar.css">