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
     	<h4 class="page-section-heading"><?php echo $subject;?> Action Points</h4>
     	<div class="col-md-12 col-lg-12" style="margin-bottom:5px;">
     		<a href="<?php echo base_url();?>all-events" class="btn btn-primary btn-sm pull-left" data-toggle="tooltip" data-placement="top" title="Back to events">Back to Events</a>

	 		<a href="<?php echo base_url();?>add-action-point/<?php echo $meeting_id;?>" class="btn btn-success btn-sm pull-right" data-toggle="tooltip" data-placement="top" title="Add">Add action point</a>
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
		                        <th>Created</th>
		                        <th>Assigned to</th>
		                        <th>Priority</th>
		                        <th>Action</th>
		                        <th>Notes</th>
		                        <th class="text-right" colspan="2">Actions</th>
		                    </tr>
		                </thead>
		                <tbody id="responsive-table-body">
                        <?php
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
                                             <a href="<?php echo base_url();?>delete-action-point/<?php echo $action_point_id;?>/<?php echo $meeting_id;?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you really want to delete this action point?');">Delete</a>
                                        </td>
                                        <td >
                                             <a href="<?php echo base_url();?>edit-action-point/<?php echo $action_point_id;?>/<?php echo $meeting_id;?>" class="btn btn-info btn-sm">Edit</a>
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