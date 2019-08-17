<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class ShowLog extends UMS_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UMS/m_umlog','');
	}
	public function index()
	{
		$this->output('UMS/v_showAllLog');
	}
	public function setTime()
	{
		$data['UsName'] = $this->input->post('UsName');
		$data['UsLogin'] = $this->input->post('UsLogin');
		$data['TimeFrom'] = $this->input->post('TimeFrom');
		$data['TimeTo'] = $this->input->post('TimeTo');
		$data['log'] = $this->m_umlog->get_time_between_specific_user($data['TimeFrom'],$data['TimeTo'],$data['UsLogin'],$data['UsName']);
		$this->output('UMS/v_showAllLog_set_time',$data);
	}
} 
?>