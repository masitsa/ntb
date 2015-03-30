<link href="<?php echo base_url()."assets/themes/jasny/css/jasny-bootstrap.css"?>" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo base_url()."assets/themes/jasny/js/jasny-bootstrap.js"?>"></script>
<div class="container-fluid">
    <!-- <div class="tabbable">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-fw fa-picture-o"></i> Photos</a>
            </li>
            <li class=""><a href="#profile" data-toggle="tab"><i class="fa fa-fw fa-folder"></i> Albums</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="home">
                <img src="<?php echo base_url();?>assets/themes/themekit/images/place1.jpg" alt="image" />
                <img src="<?php echo base_url();?>assets/themes/themekit/images/place2.jpg" alt="image" />
                <img src="<?php echo base_url();?>assets/themes/themekit/images/food1.jpg" alt="image" />
            </div>
            <div class="tab-pane fade" id="profile">
                <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
            </div>
            <div class="tab-pane fade" id="dropdown1">
                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
            </div>
            <div class="tab-pane fade" id="dropdown2">
                <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
            </div>
        </div>
    </div> -->
    <!-- Adding Errors -->
	<?php
	$error = $this->session->userdata('error_message');
	$success = $this->session->userdata('success_message');
	
    if(!empty($error)){
        echo '<div class="alert alert-danger center-align">'.$error.'</div>';
		$this->session->unset_userdata('error_message');
    }
	
    if(!empty($success)){
        echo '<div class="alert alert-success center-align">'.$success.'</div>';
		$this->session->unset_userdata('success_message');
    }
    ?>
    <div class="row">
       
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                    <a href="#" class="btn btn-white btn-xs pull-right"><i class="fa fa-pencil"></i></a>
                    <i class="fa fa-fw fa-info-circle"></i> About
                </div>
                <div class="panel-body">
                 <?php echo form_open_multipart('site/profile/update_profile_image/'.$user_image, array('class' => 'upload_profile_pic', 'id' => 'upload_image'));?>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Profile image</label>
                        <div class="col-lg-8">
                            
                            <div class="row">
                            
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="height:160px; width:212px;">
                                    		<img src="<?php echo $profile_image_location;?>">
                                        </div>
                                        <div>
                                            <span class="btn btn-file btn-info"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" name="profile_image"></span>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="center-align">
                    	<button type="submit" class="btn btn-primary">Update image</button>
                    </div>
                     <?php echo form_close();?>
                    <div class="col-md-5">
                        <ul class="list-unstyled profile-about margin-none">
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4"><span class="text-muted">Names : </span></div>
                                    
                                    <div class="col-sm-8" >
                                        <input type="text" id="inputSuccess1" name='first_name' class="form-control" placeholder="First name">
                                     
                                    </div>
                                    
                                </div>
                            </li>
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4"><span class="text-muted">Email address : </span>
                                    </div>
                                    <div class="col-sm-8">Specialist</div>
                                </div>
                            </li>
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4"><span class="text-muted">Gender</span>
                                    </div>
                                    <div class="col-sm-8">Male</div>
                                </div>
                            </li>
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4"><span class="text-muted">Lives in</span>
                                    </div>
                                    <div class="col-sm-8">Miami, FL, USA</div>
                                </div>
                            </li>
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4"><span class="text-muted">Credits</span>
                                    </div>
                                    <div class="col-sm-8">249</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <!-- notifications -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading panel-heading-gray">
            <i class="fa fa-bookmark"></i> Bookmarks
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <a href="#" class="h5 margin-none">Climb a Mountain</a>
                            <div class="text-muted">
                                <small><i class="fa fa-calendar"></i> 24/10/2014</small>
                            </div>
                        </div>
                        <a href="#">
                            <img src="<?php echo base_url();?>assets/themes/themekit/images/place1-full.jpg" alt="image" class="img-responsive" />
                        </a>
                        <div class="panel-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor impedit ipsum laborum maiores tempore veritatis....</p>
                            <div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-primary btn-xs">read</a>
                                </div>
                                <a href="#" class="text-muted"> <i class="fa fa-comments"></i> 6</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="#" class="h5 margin-none">Vegetarian Pizza</a>
                            <p class="text-muted"><i class="fa fa-calendar"></i> 24/10/2014</p>
                            <span class="fa fa-star text-primary"></span>
                            <span class="fa fa-star text-primary"></span>
                            <span class="fa fa-star text-primary"></span>
                            <span class="fa fa-star text-primary"></span>
                            <span class="fa fa-star-o"></span>
                        </div>
                        <a href="#">
                            <img src="<?php echo base_url();?>assets/themes/themekit/images/food1-full.jpg" alt="image" class="img-responsive" />
                        </a>
                        <div class="panel-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor impedit ipsum laborum maiores tempore veritatis....</p>
                            <div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-primary btn-xs">read</a>
                                </div>
                                <a href="#" class="text-muted"> <i class="fa fa-comments"></i> 6</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="pull-right">
                                <a href="#" class="btn btn-success btn-xs"><i class="fa fa-check-circle"></i></a>
                            </div>
                            <a href="#" class="h5">Win a Holiday</a>
                            <div class="text-muted">
                                <small><i class="fa fa-calendar"></i> 24/10/2014</small>
                            </div>
                        </div>
                        <a href="#">
                            <img src="<?php echo base_url();?>assets/themes/themekit/images/place2-full.jpg" alt="image" class="img-responsive" />
                        </a>
                        <ul class="icon-list icon-list-block">
                            <li><i class="fa fa-calendar fa-fw"></i> <a href="#">1 Week</a>
                            </li>
                            <li><i class="fa fa-users fa-fw"></i> <a href="#"> 2 People</a>
                            </li>
                            <li><i class="fa fa-map-marker fa-fw"></i> <a href="#">Miami, FL, USA</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>