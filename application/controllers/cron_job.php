<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cron_job extends CI_Controller {
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
	public function getChecklistQuarters(){
		$current_month = date('m');
		$current_year = date('Y');
		if($current_month>=1 && $current_month<=3){$quarter = '1st';}
		else if($current_month>=4 && $current_month<=6){$quarter = '2nd';}
		else if($current_month>=7 && $current_month<=9){$quarter = '3rd';}
		else if($current_month>=10 && $current_month<=12){$quarter = '4th';}
		return $quarter;
	}
	public function get_hotels_completed_rooms(){
		$current_year 	= date('Y');
		$curr_quarter	= $this->getChecklistQuarters();
		$hotels			= $this->login_model->getHotels();
		
		if(is_array($hotels)){
			foreach($hotels as $val_hotel){
				$hotel_id	= $val_hotel->hotel_id;
				$rooms		= $this->login_model->getHotelRooms($hotel_id);
				$comp_per	= $this->login_model->get_settings($hotel_id);
				$per_req	= $comp_per[0]->percentage;
				
				if(is_array($rooms)){
					$total_rooms	= count($rooms);
					foreach($rooms as $val_room){
						$room_report	= $this->cron_job_model->get_Rooms_Completed($hotel_id, $val_room->room_no, $curr_quarter);
						
						if(!empty($room_report)){
							$comp_datef	= date_create($room_report[0]->created_date);
							$comp_date	= date_format($comp_datef, 'Y-m-d');
							$comp		= count($room_report);
						}else{
							$comp_date	= '';
							$comp		= '0';
						}
						
						$calPercentage = round((($comp / $total_rooms)*100),2);
						
						if($calPercentage >= $per_req){
							$this->cron_job_model->save_Rooms_Completed($hotel_id, $val_room->room_no, $curr_quarter, $current_year, $calPercentage, $comp_date);
							//echo 'Curr Quarter: '.$curr_quarter.' --- cal %tage: '.$calPercentage.' --- %tage: '.$per_req.' --- hotel Id: '.$hotel_id.' --- Room #: '.$val_room->room_no.' --- Year: '.$current_year.'///'.$comp_date.'<br>';
						}
					}
					//echo '<br><hr><br>';
				}
			}
		}
	}
	public function get_gmail_emails(){
		/*We need to do few things from the gmail side while connecting
		1. Login to your gmail account, Under Settings -> Forwarding and POP/IMAP -> Enable Imap.
		2. Go to https://www.google.com/settings/security/lesssecureapps and select "Turn On"
		3. Go to: https://accounts.google.com/b/0/DisplayUnlockCaptcha and enable access.
		https://davidwalsh.name/gmail-php-imap*/
		
		$login_credentials	= $this->login_model->get_all_settings();
		if(is_array($login_credentials)){
			foreach($login_credentials as $credentials){
				if(!empty($credentials->email_add)){
					/* connect to gmail */
					$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';//{outlook.office365.com:993/imap/ssl/authuser=fulluser@email.com/user=fullshared@mail.com}INBOX----//----imap_open("{outlook.office365.com:993/imap/ssl/authuser=user@maindomain.com/user=shared@anotherdomain.com}", "user@maindomain.com", "password");
					//'Muuu@6060';
					
					$username	= $credentials->email_add;
					$password	= $this->login_model->encryptor('decrypt', $credentials->email_pass);
					$hotel_id	= $credentials->hotel_id;
					
					$inbox		= imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());
					$emails		= imap_search($inbox,'UNSEEN');//ALL,UNSEEN
					if($emails){
						$output = '';
						rsort($emails);
						foreach($emails as $email_number){
							$overview	= imap_fetch_overview($inbox, $email_number, 0);
							//$message	= imap_fetchbody($inbox, $email_number, 2);
							$message	= imap_qprint(imap_fetchbody($inbox,$email_number,1));
							$message	= mb_convert_encoding($message, "UTF-8", "auto");
							
							$header		= imap_headerinfo($inbox, $email_number);
							$fromaddr	= $header->from[0]->mailbox . "@" . $header->from[0]->host;
							$overview[0]->from_email	= $fromaddr;
							$overview[0]->subject		= utf8_decode(imap_utf8($overview[0]->subject));
							
							$overview[0]->subject		= str_replace(" ? "," - ", $overview[0]->subject);
							
							$post_data = array(
								'hotel_id'		=> 	$hotel_id,
								'from_email'	=> 	$overview[0]->from_email,
								'to_email'		=> 	$overview[0]->to,
								'subject'		=> 	$overview[0]->subject,
								'message'		=> 	$message,
								'raw_date'		=> 	$overview[0]->date,
								'email_receive_date'	=> 	$overview[0]->udate,
								'is_ticket'		=> 	'0',
								'is_approved'	=> 	'0',
								'status'		=> 	'0'
							);
							
							$this->cron_job_model->save_gmail_inbox($post_data);
							
							/*echo '<pre>';
							print_r($overview);
							print_r($message);
							exit();*/
							
							/*$output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
							$output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
							$output.= '<span class="from">'.$overview[0]->from.'</span>';
							$output.= '<span class="from">'.$overview[0]->from_email.'</span>';
							$output.= '<span class="date">on '.$overview[0]->date.'</span>';
							$output.= '</div>';
							$output.= '<div class="body">'.$message.'</div>';*/
						}
					}
					imap_close($inbox);
				}
			}
		}
	}
	
}