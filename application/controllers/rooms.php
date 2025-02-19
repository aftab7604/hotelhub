<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rooms extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->helper('admin_helper');
	}
	
	public function add_rooms(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		$hotel_id 				= $this->session->userdata['logged_in']['firm_id'];
		$data['page_title'] 	= 'Manage Hotel Areas';
		$data['site_name'] 		= ' | HOPS 247';
		$data['main_content'] 	= 'admin/add_rooms';
		$data['hotel_info']		= $this->login_model->getSingleHotel($hotel_id);
		$data['room_info']		= $this->login_model->getHotelRooms($hotel_id);
		$data['hotel_area']		= $this->login_model->get_hotel_area($hotel_id);
		$data['areas_list_info']= $this->login_model->get_areas_list();
		$this->load->view('admin/template', $data);
	}
	public function add_rooms_info(){
		if(empty($_POST['floor_num'])){
			$this->session->set_flashdata('flash_data_danger', 'Please enter floor number first!');
		}
		if(empty($_POST['room_num'])){
			$this->session->set_flashdata('flash_data_danger', 'Please enter room number first!');
		}
		if(empty($_POST['room_type'])){
			$this->session->set_flashdata('flash_data_danger', 'Please enter room type first!');
		}
		$post_data = array(
			'floor_num'	=> $_POST['floor_num'],
			'room_no'	=> $_POST['room_num'],
			'room_type' => $_POST['room_type'],
			'room_id' 	=> $_POST['room_id']
		);
		
		$results = $this->login_model->saveRooms($post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Room info has been added successfully.');
			redirect('rooms/add_rooms');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function add_hotel_areas(){
		if(empty($_POST['area_floor'])){$this->session->set_flashdata('flash_data_danger', 'Please enter floor number first!');}
		if(empty($_POST['area_type'])){$this->session->set_flashdata('flash_data_danger', 'Please select area type first!');}
		if(empty($_POST['area_name'])){$this->session->set_flashdata('flash_data_danger', 'Please enter area name first!');}
		
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$post_data	= array(
			'hotel_id'		=> $hotel_id,
			'floor_num'		=> $_POST['area_floor'],
			'area_type' 	=> $_POST['area_name'],
			'description' 	=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes']))
		);
		
		$results = $this->login_model->save_hotel_area($post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'New Area has been added successfully.');
			redirect('rooms/add_rooms');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function delete_hotel_areas($id){
		$id = intval($id);
		$this->login_model->delete_hotel_area($id);
		$this->session->set_flashdata("flash_data", "Area deleted Successfully");
		redirect("rooms/add_rooms");
	}
	public function get_room_type(){
		$post_data = array(
			'room_no'	=> $_POST['room_no'],
			'hotel_id' => $this->session->userdata['logged_in']['firm_id']
		);
		$results = $this->login_model->get_room_type($post_data);
		echo $results[0]->room_type;
	}
	public function add_keys(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		$hotel_id 				= $this->session->userdata['logged_in']['firm_id'];
		$data['page_title'] 	= 'Manage Hotel keys';
		$data['site_name'] 		= ' | HOPS 247';
		$data['main_content'] 	= 'admin/add_keys';
		$data['hotel_info']		= $this->login_model->getSingleHotel($hotel_id);
		$data['hotel_keys']		= $this->login_model->get_hotel_keys($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function add_keys_info(){
		if(empty($_POST['key_num'])){$this->session->set_flashdata('flash_data_danger', 'Please enter key number first!');}
		if(empty($_POST['key_name'])){$this->session->set_flashdata('flash_data_danger', 'Please enter key name first!');}
		$hotel_id 				= $this->session->userdata['logged_in']['firm_id'];
		
		$verify_key_num = $this->login_model->get_single_keys_count($_POST['key_num'], $hotel_id);
		if($verify_key_num == 1){
			$this->session->set_flashdata('flash_data_danger', 'The Key Number "'.$_POST["key_num"].'" already exist.');
			redirect('rooms/add_keys');
		}else{
			$post_data = array(
				'hotel_id' 		=> $hotel_id,
				'key_name'		=> $_POST['key_name'],
				'key_num'		=> $_POST['key_num'],
				'key_desc' 		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes']))
			);
			$results = $this->login_model->save_hotel_keys($post_data);
			if($results){
				$this->session->set_flashdata('flash_data', 'Keys info has been added successfully.');
				redirect('rooms/add_keys');
			}else{
				$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
			}
		}
	}
	public function edit_keys_info(){
		if(empty($_POST['key_num'])){$this->session->set_flashdata('flash_data_danger', 'Please enter key number first!');}
		if(empty($_POST['key_name'])){$this->session->set_flashdata('flash_data_danger', 'Please enter key name first!');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$verify_key_num = $this->login_model->get_single_keys_count($_POST['key_num'], $hotel_id);//print_r($verify_key_num);//exit;
		if($verify_key_num == 1){
			$verify_key_data = $this->login_model->get_single_keys_data($_POST['key_num'], $hotel_id);//print_r($verify_key_data);exit;
			if($verify_key_data[0]->key_id != $_POST['key_id']){
				$this->session->set_flashdata('flash_data_danger', 'The Key Number "'.$_POST["key_num"].'" already exist.');
				redirect('rooms/add_keys');
			}else{
				$post_data = array(
				'key_num'	=> $_POST['key_num'],
				'key_name'	=> $_POST['key_name'],
				'key_desc' 	=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes']))
			);
				$results = $this->login_model->update_hotel_keys($_POST['key_id'], $post_data);
				if($results){
					$this->session->set_flashdata('flash_data', 'Keys info has been updated successfully.');
					redirect('rooms/add_keys');
				}else{
					$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
				}
			}
		}else{
			$post_data = array(
				'key_num'	=> $_POST['key_num'],
				'key_name'	=> $_POST['key_name'],
				'key_desc' 	=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes']))
			);
			$results = $this->login_model->update_hotel_keys($_POST['key_id'], $post_data);
			if($results){
				$this->session->set_flashdata('flash_data', 'Keys info has been updated successfully.');
				redirect('rooms/add_keys');
			}else{
				$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
			}
		}
	}
	public function delete_hotel_keys($id){
		$id = intval($id);
		$this->login_model->delete_hotel_keys($id);
		$this->session->set_flashdata("flash_data", "key deleted Successfully");
		redirect("rooms/add_keys");
	}
}
?>