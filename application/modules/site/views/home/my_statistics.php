<div class="panel panel-default">
	<div class="panel-heading panel-heading-gray">
	    <i class="fa fa-bookmark"></i> My meeting Stats
	</div>
	<div class="panel-body">
	   <div class="table-responsive">
	        <table class="table v-middle">
	           <thead>
	                <tr>
	                    <th>Subject</th>
	                    <th>Date</th>
	                    <th>Att.</th>
	                    <th>Com.</th>
	                    <th>Tsk.</th>
	                    <th class="text-right">Action</th>
	                </tr>
	            </thead>
	            <tbody id="responsive-table-body">
	                <?php
	                $mylatest_events = $this->events_model->get_mylatest_meetings();

	                if($mylatest_events->num_rows() > 0)
	                {
	                    foreach ($mylatest_events->result() as $latest) {
	                        # code...
	                        $meeting_date = $latest->meeting_date;
	                         $meeting_id = $latest->meeting_id;
	                        $meeting_status = $latest->meeting_status;
	                        $end_date = $latest->end_date;
	                        $country_id = $latest->country_id;
	                        $country_name = $latest->country_name;

	                        $event_type_id = $latest->event_type_id;
	                        $event_type_name = $latest->event_type_name;
	                        $agency_id = $latest->agency_id;

	                        $agency_name = $latest->agency_name;
	                        $location = $latest->location;
	                        $subject = $latest->subject;

	                        $meeting_date = date('j M Y',strtotime($meeting_date));
	                        $end_date = date('j M Y',strtotime($end_date));
	                        $total_attendees = $this->events_model->get_total_meeting_attendees($meeting_id);
	                        $total_comments = $this->events_model->get_total_meeting_comments($meeting_id);
	                        $total_action_points = $this->events_model->get_total_meeting_tasks($meeting_id);
	                        ?>
	                        <tr>
	                            <td><?php echo $subject;?></a>
	                            </td>
	                            <td><span class="label label-default"><?php echo $meeting_date;?></span>
	                            </td>
	                           
	                            <td><i class="fa fa-fw fa-user"><?php echo $total_attendees;?> </i>
	                            </td>
	                            <td><i class="fa fa-fw fa-comment"><?php echo $total_comments;?> </i>
	                            </td>
	                            <td><i class="fa fa-fw fa-tasks"><?php echo $total_action_points;?> </i>
	                            </td>
	                            
	                            <td class="text-right">
	                                <a class="btn btn-info btn-xs" href="<?php echo base_url();?>view-meeting/<?php echo $meeting_id?>" > <i class="fa fa-fw fa-folder-open"></i> View details</a>

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