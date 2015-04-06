<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Event_type extends admin {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('event_type_model');
	}
    
	/*
	*	Default action is to show all the event_type
	*/
	public function index() 
	{
		$where = 'event_type_id > 0';
		$table = 'event_type';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-event-type';
		$config['total_rows'] = $this->event_type_model->count_items($table, $where);
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
		$query = $this->event_type_model->get_all_event_type($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['event_type'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('event_type/all_event_type', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'add-event-type" class="btn btn-success pull-right">Add event_type</a> There are no event_types';
		}
		$data['title'] = 'All event-type';
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Add a new event_type page
	*
	*/
	public function add_event_type() 
	{
		//form validation rules
		$this->form_validation->set_rules('event_type_name', 'event_type Name', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if event_type has valid login credentials
			if($this->event_type_model->add_event_type())
			{
				redirect('all-event-type');
			}
			
			else
			{
				$data['error'] = 'Unable to add event_type. Please try again';
			}
		}
		
		//open the add new event_type page
		$data['title'] = 'Add new event_type';
		$data['content'] = $this->load->view('event_type/add_event_type', '', TRUE);
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Edit an existing event_type page
	*	@param int $event_type_id
	*
	*/
	public function edit_event_type($event_type_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('event_type_name', 'event_type Name', 'xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if event_type has valid login credentials
			if($this->event_type_model->edit_event_type($event_type_id))
			{
				$this->session->set_userdata('success_message', 'event_type edited successfully');
				redirect('all-event-type');
				
			}
			
			else
			{
				$data['error'] = 'Unable to add event_type. Please try again';
			}
		}
		
		//open the add new event_type page
		$data['title'] = 'Edit event_type';
		
		//select the event_type from the database
		$query = $this->event_type_model->get_event_type($event_type_id);
		if ($query->num_rows() > 0)
		{
			$v_data['event_type'] = $query->result();
			$data['content'] = $this->load->view('event_type/edit_event_type', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'event_type does not exist';
		}
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Delete an existing event_type page
	*	@param int $event_type_id
	*
	*/
	public function delete_event_type($event_type_id) 
	{
		if($this->event_type_model->delete_event_type($event_type_id))
		{
			$this->session->set_userdata('success_message', 'event_type has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'event_type could not be deleted');
		}
		
		redirect('all-event-type');
	}
    
	/*
	*
	*	Activate an existing event_type page
	*	@param int $event_type_id
	*
	*/
	public function activate_event_type($event_type_id) 
	{
		if($this->event_type_model->activate_event_type($event_type_id))
		{
			$this->session->set_userdata('success_message', 'event_type has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'event_type could not be activated');
		}
		
		redirect('all-event-type');
	}
    
	/*
	*
	*	Deactivate an existing event_type page
	*	@param int $event_type_id
	*
	*/
	public function deactivate_event_type($event_type_id) 
	{
		if($this->event_type_model->deactivate_event_type($event_type_id))
		{
			$this->session->set_userdata('success_message', 'event_type has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'event_type could not be disabled');
		}
		
		redirect('all-event-type');
	}
	
	
}
?>