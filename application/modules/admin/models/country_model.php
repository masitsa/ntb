<?php

class Country_model extends CI_Model 
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
	*	Retrieve all country
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_country($table, $where, $per_page, $page)
	{
		//retrieve all country
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('country_id');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Retrieve all administrators
	*
	*/
	public function get_all_administrators()
	{
		$this->db->from('country');
		$this->db->select('*');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve all front end country
	*
	*/
	public function get_all_front_end_country()
	{
		$this->db->from('country');
		$this->db->select('*');
		$this->db->where('country_level_id = 2');
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_all_countries()
	{
		//retrieve all country
		$query = $this->db->get('country');
		
		return $query;
	}
	
	/*
	*	Add a new country to the database
	*
	*/
	public function add_country()
	{
		$data = array(
				'country_name'=>$this->input->post('country_name'),
				'created_by'=>$this->session->userdata('user_id'),
				'created'=>date('Y-m-d H:i:s'),
				'country_status'=>0
			);
			
		if($this->db->insert('country', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Add a new front end country to the database
	*
	*/
	public function add_frontend_country()
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('other_names'))),
				'email'=>$this->input->post('email'),
				'password'=>md5($this->input->post('password')),
				'phone'=>$this->input->post('phone'),
				'created'=>date('Y-m-d H:i:s'),
				'country_level_id'=>2,
				'activated'=>1
			);
			
		if($this->db->insert('country', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing country
	*	@param int $country_id
	*
	*/
	public function edit_country($country_id)
	{
		$data = array(
				'country_name'=>$this->input->post('country_name'),
				'country_status'=>0
			);
		
		//check if country wants to update their password
		
		
		$this->db->where('country_id', $country_id);
		
		if($this->db->update('country', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing country
	*	@param int $country_id
	*
	*/
	public function edit_frontend_country($country_id)
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('last_name'))),
				'phone'=>$this->input->post('phone')
			);
		
		//check if country wants to update their password
		$pwd_update = $this->input->post('admin_country');
		if(!empty($pwd_update))
		{
			if($this->input->post('old_password') == md5($this->input->post('current_password')))
			{
				$data['password'] = md5($this->input->post('new_password'));
			}
			
			else
			{
				$this->session->set_countrydata('error_message', 'The current password entered does not match your password. Please try again');
			}
		}
		
		$this->db->where('country_id', $country_id);
		
		if($this->db->update('country', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing country's password
	*	@param int $country_id
	*
	*/
	public function edit_password($country_id)
	{
		if($this->input->post('slug') == md5($this->input->post('current_password')))
		{
			if($this->input->post('new_password') == $this->input->post('confirm_password'))
			{
				$data['password'] = md5($this->input->post('new_password'));
		
				$this->db->where('country_id', $country_id);
				
				if($this->db->update('country', $data))
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
	*	Retrieve a single country
	*	@param int $country_id
	*
	*/
	public function get_country($country_id)
	{
		//retrieve all country
		$this->db->from('country');
		$this->db->select('*');
		$this->db->where('country_id = '.$country_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve a single country by their email
	*	@param int $email
	*
	*/
	public function get_country_by_email($email)
	{
		//retrieve all country
		$this->db->from('country');
		$this->db->select('*');
		$this->db->where('email = \''.$email.'\'');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing country
	*	@param int $country_id
	*
	*/
	public function delete_country($country_id)
	{
		if($this->db->delete('country', array('country_id' => $country_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated country
	*	@param int $country_id
	*
	*/
	public function activate_country($country_id)
	{
		$data = array(
				'country_status' => 1
			);
		$this->db->where('country_id', $country_id);
		
		if($this->db->update('country', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated country
	*	@param int $country_id
	*
	*/
	public function deactivate_country($country_id)
	{
		$data = array(
				'country_status' => 0
			);
		$this->db->where('country_id', $country_id);
		
		if($this->db->update('country', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Reset a country's password
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
		
		if($this->db->update('country', $data))
		{
			//email the password to the country
			$country_details = $this->country_model->get_country_by_email($email);
			
			$country = $country_details->row();
			$country_name = $country->first_name;
			
			//email data
			$receiver['email'] = $this->input->post('email');
			$sender['name'] = 'Fad Shoppe';
			$sender['email'] = 'info@fadshoppe.com';
			$message['subject'] = 'You requested a password change';
			$message['text'] = 'Hi '.$country_name.'. Your new password is '.$pwd;
			
			//send the country their new password
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