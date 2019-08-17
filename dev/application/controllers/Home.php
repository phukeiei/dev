<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('UMS_Controller.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpWord\Writer\PDF\MPDF;
use PhpOffice\PhpWord\TemplateProcessor;

class Home extends UMS_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $sys_query = "SELECT * FROM umsystem WHERE StID NOT IN (1) ORDER BY StID ASC";
        $data['rs_sys'] = $this->db->query($sys_query)->result();
        $data['use_slide'] = true;
        $this->output_frontend('front/v_home', $data);
    }

    public function demo()
    {
        $data['header_title'] = "Demo Element";
        $data['header_description'] = "Template Frontend - Show";
        $this->output_frontend('front/v_demo', $data);
    }

    public function demo_code()
    {
        $data['header_title'] =  "Code Guide Frontend";
        $data['header_description'] = "";
        $data['scripts'] = "hljs.initHighlightingOnLoad();";
        $data["styles"] = "";
        $this->output_frontend('front/v_demo_code', $data);
    }

    function demo_avenxo(){
        $data['header_title'] =  "Demo Template";
        $data['header_description'] = "";
        $this->output_no_login("front/v_avenxo");
    }

    function demo_calendar(){
        $this->output_frontend_fancy('front/v_demo_calendar');
    }
	
	function demo_excel(){
		$data['header_title'] =  "Code Guide Excel";
        $data['header_description'] = "";
		$this->output('front/v_example_excel', $data);
	}
	function Export_excel(){
		$spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

        $sheet = $spreadsheet->getActiveSheet();

        // manually set table data value
        $sheet->setCellValue('A1', 'Gipsy Danger'); 
        $sheet->setCellValue('A2', 'Gipsy Avenger');
        $sheet->setCellValue('A3', 'Striker Eureka');
        
        $writer = new Xlsx($spreadsheet); // instantiate Xlsx
 
        $filename = 'list-of-jaegers'; // set filename for excel file to be exported
 
		// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
		ob_end_clean();

        $writer->save('php://output');	// download file 
	}
	function Export_word(){
		$phpWord = new PhpWord();
		// $section = $phpWord->addSection();
		// $section->addText('Hello World !');
		
		// New portrait section
		// $section = $phpWord->createSection(array('borderColor'=>'00FF00', 'borderSize'=>12));
		// $section->addText('I am placed on a default section.');
		
		// New landscape section
		$section = $phpWord->createSection(array('orientation'=>'landscape'));
		$section->addText('I am placed on a landscape section. Every page starting from this section will be landscape style.');
		// 2. Advanced table
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars('Fancy table'), $header);
			$styleTable = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80);
			$styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
			$styleCell = array('valign' => 'center');
			$styleCellBTLR = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
			$fontStyle = array('bold' => true, 'align' => 'center');
			$phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
			$table = $section->addTable('Fancy Table');
			$table->addRow(900);
			$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Row 1'), $fontStyle);
			$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Row 2'), $fontStyle);
			$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Row 3'), $fontStyle);
			$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Row 4'), $fontStyle);
			$table->addCell(2000, $styleCellBTLR)->addText(htmlspecialchars('Row 5'), $fontStyle);
			for ($i = 1; $i <= 8; $i++) {
				$table->addRow();
				$table->addCell(2000)->addText(htmlspecialchars("Cell {$i}"));
				$table->addCell(2000)->addText(htmlspecialchars("Cell {$i}"));
				$table->addCell(2000)->addText(htmlspecialchars("Cell {$i}"));
				$table->addCell(2000)->addText(htmlspecialchars("Cell {$i}"));
				$text = (0== $i % 2) ? 'X' : '';
				$table->addCell(2000)->addText(htmlspecialchars($text));
			}

		// 3. colspan (gridSpan) and rowspan (vMerge)
			$section->addPageBreak();
			$section->addText(htmlspecialchars('Table with colspan and rowspan'), $header);
			$styleTable = array('borderSize' => 6, 'borderColor' => '999999');
			$cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'FFFF00');
			$cellRowContinue = array('vMerge' => 'continue');
			$cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
			$cellHCentered = array('align' => 'center');
			$cellVCentered = array('valign' => 'center');
			$phpWord->addTableStyle('Colspan Rowspan', $styleTable);
			$table = $section->addTable('Colspan Rowspan');
			$table->addRow();
			$cell1 = $table->addCell(2000, $cellRowSpan);
			$textrun1 = $cell1->addTextRun($cellHCentered);
			$textrun1->addText(htmlspecialchars('A'));
			$textrun1->addFootnote()->addText(htmlspecialchars('Row span'));
			$cell2 = $table->addCell(4000, $cellColSpan);
			$textrun2 = $cell2->addTextRun($cellHCentered);
			$textrun2->addText(htmlspecialchars('B'));
			$textrun2->addFootnote()->addText(htmlspecialchars('Colspan span'));
			$table->addCell(2000, $cellRowSpan)->addText(htmlspecialchars('E'), null, $cellHCentered);
			$table->addRow();
			$table->addCell(null, $cellRowContinue);
			$table->addCell(2000, $cellVCentered)->addText(htmlspecialchars('C'), null, $cellHCentered);
			$table->addCell(2000, $cellVCentered)->addText(htmlspecialchars('D'), null, $cellHCentered);
			$table->addCell(null, $cellRowContinue);
		
		
		// New portrait section
		// $section = $phpWord->createSection(array('marginLeft'=>600, 'marginRight'=>600, 'marginTop'=>600, 'marginBottom'=>600));
		// $section->addText('This section uses other margins.');
		
		
		
		$writer = new Word2007($phpWord);
		
		$filename = 'simple';
		
		header('Content-Type: application/msword');
		header('Content-Disposition: attachment;filename="'. $filename .'.docx"'); 
		header('Cache-Control: max-age=0');
		
		ob_end_clean();
		
		$writer->save('php://output');
	}
	
	function Export_PDF(){
		// echo $header;
		// die;
		
		$phpWord = new PhpWord();
		
		
		$section = $phpWord->addSection();
		$section->addText('Hello World !');
				// 2. Advanced table
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars('Fancy table'), $header);
			$styleTable = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80);
			$styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
			$styleCell = array('valign' => 'center');
			$styleCellBTLR = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
			$fontStyle = array('bold' => true, 'align' => 'center');
			$phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
			$table = $section->addTable('Fancy Table');
			$table->addRow(900);
			$table->addCell(2000, $styleCell)->addText(htmlspecialchars('แถววววว 1'), $fontStyle);
			$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Row 2'), $fontStyle);
			$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Row 3'), $fontStyle);
			$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Row 4'), $fontStyle);
			$table->addCell(500, $styleCellBTLR)->addText(htmlspecialchars('Row 5'), $fontStyle);
			for ($i = 1; $i <= 8; $i++) {
				$table->addRow();
				$table->addCell(2000)->addText(htmlspecialchars("Cell {$i}"));
				$table->addCell(2000)->addText(htmlspecialchars("Cell {$i}"));
				$table->addCell(2000)->addText(htmlspecialchars("Cell {$i}"));
				$table->addCell(2000)->addText(htmlspecialchars("Cell {$i}"));
				$text = (0== $i % 2) ? 'X' : '';
				$table->addCell(500)->addText(htmlspecialchars($text));
			}
		
		$writer = new MPDF($phpWord);
		
		$filename = 'simple';
		
		header('Content-Type: application/msword');
		header('Content-Disposition: attachment;filename="'. $filename .'.pdf"'); 
		header('Cache-Control: max-age=0');
		
		ob_end_clean();
		
		$writer->save('php://output');
	}
	
	function test_template(){


     
	}
	
	
	
	function import_file(){
		// input post type files;
		$files = $_FILES['DataExcel'];  	
		// Path file uploads 
		$uploads_dir  = $this->config->item('uploads_dir')."umsExcel";
		// loop check file error 
		foreach($files['error'] as $key=>$value){
			$error =  $value;
			if ($error == UPLOAD_ERR_OK) {
				// value temp name
				$tmp_name = $files['tmp_name'][$key];
				// value file name
				$name =  $files['name'][$key];
				// uploads file to server
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
			}else{
				echo "Can't Upload";
			}
		}
		redirect('Home/demo_code', 'refresh');
	}
	
	

	
	/*
	function Save_excel(){
		// save file on uploads file 
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'name-of-the-generated-file.xlsx';
 
        $writer->save("/var/www/uploads/ossd7site/".$filename); // will create and save the file in the root of the project
		
	}*/
}
?>