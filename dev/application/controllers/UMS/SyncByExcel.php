<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('UMS_Controller.php');
// last edited : 04/10/2014 edit syncHR for syncSTD
class SyncByExcel extends UMS_Controller{
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
	
		// echo $this->config->item('uploads_dir'); 
		// echo $this->session->userdata('UsDpID');
		// $data['user'] = $this->m_umuser->get_all();
		// $data['syncfile'] = $this->da_umsync->get_all_sync();
		$data['headingsArray'] ="";
		$this->output('UMS/v_syncByExcel',$data);
	}

	public function ImportFile(){
		
		$files = $_FILES['DataExcel'];
		// print_r($files);die;
		// echo $files['name']."<br>";
		// echo $files['type']."<br>";
		// echo $files['tmp_name']."<br>";
		if($files['type']=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $files['type']=="application/vnd.ms-excel"){
		// if($files['type']=="application/vnd.ms-excel"){
			// echo "True<br>";
			/** PHPExcel */
			include ("plugins/PHPExcel/Classes/PHPExcel.php");
			// include ("plugins/PHPExcel/excel_reader.php");

			/** PHPExcel_IOFactory - Reader */
			include ("plugins/PHPExcel/Classes/PHPExcel/IOFactory.php");

			// $uploads_dir = '/var/www/uploads/iserl';
			$uploads_dir  = $this->config->item('uploads_dir')."umsExcel";
			// move_uploaded_file($_FILES['name']['tmp_name'],"".$uploads_dir."/".$filename."");
			$error = $_FILES["DataExcel"]["error"];
			// echo $error;
				if ($error == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["DataExcel"]["tmp_name"];
					$name = $_FILES["DataExcel"]["name"];
					move_uploaded_file($tmp_name, "$uploads_dir/$name");
				}else{
					echo "Can't Upload";
				}
			$filename = $uploads_dir."/".$_FILES["DataExcel"]["name"];
			$inputFileName = $filename;
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objReader->setReadDataOnly(true);
			$objPHPExcel = $objReader->load($inputFileName);

			$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
			$highestRow = $objWorksheet->getHighestRow();
			$highestColumn = $objWorksheet->getHighestColumn();

			// ---อ่านแถวและคอลัมภ์ที่เป็นหัวตาราง ใช้หัวตารางเป็น Index
			$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
			// echo "<pre>";
			// print_r($headingsArray);
			// echo "</pre>";
			// $headingsArray = $headingsArray[1];
			// print_r($headingsArray);die;
			// echo $highestRow."<br>".$highestColumn;
			$namedDataArray = array();
			$firstRowImport= 2;
			for ($row = $firstRowImport; $row <= $highestRow; ++$row) {
				$dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
				$namedDataArray[$row] = $dataRow[$row];
				// echo "<pre>";
					// print_r($dataRow);
				// echo "</pre>";
			}
			$data['namedDataArray'] = $namedDataArray;
			$data['firstRowImport']=$firstRowImport;
			$data['highestRow']=$highestRow;
			$data['headingsArray'] = $headingsArray;
			
			$data['rs_dp'] = $this->m_umdepartment->show_all()->result();
			// print_r($data['namedDataArray']);
			// print_r($data['rs_dp']);
			// die;
			// echo "</pre>";
			// $this->output('v_ALS_reviewExcelSTU',$this->data);
			$this->output('UMS/v_syncByExcel',$data);
			 // }
		}else{
			// echo "False";
			$data = "";
			$this->output('UMS/v_syncByExcel',$data);
		}
	}

	public function InsertDataFromExcel(){
		pre($this->input->post());
		die;
		$UsLogIn = $this->input->post('UsLogIn');
		$UsName = $this->input->post('UsName');
		$UsEmail = $this->input->post('UsEmail');
		$UsStatus = $this->input->post('UsStatus');
		$UsDpID = $this->input->post('UsDpID');
		// $countData = count($UsLogIn);
		// echo "<pre>";
		// print_r($UsLogIn);
		// print_r($UsName);
		// print_r($UsEmail);
		// print_r($UsStatus);
		// print_r($UsDpID);
		// echo "</pre>";
		//init pdf header
		$pdf_no=1;
		$pdf_header = "<h1>Transfer User Information From REG</h1><br />";
		$pdf_thead = "<table border='1'><tr><td>No.</td><td>FirstName  LastName</td><td>Username</td><td>Password</td><td>E-Mail</td></tr>";
		$pdf_endtable ="</table>";
		$pdf_content ="";
		//Default User
		$DefaultSyncWgID = 15; // WgID from umwgroup table
		// $DefaultSyncDpID = 1;  // DpID from umdepartment table
		// $DefaultSyncDpID = $this->session->userdata('UsDpID');  // DpID from session UsDpID
		// $DefaultSyncDpID = $this->session->userdata('UsDpID');  // DpID from session UsDpID
		//$TeacherSyncWgID = 5; // for teacher
		$UsLogIn = $this->input->post('UsLogIn');
		$UsName = $this->input->post('UsName');
		$UsEmail = $this->input->post('UsEmail');
		// $UsLogin = $this->input->post('UsLogin');
		//$UsMajorTypeID =  $this->input->post('UsMajorTypeID');
		// $UsDpID = $this->input->post('UsDpID');
		/*foreach( $UsPsCode as $key => $PsCode){
			echo "key: ".$key;
			echo " PsCode ".$PsCode;
			echo " Name ".$UsName[$key];
			echo " Email ".$UsEmail[$key];
			echo " Login ".$UsLogin[$key];
			echo "<br />";

		}*/
		foreach( $UsLogIn as $key => $PsCode){
			$this->m_umuser->UsID = "";
			$this->m_umuser->UsPsCode = $PsCode;
			$this->m_umuser->UsName = $UsName[$key];
			$this->m_umuser->UsWgID = $DefaultSyncWgID;
			$this->m_umuser->UsLogin = $UsLogIn[$key];
			$this->m_umuser->UsPassword = md5("O]O".$UsLogIn[$key]."O[O");
			$this->m_umuser->UsQsID = 1;
			$this->m_umuser->UsDpID = $DefaultSyncDpID;
			$this->m_umuser->UsAnswer = "answer";
			$this->m_umuser->UsEmail = $UsEmail[$key];
			$this->m_umuser->UsDesc = "Sync Form Excel";
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
			$pdf_content .= "<tr><td>".$pdf_no++."</td><td>".$new['UsName']."</td><td>".$new['UsLogin']."</td><td>".$UsLogIn[$key]."</td><td>".$new['UsEmail']."</td></tr>";

		}
		if($pdf_no > 1){
		//	$this->mpdf->useAdobeCJK = true;
		//	$this->mpdf->autoLangToFont =true;
		//	$this->mpdf->WriteHTML($pdf_header.$pdf_thead.$pdf_content.$pdf_endtable);
		// $filename = "sync".date("Ymdhi");
		// $this->mpdf->Output('/var/www/uploads/ums/umspdf/'.$filename.'.pdf','F');

			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetCreator(PDF_CREATOR);
				// Add a page
			$pdf->AddPage();
			$pdf->writeHTML($pdf_header.$pdf_thead.$pdf_content.$pdf_endtable);
			$filename = "sync".date("Ymdhi");
			ob_clean();
			$pdf->Output('/var/www/uploads/sem/umspdf/'.$filename.'.pdf','F');
			$this->da_umsync->insert($filename);
		}
		redirect('UMS/showUser', 'refresh');


	}
}
?>
