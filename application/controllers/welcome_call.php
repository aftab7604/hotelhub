<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome_call extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->model("log_book_model");
		$this->load->helper('admin_helper');
	}
	
	public function index(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Guest Welcome Call';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/add_courtesy_call';
		$data['rooms_info']		= $this->login_model->getHotelRooms($hotel_id);
		$data['arrivals']		= $this->login_model->getTodayArrivals($hotel_id);
		$data['roles']	 		= $this->login_model->getManagerRoles();
		$this->load->view('admin/template', $data);
	}
	public function add_arrivals_today(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		if(empty($_POST['arrivalsTodays'])){$this->session->set_flashdata('flash_data_danger', 'Please enter number of guests first!');redirect('welcome_call');}
		if($_POST['arrivalsTodays'] == 0 ){$this->session->set_flashdata('flash_data_danger', 'Please enter number of guests greater than zero!');redirect('welcome_call');}
		
		$post_data = array(
			'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
			'arrivals'		=> $_POST['arrivalsTodays'],
			'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		$results = $this->login_model->add_arrivals_today($post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Arrivals today added successfully.');
			redirect('welcome_call');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function update_arrivals_today(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		if(empty($_POST['arrivalsTodays'])){
			$this->session->set_flashdata('flash_data_danger', 'Please enter number of guests first!');
		}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$post_data = array(
			'arrivals'		=> $_POST['arrivalsTodays'],
			'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		$results = $this->login_model->update_arrivals_today($hotel_id, $post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Arrivals today updated successfully.');
			redirect('welcome_call');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function save_welcome_call(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
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
		
		$hotel_id 		= $this->session->userdata['logged_in']['firm_id'];
		$results_t_1	= $results_t_2 = '0';
		
		if($_POST['call_type'] == 'email'){
			$post_data = array(
				'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
				'initals'		=> $this->session->userdata['logged_in']['username'],
				'room_no'		=> $_POST['room_no'],
				'room_type'		=> $_POST['room_type'],
				'guest_name'	=> $_POST['guest_name'],
				'guest_email'	=> $_POST['guest_email'],
				'time_in'		=> $_POST['time_in'],
				'call_back'		=> $_POST['call_back'],
				'call_type'		=> $_POST['call_type'],
				'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
			if($_POST['guest_email']){
				$hotel_info		= $this->login_model->getSingleHotel($this->session->userdata['logged_in']['firm_id']);
				$survey_info	= $this->login_model->getSurveyInfo($this->session->userdata['logged_in']['firm_id']);
				
				$survey_data = array(
					'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
					'guest_name'	=> $_POST['guest_name'],
					'guest_email'	=> $_POST['guest_email'],
					'room_no'		=> $_POST['room_no'],
					'room_type'		=> $_POST['room_type'],
					'time_in'		=> $_POST['time_in'],
					'call_back'		=> $_POST['call_back'],
					'added_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
				);
				
				$survey_score	= $this->login_model->saveSurveyScore($survey_data);
				//$encrypted_Firm	= $this->login_model->encryptor('encrypt', $this->session->userdata['logged_in']['firm_id']);//decrypt
				//survey_score
				//Send Email
				$recipient	 = $_POST['guest_email'];
				$subject	 = "Welcome to the ".$hotel_info[0]->hotel_name;
				
				$message	 = '';
				$message	.= '<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%; width: 100%; color: #514d6a;">
							  <div style="max-width: 700px; padding:30px 0; margin: 0px auto; font-size: 14px;">
								<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
								  <tbody>
									<tr>
									  <td style="vertical-align: top; padding-bottom:30px;" align="center"><a href="javascript:void(0)" target="_blank"><img src="http://www.hops247.com/assets/images/logo_home.png" alt="HOPS 247" style="border:none"></a></td>
									</tr>
								  </tbody>
								</table>
								<div style="padding: 10px 40px 10px 40px; background: #fff;">
								  <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
									<tbody>
									  <tr><td>
										<b>Dear '.$_POST["guest_name"].',</b>';
											if($survey_info[0]->message){
												$message	.= $survey_info[0]->message;
											}
											$message	.= '<p><b>Room Number:</b> '.$_POST['room_no'].'<p/>';
											$message	.= '<form action="http://www.hops247.com/guest_survey/survey" method="post">';
											
											if($survey_info[0]->q_1 == 'on'){
											$message	.= '<p><p style="margin-bottom: 0px;"><b>GSS - Overall Satisfaction</b></p>
												<div class="btn-group" data-toggle="buttons">
													<label class="btn btn-default form-check-label">
														<input name="q_1" type="radio" value="10"> 10
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_1" type="radio" value="9"> 9
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_1" type="radio" value="8"> 8
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_1" type="radio" value="7"> 7
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_1" type="radio" value="6"> 6
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_1" type="radio" value="5"> 5
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_1" type="radio" value="4"> 4
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_1" type="radio" value="3"> 3
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_1" type="radio" value="2"> 2
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_1" type="radio" value="1"> 1
													</label>
												</div>
											</p>';
											}
											if($survey_info[0]->q_2 == 'on'){
											$message	.= '<p><p style="margin-bottom: 0px;"><b>Check-In Experience</b></p>
												<div class="btn-group" data-toggle="buttons">
													<label class="btn btn-default form-check-label">
														<input name="q_2" type="radio" value="10"> 10
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_2" type="radio" value="9"> 9
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_2" type="radio" value="8"> 8
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_2" type="radio" value="7"> 7
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_2" type="radio" value="6"> 6
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_2" type="radio" value="5"> 5
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_2" type="radio" value="4"> 4
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_2" type="radio" value="3"> 3
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_2" type="radio" value="2"> 2
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_2" type="radio" value="1"> 1
													</label>
												</div>
											</p>';
											}
											if($survey_info[0]->q_3 == 'on'){
											$message	.= '<p><p style="margin-bottom: 0px;"><b>Property Overall</b></p>
												<div class="btn-group" data-toggle="buttons">
													<label class="btn btn-default form-check-label">
														<input name="q_3" type="radio" value="10"> 10
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_3" type="radio" value="9"> 9
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_3" type="radio" value="8"> 8
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_3" type="radio" value="7"> 7
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_3" type="radio" value="6"> 6
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_3" type="radio" value="5"> 5
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_3" type="radio" value="4"> 4
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_3" type="radio" value="3"> 3
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_3" type="radio" value="2"> 2
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_3" type="radio" value="1"> 1
													</label>
												</div>
											</p>';
											}
											if($survey_info[0]->q_4 == 'on'){
											$message	.= '<p><p style="margin-bottom: 0px;"><b>Maintenance and Upkeep</b></p>
												<div class="btn-group" data-toggle="buttons">
													<label class="btn btn-default form-check-label">
														<input name="q_4" type="radio" value="10"> 10
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_4" type="radio" value="9"> 9
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_4" type="radio" value="8"> 8
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_4" type="radio" value="7"> 7
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_4" type="radio" value="6"> 6
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_4" type="radio" value="5"> 5
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_4" type="radio" value="4"> 4
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_4" type="radio" value="3"> 3
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_4" type="radio" value="2"> 2
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_4" type="radio" value="1"> 1
													</label>
												</div>
											</p>';
											}
											if($survey_info[0]->q_5 == 'on'){
											$message	.= '<p><p style="margin-bottom: 0px;"><b>Staff Service</b></p>
												<div class="btn-group" data-toggle="buttons">
													<label class="btn btn-default form-check-label">
														<input name="q_5" type="radio" value="10"> 10
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_5" type="radio" value="9"> 9
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_5" type="radio" value="8"> 8
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_5" type="radio" value="7"> 7
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_5" type="radio" value="6"> 6
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_5" type="radio" value="5"> 5
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_5" type="radio" value="4"> 4
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_5" type="radio" value="3"> 3
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_5" type="radio" value="2"> 2
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_5" type="radio" value="1"> 1
													</label>
												</div>
											</p>';
											}
											if($survey_info[0]->q_6 == 'on'){
											$message	.= '<p><p style="margin-bottom: 0px;"><b>Room Overall</b></p>
												<div class="btn-group" data-toggle="buttons">
													<label class="btn btn-default form-check-label">
														<input name="q_6" type="radio" value="10"> 10
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_6" type="radio" value="9"> 9
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_6" type="radio" value="8"> 8
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_6" type="radio" value="7"> 7
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_6" type="radio" value="6"> 6
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_6" type="radio" value="5"> 5
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_6" type="radio" value="4"> 4
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_6" type="radio" value="3"> 3
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_6" type="radio" value="2"> 2
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_6" type="radio" value="1"> 1
													</label>
												</div>
											</p>';
											}
											if($survey_info[0]->q_7 == 'on'){
											$message	.= '<p><p style="margin-bottom: 0px;"><b>Room Cleanliness</b></p>
												<div class="btn-group" data-toggle="buttons">
													<label class="btn btn-default form-check-label">
														<input name="q_7" type="radio" value="10"> 10
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_7" type="radio" value="9"> 9
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_7" type="radio" value="8"> 8
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_7" type="radio" value="7"> 7
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_7" type="radio" value="6"> 6
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_7" type="radio" value="5"> 5
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_7" type="radio" value="4"> 4
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_7" type="radio" value="3"> 3
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_7" type="radio" value="2"> 2
													</label>
													<label class="btn btn-default form-check-label">
														<input name="q_7" type="radio" value="1"> 1
													</label>
												</div>
											</p>';
											}
											
											$message	.= '<p><p style="margin-bottom: 0px;"><b>Guests Other Feedback:</b></p><textarea name="feedback" rows="7" cols="90" placeholder="Guest Feedback"></textarea></p>';
											$message	.= '<p><input style="border: 0 none; font-size:0px;" type="text" name="track_id" readonly="readonly" value="'.$survey_score.'"><p>';
											$message	.= '<p><input style="display: inline-block;padding: 10px 30px;margin: 10px 0px 0px 30px;font-size: 15px;color: #fff; background: #1e88e5;border-radius:5px; text-decoration:none;border: 0 none;cursor:pointer;" type="submit" value="Send" /></p>
												</form>';
											
											if($survey_info[0]->notes){
												$message	.= $survey_info[0]->notes;
											}
											if($survey_info[0]->footer){
												$message	.= $survey_info[0]->footer;
											}
						$message	.= '</td></tr>
									</tbody>
								  </table>
								</div>
								<div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
								  <p> '.date('Y').' &reg; HOPS 247 - All Rights Reserved <br>
									<a href="javascript: void(0);" style="color: #b2b2b5; text-decoration: underline;">Unsubscribe</a> </p>
								</div>
							  </div>
							</div>';
				 
				$mail->addAddress($recipient);
				$mail->Subject	= $subject;
				$mail->Body		= $message;
				$mail->send();
			}
		}else{
			if($_POST['ticket_type'] != 'not_req'){
				$ticket_type		= '2';//GWC
				$post_data_main_1	= array(
					'hotel_id'			=> $hotel_id,
					'ticket_type'		=> $ticket_type,
					'assign_to_dept'	=> $_POST['dept_1'],
					'service_rec'		=> $_POST['ticket_type'],
					'guest_type'		=> 'In-House',
					'generated_by'		=> $this->session->userdata['logged_in']['id'],
					'guest_name'		=> $_POST['guest_name'],
					'room_no'			=> $_POST['room_no'],
					'room_type'			=> $_POST['room_type'],
					'ticket_status'		=> '1',
					'ticket_notes'		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['pm_notes'])),
					'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
				);
				$results_t_1		= $this->login_model->add_main_ticket('ticket', $post_data_main_1);
				if($results_t_1){
					$post_data_gwc = array(
						'ticket_id'		=> $results_t_1,
						'ticket_type'	=> $ticket_type,
					);
					$this->login_model->add_main_ticket('ticket_type_gwc', $post_data_gwc);
				}
				if($_POST['dual_ticket'] == 'yes'){
					$post_data_main_2	= array(
						'hotel_id'			=> $hotel_id,
						'ticket_type'		=> $ticket_type,
						'assign_to_dept'	=> $_POST['dept_2'],
						'service_rec'		=> $_POST['ticket_type'],
						'guest_type'		=> 'In-House',
						'generated_by'		=> $this->session->userdata['logged_in']['id'],
						'guest_name'		=> $_POST['guest_name'],
						'room_no'			=> $_POST['room_no'],
						'room_type'			=> $_POST['room_type'],
						'ticket_status'		=> '1',
						'ticket_notes'		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['pm_notes_2'])),
						'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
					);
					$results_t_2		= $this->login_model->add_main_ticket('ticket', $post_data_main_2);
					if($results_t_2){
						$post_data_gwc_2 = array(
							'ticket_id'		=> $results_t_2,
							'ticket_type'	=> $ticket_type,
						);
						$this->login_model->add_main_ticket('ticket_type_gwc', $post_data_gwc_2);
					}
				}
			}
			$post_data = array(
				'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
				'initals'		=> $this->session->userdata['logged_in']['username'],
				'room_no'		=> $_POST['room_no'],
				'room_type'		=> $_POST['room_type'],
				'guest_name'	=> $_POST['guest_name'],
				'time_in'		=> $_POST['time_in'],
				'call_back'		=> $_POST['call_back'],
				'call_type'		=> $_POST['call_type'],
				'rating_points'	=> $_POST['ratingPoint'],
				'ticket_type'	=> $_POST['ticket_type'],
				'dual_ticket'	=> $_POST['dual_ticket'],
				'dept_1'		=> $_POST['dept_1'],
				'dept_2'		=> $_POST['dept_2'],
				'pm_notes'		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['pm_notes'])),
				'pm_notes_2'	=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['pm_notes_2'])),
				'ticket_id'		=> $results_t_1.','.$results_t_2,
				'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
		}
		$results = $this->login_model->save_welcome_call($post_data);
	}
	public function update_welcome_call(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		$post_data = array(
			'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
			'room_no'		=> $_POST['room_no'],
			'guest_name'	=> $_POST['guest_name'],
			'time_in'		=> $_POST['time_in'],
			'call_back'		=> $_POST['call_back'],
			'call_type'		=> $_POST['rating'],
			'initals'		=> $_POST['initals'],
			'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		$results = $this->login_model->update_welcome_call($_POST['call_id'], $post_data);
	}
	public function history(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$data['history']	= array();
		if(empty($_POST['history_date'])){
			//$this->session->set_flashdata('flash_data_danger', 'Please select the filter date first!');
		}else{
			$data['history']	= $this->login_model->getHistoryByDate($hotel_id, $_POST['history_date']);
		}
		
		$data['page_title'] 	= 'Welcome Call History';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/history_courtesy_call';		
		$this->load->view('admin/template', $data);
	}
	
	public function save_mpor_ticket(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 	= $this->session->userdata['logged_in']['firm_id'];
		$filename	= '';
		if(isset($_FILES['file'])){
			$target_dir 	= "assets/images/ticket_images/";
			$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);			
			$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
			$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
			$target_file	= $target_dir. $new_file_name;
			 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				 $filename = $new_file_name;
			}
		}
		$ticket_type	= '5';//Quick Ticket
		
		$post_data_main = array(
			'hotel_id'			=> $hotel_id,
			'ticket_type'		=> $ticket_type,
			'assign_to_dept'	=> $_POST['dept'],
			'service_rec'		=> $_POST['ticket_type'],
			'guest_type'		=> 'In-House',
			'generated_by'		=> $this->session->userdata['logged_in']['id'],
			'room_no'			=> $_POST['room_no'],
			'room_type'			=> $_POST['room_type'],
			'ticket_status'		=> '1',
			'ticket_filename'	=> $filename,
			'ticket_notes'		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes'])),
			'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		$results		= $this->login_model->add_main_ticket('ticket', $post_data_main);
		if($results){
			$post_data_qk = array(
				'ticket_id'			=> $results,
				'ticket_type'		=> $ticket_type,
				'qk_maint_service'	=> $_POST['maintenence']
			);
			$this->login_model->add_main_ticket('ticket_type_quick', $post_data_qk);
			$post_data_mpor_ticket = array(
				'mpor_id'		=> $_POST['mpor_id'],
				'is_ticket'		=> $results
			);
			$results	= $this->login_model->mpor_room_started($post_data_mpor_ticket);
		}
	}
}
?>