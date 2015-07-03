<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracking extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
	public function getFriends($id){
		$query="SELECT friends.username AS friendAlias,friends.id AS friendID ".
		"FROM users ".
		"LEFT JOIN friendships ".
		"ON users.id = friendships.user_id ".
		"LEFT JOIN users AS friends ".
		"ON friends.id = friendships.friend_id ".
		"WHERE users.id = ?";

		return $this->db->query($query,$id)->result_array();
	}
	public function addKey($id,$carrier,$trackingKey){
		$query="INSERT INTO trackkeys (user_id, serial, deliverydate, provider, created_at, updated_at)
	          	VALUES(?, ?, NOW(), ? ,NOW(), NOW())";

		$this->db->query($query,array(
			$id,
			$trackingKey,
			$carrier
		));
		redirect(base_url()."profile");
	}
	public function getKeys($id){
		$query = "SELECT trackkeys.id,trackkeys.deliverydate,trackkeys.serial,trackkeys.provider 
				  FROM trackkeys 
				  LEFT JOIN users 
				  ON users.id = trackkeys.user_id
				  WHERE users.id = ?";
		return $this->db->query($query,$id)->result_array();
	}
	public function updateKey(){

	}
	public function deleteKey($id){
		$this->db->where('id', $id);
   	$this->db->delete('trackkeys');
	}
}