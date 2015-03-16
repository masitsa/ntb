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
	
	public function get_titles()
	{
		return $this->db->get('title');
	}
	
	public function add_facilitator()
	{
		$data = array
		(
			'facilitator_title' => $this->input->post('facilitator_title'),
			'facilitator_first_name' => $this->input->post('facilitator_first_name'),
			'facilitator_last_name' => $this->input->post('facilitator_last_name'),
			'facilitator_email' => $this->input->post('facilitator_email'),
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
}

?>