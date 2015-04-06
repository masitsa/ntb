<?php

class Attachments_model extends CI_Model 
{
	
    public function delete_attachment($attachment_id)
	{
		$this->db->where('file_id', $attachment_id);
		if($this->db->delete('files'))
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
	public function activate_attachment($attachment_id)
	{
		$data = array(
				'file_delete' => 0
			);
		$this->db->where('file_id', $attachment_id);
		
		if($this->db->update('files', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated attachment
	*	@param int $attachment_id
	*
	*/
	public function deactivate_attachment($attachment_id)
	{
		$data = array(
				'file_delete' => 1
			);
		$this->db->where('file_id', $attachment_id);
		
		if($this->db->update('files', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
}