<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guest_survey extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->model("log_book_model");
		$this->load->helper('admin_helper');
		$this->load->helper('survey_helper');
	}
	public function manage(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Guest Survey';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/add_guest_survey';
		$data['survey_info']	= $this->login_model->getSurveyInfo($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function save_guest_survey(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$results 	= $this->login_model->updateSurveyInfo($hotel_id, $_POST);
	}
	//Survey function will save data from email
	public function survey(){
		$track_id = '';
		$feedback = '';
		$q_1=$q_2=$q_3=$q_4=$q_5=$q_6=$q_7= 'N/s';
		
		if(isset($_POST['q_1'])){$q_1 = $_POST['q_1'];}
		if(isset($_POST['q_2'])){$q_2 = $_POST['q_2'];}
		if(isset($_POST['q_3'])){$q_3 = $_POST['q_3'];}
		if(isset($_POST['q_4'])){$q_4 = $_POST['q_4'];}
		if(isset($_POST['q_5'])){$q_5 = $_POST['q_5'];}
		if(isset($_POST['q_6'])){$q_6 = $_POST['q_6'];}
		if(isset($_POST['q_7'])){$q_7 = $_POST['q_7'];}
		if(isset($_POST['feedback'])){$feedback = $_POST['feedback'];}
		if(isset($_POST['track_id'])){$track_id = $_POST['track_id'];}
		
		if(isset($_POST['x_q_1'])){$q_1 = $_POST['x_q_1'];}
		if(isset($_POST['x_q_2'])){$q_2 = $_POST['x_q_2'];}
		if(isset($_POST['x_q_3'])){$q_3 = $_POST['x_q_3'];}
		if(isset($_POST['x_q_4'])){$q_4 = $_POST['x_q_4'];}
		if(isset($_POST['x_q_5'])){$q_5 = $_POST['x_q_5'];}
		if(isset($_POST['x_q_6'])){$q_6 = $_POST['x_q_6'];}
		if(isset($_POST['x_q_7'])){$q_7 = $_POST['x_q_7'];}
		if(isset($_POST['x_feedback'])){$feedback = $_POST['x_feedback'];}
		if(isset($_POST['x_track_id'])){$track_id = $_POST['x_track_id'];}
		
		$survey_data = array(
			'q_1'		=> $q_1,
			'q_2'		=> $q_2,
			'q_3'		=> $q_3,
			'q_4'		=> $q_4,
			'q_5'		=> $q_5,
			'q_6'		=> $q_6,
			'q_7'		=> $q_7,
			'feedback'	=> $feedback,
			'status'	=> '1'
		);
		
		$results			= $this->login_model->getSingleSurveyInfo($track_id);
		$data['survey_id']	= $this->login_model->encryptor('encrypt', $track_id);//decrypt
		if($results > 0){
			$data['message']	= 'YOU ALREADY FILLED THAT SURVEY!';
		}else{
			$this->login_model->updateSurveyScore($track_id, $survey_data);
			$data['message']	= 'THANK YOU SO MUCH FOR YOUR PRECIOUS TIME';
		}
		$this->load->view('admin/thankyou', $data);
	}
	public function scoreboard(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Survey Scoreboard';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/survey_scoreboard';
		//$data['survey_info']	= $this->login_model->getSurveyInfo($hotel_id);
		$this->load->view('admin/template', $data);
	}
	
	public function survey_responses(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Survey History';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/survey_scoreboard_history';
		$data['survey_score_info']	= $this->login_model->getSurveyScoreInfo($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function mass_survey_upload(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Mass Survey Upload';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/mass_survey';
		$data['survey_info']	= $this->login_model->get_Mass_Survey($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function upload_survey(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$user_id	= $this->session->userdata['logged_in']['id'];
		
		if($_FILES['file']){
			$target_dir 	= "assets/images/mass_files/";
			$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);			
			$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
			$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
			$target_file	= $target_dir. $new_file_name;
			 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				 $filename = $new_file_name;
			}
			
			$Mass_file		= base_url().'assets/images/mass_files/'.$filename;
			$i				= 1;
			$fp 			= fopen($Mass_file, 'rb');
			$unique_code	= rand(0, 100000);
			
			while(!feof($fp)) {
				$results = fgetcsv($fp);
				if($i >1){
					$arrival_date 	= date_create($results[4]);
					$departure_date = date_create($results[5]);
					
					$post_data = array(
						'hotel_id'		=> $hotel_id,
						'user_id'		=> $user_id,
						'first_name'	=> $results[0],
						'last_name'		=> $results[1],
						'email'			=> $results[2],
						'phone'			=> $results[3],
						'arrival'		=> date_format($arrival_date, "Y-m-d"),
						'departure'		=> date_format($departure_date, "Y-m-d"),
						'member_level'	=> $results[6],
						'member_no'		=> $results[7],
						'room_no'		=> $results[8],
						'unique_code'	=> $unique_code,
						'status'		=> '1',
						'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
					);
					$this->login_model->save_Mass_Survey($post_data);
				}
				$i++;
			}
			//unlink('assets/images/mass_files/'.$filename);
			$this->session->set_flashdata('flash_data', 'Data Imported successfully.');
			redirect('guest_survey/mass_survey_upload');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function edit_survey_info(){
		if(empty($_POST['first_name'])){$this->session->set_flashdata('flash_data_danger', 'Please enter first name first!');}
		
		$m_id   		= $_POST['m_id'];
		$arrival_date 	= date_create($_POST['arrival']);
		$departure_date = date_create($_POST['departure']);
		$post_data = array(
			'first_name'	=> $_POST['first_name'],
			'last_name'		=> $_POST['last_name'],
			'email'			=> $_POST['email'],
			'phone'			=> $_POST['phone'],
			'arrival'		=> date_format($arrival_date, "Y-m-d"),
			'departure'		=> date_format($departure_date, "Y-m-d"),
			'member_level'	=> $_POST['member_level'],
			'member_no'		=> $_POST['member_no'],
			'room_no'		=> $_POST['room_no']
		);
		$results = $this->login_model->update_Mass_Survey($m_id, $post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Survey updated successfully.');
			redirect(site_url("guest_survey/mass_survey_upload"));
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function delete_survey($id){
		$id = intval($id);
		$this->login_model->delete_Mass_Survey($id);
		$this->session->set_flashdata("flash_data", "Survey deleted Successfully");
		redirect(site_url("guest_survey/mass_survey_upload"));
	}
	
	public function mass_survey(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Mass Survey';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/manage_mass_survey';
		$data['survey_info']	= $this->login_model->getMassSurveyInfo($hotel_id);
		$data['survey_questions']	= $this->login_model->getMassSurveyInfoQuestions($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function save_mass_survey(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$results 	= $this->login_model->updateMassSurveyInfo($hotel_id, $_POST);
	}
	public function mass_survey_questions(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Mass Survey Questions';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/add_mass_survey_questions';
		$data['survey_questions']	= $this->login_model->getMassSurveyInfoQuestions($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function mass_survey_add_question(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$post_data	= array(
			'hotel_id'		=> $hotel_id,
			'question' 		=> $_POST['question'],
			'label_1' 		=> $_POST['label_1'],
			'label_2' 		=> $_POST['label_2'],
			'label_3' 		=> $_POST['label_3'],
			'label_4'		=> $_POST['label_4'],
			'red_yes'		=> $_POST['red_yes'],
			'red_no'		=> $_POST['red_no'],
			'red_if'		=> $_POST['red_if']
		);		
		$results 	= $this->login_model->saveMassSurveyInfoQuestions($post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Question information added successfully.');
			redirect('guest_survey/mass_survey_questions');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function mass_survey_update_question(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$q_id		= $_POST['q_id'];
		
		$post_data	= array(
			'question' 		=> $_POST['question'],
			'label_1' 		=> $_POST['label_1'],
			'label_2' 		=> $_POST['label_2'],
			'label_3' 		=> $_POST['label_3'],
			'label_4'		=> $_POST['label_4'],
			'red_yes'		=> $_POST['red_yes'],
			'red_no'		=> $_POST['red_no'],
			'red_if'		=> $_POST['red_if']
		);		
		$results 	= $this->login_model->updateMassSurveyInfoQuestions($q_id, $post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Question information updated successfully.');
			redirect('guest_survey/mass_survey_questions');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function mass_survey_delete_question($id){
		$id = intval($id);
		
		$this->login_model->deleteMassSurveyInfoQuestions($id);
		$this->session->set_flashdata("flash_data", "Question deleted Successfully");
		redirect('guest_survey/mass_survey_questions');
	}
	public function mass_survey_update_question_state(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$post_data	= array(
			'q_state' 	=> 'off'
		);
		$this->login_model->updateMassSurveyInfoQuestionsAll($hotel_id, $post_data);
		$on_question = explode(',', $_POST['questions']);
		$post_data_1	= array(
			'q_state' 	=> 'on'
		);
		foreach($on_question as $qid_on_question){
			$this->login_model->updateMassSurveyInfoQuestions($qid_on_question, $post_data_1);
		}
	}
	public function send_email_mass_survey(){
		$hotel_id			= $this->session->userdata['logged_in']['firm_id'];
		$survey_info		= $this->login_model->getMassSurveyInfo($hotel_id);
		$survey_questions	= $this->login_model->getMassSurveyInfoQuestions($hotel_id);
		$Survey_Guest_Names	= $this->login_model->getMassSurveyGuestNamesDateBase($hotel_id, $_POST['unique_code']);
		$hotel_info			= $this->login_model->getSingleHotel($hotel_id);
		$settings_info		= $this->login_model->get_settings($hotel_id);
		
		if($settings_info[0]->from_label){$from_label	= $settings_info[0]->from_label;}else{$from_label	= 'Hotel HOPS';}
		if($settings_info[0]->email_logo){$email_logo	= $settings_info[0]->email_logo;}else{$email_logo	= 'logo_home.png';}
		
		require 'PHPMailer/PHPMailerAutoload.php';
		
		
		$subject	 = "Welcome to the ".$hotel_info[0]->hotel_name;
		if(is_array($Survey_Guest_Names)){foreach($Survey_Guest_Names as $guest_Names){
			//$recipient	 = 'mluqman2008@gmail.com';
			//$recipient	 = $guest_Names->email;
			$mail = new PHPMailer;
			// $mail->isSMTP();
			$mail->Host 		= 'p3plcpnl0833.prod.phx3.se';
			$mail->SMTPAuth 	= true;
			$mail->Username 	= 'brandon10@dprofits.com';
			$mail->Password 	= 'Password12';
			$mail->SMTPSecure 	= 'tls';
			$mail->Port 		= 465;
			$mail->setFrom('admin@hotelgss.com', $from_label);
			//$mail->addBCC("Brandon@kayakhg.com", "Brandon Lane"); 
			$mail->isHTML(true);
		
			$message	 = '';
			$message	.= '<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%; width: 100%; color: #514d6a;">
					  <div style="max-width: 700px; padding:30px 0; margin: 0px auto; font-size: 14px;">
						<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
						  <tbody>
							<tr>
							  <td style="vertical-align: top; padding-bottom:30px;" align="center"><a href="javascript:void(0)" target="_blank"><img src="https://www.hops247.com/assets/images/'.$email_logo.'" alt="HOPS 247" width="205" height="90" style="border:none"></a></td>
							</tr>
						  </tbody>
						</table>
						<div style="padding: 10px 40px 10px 40px; background: #fff;">
						  <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
							<tbody>
							  <tr><td>
								<b>Dear '.ucwords($guest_Names->first_name).' '.ucwords($guest_Names->last_name).',</b>';
									if($survey_info[0]->message){
										$message	.= $survey_info[0]->message;
									}
									$message	.= '<p><b>Room Number:</b> '.$guest_Names->room_no.'<p/>';
									$message	.= '<p><b>Member Level:</b> '.$guest_Names->member_level.'<p/>';
									$message	.= '<p><b>Member No#:</b> '.$guest_Names->member_no.'<p/>';
									$message	.= '<p><b>Arrival/Departure:</b> '.$guest_Names->arrival.' / '.$guest_Names->departure.'<p/>';
									$message	.= '<p><b>Please answer survey questions below:</b><p/>';
									$message	.= '<form action="http://www.hops247.com/guest_survey/mass_survey_email_response" method="post">';
									
									if(is_array($survey_questions)){foreach($survey_questions as $val){
										if($val->q_state == 'on'){
											$message	.= '<p><p style="margin-bottom: 0px;"><b>'.$val->question.'</b></p>
												<div class="btn-group" data-toggle="buttons">';
													if($val->label_1 != ''){
														if($val->label_1 == 'Yes'){$label_1 = 'yes';}else{$label_1 = '1';}
														$message	.= '<label class="btn btn-default form-check-label">
															<input name="q_'.$val->q_id.'" type="radio" value="'.$label_1.'"> '.$val->label_1.'
														</label>';
													}
													if($val->label_2 != ''){
														if($val->label_2 == 'No'){$label_2 = 'no';}else{$label_2 = '2';}
														$message	.= '<label class="btn btn-default form-check-label">
															<input name="q_'.$val->q_id.'" type="radio" value="'.$label_2.'"> '.$val->label_2.'
														</label>';
													}
													if($val->label_3 != ''){
														$message	.= '<label class="btn btn-default form-check-label">
															<input name="q_'.$val->q_id.'" type="radio" value="3"> '.$val->label_3.'
														</label>';
													}
													if($val->label_4 != ''){
														$message	.= '<label class="btn btn-default form-check-label">
															<input name="q_'.$val->q_id.'" type="radio" value="4"> '.$val->label_4.'
														</label>';
													}
											$message	.= '</div>
											</p>';
										}
									}}
									$message	.= '<p><p style="margin-bottom: 0px;"><b>Guests Other Feedback:</b></p><textarea name="feedback" rows="7" cols="70" placeholder="Guest Feedback"></textarea></p>';
									$message	.= '<p><input style="border: 0 none; font-size:0px;" type="text" name="track_id" readonly="readonly" value="'.$guest_Names->m_id.'"><p>';
									$message	.= '<p><input style="border: 0 none; font-size:0px;" type="text" name="hotel_id" readonly="readonly" value="'.$hotel_id.'"><p>';
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
						  <p> '.date('Y').' &reg; Hotel HOPS - All Rights Reserved <br>
							<a href="javascript: void(0);" style="color: #b2b2b5; text-decoration: underline;">Unsubscribe</a> </p>
						</div>
					  </div>
					</div>';
		
			$mail->addAddress($guest_Names->email, ucwords($guest_Names->first_name));
			$mail->Subject	= $subject;
			$mail->Body		= $message;
			$mail->send();
			//echo '<pre>';
			//echo $message;
			//sleep(5);
			$m_id   	= $guest_Names->m_id;
			$GPost_data = array('status'	=> '0');
			//$this->login_model->update_Mass_Survey($m_id, $GPost_data);
		}}
		//exit;
	}
	public function mass_survey_email_response(){
		if(isset($_POST['feedback'])){$feedback = $_POST['feedback'];}
		if(isset($_POST['track_id'])){$track_id = $_POST['track_id'];}
		if(isset($_POST['x_feedback'])){$feedback = $_POST['x_feedback'];}
		if(isset($_POST['x_track_id'])){$track_id = $_POST['x_track_id'];}
		if(isset($_POST['hotel_id'])){$hotel_id = $_POST['hotel_id'];}
		if(isset($_POST['x_hotel_id'])){$hotel_id = $_POST['x_hotel_id'];}
		
		$questions_data		= $this->login_model->getMassSurveyInfoQuestions($hotel_id);
		$is_red = '0';
		$answer = '';
		//echo '<pre>';print_r($_POST);exit;
		if(is_array($questions_data)){
			foreach($questions_data as $val){
				$index = "";
				if(isset($_POST['q_'.$val->q_id])){
					$index 	= 'q_'.$val->q_id;
					$answer = $_POST['q_'.$val->q_id];
				}
				elseif(isset($_POST['x_q_'.$val->q_id])){
					$index 	= 'q_'.$val->q_id;
					$answer = $_POST['x_q_'.$val->q_id];
				}
				//echo $index;$answer;exit;
				if($index != ""){
					$q_id		 = str_replace('q_', '', $index);
					$result		 = $this->login_model->getMassSurveyInfoAnswer($hotel_id, $track_id, $q_id);
					$answer		 = strtolower($answer);
					
					
					
					if($answer == 'yes'){
						//if($val->red_if == 'yes'){
							$redirect	= $val->red_yes;
							$is_red		= '1';
						//}
					}
					if($answer == 'no'){
						//if($val->red_if == 'no'){
							$redirect	 = $val->red_no;
							$is_red		= '1';
						//}
					}
					
					//if($answer == 'yes'){$answer = '1';}else{$answer = '1';}
					
					$survey_data = array(
						'hotel_id'		=> $hotel_id,
						'm_id'			=> $track_id,
						'q_id'			=> $q_id,
						'answer'		=> $answer,
						'feedback'		=> $feedback,
						'created_date'	=> gmdate('Y-m-d H:i:s A')
					);
					if($result){
						$this->login_model->updateMassSurveyInfoAnswer($result[0]->a_id, $survey_data);
					}else{
						$this->login_model->saveMassSurveyInfoAnswer($survey_data);
					}
				}	
		}}
		if($is_red == '1'){
			redirect($redirect);
		}
		
		$hotel_name_info 	= admin_helper::get_hotel_name($hotel_id);
		$hotel_name			= $hotel_name_info[0]->hotel_name;
		$settings_info		= $this->login_model->get_settings($hotel_id);
		
		$data['message']	= 'THANK YOU SO MUCH FOR YOUR PRECIOUS TIME';
		$data['hotel_id']	= $hotel_id;
		$data['hotel_name']	= $hotel_name;
		$data['settings_info']		= $settings_info;
		$data['m_id']		= $track_id;
		$data['final']		= '0';
		$this->load->view('admin/mass_survey_thankyou', $data);
	}
	public function mass_survey_adtnl_answer(){
		$hotel_id	= $_POST['hotel_id'];
		
		$q_1		= isset($_POST['q_1']) ? $_POST['q_1'] : "";
		$q_2		= isset($_POST['q_2']) ? $_POST['q_2'] : "";
		$q_3		= isset($_POST['q_3']) ? $_POST['q_3'] : "";
		$q_4		= isset($_POST['q_4']) ? $_POST['q_4'] : "";
		$q_5		= isset($_POST['q_5']) ? $_POST['q_5'] : "";
		$q_6		= isset($_POST['q_6']) ? $_POST['q_6'] : "";
		$q_7		= isset($_POST['q_7']) ? $_POST['q_7'] : "";
		$feedback	= isset($_POST['feedback']) ? $_POST['feedback'] : "";
		
		$survey_data = array(
			'hotel_id'		=> $hotel_id,
			'm_id'			=> $_POST['m_id'],
			'q_1'			=> $q_1,
			'q_2'			=> $q_2,
			'q_3'			=> $q_3,
			'q_4'			=> $q_4,
			'q_5'			=> $q_5,
			'q_6'			=> $q_6,
			'q_7'			=> $q_7,
			'feedback'		=> $feedback,
			'created_date'	=> gmdate('Y-m-d H:i:s A')
		);
		
		$result		 = $this->login_model->getMassSurveyAdtnlAnswer($hotel_id, $_POST['m_id']);
		if($result){
			$this->login_model->updateMassSurveyAdtnlAnswer($_POST['m_id'], $survey_data);
		}else{
			$this->login_model->saveMassSurveyAdtnlAnswer($survey_data);
		}
		
		$hotel_name_info 	= admin_helper::get_hotel_name($hotel_id);
		$hotel_name			= $hotel_name_info[0]->hotel_name;
		$settings_info		= $this->login_model->get_settings($hotel_id);
		$survey_info		= $this->login_model->getMassSurveyInfo($hotel_id);
		
		$data['hotel_name']			= $hotel_name;
		$data['settings_info']		= $settings_info;
		$data['message']			= $survey_info[0]->thank_you_message;
		$data['final']		= '1';
		$this->load->view('admin/mass_survey_thankyou', $data);
	}
}
?>