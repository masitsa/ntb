<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/site/controllers/account.php";

class Social extends account {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('admin/users_model');
		$this->load->model('login/login_model');
		$this->load->model('site/site_model');
		$this->load->model('site/events_model');
		$this->load->model('site/action_point_model');
		$this->load->model('site/attendee_model');
		$this->load->model('social_model');

	}
    
    
	/*
	*
	*	Default action is to go to the home page
	*
	*/
	public function index($email_address, $meeting_id = NULL) 
	{
		// $this->load->view('includes/top_navigation');

		$where = 'meeting.country_id = country.country_id AND meeting.event_type_id = event_type.event_type_id AND meeting.agency_id = agency.agency_id AND attendee.meeting_id = meeting.meeting_id AND attendee.attendee_email = "'.$email_address.'"';
		$table = 'meeting, agency,event_type,country,attendee';
		//pagination
		// if($meeting_id == NULL)
		// {
		// 	$where .= '';
		// }
		// else
		// {
		// 	$where .=' AND meeting.meeting_id ='.$meeting_id;
		// }
		$this->load->library('pagination');
		if($meeting_id == NULL)
		{
			$config['base_url'] = base_url().'meetings/'.$email_address;
			$segment = 3;
		}
		else
		{
			$config['base_url'] = base_url().'meetings/'.$email_address.'/'.$meeting_id;
			$segment = 4;
		}
		$config['total_rows'] = $this->events_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->events_model->get_all_events($table, $where, $config["per_page"], $page);
		
		
		$v_data['query'] = $query;
		$v_data['email_address'] = $email_address;
		$v_data['meeting_id'] = $meeting_id;
		// $this->load->view('includes/top_navigation');
		$data['content'] = $this->load->view('home/meetings', $v_data, true);
		
		$data['title'] = 'Home';
		$this->load->view('social/templates/general_page', $data);
	}
	public function meeting_comments($meeting_id)
	{
		$data = array('meeting_id'=>$meeting_id);
		$this->load->view('home/show_meeting_comments',$data);	
	}
	public function save_meeting_comments($meeting_id)
	{
		//initialize required variables
		
		$this->form_validation->set_rules('attendee_first_name', 'First name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('attendee_comment', 'Attendee comment', 'trim|required|xss_clean');
		$this->form_validation->set_rules('attendee_email', 'Email', 'trim|required|valid_email|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->social_model->add_meeting_agenda_comment($meeting_id))
			{
				$data['result'] = 'Agenda comment has been updated successfully';
			}
			else
			{
				$data['result'] = 'Something went wrong when adding the agenda comment details. Please try again';
			}
		}
		else
		{
			$data['result'] = 'Ensure that all details have been entered';
		}
		echo json_encode($data);
	}

}