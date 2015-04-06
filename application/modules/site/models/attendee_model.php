<?php

class Attendee_model extends CI_Model 
{
	public function get_all_attendees($table, $where, $per_page, $page, $limit = NULL, $order_by = 'created', $order_method = 'DESC')
	{
		$this->db->from($table);
		$this->db->select('attendee.*');
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
	public function get_all_attendees_time($meeting_id)
	{
		$this->db->from('attendee');
		$this->db->select('attendee.*');
		$this->db->where('attendee_id > 0 AND meeting_id ='.$meeting_id);
		$this->db->order_by('attendee_id','DESC');
		
		$query = $this->db->get();
		
		
		return $query;
	}
	
	public function get_active_attendees($meeting_id)
	{
		$this->db->from('attendee');
		$this->db->select('attendee.*');
		$this->db->where('attendee_status = 0 AND meeting_id ='.$meeting_id);
		$this->db->order_by('attendee_id','DESC');
		
		$query = $this->db->get();
		
		
		return $query;
	}
	
	public function get_titles()
	{
		return $this->db->get('title');
	}
	public function get_all_member_details($user_id)
	{
		$this->db->from('users');
		$this->db->select('*');
		$this->db->where('user_id ='.$user_id);
		$this->db->order_by('user_id','DESC');
		$query = $this->db->get();
		
		return $query;
	}
	
	public function add_attendee($meeting_id)
	{
		$attendee_type = $this->input->post('attendee_type');

		if($attendee_type == 1)
		{
			// get the member details
			$query = $this->get_all_member_details($this->input->post('member_id'));
			if($query->num_rows > 0)
			{
				foreach ($query->result() as $value) {
					# code...
					$first_name = $value->first_name;
					$last_name = $value->other_names;
					$email = $value->email;
					$gender_id = $value->gender_id;

					if($gender_id == 1)
					{
						$gender = 'Mr.';
					}
					else
					{
						$gender = 'Mrs.';
					}

				}
			}
			// this is not a member
			$data = array
			(
				'attendee_title' => $gender,
				'attendee_first_name' => $first_name,
				'attendee_last_name' => $last_name,
				'attendee_email' => $email,
				'meeting_id' => $meeting_id,
				'user_id' => $this->input->post('member_id'),
				'created' => date('Y-m-d H:i:s')
			);
		}
		else
		{
			// this is not a member
			$data = array
			(
				'attendee_title' => $this->input->post('attendee_title'),
				'attendee_first_name' => $this->input->post('attendee_first_name'),
				'attendee_last_name' => $this->input->post('attendee_last_name'),
				'attendee_email' => $this->input->post('attendee_email'),
				'meeting_id' => $meeting_id,
				'created' => date('Y-m-d H:i:s')
			);
			
			
		}
			if($this->db->insert('attendee', $data))
			{
				return TRUE;
			}
			
			else
			{
				return FALSE;
			}
		
	}
	
	public function delete_attendee($attendee_id)
	{
		$this->db->where('attendee_id', $attendee_id);
		if($this->db->delete('attendee'))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
	
	public function get_attendee($attendee_id)
	{
		$this->db->where('attendee_id', $attendee_id);
		return $this->db->get('attendee');
	}
	
	public function edit_attendee($attendee_id)
	{
		$data = array
		(
			'attendee_title' => $this->input->post('attendee_title'),
			'attendee_first_name' => $this->input->post('attendee_first_name'),
			'attendee_last_name' => $this->input->post('attendee_last_name'),
			'attendee_email' => $this->input->post('attendee_email'),
		);
		
		$this->db->where('attendee_id', $attendee_id);
		if($this->db->update('attendee', $data))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated attendee
	*	@param int $attendee_id
	*
	*/
	public function activate_attendee($attendee_id)
	{
		$data = array(
				'attendee_status' => 0
			);
		$this->db->where('attendee_id', $attendee_id);
		
		if($this->db->update('attendee', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated attendee
	*	@param int $attendee_id
	*
	*/
	public function deactivate_attendee($attendee_id)
	{
		$data = array(
				'attendee_status' => 1
			);
		$this->db->where('attendee_id', $attendee_id);
		
		if($this->db->update('attendee', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	public function send_meeting_action_email($action_status,$meeting_id,$attendee_id,$action_point_id)
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
		// end of action point functiion
		if($action_status == 1)
		{
			// means that you accept receipt of the work done
			$subject = "Status update for ".$subject2." meeting's action point ";
			$message = '
					<p>The action point for <strong>'.$subject2.'</strong> meeting that was scheduled for '.$action_date.', has been successfully received. Thank you for feedback</p>
					';
			$sender_email = "mugoken@gmail.com";
			$shopping = "";
			$from = "Ken";
		}
		else if($status == 2)
		{
			// email the person that you have completed the task
			$subject = "Status update for ".$subject2." meeting's action point ";
			$message = '
					<p>The action point for <strong>'.$subject2.'</strong> meeting that was scheduled for '.$action_date.', has been successfully completed. </p> <p> Thank you for your participation</p>
					';
			$sender_email = "mugoken@gmail.com";
			$shopping = "";
			$from = "Ken";
		}
		else
		{
			// email for reminder that the work is undone
			$subject = "Reminder for ".$subject2." meeting's action point ";
			$message = '
					<p> Plese be reminded of the action point assigned to you during the <strong>'.$subject2.'</strong> meeting. </p>
					<p> The details to this action point is as follows :</p>
					<p> '.$action_point_notes.'</p>
					<p> This work is due on the '.$action_date.'. your feedback will be highly appretiated. </p>
					<p> Thank you</p>
					';
			$sender_email = "mugoken@gmail.com";
			$shopping = "";
			$from = "Ken";
		}



		
		$button = '';
		$response = $this->email_model->send_mandrill_mail($attendee_email, "Hi ".$attendee_first_name, $subject, $message, $sender_email, $shopping, $from, $button);
		
		return $response;
		
	}
	/*
	*
	*	Meeting reminder Email
	*
	*/
	public function send_meeting_attendee_reminder_email($meeting_id, $attendee_id) 
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
		
		$subject = "Reminder for ".$subject2;
		$message = '
				<p>Please remember your attendance in our event <strong>'.$subject2.'</strong> which is scheduled for '.$meeting_date.'. The event will take place at '.$location.'. Kindly keep time</p>
				';
		$sender_email = "mugoken@gmail.com";
		$shopping = "";
		$from = "Ken";
		
		$button = '<a href='.base_url().'/meetings/'.$attendee_email.'';
		$response = $this->email_model->send_mandrill_mail($attendee_email, "Hi ".$attendee_first_name, $subject, $message, $sender_email, $shopping, $from, $button);
		
		return $response;
	}
}

?>