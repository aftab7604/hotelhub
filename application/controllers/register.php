<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->model("login_model");
	}
	
	public function index_bk(){
		if(isset($this->session->userdata['logged_in'])){
			redirect('dashboard');
		}
		
		$page_title = 'Register';
		$site_name  = ' | HOPS 247';
		$this->load->view("admin/register");
	}
	
	public function auth_register(){

		$name = $this->input->post("name", true);
		$email = $this->input->post("email", true);
		$pass = $this->input->post("pass", true);
		$pass_c = $this->input->post("pass_c", true);
		$chk_bx = $this->input->post("chk_bx", true);
		
		if($pass != $pass_c ){
			$this->session->set_flashdata('flash_data', 'Password And Confirm Password are not same!');
		}
		
		$result = $this->login_model->getregister($name,$email,$pass);
		if ($result == TRUE) {
			redirect("login");
		}
		
	}
	
}
?>