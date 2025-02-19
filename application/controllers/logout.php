<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
	public function __construct() 
	{
		if(!isset($_SESSION)): session_start(); endif;
		parent::__construct();
		$this->load->model("login_model");
		
	}
	public function index()
	{
		$tracking_post_data = array(
			'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
			'user_id'		=> $this->session->userdata['logged_in']['id'],
			'txt_bdy' 		=> ucwords($this->session->userdata['logged_in']['username']).' Log out at '.gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
			'txt_type' 		=> 'logout',
			'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		$this->login_model->save_tracking($tracking_post_data);
		//UPDATE IS_ONLINE BIT 0
		$IS_ONLINE_post_data = array('is_online'	=> '0');
		$this->login_model->updateCustomers($this->session->userdata['logged_in']['id'], $IS_ONLINE_post_data);
		
		$this->session->sess_destroy();
		redirect("login");
	}	
}
?>