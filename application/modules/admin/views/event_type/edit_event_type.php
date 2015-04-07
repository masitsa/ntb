          <div class="padd">
            <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
            }
			$event_type_name = $event_type[0]->event_type_name;
			$event_type_status = $event_type[0]->event_type_status;
			$event_type_id = $event_type[0]->event_type_id;
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
				$event_type_name = set_value('event_type_name');
				$event_type_status = set_value('event_type_status');
            }
            
            $success = $this->session->userdata('success_message');
            
            if(!empty($success))
            {
                echo '<div class="alert alert-success"> <strong>Success!</strong> '.$success.' </div>';
				$this->session->unset_userdata('success_message');
            }
            
            $error = $this->session->userdata('error_message');
            
            if(!empty($error))
            {
                echo '<div class="alert alert-danger"> <strong>Oh snap!</strong> '.$error.' </div>';
				$this->session->unset_userdata('error_message');
            }
            ?>
            
            <?php echo form_open('edit-event-type/'.$event_type_id, array("class" => "form-horizontal", "role" => "form"));?>
            <!-- First Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Event type Name</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="event_type_name" placeholder="Event Type Name" value="<?php echo $event_type_name;?>">
                </div>
            </div>
            
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Edit event type
                </button>
            </div>
            <br />
            <?php echo form_close();?>
		</div>