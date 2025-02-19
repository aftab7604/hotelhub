<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mpor extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->model("log_book_model");
		$this->load->model("cron_job_model");
		$this->load->helper('admin_helper');
		$this->load->helper('survey_helper');
		$this->load->helper('pm_report_helper');
	}
	
	public function room_breakout(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 		= 'Room Breakout';
		$data['site_name'] 			= ' | HOPS 247';		
		$data['main_content'] 		= 'admin/room_breakout';
		//$data['house_keeping']		= $this->login_model->getHotelHouseKeeping($hotel_id);
		$data['house_keeping']		= $this->login_model->getHotelHouseKeepingAll($hotel_id);
		$data['house_keeping_all']	= $this->login_model->getHotelHouseKeepingAll($hotel_id);
		$data['rooms_info']			= $this->login_model->getHotelRooms($hotel_id);
		$data['house_keeping_info']	= $this->login_model->get_Mpor($hotel_id);
		$data['settings']			= $this->login_model->get_Mpor_settings($hotel_id);
		$data['checkout_count']		= $this->login_model->get_Mpor_checkout_count($hotel_id);
		$data['stayover_count']		= $this->login_model->get_Mpor_stayover_count($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function mpor_settings(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		if($_POST['action_page'] == 'room_breakout'){
		    
		    $occupies_rooms = $_POST['total_occupied'];
			$vacant_rooms = $_POST['total_vacant'];
			$total_rooms = $vacant_rooms + $occupies_rooms;
			if($total_rooms > $_POST['total_rooms']) {
				$this->session->set_flashdata('flash_data_danger', 'Occupied/Vaacnt rooms must be less than total rooms.');
				redirect('mpor/'.$_POST['action_page']);
			}

			$checkouts = $_POST['total_checkouts'];
			$stayovers = $_POST['total_stayovers'];
			if($checkouts + $stayovers > $occupies_rooms) {
				$this->session->set_flashdata('flash_data_danger', 'Checkouts/Stayovers must less than occupied rooms.');
				redirect('mpor/'.$_POST['action_page']);
			}
			
			$post_data = array(
				'hotel_id'			=> $this->session->userdata['logged_in']['firm_id'],
				'total_rooms'		=> $_POST['total_rooms'],
				'total_occupied' 	=> $_POST['total_occupied'],
				'total_vacant' 		=> $_POST['total_vacant'],
				'total_checkouts'	=> $_POST['total_checkouts'],
				'total_stayovers'	=> $_POST['total_stayovers'],
				'out_of_order'		=> $_POST['out_of_order'],
				'default_chk_sty'	=> $_POST['default_chk_sty'],
				'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
		}else{
			$post_data = array(
				'hotel_id'			=> $this->session->userdata['logged_in']['firm_id'],
				'default_chk_sty'	=> $_POST['default_chk_sty']
			);
		}
		$results = $this->login_model->save_Mpor_settings($post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Room Breakout Settings has been added successfully.');
			redirect('mpor/'.$_POST['action_page']);
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function add_mpor_data(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		if(is_array($_POST['room_no'])){
			$settings		= $this->login_model->get_Mpor_settings($hotel_id);
			if(is_array($settings)){
				$total_checkouts	= $settings[0]->total_checkouts;
				$total_stayovers	= $settings[0]->total_stayovers;
				$chk_stay			= $settings[0]->default_chk_sty;
			}else{
				$total_checkouts	= 0;
				$total_stayovers	= 0;
				$chk_stay			= 'stayover';
			}
			$array_count = count($_POST['room_no']);
			/*if($chk_stay == 'stayover'){
				if($array_count >= $total_stayovers){
					$this->session->set_flashdata('flash_data_danger', 'You assign more stayovers from total stayovers');
					redirect('mpor/room_breakout');
				}
			}else{
				if($array_count >= $total_checkouts){
					$this->session->set_flashdata('flash_data_danger', 'You assign more checkouts from total checkouts');
					redirect('mpor/room_breakout');
				}
			}*/
			
			/*echo $total_checkouts.'<br>';
			echo $total_stayovers.'<br>';
			echo $chk_stay.'<br>';
			echo count($_POST['room_no']);
			
			exit;*/
			foreach($_POST['room_no'] as $room_no){
				$post_data = array(
					'hotel_id'			=> $this->session->userdata['logged_in']['firm_id'],
					'created_by_id'		=> $this->session->userdata['logged_in']['id'],
					'assign_to_id' 		=> $_POST['assign_to'],
					'assign_rooms' 		=> $room_no,
					'chk_stay' 			=> $chk_stay,
					'status'			=> 'Pending',
					'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
				);
				$results = $this->login_model->saveMpor($post_data);
			}
			if($results){
				$this->session->set_flashdata('flash_data', 'Room Breakout has been added successfully.');
				redirect('mpor/room_breakout');
			}else{
				$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
			}
		}else{$this->session->set_flashdata('flash_data_danger', 'Please select any rooms first');}
	}
	
	public function my_board(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$user_id	= $this->session->userdata['logged_in']['id'];
		
		$data['page_title'] 	= 'My Board';
		$data['site_name'] 		= ' | HOPS 247';
		$data['main_content'] 	= 'admin/my_board';
		
		if(isset($_POST['employee'])){
			$user_id	= $_POST['employee'];
			if($user_id == 0){
				$data['mpor_assign']	= $this->login_model->get_Mpor($hotel_id);
			}else{
				$data['mpor_assign']	= $this->login_model->get_Mpor_By_User($user_id, $hotel_id);
			}
		}else{
			if(isset($this->session->userdata['logged_in']['role']) && ($this->session->userdata['logged_in']['role'] == '2' || $this->session->userdata['logged_in']['role'] == '8')){
				$data['mpor_assign']	= $this->login_model->get_Mpor($hotel_id);
			}else{
				$data['mpor_assign']	= $this->login_model->get_Mpor_By_User($user_id, $hotel_id);//get_Mpor($hotel_id) for all users
			}
		}
		
		$data['roles']	 		= $this->login_model->getManagerRoles();
		$data['settings']		= $this->login_model->get_settings($hotel_id);
		$data['housekeepers']	= $this->login_model->getHotelHouseKeepingAll($hotel_id);
		$data['categories']		= $this->pmp_model->getAllPMPEditCategories($hotel_id, 'MYBOARD');
		$this->load->view('admin/template', $data);
	}
	public function live_progress(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$user_id	= $this->session->userdata['logged_in']['id'];
		
		$data['page_title'] 	= 'Live Progress';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/live_progress';		
		$data['house_keeping_info']	= $this->login_model->get_Mpor_live_progress($hotel_id, $user_id);
		$data['roles']	 		= $this->login_model->getManagerRoles();

		$this->load->view('admin/template', $data);
	}	
	public function edit_mpor($mpor_id){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$mpor_id					= intval($mpor_id);
		$data['mpor_data']			= $this->login_model->getSingleMPOR($mpor_id);
		$data['house_keeping_info']	= $this->login_model->get_Mpor($hotel_id);
		$data['house_keeping_all']	= $this->login_model->getHotelHouseKeepingAll($hotel_id);
		$data['rooms_info']			= $this->login_model->getHotelRooms($hotel_id);
		$data['page_title'] 		= 'Update Room Breakout';
		$data['site_name'] 			= ' | HOPS 247';		
		$data['main_content'] 		= 'admin/edit_mpor';
		$this->load->view('admin/template', $data);	
	}
	public function edit_mpor_info(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		$post_data = array(
			'mpor_id'			=> $_POST['mpor_id'],
			'hotel_id'			=> $this->session->userdata['logged_in']['firm_id'],
			'created_by_id'		=> $this->session->userdata['logged_in']['id'],
			'assign_to_id' 		=> $_POST['assign_to_id'],
			'assign_rooms' 		=> $_POST['assign_rooms'],
			'chk_stay' 			=> $_POST['chk_stay'],
			'sp_request' 		=> $_POST['sp_request'],
			'is_dnd' 			=> $_POST['is_dnd'],
			'notes'				=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes']))
		);
		$results = $this->login_model->mpor_room_started($post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Information updated successfully.');
			redirect('mpor/room_breakout');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function delete_mpor($mpor_id){
		$mpor_id = intval($mpor_id);
		
		$this->login_model->delete_mpor($mpor_id);
		$this->session->set_flashdata("flash_data", "Record deleted Successfully");
		redirect(site_url("mpor/room_breakout"));
	}
	public function delete_mpor_multiple(){
		$strings = implode(",",$_POST);
		$strings = trim($strings, ',');
		
		$this->login_model->delete_mpor_multiple($strings);
		$this->session->set_flashdata("flash_data", "Record deleted Successfully");
	}
	
    public function update_mpor_room_started_info(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$mpor_res = $this->login_model->getSingleMPOR($_POST['mpor_id']);
		
		if($_POST['method_type'] == 'started'){
			$current_time = gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
			if($_POST['type'] == 'reinspect' || $_POST['type'] == 'startover') {
				if ($mpor_res) {
					// Convert current time to DateTime object, taking the timezone into account
					$current_time = new DateTime(gmdate('Y-m-d H:i:s', strtotime($this->session->userdata['logged_in']['tz'] . ' hours')));
	
					// Get the timer value and convert it into an interval
					$timer = $mpor_res[0]->timer;
					list($hours, $minutes, $seconds) = explode(":", $timer);
					$interval = new DateInterval("PT{$hours}H{$minutes}M{$seconds}S");

					// Subtract the interval from the current time
					$current_time->sub($interval);
					$current_time = $current_time->format('Y-m-d H:i:s');
				}
			}

			$post_data = array(
				'mpor_id'		=> $_POST['mpor_id'],
				'status'		=> 'In-Progress',
				'started_at'	=> $current_time
			);
			$post_data_noti = array(
				'hotel_id'		=> $mpor_res[0]->hotel_id,
				'user_id'		=> $mpor_res[0]->created_by_id,
				'dept_id'		=> '',
				'txt_hdn'		=> '',
				'txt_bdy'		=> 'Room# '.$mpor_res[0]->assign_rooms.' is In-Progress',
				'txt_type'		=> 'warning',
				'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
		}
		if($_POST['method_type'] == 'completed'){
			$imagedata 		= base64_decode($_POST['img_data']);
			$sig_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.png';
			$Esignatures	= "assets/images/eSignatures/".$sig_file_name;
			file_put_contents($Esignatures,$imagedata);
		
			// Get the data for the given mpor_id
			$time_difference = '';
			if ($mpor_res) {
				$started_at = $mpor_res[0]->started_at;
				$current_time = gmdate('Y-m-d H:i:s', strtotime($this->session->userdata['logged_in']['tz'] . ' hours'));
				$start_time = new DateTime($started_at);
				$current_date_time = new DateTime($current_time);
				$date_diff = $start_time->diff($current_date_time);
				$time_difference = $date_diff->format("%H:%I:%S");
			}

			$post_data = array(
				'mpor_id'		=> $_POST['mpor_id'],
				'emp_signature'	=> $sig_file_name,
				'status'		=> 'Completed',
				'approved'		=> '',
				'completed_at'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
				'timer' 		=> $time_difference
			);
			//echo '<pre>'; print_r($_POST);print_r($post_data);exit;
			$post_data_noti = array(
				'hotel_id'		=> $mpor_res[0]->hotel_id,
				'user_id'		=> $mpor_res[0]->created_by_id,
				'dept_id'		=> '',
				'txt_hdn'		=> '',
				'txt_bdy'		=> 'Room# '.$mpor_res[0]->assign_rooms.' is ready for inspection',
				'txt_type'		=> 'warning',
				'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
		}
		if($_POST['method_type'] == 'request'){
			$post_data = array(
				'mpor_id'		=> $_POST['mpor_id'],
				'sp_request'	=> $_POST['sp_request']
			);
			$post_data_noti = array(
				'hotel_id'		=> $mpor_res[0]->hotel_id,
				'user_id'		=> $mpor_res[0]->assign_to_id,
				'txt_hdn'		=> '',
				'txt_bdy'		=> 'Room# '.$mpor_res[0]->assign_rooms.' requested for '.$_POST['sp_request'],
				'txt_type'		=> 'warning',
				'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
		}
		if($_POST['method_type'] == 'checkout_stayover'){
			$post_data = array(
				'mpor_id'		=> $_POST['mpor_id'],
				'chk_stay'		=> $_POST['chk_stay']
			);
			$post_data_noti = array(
				'hotel_id'		=> isset($mpor_res[0]->hotel_id) ? $mpor_res[0]->hotel_id : '',
				'user_id'		=> isset($mpor_res[0]->assign_to_id) ? $mpor_res[0]->assign_to_id : '',
				'txt_hdn'		=> '',
				'txt_bdy'		=> 'Room# '.$mpor_res[0]->assign_rooms.' is '.$_POST['chk_stay'],
				'txt_type'		=> 'info',
				'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
		}
		if($_POST['method_type'] == 'notes'){
			$notes = str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes']));
			
			$post_data = array(
				'mpor_id'	=> $_POST['mpor_id'],
				'notes'		=> $notes
			);
			$post_data_noti = array(
				'hotel_id'		=> $mpor_res[0]->hotel_id,
				'user_id'		=> $mpor_res[0]->assign_to_id,
				'txt_hdn'		=> '',
				'txt_bdy'		=> 'Room# '.$mpor_res[0]->assign_rooms.' have some notes, "'.$notes.'"',
				'txt_type'		=> 'error',
				'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
		}
		/*if($_POST['method_type'] == 'edit_mpor'){
			$post_data = array(
				'mpor_id'			=> $_POST['mpor_id'],
				'hotel_id'			=> $this->session->userdata['logged_in']['firm_id'],
				'created_by_id'		=> $this->session->userdata['logged_in']['id'],
				'assign_to_id' 		=> $_POST['assign_to_id'],
				'assign_rooms' 		=> $_POST['assign_rooms'],
				'chk_stay' 			=> $_POST['chk_stay'],
				'sp_request' 		=> $_POST['sp_request'],
				'is_dnd' 			=> $_POST['is_dnd'],
				'notes'				=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes']))
			);
			$post_data_noti = array();
		}*/
		if($_POST['method_type'] == 'approved'){
			$imagedata 		= base64_decode($_POST['Esignatures']);
			$sig_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.png';
			$Esignatures	= "assets/images/eSignatures/".$sig_file_name;
			file_put_contents($Esignatures,$imagedata);
			$file_name = '';
			if(isset($_FILES['file'])){
				$target_dir 	= "assets/images/mpor_images/";
				$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);			
				$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
				$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
				$target_file	= $target_dir. $new_file_name;
				 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
					 $file_name = $new_file_name;
				}
			}
			
			$post_data = array(
				'mpor_id'			=> $_POST['mpor_id'],
				'approved'			=> 'Approved',
				'inspected_by'		=> $this->session->userdata['logged_in']['id'],
				'insp_signature'	=> $sig_file_name,
				'insp_file_name'	=> $file_name,
				'inspected_time'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
				'inspected_notes'	=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes']))
			);
			$post_data_noti = array(
				'hotel_id'		=> $mpor_res[0]->hotel_id,
				'user_id'		=> '',
				'dept_id'		=> '3',//Front Desk
				'txt_hdn'		=> '',
				'txt_bdy'		=> 'Room# '.$mpor_res[0]->assign_rooms.' has been approved',
				'txt_type'		=> 'success',
				'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
		}
		if($_POST['method_type'] == 'reinspect'){
			$imagedata 		= base64_decode($_POST['Esignatures']);
			$sig_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.png';
			$Esignatures	= "assets/images/eSignatures/".$sig_file_name;
			file_put_contents($Esignatures,$imagedata);
			
			$file_name = '';
			if(isset($_FILES['file'])){
				$target_dir 	= "assets/images/mpor_images/";
				$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);			
				$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
				$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
				$target_file	= $target_dir. $new_file_name;
				 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
					 $file_name = $new_file_name;
				}
			}

			$post_data = array(
				'mpor_id'			=> $_POST['mpor_id'],
				'approved'			=> 'Normal Re-Inspect',
				'inspected_by'		=> $this->session->userdata['logged_in']['id'],
				'insp_signature'	=> $sig_file_name,
				'insp_file_name'	=> $file_name,
				'inspected_time'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
				'inspected_notes'	=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes'])),
				'status'			=> 'Pending',
				'completed_at'		=> '0000-00-00 00:00:00'
			);

			//Update status according to inspection type
			$inspection_type = $_POST['inspection_type'];
			if($inspection_type == 'premium') {
				if ($mpor_res) {
					$user_id = $mpor_res[0]->assign_to_id;
					$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
					$where = ['assign_to_id' => $user_id, 'status' => 'In-Progress', "is_active" => '1', 'hotel_id' => $hotel_id];
					$this->db->where($where);
					$this->db->where("DATE(created_date) =", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')));
					$result = $this->login_model->get_where($where, 'mpor');
					if($result) {
						$started_at = $result->started_at;
						$current_time = gmdate('Y-m-d H:i:s', strtotime($this->session->userdata['logged_in']['tz'] . ' hours'));
						$start_time = new DateTime($started_at);
						$current_date_time = new DateTime($current_time);
						$date_diff = $start_time->diff($current_date_time);
						$timer = $date_diff->format("%H:%I:%S");

						$store_data = array(
							'mpor_id' 	 => $result->mpor_id,
							'status' 	 => 'Pending',
							'timer' 	 => $timer,
							'started_at' => '0000-00-00 00:00:00',
							'approved'	 => 'Start-Over'
						);
						$this->login_model->mpor_room_started($store_data);

						//get room id and mark its notificaion seen
						$room_id = $result->assign_rooms;
						$msg = 'Room# '.$room_id.' is In-Progress';
						$where = [
							'hotel_id' => $result->hotel_id, 
							'user_id' => $result->created_by_id, 
							'txt_bdy' => $msg, 
							'status' => 'unseen'
						];
						$this->db->where($where);
						$this->db->where("DATE(created_date) =", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')));
						$data = $this->login_model->get_where($where, 'notifications');
						if(!empty($data)) {
							$noti_data = array(
								'n_id'	 => $data->n_id,
								'status' => 'seen'
							);
							$this->login_model->update_notification($noti_data);
						}

						//now update current record
						$current_time = new DateTime(gmdate('Y-m-d H:i:s', strtotime($this->session->userdata['logged_in']['tz'] . ' hours')));
			
						// Get the timer value and convert it into an interval
						$timer = $mpor_res[0]->timer;
						list($hours, $minutes, $seconds) = explode(":", $timer);
						$interval = new DateInterval("PT{$hours}H{$minutes}M{$seconds}S");

						// Subtract the interval from the current time
						$current_time->sub($interval);
						$current_time = $current_time->format('Y-m-d H:i:s');

						//additional notifaication
						$noti_data = array(
							'hotel_id'		=> $mpor_res[0]->hotel_id,
							'user_id'		=> $mpor_res[0]->created_by_id,
							'dept_id'		=> '',
							'txt_hdn'		=> '',
							'txt_bdy'		=> 'Room# '.$mpor_res[0]->assign_rooms.' is In-Progress',
							'txt_type'		=> 'warning',
							'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
						);
						$this->login_model->save_notification($noti_data);

						$post_data = array(
							'mpor_id'			=> $_POST['mpor_id'],
							'approved'			=> 'Premium Re-Inspect',
							'inspected_by'		=> $this->session->userdata['logged_in']['id'],
							'insp_signature'	=> $sig_file_name,
							'insp_file_name'	=> $file_name,
							'inspected_time'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
							'inspected_notes'	=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes'])),
							'status'			=> 'In-Progress',
							'completed_at'		=> '0000-00-00 00:00:00',
							'started_at'		=> $current_time 
						);
					}
				}				
			}			
			
			$post_data_noti = array(
				'hotel_id'		=> $mpor_res[0]->hotel_id,
				'user_id'		=> $mpor_res[0]->assign_to_id,
				'dept_id'		=> '',
				'txt_hdn'		=> '',
				'txt_bdy'		=> 'Room# '.$mpor_res[0]->assign_rooms.' marked as Re-Inspected',
				'txt_type'		=> 'error',
				'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
		}
		if($_POST['method_type'] == 'dnd'){
			if(isset($_FILES['file'])){
				$target_dir 	= "assets/images/mpor_images/";
				$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);			
				$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
				$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
				$target_file	= $target_dir. $new_file_name;
				 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
					 $post_data['dnd_filename'] = $new_file_name;
				}
			}
			$post_data['mpor_id']	= $_POST['mpor_id'];
			$post_data['is_dnd']	= '1';
			
			$post_data_noti = array(
				'hotel_id'		=> $mpor_res[0]->hotel_id,
				'user_id'		=> $mpor_res[0]->created_by_id,
				'dept_id'		=> '',
				'txt_hdn'		=> '',
				'txt_bdy'		=> 'Room# '.$mpor_res[0]->assign_rooms.' is DND',
				'txt_type'		=> 'error',
				'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
		}
		if($_POST['method_type'] == 'not_dnd'){
			$post_data = array(
				'mpor_id'	=> $_POST['mpor_id'],
				'is_dnd'	=> $_POST['is_dnd']
			);
			$post_data_noti = array(
				'hotel_id'		=> $mpor_res[0]->hotel_id,
				'user_id'		=> $mpor_res[0]->assign_to_id,
				'txt_hdn'		=> '',
				'txt_bdy'		=> 'Room# '.$mpor_res[0]->assign_rooms.' is now ready for service',
				'txt_type'		=> 'info',
				'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
		}
		
		$results = $this->login_model->mpor_room_started($post_data);
		if($post_data_noti){
			$results = $this->login_model->save_notification($post_data_noti);
		}
		if($_POST['method_type'] == 'completed'){//echo 'here'; exit;
			redirect('mpor/my_board');
		}
	}	
	
	public function lock_mpor_start_comp_timer(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		if($_POST['method'] == 'Start'){
			$post_data = array(
				'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
				'mpor_id'		=> $_POST['mpor_id'],
				'cat_id' 		=> $_POST['cat_id'],
				'subcat_id' 	=> $_POST['subcat_id'],
				'started_at' 	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
				'status' 		=> 0,
				'created_date' 	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
			$this->login_model->lock_mpor_start_timer($post_data);
		}else if($_POST['method'] == 'Complete'){
			$post_data = array(
				'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
				'mpor_id'		=> $_POST['mpor_id'],
				'cat_id' 		=> $_POST['cat_id'],
				'subcat_id' 	=> $_POST['subcat_id'],
				'completed_at' 	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
				'time_taken' 	=> $_POST['time_taken'],
				'status' 		=> 1,
				'created_date' 	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
			$this->login_model->lock_mpor_complete_timer($post_data);
		}
		
		//echo '<pre>'; print_r($post_data);
	}
	
	public function manager_screen(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 			= 'Inspector Central';
		$data['site_name'] 				= ' | HOPS 247';		
		$data['main_content'] 			= 'admin/inspector_central';
		$data['house_keeping_info']		= $this->login_model->get_Mpor($hotel_id);
		$data['checkout_count']			= $this->login_model->get_Mpor_checkout_count($hotel_id);
		$data['stayover_count']			= $this->login_model->get_Mpor_stayover_count($hotel_id);
		$data['inprogress_count']		= $this->login_model->get_Mpor_inprogress_count($hotel_id);
		$data['completed_count']		= $this->login_model->get_Mpor_completed_count($hotel_id);
		$data['apr_checkout_count']		= $this->login_model->get_Mpor_apr_checkout_count($hotel_id);
		$data['apr_stayover_count']		= $this->login_model->get_Mpor_apr_stayover_count($hotel_id);
		$data['settings']				= $this->login_model->get_settings($hotel_id);
		$data['house_keeping']			= $this->login_model->getHotelHouseKeepingAll($hotel_id);
		$data['roles']	 				= $this->login_model->getManagerRoles();

		$this->load->view('admin/template', $data);
	}
	
	public function get_timer() {
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];

		$house_keeping_info	= $this->login_model->get_Mpor($hotel_id);
		
		foreach ($house_keeping_info as &$data) {
			// Fetch the username using admin_helper
			$user_info = admin_helper::get_user_name($data->inspected_by);
			$data->inspected_by_name = !empty($user_info) ? ucfirst($user_info[0]->username) : "Unknown";
		}
		
		echo json_encode($house_keeping_info);
	}
	
	public function get_notifications(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id					= $this->session->userdata['logged_in']['firm_id'];
		$dept_id					= $this->session->userdata['logged_in']['role'];
		$user_id					= $this->session->userdata['logged_in']['id'];
		
		$data['dept_notification']	= $this->login_model->get_dept_notification($dept_id);
		/*System Lockdown*/
		$data['sys_lockdown']		= $this->login_model->get_emergency($hotel_id);

		$user_notifications	= $this->login_model->get_user_notification($user_id);
		//filter notifications
		if($user_notifications) {
			foreach($user_notifications as $noti) {
				if(isset($noti->txt_bdy) && !empty($noti->txt_bdy)) {
					$checks = [];
					if(strpos($noti->txt_bdy, 'ready for inspection')) {
						if (!in_array(' is In-Progress', $checks)) {
							$checks[] = ' is In-Progress';
						}
					} else if(strpos($noti->txt_bdy, 'is In-Progress')) {
						if (!in_array(' is ready for inspection', $checks)) {
							$checks[] = ' is ready for inspection';
						}
					} else if(strpos($noti->txt_bdy, 'has been approved') || strpos($noti->txt_bdy, 'marked as Re-Inspected')) {
						if (!in_array(' is In-Progress', $checks)) {
							$checks[] = ' is In-Progress';
						}
						if (!in_array(' is ready for inspection', $checks)) {
							$checks[] = ' is ready for inspection';
						}
					} else if(strpos($noti->txt_bdy, 'is DND')) {
						if (!in_array(' is now ready for service', $checks)) {
							$checks[] = ' is now ready for service';
						}
					}
					
					//extract room no
					if (preg_match('/Room# (\d+)/', $noti->txt_bdy, $matches)) {
						$room_number = $matches[1];
						$this->update_Room_Notification($user_notifications, $room_number, $checks, $noti->created_date);
					}
				}
			}
		}

		$data['user_notification'] = $this->login_model->get_user_notification($user_id);
		
		$this->load->view('admin/mpor_noti', $data);
	}

	private function update_Room_Notification($user_notifications, $room_number, $checks, $created_date) {
		foreach($user_notifications as $noti) {
			if(isset($noti->txt_bdy) && !empty($noti->txt_bdy)) {
				// Convert both dates to timestamps for comparison
                $noti_created_timestamp = strtotime($noti->created_date);
                $given_created_timestamp = strtotime($created_date);

				foreach($checks as $check) {
					if($noti->txt_bdy == 'Room# '.$room_number.$check && $noti->status == 'unseen' && $noti_created_timestamp < $given_created_timestamp) {
						$post_data_noti = array(
							'n_id'		=> $noti->n_id,
							'status'	=> 'seen'
						);
						$this->login_model->update_notification($post_data_noti);
					}
				}				
			}
		}
	}
	
	public function get_top_notifications(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id			= $this->session->userdata['logged_in']['firm_id'];
		$dept_id			= $this->session->userdata['logged_in']['role'];
		$user_id			= $this->session->userdata['logged_in']['id'];
		
		$notifications		= $this->login_model->get_top_notifications($hotel_id, $user_id);
		$html 				= '';
		$unseen_count		= 0;
		if(!empty($notifications) && is_array($notifications))
		{
			foreach($notifications as $val)
			{
				if($val->status == 'seen')
				{
					$status = 'online';
				} else {
					$status = 'busy';
					$unseen_count++;
				}
				$html .= '<a target="_blank" href="'.$val->post_url.'" onclick="markAsSeen('.$val->nt_id.')"><div class="user-img" style="margin-bottom: 40px;"><img src="'.base_url().'assets/plugins/images/users/varun.jpg" alt="user" class="img-circle"><span class="profile-status '.$status.' pull-right"></span></div><div class="mail-contnet"><h5>'.$val->txt_hdn.'</h5><span class="mail-desc" style="white-space: unset;">'.$val->txt_bdy.'</span><span class="time">'.date("d M, Y h:i A", strtotime($val->created_date)).'</span></div></a>';
			}
			$html .= '<div class="hidden" id="noti_count">'.($unseen_count).'</div>';
		} else {
			$html .= '<div class="hidden" id="noti_count">'.($unseen_count).'</div>';
		}
		echo $html;
	} 

	public function mark_notification_seen() {
		if ($this->input->post('notification_id')) {
			$notification_id = $this->input->post('notification_id');
	
			$update_data = array('status' => 'seen', 'nt_id' => $notification_id);
			$this->login_model->update_top_notifications($update_data);
	
			echo json_encode(['success' => true, 'message' => 'Notification marked as seen']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Invalid request']);
		}
	}
	
	public function update_notifications(){
		if($_POST['method_type'] == 'notification_seen'){
			$post_data_noti = array(
				'n_id'		=> $_POST['n_id'],
				'status'	=> $_POST['status']
			);
		}
		if($_POST['method_type'] == 'notification_tone'){
			$post_data_noti = array(
				'n_id'			=> $_POST['n_id'],
				'notify_tone'	=> $_POST['notify_tone']
			);
		}
		$this->login_model->update_notification($post_data_noti);
	}
	public function room_priority(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$user_id	= $this->session->userdata['logged_in']['id'];
		
		$data['page_title'] 	= 'Room Priorities';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/room_priority';
		$data['rooms_info']		= $this->login_model->getHotelRooms($hotel_id);
		$data['house_keeping_info']	= $this->login_model->get_Mpor($hotel_id);
		$data['house_keeping_all']	= $this->login_model->getHotelHouseKeepingAll($hotel_id);
		
		$data['settings']		= $this->login_model->get_Mpor_settings($hotel_id);
		$data['checkout_count']	= $this->login_model->get_Mpor_checkout_count($hotel_id);
		$data['stayover_count']	= $this->login_model->get_Mpor_stayover_count($hotel_id);
		
		$this->load->view('admin/template', $data);
	}
	public function pull_assigned_rooms_drag(){
		$assigned_user_id	= str_replace('user_id_', '', $_POST['whichnest']);
		$curr_date 			= gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
		$hotel_id			= $this->session->userdata['logged_in']['firm_id'];
		$settings			= $this->login_model->get_Mpor_settings($hotel_id);
		$priority			= 1;
		$onlyRoomNos		= array();
		if(isset($_POST['whichnest']) && $_POST['whichnest'] != ''){
			$super_array = json_decode($_POST['output'], true);
			foreach($super_array as $inner_array){
				foreach($inner_array as $room_no){
					$onlyRoomNos[] = $room_no;
					$exist = $this->login_model->checkRoomExistOrNot($hotel_id, $room_no);
					if($exist){
						$post_data = array(
							'assign_to_id'	=> $assigned_user_id,
							'priority'		=> $priority
						);
						$this->login_model->updateRoomPriorities($hotel_id, $room_no, $post_data);
						//echo $room_no.'-'.$assigned_user_id.'-'.$priority.'<br>---update----<br>';
						$priority++;
					}else{
						$post_data = array(
							'hotel_id'		=> $hotel_id,
							'created_by_id'	=> $this->session->userdata['logged_in']['id'],
							'assign_to_id'	=> $assigned_user_id,
							'assign_rooms'	=> $room_no,
							'priority'		=> $priority,
							'chk_stay'		=> $settings[0]->default_chk_sty,
							'status'		=> 'Pending',
							'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
						);
						//echo $room_no.'-'.$assigned_user_id.'-'.$priority.'<br>---insert----<br>';
						$this->login_model->saveMpor($post_data);
						$priority++;
					}
				}
			}
			$roomNosString = "'".implode("', '", $onlyRoomNos)."'";
			$this->login_model->get_Unassigned_rooms($hotel_id, $assigned_user_id, $roomNosString, $curr_date);			
			$info_user = $this->login_model->get_assign_rooms_data_2($hotel_id, $assigned_user_id, $curr_date);
			
			echo $html1 = '<p><small>TOTAL ROOMS = </small>'.$info_user[0]->total_rooms.'</p><p><small>CHECKOUTS = </small>'.$info_user[0]->total_checkouts.'</p><p><small>STAYOVERS = </small>'.$info_user[0]->total_stayovers.'</p>';
		}
	}
	public function pull_priorityPage_stat(){
		$hotel_id		= $this->session->userdata['logged_in']['firm_id'];
			
		$checkout_count	= $this->login_model->get_Mpor_checkout_count($hotel_id);
		$stayover_count	= $this->login_model->get_Mpor_stayover_count($hotel_id);
		$html 			= '<div class="form-group m-b-5"><label class="col-sm-6 control-label">Running Balance Checkouts</label><div class="col-sm-2 control-label"><b>'.$checkout_count.'</b></div></div><div class="form-group m-b-5"><label class="col-sm-6 control-label">Running Balance Stayover</label><div class="col-sm-2 control-label"><b>'.$stayover_count.'</b></div></div>';
		echo $html;
	}
	
	public function statistics(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$user_id	= $this->session->userdata['logged_in']['id'];
		
		$data['page_title'] 	= 'Housekeeper Statistics';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/housekeeper_statistics';
		$data['all_housekeepers']	= $this->login_model->getHotelHouseKeepingAll($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function analytics(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$user_id	= $this->session->userdata['logged_in']['id'];
		
		$data['page_title'] 	= 'MPOR Analytics';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/housekeeper_analytics';
		$data['all_housekeepers']	= $this->login_model->getHotelHouseKeepingAll($hotel_id);
		$this->load->view('admin/template', $data);
	}
	
	public function history(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id			= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Housekeeper History';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/mpor_history';
		$data['HK_employees']	= $this->login_model->getHotelHouseKeepingAll($hotel_id);
		$data['rooms_info']		= $this->login_model->getHotelRooms($hotel_id);
		$data['rooms_type']		= $this->pmp_model->getAllDRoomTypes($hotel_id);
		//$data['hk_history']		= $this->login_model->get_Mpor_By_Date($hotel_id, $between);
		//$data['settings']		= $this->login_model->get_Mpor_settings_By_Date($hotel_id, $between);
		$this->load->view('admin/template', $data);
	}
	public function history_mpor(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$HTML		= '';
		$between	= " BETWEEN '".$_POST['date']." 00:00:00' AND '".$_POST['date']." 23:59:59' ";
		$hk_history		= $this->login_model->get_Mpor_By_Date($hotel_id, $between);
		if(is_array($hk_history)){foreach($hk_history as $hk_info_val){
			
			$username = admin_helper::get_user_name($hk_info_val->created_by_id);
			$usernameE = admin_helper::get_user_name($hk_info_val->assign_to_id);
			if($hk_info_val->is_dnd == '1'){
				//$dnd = '<a class="image-popup-no-margins" href="'.base_url().'assets/images/mpor_images/'.$hk_info_val->dnd_filename.'" title=""><img src="'.base_url().'assets/images/mpor_images/'.$hk_info_val->dnd_filename.'" class="img-responsive" /></a>';
				//$dnd = '<img src="'.base_url().'assets/images/mpor_images/'.$hk_info_val->dnd_filename.'" class="img-responsive" width="130" title="Yes" alt="Yes" />';
				$dnd = '<a class="example-image-link" href="'.base_url().'assets/images/mpor_images/'.$hk_info_val->dnd_filename.'" data-lightbox="example-1"><img class="example-image" src="'.base_url().'assets/images/mpor_images/'.$hk_info_val->dnd_filename.'" width="50" title="Yes" alt="Yes" /></a>';
				
			}else{$dnd = '&mdash;';}
			if($hk_info_val->is_ticket){$is_ticket = '<a target="_blank" href="'.site_url("ticket/ticket_info/").'/'.$hk_info_val->is_ticket.'">View</a>';}else{$is_ticket = '&mdash;';}
			if($hk_info_val->status == 'Completed'){if($hk_info_val->approved == ''){$status = 'Waiting for approval';}else{$status = $hk_info_val->approved;}}else{$status = $hk_info_val->status;}
			
			$HTML		.= '<tr><td>'.ucfirst($username[0]->username).'</td>';
			$HTML		.= '<td>'.ucfirst($usernameE[0]->username).'</td>';
			$HTML		.= '<td>'.$hk_info_val->assign_rooms.'</td>';
			$HTML		.= '<td>'.ucfirst($hk_info_val->chk_stay).'</td>';
			$HTML		.= '<td>'.ucfirst($hk_info_val->sp_request).'</td>';
			$HTML		.= '<td>'.$dnd.'</td>';
			$HTML		.= '<td>'.htmlspecialchars_decode($hk_info_val->notes).'</td>';
			$HTML		.= '<td>'.$is_ticket.'</td>';
			$HTML		.= '<td>'.$status.'</td></tr>';
        }}
		echo $HTML;
	}
	public function get_hk_dateRange(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$HTML		= '';
		$room_no	= $_POST['room_no'];
		
		$between	= " BETWEEN '".$_POST['arrival_date']." 00:00:00' AND '".$_POST['departure_date']." 23:59:59' ";
		$hk_history	= $this->login_model->get_Mpor_By_Date_And_Room($hotel_id, $room_no, $between);

		if(is_array($hk_history)){foreach($hk_history as $hk_info_val){
			$usernameE = admin_helper::get_user_name($hk_info_val->assign_to_id);
			$HTML	.= date('d M, Y', strtotime($hk_info_val->created_date)).' - '.ucfirst($usernameE[0]->username).'<br />';			
        }}else{
			$HTML	.= 'NO DATA FOUND';
		}
		echo $HTML;
	}
	
	public function pdf_room_priority(){
		$this->load->library('m_pdf');
		
		$current_date	= gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
		$pdfFilePath	= "room_priorities_".$current_date.".pdf";
		$hotel_id		= $this->session->userdata['logged_in']['firm_id'];
		$employees		= $this->login_model->getHotelHouseKeepingAll($hotel_id);
		
		$this->m_pdf->pdf->SetDisplayMode('fullpage');
		foreach($employees as $i => $employee){
			if($i){$this->m_pdf->pdf->AddPage();}
			$data		= array('employee' => $employee->id);
			$PDF_HTML	= $this->load->view('admin/pdf_room_priority', $data, true);
			$this->m_pdf->pdf->WriteHTML($PDF_HTML);
		}
		
		$this->m_pdf->pdf->SetHTMLFooter("");
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
    }
    
    //Update Employee
	public function update_employee() {
		$employee_id = $this->input->post('employee_id');
		$record_id = $this->input->post('record_id');

		if($employee_id && $record_id) {
			$post_data = array(
				'mpor_id'			=> $record_id,
				'assign_to_id' 		=> $employee_id
			);
			$results = $this->login_model->mpor_room_started($post_data);
			echo 'Success';
		} else {
			echo 'Error';
		}
	}
	
	//get speciifc record
	public function check_reInspect($id) {
		$hotel_id = $this->session->userdata['logged_in']['firm_id'];
		
		$where = [
			'assign_to_id' => $id, 
			'status' => 'In-Progress', 
			'is_active' => '1', 
			'hotel_id' => $hotel_id
		];
		$this->db->where($where);
		$this->db->where("DATE(created_date) =", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')));
		$result = $this->login_model->get_where($where, 'mpor');
		
		// Ensure we always return a valid JSON response
		echo json_encode($result ?: []); 
	}
	
}