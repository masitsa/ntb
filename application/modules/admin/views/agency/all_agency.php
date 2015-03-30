<?php	
		$result = '<a href="'.site_url().'add-agency" class="btn btn-success pull-right">Add agency</a>';
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
		if ($agency->num_rows() > 0)
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
			foreach ($agency->result() as $row)
			{
				$agency_id = $row->agency_id;
				$agency_name = $row->agency_name;
				//create deactivated status display
				if($row->agency_status == 0)
				{
					$status = '<span class="label label-important">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'activate-agency/'.$agency_id.'" onclick="return confirm(\'Do you want to activate '.$agency_name.'?\');">Activate</a>';
				}
				//create activated status display
				else if($row->agency_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'deactivate-agency/'.$agency_id.'" onclick="return confirm(\'Do you want to deactivate '.$agency_name.'?\');">Deactivate</a>';
				}
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$agency_name.'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'edit-agency/'.$agency_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'delete-agency/'.$agency_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$agency_name.'?\');">Delete</a></td>
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