<?php

class Event_type_model extends CI_Model 
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
	*	Retrieve all event_type
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_event_type($table, $where, $per_page, $page)
	{
		//retrieve all event_type
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('event_type_id');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Retrieve all administrators
	*
	*/
	public function get_all_administrators()
	{
		$this->db->from('event_type');
		$this->db->select('*');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve all front end event_type
	*
	*/
	public function get_all_front_end_event_type()
	{
		$this->db->from('event_type');
		$this->db->select('*');
		$this->db->where('event_type_level_id = 2');
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_all_countries()
	{
		//retrieve all event_type
		$query = $this->db->get('country');
		
		return $query;
	}
	
	/*
	*	Add a new event_type to the database
	*
	*/
	public function add_event_type()
	{
		$data = array(
				'event_type_name'=>$this->input->post('event_type_name'),
				'created_by'=>$this->session->userdata('user_id'),
				'created'=>date('Y-m-d H:i:s'),
				'event_type_status'=>0
			);
			
		if($this->db->insert('event_type', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Add a new front end event_type to the database
	*
	*/
	public function add_frontend_event_type()
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('other_names'))),
				'email'=>$this->input->post('email'),
				'password'=>md5($this->input->post('password')),
				'phone'=>$this->input->post('phone'),
				'created'=>date('Y-m-d H:i:s'),
				'event_type_level_id'=>2,
				'activated'=>1
			);
			
		if($this->db->insert('event_type', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing event_type
	*	@param int $event_type_id
	*
	*/
	public function edit_event_type($event_type_id)
	{
		$data = array(
				'event_type_name'=>$this->input->post('event_type_name'),
				'event_type_status'=>0
			);
		
		//check if event_type wants to update their password
		
		
		$this->db->where('event_type_id', $event_type_id);
		
		if($this->db->update('event_type', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing event_type
	*	@param int $event_type_id
	*
	*/
	public function edit_frontend_event_type($event_type_id)
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('last_name'))),
				'phone'=>$this->input->post('phone')
			);
		
		//check if event_type wants to update their password
		$pwd_update = $this->input->post('admin_event_type');
		if(!empty($pwd_update))
		{
			if($this->input->post('old_password') == md5($this->input->post('current_password')))
			{
				$data['password'] = md5($this->input->post('new_password'));
			}
			
			else
			{
				$this->session->set_event_typedata('error_message', 'The current password entered does not match your password. Please try again');
			}
		}
		
		$this->db->where('event_type_id', $event_type_id);
		
		if($this->db->update('event_type', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing event_type's password
	*	@param int $event_type_id
	*
	*/
	public function edit_password($event_type_id)
	{
		if($this->input->post('slug') == md5($this->input->post('current_password')))
		{
			if($this->input->post('new_password') == $this->input->post('confirm_password'))
			{
				$data['password'] = md5($this->input->post('new_password'));
		
				$this->db->where('event_type_id', $event_type_id);
				
				if($this->db->update('event_type', $data))
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
	*	Retrieve a single event_type
	*	@param int $event_type_id
	*
	*/
	public function get_event_type($event_type_id)
	{
		//retrieve all event_type
		$this->db->from('event_type');
		$this->db->select('*');
		$this->db->where('event_type_id = '.$event_type_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve a single event_type by their email
	*	@param int $email
	*
	*/
	public function get_event_type_by_email($email)
	{
		//retrieve all event_type
		$this->db->from('event_type');
		$this->db->select('*');
		$this->db->where('email = \''.$email.'\'');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing event_type
	*	@param int $event_type_id
	*
	*/
	public function delete_event_type($event_type_id)
	{
		if($this->db->delete('event_type', array('event_type_id' => $event_type_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated event_type
	*	@param int $event_type_id
	*
	*/
	public function activate_event_type($event_type_id)
	{
		$data = array(
				'event_type_status' => 1
			);
		$this->db->where('event_type_id', $event_type_id);
		
		if($this->db->update('event_type', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated event_type
	*	@param int $event_type_id
	*
	*/
	public function deactivate_event_type($event_type_id)
	{
		$data = array(
				'event_type_status' => 0
			);
		$this->db->where('event_type_id', $event_type_id);
		
		if($this->db->update('event_type', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Reset a event_type's password
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
		
		if($this->db->update('event_type', $data))
		{
			//email the password to the event_type
			$event_type_details = $this->event_type_model->get_event_type_by_email($email);
			
			$event_type = $event_type_details->row();
			$event_type_name = $event_type->first_name;
			
			//email data
			$receiver['email'] = $this->input->post('email');
			$sender['name'] = 'Fad Shoppe';
			$sender['email'] = 'info@fadshoppe.com';
			$message['subject'] = 'You requested a password change';
			$message['text'] = 'Hi '.$event_type_name.'. Your new password is '.$pwd;
			
			//send the event_type their new password
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