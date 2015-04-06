<?php	
		$result = '<a href="'.site_url().'add-event-type" class="btn btn-success pull-right">Add event_type</a>';
		$success = $this->session->userdata('success_message');
		
		if(!empty($success))
		{
			echo '<div class="alert alert-success"> <strong>Success!</strong> '.$success.' </div>';
			$this->session->unset_userdata('success_message');
		}
		
		$error = $this->session->userdata('error_message');
		
		if(!empty($error))
		{
			echo '<div class="alert alert-danger"> <strong>Oh snap!</strong> '.$error.' </div>';
			$this->session->unset_userdata('error_message');
		}
		
		//if users exist display them
		if ($event_type->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
				<table class="table table-hover table-bordered ">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Name</th>
					  <th>Status</th>
					  <th colspan="5">Actions</th>
					</tr>
				  </thead>
				  <tbody>
			';
			foreach ($event_type->result() as $row)
			{
				$event_type_id = $row->event_type_id;
				$event_type_name = $row->event_type_name;
				//create deactivated status display
				if($row->event_type_status == 0)
				{
					$status = '<span class="label label-important">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'activate-event-type/'.$event_type_id.'" onclick="return confirm(\'Do you want to activate '.$event_type_name.'?\');">Activate</a>';
				}
				//create activated status display
				else if($row->event_type_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'deactivate-event-type/'.$event_type_id.'" onclick="return confirm(\'Do you want to deactivate '.$event_type_name.'?\');">Deactivate</a>';
				}
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$event_type_name.'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'edit-event-type/'.$event_type_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'delete-event-type/'.$event_type_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$event_type_name.'?\');">Delete</a></td>
					</tr> 
				';
			}
			
			$result .= 
			'
						  </tbody>
						</table>
			';
		}
		
		else
		{
			$result .= "There are no agencies";
		}
		
		echo $result;
?>