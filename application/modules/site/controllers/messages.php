<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/site/controllers/account.php";

class Messages extends account 
{
	
	function __construct()
	{
		parent:: __construct();
	}
	
	public function inbox($search = '__', $order_by = 'created') 
	{
		$where = 'user_id <> '.$this->user_id;
		$table = 'users';
		$limit = NULL;
		
		//pagination
		$segment = 2;
		$this->load->library('pagination');
		$config['base_url'] = base_url().'inbox';
		$config['total_rows'] = $this->users_model->count_items($table, $where, $limit);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 21;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = '»';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = '«';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
		
		$v_data["links"] = $this->pagination->create_links();
		$v_data["first"] = $page + 1;
		$v_data["total"] = $config['total_rows'];
		
		if($v_data["total"] < $config["per_page"])
		{
			$v_data["last"] = $page + $v_data["total"];
		}
		
		else
		{
			$v_data["last"] = $page + $config["per_page"];
		}
		$v_data["page"] = $page;
		
		$v_data['users'] = $this->messages_model->get_all_users($table, $where, $config["per_page"], $page, $limit);
		$v_data['profile_image_location'] = $this->profile_image_location;
		$data['content'] = $this->load->view('home/messages', $v_data, true);
		
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('site/templates/general_page', $data);
	}
	
	public function view_message($receiver_web_name)
	{


		$where = 'user_id <> '.$this->user_id;
		$table = 'users';
		$limit = NULL;
		
		//pagination
		$segment = 2;
		$this->load->library('pagination');
		$config['base_url'] = base_url().'inbox';
		$config['total_rows'] = $this->users_model->count_items($table, $where, $limit);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 21;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = '»';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = '«';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
		
		$v_data["links"] = $this->pagination->create_links();
		$v_data["first"] = $page + 1;
		$v_data["total"] = $config['total_rows'];
		
		if($v_data["total"] < $config["per_page"])
		{
			$v_data["last"] = $page + $v_data["total"];
		}
		
		else
		{
			$v_data["last"] = $page + $config["per_page"];
		}
		$v_data["page"] = $page;

		$v_data['users'] = $this->messages_model->get_all_users($table, $where, $config["per_page"], $page, $limit);
		//for smileys
		$image_array = get_clickable_smileys($this->smiley_location, 'instant_message');
		$col_array = $this->table->make_columns($image_array, 12);
		
		$v_data['smiley_table'] = $this->profile_model->generate_emoticons($col_array);
		$v_data['smiley_location'] = $this->smiley_location;
			
		$receiver_id = $this->messages_model->get_receiver_id($receiver_web_name);

		// $v_data['receiver'] = $this->profile_model->get_client($receiver_id);
		// $v_data['sender'] = $this->profile_model->get_client($this->user_id);

		$v_data['receiver'] = $this->profile_model->get_user($receiver_id);
		$v_data['sender'] = $this->profile_model->get_user($this->user_id);

		$v_data['messages'] = $this->profile_model->get_messages($this->user_id, $receiver_id, $this->messages_path);
		$v_data['received_messages'] = $this->profile_model->count_received_messages($v_data['messages']);
		$v_data['profile_image_location'] = $this->profile_image_location;
		
		//for smileys
		$image_array = get_clickable_smileys($this->smiley_location, 'instant_message');
		$col_array = $this->table->make_columns($image_array, 12);
		
		$v_data['smiley_table'] = $this->profile_model->generate_emoticons($col_array);
		
		// $data['content'] = $this->load->view('messages/view_message', $v_data, true);
		$data['title'] = $this->site_model->display_page_title();
		$data['content'] = $this->load->view('home/messages', $v_data, true);
		
		$data['title'] = 'Home';
		$this->load->view('site/templates/general_page', $data);
	}
	
	public function message_profile($page = NULL)
	{
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('user_message_details', 'Message', 'required|xss_clean');
		
		if($this->form_validation->run())
		{
			$data['user_message_details'] = $this->input->post('user_message_details');
			$data['user_id'] = 1;
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
					
					$this->display_messages($data['receiver_id']);
				}
				
				else
				{
					echo 'false1';
				}
			}
			
			else
			{
				$this->file_model->write_to_file($file_path, $content);
				$this->display_messages($data['receiver_id']);
			}
		}
		
		else
		{
			echo 'false2';
		}
	}
	
	public function display_messages($receiver_id)
	{
		$v_data['receiver'] = $this->profile_model->get_user($receiver_id);
		$v_data['sender'] = $this->profile_model->get_user($this->user_id);
		$v_data['messages'] = $this->profile_model->get_messages($this->user_id, $receiver_id, $this->messages_path);
		$v_data['received_messages'] = $this->profile_model->count_received_messages($v_data['messages']);
		$v_data['profile_image_location'] = $this->profile_image_location;
		$v_data['smiley_location'] = $this->smiley_location;
		
		//make payment if message was sent
		$data['messages'] = $this->load->view('messages/message_details', $v_data, true);
		$data['curr_message_count'] = $v_data['received_messages'];
		echo json_encode($data);
	}
}