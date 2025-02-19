<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->model("log_book_model");
		$this->load->model("message_model");
		$this->load->helper('admin_helper');
		$this->load->helper('pm_report_helper');
	}
	
	public function index(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$user_id 	= $this->session->userdata['logged_in']['id'];
		
		if($this->session->userdata['logged_in']['role'] == '8' || $this->session->userdata['logged_in']['role'] == '2'){
			$rooms_info = $this->login_model->getHotelRooms($hotel_id);
			if($rooms_info){}else{
				$this->session->set_flashdata('flash_data_danger', 'Please manage your hotel room number/type first!');
				redirect('rooms/add_rooms');
			}
		}
		
		$data['page_title'] 	= 'Dashboard';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/dashboard';
		$data['slide_types']	= $this->login_model->get_scrollTypes($hotel_id);
		$data['pendingRoomsTik']= $this->login_model->getPendingTicketsForRooms();
		$data['pickupRoomsTik']	= $this->login_model->getPickupTicketsForRooms();
		$data['rooms'] 			= $this->login_model->getHotelRooms($hotel_id);
		$data['checklist']		= $this->pmp_model->getCreatedChecklists($hotel_id);
		
		$data['TotalTicket']	= $this->login_model->getCountOfTotalTickets();
		$data['pendingTicket']	= $this->login_model->getCountOfPendingTickets();
		$data['pickupTicket']	= $this->login_model->getCountOfPickedTickets();
		$data['closeTicket']	= $this->login_model->getCountOfClosedTickets();
		
		$data['old_pendingTicket']	= $this->login_model->getOLDPendingTickets();
		$data['old_pickupTicket']	= $this->login_model->getOLDPickedTickets();
		
		$data['total_users']	= $this->login_model->get_hotel_Users($hotel_id);
		$data['online_users']	= $this->login_model->get_online_users($hotel_id);
		$data['total_posts']	= $this->login_model->get_total_log_book($hotel_id);
		$data['chat_sidebar']	= $this->message_model->load_left_sidebar($hotel_id, $user_id);
		
		$HTML_TRACKING			= '';
		if($this->session->userdata['logged_in']['role'] == '2' || $this->session->userdata['logged_in']['role'] == '8'){/*FOR ADMINS*/
			$tracking_info		= $this->login_model->get_user_tracking($hotel_id, '10', 'all');
		}else{/*FOR USERS*/
			$tracking_info		= $this->login_model->get_user_tracking($hotel_id, '10', $this->session->userdata['logged_in']['id']);
		}
		
		if(is_array($tracking_info)){
			foreach($tracking_info as $tracking_val){
				$generatedBy	= admin_helper::get_user_name($tracking_val->user_id);
				$generated_by	= $generatedBy[0]->username;
				$created_date	= date('h:i A', strtotime($tracking_val->created_date));
				
					 if($tracking_val->txt_type == 'logIn') {$lable = 'success'; $star = 'fa-star text-warning';}
				else if($tracking_val->txt_type == 'logout'){$lable = 'danger'; $star = 'fa-star text-warning';}
				else if($tracking_val->txt_type == 'ticket'){$lable = 'warning'; $star = 'fa-star-o';}
				else {$lable = ''; $star = 'fa-star-o';}
				
				$HTML_TRACKING	.= '<tr class="unread"><td class="hidden-xs"><i class="fa '.$star.'"></i></td>
											<td class="hidden-xs">'.$generated_by.'</td>
											<td class="max-texts"><span class="label label-'.$lable.'">'.ucwords($tracking_val->txt_type).'</span> '.$tracking_val->txt_bdy.'</td>
											<td class="text-right">'.$created_date.'</td>
										</tr>';
			}
		}else{
				$HTML_TRACKING	.= '<tr class="unread"><td colspan="6" class="hidden-xs">No Results Found</td></tr>';
		}
		$data['user_tracking']	= $HTML_TRACKING;
		
		$data['logs_entry']		= $this->log_book_model->get_logBook_entry_for_dashboard($hotel_id, $limit = 3);
		
		$data['comp_per']		= $this->login_model->get_settings($hotel_id);
		$data['quarter']		= $this->getChecklistQuarterdash();		
		$this->load->view('admin/template', $data);
	}
	public function getChecklistQuarterdash(){
		$current_month = date('m');
		$current_year = date('Y');
		if($current_month>=1 && $current_month<=3){$quarter = '1st';}
		else if($current_month>=4 && $current_month<=6){$quarter = '2nd';}
		else if($current_month>=7 && $current_month<=9){$quarter = '3rd';}
		else if($current_month>=10 && $current_month<=12){$quarter = '4th';}
		return $quarter;
	}
	/*public function calender(){
        //$user_type	= $this->uri->segment(3);
		//$type		= $this->uri->segment(4);
        $result 	= $this->login_model->getPtasks();
		
		foreach($result as $key => $val){
			$post_data = array("hotel_id" => $this->session->userdata['logged_in']['firm_id'], "room_no" => $val->title);
			$getRoomType = $this->login_model->get_room_type($post_data);
			
			$result[$key]->room_no_only = $val->title;
			$result[$key]->quarter_only = $val->status;
			$val->title = "Room# ".$val->title." completed - ".$val->status.' Quarter';
			$result[$key]->room_type = $getRoomType[0]->room_type;
		}
       echo json_encode($result);
    }*/
}
?>