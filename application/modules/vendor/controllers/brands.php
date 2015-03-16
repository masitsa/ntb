<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/vendor/controllers/account.php";

class Brands extends account
{
	var $brands_path;
	var $brands_location;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('admin/users_model');
		$this->load->model('brands_model');
		$this->load->model('admin/file_model');
		
		$this->load->library('image_lib');
		
		//path to image directory
		$this->brands_path = realpath(APPPATH . '../assets/images/brands');
		$this->brands_location = base_url().'assets/images/brands/';
	}
    
	/*
	*
	*	Default action is to show all the brands
	*
	*/
	public function index() 
	{
		$where = 'created_by IN (0, '.$this->session->userdata('vendor_id').')';
		$table = 'brand';
		$segment = 3;
		
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'vendor/all-brands';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->brands_model->get_all_brands($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('brands/all_brands', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'vendor/add-brand" class="btn btn-success pull-right">Add brand</a>There are no brands';
		}
		$data['title'] = 'All Brands';
		
		$this->load->view('account_template', $data);
	}
    
	/*
	*
	*	Add a new brand
	*
	*/
	public function add_brand() 
	{
		//form validation rules
		$this->form_validation->set_rules('brand_name', 'Brand Name', 'required|xss_clean');
		$this->form_validation->set_rules('brand_status', 'Brand Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//upload product's gallery images
			$resize['width'] = 600;
			$resize['height'] = 800;
			
			if(is_uploaded_file($_FILES['brand_image']['tmp_name']))
			{
				$brands_path = $this->brands_path;
				/*
					-----------------------------------------------------------------------------------------
					Upload image
					-----------------------------------------------------------------------------------------
				*/
				$response = $this->file_model->upload_file($brands_path, 'brand_image', $resize);
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
				}
			
				else
				{
					$this->session->set_userdata('error_message', $response['error']);
					
					$data['title'] = 'Add New Brand';
					$v_data['all_brands'] = $this->brands_model->all_brands();
					$data['content'] = $this->load->view('brands/add_brand', $v_data, true);
					$this->load->view('account_template', $data);
					break;
				}
			}
			
			else{
				$file_name = '';
			}
			
			if($this->brands_model->add_brand($file_name))
			{
				$this->session->set_userdata('success_message', 'brand added successfully');
				redirect('vendor/all-brands');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add brand. Please try again');
			}
		}
		
		//open the add new brand
		$data['title'] = 'Add New brand';
		$data['content'] = $this->load->view('brands/add_brand', '', true);
		
		$this->load->view('account_template', $data);
	}
    
	/*
	*
	*	Edit an existing brand
	*	@param int $brand_id
	*
	*/
	public function edit_brand($brand_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('brand_name', 'brand Name', 'required|xss_clean');
		$this->form_validation->set_rules('brand_status', 'brand Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//upload product's gallery images
			$resize['width'] = 600;
			$resize['height'] = 800;
			
			if(is_uploaded_file($_FILES['brand_image']['tmp_name']))
			{
				$brands_path = $this->brands_path;
				
				//delete original image
				$this->file_model->delete_file($brands_path."\\".$this->input->post('current_image'));
				
				//delete original thumbnail
				$this->file_model->delete_file($brands_path."\\thumbnail_".$this->input->post('current_image'));
				/*
				/*
					-----------------------------------------------------------------------------------------
					Upload image
					-----------------------------------------------------------------------------------------
				*/
				$response = $this->file_model->upload_file($brands_path, 'brand_image', $resize);
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
				}
			
				else
				{
					$this->session->set_userdata('error_message', $response['error']);
					
					$data['title'] = 'Edit brand';
					$query = $this->brands_model->get_brand($brand_id);
					if ($query->num_rows() > 0)
					{
						$v_data['brand'] = $query->result();
						$v_data['all_brands'] = $this->brands_model->all_brands();
						$data['content'] = $this->load->view('brands/edit_brand', $v_data, true);
					}
					
					else
					{
						$data['content'] = 'brand does not exist';
					}
					
					$this->load->view('templates/general_admin', $data);
					break;
				}
			}
			
			else{
				$file_name = $this->input->post('current_image');
			}
			//update brand
			if($this->brands_model->update_brand($file_name, $brand_id))
			{
				$this->session->set_userdata('success_message', 'brand updated successfully');
				redirect('vendor/all-brands');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update brand. Please try again');
			}
		}
		
		//open the add new brand
		$data['title'] = 'Edit Brand';
		
		//select the brand from the database
		$query = $this->brands_model->get_brand($brand_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['brand'] = $query->result();
			$v_data['all_brands'] = $this->brands_model->all_active_brands();
			
			$data['content'] = $this->load->view('brands/edit_brand', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'Brand does not exist';
		}
		
		
		$this->load->view('account_template', $data);
	}
    
	/*
	*
	*	Delete an existing brand
	*	@param int $brand_id
	*
	*/
	public function delete_brand($brand_id)
	{
		//delete brand image
		$query = $this->brands_model->get_brand($brand_id);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			$image = $result[0]->brand_image_name;
			
			$this->load->model('file_model');
			//delete image
			$this->file_model->delete_file($this->brands_path."/images/".$image);
			//delete thumbnail
			$this->file_model->delete_file($this->brands_path."/thumbs/".$image);
		}
		$this->brands_model->delete_brand($brand_id);
		$this->session->set_userdata('success_message', 'brand has been deleted');
		redirect('vendor/all-brands');
	}
    
	/*
	*
	*	Activate an existing brand
	*	@param int $brand_id
	*
	*/
	public function activate_brand($brand_id)
	{
		$this->brands_model->activate_brand($brand_id);
		$this->session->set_userdata('success_message', 'brand activated successfully');
		redirect('vendor/all-brands');
	}
    
	/*
	*
	*	Deactivate an existing brand
	*	@param int $brand_id
	*
	*/
	public function deactivate_brand($brand_id)
	{
		$this->brands_model->deactivate_brand($brand_id);
		$this->session->set_userdata('success_message', 'brand disabled successfully');
		redirect('vendor/all-brands');
	}
}
?>