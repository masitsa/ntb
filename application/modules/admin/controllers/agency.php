<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Agency extends admin {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('agency_model');
	}
    
	/*
	*	Default action is to show all the agency
	*/
	public function index() 
	{
		$where = 'agency_id > 0';
		$table = 'agency';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-agency';
		$config['total_rows'] = $this->agency_model->count_items($table, $where);
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
		$query = $this->agency_model->get_all_agency($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['agency'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('agency/all_agency', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'add-agency" class="btn btn-success pull-right">Add Agency</a> There are no Agencys';
		}
		$data['title'] = 'All Agencies';
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Add a new agency page
	*
	*/
	public function add_agency() 
	{
		//form validation rules
		$this->form_validation->set_rules('agency_name', 'Agency Name', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if agency has valid login credentials
			if($this->agency_model->add_agency())
			{
				redirect('all-agencies');
			}
			
			else
			{
				$data['error'] = 'Unable to add agency. Please try again';
			}
		}
		
		//open the add new agency page
		$data['title'] = 'Add new agency';
		$data['content'] = $this->load->view('agency/add_agency', '', TRUE);
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Edit an existing agency page
	*	@param int $agency_id
	*
	*/
	public function edit_agency($agency_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('agency_name', 'Agency Name', 'xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if agency has valid login credentials
			if($this->agency_model->edit_agency($agency_id))
			{
				$this->session->set_userdata('success_message', 'agency edited successfully');
				redirect('all-agencies');
				
			}
			
			else
			{
				$data['error'] = 'Unable to add agency. Please try again';
			}
		}
		
		//open the add new agency page
		$data['title'] = 'Edit Agency';
		
		//select the agency from the database
		$query = $this->agency_model->get_agency($agency_id);
		if ($query->num_rows() > 0)
		{
			$v_data['agency'] = $query->result();
			$data['content'] = $this->load->view('agency/edit_agency', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'agency does not exist';
		}
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Delete an existing agency page
	*	@param int $agency_id
	*
	*/
	public function delete_agency($agency_id) 
	{
		if($this->agency_model->delete_agency($agency_id))
		{
			$this->session->set_userdata('success_message', 'Agency has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Agency could not be deleted');
		}
		
		redirect('all-agencies');
	}
    
	/*
	*
	*	Activate an existing agency page
	*	@param int $agency_id
	*
	*/
	public function activate_agency($agency_id) 
	{
		if($this->agency_model->activate_agency($agency_id))
		{
			$this->session->set_userdata('success_message', 'Agency has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Agency could not be activated');
		}
		
		redirect('all-agencies');
	}
    
	/*
	*
	*	Deactivate an existing agency page
	*	@param int $agency_id
	*
	*/
	public function deactivate_agency($agency_id) 
	{
		if($this->agency_model->deactivate_agency($agency_id))
		{
			$this->session->set_userdata('success_message', 'Agency has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Agency could not be disabled');
		}
		
		redirect('all-agencies');
	}
	
	
}
?>