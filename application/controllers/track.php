<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//http://testing.shippingapis.com/ShippingAPITest.dll?API=CityStateLookup&XML=<CityStateLookupRequest USERID="053NONE02890"><ZipCode ID= "0"><Zip5>90210</Zip5></ZipCode></CityStateLookupRequest>
class Track extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Tracking");
		//$this->output->enable_profiler();
	}
	public function addKey(){
		$postData = $this->input->post();
		$sessionData = $this->session->userdata('loggedIn');
		//die(var_dump($postData));
		$this->Tracking->addKey($sessionData['id'],$postData['carrier'],$postData['trackerkey']);
	}
	public function getKeys($userId){

		$this->Tracking->getKeys();
	}
	public function updateKey(){
		$this->Tracking->updateKey();
	}
	public function deleteKey($key){
		$this->Tracking->deleteKey($key);
		echo "done";
	}
}

//end of main controller