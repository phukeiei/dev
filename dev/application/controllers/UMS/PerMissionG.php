<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class PerMissionG extends UMS_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('UMS/m_umgroup');
		$this->load->model('UMS/m_umsystem');
		$this->load->model('UMS/m_umgpermission');
		$this->load->model('UMS/m_ummenu');
	}
	public function index(){
		$this->load->view('template/header');
		$this->load->view('template/topbar');
		$this->load->view('template/toolbar');
		$this->load->view('UMS/v_PermissionG');
		$this->load->view('template/footer');
		
		
	}
	
	public function testcss(){
		$this->load->view("UMS/testcss");
	}
	
	public function test(){
		//echo $_POST['test'];
		print_r($_POST);
	}
	
	public function setPermission($GpID){
		// echo $GpID."<br>";
		$ID = str_replace("_","/",$GpID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$GpID = $this->encryption->decrypt($ID);
		// Get Group ID to set Permission
		$this->m_umgroup->GpID = $GpID;
		$data['show'] = $this->m_umgroup->get_by_key_with_sys()->result_array();
		// Get Menu in This System	
		// print_r($data['show']);
		foreach($data['show'] as $sys){};
		// Get Permission of Menu in This System
		// echo $sys['GpStID'];
		$this->m_ummenu->MnStID=$sys['GpStID'];
		
		$data['menu'] = $this->m_ummenu->get_by_key_order()->result_array();
		$this->m_umgpermission->gpGpID = $GpID;
		$data['permission'] = $this->m_umgpermission->get_by_key()->result_array();
		$data['GpID'] = $GpID;
		// 	Show Page Set Permission this system	
		$this->output('UMS/v_PermissionG',$data);
	}
	
	public function upPer(){	
			// counter something change or not ?
			// pre($this->input->post());
			// die;
			$change=0;
			$this->m_ummenu->MnStID = $_POST['MnStID'];
			foreach($this->m_ummenu->get_by_key_order()->result_array() as $per){
				$new[$per['MnID']."x"] = 0;
				$new[$per['MnID']."c"] = 0;
				$new[$per['MnID']."r"] = 0;
				$new[$per['MnID']."u"] = 0;
				$new[$per['MnID']."d"] = 0;
				$xcrud_control = $_POST["hidden".$per['MnID']."control"];
				$new[$per['MnID']."x"] = $xcrud_control[0];//$_POST["hidden".$per['MnID']."x"];
				$new[$per['MnID']."c"] = $xcrud_control[1];//$_POST["hidden".$per['MnID']."c"];
				$new[$per['MnID']."r"] = $xcrud_control[2];//$_POST["hidden".$per['MnID']."r"];
				$new[$per['MnID']."u"] = $xcrud_control[3];//$_POST["hidden".$per['MnID']."u"];
				$new[$per['MnID']."d"] = $xcrud_control[4];//$_POST["hidden".$per['MnID']."d"];

				if($new[$per['MnID']."x"] and $new[$per['MnID']."c"] and $new[$per['MnID']."r"]
				and $new[$per['MnID']."u"] and $new[$per['MnID']."d"] == 1){  // check all
					$this->m_umgpermission->gpGpID = $_POST['GpID'];
					$this->m_umgpermission->gpMnID = $per['MnID'];
					$gp = $this->m_umgpermission->search_by_key()->result_array();
					
					if($gp){ // delete data in DB
					//save history and backup
						$oldsql="";
						foreach($gp as $gp)
						{
							$oldsql= "(".$gp['gpGpID'].",".$gp['gpMnID'].",".$gp['gpSeq'].",".$gp['gpX'].",".$gp['gpC'].",".$gp['gpR'].",".$gp['gpU'].",".$gp['gpD'].")";
							break;
						}
						$desc = "delete umgpermission (gpGpID, gpMnID, gpSeq, gpX, gpC, gpR, gpU, gpD)";
						$HtID = $this->m_umhistory->insert("umgpermission",$oldsql,NULL,$gp['gpGpID'],$desc);
					//save log
						$change=1;
					// delete
						$this->m_umgpermission->gpGpID = $_POST['GpID'];
						$this->m_umgpermission->gpMnID = $per['MnID'];
						$this->m_umgpermission->delete();
					}	
				} 
				
				if($new[$per['MnID']."x"] != 1 or $new[$per['MnID']."c"] != 1 or $new[$per['MnID']."r"] != 1
				or $new[$per['MnID']."u"] != 1 or $new[$per['MnID']."d"] != 1){ // Not check all
					$this->m_umgpermission->gpGpID = $_POST['GpID'];
					$this->m_umgpermission->gpMnID = $per['MnID'];
					$gp = $this->m_umgpermission->search_by_key()->result_array();

					if($gp){ // find in database
					//save backup
						//save history and backup
						$oldsql="";
						foreach($gp as $gp)
						{
							$oldsql= "(".$gp['gpGpID'].",".$gp['gpMnID'].",".$gp['gpSeq'].",".$gp['gpX'].",".$gp['gpC'].",".$gp['gpR'].",".$gp['gpU'].",".$gp['gpD'].")";
							break;
						}
						
					//update permission
						$this->m_umgpermission->gpGpID = $_POST['GpID'];
						$this->m_umgpermission->gpMnID = $per['MnID'];
						$this->m_umgpermission->gpSeq = "0";
						$this->m_umgpermission->gpX = $new[$per['MnID']."x"];
						$this->m_umgpermission->gpC = $new[$per['MnID']."c"];
						$this->m_umgpermission->gpR = $new[$per['MnID']."r"];
						$this->m_umgpermission->gpU = $new[$per['MnID']."u"];
						$this->m_umgpermission->gpD = $new[$per['MnID']."d"];
						$this->m_umgpermission->update();
					//save history
						$sql="";
						$newdata = $this->m_umgpermission->search_by_key()->result_array();
						foreach( $newdata as $gp)
						{
							$sql = "(".$gp['gpGpID'].",".$gp['gpMnID'].",".$gp['gpSeq'].",".$gp['gpX'].",".$gp['gpC'].",".$gp['gpR'].",".$gp['gpU'].",".$gp['gpD'].")";
							break;
						}
						$desc = "update umgpermission (gpGpID, gpMnID, gpSeq, gpX, gpC, gpR, gpU, gpD)";
						$HtID = $this->m_umhistory->insert("umgpermission",$oldsql,$sql,$gp['gpGpID'],$desc);
					
					//save log
						$change=1;
					
					}
					else{ // Not find in database
						$this->m_umgpermission->gpGpID = $_POST['GpID'];
						$this->m_umgpermission->gpMnID = $per['MnID'];
						$this->m_umgpermission->gpSeq = "0";
						$this->m_umgpermission->gpX = $new[$per['MnID']."x"];
						$this->m_umgpermission->gpC = $new[$per['MnID']."c"];
						$this->m_umgpermission->gpR = $new[$per['MnID']."r"];
						$this->m_umgpermission->gpU = $new[$per['MnID']."u"];
						$this->m_umgpermission->gpD = $new[$per['MnID']."d"];
						$this->m_umgpermission->insert();
					//save history
						$sql="";
						$newdata = $this->m_umgpermission->search_by_key()->result_array();
						foreach( $newdata as $gp)
						{
							$sql = "(".$gp['gpGpID'].",".$gp['gpMnID'].",".$gp['gpSeq'].",".$gp['gpX'].",".$gp['gpC'].",".$gp['gpR'].",".$gp['gpU'].",".$gp['gpD'].")";
							break;
						}
						$desc = "insert umgpermission (gpGpID, gpMnID, gpSeq, gpX, gpC, gpR, gpU, gpD)";
						$HtID = $this->m_umhistory->insert("umgpermission",NULL,$sql,$gp['gpGpID'],$desc);
					
					//save log
						$change=1;
					}
				}
				// update value 

			}

			if($change) // save log
			{
				$this->m_umlog->changepermission($_POST['GpID']);
			}
			
			redirect('UMS/showWorkGroup', 'refresh');


	}
	
}
?>