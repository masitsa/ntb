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
		$this->db->order_by('meeting_id');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
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
	public function add_event()
	{
		$data = array(
				'subject'=>$this->input->post('subject'),
				'meeting_date'=>date('Y-m-d H:i:s',strtotime($this->input->post('meeting_date'))),
				'end_date'=> date('Y-m-d H:i:s',strtotime($this->input->post('end_date'))),
				'location'=>$this->input->post('location'),
				'country_id'=>$this->input->post('country_id'),
				'agency_id'=>$this->input->post('agency_id'),
				'event_type_id'=>$this->input->post('event_type_id'),
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
	
}