<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logbook extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->model("log_book_model");
		$this->load->helper('admin_helper');
	}
	
	public function index(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Service Book';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/logbook';
		$data['logs_entry']		= $this->log_book_model->get_logBook_entry($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function save_logbook(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$filename	= '';
		if($_FILES['file']){
			$target_dir 	= "assets/images/logbook_images/";
			$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);			
			$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
			$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
			$target_file	= $target_dir. $new_file_name;
			 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				 $filename = $new_file_name;
			}
		}
		
		$post_data = array(
			'hotel_id'	=> $this->session->userdata['logged_in']['firm_id'],
			'user_id'	=> $this->session->userdata['logged_in']['id'],
			'user_name'	=> $this->session->userdata['logged_in']['username'],
			'heading'	=> $_POST['heading'],
			'message'	=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['message'])),
			'file_name'	=> $filename,
			'likes'		=> '0',
			'status'	=> '1',
			'added_date'=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		$this->log_book_model->save_logBook_entry($post_data);
	}
	public function save_reply_logbook(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$filename	= '';
		if($_FILES['file']){
			$target_dir 	= "assets/images/logbook_images/";
			$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);			
			$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
			$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
			$target_file	= $target_dir. $new_file_name;
			 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				 $filename = $new_file_name;
			}
		}
		$post_data = array(
			'lead_id'	=> $_POST['lead_id'],
			'user_id'	=> $this->session->userdata['logged_in']['id'],
			'user_name'	=> $this->session->userdata['logged_in']['username'],
			'message'	=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['message1'])),
			'file_name'	=> $filename,
			'likes'		=> '0',
			'status'	=> '1',
			'added_date'=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		$this->log_book_model->save_logBook_replies($post_data);
	}
	public function save_logbook_parent_like(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}		
		$lead_id	= $_POST['lead_id'];
		
		$this->log_book_model->save_logBook_likes($lead_id);
	}
	public function save_logbook_child_like(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}		
		$r_lead_id	= $_POST['r_lead_id'];
		
		$this->log_book_model->save_logBook_child_likes($r_lead_id);
	}
}
?>