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
		$this->db->from('action_point,priority_status,action_status');
		$this->db->select('action_point.*, priority_status.priority_status_name, action_status.action_status_name');
		$this->db->where('action_point.priority_status_id = priority_status.priority_status_id AND action_status.action_status_id = action_point.actions_status_id AND meeting_id ='.$meeting_id);
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
	
	public function add_action_point()
	{
		$data = array
		(
			'assigned_to' => $this->input->post('assigned_to'),
			'priority_status_id' => $this->input->post('priority_status_id'),
			'actions_status_id' => $this->input->post('actions_status_id'),
			'action_point_notes' => $this->input->post('action_point_notes'),
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
}

?>