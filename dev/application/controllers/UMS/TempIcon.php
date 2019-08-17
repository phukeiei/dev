<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');

class TempIcon extends UMS_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		
	}
	
	public function index(){
		if (isset( $_GET['type']) && isset( $_GET['image'])) {
			$type =  $_GET['type'];
			$image =  $_GET['image'];
			$path = "/home/staff/staff3/public_html/uploads/{$type}/{$image}";
			if (is_readable($path)) {
				$info = getimagesize($path);
				if ($info !== FALSE) {
					header("Content-type: {$info['mime']}");
					readfile($path);
					exit();
				}
			}
		}
		/*$type = "system";
		$image = "cog.png";
		$path = "/home/staff/staff3/uploads/{$type}/{$image}";
		echo $path."<br />";
		if(is_readable($path)){
			$info = getimagesize($path);
			echo "Have Image";
			if($info !== FALSE){
				echo "Have Info";
			}
		}
		else{
			echo "haven't Image";
		}*/
		//echo  $_REQUEST['type']."<br />";
		//echo  $_REQUEST['image'];
	}
	
	public function temp(){
		if (isset( $_GET['type']) && isset( $_GET['image'])) {
			$type =  $_GET['type'];
			$image =  $_GET['image'];
			$path = "/home/staff/staff3/uploads/{$type}/{$image}";
			if (is_readable($path)) {
				$info = getimagesize($path);
				if ($info !== FALSE) {
					header("Content-type: {$info['mime']}");					
					exit();
				}
			}
		}
	}
	
	public function testdate(){
		$month = date("F");
		$year = date("Y");
		echo $month.$year;
	}

	

		
}
?>