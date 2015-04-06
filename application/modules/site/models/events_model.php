<?php

class Events_model extends CI_Model 
{	
	/*
	*	Count all items from a table
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function count_items($table, $where, $limit = NULL)
	{
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		$this->db->from($table);
		$this->db->where($where);
		return $this->db->count_all_results();
	}
	/*
	*	Retrieve all orders
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_events($table, $where, $per_page, $page)
	{
		//retrieve all orders
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('meeting.meeting_id');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}

	/*
	*	Retrieve all orders
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_events()
	{
		//retrieve all orders
		$this->db->from('meeting');
		$this->db->select('*');
		$this->db->where('meeting_status = 0');
		$this->db->order_by('meeting_id','DESC');
		$query = $this->db->get();
		
		return $query;
	}
	/*
	*	Retrieve all orders
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_upcoming_meetings()
	{
		$todays_date = date("Y-m-d H:i:s");
		//retrieve all orders
		$this->db->from('meeting,event_type,country,agency');
		$this->db->select('*');
		$this->db->where('meeting.event_type_id = event_type.event_type_id AND agency.agency_id = meeting.agency_id AND country.country_id = meeting.country_id AND meeting.meeting_date > "'.$todays_date.'"');
		$this->db->order_by('meeting.meeting_date','ASC');
		$this->db->limit(5);
		$query = $this->db->get();
		
		return $query;
	}
	/*
	*	Retrieve all orders
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_mylatest_meetings()
	{
		$todays_date = date("Y-m-d H:i:s");
		//retrieve all orders
		$this->db->from('meeting,event_type,country,agency');
		$this->db->select('*');
		$this->db->where('meeting.event_type_id = event_type.event_type_id AND agency.agency_id = meeting.agency_id AND country.country_id = meeting.country_id AND meeting.created_by = '.$this->session->userdata('user_id'));
		$this->db->order_by('meeting.meeting_date','ASC');
		$this->db->limit(5);
		$query = $this->db->get();
		
		return $query;
	}
	public function get_total_meeting_attendees($meeting_id)
	{
		//retrieve all orders
		$this->db->from('attendee');
		$this->db->select('COUNT(*) AS total_attendee');
		$this->db->where('attendee_status = 0');
		$this->db->order_by('attendee_id','DESC');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$total_number = $key->total_attendee;
			}
		}
		else
		{
			$total_number = 0;
		}
		return $total_number;
	}
	public function get_total_meeting_comments($meeting_id)
	{
		//retrieve all orders
		$this->db->from('agenda_comment');
		$this->db->select('COUNT(*) AS total_comments');
		$this->db->where('agenda_comment_status = 0 AND meeting_id ='.$meeting_id);
		$this->db->order_by('agenda_comment_id','DESC');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$total_number = $key->total_comments;
			}
		}
		else
		{
			$total_number = 0;
		}
		return $total_number;
	}
	public function get_total_meeting_tasks($meeting_id)
	{
		//retrieve all orders
		$this->db->from('action_point');
		$this->db->select('COUNT(*) AS total_action_points');
		$this->db->where('action_point_status = 0 AND meeting_id ='.$meeting_id);
		$this->db->order_by('action_point_id','DESC');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$total_number = $key->total_action_points;
			}
		}
		else
		{
			$total_number = 0;
		}
		return $total_number;
	}
	public function get_all_countries()
	{
		//retrieve all orders
		$this->db->from('country');
		$this->db->select('*');
		$this->db->where('country_id > 0');
		$this->db->order_by('country_id','DESC');
		$query = $this->db->get();
		
		return $query;
	}
	public function get_all_assigned_tasks()
	{
		//retrieve all orders
		$this->db->from('action_point,meeting,priority_status,action_status,country,event_type,agency,attendee,users');
		$this->db->select('*');
		$this->db->where('meeting.meeting_id = action_point.meeting_id AND meeting.country_id = country.country_id AND action_status.action_status_id = action_point.actions_status_id AND agency.agency_id = meeting.agency_id AND meeting.event_type_id = event_type.event_type_id AND action_point.priority_status_id = priority_status.priority_status_id AND attendee.attendee_id = action_point.assigned_to AND users.user_id = '.$this->session->userdata('user_id').' AND attendee.user_id = '.$this->session->userdata('user_id'));
		$this->db->order_by('action_point.action_point_id','DESC');
		$query = $this->db->get();
		
		return $query;
	}
	public function get_tasks_for_review()
	{
		//retrieve all orders
		$this->db->from('action_point,meeting,priority_status,action_status,country,event_type,agency,attendee,users');
		$this->db->select('*');
		$this->db->where('meeting.meeting_id = action_point.meeting_id AND meeting.country_id = country.country_id AND action_status.action_status_id = action_point.actions_status_id AND agency.agency_id = meeting.agency_id AND meeting.event_type_id = event_type.event_type_id AND action_point.priority_status_id = priority_status.priority_status_id AND attendee.attendee_id = action_point.assigned_to AND users.user_id = attendee.user_id AND attendee.user_id <> '.$this->session->userdata('user_id'));
		$this->db->order_by('action_point.action_point_id','DESC');
		$query = $this->db->get();
		
		return $query;
	}
	public function get_all_agencies()
	{
		//retrieve all orders
		$this->db->from('agency');
		$this->db->select('*');
		$this->db->where('agency_id > 0');
		$this->db->order_by('agency_id','DESC');
		$query = $this->db->get();
		
		return $query;
	}

	public function get_event_name($meeting_id)
	{
		//retrieve all orders
		$this->db->from('meeting,country,event_type,agency');
		$this->db->select('*');
		$this->db->where('meeting.country_id = country.country_id AND meeting.event_type_id = event_type.event_type_id AND meeting.agency_id = agency.agency_id AND meeting_id ='.$meeting_id);
		$this->db->order_by('meeting_id','DESC');
		$query = $this->db->get();
		
		return $query;
	}
	public function get_all_event_types()
	{
		//retrieve all orders
		$this->db->from('event_type');
		$this->db->select('*');
		$this->db->where('event_type_id > 0');
		$this->db->order_by('event_type_id','DESC');
		$query = $this->db->get();
		
		return $query;
	}

	public function get_event_prefix($meeting_id)
	{
		//retrieve all orders
		$this->db->from('meeting');
		$this->db->select('COUNT(*) AS number');
		$this->db->where('parent_meeting ='.$meeting_id);
		$this->db->order_by('meeting_id','DESC');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			foreach($query->result() AS $key)
			{
				$number = $key->number;
			}
		}
		else
		{
			$number = 0;
		}
		$number = $number+1;
		return $number;
	}
	public function get_parent_meeting_name($meeting_id)
	{
		//retrieve all orders
		$this->db->from('meeting');
		$this->db->select('subject');
		$this->db->where('meeting_id ='.$meeting_id);
		$this->db->order_by('meeting_id','DESC');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			foreach($query->result() AS $key)
			{
				$subject = $key->subject;
			}
		}
		else
		{
			$subject = 'none';
		}
		return $subject;
	}
	public function get_all_members()
	{
		$this->db->from('users');
		$this->db->select('*');
		$this->db->where('user_level = 1');
		$this->db->order_by('user_id','DESC');
		$query = $this->db->get();
		
		return $query;
	}
	public function add_event()
	{
		$number_prefix = $this->get_event_prefix($this->input->post('meeting_id'));

		$subject = $this->input->post('subject')." (".$number_prefix.")";
		$data = array(
				'subject'=> $subject,
				'meeting_date'=>date('Y-m-d H:i:s',strtotime($this->input->post('meeting_date'))),
				'end_date'=> date('Y-m-d H:i:s',strtotime($this->input->post('end_date'))),
				'location'=>$this->input->post('location'),
				'country_id'=>$this->input->post('country_id'),
				'agency_id'=>$this->input->post('agency_id'),
				'event_type_id'=>$this->input->post('event_type_id'),
				'parent_meeting'=>$this->input->post('meeting_id'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('user_id')
			);
			
		if($this->db->insert('meeting', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function update_event($event_id)
	{
		$data = array(
				'subject'=>$this->input->post('subject'),
				'meeting_date'=>date('Y-m-d H:i a',strtotime($this->input->post('meeting_date'))),
				'end_date'=> date('Y-m-d H:i a',strtotime($this->input->post('end_date'))),
				'location'=>$this->input->post('location'),
				'country_id'=>$this->input->post('country_id'),
				'agency_id'=>$this->input->post('agency_id'),
				'event_type_id'=>$this->input->post('event_type_id')
			);
		$this->db->where('meeting_id', $event_id);
		if($this->db->update('meeting', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	public function mail_person($to, $from_user, $from_email, $subject = '(No subject)', $message = '')
   { 
	      $from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
	      $subject = "=?UTF-8?B?".base64_encode($subject)."?=";

	      $headers = "From: $from_user <$from_email>\r\n". 
	               "MIME-Version: 1.0" . "\r\n" . 
	               "Content-type: text/html; charset=UTF-8" . "\r\n"; 

	     return mail($to, $subject, $message, $headers); 
   }
	

	public function check_meeting_agenda($meeting_id)
	{
		//retrieve all orders
		$this->db->from('meeting_agenda');
		$this->db->select('*');
		$this->db->where('meeting_id = '.$meeting_id);
		$this->db->order_by('meeting_id','DESC');
		$query = $this->db->get();

		if($query->num_rows > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function update_meeting_agenda($meeting_id)
	{
		$trail_data = array(
		        		"meeting_id" => $meeting_id,
		        		"meeting_agenda" => $this->input->post('editor2')
			    		);

		$this->db->where('meeting_id',$meeting_id);
		if($this->db->update('meeting_agenda', $trail_data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function insert_meeting_agenda($meeting_id)
	{
		$trail_data = array(
		        		"meeting_id" => $meeting_id,
		        		"meeting_agenda" => $this->input->post('editor2')
			    		);

		if($this->db->insert('meeting_agenda', $trail_data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function check_meeting_notes($meeting_id)
	{
		//retrieve all orders
		$this->db->from('meeting_notes');
		$this->db->select('*');
		$this->db->where('meeting_id = '.$meeting_id);
		$this->db->order_by('meeting_id','DESC');
		$query = $this->db->get();

		if($query->num_rows > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function get_all_follow_up_meetings($meeting_id)
	{
		$this->db->from('meeting,country,event_type,agency');
		$this->db->select('*');
		$this->db->where('meeting.country_id = country.country_id AND event_type.event_type_id = meeting.event_type_id AND agency.agency_id = meeting.agency_id AND meeting.parent_meeting = '.$meeting_id);
		$this->db->order_by('meeting_id','DESC');
		$query = $this->db->get();
		return $query;
	}
	public function check_for_followup_meetings($meeting_id)
	{
		$this->db->from('meeting,country,event_type,agency');
		$this->db->select('*');
		$this->db->where('meeting.country_id = country.country_id AND event_type.event_type_id = meeting.event_type_id AND agency.agency_id = meeting.agency_id AND meeting.parent_meeting = '.$meeting_id);
		$this->db->order_by('meeting_id','DESC');
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			$row = $query->result();

			$meeting_id = $row[0]->meeting_id;

		}
		else
		{
			$meeting_id = 0;
		}
		return $meeting_id;
	}
	public function check_for_followup_next_meetings($meeting_id)
	{
		$this->db->from('meeting,country,event_type,agency');
		$this->db->select('*');
		$this->db->where('meeting.country_id = country.country_id AND event_type.event_type_id = meeting.event_type_id AND agency.agency_id = meeting.agency_id AND meeting.parent_meeting = '.$meeting_id);
		$this->db->order_by('meeting_id','DESC');
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			$row = $query->result();

			$meeting_id = $row[1]->meeting_id;
			if(empty($meeting_id))
			{
				$meeting_id = 0;
			}
			else
			{
				$meeting_id = $meeting_id;
			}

		}
		else
		{
			$meeting_id = 0;
		}
		return $meeting_id;
	}
	public function check_for_prev_followup_meetings($meeting_id,$parent_meeting)
	{
		$this->db->from('meeting,country,event_type,agency');
		$this->db->select('*');
		$this->db->where('meeting.country_id = country.country_id AND event_type.event_type_id = meeting.event_type_id AND agency.agency_id = meeting.agency_id AND meeting.parent_meeting = '.$meeting_id.' AND meeting.meeting_id < '.$meeting_id);
		$this->db->order_by('meeting_id','DESC');
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			$row = $query->result();

			$meeting_id = $row[0]->meeting_id;

		}
		else
		{
			$meeting_id = 0;
		}
		return $meeting_id;
		
	}
	public function check_for_prev_followup_meetings_parent($parent_meeting)
	{
		$this->db->from('meeting,country,event_type,agency');
		$this->db->select('*');
		$this->db->where('meeting.country_id = country.country_id AND event_type.event_type_id = meeting.event_type_id AND agency.agency_id = meeting.agency_id AND meeting.parent_meeting = '.$parent_meeting);
		$this->db->order_by('meeting_id','DESC');
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			$row = $query->result();

			$meeting_id = $row[1]->meeting_id;
			if(empty($meeting_id))
			{
				$meeting_id = 0;
			}
			else
			{
				$meeting_id = $meeting_id;
			}

		}
		else
		{
			$meeting_id = 0;
		}
		return $meeting_id;
		
	}
	public function check_if_followup_meetings($meeting_id)
	{
		$this->db->from('meeting,country,event_type,agency');
		$this->db->select('*');
		$this->db->where('meeting.country_id = country.country_id AND event_type.event_type_id = meeting.event_type_id AND agency.agency_id = meeting.agency_id AND meeting.meeting_id = '.$meeting_id);
		$this->db->order_by('meeting_id','DESC');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$row = $query->result();

			$parent_meeting = $row[0]->parent_meeting;


		}
		else
		{
			$parent_meeting = 0;
		}
		return $parent_meeting;

	}
	public function update_meeting_notes($meeting_id)
	{
		$trail_data = array(
		        		"meeting_id" => $meeting_id,
		        		"notes" => $this->input->post('editor1')
			    		);

		$this->db->where('meeting_id',$meeting_id);
		if($this->db->update('meeting_notes', $trail_data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function insert_meeting_notes($meeting_id)
	{
		$trail_data = array(
		        		"meeting_id" => $meeting_id,
		        		"notes" => $this->input->post('editor1')
			    		);

		if($this->db->insert('meeting_notes', $trail_data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}