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
        <div class="row">
            <div class="col-sm-12">
                <div class="control-group">
                    <label for="review_text" class="control-label">Minutes</label>
                    <div class="controls">
                        <textarea class="form-control col-md-12 cleditor" name="post_content" rows="15" placeholder="Post Content"></textarea>
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
                            <button class="btn btn-primary" type="submit" onclick="">Edit meeting details</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
     </div>
    <div role="tabpanel" class="tab-pane" id="profile">
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
                    $count = $page;
                    
                    foreach ($facilitators->result() as $row)
                    {
                        $facilitator_id = $row->facilitator_id;
                        $facilitator_first_name = $row->facilitator_first_name;
                        $facilitator_last_name = $row->facilitator_last_name;
                        $facilitator_title = $row->facilitator_title;
                        $facilitator_email = $row->facilitator_email;
                        $facilitator_status = $row->facilitator_status;
                        $count++;
                        
                        if($facilitator_status == 1)
                        {
                            $status = '<span class="label label-success">Active</span>';
                            $button = '<a class="btn btn-default" href="'.site_url().'deactivate-facilitator/'.$facilitator_id.'" onclick="return confirm(\'Do you want to deactivate '.$facilitator_first_name.'?\');">Deactivate</a>';
                        }
                        
                        else
                        {
                            $status = '<span class="label label-danger">Disabled</span>';
                            $button = '<a class="btn btn-danger" href="'.site_url().'activate-facilitator/'.$facilitator_id.'" onclick="return confirm(\'Do you want to activate '.$facilitator_first_name.'?\');">Activate</a>';
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
                                 <a href="<?php echo base_url();?>edit-facilitator/<?php echo $facilitator_id;?>" class="btn btn-info">Edit</a>
                            </td>
                            <td >
                                 <a href="<?php echo base_url();?>delete-facilitator/<?php echo $facilitator_id;?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete this facilitator?');">Delete</a>
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
                    $count = $page;
                    
                    foreach ($attendees->result() as $row)
                    {
                        $attendee_id = $row->attendee_id;
                        $attendee_first_name = $row->attendee_first_name;
                        $attendee_last_name = $row->attendee_last_name;
                        $attendee_title = $row->attendee_title;
                        $attendee_email = $row->attendee_email;
                        $attendee_status = $row->attendee_status;
                        $count++;
                        
                        if($attendee_status == 1)
                        {
                            $status = '<span class="label label-success">Active</span>';
                            $button = '<a class="btn btn-default" href="'.site_url().'deactivate-attendee/'.$attendee_id.'" onclick="return confirm(\'Do you want to deactivate '.$attendee_first_name.'?\');">Deactivate</a>';
                        }
                        
                        else
                        {
                            $status = '<span class="label label-danger">Disabled</span>';
                            $button = '<a class="btn btn-danger" href="'.site_url().'activate-attendee/'.$attendee_id.'" onclick="return confirm(\'Do you want to activate '.$attendee_first_name.'?\');">Activate</a>';
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
                                 <a href="<?php echo base_url();?>edit-attendee/<?php echo $attendee_id;?>" class="btn btn-info">Edit</a>
                            </td>
                            <td >
                                 <a href="<?php echo base_url();?>delete-attendee/<?php echo $attendee_id;?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete this attendee?');">Delete</a>
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
                        $count = $page;
                        
                        foreach ($action_points->result() as $row)
                        {
                            $action_point_id = $row->action_point_id;
                            $created = $row->created;
                            $priority_status_name = $row->priority_status_name;
                            $action_status_name = $row->action_status_name;
                            $assigned_to = $row->assigned_to;
                            $action_point_notes = $row->action_point_notes;
                            $count++;
                            
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
                                     <a href="<?php echo base_url();?>delete-action-point/<?php echo $action_point_id;?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete this action point?');">Delete</a>
                                </td>
                                <td >
                                     <a href="<?php echo base_url();?>edit-action-point/<?php echo $action_point_id;?>" class="btn btn-info">Edit</a>
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