<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->helper('admin_helper');
	}
	
	public function add_hotel(){
		if(!isset($this->session->userdata['logged_in'])){
			redirect('login');
		}
		$data['page_title'] 	= 'Add Hotel';
		$data['site_name'] 		= ' | HOPS 247';
		$data['main_content'] 	= 'admin/add_hotel';
		$this->load->view('admin/template', $data);
	}
	public function add_hotel_info(){
		if(empty($_POST['hotelname'])){$this->session->set_flashdata('flash_data_danger', 'Please enter hotel name first!');}
		
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
		//$mail->addBCC("Brandon@kayakhg.com", "Brandon Lane"); 
		$mail->isHTML(true);
		
		$post_data_hotel	= array(
			'hotel_name'	=> $_POST['hotelname'],
			'no_of_rooms' 	=> $_POST['rooms'],
			'email' 		=> $_POST['email'],
			'website' 		=> $_POST['website'],
			'phone' 		=> $_POST['phone'],
			'city'			=> $_POST['city'],
			'state' 		=> $_POST['state'],
			'zipcode' 		=> $_POST['zipcode'],
			'address' 		=> $_POST['address'],
			'timezone' 		=> $_POST['timezone'],
			'status'		=> $_POST['status']
		);
		$results = $this->login_model->saveHotel($post_data_hotel);
		
		if($results){
			$length		= 10;
			$rand_pass	= substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	
			$post_data_user	= array(
				'first_name'	=> '',
				'created_by_id'	=> $this->session->userdata['logged_in']['id'],
				'firm_id' 		=> $results,
				'last_name' 	=> '',
				'username'		=> '',
				'email' 		=> $_POST['email'],
				'pass'	 		=> sha1(md5($rand_pass)),
				'phone' 		=> $_POST['phone'],
				'role' 			=> '8',
				'status'		=> $_POST['status']
			);
			$result_user	= $this->login_model->saveUsers($post_data_user);
			$hotel_username	= explode(' ',trim($post_data_hotel['hotel_name']));
			$hotel_username_final = $hotel_username[0].'-'.$result_user;
			$post_data_user	= array(
				'username'	=> $hotel_username_final
			);
			$update_info	= $this->login_model->updateCustomers($result_user, $post_data_user);
			
			//Send Email
			$recipient	= $_POST['email'];
			$subject	= "Account Register Successfully!";
			$message	= 'Welcome to the Hotel <b>"'.$_POST['hotelname'].'"</b>,<br /><br />';
			$message   .= "Your Admin account has been generated automatically. Credentials are given below:<br />";
			$message   .= "<a href='https://www.hotelgss.com/login'>https://www.hotelgss.com/login</a><br />";
			$message   .= "<b>Email:</b> ".$_POST['email']."<br />";
			$message   .= "<b>Username:</b> ".$hotel_username_final."<br />";
			$message   .= "<b>Password:</b> ".$rand_pass."<br /><br />";
			$message   .= "Thank You<br />";
			
			$mail->addAddress($recipient);
			$mail->Subject = $subject;
			$mail->Body = $message;
			$mail->send();
			
			$this->session->set_flashdata('flash_data', 'Hotel has been added successfully.');
			redirect('hotel/manage_hotel');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function manage_hotel(){
		if(!isset($this->session->userdata['logged_in'])){
			redirect('login');
		}
		
		$data['hotels'] 		= $this->login_model->getHotels();
		$data['page_title'] 	= 'Manage Hotels';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/manage_hotel';
		$this->load->view('admin/template', $data);	
	}
	public function edit_hotel($id){
		if(!isset($this->session->userdata['logged_in'])){
			redirect('login');
		}
		$id = intval($id);
		$data['hotel']		= $this->login_model->getSingleHotel($id);
		$data['page_title'] 	= 'Update Hotel';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/edit_hotel';
		$this->load->view('admin/template', $data);	
	}
	public function edit_hotel_info(){
		if(empty($_POST['hotelname'])){
			$this->session->set_flashdata('flash_data_danger', 'Please enter hotel name first!');
		}
		$user_id	= $_POST['user_id'];
		$post_data = array(
			'hotel_name'	=> $_POST['hotelname'],
			'no_of_rooms' 	=> $_POST['rooms'],
			'email' 		=> $_POST['email'],
			'website' 		=> $_POST['website'],
			'phone' 		=> $_POST['phone'],
			'city'			=> $_POST['city'],
			'state' 		=> $_POST['state'],
			'zipcode' 		=> $_POST['zipcode'],
			'address' 		=> $_POST['address'],
			'timezone' 		=> $_POST['timezone'],
			'status'		=> $_POST['status']
		);
		$results = $this->login_model->updateHotel($user_id, $post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Hotel information updated successfully.');
			redirect('hotel/manage_hotel');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function delete_hotel($id){
		$id = intval($id);
		
		$this->login_model->delete_hotel($id);
		$this->session->set_flashdata("flash_data", "Hotel deleted Successfully");
		redirect(site_url("hotel/manage_hotel"));
	}
	
	
	public function one_login(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		$data['hotels'] 		= $this->login_model->getHotels();
		$data['admin_users']	= $this->login_model->getAllAdminUsers();
		$data['page_title'] 	= 'One-Login Hotels';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/one_login';
		$this->load->view('admin/template', $data);	
	}
	public function update_user_multi_firms(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		$post_data	= array(
			'multi_firms' 	=> $_POST['hotel_id_list']
		);
		$results = $this->login_model->updateCustomers($_POST['user_id'], $post_data);
	}
}
?>