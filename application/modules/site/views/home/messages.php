<?php
    //get receiver details
    if($receiver->num_rows() > 0)
    {
        $row = $receiver->row();
        $receiver_username = $row->user_username;
        $receiver_id = $row->user_id;
    }
?>
 <div class="container-fluid">
    <div class="media messages-container media-clearfix-xs-min media-grid">
        <div class="media-left">
            <div class="messages-list">
                <div class="panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item active">
                            <a href="#">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/female.png" width="50" alt="" class="media-object" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Today</span>
                                        <span class="user">Mary D.</span>
                                        <div class="message">Are we ok to meet...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/male.png" height="50" alt="" class="media-object" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Adrian T.</span>
                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/female.png" width="50" alt="" class="media-object" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">5 days</span>
                                        <span class="user">Michelle A.</span>
                                        <div class="message">Nice design.</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/female.png" height="50" alt="" class="media-object" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Sue T.</span>
                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/male.png" height="50" alt="" class="media-object" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Adrian T.</span>
                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/female.png" height="50" alt="" class="media-object" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Adrian T.</span>
                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/male.png" height="50" alt="" class="media-object" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Adrian T.</span>
                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/male.png" height="50" alt="" class="media-object" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Adrian T.</span>
                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="media-body">
            <div class="panel panel-default share">
             <?php
                echo form_open('site/messages/message_profile', array('class' => 'send_message2', 'id' => 'compose_message'));
                echo form_hidden('receiver_id', $receiver_id);
            ?>
                <div class="input-group">
                    <div class="input-group-btn">
                        <button class="btn btn-primary" href="#">
                            <i class="fa fa-envelope"></i> Send
                        </button>
                        
                         <!-- <i class="fa fa-envelope"></i><input name="submit" class="btn btn-primary" value="Send " type="submit"> -->
                    </div>
                    <input type="text" name="user_message_details" id="instant_message" class="form-control share-text" placeholder="Write message..." />
                    <!-- <textarea name="client_message_details" id="instant_message2" class="form-control input"  size="20" placeholder="Enter message" required="required"></textarea> -->

                </div>
            </div>
                <?php echo $smiley_table;?>
            <?php echo form_close();?>
            <div id="view_message">
            <?php echo $this->load->view('messages/message_details');?>
            </div>
           <!--  <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/female.png" width="60" alt="woman" class="media-object" />
                    </a>
                </div>
                <div class="media-body message">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-white">
                            <div class="pull-right">
                                <small class="text-muted">2 min ago</small>
                            </div>
                            <a href="#">Mary D.</a>
                        </div>
                        <div class="panel-body">
                            Hi Bill,
                            <br/> Is it ok if we schedule the meeting tomorrow?
                        </div>
                    </div>
                </div>
            </div>
            <div class="media">
                <div class="media-body message">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-white">
                            <div class="pull-right">
                                <small class="text-muted">10 min ago</small>
                            </div>
                            <a href="#">Me</a>
                        </div>
                        <div class="panel-body">
                            Are we still on for Today?
                        </div>
                    </div>
                </div>
                <div class="media-right">
                    <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/male.png" width="60" alt="" class="media-object" />
                </div>
            </div>
            <div class="media">
                <div class="media-left">
                    <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/female.png" width="60" alt="" class="media-object" />
                </div>
                <div class="media-body message">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-white">
                            <div class="pull-right">
                                <small class="text-muted">1 day ago</small>
                            </div>
                            <a href="#">Mary D.</a>
                        </div>
                        <div class="panel-body">
                            Cool. It's settled. Tomorrow will discuss the project.
                        </div>
                    </div>
                </div>
            </div>
            <div class="media">
                <div class="media-body message">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-white">
                            <div class="pull-right">
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <a href="#">Me</a>
                        </div>
                        <div class="panel-body">
                            I suggest a meeting on Tuesday. What do you think?
                        </div>
                    </div>
                </div>
                <div class="media-right">
                    <img src="<?php echo base_url();?>assets/themes/themekit/images/people/110/male.png" width="60" alt="" class="media-object" />
                </div>
            </div> -->
        </div>
    </div>
</div>