<!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
        <div class="sidebar left sidebar-size-2 sidebar-offset-0 sidebar-visible-desktop sidebar-visible-mobile sidebar-skin-dark" id="sidebar-menu">
            <div data-scrollable>
                <div class="category">Invited Meetings</div>
                <div class="sidebar-block">
                    <ul class="sidebar-feed">
                    <?php
                    if($query->num_rows() > 0)
                    {

                        foreach ($query->result() as $row)
                        {
                            $meeting_id = $row->meeting_id;
                            $meeting_date = $row->meeting_date;
                            $meeting_status = $row->meeting_status;
                            $end_date = $row->end_date;
                            $country_id = $row->country_id;
                            $country_name = $row->country_name;

                            $event_type_id = $row->event_type_id;
                            $event_type_name = $row->event_type_name;
                            $agency_id = $row->agency_id;

                            $agency_name = $row->agency_name;
                            $location = $row->location;
                            $subject = $row->subject;
                            $meeting_date = date('j M Y',strtotime($meeting_date));
                            ?>
                            <li class="media">
                               
                                <div class="media-body">
                                    <a href="<?php echo base_url();?>meetings/<?php echo $email_address;?>/<?php echo $meeting_id;?>" class="text-white"><?php echo $subject?></a>
                                    <span class="time"><?php echo $meeting_date;?></span>
                                </div>
                                <div class="media-right">
                                    <span class="news-item-success"><i class="fa fa-circle"></i></span>
                                </div>
                            </li>
                       <?php
                           }
                       }
                       ?>
                    </ul>
                </div> 
                <div class="sidebar-block">
                    <div class="profile">
                        <img src="<?php echo base_url();?>assets/themes/themekit/images/logo/download.jpg" alt="people" width="100%"/>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->