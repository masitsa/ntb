<!DOCTYPE html>
<html class="st-layout ls-top-navbar ls-bottom-footer show-sidebar sidebar-l2" lang="en">
<head>
   	<?php echo $this->load->view('site/includes/header', '', TRUE); ?>
</head>
<body>
    <!-- Wrapper required for sidebar transitions -->
    <div class="st-container">
        
        <!-- top navi gation -->
        	<?php echo $this->load->view('site/includes/top_navigation', '', TRUE); ?>
        <!-- end of top navigation -->

        <!-- side bar -->
        	<?php echo $this->load->view('site/includes/side_bar', '', TRUE); ?>
        <!-- end of side bar -->

        <!-- speed bar -->
        	<?php echo $this->load->view('site/includes/speed_bar', '', TRUE); ?>
        <!-- speed bar -->
        
        
        <!-- st-effect-1, st-effect-2, st-effect-4, st-effect-5, st-effect-9, st-effect-10, st-effect-11, st-effect-12, st-effect-13 -->
        <!-- content push wrapper -->
        <div class="st-pusher" id="content">
            <!-- sidebar effects INSIDE of st-pusher: -->
            <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->
            <!-- this is the wrapper for the content -->
            <div class="st-content">
                <!-- extra div for emulating position:fixed of the menu -->
                <div class="st-content-inner">

                   	<!-- inner navigation  -->
                   		<?php echo $this->load->view('site/includes/inner_navigation', '', TRUE); ?>
                   	<!-- inner navigation  -->

                   	<!-- content -->
                   		<?php echo $content;?>
                   	<!-- end of content -->

                </div>
                <!-- /st-content-inner -->
            </div>
            <!-- /st-content -->
        </div>
        <!-- /st-pusher -->

        <!-- Footer -->
       	<?php echo $this->load->view('site/includes/footer', '', TRUE); ?>
        <!-- // Footer -->
    </div>
    <!-- /st-container -->
    <!-- Inline Script for colors and config objects; used by various external scripts; -->
    <script>
    var colors = {
        "danger-color": "#e74c3c",
        "success-color": "#81b53e",
        "warning-color": "#f0ad4e",
        "inverse-color": "#2c3e50",
        "info-color": "#2d7cb5",
        "default-color": "#6e7882",
        "default-light-color": "#cfd9db",
        "purple-color": "#9D8AC7",
        "mustard-color": "#d4d171",
        "lightred-color": "#e15258",
        "body-bg": "#f6f6f6"
    };
    var config = {
        theme: "social-2",
        skins: {
            "default": {
                "primary-color": "#16ae9f"
            },
            "orange": {
                "primary-color": "#e74c3c"
            },
            "blue": {
                "primary-color": "#4687ce"
            },
            "purple": {
                "primary-color": "#af86b9"
            },
            "brown": {
                "primary-color": "#c3a961"
            },
            "default-nav-inverse": {
                "color-block": "#242424"
            }
        }
    };
    </script>
    <!-- Separate Vendor Script Bundles -->
    <script src="<?php echo base_url();?>assets/themes/themekit/js/vendor-core.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/themekit/js/vendor-tables.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/themekit/js/vendor-forms.min.js"></script>
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/vendor-media.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/vendor-player.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/vendor-charts-all.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/vendor-charts-flot.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/vendor-charts-easy-pie.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/vendor-charts-morris.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/vendor-charts-sparkline.min.js"></script> -->
    <script src="<?php echo base_url();?>assets/themes/themekit/js/vendor-maps.min.js"></script>
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/vendor-tree.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/vendor-nestable.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/vendor-angular.min.js"></script> -->
    <!-- Compressed Vendor Scripts Bundle
    Includes all of the 3rd party JavaScript libraries above.
    The bundle was generated using modern frontend development tools that are provided with the package
    To learn more about the development process, please refer to the documentation.
    Do not use it simultaneously with the separate bundles above. -->
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/vendor-bundle-all.min.js"></script> -->
    <!-- Compressed App Scripts Bundle
    Includes Custom Application JavaScript used for the current theme/module;
    Do not use it simultaneously with the standalone modules below. -->
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/module-bundle-main.min.js"></script> -->
    <!-- Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules may have not been used with the current theme/module
    but ALL the modules are 100% compatible -->
    <script src="<?php echo base_url();?>assets/themes/themekit/js/module-essentials.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/themekit/js/module-layout.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/themekit/js/module-sidebar.min.js"></script>
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/module-media.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/module-player.min.js"></script> -->
    <script src="<?php echo base_url();?>assets/themes/themekit/js/module-timeline.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/themekit/js/module-chat.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/themekit/js/module-maps.min.js"></script>
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/module-charts-all.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/module-charts-flot.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/module-charts-easy-pie.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/module-charts-morris.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/themes/themekit/js/module-charts-sparkline.min.js"></script> -->
    <!-- [social-2] Core Theme Script:
        Includes the custom JavaScript for this theme/module;
        The file has to be loaded in addition to the UI modules above;
        module-bundle-main.js already includes theme-core.js so this should be loaded
        ONLY when using the standalone modules; -->
    <script src="<?php echo base_url();?>assets/themes/themekit/js/theme-core.min.js"></script>
</body>
</html>