<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function loginUser($username,$password){
		/*if($username == 0 || $username == false || $password == 0 || $password == false)
			return false;*/
		
		$pwHash = crypt($password,"SecretSaltyGoodness23");
		$query = "SELECT users.id,users.email,users.name,users.username FROM users WHERE users.email = ? AND users.password = ?";
		$results = $this->db->query($query,array($username,$pwHash))->result_array();

		return empty($results) ? false : $results[0];
	}

	public function addUser(){
		$username = $this->input->post('username');
  		$query = 'INSERT INTO users (username, name, email, password, created_at, updated_at)
	          				  VALUES(?, ?, ?, ? ,NOW(), NOW())';
  		return $this->db->query($query,array(
			$username,
			$this->input->post('name'),
			$this->input->post('email'),
			crypt($this->input->post('pword'),"SecretSaltyGoodness23")
  		));
	}

	public function editUser($id){
			$data = array(
          'username' => $this->input->post('username'),
          'name' => $this->input->post('name')
      );
      $this->db->where('id', $id);
      $this->db->update('users', $data);
      return $data;
	}

	public function getProfile($id){
		$query = "SELECT users.name,users.email,users.username FROM users WHERE id = ?";
		return $this->db->query($query,$id)->result_array();
	}
}