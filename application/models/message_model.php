<?php

class Message_Model extends CI_Model {
	public function create_private_chat($post_data){
		$query =  $this->db->where("hotel_id", $post_data['hotel_id'])
			->where('(sender_id = "'.$post_data['sender_id'].'" AND recipient_id = "'.$post_data['recipient_id'].'")')
			->or_where('(sender_id = "'.$post_data['recipient_id'].'" AND recipient_id = "'.$post_data['sender_id'].'")')
			->where("type", $post_data['type'])
			->where("group_id", '0')
			->get('messages_relations');
		//echo $sql = $this->db->last_query();exit;

		if ($query->num_rows() > 0) {
			$results = $query->result();
			echo  $results[0]->r_id;
		} else {
			//Insert Relation
			$this->db->insert("messages_relations", $post_data);
			$insert_id = $this->db->insert_id();
			echo  $insert_id;
		}
	}
	public function create_group_info($post_data){
		$this->db->insert("messages_group_info", $post_data);
		$group_id = $this->db->insert_id();
		
		$allmembers = explode(',', $post_data['group_members']);
		
		foreach($allmembers as $group_users){
			if($group_users != ''){
				$this->db->insert("messages_group_members", array('hotel_id' => $post_data['hotel_id'], 'group_id' => $group_id, 'user_id' => $group_users));
			}
		}
		
		return $group_id;
	}
	public function create_group_relation($post_data){
		$this->db->insert("messages_relations", $post_data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function load_left_sidebar($hotel_id, $sender_id){
		$chats	 	= $this->db->query("SELECT GROUP_CONCAT(messages_relations.r_id) AS site_list FROM messages_relations WHERE hotel_id = ".$hotel_id." AND ( (sender_id = ".$sender_id." OR recipient_id = ".$sender_id.") AND type = 'private')");
		$groups		= $this->db->query("SELECT GROUP_CONCAT(mr.r_id) AS site_list FROM messages_relations mr LEFT JOIN messages_group_members gm ON mr.group_id = gm.group_id WHERE gm.user_id = ".$sender_id." AND gm.hotel_id = ".$hotel_id." ");
		
		$chats_results		= $chats->result();
		$groups_results		= $groups->result();
		
		if ($chats_results[0]->site_list != '') {
			$r_ids			= $chats_results[0]->site_list;
		} else {
			$r_ids			= 0;
		}
		
		if ($groups_results[0]->site_list != '') {
			if($r_ids != 0){
				$r_ids		= $r_ids.','.$groups_results[0]->site_list;
			}else{
				$r_ids		= $groups_results[0]->site_list;
			}
		} else {
			$r_ids			= $r_ids;
		}
		
		/*$query =  $this->db->where("hotel_id", $hotel_id)
		->where('(sender_id = "'.$sender_id.'" OR recipient_id = "'.$sender_id.'")')
		->order_by('last_modified', 'DESC')
		->get('messages_relations');*/
		
		$query		= $this->db->query("SELECT * FROM messages_relations WHERE hotel_id = ".$hotel_id." AND r_id IN (".$r_ids.") ORDER by last_modified DESC");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function fetch_chat_data($hotel_id, $r_id){
		$post_data = array(
			'seen'		=> '1',
			'seen_at'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))
		);
		$this->db->where("hotel_id", $hotel_id)->where("r_id", $r_id)->where("sender_id != ", $this->session->userdata['logged_in']['id'])->update("messages", $post_data);
		$this->db->where("u_id", $this->session->userdata['logged_in']['id'])->where("r_id", $r_id)->where("seen", 0)->update("messages_seen", $post_data);
		
		//echo $sql = $this->db->last_query();exit;
		/*$this->db->where("hotel_id", $hotel_id)->where("created_by", $recipient_id)->where("user_id", $sender_id)->update("notifications_tag", array('status' => 'seen'));*/
		//$query =  $this->db->query("SELECT * FROM messages m LEFT JOIN messages_relations mr ON mr.r_id = m.r_id where m.hotel_id = '".$hotel_id."' and m.r_id = '".$r_id."'");

		$query =  $this->db->where("hotel_id", $hotel_id)
		->where("r_id", $r_id)
		->order_by('m_id', 'ASC')
		->get('messages');
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function send_message($post_data){
		$post_data2 = array('is_typing'	=> '0');
		$this->db->where("hotel_id", $post_data['hotel_id'])->where("r_id", $post_data['r_id'])->update("messages", $post_data2);
		
		//Insert Message
		$this->db->insert("messages", $post_data);
		$insert_id = $this->db->insert_id();
		
		$this->db->where("r_id", $post_data['r_id'])->update("messages_relations", array('last_modified'	=> gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'))));
		
		return $insert_id;
	}
	public function create_tie_message($tie_post_data){
		$hotel_id				= $tie_post_data['hotel_id'];
		$group_created_by		= $tie_post_data['generated_by'];
		$generated_by_name		= $tie_post_data['generated_by_name'];
		$group_name				= $tie_post_data['group_name'];
		$message_class			= $tie_post_data['message_class'];
		$tie_id					= $tie_post_data['tie_id'];
		$tie_type				= $tie_post_data['tie_type'];
		$first_message			= $tie_post_data['first_message'];
		
		$group_members_comma	= $tie_post_data['assign_to'];
		$group_members			= explode(',', $tie_post_data['assign_to']);		
		$created_date			= gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
				
		$group_info = array(
			'hotel_id'				=> $hotel_id,
			'group_created_by'		=> $group_created_by,
			'group_name'			=> $group_name,
			'group_image'			=> '',
			'group_members'			=> $group_members_comma,
			'group_created_date'	=> $created_date,
		);
		$group_id					= $this->create_group_info($group_info);
		
		if($group_id){
			$group_relation = array(
				'hotel_id'			=> $hotel_id,
				'sender_id'			=> $group_created_by,
				'recipient_id'		=> '0',
				'type'				=> 'group',
				'group_id'			=> $group_id,
				'last_modified'		=> $created_date,
			);
			$relation_id			= $this->create_group_relation($group_relation);
		}
		if($relation_id){
			$this->db->insert("messages_tie", array('hotel_id' => $hotel_id, 'tie_type' => $tie_type, 'tie_id' => $tie_id, 'r_id' => $relation_id, 'group_id' => $group_id, 'tie_created_date' => $created_date));
			$message_data = array(
				'hotel_id'			=> $hotel_id,
				'sender_id'			=> $group_created_by,
				'r_id'				=> $relation_id,					
				'sender_name'		=> $generated_by_name,
				'recipient_id'		=> 0,
				'recipient_name'	=> $group_name,
				'group_id'			=> $group_id,
				'text_message'		=> $first_message, //$generated_by_name.' added you in a group "'.$group_name.'"',
				'message_type'		=> $tie_type,
				'message_class'		=> $message_class,
				'seen'				=> '0',
				'is_display'		=> '1',
				'sent_at'			=> $created_date,
			);
			$this->send_message($message_data);
		}
	}
	public function get_tie_message($post_data){
		$query =   $this->db->where("hotel_id", $post_data['hotel_id'])
							->where("tie_type", $post_data['tie_type'])
							->where("tie_id", $post_data['tie_id'])
							->get('messages_tie');
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function typing_status($hotel_id, $sender_id, $r_id, $is_typing){
		$post_data = array('is_typing'	=> $is_typing);
		$this->db->where("hotel_id", $hotel_id)->where("r_id", $r_id)->where("sender_id", $sender_id)->update("messages", $post_data);
	}
	public function get_count_unseen_messages($type, $hotel_id, $r_id, $sender_id){
		if($type == 'single'){
			$query = $this->db->query("SELECT COUNT(*) AS unseen FROM messages WHERE hotel_id = '".$hotel_id."' AND r_id = '".$r_id."' AND sender_id = '".$sender_id."' AND seen = '0'");
		}else{
			$query = $this->db->query("SELECT COUNT(*) AS unseen FROM messages_seen WHERE r_id = '".$r_id."' AND u_id = '".$sender_id."' AND seen = '0'");
		}
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_group_members($hotel_id, $group_id){
		$query =  $this->db->where("hotel_id", $hotel_id)
		->where("group_id", $group_id)
		->get('messages_group_members');
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function group_message_relation($post_data){		
		//Insert Message
		$this->db->insert("messages_seen", $post_data);
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}
	
	/* Will Be Deleted Soon*/
	public function get_hotel_users_list($hotel_id, $user_id){
		$query =  $this->db->where("firm_id", $hotel_id)->where("status", '1')->where_not_in("id", $user_id)->get("users");
		//echo $sql = $this->db->last_query();exit;
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
}
?>