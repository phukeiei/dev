<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include('UMS_Controller.php');
class UMS_redirect extends  UMS_Controller {
	public function __construct(){
		parent::__construct();
		
	}
	function index(){

		$UsID = $this->session->userdata('UsID');
		$StID = $this->session->userdata('StID');
		$GpID = $this->session->userdata('GpID');
	
		$host = "10.51.4.16";
		echo $host ; echo "<br>";
		echo $UsID ; echo "<br>";
		echo $StID ; echo "<br>";
		echo $GpID ; 

		die();
		
		$redirect .= "/".$UsID;
		$redirect .= "/".$StID;
		$redirect .= "/".$GpID;
		echo $redirect ; 
		die();
		header("Location: http://".$host."/msipbri/js/test_login".$redirect);
		// redirect($redirect);
	}
	
}