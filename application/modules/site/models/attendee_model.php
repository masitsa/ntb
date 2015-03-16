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
	
	public function get_titles()
	{
		return $this->db->get('title');
	}
	
	public function add_attendee()
	{
		$data = array
		(
			'attendee_title' => $this->input->post('attendee_title'),
			'attendee_first_name' => $this->input->post('attendee_first_name'),
			'attendee_last_name' => $this->input->post('attendee_last_name'),
			'attendee_email' => $this->input->post('attendee_email'),
			'created' => date('Y-m-d H:i:s')
		);
		
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
	
	/*
	*	Deactivate an activated attendee
	*	@param int $attendee_id
	*
	*/
	public function deactivate_attendee($attendee_id)
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
}

?>