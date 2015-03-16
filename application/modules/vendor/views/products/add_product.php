          <link href="<?php echo base_url()."assets/themes/jasny/css/jasny-bootstrap.css"?>" rel="stylesheet"/>
          <div class="padd">
          	<a href="<?php echo site_url().'vendor/all-products';?>" class="btn btn-sm btn-info">Back to products</a>
			<?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
         	<div class="row">
            	<div class="col-md-6">
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
                    
                    <!-- product Name -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Product Name <span class="required">*</span></label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="product_name" placeholder="Product Name" value="<?php echo set_value('product_name');?>">
                        </div>
                    </div>
                    <!-- Product Category -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Product Category <span class="required">*</span></label>
                        <div class="col-lg-7">
                            <select name="category_id" id="category_id" class="form-control">
                                <?php
                                echo '<option value="0">No Category</option>';
                                if($all_categories->num_rows() > 0)
                                {
                                    $result = $all_categories->result();
                                    
                                    foreach($result as $res)
                                    {
                                        if($res->category_id == set_value('category_id'))
                                        {
                                            echo '<option value="'.$res->category_id.'" selected>'.$res->category_name.'</option>';
                                        }
                                        else
                                        {
                                            echo '<option value="'.$res->category_id.'">'.$res->category_name.'</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <!-- Product brand -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Product Brand</label>
                        <div class="col-lg-7">
                            <select name="brand_id" class="form-control">
                                <?php
                                echo '<option value="0">No Brand</option>';
                                if($all_brands->num_rows() > 0)
                                {
                                    $result = $all_brands->result();
                                    
                                    foreach($result as $res)
                                    {
                                        if($res->brand_id == set_value('brand_id'))
                                        {
                                            echo '<option value="'.$res->brand_id.'" selected>'.$res->brand_name.'</option>';
                                        }
                                        else
                                        {

                                            echo '<option value="'.$res->brand_id.'">'.$res->brand_name.'</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <!-- Product Buying Price -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Product Buying Price</label>
                        <div class="col-lg-7">
                            <input type="number" class="form-control" name="product_buying_price" placeholder="Product Buying Price" value="<?php echo set_value('product_buying_price');?>">
                        </div>
                    </div>
                    <!-- Product Selling Price -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Product Selling Price <span class="required">*</span></label>
                        <div class="col-lg-7">
                            <input type="number" class="form-control" name="product_selling_price" placeholder="Product Selling Price" value="<?php echo set_value('product_selling_price');?>">
                        </div>
                    </div>
                    <div class="form-group">
                         <label class="col-lg-4 control-label">Sale price type</label>
                          <div class="col-lg-7">
                            <?php
                             if($all_discount_types->num_rows() > 0)
                                {
                                    $result = $all_discount_types->result();
                                    
                                    foreach($result as $res)
                                    {
                                        ?>
                                        <input type="radio" name="sale_price_type_id" value="<?php echo $res->discount_type_id?>" onclick="discount_type(<?php echo $res->discount_type_id?>)"><?php echo $res->discount_type_name;?>
                                        <?php
                                    }
                                }
                              ?>
                         
                        </div>
                    </div>
                    <!-- Product Sale Price -->

                    <div id="percentage_div" class="form-group" style="display:none;">
                        <label class="col-lg-4 control-label">Sale % Off</label>
                        <div class="col-lg-7">
                            <input type="number" class="form-control" name="product_sale_price" placeholder="Product Sale Price" value="">
                        </div>
                    </div>
                    <div id="amount_div" class="form-group" style="display:none;">
                        <label class="col-lg-4 control-label">Amount $ off</label>
                        <div class="col-lg-7">
                            <input type="number" class="form-control" name="product_sale_price" placeholder="Product Sale Price" value="">
                        </div>
                    </div>
                    <!-- Product Balance -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Product Balance <span class="required">*</span></label>
                        <div class="col-lg-7">
                            <input type="number" class="form-control" name="product_balance" placeholder="Product Balance" value="<?php echo set_value('product_balance');?>">
                        </div>
                    </div>
                    <!-- Minimum order qty -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Minimum Order Quantity</label>
                        <div class="col-lg-7">
                            <input type="number" class="form-control" name="minimum_order_quantity" placeholder="Minimum Order Quantity" value="<?php echo set_value('minimum_order_quantity');?>">
                        </div>
                    </div>
                    <!-- Maximum purchase qty -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Maximum Purchase Quantity</label>
                        <div class="col-lg-7">
                            <input type="number" class="form-control" name="maximum_purchase_quantity" placeholder="Maximum Purchase Quantity" value="<?php echo set_value('maximum_purchase_quantity');?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                
                    <!-- Image -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Product Image</label>
                        <div class="col-lg-7">
                            
                            <div class="row">
                            
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="height:160px; width:212px;">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" />
                                        </div>
                                        <div>
                                            <span class="btn btn-file btn-info"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" name="product_image"></span>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- Gallery Images -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Gallery Images</label>
                        <div class="col-lg-7">
                            <?php echo form_upload(array( 'name'=>'gallery[]', 'multiple'=>true, 'class'=>'btn'));?>
                        </div>
                    </div>
                    <!-- Activate checkbox -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Activate product?</label>
                        <div class="col-lg-7">
                            <div class="radio">
                                <label>
                                    <input id="optionsRadios1" type="radio" checked value="1" name="product_status">
                                    Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input id="optionsRadios2" type="radio" value="0" name="product_status">
                                    No
                                </label>
                            </div>
                        </div>
                    </div> 
                    <!-- Featured checkbox -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Featured product?</label>
                        <div class="col-lg-7">
                            <div class="radio">
                                <label>
                                    <input id="optionsRadios3" type="radio" value="1" name="featured">
                                    Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input id="optionsRadios4" type="radio" checked value="0" name="featured">
                                    No
                                </label>
                            </div>
                        </div>
                    </div> 
                    
                    <!-- Features -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Features</label>
                        <div class="col-lg-7">
                                   <button class="submit btn btn-success" type="button" data-toggle="modal" data-target="#features_modal">
                                Add Features
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12">
                    <!-- Product Description -->
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Product Description <span class="required">*</span></label>
                      <div class="col-lg-10">
                        <textarea name="product_description"><?php echo set_value('product_description');?></textarea>
                      </div>
                    </div>
            	</div>
            </div>
            
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Add product
                </button>
            </div>
            <?php echo form_close();?>
            
            <div class="modal fade" id="features_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Product Features</h4>
                        </div>
                        
                        <div class="modal-body">
                            <div class="row">
                                <!-- Features -->
                                <div class="col-md-12" id="features">
                                    <?php $this->load->view('products/features');?>
                                </div>
                                <!-- End features -->
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
		</div>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
<script type="text/javascript">
     function discount_type(id){

        var myTarget1 = document.getElementById("percentage_div");
        var myTarget2 = document.getElementById("amount_div");
        if(id == 1)
        {
          myTarget1.style.display = 'none';
          myTarget2.style.display = 'none';
        }
        else if(id == 2)
        {
          myTarget1.style.display = 'block';
          myTarget2.style.display = 'none';
        }
        else if(id == 3)
        {
          myTarget1.style.display = 'none';
          myTarget2.style.display = 'block';
        }
        else
        {
          myTarget1.style.display = 'none';
          myTarget2.style.display = 'none';
        }
        
    }
	$(document).on("change","select#category_id",function()
	{			
		value = $(this).val();
		
		var features = $.ajax(
		{
			url: '<?php echo site_url();?>vendor/products/get_category_features/'+value,
			processData: false,
			contentType: false,
			cache: true
		});
		features.done(function(code) {
			if((code == "null") || (code == null)){
				$('div#features').fadeIn('slow').html('');
			}
			else{
				$('div#features').fadeIn('slow').html(code);
			}
		});
	});
	
	//Add Feature
	$(document).on("submit","div.tab-content form",function(e)
	{
		e.preventDefault();
		
		var formData = new FormData(this);
		
		var category_feature_id = $(this).attr('name');

		$.ajax({
			type:'POST',
			url: $(this).attr('action'),
			data:formData,
			cache:false,
			contentType: false,
			processData: false,
			dataType: 'json',
			success:function(data){
				
				if(data.result == "success")
				{
					$("#new_features"+category_feature_id).html(data.result_options);
					$("#cat_feature"+category_feature_id)[0].reset();
				}
				else
				{
					$("#new_features"+category_feature_id).html(data);
				}
			},
			error: function(xhr, status, error) {
				alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
				$("#new_features"+category_feature_id).html(error);
			}
		});
		return false;
	});
	
	//Delete Feature
	$(document).on("click","a.delete_feature",function()
	{
		var category_feature_id = $(this).attr('id');
		var delete_row = $(this).attr('href');
		var row = $.ajax(
		{
			url: '<?php echo site_url();?>vendor/products/delete_new_feature/'+category_feature_id+'/'+delete_row,
			processData: false,
			contentType: false,
			cache: true
		});
		row.done(function(data) {
			$("#new_features"+category_feature_id).html(data);
		});
		return false;
	});
</script>