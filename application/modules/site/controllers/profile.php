<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/site/controllers/account.php";

class Profile extends account 
{
	var $message_amount;
	var $like_amount;
	
	function __construct()
	{
		parent:: __construct();
		$this->message_amount = 5;
		$this->like_amount = 0.5;
	}
	
	public function about_you()
	{
		//initialize required variables
		$v_data['profile_image_location'] = 'http://placehold.it/300x200&text=Upload+image';
		$v_data['neighbourhood_id_error'] = '';
		$v_data['client_about_error'] = '';
		$v_data['client_dob1_error'] = '';
		$v_data['client_dob2_error'] = '';
		$v_data['client_dob3_error'] = '';
		$v_data['gender_id_error'] = '';
		$v_data['client_looking_gender_id_error'] = '';
		$v_data['age_group_id_error'] = '';
		$v_data['encounter_id_error'] = '';
		
		//upload image if it has been selected
		$response = $this->profile_model->upload_profile_image($this->profile_image_path);
		if($response)
		{
			$v_data['profile_image_location'] = $this->profile_image_location.$this->session->userdata('profile_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['profile_image_error'] = $this->session->userdata('profile_error_message');
		}
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('neighbourhood_id', 'Neighbourhood', 'trim|required|xss_clean');
		$this->form_validation->set_rules('client_about', 'About you', 'trim|required|min_length[20]|xss_clean');
		$this->form_validation->set_rules('client_dob1', 'Day of birth', 'trim|required|greater_than[0]|less_than[32]|xss_clean');
		$this->form_validation->set_rules('client_dob2', 'Month of birth', 'trim|required|greater_than[0]|less_than[13]|xss_clean');
		$this->form_validation->set_rules('client_dob3', 'Year of birth', 'trim|required|greater_than[1900]|xss_clean');
		$this->form_validation->set_rules('client_looking_gender_id', 'Looking for', 'trim|required|xss_clean');
		$this->form_validation->set_rules('age_group_id', 'Aged', 'trim|required|xss_clean');
		$this->form_validation->set_rules('encounter_id', 'Encounter type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('gender_id', 'Gender', 'trim|required|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->profile_model->register_profile_details($this->user_id, $this->session->userdata('profile_file_name'), $this->session->userdata('profile_thumb_name')))
			{
				//redirect only if logo error isnt present
				if(empty($v_data['profile_image_error']))
				{
					redirect('browse');
				}
			}
			
			else
			{
				$this->session->set_userdata('vendor_signup2_error_message', 'Unable to add user details. Please try again');
			}
		}
		$validation_errors = validation_errors();
		
		//repopulate form data if validation errors are present
		if(!empty($validation_errors))
		{
			//create errors
			$v_data['neighbourhood_id_error'] = form_error('neighbourhood_id');
			$v_data['client_about_error'] = form_error('client_about');
			$v_data['client_dob1_error'] = form_error('client_dob1');
			$v_data['client_dob2_error'] = form_error('client_dob2');
			$v_data['client_dob3_error'] = form_error('client_dob3');
			$v_data['gender_id_error'] = form_error('gender_id');
			$v_data['client_looking_gender_id_error'] = form_error('client_looking_gender_id');
			$v_data['age_group_id_error'] = form_error('age_group_id');
			$v_data['encounter_id_error'] = form_error('encounter_id');
			
			//repopulate fields
			$v_data['neighbourhood_id'] = set_value('neighbourhood_id');
			$v_data['client_about'] = set_value('client_about');
			$v_data['client_looking_gender_id'] = set_value('client_looking_gender_id');
			$v_data['age_group_id'] = set_value('age_group_id');
			$v_data['encounter_id'] = set_value('encounter_id');
			$v_data['client_dob1'] = set_value('client_dob1');
			$v_data['client_dob2'] = set_value('client_dob2');
			$v_data['client_dob3'] = set_value('client_dob3');
			$v_data['gender_id'] = set_value('gender_id');
			$v_data['client_looking_gender_id'] = set_value('client_looking_gender_id');
		}
		
		//populate form data on initial load of page
		else
		{
			if(!empty($v_data['profile_image_error']))
			{
				$v_data['neighbourhood_id'] = set_value('neighbourhood_id');
				$v_data['client_about'] = set_value('client_about');
				$v_data['client_looking_gender_id'] = set_value('client_looking_gender_id');
				$v_data['age_group_id'] = set_value('age_group_id');
				$v_data['encounter_id'] = set_value('encounter_id');
				$v_data['client_dob1'] = set_value('client_dob1');
				$v_data['client_dob2'] = set_value('client_dob2');
				$v_data['client_dob3'] = set_value('client_dob3');
			}
			
			else
			{
				$v_data['neighbourhood_id'] = '';
				$v_data['client_about'] = '';
				$v_data['gender_id'] = "";
				$v_data['client_looking_gender_id'] = "";
				$v_data['age_group_id'] = '';
				$v_data['encounter_id'] = '';
				$v_data['client_dob1'] = '';
				$v_data['client_dob2'] = '';
				$v_data['client_dob3'] = '';
			}
		}
		$v_data['neighbourhoods_query'] = $this->profile_model->get_neighbourhoods();
		$v_data['genders_query'] = $this->profile_model->get_gender();
		$v_data['age_groups_query'] = $this->profile_model->get_age_group();
		$v_data['encounters_query'] = $this->profile_model->get_encounter();
		
		$data['content'] = $this->load->view('register/about_you', $v_data, true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('site/templates/home_page', $data);
	}
	
	public function like_profile($like_id)
	{
		if($this->profile_model->like_profile($this->user_id, $like_id))
		{
			if($this->payments_model->bill_client($this->user_id, $this->like_amount))
			{
			}
			
			else
			{
			}
			echo 'true';
		}
		
		else
		{
			echo 'false';
		}
	}
	
	public function unlike_profile($like_id)
	{
		if($this->profile_model->unlike_profile($this->user_id, $like_id))
		{
			echo 'true';
		}
		
		else
		{
			echo 'false';
		}
	}
	
	public function send_message($receiver_id, $page = NULL)
	{
		$v_data['smiley_location'] = $this->smiley_location;
		
		$v_data['receiver'] = $this->profile_model->get_client($receiver_id);
		$v_data['sender'] = $this->profile_model->get_client($this->user_id);
		$v_data['messages'] = $this->profile_model->get_messages($this->user_id, $receiver_id, $this->messages_path);
		$v_data['received_messages'] = $this->profile_model->count_received_messages($v_data['messages']);
		$v_data['profile_image_location'] = $this->profile_image_location;
		
		//make payment if message was sent
		if($page > 0)
		{
		}
		
		if($page == 1)
		{
			$data['messages'] = $this->load->view('messages/message_details', $v_data, true);
			$data['curr_message_count'] = $v_data['received_messages'];
			// $data['account_balance'] = $this->payments_model->get_account_balance($this->session->userdata('client_id'));
			
			echo json_encode($data);
		}
		
		else if($page == 2)
		{
			$data['messages'] = $this->load->view('account/modal_messages', $v_data, true);
			$data['curr_message_count'] = $v_data['received_messages'];
			$data['account_balance'] = $this->payments_model->get_account_balance($this->session->userdata('client_id'));
			
			echo json_encode($data);
		}
		
		else
		{
			//for smileys
			$image_array = get_clickable_smileys($this->smiley_location, 'instant_message');
			$col_array = $this->table->make_columns($image_array, 12);
			
			$v_data['smiley_table'] = $this->profile_model->generate_emoticons($col_array);
			
			echo $this->load->view('account/message', $v_data, true);
		}
	}
	
	public function message_profile($page = NULL)
	{
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('client_message_details', 'Message', 'required|xss_clean');
		
		if($this->form_validation->run())
		{
			$data['client_message_details'] = $this->input->post('client_message_details');
			$data['client_id'] = 1;
			$data['receiver_id'] = $this->input->post('receiver_id');
			$data['created'] = date('Y-m-d H:i:s');
			$content = json_encode($data);
			
			//create file name
			$file_name = $this->profile_model->create_file_name($this->user_id, $this->input->post('receiver_id'));
			$file_path = $this->messages_path.'//'.$file_name;
			$base_path = $this->messages_path;
			
			//check if file exists
			if(!$this->file_model->check_if_file_exists($file_path, $base_path))
			{
				//create file if not exists
				if($this->file_model->create_file($file_path, $base_path))
				{
					$this->file_model->write_to_file($file_path, $content);
					

					//bill client
					if($this->payments_model->bill_client($this->user_id, $this->message_amount))
					{
					}
					
					else
					{
					}
					$this->send_message($data['receiver_id'], $page);
				}
				
				else
				{
					echo 'false';
				}
			}
			
			else
			{
				$this->file_model->write_to_file($file_path, $content);
					
				//bill client
				
				$this->send_message($data['receiver_id'], $page);
			}
			
			//$this->db->insert('client_message', $data);
		}
		
		else
		{
			echo 'false';
		}
	}
	
	public function update_profile_image($user_image)
	{
		//upload image if it has been selected
		$response = $this->profile_model->update_profile_image($this->profile_image_path, $user_image, $this->user_id);
		redirect('profile');
	}
	
	public function edit_profile()
	{
		$v_data['genders_query'] = $this->profile_model->get_gender();

		$v_data['post_genders'] = '';
		$v_data['post_ages'] = '';
		
		$v_data['ages_array'] = '';
		
		//initialize required variables
		$v_data['client_about_error'] = '';
		$v_data['client_dob1_error'] = '';
		$v_data['client_dob2_error'] = '';
		$v_data['client_dob3_error'] = '';
		$v_data['gender_id_error'] = '';
				
		$user_query = $this->profile_model->get_user($this->user_id);
		$row = $user_query->row();
		$v_data['profile_image_location'] = $this->profile_image_location.$row->user_image;
		$v_data['user_image'] = $row->user_image;
		$v_data['gender_id'] = $row->gender_id;
		$v_data['user_about'] = $row->user_about;
		$user_dob = $row->user_dob;
		$v_data['user_dob1'] = date('d',strtotime($user_dob));
		$v_data['user_dob2'] = date('m',strtotime($user_dob));
		$v_data['user_dob3'] = date('Y',strtotime($user_dob));
		
		//upload image if it has been selected
		/*$response = $this->profile_model->upload_profile_image($this->profile_image_path, $row->user_image, $row->user_thumb);
		if($response)
		{
			$v_data['profile_image_location'] = $this->profile_image_location.$this->session->userdata('profile_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['profile_image_error'] = $this->session->userdata('profile_error_message');
		}*/
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('user_about', 'About you', 'trim|required|min_length[20]|xss_clean');
		$this->form_validation->set_rules('user_dob1', 'Day of birth', 'trim|required|greater_than[0]|less_than[32]|xss_clean');
		$this->form_validation->set_rules('user_dob2', 'Month of birth', 'trim|required|greater_than[0]|less_than[13]|xss_clean');
		$this->form_validation->set_rules('user_dob3', 'Year of birth', 'trim|required|greater_than[1900]|xss_clean');
		$this->form_validation->set_rules('gender_id', 'I am a', 'trim|required|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->profile_model->register_profile_details($this->user_id, $this->session->userdata('profile_file_name'), $this->session->userdata('profile_thumb_name')))
			{
				//redirect only if logo error isnt present
				redirect('my-profile');
			}
			
			else
			{
				$this->session->set_userdata('vendor_signup2_error_message', 'Unable to add user details. Please try again');
			}
		}
		$validation_errors = validation_errors();
		
		//repopulate form data if validation errors are present
		if(!empty($validation_errors))
		{
			//create errors
			$v_data['user_about_error'] = form_error('user_about');
			$v_data['user_dob1_error'] = form_error('user_dob1');
			$v_data['user_dob2_error'] = form_error('user_dob2');
			$v_data['user_dob3_error'] = form_error('user_dob3');
			$v_data['gender_id'] = form_error('gender_id');
			
			//repopulate fields
			$v_data['user_about'] = set_value('user_about');
			$v_data['gender_id'] = set_value('gender_id');
			$v_data['user_dob1'] = set_value('user_dob1');
			$v_data['user_dob2'] = set_value('user_dob2');
			$v_data['user_dob3'] = set_value('user_dob3');
		}
		
		//populate form data on initial load of page
		else
		{
			if(!empty($v_data['profile_image_error']))
			{
				/*$v_data['neighbourhood_id'] = set_value('neighbourhood_id');
				$v_data['user_about'] = set_value('user_about');
				$v_data['user_looking_gender_id'] = set_value('user_looking_gender_id');
				$v_data['age_group_id'] = set_value('age_group_id');
				$v_data['encounter_id'] = set_value('encounter_id');
				$v_data['user_dob1'] = set_value('user_dob1');

				$v_data['user_dob2'] = set_value('user_dob2');
				$v_data['user_dob3'] = set_value('user_dob3');*/
			}
			
			else
			{
			}
		}
		// $v_data['genders_query'] = $this->profile_model->get_gender();
		
		// $data['content'] = $this->load->view('home/edit_profile', $v_data, true);
		
		// $data['title'] = $this->site_model->display_page_title();
		// $this->load->view('templates/general_page', $data);
		$data['content'] = $this->load->view('home/profile', $v_data, true);
		
		$data['title'] = 'Home';
		$this->load->view('site/templates/general_page', $data);
	}
	public function profile_page() 
	{
		// $this->load->view('includes/top_navigation');
		$user_query = $this->profile_model->get_user($this->user_id);
		$row = $user_query->row();
		$v_data['profile_image_location'] = $this->profile_image_location.$row->user_image;
		$v_data['gender_id'] = $row->gender_id;
		$v_data['user_about'] = $row->user_about;
		$user_dob = $row->user_dob;
		$v_data['user_dob1'] = date('d',strtotime($user_dob));
		$v_data['user_dob2'] = date('m',strtotime($user_dob));
		$v_data['user_dob3'] = date('Y',strtotime($user_dob));
		
		//upload image if it has been selected
		$response = $this->profile_model->upload_profile_image($this->profile_image_path, $row->user_image, $row->user_thumb);
		if($response)
		{
			$v_data['profile_image_location'] = $this->profile_image_location.$this->session->userdata('profile_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['profile_image_error'] = $this->session->userdata('profile_error_message');
		}
		$v_data['genders_query'] = $this->profile_model->get_gender();
		$data['content'] = $this->load->view('home/profile', $v_data, true);
		
		$data['title'] = 'Home';
		$this->load->view('site/templates/general_page', $data);
	}
    
}