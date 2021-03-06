<?php

class Site_model extends CI_Model 
{
	public function display_page_title()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		
		$page_url = ucwords(strtolower($page[0]));
		
		if($total > 1)
		{
			$sub_page = explode("-",$page[1]);
			$total_sub = count($sub_page);
			$page_name = '';
			
			for($r = 0; $r < $total_sub; $r++)
			{
				$page_name .= ' '.$sub_page[$r];
			}
			$page_url .= ' | '.ucwords(strtolower($page_name));
			
			if($page[1] == 'category')
			{
				$category_id = $page[2];
				$category_details = $this->categories_model->get_category($category_id);
				
				if($category_details->num_rows() > 0)
				{
					$category = $category_details->row();
					$category_name = $category->category_name;
				}
				
				else
				{
					$category_name = 'No Category';
				}
				
				$page_url .= ' | '.ucwords(strtolower($category_name));
			}
			
			else if($page[1] == 'brand')
			{
				$brand_id = $page[2];
				$brand_details = $this->brands_model->get_brand($brand_id);
				
				if($brand_details->num_rows() > 0)
				{
					$brand = $brand_details->row();
					$brand_name = $brand->brand_name;
				}
				
				else
				{
					$brand_name = 'No Brand';
				}
				
				$page_url .= ' | '.ucwords(strtolower($brand_name));
			}
			
			else if($page[1] == 'view-product')
			{
				$product_id = $page[2];
				$product_details = $this->products_model->get_product($product_id);
				
				if($product_details->num_rows() > 0)
				{
					$product = $product_details->row();
					$product_name = $product->product_name;
				}
				
				else
				{
					$product_name = 'No Product';
				}
				
				$page_url .= ' | '.ucwords(strtolower($product_name));
			}
		}
		
		return $page_url;
	}
	
	public function get_crumbs()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		
		$crumb[0]['name'] = ucwords(strtolower($page[0]));
		$crumb[0]['link'] = $page[0];
		
		if($total > 1)
		{
			$sub_page = explode("-",$page[1]);
			$total_sub = count($sub_page);
			$page_name = '';
			
			for($r = 0; $r < $total_sub; $r++)
			{
				$page_name .= ' '.$sub_page[$r];
			}
			$crumb[1]['name'] = ucwords(strtolower($page_name));
			
			if($page[1] == 'category')
			{
				$category_id = $page[2];
				$category_details = $this->categories_model->get_category($category_id);
				
				if($category_details->num_rows() > 0)
				{
					$category = $category_details->row();
					$category_name = $category->category_name;
				}
				
				else
				{
					$category_name = 'No Category';
				}
				
				$crumb[1]['link'] = 'products/all-products/';
				$crumb[2]['name'] = ucwords(strtolower($category_name));
				$crumb[2]['link'] = 'products/category/'.$category_id;
			}
			
			else if($page[1] == 'brand')
			{
				$brand_id = $page[2];
				$brand_details = $this->brands_model->get_brand($brand_id);
				
				if($brand_details->num_rows() > 0)
				{
					$brand = $brand_details->row();
					$brand_name = $brand->brand_name;
				}
				
				else
				{
					$brand_name = 'No Brand';
				}
				
				$crumb[1]['link'] = 'products/all-products/';
				$crumb[2]['name'] = ucwords(strtolower($brand_name));
				$crumb[2]['link'] = 'products/brand/'.$brand_id;
			}
			
			else if($page[1] == 'view-product')
			{
				$product_id = $page[2];
				$product_details = $this->products_model->get_product($product_id);
				
				if($product_details->num_rows() > 0)
				{
					$product = $product_details->row();
					$product_name = $product->product_name;
				}
				
				else
				{
					$product_name = 'No Product';
				}
				
				$crumb[1]['link'] = 'products/all-products/';
				$crumb[2]['name'] = ucwords(strtolower($product_name));
				$crumb[2]['link'] = 'products/view-product/'.$product_id;
			}
			
			else
			{
				$crumb[1]['link'] = '#';
			}
		}
		
		return $crumb;
	}
	
	function generate_price_range()
	{
		$max_price = $this->products_model->get_max_product_price();
		//$min_price = $this->products_model->get_min_product_price();
		
		$interval = $max_price/5;
		
		$range = '';
		$start = 0;
		$end = 0;
		
		for($r = 0; $r < 5; $r++)
		{
			$end = $start + $interval;
			$value = '$'.number_format(($start+1), 0, '.', ',').' - $'.number_format($end, 0, '.', ',');
			$range .= '<label> <input type="radio" name="agree" value="'.$start.'-'.$end.'"  /> '.$value.'</label> <br>';
			
			$start = $end;
		}
		
		return $range;
	}
	
	public function get_all_categories()
	{
		$this->db->where(array('category_status'=> 1, 'category_parent > ' => 0));
		return $this->db->get('category');
	}
	
	public function get_parent_categories()
	{
		$this->db->where(array('category_status'=> 1, 'category_parent' => 0));
		return $this->db->get('category');
	}
	
	public function get_all_meetings()
	{
		$this->db->where('meeting.event_type_id = event_type.event_type_id AND meeting.agency_id = agency.agency_id');
		return $this->db->get('meeting, event_type, agency');
	}
	
	public function random_color()
	{
		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    	$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
		
		return $color;
	}
	
	public function get_notes_details($meeting_id)
	{
		//retrieve all orders
		$this->db->from('meeting_notes');
		$this->db->select('*');
		$this->db->where('meeting_id = '.$meeting_id);
		$this->db->order_by('meeting_id','DESC');
		$query = $this->db->get();
		
		return $query;
	}

	public function get_meeting_notes($meeting_id)
	{
		//retrieve all orders
		$this->db->from('meeting_notes');
		$this->db->select('count(*) AS number');
		$this->db->where('meeting_id = '.$meeting_id);
		$this->db->order_by('meeting_id','DESC');
		$query = $this->db->get();
		
        $num_meeting_notes = count($query);
        if($num_meeting_notes > 0)
        {
            foreach ($query->result() as $cont)
            {
                $number = $cont->number;
            }
        }
        else
        {
        	$number =0;
        }
        return $number;
	}

	public function get_meeting_agenda($meeting_id)
	{
		//retrieve all orders
		$this->db->from('meeting_agenda');
		$this->db->select('*');
		$this->db->where('meeting_id = '.$meeting_id);
		$this->db->order_by('meeting_id','DESC');
		$query = $this->db->get();
        return $query;
	}
    
	/*
	*
	*	Vendor Account Verification Email
	*
	*/
	public function contact_admin() 
	{
		$this->load->model('site/email_model');
		$date = date('jS M Y H:i a',strtotime(date('Y-m-d H:i:s')));
		$subject = $this->input->post('sender_name')." needs some help";
		$message = '
				<p>A help message was sent on '.$date.' saying:</p> 
				<p>'.$this->input->post('message').'</p>
				<p>Their contact details are:</p>
				<p>
					Name: '.$this->input->post('sender_name').'<br/>
					Email: '.$this->input->post('sender_email').'<br/>
					Phone: '.$this->input->post('sender_phone').'
				</p>
				';
		$sender_email = $this->input->post('sender_email');
		$shopping = "";
		$from = $this->input->post('sender_name');
		
		$button = '';
		$response = $this->email_model->send_mandrill_mail('marttkip@gmail.com', "Hi Martin", $subject, $message, $sender_email, $shopping, $from, $button, $cc = $this->input->post('sender_email'));
		
		//echo var_dump($response);
		
		return $response;
	}
	public function get_all_meeting_attachments($meeting_id)
	{
		$this->db->from('files');
		$this->db->select('*');
		$this->db->where('meeting_id ='.$meeting_id);
		$this->db->order_by('files.file_id','DESC');
		$query = $this->db->get();
		return $query;
	}
}

?>