<div id="content">
    <div class="container-fluid">
        <div class="lock-container">
            <h1>Events Planner</h1>
            <div class="panel panel-default text-center">
                <img src="<?php echo base_url();?>assets/themes/themekit/images/logo/download.jpg" class="" style="height: 125px;width: 81%; border-radius: none !important;">
                
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
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				?>
				<div class="alert alert-success">
				  <?php 
					echo $validation_errors;
				  ?>
				</div>
				<?php
			}
                               
		  echo form_open($this->uri->uri_string(),"class='form-horizontal'"); 
		  ?>
                    <!-- Email -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email" value="<?php echo set_value('email');?>">
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                    </div>
                    <!-- Remember me checkbox and sign in button -->
                      <div class="form-actions">
                          <button class="submit btn btn-primary pull-right" type="submit">
                              Sign In
                          </button>
                      </div>
                    <br />
                  <?php echo form_close();?>
        </div>
    </div>
</div>