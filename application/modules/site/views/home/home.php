<!-- <div class="cover overlay cover-image-full height-300-lg">
    <img src="<?php echo base_url();?>assets/themes/themekit/images/profile-cover.jpg" alt="cover" />
    <div class="overlay overlay-full">
        <div class="v-top">
            <a href="#" class="btn btn-cover"><i class="fa fa-pencil"></i></a>
        </div>
    </div>
</div> -->

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading panel-heading-gray">
            <i class="fa fa-bookmark"></i> Tasks Summary
            <div class="pull-right">
            <a href="<?php echo base_url();?>all-events" class="btn btn-primary btn-xs " > <i class="fa fa-fw fa-folder"></i> View all meetings </a> 
            <a href="<?php echo base_url();?>calender" class="btn btn-info btn-xs" > <i class="fa fa-fw fa-calendar"></i> View in calendar </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div id="assigned_tasks"></div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div id="tasks_to_review"></div>
                </div>

            </div>
           
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading panel-heading-gray">
            <i class="fa fa-bookmark"></i> Meetings summary

        </div>
        <div class="panel-body">
             <div class="row">
                <div class="col-md-6">
                    <div id="upcoming_meetings"></div>
                </div>
                 <div class="col-md-6 col-lg-6">
                    <div id="my_statistics"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
      assigned_tasks();
      tasks_to_review();
      upcoming_meetings();
      my_statistics();
    });

    function assigned_tasks(){

        var XMLHttpRequestObject = false;
            
        if (window.XMLHttpRequest) {
        
            XMLHttpRequestObject = new XMLHttpRequest();
        } 
            
        else if (window.ActiveXObject) {
            XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
        }

        var url = "<?php echo base_url();?>assigned-tasks";

                
        if(XMLHttpRequestObject) {
            
            var obj = document.getElementById("assigned_tasks");
                    
            XMLHttpRequestObject.open("GET", url);
                    
            XMLHttpRequestObject.onreadystatechange = function(){
                
                if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
                    obj.innerHTML = XMLHttpRequestObject.responseText;
                   
                 
                }
            }
                    
            XMLHttpRequestObject.send(null);
        }
    }
    function tasks_to_review(){

        var XMLHttpRequestObject = false;
            
        if (window.XMLHttpRequest) {
        
            XMLHttpRequestObject = new XMLHttpRequest();
        } 
            
        else if (window.ActiveXObject) {
            XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
        }

        var url = "<?php echo base_url();?>tasks-to-review";

                
        if(XMLHttpRequestObject) {
            
            var obj = document.getElementById("tasks_to_review");
                    
            XMLHttpRequestObject.open("GET", url);
                    
            XMLHttpRequestObject.onreadystatechange = function(){
                
                if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
                    obj.innerHTML = XMLHttpRequestObject.responseText;
                   
                 
                }
            }
                    
            XMLHttpRequestObject.send(null);
        }
    }
    function upcoming_meetings(){

        var XMLHttpRequestObject = false;
            
        if (window.XMLHttpRequest) {
        
            XMLHttpRequestObject = new XMLHttpRequest();
        } 
            
        else if (window.ActiveXObject) {
            XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
        }

        var url = "<?php echo base_url();?>upcoming-meetings";

                
        if(XMLHttpRequestObject) {
            
            var obj = document.getElementById("upcoming_meetings");
                    
            XMLHttpRequestObject.open("GET", url);
                    
            XMLHttpRequestObject.onreadystatechange = function(){
                
                if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
                    obj.innerHTML = XMLHttpRequestObject.responseText;
                   
                 
                }
            }
                    
            XMLHttpRequestObject.send(null);
        }
    }
    function my_statistics(){

        var XMLHttpRequestObject = false;
            
        if (window.XMLHttpRequest) {
        
            XMLHttpRequestObject = new XMLHttpRequest();
        } 
            
        else if (window.ActiveXObject) {
            XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
        }

        var url = "<?php echo base_url();?>my-statistics";

                
        if(XMLHttpRequestObject) {
            
            var obj = document.getElementById("my_statistics");
                    
            XMLHttpRequestObject.open("GET", url);
                    
            XMLHttpRequestObject.onreadystatechange = function(){
                
                if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
                    obj.innerHTML = XMLHttpRequestObject.responseText;
                   
                 
                }
            }
                    
            XMLHttpRequestObject.send(null);
        }
    }
    function send_notification(action_status,meeting_id,attendee_id,action_point_id)
    {
        var XMLHttpRequestObject = false;
        
        if (window.XMLHttpRequest) {
        
            XMLHttpRequestObject = new XMLHttpRequest();
        } 
            
        else if (window.ActiveXObject) {
            XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var url = "<?php echo base_url();?>send-other-notification/"+action_status+"/"+meeting_id+"/"+attendee_id+"/"+action_point_id;
        if(XMLHttpRequestObject) {
                    
            XMLHttpRequestObject.open("GET", url);
                    
            XMLHttpRequestObject.onreadystatechange = function(){
                
                if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                    tasks_to_review();
                }
            }
                    
            XMLHttpRequestObject.send(null);
        }
    }
    function mark_as_complete(action_point_id)
    {
        var XMLHttpRequestObject = false;
        
        if (window.XMLHttpRequest) {
        
            XMLHttpRequestObject = new XMLHttpRequest();
        } 
            
        else if (window.ActiveXObject) {
            XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var url = "<?php echo base_url();?>mark-as-complete/"+action_point_id;
        if(XMLHttpRequestObject) {
                    
            XMLHttpRequestObject.open("GET", url);
                    
            XMLHttpRequestObject.onreadystatechange = function(){
                
                if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                    tasks_to_review();
                }
            }
                    
            XMLHttpRequestObject.send(null);
        }
    }
    function send_for_review(action_point_id,attendee_id,meeting_id)
    {
         var XMLHttpRequestObject = false;
        
        if (window.XMLHttpRequest) {
        
            XMLHttpRequestObject = new XMLHttpRequest();
        } 
            
        else if (window.ActiveXObject) {
            XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var url = "<?php echo base_url();?>send-for-review/"+action_point_id+"/"+attendee_id+"/"+meeting_id;
        if(XMLHttpRequestObject) {
                    
            XMLHttpRequestObject.open("GET", url);
                    
            XMLHttpRequestObject.onreadystatechange = function(){
                
                if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                    tasks_to_review();
                }
            }
                    
            XMLHttpRequestObject.send(null);
        }
    }
</script>