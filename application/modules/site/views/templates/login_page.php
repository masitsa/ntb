<!DOCTYPE html>
<html class="hide-sidebar ls-bottom-footer" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Events Planner</title>
    <!-- Compressed Vendor BUNDLE
    Includes vendor (3rd party) styling such as the customized Bootstrap and other 3rd party libraries used for the current theme/module -->
    <link href="<?php echo base_url()."assets/themes/themekit/";?>css/vendor.min.css" rel="stylesheet">
    <!-- Compressed Theme BUNDLE
Note: The bundle includes all the custom styling required for the current theme, however
it was tweaked for the current theme/module and does NOT include ALL of the standalone modules;
The bundle was generated using modern frontend development tools that are provided with the package
To learn more about the development process, please refer to the documentation. -->
    <!-- <link href="<?php echo base_url()."assets/themes/themekit/";?>css/theme.bundle.min.css" rel="stylesheet"> -->
    <!-- Compressed Theme CORE
This variant is to be used when loading the separate styling modules -->
    <link href="<?php echo base_url()."assets/themes/themekit/";?>css/theme-core.min.css" rel="stylesheet">
    <!-- Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules may have not been used with the current theme/module
    but ALL modules are 100% compatible -->
    <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-essentials.min.css" rel="stylesheet" />
    <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-layout.min.css" rel="stylesheet" />
    <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-sidebar.min.css" rel="stylesheet" />
    <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-sidebar-skins.min.css" rel="stylesheet" />
    <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-navbar.min.css" rel="stylesheet" />
    <!-- <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-media.min.css" rel="stylesheet" /> -->
    <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-timeline.min.css" rel="stylesheet" />
    <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-cover.min.css" rel="stylesheet" />
    <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-chat.min.css" rel="stylesheet" />
    <!-- <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-charts.min.css" rel="stylesheet" /> -->
    <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-maps.min.css" rel="stylesheet" />
    <!-- <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-colors-alerts.min.css" rel="stylesheet" /> -->
    <!-- <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-colors-background.min.css" rel="stylesheet" /> -->
    <!-- <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-colors-buttons.min.css" rel="stylesheet" /> -->
    <!-- <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-colors-calendar.min.css" rel="stylesheet" /> -->
    <!-- <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-colors-progress-bars.min.css" rel="stylesheet" /> -->
    <!-- <link href="<?php echo base_url()."assets/themes/themekit/";?>css/module-colors-text.min.css" rel="stylesheet" /> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- If you don't need support for Internet Explorer <= 8 you can safely remove these -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="login">
    

    <!-- content -->
    	<?php echo $content;?>
    <!-- end of content -->
    <!-- Footer -->
    <footer class="footer">
        <strong>Events Planner</strong> v0.1 &copy; Copyright 2015
    </footer>
    <!-- // Footer -->
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
    <script src="<?php echo base_url()."assets/themes/themekit/";?>js/vendor-core.min.js"></script>
    <script src="<?php echo base_url()."assets/themes/themekit/";?>js/vendor-tables.min.js"></script>
    <script src="<?php echo base_url()."assets/themes/themekit/";?>js/vendor-forms.min.js"></script>
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/vendor-media.min.js"></script> -->
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/vendor-player.min.js"></script> -->
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/vendor-charts-all.min.js"></script> -->
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/vendor-charts-flot.min.js"></script> -->
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/vendor-charts-easy-pie.min.js"></script> -->
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/vendor-charts-morris.min.js"></script> -->
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/vendor-charts-sparkline.min.js"></script> -->
    <script src="<?php echo base_url()."assets/themes/themekit/";?>js/vendor-maps.min.js"></script>
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/vendor-tree.min.js"></script> -->
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/vendor-nestable.min.js"></script> -->
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/vendor-angular.min.js"></script> -->
    <!-- Compressed Vendor Scripts Bundle
    Includes all of the 3rd party JavaScript libraries above.
    The bundle was generated using modern frontend development tools that are provided with the package
    To learn more about the development process, please refer to the documentation.
    Do not use it simultaneously with the separate bundles above. -->
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/vendor-bundle-all.min.js"></script> -->
    <!-- Compressed App Scripts Bundle
    Includes Custom<?php echo base_url()."assets/themes/themekit/";?> Application JavaScript used for the current theme/module;
    Do not use it simultaneously with the standalone modules below. -->
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/module-bundle-main.min.js"></script> -->
    <!-- Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules may have not been used with the current theme/module
    but ALL the modules are 100% compatible -->
    <script src="<?php echo base_url()."assets/themes/themekit/";?>js/module-essentials.min.js"></script>
    <script src="<?php echo base_url()."assets/themes/themekit/";?>js/module-layout.min.js"></script>
    <script src="<?php echo base_url()."assets/themes/themekit/";?>js/module-sidebar.min.js"></script>
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/module-media.min.js"></script> -->
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/module-player.min.js"></script> -->
    <script src="<?php echo base_url()."assets/themes/themekit/";?>js/module-timeline.min.js"></script>
    <script src="<?php echo base_url()."assets/themes/themekit/";?>js/module-chat.min.js"></script>
    <script src="<?php echo base_url()."assets/themes/themekit/";?>js/module-maps.min.js"></script>
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/module-charts-all.min.js"></script> -->
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/module-charts-flot.min.js"></script> -->
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/module-charts-easy-pie.min.js"></script> -->
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/module-charts-morris.min.js"></script> -->
    <!-- <script src="<?php echo base_url()."assets/themes/themekit/";?>js/module-charts-sparkline.min.js"></script> -->
    <!-- [social-2] Core Theme Script:
        Includes the custom JavaScript for this theme/module;
        The file has to be loaded in addition to the UI modules above;
        module-bundle-main.js already includes theme-core.js so this should be loaded
        ONLY when using the standalone modules; -->
    <script src="<?php echo base_url()."assets/themes/themekit/";?>js/theme-core.min.js"></script>
</body>
</html>