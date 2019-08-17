 <?php
/*
  @Name File : 
  @Description : 
  @Author : Jiranuwat
  @Create Date : 
*/
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	require_once dirname(__FILE__)."/../Ffm_Controller.php";
	
	/**
		* @Name class : C_assignment_export
		* @Discription : ขอรายละเอียดเพื่มเติม ได้โปรดเถอะ อธิบายด้วย
		* @Author : นามปากกาใคร?
		* @Create Date : ถูกสร้างเมื่อไร DD-MM-YYYY
	*/
   	
	class Export_document extends Ffm_Controller{
		public $thainumber;
		public $thaicount;
		public $counts;
		public $html_content;
		/** Discription: การตั้งค่าพื้นฐานของclassนี้*/
		public function __construct(){
			$this->dir_syst='sar/Report/'; // ที่อยู่ไฟล์งาน
			$this->thainumber = ['ก','ข','ค','ง','จ','ฉ','ช','ซ','ญ','ด','ต','ท','ธ','น','บ','ป','พ','ฟ','ผ','ฝ','ม','ย','ร','ล','ว','ศ','ส','ษ','ห','อ','ฮ'];
			$this->thaicount = -1;
			$this->counts =0 ;
			parent::__construct();
			// Your own constructor code
		} // End Function
		
		public function index(){
		}
		
		/*
		 * @Name        Function : Exportprechapter
		 * @Discription : ฟังชั่นที่ทำงานสร้างหัวกระดาษ บทรอง
		 * @Input       : -
		 * @Output      : หัวกระดาษ บทรอง
		 * @Author      :  Jiranuwat
		 * @Create      Date : 26-1-2562
		 */
		public function Exportprechapter($Header,$Footer){
			$this->thaicount++;
			$html = '<style>
						@page prechapter'.$this->thaicount.'{
							odd-header-name: prechapter'.$this->thaicount.'HeaderOdd;
							odd-footer-name: prechapter'.$this->thaicount.'FooterOdd;
						}
						div.prechapter'.$this->thaicount.'{
							page-break-before: left;
							page: prechapter'.$this->thaicount.';
						}
					</style>
					<htmlpageheader name="prechapter'.$this->thaicount.'HeaderOdd" style="display:none">
						'.$Header.'
					</htmlpageheader>
					<htmlpagefooter name="prechapter'.$this->thaicount.'FooterOdd" style="display:none">
						'.$Footer.'
					</htmlpagefooter>';
			if($this->thaicount == 0 ){
				$html.= '<style>
						@page prechapter'.$this->thaicount.'{
							resetpagenum:"1"
						}</style>';
			}
			$html = str_replace('{PageThai}' , $this->thainumber[$this->thaicount],$html);
			return $html;
		}
		/*
		 * @Name        Function : Exportmainchapter
		 * @Discription : ฟังชั่นที่ทำงานสร้างหัวกระดาษ บทหลัก
		 * @Input       : -
		 * @Output      : หัวกระดาษ บทหลัก
		 * @Author      :  Jiranuwat
		 * @Create      Date : 26-1-2562
		 */
		public function Exportmainchapter($Header,$Footer){
			$this->counts++;
			$html = '<style>
						@page mainchapter'.$this->counts.'{
							odd-header-name: mainchapter'.$this->counts.'HeaderOdd;
							odd-footer-name: mainchapter'.$this->counts.'FooterOdd;
						}
						div.mainchapter'.$this->counts.'{
							page-break-before: left;
							page: mainchapter'.$this->counts.';
						}
					</style>
					<htmlpageheader name="mainchapter'.$this->counts.'HeaderOdd" style="display:none">
						'.$Header.'
					</htmlpageheader>
					<htmlpagefooter name="mainchapter'.$this->counts.'FooterOdd" style="display:none">
						'.$Footer.'
					</htmlpagefooter>';
			return $html;
		}
		/*
		 * @Name        Function : getMBStrSplit
		 * @Discription : ฟังชั่นที่ทำงานแปลงรุปแบบ string
		 * @Input       : ชุดตัวอักษร
		 * @Output      : รุปแบบ string แบบใหม่
		 * @Author      :  Jiranuwat
		 * @Create      Date : 26-1-2562
		 */
		// Convert a string to an array with multibyte string
		public function getMBStrSplit($string, $split_length = 1){
			mb_internal_encoding('UTF-8');
			mb_regex_encoding('UTF-8'); 
			
			$split_length = ($split_length <= 0) ? 1 : $split_length;
			$mb_strlen = mb_strlen($string, 'utf-8');
			$array = array();
			$i = 0; 
			
			while($i < $mb_strlen)
			{
				$array[] = mb_substr($string, $i, $split_length);
				$i = $i+$split_length;
			}
			return $array;
		}
		/*
		 * @Name        Function : getSubStrTH
		 * @Discription : ฟังชั่นที่ทำงานแปลงชุดตัวอักษรเป็นภาษาไทย
		 * @Input       : ชุดตัวอักษร
		 * @Output      : ชุดตัวอักษรเป็นภาษาไทย
		 * @Author      :  Jiranuwat
		 * @Create      Date : 26-1-2562
		 */
		// Get part of string for Character Thai
		public function getSubStrTH($string)
		{			
			$array = $this->getMBStrSplit($string);
			$count = 0;
			$action =1;
					// echo $string;
					// echo $count;
			for($i=0; $i < count($array); $i++)
			{
				$ascii = ord(iconv("UTF-8", "TIS-620", $array[$i] ));
				//echo $ascii.$array[$i]."<br>";
				if( ($ascii == 209 ||  ($ascii >= 212 && $ascii <= 218 ) || ($ascii >= 231 && $ascii <= 238 )) && $action)
				{
					//$start++;
					 ++$count;
					$action = 0;
					continue;
				}
				$action=1;
				}
			return (strlen($string)/3)-$count;
		}
		/*
		 * @Name        Function : StringToDot
		 * @Discription : ฟังชั่นที่ทำงานเพื่มจุดหลังชุดตัวอักษร
		 * @Input       : ชุดตัวอักษร
		 * @Output      : มีจุดหลังชุดตัวอักษร
		 * @Author      :  Jiranuwat
		 * @Create      Date : 26-1-2562
		 */
		public function StringToDot($string)
		{
			$dot = $string.' ';
			for($i = 0 ; $i< 125-($this->getSubStrTH($string)*2.1);$i++){
				$dot .= '.';
			}
			return $dot;
		}
		/*
		 * @Name        Function : Exportprechapter
		 * @Discription : ฟังชั่นที่ทำงานสร้างหัวกระดาษ บทรอง
		 * @Input       : ข้อความหัวข้อ
		 * @Output      : หัวกระดาษ บทรอง
		 * @Author      :  Jiranuwat
		 * @Create      Date : 26-1-2562
		 */
		public function SarubunMainTopic($Topic){
			$html = '
			<tr>
			  <td style="padding-bottom: 7.5px;font-weight:bold;font-size:18px;float:left;;white-space: nowrap;">'.$Topic.'
			  </td>
			  <td style="padding-bottom: 7.5px;font-size:16px;float:right;white-space: nowrap;">{PST}
			  </td>
			</tr>';
			return $html;
		}
		/*
		 * @Name        Function : Exportprechapter
		 * @Discription : ฟังชั่นที่ทำงานสร้างหัวกระดาษ บทรอง
		 * @Input       : ข้อความหัวข้อ
		 * @Output      : หัวกระดาษ บทรอง
		 * @Author      :  Jiranuwat
		 * @Create      Date : 26-1-2562
		 */
		public function SarubunSubTopic($Topic){
			$html = '
			<tr style="">
			  <td style="padding-bottom: 7.5px;font-size:16px;float:left;;white-space: nowrap;">'.$this->StringToDot($Topic).'
			  </td>
			  <td style="padding-bottom: 7.5px;font-size:16px;float:right;white-space: nowrap;">{PST}
			  </td>
			</tr>';
			return $html;
		}
		/*
		 * @Name        Function : Exportprechapter
		 * @Discription : ฟังชั่นที่ทำงานสร้างหัวกระดาษ บทรอง
		 * @Input       : รหัสเล่มsar
		 * @Output      : เล่ม sar
		 * @Author      :  Jiranuwat
		 * @Create      Date : 26-1-2562
		 */
		public function Export_pdf($sar_id=''){
			$this->load->model($this->dir_syst."M_report_book", 'rpb');
			 $rpb = $this->rpb; // ตั้งค่าพื้นฐาน Modal
			 $data['rs_tmp_head'] = $rpb->get_information_tmp_head_export($sar_id); 
			 $data['rs_tmp_content'] = $rpb->get_information_tmp_content_export($sar_id);
			 $data['rs_sar_head'] = $rpb->get_information_sar_head_export($sar_id);
			 $data['rs_sar_content'] = $rpb->get_information_sar_content_export($sar_id); 
			require_once "mpdf/mpdf.php";
			$i=1;
			$mpdf=new mPDF();
			$mpdf->autoScriptToLang = true;
			$mpdf->autoLangToFont = true;
			$ignore_table_width = true;
			$ignore_table_percents = true;
			// $mpdf->showImageErrors = true;
			ob_start();
			$html = '
			<html>
			<head>
			<style>
				@page {
					size: auto;
					}
				@page coverpage :first{
					background-image-resize: 6;
					background-image:url(http://'.$_SERVER['SERVER_NAME'].'/pcksite/application/controllers/sar2/documents/images/frontcover.jpg);
				}
				@page coverpage {
					odd-header-name: _blank;
					even-header-name: _blank;
					odd-footer-name: _blank;
					even-footer-name: _blank;
				}
				div.coverpage {
					page-break-before: always ;
					page: coverpage;
				}
				
				@page coverbackpage :first{
					background-image-resize: 6;
					background-image:url(http://'.$_SERVER['SERVER_NAME'].'/pcksite/application/controllers/sar2/documents/images/backcover.jpg);
				}
				@page coverbackpage {
					odd-header-name: _blank;
					even-header-name: _blank;
					odd-footer-name: _blank;
					even-footer-name: _blank;
				}
				div.coverbackpage {
					page-break-before: always ;
					page: coverbackpage;
				}
			</style>
			</head>
			<body>
				<!-- หน้าปก -->
				<div class="coverpage"> <div width="100%" height="100%"></div></div>
				<div>
					<div style="text-align:center">';
					// echo 'http://'.$_SERVER['SERVER_NAME'];
					// die();
					$html .= '<img src="http://'.$_SERVER['SERVER_NAME'].'/pcksite/application/controllers/sar2/documents/images/logo_ThJPG.jpg" height="200px" width="200px">					
					</div>
					<br>
					<br>
					<div style="text-align:center;font-weight:bold;font-size:26;text-shadow: 2px 2px  5px #848585;">หลักสูตรพยาบาลศาสตรบัณฑิต</div>
					<div style="text-align:center;font-size:20">การรับรองสถาบันการศึกษาวิชาการพยาบาลและการผดุงครรภ์ พ.ศ. ๒๕๖๐</div>
					<br>
					<br>
					<div style="text-align:center;font-weight:bold;font-size:30;text-shadow: 2px 2px 5px #848585;">วิทยาลัยพยาบาลบรมราชชนนี สระบุรี</div>
					<div style="text-align:center;font-size:30">Boromarajonani College of Nursing,Saraburi</div>
					<br>
					<hr>
					<br>
					<br>
					<div style="text-align:center;font-weight:bold;font-size:30;text-shadow: 2px 2px 5px #848585;">รายงานการประเมินตนเอง</div>
					<div style="text-align:center;font-size:26">Self - Assessment report (SAR)</div>
					<div style="text-align:center;font-weight:bold;font-size:30;text-shadow: 2px 2px 5px #848585;">ระดับสถาบันการศึกษา</div>
					<br>
					<br>
					<hr>
					<br>
					<br>
					<br>
					<br>	
					<br>
					<br>
					<div style="text-align:right;font-size:16;font-weight:bold;text-shadow: 2px 2px 5px #848585;">ประจำปีการศึกษา ๒๕๖๐ ( ๑ สิงหาคม ๒๕๖๐ ถึง ๓๑ กรกฎาคม ๒๕๖๑)</div>
					<div style="text-align:right;font-size:16">Academic year 2016 ( 1 August 2017 to 31 July 2018)</div>
				</div>';
		/* ****************** Data ******************** */
		
		$header =' <div style="text-align:right;border-bottom: 2px solid #848585;">รายงานผลการประเมินตัวเองของสถาบันการศึกษา | ปีการศึกษา ๒๕๖๐</div>';
		$footer =' <table width="100%" style="overflow: hidden ;border-top: 2px solid #848585;" autosize="1">
						<tr>
						<td style="text-align:left;">วิทยาลัยพยาบาลบรมราชชนนี สระบุรี</td>
						<td style="text-align:right;">หน้า {PageThai}</td>
						</tr>
						</table>';
		$html .= $this->Exportprechapter($header,$footer);
		$html .= '<div class="prechapter'.$this->thaicount.'">
					<br>
					<div style="text-align:center;font-size:20px;font-weight:bold">สารบัญ</div>
					<br>
						
						<table width="100%" style="overflow: hidden " autosize="1">
						<tr>
						<td style="padding-bottom: 7.5px;text-align:left;width:75%;font-size:18px">ส่วนที่</td>
						<td style="padding-bottom: 7.5px;text-align:right;width:25%;font-size:18px">หน้าที่</td>
						</tr>
						</table>
						<table width="100%" style="overflow: x " autosize="1">
						'.$this->SarubunMainTopic("เกณฑ์การประเมินขั้นพื้นฐาน").'
						'.$this->SarubunSubTopic("AUN 1 การบริหารองค์กร").'
						'.$this->SarubunSubTopic("AUN 2 คุณสมบัตัของผู้บริหารสถาบันการศึกษาพยาบาล").'
						'.$this->SarubunSubTopic("AUN 3 ระบบสารสนเทศเพื่อการบริหารและตัดสินใจ").'
						'.$this->SarubunSubTopic("AUN 4 คุณวุฒิอาจารย์พยาบาลประจำ").'
						'.$this->SarubunSubTopic("AUN 5 อัตราส่วนจำนวนอาจารย์พยาบาลประจำ").'
						'.$this->SarubunSubTopic("AUN 6 อัตราส่วนจำนวนอาจารย์พยาบาลวชั่วคราว").'
						'.$this->SarubunSubTopic("AUN 7 การวางแผนและการพัฒนาอาจารย์").'
						'.$this->SarubunSubTopic("AUN 8 การบริหารหลักสูตร").'
						'.$this->SarubunSubTopic("AUN 9 ผลการประเมินคุณภาพภายในระดับหลักสูตร").'
						'.$this->SarubunSubTopic("AUN 10 การพัฒนานักศึกษา").'
						</table>
				  </div>
					';
		$html .= $this->Exportprechapter($header,$footer);
		$html .= '<div class="prechapter'.$this->thaicount.'">
					<br>
					<div style="text-align:center;font-size:20px;font-weight:bold">สารบัญรูป</div>
					<br>
						
						<table width="100%" style="overflow: hidden " autosize="1">
						<tr>
						<td style="padding-bottom: 7.5px;text-align:left;width:75%;font-size:18px"></td>
						<td style="padding-bottom: 7.5px;text-align:right;width:25%;font-size:18px">หน้าที่</td>
						</tr>
						</table>
						<table width="100%" style="overflow: x " autosize="1">
						'.$this->SarubunSubTopic("รูปที่ 1 ตัวอย่างรูปภาพอย่างง่าย").'
						'.$this->SarubunSubTopic("รูปที่ 2 ผู้บริหารสถาบันการศึกษาพยาบาล").'
						'.$this->SarubunSubTopic("รูปที่ 3 ระบบสารสนเทศ").'
						'.$this->SarubunSubTopic("รูปที่ 4 อาจารย์พยาบาลประจำ").'
						'.$this->SarubunSubTopic("รูปที่ 5 รวมรุ่นพยาบาลประจำ").'
						'.$this->SarubunSubTopic("รูปที่ 6 อาจารย์พยาบาลวชั่วคราว").'
						'.$this->SarubunSubTopic("รูปที่ 7 การวางแผนการเงิน").'
						'.$this->SarubunSubTopic("รูปที่ 8 ตัวอย่างหลักสูตร").'
						'.$this->SarubunSubTopic("รูปที่ 9 ผลการประเมินคุณภาพ").'
						'.$this->SarubunSubTopic("รูปที่ 10 ข้อมูลนักศึกษา").'
						</table>
				  </div>
					';
		$html .= $this->Exportprechapter($header,$footer);
		$html .= '<div class="prechapter'.$this->thaicount.'">
					<br>
					<div style="text-align:center;font-size:20px;font-weight:bold">สารบัญตาราง</div>
					<br>
						
						<table width="100%" style="overflow: hidden " autosize="1">
						<tr>
						<td style="padding-bottom: 7.5px;text-align:left;width:75%;font-size:18px">ส่วนที่</td>
						<td style="padding-bottom: 7.5px;text-align:right;width:25%;font-size:18px">หน้าที่</td>
						</tr>
						</table>
						<table width="100%" style="overflow: x " autosize="1">
						'.$this->SarubunSubTopic("ตาราง 1 ผู้บริหารองค์กร").'
						'.$this->SarubunSubTopic("ตาราง 2 ผู้บริหารสถาบันการศึกษาพยาบาล").'
						'.$this->SarubunSubTopic("ตาราง 3 การบริหารและตัดสินใจ").'
						'.$this->SarubunSubTopic("ตาราง 4 พยาบาลประจำ").'
						'.$this->SarubunSubTopic("ตาราง 5 อัตราส่วนจำนวนอาจารย์พยาบาลประจำ").'
						'.$this->SarubunSubTopic("ตาราง 6 อัตราส่วนจำนวนอาจารย์พยาบาลวชั่วคราว").'
						'.$this->SarubunSubTopic("ตาราง 7 การวางแผนและการพัฒนาอาจารย์").'
						'.$this->SarubunSubTopic("ตาราง 8 หลักสูตร").'
						'.$this->SarubunSubTopic("ตาราง 9 ผลการประเมิน").'
						'.$this->SarubunSubTopic("ตาราง 10 รายชิ่อนักศึกษา").'
						</table>
				  </div>
					';	




		$sjm_group = '';
		$ses_group = '';
		$sus_group = '';
		$this->html_content = '';
		foreach($data['rs_tmp_head']->result() as $key => $row){
			if($ses_group != '' && $ses_group != $row->ses_name){
				$asub_group = '';
				foreach($data['rs_sar_head']->result() as $key => $row2){					
					if($ses_group == $row2->ass_name){
						$asub_group = $this->Create_information_content($asub_group,$row2->asub_name,3);
						$secon_sus_group = '';
						foreach($data['rs_sar_content']->result() as $key => $row3){
							if($row3->asub_parent == $row2->asub_id){
								$secon_sus_group = $this->Create_information_content($secon_sus_group,$row3->asub_name,3);
								if(!is_null($row3->atxd_data)){
									$this->html_content .= "<div style='margin-left:30px'>".$row3->atxd_data."</div>";
								}
							}
						}
						if(!is_null($row2->atxd_data)){
							$this->html_content .= "<div style='margin-left:30px'>".$row2->atxd_data."</div>";
						}
					}
				}
				$header =' <div style="text-align:right;border-bottom: 2px solid #848585;">'.$row->sjm_name.' | ปีการศึกษา ๒๕๖๐</div>';
				$footer =' <table width="100%" style="overflow: hidden ;border-top: 2px solid #848585;" autosize="1">
								<tr>
								<td style="text-align:left;">วิทยาลัยพยาบาลบรมราชชนนี สระบุรี</td>
								<td style="text-align:right;">หน้า {PAGENO}</td>
								</tr>
								</table>';
				$html .= $this->Exportmainchapter($header,$footer);
				$html .= '<div class="mainchapter'.$this->counts.'">';
				$this->html_content = str_replace("<table","<table style='width:100%;border: 1px solid #eeeeee; border-collapse: collapse; '",$this->html_content);
				$this->html_content = str_replace("<thead","<thead style='border: 1px solid #eeeeee;text-align: center; color: #FFFFFF; background-color: rgb(2, 117, 216); vertical-align: top; font-size: 18px; border-collapse: collapse; '",$this->html_content);
				$this->html_content = str_replace("<tr","<tr style='border: 1px solid #eeeeee;height:20px; border-collapse: collapse; '",$this->html_content);
				$this->html_content = str_replace("<td","<td style='border: 1px solid #eeeeee; border-collapse: collapse; '",$this->html_content);
				$this->html_content = preg_replace('/<math\b[^>]*>(.*?)<\/math>/i', '', $this->html_content);
				$html .= $this->html_content.'</div>';
				$this->html_content = '';
			}
			$sjm_group = $this->Create_information_content($sjm_group,$row->sjm_name,1);
			$ses_group = $this->Create_information_content($ses_group,$row->ses_name,2);
			$sus_group = $this->Create_information_content($sus_group,$row->sus_name,3);
			foreach($data['rs_tmp_content']->result() as $key => $row2){
				if($row2->sus_parent == $row->sus_id){
					$this->html_content .= "<div style='margin-left:30px'>".$row2->sus_name."</div>";
					if(!is_null($row2->txd_data)){
						$this->html_content .= "<div style='margin-left:30px'>".$row2->txd_data."</div>";
					}
				}
			}
			if(!is_null($row->txd_data)){
				$this->html_content .= "<div style='margin-left:30px'>".$row->txd_data."</div>";
			}
		}




			 
		/* ****************** Data ******************** */
		$html .='<div class="coverbackpage"> <div width="100%" height="100%"></div></div></body>
			</html>';
			
			$mpdf->WriteHTML($html);
			ob_end_clean();
			//$mpdf->Output();
			 echo $html;
		} // End Function
	
		/*
		 * @Name        Function : Create_information_content
		 * @Discription : ฟังชั่นที่ทำงานสร้างชุดข้อความผ่านตัวแปร
		 * @Input       : เงื่อนไข ค่า ทางเลือก
		 * @Output      : ชุดข้อความ
		 * @Author      :  Jiranuwat
		 * @Create      Date : 26-1-2562
		 */
	public function Create_information_content($condition,$value,$option="999"){
		$action = 0;
		if($condition == ''){
			$condition = $value;
			$action = 1;
		}
		else if($condition != $value){
			$condition = $value;
			$action = 1; 
		}
		if($action){			
			switch ($option) {
				case 1: 
					$this->html_content .= "<div style='font-size:20px;text-align:center;font-weight:bold;width:100%'>".$value."</div>";
					break;
				case 2: 
					$this->html_content .= "<div style='font-size:18px;text-align:left;font-weight:bold;width:100%';>".$value."</div>";
					break;
				case 3: 
					$this->html_content .= "<div style='font-size:18px;text-align:left;width:100%;margin-top:10px'>".$value."</div>";
					break;
				default:	
					$this->html_content .= '<div>'.$value.'</div>';
			}
		}
		return $condition;
	}
	
		/*
		 * @Name        Function : ExPortTCPDF
		 * @Discription : ฟังชั่นที่ทำงานส่งออกเอกสาร
		 * @Input       : -
		 * @Output      : เอกสาร
		 * @Author      :  Jiranuwat
		 * @Create      Date : 26-1-2562
		 */
	public function ExPortTCPDF(){
		require_once APPPATH."libraries/tcpdf/tcpdf.php";
		$pdf = new TCPDF();
		$pdf->SetFont('freeserif', '', 14, '', true);
		$pdf->AddPage();

		$html = '<div><img src="images/person.png"></img></div>
		<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
		<i>This is the first exampฟหกหกหกฟหกหฟกฟหกฟหกฟหกฟหกหฟกle of TCPDF library.</i>
		<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
		<p>Please check the source code documentation and other examples for further information.</p>
		<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/this->thaicount;.php?group_id=128076">MAKE A DONATION!</a></p>
		';
		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
		ob_end_clean() ;
		$pdf->Output();
		}
	} // End Class
?>