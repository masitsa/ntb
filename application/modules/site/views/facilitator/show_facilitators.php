<a   class="btn btn-info btn-xs send_mass_convenors_mail" href="<?php echo $meeting_id;?>" meeting_id='<?php echo $meeting_id;?>' data-toggle="tooltip" data-placement="top" title="" data-original-title="send mass notification"><i class="fa fa-fw fa-envelope"></i> Send Mass Email Notification</a>

<a data-toggle="modal" data-target=".add-convenor"  class="btn btn-success btn-sm pull-right"  data-toggle="tooltip" data-placement="top" title="Add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Convenor</a>

<div class="modal fade add-convenor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="hgroup title">
                 <h3>Convenors</h3>
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
                        <div class="col-sm-6">
                            <div class="control-group">
                                 <label class="control-label">First Name</label>
                                <div class="controls">
                                     <input type="text" class="form-control" name="facilitator_first_name" placeholder="First name" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-sm-6">
                            <div class="control-group">
                                 <label class="control-label">Last Name</label>
                                <div class="controls">
                                     <input type="text" class="form-control" name="facilitator_last_name" placeholder="Last name" value="">
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="control-group">
                                 <label class="control-label">Convenor email</label>
                                <div class="controls">
                                     <input type="text" class="form-control" name="facilitator_email" placeholder="Email address" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       
                        <div class="col-sm-6">
                            <div class="control-group">
                                 <label class="control-label">Organization</label>
                                <div class="controls">
                                     <input type="text" class="form-control" name="organization_name" placeholder="organization name" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="control-group">
                                 <label class="control-label">Designation</label>
                                <div class="controls">
                                     <input type="text" class="form-control" name="designation" placeholder="Designation name" value="">
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

                $organization_name = $row->organization_name;
                $designation = $row->designation;

                $combine = $facilitator_id."/".$meeting_id;
                
                
                if($facilitator_status == 0)
                {
                    $status = '<span class="label label-success btn-xs">Active</span>';
                    $button = '<a class="btn btn-danger btn-xs "  facilitator_id="'.$facilitator_id.'" onclick="deactivate_facilitator('.$facilitator_id.','.$meeting_id.')">Deactivate</a>';
                }
                
                else
                {
                    $status = '<span class="label label-danger label-xs">Disabled</span>';
                    $button = '<a class="btn btn-success btn-xs" onclick="activate_facilitator('.$facilitator_id.','.$meeting_id.')">Activate</a>';
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
                    <td><?php echo $button;?></td>
                    
                    <td>
                        <a data-toggle="modal" data-target=".edit-convenor<?php echo $facilitator_id;?>"  class="btn btn-success btn-xs "  data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> edit details</a>

                        <!-- start of edit -->
                        <div class="modal fade edit-convenor<?php echo $facilitator_id;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-lg">
						    <div class="modal-content">
						         <div class="modal-header">
						            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						            <div class="hgroup title">
						                 <h3>Edit <?php echo $facilitator_first_name." ".$facilitator_last_name;?></h3>
						            </div>
						        </div>
						            <form enctype="multipart/form-data" meeting_id="<?php echo $meeting_id;?>" action="<?php echo base_url();?>update-meeting-facilitator/<?php echo $facilitator_id;?>/<?php echo $meeting_id;?>"  id = "update_convenor_form" method="post">
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
						                                            
						                                            if($title_name == $facilitator_title)
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
						                                     <input type="text" class="form-control" name="facilitator_first_name" placeholder="First name" value="<?php echo $facilitator_first_name;?>">
						                                </div>
						                            </div>
						                        </div>
						                    </div>
						                    <div class="row">
						                        
						                        <div class="col-sm-6">
						                            <div class="control-group">
						                                 <label class="control-label">Last Name</label>
						                                <div class="controls">
						                                     <input type="text" class="form-control" name="facilitator_last_name" placeholder="Last name" value="<?php echo $facilitator_last_name;?>">
						                                </div>
						                            </div>
						                        </div>
						                        <div class="col-sm-6">
						                            <div class="control-group">
						                                 <label class="control-label">Convenor email</label>
						                                <div class="controls">
						                                     <input type="text" class="form-control" name="facilitator_email" placeholder="Email address" value="<?php echo $facilitator_email;?>">
						                                </div>
						                            </div>
						                        </div>
						                    </div>
                                             <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="control-group">
                                                         <label class="control-label">Organization</label>
                                                        <div class="controls">
                                                             <input type="text" class="form-control" name="organization_name" placeholder="organization name" value="<?php echo $organization_name?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="control-group">
                                                         <label class="control-label">Designation</label>
                                                        <div class="controls">
                                                             <input type="text" class="form-control" name="designation" placeholder="Designation name" value="<?php echo $designation;?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
						                </div>
						                <div class="modal-footer">
						                    <div class="pull-right">
						                        <button class="btn btn-danger btn-sm" type="submit"  data-dismiss="modal" aria-hidden="true">Close</button>
						                        <button class="btn btn-primary btn-sm" type="submit" onclick="">Update <?php echo $facilitator_first_name;?> details</button>
						                    </div>
						                </div> 
						            </form>
						        </div>
						    </div>
						</div>
                        <!-- end of edit -->
                    </td>
                    <td>
                        <a  class="btn btn-info btn-xs send_convenors_mail" href="<?php echo $combine;?>" facilitator_id="<?php echo $combine;?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="send notification"><i class="fa fa-fw fa-envelope"></i> send notification</a>
                    </td>
                    <td>
                        <a  class="btn btn-danger btn-xs " data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete" onclick="delete_facilitator(<?php echo $facilitator_id;?>,<?php echo $meeting_id;?>)"><i class="fa fa-times"></i> Delete from list</a>
                    </td>
                    
                </tr>
                <?php    
            }
        }
        ?>
        
      
    </tbody>
</table>