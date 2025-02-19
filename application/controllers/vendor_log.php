<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendor_log extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->model("log_book_model");
		$this->load->helper('admin_helper');
	}
	
	public function add_vendor(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$user_id	= $this->session->userdata['logged_in']['id'];
		
		$data['page_title'] 	= 'Add Vendor';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/add_vendor';
		$data['room_types']		= $this->pmp_model->getAllDRoomTypes($hotel_id);
		$data['areas_list_info']= $this->login_model->get_areas_list();
		$this->load->view('admin/template', $data);
	}
	public function add_vendor_info(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		if(empty($_POST['vendor_name'])){$this->session->set_flashdata('flash_data_danger', 'Vendor Name is required');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$post_data = array(
			'hotel_id'			=> $hotel_id,
			'v_name' 			=> $_POST['vendor_name'],
			'company_type'		=> $_POST['vendor_type'],
			'v_city'			=> $_POST['vendor_city'],
			'v_phone'			=> $_POST['vendor_phone'],
			'v_email'			=> $_POST['vendor_email'],
			'v_address'			=> $_POST['vendor_address'],
			'tracking_req'		=> $_POST['tracking_req'],
			'guest_room_req'	=> $_POST['guest_room_req'],
			'public_area'		=> $_POST['public_area'],
			'room_types'		=> $_POST['room_types'],
			'wt_public_areas'	=> $_POST['wt_public_areas'],
			'rm_per_num'		=> $_POST['room_percent_number'],
			'per_of_rooms'		=> $_POST['per_of_rooms'],
			'num_of_rooms'		=> $_POST['num_of_rooms'],
			'how_often'			=> $_POST['how_often'],
			'time_frame'		=> $_POST['time_frame'],
			'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		
		$is_result = $this->login_model->save_vendor($post_data);
		if($is_result){
			$this->session->set_flashdata('flash_data', 'Vendor Information added successfully.');
			redirect('vendor_log/manage_vendor');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function manage_vendor(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Manage Vendor';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/manage_vendor';
		$data['vendor_info']	= $this->login_model->get_vendors($hotel_id);
		$this->load->view('admin/template', $data);	
	}
	public function edit_vendor($id){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$id 					= intval($id);
		$data['page_title'] 	= 'Update Vendor';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/edit_vendor';
		$data['room_types']		= $this->pmp_model->getAllDRoomTypes($hotel_id);
		$data['areas_list_info']= $this->login_model->get_areas_list();
		$data['vendor_info']	= $this->login_model->get_single_vendor($id);
		$this->load->view('admin/template', $data);	
	}
	public function update_vendor_info(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		if(empty($_POST['vendor_name'])){$this->session->set_flashdata('flash_data_danger', 'Vendor Name is required');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$post_data = array(
			'hotel_id'			=> $hotel_id,
			'v_name' 			=> $_POST['vendor_name'],
			'company_type'		=> $_POST['vendor_type'],
			'v_city'			=> $_POST['vendor_city'],
			'v_phone'			=> $_POST['vendor_phone'],
			'v_email'			=> $_POST['vendor_email'],
			'v_address'			=> $_POST['vendor_address'],
			'tracking_req'		=> $_POST['tracking_req'],
			'guest_room_req'	=> $_POST['guest_room_req'],
			'public_area'		=> $_POST['public_area'],
			'room_types'		=> $_POST['room_types'],
			'wt_public_areas'	=> $_POST['wt_public_areas'],
			'rm_per_num'		=> $_POST['room_percent_number'],
			'per_of_rooms'		=> $_POST['per_of_rooms'],
			'num_of_rooms'		=> $_POST['num_of_rooms'],
			'how_often'			=> $_POST['how_often'],
			'time_frame'		=> $_POST['time_frame']
		);
		//echo '<pre>';print_r($post_data);exit;
		$is_result = $this->login_model->update_vendor($_POST['v_id'], $post_data);
		if($is_result){
			$this->session->set_flashdata('flash_data', 'Vendor Information updated successfully.');
			redirect('vendor_log/manage_vendor');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function delete_vendor($id){
		$id = intval($id);
		
		$this->login_model->delete_vendor($id);
		$this->session->set_flashdata("flash_data", "Vendor deleted Successfully");
		redirect(site_url("vendor_log/manage_vendor"));
	}
	
	//VENDOR SIGNIN
	public function vendor_signIn(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$user_id	= $this->session->userdata['logged_in']['id'];
		
		$data['page_title'] 	= 'Vendor Sign-In';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/vendor_signIn';
		$data['vendor_info']	= $this->login_model->get_vendors($hotel_id);
		$data['available_keys']	= $this->login_model->get_available_keys($hotel_id);
		$data['time_in_keys']	= $this->login_model->get_timeIn_keys($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function vendor_signIn_info(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		if(empty($_POST['vendor_list'])){$this->session->set_flashdata('flash_data_danger', 'Select any vendor first');}
		if(empty($_POST['v_rep_name'])){$this->session->set_flashdata('flash_data_danger', 'Vendor Rep Name is required');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$VR_ESIGNATURES_IMAGEDATE	= base64_decode($_POST['v_r_Esignatures']);
		$VR_ESIGNATURES_FILENAME	= 'GSS_'.time().'_'.rand(0, 1000).'.png';
		$VR_ESIGNATURES_PATH		= "assets/images/eSignatures/".$VR_ESIGNATURES_FILENAME;
		file_put_contents($VR_ESIGNATURES_PATH, $VR_ESIGNATURES_IMAGEDATE);
		
		$HR_ESIGNATURES_IMAGEDATE	= base64_decode($_POST['h_r_Esignatures']);
		$HR_ESIGNATURES_FILENAME	= 'GSS_'.time().'_'.rand(0, 1000).'.png';
		$HR_ESIGNATURES_PATH		= "assets/images/eSignatures/".$HR_ESIGNATURES_FILENAME;
		file_put_contents($HR_ESIGNATURES_PATH, $HR_ESIGNATURES_IMAGEDATE);
		
		$post_data = array(
			'hotel_id'			=> $hotel_id,
			'user_id'			=> $this->session->userdata['logged_in']['id'],
			'v_id' 				=> $_POST['vendor_list'],
			'v_r_name'			=> $_POST['v_rep_name'],
			'key_required'		=> $_POST['key_req'],
			'key_id'			=> $_POST['key_id'],
			'time_in'			=> $_POST['time_inn'],
			'visit_reason'		=> $_POST['reason_of_visit'],
			'v_r_signature'		=> $VR_ESIGNATURES_FILENAME,
			'h_r_signature'		=> $HR_ESIGNATURES_FILENAME,
			'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		$key_post_data = array(
			'hotel_id'		=> $hotel_id,
			'issued_to' 	=> $this->session->userdata['logged_in']['id'],
			'key_holderSig'	=> $HR_ESIGNATURES_FILENAME,
			'key_id'		=> $_POST['key_id'],
			'time_out'		=> $_POST['time_inn'],				
			'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		
		if($_POST['key_req'] == 'no'){
			$post_data['keylog_id'] = '0';
			$is_result = $this->login_model->save_vendor_signIn($post_data);
			if($is_result){
				$this->session->set_flashdata('flash_data', 'Request submitted successfully.');
				redirect('vendor_log/vendor_signIn');
			}else{
				$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
			}
		}else{
			//already requested or not
			$is_verify = $this->login_model->request_a_key_verify($key_post_data);
			if($is_verify == 0){
				$results = $this->login_model->request_a_key($key_post_data);
				if($results){
					//Send Top Notifications
					$all_users		= $this->login_model->get_hotel_Users($hotel_id);
					$my_key_name	= admin_helper::get_key_name($_POST['key_id']);
					$key_num		= $my_key_name[0]->key_num;
					$key_name		= $my_key_name[0]->key_name;
					$post_url		= site_url("key_log/view");
					$txt_bdy		= $this->session->userdata['logged_in']['username'].' Requested Key <strong style="color:#337ab7;">('.$key_num.'--'.$key_name.')</strong> Witness';
					foreach($all_users as $user_val){
						if($user_val->id != $this->session->userdata['logged_in']['id']){
							$top_noti_post_data = array(
								'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
								'created_by'	=> $this->session->userdata['logged_in']['id'],
								'txt_hdn'		=> $this->session->userdata['logged_in']['username'],
								'user_id'		=> $user_val->id,
								'txt_bdy'		=> $txt_bdy,
								'post_url'		=> $post_url,
								'txt_type'		=> 'key_request',
								'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
							);
							$this->pmp_model->save_top_noti($top_noti_post_data);
						}
					}
					//Send Top Notifications
					
					$post_data['keylog_id'] = $results;
					$is_result = $this->login_model->save_vendor_signIn($post_data);
					if($is_result){
						$this->session->set_flashdata('flash_data', 'Request submitted for key witness successfully. successfully.');
						redirect('vendor_log/vendor_signIn');
					}else{
						$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
					}
				}else{
					$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
				}
			}else{
				$this->session->set_flashdata('flash_data_danger', 'You cannot request same key twice.');
				redirect('vendor_log/vendor_signIn');
			}
		}
	}
	public function vendor_signIn_info_timeout(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$VR_ESIGNATURES_IMAGEDATE	= base64_decode($_POST['Esignatures_r']);
		$VR_ESIGNATURES_FILENAME	= 'GSS_'.time().'_'.rand(0, 1000).'.png';
		$VR_ESIGNATURES_PATH		= "assets/images/eSignatures/".$VR_ESIGNATURES_FILENAME;
		file_put_contents($VR_ESIGNATURES_PATH, $VR_ESIGNATURES_IMAGEDATE);
		
		$HR_ESIGNATURES_IMAGEDATE	= base64_decode($_POST['Esignatures_h']);
		$HR_ESIGNATURES_FILENAME	= 'GSS_'.time().'_'.rand(0, 1000).'.png';
		$HR_ESIGNATURES_PATH		= "assets/images/eSignatures/".$HR_ESIGNATURES_FILENAME;
		file_put_contents($HR_ESIGNATURES_PATH, $HR_ESIGNATURES_IMAGEDATE);
		
		$post_data = array(
			'time_out'			=> gmdate('h:i A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
			't_user_id'			=> $this->session->userdata['logged_in']['id'],
			't_v_r_signature'	=> $VR_ESIGNATURES_FILENAME,
			't_h_r_signature'	=> $HR_ESIGNATURES_FILENAME,
			't_created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		$key_post_data = array(
			'returned_by' 		=> $this->session->userdata['logged_in']['id'],
			'returned_by_sig' 	=> $HR_ESIGNATURES_FILENAME,
			'time_in' 			=> gmdate('h:i A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
			'key_status'		=> 'Returned'
		);
		
		if($_POST['keylog_id'] == '0'){
			$is_result = $this->login_model->update_vendor_signIn($_POST['vsignin_id'], $post_data);
			if($is_result){
				$this->session->set_flashdata('flash_data', 'Vendor time-out successfully.');
				redirect('vendor_log/vendor_signIn');
			}else{
				$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
			}
		}else{
			$this->login_model->update_vendor_signIn($_POST['vsignin_id'], $post_data);
			$this->login_model->witness_a_key($_POST['keylog_id'] ,$key_post_data);
			//Send Top Notifications
			$all_users		= $this->login_model->get_hotel_Users($hotel_id);
			$my_key_name	= admin_helper::get_key_name($_POST['keylog_id']);
			$key_num		= $my_key_name[0]->key_num;
			$key_name		= $my_key_name[0]->key_name;
			$post_url		= site_url("key_log/view");
			$txt_bdy		= $this->session->userdata['logged_in']['username'].' Requested Key <strong style="color:#337ab7;">('.$key_num.'--'.$key_name.')</strong> Witness';
			foreach($all_users as $user_val){
				if($user_val->id != $this->session->userdata['logged_in']['id']){
					$top_noti_post_data = array(
						'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
						'created_by'	=> $this->session->userdata['logged_in']['id'],
						'txt_hdn'		=> $this->session->userdata['logged_in']['username'],
						'user_id'		=> $user_val->id,
						'txt_bdy'		=> $txt_bdy,
						'post_url'		=> $post_url,
						'txt_type'		=> 'key_request',
						'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
					);
					$this->pmp_model->save_top_noti($top_noti_post_data);
				}
			}
			//Send Top Notifications
			$this->session->set_flashdata('flash_data', 'Vendor time-out successfully.');
			redirect('vendor_log/vendor_signIn');
		}
	}
}
?>