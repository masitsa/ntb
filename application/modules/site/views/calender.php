  <!-- jQuery UI -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/themes/bluish/"?>style/jquery-ui.css"> 
  <!-- Calendar -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/themes/bluish/"?>style/fullcalendar.css">
  
 <div class="container-fluid">

 	
 	<div class="col-md-12 col-lg-12">
	 	<div class="col-md-12 col-lg-12">
        	<?php
				//error messages
				if($this->session->userdata('error_message'))
				{
					?>
					<div class="alert alert-danger">
					  <?php 
						echo $this->session->userdata('error_message');
						$this->session->unset_userdata('error_message');
					  ?>
					</div>
					<?php
				}
				
				//success messages
				if($this->session->userdata('success_message'))
				{
					?>
					<div class="alert alert-success">
					  <?php 
						echo $this->session->userdata('success_message');
						$this->session->unset_userdata('success_message');
					  ?>
					</div>
					<?php
				}
			?>
		 	<div class="panel panel-default" style="height:1000px; padding:15px;">

            	<!-- <div class="row" style="margin-bottom:20px;">
                	<div class="col-md-3 col-md-offset-9">
                    	<button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target=".add-event"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Event</button>
                	</div>
                </div>
 -->
			<div class="modal fade add-event" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg">
			    <div class="modal-content">
			      
					 <div class="modal-header">
			            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			            <div class="hgroup title">
			                 <h3>You're one step closer to creating a meeting!</h3>
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
			                            <label for="review_text" class="control-label">Meeting Type</label>
			                            <div class="controls">
			                            	<select class="form-control" name="meeting_id">
			                            		<option value="0">Parent Meeting</option>
			                              		<?php
			                              		//if users exist display them
			                              		$events_query = $this->events_model->get_events();
												if ($events_query->num_rows() > 0)
												{
													foreach ($events_query->result() as $evts)
													{
														$meeting_id = $evts->meeting_id;
														$subject = $evts->subject;
														$meeting_date = $evts->meeting_date;
														$meeting_date = date('j M Y',strtotime($meeting_date));
														?>
														<option value="<?php echo $meeting_id;?>"><?php echo $subject;?></option>
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
            	<div id="meetings"></div>
		    </div>
		</div>
	</div>
 </div>
 <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
          <div id="meeting_data"></div>  
    </div>
  </div>
</div>
<script src="<?php echo base_url()."assets/themes/bluish/"?>js/jquery-ui-1.10.2.custom.min.js"></script> <!-- jQuery UI -->
<script src="<?php echo base_url()."assets/themes/bluish/"?>js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->

<script type="text/javascript">

	$(document).on("click","a.fc-event",function()
	{			
		var meeting_id = $(this).attr('href');
		
		$.ajax({
			type:'POST',
			url: '<?php echo site_url()?>site/events/get_meeting_details/'+meeting_id,
			cache:false,
			contentType: false,
			processData: false,
			dataType: 'json',
			success:function(data)
			{
				$("#meeting_data").html(data.meeting_data);
			},
			error: function(xhr, status, error) {
				//alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
				$("#meeting_data").html(error);
			}
		});
		return false;
	});
	
$(document).ready(function() {
	
	  $(function() {
	    $( "#datepicker" ).datepicker();
	  });
	  $(function() {
	    $( "#datepicker2" ).datepicker();
	  });
	  
	var config_url = '<?php echo site_url();?>';
	var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
  $.ajax({
	type:'POST',
	url: config_url+"site/get_meetings_schedule",
	cache:false,
	contentType: false,
	processData: false,
	dataType: "json",
	success:function(data){
		
		var meetings = [];
		var total_events = parseInt(data.total_events, 10);

		for(i = 0; i < total_events; i++)
		{
			var data_array = [];
			
			data_title = data.title[i];
			data_start = data.start[i];
			data_end = data.end[i];
			data_backgroundColor = data.backgroundColor[i];
			data_borderColor = data.borderColor[i];
			data_allDay = data.allDay[i];
			data_url = data.url[i];
			
			//add the items to an array
			data_array.title = data_title;
			data_array.start = data_start;
			data_array.end = data_end;
			data_array.backgroundColor = data_backgroundColor;
			data_array.borderColor = data_borderColor;
			data_array.allDay = data_allDay;
			data_array.url = data_url;
			//console.log(data_array);
			meetings.push(data_array);
		}
		console.log(meetings);
		/*for(var i in data){
			meetings.push([i, data [i]]);alert(data[i]);
		}*/
		
		$('#meetings').fullCalendar({
			  header: {
				left: 'prev',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,next'
			  },
			  editable: true,
			  events: meetings
			});
	},
	error: function(xhr, status, error) {
		alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
	}
});

});
</script>