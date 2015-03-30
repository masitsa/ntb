<div class="row">
    <div class="col-lg-12">
     <a href="<?php echo site_url();?>all-agencies" class="btn btn-primary pull-right">Back to agencies</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
          <div class="padd">
            <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
            }
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
            ?>
            
            <?php echo form_open($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
             <div class="row">
                <div class="row ">
                    <div class="col-lg-12">
                        <!-- post category -->
                        <!-- First Name -->
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Agency Name</label>
                            <div class="col-lg-6">
                            	<input type="text" class="form-control" name="agency_name" placeholder="Agency Name" value="<?php echo set_value('agency_name');?>">
                            </div>
                        </div>
                        
                    </div>
                    
                      
                    </div>
                </div>
                <div class="row">
                    <div class="form-actions center-align">
                        <button class="submit btn btn-success" type="submit">
                            Add a new agency
                        </button>
                    </div>
                </div>
                        <br />
            <?php echo form_close();?>
		</div>
    </div>
</div>
