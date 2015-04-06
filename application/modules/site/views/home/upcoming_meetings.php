<div class="panel panel-default">
	<div class="panel-heading panel-heading-gray">
	    <i class="fa fa-bookmark"></i> Upcoming events
	    
	    
	</div>
	<div class="panel-body">
	    <div class="table-responsive">
	        <table class="table v-middle">
	            <thead>
	                <tr>
	                    <th>Subject</th>
	                    <th>Date</th>
	                    <th>Location</th>
	                    <th class="text-right">Action</th>
	                </tr>
	            </thead>
	            <tbody id="responsive-table-body">
	                <?php
	                $upcoming_events = $this->events_model->get_upcoming_meetings();

	                if($upcoming_events->num_rows() > 0)
	                {
	                    foreach ($upcoming_events->result() as $row) {
	                        # code...
	                        $meeting_date = $row->meeting_date;
	                         $meeting_id = $row->meeting_id;
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
	                        ?>
	                        <tr>
	                            <td><?php echo $subject;?></a>
	                            </td>
	                            <td><span class="label label-default"><?php echo $meeting_date;?></span>
	                            </td>
	                           
	                            <td><?php echo $country_name.', '.$location;?><a href="#"><i class="fa fa-map-marker fa-fw text-muted"></i></a>
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