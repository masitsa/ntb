<?php

class Transactions_model extends CI_Model 
{
	/*
	*	Count all items from a table
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function count_items($table, $where, $limit = NULL)
	{
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		$this->db->from($table);
		$this->db->where($where);
		return $this->db->count_all_results();
	}
	
	/*
	*	Retrieve all transactions
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_transactions($table, $where, $per_page, $page)
	{
		//retrieve all transactions
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('transactions.transaction_id','desc');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Retrieve all administrators
	*
	*/
	public function get_all_administrators()
	{
		$this->db->from('transactions');
		$this->db->select('*');
		$query = $this->db->get();
		
		return $query;
	}

	public function get_all_transaction_types()
	{
		$this->db->from('transaction_type');
		$this->db->select('*');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve all front end transactions
	*
	*/
	public function get_all_front_end_transactions()
	{
		$this->db->from('transactions');
		$this->db->select('*');
		$this->db->where('customer_level_id = 2');
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_all_countries()
	{
		//retrieve all transactions
		$query = $this->db->get('country');
		
		return $query;
	}
	
	/*
	*	Add a new customer to the database
	*
	*/
	public function add_customer_transaction($customer_id)
	{
		$data = array(
				'amount_transacted'=>$this->input->post('amount_transacted'),
				'customer_id'=>$customer_id,
				'phone_transfered_to'=>$this->input->post('phone'),
				'date_transacted'=>$this->input->post('date_transacted'),
				'transaction_type_id'=>$this->input->post('transaction_type_id'),
				'created'=>date('Y-m-d H:i:s'),
				'agent_id'=>$this->session->userdata('user_id')
			);
			
		if($this->db->insert('transactions', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Add a new front end customer to the database
	*
	*/
	public function add_frontend_customer()
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('other_names'))),
				'email'=>$this->input->post('email'),
				'password'=>md5($this->input->post('password')),
				'phone'=>$this->input->post('phone'),
				'created'=>date('Y-m-d H:i:s'),
				'customer_level_id'=>2,
				'activated'=>1
			);
			
		if($this->db->insert('transactions', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing customer
	*	@param int $customer_id
	*
	*/
	public function edit_customer($customer_id)
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('other_names'))),
				'email'=>$this->input->post('email'),
				'phone'=>$this->input->post('phone'),
				'address'=>$this->input->post('address'),
				'post_code'=>$this->input->post('post_code'),
				'city'=>$this->input->post('city'),
				'activated'=>$this->input->post('activated')
			);
		
		//check if customer wants to update their password
		$pwd_update = $this->input->post('admin_customer');
		if(!empty($pwd_update))
		{
			if($this->input->post('old_password') == md5($this->input->post('current_password')))
			{
				$data['password'] = md5($this->input->post('new_password'));
			}
			
			else
			{
				$this->session->set_customerdata('error_message', 'The current password entered does not match your password. Please try again');
			}
		}
		
		$this->db->where('customer_id', $customer_id);
		
		if($this->db->update('transactions', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing customer
	*	@param int $customer_id
	*
	*/
	public function edit_frontend_customer($customer_id)
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('last_name'))),
				'phone'=>$this->input->post('phone')
			);
		
		//check if customer wants to update their password
		$pwd_update = $this->input->post('admin_customer');
		if(!empty($pwd_update))
		{
			if($this->input->post('old_password') == md5($this->input->post('current_password')))
			{
				$data['password'] = md5($this->input->post('new_password'));
			}
			
			else
			{
				$this->session->set_customerdata('error_message', 'The current password entered does not match your password. Please try again');
			}
		}
		
		$this->db->where('customer_id', $customer_id);
		
		if($this->db->update('transactions', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing customer's password
	*	@param int $customer_id
	*
	*/
	public function edit_password($customer_id)
	{
		if($this->input->post('slug') == md5($this->input->post('current_password')))
		{
			if($this->input->post('new_password') == $this->input->post('confirm_password'))
			{
				$data['password'] = md5($this->input->post('new_password'));
		
				$this->db->where('customer_id', $customer_id);
				
				if($this->db->update('transactions', $data))
				{
					$return['result'] = TRUE;
				}
				else{
					$return['result'] = FALSE;
					$return['message'] = 'Oops something went wrong and your password could not be updated. Please try again';
				}
			}
			else{
					$return['result'] = FALSE;
					$return['message'] = 'New Password and Confirm Password don\'t match';
			}
		}
		
		else
		{
			$return['result'] = FALSE;
			$return['message'] = 'You current password is not correct. Please try again';
		}
		
		return $return;
	}
	
	/*
	*	Retrieve a single customer
	*	@param int $customer_id
	*
	*/
	public function get_customer($customer_id)
	{
		//retrieve all transactions
		$this->db->from('transactions');
		$this->db->select('*');
		$this->db->where('customer_id = '.$customer_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve a single customer by their email
	*	@param int $email
	*
	*/
	public function get_customer_by_email($email)
	{
		//retrieve all transactions
		$this->db->from('transactions');
		$this->db->select('*');
		$this->db->where('email = \''.$email.'\'');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing customer
	*	@param int $customer_id
	*
	*/
	public function delete_customer($customer_id)
	{
		if($this->db->delete('transactions', array('customer_id' => $customer_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated customer
	*	@param int $customer_id
	*
	*/
	public function activate_customer($customer_id)
	{
		$data = array(
				'activated' => 1
			);
		$this->db->where('customer_id', $customer_id);
		
		if($this->db->update('transactions', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated customer
	*	@param int $customer_id
	*
	*/
	public function deactivate_customer($customer_id)
	{
		$data = array(
				'activated' => 0
			);
		$this->db->where('customer_id', $customer_id);
		
		if($this->db->update('transactions', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Reset a customer's password
	*	@param string $email
	*
	*/
	public function reset_password($email)
	{
		//reset password
		$result = md5(date("Y-m-d H:i:s"));
		$pwd2 = substr($result, 0, 6);
		$pwd = md5($pwd2);
		
		$data = array(
				'password' => $pwd
			);
		$this->db->where('email', $email);
		
		if($this->db->update('transactions', $data))
		{
			//email the password to the customer
			$customer_details = $this->transactions_model->get_customer_by_email($email);
			
			$customer = $customer_details->row();
			$customer_name = $customer->first_name;
			
			//email data
			$receiver['email'] = $this->input->post('email');
			$sender['name'] = 'Fad Shoppe';
			$sender['email'] = 'info@fadshoppe.com';
			$message['subject'] = 'You requested a password change';
			$message['text'] = 'Hi '.$customer_name.'. Your new password is '.$pwd;
			
			//send the customer their new password
			if($this->email_model->send_mail($receiver, $sender, $message))
			{
				return TRUE;
			}
			
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}
}
?>