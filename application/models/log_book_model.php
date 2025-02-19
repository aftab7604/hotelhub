<?php

class Log_Book_Model extends CI_Model 
{
	public function save_logBook_entry($post_data){
		$firm = $this->db->insert('log_book', $post_data);
		$insert_id 	= $this->db->insert_id();
		return $insert_id;
	}
	public function save_logBook_replies($post_data){
		$firm = $this->db->insert('log_book_replies', $post_data);
		$insert_id 	= $this->db->insert_id();
		return $insert_id;
	}
	public function get_logBook_entry_for_dashboard($hotel_id, $limit){
		$query =  $this->db->where("hotel_id", $hotel_id)->order_by("lead_id", "DESC")->limit($limit)->get("log_book");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_logBook_entry($hotel_id){
		$query =  $this->db->where("hotel_id", $hotel_id)->order_by("lead_id", "DESC")->get("log_book");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function save_logBook_likes($lead_id){
		$this->db->set('likes', 'likes+1', FALSE);
		$this->db->where('lead_id', $lead_id);
		$this->db->update('log_book');
		return true;
	}
	public function save_logBook_child_likes($r_lead_id){
		$this->db->set('likes', 'likes+1', FALSE);
		$this->db->where('r_lead_id', $r_lead_id);
		$this->db->update('log_book_replies');
		return true;
	}
}
?>