<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Event extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->model("message_model");
		$this->load->helper('admin_helper');
	}
	public function add_event(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 				= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Add New Event';
		$data['site_name'] 		= ' | HOPS 247';
		$data['main_content'] 	= 'admin/add_event';
		$data['depts']	 		= $this->login_model->getManagerRoles();
		$data['users']	 		= $this->login_model->get_hotel_Users($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function save_event_info(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 				= $this->session->userdata['logged_in']['firm_id'];
		$assign_to_ids			= '';
		$assign_to_idsx			= '';
		$file_name 				= '';
		
		if(isset($_POST['all_day'])){
			$all_day 		= '1';
			$start_time 	= '';
			$end_time 		= '';
			
			$event_start_f	= DateTime::createFromFormat('m-d-Y H:i:s', $_POST['event_start_date'].' 00:00:00');
			$event_end_f	= DateTime::createFromFormat('m-d-Y H:i:s', $_POST['event_end_date'].' 23:59:59');
			$event_start	= $event_start_f->format('Y-m-d H:i:s');
			$event_end		= $event_end_f->format('Y-m-d H:i:s');
		}else{
			$all_day 		= '0';
			$start_time 	= $_POST['event_start_time'];
			$end_time 		= $_POST['event_end_time'];
			
			$event_start_f	= DateTime::createFromFormat('m-d-Y H:i A', $_POST['event_start_date'].' '.$_POST['event_start_time']);
			$event_end_f	= DateTime::createFromFormat('m-d-Y H:i A', $_POST['event_end_date'].' '.$_POST['event_end_time']);
			$event_start	= $event_start_f->format('Y-m-d H:i:s');
			$event_end		= $event_end_f->format('Y-m-d H:i:s');
		}
		
		$event_start_date	= DateTime::createFromFormat('m-d-Y', $_POST['event_start_date']);
		$event_end_date		= DateTime::createFromFormat('m-d-Y', $_POST['event_end_date']);
		$start_date			= $event_start_date->format('Y-m-d');
		$end_date			= $event_end_date->format('Y-m-d');
		
		if(isset($_FILES['file'])){
			$target_dir 	= "assets/images/event_images/";
			$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);			
			$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
			$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
			$target_file	= $target_dir. $new_file_name;
			 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				 $file_name = $new_file_name;
			}
		}
		$tie_assign_to = '';
		if($_POST['assign_to_dp_ur'] == 'all_depts'){
			$depts	= $this->login_model->getManagerRoles();
			foreach($depts as $dept_val){
				$assign_to_ids	.= $dept_val->id.',';
			}
			$assign_to_ids = trim($assign_to_ids, ',');
			
			$usersx	= $this->login_model->get_hotel_Users($hotel_id);
			foreach($usersx as $user_valx){
				$assign_to_idsx	.= $user_valx->id.',';
			}
			$tie_assign_to = $assign_to_idsx;
		}
		if($_POST['assign_to_dp_ur'] == 'all_users'){
			$users	= $this->login_model->get_hotel_Users($hotel_id);
			foreach($users as $user_val){
				$assign_to_ids	.= $user_val->id.',';
			}
			$assign_to_ids = trim($assign_to_ids, ',');
			$tie_assign_to = $assign_to_ids;
		}
		if($_POST['assign_to_dp_ur'] == 'user'){
			foreach($_POST['select_users_drp'] as $ids){
				$assign_to_ids	.= $ids.',';
			}
			$assign_to_ids = trim($assign_to_ids, ',');
			$tie_assign_to = $assign_to_ids.','.$this->session->userdata['logged_in']['id'];
		}
		if($_POST['assign_to_dp_ur'] == 'dept'){
			foreach($_POST['select_dept_drp'] as $ids){
				$assign_to_ids	.= $ids.',';
			}
			$assign_to_ids = trim($assign_to_ids, ',');
			
			$usersx	= $this->login_model->get_roles_users($hotel_id, $assign_to_ids);
			foreach($usersx as $user_valx){
				$assign_to_idsx	.= $user_valx->id.',';
			}
			$assign_to_ids = trim($assign_to_ids, ',');
			$tie_assign_to = $assign_to_idsx.','.$this->session->userdata['logged_in']['id'];
			
		}
		$next_run = date("Y-m-d H:i:s", strtotime("+".$_POST['rem_number']." ".$_POST['rem_period'], strtotime($event_start)));
		
		/*echo $event_start.'<br>';
		echo $event_end.'<br>';
		echo $_POST['rem_number']." ".$_POST['rem_period'].'<br>';
		echo $next_run = date("Y-m-d H:i:s", strtotime("+".$_POST['rem_number']." ".$_POST['rem_period'], strtotime($event_start)));
		exit;*/
		
		$post_data = array(
			'hotel_id'			=> $hotel_id,
			'created_by'		=> $this->session->userdata['logged_in']['id'],
			'title' 			=> $_POST['event_title'],
			'location' 			=> $_POST['event_location'],
			'description'		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['event_desc'])),
			'assign_to_type' 	=> $_POST['assign_to_dp_ur'],
			'assign_to_ids' 	=> $assign_to_ids,
			'className' 		=> $_POST['className'],
			'all_day'			=> $all_day,
			'start_date' 		=> $start_date,
			'end_date' 			=> $end_date,
			'start_time' 		=> $start_time,
			'end_time' 			=> $end_time,
			'repeat_event' 		=> $_POST['repeat_event'],
			'event_start'	 	=> $event_start,
			'event_end' 		=> $event_end,
			'file_name' 		=> $file_name,
			'status'			=> '1',
			'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		
		$results	= $this->login_model->save_event($post_data, 'events');
		if($results){
			foreach($_POST['reminder'] as $noti){
				$post_data_noti = array(
					'event_id'			=> $results,
					'noti_type'			=> $noti,
					'rem_number'		=> $_POST['rem_number'],
					'rem_period' 		=> $_POST['rem_period'],
					'last_run' 			=> $event_start,
					'next_run' 			=> $next_run
				);
				$this->login_model->save_event($post_data_noti, 'events_noti');
			}
			if($all_day == 1){
				$message_event_end = 'All Day';
			}else{
				$message_event_end = $start_time;
			}
			
			/*Create Message START*/
			$tie_message 		= array(
				'tie_type'			=> 'Event',
				'hotel_id'			=> $this->session->userdata['logged_in']['firm_id'],
				'generated_by'		=> $this->session->userdata['logged_in']['id'],
				'generated_by_name'	=> $this->session->userdata['logged_in']['username'],
				'tie_id'			=> $results,
				'group_name'		=> 'Event <b>'.$_POST['event_title'].'</b> has been created',
				'first_message'		=> 'Event Name - <b>'.$_POST['event_title'].'</b></br>Date - <b>'.$start_date.'</b></br>Time - <b>'.$message_event_end.'</b></br>Created By - <b>'.$this->session->userdata['logged_in']['username'].'</b></br>Created Date - <b>'.gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')).'</b>',
				'message_class'		=> 'bg-warning',
				'assign_to'			=> $tie_assign_to,
				'created_at'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
			);
			//echo '<pre>';print_r($tie_message);exit;
			$this->message_model->create_tie_message($tie_message);
			/*Create Message END*/
			
			$post_url	= site_url("event/calendar");
			if($_POST['assign_to_dp_ur'] == 'all_users' || $_POST['assign_to_dp_ur'] == 'all_depts'){
				if($_POST['assign_to_dp_ur'] == 'all_users'){		$txt_bdy	= 'Assign you an event "'.$_POST['event_title'].'"';}
				elseif($_POST['assign_to_dp_ur'] == 'all_depts'){	$txt_bdy	= 'Assign an event to your dept "'.$_POST['event_title'].'"';}
				
				$users	= $this->login_model->get_hotel_Users($hotel_id);
				foreach($users as $user_val){
					$top_noti_post_data = array(
						'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
						'created_by'	=> $this->session->userdata['logged_in']['id'],
						'txt_hdn'		=> $this->session->userdata['logged_in']['username'],
						'user_id'		=> $user_val->id,
						'txt_bdy'		=> $txt_bdy,
						'post_url'		=> $post_url,
						'txt_type'		=> 'event',
						'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
					);
					$this->pmp_model->save_top_noti($top_noti_post_data);
				}
			}
			if($_POST['assign_to_dp_ur'] == 'user'){
				foreach($_POST['select_users_drp'] as $ids){
					$top_noti_post_data = array(
						'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
						'created_by'	=> $this->session->userdata['logged_in']['id'],
						'txt_hdn'		=> $this->session->userdata['logged_in']['username'],
						'user_id'		=> $ids,
						'txt_bdy'		=> 'Assign you an event "'.$_POST['event_title'].'"',
						'post_url'		=> $post_url,
						'txt_type'		=> 'event',
						'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
					);
					$this->pmp_model->save_top_noti($top_noti_post_data);
				}
			}
			if($_POST['assign_to_dp_ur'] == 'dept'){
			foreach($_POST['select_dept_drp'] as $ids){
				$user_id	= $this->login_model->getSingleUserInfo($ids, $hotel_id);
				$top_noti_post_data = array(
					'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
					'created_by'	=> $this->session->userdata['logged_in']['id'],
					'txt_hdn'		=> $this->session->userdata['logged_in']['username'],
					'user_id'		=> $user_id[0]->id,
					'txt_bdy'		=> 'Assign an event to your dept "'.$_POST['event_title'].'"',
					'post_url'		=> $post_url,
					'txt_type'		=> 'event',
					'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
				);
				$this->pmp_model->save_top_noti($top_noti_post_data);
			}
		}
			
			$this->session->set_flashdata('flash_data', 'Event has been added successfully.');
			redirect('event/calendar');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
		/*echo '<pre>';
		print_r($post_data);
		echo '<br><hr><br>';
		print_r($_POST);
		exit;*/
	}
	public function calendar(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 				= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Events Calendar';
		$data['site_name'] 		= ' | HOPS 247';
		$data['main_content'] 	= 'admin/calendar_event';
		$data['depts']	 		= $this->login_model->getManagerRoles();
		$data['users']	 		= $this->login_model->get_hotel_Users($hotel_id);
		$data['events']	 		= $this->login_model->get_hotel_Events($hotel_id);
		$this->load->view('admin/template', $data);
    }
	public function get_all_events(){
		$hotel_id 	= $this->session->userdata['logged_in']['firm_id'];
        $events 	= $this->login_model->get_events($hotel_id);
		//echo '<pre>'; print_r($events);exit;
		/*foreach($result as $key => $val){
			$post_data = array("hotel_id" => $this->session->userdata['logged_in']['firm_id'], "room_no" => $val->title);
			$getRoomType = $this->login_model->get_room_type($post_data);
			
			$result[$key]->room_no_only = $val->title;
			$result[$key]->quarter_only = $val->status;
			$val->title = "Room# ".$val->title." completed - ".$val->status.' Quarter';
			$result[$key]->room_type = $getRoomType[0]->room_type;
		}*/
       echo json_encode($events);
    }
	public function delete_event(){
		$event_id 	= intval($_POST['event_id']);
		$this->login_model->delete_event($event_id);
		$this->session->set_flashdata("flash_data", "Event deleted Successfully");
	}
}
