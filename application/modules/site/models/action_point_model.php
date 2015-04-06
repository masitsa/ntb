<?php

class Action_point_model extends CI_Model 
{
	public function get_all_action_points($table, $where, $per_page, $page, $limit = NULL, $order_by = 'created', $order_method = 'DESC')
	{
		$this->db->from($table);
		$this->db->select('action_point.*, priority_status.priority_status_name, action_status.action_status_name');
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
	public function get_all_action_points_time($meeting_id)
	{
		$this->db->from('action_point,priority_status,action_status,attendee');
		$this->db->select('attendee.attendee_first_name,attendee.attendee_last_name,attendee.attendee_title,action_point.action_point_notes,action_point.assigned_to,action_point.meeting_id,action_point.action_point_status,action_point.action_point_id,action_point.created,action_point.priority_status_id,action_point.actions_status_id,priority_status.priority_status_name, action_status.action_status_name');
		$this->db->where('action_point.priority_status_id = priority_status.priority_status_id AND action_status.action_status_id = action_point.actions_status_id AND attendee.attendee_id = action_point.assigned_to  AND action_point.meeting_id ='.$meeting_id);
		$this->db->order_by('action_point.action_point_id','DESC');
		$query = $this->db->get();
		return $query;
	}
	
	public function get_action_statuses()
	{
		return $this->db->get('action_status');
	}
	
	public function get_priority_statuses()
	{
		return $this->db->get('priority_status');
	}
	
	public function add_action_point($meeting_id)
	{
		$data = array
		(
			'assigned_to' => $this->input->post('assigned_to'),
			'priority_status_id' => $this->input->post('priority_status_id'),
			'actions_status_id' => $this->input->post('actions_status_id'),
			'action_point_notes' => $this->input->post('action_point_notes'),
			'meeting_id' => $meeting_id,
			'created' => date('Y-m-d H:i:s')
		);
		
		if($this->db->insert('action_point', $data))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
	
	public function delete_action_point($action_point_id)
	{
		$this->db->where('action_point_id', $action_point_id);
		if($this->db->delete('action_point'))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
	
	public function get_action_point($action_point_id)
	{
		$this->db->where('action_point_id', $action_point_id);
		return $this->db->get('action_point');
	}
	
	public function edit_action_point($action_point_id)
	{
		$data = array
		(
			'assigned_to' => $this->input->post('assigned_to'),
			'priority_status_id' => $this->input->post('priority_status_id'),
			'actions_status_id' => $this->input->post('actions_status_id'),
			'action_point_notes' => $this->input->post('action_point_notes')
		);
		
		$this->db->where('action_point_id', $action_point_id);
		if($this->db->update('action_point', $data))
		{
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
	public function activate_action_point($action_point_id)
	{
		$data = array(
				'action_point_status' => 0
			);
		$this->db->where('action_point_id', $action_point_id);
		
		if($this->db->update('action_point', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated action_point
	*	@param int $action_point_id
	*
	*/
	public function deactivate_action_point($action_point_id)
	{
		$data = array(
				'action_point_status' => 1
			);
		$this->db->where('action_point_id', $action_point_id);
		
		if($this->db->update('action_point', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	public function mark_as_complete($action_point_id)
	{
		$trail_data = array(
		        		"completed_status" => 2
			    		);

		$this->db->where('action_point_id',$action_point_id);
		if($this->db->update('action_point', $trail_data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function send_for_review($action_point_id,$attendee_id,$meeting_id)
	{
		$trail_data = array(
		        		"completed_status" => 1
			    		);

		$this->db->where('action_point_id',$action_point_id);
		if($this->db->update('action_point', $trail_data))
		{
			// get attendee details
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

	                // message function here

					// end of message function here
			    }
			}
			// end of attendee details
			// get user details 

			$user_array = $this->user_model->get_user($this->session->userdata('user_id'));
			if($user_array->num_rows() > 0)
			{
				foreach ($user_array->result() as $key) {
					# code...
					$user_email = $key->email;
					$first_name = $key->first_name;
					$other_names = $key->other_names;
				}
			}

			// start of action point function 
			$action_point_array = $this->action_point_model->get_action_point($action_point_id);
			if($action_point_array->num_rows() > 0)
			{
				foreach ($action_point_array->result() as $action_point_row)
			    {
			    	$action_point_id = $action_point_row->action_point_id;
	                $action_point_notes = $action_point_row->action_point_notes;
	                $action_date = $action_point_row->action_date;

			    }
			}

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

			// means that you accept receipt of the work done
			$subject = "Status update for ".$subject2." meeting's action point ";
			$message = '
					<p>The action point for <strong>'.$subject2.'</strong> meeting that was scheduled for '.$action_date.', has been sent for review. Please mark the task as complete</p>
					';
			$sender_email = $attendee_email;
			$shopping = "";
			$from = "".$attendee_first_name."";
			$button = '';
			$response = $this->email_model->send_mandrill_mail($user_email, "Hi ".$first_name, $subject, $message, $sender_email, $shopping, $from, $button);
		
		}
		else
		{
			return FALSE;
		}

	}
}

?>