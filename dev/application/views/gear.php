<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class Gear extends UMS_Controller{

	public function __construct()
	{ 
		parent::__construct();
		$this->load->model('UMS/m_umuser');
		$this->load->model('UMS/m_umusergroup');
		$this->load->model('UMS/m_umsystem');
		$this->load->model('UMS/m_umlog');
	}
	public function index()
	{// remove old session off this system
		//$this->session->unset_userdata('GpID');
		//$this->session->unset_userdata('StID');
		$this->session->unset_userdata('HOME');
		$this->session->unset_userdata('URL');
		$this->session->unset_userdata('MnID');
		$this->session->unset_userdata('MnURL');
		$this->session->unset_userdata('MnNameT');		
		if($this->checkUser()) 
		{// Have Session data
			$this->session->unset_userdata('StID');
			$data['permission'] = $this->m_umusergroup->get_gear()->result_array();
			$data['system'] = $this->m_umusergroup->get_system()->result_array();
			/*$date = array();
			foreach($data['system'] as $system){
				$data['temp'] = $system['GpIcon'];
				$this->m_umicon->IcName = $data['temp'];
				$temp = $this->m_umicon->get_date_by_name()->result_array();
			}
			}*/
			$data['save'] = explode("?",get_cookie('gear'.$this->session->userdata('UsID')));
			//$data['save'] = explode("?",$this->session->userdata('save')); old version get savedata from session
			/*foreach($data['save'] as $loop)
			{
				echo $loop;
			} for debugging*/ 
			
			$this->output('Gear/Gear',$data);
		}		
		else
		{
			$this->login();
			//redirect('https://'.base_url().'/index.php/gear/login','refresh');
		}
	}
	
	public function login()
	{
		force_ssl();
		// $this->load->view('Gear/login');
		$this->load->view('Gear/extras-login');
	}
	function checklogin()
	{
		$this->load->library('service_ldap');
		// some logic with MD5 to query
		$user = $this->m_umuser->check_login($_POST['username'],md5("O]O".$_POST['password']."O[O"));
		// check it can log in ?
		if(!$user)
		{	$this->service_ldap->connect();
			if($this->service_ldap->authenticate($_POST['username'],$_POST['password']))
			{
				$user = $this->m_umuser->check_user($_POST['username']);
				if(!$user)
				{
					$this->m_umlog->loginfailed();
				}
				else
				{	
					$usr = $user->row_array();
					$this->session->set_userdata('UsID',$usr['UsID']);
					$this->session->set_userdata('UsPsCode',$usr['UsPsCode']);
					$this->session->set_userdata('UsLogin',$usr['UsLogin']);
					$this->session->set_userdata('UsDpID',$usr['UsDpID']);
					$this->m_umlog->login();
				}
			}
			else
			{
			// when log in fail it have 2 case
			// If it has user but password wrong
			
				$user = $this->m_umuser->check_user($_POST['username']);
				if($user)
				{
					foreach ($user->result_array() as $usr)
					{ 
						$this->m_umlog->wrongpass($usr['UsID']);
						break;
					}

				}
				// or It don't have Account
				else
				{	//
					$this->m_umlog->loginfailed();
				}
			}
			$this->service_ldap->close();
		}
		else
		{
		// create a session to log in this main system
			foreach ($user->result_array() as $usr)
			{ 
				$this->session->set_userdata('UsID',$usr['UsID']);
				$this->session->set_userdata('UsPsCode',$usr['UsPsCode']);
				$this->session->set_userdata('UsLogin',$usr['UsLogin']);
				$this->session->set_userdata('UsDpID',$usr['UsDpID']);
				$this->m_umlog->login();
				break;
			}
		}
		redirect('gear', 'refresh');
	}
	function setGear($StID,$GpID,$URL)
	{	
		$ID = str_replace("_","/",$StID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$StID = $this->encrypt->decode($ID);
		$ID = str_replace("_","/",$GpID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$GpID = $this->encrypt->decode($ID);
		$ID = str_replace("_","/",$URL);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$URL = $this->encrypt->decode($ID);
		// remove old session off this system
		//$this->session->unset_userdata('GpID');
		//$this->session->unset_userdata('StID');
		//this->create session to set menu is this user have accessable						try this if want to check session echo $StID and echo $GpID;
		$this->session->set_userdata('GpID',$GpID);
		$this->session->set_userdata('StID',$StID);
		
		// logging 
		$GpName=$this->m_umgroup->get_name($GpID);
		$Sys=$this->m_umsystem->get_sys($StID);
		$URL = str_replace(".","/",$URL);
		
		$this->session->set_userdata('HOME',$URL);
		$this->session->set_userdata('SysName',$Sys['StAbbrE']);
		$this->m_umlog->getgear($GpName,$Sys['StNameT']);
		
		//This use input type hidden to post Link of that System to go to it
		redirect($URL,'refresh'); 
		
	}
	function saveGear()
	{
		/*if($this->session->userdata('save')) for old version get save data from session
		{
			$this->session->unset_userdata('save');
		} 
		$this->session->set_userdata('save',$this->input->post('contents',TRUE));*/
		delete_cookie('gear'.$this->session->userdata('UsID'));
		set_cookie('gear'.$this->session->userdata('UsID'),$this->input->post('contents',TRUE),60*60*24*90);
	}
	function logout()
	{
		$this->m_umlog->logout();
		$this->session->unset_userdata('UsID');
		$this->session->unset_userdata('GpID');
		$this->session->unset_userdata('StID');
		$this->session->unset_userdata('UsPsCode');
		$this->session->unset_userdata('UsLogin');
		redirect('gear','refresh');
		
	}
} 
?>