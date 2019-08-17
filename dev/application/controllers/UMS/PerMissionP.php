<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class PerMissionP extends UMS_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('UMS/m_umgroup');
		$this->load->model('UMS/m_umusergroup');
		$this->load->model('UMS/m_umsystem');
		$this->load->model('UMS/m_umpermission');
		$this->load->model('UMS/m_umgpermission');
		$this->load->model('UMS/m_ummenu');
	}
	public function index(){
		//$this->load->view('template/header');
		//$this->load->view('template/topbar');
		//$this->load->view('template/toolbar');
		$this->output('UMS/v_PermissionP');
		//$this->load->view('template/footer');
		
		
	}
	
	public function setGroup($UsID){
		$ID = str_replace("_","/",$UsID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$UsID = $this->encryption->decrypt($ID);
		// Get Group ID to set Permission
		$this->m_umusergroup->UgUsID = $UsID;
		$data['show'] = $this->m_umusergroup->get_group()->result_array();
		$data['UsID'] = $UsID;
		// Get Menu in This System	
		/*foreach($data['show'] as $sys){}
		// Get Permission of Menu in This System
		$this->m_ummenu->MnStID=$sys['GpStID'];
		$data['menu'] = $this->m_ummenu->get_by_key_order()->result_array();
		$this->m_umgpermission->gpGpID = $GpID;
		$data['permission'] = $this->m_umgpermission->get_by_key()->result_array();
		$data['GpID'] = $GpID;*/
		// 	Show Page Set Permission this system	
		$this->output('UMS/v_SelectSystem',$data);
	}
	
	public function setPermission(){
	
		$this->m_umgroup->GpID = $_REQUEST['GpID'];
		$data['show'] = $this->m_umgroup->get_by_key_with_sys()->result_array();
		$this->m_umuser->UsID = $_REQUEST['UsID'];
		$data['name'] = $this->m_umuser->get_by_key()->result_array();
		// Get Permission of Menu in This System
		$this->m_ummenu->MnStID=$_REQUEST['StID'];
		$data['menu'] = $this->m_ummenu->get_by_key_order()->result_array();
		$this->m_umpermission->pmUsID=$_REQUEST['UsID'];
		$data['permission'] = $this->m_umpermission->get_by_key_with_ID()->result_array();
		$data['checkper'] = 1;
		if($data['permission'] == NULL){
			$this->m_umgpermission->gpGpID = $_REQUEST['GpID'];
			$data['permission'] = $this->m_umgpermission->get_by_key()->result_array();
			$data['checkper'] = 2;
		}
		//var_dump($data);
		/*if($data['permission'] != NULL){
			foreach($data['gpermission'] as $gpermission){
				foreach($data['permission'] as $permission){
					if($gpermission['gpMnID'] == $permission['pmMnID']){
						//$gpermission['gpSeq'] == $permission['pmSeq'];
						//$gpermission['gpX'] == $permission['pmX'];
						//$gpermission['gpC'] == $permission['pmC'];
					//	$gpermission['gpR'] == $permission['pmR'];
						//$gpermission['gpU'] == $permission['pmU'];
						//$gpermission['gpD'] == $permission['pmD'];
						
						$data['gpermission']['gpMnID'] = $permission['pmID'];
						$data['gpermission']['gpSeq'] = $permission['gpSeq'];
						$data['gpermission']['gpX'] = $permission['gpX'];
						$data['gpermission']['gpC'] = $permission['gpC'];
						$data['gpermission']['gpR'] = $permission['gpR'];
						$data['gpermission']['gpU'] = $permission['gpU'];
						$data['gpermission']['gpD'] = $permission['gpD'];
						echo $data['gpermission']['gpMnID'];
						echo $data['gpermission']['gpSeq'];
						echo $data['gpermission']['gpX'];
						echo $data['gpermission']['gpC'];
						echo $data['gpermission']['gpR'];
						echo $data['gpermission']['gpU'];
						echo $data['gpermission']['gpD'];
						echo "<br />";
					}
				}
			}
		}*/
		

		$data['GpID'] = $_REQUEST['GpID'];
		$data['UsID'] = $_REQUEST['UsID'];
		// 	Show Page Set Permission this system	
		$this->output('UMS/v_PermissionP',$data);
	}
	
	public function upPer(){	
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

				/* old version modify by golf
				$new[$per['MnID']."x"] = $_POST["hidden".$per['MnID']."x"];
				$new[$per['MnID']."c"] = $_POST["hidden".$per['MnID']."c"];
				$new[$per['MnID']."r"] = $_POST["hidden".$per['MnID']."r"];
				$new[$per['MnID']."u"] = $_POST["hidden".$per['MnID']."u"];
				$new[$per['MnID']."d"] = $_POST["hidden".$per['MnID']."d"];
				*/
				// set value
				
				if($new[$per['MnID']."x"] and $new[$per['MnID']."c"] and $new[$per['MnID']."r"]
				and $new[$per['MnID']."u"] and $new[$per['MnID']."d"] == 1){  // check all
					$this->m_umpermission->pmUsID = $_POST['UsID'];
					$this->m_umpermission->pmMnID = $per['MnID'];
					$gp['per'] = $this->m_umpermission->search_by_key()->result_array();
					if($gp['per']){ // delete data in DB
						$this->m_umpermission->pmUsID = $_POST['UsID'];
						$this->m_umpermission->pmMnID = $per['MnID'];
						$this->m_umpermission->pmSeq = "0";
						$this->m_umpermission->pmX = $new[$per['MnID']."x"];
						$this->m_umpermission->pmC = $new[$per['MnID']."c"];
						$this->m_umpermission->pmR = $new[$per['MnID']."r"];
						$this->m_umpermission->pmU = $new[$per['MnID']."u"];
						$this->m_umpermission->pmD = $new[$per['MnID']."d"];
						$this->m_umpermission->update();
						//$this->m_umpermission->delete();
					}	
					else{ // Insert data in  DB
						$this->m_umpermission->pmUsID = $_POST['UsID'];
						$this->m_umpermission->pmMnID = $per['MnID'];
						$this->m_umpermission->pmSeq = "0";
						$this->m_umpermission->pmX = $new[$per['MnID']."x"];
						$this->m_umpermission->pmC = $new[$per['MnID']."c"];
						$this->m_umpermission->pmR = $new[$per['MnID']."r"];
						$this->m_umpermission->pmU = $new[$per['MnID']."u"];
						$this->m_umpermission->pmD = $new[$per['MnID']."d"];
						$this->m_umpermission->insert();
					}
				} 
				
				if($new[$per['MnID']."x"] != 1 or $new[$per['MnID']."c"] != 1 or $new[$per['MnID']."r"] != 1
				or $new[$per['MnID']."u"] != 1 or $new[$per['MnID']."d"] != 1){ // Not check all
					$this->m_umpermission->pmUsID = $_POST['UsID'];
					$this->m_umpermission->pmMnID = $per['MnID'];
					$gp['per'] = $this->m_umpermission->search_by_key()->result_array();
					if($gp['per']){ // Update data in DB
						$this->m_umpermission->pmUsID = $_POST['UsID'];
						$this->m_umpermission->pmMnID = $per['MnID'];
						$this->m_umpermission->pmSeq = "0";
						$this->m_umpermission->pmX = $new[$per['MnID']."x"];
						$this->m_umpermission->pmC = $new[$per['MnID']."c"];
						$this->m_umpermission->pmR = $new[$per['MnID']."r"];
						$this->m_umpermission->pmU = $new[$per['MnID']."u"];
						$this->m_umpermission->pmD = $new[$per['MnID']."d"];
						$this->m_umpermission->update();
					}
					else{ // Insert data in  DB
						$this->m_umpermission->pmUsID = $_POST['UsID'];
						$this->m_umpermission->pmMnID = $per['MnID'];
						$this->m_umpermission->pmSeq = "0";
						$this->m_umpermission->pmX = $new[$per['MnID']."x"];
						$this->m_umpermission->pmC = $new[$per['MnID']."c"];
						$this->m_umpermission->pmR = $new[$per['MnID']."r"];
						$this->m_umpermission->pmU = $new[$per['MnID']."u"];
						$this->m_umpermission->pmD = $new[$per['MnID']."d"];
						$this->m_umpermission->insert();
					}
				}
				
				// update value 
			
			}
			redirect('UMS/showUser', 'refresh');

	}
	
}
?>
