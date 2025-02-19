<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pmp extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("pmp_model");
		$this->load->helper('admin_helper');
		$this->load->helper('pm_report_helper');
	}
	public function index(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
				
		$data['page_title'] 	= 'Preventive Maintenance';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/pmp_main';
		$data['categories']		= $this->pmp_model->getAllPMPCategories();		
		$this->load->view('admin/template', $data);
	}
	public function add_cat(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		if(empty($_POST['cat_name'])){$this->session->set_flashdata('flash_data_danger', 'Please enter category name first!');}
		$post_data = array(
			'cat_name'	=> $_POST['cat_name'],
			'cat_type'	=> 'CHECKLIST',
			'status'	=> 1
		);
		$results = $this->pmp_model->savePMPCategory($post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Category has been added successfully.');
			redirect('pmp');
		}else{$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');}
	}
	public function add_item(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		if(empty($_POST['item_name'])){$this->session->set_flashdata('flash_data_danger', 'Please enter item name first!');}
		$post_data = array(
			'cat_id'		=> $_POST['cat_id'],
			'subcat_name'	=> $_POST['item_name'],
			'status'		=> 1
		);

		$results = $this->pmp_model->savePMPSubItems($post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Item has been added successfully.');
			redirect('pmp');
		}else{$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');}
	}
	/*Update*/
	public function update_cat(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		if(empty($_POST['cat_name'])){$this->session->set_flashdata('flash_data_danger', 'Please enter category name first!');}
		$post_data	= array('cat_name'	=> $_POST['cat_name']);
		$cat_id		= $_POST['cat_id'];
		
		$results = $this->pmp_model->updatePMPCategory($cat_id, $post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Category has been updated successfully.');
			redirect('pmp');
		}else{$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');}
	}
	public function update_item(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		if(empty($_POST['item_name'])){$this->session->set_flashdata('flash_data_danger', 'Please enter item name first!');}
		$post_data	= array('subcat_name'	=> $_POST['item_name']);
		$item_id	= $_POST['item_id'];

		$results = $this->pmp_model->updatePMPSubItems($item_id, $post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Item has been updated successfully.');
			redirect('pmp');
		}else{$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');}
	}
	/*item*/
	public function changeItemStatus(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$s_id		= $_POST['itemId'];
		$post_data	= array(
			'status' => $_POST['status']
		);
		
		$results = $this->pmp_model->updatePMPSubItemStatus($s_id, $post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Item Status has been updated successfully.');
		}else{$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');}
	}
	public function deleteItem(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$s_id		= $_POST['itemId'];		
		$results = $this->pmp_model->deletePMPSubItem($s_id);
		if($results){
			$this->session->set_flashdata('flash_data', 'Item has been deleted successfully.');
		}else{$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');}
	}
	/*category*/
	public function changeCategoryStatus(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$c_id		= $_POST['categoryId'];
		$post_data	= array(
			'status' => $_POST['status']
		);
		
		$results = $this->pmp_model->updatePMPCategoryStatus($c_id, $post_data);
		if($results){
			$this->session->set_flashdata('flash_data', 'Category Status has been updated successfully.');
		}else{$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');}
	}
	public function deleteCategory(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$c_id		= $_POST['categoryId'];		
		$results = $this->pmp_model->deletePMPCategory($c_id);
		if($results){
			$this->session->set_flashdata('flash_data', 'Category has been deleted successfully.');
		}else{$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');}
	}
	/*Manager window*/
	
	//CHECKLIST MY BOARD
	public function manage_board_checklist(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id		 		= $this->session->userdata['logged_in']['firm_id'];
				
		$data['page_title'] 	= 'Board Preventive Maintenance';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/pmp_board_manager';
		/*$data['room_types']		= $this->pmp_model->getAllDRoomTypes($hotel_id);*/
		//$data['categories']		= $this->pmp_model->getAllPMPActiveCategories();
		//$data['checklists']		= $this->pmp_model->getSingleChecklist($id);
		
		$data['categories']		= $this->pmp_model->checkCatExistsOrNotThenLoadDefault($hotel_id, 'MYBOARD');
		//$data['categories']		= $this->pmp_model->getAllPMPEditCategories($hotel_id, 'MYBOARD');
		$this->load->view('admin/template', $data);
	}
	public function save_checklist_board(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		if($_POST['category']){
			//echo '<pre>'; print_r($_POST);exit;
			foreach($_POST['category'] as $index=>$arrayOfCats){				
				$post_data = array(
					'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
					'room_type'		=> 'MYBOARD',
					'id'			=> $index,
					'cat_name'		=> $arrayOfCats["cat_name"],
					'status'		=> 1
				);
				$idOfNewAddedCat = $this->pmp_model->saveCustomCatBoard($post_data);
				unset($arrayOfCats["cat_name"]);
				
				if($idOfNewAddedCat){
					foreach($arrayOfCats as $subCatIDs=>$subCatsNames){
						$post_data_1 = array(
							'cat_id'		=> $idOfNewAddedCat,
							'subcat_name'	=> $subCatsNames,
							'id'			=> $subCatIDs,
							'type'			=> 'MYBOARD',
							'status'		=> 1
						);
						$results = $this->pmp_model->saveCustomSubCatBoard($post_data_1);
					}
				}
			}
		}
		/*$post_data = array(
			'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
			'room_type'		=> $_POST['room_type'],
			'status'		=> 1
		);
		$idOfNewAddedCat = $this->pmp_model->saveChecklistTemplates($post_data);*/
		//if($results){
			$this->session->set_flashdata('flash_data', 'Checklist has been updated successfully.');
			redirect('pmp/manage_board_checklist');
		//}else{$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');}
	}
	
	
	//CHECKLIST
	public function add_checklist(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
				
		$data['page_title'] 	= 'Preventive Maintenance';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/pmp_manager';
		$hotel_id		 		= $this->session->userdata['logged_in']['firm_id'];
		$data['categories']		= $this->pmp_model->getAllPMPActiveCategories();
		$room_types				= $this->pmp_model->getAllDRoomTypes($hotel_id);

		
		$filter_room_types = [];
		if($room_types) {
			foreach($room_types as $r_type) {
				$room_exist = $this->pmp_model->getChecklistByRoom($hotel_id, $r_type->room_type);
				if(!$room_exist || $room_exist == 0) {
					$filter_room_types[] = $r_type;
				}
			}
		}

		$data['room_types'] = $filter_room_types;

		$this->load->view('admin/template', $data);
	}
	public function save_checklist_buddy(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}

		$results = [];
		if($_POST['category']){
			foreach($_POST['category'] as $index=>$arrayOfCats){
				if(!empty($arrayOfCats["cat_name"])) {
					$post_data = array(
						'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
						'room_type'		=> $_POST['room_type'],
						'cat_name'		=> $arrayOfCats["cat_name"],
						'status'		=> 1
					);
					
					$idOfNewAddedCat = $this->pmp_model->saveCustomCat($post_data);
					unset($arrayOfCats["cat_name"]);
					if($idOfNewAddedCat){
						foreach($arrayOfCats as $subCatIDs=>$subCatsNames){
							$post_data_1 = array(
								'cat_id'		=> $idOfNewAddedCat,
								'subcat_name'	=> $subCatsNames,
								'status'		=> 1
							);
							$results = $this->pmp_model->saveCustomSubCat($post_data_1);
						}
					}
				}				
			}
		}
		
		$post_data = array(
			'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
			'room_type'		=> $_POST['room_type'],
			'status'		=> 1
		);
		$idOfNewAddedCat = $this->pmp_model->saveChecklistTemplates($post_data);

		if(!empty($results)){
			$this->session->set_flashdata('flash_data', 'Checklist has been added successfully.');
			redirect('pmp/manage_checklist');
		}else{
			$this->session->set_flashdata('flash_data_danger', 'There is an error, Please try again.');
		}
	}
	
	public function manage_checklist(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		
		$hotel_id				= $this->session->userdata['logged_in']['firm_id'];
		$data['page_title'] 	= 'Preventive Maintenance';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/manage_checklist';
		$data['checklists']		= $this->pmp_model->getAllHotelChecklists($hotel_id);		
		$this->load->view('admin/template', $data);
	}
	
	public function view_checklist($id){
		if(!isset($this->session->userdata['logged_in'])){
			redirect('login');
		}
		$id						= intval($id);
		$this->session->set_userdata('room_id', $id);
		$hotel_id		 		= $this->session->userdata['logged_in']['firm_id'];
		//$data['room_types']		= $this->pmp_model->getAllDRoomTypes($hotel_id);
		$data['checklists']		= $this->pmp_model->getSingleChecklist($id);

		$data['categories']		= $this->pmp_model->getAllPMPEditCategories($data['checklists'][0]->hotel_id,$data['checklists'][0]->room_type);
				
		$data['page_title'] 	= 'Preventive Maintenance';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/edit_checklist';
		$this->load->view('admin/template', $data);	
	}
	public function save_checklist_edit_buddy(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}

		$hotel_id = $this->session->userdata['logged_in']['firm_id'];
		$room_type = $_POST['room_type'];
		$form_subcat_ids = [];

		$new_cats = [];
		$new_subcats = [];
		if($_POST['category']){
			foreach($_POST['category'] as $index=>$arrayOfCats){
				if(!empty($arrayOfCats["cat_name"])) {
					$post_data = array(
						'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
						'room_type'		=> $_POST['room_type'],
						'cat_name'		=> $arrayOfCats["cat_name"],
						'status'		=> 1,
						'id'			=> $index
					);
					
					$idOfCat = $this->pmp_model->updateCustomCat($post_data);

					$id = $idOfCat['id'];
					$type = $idOfCat['type'];

					if ($type == 'new') {
						$new_cats[] = $id;
					}

					unset($arrayOfCats["cat_name"]);
					if($id){
						foreach($arrayOfCats as $subCatIDs=>$subCatsNames){
							$post_data_1 = array(
								'cat_id'		=> $id,
								'subcat_name'	=> $subCatsNames,
								'status'		=> 1,
								'id'			=> $subCatIDs
							);
							$result = $this->pmp_model->updateCustomSubCat($post_data_1);

							$s_id = $result['id'];
							$s_type = $result['type'];

							if ($s_type == 'new') {
								$new_subcats[] = $s_id;
							} else {
								$form_subcat_ids[] = $s_id;
							}
						}
					}
				}
				
			}
		}
		

		/* If a category unchecked, Delete that category and realted subcategories */
		// Extract all existing category IDs from the database
		$allCategories = $this->pmp_model->getAllCategories($hotel_id, $room_type);
		$existing_category_ids = [];
		if ($allCategories) {
			foreach ($allCategories as $category) {
				$existing_category_ids[] = $category->c_id;
			}
		}

		// Extract submitted category IDs from $_POST
		$submitted_category_ids = [];
		if (!empty($_POST['category'])) {
			foreach ($_POST['category'] as $index => $arrayOfCats) {
				$submitted_category_ids[] = $index; // $index is the category ID from $_POST
			}
		}

		// Find categories that exist in $allCategories but are missing in $_POST['category']
		$missing_category_ids = array_diff($existing_category_ids, $submitted_category_ids);

		// Check if missing_category_ids exist in new_cat array, then remove them
		$missing_category_ids = array_diff($missing_category_ids, $new_cats);


		if(!empty($missing_category_ids)){
			// Fetch subcategories related to deleted categories
			$missing_subcats = $this->pmp_model->getSubCatsByCatIds($missing_category_ids);

			if (!empty($missing_subcats)) {
				// Extract subcategory IDs
				$missing_subcat_ids = array_column($missing_subcats, 's_id');
		
				// Delete those subcategories
				$this->pmp_model->deleteCustomSubCats($missing_subcat_ids);
			}

			$this->pmp_model->deleteCustomCats($missing_category_ids);

		}

		/* Delete subcategory if unchecked */
		if(!empty($existing_category_ids)) {
			$subcats = $this->pmp_model->getSubCatsByCatIds($existing_category_ids);
			if (!empty($subcats)) {
				// Extract subcategory IDs
				$subcats_ids = array_column($subcats, 's_id');

				$missing_subcat_ids = array_diff($subcats_ids, $form_subcat_ids);
				$missing_subcat_ids = array_diff($missing_subcat_ids, $new_subcats);

				if(!empty($missing_subcat_ids)) {
					$this->pmp_model->deleteCustomSubCats($missing_subcat_ids);
				}
			}
		}
		
		$this->session->set_flashdata('flash_data', 'Checklist has been updated successfully.');
		$room_id = $this->session->userdata('room_id');
		
        redirect('pmp/view_checklist/' . $room_id);

	//	redirect('pmp/manage_checklist');
	}
	public function toggle_checklist($id){
		$id		= intval($id);
		$hotel_id = $this->session->userdata['logged_in']['firm_id'];
		$result = $this->pmp_model->toggle_checklist($id, $hotel_id);
		if($result) {
			$this->session->set_flashdata("flash_data", "Checklist Updated Successfully.");
		} else {
			$this->session->set_flashdata("flash_data_danger", "Only one active record allowed per room type.");
		}
		
		redirect('pmp/manage_checklist');
	}
	public function getChecklistQuarter(){
		$current_month = date('m');
		$current_year = date('Y');
		if($current_month>=1 && $current_month<=3){$quarter = '1st';}
		else if($current_month>=4 && $current_month<=6){$quarter = '2nd';}
		else if($current_month>=7 && $current_month<=9){$quarter = '3rd';}
		else if($current_month>=10 && $current_month<=12){$quarter = '4th';}
		return $quarter;
	}
	public function getChecklistQuarterHTML(){
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
	public function getQuarterHTMLByQuarter($quarter){
		$current_year = date('Y');
		if($quarter == '1st'){
			$start_date = strtotime('1-January-'.$current_year);
			$end_date = strtotime('1-April-'.$current_year);
		}else if($quarter == '2nd'){
			$start_date = strtotime('1-April-'.$current_year);
			$end_date = strtotime('1-July-'.$current_year);
		}else if($quarter == '3rd'){
			$start_date = strtotime('1-July-'.$current_year);
			$end_date = strtotime('1-October-'.$current_year);
		}else if($quarter == '4th'){
			$start_date = strtotime('1-October-'.$current_year);
			$end_date = strtotime('1-January-'.($current_year+1));
		}
		$quarter = '<div class="pull-right">'.$quarter.' Quarter, '. date('Y-m-d', $start_date). ' to '.date('Y-m-d', $end_date).'</div>';
		return $quarter;
	}
	public function lastEditted($db_modify_date){
		$db_modify_date = new DateTime($db_modify_date);
		$time_passed	= $db_modify_date->diff(new DateTime(date("Y-m-d H:i:s")));
		if($time_passed->y > 0){return $value = $time_passed->y.' year';}
		if($time_passed->m > 0){return $value = $time_passed->m.' months';}
		if($time_passed->d > 0){return $value = $time_passed->d.' days';}
		if($time_passed->h > 0){return $value = $time_passed->h.' hours';}
		if($time_passed->i > 0){return $value = $time_passed->i.' minutes';}
		if($time_passed->s > 0){return $value = $time_passed->s.' seconds';}
	}
	public function checklist_report(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id		 		= $this->session->userdata['logged_in']['firm_id'];
		$data['quarterHTML']	= $this->getChecklistQuarterHTML();
		$data['quarter']		= $this->getChecklistQuarter();
		$data['rooms']			= $this->login_model->getHotelRooms($hotel_id);
		
		$data['page_title'] 	= 'Preventive Maintenance';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/employee_checklist_report';
		$this->load->view('admin/template', $data);	
	}
	public function checklist($room_type){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id		 		= $this->session->userdata['logged_in']['firm_id'];
		$room_no				= $this->uri->segment(3);
		$room_type				= $this->uri->segment(4);
		$url_quarter			= $this->uri->segment(5);
		$data['room_no']		= $room_no;
		$data['room_type']		= $room_type;
		
		if($url_quarter){
			$data['quarter']	= $url_quarter;
			$data['quarterHTML']= $this->getQuarterHTMLByQuarter($url_quarter);
		}else{
			$data['quarter']	= $this->getChecklistQuarter();
			$data['quarterHTML']= $this->getChecklistQuarterHTML();
		}
		$data['categories']		= $this->pmp_model->getAllPMPEditCategories($hotel_id, $room_type);
				
		$data['page_title'] 	= 'Preventive Maintenance';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/employee_checklist';
		$this->load->view('admin/template', $data);	
	}
	public function save_emp_checklist(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$checked		= $_POST['checked'];
		$files			= array();
		$filename		= '';
		$ticket_type	= '4';//PMP
		
		if(isset($_FILES['file'])){
			foreach($_FILES["file"]["tmp_name"] as $key=>$tmp_name){
				$target_dir 	= "assets/images/pmp_images/";
				$uploaded_file	= $target_dir . basename($_FILES["file"]["name"][$key]);		
				$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
				$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
				$target_file	= $target_dir. $new_file_name;
				if (move_uploaded_file($_FILES["file"]["tmp_name"][$key], $target_file)){
					$files[]	= $new_file_name;
				}
			}
			$filename = implode(",", $files);
		}
		
		if($_POST['flaged'] == 'flag'){
			$flag_type		= $_POST['flaged_type'];
			$post_data_main = array(
				'hotel_id'			=> $_POST['hotel_id'],
				'ticket_type'		=> $ticket_type,
				'generated_by'		=> $this->session->userdata['logged_in']['id'],
				'assign_to_dept'	=> '7',
				'service_rec'		=> 'no',
				'room_no'			=> $_POST['room_no'],
				'room_type'			=> $_POST['room_type'],
				'ticket_notes'		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes'])),
				'ticket_filename'	=> $filename,
				'ticket_status'		=> '1',
				'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
			);
			$results		= $this->login_model->add_main_ticket('ticket', $post_data_main);
			if($results){
				$post_data_pmp	= array(
					'ticket_id'			=> $results,
					'ticket_type'		=> $ticket_type,
					'pmp_status'		=> $_POST['flaged'],
					'flag_type'			=> $_POST['flaged_type'],
					'flag_type_2'		=> $_POST['flaged_type_2'],
					'vendor_req' 		=> $_POST['vendor'],
					'cat_id'			=> $_POST['cat_id'],
					'item_id'			=> $_POST['item_id'],
					'quarter'			=> $_POST['quarter'],
				);
				$this->login_model->add_main_ticket('ticket_type_pmp', $post_data_pmp);
			}
			/*$flag_type	= $_POST['flaged_type'];			
			$post_data_ticket = array(
				//'assign_to_dept' 	=> '7',
				//'pickuped_by' 		=> '0',
				//'serviceRec' 		=> 'no',
				//'ticketStatus' 		=> '1',
				//'hotel_id'			=> $_POST['hotel_id'],
				//'ticketGenBy' 		=> $this->session->userdata['logged_in']['username'],
				//'guestRoomNumber' 	=> $_POST['room_no'],
				//'guestRoomType' 	=> $_POST['room_type'],			
				
				//'special_ticket' 	=> '1',
				'pm_status'			=> $_POST['flaged'],
				'flage_type' 		=> $flag_type,
				'flage_type_2' 		=> $_POST['flaged_type_2'],
				'vendor_req' 		=> $_POST['vendor'],
				'cat_id'			=> $_POST['cat_id'],
				'item_id'			=> $_POST['item_id'],
				'quarter'			=> $_POST['quarter'],
				//'pm_notes'			=> $notes,//str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($notes)),
				//'pm_filename'		=> $filename,
				//'ticketDate'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
			$this->pmp_model->save_special_ticket($post_data_ticket);*/
		}else{
			$flag_type	= '';
			if($_POST['repair'] == 'yes'){$spsfic_req = $_POST['repair_yes_notes'];}else{$spsfic_req = '';}
			$post_data_main = array(
				'hotel_id'			=> $_POST['hotel_id'],
				'ticket_type'		=> $ticket_type,
				'generated_by'		=> $this->session->userdata['logged_in']['id'],
				'assign_to_dept'	=> '3',
				'service_rec'		=> 'yes',
				'room_no'			=> $_POST['room_no'],
				'room_type'			=> $_POST['room_type'],
				'ticket_notes'		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes'])),
				'ticket_filename'	=> $filename,
				'ticket_status'		=> '1',
				'created_date'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')),
			);
			$results		= $this->login_model->add_main_ticket('ticket', $post_data_main);
			if($results){
				$post_data_pmp	= array(
					'ticket_id'			=> $results,
					'ticket_type'		=> $ticket_type,
					'pmp_status'		=> $_POST['flaged'],
					'repair_req'		=> $_POST['repair'],
					'item_ratting'		=> $_POST['rate'],
					'spsfic_req'		=> $spsfic_req,
					'cat_id'			=> $_POST['cat_id'],
					'item_id'			=> $_POST['item_id'],
					'quarter'			=> $_POST['quarter'],
				);
				$this->login_model->add_main_ticket('ticket_type_pmp', $post_data_pmp);
			}
			/*$post_data_ticket = array(				
				//'assign_to_dept' 	=> '3',
				//'pickuped_by' 		=> '0',
				//'serviceRec' 		=> 'yes',
				//'ticketStatus' 		=> '1',
				//'hotel_id'			=> $_POST['hotel_id'],
				//'ticketGenBy' 		=> $this->session->userdata['logged_in']['username'],
				//'guestRoomNumber' 	=> $_POST['room_no'],
				//'guestRoomType' 	=> $_POST['room_type'],		
				
				//'special_ticket' 	=> '1',
				//'pm_status'			=> $_POST['flaged'],
				//'repair_req'		=> $_POST['repair'],
				//'ratting'			=> $_POST['rate'],
				//'spsfic_req'		=> $spsfic_req,
				//'cat_id'			=> $_POST['cat_id'],
				//'item_id'			=> $_POST['item_id'],
				//'quarter'			=> $_POST['quarter'],
				//'pm_notes'			=> $notes,//str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($notes)),
				//'pm_filename'		=> $filename,
				//'ticketDate'		=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
			$this->pmp_model->save_special_ticket($post_data_ticket);*/
		}
		
		$post_data = array(
			'hotel_id'	=> $_POST['hotel_id'],
			'user_id'	=> $_POST['user_id'],
			'room_no'	=> $_POST['room_no'],
			'room_type'	=> $_POST['room_type'],
			'cat_id'	=> $_POST['cat_id'],
			'item_id'	=> $_POST['item_id'],
			'quarter'	=> $_POST['quarter'],
			'flag'		=> $_POST['flaged'],
			'flag_type'	=> $flag_type,
			'notes'		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes'])),
			//str_replace(array("&amp;lt;p&amp;gt;", "&amp;lt;/p&amp;gt;"), "", htmlspecialchars($notes)),
			'filename'	=> $filename,
			'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		$this->pmp_model->save_emp_checklist($post_data);
	}
	public function del_emp_checklist(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$post_data = array(
			'hotel_id'	=> $_POST['hotel_id'],
			'user_id'	=> $_POST['user_id'],
			'room_no'	=> $_POST['room_no'],
			'room_type'	=> $_POST['room_type'],
			'cat_id'	=> $_POST['cat_id'],
			'item_id'	=> $_POST['item_id'],
			'quarter'	=> $_POST['quarter']
		);
		$this->pmp_model->del_emp_checklist($post_data);
	}
	public function summary(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id		 		= $this->session->userdata['logged_in']['firm_id'];
		$room_no				= $this->uri->segment(3);
		$room_type				= $this->uri->segment(4);
		$data['room_no']		= $room_no;
		$data['room_type']		= $room_type;
		$data['quarterHTML']	= $this->getChecklistQuarterHTML();
		$data['logs']			= $this->pmp_model->getAllPMPLogs($hotel_id, $room_no, $room_type);
				
		$data['page_title'] 	= 'Preventive Maintenance Summary';
		$data['site_name'] 		= ' | HOPS 247';		
		$data['main_content'] 	= 'admin/checklist_summary';
		$this->load->view('admin/template', $data);
	}
	public function save_tickets_reply_noti(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$txt_bdy	= 'Mention you in a ticket#'.$_POST['ticket_id'];
		$post_url	= site_url("ticket/ticket_info/").'/'.$_POST['ticket_id'];
		$post_data 	= array(
			'hotel_id'		=> $this->session->userdata['logged_in']['firm_id'],
			'created_by'	=> $this->session->userdata['logged_in']['id'],
			'user_id'		=> $_POST['user_id'],
			'txt_hdn'		=> $this->session->userdata['logged_in']['username'],
			'txt_bdy'		=> $txt_bdy,
			'post_url'		=> $post_url,
			'txt_type'		=> 'tkt_message',
			'created_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		
		$this->pmp_model->save_top_noti($post_data);
	}
	public function save_notes_reply(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
		
		$File_name = '';
		if($_FILES['file']){
			$target_dir 	= "assets/images/ticket_images/";
			$uploaded_file	= $target_dir . basename($_FILES["file"]["name"]);			
			$imageFileType	= pathinfo($uploaded_file,PATHINFO_EXTENSION);
			$new_file_name	= 'GSS_'.time().'_'.rand(0, 1000).'.'.$imageFileType;
			$target_file	= $target_dir. $new_file_name;
			 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
				 $File_name = $new_file_name;
			}
		}
		$post_data = array(
			'hotel_id'		=> $hotel_id,
			'added_by'		=> $this->session->userdata['logged_in']['username'],
			'status'		=> '1',
			'file_name'		=> $File_name,
			'ticket_id'		=> $_POST['ticket_num'],
			//'message'		=> str_replace(array("&lt;p&gt;", "&lt;/p&gt;"), "", htmlspecialchars($_POST['notes'])),
			'message'		=> $_POST['notes'],
			'added_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		$inserted_id 		= $this->pmp_model->save_notes_reply($post_data);
		
		$users	= $this->login_model->get_hotel_Users($hotel_id);
		foreach($users as $user_val){
			$post_data_view 	= array(
				'hotel_id'		=> $hotel_id,
				'ticket_id'		=> $_POST['ticket_num'],
				'user_id'		=> $user_val->id,
				'user_name'		=> $user_val->username,
				'message_id'	=> $inserted_id,
				'added_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
			);
			$this->pmp_model->save_notes_reply_status($post_data_view);
		}
	}
	/*Message View In Ticket*/
	public function update_notes_reply_status(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id			= $this->session->userdata['logged_in']['firm_id'];
		$user_id			= $this->session->userdata['logged_in']['id'];
		
		$post_data_view 	= array(
			'hotel_id'		=> $hotel_id,
			'user_id'		=> $user_id,
			'ticket_id'		=> $_POST['ticket_id'],
			'status'		=> 'seen',
			'added_date'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		$this->pmp_model->update_notes_reply_status($post_data_view);
	}
	public function get_notes_reply_status(){
		if(!isset($this->session->userdata['logged_in'])){redirect('login');}
		$hotel_id			= $this->session->userdata['logged_in']['firm_id'];
		$user_id			= $this->session->userdata['logged_in']['id'];
		
		$post_data_view 	= array(
			'hotel_id'		=> $hotel_id,
			'user_id'		=> $user_id,
			'ticket_id'		=> $_POST['ticket_id']
		);
		$notifications 		= $this->pmp_model->get_notes_reply_status($post_data_view);
		$html 				= '';
		if(is_array($notifications)){
			$html 			.= '<div class="steamline">';
			foreach($notifications as $val){
				$html 			.= '<div class="sl-item m-0"><div class="sl-left" style="background: none;"><img src="'.base_url().'assets/plugins/images/users/varun.jpg" alt="'.$val->user_name.'" class="img-circle"></div><div class="sl-right m-b-10"><div class="m-l-20 p-t-20"><a href="javascript:;" class="text-info">'.$val->user_name.'</a> <span class="sl-date">'.date("m-d-y h:i a", strtotime($val->added_date)).'</span></div></div></div>';
			}
			$html 			.= '</div>';
		}
		echo $html;
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