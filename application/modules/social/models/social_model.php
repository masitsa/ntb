<?php

class Social_model extends CI_Model 
{


	public function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
 
    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }
 
    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();
 
    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Create temp time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }
 
      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }
    
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
 break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
 // Add s if value is not 1
 if ($value != 1) {
   $interval .= "s";
 }
 // Add value and interval to times array
 $times[] = $value . " " . $interval;
 $count++;
      }
    }
 
    // Return string with times
    return implode(", ", $times);
  }
  public function get_all_meeting_comments($meeting_id)
  {
  	$this->db->from('agenda_comment');
  	$this->db->select('*');
  	$this->db->where('meeting_id ='.$meeting_id);
  	$this->db->order_by('agenda_comment_id','DESC');
  	
  	$query = $this->db->get();
	
	
	 return $query;
  }
  public function get_attendee_detail($email,$meeting_id)
  {
  	$this->db->from('attendee');
	$this->db->select('*');
	$this->db->where('attendee_email = "'.$email.'" AND meeting_id ='.$meeting_id);
	$this->db->order_by('attendee_id','DESC');
	
	$query = $this->db->get();
	return $query;
  }
  public function add_meeting_agenda_comment($meeting_id)
  {
    // this is not a member
      $data = array
      (
        'agenda_comment_user' => $this->input->post('attendee_first_name'),
        'agenda_comment_description' => $this->input->post('attendee_comment'),
        'agenda_comment_email' => $this->input->post('attendee_email'),
        'meeting_id' => $meeting_id
      );
      if($this->db->insert('agenda_comment', $data))
      {
        return TRUE;
      }
      
      else
      {
        return FALSE;
      }
  }
}