<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Country extends admin {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('country_model');
	}
    
	/*
	*	Default action is to show all the country
	*/
	public function index() 
	{
		$where = 'country_id > 0';
		$table = 'country';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-country';
		$config['total_rows'] = $this->country_model->count_items($table, $where);
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
		$query = $this->country_model->get_all_country($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['country'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('country/all_country', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'add-country" class="btn btn-success pull-right">Add country</a> There are no countrys';
		}
		$data['title'] = 'All country';
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Add a new country page
	*
	*/
	public function add_country() 
	{
		//form validation rules
		$this->form_validation->set_rules('country_name', 'country Name', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if country has valid login credentials
			if($this->country_model->add_country())
			{
				redirect('all-country');
			}
			
			else
			{
				$data['error'] = 'Unable to add country. Please try again';
			}
		}
		
		//open the add new country page
		$data['title'] = 'Add new country';
		$data['content'] = $this->load->view('country/add_country', '', TRUE);
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Edit an existing country page
	*	@param int $country_id
	*
	*/
	public function edit_country($country_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('country_name', 'country Name', 'xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if country has valid login credentials
			if($this->country_model->edit_country($country_id))
			{
				$this->session->set_userdata('success_message', 'country edited successfully');
				redirect('all-country');
				
			}
			
			else
			{
				$data['error'] = 'Unable to add country. Please try again';
			}
		}
		
		//open the add new country page
		$data['title'] = 'Edit country';
		
		//select the country from the database
		$query = $this->country_model->get_country($country_id);
		if ($query->num_rows() > 0)
		{
			$v_data['country'] = $query->result();
			$data['content'] = $this->load->view('country/edit_country', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'country does not exist';
		}
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Delete an existing country page
	*	@param int $country_id
	*
	*/
	public function delete_country($country_id) 
	{
		if($this->country_model->delete_country($country_id))
		{
			$this->session->set_userdata('success_message', 'country has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'country could not be deleted');
		}
		
		redirect('all-country');
	}
    
	/*
	*
	*	Activate an existing country page
	*	@param int $country_id
	*
	*/
	public function activate_country($country_id) 
	{
		if($this->country_model->activate_country($country_id))
		{
			$this->session->set_userdata('success_message', 'country has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'country could not be activated');
		}
		
		redirect('all-country');
	}
    
	/*
	*
	*	Deactivate an existing country page
	*	@param int $country_id
	*
	*/
	public function deactivate_country($country_id) 
	{
		if($this->country_model->deactivate_country($country_id))
		{
			$this->session->set_userdata('success_message', 'country has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'country could not be disabled');
		}
		
		redirect('all-country');
	}
	
	
}
?>