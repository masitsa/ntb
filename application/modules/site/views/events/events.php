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
     	<div class="col-md-12 col-lg-12" style="margin-bottom:5px;">
     		<a href="<?php echo base_url();?>calender"  class="btn btn-info btn-sm " style="margin-right:5px;" ><i class="fa fa-fw fa-mail-reply"></i>  Back Events Calender</a>
	 		<button type="button" class="btn btn-primary btn-sm pull-right " data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-fw fa-plus-square"></i> Add a new meeting</button>

			<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg">
			    <div class="modal-content">
			      
					 <div class="modal-header">
			            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			            <div class="hgroup title">
			                 <h3>You're one step closer to creating a meeting!</h3>
				                <h5>Please fill in all the fields to add this meeting</h5>
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
		        	 <table data-toggle="data-table" class="table col-md-12 col-sm-9" cellspacing="0">
                    <thead>
                        <tr>
                             <th >#</th>
	                        <th>Subject</th>
	                        <th>Event Date - End Date</th>
	                       <th>Country</th>
	                        <th>Agency</th>
	                        <th>Status</th>
	                        <th>Edit </th>
	                        <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                           <th >#</th>
	                        <th>Subject</th>
	                        <th>Event Date - End Date</th>
	                        <th>Country</th>
	                        <th>Agency</th>
	                        <th>Status</th>
	                        <th>Edit </th>
	                        <th>Action </th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
		                	//if users exist display them
							if ($query->num_rows() > 0)
							{
								$count = $page;
								$x = 0;
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
									$x++;
				                	?>
					                    <tr>
					                        <td>
					                            <?php echo $x;?>
					                        </td>
					                         <td>
					                            <?php echo $subject?>
					                        </td>
					                        <td><span class="label label-default"><?php echo $meeting_date;?> - <?php echo $end_date;?></span>
					                        </td>
					                        <td><?php echo $country_name;?></td>
					                        <td><?php echo $agency_name?></td>
					                     	<td><?php echo $button;?></td>
					                       	<td>
					                       		<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target=".bs-example<?php echo $meeting_id;?>-modal-lg"><i class="fa fa-pencil"></i> Edit </button>
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
					                       	</td>
					                        <td >
					                             <a class="btn btn-info btn-xs" href="<?php echo base_url();?>view-meeting/<?php echo $meeting_id?>" ><i class="fa fa-folder-open"></i>View details</a>
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
