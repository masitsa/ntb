<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends MX_Controller {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('admin/users_model');
		$this->load->model('login/login_model');
		$this->load->model('events_model');
		$this->load->model('site/action_point_model');
		$this->load->model('site/attendee_model');
		$this->load->model('site/facilitator_model');
		
		
		
	}
    
    
	/*
	*
	*	Default action is to go to the home page
	*
	*/
	public function index() 
	{
		// $this->load->view('includes/top_navigation');
		$where = 'meeting.country_id = country.country_id AND meeting.event_type_id = event_type.event_type_id AND meeting.agency_id = agency.agency_id';
		$table = 'meeting, agency, event_type,country';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-events';
		$config['total_rows'] = $this->events_model->count_items($table, $where);
		$config['uri_segment'] = 2;
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
		
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->events_model->get_all_events($table, $where, $config["per_page"], $page);
		
		
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$v_data['countries'] = $this->events_model->get_all_countries();
		$v_data['event_types'] = $this->events_model->get_all_event_types();
		$v_data['agencies'] = $this->events_model->get_all_agencies();

		
		$data['title'] = 'All orders';
		$data['content'] = $this->load->view('events/events', $v_data, true);
		
		$data['title'] = 'Events';
		$this->load->view('site/templates/general_page', $data);
	}

	public function add_event()
	{
		//initialize required variables
		$v_data['subject_error'] = '';
		$v_data['location_error'] = '';
		$v_data['country_id_error'] = '';
		$v_data['event_type_id_error'] = '';
		$v_data['agency_id_error'] = '';
		$v_data['meeting_date_error'] = '';
		$v_data['end_date_error'] = '';
		
		$this->form_validation->set_error_delimiters('', '');
		//form validation rules
		$this->form_validation->set_rules('subject', 'Subject', 'required|xss_clean');
		$this->form_validation->set_rules('location', 'Location', 'required|xss_clean');
		$this->form_validation->set_rules('country_id', 'Country', 'required|xss_clean');
		$this->form_validation->set_rules('event_type_id', 'Event type', 'required|xss_clean');
		$this->form_validation->set_rules('agency_id', 'Agency', 'required|xss_clean');
		$this->form_validation->set_rules('meeting_date', 'Meeting Date', 'required|xss_clean');
		$this->form_validation->set_rules('end_date', 'End date', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->events_model->add_event())
			{
				$this->session->set_userdata('success_message', 'brand added successfully');
				redirect('all-events');
			}
			
			else
			{
					$this->session->set_userdata('meeting_error_message', 'Unable to add meeting details. Please try again');
			}
		}
		else
		{

			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['subject_error'] = form_error('subject');
				$v_data['location_error'] = form_error('location');
				$v_data['country_id_error'] = form_error('country_id');
				$v_data['event_type_id_error'] = form_error('event_type_id');
				$v_data['agency_id_error'] = form_error('agency_id');
				$v_data['meeting_date_error'] = form_error('meeting_date');
				$v_data['end_date_error'] = form_error('end_date');

				
				
				//repopulate fields
				$v_data['subject'] = set_value('subject');
				$v_data['location'] = set_value('location');
				$v_data['country_id'] = set_value('country_id');
				$v_data['agency_id'] = set_value('agency_id');
				$v_data['event_type_id'] = set_value('event_type_id');
				$v_data['meeting_date'] = set_value('meeting_date');
				$v_data['end_date'] = set_value('end_date');
			}
			//populate form data on initial load of page
			else
			{
				
			}
			
		}
			
		// $this->load->view('includes/top_navigation');
		$where = 'meeting.country_id = country.country_id AND meeting.event_type_id = event_type.event_type_id AND meeting.agency_id = agency.agency_id';
		$table = 'meeting, agency, event_type,country';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-events';
		$config['total_rows'] = $this->events_model->count_items($table, $where);
		$config['uri_segment'] = 2;
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
		
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->events_model->get_all_events($table, $where, $config["per_page"], $page);
		
		
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$v_data['countries'] = $this->events_model->get_all_countries();
		$v_data['event_types'] = $this->events_model->get_all_event_types();
		$v_data['agencies'] = $this->events_model->get_all_agencies();
		
		$data['title'] = 'All orders';
		$data['content'] = $this->load->view('events/events', $v_data, true);
		
		$data['title'] = 'Events';
		$this->load->view('site/templates/general_page', $data);
		
	}

	public function edit_event($event_id)
	{
		//initialize required variables
		
		//form validation rules
		$this->form_validation->set_rules('subject', 'Subject', 'required|xss_clean');
		$this->form_validation->set_rules('location', 'Location', 'required|xss_clean');
		$this->form_validation->set_rules('country_id', 'Country', 'required|xss_clean');
		$this->form_validation->set_rules('event_type_id', 'Event type', 'required|xss_clean');
		$this->form_validation->set_rules('agency_id', 'Agency', 'required|xss_clean');
		$this->form_validation->set_rules('meeting_date', 'Meeting Date', 'required|xss_clean');
		$this->form_validation->set_rules('end_date', 'End date', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->events_model->update_event($event_id))
			{
				$this->session->set_userdata('success_message', 'event updated successfully');
				redirect('all-events');
			}
			
			else
			{
					$this->session->set_userdata('error_message', 'Unable to update meeting details. Please try again');
					redirect('all-events');
			}
		}
		else
		{

			$this->session->set_userdata('error_message', 'Unable to updated meeting details sda. Please try again');
			redirect('all-events');
		}

	}
	/*
	*
	*	Activate an existing brand
	*	@param int $brand_id
	*
	*/
	public function activate_event($event_id)
	{
		$data = array(
				'meeting_status' => 1
			);
		$this->db->where('meeting_id', $event_id);
		
		if($this->db->update('meeting', $data))
		{
			$this->session->set_userdata('success_message', ' Meeting activated successfully');
		}
		else{
			$this->session->set_userdata('error_message', ' Meeting was not activated. Please try again');
		}
		
		redirect('all-events');
	}
    
	/*
	*
	*	Deactivate an existing brand
	*	@param int $brand_id
	*
	*/
	public function deactivate_event($event_id)
	{
		$data = array(
				'meeting_status' => 2
			);
		$this->db->where('meeting_id', $event_id);
		
		if($this->db->update('meeting', $data))
		{
			$this->session->set_userdata('success_message', ' Meeting deactivated successfully');
		}
		else{
			$this->session->set_userdata('error_message', ' Meeting was not deactivated. Please try again');
		}
		
		redirect('all-events');
	}

}