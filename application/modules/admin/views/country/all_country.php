<?php	
		$result = '<a href="'.site_url().'add-country" class="btn btn-success pull-right">Add country</a>';
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
		if ($country->num_rows() > 0)
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
			foreach ($country->result() as $row)
			{
				$country_id = $row->country_id;
				$country_name = $row->country_name;
				//create deactivated status display
				if($row->country_status == 0)
				{
					$status = '<span class="label label-important">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'activate-country/'.$country_id.'" onclick="return confirm(\'Do you want to activate '.$country_name.'?\');">Activate</a>';
				}
				//create activated status display
				else if($row->country_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'deactivate-country/'.$country_id.'" onclick="return confirm(\'Do you want to deactivate '.$country_name.'?\');">Deactivate</a>';
				}
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$country_name.'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'edit-country/'.$country_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'delete-country/'.$country_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$country_name.'?\');">Delete</a></td>
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