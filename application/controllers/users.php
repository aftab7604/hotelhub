<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->helper('admin_helper');
	}
	public function add_user(){
		if(!isset($this->session->userdata['logged_in'])){
			redirect('login');
		}
		$data['page_title'] 	= 'Add User';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/add_user';
		$data['roles']	 		= $this->login_model->getRoles();
		$data['hotels']	 		= $this->login_model->getActiveHotels();
		$this->load->view('admin/template', $data);
	}
	public function add_user_data(){
		if(empty($_POST['firstName'])){
			$this->session->set_flashdata('flash_data_danger', 'Please enter first name first!');
		}

		$post_data = array(
			'first_name'	=> $_POST['firstName'],
			'created_by_id'	=> $this->session->userdata['logged_in']['id'],
			'firm_id' 		=> $_POST['hotel'],
			'last_name' 	=> $_POST['lastName'],
			'username'		=> $_POST['username'],
			'email' 		=> $_POST['email'],
			'pass'	 		=> sha1(md5($_POST['password'])),
			'phone' 		=> $_POST['phone'],
			'role' 			=> $_POST['role'],
			'lang' 			=> $_POST['lang'],
			'status'		=> $_POST['status']
		);
		$results = $this->login_model->saveUsers($post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'User has been added successfully.');
			redirect('users/manage_users');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function manage_users(){
		if(!isset($this->session->userdata['logged_in'])){
			redirect('login');
		}
		
		$data['users']	 		= $this->login_model->getUsers();
		$data['roles']	 		= $this->login_model->getRoles();
		$data['page_title'] 	= 'Manage Users';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/manage_users';
		$this->load->view('admin/template', $data);	
	}
	public function edit_user($id){
		if(!isset($this->session->userdata['logged_in'])){
			redirect('login');
		}
		$id = intval($id);
		$data['users']			= $this->login_model->getSingleUser($id);
		$data['roles']	 		= $this->login_model->getRoles();
		$data['hotels']	 		= $this->login_model->getActiveHotels();
		$data['page_title'] 	= 'Update User';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/edit_user';
		$this->load->view('admin/template', $data);	
	}
	public function edit_user_info(){
		if(empty($_POST['firstName'])){
			$this->session->set_flashdata('flash_data_danger', 'Please enter first name first!');
		}
		
		$user_id   = $_POST['user_id'];
		if($_POST['password'] == ''){
			$password = $_POST['pass'];
		}else{
			$password = sha1(md5($_POST['password']));
		}
		$post_data = array(
			'first_name'	=> $_POST['firstName'],
			'firm_id' 		=> $_POST['hotel'],
			'last_name' 	=> $_POST['lastName'],
			'username'		=> $_POST['username'],
			'email' 		=> $_POST['email'],
			'pass' 			=> $password,
			'role' 			=> $_POST['role'],
			'phone' 		=> $_POST['phone'],
			'lang' 			=> $_POST['lang'],
			'status' 		=> $_POST['status']
		);
		$results = $this->login_model->updateCustomers($user_id, $post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'User information updated successfully.');
			redirect('users/manage_users');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function delete_user($id){
		$id = intval($id);
		$this->login_model->delete_customer($id);
		$this->session->set_flashdata("flash_data", "User deleted Successfully");
		redirect(site_url("users/manage_users"));
	}
	
	//Role2 CRUD employee
	public function add_employee(){
		if(!isset($this->session->userdata['logged_in'])){
			redirect('login');
		}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$rooms_info = $this->login_model->getHotelRooms($hotel_id);
		if($rooms_info){}else{
			$this->session->set_flashdata('flash_data_danger', 'Please manage your hotel room number/type first!');
			redirect('rooms/add_rooms');
		}
		
		$data['page_title'] 	= 'Add Employee';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/add_employee';
		$data['roles']	 		= $this->login_model->getManagerRoles();
		$this->load->view('admin/template', $data);
	}
	public function add_employee_data(){
		if(empty($_POST['firstName'])){
			$this->session->set_flashdata('flash_data_danger', 'Please enter first name first!');
		}
		$manager_inspector	= '';
		$file_name			= '';
				
		if($_POST['role'] == '4'){
			$manager_inspector = $_POST['manager_inspector'];
		}
		if(isset($_FILES['file'])){
			$target_dir 	= "assets/images/user_profile_images/";
			$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);			
			$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
			$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
			$target_file	= $target_dir. $new_file_name;
			 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				 $file_name = $new_file_name;
			}
		}
		
		$post_data = array(
			'first_name'	=> $_POST['firstName'],
			'created_by_id'	=> $this->session->userdata['logged_in']['id'],
			'firm_id'		=> $this->session->userdata['logged_in']['firm_id'],
			'last_name' 	=> $_POST['lastName'],
			'username'		=> $_POST['username'],
			'email' 		=> $_POST['email'],
			'pass'	 		=> sha1(md5($_POST['password'])),
			'phone' 		=> $_POST['phone'],
			'role' 			=> $_POST['role'],
			'lang' 			=> $_POST['lang'],
			'logo' 			=> $file_name,
			'manager_inspector'	=> $manager_inspector,
			'status'		=> $_POST['status']
		);
		
		$results = $this->login_model->saveUsers($post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Employee has been added successfully.');
			redirect('users/manage_employee');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function manage_employee(){
		if(!isset($this->session->userdata['logged_in'])){
			redirect('login');
		}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		$rooms_info = $this->login_model->getHotelRooms($hotel_id);
		if($rooms_info){}else{
			$this->session->set_flashdata('flash_data_danger', 'Please manage your hotel room number/type first!');
			redirect('rooms/add_rooms');
		}
		$data['users']	 		= $this->login_model->get_hotel_Users($hotel_id);
		$data['page_title'] 	= 'Manage Employee';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/manage_employee';
		$this->load->view('admin/template', $data);	
	}
	public function edit_employee($id){
		if(!isset($this->session->userdata['logged_in'])){
			redirect('login');
		}
		$id = intval($id);
		$data['users']			= $this->login_model->getSingleUser($id);
		$data['roles']	 		= $this->login_model->getManagerRoles();
		$data['page_title'] 	= 'Update Employee';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/edit_employee';
		$this->load->view('admin/template', $data);	
	}
	public function edit_employee_info(){
		if(empty($_POST['firstName'])){
			$this->session->set_flashdata('flash_data_danger', 'Please enter first name first!');
		}
		$manager_inspector = '';
		if($_POST['role'] == '4'){
			$manager_inspector = $_POST['manager_inspector'];
		}
		$user_id   = $_POST['user_id'];
		if($_POST['password'] == ''){
			$password = $_POST['pass'];
		}else{
			$password = sha1(md5($_POST['password']));
		}
		
		if($_FILES['file']['name'] != ''){
			$file_name = '';
		}else{
			$file_name = $_POST['hdn_profile_pic'];
		}
		
		if(isset($_FILES['file'])){
			$target_dir 	= "assets/images/user_profile_images/";
			$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);			
			$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
			$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
			$target_file	= $target_dir. $new_file_name;
			 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				 $file_name = $new_file_name;
			}
		}
		
		$post_data = array(
			'first_name'	=> $_POST['firstName'],
			'last_name' 	=> $_POST['lastName'],
			'username'		=> $_POST['username'],
			'email' 		=> $_POST['email'],
			'pass' 			=> $password,
			'role' 			=> $_POST['role'],
			'lang' 			=> $_POST['lang'],
			'logo' 			=> $file_name,
			'phone' 		=> $_POST['phone'],
			'manager_inspector'	=> $manager_inspector,
			'status' 		=> $_POST['status']
		);
		$results = $this->login_model->updateCustomers($user_id, $post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Employee information updated successfully.');
			redirect('users/manage_employee');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function delete_employee($id){
		$id = intval($id);
		$this->login_model->delete_customer($id);
		$this->session->set_flashdata("flash_data", "Employee deleted Successfully");
		redirect(site_url("users/manage_employee"));
	}
	
	public function all_hotel_users_for_mentions(){
		$search_query	= $this->uri->segment(3);
		$query_results	= $this->login_model->all_hotel_users_for_mentions($search_query);
		
		foreach($query_results as $key => $val){
			$query_results[$key]->type = 'contact';
		}
		//return $query_results;
		echo json_encode($query_results);
		/*//echo '<pre>';
		//print_r($query_results);
		exit;*/
	}
	//USER FOOTPRINTS
	public function tracking(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id				= $this->session->userdata['logged_in']['firm_id'];
				
		$data['page_title'] 	= 'Track Users';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/tracking_info';
		$data['users']			= $this->login_model->get_hotel_Users($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function get_tracking(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id			= $this->session->userdata['logged_in']['firm_id'];
		$user_id			= $_POST['user_id'];
		$tracking_info		= $this->login_model->get_user_tracking($hotel_id, '20', $user_id);
		$HTML_TRACKING		= '';
		
		if(is_array($tracking_info)){
			foreach($tracking_info as $tracking_val){
				$generatedBy	= admin_helper::get_user_name($tracking_val->user_id);
				$generated_by	= $generatedBy[0]->username;
				$created_date	= date('h:i A', strtotime($tracking_val->created_date));
				
					 if($tracking_val->txt_type == 'logIn') {$lable = 'success'; $star = 'fa-star text-warning';}
				else if($tracking_val->txt_type == 'logout'){$lable = 'danger'; $star = 'fa-star text-warning';}
				else if($tracking_val->txt_type == 'ticket'){$lable = 'warning'; $star = 'fa-star-o';}
				else {$lable = ''; $star = 'fa-star-o';}
				
				$HTML_TRACKING	.= '<tr class="unread"><td class="hidden-xs"><i class="fa '.$star.'"></i></td>
											<td class="hidden-xs">'.$generated_by.'</td>
											<td class="max-texts"><span class="label label-'.$lable.'">'.ucwords($tracking_val->txt_type).'</span> '.$tracking_val->txt_bdy.'</td>
											<td class="text-right">'.$created_date.'</td>
                                    	</tr>';
			}
		}else{
				$HTML_TRACKING	.= '<tr class="unread"><td colspan="6" class="hidden-xs">No Results Found</td></tr>';
		}
		echo $HTML_TRACKING;
	}
	public function get_tracking_records(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id			= $this->session->userdata['logged_in']['firm_id'];
		$user_id			= $_POST['user_id'];
		$tracking_info		= $this->login_model->get_user_tracking($hotel_id, '', $user_id);
		$HTML_TRACKING		= '';
		
		if(is_array($tracking_info)){
				$HTML_TRACKING	.= 'Showing '.count($tracking_info).' - '.count($tracking_info).' of '.count($tracking_info);
		}else{
				$HTML_TRACKING	.= 'Showing 0 - 0 of 0';
		}
		echo $HTML_TRACKING;
	}
}
?>