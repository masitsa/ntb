<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload_Controller extends CI_Controller {
public function __construct() {
parent::__construct();
}
public function file_view(){
$this->load->view('file_view', array('error' => ' ' ));
}
public function do_upload($meeting_id){
	 $upload = base_url()."./assets/files/";
	// var_dump($upload)or die();
	$config = array(
	'upload_path' => "./assets/files/",
	'allowed_types' => "gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp",
	'overwrite' => TRUE,
	'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
	'max_height' => "768",
	'max_width' => "1024"
	);

	$this->load->library('upload', $config);
	 $file = $_FILES['userfile']['name'];
	
	if (file_exists("$upload" . $_FILES["userfile"]["name"]))
  	{
			$data['result']='failure';
  	}
    else
    {
		if($this->upload->do_upload())
		{
			$trail_data = array(
	        		"meeting_id" => $meeting_id,
	        		"filename" => $file
		    );
			$this->db->insert('files', $trail_data);

			$data = array('upload_data' => $this->upload->data());
			$data['result'] = "success";
		}
		else
		{
			$error = $this->upload->display_errors();
			$data['result'] = $error;

		}
	}

	echo json_encode($data);
}
}
?>