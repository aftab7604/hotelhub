<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->helper('admin_helper');
		$this->load->helper('pm_report_helper');
	}
	public function index(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id		 		= $this->session->userdata['logged_in']['firm_id'];
		
		$data['settings']		= $this->login_model->get_settings($hotel_id);
		$data['room_types']		= $this->pmp_model->getAllDRoomTypes($hotel_id);
		$data['page_title'] 	= 'HOPS Settings';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/settings';
		$this->load->view('admin/template', $data);
	}
	public function save_settings(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		if($_POST['email_pass'] != ''){
			$pass = $this->login_model->encryptor('encrypt', $_POST['email_pass']);
		}else{
			$pass = $_POST['email_pass_hdn'];
		}
		
		if($_FILES['file_email_logo']['name'] != ''){
			$filename_email_logo = '';
		}else{
			$filename_email_logo = $_POST['hdn_email_logo'];
		}
		
		if(isset($_FILES['file_email_logo'])){
			$target_dir 	= "assets/images/";
			$uploaded_file	= $target_dir . basename($_FILES["file_email_logo"]["name"]);			
			$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
			$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
			$target_file	= $target_dir. $new_file_name;
			 if (move_uploaded_file($_FILES["file_email_logo"]["tmp_name"], $target_file)) {
				 $filename_email_logo	= $new_file_name;
			}
		}
		
		//goal time
		$hotel_id = $this->session->userdata['logged_in']['firm_id'];
		//goal time
		$goal_times = [
			'checkout' => [],
			'stayover' => []
		];
		if($_POST['room_type'] !== '') {
			if(empty($_POST['hours']) && empty($_POST['minutes'])) {				
				$this->session->set_flashdata('flash_data_danger', 'Please Set Goal Time.');
				redirect('settings');
			} else {
				$chk_sty = $_POST['chk_sty_setting'];
				$room_type = $_POST['room_type'];
				$hours = str_pad($_POST['hours'], 2, '0', STR_PAD_LEFT);
				$minutes = str_pad($_POST['minutes'], 2, '0', STR_PAD_LEFT);
				$goal_time = $hours . ":" . $minutes;
	
				// Fetch existing settings from the database
				$settings = $this->login_model->get_settings($hotel_id);
				if ($settings && !empty($settings[0]->goal_time)) {
					$goal_times = json_decode($settings[0]->goal_time, true); // Convert JSON to array
				}
			
				// Ensure the structure exists
				if (!isset($goal_times['checkout'])) {
					$goal_times['checkout'] = [];
				}
				if (!isset($goal_times['stayover'])) {
					$goal_times['stayover'] = [];
				}
			
				// Update the goal time for the respective category and room type
				$goal_times[$chk_sty][$room_type] = $goal_time;
			}			
		}
		
		$post_data = array(
			'hotel_id'				=> $this->session->userdata['logged_in']['firm_id'],
			'percentage'			=> $_POST['percentage'],
			'email_add'				=> $_POST['email_add'],
			'email_pass'			=> $pass,
			'from_label'			=> $_POST['from_email_label'],
			'email_logo'			=> $filename_email_logo,
			'panic_btn'				=> $_POST['panic_btn'],
			'terms_conditions' 		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['terms'])),
			'terms_conditions_hk' 	=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['terms_hk'])),
			'goal_time'				=> !empty($goal_times) ? json_encode($goal_times) : null
		);
		$results = $this->login_model->save_settings($post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Setting has been updated successfully.');
			redirect('settings');
		}else{$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');}
	}
	public function dash(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id		 		= $this->session->userdata['logged_in']['firm_id'];
		
		$data['settings']		= $this->login_model->get_scrollTypes($hotel_id);
		$data['page_title'] 	= 'Dashboard Settings';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/settings_dash';
		$this->load->view('admin/template', $data);
	}
	public function save_dash_settings(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		if(!isset($_POST['taskassignto'])){$this->session->set_flashdata('flash_data_danger', 'Please select any types first!');redirect('settings/dash');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
				
		if(isset($_POST['taskassignto'])){
			$this->login_model->delete_scrollTypes($hotel_id);
			foreach($_POST['taskassignto'] as $types){
				$post_data = array(
					'hotel_id'		=> $hotel_id,
					'scroll_type'	=> $types,
					'filter_range'	=> $_POST['range_'.$types],
					'added_date'	=> gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
				);
				$results = $this->login_model->save_scrollTypes($post_data);
			}
			if($results){
				$this->session->set_flashdata('flash_data', 'Setting has been updated successfully.');
				redirect('settings/dash');
			}else{$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');}
		}
	}
	
	//Ticket Notifications
	public function ticket(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id		 		= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Tickets Notifications';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/settings_ticket';
		
		$data['ticket_types']	= $this->login_model->get_ticket_types();
		$data['users']			= $this->login_model->get_hotel_Users($hotel_id);
		$data['roles']			= $this->login_model->get_noti_depts();
		$this->load->view('admin/template', $data);
	}
	public function update_user_ticket_noti(){
		$user_id		= $_POST['user_id'];
		$ticket_ids		= $_POST['tkt_ids'];
		$method			= $_POST['method'];
		
		if($method == 'email'){
			$post_data = array(
				'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
				'user_id'		=> $user_id,
				'email_ids'		=> $ticket_ids
			);
		}else if($method == 'sms'){
			$post_data = array(
				'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
				'user_id'		=> $user_id,
				'sms_ids'		=> $ticket_ids
			);
		}else if($method == 'dept'){
			$post_data = array(
				'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
				'user_id'		=> $user_id,
				'dept_ids'		=> $ticket_ids
			);
		}
		$this->login_model->update_ticket_noti($user_id, $post_data);
	}
	
	// Fetch goal time of room types
	// Fetch goal time of room types
	public function fetch_goal_time() {
		$room_type = $this->input->post('room_type');
		$chk_sty_setting = $this->input->post('chk_sty_setting'); // Get checkout/stayover selection
		$hotel_id = $this->session->userdata['logged_in']['firm_id'];
	
		$settings = $this->login_model->get_settings($hotel_id);
	
		if ($settings && !empty($settings[0]->goal_time)) {
			$goal_times = json_decode($settings[0]->goal_time, true);
	
			// Ensure the structure exists
			if (isset($goal_times[$chk_sty_setting]) && isset($goal_times[$chk_sty_setting][$room_type])) {
				echo json_encode(['goal_time' => $goal_times[$chk_sty_setting][$room_type]]);
				return;
			}
		}
	
		echo json_encode(['goal_time' => '']);
	}
}
?>