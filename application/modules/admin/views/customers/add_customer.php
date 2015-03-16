<div class="row">
    <div class="col-lg-12">
     <a href="<?php echo site_url();?>all-customers" class="btn btn-primary pull-right">Back to customers</a>
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
                    <div class="col-lg-5">
                        <!-- post category -->
                        <!-- First Name -->
                        <div class="form-group">
                            <label class="col-lg-4 control-label">First Name</label>
                            <div class="col-lg-8">
                            	<input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo set_value('first_name');?>">
                            </div>
                        </div>
                        <!-- Other Names -->
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Other Names</label>
                            <div class="col-lg-8">
                            	<input type="text" class="form-control" name="other_names" placeholder="Other Names" value="<?php echo set_value('other_names');?>">
                            </div>
                        </div>
                       
                          <div class="form-group">
                            <label class="col-lg-4 control-label">Activate User?</label>
                            <div class="col-lg-8">
                                <input type="radio" name="activated"  checked value="1"> Yes
                                <input type="radio" name="activated"  value="2"> No
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Phone</label>
                            <div class="col-lg-8">
                            	<input type="text" class="form-control" name="phone" placeholder="Phone" value="<?php echo set_value('phone');?>">
                            </div>
                        </div>
                        <!-- Address -->
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Address</label>
                            <div class="col-lg-8">
                            	<input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo set_value('address');?>">
                            </div>
                        </div>
                        <!-- Postal Code -->
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Postal Code</label>
                            <div class="col-lg-8">
                            	<input type="text" class="form-control" name="post_code" placeholder="Postal Code" value="<?php echo set_value('post_code');?>">
                            </div>
                        </div>
                        <!-- City -->
                        <div class="form-group">
                            <label class="col-lg-4 control-label">City</label>
                            <div class="col-lg-8">
                            	<input type="text" class="form-control" name="city" placeholder="City" value="<?php echo set_value('city');?>">
                            </div>
                        </div>
                        <!-- Activate checkbox -->
                      
                    </div>
                </div>
                <div class="row">
                    <div class="form-actions center-align">
                        <button class="submit btn btn-success" type="submit">
                            Add a new customer
                        </button>
                    </div>
                </div>
                        <br />
            <?php echo form_close();?>
		</div>
    </div>
</div>
