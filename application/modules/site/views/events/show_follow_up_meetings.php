<div class="table-responsive">
<table data-toggle="data-table" class="table col-md-12 col-sm-9" cellspacing="0">
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
            <th>Status</th>
            <th>Edit </th>
            <th>Action</th>
        </tr>
    </thead>
    <tfoot>
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
            <th>Status</th>
            <th>Edit </th>
            <th>Action </th>
        </tr>
    </tfoot>
    <tbody>
        <?php
        	$followup = $this->events_model->get_all_follow_up_meetings($meeting_id);
        	//if users exist display them
			if ($followup->num_rows() > 0)
			{
				foreach ($followup->result() as $follwoup)
				{
					$meeting_id = $follwoup->meeting_id;
					$meeting_date = $follwoup->meeting_date;
					$meeting_status = $follwoup->meeting_status;
					$end_date = $follwoup->end_date;
					$country_id = $follwoup->country_id;
					$country_name = $follwoup->country_name;

					$event_type_id = $follwoup->event_type_id;
					$event_type_name = $follwoup->event_type_name;
					$agency_id = $follwoup->agency_id;

					$agency_name = $follwoup->agency_name;
					$location = $follwoup->location;
					$subject = $follwoup->subject;


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
	                        <td><?php echo $country_name;?></td>
	                        <td><?php echo $agency_name?></td>
	                     	<td><?php echo $button;?></td>
	                       	<td>
	                       		<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target=".bs-example<?php echo $meeting_id;?>-modal-lg">Edit </button>
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
	                             <a class="btn btn-info btn-xs" href="<?php echo base_url();?>view-meeting/<?php echo $meeting_id?>" >View details</a>
	                        </td>
	                    </tr>
	                    <?php
	               	}
            	}
                ?>
        </tbody>
    </table>
    
</div>