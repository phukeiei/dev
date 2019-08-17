<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('UMS_Controller.php');
class ShowUser extends UMS_Controller{

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
		$this->load->model('UMS/da_umsync');
		$this->load->model('UMS/m_umgroupdefault');
	}
	public function index(){
		$data['user'] = $this->m_umuser->get_all();
		$this->output('UMS/v_showUser',$data);
	}
	

	public function showUserAdd(){
		$data['user'] = $this->m_umuser->get_all();
		$this->output('UMS/v_syncHR',$data);
	}
	public function search(){
		$r = $this->da_umsync->sync();
		$groupname = $this->m_umwgroup->get_all();
		header ('Content-type: text/html; charset=utf-8');
		
		foreach($r->result_array() as $row){
			echo "<tr>";
			echo "<td><input name='UsPsCode[]' type='hidden' value='".$row['personId']."' />
				<input name='UsName[]' type='text' value='".$row['name']."' readonly /></td>";
			echo "<td><input name='UsEmail[]' type='text' value='".$row['emailAddr']."' readonly /></td>";
			echo "<td><input name='UsLogin[]' class='user' type='text' value='".strtolower($row['fName2'].substr($row['lName2'],0,1))."' /><input class='check' type='button' value='validate user' onclick='valid(this)'/></td>";
			echo "<td><input class='delete' type='button' onclick='delete_row(this)' value='delete' /></td>";
			echo "</tr>";
		}

	}
	public function check_username($user){
		$is_empty = $this->da_umsync->check_username($user);
		header ('Content-type: text/html; charset=utf-8');
		echo $is_empty;
	}
	public function syncing(){
		//Default User
		$DefaultSyncWgID = 10; // WgID from umwgroup table
		$DefaultSyncDpID = 0;  // DpID from umdepartment table
		$UsPsCode = $this->input->post('UsPsCode');
		$UsName = $this->input->post('UsName');
		$UsEmail = $this->input->post('UsEmail');
		$UsLogin = $this->input->post('UsLogin');
		/*foreach( $UsPsCode as $key => $PsCode){
			echo "key: ".$key;
			echo " PsCode ".$PsCode;
			echo " Name ".$UsName[$key];
			echo " Email ".$UsEmail[$key];
			echo " Login ".$UsLogin[$key];
			echo "<br />";
			
		}*/
		foreach( $UsPsCode as $key => $PsCode){
			$this->m_umuser->UsID = "";
			$this->m_umuser->UsPsCode = $PsCode;
			$this->m_umuser->UsName = $UsName[$key];
			$this->m_umuser->UsWgID = $DefaultSyncWgID;
			$this->m_umuser->UsLogin = $UsLogin[$key];
			$this->m_umuser->UsPassword = md5("O]O".$UsLogin[$key]."O[O");
			$this->m_umuser->UsQsID = 1;
			$this->m_umuser->UsDpID = $DefaultSyncDpID;
			$this->m_umuser->UsAnswer = "answer";
			$this->m_umuser->UsEmail = $UsEmail[$key];
			$this->m_umuser->UsDesc = "Sync Form HR";
			$this->m_umuser->UsActive = 1;
			$this->m_umuser->UsAdmin = 0;
			$this->m_umuser->UsPwdExpDt = 0;
			$this->m_umuser->UsUpdDt = 0;
			$this->m_umuser->UsUpdUsID = 0;
			$this->m_umuser->UsSessionID = 0;
			
			$this->ums->trans_begin();
			$this->m_umuser->insert();
			if($this->ums->trans_status() === false)
			{
				$this->ums->trans_rollback();
				$this->output('error');
			}
			else
			{
				$field = $this->m_umuser->get_by_many_add()->row_array();
				$data['search'] = $this->m_umgroupdefault->get_by_default($DefaultSyncWgID)->result_array();
			//Save History
				$new = $this->m_umuser->get_by_id($field['UsID'])->row_array();
				$sql = "(".$new['UsID'].",".$new['UsName'].",".$new['UsLogin'].",".$new['UsPassword'].",".$new['UsPsCode'].",".$new['UsWgID'].",".$new['UsQsID'].",".$new['UsAnswer'].",".$new['UsEmail'].",".$new['UsActive'].",".$new['UsAdmin'].",".$new['UsDesc'].",".$new['UsPwdExpDt'].",".$new['UsUpdDt'].",".$new['UsUpdDt'].",".$new['UsUpdUsID'].",".$new['UsSessionID'].",".$new['UsDpID'].")";
				$desc = "insert umuser ( UsID , UsName , UsLogin , UsPassword , UsPsCode , UsWgID , UsQsID , UsAnswer , UsEmail , UsActive , UsAdmin , UsDesc , UsPwdExpDt , UsUpdDt , UsUpdDt , UsUpdUsID , UsSessionID , UsDpID )";
				$HtID = $this->m_umhistory->insert("umuser",NULL,$sql,$new['UsID'],$desc);
			// Save Log
				$this->m_umlog->adddata("umuser",$HtID);
				
				foreach($data['search'] as $search) {
					$this->m_umusergroup->UgUsID = $field['UsID'];
					$this->m_umusergroup->UgGpID = $search['GdGpID'];
					$this->m_umusergroup->UgID = 1;
					$this->m_umusergroup->UgGpID = $search['GdGpID'];
					$this->m_umusergroup->UgUsID = $field['UsID'];
					$this->m_umusergroup->insert();
					// Save History
					$sqlgp = "( 0 , ".$search['GdGpID']." , ".$field['UsID']." )";
					$desc = "insert umusergroup ( UgID , UgGpID , UgUsID )";
					$HtID = $this->m_umhistory->insert("umusergroup",NULL,$sqlgp,$field['UsID'],$desc);
					// Save Log
					$this->m_umlog->adddata("umusergroup",$HtID);
				}
	
				

				$this->ums->trans_commit();
				
			}
		}
		redirect('UMS/showUser', 'refresh');
	}
	
	
	
	
	public function edit($UsID){

		$data['editshow'] = $this->m_umuser->get_by_id_with_wgroup($UsID)->result_array();
		$data['wgroup'] = $this->m_umuser->get_by_not_in_WgID($UsID)->result_array();
		$data['showques'] = $this->m_umuser->get_by_id_with_question($UsID)->result_array();
		$data['question'] = $this->m_umuser->get_by_not_in_QsID($UsID)->result_array();
		$data['dpment'] = $this->m_umuser->get_by_id_with_department($UsID)->result_array();
		$data['department'] = $this->m_umuser->get_by_not_in_dpID($UsID)->result_array();
		$data['user'] = $this->m_umuser->get_all();
		$data['sysname'] = $this->m_umgroup->show_all()->result_array();
		$UsIDsys = $UsID;
		$this->m_umusergroup->UgUsID = $UsIDsys;
		$data['persys'] = $this->m_umusergroup->get_perSystem()->result_array();
		$data['UsID'] = $UsID;
		$this->output('UMS/v_showUserEdit',$data);
		
	}
	
	
	
		
	public function submit(){
	// Save Backup data
		$old = $this->m_umuser->get_by_id($this->input->post('UsID'))->row_array();
		$oldsql = "(".$old['UsID'].",".$old['UsName'].",".$old['UsLogin'].",".$old['UsPassword'].",".$old['UsPsCode'].",".$old['UsWgID'].",".$old['UsQsID'].",".$old['UsAnswer'].",".$old['UsEmail'].",".$old['UsActive'].",".$old['UsAdmin'].",".$old['UsDesc'].",".$old['UsPwdExpDt'].",".$old['UsUpdDt'].",".$old['UsUpdDt'].",".$old['UsUpdUsID'].",".$old['UsSessionID'].",".$old['UsDpID'].")";
	// update User
		$this->m_umuser->UsID = $this->input->post('UsID');
		$this->m_umuser->UsPsCode = $this->input->post('UsPsCode');
		$this->m_umuser->UsName = $this->input->post('UsName');
		$this->m_umuser->UsWgID = $this->input->post('UsWgID');
		$this->m_umuser->UsLogin = $this->input->post('UsLogin');
		$this->m_umuser->UsQsID = $this->input->post('UsQsID');
		$this->m_umuser->UsDpID = $this->input->post('UsDpID');
		$this->m_umuser->UsAnswer = $this->input->post('UsAnswer');
		$this->m_umuser->UsEmail = $this->input->post('UsEmail');
		$this->m_umuser->UsDpID = $this->input->post('UsDpID');
		$this->m_umuser->UsDesc = $this->input->post('UsDesc');
		$this->m_umuser->UsActive = $this->input->post('hiddenUsActive');
		$this->m_umuser->UsAdmin = $this->input->post('hiddenUsAdmin');
		
		$this->m_umuser->UsPwdExpDt = 0;
		$this->m_umuser->UsUpdDt = 0;
		$this->m_umuser->UsUpdUsID = 0;
		$this->m_umuser->UsSessionID = 0;
		
		$this->ums->trans_begin();
		$this->m_umuser->update();
		if($this->ums->trans_status() === false)
		{
			$this->ums->trans_rollback();
			$this->output('error');
		}
		else
		{
		// Save History
			$new = $this->m_umuser->get_by_id($this->input->post('UsID'))->row_array();
			$sql = "(".$new['UsID'].",".$new['UsName'].",".$new['UsLogin'].",".$new['UsPassword'].",".$new['UsPsCode'].",".$new['UsWgID'].",".$new['UsQsID'].",".$new['UsAnswer'].",".$new['UsEmail'].",".$new['UsActive'].",".$new['UsAdmin'].",".$new['UsDesc'].",".$new['UsPwdExpDt'].",".$new['UsUpdDt'].",".$new['UsUpdDt'].",".$new['UsUpdUsID'].",".$new['UsSessionID'].",".$new['UsDpID'].")";
			$desc = "update umuser ( UsID , UsName , UsLogin , UsPassword , UsPsCode , UsWgID , UsQsID , UsAnswer , UsEmail , UsActive , UsAdmin , UsDesc , UsPwdExpDt , UsUpdDt , UsUpdDt , UsUpdUsID , UsSessionID , UsDpID )";
			//$HtID = $this->m_umhistory->insert("umuser",$oldsql,$sql,$new['UsID'],$desc);
		// Save Log
			//$this->m_umlog->updatedata("umuser",$HtID);
		
			$this->m_umgroup->UgUsID = $_POST['UsID'];
			$data['search'] = $this->m_umgroup->show_all()->result_array();
				foreach($data['search'] as $search){
					$this->m_umusergroup->UgUsID = $_POST['UsID'];
					$this->m_umusergroup->UgGpID = $search['GpID'];
					$data['check'] = $this->m_umusergroup->search_check()->result_array();
					
				if($_POST["hidden".$search['GpID']] == 1){
					if(!$data['check']){
						$this->m_umusergroup->UgID = 0;
						$this->m_umusergroup->UgGpID = $search['GpID'];
						$this->m_umusergroup->UgUsID = $_POST['UsID'];
						//echo $_POST["hidden".$search['GpID']]."it insert".$search['GpNameT']."<br />";
						$this->m_umusergroup->insert();
					// Save History
						$sqlgp = "( 0 , ".$search['GpID']." , ".$_POST['UsID']." )";
						$desc = "insert umusergroup ( UgID , UgGpID , UgUsID )";
						$HtID = $this->m_umhistory->insert("umusergroup",NULL,$sqlgp,$_POST['UsID'],$desc);
						// Save Log
						$this->m_umlog->adddata("umusergroup",$HtID);
					}
					
				}
				else{
					if($data['check']){
					// Save History
						$sqlgp = "( 0 , ".$search['GpID']." , ".$_POST['UsID']." )";
						$desc = "delete umusergroup ( UgID , UgGpID , UgUsID )";
						//echo $_POST["hidden".$search['GpID']]."it delete".$search['GpNameT'].$search['GpID']."<br />";
						$HtID = $this->m_umhistory->insert("umusergroup",$sqlgp,NULL,$_POST['UsID'],$desc);
						// Save Log
						$this->m_umlog->deletedata("umusergroup",$HtID);
						
						$this->m_umusergroup->UgGpID = $search['GpID'];
						$this->m_umusergroup->UgUsID = $_POST['UsID'];
						$this->m_umusergroup->delete();
					}
				}
			}
			$this->ums->trans_commit();
			redirect('UMS/showUser', 'refresh');
		}
	}
	
	public function remove($UsID){
		// Save Backup data
		$old = $this->m_umuser->get_by_id($UsID)->row_array();
		$oldsql = "(".$old['UsID'].",".$old['UsName'].",".$old['UsLogin'].",".$old['UsPassword'].",".$old['UsPsCode'].",".$old['UsWgID'].",".$old['UsQsID'].",".$old['UsAnswer'].",".$old['UsEmail'].",".$old['UsActive'].",".$old['UsAdmin'].",".$old['UsDesc'].",".$old['UsPwdExpDt'].",".$old['UsUpdDt'].",".$old['UsUpdDt'].",".$old['UsUpdUsID'].",".$old['UsSessionID'].",".$old['UsDpID'].")";
		$desc = "delete umuser ( UsID , UsName , UsLogin , UsPassword , UsPsCode , UsWgID , UsQsID , UsAnswer , UsEmail , UsActive , UsAdmin , UsDesc , UsPwdExpDt , UsUpdDt , UsUpdDt , UsUpdUsID , UsSessionID , UsDpID )";
		$HtID = $this->m_umhistory->insert("umuser",$oldsql,NULL,$old['UsID'],$desc);
		// Save Log
		$this->m_umlog->deletedata("umuser",$HtID);
		$this->m_umuser->UsID=$UsID;
		$this->m_umuser->delete();
		
		$this->m_umusergroup->UgUsID=$UsID;
		$this->ums->trans_begin();
		$this->m_umusergroup->delete();
		if($this->ums->trans_status() === false)
		{
			$this->ums->trans_rollback();
			$this->output('error');
		}
		else
		{
			redirect('UMS/showUser', 'refresh');
		}
	}
	
	public function test(){
	
		echo $this->input->post('UsPsCode'); 		echo "<br />";
		echo $this->input->post('UsName'); 		echo "<br />";
		echo $this->input->post('UsWgID');		echo "<br />";
		echo $this->input->post('UsLogin');		echo "<br />";
		echo md5("O]O".$this->input->post('UsPassword')."O[O");		echo "<br />";
		echo md5("O]O".$this->input->post('UsPassword')."O[O");		echo "<br />";
		echo $this->input->post('UsQsID');		echo "<br />";
		echo $this->input->post('UsAnswer');		echo "<br />";
		echo $this->input->post('UsEmail');		echo "<br />";
		echo $this->input->post('UsDesc');		echo "<br />";
		
		
	}
	
	
	
	public function test1(){
		echo $_POST['hiddenUsActive'];
		echo "<br />";
		echo $_POST['hiddenUsAdmin']; 		echo "<br />";
		echo $this->input->post('UsPsCode'); 		echo "<br />";
		echo $this->input->post('UsName'); 		echo "<br />";
		echo $this->input->post('UsWgID');		echo "<br />";
		echo $this->input->post('UsLogin');		echo "<br />";
		echo md5("O]O".$this->input->post('UsPassword')."O[O");		echo "<br />";
		echo md5("O]O".$this->input->post('UsPassword')."O[O");		echo "<br />";
		echo $this->input->post('UsQsID');		echo "<br />";
		echo $this->input->post('UsAnswer');		echo "<br />";
		echo $this->input->post('UsEmail');		echo "<br />";
		echo $this->input->post('UsDesc');		echo "<br />";
		echo $this->input->post('UsActive');		echo "<br />";
		echo $this->input->post('UsAdmin');
		echo "<br />";
		echo "_______________________";
		echo "New Page"; echo "<br />";
		$data['system'] = $this->m_umgroup->show_all()->result_array();
		foreach($data['system'] as $sys){
			echo $_POST["hidden".$sys['GpID']];
			echo "<br />";
		}
	}
	

	
}
?>