<!-- Fixed navbar -->
        <div class="navbar navbar-main navbar-primary navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#sidebar-menu" data-effect="st-effect-1" data-toggle="sidebar-menu" class="toggle pull-left visible-xs"><i class="fa fa-ellipsis-v"></i></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#sidebar-chat" data-toggle="sidebar-menu" data-effect="st-effect-1" class="toggle pull-right visible-xs"><i class="fa fa-comments"></i></a>
                    <a class="navbar-brand" href="">TNC</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="main-nav">
                    <ul class="nav navbar-nav">
                        
                        <li><a href="<?php echo base_url();?>calender">TNC Events Calender</a></li>
                        
                        <li><a href="<?php echo base_url();?>all-events">Event Lists</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">TNC Social <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="active"><a href="<?php echo base_url();?>home">Timeline</a>
                                </li>
                                <li><a href="<?php echo base_url();?>profile">Profile</a>
                                </li>
                                <!-- <li><a href="<?php echo base_url();?>friends">Friends</a>
                                </li> -->
                                <li class="dropdown-header">Private User Pages</li>
                                <li><a href="<?php echo base_url();?>messages">Messages</a>
                                </li>
                                <li><a href="<?php echo base_url();?>profile">Profile</a>
                                </li>
                                
                            </ul>
                        </li>
                      
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden-xs">
                            <a href="#sidebar-chat" data-toggle="sidebar-menu" data-effect="st-effect-1">
                                <i class="fa fa-comments"></i>
                            </a>
                        </li>
                        <!-- User -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle user" data-toggle="dropdown">
                                <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/male.png" alt="<?php echo $this->session->userdata('first_name');?>" class="img-circle" width="40" /> <?php echo $this->session->userdata('first_name');?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url();?>profile">Profile</a>
                                </li>
                                <li><a href="<?php echo base_url();?>messages">Messages</a>
                                </li>
                                <li><a href="<?php echo base_url();?>logout-user">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </div>