<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once "./application/modules/site/controllers/account.php";
class Facilitator extends account 
{	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('site_model');
		$this->load->model('facilitator_model');
		$this->load->model('admin/users_model');
		$this->load->model('site/events_model');
		$this->load->model('site/attendee_model');
	}
    
	/*
	*
	*	List facilitators
	*
	*/
	public function all_facilitators($meeting_id = NULL) 
	{
		$where = 'facilitator_id > 0 AND meeting_id ='.$meeting_id;
		$table = 'facilitator';
		$limit = NULL;
		
		//pagination
		$segment = 3;
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-facilitators/'.$meeting_id;
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
		$v_data["meeting_id"] = $meeting_id;
		
		$v_data['facilitators'] = $this->facilitator_model->get_all_facilitators($table, $where, $config["per_page"], $page, $limit);
		
		$data['content'] = $this->load->view('facilitator/all_facilitators', $v_data, true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Add facilitator
	*
	*/
	public function add_facilitator($meeting_id = NULL) 
	{
		//initialize required variables
		$v_data['facilitator_first_name_error'] = '';
		$v_data['facilitator_last_name_error'] = '';
		$v_data['facilitator_email_error'] = '';
		$v_data['facilitator_title_error'] = '';
		$v_data['titles_query'] = $this->facilitator_model->get_titles();
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('facilitator_title', 'Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('facilitator_first_name', 'First name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('facilitator_last_name', 'Last name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('organization_name', 'Organization name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('designation', 'Designation', 'trim|required|xss_clean');
		$this->form_validation->set_rules('facilitator_email', 'Email', 'trim|required|valid_email|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->facilitator_model->add_facilitator($meeting_id))
			{
				$this->session->set_userdata('success_message', 'Facilitator added successfully');
				redirect('all-facilitators/'.$meeting_id);
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Unable to add facilitator. Please try again');
			}
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['facilitator_first_name_error'] = form_error('facilitator_first_name');
				$v_data['facilitator_last_name_error'] = form_error('facilitator_last_name');
				$v_data['facilitator_email_error'] = form_error('facilitator_email');
				$v_data['facilitator_title_error'] = form_error('facilitator_title');
				
				//repopulate fields
				$v_data['facilitator_first_name'] = set_value('facilitator_first_name');
				$v_data['facilitator_last_name'] = set_value('facilitator_last_name');
				$v_data['facilitator_email'] = set_value('facilitator_email');
				$v_data['facilitator_title'] = set_value('facilitator_title');
			}
			
			//populate form data on initial load of page
			else
			{
				$v_data['facilitator_first_name'] = '';
				$v_data['facilitator_last_name'] = '';
				$v_data['facilitator_email'] = '';
				$v_data['facilitator_title'] = '';
			}
		}
		
		$v_data['title'] = 'Add';
		$v_data['meeting_id'] = $meeting_id;
		$data['content'] = $this->load->view('facilitator/add_facilitator', $v_data, true);
		
		$data['title'] = 'Add';
		$this->load->view('site/templates/general_page', $data);
	}
    
    /*
	*
	*	Edit facilitator
	*
	*/
	public function edit_meeting_facilitator($facilitator_id,$meeting_id) 
	{
		$this->form_validation->set_rules('facilitator_title', 'Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('facilitator_first_name', 'First name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('facilitator_last_name', 'Last name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('facilitator_email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('organization_name', 'Organization name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('designation', 'Designation', 'trim|required|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->facilitator_model->edit_facilitator($facilitator_id))
			{
				$data['result'] = 'Facilitator details has been updated successfully';
			}
			else
			{
				$data['result'] = 'Something went wrong when updating facilitator details. Please try again';
			}
		}
		else
		{
			$data['result'] = 'Ensure that all details have been entered';
		}
		echo json_encode($data);
	}
	/*
	*
	*	Edit facilitator
	*
	*/
	public function edit_facilitator($facilitator_id,$meeting_id) 
	{
		//initialize required variables
		$v_data['facilitator_first_name_error'] = '';
		$v_data['facilitator_last_name_error'] = '';
		$v_data['facilitator_email_error'] = '';
		$v_data['facilitator_title_error'] = '';
		$facilitator_query = $this->facilitator_model->get_facilitator($facilitator_id);
		$v_data['titles_query'] = $this->facilitator_model->get_titles();
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('facilitator_title', 'Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('facilitator_first_name', 'First name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('facilitator_last_name', 'Last name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('facilitator_email', 'Email', 'trim|required|valid_email|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->facilitator_model->edit_facilitator($facilitator_id))
			{
				$this->session->set_userdata('success_message', 'Facilitator edited successfully');
				redirect('all-facilitators/'.$meeting_id);
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Unable to add facilitator. Please try again');
			}
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['facilitator_first_name_error'] = form_error('facilitator_first_name');
				$v_data['facilitator_last_name_error'] = form_error('facilitator_last_name');
				$v_data['facilitator_email_error'] = form_error('facilitator_email');
				$v_data['facilitator_title_error'] = form_error('facilitator_title');
				
				//repopulate fields
				$v_data['facilitator_first_name'] = set_value('facilitator_first_name');
				$v_data['facilitator_last_name'] = set_value('facilitator_last_name');
				$v_data['facilitator_email'] = set_value('facilitator_email');
				$v_data['facilitator_title'] = set_value('facilitator_title');
			}
			
			//populate form data on initial load of page
			else
			{
				if($facilitator_query->num_rows() > 0)
				{
					$row = $facilitator_query->row();
					
					$v_data['facilitator_first_name'] = $row->facilitator_first_name;
					$v_data['facilitator_last_name'] = $row->facilitator_last_name;
					$v_data['facilitator_email'] = $row->facilitator_email;
					$v_data['facilitator_title'] = $row->facilitator_title;
				}
				
				else
				{
					$v_data['facilitator_first_name'] = '';
					$v_data['facilitator_last_name'] = '';
					$v_data['facilitator_email'] = '';
					$v_data['facilitator_title'] = '';
				}
			}
		}
		$v_data['title'] = 'Edit';
		$v_data['meeting_id'] = $meeting_id;
		$data['content'] = $this->load->view('facilitator/add_facilitator', $v_data, true);
		
		$data['title'] = 'Add';
		$this->load->view('site/templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing facilitator
	*	@param int $facilitator_id
	*
	*/
	public function delete_facilitator($facilitator_id,$meeting_id)
	{
		//delete facilitator
		if($this->facilitator_model->delete_facilitator($facilitator_id))
		{
			$this->session->set_userdata('success_message', 'Facilitator has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to delete facilitator. Please try again');
		}
	}
    
    public function delete_meeting_facilitator($facilitator_id,$meeting_id){
    	$meeting_detail = $this->events_model->get_event_name($meeting_id);
		if ($meeting_detail->num_rows() > 0)
		{
		    foreach ($meeting_detail->result() as $row)
		    {
		        $created_by = $row->created_by;
		    }
		}

		if($created_by == $this->user_id)
		{
	    	if($this->facilitator_model->delete_facilitator($facilitator_id))
			{
				$data['result'] = 'Facilitator has been successfully deleted';
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Unable to delete facilitator. Please try again');
			}
		}
		else
		{

		}

    }
	/*
	*
	*	Activate an existing facilitator
	*	@param int $facilitator_id
	*
	*/
	public function activate_facilitator($facilitator_id,$meeting_id)
	{
		if($this->facilitator_model->activate_facilitator($facilitator_id))
		{
			$this->session->set_userdata('success_message', 'Facilitator activated successfully');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to activate facilitator. Please try again');
		}
		redirect('all-facilitators/'.$meeting_id);
	}
    
	/*
	*
	*	Deactivate an existing facilitator
	*	@param int $facilitator_id
	*
	*/
	public function deactivate_facilitator($facilitator_id,$meeting_id)
	{
		// $meeting_detail = $this->events_model->get_event_name($meeting_id);
		// if ($meeting_detail->num_rows() > 0)
		// {
		//     foreach ($meeting_detail->result() as $row)
		//     {
		//         $created_by = $row->created_by;
		//     }
		// }

		// if($created_by == $this->user_id)
		// {
			if($this->facilitator_model->deactivate_facilitator($facilitator_id))
			{
				// $this->session->set_userdata('success_message', 'Facilitator deactivate successfully');

			}
			
			else
			{
				// $this->session->set_userdata('error_message', 'Unable to deactivate facilitator. Please try again');
			}
		// }
		// else
		// {
		// 	$this->session->set_userdata('error_message', 'You do not have the rights to perform thhis action');

			
		// }
		// redirect('all-facilitators/'.$meeting_id);
	}


	
	public function deactivate_meeting_facilitator($facilitator_id)
	{


		if($this->facilitator_model->deactivate_facilitator($facilitator_id))
		{
			$this->session->set_userdata('success_message', 'Facilitator deactivate successfully');
			$data['result'] = 'success';
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to deactivate facilitator. Please try again');
			$data['result'] = 'failure';
		}
		
		echo json_encode($data);
	}
	public function add_meeting_facilitator($meeting_id)
	{
		$this->form_validation->set_rules('facilitator_title', 'Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('facilitator_first_name', 'First name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('facilitator_last_name', 'Last name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('facilitator_email', 'Email', 'trim|required|valid_email|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->facilitator_model->add_facilitator($meeting_id))
			{
				$this->session->set_userdata('success_message', 'Facilitator edited successfully');
				$data['result'] = 'success';
			}
			else
			{
				$data['result'] = 'failure';
			}
		}
		else
		{
			$data['result'] = 'failure';
		}
		
		echo json_encode($data);
	}
	function send_convenor_notification($facilitator_id, $meeting_id)
	{
		if($this->facilitator_model->send_meeting_reminder_email($meeting_id, $facilitator_id))
		{			
			$data['result'] = 'success';
		}
		
		else
		{
			$data['result'] = 'fail';
		}

		echo json_encode($data);
	}

	function send_convenor_mass_notification($meeting_id)
	{
		// get facilitator details
		$facilitator_array = $this->facilitator_model->get_meeting_facilitator($meeting_id);
		if ($facilitator_array->num_rows() > 0)
		{
			foreach ($facilitator_array->result() as $facilitator_row)
			{
				$facilitator_id = $facilitator_row->facilitator_id;
				
				if($this->facilitator_model->send_meeting_reminder_email($meeting_id, $facilitator_id))
				{			
					$data['result'] = 'success';
				}
				
				else
				{
					$data['result'] = 'fail';
				}
			}
		}
		
		echo json_encode($data);
	}
	public function meeting_facilitators($meeting_id)
	{

		$data = array('meeting_id'=>$meeting_id);
		$this->load->view('facilitator/show_facilitators',$data);	
	}
}
?>