<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class ShowSystem extends UMS_Controller {

	public function __construct(){
		//call parent::__construct() for use $this->load
		parent::__construct();
		$this->load->model('UMS/m_umsystem');
		$this->load->model('UMS/m_ummenu');
		$this->load->model('UMS/m_umicon');
		$this->load->model('UMS/m_umtemplate');
		$this->load->model('UMS/m_umgroup');
		$this->load->model('UMS/m_umgroupdefault');
		$this->load->model('UMS/m_umgpermission');
		$this->load->model('UMS/m_umpermission');
	}
	

		public function index(){
		$data['OK'] = 0;
	// Show system
		$data['showsys'] = $this->m_umsystem->get_all();
		$this->m_umicon->IcType= 'system';
		$data['showicon']=$this->m_umicon->get_by_type();
	//Output!
		$this->output('UMS/v_showSystem',$data);
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
		$uniq = $this->m_umsystem->get_unique()->row_array();
		if($uniq <> NULL)
		{
		$data['OK'] = 2;
			$this->ums->trans_rollback();
		}
		else
		{
				$this->m_umsystem->insert();
				$data['OK'] = 1;
				// Save History
				$StID = $this->m_umsystem->last_insert_id;
				$sql="(".$StID.",".$this->input->post("StNameT").",".$this->input->post("StNameE").",".$this->input->post("StAbbrT").",".$this->input->post("StAbbrE").",".$this->input->post("StDesc").",".$this->input->post("StURL").",".$this->input->post("StIcon").")";
				$desc = "insert umsystem (StID, StNameT, StNameE, StAbbrT, StAbbrE, StDesc, StURL, StIcon)";
				$HtID = $this->m_umhistory->insert("umsystem",NULL,$sql,$StID,$desc);
			// Save Log
				$this->m_umlog->adddata("umsystem",$HtID);
			// New Template for System
				$StID = $this->m_umsystem->get_id($this->input->post("StNameT"));
				$this->m_umtemplate->StID = $StID;
				$this->m_umtemplate->add_default();
				$this->ums->trans_commit();
				
		}
				$data['showsys'] = $this->m_umsystem->get_all();
				$this->m_umicon->IcType= 'system';
				$data['showicon']=$this->m_umicon->get_by_type();
				//Output!
				$this->output('UMS/v_showSystem',$data);
	}
	
	public function edit($StID){
		$ID = str_replace("_","/",$StID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$StID = $this->encryption->decrypt($ID);
	// Update into umgroup
		$this->m_umicon->IcType= 'system';
		$data['showicon']=$this->m_umicon->get_by_type();
		$this->m_umsystem->StID = $StID;
		$data['StID'] = $StID;
		$data['edit'] = $this->m_umsystem->get_by_key_sys()->result_array();
	// Show All WorkGroup in This System
		$data['showsys'] = $this->m_umsystem->show_all();  
	// Show Option in Insert Form
		$data['opt'] = $this->m_umsystem->get_all();
	// Show Output!! from same in index()
		$data['OK']= 0;
		$this->output('UMS/v_showSystem_edit',$data);
	}
	
	public function update($StID){
		$ID = str_replace("_","/",$StID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$StID = $this->encryption->decrypt($ID);
	// Save Backup Data
		$oldsql="";
		$olddata = $this->m_umsystem->get_by_id($StID);
		foreach( $olddata->result_array() as $old)
		{
			$oldsql ="(".$old['StID'].",".$old['StNameT'].",".$old['StNameE'].",".$old['StAbbrT'].",".$old['StAbbrE'].",".$old['StDesc'].",".$old['StURL'].",".$old['StIcon'].")";
			break;
		}
	// update umsystem
		$this->m_umsystem->StID = $StID;
		$this->m_umsystem->StNameT = $this->input->post('StNameT');
		$this->m_umsystem->StNameE = $this->input->post('StNameE');
		$this->m_umsystem->StAbbrT = $this->input->post('StAbbrT');
		$this->m_umsystem->StAbbrE = $this->input->post('StAbbrE');
		$this->m_umsystem->StDesc = $this->input->post('StDesc');
		$this->m_umsystem->StURL = $this->input->post('StURL');
		$this->m_umsystem->StIcon = $this->input->post('StIcon');
		$this->ums->trans_begin();
		$uniq = $this->m_umsystem->get_unique_with_ID()->result_array();
		if($uniq <> NULL )
		{
			$data['OK'] = 2;
			$this->ums->trans_rollback();
			// Update into umgroup
			$this->m_umicon->IcType= 'system';
			
		}
		else
		{
			$data['OK']= 1;
				$this->m_umsystem->update();
			// Save History
				$sql=""; 
				$newdata = $this->m_umsystem->get_by_id($StID);
				foreach( $newdata->result_array() as $new)
				{
					$sql ="(".$new['StID'].",".$new['StNameT'].",".$new['StNameE'].",".$new['StAbbrT'].",".$new['StAbbrE'].",".$new['StDesc'].",".$new['StURL'].",".$new['StIcon'].")";
					break;		
				}
				$desc = "update umsystem (StID, StNameT, StNameE, StAbbrT, StAbbrE, StDesc, StURL, StIcon)";
				$HtID = $this->m_umhistory->insert("umsystem",$oldsql,$sql,$new['StID'],$desc);
			//Save Log
				$this->m_umlog->updatedata("umsystem",$HtID);
			//commit transaction
				$this->ums->trans_commit();
			
		
		}
		$data['showsys'] = $this->m_umsystem->get_all();
				$this->m_umicon->IcType= 'system';
				$data['showicon']=$this->m_umicon->get_by_type();
				//Output!
				$this->output('UMS/v_showSystem',$data);
	}
	
	public function remove($StID){
		//$ID = str_replace("_","/",$StID);
		//$ID = str_replace(":","+",$ID);
		//$ID = str_replace("~","=",$ID);
		//$StID = $this->encryption->decrypt($ID);
	$this->ums->trans_begin();
	// Save Backup Data
		$oldsql="";
		$olddata = $this->m_umsystem->get_by_id($StID);
		foreach( $olddata->result_array() as $old)
		{
			$oldsql ="(".$old['StID'].",".$old['StNameT'].",".$old['StNameE'].",".$old['StAbbrT'].",".$old['StAbbrE'].",".$old['StDesc'].",".$old['StURL'].",".$old['StIcon'].")";
			break;
		}
		$desc = "delete umsystem (StID, StNameT, StNameE, StAbbrT, StAbbrE, StDesc, StURL, StIcon)";
		$HtID = $this->m_umhistory->insert("umsystem",$oldsql,NULL,$old['StID'],$desc);
	// Save Log
		$this->m_umlog->deletedata("umgroup",$HtID);
	
	// Remove from template
		$this->m_umtemplate->StID=$StID;
		$this->m_umtemplate->delete();
	
	// Remove menu by group
		$this->m_umsystem->StID= $StID;
		$this->m_umsystem->delete_in_gpermission();
		$this->m_umsystem->StID= $StID;
		$this->m_umsystem->delete_in_groupdefault();
	// Remove by menu
		$this->m_umsystem->StID= $StID;
		$this->m_umsystem->delete_in_permission();
		
	// Remove by system	
		$this->m_ummenu->MnStID=$StID;
		$this->m_ummenu->deleteBySystem();
		$this->m_umgroup->GpStID=$StID;
		$this->m_umgroup->delete_by_GpStID();
	// Remove from umsystem
		$this->m_umsystem->StID=$StID;
		$this->m_umsystem->delete();
		if($this->ums->trans_status() === false)
		{
			$this->ums->trans_rollback();
			$this->output('error');
		}
		else
		{
			$this->ums->trans_commit();
		
			// refresh to index()
				redirect('UMS/showSystem', 'refresh');
		}
	}
	
	public function showMenu($StID){
		$ID = str_replace("_","/",$StID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$StID = $this->encryption->decrypt($ID);
	
		$data['OK']=0;
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
		$ID = str_replace("_","/",$MnStID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$MnStID = $this->encryption->decrypt($ID);
	
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
		$ID = str_replace("_","/",$MnID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$MnID = $this->encryption->decrypt($ID);
	
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
		$this->ums->trans_begin();
		$uniq = $this->m_ummenu->get_uniq()->row_array();
		if($uniq <> NULL)
		{
			$this->ums->trans_rollback();
			$data['OK'] = 2;
		}
		else
		{
			$data['OK'] = 1;
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
			//commit transaction
				$this->ums->trans_commit();
			
		}
		$this->m_ummenu->MnStID = $MnStID;
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
	
	public function editMenu($MnID,$MnStID){
		$ID = str_replace("_","/",$MnStID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$MnStID = $this->encryption->decrypt($ID);
	
		$ID = str_replace("_","/",$MnID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$MnID = $this->encryption->decrypt($ID);
	
	// Update into umgroup
		$this->m_umicon->IcType= 'menu';
		$data['showicon']=$this->m_umicon->get_by_type();
		$this->m_ummenu->MnID = $MnID;
		$data['edit'] = $this->m_ummenu->get_by_key_with_menu()->result_array();
	foreach($data['edit'] as $sys){}
		$this->m_ummenu->MnStID = $sys['MnStID'];
		$this->m_ummenu->MnID = $sys['MnID'];
		$this->m_ummenu->MnSeq = $sys['MnSeq'];
		$this->m_ummenu->MnIcon = $sys['MnIcon'];
		$this->m_ummenu->MnNameT = $sys['MnNameT'];
		$this->m_ummenu->MnNameE = $sys['MnNameE'];
		$this->m_ummenu->MnURL = $sys['MnURL'];
		$this->m_ummenu->MnDesc = $sys['MnDesc'];
		$this->m_ummenu->MnToolbar = $sys['MnToolbar'];
		$this->m_ummenu->MnToolbarSeq = $sys['MnToolbarSeq'];
		$this->m_ummenu->MnToolbarIcon = $sys['MnToolbarIcon'];
		$this->m_ummenu->MnParentMnID = $sys['MnParentMnID'];
		$this->m_ummenu->MnLevel = $sys['MnLevel'];
		$data['menu2'] = $this->m_ummenu->get_by_key()->result_array();
	// Show Output!! from same in index()
		$this->output('UMS/v_showMenu_edit',$data);
	}
	
	public function updateMenu($MnID,$MnStID){
		$ID = str_replace("_","/",$MnStID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$MnStID = $this->encryption->decrypt($ID);
	
		$ID = str_replace("_","/",$MnID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$MnID = $this->encryption->decrypt($ID);
	
		
	// Save History
		$oldsql="";
		$olddata = $this->m_ummenu->get_menu_url($MnID);
		$oldsql ="(".$olddata['MnStID'].",".$olddata['MnID'].",".$olddata['MnSeq'].",".$olddata['MnIcon'].",".$olddata['MnNameT'].",".$olddata['MnNameE'].",".$olddata['MnURL'].",".$olddata['MnDesc'].",".$olddata['MnToolbar'].",".$olddata['MnToolbarSeq'].",".$olddata['MnToolbarIcon'].",".$olddata['MnParentMnID'].",".$olddata['MnLevel'].")";
		
	// update umsystem
		$this->m_ummenu->MnID = $MnID;
		$this->m_ummenu->MnStID = $this->input->post('MnStID');
		$this->m_ummenu->MnSeq = $this->input->post('MnSeq');
		$this->m_ummenu->MnIcon = $this->input->post('MnIcon');
		if($this->m_ummenu->MnIcon == ''){
			$this->m_ummenu->MnIcon = 'Computer.png';
		}
		$this->m_ummenu->MnNameT = $this->input->post('MnNameT');
		$this->m_ummenu->MnNameE = $this->input->post('MnNameE');
		$this->m_ummenu->MnURL = $this->input->post('MnURL');
		$this->m_ummenu->MnDesc = $this->input->post('MnDesc');
		$this->m_ummenu->MnToolbar = $this->input->post('MnToolbar');
		$this->m_ummenu->MnToolbarSeq = $this->input->post('MnToolbarSeq');
		$this->m_ummenu->MnToolbarIcon = $this->input->post('MnToolbarIcon');
		$this->m_ummenu->MnParentMnID = $this->input->post('MnParentMnID');
		$this->m_ummenu->MnLevel = $this->input->post('MnLevel');
		$this->ums->trans_begin();
		$uniq = $this->m_ummenu->get_uniq_with_MnID()->result_array();
		
		if($uniq <> NULL)
		{
			$this->ums->trans_rollback();
			$data['OK'] = 2;
		}
		else
		{
			$data['OK'] = 1;
				$this->m_ummenu->update();
			// Save History
				$sql="";
				$newdata = $this->m_ummenu->get_menu_url($MnID);
				$sql ="(".$newdata['MnStID'].",".$newdata['MnID'].",".$newdata['MnSeq'].",".$newdata['MnIcon'].",".$newdata['MnNameT'].",".$newdata['MnNameE'].",".$newdata['MnURL'].",".$newdata['MnDesc'].",".$newdata['MnToolbar'].",".$newdata['MnToolbarSeq'].",".$newdata['MnToolbarIcon'].",".$newdata['MnParentMnID'].",".$newdata['MnLevel'].")";
				$desc = "update ummenu (MnStID, MnID, MnSeq, MnIcon, MnNameT, MnNameE, MnURL, MnDesc, MnToolbar, MnToolbarSeq, MnToolbarIcon, MnParentMnID, MnLevel)";
				$HtID = $this->m_umhistory->insert("ummenu",$oldsql,$sql,$newdata['MnID'],$desc);
			// Save Log
				$this->m_umlog->deletedata("ummenu",$HtID);
			//commit transaction
				$this->ums->trans_commit();
		}
		$this->m_ummenu->MnStID = $MnStID;
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
	
	public function removemenu($MnID){
	
	
		$this->ums->trans_begin();
	// Save History
		$oldsql="";
		$olddata = $this->m_ummenu->get_menu_url($MnID);
		$oldsql ="(".$olddata['MnStID'].",".$olddata['MnID'].",".$olddata['MnSeq'].",".$olddata['MnIcon'].",".$olddata['MnNameT'].",".$olddata['MnNameE'].",".$olddata['MnURL'].",".$olddata['MnDesc'].",".$olddata['MnToolbar'].",".$olddata['MnToolbarSeq'].",".$olddata['MnToolbarIcon'].",".$olddata['MnParentMnID'].",".$olddata['MnLevel'].")";
		$desc = "delete ummenu (MnStID, MnID, MnSeq, MnIcon, MnNameT, MnNameE, MnURL, MnDesc, MnToolbar, MnToolbarSeq, MnToolbarIcon, MnParentMnID, MnLevel)";
		$HtID = $this->m_umhistory->insert("ummenu",$oldsql,NULL,$olddata['MnID'],$desc);
	// Save Log
		$this->m_umlog->deletedata("ummenu",$HtID);
	// Remove into umsystem
		$this->m_ummenu->MnID = $MnID;
		$data['show'] = $this->m_ummenu->get_by_key_with_menu()->result_array();
		foreach($data['show'] as $sys){}
		$this->m_ummenu->MnStID = $sys['MnStID'];
		$this->m_ummenu->MnID=$MnID;
		$this->m_ummenu->delete();
		if($this->ums->trans_status() === false)
		{
			$this->ums->trans_rollback();
			$this->output('error');
		}
		else
		{
			$this->ums->trans_commit();
			$MnStID = $this->encryption->encrypt($sys['MnStID']);
				$ID = str_replace("/","_",$MnStID);
				$ID = str_replace("+",":",$ID);
				$MnStID = str_replace("=","~",$ID);
			// refresh to index()
			redirect('UMS/showSystem/showMenu/'.$MnStID, 'refresh');
		}
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
