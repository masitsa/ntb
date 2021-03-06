<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once "./application/modules/site/controllers/account.php";
class Action_point extends account 
{	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('site_model');
		$this->load->model('action_point_model');
		$this->load->model('site/attendee_model');
		$this->load->model('admin/users_model');
		$this->load->model('site/events_model');
		$this->load->model('admin/users_model');
	}
    
	/*
	*
	*	List action points
	*
	*/
	public function all_action_points($meeting_id = NULL) 
	{
		$where = 'action_point.priority_status_id = priority_status.priority_status_id AND action_point.actions_status_id = action_status.action_status_id AND action_point.meeting_id ='.$meeting_id;
		$table = 'action_point, priority_status, action_status';
		$limit = NULL;
		
		//pagination
		$segment = 3;
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-action-points/'.$meeting_id;
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
		$v_data['action_points'] = $this->action_point_model->get_all_action_points($table, $where, $config["per_page"], $page, $limit);
		
		$data['content'] = $this->load->view('action_point/all_action_points', $v_data, true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
    
    /*
	*
	*	Add action point
	*
	*/
	public function add_meeting_action_point($meeting_id) 
	{
		
		$this->form_validation->set_rules('assigned_to', 'Assigned to', 'trim|required|xss_clean');
		$this->form_validation->set_rules('priority_status_id', 'Priority', 'trim|required|xss_clean');
		$this->form_validation->set_rules('actions_status_id', 'Action', 'trim|required|xss_clean');
		$this->form_validation->set_rules('action_point_notes', 'Notes', 'trim|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->action_point_model->add_action_point($meeting_id))
			{
				$data['result'] = 'Action point details has been added successfully';
			}
			else
			{
				$data['result'] = 'Something went wrong when adding the action point details. Please try again';
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
	*	Add action point
	*
	*/
	public function add_action_point($meeting_id) 
	{
		//initialize required variables
		$v_data['assigned_to_error'] = '';
		$v_data['priority_status_id_error'] = '';
		$v_data['actions_status_id_error'] = '';
		$v_data['action_point_notes_error'] = '';
		$v_data['priority_status_query'] = $this->action_point_model->get_priority_statuses();
		$v_data['action_status_query'] = $this->action_point_model->get_action_statuses();
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('assigned_to', 'Assigned to', 'trim|required|xss_clean');
		$this->form_validation->set_rules('priority_status_id', 'Priority', 'trim|required|xss_clean');
		$this->form_validation->set_rules('actions_status_id', 'Action', 'trim|required|xss_clean');
		$this->form_validation->set_rules('action_point_notes', 'Notes', 'trim|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->action_point_model->add_action_point($meeting_id))
			{
				$this->session->set_userdata('success_message', 'Action point added successfully');
				redirect('all-action-points/'.$meeting_id);
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Unable to add action point. Please try again');
			}
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['assigned_to_error'] = form_error('assigned_to');
				$v_data['priority_status_id_error'] = form_error('priority_status_id');
				$v_data['actions_status_id_error'] = form_error('actions_status_id');
				$v_data['action_point_notes_error'] = form_error('action_point_notes');
				
				//repopulate fields
				$v_data['assigned_to'] = set_value('assigned_to');
				$v_data['priority_status_id'] = set_value('priority_status_id');
				$v_data['actions_status_id'] = set_value('actions_status_id');
				$v_data['action_point_notes'] = set_value('action_point_notes');
			}
			
			//populate form data on initial load of page
			else
			{
				$v_data['assigned_to'] = '';
				$v_data['priority_status_id'] = '';
				$v_data['actions_status_id'] = '';
				$v_data['action_point_notes'] = '';
			}
		}
		
		$v_data['title'] = 'Add';
		$v_data['meeting_id'] = $meeting_id;
		$data['content'] = $this->load->view('action_point/add_action_point', $v_data, true);
		
		$data['title'] = 'Add';
		$this->load->view('site/templates/general_page', $data);
	}
    
	/*
	*
	*	Edit action point
	*
	*/
	public function edit_meeting_action_point($action_point_id,$meeting_id)
	{
		$this->form_validation->set_rules('assigned_to', 'Assigned to', 'trim|required|xss_clean');
		$this->form_validation->set_rules('priority_status_id', 'Priority', 'trim|required|xss_clean');
		$this->form_validation->set_rules('actions_status_id', 'Action', 'trim|required|xss_clean');
		$this->form_validation->set_rules('action_point_notes', 'Notes', 'trim|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->action_point_model->edit_action_point($action_point_id))
			{
				$data['result'] = 'Action point details has been updated successfully';
			}
			else
			{
				$data['result'] = 'Something went wrong when updating Action point details. Please try again';
			}
		}
		else
		{
			$data['result'] = 'Ensure that all details have been entered';
		}
		echo json_encode($data);
	}
	public function edit_action_point($action_point_id,$meeting_id) 
	{
		//initialize required variables
		$v_data['assigned_to_error'] = '';
		$v_data['priority_status_id_error'] = '';
		$v_data['actions_status_id_error'] = '';
		$v_data['action_point_notes_error'] = '';
		$v_data['priority_status_query'] = $this->action_point_model->get_priority_statuses();
		$v_data['action_status_query'] = $this->action_point_model->get_action_statuses();
		$action_point_query = $this->action_point_model->get_action_point($action_point_id);
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('assigned_to', 'Assigned to', 'trim|required|xss_clean');
		$this->form_validation->set_rules('priority_status_id', 'Priority', 'trim|required|xss_clean');
		$this->form_validation->set_rules('actions_status_id', 'Action', 'trim|required|xss_clean');
		$this->form_validation->set_rules('action_point_notes', 'Notes', 'trim|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->action_point_model->edit_action_point($action_point_id))
			{
				$this->session->set_userdata('success_message', 'Action point edited successfully');
				redirect('all-action-points/'.$meeting_id);
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Unable to add action point. Please try again');
			}
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['assigned_to_error'] = form_error('assigned_to');
				$v_data['priority_status_id_error'] = form_error('priority_status_id');
				$v_data['actions_status_id_error'] = form_error('actions_status_id');
				$v_data['action_point_notes_error'] = form_error('action_point_notes');
				
				//repopulate fields
				$v_data['assigned_to'] = set_value('assigned_to');
				$v_data['priority_status_id'] = set_value('priority_status_id');
				$v_data['actions_status_id'] = set_value('actions_status_id');
				$v_data['action_point_notes'] = set_value('action_point_notes');
			}
			
			//populate form data on initial load of page
			else
			{
				if($action_point_query->num_rows() > 0)
				{
					$row = $action_point_query->row();
					
					$v_data['assigned_to'] = $row->assigned_to;
					$v_data['priority_status_id'] = $row->priority_status_id;
					$v_data['actions_status_id'] = $row->actions_status_id;
					$v_data['action_point_notes'] = $row->action_point_notes;
				}
				
				else
				{
					$v_data['assigned_to'] = '';
					$v_data['priority_status_id'] = '';
					$v_data['actions_status_id'] = '';
					$v_data['action_point_notes'] = '';
				}
			}
		}
		$v_data['title'] = 'Edit';
		$v_data['meeting_id'] = $meeting_id;
		$data['content'] = $this->load->view('action_point/add_action_point', $v_data, true);
		
		$data['title'] = 'Add';
		$this->load->view('site/templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing category
	*	@param int $category_id
	*
	*/
	public function delete_action_point($action_point_id,$meeting_id)
	{
		//delete action point
		if($this->action_point_model->delete_action_point($action_point_id))
		{
			$this->session->set_userdata('success_message', 'Action point has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to delete action point. Please try again');
		}
		redirect('all-action-points/'.$meeting_id);
	}
	
	public function meeting_action_points($meeting_id)
	{
		$data = array('meeting_id'=>$meeting_id);
		$this->load->view('action_point/show_action_points',$data);
	}
	/*
	*
	*	Activate an existing facilitator
	*	@param int $facilitator_id
	*
	*/
	public function activate_action_point($action_point_id,$meeting_id)
	{
		if($this->action_point_model->activate_action_point($action_point_id))
		{
			$this->session->set_userdata('success_message', 'action_point activated successfully');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to activate action_point. Please try again');
		}
	}
    
	/*
	*
	*	Deactivate an existing action_point
	*	@param int $action_point_id
	*
	*/
	public function deactivate_action_point($action_point_id,$meeting_id)
	{
		
			if($this->action_point_model->deactivate_action_point($action_point_id))
			{
				// $this->session->set_userdata('success_message', 'action_point deactivate successfully');

			}
			
			else
			{
				// $this->session->set_userdata('error_message', 'Unable to deactivate action_point. Please try again');
			}
		
	}
}
?>