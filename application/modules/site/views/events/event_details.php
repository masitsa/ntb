<?php
$meeting_detail = $this->events_model->get_event_name($meeting_id);
if ($meeting_detail->num_rows() > 0)
{
    foreach ($meeting_detail->result() as $row)
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
        $parent_meeting = $row->parent_meeting;
        // get the parent meeting name
        $meeting_name = $this->events_model->get_parent_meeting_name($parent_meeting);
        // get the parent meeting ends

        // 


        $meeting_date = date('j M Y',strtotime($meeting_date));
        $end_date = date('j M Y',strtotime($end_date));
    }
}

?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/themes/minified/themes/default.min.css" type="text/css" media="all" />

<script src="<?php echo base_url();?>assets/themes/minified/jquery.sceditor.bbcode.min.js"></script>
<script>
            // Source: http://www.backalleycoder.com/2011/03/20/link-tag-css-stylesheet-load-event/
            var loadCSS = function(url, callback){
                var link = document.createElement('link');
                link.type = 'text/css';
                link.rel = 'stylesheet';
                link.href = url;
                link.id = 'theme-style';

                document.getElementsByTagName('head')[0].appendChild(link);

                var img = document.createElement('img');
                img.onerror = function(){
                    if(callback) callback(link);
                }
                img.src = url;
            }

            $(document).ready(function() {
                var initEditor = function() {
                    $("textarea").sceditor({
                        plugins: 'bbcode',
                        style: "./minified/jquery.sceditor.default.min.css"
                    });
                };

                $("#theme").change(function() {
                    var theme = "./minified/themes/" + $(this).val() + ".min.css";

                    $("textarea").sceditor("instance").destroy();
                    $("link:first").remove();
                    $("#theme-style").remove();

                    loadCSS(theme, initEditor);
                });

                initEditor();
            });
        </script>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <div class="hgroup title">
         <h4>Subject : <?php echo $subject;?></h4>
         <p><span>Event Dates : </span> <?php echo $meeting_date;?> - <?php echo $end_date;?></p>
          <p><span>Event type :</span> <?php echo $event_type_name;?>, <span>Agency :</span> <?php echo $agency_name;?></p>
         <p><span>Country :</span> <?php echo $country_name;?>,<span> Location : <span/><?php echo $location;?></p>
         <p><span>Parent Meeting :</span> <?php echo $meeting_name;?>
    </div>
</div>

<div class="modal-body">
    <div role="tabpanel">

      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Meeting Notes</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Convenors</a></li>
        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Attendees</a></li>
        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Action points</a></li>
        <li role="presentation"><a href="#attachments" aria-controls="attachments" role="tab" data-toggle="tab">Attachments</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <!-- <?php echo form_open('site/save_meeting_notes/'.$meeting_id, array('class' => 'form-horizontal'));?> -->
           <form enctype="multipart/form-data" meeting_id="<?php echo $meeting_id;?>" action="<?php echo base_url();?>site/save_meeting_notes/<?php echo $meeting_id;?>"  id = "meeting_notes_form" method="post">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="control-group">
                            <label for="review_text" class="control-label">Minutes</label>
                            <div class="controls">
                                <!-- <textarea name="bbcode_field" id="bbcode_field2" class="col-md-12" style="height:200px;width:800px;" ></textarea> -->
                                <?php
                                    $rs = $this->site_model->get_notes_details($meeting_id);
                                    $num_meeting_notes = count($rs);
                                   $number = $this->site_model->get_meeting_notes($meeting_id);

                                    if($number > 0)
                                    {
                                        foreach ($rs->result() as $cont)
                                        {
                                            $notes = $cont->notes;
                                        }
                                        ?>
                                        <textarea id="editor1" name="editor1" rows="10" cols="100" class="form-control col-md-6" ><?php echo $notes;?></textarea>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <textarea id="editor1" name="editor1" rows="10" cols="100" class="form-control col-md-6" ></textarea>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                     <div class="col-sm-12">
                        <div class="control-group">
                        <label for="review_text" class="control-label"></label>

                            <div class="controls">
                                <div class="pull-right">
                                    <button class="btn btn-primary btn-sm" type="submit">Edit meeting details</button>
                                      <!-- <a hred="#" class="btn btn-large btn-success btn-sm" onclick="save_meeting_notes(<?php echo $meeting_id;?>)">Save Nurse Notes</a> -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php echo form_close();?>
         </div>
        <div role="tabpanel" class="tab-pane" id="profile">
            <a   class="btn btn-info btn-xs send_mass_convenors_mail" href="<?php echo $meeting_id;?>" meeting_id='<?php echo $meeting_id;?>' data-toggle="tooltip" data-placement="top" title="" data-original-title="send mass notification"><i class="fa fa-fw fa-envelope"></i> Send Mass Email Notification</a>

            <a data-toggle="modal" data-target=".add-convenor"  class="btn btn-success btn-sm pull-right"  data-toggle="tooltip" data-placement="top" title="Add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Convenor</a>
            
            <div class="modal fade add-convenor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="hgroup title">
                             <h3>Convenors for <?php echo $subject;?>!</h3>
                        </div>
                    </div>
                        <form enctype="multipart/form-data" meeting_id="<?php echo $meeting_id;?>" action="<?php echo base_url();?>add-meeting-facilitator/<?php echo $meeting_id;?>"  id = "convenor_form" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="control-group">
                                            <label class="control-label">Title</label>
                                            <div class="controls">
                                               <select name="facilitator_title" class="form-control">
                                                <option value="">--Select title--</option>
                                                <?php
                                                $titles_query = $this->attendee_model->get_titles();

                                                if($titles_query->num_rows() > 0)
                                                {
                                                    foreach($titles_query->result() as $res)
                                                    {
                                                        $title_id = $res->title_id;
                                                        $title_name = $res->title_name;
                                                        
                                                        if($title_name == $attendee_title)
                                                        {
                                                            echo '<option value="'.$title_name.'" selected="selected">'.$title_name.'</option>';
                                                        }
                                                        
                                                        else
                                                        {
                                                            echo '<option value="'.$title_name.'">'.$title_name.'</option>';
                                                        }
                                                    }
                                                }
                                            ?>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="control-group">
                                             <label class="control-label">First Name</label>
                                            <div class="controls">
                                                 <input type="text" class="form-control" name="facilitator_first_name" placeholder="First name" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="control-group">
                                             <label class="control-label">Last Name</label>
                                            <div class="controls">
                                                 <input type="text" class="form-control" name="facilitator_last_name" placeholder="Last name" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="control-group">
                                             <label class="control-label">Convenor email</label>
                                            <div class="controls">
                                                 <input type="text" class="form-control" name="facilitator_email" placeholder="Email address" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="pull-right">
                                    <button class="btn btn-danger btn-sm" type="submit"  data-dismiss="modal" aria-hidden="true">Close</button>
                                    <button class="btn btn-primary btn-sm" type="submit" onclick="">Add Convenor</button>
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
           <table data-toggle="data-table" class="table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="20">
                            <div class="checkbox checkbox-single margin-none">
                                <input id="checkAll" data-toggle="check-all" data-target="#responsive-table-body" type="checkbox">
                                <label for="checkAll">Check All</label>
                            </div>
                        </th>
                        <th>Title</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-right" colspan="3">Actions</th>
                    </tr>
                </thead>
                <tbody >
                <?php
                    $facilitators = $this->facilitator_model->get_all_facilitators_time($meeting_id);
                    if ($facilitators->num_rows() > 0)
                    {
                        
                        foreach ($facilitators->result() as $row)
                        {
                            $facilitator_id = $row->facilitator_id;
                            $facilitator_first_name = $row->facilitator_first_name;
                            $facilitator_last_name = $row->facilitator_last_name;
                            $facilitator_title = $row->facilitator_title;
                            $facilitator_email = $row->facilitator_email;
                            $facilitator_status = $row->facilitator_status;

                            $combine = $facilitator_id."/".$meeting_id;
                            
                            
                            if($facilitator_status == 1)
                            {
                                $status = '<span class="label label-success btn-xs">Active</span>';
                                $button = '<a class="btn btn-default btn-xs delete_facilitator"  href="'.$facilitator_id.'" facilitator_id="'.$facilitator_id.'" >Deactivate</a>';
                            }
                            
                            else
                            {
                                $status = '<span class="label label-danger label-xs">Disabled</span>';
                                $button = '<a class="btn btn-danger btn-xs" href="'.site_url().'activate-facilitator/'.$facilitator_id.'" onclick="return confirm(\'Do you want to activate '.$facilitator_first_name.'?\');">Activate</a>';
                            }
                            
                            ?>
                            <tr>
                                <td>
                                    <div class="checkbox checkbox-single">
                                        <input id="checkbox<?php echo $facilitator_id?>" type="checkbox" checked>
                                        <label for="checkbox<?php echo $facilitator_id?>">Label</label>
                                    </div>
                                </td>
                                 <td>
                                    <?php echo $facilitator_title;?>
                                </td>
                                <td><?php echo $facilitator_first_name;?></td>
                                <td><?php echo $facilitator_last_name;?></td>
                                <td><?php echo $facilitator_email;?></td>
                                <td><?php echo $status;?></td>
                                <td><?php echo $button;?></td>
                                
                                <td>
                                    <a href="<?php echo base_url();?>edit-facilitator/<?php echo $facilitator_id;?>/<?php echo $meeting_id;?>" target="_blank" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                </td>
                                <td>
                                    <a  class="btn btn-danger btn-xs delete_facilitator"  href="<?php echo $combine;?>" facilitator_id="<?php echo $combine;?>"data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-times"></i></a>
                                </td>
                                <td>
                                    <a  class="btn btn-info btn-xs send_convenors_mail" href="<?php echo $combine;?>" facilitator_id="<?php echo $combine;?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="send notification"><i class="fa fa-fw fa-envelope"></i></a>
                                </td>
                            </tr>
                            <?php    
                        }
                    }
                    ?>
                    
                  
                </tbody>
            </table>

        </div>
        <div role="tabpanel" class="tab-pane" id="messages">
            <a   class="btn btn-info btn-xs send_mass_attendees_mail" href="<?php echo $meeting_id;?>" meeting_id='<?php echo $meeting_id;?>' data-toggle="tooltip" data-placement="top" title="" data-original-title="send mass notification"><i class="fa fa-fw fa-envelope"></i> Send Mass Email Notification</a>

            <a data-toggle="modal" data-target=".add-attendees"  class="btn btn-success btn-sm pull-right"  data-toggle="tooltip" data-placement="top" title="Add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add attendee</a>
            
            <div class="modal fade add-attendees" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="hgroup title">
                             <h3>Attendees for <?php echo $subject;?>!</h3>
                        </div>
                    </div>
                        <form enctype="multipart/form-data" meeting_id="<?php echo $meeting_id;?>" action="<?php echo base_url();?>add-meeting-attendee/<?php echo $meeting_id;?>"  id = "attendee_form" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="form-group">
                                            <label class="col-lg-4 control-label"> </label>
                                            <div class="col-lg-8">
                                                <input type="radio" name="attendee_type" value="2"   onclick="check_attendee_type(2)"> Other Member
                                                <input type="radio" name="attendee_type" value="1" onclick="check_attendee_type(1)"> TNC Member
                                             </div>
                                         </div>
                                    </div>
                                </div>
                                <div id="tnc_member_div" style="display:none">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="control-group">
                                                <label class="control-label">Member</label>
                                                <div class="controls">
                                                   <select name="member_id" class="form-control">
                                                    <option value="">--Select a member--</option>
                                                    <?php
                                                    $members_query = $this->events_model->get_all_members();

                                                    if($members_query->num_rows() > 0)
                                                    {
                                                        foreach($members_query->result() as $res)
                                                        {
                                                            $user_id = $res->user_id;
                                                            $first_name = $res->first_name;
                                                            $other_names = $res->other_names;
                                                            $name = $first_name." ".$other_names;
                                                            echo '<option value="'.$user_id.'">'.$name.'</option>';
                                                            
                                                        }
                                                    }
                                                ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                 <div id="other_member_div" style="display:block">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="control-group">
                                                <label class="control-label">Title</label>
                                                <div class="controls">
                                                   <select name="attendee_title" class="form-control">
                                                    <option value="">--Select title--</option>
                                                    <?php
                                                    $titles_query = $this->attendee_model->get_titles();

                                                    if($titles_query->num_rows() > 0)
                                                    {
                                                        foreach($titles_query->result() as $res)
                                                        {
                                                            $title_id = $res->title_id;
                                                            $title_name = $res->title_name;
                                                            
                                                            if($title_name == $attendee_title)
                                                            {
                                                                echo '<option value="'.$title_name.'" selected="selected">'.$title_name.'</option>';
                                                            }
                                                            
                                                            else
                                                            {
                                                                echo '<option value="'.$title_name.'">'.$title_name.'</option>';
                                                            }
                                                        }
                                                    }
                                                ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                         <div class="control-group">
                                                 <label class="control-label">First Name</label>
                                                <div class="controls">
                                                     <input type="text" class="form-control" name="attendee_first_name" placeholder="First name" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                       
                                        <div class="col-sm-6">
                                            <div class="control-group">
                                                 <label class="control-label">Last Name</label>
                                                <div class="controls">
                                                     <input type="text" class="form-control" name="attendee_last_name" placeholder="Last name" value="">
                                                </div>
                                            </div>
                                        </div>
                                   
                                        <div class="col-sm-6">
                                            <div class="control-group">
                                                 <label class="control-label">Atendee email</label>
                                                <div class="controls">
                                                     <input type="text" class="form-control" name="attendee_email" placeholder="Email address" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="pull-right">
                                    <button class="btn btn-danger btn-sm" type="submit"  data-dismiss="modal" aria-hidden="true">Close</button>
                                    <button class="btn btn-primary btn-sm" type="submit" onclick="">Add attendee</button>
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
            <table class="table v-middle">
                <thead>
                    <tr>
                        <th width="20">
                            <div class="checkbox checkbox-single margin-none">
                                <input id="checkAll" data-toggle="check-all" data-target="#responsive-table-body" type="checkbox">
                                <label for="checkAll">Check All</label>
                            </div>
                        </th>
                        <th>Title</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-right" colspan="3">Actions</th>
                    </tr>
                </thead>
                <tbody id="responsive-table-body">
                <?php
                $attendees = $this->attendee_model->get_all_attendees_time($meeting_id);
                    if ($attendees->num_rows() > 0)
                    {
                        
                        foreach ($attendees->result() as $row)
                        {
                            $attendee_id = $row->attendee_id;
                            $attendee_first_name = $row->attendee_first_name;
                            $attendee_last_name = $row->attendee_last_name;
                            $attendee_title = $row->attendee_title;
                            $attendee_email = $row->attendee_email;
                            $attendee_status = $row->attendee_status;
                             $combine2 = $attendee_id."/".$meeting_id;
                           
                            if($attendee_status == 1)
                            {
                                $status = '<span class="label label-success label-sm">Active</span>';
                                $button = '<a class="btn btn-default btn-sm" href="'.site_url().'deactivate-attendee/'.$attendee_id.'" onclick="return confirm(\'Do you want to deactivate '.$attendee_first_name.'?\');">Deactivate</a>';
                            }
                            
                            else
                            {
                                $status = '<span class="label label-danger label-sm">Disabled</span>';
                                $button = '<a class="btn btn-danger btn-sm" href="'.site_url().'activate-attendee/'.$attendee_id.'" onclick="return confirm(\'Do you want to activate '.$attendee_first_name.'?\');">Activate</a>';
                            }
                            
                            ?>
                            <tr>
                                <td>
                                    <div class="checkbox checkbox-single">
                                        <input id="checkbox<?php echo $attendee_id?>" type="checkbox" checked>
                                        <label for="checkbox<?php echo $attendee_id?>">Label</label>
                                    </div>
                                </td>
                                 <td>
                                    <?php echo $attendee_title;?>
                                </td>
                                <td><?php echo $attendee_first_name;?></td>
                                <td><?php echo $attendee_last_name;?></td>
                                <td><?php echo $attendee_email;?></td>
                                <td><?php echo $status;?></td>
                                <!-- <td><?php echo $button;?></td> -->
                                
                                <!-- <td>
                                    <a href="<?php echo base_url();?>edit-attendee/<?php echo $attendee_id;?>/<?php echo $meeting_id;?>" target="_blank" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-danger btn-xs " data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-times"></i></a>
                                </td> -->
                                <td>
                                    <a  class="btn btn-info btn-xs send_attendees_mail" href="<?php echo $combine2;?>" attendee_id="<?php echo $combine2;?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="send notification"><i class="fa fa-fw fa-envelope"></i></a>
                                </td>
                            </tr>
                            <?php    
                        }
                    }
                    ?>
                    
                  
                </tbody>
            </table>

        </div>
        <div role="tabpanel" class="tab-pane" id="settings">
         <a data-toggle="modal" data-target=".add-acction-point"  class="btn btn-success btn-sm pull-right"  data-toggle="tooltip" data-placement="top" title="Add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add action point</a>
            
            <div class="modal fade add-acction-point" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="hgroup title">
                             <h3>Action point for <?php echo $subject;?>!</h3>
                        </div>
                    </div>
                        <form enctype="multipart/form-data" meeting_id="<?php echo $meeting_id;?>" action="<?php echo base_url();?>add-meeting-action-point/<?php echo $meeting_id;?>"  id = "action_point_form" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="control-group">
                                             <label class="control-label">Assign to</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="assigned_to" id="assigned_to" placeholder="Assigned to" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="control-group">
                                            <label class="control-label">Priority</label>
                                            <div class="controls">
                                               <select name="priority_status_id" id="priority_status_id" class="form-control">
                                                <option value="">--Select priority--</option>
                                                <?php
                                                $priority_status_query = $this->action_point_model->get_priority_statuses();
                                                $action_status_query = $this->action_point_model->get_action_statuses();
                                                
                                                if($priority_status_query->num_rows() > 0)
                                                {
                                                    foreach($priority_status_query->result() as $res)
                                                    {
                                                        $priority_status_id2 = $res->priority_status_id;
                                                        $priority_status_name = $res->priority_status_name;
                                                        
                                                        if($priority_status_id2 == $priority_status_id)
                                                        {
                                                            echo '<option value="'.$priority_status_id2.'" selected="selected">'.$priority_status_name.'</option>';
                                                        }
                                                        
                                                        else
                                                        {
                                                            echo '<option value="'.$priority_status_id2.'">'.$priority_status_name.'</option>';
                                                        }
                                                    }
                                                }
                                            ?>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="control-group">
                                            <label class="control-label">Action Status</label>
                                            <div class="controls">
                                               <select name="actions_status_id" id="actions_status_id" class="form-control">
                                                <option value="">--Select action--</option>
                                            <?php
                                                if($action_status_query->num_rows() > 0)
                                                {
                                                    foreach($action_status_query->result() as $res)
                                                    {
                                                        $actions_status_id2 = $res->action_status_id;
                                                        $action_status_name = $res->action_status_name;
                                                        
                                                        if($actions_status_id2 == $actions_status_id)
                                                        {
                                                            echo '<option value="'.$actions_status_id2.'" selected="selected">'.$action_status_name.'</option>';
                                                        }
                                                        
                                                        else
                                                        {
                                                            echo '<option value="'.$actions_status_id2.'">'.$action_status_name.'</option>';
                                                        }
                                                    }
                                                }
                                            ?>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="control-group">
                                             <label class="control-label">Note</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="action_point_notes" id="action_point_notes" placeholder="point 1, point 2" value="">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="pull-right">
                                    <button class="btn btn-danger btn-sm" type="submit"  data-dismiss="modal" aria-hidden="true">Close</button>
                                    <button class="btn btn-primary btn-sm" type="submit" onclick="">Add action point</button>
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
               <table data-toggle="data-table" class="table" cellspacing="0" width="100%">
                <thead>
                    <th width="20">
                        <div class="checkbox checkbox-single margin-none">
                            <input id="checkAll" data-toggle="check-all" data-target="#responsive-table-body" type="checkbox">
                            <label for="checkAll">Check All</label>
                        </div>
                    </th>
                    <th>Assigned to</th>
                    <th>Priority</th>
                    <th>Action</th>
                    <th>Notes</th>
                    <th class="text-right" colspan="2">Actions</th>
                </thead>
                <tbody id="responsive-table-body">
                     <?php
                        $action_points = $this->action_point_model->get_all_action_points_time($meeting_id);
                        if ($action_points->num_rows() > 0)
                        {
                          
                            
                            foreach ($action_points->result() as $row)
                            {
                                $action_point_id = $row->action_point_id;
                                $created = $row->created;
                                $priority_status_name = $row->priority_status_name;
                                $action_status_name = $row->action_status_name;
                                $assigned_to = $row->assigned_to;
                                $action_point_notes = $row->action_point_notes;
                             
                                
                                ?>
                                <tr>
                                    <td>
                                        <div class="checkbox checkbox-single">
                                            <input id="checkbox<?php echo $action_point_id?>" type="checkbox" checked>
                                            <label for="checkbox<?php echo $action_point_id?>">Label</label>
                                        </div>
                                    </td>
                                    <td><?php echo $assigned_to;?></td>
                                    <td><?php echo $priority_status_name;?></td>
                                    <td><?php echo $action_status_name;?></td>
                                    <td><?php echo $action_point_notes;?></td>
                                    <td >
                                         <a href="<?php echo base_url();?>edit-action-point/<?php echo $action_point_id;?>/<?php echo $meeting_id;?>" target="_blank" class="btn btn-info btn-sm">Edit Action point</a>
                                    </td>
                                </tr>
                                <?php    
                            }
                        }
                        ?>
                </tbody>
              </table>

        </div>
        <div role="tabpanel" class="tab-pane" id="attachments">
            <a data-toggle="modal" data-target=".add-event"  class="btn btn-success btn-sm pull-right"  data-toggle="tooltip" data-placement="top" title="Add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add attachment</a>
            
            <div class="modal fade add-event" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="hgroup title">
                             <h3>Attachments for <?php echo $subject;?>!</h3>
                        </div>
                    </div>
                        <form enctype="multipart/form-data" meeting_id="<?php echo $meeting_id;?>" action="<?php echo base_url();?>site/upload_controller/do_upload/<?php echo $meeting_id;?>"  id = "attachment_form" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="control-group">
                                            <label class="control-label">Attachment</label>
                                            <div class="controls">
                                               <input type="file" name="userfile"  class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="pull-right">
                                    <button class="btn btn-danger btn-sm" type="submit"  data-dismiss="modal" aria-hidden="true">Close</button>
                                    <button class="btn btn-primary btn-sm" type="submit" onclick="">Upload Attachment</button>
                                </div>
                            </div> 
                        </form>


                    </div>
                </div>
            </div>
               <table data-toggle="data-table" class="table" cellspacing="0" width="100%">
                <thead>
                    <th width="20">
                       
                    </th>
                    <th>Created</th>
                    <th>File Name</th>
                    <th>Attachment</th>
                    <th class="text-right" colspan="2">Actions</th>
                </thead>
                <tbody id="responsive-table-body">
                     <?php
                        $meeting_attachments = $this->site_model->get_all_meeting_attachments($meeting_id);
                        if ($meeting_attachments->num_rows() > 0)
                        {
                          
                            $x =0;
                            foreach ($meeting_attachments->result() as $row)
                            {
                                $file_id = $row->file_id;
                                $created = $row->created_on;
                                $file_delete = $row->file_delete;
                                $file_name = $row->filename;
                                $created_by = $row->created_by;
                             
                                $x++;
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $x;?>
                                    </td>
                                     <td>
                                        <span class="label label-default"><?php echo date('jS M Y H:i a',strtotime($created));?></span>
                                    </td>
                                    <td>
                                        <?php echo $file_name;?>
                                    </td>
                                    <td><a href="<?php echo base_url();?>assets/files/<?php echo $file_name;?>" target="_blank">Download attachment</a></td>

                                   <!--  <td >
                                         <a href="<?php echo base_url();?>" target="_blank" class="btn btn-warning btn-sm">Delete</a>
                                    </td> -->
                                </tr>
                                <?php    
                            }
                        }
                        ?>
                </tbody>
              </table>
        </div>
      </div>

    </div>
</div>
<script type="text/javascript">
function check_attendee_type(type_id){

        var myTarget2 = document.getElementById("tnc_member_div");

        var myTarget3 = document.getElementById("other_member_div");

        if(type_id == 1)
        {
            myTarget2.style.display = 'block';
            myTarget3.style.display = 'none';
        }
        else
        {
            myTarget2.style.display = 'none';
            myTarget3.style.display = 'block';
        }

        
    }
function save_meeting_notes(meeting_id){
    var data_url = '<?php echo site_url()?>site/save_meeting_notes/'+meeting_id;
    var val = instance.val();
    alert(val);
    // var meeting_notes = $('textarea').sceditor('editor1').val();
    // window.alert(meeting_notes);
    // $.ajax({
    // type:'POST',
    // url: data_url,
    // data:{notes: meeting_notes},
    // dataType: 'text',
    // success:function(data){
    //     alert("You have successfully updated the meeting notes");
    // //obj.innerHTML = XMLHttpRequestObject.responseText;
    // },
    // error: function(xhr, status, error) {
    // //alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
    // alert(error);
    // }

    // });

    
}
</script>