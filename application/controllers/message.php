<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);
class Message extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("message_model");
		$this->load->model("pmp_model");
		$this->load->helper('admin_helper');
	}
	public function index(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 				= $this->session->userdata['logged_in']['firm_id'];
		$user_id 				= $this->session->userdata['logged_in']['id'];
		
		$data['page_title'] 	= 'Message';
		$data['site_name'] 		= ' | HOPS 247';
		$data['main_content'] 	= 'admin/message';
		$data['hotel_users']	= $this->message_model->get_hotel_users_list($hotel_id, $user_id);
		$data['left_sidebar']	= $this->message_model->load_left_sidebar($hotel_id, $user_id);
		$this->load->view('admin/template', $data);
	}
	public function load_left_sidebar(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 		= $this->session->userdata['logged_in']['firm_id'];
		$user_id 		= $this->session->userdata['logged_in']['id'];
		$left_sidebar	= $this->message_model->load_left_sidebar($hotel_id, $user_id);
		$HTML			= '';
		
		if(is_array($left_sidebar)){foreach($left_sidebar as $sidebar_chat){
			if($sidebar_chat->type == 'private'){
				if($this->session->userdata['logged_in']['id'] == $sidebar_chat->recipient_id){$user_id = $sidebar_chat->sender_id;}else{$user_id = $sidebar_chat->recipient_id;}
				$user_info = admin_helper::get_user_name($user_id);
				if($user_info[0]->logo != ''){
					$user_logo	= base_url().'assets/images/user_profile_images/'.$user_info[0]->logo;
				}else{
					$user_logo	= base_url().DEFAULT_PROFILE_IMAGE;
				}
				
				$sender_name = '';
				if(isset($user_info[0]->first_name) && !empty($user_info[0]->first_name)) {
					$sender_name = $user_info[0]->first_name . ' ' . $user_info[0]->last_name;
				} else {
					$sender_name = $user_info[0]->username;
				}
				
				$HTML .='<li id="user_'.$sidebar_chat->r_id.'" onclick="get_messages(\'' . $sidebar_chat->r_id . '\', \'' . $user_info[0]->id . '\', \'' . $sender_name . '\', \'0\');"><a href="javascript:void(0)" class="chat-user"><img src="'.$user_logo.'" alt="user-img" class="img-circle">';
				
				$HTML .='<span>'.$sender_name.'';
					if($user_info[0]->is_online == '1'){
						$HTML .='<i class="fa fa-circle m-r-5 text-success" style="font-size:9px;"></i>';
					}else{
						$HTML .='<i class="fa fa-circle m-r-5 text-muted" style="font-size:9px;"></i>';
					}
					$unseen_messages	= $this->message_model->get_count_unseen_messages('single', $hotel_id, $sidebar_chat->r_id, $user_id);					
					if($unseen_messages[0]->unseen > 0){
						$HTML .='<span class="label label-rouded label-danger pull-right">'.$unseen_messages[0]->unseen.'</span>';
					}
					if($user_info[0]->is_online == '1'){
						$HTML .='<small class="text-success">Online</small>';
					}else{
						$HTML .='<small class="text-danger">Offline</small>';
					}
				$HTML .='</span></a></li>';				
            }else{
					$group_info = admin_helper::group_info($sidebar_chat->group_id);
					if($group_info[0]->group_image != ''){
						$group_logo	= base_url().'assets/images/group_chat_images/'.$group_info[0]->group_image;
					}else{
						$group_logo	= base_url().DEFAULT_PROFILE_IMAGE;
					}
					$unseen_messages	= $this->message_model->get_count_unseen_messages('group', $hotel_id, $sidebar_chat->r_id, $user_id);					
					
					$HTML .='<li id="user_'.$sidebar_chat->r_id.'" onclick="get_messages(\'' . $sidebar_chat->r_id . '\', \'0\', \'' . $group_info[0]->group_name . '\', \'' . $sidebar_chat->group_id . '\');"><a href="javascript:void(0)" class="chat-user"><img src="'.$group_logo.'" alt="user-img" class="img-circle">';
                     $HTML .='<span>'.$group_info[0]->group_name;
					if($unseen_messages[0]->unseen > 0){
						$HTML .='<span class="label label-rouded label-danger pull-right">'.$unseen_messages[0]->unseen.'</span>';
					}
					 $HTML .='</span></a></li>';
                }
			}
		}
		$HTML .='<li class="p-20"></li><li class="p-20"></li><li class="p-20"></li>';
		echo $HTML;
	}
	public function load_left_sidebar_dashboard(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 		= $this->session->userdata['logged_in']['firm_id'];
		$user_id 		= $this->session->userdata['logged_in']['id'];
		$left_sidebar	= $this->message_model->load_left_sidebar($hotel_id, $user_id);
		$HTML			= '';
		
		if(is_array($left_sidebar)){foreach($left_sidebar as $sidebar_chat){
			if($sidebar_chat->type == 'private'){
				if($this->session->userdata['logged_in']['id'] == $sidebar_chat->recipient_id){$user_id = $sidebar_chat->sender_id;}else{$user_id = $sidebar_chat->recipient_id;}
				$user_info = admin_helper::get_user_name($user_id);
				if($user_info[0]->logo != ''){
					$user_logo	= base_url().'assets/images/user_profile_images/'.$user_info[0]->logo;
				}else{
					$user_logo	= base_url().DEFAULT_PROFILE_IMAGE;
				}
				$HTML .='<li id="sidebar-user-box" class="'.$sidebar_chat->r_id.'" data-r_id="'.$sidebar_chat->r_id.'" data-u_id="'.$user_info[0]->id.'" data-chat_name="'.$user_info[0]->first_name.'" data-g_id="0"><img src="'.$user_logo.'" class="user_icon" alt="'.$user_info[0]->first_name.'" /><span id="slider-username">'.$user_info[0]->first_name.'</span>';
					if($user_info[0]->is_online == '1'){
						$HTML .='<i class="fa fa-circle m-r-5 text-success" style="font-size:9px;"></i>';
					}else{
						$HTML .='<i class="fa fa-circle m-r-5 text-muted" style="font-size:9px;"></i>';
					}
					$unseen_messages	= $this->message_model->get_count_unseen_messages('single', $hotel_id, $sidebar_chat->r_id, $user_id);
					if($unseen_messages[0]->unseen > 0){
						$HTML .='<span class="label label-rouded label-warning pull-right m-t-5">'.$unseen_messages[0]->unseen.'</span>';
					}
				$HTML .='</li>';
            }else{
				$group_info = admin_helper::group_info($sidebar_chat->group_id);
				if($group_info[0]->group_image != ''){
					$group_logo	= base_url().'assets/images/group_chat_images/'.$group_info[0]->group_image;
				}else{
					$group_logo	= base_url().DEFAULT_PROFILE_IMAGE;
				}
				$unseen_messages	= $this->message_model->get_count_unseen_messages('group', $hotel_id, $sidebar_chat->r_id, $user_id);					
				
				$HTML .='<li id="sidebar-user-box" class="'.$sidebar_chat->r_id.'" data-r_id="'.$sidebar_chat->r_id.'" data-u_id="0" data-chat_name="'.$group_info[0]->group_name.'" data-g_id="'.$sidebar_chat->group_id.'"><img src="'.$group_logo.'" class="user_icon" alt="'.$group_info[0]->group_name.'" /><span id="slider-username">'.$group_info[0]->group_name.'</span>';
				if($unseen_messages[0]->unseen > 0){
					$HTML .='<span class="label label-rouded label-warning pull-right m-t-5">'.$unseen_messages[0]->unseen.'</span>';
				}
				$HTML .='</li>';
			}
		}
	}
		//$HTML .='<li class="p-20"></li><li class="p-20"></li><li class="p-20"></li>';
		echo $HTML;
	}
	public function create_private_chat(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 			= $this->session->userdata['logged_in']['firm_id'];
		$sender_id 			= $this->session->userdata['logged_in']['id'];
		
		$post_data = array(
			'hotel_id'			=> $hotel_id,
			'sender_id'			=> $sender_id,
			'recipient_id'		=> $_POST['recipient_id'],
			'type'				=> $_POST['type'],
			'group_id'			=> '0',
			'last_modified'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
		);
		$results = $this->message_model->create_private_chat($post_data);
		//echo '<pre>'; print_r($results);exit;
		//redirect('message');
	}
	public function create_group_chat(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 			= $this->session->userdata['logged_in']['firm_id'];
		$group_created_by	= $this->session->userdata['logged_in']['id'];
		$sender_name 		= $this->session->userdata['logged_in']['username'];
		
		$group_members		= '';
		if(isset($_POST['group_users'])){
			foreach($_POST['group_users'] as $group_users){
				$group_members .= $group_users.',';
			}
		}
		
		$group_info = array(
			'hotel_id'				=> $hotel_id,
			'group_created_by'		=> $group_created_by,
			'group_name'			=> $_POST['group_name'],
			'group_image'			=> '',
			'group_members'			=> $group_members.$group_created_by.',',
			'group_created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
		);
		$group_id	= $this->message_model->create_group_info($group_info);
		if($group_id){
			$post_data = array(
				'hotel_id'			=> $hotel_id,
				'sender_id'			=> $group_created_by,
				'recipient_id'		=> '0',
				'type'				=> $_POST['type'],
				'group_id'			=> $group_id,
				'last_modified'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
			);
			$relation_id			= $this->message_model->create_group_relation($post_data);
		}
		
		$post_data = array(
			'hotel_id'			=> $hotel_id,
			'sender_id'			=> $group_created_by,
			'r_id'				=> $relation_id,					
			'sender_name'		=> $sender_name,
			'recipient_id'		=> 0,
			'recipient_name'	=> $_POST['group_name'],
			'group_id'			=> $group_id,
			'text_message'		=> $sender_name.' added you in a group "'.$_POST['group_name'].'"',
			'seen'				=> '0',
			'is_display'		=> '1',
			'sent_at'			=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
		);
		$this->message_model->send_message($post_data);
		
		//Notification
		if(isset($_POST['group_users'])){
			foreach($_POST['group_users'] as $group_users){
				$top_noti_post_data = array(
					'hotel_id'		=> $hotel_id,
					'created_by'	=> $group_created_by,
					'txt_hdn'		=> $sender_name,
					'user_id'		=> $group_users,
					'txt_bdy'		=> $sender_name.' added you in a group "'.$_POST['group_name'].'"',
					'post_url'		=> '',
					'txt_type'		=> 'message',
					'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
				);
				$this->pmp_model->save_top_noti($top_noti_post_data);
			}
		}
		
		redirect('message');
	}
	public function load_chat(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 			= $this->session->userdata['logged_in']['firm_id'];
		$sender_id 			= $this->session->userdata['logged_in']['id'];
		$r_id				= $this->input->post('r_id');
		
		$chat_data			= $this->message_model->fetch_chat_data($hotel_id, $r_id);
		$is_typing			= 0;
		$typing_by			= '';
		$HTML_CHAT			= '';
		//echo '<pre>';print_r($chat_data);exit;
		
		if(is_array($chat_data)){
			foreach($chat_data as $chat_val){
			    $sender_name = '';
				$recipient_name = '';
				if($chat_val->group_id == 0){
					$sender_info	= admin_helper::get_user_name($chat_val->sender_id);
					$recipient_info	= admin_helper::get_user_name($chat_val->recipient_id);
					
					if(isset($recipient_info[0]->first_name) && !empty($recipient_info[0]->first_name)) {
						$recipient_name = $recipient_info[0]->first_name . ' ' . $recipient_info[0]->last_name;
					} else {
						$recipient_name = $recipient_info[0]->username;
					}

					if(isset($sender_info[0]->first_name) && !empty($sender_info[0]->first_name)) {
						$sender_name = $sender_info[0]->first_name . ' ' . $sender_info[0]->last_name;
					} else {
						$sender_name = $sender_info[0]->username;
					}
				}else{
					$sender_info	= admin_helper::get_user_name($chat_val->sender_id);
					
					if(isset($sender_info[0]->first_name) && !empty($sender_info[0]->first_name)) {
						$sender_name = $sender_info[0]->first_name;
					} else {
						$sender_name = $sender_info[0]->username;
					}

					$recipient_name	= $sender_name;
				}
				
				if($chat_val->is_filename != ''){					
					$chat_message = '<a class="example-image-link" href="'.base_url().'assets/images/message_images/'.$chat_val->is_filename.'" data-lightbox="example-1" data-title="Optional caption."><img class="example-image" src="'.base_url().'assets/images/message_images/'.$chat_val->is_filename.'" alt="image-1" width="200" /></a><br>'.$chat_val->text_message;
				}else{
					$chat_message	= $chat_val->text_message;
				}
				
				//$chat_message	= $chat_val->text_message;
				$message_date	= gmdate('Y-m-d H:i:s A', strtotime($chat_val->sent_at));
				
				if($sender_info[0]->logo != ''){
					$sender_profile_image	= base_url().'assets/images/user_profile_images/'.$sender_info[0]->logo;
				}else{
					$sender_profile_image	= base_url().DEFAULT_PROFILE_IMAGE;
				}
				
				$chat_sender_name = '';
				if(empty($chat_val->sender_name)) {
					$chat_sender_name = $sender_name;
				} else {
					$chat_sender_name = $chat_val->sender_name;
				}
				
				if($chat_val->seen == '0'){$seen = 'fa fa-check text-mute';}else{$seen = 'fa fa-check text-info';}
				if($chat_val->sender_id == $sender_id){$class = 'odd';}else{$class = '';$seen = '';if($chat_val->is_typing == '1'){$is_typing = '1'; $typing_by = $chat_sender_name;}}
				
				$HTML_CHAT	.= '<li class="'.$class.'"><div class="chat-image"><img alt="'.$sender_name.'" src="'.$sender_profile_image.'"></div><div class="chat-body"><div class="chat-text '.$chat_val->message_class.'"><h4>'.$chat_sender_name.'</h4><p> '.$chat_message.' </p> <b>'.$message_date.'</b> <i class="'.$seen.'"></i></div></div></li>';				
			}
		}else{
			$HTML_CHAT	.= '<li><div class="chat-body"><div class="chat-text"><b>Start a conversation...</b></div></div></li>';
		}
		if($is_typing == 1){
			$HTML_CHAT	.= '<li style="margin-bottom:0px;"><div class="chat-body"><div class="chat-text" style="background: none;padding-bottom: 0px;"><b>'.$typing_by.' is typing...</b></div></div></li>';
		}
		echo $HTML_CHAT;
	}
	public function load_chat_dashboard(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 			= $this->session->userdata['logged_in']['firm_id'];
		$sender_id 			= $this->session->userdata['logged_in']['id'];
		$r_id				= $this->input->post('r_id');
		
		$chat_data			= $this->message_model->fetch_chat_data($hotel_id, $r_id);
		$is_typing			= 0;
		$HTML_CHAT			= '';
		//echo '<pre>';print_r($chat_data);exit;
		
		if(is_array($chat_data)){
			foreach($chat_data as $chat_val){
				/*if($chat_val->group_id == 0){
					$sender_info	= admin_helper::get_user_name($chat_val->sender_id);
					$recipient_info	= admin_helper::get_user_name($chat_val->recipient_id);
					
					$sender_name	= $sender_info[0]->first_name;
					$recipient_name	= $recipient_info[0]->first_name;
				}else{
					$sender_info	= admin_helper::get_user_name($chat_val->sender_id);
					$sender_name	= $sender_info[0]->first_name;
					$recipient_name	= $sender_name;
				}*/
				
				$chat_message	= $chat_val->text_message;
				$message_date	= gmdate('Y-m-d H:i A', strtotime($chat_val->sent_at));
				
				/*if($sender_info[0]->logo != ''){
					$sender_profile_image	= base_url().'assets/images/user_profile_images/'.$sender_info[0]->logo;
				}else{
					$sender_profile_image	= base_url().DEFAULT_PROFILE_IMAGE;
				}*/
				
				if($chat_val->seen == '0'){$seen = 'fa fa-check text-mute';}else{$seen = 'fa fa-check text-info';}
				if($chat_val->sender_id == $sender_id){$class = 'right';if($chat_val->is_typing == '1'){$is_typing = '1';}}else{$class = 'left';$seen = '';}
				
				if (!empty($chat_val->is_filename)) {					
					$HTML_CHAT .= '<a class="example-image-link" href="'.base_url().'assets/images/message_images/'.htmlspecialchars($chat_val->is_filename, ENT_QUOTES, 'UTF-8').'" data-lightbox="example-1" data-title="Optional caption.">
					<img class="example-image" src="'.base_url().'assets/images/message_images/'.htmlspecialchars($chat_val->is_filename, ENT_QUOTES, 'UTF-8').'" alt="image-1" width="200" /></a><br>'
					.htmlspecialchars($chat_val->text_message, ENT_QUOTES, 'UTF-8').'<br>'.$message_date;
				} else {
					$HTML_CHAT .= '<div class="msg-'.$class.'">'.htmlspecialchars($chat_message, ENT_QUOTES, 'UTF-8').'<br>'.$message_date.'</div>';
				}
				
			}
		}else{
			$HTML_CHAT	.= '<div class="msg-left"><b>Start a conversation...</b></div>';
		}
		if($is_typing == 1){
			$HTML_CHAT	.= '<div class="msg-left"><b>User is typing...</b></div>';
		}
		echo $HTML_CHAT;
	}
	public function send_message(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 			= $this->session->userdata['logged_in']['firm_id'];
		$sender_id 			= $this->session->userdata['logged_in']['id'];
		$sender_name 		= $this->session->userdata['logged_in']['first_name'];
		$filename			= '';
		
		if(isset($_FILES['file'])){
			$target_dir 	= "assets/images/message_images/";
			$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);			
			$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
			$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
			$target_file	= $target_dir. $new_file_name;
			 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				 $filename	= $new_file_name;
			}
		}
		
		if(empty($sender_name)) {
			$sender_info = admin_helper::get_user_name($sender_id);
			$name = '';
			if(isset($sender_info[0]->first_name) && !empty($sender_info[0]->first_name)) {
				$name = $sender_info[0]->first_name;
			} else {
				$name = $sender_info[0]->username;
			}
			$sender_name	= $name;
		}
		
		$post_data = array(
			'hotel_id'			=> $hotel_id,
			'sender_id'			=> $sender_id,
			'sender_name'		=> $sender_name,
			'r_id'				=> $_POST['r_id'],
			'group_id'			=> $_POST['group_id'],
			'recipient_id'		=> $_POST['recipient_id'],
			'recipient_name'	=> $_POST['recipient_name'],
			'text_message'		=> $_POST['text_message'],
			'is_filename'		=> $filename,
			'seen'				=> '0',
			'sent_at'			=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
		);
		$top_noti_post_data = array(
			'hotel_id'		=> $hotel_id,
			'created_by'	=> $sender_id,
			'txt_hdn'		=> $_POST['recipient_name'],
			'user_id'		=> $_POST['recipient_id'],
			'txt_bdy'		=> 'You have a new message from '.$sender_name,
			'post_url'		=> '',
			'txt_type'		=> 'message',
			'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		
		$this->pmp_model->save_top_noti($top_noti_post_data);
		$m_id	= $this->message_model->send_message($post_data);
		
		//Save relations
		if($_POST['group_id'] != 0){
			$group_users	= $this->message_model->get_group_members($hotel_id, $_POST['group_id']);
			foreach($group_users as $members){
				$post_data_seen = array(
					'r_id'			=> $_POST['r_id'],
					'm_id'			=> $m_id,
					'u_id'			=> $members->user_id,
					'seen'			=> $members->user_id == $sender_id ? "1" : "0",
					'seen_at'		=> $members->user_id == $sender_id ? gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')) : "",
					'sent_at'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
				);
				$this->message_model->group_message_relation($post_data_seen);
			}
		}
	}
	public function tie_message(){
		$hotel_id 			= $this->session->userdata['logged_in']['firm_id'];
		$user_id 			= $this->session->userdata['logged_in']['id'];
		$user_name 			= $this->session->userdata['logged_in']['first_name'];
		
		/*Data required from Ticket Insert function*/
		$ticket_id			= '77';
		$ticket_title		= 'Ticket #GSS77';
		$ticket_type		= '1';
		$assign_to			= '62,63,64,65,66,67,68';
		
		$tie_message = array(
			'tie_type'			=> 'Ticket',
			'hotel_id'			=> $hotel_id,
			'generated_by'		=> $user_id,
			'generated_by_name'	=> $user_name,
			'tie_id'			=> $ticket_id,
			'group_name'		=> $ticket_title,
			'ticket_type'		=> $ticket_type,
			'message_class'		=> 'bg-warning',
			'assign_to'			=> $assign_to,
			'created_at'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
		);
		
		$this->message_model->create_tie_message($tie_message);
	}
	public function user_typing(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 			= $this->session->userdata['logged_in']['firm_id'];
		$sender_id 			= $this->session->userdata['logged_in']['id'];
		$r_id				= $this->input->post('r_id');
		$is_typing			= $this->input->post('typing');
		
		$this->message_model->typing_status($hotel_id, $sender_id, $r_id, $is_typing);
	}	
	
	public function get_group_members(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$group_id = $this->input->post('g_id');
		$hotel_id = $this->session->userdata['logged_in']['firm_id'];	

		$group_users = $this->message_model->get_group_members($hotel_id, $group_id);

		$all_members = [];
		$unique_users = [];
		if($group_users) {
			foreach($group_users as $members){
				$user_id = $members->user_id;
	
				// Skip if already added
				if (in_array($user_id, $unique_users)) {
					continue;
				}
	
				$user_info = admin_helper::get_user_name($user_id);
	
				if (isset($user_info[0]->first_name) && !empty($user_info[0]->first_name)) {
					$all_members[] = $user_info[0]->first_name . ' ' . $user_info[0]->last_name;
				} else {
					$all_members[] = $user_info[0]->username;
				}
	
				// Mark user_id as added
				$unique_users[] = $user_id;				
			}
		}

		echo json_encode($all_members);
	}	
}