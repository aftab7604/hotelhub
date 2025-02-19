<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_helper
{
    public function __construct(){
        parent::__construct();
    }
	public static function get_user_name($user_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM users WHERE id = '".$user_id."' ");
        return $result = $query->result();
    }
	public static function get_key_name($key_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM key_rings WHERE key_id = '".$key_id."' ");
        return $result = $query->result();
    }
	public static function get_settings($hotel_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM settings WHERE hotel_id = '".$hotel_id."' ");
        return $result = $query->result();
    }
	public static function get_vendor_name($v_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM vendor_info WHERE v_id = '".$v_id."' ");
        return $result = $query->result();
    }
	public static function get_role_name($role_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT name FROM roles WHERE id = '".$role_id."' ");
        return $result = $query->result();
    }
	public static function get_hotel_info($hotel_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM hotels WHERE hotel_id = '".$hotel_id."' ");
        return $result = $query->result();
    }
	public static function get_hotel_name($hotel_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT hotel_name FROM hotels WHERE hotel_id = '".$hotel_id."' ");
        return $result = $query->result();
    }
	public static function get_subcat_items($cat_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM pmp_subcat WHERE cat_id = '".$cat_id."' ");
        return $result = $query->result();
    }
	public static function get_subcat_active_items($cat_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM pmp_subcat WHERE status = '1' and cat_id = '".$cat_id."' ");
        return $result = $query->result();
    }
	public static function get_subcat_active_edit_items($cat_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM custom_subcat WHERE status = '1' and cat_id = '".$cat_id."' ");
        return $result = $query->result();
    }
	public static function get_custom_or_default_subcat_active($hotel_id, $cat_id){
        $CI = &get_instance();
		$query = $CI->db->query("SELECT * FROM custom_cat WHERE status = '1' and room_type = 'MYBOARD' and hotel_id = '".$hotel_id."' ");
		
		if ($query->num_rows() > 0) {
			$query = $CI->db->query("SELECT * FROM custom_subcat WHERE status = '1' and cat_id = '".$cat_id."' ");
			return $query->result();
		} else {
        	$query = $CI->db->query("SELECT * FROM pmp_subcat WHERE status = '1' and cat_id = '".$cat_id."' ");
			return $query->result();
		}
		
		//$result = $query->result();
		//echo '<pre>'; print_r($result);exit;
		
        //$query = $CI->db->query("SELECT * FROM custom_subcat WHERE status = '1' and cat_id = '".$cat_id."' ");
        //return $result = $query->result();
    }
	public static function get_category_name($cat_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT cat_name FROM custom_cat WHERE c_id = '".$cat_id."' ");
        return $result = $query->result();
    }
	public static function get_subcategory_name($item_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT subcat_name FROM custom_subcat WHERE s_id = '".$item_id."' ");
        return $result = $query->result();
    }
	public static function get_emp_checked_items($hotel_id,$room_no,$room_type,$cat_id,$item_id,$quarter){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM checklist_emp_record WHERE hotel_id = '".$hotel_id."' and room_no = '".$room_no."' and room_type = '".$room_type."' and cat_id = '".$cat_id."' and item_id = '".$item_id."' and quarter = '".$quarter."'");
        return $result = $query->result();
    }
	public static function last_edited_by_category($hotel_id,$room_no,$room_type,$cat_id,$quarter){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT created_date FROM checklist_emp_logs WHERE hotel_id = '".$hotel_id."' and room_no = '".$room_no."' and room_type = '".$room_type."' and cat_id = '".$cat_id."' and quarter = '".$quarter."' ORDER by clter_id desc LIMIT 1");
        return $result = $query->result();
    }
	public static function lastEditted_helper($db_modify_date){
		$db_modify_date = new DateTime($db_modify_date);	
		$time_passed	= $db_modify_date->diff(new DateTime(date("Y-m-d H:i:s", time() - 3600)));
		if($time_passed->y > 0){return $value = $time_passed->y.' year';}
		if($time_passed->m > 0){return $value = $time_passed->m.' month';}
		if($time_passed->d > 0){return $value = $time_passed->d.' day';}
		if($time_passed->h > 0){return $value = $time_passed->h.' hour';}
		if($time_passed->i > 0){return $value = $time_passed->i.' minute';}
		if($time_passed->s > 0){return $value = $time_passed->s.' second';}
	}
	public static function get_ticket_notes_replies($ticket_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM ticket_notes_replies WHERE ticket_id = '".$ticket_id."' ORDER by notes_reply_id asc");
        return $result = $query->result();
    }
	public static function get_room_serviceRec($hotel_id, $room_no){		
        $CI = &get_instance();
        $query = $CI->db->query("SELECT t.*, r.name AS dept_name FROM ticket t LEFT JOIN roles r ON t.assign_to_dept = r.id WHERE t.hotel_id = '".$hotel_id."' and t.room_no = '".$room_no."'");
        return $result = $query->result();
    }
	public static function get_log_replies($lead_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM log_book_replies WHERE lead_id = '".$lead_id."' and status = '1'");
        return $result = $query->result();
    }
	public static function get_hotel_timezone($hotel_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT timezone FROM hotels WHERE hotel_id = '".$hotel_id."' ");
        return $result = $query->result();
    }
	public static function get_count_todays_welcome_calls($hotel_id, $created_date){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT COUNT(*) AS total_todays FROM guests_welcome_call WHERE hotel_id = '".$hotel_id."' and DATE(created_date) = '".$created_date."'");
        return $result = $query->result();
    }
	public static function get_todays_welcome_calls($hotel_id, $created_date){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM guests_welcome_call WHERE hotel_id = '".$hotel_id."' and DATE(created_date) = '".$created_date."'");
        return $result = $query->result();
    }
	public static function getCountOfFutureReservations($hotel_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT COUNT(*) AS reservations_count FROM guest_future_reservations WHERE hotel_id = '".$hotel_id."' and status = '0'");
        return $result = $query->result();
    }
	public static function getCountOfGVPendingTickets($hotel_id){
        $CI = &get_instance();
		$query = $CI->db->query("SELECT COUNT(*) AS GVPndgTkts_count FROM gss_inbox WHERE hotel_id = '".$hotel_id."' and is_approved = '0' and is_ticket = '0'");
        return $result = $query->result();
    }
	public static function get_room_type($hotel_id, $room_no){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM rooms WHERE hotel_id = '".$hotel_id."' and room_no = '".$room_no."'");
        return $result = $query->result();
    }
	public static function get_assign_rooms_data($hotel_id, $user_id, $created_date){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT COUNT(assign_rooms) as total_rooms,
(SELECT count(chk_stay) FROM mpor WHERE hotel_id = '".$hotel_id."' AND assign_to_id = '".$user_id."' AND DATE(created_date) = '".$created_date."' and status = 'Completed') AS total_completed,

(SELECT count(chk_stay) FROM mpor WHERE hotel_id = '".$hotel_id."' AND assign_to_id = '".$user_id."' AND DATE(created_date) = '".$created_date."' and chk_stay = 'checkout') AS total_checkouts,
(SELECT count(chk_stay) FROM mpor WHERE hotel_id = '".$hotel_id."' AND assign_to_id = '".$user_id."' AND DATE(created_date) = '".$created_date."' and chk_stay = 'checkout' and status = 'Completed') AS total_checkouts_completed,
(SELECT count(chk_stay) FROM mpor WHERE hotel_id = '".$hotel_id."' AND assign_to_id = '".$user_id."' AND DATE(created_date) = '".$created_date."' and chk_stay = 'stayover' and status = 'Completed') AS total_stayovers_completed,
(SELECT count(chk_stay) FROM mpor WHERE hotel_id = '".$hotel_id."' AND assign_to_id = '".$user_id."' AND DATE(created_date) = '".$created_date."' and chk_stay = 'stayover') AS total_stayovers
FROM mpor WHERE hotel_id = '".$hotel_id."' AND assign_to_id = '".$user_id."' AND DATE(created_date) = '".$created_date."'");
        return $result = $query->result();
    }
	public static function get_assigned_rooms_by_id($hotel_id, $user_id, $created_date){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM mpor WHERE hotel_id = '".$hotel_id."' and assign_to_id = '".$user_id."' and is_active = '1' and DATE(created_date) = '".$created_date."' ORDER BY priority asc");
        return $result = $query->result();
    }
	public static function get_hk_emp_status($hotel_id, $user_id, $status, $created_date){
		$query = "SELECT * FROM mpor WHERE hotel_id = '".$hotel_id."' and assign_to_id = '".$user_id."' and status = '".$status."' and is_active = '1' and DATE(created_date) = '".$created_date."'";
		if($status == 'Completed'){
			$query .= " order by completed_at desc";
		}
		$query .= " LIMIT 1";
		
        $CI = &get_instance();
        $query = $CI->db->query($query);
        return $result = $query->result();
    }
	public static function get_latest_completed($hotel_id, $user_id, $status, $time, $created_date){
		$query = "SELECT * FROM mpor WHERE hotel_id = '".$hotel_id."' and assign_to_id = '".$user_id."' and status = '".$status."' and started_at < '".$time."' and is_active = '1' and DATE(created_date) = '".$created_date."'";
		if($status == 'Completed'){
			$query .= " order by completed_at desc";
		}
		$query .= " LIMIT 1";
		
        $CI = &get_instance();
        $query = $CI->db->query($query);
        return $result = $query->result();
    }
	public static function get_all_housekeepers($hotel_id, $user_id){
		$query = "SELECT * FROM users u WHERE u.firm_id = '".$hotel_id."' AND u.role = '4'";
		if($user_id !=''){
			$query .= " AND u.id = '".$user_id."'";
		}
        $CI = &get_instance();
        $query = $CI->db->query($query);
        return $result = $query->result();
    }
	public static function getCountOfRoomsStatistic($hotel_id, $user_id, $between, $astirik, $action){
		if($astirik == 'count'){$star = 'COUNT(*) AS total_rows';}else{$star = '*';}
		
		$query = "SELECT ".$star." FROM mpor WHERE hotel_id = '".$hotel_id."' AND assign_to_id = '".$user_id."' AND created_date ". $between;
		if($action == 'assigned'){
			$query .= "";
		}
		if($action == 'checkout'){
			$query .= " AND chk_stay = 'checkout'";
		}
		if($action == 'stayover'){
			$query .= " AND chk_stay = 'stayover'";
		}
		if($action == 'tickets'){
			$query .= " AND is_ticket != ''";
		}
		if($action == 'reinspect'){
			$query .= " AND approved = 'Re-Inspect'";
		}
		if($action == 'is_dnd'){
			$query .= " AND is_dnd = '1'";
		}
		if($action == 'approved'){
			$query .= " AND approved = 'Approved'";
		}
		if($action == 'completed'){
			$query .= " AND status = 'Completed' order by started_at asc";
		}
		if($action == 'checkout_co'){
			$query .= " AND status = 'Completed' AND chk_stay = 'checkout'";
		}
		if($action == 'stayover_co'){
			$query .= " AND status = 'Completed' AND chk_stay = 'stayover'";
		}
		//echo $query.'<br>'; //exit;
        $CI = &get_instance();
        $query = $CI->db->query($query);
        return $result = $query->result();
    }
	public static function getCountOfAnalytics($hotel_id, $user_id, $between, $astirik, $action){
		if($astirik == 'count'){$star = 'COUNT(*) AS total_rows';}else{$star = '*';}
		$query = "SELECT ".$star." FROM mpor WHERE hotel_id = '".$hotel_id."' AND created_date ". $between;
		
		if($user_id != ''){
			$query .= " AND assign_to_id = '".$user_id."'";
		}
		if($action == 'completed'){
			//$query .= " AND status = 'Completed' order by started_at asc";
			$query .= " order by started_at asc";
		}
		//echo $query.'<br>'; exit;
        $CI = &get_instance();
        $query = $CI->db->query($query);
        return $result = $query->result();
    }
	public static function getMPORSettingsINFO($hotel_id, $between){
		$CI = &get_instance();
		$query = $CI->db->query("SELECT * FROM mpor_settings WHERE hotel_id = ".$hotel_id." AND DATE(created_date) ".$between."");
        return $result = $query->result();
	}
	public static function getMPORINFO($hotel_id, $filterBy, $between){
		$CI = &get_instance();
		$query = $CI->db->query("SELECT * FROM mpor WHERE hotel_id = ".$hotel_id." ".$filterBy." AND DATE(created_date) ".$between."");
        return $result = $query->result();
	}
	public static function getMPORINFOByRoomType($hotel_id, $filterBy, $between){
		$CI = &get_instance();
		$query = $CI->db->query("SELECT * FROM mpor m LEFT JOIN rooms r ON r.room_no = m.assign_rooms WHERE m.hotel_id = ".$hotel_id." AND r.hotel_id = ".$hotel_id." AND r.room_type = '".$filterBy."' AND DATE(m.created_date) ".$between."");
        return $result = $query->result();
	}
	public static function get_hotel_Users($hotel_id, $user_id){
		$query = "SELECT U.*, R.name AS Role_name FROM users U LEFT JOIN roles R ON U.role = R.id WHERE U.firm_id = '".$hotel_id."'";
		if($user_id !=''){
			$query .= " AND U.id = '".$user_id."'";
		}
        $CI = &get_instance();
        $query = $CI->db->query($query);
        return $result = $query->result();
    }
	public static function get_roles($role_id){
		$query = "SELECT * FROM roles WHERE";
		if($role_id == ''){
			$query .= " id != 1 AND id !=8";
		}else{
			$query .= " id = '".$role_id."'";
		}
        $CI = &get_instance();
        $query = $CI->db->query($query);
        return $result = $query->result();
    }
	public static function get_user_ticket_notifications($user_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM notifications_tickets WHERE user_id = '".$user_id."' ");
        return $result = $query->result();
    }
	public static function getCalculateProductivityRanking($hotel_id, $user_id, $role, $ticket_type, $ticket_status, $between){
		$query = "SELECT COUNT(*) AS total FROM ticket WHERE hotel_id = '".$hotel_id."' AND DATE(created_date) ". $between;
		
		if($user_id != ''){
			$query .= " AND generated_by = '".$user_id."'";
		}
		if($role != ''){
			$query .= " AND assign_to_dept = '".$role."'";
		}
		if($ticket_type != ''){
			$query .= " AND ticket_type = '".$ticket_type."'";
		}
		if($ticket_status != ''){
			$query .= " AND ticket_status = '".$ticket_status."'";
		}
		//echo $query.'<br>'; exit;
        $CI = &get_instance();
        $query = $CI->db->query($query);
        return $result = $query->result();
    }
	public static function getScrollsByTypes($hotel_id, $slide_type, $period, $CURRENT_DATE, $limit){
		if($slide_type == 'top_PM' or $slide_type == 'top_Cleaned' or $slide_type == 'top_sales_tickets' or $slide_type == 'top_guest_recovery' or $slide_type == 'tickets_completed'){
			if($slide_type == 'top_PM')				{$condition = 'AND ticket_type		= 1';}
			if($slide_type == 'top_Cleaned')		{$condition = 'AND ticket_status 	= 3';}
			if($slide_type == 'tickets_completed')	{$condition = 'AND ticket_status 	= 3';}
			if($slide_type == 'top_sales_tickets')	{$condition = 'AND assign_to_dept 	= 6';}
			if($slide_type == 'top_guest_recovery')	{$condition = 'AND service_rec 		= "yes"';}
			
			$column_name = 'created_date';
				if($period == 'Daily')		{$timePeriod = "AND DATE(".$column_name.") = CURDATE()";}
			elseif($period == 'Weekly')		{$timePeriod = "AND yearweek(DATE(".$column_name."), 1) = yearweek(curdate(), 1)";}
			elseif($period == 'Monthly')	{$timePeriod = "AND MONTH(".$column_name.") = MONTH(CURRENT_DATE()) AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			elseif($period == 'Quarterly')	{$timePeriod = "AND quarter(".$column_name.") = quarter(curdate())";}
			elseif($period == 'Yearly')		{$timePeriod = "AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			$query  = "SELECT * FROM ticket WHERE hotel_id = '".$hotel_id."' ".$condition." ".$timePeriod."";
			$query .= " ORDER BY ticket_id DESC";
			$query .= " LIMIT ".$limit."";
		}
		if($slide_type == 'percentage_of_pickup_tickets' or $slide_type == 'percentage_of_pending_tickets' or $slide_type == 'percentage_of_close_tickets'){
			if($slide_type == 'percentage_of_pending_tickets')	{$condition = 'AND ticket_status	= 1';}
			if($slide_type == 'percentage_of_pickup_tickets')	{$condition = 'AND ticket_status	= 2';}
			if($slide_type == 'percentage_of_close_tickets')	{$condition = 'AND ticket_status	= 3';}
			
			$column_name = 'created_date';
				if($period == 'Daily')		{$timePeriod = "AND DATE(".$column_name.") = CURDATE()";}
			elseif($period == 'Weekly')		{$timePeriod = "AND yearweek(DATE(".$column_name."), 1) = yearweek(curdate(), 1)";}
			elseif($period == 'Monthly')	{$timePeriod = "AND MONTH(".$column_name.") = MONTH(CURRENT_DATE()) AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			elseif($period == 'Quarterly')	{$timePeriod = "AND quarter(".$column_name.") = quarter(curdate())";}
			elseif($period == 'Yearly')		{$timePeriod = "AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			$query  = "SELECT count(*) AS TotalTypeTickets, (SELECT count(*) FROM ticket WHERE hotel_id = '".$hotel_id."' ".$timePeriod.") AS TotalTickets FROM ticket WHERE hotel_id = '".$hotel_id."' ".$condition." ".$timePeriod."";
		}
		if($slide_type == 'users_tickets_created' or $slide_type == 'users_tickets_closed'){
			if($slide_type == 'users_tickets_created')	{$condition = 'group by generated_by';}
			if($slide_type == 'users_tickets_closed')	{$condition = 'AND ticket_status 	= 3';}

			$column_name = 'created_date';
				if($period == 'Daily')		{$timePeriod = "AND DATE(".$column_name.") = CURDATE()";}
			elseif($period == 'Weekly')		{$timePeriod = "AND yearweek(DATE(".$column_name."), 1) = yearweek(curdate(), 1)";}
			elseif($period == 'Monthly')	{$timePeriod = "AND MONTH(".$column_name.") = MONTH(CURRENT_DATE()) AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			elseif($period == 'Quarterly')	{$timePeriod = "AND quarter(".$column_name.") = quarter(curdate())";}
			elseif($period == 'Yearly')		{$timePeriod = "AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			$query  = "SELECT generated_by, COUNT(generated_by) AS total_Tickets FROM ticket WHERE hotel_id = '".$hotel_id."' ".$timePeriod." ".$condition."";
			$query .= " ORDER BY total_Tickets DESC";
			$query .= " LIMIT ".$limit."";
		}
		if($slide_type == 'avg_tickets_completed_time' or $slide_type == 'avg_guest_recovery_completing_time'){
			if($slide_type == 'avg_tickets_completed_time')			{$condition = 'AND ticket_status	= 3';}
			if($slide_type == 'avg_guest_recovery_completing_time')	{$condition = "AND ticket_status	= 3 AND service_rec	= 'yes'";}
			
			$column_name = 'created_date';
				if($period == 'Daily')		{$timePeriod = "AND DATE(".$column_name.") = CURDATE()";}
			elseif($period == 'Weekly')		{$timePeriod = "AND yearweek(DATE(".$column_name."), 1) = yearweek(curdate(), 1)";}
			elseif($period == 'Monthly')	{$timePeriod = "AND MONTH(".$column_name.") = MONTH(CURRENT_DATE()) AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			elseif($period == 'Quarterly')	{$timePeriod = "AND quarter(".$column_name.") = quarter(curdate())";}
			elseif($period == 'Yearly')		{$timePeriod = "AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			$query  = "SELECT * FROM ticket WHERE hotel_id = '".$hotel_id."' ".$condition." ".$timePeriod."";
		}
		if($slide_type == 'top_MPOR'){			
			$column_name = 'created_date';
				if($period == 'Daily')		{$timePeriod = "AND DATE(".$column_name.") = CURDATE()";}
			elseif($period == 'Weekly')		{$timePeriod = "AND yearweek(DATE(".$column_name."), 1) = yearweek(curdate(), 1)";}
			elseif($period == 'Monthly')	{$timePeriod = "AND MONTH(".$column_name.") = MONTH(CURRENT_DATE()) AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			elseif($period == 'Quarterly')	{$timePeriod = "AND quarter(".$column_name.") = quarter(curdate())";}
			elseif($period == 'Yearly')		{$timePeriod = "AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			$query  = "SELECT * FROM mpor WHERE hotel_id = '".$hotel_id."' AND status = 'Completed' ".$timePeriod."";
		}
		if($slide_type == 'upcoming_events'){
			$column_name = 'event_start';
			
				if($period == 'Daily')		{$timePeriod = "AND DATE(".$column_name.") = '".$CURRENT_DATE."'";}
			elseif($period == 'Weekly')		{$timePeriod = "AND yearweek(DATE(".$column_name."), 1) = yearweek('".$CURRENT_DATE."', 1)";}
			elseif($period == 'Monthly')	{$timePeriod = "AND MONTH(".$column_name.") = MONTH(CURRENT_DATE()) AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			elseif($period == 'Quarterly')	{$timePeriod = "AND quarter(".$column_name.") = quarter(curdate())";}
			elseif($period == 'Yearly')		{$timePeriod = "AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			$query  = "SELECT * FROM events WHERE hotel_id = '".$hotel_id."' AND status = '1' ".$timePeriod."";
			$query .= " ORDER BY event_id DESC";
			$query .= " LIMIT ".$limit."";
		}
		if($slide_type == 'PM_completed/Flagged_Pie_Chart'){
			$column_name = 'created_date';
			
				if($period == 'Daily')		{$timePeriod = "AND DATE(".$column_name.") = '".$CURRENT_DATE."'";}
			elseif($period == 'Weekly')		{$timePeriod = "AND yearweek(DATE(".$column_name."), 1) = yearweek('".$CURRENT_DATE."', 1)";}
			elseif($period == 'Monthly')	{$timePeriod = "AND MONTH(".$column_name.") = MONTH(CURRENT_DATE()) AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			elseif($period == 'Quarterly')	{$timePeriod = "AND quarter(".$column_name.") = quarter(curdate())";}
			elseif($period == 'Yearly')		{$timePeriod = "AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			$query  = "SELECT SUM(CASE WHEN flag = 'complete' THEN 1 ELSE 0 END) AS total_completed,";
			$query .= " SUM(CASE WHEN flag = 'flag' THEN 1 ELSE 0 END) AS total_flagged";
			$query .= " FROM checklist_emp_record WHERE hotel_id = '".$hotel_id."' ".$timePeriod."";
		}
		if($slide_type == 'Pending/Picked_Up_And_Completed_Tickets_Pie_Chart'){
			$column_name = 'created_date';
			
				if($period == 'Daily')		{$timePeriod = "AND DATE(".$column_name.") = '".$CURRENT_DATE."'";}
			elseif($period == 'Weekly')		{$timePeriod = "AND yearweek(DATE(".$column_name."), 1) = yearweek('".$CURRENT_DATE."', 1)";}
			elseif($period == 'Monthly')	{$timePeriod = "AND MONTH(".$column_name.") = MONTH(CURRENT_DATE()) AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			elseif($period == 'Quarterly')	{$timePeriod = "AND quarter(".$column_name.") = quarter(curdate())";}
			elseif($period == 'Yearly')		{$timePeriod = "AND YEAR(".$column_name.") = YEAR(CURRENT_DATE())";}
			$query  = "SELECT SUM(CASE WHEN ticket_status = '1' THEN 1 ELSE 0 END) AS total_pending,";
			$query .= " SUM(CASE WHEN ticket_status = '2' THEN 1 ELSE 0 END) AS total_picked,";
			$query .= " SUM(CASE WHEN ticket_status = '3' THEN 1 ELSE 0 END) AS total_closed";
			$query .= " FROM ticket WHERE hotel_id = '".$hotel_id."' ".$timePeriod."";
		}
		//echo $query.'<br>';//exit;
        $CI = &get_instance();
        $query = $CI->db->query($query);
        return $result = $query->result();
    }
	public static function get_key_status($keylog_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM key_logs WHERE keylog_id = '".$keylog_id."' ");
        return $result = $query->result();
    }
	public static function get_multiple_hotels($hotel_ids){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM hotels WHERE hotel_id IN (".$hotel_ids.") ");
        return $result = $query->result();
    }
	public static function group_info($group_id){
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM messages_group_info WHERE group_id = '".$group_id."' ");
        return $result = $query->result();
    }
	public static function get_count_unseen_messages($type, $hotel_id, $r_id, $user_id){
        $CI		= &get_instance();
		if($type == 'single'){
			$query	= $CI->db->query("SELECT COUNT(*) AS unseen FROM messages WHERE hotel_id = '".$hotel_id."' AND r_id = '".$r_id."' AND sender_id = '".$user_id."' AND seen = '0'");
		}else{
			$query	= $CI->db->query("SELECT COUNT(*) AS unseen FROM messages_seen WHERE r_id = '".$r_id."' AND u_id = '".$user_id."' AND seen = '0'");
		}
        return $result = $query->result();
    }
	public static function group_mpor_checklist_info($hotel_id, $mpor_id, $cat_id){
        $CI		= &get_instance();
        $query	= $CI->db->query("SELECT * FROM mpor_checklist_data WHERE hotel_id = '".$hotel_id."' AND mpor_id = '".$mpor_id."' AND cat_id = '".$cat_id."'");
        return $result = $query->result();
    }
}
