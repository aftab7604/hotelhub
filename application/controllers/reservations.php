<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservations extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->model("log_book_model");
		$this->load->helper('admin_helper');
		$this->load->helper('survey_helper');
	}
	public function index(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Reservations';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/reservations';
		$data['reservations']	= $this->login_model->getReservations($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function confirm_reservation($id){
		$id = intval($id);
		
		$this->login_model->confirm_reservation($id);
		$this->session->set_flashdata("flash_data", "Reservation confirmed Successfully");
		redirect(site_url("reservations"));
	}
	public function delete_reservation($id){
		$id = intval($id);
		
		$this->login_model->delete_reservation($id);
		$this->session->set_flashdata("flash_data", "Reservation deleted Successfully");
		redirect(site_url("reservations"));
	}
	public function make_reservation(){
		$survey_id	= $this->login_model->encryptor('decrypt', $this->uri->segment(3));//encrypt
		
		$data['page_title'] 	= 'Make Reservations';
		$data['site_name'] 		= ' | HOPS 247';
		$reservations			= $this->login_model->getSingleSurveyInfo($survey_id);
		$data['reservations']	= $reservations;
		$data['room_type']		= $this->pmp_model->getAllDRoomTypes($reservations[0]->hotel_id);
		$data['footer']			= $this->load->view('admin/footer', NULL, TRUE);
		
		$this->load->view('admin/make_reservations', $data);
	}
	public function add_reservations(){
		$arrivaldate 	= DateTime::createFromFormat('m-d-Y', $this->input->post('arrival_date'));
		$departdate		= DateTime::createFromFormat('m-d-Y', $this->input->post('depart_date'));
		$post_data = array(
			'hotel_id'		=> $_POST['hotel_id'],
			'guest_name' 	=> $_POST['guest_name'],
			'guest_email' 	=> $_POST['guest_email'],
			'guest_phone' 	=> $_POST['guest_phone'],
			'room_type' 	=> $_POST['room_type'],			
			'arrival_date'	=> $arrivaldate->format('Y-m-d'),
			'depart_date'	=> $departdate->format('Y-m-d'),
			'status'		=> 0
		);
		/*echo '<pre>';
		print_r($post_data);*/
		$results = $this->login_model->save_future_reservations($post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Reservation has been added successfully.');
			redirect('/');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
}
?>