<?php

class Login_Model extends CI_Model 

{

	public function getlogin($email, $pass){

		/*$data = array('pass' =>sha1(md5('123456')));

		$this->db->where("email", $email)->update("users", $data);*/

		

		$query =  $this->db->where("status", '1')->where("email", $email)->where("pass", sha1(md5($pass)))->get("users");		

		if ($query->num_rows() == 1) {

			return true;

		} else {

			return false;

		}

	}

	public function getregister($name, $email, $pass){

		$query =  $this->db->query("INSERT INTO users (username, email, pass, role, status) VALUES ('".$name."','".$email."','".sha1(md5($pass))."','1','1')");

		if ($query) {

			return true;

		} else {

			return false;

		}

	}

	public function read_user_information($email){

		$condition = "email =" . "'" . $email . "'";

		$this->db->select('*');

		$this->db->from('users');

		$this->db->where($condition);

		$this->db->limit(1);

		$query = $this->db->get();

		

		if ($query->num_rows() == 1) {

		return $query->result();

		} else {

		return false;

		}

	}

	public function getSingleUserInfo($role_id, $hotel_id){

		$query =  $this->db->where("role", $role_id)->where("firm_id", $hotel_id)->get("users");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	

	/*Rooms CRUD*/

	public function saveRooms($data){

		$numb 		= $data['room_no'];

		$totalrooms = count($numb);

		$hotel_id 	= $this->session->userdata['logged_in']['firm_id'];		

		for ($i=0; $i < $totalrooms; $i++){

			$queryCheckRoom	=  $this->db->where("id", $data['room_id'][$i])->get("rooms");

			if ($queryCheckRoom->num_rows() > 0){//update

				$this->db->query("UPDATE rooms SET floor_num = '".$data['floor_num'][$i]."', room_no = '".$data['room_no'][$i]."', room_type = '".$data['room_type'][$i]."' WHERE id = '".$data['room_id'][$i]."'");

			}else{//insert

				$this->db->query("INSERT INTO rooms (hotel_id, floor_num, room_no, room_type) VALUES (".$hotel_id.", '".$data['floor_num'][$i]."', '".$data['room_no'][$i]."', '".$data['room_type'][$i]."')");

			}

		}

		return true;

	}

	public function save_hotel_area($post_date){

		$this->db->insert("areas_type", $post_date);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function getHotelRooms($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->get("rooms");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function get_hotel_area($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->get("areas_type");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function delete_hotel_area($id){

		$this->db->where("area_id", $id)->delete("areas_type");

	}

	public function get_areas_list(){

		$query =  $this->db->where("status", 1)->get("areas_list");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function get_room_type($data){

		$query =  $this->db->where("hotel_id", $data['hotel_id'])->where("room_no", $data['room_no'])->get("rooms");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	

	/*Ticket CRUD*/

	public function add_main_ticket($table, $post_date){

		$this->db->insert($table, $post_date);

		//echo $sql = $this->db->last_query();exit;

		$insert_id = $this->db->insert_id();

		//return ($this->db->affected_rows() != 1) ? false : true;

		return $insert_id;

	}

	public function update_ticket($data){

		$ticket_id = $data["ticket_id"];

		unset($data["ticket_id"]);

		$this->db->where("id", $ticket_id)->update("tickets", $data);

		return true;

		

	}

	/*public function getTop3Tickets(){

		$Query_Main =	"SELECT T.ticket_id AS ticketID, T.ticket_type AS ticketTypeID, T.*,

						PM.*, PMP.*, GV.*, GWC.*, QK.*, SP.*, TY.type_name, R.name AS dept_name

						FROM ticket T 

							LEFT JOIN ticket_type_pm PM		ON T.ticket_id = PM.ticket_id 

							LEFT JOIN ticket_type_pmp PMP	ON T.ticket_id = PMP.ticket_id 

							LEFT JOIN ticket_type_gv GV		ON T.ticket_id = GV.ticket_id 

							LEFT JOIN ticket_type_gwc GWC	ON T.ticket_id = GWC.ticket_id 

							LEFT JOIN ticket_type_quick QK	ON T.ticket_id = QK.ticket_id 

							LEFT JOIN ticket_type_sp SP		ON T.ticket_id = SP.ticket_id 

							LEFT JOIN ticket_types TY		ON T.ticket_type = TY.t_id  

							LEFT JOIN roles R				ON T.assign_to_dept = R.id

						WHERE T.hotel_id = '".$this->session->userdata['logged_in']['firm_id']."' AND T.ticket_status = '1' ORDER BY T.ticket_id DESC LIMIT 3";

		$query =  $this->db->query($Query_Main);

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}*/

	public function getPendingTicketsForRooms(){

		$query =  $this->db->query("SELECT CONCAT(room_no) AS pendingtickets FROM ticket WHERE ticket_status = 1 and hotel_id = '".$this->session->userdata['logged_in']['firm_id']."'");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	public function getPickupTicketsForRooms(){

		$query =  $this->db->query("SELECT CONCAT(room_no) AS pickuptickets FROM ticket WHERE ticket_status = 2 and hotel_id = '".$this->session->userdata['logged_in']['firm_id']."'");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	public function getCountOfTotalTickets(){

		$query =  $this->db->where("hotel_id", $this->session->userdata['logged_in']['firm_id'])->get("ticket");

		return $query->num_rows();

	}

	public function getCountOfPendingTickets(){

		$query =  $this->db->where("ticket_status", '1')->where("hotel_id", $this->session->userdata['logged_in']['firm_id'])->get("ticket");

		return $query->num_rows();

	}

	public function getCountOfPickedTickets(){

		$query =  $this->db->where("ticket_status", '2')->where("hotel_id", $this->session->userdata['logged_in']['firm_id'])->get("ticket");

		return $query->num_rows();	}

	public function getCountOfClosedTickets(){

		$query =  $this->db->where("ticket_status", '3')->where("hotel_id", $this->session->userdata['logged_in']['firm_id'])->get("ticket");

		return $query->num_rows();

	}

	

	public function getOLDPendingTickets(){

		$query =  $this->db->where("ticket_status", '1')->where("hotel_id", $this->session->userdata['logged_in']['firm_id'])->order_by("ticket_id", "ASC")->limit(1)->get("ticket");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	public function getOLDPickedTickets(){

		$query =  $this->db->where("ticket_status", '2')->where("hotel_id", $this->session->userdata['logged_in']['firm_id'])->order_by("ticket_id", "ASC")->limit(1)->get("ticket");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	

	public function getPendingTickets(){

		$Query_Main =	"SELECT T.ticket_id AS ticketID, T.ticket_type AS ticketTypeID, T.*,

						PM.*, PMP.*, GV.*, GWC.*, QK.*, SP.*, TY.type_name, R.name AS dept_name

						FROM ticket T 

							LEFT JOIN ticket_type_pm PM		ON T.ticket_id = PM.ticket_id 

							LEFT JOIN ticket_type_pmp PMP	ON T.ticket_id = PMP.ticket_id 

							LEFT JOIN ticket_type_gv GV		ON T.ticket_id = GV.ticket_id 

							LEFT JOIN ticket_type_gwc GWC	ON T.ticket_id = GWC.ticket_id 

							LEFT JOIN ticket_type_quick QK	ON T.ticket_id = QK.ticket_id 

							LEFT JOIN ticket_type_sp SP		ON T.ticket_id = SP.ticket_id 

							LEFT JOIN ticket_types TY		ON T.ticket_type = TY.t_id  

							LEFT JOIN roles R				ON T.assign_to_dept = R.id

						WHERE T.hotel_id = '".$this->session->userdata['logged_in']['firm_id']."' AND T.ticket_status = '1'";

		$query =  $this->db->query($Query_Main);

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	public function getPickedTickets(){

		$Query_Main =	"SELECT T.ticket_id AS ticketID, T.ticket_type AS ticketTypeID, T.*,

						PM.*, PMP.*, GV.*, GWC.*, QK.*, SP.*, TY.type_name, R.name AS dept_name

						FROM ticket T 

							LEFT JOIN ticket_type_pm PM		ON T.ticket_id = PM.ticket_id 

							LEFT JOIN ticket_type_pmp PMP	ON T.ticket_id = PMP.ticket_id 

							LEFT JOIN ticket_type_gv GV		ON T.ticket_id = GV.ticket_id 

							LEFT JOIN ticket_type_gwc GWC	ON T.ticket_id = GWC.ticket_id 

							LEFT JOIN ticket_type_quick QK	ON T.ticket_id = QK.ticket_id 

							LEFT JOIN ticket_type_sp SP		ON T.ticket_id = SP.ticket_id 

							LEFT JOIN ticket_types TY		ON T.ticket_type = TY.t_id  

							LEFT JOIN roles R				ON T.assign_to_dept = R.id

						WHERE T.hotel_id = '".$this->session->userdata['logged_in']['firm_id']."' AND T.ticket_status = '2'";

		$query =  $this->db->query($Query_Main);

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	public function getClosedTickets(){

		$Query_Main =	"SELECT T.ticket_id AS ticketID, T.ticket_type AS ticketTypeID, T.*,

						PM.*, PMP.*, GV.*, GWC.*, QK.*, SP.*, TY.type_name, R.name AS dept_name

						FROM ticket T 

							LEFT JOIN ticket_type_pm PM		ON T.ticket_id = PM.ticket_id 

							LEFT JOIN ticket_type_pmp PMP	ON T.ticket_id = PMP.ticket_id 

							LEFT JOIN ticket_type_gv GV		ON T.ticket_id = GV.ticket_id 

							LEFT JOIN ticket_type_gwc GWC	ON T.ticket_id = GWC.ticket_id 

							LEFT JOIN ticket_type_quick QK	ON T.ticket_id = QK.ticket_id 

							LEFT JOIN ticket_type_sp SP		ON T.ticket_id = SP.ticket_id 

							LEFT JOIN ticket_types TY		ON T.ticket_type = TY.t_id  

							LEFT JOIN roles R				ON T.assign_to_dept = R.id

						WHERE T.hotel_id = '".$this->session->userdata['logged_in']['firm_id']."' AND T.ticket_status = '3'";

		$query =  $this->db->query($Query_Main);

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	public function get_ticket_types(){

		$query =  $this->db->where("status", 1)->get("ticket_types");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	public function get_Searched_Tickets($ticket_type, $between){

		$Query_Main =	"SELECT T.ticket_id AS ticketID, T.ticket_type AS ticketTypeID, T.*,

						PM.*, PMP.*, GV.*, GWC.*, QK.*, SP.*, TY.type_name, R.name AS dept_name

						FROM ticket T 

							LEFT JOIN ticket_type_pm PM		ON T.ticket_id = PM.ticket_id 

							LEFT JOIN ticket_type_pmp PMP	ON T.ticket_id = PMP.ticket_id 

							LEFT JOIN ticket_type_gv GV		ON T.ticket_id = GV.ticket_id 

							LEFT JOIN ticket_type_gwc GWC	ON T.ticket_id = GWC.ticket_id 

							LEFT JOIN ticket_type_quick QK	ON T.ticket_id = QK.ticket_id 

							LEFT JOIN ticket_type_sp SP		ON T.ticket_id = SP.ticket_id 

							LEFT JOIN ticket_types TY		ON T.ticket_type = TY.t_id  

							LEFT JOIN roles R				ON T.assign_to_dept = R.id

						WHERE T.hotel_id = '".$this->session->userdata['logged_in']['firm_id']."'";

		if($ticket_type != ''){

			$Query_Main .=	" AND T.ticket_type = '".$ticket_type."'";

		}

		if($between != ''){

			$Query_Main .=	" AND DATE(T.created_date) ".$between."";

		}

		echo $Query_Main; exit();

		$query =  $this->db->query($Query_Main);

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	public function getSingleTicket($ticket_id){

		$Query_Main =	"SELECT T.ticket_id AS ticketID, T.ticket_type AS ticketTypeID, T.*,

						PM.*, PMP.*, GV.*, GWC.*, QK.*, SP.*, TY.type_name, R.name AS dept_name

						FROM ticket T 

							LEFT JOIN ticket_type_pm PM		ON T.ticket_id = PM.ticket_id 

							LEFT JOIN ticket_type_pmp PMP	ON T.ticket_id = PMP.ticket_id 

							LEFT JOIN ticket_type_gv GV		ON T.ticket_id = GV.ticket_id 

							LEFT JOIN ticket_type_gwc GWC	ON T.ticket_id = GWC.ticket_id 

							LEFT JOIN ticket_type_quick QK	ON T.ticket_id = QK.ticket_id 

							LEFT JOIN ticket_type_sp SP		ON T.ticket_id = SP.ticket_id 

							LEFT JOIN ticket_types TY		ON T.ticket_type = TY.t_id  

							LEFT JOIN roles R				ON T.assign_to_dept = R.id

						WHERE T.hotel_id = '".$this->session->userdata['logged_in']['firm_id']."' AND T.ticket_id = '".$ticket_id."'";

		$query =  $this->db->query($Query_Main);

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	public function getVerifyAndAssignTicket($data, $ticket_id){

		$query =  $this->db->where("ticket_id", $ticket_id)->where("ticket_status", '1')->where("hotel_id", $this->session->userdata['logged_in']['firm_id'])->get("ticket");

		if ($query->num_rows() > 0){			

			$this->db->where("ticket_id", $ticket_id)->update("ticket", $data);

			return true;

		} else {

			return false;

		}

	}

	public function closeTicket($ticket_id, $post_data){

		$this->db->where("ticket_id", $ticket_id)->update("ticket", $post_data);

		return true;

	}

	

	/*Hotel CRUD */

	public function saveHotel($post_data){

		$firm = $this->db->insert('hotels', $post_data);

		$insert_id 	= $this->db->insert_id();

		

		$hotel_id = array('hotel_id'	=> $insert_id);

		/*survey_info*/

		$this->db->insert('survey_info', $hotel_id);

		/*mass_survey_info*/

		$this->db->insert('mass_survey_info', $hotel_id);

		/*settings*/

		$this->db->insert('settings', $hotel_id);

		

		return $insert_id;

	}

	public function getActiveHotels(){

		$query =  $this->db->where("status", '1')->get("hotels");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function getHotels(){

		$query =  $this->db->get("hotels");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function getSingleHotel($id){

		$query =  $this->db->where("hotel_id", $id)->get("hotels");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	public function updateHotel($id, $data){

		$this->db->where("hotel_id", $id)->update("hotels", $data);

		return true;

	}

	public function delete_hotel($id){

		$this->db->where("hotel_id", $id)->delete("hotels");

	}

	

	/*Customer CRUD && Users CRUD*/

	public function saveUsers($post_data){

		$firm = $this->db->insert('users', $post_data);

		$insert_id 	= $this->db->insert_id();

		return $insert_id;

	}	

    public function all_hotel_users_for_mentions($search_query){

		$sql = "SELECT id, username as name, logo as avatar FROM users WHERE username LIKE '%".$search_query."%' AND firm_id = ".$this->session->userdata['logged_in']['firm_id']."";

		return $this->db->query($sql)->result();

    }



	public function getPtasks(){

			$sql = "SELECT clter_id as id, room_no as title, pecentage as p_id, quarter as status, date(created_date) as date, color as className FROM completed_rooms_per_quarter WHERE hotel_id = ".$this->session->userdata['logged_in']['firm_id']." ORDER BY clter_id DESC";

		return $this->db->query($sql)->result();

    }

	public function getCustomers(){

		$query =  $this->db->where("role", '3')->get("users");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function getSingleCustomers($id){

		$query =  $this->db->where("id", $id)->where("role", '3')->get("users");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}	

	public function updateCustomers($id, $data){

		$this->db->where("id", $id)->update("users", $data);

		return true;

	}

	public function delete_customer($id){

		$this->db->where("id", $id)->delete("users");

	}

	public function get_online_users($hotel_id){

		$query =  $this->db->where("firm_id", $hotel_id)->where("is_online", '1')->get("users");

		if ($query->num_rows() > 0) {

			return $query->num_rows();

		} else {

			return 0;

		}

    }

	public function get_total_log_book($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->get("log_book");

		if ($query->num_rows() > 0) {

			return $query->num_rows();

		} else {

			return 0;

		}

    }

	

	/*Users CRUD*/

	public function getRoles(){

		$query =  $this->db->where("status", '1')->get("roles");

		if ($query->num_rows() > 0) {

			$results = $query->result();

			foreach($results as $id=>$role)

			{

				if($id == 0)

				{

					$arrary[0] = $role;

				}

				if($id == 7)

				{

					$arrary[1] = $role;

				}

				if($id == 1)

				{

					$arrary[2] = $role;

				}

				if($id == 2)

				{

					$arrary[3] = $role;

				}

				if($id==3)

				{

					$arrary[4]=$role;

				}

				if($id==4)

				{

					$arrary[5]=$role;

				}

				if($id==5)

				{

					$arrary[6]=$role;

				}

				if($id==6)

				{

					$arrary[7]=$role;

				}

			}

			ksort($arrary);

			return $arrary;

		} else {

			return 0;

		}

	}

	public function get_Admin_Roles(){

		$query =  $this->db->where("status", '1')->where("id !=", '1')->where("id !=", '8')->get("roles");

		if ($query->num_rows() > 0) {

			$results = $query->result();

			foreach($results as $id=>$role)

			{

				if($id == 0)

				{

					$arrary[1] = $role;

				}

				if($id==1)

				{

					$arrary[2]=$role;

				}

				if($id==2)

				{

					$arrary[3]=$role;

				}

				if($id==3)

				{

					$arrary[4]=$role;

				}

				if($id==4)

				{

					$arrary[5]=$role;

				}

				if($id==5)

				{

					$arrary[6]=$role;

				}

				if($id==6)

				{

					$arrary[0] = $role;

				}

			}

			ksort($arrary);

			return $arrary;

		} else {

			return 0;

		}

	}

	public function getManagerRoles(){

		$query =  $this->db->where("status", '1')->where("id !=", '1')->get("roles");

		if ($query->num_rows() > 0) {

			$results = $query->result();

			foreach($results as $id=>$role)

			{

				if($id == 0)

				{

					$arrary[1] = $role;

				}

				if($id==1)

				{

					$arrary[2]=$role;

				}

				if($id==2)

				{

					$arrary[3]=$role;

				}

				if($id==3)

				{

					$arrary[4]=$role;

				}

				if($id==4)

				{

					$arrary[5]=$role;

				}

				if($id==5)

				{

					$arrary[6]=$role;

				}

				if($id==6)

				{

					$arrary[0] = $role;

				}

			}

			ksort($arrary);

			return $arrary;

		} else {

			return 0;

		}

	}

	public function get_agenda_chk_Roles(){

		$query =  $this->db->where("status", '1')->where("id !=", '1')->get("roles");

		if ($query->num_rows() > 0) {

			$results = $query->result();

			foreach($results as $id=>$role)

			{

				if($id == 0)

				{

					$arrary[1] = $role;

				}

				if($id==1)

				{

					$arrary[2]=$role;

				}

				if($id==2)

				{

					$arrary[3]=$role;

				}

				if($id==3)

				{

					$arrary[4]=$role;

				}

				if($id==4)

				{

					$arrary[5]=$role;

				}

				if($id==5)

				{

					$arrary[6]=$role;

				}

				if($id==6)

				{

					$arrary[0] = $role;

				}

				if($id==7)

				{

					$arrary[7] = $role;

				}

			}

			ksort($arrary);

			return $arrary;

		} else {

			return 0;

		}

	}

	public function get_hotel_Users($hotel_id){

		$query =  $this->db->query("SELECT U.*, R.name AS Role_name FROM users U LEFT JOIN roles R ON U.role = R.id WHERE U.firm_id = '".$hotel_id."'");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function getUsers(){

		$query =  $this->db->where("role", '1')->or_where("role", '8')->or_where("role", '2')->or_where("role", '3')->get("users");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function getSingleUser($id){

		$query =  $this->db->where("id", $id)->get("users");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	public function get_noti_depts(){

		$query =  $this->db->query("SELECT * FROM roles WHERE id NOT IN ('1','2','8','9')");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}
	public function get_roles_users($hotel_id, $role_ids){

		$query =  $this->db->query("SELECT * FROM users WHERE firm_id = '".$hotel_id."' and role IN (".$role_ids.")");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	public function get_ticket_noti_Info($hotel_id, $user_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("user_id", $user_id)->get("notifications_tickets");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	

	/*Encrypt - Decrypt Function*/

	public function encryptor($action, $string) {

        $output = false;

        $encrypt_method = "AES-256-CBC";

        //pls set your unique hashing key

        $secret_key = 'vectorlegelmethod';

        $secret_iv = 'U03QU4RwZuIxh)ztKK';

        // hash

        $key = hash('sha256', $secret_key);



        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning

        $iv = substr(hash('sha256', $secret_iv), 0, 16);



        //do the encyption given text/string/number

        if( $action == 'encrypt' ) {

            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);

            $output = base64_encode($output);

        }

        else if( $action == 'decrypt' ){

            //decrypt the given text/string/number

            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

        }

        return $output;

    }

	

	/*Wellcome Call CRUD*/

	public function getTodayArrivals($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->get("guest_today_arrivals");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	public function add_arrivals_today($post_data){

		$firm = $this->db->insert('guest_today_arrivals', $post_data);

		$insert_id 	= $this->db->insert_id();

		return $insert_id;

	}

	public function update_arrivals_today($hotel_id, $data){

		$this->db->where("hotel_id", $hotel_id)->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->update("guest_today_arrivals", $data);

		return true;

	}

	public function save_welcome_call($post_data){

		$firm = $this->db->insert('guests_welcome_call', $post_data);

		$insert_id 	= $this->db->insert_id();

		return $insert_id;

	}

	public function update_welcome_call($call_id, $post_data){

		$this->db->where("g_id", $call_id)->update("guests_welcome_call", $post_data);

		return true;

	}

	public function getHistoryByDate($hotel_id, $date){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("DATE(created_date)", date("Y-m-d", strtotime($date)))->get("guests_welcome_call");

		//echo $sql = $this->db->last_query();

		

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	

	/*Survey CRUD*/

	public function getSurveyInfo($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->get("survey_info");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function updateSurveyInfo($hotel_id, $post_data){

		$this->db->where("hotel_id", $hotel_id)->update("survey_info", $post_data);

		return true;

	}

	public function saveSurveyScore($post_data){

		$firm = $this->db->insert('survey_score', $post_data);

		$insert_id 	= $this->db->insert_id();

		return $insert_id;

	}

	public function getSingleSurveyInfo($track_id){

		$query =  $this->db->where("s_id", $track_id)->where("status", 1)->get("survey_score");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function updateSurveyScore($track_id, $post_data){

		$this->db->where("s_id", $track_id)->update("survey_score", $post_data);

		return true;

	}

	public function getSurveyScoreInfo($hotel_id){

		$year 	= date('Y');

		$query 	= $this->db->where("hotel_id", $hotel_id)->where("EXTRACT(YEAR FROM added_date) = ", $year)->where("status", '1')->order_by("s_id", "DESC")->get("survey_score");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	

	/*Reservation CRUD*/

	public function getReservations($hotel_id){

		$query 	= $this->db->where("hotel_id", $hotel_id)->order_by("f_r_id", "DESC")->get("guest_future_reservations");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function save_future_reservations($post_data){

		$firm = $this->db->insert('guest_future_reservations', $post_data);

		$insert_id 	= $this->db->insert_id();

		return $insert_id;

	}

	public function confirm_reservation($id){

		$data = array('status' => 1);

		$this->db->where("f_r_id", $id)->update("guest_future_reservations", $data);

		return true;

	}

	public function delete_reservation($id){

		$this->db->where("f_r_id", $id)->delete("guest_future_reservations");

	}

	

	/*Setting CRUD*/

	public function get_all_settings(){

		$query 	= $this->db->get("settings");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function get_settings($hotel_id){

		$query 	= $this->db->where("hotel_id", $hotel_id)->get("settings");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function save_settings($post_data){

		$this->db->where("hotel_id", $post_data['hotel_id'])->update("settings", $post_data);

		return true;

	}

	public function getAllAdminUsers(){

		$query =  $this->db->query("SELECT * FROM users u WHERE u.role = '8' order by firm_id asc");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	/*Housekeeping Module*/

	public function getHotelHouseKeepingAll($hotel_id){

		$query =  $this->db->query("SELECT * FROM users u WHERE u.firm_id = '".$hotel_id."' AND u.role = '4'");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function getHotelHouseKeeping($hotel_id){

		$query =  $this->db->query("SELECT * FROM users u WHERE NOT EXISTS (SELECT * FROM mpor m WHERE m.assign_to_id = u.id AND DATE(m.created_date) = '".gmdate("Y-m-d", strtotime($this->session->userdata['logged_in']['tz'].' hours'))."') AND u.firm_id = '".$hotel_id."' AND u.role = '4'");

		

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function saveMpor($post_data){

		$firm = $this->db->insert('mpor', $post_data);

		$insert_id 	= $this->db->insert_id();

		return $insert_id;

	}

	public function get_Mpor_live_progress($hotel_id, $user_id){

		$query = $this->db->query("
			SELECT * 
			FROM mpor 
			WHERE assign_to_id NOT IN ('".$user_id."') 
			AND hotel_id = '".$hotel_id."'  
			AND is_active = '1' 
			AND DATE(created_date) = '".gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'))."' 
			ORDER BY priority ASC
		");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function get_Mpor($hotel_id){
	    
	    $query = $this->db->where("hotel_id", $hotel_id)
		->where("is_active", '1')
		->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))
		->order_by('priority', 'ASC')
		->get("mpor");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function get_Mpor_By_Date_And_Room($hotel_id, $room_no, $between){

		$query = $this->db->query("SELECT * FROM mpor WHERE hotel_id = ".$hotel_id." AND assign_rooms = ".$room_no." AND is_active =  '1' AND DATE(created_date) ".$between."");

		//echo $sql = $this->db->last_query();exit;

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function get_Mpor_By_Date($hotel_id, $between){

		$query = $this->db->query("SELECT * FROM mpor WHERE hotel_id = ".$hotel_id." AND is_active =  '1' AND DATE(created_date) ".$between."");

		//echo $sql = $this->db->last_query();exit;

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function get_Mpor_By_User($user_id, $hotel_id){
	    
	    $query =  $this->db
		->where("assign_to_id", $user_id)
		->where("is_active", '1')
		->where("hotel_id", $hotel_id)
		->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))
		->order_by('priority', 'ASC')
		->get("mpor");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function getSingleMPOR($mpor_id){

		$query =  $this->db->where("mpor_id", $mpor_id)->where("is_active", '1')->get("mpor");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}
	
	public function getMorphWhere($where){
		$query =  $this->db->where($where)->get("mpor");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function delete_mpor($mpor_id){

		$this->db->where("mpor_id", $mpor_id)->delete("mpor");

	}

	public function delete_mpor_multiple($post_data){

		$this->db->query("DELETE FROM mpor WHERE mpor_id IN (".$post_data.")");

	}

	public function mpor_room_started($post_data){

		$this->db->where("mpor_id", $post_data['mpor_id'])->update("mpor", $post_data);

		return true;

	}

	public function save_Mpor_settings($post_data){

		$query =  $this->db->where("hotel_id", $post_data['hotel_id'])->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->get("mpor_settings");

		if ($query->num_rows() > 0) {

			$this->db->where("hotel_id", $post_data['hotel_id'])->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->update("mpor_settings", $post_data);

			return true;

		}else{

			$this->db->insert('mpor_settings', $post_data);

			$insert_id = $this->db->insert_id();

			return $insert_id;

		}

	}

	public function get_Mpor_settings_By_Date($hotel_id, $between){

		$query = $this->db->query("SELECT SUM(total_rooms) AS total_rooms, SUM(total_checkouts) AS total_checkouts, SUM(total_occupied) AS total_occupied, SUM(total_stayovers) AS total_stayovers, SUM(total_vacant) AS total_vacant, SUM(out_of_order) AS out_of_order FROM mpor_settings WHERE hotel_id = ".$hotel_id." AND DATE(created_date) ".$between."");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function get_Mpor_settings($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->get("mpor_settings");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function get_Unassigned_rooms($hotel_id, $user_id, $room_list, $created_date){

        $query = $this->db->query("SELECT * FROM mpor WHERE hotel_id = '".$hotel_id."' AND assign_to_id = '".$user_id."' AND assign_rooms NOT IN (".$room_list.") AND is_active = '1' AND DATE(created_date) = '".$created_date."'");

        if ($query->num_rows() > 0) {

			$result = $query->result();

			

			$post_data = array('assign_to_id' => '000000');

			$this->db->where("mpor_id", $result[0]->mpor_id)->update('mpor', $post_data);

			return $query->result();

		} else {

			return 0;

		}

    }

	public function get_assign_rooms_data_2($hotel_id, $user_id, $created_date){

        $query = $this->db->query("SELECT COUNT(assign_rooms) as total_rooms,

(SELECT count(chk_stay) FROM mpor WHERE hotel_id = '".$hotel_id."' AND assign_to_id = '".$user_id."' AND DATE(created_date) = '".$created_date."' and chk_stay = 'checkout') AS total_checkouts,

(SELECT count(chk_stay) FROM mpor WHERE hotel_id = '".$hotel_id."' AND assign_to_id = '".$user_id."' AND DATE(created_date) = '".$created_date."' and chk_stay = 'stayover') AS total_stayovers

FROM mpor WHERE hotel_id = '".$hotel_id."' AND assign_to_id = '".$user_id."' AND DATE(created_date) = '".$created_date."'");

        if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	public function get_Mpor_checkout_count($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("is_active", '1')->where("chk_stay", 'checkout')->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->get("mpor");

		if ($query->num_rows() > 0) {

			return $query->num_rows();

		} else {

			return 0;

		}

	}

	public function get_Mpor_stayover_count($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("is_active", '1')->where("chk_stay", 'stayover')->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->get("mpor");

		if ($query->num_rows() > 0) {

			return $query->num_rows();

		} else {

			return 0;

		}

	}

	public function get_Mpor_inprogress_count($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("is_active", '1')->where("status", 'In-Progress')->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->get("mpor");

		if ($query->num_rows() > 0) {

			return $query->num_rows();

		} else {

			return 0;

		}

	}

	public function get_Mpor_completed_count($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("is_active", '1')->where("status", 'Completed')->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->get("mpor");

		if ($query->num_rows() > 0) {

			return $query->num_rows();

		} else {

			return 0;

		}

	}

	public function get_Mpor_apr_checkout_count($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("is_active", '1')->where("approved",'Approved')->where("chk_stay", 'checkout')->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->get("mpor");

		if ($query->num_rows() > 0) {

			return $query->num_rows();

		} else {

			return 0;

		}

	}

	public function get_Mpor_apr_stayover_count($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("is_active", '1')->where("approved",'Approved')->where("chk_stay", 'stayover')->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->get("mpor");

		if ($query->num_rows() > 0) {

			return $query->num_rows();

		} else {

			return 0;

		}

	}

	public function updateRoomPriorities($hotel_id, $room_no, $post_data){

		$this->db->where("hotel_id", $hotel_id)->where("assign_rooms", $room_no)->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->update("mpor", $post_data);

		return true;

	}

	public function checkRoomExistOrNot($hotel_id, $user_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("assign_rooms", $user_id)->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->get("mpor");

		if ($query->num_rows() > 0) {

			return $query->num_rows();

		} else {

			return 0;

		}

	}

	

	/*Notifications*/

	public function save_notification($post_data){

		$this->db->insert('notifications', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function update_notification($post_data){

		$this->db->where("n_id", $post_data['n_id'])->update('notifications', $post_data);

		return true;

	}

	public function get_user_notification($user_id){

		$query =  $this->db->where("user_id", $user_id)->where("status", 'unseen')->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->get("notifications");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function get_dept_notification($dept_id){

		$query =  $this->db->where("dept_id", $dept_id)->where("status", 'unseen')->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->get("notifications");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	

	/*Top Notifications*/

	public function get_top_notifications($hotel_id, $user_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("user_id", $user_id)->where("status", 'unseen')->order_by("nt_id", "DESC")->limit(10)->get("notifications_tag");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}
	
	public function update_top_notifications($data){
		$this->db->where("nt_id", $data['nt_id'])->update('notifications_tag', $data);
		return true;
	}

	/*Emergency*/

	public function save_emergency($post_data){

		$this->db->insert('emergency', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function get_emergency($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("status", '1')->order_by("e_id", "DESC")->limit(1)->get("emergency");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function update_emergency($e_id, $post_data){

		$this->db->where("e_id", $e_id)->update('emergency', $post_data);

		return true;

	}

	

	/*Guest Voice CRUD*/

	public function getGVTickets($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("is_approved", '0')->where("is_ticket", '0')->get("gss_inbox");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function get_single_guest_voice($g_id){

		$query =  $this->db->where("g_id", $g_id)->get("gss_inbox");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function update_inbox($g_id, $post_data){

		$this->db->where("g_id", $g_id)->update('gss_inbox', $post_data);

		return true;

	}

	public function delete_guest_voice($g_id){

		$this->db->where("g_id", $g_id)->delete("gss_inbox");

	}

	

	/*Complaint CRUD*/

	public function save_complaint($post_data){

		$this->db->insert('complaint', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function get_complaints(){

		$query =  $this->db->where("status", '0')->get("complaint");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function update_complaint($case_id, $post_data){

		$this->db->where("c_id", $case_id)->update('complaint', $post_data);

		return true;

	}

	public function delete_complaint($case_id){

		$this->db->where("c_id", $case_id)->delete("complaint");

	}

	

	/*EVENTS CRUD*/

	public function save_event($post_data, $table){

		$this->db->insert($table, $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function get_events($hotel_id){//, all_day as allDay

		$sql = "SELECT event_id as id, title, event_start as start, event_end as end, className, description FROM events WHERE status = 1 AND hotel_id = ".$hotel_id." ORDER BY event_id DESC";

		return $this->db->query($sql)->result();

    }

	public function delete_event($event_id){

		$this->db->where("event_id", $event_id)->delete("events_noti");

		$this->db->where("event_id", $event_id)->delete("events");

	}

	public function get_hotel_Events($hotel_id){

		$query = $this->db->query("SELECT * FROM events WHERE status = 1 AND hotel_id = ".$hotel_id." AND CURRENT_DATE() BETWEEN start_date AND end_date");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	

	/*SCROLLER CRUD*/

	public function save_scrollTypes($post_data){

		$this->db->insert('scroll_types', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function get_scrollTypes($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->get("scroll_types");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	public function delete_scrollTypes($hotel_id){

		$this->db->where("hotel_id", $hotel_id)->delete("scroll_types");

	}

	

	/*AGENDA CRUD*/

	public function save_agenda($post_data){

		$this->db->insert('agenda_list', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function get_agendas_list($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->get("agenda_list");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	public function update_agenda($agenda_id, $post_data){

		$this->db->where("agd_id", $agenda_id)->update('agenda_list', $post_data);

		return true;

	}

	public function get_single_agenda($agenda_id){

		$query =  $this->db->where("agd_id", $agenda_id)->get("agenda_list");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function delete_agenda($agenda_id){

		$this->db->where("agd_id", $agenda_id)->delete("agenda_list");

	}

	

	public function get_agenda_checklist($agenda_id){

		$query =  $this->db->where("agenda_id", $agenda_id)->order_by("agenda_priority", "ASC")->get("agenda_checklist");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	public function save_agenda_checklist($post_data){

		$query =  $this->db->where("agenda_id", $post_data['agenda_id'])->get("agenda_checklist");

		if ($query->num_rows() > 0) {

			$priority = $query->num_rows()+1;

		}else{

			$priority = 1;

		}

		$post_data['agenda_priority'] = $priority;

		

		$this->db->insert('agenda_checklist', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function update_agenda_checklist($agenda_checklist_id, $post_data){

		$this->db->where("adg_chk_id", $agenda_checklist_id)->update('agenda_checklist', $post_data);

		return true;

    }

	public function update_agenda_checklist_priority($agenda_checklist_id, $agenda_priority){

		$post_data = array('agenda_priority' => $agenda_priority);

		$this->db->where("adg_chk_id", $agenda_checklist_id)->update('agenda_checklist', $post_data);

		return true;

    }

	public function delete_agenda_checklist($agenda_checklist_id){

		$this->db->where("adg_chk_id", $agenda_checklist_id)->delete("agenda_checklist");

	}



	/*USER TRACKING CRUD*/

	public function save_tracking($post_data){

		$this->db->insert('users_logs', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function get_user_tracking($hotel_id, $limit, $user_id){

		if($user_id == 'all'){

			$query =  $this->db->where("hotel_id", $hotel_id)->order_by("log_id", "DESC")->limit($limit)->get("users_logs");

		}else{

			$query =  $this->db->where("hotel_id", $hotel_id)->where("user_id", $user_id)->order_by("log_id", "DESC")->get("users_logs");

		}

		//->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))

		

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	

	/*Ticket Notification CRUD*/

	/*public function get_ticket_noti($hotel_id, $user_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("user_id", $user_id)->get("notifications_tickets");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }*/

	public function update_ticket_noti($user_id, $post_data){

		$query =  $this->db->where("user_id", $user_id)->get("notifications_tickets");

		if ($query->num_rows() > 0) {

			$this->db->where("user_id", $user_id)->update("notifications_tickets", $post_data);

			return true;

		}else{

			$this->db->insert('notifications_tickets', $post_data);

			$insert_id = $this->db->insert_id();

			return $insert_id;

		}

    }

	

	/*Hotel KEYS CRUD*/

	public function save_hotel_keys($post_data){

		$this->db->insert('key_rings', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function get_hotel_keys($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->get("key_rings");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	public function get_single_keys_count($key_id, $hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("key_num", $key_id)->get("key_rings");

		if ($query->num_rows() > 0) {

			return $query->num_rows();

		} else {

			return 0;

		}

    }

	public function get_single_keys_data($key_id, $hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("key_num", $key_id)->get("key_rings");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	public function update_hotel_keys($key_id, $post_data){

		$this->db->where("key_id", $key_id)->update('key_rings', $post_data);

		return true;

    }

	public function delete_hotel_keys($key_id){

		$this->db->where("key_id", $key_id)->delete("key_rings");

	}

	

	/*KEYS LOGS CRUD*/

	public function get_available_keys($hotel_id){

		$query = $this->db->query("SELECT * FROM key_rings WHERE key_rings.key_id NOT IN (SELECT key_logs.key_id FROM key_logs WHERE (key_logs.key_status = 'Issued' OR key_logs.key_status = 'Returned')) AND hotel_id = '$hotel_id'");



		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	public function request_a_key_verify($post_data){

		$query =  $this->db->where("hotel_id", $post_data['hotel_id'])->where("issued_to", $post_data['issued_to'])->where("key_id", $post_data['key_id'])->where("key_status", 'Requested')->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->get("key_logs");

		if ($query->num_rows() > 0) {

			return $query->num_rows();

		} else {

			return 0;

		}

    

	}

	public function request_a_key($post_data){

		$this->db->insert('key_logs', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function witness_a_key($keylog_id, $post_data){

		$this->db->where("keylog_id", $keylog_id)->update('key_logs', $post_data);

		return true;

    }

	public function get_all_requested_keys($hotel_id){

		$query = $this->db->query("SELECT * FROM key_logs WHERE hotel_id = ".$hotel_id." AND (key_status = 'Requested' OR key_status = 'Returned') AND DATE(created_date) = '".gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'))."'");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	public function get_all_issued_keys($hotel_id){

		$query = $this->db->query("SELECT * FROM key_logs WHERE hotel_id = ".$hotel_id." AND (key_status = 'Issued' OR key_status = 'Completed') AND DATE(created_date) = '".gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'))."'");

		//echo $sql = $this->db->last_query();exit;

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	public function get_all_not_returned_keys($hotel_id){

		$query = $this->db->query("SELECT * FROM key_logs WHERE hotel_id = ".$hotel_id." AND (key_status = 'Issued' OR key_status = 'Returned')");

		

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	public function get_my_issued_keys($hotel_id, $user_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("issued_to", $user_id)->where("key_status", 'Issued')->where("DATE(created_date)", gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours')))->get("key_logs");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	public function get_key_logs_history($hotel_id, $between){

		$query =  $this->db->query("SELECT * FROM key_logs WHERE hotel_id = ".$hotel_id." AND DATE(created_date) ".$between."");

		//echo $sql = $this->db->last_query();exit;

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	

	/*VENDOR CRUD*/

	public function save_vendor($post_data){

		$this->db->insert('vendor_info', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function get_vendors($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->get("vendor_info");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	public function get_single_vendor($vendor_id){

		$query =  $this->db->where("v_id", $vendor_id)->get("vendor_info");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function update_vendor($v_id, $post_data){

		$this->db->where("v_id", $v_id)->update('vendor_info', $post_data);

		return true;

    }

	public function delete_vendor($vendor_id){

		$this->db->where("v_id", $vendor_id)->delete("vendor_info");

	}

	

	/*VENDOR CRUD*/

	public function save_vendor_signIn($post_data){

		$this->db->insert('vendor_signIn', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function get_timeIn_keys($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("time_out", '')->get("vendor_signIn");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	public function update_vendor_signIn($vsignin_id, $post_data){

		$this->db->where("vsignin_id", $vsignin_id)->update('vendor_signIn', $post_data);

		return true;

    }

	

	/*Mass Survey CRUD*/

	public function save_Mass_Survey($post_data){

		$this->db->insert('mass_survey', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function get_Mass_Survey($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("status", '1')->get("mass_survey");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	public function getMassSurveyGuestNamesDateBase($hotel_id, $unique_code){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("unique_code", $unique_code)->where("status", '1')->get("mass_survey");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

    }

	public function delete_Mass_Survey($m_id){

		$this->db->where("m_id", $m_id)->delete("mass_survey");

	}

	public function update_Mass_Survey($m_id, $post_data){

		$this->db->where("m_id", $m_id)->update('mass_survey', $post_data);

		return true;

    }

	public function getMassSurveyInfo($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->get("mass_survey_info");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function updateMassSurveyInfo($hotel_id, $post_data){

		$this->db->where("hotel_id", $hotel_id)->update("mass_survey_info", $post_data);

		return true;

	}

	

	/*Mass Survey Questions CRUD*/

	public function getMassSurveyInfoQuestions($hotel_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->get("mass_survey_info_questions");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function saveMassSurveyInfoQuestions($post_data){

		$this->db->insert('mass_survey_info_questions', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function updateMassSurveyInfoQuestions($q_id, $post_data){

		$this->db->where("q_id", $q_id)->update('mass_survey_info_questions', $post_data);

		return true;

    }

	public function updateMassSurveyInfoQuestionsAll($hotel_id, $post_data){

		$this->db->where("hotel_id", $hotel_id)->update('mass_survey_info_questions', $post_data);

		return true;

    }

	public function deleteMassSurveyInfoQuestions($q_id){

		$this->db->where("q_id", $q_id)->delete("mass_survey_info_questions");

	}

	

	/*Mass Survey Answer CRUD*/

	public function getMassSurveyInfoAnswer($hotel_id, $m_id, $q_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("m_id", $m_id)->where("q_id", $q_id)->get("mass_survey_info_answer");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function saveMassSurveyInfoAnswer($post_data){

		$this->db->insert('mass_survey_info_answer', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function updateMassSurveyInfoAnswer($a_id, $post_data){

		$this->db->where("a_id", $a_id)->update('mass_survey_info_answer', $post_data);

		return true;

    }

	

	/*Mass Survey Additional Answer CRUD*/

	public function getMassSurveyAdtnlAnswer($hotel_id, $m_id){

		$query =  $this->db->where("hotel_id", $hotel_id)->where("m_id", $m_id)->get("mass_survey_adtnl_answer");

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return 0;

		}

	}

	public function saveMassSurveyAdtnlAnswer($post_data){

		$this->db->insert('mass_survey_adtnl_answer', $post_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function updateMassSurveyAdtnlAnswer($m_id, $post_data){

		$this->db->where("m_id", $m_id)->update('mass_survey_adtnl_answer', $post_data);

		return true;

    }

	public function lock_mpor_start_timer($post_date){

		$this->db->insert("mpor_checklist_data", $post_date);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function lock_mpor_complete_timer($post_data){

		$this->db->where("hotel_id", $post_data['hotel_id'])->where("mpor_id", $post_data['mpor_id'])->where("cat_id", $post_data['cat_id'])->where("subcat_id", $post_data['subcat_id'])->update('mpor_checklist_data', $post_data);

		return true;

    }
    
    public function get_where($where, $table) {
		$data = $this->db->where($where)->get($table)->row();
		return $data;
	}
}



?>