<link rel="stylesheet" href="<?php echo base_url();?>assets/themes/minified/themes/default.min.css" type="text/css" media="all" />

<script src="<?php echo base_url();?>assets/themes/minified/jquery.sceditor.bbcode.min.js"></script>
<script>
			// Source: http://www.backalleycoder.com/2011/03/20/link-tag-css-stylesheet-load-event/
			var loadCSS = function(url, callback){
				var link = document.createElement('link');
				link.type = 'text/css';
				link.rel = 'stylesheet';
				link.href = url;
				link.id = 'theme-style';

				document.getElementsByTagName('head')[0].appendChild(link);

				var img = document.createElement('img');
				img.onerror = function(){
					if(callback) callback(link);
				}
				img.src = url;
			}

			$(document).ready(function() {
				var initEditor = function() {
					$("textarea").sceditor({
						plugins: 'bbcode',
						style: "./minified/jquery.sceditor.default.min.css"
					});
				};

				$("#theme").change(function() {
					var theme = "./minified/themes/" + $(this).val() + ".min.css";

					$("textarea").sceditor("instance").destroy();
					$("link:first").remove();
					$("#theme-style").remove();

					loadCSS(theme, initEditor);
				});

				initEditor();
			});
		</script>
 <div class="container-fluid">
 	<div class="col-md-12 col-lg-12">
     	<h4 class="page-section-heading"></h4>
     	<div class="col-md-12 col-lg-12" style="margin-bottom:5px;">
     		<a href="<?php echo base_url();?>calender"  class="btn btn-info btn-sm " style="margin-right:5px;" >Back Events Calender</a>
	 		<button type="button" class="btn btn-primary btn-sm pull-right " data-toggle="modal" data-target=".bs-example-modal-lg">Add Event</button>

			<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg">
			    <div class="modal-content">
			      
					 <div class="modal-header">
			            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			            <div class="hgroup title">
			                 <h3>You're one step closer to ceating a meeting!</h3>
				                <h5>"" Fill in all the fields to add this meetinf</h5>
			            </div>
			        </div>

					 <form enctype="multipart/form-data" product_id="" action="<?php echo base_url();?>add-event"  id = "product_review_form" method="post">
			      		

			            <div class="modal-body">
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
	 	<div class="col-md-12 col-lg-12">
		 	<?php
		 	$error = $this->session->userdata('error_message');
			$success = $this->session->userdata('success_message');
			$search_result2 = '';
		 	if(!empty($error))
			{
				$search_result2 = '<div class="alert alert-danger">'.$error.'</div>';
				$this->session->unset_userdata('error_message');
			}
			
			if(!empty($success))
			{
				$search_result2 ='<div class="alert alert-success">'.$success.'</div>';
				$this->session->unset_userdata('success_message');
			}
			echo $search_result2;
		 	?>
		</div>

	 	<div class="col-md-12 col-lg-12">
		 	<div class="panel panel-default">




		        <!-- Progress table -->
		        <div class="table-responsive">
		            <table class="table v-middle">
		                <thead>
		                    <tr>
		                        <th width="20">
		                            <div class="checkbox checkbox-single margin-none">
		                                <input id="checkAll" data-toggle="check-all" data-target="#responsive-table-body" type="checkbox" checked>
		                                <label for="checkAll">Check All</label>
		                            </div>
		                        </th>
		                        <th>Subject</th>
		                        <th>Event Date - End Date</th>
		                        <th>Country</th><!-- 
		                        <th>Agency</th>
		                        <th>Event Type</th>
		                        <th>Location</th> -->
		                        <!-- <th>Attendance</th> -->
		                        <th class="text-left" colspan="1">Event Items</th>
		                        <th class="text-left" colspan="3" >Action</th>
		                    </tr>
		                </thead>
		                <tbody id="responsive-table-body">
		                	<?php
		                	//if users exist display them
							if ($query->num_rows() > 0)
							{
								$count = $page;
								foreach ($query->result() as $row)
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


								
								
								


									$meeting_date = date('j M Y',strtotime($meeting_date));
									$end_date = date('j M Y',strtotime($end_date));
									
									//status
									if($meeting_status == 1)
									{
										$status = 'Active';
										$button = '<a class="btn btn-danger btn-xs" href="'.site_url().'deactivate-event/'.$meeting_id.'" onclick="return confirm(\'Do you want to activate '.$subject.'?\');">Deactivate</a>';

									}
									else
									{
										$status = 'Disabled';
										$button = '<a class="btn btn-success btn-xs" href="'.site_url().'activate-event/'.$meeting_id.'" onclick="return confirm(\'Do you want to activate '.$subject.'?\');">Activate</a>';

									}
									
									//create deactivated status display
									if($meeting_status == 0)
									{
										$status = '<span class="label label-danger">Deactivated</span>';
									}
									
				                	?>
					                    <tr>
					                        <td>
					                            <div class="checkbox checkbox-single">
					                                <input id="checkbox1" type="checkbox" checked>
					                                <label for="checkbox1">Label</label>
					                            </div>
					                        </td>
					                         <td>
					                            <?php echo $subject?>
					                        </td>
					                        <td><span class="label label-default"><?php echo $meeting_date;?> - <?php echo $end_date;?></span>
					                        </td>
					                        <td><?php echo $country_name;?></td><!-- 
					                        <td><?php echo $agency_name?></td>
					                        <td><?php echo $event_type_name;?></td>
					                        <td><?php echo $location;?><a href="#"><i class="fa fa-map-marker fa-fw text-muted"></i></a></td> -->
					                       
					                        <!-- <td>
					                            <div class="progress">
					                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
					                                </div>
					                            </div>
					                        </td> -->
					                         <td >

                    					         <a class="btn btn-info btn-xs" href="<?php echo base_url()?>all-facilitators/<?php echo $meeting_id;?>" >Conveyors</a>
					                         	 <a class="btn btn-warning btn-xs" href="<?php echo base_url()?>all-attendees/<?php echo $meeting_id;?>" >Attendees</a>
					                             <a class="btn btn-success btn-xs" href="<?php echo base_url()?>all-action-points/<?php echo $meeting_id;?>" >Action point</a>

					                         </td>
					                        <td >

					                             <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target=".bs-example<?php echo $meeting_id;?>-modal-lg">Edit </button>
					                             <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target=".bs-details<?php echo $meeting_id;?>-modal-lg">Details</button>
					                            
					                             <?php echo $button;?>


					                             <div class="modal fade bs-example<?php echo $meeting_id;?>-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
													  <div class="modal-dialog modal-lg">
													    <div class="modal-content">
													      
															 <div class="modal-header">
													            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													            <div class="hgroup title">
													                 <h3>You're one step closer in editing <?php echo $subject;?>!</h3>
													            </div>
													        </div>

															 <form enctype="multipart/form-data" product_id="" action="<?php echo base_url();?>edit-event/<?php echo $meeting_id;?>"  id = "product_review_form" method="post">
													      		

													            <div class="modal-body">
													                <div class="row">

													                    <div class="col-sm-6">
													                        <div class="control-group">
													                            <label class="control-label">Meeting Date</label>
													                            <div class="controls">
																					<div class='input-group date' >
																						<input type='text' id='datepicker' name="meeting_date" class="form-control" value="<?php echo $meeting_date;?>" />
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
																						<input type='text' id='datepicker2' name="end_date" class="form-control"  value="<?php echo $end_date;?>"/>
																						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
																					</div>
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
																								$country_id2 = $cont->country_id;
																								$country_name = $cont->country_name;
																								if($country_id == $country_id2)
																								{
																									?>
																									<option value="<?php echo $country_id;?>" selected><?php echo $country_name;?></option>
																									<?php
																								}
																								else
																								{
																									?>
																									<option value="<?php echo $country_id;?>"><?php echo $country_name;?></option>
																									<?php
																								}
																								
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
																								$agency_id2 = $agents->agency_id;
																								$agency_name = $agents->agency_name;

																								if($agency_id == $agency_id2)
																								{
																									?>
																									<option value="<?php echo $agency_id;?>" selected><?php echo $agency_name;?></option>
																									<?php
																								}
																								else
																								{
																									?>
																									<option value="<?php echo $agency_id;?>"><?php echo $agency_name;?></option>
																									<?php
																								}
																								
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
													                            <label for="review_text" class="control-label">Events Type</label>
													                            <div class="controls">
													                            	<select class="form-control" name="event_type_id">
													                              		<?php
													                              		//if users exist display them
																						if ($event_types->num_rows() > 0)
																						{
																							foreach ($event_types->result() as $evt)
																							{
																								$event_type_id2 = $evt->event_type_id;
																								$event_type_name = $evt->event_type_name;
																								if($event_type_id == $event_type_id2)
																								{
																									?>
																									<option value="<?php echo $event_type_id;?>" selected><?php echo $event_type_name;?></option>
																									<?php

																								}
																								else
																								{
																									?>
																									<option value="<?php echo $event_type_id;?>"><?php echo $event_type_name;?></option>
																									<?php
																								}
																								
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
													                            	<input type="text" class="form-control col-md-12" name="location" value="<?php echo $location;?>">
													                            </div>
													                        </div>

													                    </div>
													                    <div class="col-sm-6">
													                        <div class="control-group">
													                            <label for="review_text" class="control-label">Subject</label>
													                            <div class="controls">
													                            	<input type="text" class="form-control col-md-12" name="subject" value="<?php echo $subject;?>">
													                            </div>
													                        </div>

													                    </div>
													                </div>

													            </div>

													            <div class="modal-footer">
													                <div class="pull-right">
													                    <button class="btn btn-primary" type="submit" onclick="">Edit meeting details</button>
													                </div>
													            </div>                         
														</form>
										 
													    </div>
													  </div>
													</div>

													<!-- meeting edit -->

													<!-- meeting details -->
													<div class="modal fade bs-details<?php echo $meeting_id;?>-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
													  <div class="modal-dialog modal-lg">
													    <div class="modal-content">
													      
															 <div class="modal-header">
													            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													            <div class="hgroup title">
													                 <h3> <?php echo $subject;?> Info!</h3>
													            </div>
													        </div>
												            <div class="modal-body">
												            	<div role="tabpanel">

																  <!-- Nav tabs -->
																  <ul class="nav nav-tabs" role="tablist">
																    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Meeting Notes</a></li>
																    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Convenors</a></li>
																    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Attendees</a></li>
																    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Action points</a></li>
																  </ul>

																  <!-- Tab panes -->
																  <div class="tab-content">
																    <div role="tabpanel" class="tab-pane active" id="home">
																	    <div class="row">
														                    <div class="col-sm-12">
														                        <div class="control-group">
														                            <label for="review_text" class="control-label">Minutes</label>
														                            <div class="controls">
																	    				<textarea name="bbcode_field" class="col-md-12" style="height:100px;width:800px;"></textarea>
														                            </div>
														                        </div>

														                    </div>
																	    </div>
																	    <div class="row">
																	    	 <div class="col-sm-12">
														                        <div class="control-group">
														                        <label for="review_text" class="control-label"></label>

														                            <div class="controls">
															                            <div class="pull-right">
																		                    <button class="btn btn-primary" type="submit" onclick="">Edit meeting details</button>
																		                </div>
														                            </div>
														                        </div>

														                    </div>
																	    </div>
																	 </div>
																    <div role="tabpanel" class="tab-pane" id="profile">
																    	<table class="table v-middle">
															                <thead>
															                    <tr>
															                        <th width="20">
															                            <div class="checkbox checkbox-single margin-none">
															                                <input id="checkAll" data-toggle="check-all" data-target="#responsive-table-body" type="checkbox">
															                                <label for="checkAll">Check All</label>
															                            </div>
															                        </th>
															                        <th>Title</th>
															                        <th>First name</th>
															                        <th>Last name</th>
															                        <th>Email</th>
															                        <th>Status</th>
															                        <th class="text-right" colspan="3">Actions</th>
															                    </tr>
															                </thead>
															                <tbody id="responsive-table-body">
													                        <?php
													                        	$facilitators = $this->facilitator_model->get_all_facilitators_time($meeting_id);
													                        	if ($facilitators->num_rows() > 0)
													                            {
													                                $count = $page;
													                                
													                                foreach ($facilitators->result() as $row)
													                                {
													                                    $facilitator_id = $row->facilitator_id;
													                                    $facilitator_first_name = $row->facilitator_first_name;
													                                    $facilitator_last_name = $row->facilitator_last_name;
													                                    $facilitator_title = $row->facilitator_title;
													                                    $facilitator_email = $row->facilitator_email;
													                                    $facilitator_status = $row->facilitator_status;
													                                    $count++;
																						
																						if($facilitator_status == 1)
																						{
																							$status = '<span class="label label-success">Active</span>';
																							$button = '<a class="btn btn-default" href="'.site_url().'deactivate-facilitator/'.$facilitator_id.'" onclick="return confirm(\'Do you want to deactivate '.$facilitator_first_name.'?\');">Deactivate</a>';
																						}
																						
																						else
																						{
																							$status = '<span class="label label-danger">Disabled</span>';
																							$button = '<a class="btn btn-danger" href="'.site_url().'activate-facilitator/'.$facilitator_id.'" onclick="return confirm(\'Do you want to activate '.$facilitator_first_name.'?\');">Activate</a>';
																						}
													                                	
																						?>
													                                    <tr>
													                                        <td>
													                                            <div class="checkbox checkbox-single">
													                                                <input id="checkbox<?php echo $facilitator_id?>" type="checkbox" checked>
													                                                <label for="checkbox<?php echo $facilitator_id?>">Label</label>
													                                            </div>
													                                        </td>
													                                         <td>
													                                            <?php echo $facilitator_title;?>
													                                        </td>
													                                        <td><?php echo $facilitator_first_name;?></td>
													                                        <td><?php echo $facilitator_last_name;?></td>
													                                        <td><?php echo $facilitator_email;?></td>
													                                        <td><?php echo $status;?></td>
													                                        <td><?php echo $button;?></td>
													                                        <td >
													                                             <a href="<?php echo base_url();?>edit-facilitator/<?php echo $facilitator_id;?>" class="btn btn-info">Edit</a>
													                                        </td>
													                                        <td >
													                                             <a href="<?php echo base_url();?>delete-facilitator/<?php echo $facilitator_id;?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete this facilitator?');">Delete</a>
													                                        </td>
													                                    </tr>
													                                    <?php    
													                                }
													                            }
													                            ?>
															                    
															                  
															                </tbody>
															            </table>

																    </div>
																    <div role="tabpanel" class="tab-pane" id="messages">
																    	<table class="table v-middle">
															                <thead>
															                    <tr>
															                        <th width="20">
															                            <div class="checkbox checkbox-single margin-none">
															                                <input id="checkAll" data-toggle="check-all" data-target="#responsive-table-body" type="checkbox">
															                                <label for="checkAll">Check All</label>
															                            </div>
															                        </th>
															                        <th>Title</th>
															                        <th>First name</th>
															                        <th>Last name</th>
															                        <th>Email</th>
															                        <th>Status</th>
															                        <th class="text-right" colspan="3">Actions</th>
															                    </tr>
															                </thead>
															                <tbody id="responsive-table-body">
													                        <?php
													                        $attendees = $this->attendee_model->get_all_attendees_time($meeting_id);
													                        	if ($attendees->num_rows() > 0)
													                            {
													                                $count = $page;
													                                
													                                foreach ($attendees->result() as $row)
													                                {
													                                    $attendee_id = $row->attendee_id;
													                                    $attendee_first_name = $row->attendee_first_name;
													                                    $attendee_last_name = $row->attendee_last_name;
													                                    $attendee_title = $row->attendee_title;
													                                    $attendee_email = $row->attendee_email;
													                                    $attendee_status = $row->attendee_status;
													                                    $count++;
																						
																						if($attendee_status == 1)
																						{
																							$status = '<span class="label label-success">Active</span>';
																							$button = '<a class="btn btn-default" href="'.site_url().'deactivate-attendee/'.$attendee_id.'" onclick="return confirm(\'Do you want to deactivate '.$attendee_first_name.'?\');">Deactivate</a>';
																						}
																						
																						else
																						{
																							$status = '<span class="label label-danger">Disabled</span>';
																							$button = '<a class="btn btn-danger" href="'.site_url().'activate-attendee/'.$attendee_id.'" onclick="return confirm(\'Do you want to activate '.$attendee_first_name.'?\');">Activate</a>';
																						}
													                                	
																						?>
													                                    <tr>
													                                        <td>
													                                            <div class="checkbox checkbox-single">
													                                                <input id="checkbox<?php echo $attendee_id?>" type="checkbox" checked>
													                                                <label for="checkbox<?php echo $attendee_id?>">Label</label>
													                                            </div>
													                                        </td>
													                                         <td>
													                                            <?php echo $attendee_title;?>
													                                        </td>
													                                        <td><?php echo $attendee_first_name;?></td>
													                                        <td><?php echo $attendee_last_name;?></td>
													                                        <td><?php echo $attendee_email;?></td>
													                                        <td><?php echo $status;?></td>
													                                        <td><?php echo $button;?></td>
													                                        <td >
													                                             <a href="<?php echo base_url();?>edit-attendee/<?php echo $attendee_id;?>" class="btn btn-info">Edit</a>
													                                        </td>
													                                        <td >
													                                             <a href="<?php echo base_url();?>delete-attendee/<?php echo $attendee_id;?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete this attendee?');">Delete</a>
													                                        </td>
													                                    </tr>
													                                    <?php    
													                                }
													                            }
													                            ?>
															                    
															                  
															                </tbody>
															            </table>

																    </div>
																    <div role="tabpanel" class="tab-pane" id="settings">
																    	
															               <table class="table v-middle">
															                <thead>
															                    <th width="20">
														                            <div class="checkbox checkbox-single margin-none">
														                                <input id="checkAll" data-toggle="check-all" data-target="#responsive-table-body" type="checkbox">
														                                <label for="checkAll">Check All</label>
														                            </div>
														                        </th>
														                        <th>Created</th>
														                        <th>Assigned to</th>
														                        <th>Priority</th>
														                        <th>Action</th>
														                        <th>Notes</th>
														                        <th class="text-right" colspan="2">Actions</th>
															                </thead>
															                <tbody id="responsive-table-body">
															                	 <?php
															                	 $action_points = $this->action_point_model->get_all_action_points_time($meeting_id);
														                        	if ($action_points->num_rows() > 0)
														                            {
														                                $count = $page;
														                                
														                                foreach ($action_points->result() as $row)
														                                {
														                                    $action_point_id = $row->action_point_id;
														                                    $created = $row->created;
														                                    $priority_status_name = $row->priority_status_name;
														                                    $action_status_name = $row->action_status_name;
														                                    $assigned_to = $row->assigned_to;
														                                    $action_point_notes = $row->action_point_notes;
														                                    $count++;
														                                	
																							?>
														                                    <tr>
														                                        <td>
														                                            <div class="checkbox checkbox-single">
														                                                <input id="checkbox<?php echo $action_point_id?>" type="checkbox" checked>
														                                                <label for="checkbox<?php echo $action_point_id?>">Label</label>
														                                            </div>
														                                        </td>
														                                         <td>
														                                            <span class="label label-default"><?php echo date('jS M Y H:i a',strtotime($created));?></span>
														                                        </td>
														                                        <td><?php echo $assigned_to;?></td>
														                                        <td><?php echo $priority_status_name;?></td>
														                                        <td><?php echo $action_status_name;?></td>
														                                        <td><?php echo $action_point_notes;?></td>
														                                        <td >
														                                             <a href="<?php echo base_url();?>delete-action-point/<?php echo $action_point_id;?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete this action point?');">Delete</a>
														                                        </td>
														                                        <td >
														                                             <a href="<?php echo base_url();?>edit-action-point/<?php echo $action_point_id;?>" class="btn btn-info">Edit</a>
														                                        </td>
														                                    </tr>
														                                    <?php    
														                                }
														                            }
														                            ?>
															                </tbody>
															              </table>

																    </div>
																  </div>

																</div>
												            </div>                        
																
										 
													    </div>
													  </div>
													</div>
													<!-- end of meeting details -->
					                        </td>
					                    </tr>
					                    <?php
					               	}
			                	}
			                    ?>
		                  
		                </tbody>
		            </table>
		        </div>
		        <!-- Large modal -->

		        <!-- // Progress table -->
		    
	            <?php
	                if(isset($links)){echo $links;}
	            ?>
		    </div>
		</div>
	</div>
 </div>

 <script>
 $(document).ready(function() {
	  $(function() {
	    $( "#datepicker" ).datepicker();
	  });
	  $(function() {
	    $( "#datepicker2" ).datepicker();
	  });
	});
  </script>
 <!-- CLEditor -->
