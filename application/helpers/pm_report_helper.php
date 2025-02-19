<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pm_report_helper
{
    public function __construct(){
        parent::__construct();
    }
	
	public static function get_checklist_records($hotel_id, $room_no, $quarter){
        $CI 	= &get_instance();
        $query	= $CI->db->query("SELECT * FROM checklist_emp_record WHERE hotel_id = '".$hotel_id."' and room_no = '".$room_no."' and quarter = '".$quarter."' order by clter_id desc limit 0, 1 ");
        return $result = $query->result();
    }
	public static function getCountOfRoomTypeChecklists($hotel_id, $room_type){
        $CI 	= &get_instance();
        $query	= $CI->db->query("SELECT count(*) AS total_checklists FROM custom_cat cc left join custom_subcat cs ON cs.cat_id = cc.c_id WHERE cc.hotel_id = ".$hotel_id." and cc.room_type = '".$room_type."'");
        return $result = $query->result();
    }
	public static function getCountOfCompletedChecklists($hotel_id, $room_no, $quarter){
        $CI 	= &get_instance();
        $query	= $CI->db->query("SELECT count(*) AS total_compt_checklists FROM checklist_emp_record WHERE hotel_id = '".$hotel_id."' and room_no = '".$room_no."' and quarter = '".$quarter."' ");
        return $result = $query->result();
    }
	public static function getCountOfFlaggedChecklists($hotel_id, $room_no, $quarter){
        $CI 	= &get_instance();
        $query	= $CI->db->query("SELECT count(*) AS total_flag_checklists FROM checklist_emp_record WHERE hotel_id = '".$hotel_id."' and room_no = '".$room_no."' and quarter = '".$quarter."' and flag = 'flag' ");
        return $result = $query->result();
    }
	public static function getRoomsCompleted($hotel_id, $room_no, $quarter){
        $CI 	= &get_instance();
        $query	= $CI->db->query("SELECT count(*) AS completedRooms FROM checklist_emp_record WHERE hotel_id = '".$hotel_id."' and room_no = '".$room_no."' and quarter = '".$quarter."'");
        return $result = $query->result();
    }
}