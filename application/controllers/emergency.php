<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emergency extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->helper('admin_helper');
		$this->load->helper('pm_report_helper');
	}
	public function index(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		$notes		= str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['panic_notes']));
		$post_data	= array(
			'hotel_id'			=> $this->session->userdata['logged_in']['firm_id'],
			'user_id'			=> $this->session->userdata['logged_in']['id'],
			'location'			=> $_POST['location'],
			'emergency_type'	=> $_POST['emergency_type'],
			'notes'				=> $notes,
			'status'			=> '1',
			'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		$results = $this->login_model->save_emergency($post_data);
		redirect('dashboard');
	}
	public function update_emergency(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		$e_id		= $_POST['e_id'];
		$post_data	= array(
			'status'	=> $_POST['status']
		);
		$results = $this->login_model->update_emergency($e_id, $post_data);
		//redirect('dashboard');
	}
}
?>