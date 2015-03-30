          <div class="padd">
            <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
            }
			$agency_name = $agency[0]->agency_name;
			$agency_status = $agency[0]->agency_status;
			$agency_id = $agency[0]->agency_id;
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
				$agency_name = set_value('agency_name');
				$agency_status = set_value('agency_status');
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
            
            <?php echo form_open('edit-agency/'.$agency_id, array("class" => "form-horizontal", "role" => "form"));?>
            <!-- First Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Agency Name</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="agency_name" placeholder="First Name" value="<?php echo $agency_name;?>">
                </div>
            </div>
            
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Edit Agency
                </button>
            </div>
            <br />
            <?php echo form_close();?>
		</div>