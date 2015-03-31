<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once "./application/modules/site/controllers/account.php";
class Attendee extends account 
{	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('site_model');
		$this->load->model('attendee_model');
		$this->load->model('admin/users_model');
		$this->load->model('site/events_model');
	}
    
	/*
	*
	*	List attendees
	*
	*/
	public function all_attendees($meeting_id = NULL) 
	{
		$where = 'attendee_id > 0 AND meeting_id ='.$meeting_id;
		$table = 'attendee';
		$limit = NULL;
		
		//pagination
		$segment = 3;
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-attendees/'.$meeting_id;
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
		
		$v_data['attendees'] = $this->attendee_model->get_all_attendees($table, $where, $config["per_page"], $page, $limit);
		
		$data['content'] = $this->load->view('attendee/all_attendees', $v_data, true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Add attendee
	*
	*/
	public function add_attendee($meeting_id) 
	{
		//initialize required variables
		$v_data['attendee_first_name_error'] = '';
		$v_data['attendee_last_name_error'] = '';
		$v_data['attendee_email_error'] = '';
		$v_data['attendee_title_error'] = '';
		$v_data['titles_query'] = $this->attendee_model->get_titles();
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('attendee_title', 'Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('attendee_first_name', 'First name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('attendee_last_name', 'Last name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('attendee_email', 'Email', 'trim|required|valid_email|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->attendee_model->add_attendee($meeting_id))
			{
				$this->session->set_userdata('success_message', 'Attendee added successfully');
				redirect('all-attendees/'.$meeting_id);
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Unable to add attendee. Please try again');
			}
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['attendee_first_name_error'] = form_error('attendee_first_name');
				$v_data['attendee_last_name_error'] = form_error('attendee_last_name');
				$v_data['attendee_email_error'] = form_error('attendee_email');
				$v_data['attendee_title_error'] = form_error('attendee_title');
				
				//repopulate fields
				$v_data['attendee_first_name'] = set_value('attendee_first_name');
				$v_data['attendee_last_name'] = set_value('attendee_last_name');
				$v_data['attendee_email'] = set_value('attendee_email');
				$v_data['attendee_title'] = set_value('attendee_title');
			}
			
			//populate form data on initial load of page
			else
			{
				$v_data['attendee_first_name'] = '';
				$v_data['attendee_last_name'] = '';
				$v_data['attendee_email'] = '';
				$v_data['attendee_title'] = '';
			}
		}
		
		$v_data['title'] = 'Add';
		$v_data['meeting_id'] = $meeting_id;
		$data['content'] = $this->load->view('attendee/add_attendee', $v_data, true);
		
		$data['title'] = 'Add';
		$this->load->view('site/templates/general_page', $data);
	}
    
	/*
	*
	*	Edit attendee
	*
	*/
	public function edit_attendee($attendee_id,$meeting_id) 
	{
		//initialize required variables
		$v_data['attendee_first_name_error'] = '';
		$v_data['attendee_last_name_error'] = '';
		$v_data['attendee_email_error'] = '';
		$v_data['attendee_title_error'] = '';
		$attendee_query = $this->attendee_model->get_attendee($attendee_id);
		$v_data['titles_query'] = $this->attendee_model->get_titles();
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('attendee_title', 'Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('attendee_first_name', 'First name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('attendee_last_name', 'Last name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('attendee_email', 'Email', 'trim|required|valid_email|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->attendee_model->edit_attendee($attendee_id))
			{
				$this->session->set_userdata('success_message', 'Attendee edited successfully');
				redirect('all-attendees/'.$meeting_id);
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Unable to add attendee. Please try again');
			}
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['attendee_first_name_error'] = form_error('attendee_first_name');
				$v_data['attendee_last_name_error'] = form_error('attendee_last_name');
				$v_data['attendee_email_error'] = form_error('attendee_email');
				$v_data['attendee_title_error'] = form_error('attendee_title');
				
				//repopulate fields
				$v_data['attendee_first_name'] = set_value('attendee_first_name');
				$v_data['attendee_last_name'] = set_value('attendee_last_name');
				$v_data['attendee_email'] = set_value('attendee_email');
				$v_data['attendee_title'] = set_value('attendee_title');
			}
			
			//populate form data on initial load of page
			else
			{
				if($attendee_query->num_rows() > 0)
				{
					$row = $attendee_query->row();
					
					$v_data['attendee_first_name'] = $row->attendee_first_name;
					$v_data['attendee_last_name'] = $row->attendee_last_name;
					$v_data['attendee_email'] = $row->attendee_email;
					$v_data['attendee_title'] = $row->attendee_title;
				}
				
				else
				{
					$v_data['attendee_first_name'] = '';
					$v_data['attendee_last_name'] = '';
					$v_data['attendee_email'] = '';
					$v_data['attendee_title'] = '';
				}
			}
		}
		$v_data['title'] = 'Edit';
		$v_data['meeting_id'] = $meeting_id;
		$data['content'] = $this->load->view('attendee/add_attendee', $v_data, true);
		
		$data['title'] = 'Add';
		$this->load->view('site/templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing attendee
	*	@param int $attendee_id
	*
	*/
	public function delete_attendee($attendee_id,$meeting_id)
	{
		//delete attendee
		if($this->attendee_model->delete_attendee($attendee_id))
		{
			$this->session->set_userdata('success_message', 'Attendee has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to delete attendee. Please try again');
		}
		redirect('all-attendees/'.$meeting_id);
	}
    
	/*
	*
	*	Activate an existing attendee
	*	@param int $attendee_id
	*
	*/
	public function activate_attendee($attendee_id,$meeting_id)
	{
		if($this->attendee_model->activate_attendee($attendee_id))
		{
			$this->session->set_userdata('success_message', 'Attendee activated successfully');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to activate attendee. Please try again');
		}
		redirect('all-attendees/'.$meeting_id);
	}
    
	/*
	*
	*	Deactivate an existing attendee
	*	@param int $attendee_id
	*
	*/
	public function deactivate_attendee($attendee_id,$meeting_id)
	{
		if($this->attendee_model->deactivate_attendee($attendee_id))
		{
			$this->session->set_userdata('success_message', 'Attendee deactivate successfully');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to deactivate attendee. Please try again');
		}
		redirect('all-attendees/'.$meeting_id);
	}
	public function add_meeting_attendee($meeting_id)
	{
		$this->form_validation->set_rules('attendee_title', 'Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('attendee_first_name', 'First name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('attendee_last_name', 'Last name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('attendee_email', 'Email', 'trim|required|valid_email|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->attendee_model->add_attendee($meeting_id))
			{
				$this->session->set_userdata('success_message', 'Attendee edited successfully');
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

	function send_attendee_notification($attendee_id,$meeting_id)
	{
			// get meeting details
			$meeting_detail = $this->events_model->get_event_name($meeting_id);
			if ($meeting_detail->num_rows() > 0)
			{
			    foreach ($meeting_detail->result() as $row)
			    {
			        $meeting_id = $row->meeting_id;
			        $meeting_date = $row->meeting_date;
			        $meeting_status = $row->meeting_status;
			        $end_date = $row->end_date;
			        $country_id = $row->country_id;
			        $country_name = $row->country_name;

			        $event_type_id = $row->event_type_id;
			        $event_type_name = $row->event_type_name;
			        $agency_id = $row->agency_id;

			        $agency_name = $row->agency_name;
			        $location = $row->location;
			        $subject = $row->subject;

			        $meeting_date = date('j M Y',strtotime($meeting_date));
			        $end_date = date('j M Y',strtotime($end_date));
			    }
			}
			
			// get facilitator details
			$attendee_array = $this->attendee_model->get_attendee($attendee_id);
			if ($attendee_array->num_rows() > 0)
			{
			    foreach ($attendee_array->result() as $attendee_row)
			    {
			    	$attendee_id = $attendee_row->attendee_id;
                    $attendee_first_name = $attendee_row->attendee_first_name;
                    $attendee_last_name = $attendee_row->attendee_last_name;
                    $attendee_title = $attendee_row->attendee_title;
                    $attendee_email = $attendee_row->attendee_email;
                    $attendee_status = $attendee_row->attendee_status;
			    }
			}
			// end of attendee details

			//  use this to create a message and send to the attendee 

			// message function here
			// end of message function here

			$data['result'] = 'success';

			echo json_encode($data);
	}

	function send_attendee_mass_notification($meeting_id)
	{
			// get meeting details
			$meeting_detail = $this->events_model->get_event_name($meeting_id);
			if ($meeting_detail->num_rows() > 0)
			{
			    foreach ($meeting_detail->result() as $row)
			    {
			        $meeting_id = $row->meeting_id;
			        $meeting_date = $row->meeting_date;
			        $meeting_status = $row->meeting_status;
			        $end_date = $row->end_date;
			        $country_id = $row->country_id;
			        $country_name = $row->country_name;

			        $event_type_id = $row->event_type_id;
			        $event_type_name = $row->event_type_name;
			        $agency_id = $row->agency_id;

			        $agency_name = $row->agency_name;
			        $location = $row->location;
			        $subject = $row->subject;

			        $meeting_date = date('j M Y',strtotime($meeting_date));
			        $end_date = date('j M Y',strtotime($end_date));
			    }
			}
			
			// get attendee details
			$attendee_array = $this->attendee_model->get_all_attendees_time($meeting_id);
			if ($attendee_array->num_rows() > 0)
			{
			    foreach ($attendee_array->result() as $attendee_row)
			    {
			    	$attendee_id = $attendee_row->attendee_id;
                    $attendee_first_name = $attendee_row->attendee_first_name;
                    $attendee_last_name = $attendee_row->attendee_last_name;
                    $attendee_title = $attendee_row->attendee_title;
                    $attendee_email = $attendee_row->attendee_email;
                    $attendee_status = $attendee_row->attendee_status;

                    // message function here

					// end of message function here
			    }
			}
			// end of attendee details


			

			$data['result'] = 'success';

			echo json_encode($data);
	}
}
?>