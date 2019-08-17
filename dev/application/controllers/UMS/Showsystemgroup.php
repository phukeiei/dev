<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('UMS_Controller.php');
class Showsystemgroup extends UMS_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('UMS/m_umuser');
		$this->load->model('UMS/m_umsystem');
		$this->load->model('UMS/m_umpermission');
		$this->load->model('UMS/m_ummenu');
		$this->load->model('UMS/m_umusergroup');
		$this->load->model('UMS/m_umgroup');
		$this->load->model('UMS/m_umwgroup');
		$this->load->model('UMS/m_umquestion');
		$this->load->model('UMS/m_umdepartment');
		$this->load->model('UMS/m_umicon');
		$this->load->model('UMS/m_umtemplate');
		$this->load->model('UMS/m_umgroupdefault');
		$this->load->model('UMS/m_umgpermission');			
	}
	public function index(){
		// show user
		//die;	
		$data['user'] = $this->m_umuser->get_all();
		// Show system
		$data['showsys'] = $this->m_umsystem->get_all();
		$this->m_umicon->IcType= 'system';
		$data['showicon']=$this->m_umicon->get_by_type();
		$this->output('UMS/v_showtwomenu2_2',$data);
	}
	

	public function Showworkgroupadd(){
	// Insert into umgroup
		$this->m_umgroup->GpID = "";
		$this->m_umgroup->GpNameT = $this->input->post('GpNameT');
		$this->m_umgroup->GpNameE = $this->input->post('GpNameE');
		$this->m_umgroup->GpDesc = $this->input->post('GpDesc');
		$this->m_umgroup->GpStID = $this->input->post('GpStID');
		$this->ums->trans_begin();
		$this->m_umgroup->insert();
	// Save History
		if($this->ums->trans_status() === false)
		{
			$this->ums->trans_rollback();
			$this->output('error');
		}
		else
		{
			$sql="";
			$newdata = $this->m_umgroup->get_by_GpNameT($this->input->post('GpNameT'));
			foreach ( $newdata->result_array() as $new)
			{
				if($new['GpStID'] == $this->input->post('GpStID'))
				{
					$sql = "(".$new['GpID'].",".$new['GpNameT'].",".$new['GpNameE'].",".$new['GpDesc'].",".$new['GpStID'].")";
					break;
				}
			}
			$desc = "insert umgroup (GpID, GpNameT, GpNameE, GpDesc, GpStID)";
			$HtID = $this->m_umhistory->insert("umgroup",NULL,$sql,$new['GpID'],$desc);
		// Save Log
			$this->m_umlog->adddata("umgroup",$HtID);
		//commit transaction
			$this->ums->trans_commit();
		// refresh to index()
			redirect('UMS/showtwomenu', 'refresh');
		}
	}
	
	

	
	
		public function add(){
	// Insert New System
		$this->m_umsystem->StNameT = $this->input->post("StNameT");
		$this->m_umsystem->StNameE = $this->input->post("StNameE");
		$this->m_umsystem->StAbbrT = $this->input->post("StAbbrT");
		$this->m_umsystem->StAbbrE = $this->input->post("StAbbrE");
		$this->m_umsystem->StDesc = $this->input->post("StDesc");
		$this->m_umsystem->StURL = $this->input->post("StURL");
		$this->m_umsystem->StIcon = $this->input->post("StIcon");
		$this->ums->trans_begin();
		$this->m_umsystem->insert();
		if($this->ums->trans_status() === false)
		{
			$this->ums->trans_rollback();
			$this->output('error');
		}
		else
		{
			// Save History
				$StID = $this->m_umsystem->last_insert_id;
				$sql="(".$StID.",".$this->input->post("StNameT").",".$this->input->post("StNameE").",".$this->input->post("StAbbrT").",".$this->input->post("StAbbrE").",".$this->input->post("StDesc").",".$this->input->post("StURL").",".$this->input->post("StIcon").")";
				$desc = "insert umsystem (StID, StNameT, StNameE, StAbbrT, StAbbrE, StDesc, StURL, StIcon)";
				$HtID = $this->m_umhistory->insert("umsystem",NULL,$sql,$StID,$desc);
			// Save Log
				$this->m_umlog->adddata("umsystem",$HtID);
			// New Template for System
			/*
				fix Here Ply... check in model field data change
			*/
				$StID = $this->m_umsystem->get_id($this->input->post("StNameT"));
				$this->m_umtemplate->StID = $StID;
				$this->m_umtemplate->add_default();
				$this->ums->trans_commit();
				$this->index();
		}
	}

	
	
		
	
	
	// showsystem
	
	public function showMenu($StID){
		$this->m_ummenu->MnStID = $StID;
		$data['show'] = $this->m_ummenu->get_by_key_with_sys()->result_array();
	// Get Menu in This System	
		if(empty($data['show'])){
		$data['MnStID'] = $this->m_ummenu->MnStID;
		$this->output('UMS/v_showMenuB',$data);
		}
		else{
		foreach($data['show'] as $sys){}
		$this->m_ummenu->MnID = $sys['MnID'];
		$this->m_ummenu->MnStID = $sys['MnStID'];
		$this->m_ummenu->MnNameT = $sys['MnNameT'];
		$this->m_ummenu->MnParentMnID = $sys['MnParentMnID'];
		$this->m_ummenu->MnLevel = $sys['MnLevel'];
		$data['menu1'] = $this->m_ummenu->get_by_key()->result_array();
		$this->output('UMS/v_showMenu',$data);
		}
	}
		public function addMain($MnStID){
		// Update into umgroup
		$this->m_umicon->IcType= 'menu';
		$data['showicon']=$this->m_umicon->get_by_type();
		$data['MnStID']=$MnStID;
		$this->m_ummenu->MnStID = $MnStID;
		$this->m_ummenu->MnParentMnID = 0;
		$this->m_ummenu->MnLevel = 0;
		$data['menu2'] = $this->m_ummenu->get_by_key()->result_array();
	// Show Output!! from same in index()
		$this->output('UMS/v_showMenu_addMain',$data);
	}
	
	public function addMenu($MnID){
		$this->m_umicon->IcType= 'menu';
		$data['showicon']=$this->m_umicon->get_by_type();
		// Update into umgroup
		$this->m_ummenu->MnID = $MnID;
		$data['edit'] = $this->m_ummenu->get_by_key_with_menu()->result_array();
	foreach($data['edit'] as $sys){}
		$this->m_ummenu->MnStID = $sys['MnStID'];
		$this->m_ummenu->MnParentMnID = $sys['MnParentMnID'];
		$this->m_ummenu->MnLevel = $sys['MnLevel'];
		$data['menu2'] = $this->m_ummenu->get_by_key()->result_array();
	
	// Show Output!! from same in index()
		$this->output('UMS/v_showMenu_add',$data);
	}
	
	public function addMenu1(){
		$MnStID = $this->input->post("MnStID");
		$MnNameT = $this->input->post("MnNameT");
		$MnNameE = $this->input->post("MnNameE");
		$MnIcon = $this->input->post("MnIcon");
		if($MnIcon == ''){
			$MnIcon = 'Computer.png';
		}
		$MnURL = $this->input->post("MnURL");
		$MnDesc = $this->input->post("MnDesc");
		$MnParentMnID = $this->input->post("MnParentMnID");
		$MnLevel = $this->input->post("MnLevel");
		
		$this->m_ummenu->MnStID = $this->input->post("MnStID");
		$this->m_ummenu->MnNameT = $this->input->post("MnNameT");
		$this->m_ummenu->MnNameE = $this->input->post("MnNameE");
		$this->m_ummenu->MnIcon = $this->input->post("MnIcon");
		if($this->m_ummenu->MnIcon == ''){
			$this->m_ummenu->MnIcon = 'Computer.png';
		}
		$this->m_ummenu->MnURL = $this->input->post("MnURL");
		$this->m_ummenu->MnDesc = $this->input->post("MnDesc");
		$this->m_ummenu->MnParentMnID = $this->input->post("MnParentMnID");
		$this->m_ummenu->MnLevel = $this->input->post("MnLevel");
		$this->m_ummenu->insert();
	// Save History
		$MnID = $this->m_ummenu->get_MnID($MnNameT,$MnStID);
		$sql="";
		$newdata = $this->m_ummenu->get_menu_url($MnID);
		$sql ="(".$newdata['MnStID'].",".$newdata['MnID'].",".$newdata['MnSeq'].",".$newdata['MnIcon'].",".$newdata['MnNameT'].",".$newdata['MnNameE'].",".$newdata['MnURL'].",".$newdata['MnDesc'].",".$newdata['MnToolbar'].",".$newdata['MnToolbarSeq'].",".$newdata['MnToolbarIcon'].",".$newdata['MnParentMnID'].",".$newdata['MnLevel'].")";
		$desc = "insert ummenu (MnStID, MnID, MnSeq, MnIcon, MnNameT, MnNameE, MnURL, MnDesc, MnToolbar, MnToolbarSeq, MnToolbarIcon, MnParentMnID, MnLevel)";
		$HtID = $this->m_umhistory->insert("ummenu",null,$sql,$MnID,$desc);
	// Save Log
		$this->m_umlog->deletedata("ummenu",$HtID);
	// redirect
		redirect('UMS/showSystem/showMenu/'.$MnStID, 'refresh');
	}
	
	public function saveSeq(){
		$Seq = $_POST['Seq'];
		$MnStID=$_POST['MnStID'];
		$i=1;
		foreach( $Seq as $v ) {
		$this->m_ummenu->MnID=$v;
		$this->m_ummenu->MnSeq=$i;
		$this->m_ummenu->updateSeq();
		$i++;
		}
		// Save Log & history
		$desc = "update ummenu sequence";
		$this->m_umhistory->insert("ummenu",null,null,$MnStID,$desc);
		redirect('UMS/showSystem/showMenu/'.$MnStID, 'refresh');
	}
	

	
}
?>