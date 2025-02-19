<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->helper('admin_helper');
		$this->load->helper('pm_report_helper');
	}
	public function checklist_report(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id		 		= $this->session->userdata['logged_in']['firm_id'];
		
		$data['quarterHTML']	= $this->getChecklistQuarterHTML_2();
		$data['quarter']		= $this->getChecklistQuarter_2();
		$data['rooms']			= $this->login_model->getHotelRooms($hotel_id);
				
		$data['page_title'] 	= 'Preventive Maintenance';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/employee_checklist_report';
		$this->load->view('admin/template', $data);	
	}
	public function getChecklistQuarterHTML_2(){
		$current_month = date('m');
		$current_year = date('Y');
		if($current_month>=1 && $current_month<=3){
			$quarter = '1st';
			$start_date = strtotime('1-January-'.$current_year);
			$end_date = strtotime('1-April-'.$current_year);
		}else if($current_month>=4 && $current_month<=6){
			$quarter = '2nd';
			$start_date = strtotime('1-April-'.$current_year);
			$end_date = strtotime('1-July-'.$current_year);
		}else if($current_month>=7 && $current_month<=9){
			$quarter = '3rd';
			$start_date = strtotime('1-July-'.$current_year);
			$end_date = strtotime('1-October-'.$current_year);
		}else if($current_month>=10 && $current_month<=12){
			$quarter = '4th';
			$start_date = strtotime('1-October-'.$current_year);
			$end_date = strtotime('1-January-'.($current_year+1));
		}
		$quarter = '<div class="pull-right">'.$quarter.' Quarter, '. date('Y-m-d', $start_date). ' to '.date('Y-m-d', $end_date).'</div>';
		return $quarter;
	}
	public function getChecklistQuarter_2(){
		$current_month = date('m');
		$current_year = date('Y');
		if($current_month>=1 && $current_month<=3){$quarter = '1st';}
		else if($current_month>=4 && $current_month<=6){$quarter = '2nd';}
		else if($current_month>=7 && $current_month<=9){$quarter = '3rd';}
		else if($current_month>=10 && $current_month<=12){$quarter = '4th';}
		return $quarter;
	}
	public function checklistPerDay(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id		 		= $this->session->userdata['logged_in']['firm_id'];
		
		$data['quarter']		= $this->getChecklistQuarter();
		$data['rooms']			= $this->login_model->getHotelRooms($hotel_id);
		$data['comp_per']		= $this->login_model->get_settings($hotel_id);
		
		$data['page_title'] 	= 'Preventive Maintenance';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/checklist_room_per_day';
		$this->load->view('admin/template', $data);
	}
}
?>