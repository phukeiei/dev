<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class UMS extends UMS_Controller{

	// Create __construct for load model use in this controller
	public function __construct(){
		parent::__construct();
	}

	public function index(){

		$this->session->unset_userdata('MnID');
		$this->session->unset_userdata('MnNameT');
		$this->session->unset_userdata('MnLevel');
		$this->session->unset_userdata('MnURL');

		$this->output('UMS/v_home');

	}






}


?>
