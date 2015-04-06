<a data-toggle="modal" data-target=".add-acction-point"  class="btn btn-success btn-sm pull-right"  data-toggle="tooltip" data-placement="top" title="Add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add action point</a>
				            
<div class="modal fade add-acction-point" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="hgroup title">
                 <h3>Action point for !</h3>
            </div>
        </div>
            <form enctype="multipart/form-data" meeting_id="<?php echo $meeting_id;?>" action="<?php echo base_url();?>add-action-point/<?php echo $meeting_id;?>"  id = "action_point_form" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="control-group">
                                 <label class="control-label">Assign to</label>
                                <div class="controls">
                                	<select name="assigned_to" id="assigned_to" class="form-control">
                                    	<option value="">--Select person to assign the task--</option>

	                                    <?php
	                                     $attendee_query = $this->attendee_model->get_active_attendees($meeting_id);
	                                    
	                                    if($attendee_query->num_rows() > 0)
	                                    {
	                                        foreach($attendee_query->result() as $attend)
	                                        {
	                                            $attendee_id = $attend->attendee_id;
	                                            $attendee_first_name = $attend->attendee_first_name;
	                                            $attendee_last_name = $attend->attendee_last_name;
	                                            $attendee_title = $attend->attendee_title;
	                                            
	                                            $name = $attendee_title.' '.$attendee_first_name.' '.$attendee_first_name;
	                                            echo '<option value="'.$attendee_id.'">'.$name.'</option>';
	                                           
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
        <th>Action point status</th>
        <th>Notes</th>
        <th>Status</th>
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
                    $priority_status_id = $row->priority_status_id;

                    $attendee_first_name = $row->attendee_first_name;
                    $attendee_last_name = $row->attendee_last_name;
                    $attendee_title = $row->attendee_title;
                    $action_status_id = $row->actions_status_id;
                    $assigned_to = $row->assigned_to;
                    $action_point_notes = $row->action_point_notes;
                 
                    $action_point_status = $row->action_point_status;	                
	                
	                if($action_point_status == 0)
	                {
	                    $status = '<span class="label label-success btn-xs">Active</span>';
	                    $button = '<a class="btn btn-danger btn-xs "  action_point_id="'.$action_point_id.'" onclick="deactivate_action_point('.$action_point_id.','.$meeting_id.')">Deactivate</a>';
	                }
	                
	                else
	                {
	                    $status = '<span class="label label-danger label-xs">Disabled</span>';
	                    $button = '<a class="btn btn-success btn-xs" onclick="activate_action_point('.$action_point_id.','.$meeting_id.')">Activate</a>';
	                }
                    ?>
                    <tr>
                        <td>
                            <div class="checkbox checkbox-single">
                                <input id="checkbox<?php echo $action_point_id?>" type="checkbox" checked>
                                <label for="checkbox<?php echo $action_point_id?>">Label</label>
                            </div>
                        </td>
                        <td><?php echo $attendee_title.' '.$attendee_first_name.' '.$attendee_last_name;?></td>
                        <td><?php echo $priority_status_name;?></td>
                        <td><?php echo $action_status_name;?></td>
                        <td><?php echo $action_point_notes;?></td>
                        <td><?php echo $button;?></td>
                        <td >
                             <a data-toggle="modal" data-target=".edit-action-point<?php echo $action_point_id;?>"  class="btn btn-success btn-xs "  data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> edit details</a>
                            <div class="modal fade edit-action-point<?php echo $action_point_id;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							         <div class="modal-header">
							            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							            <div class="hgroup title">
							                 <h3>Action point for !</h3>
							            </div>
							        </div>
							            <form enctype="multipart/form-data" meeting_id="<?php echo $meeting_id;?>" action="<?php echo base_url();?>update-meeting-action-point/<?php echo $action_point_id;?>/<?php echo $meeting_id;?>"  id = "update_action_point_form" method="post">
							                <div class="modal-body">
							                    <div class="row">
							                        <div class="col-sm-6">
							                            <div class="control-group">
							                                 <label class="control-label">Assign to</label>
							                                <div class="controls">
							                                    <select name="assigned_to" id="assigned_to" class="form-control">
							                                    	<option value="">--Select person to assign the task--</option>

								                                    <?php
								                                     $attendee_query = $this->attendee_model->get_active_attendees($meeting_id);
								                                    
								                                    if($attendee_query->num_rows() > 0)
								                                    {
								                                        foreach($attendee_query->result() as $attend)
								                                        {
								                                            $attendee_id = $attend->attendee_id;
								                                            $attendee_first_name = $attend->attendee_first_name;
								                                            $attendee_last_name = $attend->attendee_last_name;
								                                            $attendee_title = $attend->attendee_title;
								                                            
								                                            $name = $attendee_title.' '.$attendee_first_name.' '.$attendee_first_name;
								                                            if($attendee_id == $assigned_to)
								                                            {
								                                                echo '<option value="'.$attendee_id.'" selected="selected">'.$name.'</option>';
								                                            }
								                                            
								                                            else
								                                            {
								                                                echo '<option value="'.$attendee_id.'">'.$name.'</option>';
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
							                                            
							                                            if($actions_status_id2 == $action_status_id)
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
							                                    <input type="text" class="form-control" name="action_point_notes" id="action_point_notes" placeholder="point 1, point 2" value="<?php echo $action_point_notes;?>">

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
                        </td>
	                    <td>
	                        <a  class="btn btn-danger btn-xs " data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete" onclick="delete_action_point(<?php echo $action_point_id;?>,<?php echo $meeting_id;?>)"><i class="fa fa-times"></i> Delete from list</a>
	                    </td>
                    </tr>
                    <?php    
                }
            }
            ?>
    </tbody>
  </table>