<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class CopySystemmenu extends UMS_Controller {
	
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
		$this->load->model('UMS/m_umusergroup');
		$this->load->model('UMS/m_umdepartment');
		$this->load->model('UMS/m_umcopymenu');
	}
	
	
	public function index(){
		$data['OK'] = 0;
	// Show system
		$data['showsys'] = $this->m_umsystem->get_all();
		$this->m_umicon->IcType= 'system';
		$data['showicon']=$this->m_umicon->get_by_type();
	//Output!
	// echo json_encode($data);
	// die;
		$this->output('UMS/Copymenu/v_showCopySystem',$data);
	}
	
	
	public function showCopyMenu($StID){
		//echo $StID ; die;
		$st = $StID;
		$ID = str_replace("_","/",$StID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$StID = $this->encryption->decrypt($ID);

		$data['OK']=0;
		$this->m_ummenu->MnStID = $StID;
		$data['show'] = $this->m_ummenu->get_by_key_with_sys()->result_array();
		$data['menu1'] = $this->m_umcopymenu->get_all_copy($st)->result_array();
		$data['rs_site'] = $this->m_umcopymenu->get_dpnotin()->result();
		// echo json_encode($data['rs_site']);
		// die;
		/////////////////TESTSAS/////////////////////
		/*echo "<pre>";
		print_r($data['menu1']);die;*/
		//echo $this->m_ummenu->get_all_copy($st);die;
		$this->output('UMS/Copymenu/v_showCopyMenu',$data);
		//}
	}

	public function test_import_another(){
		// echo "test_import_another.<br>";
		
		$MnID = $this->input->post('stid');
		$siteto = $this->input->post('site-to');
		$sy_id = $this->input->post('sy_id');
		foreach($MnID as $key=>$val){
			// echo $val."<br>";
			
			$menu1[$key] = $this->m_ummenu->get_by_key_copy($val)->row_array();
		}
		
		$sys_bf = $this->m_umsystem->get_sys2($sy_id);
		$rs = $sys_bf->row();
		$chk_sys = $this->m_umcopymenu->checkSystem($siteto,$sy_id);
		// echo $this->m_umcopymenu->ums->last_query()."<br>";
		// checkSystem 
		   if ($chk_sys->num_rows() == 0) {
			   echo "INSERT Systems <BR>";
			 
			  $this->m_umcopymenu->StID = $rs->StID;
			  $this->m_umcopymenu->StNameT = $rs->StNameT;
			  $this->m_umcopymenu->StNameE = $rs->StNameE;
			  $this->m_umcopymenu->StAbbrT = $rs->StAbbrT;
			  $this->m_umcopymenu->StAbbrE = $rs->StAbbrE;
			  $this->m_umcopymenu->StDesc  = $rs->StDesc;
			  $this->m_umcopymenu->StURL   = $rs->StURL;
			  $this->m_umcopymenu->StIcon  = $rs->StIcon;
			  $this->m_umcopymenu->insert_system($siteto);
			  // $SystemId = $this->m_umcopymenu->last_insert_id;
			   $SystemId = $sy_id;
		   }else{
				$SystemId = $sy_id;
				
		   }
		 // end 
		// echo "*******************************************************<br>";
		
		 // echo json_encode($menu1);
		 foreach($menu1 as $main ){
			// $chk_sysmn = $this->m_umcopymenu->checkSystemMenu($siteto,$SystemId,$main['MnID'],$main['MnURL']);
				// if($chk_sysmn->num_rows()==0){
					// echo "insert Menu <BR>";
					$this->m_umcopymenu->MnStID = $SystemId; 
					// $this->m_umcopymenu->MnID = $main['MnID'];
					$this->m_umcopymenu->MnSeq = $main['MnSeq'];
					$this->m_umcopymenu->MnNameT =  $main['MnNameT'];
					$this->m_umcopymenu->MnNameE =  $main['MnNameE'];
					$this->m_umcopymenu->MnIcon =  $main['MnIcon'];
					$this->m_umcopymenu->MnURL =  $main['MnURL'];
					$this->m_umcopymenu->MnDesc =  $main['MnDesc'];
					$this->m_umcopymenu->MnToolbar =  $main['MnToolbar'];
					$this->m_umcopymenu->MnToolbarSeq =  $main['MnToolbarSeq'];
					$this->m_umcopymenu->MnToolbarIcon =  $main['MnToolbarIcon'];
					$this->m_umcopymenu->MnParentMnID =  $main['MnParentMnID'];
					$this->m_umcopymenu->MnLevel =  $main['MnLevel'];
					if($main['MnLevel']!=0){
						$this->m_umcopymenu->MnParentMnID = $parent_id;
						$this->m_umcopymenu->insert_menu($siteto);
						
						
						$this->m_umcopymenu->MnID = $this->m_umcopymenu->last_insert_id;
						// $this->m_umcopymenu->update();
					}else{
					
						$this->m_umcopymenu->insert_menu($siteto);
						$parent_id = $this->m_umcopymenu->last_insert_id;
					}
				// }else{
					// echo "NOT <br>";
					// echo "<script>alert('มีเมนูนี้ในระบบเเล้ว :: ".$main['MnNameT']."')</script>";
				// }
				 // echo $this->m_umcopymenu->ums->last_query()."<br>";
				 // echo "*************************************************************<br>";
		 } 
		
		  // echo $this->m_umcopymenu->ums->last_query()."<br>";
			 
			
		// foreach($menu1 as $main ){
			// echo $main['MnNameT']."<br>";
		// }
		// echo json_encode($sys_bf);
		redirect('UMS/CopySystemmenu', 'refresh');
	}
	
	
	public function export_excel($st="")
    {
		
		
		
        /** PHPExcel */
        // include("plugins/PHPExcel/Classes1/PHPExcel.php");

        /** PHPExcel_IOFactory - Reader */
        // include("plugins/PHPExcel/Classes1/PHPExcel/IOFactory.php");

        /*$this->load->model($this->model . "M_compile_system", "mcs");
		

        $user = $this->mcs->get_user_detail($ps_id);
        if ($user->num_rows() == 0) {
            exit("ไม่พบผู้ใช้");
		}*/
		
		$this->load->library('excel');
		
		
		if($this->input->post('stid')!=null){
			$stid = $this->input->post('stid');
			foreach($stid as $key=>$val){
				$menu1[$key] = $this->m_umcopymenu->get_by_key_copy($val)->row_array();
			}
			
		}else{
				$menu1 = $this->m_umcopymenu->get_all_copy($st)->result_array();
			
		}
		/* echo "<pre>";
		print_r($menu1);die;
		die; */
        //activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		//set cell A1 content with some text
		
				$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
				$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
				$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
				$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
				$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
				$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
				$this->excel->getActiveSheet()->mergeCells('A1:M1');
				$this->excel->getActiveSheet()->getStyle('A1:B1:C1:D1:E1:F1:G1:H1:I1:J1:K1:L1:M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('A1:B1:C1:D1:E1:F1:G1:H1:I1:J1:K1:L1:M1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('A1', $menu1[0]['StNameT']);
				$this->excel->getActiveSheet()->setCellValue('A2', "MnStID");
                $this->excel->getActiveSheet()->setCellValue('B2', "MnID");
				$this->excel->getActiveSheet()->setCellValue('C2', "MnSeq");
				$this->excel->getActiveSheet()->setCellValue('D2', "MnNameT");
				$this->excel->getActiveSheet()->setCellValue('E2', "MnNameE");
				$this->excel->getActiveSheet()->setCellValue('F2', "MnIcon");
				$this->excel->getActiveSheet()->setCellValue('G2', "MnURL");
				$this->excel->getActiveSheet()->setCellValue('H2', "MnDesc");
				$this->excel->getActiveSheet()->setCellValue('I2', "MnToolbar");
				$this->excel->getActiveSheet()->setCellValue('J2', "MnToolbarSeq");
				$this->excel->getActiveSheet()->setCellValue('K2', "MnToolbarIcon");
				$this->excel->getActiveSheet()->setCellValue('L2', "MnParentMnID");
				$this->excel->getActiveSheet()->setCellValue('M2', "MnLevel");
				
				$num = 3;
				foreach($menu1 as $main ){
					//if($main['MnLevel']==0){
						$this->excel->getActiveSheet()->setCellValue('A'.$num, $main['MnStID']);
						$this->excel->getActiveSheet()->setCellValue('B'.$num, $main['MnID']);
						$this->excel->getActiveSheet()->setCellValue('C'.$num, $main['MnSeq']);
						$this->excel->getActiveSheet()->setCellValue('D'.$num, $main['MnNameT']);
						$this->excel->getActiveSheet()->setCellValue('E'.$num, $main['MnNameE']);
						$this->excel->getActiveSheet()->setCellValue('F'.$num, $main['MnIcon']);
						$this->excel->getActiveSheet()->setCellValue('G'.$num, $main['MnURL']);
						$this->excel->getActiveSheet()->setCellValue('H'.$num, $main['MnDesc']);
						$this->excel->getActiveSheet()->setCellValue('I'.$num, $main['MnToolbar']);
						$this->excel->getActiveSheet()->setCellValue('J'.$num, $main['MnToolbarSeq']);
						$this->excel->getActiveSheet()->setCellValue('K'.$num, $main['MnToolbarIcon']);
						$this->excel->getActiveSheet()->setCellValue('L'.$num, $main['MnParentMnID']);
						$this->excel->getActiveSheet()->setCellValue('M'.$num, $main['MnLevel']);
						
				//	}else{
			//	}
					$num++;
				}
				
		
		$filename='เมนู'.$menu1[0]['StNameT'].'.xlsx'; //save our workbook as this file name
		
		
		
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
		ob_end_clean();
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit;
    }
	
	
	
	
	
	
	/*#####################################################################################################################*/
	public function index_import_copymenu(){
		// echo $this->session->userdata('UsDpID');
		// $data['user'] = $this->m_umuser->get_all();
		// $data['syncfile'] = $this->da_umsync->get_all_sync();
		
		$data['headingsArray'] ="";
		$this->output('UMS/Copymenu/v_syncByCopyExcel',$data);
	}
	
	
	public function ImportCopyFile(){
		$this->load->library('excel');
		$files = $_FILES['DataExcel'];
		// print_r($files);die;
		// echo $files['name']."<br>";
		// echo $files['type']."<br>";
		// echo $files['tmp_name']."<br>";
		if($files['type']=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $files['type']=="application/vnd.ms-excel"){
		// if($files['type']=="application/vnd.ms-excel"){
			// echo "True<br>";
			/** PHPExcel */
			// include ("plugins/PHPExcel/Classes/PHPExcel.php");
			// include ("plugins/PHPExcel/excel_reader.php");

			/** PHPExcel_IOFactory - Reader */
			// include ("plugins/PHPExcel/Classes/PHPExcel/IOFactory.php");
			
			// $uploads_dir = '/var/www/uploads/ums';
			$uploads_dir = $this->config->item('ums_upload_dir');
			if (!file_exists($uploads_dir)) {
				mkdir($uploads_dir, 0777);
			}
			
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
			$headingsArray = $objWorksheet->rangeToArray('A2:'.$highestColumn.'2',null, true, true, true);
			// echo "<pre>";
			// print_r($headingsArray);
			// echo "</pre>";
			// $headingsArray = $headingsArray[1];
			// print_r($headingsArray);die;
			// echo $highestRow."<br>".$highestColumn;
			$namedDataArray = array();
			$firstRowImport= 3;
			$data['sys_name'] = $objWorksheet->rangeToArray('A1',null, true, true, true);
			/*echo $data['sys_name'][1]['A'];
			die;*/
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
			// print_r($data['namedDataArray']);
			// echo "</pre>";
			// $this->output('v_ALS_reviewExcelSTU',$this->data);
			/*echo "<pre>";
			print_r($data);
			die;*/

		 
			$this->m_umcopymenu->StNameT = $data['sys_name'][1]['A'];
			$data['rs_umsystem'] = $this->m_umcopymenu->get_by_key_import()->result();
			$this->m_umcopymenu->MnStID = $data['rs_umsystem'][0]->StID;
			$data['rs_ummenu'] = $this->m_umcopymenu->get_by_keymenu_import()->result();
			// echo "<pre>";
			// echo $data['rs_umsystem'][0]->StID;
			// print_r($data['rs_umsystem']);
			// die;
			// print_r($data['rs_ummenu']);
			// die;
			$this->output('UMS/Copymenu/v_syncByCopyExcel',$data);
			 // }
		}else{
			// echo "False";
			$data = "";
			$this->output('UMS/Copymenu/v_syncByCopyExcel',$data);
		}
	}
	
	
	
	
	
	public function Importnewmenu(){
		$MnStID = $this->input->post('MnStID');
		$MnID = $this->input->post('MnID');
		$MnSeq = $this->input->post('MnSeq');
		$MnNameT = $this->input->post('MnNameT');
		$MnNameE = $this->input->post('MnNameE');
		$MnIcon = $this->input->post('MnIcon');
		$MnURL = $this->input->post('MnURL');
		$MnDesc = $this->input->post('MnDesc');
		$MnToolbar = $this->input->post('MnToolbar');
		$MnToolbarSeq = $this->input->post('MnToolbarSeq');
		$MnToolbarIcon = $this->input->post('MnToolbarIcon');
		$MnParentMnID = $this->input->post('MnParentMnID');
		$MnLevel = $this->input->post('MnLevel');
		if(count($MnStID)!=0){
			foreach($MnStID as $key=>$val){
				$this->m_ummenu->MnStID = $val; 
				$this->m_ummenu->MnID = $MnID[$key]; 
				$this->m_ummenu->MnSeq = $MnSeq[$key]; 
				$this->m_ummenu->MnNameT = $MnNameT[$key]; 
				$this->m_ummenu->MnNameE = $MnNameE[$key]; 
				$this->m_ummenu->MnIcon = $MnIcon[$key]; 
				$this->m_ummenu->MnURL = $MnURL[$key];
				$this->m_ummenu->MnDesc = $MnDesc[$key]; 
				$this->m_ummenu->MnToolbar = $MnToolbar[$key];
				$this->m_ummenu->MnToolbarSeq = $MnToolbarSeq[$key];
				$this->m_ummenu->MnToolbarIcon = $MnToolbarIcon[$key];
				$this->m_ummenu->MnParentMnID = $MnParentMnID[$key]; 
				$this->m_ummenu->MnLevel = $MnLevel[$key];
				if($MnLevel[$key]!=0){
					$this->m_ummenu->MnParentMnID = $MnParentMnID[$key];
					$this->m_ummenu->insert();
					
					
					$this->m_ummenu->MnID = $this->m_ummenu->last_insert_id;
					$this->m_ummenu->update();
				}else{
					//$this->m_ummenu->MnParentMnID = $parent_id;
					$this->m_ummenu->insert();
					$parent_id = $this->m_ummenu->last_insert_id;
				}
				
			}
			echo "<script>alert('นำเข้าสำเร็จ')</script>";
		}else{
			echo "<script>alert('มีเมนูนี้ในระบบเเล้ว')</script>";
		}
		redirect('UMS/showSystem', 'refresh');
	}
}
?>