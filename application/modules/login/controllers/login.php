<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('login_model');
	}
    
	/*
	*
	*	Login a user
	*
	*/
	public function login_admin() 
	{
		//form validation rules
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|exists[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if user has valid login credentials
			if($this->login_model->validate_user())
			{
				//redirect('dashboard');
				if($this->session->userdata('user_level') == 1)
				{
					redirect('all-customers');
				}
				else
				{
					redirect('all-users');
				}
				
			}
			
			else
			{
				$data['error'] = 'The email or password provided is incorrect. Please try again';
				$this->load->view('admin_login', $data);
			}
		}
		
		else
		{
			$this->load->view('admin_login');
		}
	}
	/*
	*
	*	Vendor Sign in
	*
	*/
	public function user_signin() 
	{
		// initialize required variables
		$v_data['user_email_error'] = '';
		$v_data['user_password_error'] = '';
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('user_email', 'Email', 'trim|valid_email|required|exists[users.email]|xss_clean');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_message('exists', 'This email has not been registered');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->login_model->login_user())
			{
				//echo 'Your account is now verified. YAY!';
				redirect('calendar');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Unable to sign into your account. Please try again');
			}
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['user_email_error'] = form_error('user_email');
				$v_data['user_password_error'] = form_error('user_password');
				
				//repopulate fields
				$v_data['user_email'] = set_value('user_email');
				$v_data['user_password'] = set_value('user_password');
			}
			
			//populate form data on initial load of page
			else
			{
				$v_data['user_email'] = '';
				$v_data['user_password'] = '';
			}
		}
		
		$data['content'] = $this->load->view('site/login/login', '', true);
		
		$data['title'] = 'Sign In';
		$this->load->view('site/templates/login_page', $data);
	}
	public function logout_admin()
	{
		$this->session->sess_destroy();
		redirect('login-admin');
	}
	
	public function logout_user()
	{
		$this->session->sess_destroy();
		$this->session->set_userdata('front_success_message', 'Your have been signed out of your account');
		redirect('checkout');
	}
}
?>