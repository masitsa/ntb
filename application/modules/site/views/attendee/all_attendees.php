 <div class="container-fluid">
 	
 	<div class="col-md-12 col-lg-12">
     	<h4 class="page-section-heading">NTB attendees</h4>
     	<div class="col-md-12 col-lg-12" style="margin-bottom:5px;">
	 		<a href="<?php echo base_url();?>add-attendee" class="btn btn-success pull-right" data-toggle="tooltip" data-placement="top" title="Add">Add attendee</a>
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