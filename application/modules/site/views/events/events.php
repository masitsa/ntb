 
 <div class="container-fluid">
 	
 	<div class="col-md-12 col-lg-12">
     	<h4 class="page-section-heading">NTB scheduled events</h4>
     	<div class="col-md-12 col-lg-12" style="margin-bottom:5px;">
	 		<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bs-example-modal-lg">Add Event</button>

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
		                        <th>Country</th>
		                        <th>Agency</th>
		                        <th>Event Type</th>
		                        <th>Location</th>
		                        <!-- <th>Attendance</th> -->
		                        <th class="text-right" colspan="4" width="100">Action</th>
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
										$button = '<a class="btn btn-danger btn-xs" href="'.site_url().'deactivate-event/'.$meeting_id.'" onclick="return confirm(\'Do you want to activate '.$subject.'?\');">Deactivate event</a>';

									}
									else
									{
										$status = 'Disabled';
										$button = '<a class="btn btn-success btn-xs" href="'.site_url().'activate-event/'.$meeting_id.'" onclick="return confirm(\'Do you want to activate '.$subject.'?\');">Activate event</a>';

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
					                        <td><?php echo $country_name;?></td>
					                        <td><?php echo $agency_name?></td>
					                        <td><?php echo $event_type_name;?></td>
					                        <td><?php echo $location;?><a href="#"><i class="fa fa-map-marker fa-fw text-muted"></i></a></td>
					                       
					                        <!-- <td>
					                            <div class="progress">
					                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
					                                </div>
					                            </div>
					                        </td> -->
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
																	    				<textarea class="form-control col-md-12 cleditor" name="post_content" rows="15" placeholder="Post Content"></textarea>
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
															                                <input id="checkAll" data-toggle="check-all" data-target="#responsive-table-body" type="checkbox" checked>
															                                <label for="checkAll">Check All</label>
															                            </div>
															                        </th>
															                        <th>Title</th>
															                        <th>Name</th>
															                        <th>Email</th>
															                        <!-- <th>Attendance</th> -->
															                        <th class="text-right" colspan="2" width="100">Action</th>
															                    </tr>
															                </thead>
															                <tbody id="responsive-table-body">
															                	<tr>
															                		<td></td>
															                		<td></td>
															                		<td></td>
															                		<td></td>
															                		<td></td>
															                	</tr>
															                </tbody>
															              </table>

																    </div>
																    <div role="tabpanel" class="tab-pane" id="messages">
																    	<table class="table v-middle">
															                <thead>
															                    <tr>
															                        <th width="20">
															                            <div class="checkbox checkbox-single margin-none">
															                                <input id="checkAll" data-toggle="check-all" data-target="#responsive-table-body" type="checkbox" checked>
															                                <label for="checkAll">Check All</label>
															                            </div>
															                        </th>
															                        <th>Title</th>
															                        <th>Name</th>
															                        <th>Email</th>
															                        <!-- <th>Attendance</th> -->
															                        <th class="text-right" colspan="2" width="100">Action</th>
															                    </tr>
															                </thead>
															                <tbody id="responsive-table-body">
															                	<tr>
															                		<td></td>
															                		<td></td>
															                		<td></td>
															                		<td></td>
															                		<td></td>
															                	</tr>
															                </tbody>
															              </table>

																    </div>
																    <div role="tabpanel" class="tab-pane" id="settings">
																    	<table class="table v-middle">
															                <thead>
															                    <tr>
															                        <th width="20">
															                            <div class="checkbox checkbox-single margin-none">
															                                <input id="checkAll" data-toggle="check-all" data-target="#responsive-table-body" type="checkbox" checked>
															                                <label for="checkAll">Check All</label>
															                            </div>
															                        </th>
															                        <th>Title</th>
															                        <th>Name</th>
															                        <th>Email</th>
															                        <!-- <th>Attendance</th> -->
															                        <th class="text-right" colspan="2" width="100">Action</th>
															                    </tr>
															                </thead>
															                <tbody id="responsive-table-body">
															                	<tr>
															                		<td></td>
															                		<td></td>
															                		<td></td>
															                		<td></td>
															                		<td></td>
															                	</tr>
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
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  $(function() {
    $( "#datepicker2" ).datepicker();
  });
  </script>
 <!-- CLEditor -->
