<div id="content">
    <div class="container-fluid">
        <div class="lock-container">
            <h1>Events Planner</h1>
            <?php 
			  echo form_open($this->uri->uri_string(),"class='form-horizontal'"); 
			 ?>
            <div class="panel panel-default text-center">
                <img src="" class="img-circle" style="height:125px;">
                <div class="panel-body">
                    <input class="form-control"  name="user_email" type="text" placeholder="Username">
                    <input class="form-control" name="user_password" type="password" placeholder="Enter Password">
                    <button class="btn btn-primary">Login <i class="fa fa-fw fa-unlock-alt"></i></button>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>