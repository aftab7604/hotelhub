<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey_box extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->helper('admin_helper');
	}
	public function surveys(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id 	= $this->session->userdata['logged_in']['firm_id'];
		
		$data['page_title'] 	= 'Brand Survey Box';
		$data['site_name'] 		= ' | HOPS 247';
		$data['main_content'] 	= 'admin/survey_box';
		$data['gv_tickets']		= $this->login_model->getGVTickets($hotel_id);
		$this->load->view('admin/template', $data);	
	}
	public function edit_survey_box($id){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		$id = intval($id);
		$data['guest_voice']	= $this->login_model->get_single_guest_voice($id);
		$data['page_title'] 	= 'Brand Survey Box';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/edit_survey_box';
		$this->load->view('admin/template', $data);	
	}
	public function edit_survey_box_info(){
		$hotel_id 	= $this->session->userdata['logged_in']['firm_id'];
		if(empty($_POST['guest_name'])){$this->session->set_flashdata('flash_data_danger', 'Please enter guest name first!');}
		
		/*	 if($_POST['assign_to_dept'] == '2'){$col_name = 'mingrNotes';}
		else if($_POST['assign_to_dept'] == '3'){$col_name = 'frontDeskNotes';}
		else if($_POST['assign_to_dept'] == '4'){$col_name = 'houseKeepingNotes';}
		else if($_POST['assign_to_dept'] == '5'){$col_name = 'foodGuestNotes';}
		else if($_POST['assign_to_dept'] == '6'){$col_name = 'saleNotes';}
		else if($_POST['assign_to_dept'] == '7'){$col_name = 'mainnotes';}*/
		
		$g_id			= $_POST['g_id'];
		$ticket_type	= '3';//GV
		
		$post_data_main = array(
			'hotel_id'			=> $hotel_id,
			'ticket_type'		=> $ticket_type,
			'assign_to_dept'	=> $_POST['assign_to_dept'],
			'guest_name'		=> $_POST['guest_name'],
			'service_rec'		=> 'yes',
			'guest_type'		=> 'In-House',
			'ticket_status'		=> '1',
			'ticket_notes'		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['comments'])),
			'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($_POST['review_date']))
		);
		$results		= $this->login_model->add_main_ticket('ticket', $post_data_main);
		if($results){
			$post_data_gv = array(
				'ticket_id'		=> $results,
				'ticket_type'	=> $ticket_type,
				'ratting'		=> $_POST['rattings']
			);
			$this->login_model->add_main_ticket('ticket_type_gv', $post_data_gv);
			$post_data_inbox = array(
				'status'		=> $_POST['status'],
				'is_ticket'		=> '1',
				'is_approved'	=> '1'
			);
			$this->login_model->update_inbox($g_id, $post_data_inbox);
			$this->session->set_flashdata('flash_data', 'Guest Voice information updated successfully.');
			redirect(site_url("survey_box/surveys"));
		}
		//exit;
		/*$post_data = array(
			//'hotel_id'		=> $hotel_id,
			//'ticketStatus'	=> '1',
			//'special_ticket'=> '3',//GV
			//'houseGuest'	=> 'yes',
			'guestRoomNumber'=> '',
			'guestRoomType'	=> '',
			//'guestName'		=> $_POST['guest_name'],
			//'serviceRec'	=> 'yes',
			//'ratting'		=> $_POST['rattings'],
			//'assign_to_dept'=> $_POST['assign_to_dept'],
			//"$col_name"		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['comments'])),
			//'ticketDate'	=> gmdate('Y-m-d H:i:s A', strtotime($_POST['review_date']))
		);
		$this->login_model->addticket($post_data);
		
		$post_data_inbox = array(
			'status'		=> $_POST['status'],
			'is_ticket'		=> '1',
			'is_approved'	=> '1'
		);
		$results	= $this->login_model->update_inbox($g_id, $post_data_inbox);
		if($results){
			$this->session->set_flashdata('flash_data', 'Guest Voice information updated successfully.');
			redirect(site_url("survey_box/surveys"));
		}*/
		else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	public function delete_survey($id){
		$id = intval($id);
		
		$this->login_model->delete_guest_voice($id);
		$this->session->set_flashdata("flash_data", "Guest Voice deleted Successfully");
		redirect(site_url("survey_box/surveys"));
	}
}
?>