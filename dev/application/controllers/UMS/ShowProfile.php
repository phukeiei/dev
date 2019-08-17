<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class ShowProfile extends UMS_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('UMS/m_umshowprofile');
		$this->load->model('UMS/m_umuser');
		
	}
	public function index(){
		

		$data['user'] = $this->m_umuser->get_by_id($this->session->userdata('UsID'));
		$data['usergroup'] = $this->m_umshowprofile->get_by_group($this->session->userdata('UsID'));
		$this->output('UMS/v_showProfile',$data);
	}
	
}
?>
