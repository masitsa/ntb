
    <!-- Sidebar -->
    <div class="sidebar sidebar-fixed">
        <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

        <div class="sidebar-inner">
        
            <!--- Sidebar navigation -->
            <!-- If the main navigation has sub navigation, then add the class "has_submenu" to "li" of main navigation. -->
            <ul class="navi">

                <!-- Use the class nred, ngreen, nblue, nlightblue, nviolet or norange to add background color. You need to use this in <li> tag. -->

                <li><a href="<?php echo base_url()."all-users";?>"><i class="icon-list"></i> Users</a></li>
                 <!-- Menu with sub menu -->
                <li class="has_submenu">
                    <a href="#">
                        <!-- Menu name with icon -->
                        <i class="icon-th"></i> Setup
                    </a>
                    <ul>
                        <li><a href="<?php echo site_url();?>all-agencies">Agencies</a></li>
                        <li><a href="<?php echo site_url();?>all-event-type">Event type</a></li>
                        <li><a href="<?php echo site_url();?>all-country">Countries</a></li>
                    </ul>
                </li>        
                

                

            </ul>
        </div>
    </div>
    <!-- Sidebar ends -->
