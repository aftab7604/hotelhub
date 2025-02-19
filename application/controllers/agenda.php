<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->helper('admin_helper');
		$this->load->helper('pm_report_helper');
	}
	public function add_agenda(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 				= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Manage Agenda';
		$data['site_name'] 		= ' | HOPS 247';
		$data['main_content'] 	= 'admin/add_agenda';
		$data['agenda_list']	= $this->login_model->get_agendas_list($hotel_id);
		$this->load->view('admin/template', $data);
	}
	public function add_agenda_info(){
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		if(empty($_POST['agenda_task'])){$this->session->set_flashdata('flash_data_danger', 'Please enter agenda task first!');}
		$post_data = array(
			'hotel_id'			=> $hotel_id,
			'agenda_created_by'	=> $this->session->userdata['logged_in']['id'],
			'agenda_task' 		=> $_POST['agenda_task'],
			'status' 			=> 1,
			'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		$results = $this->login_model->save_agenda($post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Agenda has been added successfully.');
			redirect('agenda/add_agenda');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function edit_agenda_info(){
		$agenda_id	= $_POST['agenda_id'];
		
		if(empty($_POST['agenda_task'])){$this->session->set_flashdata('flash_data_danger', 'Please enter agenda task first!');}
		$post_data = array('agenda_task' 	=> $_POST['agenda_task']);
		
		$results = $this->login_model->update_agenda($agenda_id, $post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Agenda has been updated successfully.');
			redirect('agenda/add_agenda');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function delete_agenda($id){
		$id = intval($id);
		$this->login_model->delete_agenda($id);
		$this->session->set_flashdata("flash_data", "Agenda deleted Successfully");
		redirect("agenda/add_agenda");
	}
	
	public function agenda_checklist($agenda_id){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 				= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Add Agenda Checklist';
		$data['site_name'] 		= ' | HOPS 247';
		$data['main_content'] 	= 'admin/agenda_checklist';
		
		$agenda_id 				= intval($agenda_id);
		$data['agenda_info']	= $this->login_model->get_single_agenda($agenda_id);
		$data['depts']	 		= $this->login_model->get_agenda_chk_Roles();
		$data['users']	 		= $this->login_model->get_hotel_Users($hotel_id);
		$data['areas_list']		= $this->login_model->get_areas_list();
		$data['agenda_checklist']	= $this->login_model->get_agenda_checklist($agenda_id);
		$this->load->view('admin/template', $data);
	}
	public function agenda_checklist_info(){
		$weekdays	= $veriAgenda	= '';
		if($_POST['assign_to_dp_ur'] == 'user'){$assign_ids = $_POST['select_users_drp'];}else{$assign_ids = $_POST['select_dept_drp'];}
		foreach($_POST['assign_weekdays'] 	as $weekday_val){$weekdays .= $weekday_val.',';}
		foreach($_POST['veri_agd_comp'] 	as $veri_agd_comp_val){$veriAgenda .= $veri_agd_comp_val.',';}
		
		$post_data = array(
			'agenda_id'			=> $_POST['agenda_id'],
			'todo_task'			=> $_POST['todo_task'],
			'assign_to_type'	=> $_POST['assign_to_dp_ur'],
			'assign_ids' 		=> $assign_ids,
			'area_type' 		=> $_POST['area_type'],
			'area_type_cus' 	=> $_POST['custom_area'],
			'assign_weekdays'	=> $weekdays,
			'time_to_comp' 		=> $_POST['time_to_comp'],
			'time_hr_min' 		=> $_POST['time_hr_min'],
			'veri_agd_comp'		=> $veriAgenda,
			'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		
		$results = $this->login_model->save_agenda_checklist($post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Agenda Checklist has been added successfully.');
			redirect('agenda/agenda_checklist/'.$_POST['agenda_id']);
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function edit_checklist_info(){		
		$weekdays	= $veriAgenda	= '';
		if($_POST['assign_to_dp_ur'] == 'user'){$assign_ids = $_POST['select_users_drp'];}else{$assign_ids = $_POST['select_dept_drp'];}
		foreach($_POST['assign_weekdays'] 	as $weekday_val){$weekdays .= $weekday_val.',';}
		foreach($_POST['veri_agd_comp'] 	as $veri_agd_comp_val){$veriAgenda .= $veri_agd_comp_val.',';}
		
		$agenda_id				= $_POST['agenda_id'];
		$agenda_checklist_id	= $_POST['adg_chk_id'];
		$post_data = array(
			'todo_task'			=> $_POST['todo_task'],
			'assign_to_type'	=> $_POST['assign_to_dp_ur'],
			'assign_ids' 		=> $assign_ids,
			'area_type' 		=> $_POST['area_type'],
			'area_type_cus' 	=> $_POST['custom_area'],
			'assign_weekdays'	=> $weekdays,
			'time_to_comp' 		=> $_POST['time_to_comp'],
			'time_hr_min' 		=> $_POST['time_hr_min'],
			'veri_agd_comp'		=> $veriAgenda,
			'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		
		//echo '<pre>';print_r($post_data);exit;
		$results = $this->login_model->update_agenda_checklist($agenda_checklist_id, $post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Agenda Checklist has been updated successfully.');
			redirect('agenda/agenda_checklist/'.$agenda_id);
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function update_priority_of_agenda_list(){
		foreach($_POST['page_id_array'] as $priority => $agenda_checklist_id){
			$agenda_priority = $priority+1;
			$this->login_model->update_agenda_checklist_priority($agenda_checklist_id, $agenda_priority);
		}
	}
	public function delete_agenda_checklist(){
		$id = intval($this->uri->segment(4));
		$this->login_model->delete_agenda_checklist($id);
		$this->session->set_flashdata("flash_data", "Checklist deleted Successfully");
		redirect("agenda/agenda_checklist/".intval($this->uri->segment(3)));
	}
	
	
	public function pdf_work(){
		$data['page_title'] 	= 'PDF Work';
		$data['site_name'] 		= ' | HOPS 247';
		$data['main_content'] 	= 'admin/pdf_work';
		//$this->load->view('admin/template', $data);
		$this->load->view('admin/pdf_work');
	}
}
?>