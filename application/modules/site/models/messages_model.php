<?php
class Messages_model extends CI_Model 
{
	public function get_all_messages($table, $where, $per_page, $page, $limit = NULL, $order_by = 'created', $order_method = 'DESC')
	{
		$this->db->from($table);
		$this->db->select('*');
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
	
	public function get_receiver_id($receiver_web_name)
	{
		$user_username = str_replace("-", " ", $receiver_web_name);
		
		$this->db->where('user_username', $user_username);
		$query = $this->db->get('users');
		
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$user_id = $row->user_id;
		}
		
		else
		{
			$user_id = NULL;
		}
		
		return $user_id;
	}
}