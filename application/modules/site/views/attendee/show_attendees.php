 <a   class="btn btn-info btn-xs send_mass_attendees_mail" href="<?php echo $meeting_id;?>" meeting_id='<?php echo $meeting_id;?>' data-toggle="tooltip" data-placement="top" title="" data-original-title="send mass notification"><i class="fa fa-fw fa-envelope"></i> Send Mass Email Notification</a>

<a data-toggle="modal" data-target=".add-attendees"  class="btn btn-success btn-sm pull-right"  data-toggle="tooltip" data-placement="top" title="Add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add attendee</a>

<div class="modal fade add-attendees" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="hgroup title">
                 <h3>Attendees for</h3>
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
                $user_id = $row->user_id;
                 $combine2 = $attendee_id."/".$meeting_id;
               
                if($attendee_status == 0)
                {
                    $status = '<span class="label label-success label-sm">Active</span>';
                    $button = '<a class="btn btn-danger btn-xs"  onclick="deactivate_attendee('.$attendee_id.','.$meeting_id.')">Deactivate</a>';
                }
                
                else
                {
                    $status = '<span class="label label-danger label-sm">Disabled</span>';
                    $button = '<a class="btn btn-success btn-xs"  onclick="activate_attendee('.$attendee_id.','.$meeting_id.');">Activate</a>';
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
                    <td><?php echo $button;?></td>
                    
                    <td>
                    	<a data-toggle="modal" data-target=".edit-attendees<?php echo $attendee_id;?>"  class="btn btn-success btn-xs"  data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> edit attendee details</a>

						<div class="modal fade edit-attendees<?php echo $attendee_id;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-lg">
						    <div class="modal-content">
						         <div class="modal-header">
						            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						            <div class="hgroup title">
						                 <h3>Attendees for</h3>
						            </div>
						        </div>
						            <form enctype="multipart/form-data" meeting_id="<?php echo $meeting_id;?>" action="<?php echo base_url();?>update-meeting-attendee/<?php echo $attendee_id;?>/<?php echo $meeting_id;?>"  id = "update_attendee_form" method="post">
						                <div class="modal-body">
						                  
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
						                                         <input type="text" class="form-control" name="attendee_first_name" placeholder="First name" value="<?php echo $attendee_first_name;?>">
						                                    </div>
						                                </div>
						                            </div>
						                        </div>
						                        <div class="row">
						                           
						                            <div class="col-sm-6">
						                                <div class="control-group">
						                                     <label class="control-label">Last Name</label>
						                                    <div class="controls">
						                                         <input type="text" class="form-control" name="attendee_last_name" placeholder="Last name" value="<?php echo $attendee_last_name;?>">
						                                    </div>
						                                </div>
						                            </div>
						                       
						                            <div class="col-sm-6">
						                                <div class="control-group">
						                                     <label class="control-label">Atendee email</label>
						                                    <div class="controls">
						                                         <input type="text" class="form-control" name="attendee_email" placeholder="Email address" value="<?php echo $attendee_email;?>">
						                                    </div>
						                                </div>
						                            </div>
						                        </div>
						                   
						                </div>
						                <div class="modal-footer">
						                    <div class="pull-right">
						                        <button class="btn btn-danger btn-sm" type="submit"  data-dismiss="modal" aria-hidden="true">Close</button>
						                        <button class="btn btn-primary btn-sm" type="submit" onclick="">Update <?php echo $attendee_last_name;?> details</button>
						                    </div>
						                </div> 
						            </form>
						        </div>
						    </div>
						</div>
                    </td>
                    <td>
                        <a  class="btn btn-info btn-xs send_attendees_mail" href="<?php echo $combine2;?>" attendee_id="<?php echo $combine2;?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="send notification"><i class="fa fa-fw fa-envelope"></i> send notification</a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-danger btn-xs " data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-times"></i> Delete from List</a>
                    </td>
                    
                </tr>
                <?php    
            }
        }
        ?>
        
      
    </tbody>
</table>