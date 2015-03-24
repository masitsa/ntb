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
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <?php echo form_open('site/save_meeting_notes/'.$meeting_id, array('class' => 'form-horizontal'));?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="control-group">
                            <label for="review_text" class="control-label">Minutes</label>
                            <div class="controls">
                                <!-- <textarea name="bbcode_field" id="bbcode_field2" class="col-md-12" style="height:200px;width:800px;" ></textarea> -->
                                <?php
                                    $rs = $this->site_model->get_meeting_notes($meeting_id);
                                    $num_meeting_notes = count($rs);
                                    if($num_meeting_notes > 0)
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
            <a  href="<?php echo base_url();?>add-facilitator/<?php echo $meeting_id;?>" target="_blank" class="btn btn-success btn-sm pull-right"  data-toggle="tooltip" data-placement="top" title="Add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Facilitators</a>

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
                            
                            
                            if($facilitator_status == 1)
                            {
                                $status = '<span class="label label-success">Active</span>';
                                $button = '<a class="btn btn-default btn-sm" href="'.site_url().'deactivate-facilitator/'.$facilitator_id.'" onclick="return confirm(\'Do you want to deactivate '.$facilitator_first_name.'?\');">Deactivate</a>';
                            }
                            
                            else
                            {
                                $status = '<span class="label label-danger">Disabled</span>';
                                $button = '<a class="btn btn-danger btn-sm" href="'.site_url().'activate-facilitator/'.$facilitator_id.'" onclick="return confirm(\'Do you want to activate '.$facilitator_first_name.'?\');">Activate</a>';
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
                                <td >
                                     <a href="<?php echo base_url();?>edit-facilitator/<?php echo $facilitator_id;?>/<?php echo $meeting_id;?>" target="_blank" class="btn btn-info btn-sm">Edit Facilitator Details</a>
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
            <a  href="<?php echo base_url();?>add-attendee/<?php echo $meeting_id;?>" target="_blank" class="btn btn-success btn-sm pull-right"  data-toggle="tooltip" data-placement="top" title="Add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Attendees</a>

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
                                <td><?php echo $button;?></td>
                                <td >
                                     <a href="<?php echo base_url();?>edit-attendee/<?php echo $attendee_id;?>/<?php echo $meeting_id;?>" target="_blank" class="btn btn-info btn-sm">Edit Attendee details</a>
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
                <a  href="<?php echo base_url();?>add-action-point/<?php echo $meeting_id;?>" target="_blank" class="btn btn-success btn-sm pull-right"  data-toggle="tooltip" data-placement="top" title="Add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add action point</a>

               <table class="table v-middle">
                <thead>
                    <th width="20">
                        <div class="checkbox checkbox-single margin-none">
                            <input id="checkAll" data-toggle="check-all" data-target="#responsive-table-body" type="checkbox">
                            <label for="checkAll">Check All</label>
                        </div>
                    </th>
                    <th>Created</th>
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
                                     <td>
                                        <span class="label label-default"><?php echo date('jS M Y H:i a',strtotime($created));?></span>
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
      </div>

    </div>
</div>
<script type="text/javascript">

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