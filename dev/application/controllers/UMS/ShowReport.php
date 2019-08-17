<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class ShowReport extends UMS_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UMS/m_umlog','');
		$this->load->model("UMS/m_umuser");
		$this->load->model("UMS/m_umsystem");
		$this->load->model("UMS/m_umloggp");

	}
	public function index()
	{
		$data['log'] = $this->m_umlog->get_by_ID();
		$this->output('UMS/v_showMyLog',$data);
	}
	public function setTime()
	{
		$data['TimeFrom'] = $this->input->post('TimeFrom');
		$data['TimeTo'] = $this->input->post('TimeTo');
		$data['log'] = $this->m_umlog->get_time_between($data['TimeFrom'],$data['TimeTo']);
		$this->output('UMS/v_showMyLog_set_time',$data);
	}
	
	public function reportUser(){
		$data['count'] = $this->m_umlog->get_count()->result_array();
		foreach($data['count'] as $count){
			$data['many'] = $count['many'];
		}
		$data['system'] = $this->m_umsystem->get_sys_count()->result_array();
		/*foreach($data['system'] as $system){
			echo $system['StNameT']."  ".$system['num']."<br />";
		}*/
		$this->output('UMS/v_reportUser',$data);
	}
	
	public function reportSystem($StID){
		$this->m_umsystem->StID = $StID;
		$data['system'] = $this->m_umsystem->get_group_system()->result_array();
		$data['sysname'] = $this->m_umsystem->get_by_key_sys()->result_array();
		foreach($data['system'] as $sysname){
			$systemname = $sysname['StNameT'];
		}
		$c = strlen($systemname);
		$lengthsystem = 0;
		for ($i = 0; $i < $c; ++$i){
			if ((ord($systemname[$i]) & 0xC0) != 0x80){
            ++$lengthsystem;
			}
      }
		$data['length'] = $lengthsystem;
		$data['lengthstr'] = strlen($systemname);
		$data['log'] = $this->m_umlog->get_log_action_report($systemname)->result_array();
		$data['systemname'] = $systemname;
		
		$this->output('UMS/v_reportSystem',$data);
	}
	
	public function reportByGroup($UgGpID,$StID){
		$this->m_umsystem->StID = $StID;
		$this->m_umsystem->UgGpID = $UgGpID;
		$data['system'] = $this->m_umsystem->get_group_system()->result_array();
		$data['sysname'] = $this->m_umsystem->get_by_key_sys()->result_array();
		$data['sysGname'] =  $this->m_umsystem->get_by_key_sysGname()->result_array();
		foreach($data['system'] as $sysname){
			$systemname = $sysname['StNameT'];
		}
		$c = strlen($systemname);
		$lengthsystem = 0;
		for ($i = 0; $i < $c; ++$i){
			if ((ord($systemname[$i]) & 0xC0) != 0x80){
            ++$lengthsystem;
			}
      }
		$data['length'] = $lengthsystem;
		$data['lengthstr'] = strlen($systemname);
		$data['log'] = $this->m_umlog->get_log_action_report($systemname)->result_array();
		$data['systemname'] = $systemname;
		$data['UgGpID'] = $UgGpID;
		
		$data['showgroup'] = $this->m_umuser->get_report_by_system($UgGpID)->result_array();
		
		$this->output('UMS/v_reportGroup1',$data);
	}
	
	//public function reportGroup1($UgGpID){
	//	$this->m_umuser->GpID = $UgGpID;
	//	$data['group'] = $this->m_umuser->get_report_by_system()->result_array();
	//	$this->output('UMS/v_reportGroup',$data);
	//}
	
	public function reportEditpermission(){
		$data['log'] = $this->m_umloggp->get_loggp_all()->result_array();
		$this->output('UMS/v_showEditReportPermission',$data);
		/*foreach($data['log'] as $log){
			if($log['UsName'] && $log['StNameT'] && $log['GpNameT'] != NULL){ 
				echo $log['UsName']."/".$log['StNameT']."/".$log['GpNameT']."/".$log['status']."/"."<br />";
			}
		}*/

	}
} 
?>