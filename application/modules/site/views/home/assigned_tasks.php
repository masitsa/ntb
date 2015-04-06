<div class="panel panel-default">
<div class="panel-heading panel-heading-gray">
    <i class="fa fa-fw fa-tasks"></i> Assigned Tasks                            
</div>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table v-middle">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Due Date</th>
                    <th>Report to </th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody id="responsive-table-body">
                <?php
                $assigned_tasks = $this->events_model->get_all_assigned_tasks();

                if($assigned_tasks->num_rows() > 0)
                {
                    foreach ($assigned_tasks->result() as $row_tasks) {
                        # code...
                        $meeting_date = $row_tasks->meeting_date;
                         $meeting_id = $row_tasks->meeting_id;
                        $meeting_status = $row_tasks->meeting_status;
                        $end_date = $row_tasks->end_date;
                        $country_id = $row_tasks->country_id;
                        $country_name = $row_tasks->country_name;

                        $event_type_id = $row_tasks->event_type_id;
                        $event_type_name = $row_tasks->event_type_name;
                        $agency_id = $row_tasks->agency_id;

                        $agency_name = $row_tasks->agency_name;
                        $location = $row_tasks->location;
                        $subject = $row_tasks->subject;

                        $first_name = $row_tasks->first_name;
                        $other_names = $row_tasks->other_names;
                        $action_date = $row_tasks->action_date;
                        $action_date = date('j M Y',strtotime($action_date));
                        $end_date = date('j M Y',strtotime($end_date));

                        $attendee_id = $row_tasks->attendee_id;
                        $completed_status = $row_tasks->completed_status;
                        $action_point_id = $row_tasks->action_point_id;
                        $action_point_notes = $row_tasks->action_point_notes;
                        if($completed_status == 1)
                        {
                            // sent for review
                            $action_status = '<a class="btn btn-warning btn-xs">To be reviewed</a>';
                            $message_button = '<a class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="send received mail" onclick="send_notification(1,'.$meeting_id.','.$attendee_id.','.$action_point_id.')" > <i class="fa fa-fw fa-envelope"></i></a>';
                        }
                        if($completed_status == 2)
                        {
                            // marked as done
                            $action_status = '<a class="btn btn-success btn-xs">Completed</a>';
                            $message_button = '<a class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="send task completed mail" onclick="send_notification(2,'.$meeting_id.','.$attendee_id.','.$action_point_id.')" > <i class="fa fa-fw fa-envelope"></i></a>';

                        }
                        else
                        {
                            // not sent for review
                            $action_status = '<a class="btn btn-danger btn-xs">not done</a>';
                            $message_button = '<a class="btn btn-danger btn-xs " data-toggle="tooltip" data-placement="top" title="" data-original-title="send reminder" onclick="send_notification(0,'.$meeting_id.','.$attendee_id.','.$action_point_id.')"> <i class="fa fa-fw fa-envelope"></i></a>';

                        }
                        ?>
                        <tr>
                            <td><?php echo $subject;?></a>
                            </td>
                            <td><a class="btn btn-default btn-xs"><?php echo $action_date;?></a>
                            </td>
                           
                            <td><?php echo $first_name.' '.$other_names;?>
                            </td>
                            <td><?php echo $action_status;?>
                            </td>
                            <td>
                                <a class="btn btn-info btn-xs" onclick="send_for_review(<?php echo $action_point_id?>,<?php echo $attendee_id;?>,<?php echo $meeting_id;?>)" data-toggle="tooltip" data-placement="top" title="" data-original-title="send for review"><i class="fa fa-fw fa-check-circle"></i></a>
                            </td>
                            <td>
                                 <a class="btn btn-success btn-xs" data-toggle="modal" data-target=".view-assigned-action-point" data-toggle="tooltip" data-placement="top" title="" data-original-title="view task"> <i class="fa fa-fw fa-folder-open"></i></a>
                                 <div class="modal fade view-assigned-action-point" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                          
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <div class="hgroup title">
                                                     <h4> <?php echo $subject;?> Action Point </h4>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">

                                                    <div class="col-sm-12">
                                                        <div class="control-group">
                                                            <label class="control-label">Action point description</label>
                                                            <div class="controls">
                                                                <?php echo $action_point_notes;?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>     
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                             
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                
                
            </tbody>
        </table>
    </div>
    <!-- // Progress table -->
    
</div>
                      
                       
                    </div>