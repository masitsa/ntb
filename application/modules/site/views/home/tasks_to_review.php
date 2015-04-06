<div class="panel panel-default">
<div class="panel-heading panel-heading-gray">
    <i class="fa fa-bookmark"></i> Tasks for review  
    
</div>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table v-middle">
            <thead>
                <tr>
                    <th>Meeting Subject</th>
                    <th>Date Due</th>
                    <th>Assigned To</th>
                    <th>Status</th>
                    <th class="text-right" colspan="3">Action</th>
                </tr>
            </thead>
            <tbody id="responsive-table-body">
                <?php
                $tasks_to_review = $this->events_model->get_tasks_for_review();

                if($tasks_to_review->num_rows() > 0)
                {
                    foreach ($tasks_to_review->result() as $tasks_review) {
                        # code...
                        $meeting_date = $tasks_review->meeting_date;
                        $meeting_id = $tasks_review->meeting_id;
                        $meeting_status = $tasks_review->meeting_status;
                        $end_date = $tasks_review->end_date;
                        $country_id = $tasks_review->country_id;
                        $country_name = $tasks_review->country_name;

                        $event_type_id = $tasks_review->event_type_id;
                        $event_type_name = $tasks_review->event_type_name;
                        $agency_id = $tasks_review->agency_id;

                        $agency_name = $tasks_review->agency_name;
                        $location = $tasks_review->location;
                        $subject = $tasks_review->subject;
                        $attendee_id = $tasks_review->attendee_id;
                        $first_name = $tasks_review->first_name;
                        $other_names = $tasks_review->other_names;
                        $completed_status = $tasks_review->completed_status;
                        $action_point_id = $tasks_review->action_point_id;
                        $action_point_notes = $tasks_review->action_point_notes;

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
                        $action_date = $tasks_review->action_date;
                        $action_date = date('j M Y',strtotime($action_date));
                        ?>
                        <tr>
                            <td><?php echo $subject;?></a>
                            </td>
                            <td><a class="btn btn-default btn-xs"><?php echo $action_date;?></a>
                            </td>
                            <td><?php echo $first_name.', '.$other_names;?>
                            </td>
                            <td><?php echo $action_status;?>
                            </td>
                            <td>
                                <?php echo $message_button;?>
                            </td>
                            <td>
                                <a class="btn btn-info btn-xs" onclick="mark_as_complete(<?php echo $action_point_id?>)" data-toggle="tooltip" data-placement="top" title="" data-original-title="mark as completed"><i class="fa fa-fw fa-check-circle"></i></a>
                            </td>
                            <td>
                                <a class="btn btn-success btn-xs" data-toggle="modal" data-target=".view-action-point" data-toggle="tooltip" data-placement="top" title="" data-original-title="view task"> <i class="fa fa-fw fa-folder-open"></i></a>
                                 <div class="modal fade view-action-point" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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