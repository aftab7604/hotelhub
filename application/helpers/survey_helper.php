<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Survey_helper
{
    public function __construct(){
        parent::__construct();
    }
	
	public static function get_survey_counts_by_month($hotel_id, $month){
		$year 	= date('Y');
        $CI 	= &get_instance();
        $query	= $CI->db->query("SELECT COUNT(*) AS total_counts FROM survey_score WHERE hotel_id = '".$hotel_id."' and status = '1' and EXTRACT(MONTH FROM added_date) = '".$month."' and EXTRACT(YEAR FROM added_date) = '".$year."'");
        return $result = $query->result();
    }
	
	public static function get_survey_counts_by_month_and_question($hotel_id, $month, $question){
		$year 	= date('Y');
        $CI 	= &get_instance();
        $query	= $CI->db->query("SELECT SUM(".$question.") AS total_q_counts FROM survey_score WHERE hotel_id = '".$hotel_id."' and status = '1' and EXTRACT(MONTH FROM added_date) = '".$month."' and EXTRACT(YEAR FROM added_date) = '".$year."'");
        return $result = $query->result();
    }
}
