<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once "./application/modules/site/controllers/account.php";
class Attachments extends account 
{	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('site/site_model');
		$this->load->model('site/attachments_model');
		$this->load->model('site/attendee_model');
		$this->load->model('admin/users_model');
		$this->load->model('site/events_model');

	}
	/*
	*
	*	List action points
	*
	*/
	public function all_attachments($meeting_id = NULL) 
	{
		$where = 'attachments.priority_status_id = priority_status.priority_status_id AND attachments.actions_status_id = action_status.action_status_id AND attachments.meeting_id ='.$meeting_id;
		$table = 'attachments, priority_status, action_status';
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
		$v_data['attachments'] = $this->attachments_model->get_all_attachments($table, $where, $config["per_page"], $page, $limit);
		
		$data['content'] = $this->load->view('attachments/all_attachments', $v_data, true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Add action point
	*
	*/
	public function add_attachments($meeting_id) 
	{
		//initialize required variables
		$v_data['assigned_to_error'] = '';
		$v_data['priority_status_id_error'] = '';
		$v_data['actions_status_id_error'] = '';
		$v_data['attachments_notes_error'] = '';
		$v_data['priority_status_query'] = $this->attachments_model->get_priority_statuses();
		$v_data['action_status_query'] = $this->attachments_model->get_action_statuses();
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('assigned_to', 'Assigned to', 'trim|required|xss_clean');
		$this->form_validation->set_rules('priority_status_id', 'Priority', 'trim|required|xss_clean');
		$this->form_validation->set_rules('actions_status_id', 'Action', 'trim|required|xss_clean');
		$this->form_validation->set_rules('attachments_notes', 'Notes', 'trim|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->attachments_model->add_attachments($meeting_id))
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
				$v_data['attachments_notes_error'] = form_error('attachments_notes');
				
				//repopulate fields
				$v_data['assigned_to'] = set_value('assigned_to');
				$v_data['priority_status_id'] = set_value('priority_status_id');
				$v_data['actions_status_id'] = set_value('actions_status_id');
				$v_data['attachments_notes'] = set_value('attachments_notes');
			}
			
			//populate form data on initial load of page
			else
			{
				$v_data['assigned_to'] = '';
				$v_data['priority_status_id'] = '';
				$v_data['actions_status_id'] = '';
				$v_data['attachments_notes'] = '';
			}
		}
		
		$v_data['title'] = 'Add';
		$v_data['meeting_id'] = $meeting_id;
		$data['content'] = $this->load->view('attachments/add_attachments', $v_data, true);
		
		$data['title'] = 'Add';
		$this->load->view('site/templates/general_page', $data);
	}
    
	
    	/*
	*
	*	Delete an existing category
	*	@param int $category_id
	*
	*/
	public function activate_attachment($attachment_id,$meeting_id)
	{
		//activate action point
		if($this->attachments_model->activate_attachment($attachment_id))
		{

		}
		
		else
		{

		}
	}
		/*
	*
	*	Delete an existing category
	*	@param int $category_id
	*
	*/
	public function deactivate_attachment($attachment_id,$meeting_id)
	{
		//activate action point
		if($this->attachments_model->deactivate_attachment($attachment_id))
		{

		}
		
		else
		{

		}
	}

	/*
	*
	*	Delete an existing category
	*	@param int $category_id
	*
	*/
	public function delete_attachment($attachments_id,$meeting_id)
	{
		//delete action point
		if($this->attachments_model->delete_attachment($attachments_id))
		{
			$this->session->set_userdata('success_message', 'Action point has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to delete action point. Please try again');
		}
		
	}
	public function add_meeting_attachments($meeting_id)
	{

		$this->form_validation->set_rules('assigned_to', 'Assigned to', 'trim|required|xss_clean');
		$this->form_validation->set_rules('priority_status_id', 'Priority', 'trim|required|xss_clean');
		$this->form_validation->set_rules('actions_status_id', 'Action', 'trim|required|xss_clean');
		$this->form_validation->set_rules('attachments_notes', 'Notes', 'trim|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->attachments_model->add_attachments($meeting_id))
			{
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
	public function meeting_attachments($meeting_id)
	{
		$data = array('meeting_id'=>$meeting_id);
		$this->load->view('attachments/show_attachments',$data);
	}
}