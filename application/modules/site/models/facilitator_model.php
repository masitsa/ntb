<?php

class Facilitator_model extends CI_Model 
{
	public function get_all_facilitators($table, $where, $per_page, $page, $limit = NULL, $order_by = 'created', $order_method = 'DESC')
	{
		$this->db->from($table);
		$this->db->select('facilitator.*');
		$this->db->where($where);
		$this->db->order_by($order_by, $order_method);
		
		if(isset($limit))
		{
			$query = $this->db->get('', $limit);
		}
		
		else
		{
			$query = $this->db->get('', $per_page, $page);
		}
		
		return $query;
	}
	public function get_all_facilitators_time($meeting_id)
	{
		$this->db->from('facilitator');
		$this->db->select('facilitator.*');
		$this->db->where('facilitator_id > 0 AND meeting_id = '.$meeting_id);
		$this->db->order_by('facilitator_id', 'DESC');
		
		$query = $this->db->get();
		
		
		return $query;
	}
	
	public function get_titles()
	{
		return $this->db->get('title');
	}
	
	public function add_facilitator($meeting_id)
	{
		$data = array
		(
			'facilitator_title' => $this->input->post('facilitator_title'),
			'facilitator_first_name' => $this->input->post('facilitator_first_name'),
			'facilitator_last_name' => $this->input->post('facilitator_last_name'),
			'facilitator_email' => $this->input->post('facilitator_email'),
			'meeting_id' => $meeting_id,
			'created' => date('Y-m-d H:i:s')
		);
		
		if($this->db->insert('facilitator', $data))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
	
	public function delete_facilitator($facilitator_id)
	{
		$this->db->where('facilitator_id', $facilitator_id);
		if($this->db->delete('facilitator'))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
	
	public function get_facilitator($facilitator_id)
	{
		$this->db->where('facilitator_id', $facilitator_id);
		return $this->db->get('facilitator');
	}
	public function get_meeting_facilitator($meeting_id)
	{
		$this->db->where('meeting_id = '.$meeting_id.' AND facilitator_status = 1');
		return $this->db->get('facilitator');
	}
	
	public function edit_facilitator($facilitator_id)
	{
		$data = array
		(
			'facilitator_title' => $this->input->post('facilitator_title'),
			'facilitator_first_name' => $this->input->post('facilitator_first_name'),
			'facilitator_last_name' => $this->input->post('facilitator_last_name'),
			'facilitator_email' => $this->input->post('facilitator_email'),
		);
		
		$this->db->where('facilitator_id', $facilitator_id);
		if($this->db->update('facilitator', $data))
		{
			$subject ='Invitation to be a facilitator in our coming meeting';
			
			$from ='TNC Admin';
			$from_email = 'info@tnc.com';
			$message = 'Hello '.$this->input->post('facilitator_first_name').', <br>
						Trust this email find you well, We would like to invite you to be the facilitator in the comming meeting that we shall have. <br>
						Regards <br/>
						Administration TNC';
						mail($this->input->post('facilitator_email'), $subject, $message);
			// $this->events_model->mail_person($this->input->post('facilitator_email'),$from,$from_email,$subject,$message);
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated facilitator
	*	@param int $facilitator_id
	*
	*/
	public function activate_facilitator($facilitator_id)
	{
		$data = array(
				'facilitator_status' => 1
			);
		$this->db->where('facilitator_id', $facilitator_id);
		
		if($this->db->update('facilitator', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated facilitator
	*	@param int $facilitator_id
	*
	*/
	public function deactivate_facilitator($facilitator_id)
	{
		$data = array(
				'facilitator_status' => 0
			);
		$this->db->where('facilitator_id', $facilitator_id);
		
		if($this->db->update('facilitator', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
    
	/*
	*
	*	Meeting reminder Email
	*
	*/
	public function send_meeting_reminder_email($meeting_id, $facilitator_id) 
	{
		$this->load->model('site/email_model');
		$this->load->library('Mandrill', $this->config->item('mandrill_key'));
		
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
				$subject2 = $row->subject;

				$meeting_date = date('j M Y',strtotime($meeting_date));
				$end_date = date('j M Y',strtotime($end_date));
			}
		}
		
		// get facilitator details
		$facilitator_array = $this->facilitator_model->get_facilitator($facilitator_id);
		if ($facilitator_array->num_rows() > 0)
		{
			foreach ($facilitator_array->result() as $facilitator_row)
			{
				$facilitator_id = $facilitator_row->facilitator_id;
				$facilitator_first_name = $facilitator_row->facilitator_first_name;
				$facilitator_last_name = $facilitator_row->facilitator_last_name;
				$facilitator_title = $facilitator_row->facilitator_title;
				$facilitator_email = $facilitator_row->facilitator_email;
				$facilitator_status = $facilitator_row->facilitator_status;
			}
		}
		
		$subject = "Reminder for ".$subject2;
		$message = '
				<p>Please remember your attendance in our event <strong>'.$subject2.'</strong> which is scheduled for '.$meeting_date.'. The event will take place at '.$location.'. Kindly keep time</p>
				';
		$sender_email = "mugoken@gmail.com";
		$shopping = "";
		$from = "Ken";
		
		$button = '';
		$response = $this->email_model->send_mandrill_mail($facilitator_email, "Hi ".$facilitator_first_name, $subject, $message, $sender_email, $shopping, $from, $button);
		
		return $response;
	}
}

?>