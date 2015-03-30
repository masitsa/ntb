<?php

class Agency_model extends CI_Model 
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
	*	Retrieve all agency
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_agency($table, $where, $per_page, $page)
	{
		//retrieve all agency
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('agency_id');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Retrieve all administrators
	*
	*/
	public function get_all_administrators()
	{
		$this->db->from('agency');
		$this->db->select('*');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve all front end agency
	*
	*/
	public function get_all_front_end_agency()
	{
		$this->db->from('agency');
		$this->db->select('*');
		$this->db->where('agency_level_id = 2');
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_all_countries()
	{
		//retrieve all agency
		$query = $this->db->get('country');
		
		return $query;
	}
	
	/*
	*	Add a new agency to the database
	*
	*/
	public function add_agency()
	{
		$data = array(
				'agency_name'=>$this->input->post('agency_name'),
				'created_by'=>$this->session->userdata('user_id'),
				'created'=>date('Y-m-d H:i:s'),
				'agency_status'=>0
			);
			
		if($this->db->insert('agency', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Add a new front end agency to the database
	*
	*/
	public function add_frontend_agency()
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('other_names'))),
				'email'=>$this->input->post('email'),
				'password'=>md5($this->input->post('password')),
				'phone'=>$this->input->post('phone'),
				'created'=>date('Y-m-d H:i:s'),
				'agency_level_id'=>2,
				'activated'=>1
			);
			
		if($this->db->insert('agency', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing agency
	*	@param int $agency_id
	*
	*/
	public function edit_agency($agency_id)
	{
		$data = array(
				'agency_name'=>$this->input->post('agency_name'),
				'agency_status'=>0
			);
		
		//check if agency wants to update their password
		
		
		$this->db->where('agency_id', $agency_id);
		
		if($this->db->update('agency', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing agency
	*	@param int $agency_id
	*
	*/
	public function edit_frontend_agency($agency_id)
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('last_name'))),
				'phone'=>$this->input->post('phone')
			);
		
		//check if agency wants to update their password
		$pwd_update = $this->input->post('admin_agency');
		if(!empty($pwd_update))
		{
			if($this->input->post('old_password') == md5($this->input->post('current_password')))
			{
				$data['password'] = md5($this->input->post('new_password'));
			}
			
			else
			{
				$this->session->set_agencydata('error_message', 'The current password entered does not match your password. Please try again');
			}
		}
		
		$this->db->where('agency_id', $agency_id);
		
		if($this->db->update('agency', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing agency's password
	*	@param int $agency_id
	*
	*/
	public function edit_password($agency_id)
	{
		if($this->input->post('slug') == md5($this->input->post('current_password')))
		{
			if($this->input->post('new_password') == $this->input->post('confirm_password'))
			{
				$data['password'] = md5($this->input->post('new_password'));
		
				$this->db->where('agency_id', $agency_id);
				
				if($this->db->update('agency', $data))
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
	*	Retrieve a single agency
	*	@param int $agency_id
	*
	*/
	public function get_agency($agency_id)
	{
		//retrieve all agency
		$this->db->from('agency');
		$this->db->select('*');
		$this->db->where('agency_id = '.$agency_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve a single agency by their email
	*	@param int $email
	*
	*/
	public function get_agency_by_email($email)
	{
		//retrieve all agency
		$this->db->from('agency');
		$this->db->select('*');
		$this->db->where('email = \''.$email.'\'');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing agency
	*	@param int $agency_id
	*
	*/
	public function delete_agency($agency_id)
	{
		if($this->db->delete('agency', array('agency_id' => $agency_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated agency
	*	@param int $agency_id
	*
	*/
	public function activate_agency($agency_id)
	{
		$data = array(
				'agency_status' => 1
			);
		$this->db->where('agency_id', $agency_id);
		
		if($this->db->update('agency', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated agency
	*	@param int $agency_id
	*
	*/
	public function deactivate_agency($agency_id)
	{
		$data = array(
				'agency_status' => 0
			);
		$this->db->where('agency_id', $agency_id);
		
		if($this->db->update('agency', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Reset a agency's password
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
		
		if($this->db->update('agency', $data))
		{
			//email the password to the agency
			$agency_details = $this->agency_model->get_agency_by_email($email);
			
			$agency = $agency_details->row();
			$agency_name = $agency->first_name;
			
			//email data
			$receiver['email'] = $this->input->post('email');
			$sender['name'] = 'Fad Shoppe';
			$sender['email'] = 'info@fadshoppe.com';
			$message['subject'] = 'You requested a password change';
			$message['text'] = 'Hi '.$agency_name.'. Your new password is '.$pwd;
			
			//send the agency their new password
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