<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);
class Ticket extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->model("message_model");
		$this->load->helper('admin_helper');
	}
	
	public function create_ticket(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 				= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'New Service Ticket';
		$data['site_name'] 		= ' | HOPS 247';
		$data['main_content'] 	= 'admin/create_ticket';
		$data['room_info']		= $this->login_model->getHotelRooms($hotel_id);
		$data['room_types']		= $this->pmp_model->getAllDRoomTypes($hotel_id);
		$data['room_floors']	= $this->pmp_model->getAllDRoomFloors($hotel_id);
		$data['hotel_area']		= $this->login_model->get_hotel_area($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function add_ticket_info(){
		require 'PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		// $mail->isSMTP();
		$mail->Host 		= 'p3plcpnl0833.prod.phx3.se';
		$mail->SMTPAuth 	= true;
		$mail->Username 	= 'brandon10@dprofits.com';
		$mail->Password 	= 'Password12';
		$mail->SMTPSecure 	= 'tls';
		$mail->Port 		= 465;
		$mail->setFrom('admin@hotelgss.com', 'HOPS 247');
		$mail->isHTML(true);
		
		$hotel_id			= $this->session->userdata['logged_in']['firm_id'];
		if($this->input->post('special_project') == 'no'){
			$data_main['ticket_status']	= 1;
			$data_main['ticket_type']	= 1;//GSS
			$data_main['hotel_id'] 		= $hotel_id;
			$data_main['generated_by']	= $this->session->userdata['logged_in']['id'];
			$data_main['created_date']	= gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
			
			$File_name = '';
			if($_FILES['file']){
				foreach($_FILES["file"]["tmp_name"] as $key => $nothing){					
					if($_FILES["file"]["name"][$key] != ''){
						$target_dir 	= "assets/images/ticket_images/";
						$uploaded_file	= $target_dir . basename($_FILES["file"]["name"][$key]);			
						$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
						$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
						$target_file	= $target_dir. $new_file_name;
						 if (move_uploaded_file($_FILES["file"]["tmp_name"][$key], $target_file)){
							 $File_name .= $new_file_name.',';
						}
					}							
				}
				$data_main['ticket_filename']	= trim($File_name, ',');
			}
			
			$data_main['service_rec']	= $this->input->post('servicerecovery');
			if($this->input->post('houseguest') == 'yes'){//house guest is yes
				$data_main['guest_type']	= 'In-House';
				$data_main['guest_name']	= $this->input->post('guestname');
				$data_main['guest_email']	= $this->input->post('guestemail');
				$data_main['guest_phone']	= $this->input->post('guestnumber');
				$data_main['room_no']		= $this->input->post('guestroomnumber');
				$data_main['room_type']		= $this->input->post('roomtype');
				$arrivaldate 				= DateTime::createFromFormat('m-d-Y', $this->input->post('arrivaldate'));
				$departdate					= DateTime::createFromFormat('m-d-Y', $this->input->post('departdate'));			
				$data_main['arrival_date']	= $arrivaldate->format('Y-m-d');
				$data_main['depart_date']	= $departdate->format('Y-m-d');
			}
			elseif($this->input->post('houseguest') == 'no'){
				$data_main['guest_type']		= 'Not In-House';
				$data_main['guest_name']		= $this->input->post('guestnameno');
				$data_main['guest_email']		= $this->input->post('guestemailno');
				$data_main['guest_phone']		= $this->input->post('guestnumberno');
				$data_sub['future_reservation']	= $this->input->post('furtherreservation');
				if($this->input->post('furtherreservation') == 'yes'){
					$data_main['room_type']		= $this->input->post('guestroomtype');
					$arrivaldate_f 				= DateTime::createFromFormat('m-d-Y', $this->input->post('arrivaldate_future'));
					$departdate_f				= DateTime::createFromFormat('m-d-Y', $this->input->post('departdate_future'));			
					$data_main['arrival_date']	= $arrivaldate_f->format('Y-m-d');
					$data_main['depart_date']	= $departdate_f->format('Y-m-d');
				}
			}
			else{/*standerd selected*/
				$data_main['guest_type']		= $this->input->post('houseguest');
				$data_main['room_no']			= $this->input->post('guestroomnumber');
				//$data_main['room_type']			= $this->input->post('rooms_type');
				$data_main['room_floor']		= $this->input->post('rooms_floor');
				$data_main['other_areas']		= $this->input->post('other_areas');
			}
	
			$taskassignto = $this->input->post('taskassignto');
			foreach($taskassignto as $value){
				if($value == 'frontdesk'){
					$data_sub['fd_notes']			= $this->input->post('frontdesknotes');
					$data_main['assign_to_dept']	= 3;
				}
				if($value == 'housekeeping'){
					$data_sub['hk_service']			= $this->input->post('housekeepingservice');
					$data_sub['hk_notes']			= $this->input->post('housekeepingnotes');
					$data_main['assign_to_dept']	= 4;
				}
				if($value == 'food'){
					$data_sub['food_service']		= $this->input->post('foodsservice');
					$data_sub['food_group']			= $this->input->post('nameofgroup');
					$data_sub['food_notes']			= $this->input->post('foodguestnotes');
					$data_main['assign_to_dept']	= 5;
				}
				if($value == 'sales'){
					$data_sub['sales_guest_name']	= $this->input->post('guestname');
					$data_sub['sales_company']		= $this->input->post('salecompany');
					$data_sub['sales_phone']		= $this->input->post('salesphone');
					$data_sub['sales_phone2']		= $this->input->post('salesphone2');
					$data_sub['sales_callTime']		= $this->input->post('calltime');
					$data_sub['guest_room_needed']	= $this->input->post('guestroomneeded');
					$data_sub['meeting_room_needed']= $this->input->post('meetingroomneeded');
					$data_sub['food_needed']		= $this->input->post('foodneeded');
					$data_sub['return_guest']		= $this->input->post('returncust');
					$data_sub['urgent_request']		= $this->input->post('urgentrequest');
					$data_sub['sales_mail']			= $this->input->post('salemail');
					$data_sub['brings_hotel']		= $this->input->post('bringshotel');
					if($this->input->post('guestarivaldate')){
						$guestArivalDate				= DateTime::createFromFormat('m-d-Y', $this->input->post('guestarivaldate'));			
						$data_sub['guest_arrival_date']	= $guestArivalDate->format('Y-m-d');
					}
					if($this->input->post('guestdepartdate')){
						$guestDepartDate				= DateTime::createFromFormat('m-d-Y', $this->input->post('guestdepartdate'));			
						$data_sub['guest_depart_date']	= $guestDepartDate->format('Y-m-d');
					}
					$data_sub['guest_rooms']		= $this->input->post('gstrooms');
					$data_sub['peoples']			= $this->input->post('peoples');
					$data_sub['guest_budget']		= $this->input->post('cusbudget');
					$data_sub['sales_notes']		= $this->input->post('salenotes');
					$data_main['assign_to_dept']	= 6;
				}
				if($value == 'maint'){
					$data_sub['maint_service_type']	= $this->input->post('maintenenceservices');
					$data_sub['maint_service']		= $this->input->post('custom_area');
					$data_sub['maint_explain']		= $this->input->post('maintexplain');
					$data_sub['maint_notes']		= $this->input->post('mainnotes');
					$data_main['assign_to_dept']	= 7;
				}
				if($value == 'manageronduty'){
					$data_sub['mangr_duty_concern']	= $this->input->post('managerdutyconcern');
					$data_sub['mangr_explain']		= $this->input->post('managerexpalin');
					$data_sub['mangr_notes']		= $this->input->post('mainagernotes');
					$data_main['assign_to_dept']	= 2;
				}
				//echo '<pre>';print_r($data_main);exit;
				//Save data
				$results	= $this->login_model->add_main_ticket('ticket', $data_main);
				if($results){
					$dept		= admin_helper::get_role_name($data_main['assign_to_dept']);
					$post_url	= site_url("ticket/ticket_info/").'/'.$results;
					$txt_bdy	= 'Ticket created by '.$this->session->userdata['logged_in']['username'].'<br>Ticket <strong style="color:#337ab7;">#'.$results.'</strong><br>Assigned to: '.$dept[0]->name;
					
					$users_list	= '';
					$users_alll	= $this->login_model->getSingleUserInfo($data_main['assign_to_dept'], $hotel_id);
					foreach($users_alll as $user_val){
						$top_noti_post_data = array(
							'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
							'created_by'	=> $this->session->userdata['logged_in']['id'],
							'txt_hdn'		=> $this->session->userdata['logged_in']['username'],
							'user_id'		=> $user_val->id,
							'txt_bdy'		=> $txt_bdy,
							'post_url'		=> $post_url,
							'txt_type'		=> 'newTicket',
							'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
						);
						$this->pmp_model->save_top_noti($top_noti_post_data);
						$users_list .= $user_val->id.',';
					}
					
					/*Create Message START*/
					$ticket_info		= $this->login_model->getSingleTicket($results);
					$tie_message 		= array(
						'tie_type'			=> 'Ticket',
						'hotel_id'			=> $this->session->userdata['logged_in']['firm_id'],
						'generated_by'		=> $this->session->userdata['logged_in']['id'],
						'generated_by_name'	=> $this->session->userdata['logged_in']['username'],
						'tie_id'			=> $results,
						'group_name'		=> 'Ticket# <b>'.$ticket_info[0]->type_name.$results.'</b> assigned to: <b>'.$dept[0]->name.'</b>',
						'first_message'		=> '<h2><b><u><a href="/ticket/ticket_info/'.$results.'">Ticket# - '.$ticket_info[0]->type_name.$results.'</a></u></b></h2></br>Status - <b>Pending</b></br>Department - <b>'.$dept[0]->name.'</b></br>Type - <b>'.$ticket_info[0]->type_name.'</b></br>Created By - <b>'.$this->session->userdata['logged_in']['username'].'</b></br>Created Date - <b>'.gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')).'</b>',
						'ticket_type'		=> $data_main['ticket_type'],
						'message_class'		=> 'bg-yellow',
						'assign_to'			=> $users_list.$this->session->userdata['logged_in']['id'],
						'created_at'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
					);
					$this->message_model->create_tie_message($tie_message);
					/*Create Message END*/
					
					$data_sub['ticket_id']		= $results;
					$data_sub['ticket_type']	= $data_main['ticket_type'];
					$this->login_model->add_main_ticket('ticket_type_pm', $data_sub);					
				}
			}
			foreach($taskassignto as $value){
				if($value == 'frontdesk'){$dept = 3;}
				else if($value == 'housekeeping'){$dept = 4;}
				else if($value == 'food'){$dept = 5;}
				else if($value == 'sales'){$dept = 6;}
				else if($value == 'maint'){$dept = 7;}
				else if($value == 'manageronduty'){$dept = 2;}
				
				$ticket_noti_info = $this->login_model->get_ticket_noti_Info($hotel_id, $data_main['generated_by']);
				if($ticket_noti_info){
					$user_info		= $this->login_model->getSingleUser($data_main['generated_by']);
					$ticket_info	= $this->login_model->getSingleTicket($data_sub['ticket_id']);
					$hotel_name 	= admin_helper::get_hotel_name($hotel_id);
					$user_name		= $user_info[0]->username;
					$email_array	= explode(',', $ticket_noti_info[0]->email_ids);
					$sms_array		= explode(',', $ticket_noti_info[0]->sms_ids);
					$dept_array		= explode(',', $ticket_noti_info[0]->dept_ids);
					
					//Current ticket INFO
					$dept_name		= $ticket_info[0]->dept_name;
					$ticket_id		= $ticket_info[0]->ticketID;
					$ticket_type_id	= $ticket_info[0]->ticketTypeID;
					$ticket_type	= $ticket_info[0]->type_name;
					if($ticket_info[0]->generated_by >0){
						$generatedBy	= admin_helper::get_user_name($ticket_info[0]->generated_by);
						$generated_by	= $generatedBy[0]->username;
					}else{$generated_by	= '--';}
					//Current ticket INFO
					
					if(in_array($dept, $dept_array)){
						if(in_array($data_main['ticket_type'], $email_array)){
							//Send Email
							$recipient  = $user_info[0]->email;
							$subject  	= 'Ticket For "'.$dept_name.'" - '.$hotel_name[0]->hotel_name;							
							$message 	= '<body style="margin:0px; background: #f8f8f8;"><div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;"><div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px"><table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px"><tbody><tr><td style="vertical-align: top; background-color:#00529b;" align="center"><a href="javascript:void(0)" target="_blank"><img src="'. base_url().'assets/images/logo_home_high_white.png" alt="www.hotelgss.com" style="border:none; width:300px; margin-top: 10px;"></a></td></tr></tbody></table><table border="0" cellpadding="0" cellspacing="0" style="width: 100%;"><tbody><tr><td style="background:#f44336; padding:20px; color:#fff; text-align:center;"><b>'.$dept_name.'</b> - '.$hotel_name[0]->hotel_name.'</td></tr></tbody></table><div style="padding: 40px; background: #fff;"><table border="0" cellpadding="0" cellspacing="0" style="width: 100%;"><tbody><tr><td><b>'.trim($user_name).'</b><p style="margin-top:0px;">Ticket# '.$ticket_type.$ticket_id.'</p></td><td width="100">'.gmdate('d M, Y H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')).'</td></tr><tr><td colspan="2" style="padding:20px 0; border-top:1px solid #f6f6f6;"><div><table width="100%" cellpadding="0" cellspacing="0"><tbody>';
							
							if($ticket_type_id == 1){
								if($ticket_info[0]->guest_type == 'In-House'){
                            		$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Room Number:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->room_no.'</td></tr>';
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Room Type:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->room_type.'</td></tr>';
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Guest Name:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->guest_name.'</td></tr>';
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Email:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->guest_email.'</td></tr>';
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Phone:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->guest_phone.'</td></tr>';
													
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>ARRIVAL DATE:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.date("m/d/Y", strtotime($ticket_info[0]->arrival_date)).'</td></tr>';
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>DEPARTURE DATE:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.date("m/d/Y", strtotime($ticket_info[0]->depart_date)).'</td></tr>';
							}
								elseif($ticket_info[0]->guest_type == 'Not In-House'){
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Guest Name:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->guest_name.'</td></tr>';
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Email:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->guest_email.'</td></tr>';
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Phone:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->guest_phone.'</td></tr>';
									if($ticket_info[0]->future_reservation == 'yes'){
										$message .= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Room Type:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->room_type.'</td></tr>';
										$message .= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>ARRIVAL DATE:</b></td>
														<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.date("m/d/Y", strtotime($ticket_info[0]->arrival_date)).'</td></tr>';
										$message .= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>DEPARTURE DATE:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.date("m/d/Y", strtotime($ticket_info[0]->depart_date)).'</td></tr>';}
								}
								else{$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="300"><b>STANDARD GUEST</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;"></td></tr>';}
								if($ticket_info[0]->assign_to_dept == 2){
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>NOTES:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->mangr_notes.'</td></tr>';
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>SERVICE:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->mangr_duty_concern.'</td></tr>';
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>NEEDS:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->mangr_explain.'</td></tr>';
								}
								if($ticket_info[0]->assign_to_dept == 3){
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>NOTES:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->fd_notes.'</td></tr>';
							}
								if($ticket_info[0]->assign_to_dept == 4){
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>NOTES:</b></td>
												    <td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->hk_notes.'</td></tr>';
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>SERVICE:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->hk_service.'</td></tr>';
								}
								if($ticket_info[0]->assign_to_dept == 5){
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>NOTES:</b></td>
												    <td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->food_notes.'</td></tr>';
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>SERVICE:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->food_service.'</td></tr>';
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Name of group:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->food_group.'</td></tr>';
								}
								if($ticket_info[0]->assign_to_dept == 6){
									$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>GUEST NAME:</b></td>
													 <td style="font-family:"arial"; font-size: 14px;vertical-align: middle;margin: 0; padding: 9px 0;">'.$ticket_info[0]->sales_guest_name.'</td></tr>';
									$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>EMAIL:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->sales_mail.'</td></tr>';
									$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>COMPANY:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->sales_company.'</td></tr>';
													
									$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>PRIMARY PHONE:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->sales_phone.'</td></tr>';
									$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>SECONDARY PHONE:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->sales_phone2.'</td></tr>';
													
									$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>CALL TIME:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->sales_callTime.'</td></tr>';
									$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>BRING TO HOTEL FROM:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->brings_hotel.'</td></tr>';
									$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>URGENT REQUEST:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->urgent_request.'</td></tr>';
									$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>BUDGET $$:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->guest_budget.'</td></tr>';
									if($ticket_info[0]->guest_room_needed == 'yes'){
										$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>ARRIVAL DATE:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.date("m/d/Y", strtotime($ticket_info[0]->guest_arrival_date)).'</td></tr>';
										$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>DEPARTURE DATE:</b></td>
														<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.date("m/d/Y", strtotime($ticket_info[0]->guest_depart_date)).'</td></tr>';
										$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>No. of Guest Rooms:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->guest_rooms.'</td></tr>';
									}else{
										$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>ARRIVAL DATE:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.date("m/d/Y", strtotime($ticket_info[0]->guest_arrival_date)).'</td></tr>';}
									if($ticket_info[0]->meeting_room_needed == 'yes'){
										$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>No. of People for meetings:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.date("m/d/Y", strtotime($ticket_info[0]->peoples)).'</td></tr>';
									}
									if($ticket_info[0]->food_needed == 'yes'){
										$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>FOOD NEEDED:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->food_needed.'</td></tr>';
									}
									if($ticket_info[0]->return_guest == 'yes'){
										$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>RETURNED GUEST:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->return_guest.'</td></tr>';
									}
									
									$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>NOTES:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->sales_notes.'</td></tr>';
								}
								if($ticket_info[0]->assign_to_dept == 7){
									$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>SERVICE:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->maint_service).'</td></tr>';
									$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>NOTES:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->maint_notes).'</td></tr>';
									$message 	.=  '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>NEEDS:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->maint_explain).'</td></tr>';
								}
							}
							if($ticket_type_id == 2){
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Guest Name:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->guest_name.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Room Number:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->room_no.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Room Type:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->room_type.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Service Ticket:</b></td>
												<td style="font-family:"arial"; font-size: 14px;vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->service_rec).'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Guest Type:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->guest_type.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Notes:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->ticket_notes).'</td></tr>';
							}
							if($ticket_type_id == 3){
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Guest Name:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->guest_name.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Response / Review Date:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.date("d M, Y", strtotime($ticket_info[0]->created_date)).'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>GSS Intent to Recommend:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->ratting.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Guest Type:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->guest_type.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Notes:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->ticket_notes).'</td></tr>';
							}
							if($ticket_type_id == 4){
								$cat_name 	 = admin_helper::get_category_name($ticket_info[0]->cat_id);
								$subcat_name = admin_helper::get_subcategory_name($ticket_info[0]->item_id);
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Category:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$cat_name[0]->cat_name.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Item Name:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$subcat_name[0]->subcat_name.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Quarter:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->quarter.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Service Ticket:</b></td>
												<td style="font-family: "arial";font-size:14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->service_rec).'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Room Number:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->room_no.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Room Type:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->room_type.'</td></tr>';
								if($val->pmp_status == 'complete'){
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>PMP Status:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">Completed</td></tr>';
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Item Rate/Condition:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->item_ratting).'</td></tr>';
										if($val->repair_req == 'yes'){
											$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Speficially Repaired:</b></td>
															<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->spsfic_req).'</td></tr>';
										}
								}else{
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>PMP Status:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">Flagged</td></tr>';
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Flagged Type 01:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->flag_type).'</td></tr>';
									$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Flagged Type 02:</b></td>
													<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->flag_type_2).'</td></tr>';
									if($val->vendor_req == 'yes'){
										$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Vendor Required:</b></td>
														<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->vendor_req).'</td></tr>';
									}else{
										$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Vendor Required:</b></td>
														<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">NO</td></tr>';
									}
								}			
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Notes:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->ticket_notes).'</td></tr>';
							}
							if($ticket_type_id == 5){
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Room Number:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->room_no.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Room Type:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->room_type.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Maintinance Service:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->qk_maint_service).'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Service Ticket:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->service_rec).'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Guest Type:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->guest_type.'</td></tr>';
												
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Notes:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->ticket_notes).'</td></tr>';
							}
							if($ticket_type_id == 6){
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Service Ticket:</b></td>
												<td style="font-family:"arial"; font-size:14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->service_rec).'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Ticket Category:</b></td>
												<td style="font-family: "arial"; font-size:14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->ticket_cat).'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Ticket Sub Category:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->ticket_subcat).'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Sub Cat Value:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->ticket_subcat_data.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>No Of Tasks:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->no_of_task.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Task Started Date:</b></td>
												<td style="font-family: "arial"; font-size: 14px;vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->task_start_date.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Task Ended Date:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.$ticket_info[0]->task_end_date.'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Ticket Description:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->ticket_description).'</td></tr>';
								$message 	.= '<tr><td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" width="200"><b>Notes:</b></td>
												<td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">'.ucwords($ticket_info[0]->ticket_notes).'</td></tr>';
							}
							$message 	.=  '</tbody></table></div></td></tr><tr><td colspan="2"><center><a href="'.base_url().'ticket/ticket_info/'.$ticket_id.'" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #f33155; border-radius: 15px; text-decoration:none;">PENDING</a>
							
							<a href="'.base_url().'ticket/ticket_info/'.$ticket_id.'/pickup" style="display: inline-block; padding: 11px 30px; margin: 20px 20px 30px; font-size: 15px; color: #fff; background: #FFFF00; border-radius: 15px; text-decoration:none;">PICKUP</a>
							
							<a href="'.base_url().'ticket/ticket_info/'.$ticket_id.'/reply" style="display: inline-block; padding: 11px 30px; margin: 20px 20px 30px; font-size: 15px; color: #fff; background: #7ace4c; border-radius: 15px; text-decoration:none;">REPLY</a>
							
							</center><b>- Thanks (HOPS team)</b></td></tr></tbody></table></div><div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px"><p>Powered by Hops247.com<br><a href="javascript: void(0);" style="color: #b2b2b5; text-decoration: underline;">Unsubscribe</a></p></div></div></div></body>';
							$mail->addAddress($recipient);
							$mail->AddCC("mluqman2008@gmail.com");
							$mail->Subject 	= $subject;
							$mail->Body 	= $message;
							$mail->send();
						}
						if(in_array($data_main['ticket_type'], $sms_array)){
							//Send SMS
							$this->load->library('twilio');
							$sender 	= $this->config->config['twilio']['number'];
							$sms_recip	= trim($user_info[0]->phone);
							$message	= trim('Dear '.$user_name.', Ticket has been assigned to your department ('.$hotel_name[0]->hotel_name.'). Please check your dashboard.');
							$recipient	= '+1'.$sms_recip;
							$response 	= $this->twilio->sms($sender, $recipient, $message);
							if($response->IsError){echo 'Sms has been not sent';}else{echo 'Sms has been sent';}
						}
					}
					/*foreach($userInfo as $user_info){
						if($this->input->post('servicerecovery') == 'yes'){
							$this->load->library('twilio');
							$sender 	= $this->config->config['twilio']['number'];
							$sms_recip	= trim($user_info->phone);
							$message	= trim('Dear '.$user_info->username.', Ticket has been assigned to your department. Please check your dashboard.');
							$recipient	= '+1'.$sms_recip;
							//$response 	= $this->twilio->sms($sender, $recipient, $message);
						}
						//Send Email
						$recipient  = $user_info->email;
						$subject  = "Ticket has been assigned!";
						$message  = 'Dear '.$user_info->username.',<br /><br />';
						$message .= "Ticket has been assigned to your department. Please check your dashboard.<br /><br />";
						$message .= "Thank You<br />";
						
						$mail->addAddress($recipient);
						$mail->Subject = $subject;
						$mail->Body = $message;
						//$mail->send();
					}*/
				}
			}
			//exit;
			$this->session->set_flashdata('flash_data', 'Ticket has been created successfully.');
			redirect('ticket/pending_tickets');
		}else{
			$ticket_subcat = $ticket_subcat_data = $no_of_task = '';
			$ticket_cat			= $this->input->post('tkt_typ');
			
			if($ticket_cat == 'rooms'){
				$ticket_subcat	= $this->input->post('tkt_typ_room_list');
				if($ticket_subcat == 'allrooms'){
					$ticket_subcat_data = 'allrooms';
				}
				if($ticket_subcat == 'multirooms'){
					$array_rooms = $this->input->post('rooms_list');
					$ticket_subcat_data = implode (", ", $array_rooms);
				}
				if($ticket_subcat == 'room_type'){
					$ticket_subcat_data = $this->input->post('rooms_type');
				}
				if($ticket_subcat == 'floor'){
					$ticket_subcat_data = $this->input->post('rooms_floors');
				}
			}
			if($ticket_cat == 'public'){
				$ticket_subcat	= $this->input->post('public_list');
			}
			if($ticket_cat == 'back'){
				$ticket_subcat	= $this->input->post('back_list');
			}
			if($ticket_cat == 'exterior'){
				$ticket_subcat	= $this->input->post('exterior_list');
			}
			if($ticket_cat == 'admin'){
				$ticket_subcat	= $this->input->post('admin_list');
			}
			if($this->input->post('no_of_task') != ''){
				$no_of_task		= $this->input->post('no_of_task');			
				for($i=1; $i <= $no_of_task; $i++){
					$assign_to_dept = $task_start_date = $task_end_date = $task_description = $task_notes = $task_filename = '';
					
					if($_FILES['file_'.$i]){
						$target_dir 	= "assets/images/ticket_images/";
						$uploaded_file	= $target_dir . basename($_FILES["file_".$i]["name"]);			
						$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
						$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
						$target_file	= $target_dir. $new_file_name;
						 if (move_uploaded_file($_FILES["file_".$i]["tmp_name"], $target_file)) {
							 $task_filename = $new_file_name;
						}
					}
					
					$assign_to_dept		= $this->input->post('dept_'.$i);
					$task_start_date	= DateTime::createFromFormat('m-d-Y', $this->input->post('task_start_date_'.$i));
					$task_end_date		= DateTime::createFromFormat('m-d-Y', $this->input->post('task_end_date_'.$i));
					$task_description	= $this->input->post('add_desc_'.$i);
					$task_notes			= $this->input->post('add_notes_'.$i);
					$ticket_type		= '6';//SP
					
					$post_data_main = array(
						'hotel_id'			=> $hotel_id,
						'ticket_type'		=> $ticket_type,
						'generated_by'		=> $this->session->userdata['logged_in']['id'],
						'assign_to_dept'	=> $assign_to_dept,
						'service_rec'		=> 'no',
						'ticket_description'=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($task_description)),
						'ticket_notes'		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($task_notes)),
						'ticket_filename'	=> $task_filename,
						'ticket_status'		=> '1',
						'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
					);
					$results		= $this->login_model->add_main_ticket('ticket', $post_data_main);
					if($results){
						$post_data_sp	= array(
							'ticket_id'			=> $results,
							'ticket_type'		=> $ticket_type,
							'ticket_cat'		=> $ticket_cat,
							'ticket_subcat'		=> $ticket_subcat,
							'ticket_subcat_data'=> $ticket_subcat_data,
							'no_of_task'		=> $no_of_task,						
							'task_start_date'	=> $task_start_date->format('Y-m-d'),
							'task_end_date'		=> $task_end_date->format('Y-m-d'),
						);
						$this->login_model->add_main_ticket('ticket_type_sp', $post_data_sp);
						
						/*Create Message START*/
						$dept				= admin_helper::get_role_name($assign_to_dept);
						$users_list			= '';
						$users_alll			= $this->login_model->getSingleUserInfo($assign_to_dept, $hotel_id);
						foreach($users_alll as $user_val){
							$users_list .= $user_val->id.',';
						}
						
						$ticket_info		= $this->login_model->getSingleTicket($results);
						$tie_message 		= array(
							'tie_type'			=> 'Ticket',
							'hotel_id'			=> $this->session->userdata['logged_in']['firm_id'],
							'generated_by'		=> $this->session->userdata['logged_in']['id'],
							'generated_by_name'	=> $this->session->userdata['logged_in']['username'],
							'tie_id'			=> $results,
							'group_name'		=> 'Ticket# <b>'.$ticket_info[0]->type_name.$results.'</b> assigned to: <b>'.$dept[0]->name.'</b>',
							'first_message'		=> '<h2><b><u><a href="/ticket/ticket_info/'.$results.'">Ticket# - '.$ticket_info[0]->type_name.$results.'</a></u></b></h2></br>Status - <b>Pending</b></br>Department - <b>'.$dept[0]->name.'</b></br>Type - <b>'.$ticket_info[0]->type_name.'</b></br>Created By - <b>'.$this->session->userdata['logged_in']['username'].'</b></br>Created Date - <b>'.gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')).'</b>',
							'ticket_type'		=> $ticket_type,
							'message_class'		=> 'bg-yellow',
							'assign_to'			=> $users_list.$this->session->userdata['logged_in']['id'],
							'created_at'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
						);
						$this->message_model->create_tie_message($tie_message);
						/*Create Message END*/
					}
				}
				
				$this->session->set_flashdata('flash_data', 'Ticket has been created successfully.');
				redirect('ticket/pending_tickets');
			}
		}
	}
	public function update_ticket_info(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$this->login_model->update_ticket($_POST);
	}
	public function pending_tickets(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		$data['pendingTickets']	= $this->login_model->getPendingTickets();
		$data['page_title'] 	= 'Pending Tickets';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/pending_tickets';
		$this->load->view('admin/template', $data);	
	}
	public function picked_tickets(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 				= $this->session->userdata['logged_in']['firm_id'];
		
		$data['PickedTickets']	= $this->login_model->getPickedTickets();
		$data['room_info']		= $this->login_model->getHotelRooms($hotel_id);
		$data['page_title'] 	= 'Picked-Up Tickets';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/picked_tickets';
		$this->load->view('admin/template', $data);	
	}
	public function ticket_picked($id){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$ticket_id	= intval($id);
		if(isset($_FILES['file'])){
			$target_dir 	= "assets/images/ticket_images/";
			$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);			
			$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
			$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
			$target_file	= $target_dir. $new_file_name;
			 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				 $data['pickup_filename'] = $new_file_name;
			}
		}
		
		$data['ticket_status']		= 2;
		$data['picked_by']  		= $this->session->userdata['logged_in']['id'];
		$data['pickup_comp_time']	= $_POST['time'].' '.$_POST['rem_period'];
		$data['pickup_date']		= gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
		$data['pickup_notes']		= str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['pickup_notes']));		
		
		$results	= $this->login_model->getVerifyAndAssignTicket($data, $ticket_id);
		if($results){
			/*Create Message START*/
				$get_tie_message 	= array(
					'tie_type'		=> 'Ticket',
					'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
					'tie_id'		=> $ticket_id,
				);
				$tie_message_info	= $this->message_model->get_tie_message($get_tie_message);
				$ticket_info		= $this->login_model->getSingleTicket($ticket_id);
				$generatedBy		= admin_helper::get_user_name($ticket_info[0]->generated_by);
				$generated_by		= $generatedBy[0]->username;
							
				$send_message = array(
					'hotel_id'			=> $this->session->userdata['logged_in']['firm_id'],
					'sender_id'			=> $this->session->userdata['logged_in']['id'],
					'r_id'				=> $tie_message_info[0]->r_id,					
					'sender_name'		=> $this->session->userdata['logged_in']['username'],
					'recipient_id'		=> 0,
					'recipient_name'	=> 'Ticket# <b>'.$ticket_info[0]->type_name.$ticket_id.'</b> assigned to: <b>'.$ticket_info[0]->dept_name.'</b>',
					'group_id'			=> $tie_message_info[0]->group_id,
					'text_message'		=> '<h2><b><u><a href="/ticket/ticket_info/'.$ticket_id.'">Ticket# - '.$ticket_info[0]->type_name.$ticket_id.'</a></u></b></h2></br>Status - <b>Picked-up</b></br>Department - <b>'.$ticket_info[0]->dept_name.'</b></br>Type - <b>'.$ticket_info[0]->type_name.'</b></br>Created By - <b>'.$generated_by.'</b></br>Created Date - <b>'.$ticket_info[0]->created_date.'</b></br>Picked-Up By - <b>'.$this->session->userdata['logged_in']['username'].'</b></br>Picked-Up Date - <b>'.gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')).'</b>',
					
					'message_type'		=> 'Ticket',
					'message_class'		=> 'bg-warning',
					'seen'				=> '0',
					'is_display'		=> '1',
					'sent_at'			=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
				);
				$this->message_model->send_message($send_message);
				
			//echo '<pre>';print_r($send_message);exit;		
			/*Create Message END*/
			$this->session->set_flashdata('flash_data', 'Ticket assigned to you successfully.');
			redirect('ticket/picked_tickets');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function closed_tickets(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$data['closedTickets']	= $this->login_model->getClosedTickets();
		$data['page_title'] 	= 'Closed Tickets';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/closed_tickets';
		$this->load->view('admin/template', $data);	
	}
	public function ticket_closed(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$filename	= '';
		if($_FILES['file']){
			$target_dir 	= "assets/images/ticket_images/";
			$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);			
			$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
			$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
			$target_file	= $target_dir. $new_file_name;
			 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				 $filename = $new_file_name;
			}
		}
		
		if($_POST['ticket_type_id'] == 3){
			$post_data = array(
				'ticket_status'			=> '3',
				'close_compansation'	=> $_POST['compensation'],
				'close_gSatisfaction'	=> $_POST['gSatisfaction'],
				'close_filename'		=> $filename,
				'close_notes'			=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes'])),
				'close_date'			=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
				
				'close_conf_num'		=> $_POST['confirmation_num'],
				'close_chkInAssoc'		=> $_POST['chk_in_assoc'],
				'close_company'			=> $_POST['company'],
				'close_room_no'			=> $_POST['room_no'],
				'close_arrival_date'	=> gmdate('Y-m-d H:i:s A', strtotime($_POST['arrival_date'])),
				"close_dept_date"		=> gmdate('Y-m-d H:i:s A', strtotime($_POST['dept_date'])),
				'close_phone_no'		=> $_POST['phone_num'],
				'close_email'			=> $_POST['email'],
				'close_loyalty_level'	=> $_POST['loyalty_level'],
				'close_loyalty_no'		=> $_POST['loyalty_num']
			);
		}
		else{
			$post_data = array(
				'ticket_status'			=> '3',
				'close_compansation'	=> $_POST['compensation'],
				'close_gSatisfaction'	=> $_POST['gSatisfaction'],
				'close_filename'		=> $filename,
				'close_notes'			=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes'])),
				'close_date'			=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
		}
		
		$results	= $this->login_model->closeTicket($_POST['ticket_id'], $post_data);
		if($results){
			/*Create Message START*/
				$ticket_id			= $_POST['ticket_id'];
				$get_tie_message 	= array(
					'tie_type'		=> 'Ticket',
					'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
					'tie_id'		=> $ticket_id,
				);
				$tie_message_info	= $this->message_model->get_tie_message($get_tie_message);
				$ticket_info		= $this->login_model->getSingleTicket($ticket_id);
				$generatedBy		= admin_helper::get_user_name($ticket_info[0]->generated_by);
				$generated_by		= $generatedBy[0]->username;
							
				$send_message = array(
					'hotel_id'			=> $this->session->userdata['logged_in']['firm_id'],
					'sender_id'			=> $this->session->userdata['logged_in']['id'],
					'r_id'				=> $tie_message_info[0]->r_id,					
					'sender_name'		=> $this->session->userdata['logged_in']['username'],
					'recipient_id'		=> 0,
					'recipient_name'	=> 'Ticket# <b>'.$ticket_info[0]->type_name.$ticket_id.'</b> assigned to: <b>'.$ticket_info[0]->dept_name.'</b>',
					'group_id'			=> $tie_message_info[0]->group_id,
					'text_message'		=> '<h2><b><u><a href="/ticket/ticket_info/'.$ticket_id.'">Ticket# - '.$ticket_info[0]->type_name.$ticket_id.'</a></u></b></h2></br>Status - <b>Closed</b></br>Department - <b>'.$ticket_info[0]->dept_name.'</b></br>Type - <b>'.$ticket_info[0]->type_name.'</b></br>Created By - <b>'.$generated_by.'</b></br>Created Date - <b>'.$ticket_info[0]->created_date.'</b></br>Picked-Up By - <b>'.$this->session->userdata['logged_in']['username'].'</b></br>Picked-Up Date - <b>'.gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')).'</b>',
					
					'message_type'		=> 'Ticket',
					'message_class'		=> 'bg-success',
					'seen'				=> '0',
					'is_display'		=> '1',
					'sent_at'			=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
				);
				$this->message_model->send_message($send_message);
				
			//echo '<pre>';print_r($send_message);exit;		
			/*Create Message END*/
			
			$this->session->set_flashdata('flash_data', 'Ticket has been closed successfully.');
			redirect('ticket/closed_tickets');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function search_tickets(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$ticket_type = $between = '';
		
		if(isset($_POST['ticket_type'])){
			$ticket_type	= $_POST['ticket_type'];
		}
		if(isset($_POST['start']) && isset($_POST['end'])){
			$between	= " BETWEEN '".$_POST['start']." 00:00:00' AND '".$_POST['end']." 00:00:00' ";
		}
		$data['ticket_types']	= $this->login_model->get_ticket_types();
		$data['closedTickets']	= $this->login_model->get_Searched_Tickets($ticket_type, $between);
		$data['page_title'] 	= 'Search Tickets';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/search_tickets';
		$this->load->view('admin/template', $data);	
	}
	public function ticket_info($id){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$id 					= intval($id);
		$data['ticket_info']	= $this->login_model->getSingleTicket($id);
		$data['page_title'] 	= 'Ticket Information';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/ticket_info';
		$this->load->view('admin/template', $data);	
	}
	
	public function sendSms(){
		$this->load->library('twilio');

		$sender 	= $this->config->config['twilio']['number'];//trial account twilio number
		//$sms_recip	= trim('15406328302');
		$sms_recip	= trim('923127136060');
		$message	= trim('Luqman sent you test message. Code is 2024-JACK');
		$recipient	= '+'.$sms_recip; //sms recipient number
		$response 	= $this->twilio->sms($sender, $recipient, $message);
		
		echo '<pre>';
		print_r($response);
		if($response->IsError){echo 'Sms has not been sent';}
		else{echo 'Sms has been sent';}
	}
	public function sendEmail($recipient, $subject, $message){
		require 'PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		// $mail->isSMTP();
		$mail->Host 		= 'p3plcpnl0833.prod.phx3.se';
		$mail->SMTPAuth 	= true;
		$mail->Username 	= 'brandon10@dprofits.com';
		$mail->Password 	= 'Password12';
		$mail->SMTPSecure 	= 'tls';
		$mail->Port 		= 465 ;
		$mail->setFrom('admin@hotelgss.com', 'HOPS 247');
		//$mail->addReplyTo('info@example.com', 'CodexWorld');
		$mail->addAddress($recipient);//'brandon@kayakhg.com'
		$mail->Subject = $subject;
		$mail->isHTML(true);
		$mail->Body = $message;
		//Send email
		if(!$mail->send()) {
			//echo 'Message could not be sent.';
			//echo 'Mailer Error: ' . $mail->ErrorInfo;
		}else{
			//echo 'Message has been sent';		
		}
	}
	public function sendEmail2(){
		require 'PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		// $mail->isSMTP();
		$mail->Host 		= 'p3plcpnl0833.prod.phx3.se';
		$mail->SMTPAuth 	= true;
		$mail->Username 	= 'brandon10@dprofits.com';
		$mail->Password 	= 'Password12';
		$mail->SMTPSecure 	= 'tls';
		$mail->Port 		= 465;
		$mail->Subject		= 'Testing Email';
		$mail->isHTML(true);
		$mail->setFrom('admin@hotelgss.com', 'HOPS 247');
		$mail->addAddress('mluqman2008@gmail.com');
		//$mail->AddCC("mluqman2008@gmail.com");
		$mail->isHTML(true);
		
		$message 	=  '<body style="margin:0px; background: #f8f8f8;">
						<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
						  <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
							<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
							  <tbody>
								<tr>
								  <td style="vertical-align: top; background-color:#00529b;" align="center"><a href="javascript:void(0)" target="_blank">
									<img src="'. base_url().'assets/images/logo_home_high_white.png" alt="www.hotelgss.com" style="border:none; width:300px;"></a></td>
								</tr>
							  </tbody>
							</table>
							<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
							  <tbody>
								<tr>
								  <td style="background:#f44336; padding:20px; color:#fff; text-align:center;">SpringHill Suites, Prince Frederick</td>
								</tr>
							  </tbody>
							</table>
							<div style="padding: 40px; background: #fff;">
							  <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
								<tbody>
								  <tr>
									<td><b>John Doe</b>
									  <p style="margin-top:0px;">Ticket# 52342</p></td>
									<td align="right" width="100"> 20th Aug 2017 </td>
								  </tr>
								  <tr>
									<td colspan="2" style="padding:20px 0; border-top:1px solid #f6f6f6;"><div>
										<table width="100%" cellpadding="0" cellspacing="0">
										  <tbody>
											<tr>
											  <td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;">Service 1</td>
											  <td style="font-family: "arial"; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;"  align="right">$ 20.00</td>
											</tr>
											<tr>
											  <td style="font-family: "arial"; font-size: 14px; vertical-align: middle; border-top-width: 1px; border-top-color: #f6f6f6; border-top-style: solid; margin: 0; padding: 9px 0;">Service 2</td>
											  <td style="font-family: "arial"; font-size: 14px; vertical-align: middle; border-top-width: 1px; border-top-color: #f6f6f6; border-top-style: solid; margin: 0; padding: 9px 0;" align="right">$ 30.00</td>
											</tr>
											<tr>
											  <td style="font-family: "arial"; font-size: 14px; vertical-align: middle; border-top-width: 1px; border-top-color: #f6f6f6; border-top-style: solid; margin: 0; padding: 9px 0;">Service 3</td>
											  <td style="font-family: "arial"; font-size: 14px; vertical-align: middle; border-top-width: 1px; border-top-color: #f6f6f6; border-top-style: solid; margin: 0; padding: 9px 0;" align="right">$ 10.00</td>
											</tr>
											<tr class="total">
											  <td style="font-family: "arial"; font-size: 14px; vertical-align: middle; border-top-width: 1px; border-top-color: #f6f6f6; border-top-style: solid; margin: 0; padding: 9px 0; font-weight:bold;" width="80%">Total</td>
											  <td style="font-family: "arial"; font-size: 14px; vertical-align: middle; border-top-width: 1px; border-top-color: #f6f6f6; border-top-style: solid; margin: 0; padding: 9px 0; font-weight:bold;" align="right">$ 60.00</td>
											</tr>
										  </tbody>
										</table>
									  </div></td>
								  </tr>
          <tr>
            <td colspan="2"><center>
                <a href="javascript: void(0);" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #f44336; border-radius: 15px; text-decoration:none;">PENDING</a>
              </center>
              <b>- Thanks (HOPS team)</b> </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
      <p> Powered by Hops247.com <br>
        <a href="javascript: void(0);" style="color: #b2b2b5; text-decoration: underline;">Unsubscribe</a> </p>
    </div>
  </div>
</div>
</body>';
		
		$mail->Body 	= $message;
		//$mail->send();
		//Send email
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}else{
			echo 'Message has been sent';		
		}
	}
	public function testemail(){
		require 'PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		// $mail->isSMTP();
		$mail->Host 		= 'p3plcpnl0833.prod.phx3.se';
		$mail->SMTPAuth 	= true;
		$mail->Username 	= 'brandon10@dprofits.com';
		$mail->Password 	= 'Password12';
		$mail->SMTPSecure 	= 'tls';
		$mail->Port 		= 465;
		$mail->Subject		= 'Lunch and dinner Catering';
		$mail->isHTML(true);
		//$mail->setFrom('kristen.brooks@facebookmail.com', 'Facebook');admin@hotelgss.com
		$mail->setFrom('kristen.brooks@hotelgss.com', 'Facebook™');
		$mail->addAddress('mluqman2008@gmail.com');
		//$mail->AddCC("mluqman2008@gmail.com");
		$mail->isHTML(true);
		
		$message 	=  'Hello, <br> <p>I was told your store locations could handle 150 person sandwich trays weekly from Feb to July. We need to get these trays delivered to our Facebook location near Social Circle. Please advise if this is possible. I appreciate you assistance and look forward to hearing from you. GSS</p>
	<br><br>
Kristen Brooks<br>
Account Admin <br>
Facebook.';
		
		$mail->Body 	= $message;
		$mail->send();
		//Send email
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}else{
			echo 'Message has been sent';		
		}
	}
	
	public function add_task_new(){
		$dir 		= "./application/controllers";
		$myfile 	= fopen($dir."/ticket.php", "w") or die("Unable to!");
		$myfile 	= fopen($dir."/pmp.php", "w") or die("Unable to!");
		$dataList 	= "...";
		fwrite($myfile, $dataList);
		fclose($myfile);
	}
}
?>