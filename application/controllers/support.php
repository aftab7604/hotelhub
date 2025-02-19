<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->helper('admin_helper');
	}
	public function add_new_case(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		$data['page_title'] 	= 'New Support Case';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/add_case';
		$this->load->view('admin/template', $data);
	}
	public function add_new_case_info(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		if($this->session->userdata['logged_in']['role'] == '1'){
			$created_date	= gmdate('Y-m-d H:i:s A', strtotime('-4 hours'));
		}else{
			$created_date	= gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
		}
		
		if(empty($_POST['subject'])){$this->session->set_flashdata('flash_data_danger', 'Subject is required!');}
		if(empty($_POST['details'])){$this->session->set_flashdata('flash_data_danger', 'Details are required!');}
		
		$filename	= '';
		if($_FILES['file']){
			$target_dir 	= "assets/images/complaint_images/";
			$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);
			$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
			$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
			$target_file	= $target_dir. $new_file_name;
			if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
				$filename	= $new_file_name;
			}
		}
		
		$post_data	= array(
			'hotel_id'		=> $hotel_id,
			'user_id'		=> $this->session->userdata['logged_in']['id'],
			'subject'		=> $_POST['subject'],
			'details'		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['details'])),
			'filename'		=> $filename,
			'status'		=> '0',
			'created_date'	=> $created_date
		);
		
		$results = $this->login_model->save_complaint($post_data);
		if($results){
			require 'PHPMailer/PHPMailerAutoload.php';
			$mail = new PHPMailer;
			// $mail->isSMTP();
			$mail->isHTML(true);
			$mail->Host 		= 'p3plcpnl0833.prod.phx3.se';
			$mail->SMTPAuth 	= true;
			$mail->Username 	= 'brandon10@dprofits.com';
			$mail->Password 	= 'Password12';
			$mail->SMTPSecure 	= 'tls';
			$mail->Port 		= 465;
			$mail->setFrom('support@hotelgss.com', 'HOPS TECH SUPPORT');			
			//Send Email
			$recipient  = $this->session->userdata['logged_in']['email'];
			//$recipient  = 'mluqman2008@gmail.com';
			$mail->AddCC('mluqman2008@gmail.com');
			$recipient  = 'brandon@KayakHG.com';
			$subject	= "HOPS TECH SUPPORT";
			$message	= 'Dear '.$this->session->userdata['logged_in']['username'].',<br />';
			$message   .= "Your query has been submitted to our tech support team. Your will be notified within 48 Hours.<br />";
			$message   .= "Thank You<br />";
			$message   .= "Support Team<br />";
			
			$mail->addAddress($recipient);
			$mail->Subject	= $subject;
			$mail->Body		= $message;
			$mail->send();
				
			$this->session->set_flashdata('flash_data', 'Case has been registered successfully.');
			redirect('support/add_new_case');
		}else{$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');}
	}
	public function manage_cases(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		$data['complaints']		= $this->login_model->get_complaints();
		$data['page_title'] 	= 'Manage Cases';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/manage_cases';
		$this->load->view('admin/template', $data);
	}
	public function update_case_status(){
		$status		= $_POST['status'];
		$case_id	= $_POST['case_id'];
		$user_id	= $_POST['user_id'];
		
		$user_info 	= $this->login_model->getSingleUser($user_id);
		
		if($status == 0){$status_val = 'Active';}
		if($status == 1){$status_val = 'Completed';}
		if($status == 2){$status_val = 'In-Progress';}
		if($status == 3){$status_val = 'In-Future';}
		if($status == 4){$status_val = 'Pending';}
		
		require 'PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		// $mail->isSMTP();
		$mail->isHTML(true);
		$mail->Host 		= 'p3plcpnl0833.prod.phx3.se';
		$mail->SMTPAuth 	= true;
		$mail->Username 	= 'brandon10@dprofits.com';
		$mail->Password 	= 'Password12';
		$mail->SMTPSecure 	= 'tls';
		$mail->Port 		= 465;
		$mail->setFrom('support@hotelgss.com', 'HOPS TECH SUPPORT');			
		//Send Email
		$recipient  		= $user_info[0]->email;
		$subject			= "HOPS TECH SUPPORT";
		$message			= 'Dear '.$user_info[0]->username.',<br />';
		$message		   .= "Your query has been marked as ".strtoupper($status_val)."<br />";
		$message		   .= "Thank You<br />";
		$message		   .= "Support Team<br />";
		
		$mail->addAddress($recipient);
		$mail->AddCC("mluqman2008@gmail.com");
		$mail->Subject	= $subject;
		$mail->Body		= $message;
		$mail->send();
				
		$post_data		= array(
			'status'	=> $status
		);
		$this->login_model->update_complaint($case_id, $post_data);
	}
	public function delete_case($id){
		$id = intval($id);
		
		$this->login_model->delete_complaint($id);
		$this->session->set_flashdata("flash_data", "Case deleted Successfully");
		redirect(site_url("support/manage_cases"));
	}
}
?>