<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Key_log extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->model("log_book_model");
		$this->load->helper('admin_helper');
	}
	
	public function view(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$user_id	= $this->session->userdata['logged_in']['id'];
		//View Top Notifications
		$top_noti_post_data = array(
			'hotel_id'		=> $hotel_id,
			'user_id'		=> $user_id,
			'txt_type'		=> 'key_request',
			'status'		=> 'seen'
		);
		$this->pmp_model->update_top_noti($top_noti_post_data);
		//View Top Notifications
		
		$data['page_title'] 	= 'Key Logs';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/key_logs';
		$data['available_keys']	= $this->login_model->get_available_keys($hotel_id);
		$data['requested_keys']	= $this->login_model->get_all_requested_keys($hotel_id);
		$data['issued_keys']	= $this->login_model->get_all_issued_keys($hotel_id);
		$data['notReturned_keys']	= $this->login_model->get_all_not_returned_keys($hotel_id);
		$data['my_issued_keys']	= $this->login_model->get_my_issued_keys($hotel_id, $user_id);
		$data['settings']		= $this->login_model->get_settings($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function request_a_key(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		if(empty($_POST['key_id'])){$this->session->set_flashdata('flash_data_danger', 'Please select key first!');}
		
		$imagedata 		= base64_decode($_POST['Esignatures']);
		$sig_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.png';
		$Esignatures	= "assets/images/eSignatures/".$sig_file_name;
		file_put_contents($Esignatures,$imagedata);
		
		$post_data = array(
			'hotel_id'		=> $hotel_id,
			'issued_to' 	=> $this->session->userdata['logged_in']['id'],
			'key_holderSig'	=> $sig_file_name,
			'key_id'		=> $_POST['key_id'],
			'time_out'		=> $_POST['time_out'],
			'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		//already requested or not
		$is_verify = $this->login_model->request_a_key_verify($post_data);
		if($is_verify == 0){
			$results = $this->login_model->request_a_key($post_data);
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
				
				$this->session->set_flashdata('flash_data', 'Request submitted for witness successfully.');
				redirect('key_log/view');
			}else{
				$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
			}
		}else{
			$this->session->set_flashdata('flash_data_danger', 'You cannot request same key twice.');
			redirect('key_log/view');
		}
	}
	public function witness_a_key(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$filename	= '';
		if(isset($_FILES['file'])){
			$target_dir 	= "assets/images/key_logs/";
			$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);			
			$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
			$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
			$target_file	= $target_dir. $new_file_name;
			 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				 $filename = $new_file_name;
			}
		}
		$imagedata 		= base64_decode($_POST['Esignatures']);
		$sig_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.png';
		$Esignatures	= "assets/images/eSignatures/".$sig_file_name;
		file_put_contents($Esignatures,$imagedata);
		
		if($_POST['key_type'] == 'returned'){
			$post_data = array(
				'returned_witness' 			=> $this->session->userdata['logged_in']['id'],
				'returned_witness_signature'=> $sig_file_name,
				'returned_witness_notes' 	=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes'])),
				'returned_witness_filename'	=> $filename,
				'key_status'				=> 'Completed',
				'returned_witness_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
		}
		elseif($_POST['key_type'] == 'request'){
			$post_data = array(
				'issued_witness' 			=> $this->session->userdata['logged_in']['id'],
				'issued_witness_signature' 	=> $sig_file_name,
				'issued_witness_notes' 		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes'])),
				'issued_witness_filename'	=> $filename,
				'key_status'				=> 'Issued',
				'issued_witness_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
		}
		
		$results = $this->login_model->witness_a_key($_POST['keylog_id'] ,$post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Key Issued successfully.');
			redirect('key_log/view');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function return_a_key(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$imagedata 		= base64_decode($_POST['Esignatures']);
		$sig_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.png';
		$Esignatures	= "assets/images/eSignatures/".$sig_file_name;
		file_put_contents($Esignatures,$imagedata);
		
		$post_data = array(
			'returned_by' 		=> $this->session->userdata['logged_in']['id'],
			'returned_by_sig' 	=> $sig_file_name,
			'time_in' 			=> gmdate('h:i A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
			'key_status'		=> 'Returned'
		);
		//Key Return and witness same function
		$this->login_model->witness_a_key($_POST['keylog_id'] ,$post_data);
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
		$this->session->set_flashdata('flash_data', 'Key Issued successfully.');
		redirect('key_log/view');
	}
	
	public function history(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id				= $this->session->userdata['logged_in']['firm_id'];
		$curr_date				= gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
		
		if(isset($_POST['start_date']) && isset($_POST['end_date'])){
			$between			= " BETWEEN '".$_POST['start_date']." 00:00:00' AND '".$_POST['end_date']." 23:59:59' ";
		}else{
			$between			= " BETWEEN '".$curr_date." 00:00:00' AND '".$curr_date." 23:59:59' ";
		}
		
		$data['page_title'] 	= 'Key Logs';
		$data['site_name'] 		= ' | HOPS 247';	
		$data['main_content'] 	= 'admin/key_logs_history';
		$data['key_logs'] 		= $this->login_model->get_key_logs_history($hotel_id, $between);
		$this->load->view('admin/template', $data);
	}
}
?>