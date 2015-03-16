 <div class="container-fluid">
 	
 	<div class="col-md-12 col-lg-12">
     	<h4 class="page-section-heading"><?php echo $title;?> attendee</h4>
     	<div class="col-md-12 col-lg-12" style="margin-bottom:5px;">
	 		
	 	</div>
	 	<div class="col-md-12 col-lg-12">
		 	<div class="panel panel-default">
            <div class="row">
            	<div class="col-md-12">
                    <div class="pull-left">
                        <a href="<?php echo site_url().'all-attendees';?>" class="btn btn-primary">Back to attendees</a>
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
								<label for="attendee_title" class="col-sm-4 control-label">Title <span class="required">*</span></label>
								<div class="col-sm-8">
                                	<?php
                                        //case of an input error
                                        if(!empty($attendee_title_error))
                                        {
                                            ?>
                                            <select name="attendee_title" class="form-control alert-danger">
                                            	<option value="">--Select title--</option>
                                            <?php
                                        }
                                        
                                        else
                                        {
                                            ?>
                                            <select name="attendee_title" class="form-control">
                                            	<option value="">--Select title--</option>
                                            <?php
                                        }
                                        if($titles_query->num_rows() > 0)
                                        {
                                            foreach($titles_query->result() as $res)
                                            {
                                                $title_id = $res->title_id;
                                                $title_name = $res->title_name;
                                                
                                                if($title_name == $attendee_title)
                                                {
                                                    echo '<option value="'.$title_name.'" selected="selected">'.$title_name.'</option>';
                                                }
                                                
                                                else
                                                {
                                                    echo '<option value="'.$title_name.'">'.$title_name.'</option>';
                                                }
                                            }
                                        }
                                    ?>
                                    </select>
								</div>
							</div>
							<div class="form-group">
                                <label for="attendee_first_name" class="col-sm-4 control-label">First name <span class="required">*</span></label>
                                <div class="col-sm-8">
									<?php
										//case of an input error
										if(!empty($attendee_first_name_error))
										{
											?>
											<input type="text" class="form-control alert-danger" name="attendee_first_name" placeholder="<?php echo $attendee_first_name_error;?>" onFocus="this.value = '<?php echo $attendee_first_name;?>';">
											<?php
										}
										
										else
										{
											?>
											<input type="text" class="form-control" name="attendee_first_name" placeholder="First name" value="<?php echo $attendee_first_name;?>">
											<?php
										}
									?>
                                </div>
                            </div>
							<div class="form-group">
								<label for="attendee_last_name" class="col-sm-4 control-label">Last name <span class="required">*</span></label>
								<div class="col-sm-8">
									<?php
										//case of an input error
										if(!empty($attendee_last_name_error))
										{
											?>
											<input type="text" class="form-control alert-danger" name="attendee_last_name" placeholder="<?php echo $attendee_last_name_error;?>" onFocus="this.value = '<?php echo $attendee_last_name;?>';">
											<?php
										}
										
										else
										{
											?>
											<input type="text" class="form-control" name="attendee_last_name" placeholder="Last name" value="<?php echo $attendee_last_name;?>">
											<?php
										}
									?>
								</div>
							</div>
							<div class="form-group">
                                <label for="attendee_email" class="col-sm-4 control-label">Email <span class="required">*</span></label>
                                <div class="col-sm-8">
									<?php
										//case of an input error
										if(!empty($attendee_email_error))
										{
											?>
											<input type="text" class="form-control alert-danger" name="attendee_email" placeholder="<?php echo $attendee_email_error;?>" onFocus="this.value = '<?php echo $attendee_email;?>';">
											<?php
										}
										
										else
										{
											?>
											<input type="text" class="form-control" name="attendee_email" placeholder="Email" value="<?php echo $attendee_email;?>">
											<?php
										}
									?>
                                </div>
                            </div>
						</div>
					</div>
					
					<div class="row center-align">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-primary"><?php echo $title;?> attendee</button>
						</div>
					</div>
				<?php echo form_close();?>
                
		    </div>
		</div>
	</div>
 </div>