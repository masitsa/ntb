 <div class="container-fluid">
 	
 	<div class="col-md-12 col-lg-12">
     	<h4 class="page-section-heading"><?php echo $title;?> action point</h4>
     	<div class="col-md-12 col-lg-12" style="margin-bottom:5px;">
	 		
	 	</div>
	 	<div class="col-md-12 col-lg-12">
		 	<div class="panel panel-default">
            <div class="row">
            	<div class="col-md-12">
                    <div class="pull-left">
                        <a href="<?php echo site_url().'all-action-points';?>" class="btn btn-primary">Back to action points</a>
                    </div>
                </div>
            </div>
                <?php
					$attributes = array(
									'class' => 'form-horizontal',
									'role' => 'form',
								);
					echo form_open($this->uri->uri_string(), $attributes);
				?>
					<div class="row">
						<div class="col-md-offset-3 col-md-5">
							<div class="form-group">
								<label for="assigned_to" class="col-sm-4 control-label">Assigned to <span class="required">*</span></label>
								<div class="col-sm-8">
									<?php
										//case of an input error
										if(!empty($assigned_to_error))
										{
											?>
											<input type="text" class="form-control alert-danger" name="assigned_to" placeholder="<?php echo $assigned_to_error;?>" onFocus="this.value = '<?php echo $assigned_to;?>';">
											<?php
										}
										
										else
										{
											?>
											<input type="text" class="form-control" name="assigned_to" placeholder="Assigned to" value="<?php echo $assigned_to;?>">
											<?php
										}
									?>
								</div>
							</div>
							<div class="form-group">
                                <label for="priority_status_id" class="col-sm-4 control-label">Priority <span class="required">*</span></label>
                                <div class="col-sm-8">
                                    <?php
                                        //case of an input error
                                        if(!empty($priority_status_id_error))
                                        {
                                            ?>
                                            <select name="priority_status_id" class="form-control alert-danger">
                                            	<option value="">--Select priority--</option>
                                            <?php
                                        }
                                        
                                        else
                                        {
                                            ?>
                                            <select name="priority_status_id" class="form-control">
                                            	<option value="">--Select priority--</option>
                                            <?php
                                        }
                                        if($priority_status_query->num_rows() > 0)
                                        {
                                            foreach($priority_status_query->result() as $res)
                                            {
                                                $priority_status_id2 = $res->priority_status_id;
                                                $priority_status_name = $res->priority_status_name;
                                                
                                                if($priority_status_id2 == $priority_status_id)
                                                {
                                                    echo '<option value="'.$priority_status_id2.'" selected="selected">'.$priority_status_name.'</option>';
                                                }
                                                
                                                else
                                                {
                                                    echo '<option value="'.$priority_status_id2.'">'.$priority_status_name.'</option>';
                                                }
                                            }
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
                                <label for="actions_status_id" class="col-sm-4 control-label">Action <span class="required">*</span></label>
                                <div class="col-sm-8">
                                    <?php
                                        //case of an input error
                                        if(!empty($actions_status_id_error))
                                        {
                                            ?>
                                            <select name="actions_status_id" class="form-control alert-danger">
                                            	<option value="">--Select action--</option>
                                            <?php
                                        }
                                        
                                        else
                                        {
                                            ?>
                                            <select name="actions_status_id" class="form-control">
                                            	<option value="">--Select action--</option>
                                            <?php
                                        }
                                        if($action_status_query->num_rows() > 0)
                                        {
                                            foreach($action_status_query->result() as $res)
                                            {
                                                $actions_status_id2 = $res->action_status_id;
                                                $action_status_name = $res->action_status_name;
                                                
                                                if($actions_status_id2 == $actions_status_id)
                                                {
                                                    echo '<option value="'.$actions_status_id2.'" selected="selected">'.$action_status_name.'</option>';
                                                }
                                                
                                                else
                                                {
                                                    echo '<option value="'.$actions_status_id2.'">'.$action_status_name.'</option>';
                                                }
                                            }
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
								<label for="action_point_notes" class="col-sm-4 control-label">Notes</label>
								<div class="col-sm-8">
									<?php
											//case of an input error
                                        	if(!empty($action_point_notes_error))
											{
												?>
                                                <textarea class="form-control alert-danger" name="action_point_notes" onFocus="this.value = '<?php echo $action_point_notes;?>';" placeholder="<?php echo $action_point_notes_error;?>"></textarea>
                                                <?php
											}
											
											else
											{
												?>
                                                <textarea class="form-control" name="action_point_notes" placeholder="Notes"><?php echo $action_point_notes;?></textarea>
                                                <?php
											}
										?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row center-align">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-primary"><?php echo $title;?> action point</button>
						</div>
					</div>
				<?php echo form_close();?>
                
		    </div>
		</div>
	</div>
 </div>