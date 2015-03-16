 <div class="container-fluid">
 	
 	<div class="col-md-12 col-lg-12">
     	<h4 class="page-section-heading">NTB facilitators</h4>
     	<div class="col-md-12 col-lg-12" style="margin-bottom:5px;">
	 		<a href="<?php echo base_url();?>add-facilitator" class="btn btn-success pull-right" data-toggle="tooltip" data-placement="top" title="Add">Add facilitator</a>
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