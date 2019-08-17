<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class configSystem extends UMS_Controller {

	public function __construct(){
		//call parent::__construct() for use $this->load
		parent::__construct();
		$this->load->model('UMS/m_umsystem');
		$this->load->model('UMS/m_umgroup');
		$this->load->model('UMS/m_umusergroup');
		$this->load->model('UMS/m_umicon');
		$this->load->model('UMS/m_umtemplate');
	}
	

	public function index(){
	// Show system
		$data['showsys'] = $this->m_umsystem->get_all_join_icon();
		
	//Output!
		$this->output('UMS/v_configSystem',$data);
	}
	public function Edit($StID){
		$ID = str_replace("_","/",$StID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$StID = $this->encryption->decrypt($ID);
		$data['StID'] = $StID;
		$this->m_umtemplate->StID = $StID;
		$data['tem'] = $this->m_umtemplate->get_by_key_sys_join_icon()->row_array();
		$this->output('UMS/v_configSystem_Edit',$data);
	}
	public function EditHead($StID){
		$ID = str_replace("_","/",$StID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$StID = $this->encryption->decrypt($ID);
		$this->m_umicon->IcType= 'header';
		$data['icon']=$this->m_umicon->get_by_type()->result_array();
		$this->m_umtemplate->StID = $StID;
		$data['StID'] = $StID;
		$data['tem'] = $this->m_umtemplate->get_by_key_sys_join_icon()->row_array();
		if($data['tem']==null){
		$this->m_umtemplate->add_default();
		}
		$data['tem'] = $this->m_umtemplate->get_by_key_sys_join_icon()->row_array();
		$this->output('UMS/v_configSystem_EditHead',$data);
	}
	public function EditGear($StID){
		$ID = str_replace("_","/",$StID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$StID = $this->encryption->decrypt($ID);
		$this->m_umgroup->GpStID = $StID;
		$this->m_umicon->IcType= 'gear';
		
		$data['icon']=$this->m_umicon->get_by_type()->result_array();
		$data['permission']=$this->m_umgroup->get_by_key_with_sys_join_icon()->result_array();
		$this->output('UMS/v_configSystem_EditGear',$data);
	}
	public function updateGear($GpStID){
		$GpID = $this->input->post('GpID');
		$ID = str_replace("_","/",$GpID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$GpID = $this->encryption->decrypt($ID);
		$ID = str_replace("_","/",$GpStID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$GpStID = $this->encryption->decrypt($ID);
		$this->m_umgroup->GpID = $GpID;
		$this->m_umgroup->GpIcon = $this->input->post('Icon');
		$this->m_umgroup->updateGear();
		$ID = $this->encryption->encrypt($GpStID);
		$ID = str_replace("/","_",$ID);
		$ID = str_replace("+",":",$ID);
		$ID = str_replace("=","~",$ID);
		redirect('UMS/configSystem/EditGear/'.$ID, 'refresh');
	}

	public function updateHead($StID){
		$ID = str_replace("_","/",$StID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$StID = $this->encryption->decrypt($ID);
		$this->m_umtemplate->StID = $StID;
		$this->m_umtemplate->HeadIcon = $this->input->post('HeadIcon');
		$this->m_umtemplate->HeightHeadTop = $this->input->post('HeightHeadTop');
		$this->m_umtemplate->MarginHeadTop = $this->input->post('MarginHeadTop');
		$this->m_umtemplate->ColorHeadTop = $this->input->post('ColorHeadTop');
		$this->m_umtemplate->ColorHeadBottom = $this->input->post('ColorHeadBottom');
		$this->m_umtemplate->ColorTopButton = $this->input->post('ColorTopButton');
		$this->m_umtemplate->ColorBottomButton = $this->input->post('ColorBottomButton');
		$this->m_umtemplate->updateHead();
		$ID = $this->encryption->encrypt($StID);
		$ID = str_replace("/","_",$ID);
		$ID = str_replace("+",":",$ID);
		$ID = str_replace("=","~",$ID);
		redirect('UMS/configSystem/EditHead/'.$ID, 'refresh');
	}
	public function SetDefault($StID){
		$ID = str_replace("_","/",$StID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$StID = $this->encryption->decrypt($ID);
		$this->m_umtemplate->StID = $StID;
		$this->m_umtemplate->delete();
		$this->m_umtemplate->set_to_default();
		$this->m_umtemplate->StID = $StID;
		$this->m_umtemplate->edit_StID();
		$ID = $this->encryption->encrypt($StID);
		$ID = str_replace("/","_",$ID);
		$ID = str_replace("+",":",$ID);
		$ID = str_replace("=","~",$ID);
		redirect('UMS/configSystem/EditHead/'.$ID, 'refresh');
	}

}
?>
