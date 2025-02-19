<?php



class Pmp_Model extends CI_Model 

{

	public function savePMPCategory($post_data){

		$firm = $this->db->insert('pmp_cat', $post_data);

		$insert_id 	= $this->db->insert_id();

		return $insert_id;

	}

	public function getAllPMPCategories(){

		$query =  $this->db->where("cat_type", 'CHECKLIST')->get("pmp_cat");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function savePMPSubItems($post_data){

		$firm = $this->db->insert('pmp_subcat', $post_data);

		$insert_id 	= $this->db->insert_id();

		return $insert_id;

	}

	public function updatePMPSubItemStatus($s_id, $post_data){

		$this->db->where("s_id", $s_id)->update("pmp_subcat", $post_data);

		return true;

	}

	public function deletePMPSubItem($s_id){

		$this->db->where("s_id", $s_id)->delete("pmp_subcat");

		return true;

	}

	public function updatePMPCategoryStatus($c_id, $post_data){

		$this->db->where("c_id", $c_id)->update("pmp_cat", $post_data);

		return true;

	}

	public function deletePMPCategory($c_id){

		$this->db->where("c_id", $c_id)->delete("pmp_cat");

		return true;

	}

	public function updatePMPCategory($c_id, $post_data){

		$this->db->where("c_id", $c_id)->update("pmp_cat", $post_data);

		return true;

	}

	public function updatePMPSubItems($s_id, $post_data){

		$this->db->where("s_id", $s_id)->update("pmp_subcat", $post_data);

		return true;

	}

	

	/*Manager*/

	public function getAllDRoomTypes($hotel_id){

		$query =  $this->db->query("SELECT distinct(room_type) FROM rooms WHERE hotel_id = ".$hotel_id." ");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function getAllDRoomFloors($hotel_id){

		$query =  $this->db->query("SELECT distinct(floor_num) FROM rooms WHERE hotel_id = ".$hotel_id." ");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function getAllChecklistCreatedRoomTypes($hotel_id){

		$query =  $this->db->query("SELECT DISTINCT (CONCAT(room_type)) AS type FROM custom_cat WHERE hotel_id = ".$hotel_id." ");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function getAllPMPActiveCategories(){

		$query =  $this->db->where("status", '1')->where("cat_type", 'CHECKLIST')->get("pmp_cat");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}
	
	public function getAllCategories($hotel_id, $room_type) {
		$query = $this->db->where("hotel_id", $hotel_id)->where("room_type", $room_type)->get("custom_cat");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function deleteCustomCats($ids) {
		if (!empty($ids)) {
        
			$this->db->where_in("c_id", $ids)->delete("custom_cat");
		}
	}

	public function getSubCatsByCatIds($cat_ids) {
		if (!empty($cat_ids)) {
			$query = $this->db->where_in("cat_id", $cat_ids)->get("custom_subcat");
			return $query->result_array();
		}
		return [];
	}

	public function deleteCustomSubCats($subcat_ids) {
		if (!empty($subcat_ids)) {
			$this->db->where_in("s_id", $subcat_ids)->delete("custom_subcat");
		}
	}	

	public function updateCustomCat($post_data){
		$query =  $this->db->where("c_id", $post_data['id'])->where("room_type", $post_data['room_type'])->get("custom_cat");
		if ($query->num_rows() > 0) {
			$this->db->where("c_id", $post_data['id'])->update("custom_cat", array('cat_name' => $post_data['cat_name']));
			$data = [
				'id' => $post_data['id'],
				'type' => 'old'
			];
			return $data;			
		} else {
			unset($post_data["id"]);
			$firm = $this->db->insert('custom_cat', $post_data);
			$insert_id 	= $this->db->insert_id();

			$data = [
				'id' => $insert_id,
				'type' => 'new'
			];
			return $data;
		}
	}

	public function updateCustomSubCat($post_data){
		$query =  $this->db->where("s_id", $post_data['id'])->get("custom_subcat");
		if ($query->num_rows() > 0) {
			$this->db->where("s_id", $post_data['id'])->update("custom_subcat", array('subcat_name' => $post_data['subcat_name']));
			$data = [
				'id' => $post_data['id'],
				'type' => 'old'
			];
			return $data;			
		} else {
			unset($post_data["id"]);
			$firm = $this->db->insert('custom_subcat', $post_data);
			$insert_id 	= $this->db->insert_id();

			$data = [
				'id' => $insert_id,
				'type' => 'new'
			];
			return $data;
		}
	}
	
	public function getChecklistByRoom($hotel_id, $room_type){
		$query =  $this->db->where("hotel_id", $hotel_id)->where("room_type", $room_type)->get("checklist_templates");

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function saveCustomCatBoard($post_data){
		$query =  $this->db->where("c_id", $post_data['id'])->where("room_type", $post_data['room_type'])->get("custom_cat");
		if ($query->num_rows() > 0) {
			$this->db->where("c_id", $post_data['id'])->update("custom_cat", array('cat_name' => $post_data['cat_name']));
			return $post_data['id'];			
		} else {
			unset($post_data["id"]);
			$firm = $this->db->insert('custom_cat', $post_data);
			$insert_id 	= $this->db->insert_id();
			return $insert_id;
		}
	}
	public function saveCustomSubCatBoard($post_data){
		$query =  $this->db->where("s_id", $post_data['id'])->where("type", $post_data['type'])->get("custom_subcat");
		if ($query->num_rows() > 0) {
			$this->db->where("s_id", $post_data['id'])->update("custom_subcat", array('subcat_name' => $post_data['subcat_name']));
			return $post_data['id'];			
		} else {
			unset($post_data["id"]);
			$firm = $this->db->insert('custom_subcat', $post_data);
			$insert_id 	= $this->db->insert_id();
			return $insert_id;
		}
	}
	

	public function saveCustomCat($post_data){

		$firm = $this->db->insert('custom_cat', $post_data);

		$insert_id 	= $this->db->insert_id();

		return $insert_id;

	}

	public function saveCustomSubCat($post_data){

		$firm = $this->db->insert('custom_subcat', $post_data);

		$insert_id 	= $this->db->insert_id();

		return $insert_id;

	}

	public function saveChecklistTemplates($post_data){

		$firm = $this->db->insert('checklist_templates', $post_data);

		$insert_id 	= $this->db->insert_id();

		return $insert_id;

	}

	public function getAllHotelChecklists($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->get("checklist_templates");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function toggle_checklist($clt_id, $hotel_id) {
		// Get the current checklist details
		$checklist = $this->db->select('room_type, status')
			->where('clt_id', $clt_id)
			->get('checklist_templates')
			->row();
	
		$room_type = $checklist->room_type;
		$current_status = $checklist->status;
	
		// If the current status is inactive (0) and we want to activate it (1), check if another is active
		if ($current_status == '0') {
				$this->db->where('room_type', $room_type)->where('status', '1');
				if($hotel_id && $hotel_id !== 0) {
					$this->db->where('hotel_id', $hotel_id);
				}				
				$active_count = $this->db->count_all_results('checklist_templates');
	
			if ($active_count > 0) {
				// If another record of the same type is already active, prevent activation
				return false;
			}
		}
	
		// Toggle status
		$new_status = ($current_status == '1') ? '0' : '1';
	
		// Update database
		$this->db->where('clt_id', $clt_id)
			->update('checklist_templates', ['status' => $new_status]);
	
		return true;
	}

	public function getSingleChecklist($clt_id){

		$query =  $this->db->where("clt_id", $clt_id)->get("checklist_templates");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function checkCatExistsOrNotThenLoadDefault($hotel_id, $room_type){
		$query		= $this->db->where("hotel_id", $hotel_id)->where("room_type", $room_type)->where("status", '1')->get("custom_cat");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			$query	= $this->db->where("cat_type", 'MYBOARD')->where("status", '1')->get("pmp_cat");
			return $query->result();
		}
	}
	public function getAllPMPEditCategories($hotel_id, $room_type){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("room_type", $room_type)->where("status", '1')->get("custom_cat");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function getCreatedChecklists($hotel_id){

		$query =  $this->db->query("SELECT DISTINCT (CONCAT(room_type)) AS type FROM checklist_templates WHERE hotel_id = ".$hotel_id." ");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function save_emp_checklist($post_data){

		$firm = $this->db->insert('checklist_emp_record', $post_data);

		$insert_id 	= $this->db->insert_id();

		$post_data['desc'] = 'Checked';

		$this->db->insert('checklist_emp_logs', $post_data);

		return $insert_id;

	}

	public function getQuarter(){

		$current_month 	= date('m');

		$current_year 	= date('Y');

		$quarter 		= '';

		if($current_month>=1 && $current_month<=3){$quarter = '1st';}

		else if($current_month>=4 && $current_month<=6){$quarter = '2nd';}

		else if($current_month>=7 && $current_month<=9){$quarter = '3rd';}

		else if($current_month>=10 && $current_month<=12){$quarter = '4th';}

		return $quarter;

	}

	public function del_emp_checklist($post_data){

		$query =  $this->db->where("hotel_id", $post_data['hotel_id'])->where("room_no", $post_data['room_no'])->where("room_type", $post_data['room_type'])->where("cat_id", $post_data['cat_id'])->where("item_id", $post_data['item_id'])->where("quarter", $post_data['quarter'])->get("checklist_emp_record");

		//echo '<pre>';print_r($this->db->last_query());

		if ($query->num_rows() > 0) {

			$this->db

			->where("hotel_id", $post_data['hotel_id'])

			->where("room_no", $post_data['room_no'])

			->where("room_type", $post_data['room_type'])

			->where("cat_id", $post_data['cat_id'])

			->where("item_id", $post_data['item_id'])

			->where("quarter", $post_data['quarter'])

			->delete("checklist_emp_record");

			

			$post_data['desc'] = 'Un-checked';

			$this->db->insert('checklist_emp_logs', $post_data);

			$insert_id 	= $this->db->insert_id();

			return $insert_id;

		} else{

			return 0;

		}

	}

	public function getAllPMPLogs($hotel_id, $room_no, $room_type){

		$quarter = $this->pmp_model->getQuarter();

		$query 	 =  $this->db->where("hotel_id", $hotel_id)->where("room_no", $room_no)->where("room_type", $room_type)->where("quarter", $quarter)->order_by("clter_id", "desc")->get("checklist_emp_logs");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function save_notes_reply($post_data){

		$this->db->insert('ticket_notes_replies', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function save_top_noti($post_data){

		$this->db->insert('notifications_tag', $post_data);

	}

	public function update_top_noti($post_data){

		$this->db->where("hotel_id", $post_data['hotel_id'])->where("user_id", $post_data['user_id'])->where("txt_type", $post_data['txt_type'])->update("notifications_tag", $post_data);

	}

	public function save_notes_reply_status($post_data){

		$this->db->insert('ticket_notes_replies_view', $post_data);

	}

	public function update_notes_reply_status($post_data){

		$this->db->where("hotel_id", $post_data['hotel_id'])->where("ticket_id", $post_data['ticket_id'])->where("user_id", $post_data['user_id'])->update("ticket_notes_replies_view", $post_data);

	}

	public function get_notes_reply_status($post_data){

		$query 	 =  $this->db->where("hotel_id", $post_data['hotel_id'])->where("ticket_id", $post_data['ticket_id'])->where("status", "seen")->get("ticket_notes_replies_view");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	

}



?>