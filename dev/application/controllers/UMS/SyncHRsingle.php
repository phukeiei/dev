<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('UMS_Controller.php');
// last edited : 26/03/2557 22:05
class SyncHRsingle extends UMS_Controller{
// this version add user one by one
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
		$this->load->library('email');
		$this->load->library('pdf');

	}
	public function index(){
		$data['user'] = $this->m_umuser->get_all();
		if($this->session->userdata('UsID')!=1){
			$data['syncfile'] = $this->da_umsync->get_sync_by_UsID($this->session->userdata('UsID'));
		}else{
			$data['syncfile'] = $this->da_umsync->get_all_sync();
		}
		$this->output('UMS/v_syncHRsingle',$data);
	}
	public function search_single(){
		$this->da_umsync->UsDpID = $this->session->userdata('UsDpID');
		$this->da_umsync->HRDB = $this->da_umsync->HRDB.$this->session->userdata('UsDpID');
		$FirstName = $this->input->post('first');
		$LastName = $this->input->post('last');
		// echo $FirstName;die;
		$r = $this->da_umsync->sync_single($FirstName,$LastName);
		$groupname = $this->m_umwgroup->get_all();
		header ('Content-type: text/html; charset=utf-8');

		foreach($r->result_array() as $row){
			echo "<tr>";
			echo "<td><input name='UsPsCode[]' type='hidden' value='".$row['personId']."' />
				<input name='UsMajorTypeID[]' type='hidden' value='".$row['majortypeId']."' />
				<input name='UsDpID[]' type='hidden' value='".$row['dpId']."' />
				<input name='UsName[]' type='text' value='".$row['name']."' readonly /></td>";
			echo "<td><input name='UsEmail[]' type='text' value='".$row['emailAddr']."' /></td>";
			echo "<td><input name='UsLogin[]' class='user' type='text' value='".strtolower($row['fName2'].substr($row['lName2'],0,1))."' /><input class='check' type='button' value='validate user' onclick='valid(this)'/></td>";
			echo "<td><input class='delete' type='button' onclick='delete_row(this)' value='delete' /></td>";
			echo "</tr>";
		}

	}
	public function search(){
		$this->da_umsync->UsDpID = $this->session->userdata('UsDpID');
		$this->da_umsync->HRDB = $this->da_umsync->HRDB.$this->session->userdata('UsDpID');
		$r = $this->da_umsync->sync();
		$groupname = $this->m_umwgroup->get_all();
		header ('Content-type: text/html; charset=utf-8');

		foreach($r->result_array() as $row){
			echo "<tr>";
			echo "<td><input name='UsPsCode[]' type='hidden' value='".$row['personId']."' />
				<input name='UsMajorTypeID[]' type='hidden' value='".$row['majortypeId']."' />
				<input name='UsDpID[]' type='hidden' value='".$row['dpId']."' />
				<input name='UsName[]' type='text' value='".$row['name']."' readonly /></td>";
			echo "<td><input name='UsEmail[]' type='text' value='".$row['emailAddr']."' /></td>";
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
		//init pdf header

		$pdf_no=1;
		$pdf_header = "<h1>Transfer User Information From HR</h1><br />";
		$pdf_thead = "<table border='1'><tr><td>No.</td><td>FirstName LastName</td><td>Username</td><td>Password</td><td>E-Mail</td></tr>";
		$pdf_endtable ="</table>";
		$pdf_content ="";
		//Default User
		$DefaultSyncWgID = 10; // WgID from umwgroup table
		$DefaultSyncDpID = $this->session->userdata('UsDpID');  // DpID from umdepartment table
		$TeacherSyncWgID = 5; // for teacher
		$UsPsCode = $this->input->post('UsPsCode');
		$UsName = $this->input->post('UsName');
		$UsEmail = $this->input->post('UsEmail');
		$UsLogin = $this->input->post('UsLogin');
		$UsMajorTypeID =  $this->input->post('UsMajorTypeID');
		$UsDpID = $this->input->post('UsDpID');
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
			if($UsMajorTypeID[$key] == 1){
				$this->m_umuser->UsWgID = $TeacherSyncWgID;
			}else{
				$this->m_umuser->UsWgID = $DefaultSyncWgID;
			}
			$this->m_umuser->UsLogin = $UsLogin[$key];
			$this->m_umuser->UsPassword = md5("O]O".$UsLogin[$key]."O[O");
			$this->m_umuser->UsQsID = 1;
			if($UsDpID[$key]!=0){
				$this->m_umuser->UsDpID = $DefaultSyncDpID;
			}else{
				$this->m_umuser->UsDpID = $DefaultSyncDpID;
			}
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
				$data['search'] = $this->m_umgroupdefault->get_by_default($this->m_umuser->UsWgID)->result_array();
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
			// send e mail show username and password of user
			// username & password can change if user want to change
			//
			/*
			*	edit here!!!! gif
			*/
			$pdf_content .= "<tr><td>".$pdf_no++."</td><td>".$new['UsName']."</td><td>".$new['UsLogin']."</td><td>".$UsLogin[$key]."</td><td>".$new['UsEmail']."</td></tr>";

		}
		if($pdf_no > 1){
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetCreator(PDF_CREATOR);
				// Add a page
			$pdf->AddPage();
			$html = "<h1>Test Page</h1>";
			$pdf->writeHTML($pdf_header.$pdf_thead.$pdf_content.$pdf_endtable);
			$filename = "sync".date("Ymdhi");
			ob_clean();
			$pdf->Output('/var/www/uploads/ums/umspdf/'.$filename.'.pdf','F');
			$this->da_umsync->insert($filename);
		}
		redirect('UMS/showUser', 'refresh');
	}

	public function filedownload($filename){
		$path = "/var/www/uploads/ums/umspdf/".$filename.".pdf";
		// echo $path;

		header('Content-Description: File Transfer');
		header('Content-type: application/pdf');
		header('Content-Disposition: attachment; filename='.basename($file));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($path));
		ob_clean();
		flush();
		readfile($path);
		exit;
	}

	public function test_pdf(){
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
			// Add a page
		$pdf->AddPage();
		$html = "<h1>Test Page</h1>";
		$pdf->writeHTML($html, true, false, true, false, '');
		$filename = "sync".date("Ymdhi");
		ob_clean();
		$pdf->Output('/var/www/uploads/ums/umspdf/'.$filename.'.pdf','F');
		}
}
?>
