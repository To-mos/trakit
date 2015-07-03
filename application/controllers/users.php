<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		//$this->output->enable_profiler();
	}

	public function index(){
		$sessionData = $this->session->userdata('loggedIn');
		if(!empty($sessionData)){
			$this->load->model("Tracking");
			// $client= new GearmanClient();
			// $client->addServer("10.0.0.6", 4730);
			// //echo $client->do("reverse", "Hello World!")."</br>";
			// //echo $client->do("trackFedex", "510087020")."</br>";
			// //echo $client->do("trackUSPS", "9405509699937018835945")."</br>";
			// //echo $client->do("trackUPS", "1Z6934X10351053020")."</br>";
			// //echo $client->do("trackDHL", "123456789012")."</br>";
			$keys = $this->Tracking->getKeys($sessionData['id']);
			$this->load->template('profile',array(
				'title'   => 'Profile View',
				'username'=> $sessionData['username'],
				'name'    => $sessionData['name'],
				'email'   => $sessionData['email'],
				'trackkeys'=> $keys
			));
		}else{
			redirect(base_url());
		}
	}

	public function editProfile(){
		$sessionData = $this->session->userdata('loggedIn');
		if(!empty($sessionData)){
			$this->load->model("Tracking");
			$keys = $this->Tracking->getKeys($sessionData['id']);
			$this->load->template('editProfile',array(
				'id'      => $sessionData['id'],
				'title'   => 'Edit Your Profile',
				'username'=> $sessionData['username'],
				'name'    => $sessionData['name'],
				'email'   => $sessionData['email'],
				'trackkeys'=> $keys
			));
		}else{
			redirect(base_url());
		}
	}

	public function updateProfile(){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			if($this->form_validation->run() == TRUE){
				$this->load->model("User");//load the model classes
				$id = $this->input->post('id');
				$data = $this->User->editUser($id);
				if(!empty($data)){
					$this->session->set_flashdata('profileUpdateSuccess', "Successfully updated profile");
					$sessionData = $this->session->userdata('loggedIn');
					$this->session->set_userdata('loggedIn',array(
						'id' => $sessionData['id'],
						'username' => $data['username'],
						'name' => $data['name'],
						'email' => $sessionData['email']
					));
					redirect(base_url().'editProfile');
				}else{
					$this->session->set_flashdata('profileUpdateError', "Couldn't Change Info");
					redirect(base_url().'editProfile');
				}

				

			}else{
				$this->session->set_flashdata('profileUpdateError', validation_errors());
				redirect(base_url().'editProfile');
			}
	}

	public function login(){
		$this->load->model("User");
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Username', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('pword', 'Password', 'trim|required|xss_clean|callback_check_database');

		//$results = $this->User->login($this->input->post());
		if($this->form_validation->run() == TRUE){
			redirect('profile');
		}else{
			$this->session->set_flashdata('loginError', validation_errors());
			redirect(base_url());
		}
	}

	public function logout(){
		$this->session->sess_destroy();
  	redirect(base_url());
	}

	public function register(){
		$this->load->model("User");
		$this->load->library('form_validation');
		$postData = $this->input->post();
		//die(var_dump($postData));
		// field name, error message, validation rules
		$this->form_validation->set_rules('name', 'Your Name', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('username', 'User Name', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('pword', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('confirm_pword', 'Password Confirmation', 'trim|required|matches[pword]');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('regError', validation_errors());
		}else{
			$this->User->addUser();
			$this->session->set_flashdata('loginError',"Creation sucessful you may now login.");
		}
		redirect(base_url());
	}
	public function check_database($password){
	  //Field validation succeeded.  Validate against database
	  $username = $this->input->post('email');
		$results = $this->User->loginUser($username, $password);
		if($results){
	        $this->session->set_userdata('loggedIn',array(
				'id'    => $results['id'],
				'username' => $results['username'],
				'email' => $results['email'],
				'name' => $results['name']
			));
	    	return TRUE;
	    }else{
	    	$this->form_validation->set_message('check_database', 'Invalid username or password');
	    	return false;
	    }
	}
}

//end of main controller