<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');

class  Search extends UMS_Controller {

	// Create __construct for load model use in this controller
	public function __construct(){
		//call parent::__construct() for use $this->load
		parent::__construct();
		$this->load->model('UMS/m_umuser');
		//$this->load->model('UMS/m_umshowprofile');
		$this->load->model('UMS/m_umgroup');
		$this->load->model('UMS/m_umsystem');
		
	}
	
	public function index()
	{
		$data['search'] = $this->m_umuser->get_all();  
		
	//Output!
		$this->output('UMS/v_Search',$data);
	}
	

	public function search($data) {
		$this->load->model('UMS/m_umsearch');
		if($strSearch=="Y"){
     $sql="select * from umuser Where ".$Search2." like '%".$Search."%' "; 
     }else{
     $sql="select * from umuser";
     }

     $Qtotal = mysql_query($sql);
		// refresh to index()
		redirect('UMS/search', 'refresh');
	}
	
}