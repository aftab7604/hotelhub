<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Productivity extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->helper('admin_helper');
	}
	public function ranker(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 				= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Productivity Ranker';
		$data['site_name'] 		= ' | HOPS 247';
		$data['main_content'] 	= 'admin/productivity_ranker';
		$data['ticket_types']	= $this->login_model->get_ticket_types();
		$data['roles']			= $this->login_model->get_Admin_Roles();
		$data['users']	 		= $this->login_model->get_hotel_Users($hotel_id);
		$this->load->view('admin/template', $data);
	}
}
