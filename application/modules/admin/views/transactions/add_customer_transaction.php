<div class="row">
    <div class="col-lg-12">
     <a href="<?php echo site_url();?>customer-transactions/<?php echo $customer_id?>" class="btn btn-primary pull-right">Back to customers transaction</a>
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
                        <label class="col-lg-4 control-label">Type of transaction: </label>
                        
                        <div class="col-lg-8">
                            <select class="form-control" name="transaction_type_id">
                                <option value="">---Select transaction type---</option>
                                <?php
                                   if ($type->num_rows() > 0)
                                    {
                                       foreach ($type->result() as $row)
                                        {
                                            $customer_id = $row->customer_id;
                                            $type_name = $row->transaction_type_name;
                                            $type_id= $row->transaction_type_id;
                                                ?><option value="<?php echo $type_id; ?>" ><?php echo $type_name ?></option>
                                        <?php   
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                        <!-- Other Names -->
                       <div class="form-group">
                            <label class="col-lg-4 control-label">Date of transaction: </label>
                            
                            <div class="col-lg-8">
                                <div id="datetimepicker1" class="input-append">
                                    <input data-format="yyyy-MM-dd" class="form-control" type="text" name="date_transacted" placeholder="Date Transacted" value="<?php echo set_value('transaction_date');?>">
                                    <span class="add-on">
                                        &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                        </i>
                                    </span>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Phone transacted to</label>
                            <div class="col-lg-8">
                            	<input type="text" class="form-control" name="phone" placeholder="Phone" value="<?php echo set_value('phone');?>">
                            </div>
                        </div>
                        <!-- Address -->
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Amount transacted</label>
                            <div class="col-lg-8">
                            	<input type="text" class="form-control" name="amount_transacted" placeholder="Amount transacted" value="<?php echo set_value('amount_transacted');?>">
                            </div>
                        </div>
                      
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
