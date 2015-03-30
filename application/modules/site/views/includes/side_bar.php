<?php
$user_query = $this->profile_model->get_user($this->user_id);
$row = $user_query->row();
$profile_image_location = $this->profile_image_location.$row->user_image;

?>
<!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
        <div class="sidebar left sidebar-size-2 sidebar-offset-0 sidebar-visible-desktop sidebar-visible-mobile sidebar-skin-dark" id="sidebar-menu">
            <div data-scrollable>
                <div class="sidebar-block">
                    <div class="profile">
                        <img src="<?php echo $profile_image_location;?>" alt="people" class="img-circle" style="width:100%;height:175px;"/>
                        <h4><?php echo $this->session->userdata('first_name');?>.</h4>
                    </div>
                </div>
                <div class="category">About</div>
                <div class="sidebar-block">
                    <ul class="list-about">
                        <li><i class="fa fa-map-marker"></i> Nairobi, LA</li>
                        <li><i class="fa fa-link"></i> <a href="#"><?php echo $this->session->userdata('email');?></a>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-block">
                    <div class="profile">
                        <img src="<?php echo base_url();?>assets/themes/themekit/images/logo/download.jpg" alt="people" width="100%"/>
                        
                    </div>
                </div>
                <!-- <div class="category">Photos</div>
                <div class="sidebar-block">
                    <div class="sidebar-photos">
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/male.png" alt="people" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/male.png" alt="people" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/male.png" alt="people" />
                                </a>
                            </li>
                            
                        </ul>
                        <a href="#" class="btn btn-primary btn-xs">view all</a>
                    </div>
                </div>
                <div class="category">Activity</div>
                <div class="sidebar-block">
                    <ul class="sidebar-feed">
                        <li class="media">
                            <div class="media-left">
                                <span class="media-object">
                            <i class="fa fa-fw fa-bell"></i>
                        </span>
                            </div>
                            <div class="media-body">
                                <a href="" class="text-white">Adrian</a> just logged in
                                <span class="time">2 min ago</span>
                            </div>
                            <div class="media-right">
                                <span class="news-item-success"><i class="fa fa-circle"></i></span>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-left">
                                <span class="media-object">
                            <i class="fa fa-fw fa-bell"></i>
                        </span>
                            </div>
                            <div class="media-body">
                                <a href="" class="text-white">Adrian</a> just added <a href="" class="text-white">mosaicpro</a> as their office
                                <span class="time">2 min ago</span>
                            </div>
                            <div class="media-right">
                                <span class="news-item-success"><i class="fa fa-circle"></i></span>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-left">
                                <span class="media-object">
                            <i class="fa fa-fw fa-bell"></i>
                        </span>
                            </div>
                            <div class="media-body">
                                <a href="" class="text-white">Adrian</a> just logged in
                                <span class="time">2 min ago</span>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-left">
                                <span class="media-object">
                            <i class="fa fa-fw fa-bell"></i>
                        </span>
                            </div>
                            <div class="media-body">
                                <a href="" class="text-white">Adrian</a> just logged in
                                <span class="time">2 min ago</span>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-left">
                                <span class="media-object">
                            <i class="fa fa-fw fa-bell"></i>
                        </span>
                            </div>
                            <div class="media-body">
                                <a href="" class="text-white">Adrian</a> just logged in
                                <span class="time">2 min ago</span>
                            </div>
                        </li>
                    </ul>
                </div> -->
            </div>
        </div>
        <!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->