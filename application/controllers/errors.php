<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//http://testing.shippingapis.com/ShippingAPITest.dll?API=CityStateLookup&XML=<CityStateLookupRequest USERID="053NONE02890"><ZipCode ID= "0"><Zip5>90210</Zip5></ZipCode></CityStateLookupRequest>
class Errors extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Tracking");
		//$this->output->enable_profiler();
	}
	public function er404(){
		$this->load->view('error404');
	}
}

//end of main controller