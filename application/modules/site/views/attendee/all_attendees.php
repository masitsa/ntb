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

        $meeting_date = date('j M Y',strtotime($meeting_date));
        $end_date = date('j M Y',strtotime($end_date));
    }
}

?>
 <div class="container-fluid">
 	
 	<div class="col-md-12 col-lg-12">
     	<h4 class="page-section-heading"><?php echo $subject;?> attendees</h4>
     	<div class="col-md-12 col-lg-12" style="margin-bottom:5px;">
     		<a href="<?php echo base_url();?>all-events" class="btn btn-primary btn-sm pull-left" data-toggle="tooltip" data-placement="top" title="Back to events">Back to Events</a>

	 		<a href="<?php echo base_url();?>add-attendee/<?php echo $meeting_id;?>" class="btn btn-success btn-sm pull-right" data-toggle="tooltip" data-placement="top" title="Add">Add attendee</a>
	 	</div>
	 	<div class="col-md-12 col-lg-12">
		 	<div class="panel panel-default">
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
		        <!-- Progress table -->
		        <div class="table-responsive">
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
										$status = '<span class="label label-success label-xs">Active</span>';
										$button = '<a class="btn btn-default btn-sm" href="'.site_url().'deactivate-attendee/'.$attendee_id.'/'.$meeting_id.'" onclick="return confirm(\'Do you want to deactivate '.$attendee_first_name.'?\');">Deactivate</a>';
									}
									
									else
									{
										$status = '<span class="label label-danger label-xs">Disabled</span>';
										$button = '<a class="btn btn-danger btn-sm" href="'.site_url().'activate-attendee/'.$attendee_id.'/'.$meeting_id.'" onclick="return confirm(\'Do you want to activate '.$attendee_first_name.'?\');">Activate</a>';
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
                                             <a href="<?php echo base_url();?>edit-attendee/<?php echo $attendee_id;?>/<?php echo $meeting_id;?>" class="btn btn-info btn-sm">Edit</a>
                                        </td>
                                        <td >
                                             <a href="<?php echo base_url();?>delete-attendee/<?php echo $attendee_id;?>/<?php echo $meeting_id;?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you really want to delete this attendee?');">Delete</a>
                                        </td>
                                    </tr>
                                    <?php    
                                }
                            }
                            ?>
		                    
		                  
		                </tbody>
		            </table>
		        </div>
		        <!-- // Progress table -->
		        <div class="panel-footer padding-none text-center">
		            <?php
                    	if(isset($links)){echo $links;}
					?>
		        </div>
		    </div>
		</div>
	</div>
 </div>