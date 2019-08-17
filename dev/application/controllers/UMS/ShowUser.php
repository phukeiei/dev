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
		$this->load->model('UMS/da_umloggp');
	}

	public function index() {
	// $this->session->userdata('UsWgID');
		$UsWgID = $this->m_umwgroup->get_by_key_with_wg()->row_array();
		
		if ($UsWgID['WgID']<> 1){
			$data['user'] = $this->m_umuser->get_all_with_dp();
			
		}else {

			$data['user'] = $this->m_umuser->get_all();
		}

			$this->output('UMS/v_showUser',$data);
	}
	
	
	
	function processing_user(){
			
		$aColumns = array('UsID', 'UsName', 'UsLogin', 'dpName','UsWgID');  
		$UsDpID = $this->session->userdata('UsDpID');
		$dpName = $this->session->userdata('dpName');
		// storing  request (ie, get/post) global array to a variable
		$requestData= $_REQUEST;
		/* ชื่อตาราง */
		$table = "umuser";
		
		/* กำหนด primary key ให้กับคอลัมน์ */
		$primaryKey = "UsID";

		$colums=array(
			0 => 'UsID',
			1 => 'UsName',
			2 => 'UsLogin',
			3 => 'dpName',
			4 => ''
		);
		/* 
		 * แบ่งหน้า
		 */
		$sLimit = "";
		if ( isset( $requestData['start'] ) && $requestData['start'] != '-1' ){
			$sLimit = "LIMIT ".$requestData['start'].", ".
				$requestData['length'];
		}
	
		/*
		 * จัดเรียงลำดับ
		 */
		$sOrder = "";
		if ( isset($requestData['order'][0]['column']) ){
			$colum = $requestData['order'][0]['column']; //index colum ที่ใช้ จะเรียงลำดับ
			$sOrder = "ORDER BY  ";
			// for ( $i=0 ; $i<intval( $requestData['draw']) ; $i++ ){
				if ( $requestData['columns']["$colum"]['orderable'] == "true" ){
					$sOrder .= $aColumns[intval( $requestData['columns']["$colum"]['orderable'] )]."
						".$requestData['order'][0]['dir'].", ";
				}
			// }
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" ){
				$sOrder = "";
			}
		}
		
		$sWhere = "";
		if ( isset($requestData['search']['value']) && $requestData['search']['value'] != "" ){
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ ){
				$sWhere .= $aColumns[$i]." LIKE '%".$requestData['search']['value']."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		/* เวลาค้นหาในคอลัมน์  ในส่วนนี้ไม่ได้ใช้*/
		for ( $i=0 ; $i<count($aColumns) ; $i++ ){
			if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' ){
				if ( $sWhere == "" ){
					$sWhere = "WHERE ";
				}else{
					$sWhere .= " AND ";
				}
				$sWhere .= $aColumns[$i]." LIKE '%".$_GET['sSearch_'.$i]."%' ";
			}
		}
		// เพิ่มเงื่อนไขเมื่อไม่ใช่ผู้พัฒนาระบบจะไม่เห็น user ที่เป็นผู้พัฒนาระบบด้วยนะจ๊ะ อิอิอิอิอิ
		$WgID = explode(',',$this->session->userdata('UsWgID'));
		// if($this->ums_DevWgID != $this->session->userdata('UsWgID')){
		if(!in_array($this->session->userdata('UsWgID'),$WgID)){
			if ( $sWhere == "" ){
					$sWhere = "WHERE ";
				}else{
					$sWhere .= " AND ";
				}
			$sWhere .= "UsWgID NOT IN ".$this->$WgID;	
		}
		if($UsDpID>1){
			$sWhere .= " and dpName LIKE '".$dpName."'";
		}
		/*
		 *คำสั่ง SQL ดึงข้อมูลออกมาโชว์
		 * 
		 */
		$rResult = $this->m_umuser->getAllForJSON($sWhere, $sOrder, $sLimit, $aColumns);
		
		/* จำนวนข้อมูลหลังจากค้นหา */
		$getfound = $this->m_umuser->getFound();
		$iFilteredTotal;
		foreach($getfound->result() as $aResultFound){
			$iFilteredTotal=$aResultFound->found;
		}
		
		/*  จำนวนทั้งหมด */
		$rResultTotal = $this->m_umuser->getRowAll($primaryKey,$table);
		$iTotal;
		
		foreach($rResultTotal->result() as $aResultTotal){
			$iTotal=$aResultTotal->countall;
		}
		// echo $iTotal;die;
		/*
		 * ส่วนการแสดงผล*/
		 $output = array(
			"draw" => intval( $requestData['draw'] ),
			"recordsTotal" => $iTotal,
			"recordsFiltered" => $iFilteredTotal,
			"aaData" => array()
		);
		 
		// $aColumns = array( 'id','UsName', 'UsLogin','dpName','');  
		$j=$requestData['start'];
		// $cc = $rResult->result_array();
		
		// print_r($rResult);	
		foreach($rResult->result_array() as $aRow){
					$ID = $this->encryption->encrypt($aRow['UsID']);
					$ID = str_replace("/","_",$ID);
					$ID = str_replace("+",":",$ID);
					$ID = str_replace("=","~",$ID);
											
			$row[0] = "<center>".++$j."</center>";
			$row[1] = $aRow['UsName'];
			$row[2] = $aRow['UsLogin'];
			$row[3] = $aRow['dpName'];
			// $WgID = explode(',',$this->session->userdata('UsWgID'));
			if($this->session->userdata('UsWgID')==1 ||$this->session->userdata('UsWgID')==14){
				$row[4] = "<center>".'<a href="'.base_url().'index.php/UMS/showUser/edit/'.$ID.'"><i class="fa fa-edit tooltips" title="แก้ไขข้อมูล" style="font-size:20px;color:#ecb100"></i></a>'." ".
						'&nbsp;<a href="'.base_url().'index.php/UMS/perMissionP/setGroup/'.$ID.'"><i class="fa fa-list-alt tooltips" title="จัดการเมนู" style="color:green;font-size:20px"></i></a>'." ".
						'&nbsp;<i class="fa fa-times-circle tooltips" title="ลบข้อมูล" style="cursor:pointer;color:red;font-size:20px" onclick="return removeuser('.$aRow['UsID'].',\''.$aRow['UsName'].'\')"></i>'."</center>";
						//'<a href="'.base_url().'index.php/UMS/showUser/remove/'.$aRow['UsID'].'"><img src="'.base_url().'images/icons/color/cross.png "/></a>'."</center>";
			}else{
				$row[4] = "<center>".'<a href="'.base_url().'index.php/UMS/showUser/edit/'.$ID.'"><i class="fa fa-edit tooltips" title="แก้ไขข้อมูล" style="cursor:pointer;font-size:20px;color:#ecb100"></i></a>'." ".
					'&nbsp;<i class="fa fa-times-circle tooltips" title="ลบข้อมูล" style="cursor:pointer;color:red;font-size:20px" onclick="return removeuser('.$aRow['UsID'].',\''.$aRow['UsName'].'\')"></i>'."</center>";
			} 
			
			$output['aaData'][] = $row;
		}
		
		
		echo json_encode($output);
	}
	
	public function showUserAdd(){
	
		$data['user'] = $this->m_umuser->get_all();
		$data['groupname'] = $this->m_umwgroup->get_all();
		$data['question'] = $this->m_umquestion->get_all();
		$data['department'] = $this->m_umdepartment->get_all();
		if($this->session->userdata('UsID')!=1){//ถ้าไม่มีสิทธิ์ admin ของ ums ไม่สามารถเลือกเฟืองของ UMS ได้
			$data['sysname'] = $this->m_umgroup->show_all_not_admin()->result_array();	
		}else{
			$data['sysname'] = $this->m_umgroup->show_all()->result_array();
		}
		$data['persys'] = $this->m_umusergroup->get_perSystem()->result_array();
		$data['field'] = $this->m_umuser->get_by_many_add()->result_array();
		
		
		$this->output('UMS/v_showUserAdd',$data);
	}		
	
	public function add(){
		$this->m_umuser->UsID = "";
		$this->m_umuser->UsPsCode = $this->input->post('UsPsCode');
		$this->m_umuser->UsName = $this->input->post('UsName');
		$this->m_umuser->UsWgID = $this->input->post('UsWgID');
		$this->m_umuser->UsLogin = $this->input->post('UsLogin');
		$this->m_umuser->UsPassword = md5("O]O".$this->input->post('UsPassword')."O[O");
		$this->m_umuser->UsQsID = $this->input->post('UsQsID');
		$this->m_umuser->UsDpID = $this->input->post('UsDpID');
		$this->m_umuser->UsAnswer = $this->input->post('UsAnswer');
		$this->m_umuser->UsEmail = $this->input->post('UsEmail');
		$this->m_umuser->UsDesc = $this->input->post('UsDesc');
		$this->m_umuser->UsActive = $this->input->post('hiddenUsActive');
		$this->m_umuser->UsAdmin = $this->input->post('hiddenUsAdmin');
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
			$data['search'] = $this->m_umgroup->show_all()->result_array();
		//Save History
			$new = $this->m_umuser->get_by_id($field['UsID'])->row_array();
			$sql = "(".$new['UsID'].",".$new['UsName'].",".$new['UsLogin'].",".$new['UsPassword'].",".$new['UsPsCode'].",".$new['UsWgID'].",".$new['UsQsID'].",".$new['UsAnswer'].",".$new['UsEmail'].",".$new['UsActive'].",".$new['UsAdmin'].",".$new['UsDesc'].",".$new['UsPwdExpDt'].",".$new['UsUpdDt'].",".$new['UsUpdDt'].",".$new['UsUpdUsID'].",".$new['UsSessionID'].",".$new['UsDpID'].")";
			$desc = "insert umuser ( UsID , UsName , UsLogin , UsPassword , UsPsCode , UsWgID , UsQsID , UsAnswer , UsEmail , UsActive , UsAdmin , UsDesc , UsPwdExpDt , UsUpdDt , UsUpdDt , UsUpdUsID , UsSessionID , UsDpID )";
			$HtID = $this->m_umhistory->insert("umuser",NULL,$sql,$new['UsID'],$desc);
		// Save Log
			$this->m_umlog->adddata("umuser",$HtID);
			foreach($data['search'] as $search) {
				$this->m_umusergroup->UgUsID = $field['UsID'];
				$this->m_umusergroup->UgGpID = $search['GpID'];
				$data['check'] = $this->m_umusergroup->search_check()->result_array();
				if($_POST["hidden".$search['GpID']] == 1){
					if(!$data['check']){
						$this->m_umusergroup->UgID = 0;
						$this->m_umusergroup->UgGpID = $search['GpID'];
						$this->m_umusergroup->UgUsID = $field['UsID'];
						$this->m_umusergroup->insert();
						// Save History
						$sqlgp = "( 0 , ".$search['GpID']." , ".$field['UsID']." )";
						$desc = "insert umusergroup ( UgID , UgGpID , UgUsID )";
						$HtID = $this->m_umhistory->insert("umusergroup",NULL,$sqlgp,$field['UsID'],$desc);
						// Save Log
						$this->m_umlog->adddata("umusergroup",$HtID);
						// Save Group Log
						$this->da_umloggp->UsID = $field['UsID'];
						$this->da_umloggp->GpID = $search['GpID'];
						$this->da_umloggp->insert();
					}
						
				}
				else{
					if($data['check']){
						// Save History
						$sqlgp = "( 0 , ".$search['GpID']." , ".$field['UsID']." )";
						$desc = "delete umusergroup ( UgID , UgGpID , UgUsID )";
						$HtID = $this->m_umhistory->insert("umusergroup",NULL,$sqlgp,$field['UsID'],$desc);
						// Save Log
						$this->m_umlog->deletedata("umusergroup",$HtID);
						$this->m_umusergroup->UgGpID = $search['GpID'];
						$this->m_umusergroup->UgUsID = $field['UsID'];
						$this->m_umusergroup->delete();
						// Save Group Log
						$this->da_umloggp->UsID = $field['UsID'];
						$this->da_umloggp->GpID = $search['GpID'];
						$this->da_umloggp->update();
						
					}
				}
			}

		$this->ums->trans_commit();
		redirect('UMS/showUser', 'refresh');
		}
	}
	
	
	
	
	public function edit($UsID){
		$ID = str_replace("_","/",$UsID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$UsID = $this->encryption->decrypt($ID);
		
		$data['editshow'] = $this->m_umuser->get_by_id_with_wgroup($UsID)->result_array();
		// $data['wgroup'] = $this->m_umuser->get_by_not_in_WgID($UsID)->result_array();
		
		// if($this->ums_DevWgID == $this->session->userdata('UsWgID')){
		$WgID = explode(',',$this->ums_DevWgID);
		if(in_array($this->session->userdata('UsWgID'),$WgID )){
			$data['wgroup'] = $this->m_umuser->get_all_WgID()->result_array();
		}else{
			$query = $this->m_umuser->get_by_not_in_WgID($this->ums_DevWgID);
			$data['wgroup'] = $query->result_array();
		}
		$data['showques'] = $this->m_umuser->get_by_id_with_question($UsID)->result_array();
		$data['question'] = $this->m_umuser->get_by_not_in_QsID($UsID)->result_array();
		$data['dpment'] = $this->m_umuser->get_by_id_with_department($UsID)->result_array();
		$data['department'] = $this->m_umuser->get_by_not_in_dpID($UsID)->result_array();
		$data['user'] = $this->m_umuser->get_all();
		$data['sysname'] = $this->m_umgroup->show_all()->result_array();
		$data['sysnames'] = $this->m_umgroup->show_all_not_admin()->result_array();
		$UsIDsys = $UsID;
		$this->m_umusergroup->UgUsID = $UsIDsys;
		$data['persys'] = $this->m_umusergroup->get_perSystem()->result_array();
		$data['UsID'] = $UsID;
		// $this->session->userdata('UsWgID');
		
		if($this->session->userdata('GpID') == 550012){ // admin วิทยาลัย
			// if($data['UsWgID'] == 6 && $data['UsWgID'] == 5){
				$data['systemname'] = $this->m_umgroup->get_sysname_NO_UMS()->result_array();
				foreach($data['systemname'] as $key => $val){
					$data['actor'][$val['StID']] = $this->m_umgroup->get_actor_by_sysid_not_UMSadmin($val['StID'])->result_array();
				}
		}else{
			$data['systemname'] = $this->m_umgroup->get_sysname()->result_array();
				foreach($data['systemname'] as $key => $val){
					$data['actor'][$val['StID']] = $this->m_umgroup->get_actor_by_sysid($val['StID'])->result_array();
				}
		}
		
		$UsWgID = $this->m_umwgroup->get_by_key_with_wg()->row_array();
		if($UsWgID['WgID']<> 1 && $UsWgID['WgID']<> 14){ // case NO Administrator and Developers BUU
				$this->output('UMS/v_showUserEdit',$data);
			}else if ($UsWgID['WgID'] == 14){ // case ทีมผู้พัฒนาระบบ ม. บูรพา
				$this->output('UMS/v_showUserEditAdmin',$data);  
			}else{ 
				// echo "IN"; 
				$this->output('UMS/v_showUserEditSuperAdmin',$data);
			}
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
		if($this->input->post('UsDpID')==NUll){ // กรณีที่ select disable
			$this->m_umuser->UsDpID = $old['UsDpID'];
		}else{
			$this->m_umuser->UsDpID = $this->input->post('UsDpID');
		}
		$this->m_umuser->UsAnswer = $this->input->post('UsAnswer');
		$this->m_umuser->UsEmail = $this->input->post('UsEmail');
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
						// Save Group Log
						$this->da_umloggp->UsID = $_POST['UsID'];
						$this->da_umloggp->GpID = $search['GpID'];
						$this->da_umloggp->insert();
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
						// Save Group Log
						$this->da_umloggp->UsID = $_POST['UsID'];
						$this->da_umloggp->GpID = $search['GpID'];
						$this->da_umloggp->update();
					}
				}
			}
			$this->ums->trans_commit();
			redirect('UMS/showUser', 'refresh');
		}
	}
	
	public function submitAdmin(){
		// pre($this->input->post());
	// Save Backup data
		$old = $this->m_umuser->get_by_id($this->input->post('UsID'))->row_array();
		$oldsql = "(".$old['UsID'].",".$old['UsName'].",".$old['UsLogin'].",".$old['UsPassword'].",".$old['UsPsCode'].",".$old['UsWgID'].",".$old['UsQsID'].",".$old['UsAnswer'].",".$old['UsEmail'].",".$old['UsActive'].",".$old['UsAdmin'].",".$old['UsDesc'].",".$old['UsPwdExpDt'].",".$old['UsUpdDt'].",".$old['UsUpdDt'].",".$old['UsUpdUsID'].",".$old['UsSessionID'].",".$old['UsDpID'].")";
	// update data User
		$this->m_umuser->UsID = $this->input->post('UsID');
		$this->m_umuser->UsPsCode = $this->input->post('UsPsCode');
		$this->m_umuser->UsName = $this->input->post('UsName');
		$this->m_umuser->UsWgID = $this->input->post('UsWgID');
		$this->m_umuser->UsLogin = $this->input->post('UsLogin');
	// check update password ------------------------------------------------------------------------------
		if ($this->input->post('UsPassword') == null){$this->m_umuser->UsPassword = $old['UsPassword'];}
			else{$this->m_umuser->UsPassword = md5("O]O".$this->input->post('UsPassword')."O[O");}
	//-----------------------------------------------------------------------------------------------------	
	// update data User	
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
		$this->m_umuser->updateAdmin();
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
						// Save Group Log
						$this->da_umloggp->UsID = $_POST['UsID'];
						$this->da_umloggp->GpID = $search['GpID'];
						$this->da_umloggp->insert();
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
						// Save Group Log
						$this->da_umloggp->UsID = $_POST['UsID'];
						$this->da_umloggp->GpID = $search['GpID'];
						$this->da_umloggp->update();
					}
				}
			}
			$this->ums->trans_commit();
			// die;
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
	
 }
?>
