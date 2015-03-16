<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Customers extends admin {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('customers_model');
	}
    
	/*
	*
	*	Default action is to show all the customers
	*
	*/
	public function index() 
	{
		$where = 'customer_id > 0 AND agent_id = '.$this->session->userdata('user_id');
		$table = 'customers';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-customers';
		$config['total_rows'] = $this->customers_model->count_items($table, $where);
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
		$query = $this->customers_model->get_all_customers($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['customers'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('customers/all_customers', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'add-customer" class="btn btn-success pull-right">Add Customer</a> There are no Customers';
		}
		$data['title'] = 'All Customers';
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Add a new customer page
	*
	*/
	public function add_customer() 
	{
		//form validation rules
		$this->form_validation->set_rules('other_names', 'Other Names', 'required|xss_clean');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('phone', 'Phone', 'xss_clean');
		$this->form_validation->set_rules('activated', 'Activate customer', 'xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if customer has valid login credentials
			if($this->customers_model->add_customer())
			{
				redirect('all-customers');
			}
			
			else
			{
				$data['error'] = 'Unable to add customer. Please try again';
			}
		}
		
		//open the add new customer page
		$data['title'] = 'Add New Customer';
		$data['content'] = $this->load->view('customers/add_customer', '', TRUE);
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Edit an existing customer page
	*	@param int $customer_id
	*
	*/
	public function edit_customer($customer_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('other_names', 'Other Names', 'required|xss_clean');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('phone', 'Phone', 'xss_clean');
		$this->form_validation->set_rules('activated', 'Activate customer', 'xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if customer has valid login credentials
			if($this->customers_model->edit_customer($customer_id))
			{
				$this->session->set_customerdata('success_message', 'customer edited successfully');
				$pwd_update = $this->input->post('admin_customer');
				if(!empty($pwd_update))
				{
					redirect('admin-profile/'.$customer_id);
				}
				
				else
				{
					redirect('all-customers');
				}
			}
			
			else
			{
				$data['error'] = 'Unable to add customer. Please try again';
			}
		}
		
		//open the add new customer page
		$data['title'] = 'Edit Customer';
		
		//select the customer from the database
		$query = $this->customers_model->get_customer($customer_id);
		if ($query->num_rows() > 0)
		{
			$v_data['customers'] = $query->result();
			$data['content'] = $this->load->view('customers/edit_customer', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'customer does not exist';
		}
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Delete an existing customer page
	*	@param int $customer_id
	*
	*/
	public function delete_customer($customer_id) 
	{
		if($this->customers_model->delete_customer($customer_id))
		{
			$this->session->set_customerdata('success_message', 'Customer has been deleted');
		}
		
		else
		{
			$this->session->set_customerdata('error_message', 'Customer could not be deleted');
		}
		
		redirect('all-customers');
	}
    
	/*
	*
	*	Activate an existing customer page
	*	@param int $customer_id
	*
	*/
	public function activate_customer($customer_id) 
	{
		if($this->customers_model->activate_customer($customer_id))
		{
			$this->session->set_customerdata('success_message', 'Customer has been activated');
		}
		
		else
		{
			$this->session->set_customerdata('error_message', 'Customer could not be activated');
		}
		
		redirect('all-customers');
	}
    
	/*
	*
	*	Deactivate an existing customer page
	*	@param int $customer_id
	*
	*/
	public function deactivate_customer($customer_id) 
	{
		if($this->customers_model->deactivate_customer($customer_id))
		{
			$this->session->set_customerdata('success_message', 'Customer has been disabled');
		}
		
		else
		{
			$this->session->set_customerdata('error_message', 'Customer could not be disabled');
		}
		
		redirect('all-customers');
	}
	
	/*
	*
	*	Reset a customer's password
	*	@param int $customer_id
	*
	*/
	public function reset_password($customer_id)
	{
		$new_password = $this->login_model->reset_password($customer_id);
		$this->session->set_customerdata('success_message', 'New password is <br/><strong>'.$new_password.'</strong>');
		
		redirect('all-customers');
	}
	
	/*
	*
	*	Show an Customer's profile
	*	@param int $customer_id
	*
	*/
	public function admin_profile($customer_id)
	{
		//open the add new customer page
		$data['title'] = 'Edit customer';
		
		//select the customer from the database
		$query = $this->customers_model->get_customer($customer_id);
		if ($query->num_rows() > 0)
		{
			$v_data['customers'] = $query->result();
			$v_data['admin_customer'] = 1;
			$tab_content[0] = $this->load->view('customers/edit_customer', $v_data, true);
		}
		
		else
		{
			$data['tab_content'][0] = 'customer does not exist';
		}
		$tab_name[1] = 'Overview';
		$tab_name[0] = 'Edit Account';
		$tab_content[1] = 'Coming soon';//$this->load->view('account_overview', $v_data, true);
		$data['total_tabs'] = 2;
		$data['content'] = $tab_content;
		$data['tab_name'] = $tab_name;
		
		$this->load->view('templates/tabs', $data);
	}
}
?>