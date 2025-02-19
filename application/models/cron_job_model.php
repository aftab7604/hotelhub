<?php

class Cron_Job_Model extends CI_Model {	
	public function get_Rooms_Completed($hotel_id, $room_no, $quarter){
		$current_year 	= date('Y');
		//$query 			= $this->db->query("SELECT count(*) AS completedRooms FROM checklist_emp_record WHERE hotel_id = '".$hotel_id."' and room_no = '".$room_no."' and quarter = '".$quarter."' and EXTRACT(YEAR FROM created_date) = '".$current_year."'");
		
		$query 			= $this->db->query("SELECT created_date FROM checklist_emp_record WHERE hotel_id = '".$hotel_id."' and room_no = '".$room_no."' and quarter = '".$quarter."' and EXTRACT(YEAR FROM created_date) = '".$current_year."' ORDER BY created_date DESC");
		if ($query->num_rows() > 0){
			return $query->result();
		} else {
			return 0;
		}
	}
	public function save_Rooms_Completed($hotel_id, $room_no, $quarter, $current_year, $pecentage, $created_date){
		$query 			= $this->db->query("SELECT * FROM completed_rooms_per_quarter WHERE hotel_id = '".$hotel_id."' and room_no = '".$room_no."' and quarter = '".$quarter."' and year = '".$current_year."'");
		$results		= $query->result();
		/*echo '<pre>';
		print_r($results);
		echo $results[0]->clter_id;*/
		if($query->num_rows() > 0){
			$this->db->query("UPDATE completed_rooms_per_quarter SET hotel_id = '".$hotel_id."', room_no = '".$room_no."', quarter = '".$quarter."', year = '".$current_year."', pecentage = '".$pecentage."', created_date = '".$created_date."' WHERE clter_id = '".$results[0]->clter_id."' ");
		} else {
			$this->db->query("INSERT INTO completed_rooms_per_quarter (hotel_id, room_no, quarter, year, pecentage, created_date) VALUES ('".$hotel_id."', '".$room_no."', '".$quarter."', '".$current_year."', '".$pecentage."', '".$created_date."')");
		}
	}
	public function save_gmail_inbox($post_data){
		$this->db->insert('gss_inbox', $post_data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
}
?>