<?php	
		$result = '<a href="'.site_url().'customer-transactions/'.$customer_id.'" class="btn btn-success pull-right">Back to customer transactions</a>';
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
		if ($transactions->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
				<table class="table table-hover table-bordered ">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Date of transaction</th>
					  <th>Type of transaction</th>
					  <th>Amount transacted</th>
					  <th>Phone transfered to</th>
					  <th colspan="5">Actions</th>
					</tr>
				  </thead>
				  <tbody>
			';
			foreach ($transactions->result() as $row)
			{
				$customer_id = $row->customer_id;
				$transaction_id = $row->transaction_id;
				$amount_transacted = $row->amount_transacted;
				$transaction_type_id = $row->transaction_type_id;
				$date_transacted = $row->date_transacted;
				$transaction_type_name = $row->transaction_type_name;
				$phone_transfered_to = $row->phone_transfered_to;
				//create deactivated status display
				if($row->transaction_status == 0)
				{
					$status = '<span class="label label-important">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'activate-customer/'.$customer_id.'" onclick="return confirm(\'Do you want to activate '.$transaction_id.'?\');">Activate</a>';
				}
				//create activated status display
				else if($row->transaction_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'deactivate-customer/'.$customer_id.'" onclick="return confirm(\'Do you want to deactivate '.$transaction_id.'?\');">Deactivate</a>';
				}
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.date('jS M Y H:i a',strtotime($row->date_transacted)).'</td>
						<td>'.$transaction_type_name.'</td>
						<td>KES '.number_format($amount_transacted,2).'</td>
						<td>'.$status.'</td>
						<td>'.$button.'</td>
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
			$result .= "There are no transactions";
		}
		
		echo $result;
?>