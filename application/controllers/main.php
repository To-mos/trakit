<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent::__construct();
		//$this->output->enable_profiler();
	}

	function index(){
		// $this->load->template('index',array(
		// 	'title'   => 'Welcome to Trakit'
		// ));
		$userSession = $this->session->userdata('loggedIn');
		if(isset($userSession) && !empty($userSession)){
			redirect(base_url().'profile');
		}else{
			$this->load->view('indexOLD');
		}
	}
}

//end of main controller