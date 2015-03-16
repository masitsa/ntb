 <nav class="navbar navbar-subnav navbar-static-top margin-bottom-none" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#subnav">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-ellipsis-h"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="subnav">
            <ul class="nav navbar-nav ">

                <li class="active"><a href="<?php echo base_url();?>timeline"><i class="fa fa-fw icon-ship-wheel"></i> Timeline</a>
                </li>
                <li><a href="<?php echo base_url();?>profile"><i class="fa fa-fw icon-user-1"></i> About</a>
                </li>
                <li><a href="<?php echo base_url();?>friends"><i class="fa fa-fw fa-users"></i> Friends</a>
                </li>
                <li><a href="<?php echo base_url();?>all-events"><i class="fa fa-fw icon-ship-wheel"></i> Events / Conferences</a>
                </li>
            </ul>
            <ul class="nav navbar-nav hidden-xs navbar-right ">
                <li><a href="#" data-toggle="chat-box">Chat <i class="fa fa-fw fa-comment-o"></i></a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>