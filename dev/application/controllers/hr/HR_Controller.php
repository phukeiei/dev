<?php
/*
 * hr_controller
 * Main Controller for OpenHR Systems.
 * Copyright (c) 2559. Information System Engineering Research Laboratory.
 * @Author Chain_Chaiwat
 * @Create Date 2559-06-18
 */

if(!defined("HR_Controller")){
	define("HR_Controller","HR_Controller");

class HR_Controller extends CI_Controller {

	public $data;

	public $dArr = array(); //สำหรับโครงสร้างหน่วยงาน
	public $no = 0;			//สำหรับโครงสร้างหน่วยงาน

	public function __construct()
	{
		parent::__construct();
		$this->hr =$this->load->database('hr', TRUE);

		if($this->session->userdata("GpID") == $this->config->item("pp_GpID_admin")){
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
		}
		
		// echo "<script>";
		// echo "console.log('".$this->session->userdata("UsID")."');";
		// echo "console.log('".$this->session->userdata("UsPsCode")."');";
		// echo "console.log('".$this->session->userdata("GpID")."');";
		// echo "console.log('".$this->session->userdata("StID")."');";
		// echo "console.log('".$this->session->userdata("MnID")."');";
		// echo "</script>";
		// $this->hr->query("insert into menu_history values (NULL,?,?,?,?,?,CURRENT_TIMESTAMP)",array($this->session->userdata("UsID"), $this->session->userdata("UsPsCode"), $this->session->userdata("GpID"), $this->session->userdata("StID"), $this->session->userdata("MnID")));
		
		$this->data['btn_edit']		= $this->config->item("button_edit");
		$this->data['btn_delete']	= $this->config->item("button_delete");
		$this->data['btn_save']		= $this->config->item("button_save");
		$this->data['btn_save2'] 	= $this->config->item("button_save2");
		$this->data['btn_clear']	= $this->config->item("button_clear");
		$this->data['btn_cancel']	= $this->config->item("button_cancel");
    }

	public function javascript()
	{
  		parent::javascript();
  		$this->load->view($this->config->item("hr_dir").'v_javascript');
  	}
	function footer()
	{
		parent::footer();
		$this->load->view($this->config->item('hr_dir').'v_footer');
	}

	public function outputs($v)
	{
		$body = $this->config->item("hr_dir").$v;
		parent::output($body,$this->data);
	}

	public function index()
    {

        //$UsID = $this->session->userdata( 'UsID' ); // UsID
		$this->session->unset_userdata('MnID');
		$this->session->unset_userdata('MnNameT');
		$this->session->unset_userdata('MnLevel');
		$this->session->unset_userdata('MnURL');

        $this->outputs( 'v_main' );
    }

	function outputDetail ($v)
	{
		$lv['head'] = "";
		$lv['body'] = $this->load->view($this->config->item("hr_dir").'/v_javascript');
		$lv['body'] .= $this->load->view($this->config->item("hr_dir").$v, $this->data, true);
		$lv['footer'] = "";

		$this->load->view($this->config->item("hr_dir").'/v_in',$lv);
	}

	function outputExcel($v)
	{
		$lv['head'] = $this->load->view('info/v_headerPopup');
		$lv['body'] = $this->load->view($this->config->item("hr_dir")."v_header_js");
		$lv['body'] .= $this->load->view($this->config->item("hr_dir").$v, $this->data, true);
		$lv['footer']='';
		$this->load->view('info/v_in',$lv);
	}

	function getExcelHeader ($filename="report")
	{
		$msg = "header('Content-type: application/ms-xls');";
		$msg .= "header('Content-Disposition: attachment; filename=\"".$filename.".xls\"');";
		return $msg;
	}

	function getWordHeader ($filename="report")
	{
		$msg = "header('Content-type: application/msword');";
		$msg .= "header('Content-Disposition: attachment; filename=\"".$filename.".doc\"');";

		return $msg;
	}

	function get_amphur($pv_id="",$tagName="amph_id", $tagName2="dist_id")
	{
		$this->load->model($this->config->item('hr_dir').'m_hr_amphur', 'ap');
		$rs_ap = $this->ap->rs_by_pv_id($pv_id);

		header ('Content-type: text/html; charset=utf-8');
		if (isset($rs_ap) && ($rs_ap->num_rows() > 0))
		{
			echo "<select name='".$tagName."' class='chzn-select' style='width:200px;' id='".$tagName."' onchange=\"get_district(this.value,'".$tagName2."')\">";
			echo "<option value=''>-----เลือก-----</option>";
			foreach ($rs_ap->result() as $row)
			{
				echo "<option value='".$row->amph_id."'>".$row->amph_name."</option>";
			}
		}
		else echo "<select name=' ".$tagName." ' class='chzn-select' style='width:200px;' id='".$tagName."'><option value=''>-----เลือก-----</option>";
	}

	function get_district($amph_id="",$tagName="dist_id")
	{
		$this->load->model($this->config->item('hr_dir').'m_hr_amphur', 'ap');
		$this->load->model($this->config->item('hr_dir').'m_hr_district', 'dt');
		$this->ap->amph_id = $amph_id;
		$this->ap->get_by_key(true);
		$rs_dt = $this->dt->rs_by_pv_id_and_amph_id($this->ap->pv_id,$this->ap->amph_id);

		header ('Content-type: text/html; charset=utf-8 ');
		if (isset($rs_dt) && ($rs_dt->num_rows() > 0))
		{
			echo "<select name='".$tagName."'class='chzn-select'  style='width:200px;' id='".$tagName."'>";
			echo "<option value=''>-----เลือก-----</option>";
			foreach ($rs_dt->result() as $row)
			{
				echo "<option value='".$row->dist_id."'>".$row->dist_name."</option>";
			}
		}
		else echo "<select name='".$tagName."'class='chzn-select' style='width:200px;' id='".$tagName."'><option value=''>-----เลือก-----</option>";
	}

	function getStruct($deptGroup){ //สำหรับโครงสร้างหน่วยงาน
		$this->load->model($this->config->item('hr_dir').'m_hr_department');
		$dept = $this->m_hr_department;

		$rs = $dept->rs_dept_by_dept_group($deptGroup,'0');
		if($rs->num_rows() > 0){
			foreach($rs->result() as $row){
				$this->dArr[$this->no]['dept_id'] = $row->dept_id;
				$this->dArr[$this->no]['dept_name'] = $row->dept_name;
				$this->dArr[$this->no]['dept_level'] = $row->dept_level;
				$this->dArr[$this->no]['dptype_name'] = $row->dptype_name;
				$this->dArr[$this->no]['f_row'] = $rs->first_row()->dept_id;
				$this->dArr[$this->no]['l_row'] = $rs->last_row()->dept_id;
				$this->no++;
				if($dept->rs_dept_by_dept_group($deptGroup,$row->dept_id)->num_rows()>0){
					$this->GetChildNode($deptGroup,$row->dept_id);
				}
			}
		}
	}
	function GetChildNode($deptGroup,$parentId){ //สำหรับโครงสร้างหน่วยงาน
		$this->load->model($this->config->item('hr_dir').'m_hr_department');
		$dept = $this->m_hr_department;

		$rs = $dept->rs_dept_by_dept_group($deptGroup,$parentId);
		if($rs->num_rows() > 0){
			foreach($rs->result() as $row){
				$this->dArr[$this->no]['dept_id'] = $row->dept_id;
				$this->dArr[$this->no]['dept_name'] = $row->dept_name;
				$this->dArr[$this->no]['dept_level'] = $row->dept_level;
				$this->dArr[$this->no]['dptype_name'] = $row->dptype_name;
				$this->dArr[$this->no]['f_row'] = $rs->first_row()->dept_id;
				$this->dArr[$this->no]['l_row'] = $rs->last_row()->dept_id;
				$this->no++;
				if($dept->rs_dept_by_dept_group($deptGroup,$row->dept_id)->num_rows()>0){
					$this->GetChildNode($deptGroup,$row->dept_id);
				}
			}
		}
	}

	function get_degreeByLevel($tagName,$levelId=""){
		$this->load->model($this->config->item('pp_folder').'m_degree', 'd');

		$rs_d = $this->d->get_options('y', $this->d->searchByLevelId($levelId));
		header ('Content-type: text/html; charset=utf-8');
		echo form_dropdown($tagName, $rs_d, '', "class='select2' style='width:100%;' id='".$tagName."'");
	}

	function get_prefixNameEng($prefixId="")
	{
		$this->load->model($this->config->item('hr_dir').'m_prefix', 'pf');
		header ('Content-type: text/html; charset=utf-8');
		if($prefixId!=""){
			$rs_pf = $this->pf->get_optionsEN('n');
			echo $rs_pf[$prefixId];
		}
		else{
			echo "";
		}
	}

	function checkupload($str)
	{
		$this->form_validation->set_message('checkupload','%s');
		return false;
	}

	function validms($str)
	{
		$this->form_validation->set_message('validms','%s');
		return false;
	}

	function getNextDay($vDate,$tp)
	{
		list($y, $m, $d) = preg_split("[-]", $vDate);

		if($tp == 'F'){//forward
			$numM = GetNumDateInMonth($m,$y);
			if($d+1 <= $numM) $d += 1;
			else if($m+1 <= 12){
				$m += 1;
				$d = 1;
			}else{
				$y += 1;
				$m = $d = 1;
			}
		}else{//backward
			if($d-1 > 0) $d -= 1;
			else if($m-1 > 0){
				$m -= 1;
				$d = GetNumDateInMonth($m,$y);
			}else{
				$y -= 1;
				$m = 12;
				$d = 31;
			}
		}

		return (string)($y)."-".substr("0".$m,-2,2)."-".substr("0".$d,-2,2);
	}

	function checkselect($str){
		if ($str == "" || $str == "0") {
			$this->form_validation->set_message('checkselect','กรุณาเลือก %s');
			return false;
		}else return true;
	}

	function redirectPost($uri,$value="") {

		// Create Form
		$attributes = array('id' => 'redirectPost','name' => 'redirectPost');
		echo form_open($this->config->item('hr_dir').$uri, $attributes);

		// Create Input By Value
		if(is_array($value)){
			foreach($value as $key=>$val){
				echo '<input type="hidden" name="'.$key.'" value="'.$val.'"/>';
			}
		}

		// Close Form
		echo form_close();

		// Submit Form
		echo '<script>document.getElementById("redirectPost").submit();</script>';
	}

	function gen_datadic($table='pck_hrdb')
	{
		echo "<style>	table tr td {font-family: \"TH SarabunPSK\";font-size:21}
						table tr th {font-family: \"TH SarabunPSK\";font-size:21}
			</style>";
		$test = $this->hr->query("	SELECT TABLE_NAME,TABLE_COMMENT
									FROM INFORMATION_SCHEMA.TABLES
									WHERE TABLE_SCHEMA = '".$table."'
									Group by TABLE_NAME");

		$i=0;
		echo '<meta http-equiv=Content-Type content="text/html; charset=utf-8">';
		foreach($test->result() as $row)
		{
			echo "<table border=1 style='border-collapse:collapse' width='100%'>";
			echo "<tr>";
			echo "<td colspan='2'><b>ชื่อตารางภาษาอังกฤษ</b></td>";
			echo "<td colspan='5'>".$row->TABLE_NAME."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td colspan='2'><b>คำอธิบาย</b></td>";
			echo "<td colspan='5'>".$row->TABLE_COMMENT."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td colspan='2'><b>คีย์หลัก (PK)</b></td>";
			$sql_key = 'SELECT COLUMN_NAME
						FROM  INFORMATION_SCHEMA.`KEY_COLUMN_USAGE`
						WHERE TABLE_NAME =  "'.$row->TABLE_NAME.'"
						AND TABLE_SCHEMA =  "'.$table.'"
						AND CONSTRAINT_NAME =  "PRIMARY"';
			$key_array = array();
			foreach($this->hr->query($sql_key)->result() as $row_key)
			{
				array_push($key_array,$row_key->COLUMN_NAME);
			}
			echo "<td colspan='5'>".implode(",",$key_array)."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>ลำดับ</th>";
			echo "<th>ชื่อคอลัมน์</th>";
			echo "<th>ประเภท</th>";
			echo "<th>ขนาด</th>";
			echo "<th>กำหนดค่า</th>";
			echo "<th>รายละเอียด</th>";
			echo "<th>ตัวอย่างข้อมูล</th>";
			echo "</tr>";
			$i = 0;
			$sql = "SELECT * FROM INFORMATION_SCHEMA.`COLUMNS` WHERE `TABLE_NAME` LIKE '".$row->TABLE_NAME."' AND TABLE_SCHEMA =  '".$table."'";
			$test2 = $this->hr->query($sql);

			foreach($test2->result() as $row2 )
			{
				echo "<tr>";
				echo "<td align='center'>".++$i."</td>";
				echo "<td>".$row2->COLUMN_NAME."</td>";
				echo "<td align='center'>".strtoupper($row2->DATA_TYPE)."</td>";
				$data = explode(" ",$row2->COLUMN_TYPE);
				echo "<td align='center'>".str_replace(array($row2->DATA_TYPE,"(",")"),"",$data[0])."</td>";
				echo "<td align='center'>".$row2->COLUMN_DEFAULT."</td>";
				echo "<td>".$row2->COLUMN_COMMENT."</td>";
				/* if($row2->DATA_TYPE=="int"){
					$max = 3;
				}else $max=1;
					$sql = "select distinct `".$row2->COLUMN_NAME."` from `".$row->TABLE_NAME."` WHERE `".$row2->COLUMN_NAME."` != '0000-00-00' and `".$row2->COLUMN_NAME."` != '' and `".$row2->COLUMN_NAME."` not like '0000%' order by `".$row2->COLUMN_NAME."`desc limit 0,".$max;
					$arr = $this->hr->query($sql)->result_array();
					$arr2 = array();
				foreach($arr as $key=>$val){
					$arr2[$key] = $val[$row2->COLUMN_NAME];
					}
				$sample = implode(", ",$arr2); */
				/* if(strlen($sample)>300){
					$sample = substr($sample,1,300)."...";
					} */
				//}else{
					//$sample = "";
				//}
				//echo "<td>".$sample."</td>";
				echo "<td></td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "<br><br>";
		}

	}

	function gen_datadic_word($table='pck_hrdb'){
		header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment; filename=testing.doc");
		$this->gen_datadic($table);
	}

	function gen_datadic_excel($table='pck_hrdb'){
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=testing.xls");
		$this->gen_datadic($table);
	}

	/*
	* get_flow_line
	* $ps_id รหัสบุคลากร
	* $bill_id รหัสใบ (ใบลา, ใบยกเลิกการลา, ใบไปราชการ)
	* $bill_type ประเภทใบ (ใบลา, ใบยกเลิกการลา, ใบไปราชการ)
	* @Author Phanuphan
	* @Create Date 2560-05-08
	*/
	function getFlowLine($ps_id, $bill_id = NULL, $bill_type){
		$this->load->model($this->config->item('hr_dir').'M_hr_person','ps');
		$ps = $this->ps;
		$this->load->model($this->config->item('hr_dir').'M_appv_flow_name','fln');
		$fln = $this->fln;
		$this->load->model($this->config->item('hr_dir').'M_appv_flow_line','fl');
		$fl = $this->fl;
		$this->load->model($this->config->item('hr_dir').'M_appv_department_person','fps');
		$fps = $this->fps;
		$this->load->model($this->config->item('hr_dir').'M_appv_config','ca');
		$ca = $this->ca;
		$this->load->model($this->config->item('hr_dir').'M_hr_department','dept');
		$dept = $this->dept;
		$this->load->model($this->config->item('hr_dir').'M_appv_flow_person','al');
		$al = $this->al;
		$this->load->model($this->config->item('hr_dir').'M_appv_type','ft');
		$ft = $this->ft;
		$this->load->model($this->config->item('hr_dir').'M_hr_person_group','mgp');
		$ft = $this->ft;

		/*	$bill_type value(จากตาราง f_flowtype)
		 *	'leave'			= เส้นทางสำหรับอนุมัติการลา
		 *	'leavecancel'	= เส้นทางสำหรับอนุมัติยกเลิกการลา
		 *	'develop'		= เส้นทางสำหรับอนุมัติการพัฒนาบุคลากร
		*/
		$ftId = $ft->getFlowTypeId($bill_type);
		$ps->ps_id = $ps_id;
		$ps->get_by_key(true);

		//========== หาประเภทเส้นทางที่ต้องใช้ในการอนุมัติ ==========//
		$apfn_id = '';

		//เส้นทางอนุมัติตามบุคคล
		$qu_fln = $fln->quFlowNameByType($ftId,'ps',$ps->ps_id);
		if($qu_fln->num_rows()>0) $apfn_id = $qu_fln->row()->apfn_id;

		if($apfn_id == ''){ //เส้นทางอนุมัติตามกลุ่ม
			$rs_group = $this->mgp->hr->query("select * from hr_person_group where pg_ps_id=".$ps->ps_id);
			foreach($rs_group->result() as $row){
				$qu_fln = $fln->quFlowNameByType($ftId,'tp',$row->pg_gp_id);
				if($qu_fln->num_rows()>0){
					$apfn_id = $qu_fln->row()->apfn_id;
					break;
				}
			}
		}

		if($apfn_id == ''){ //เส้นทางอนุมัติตามประเภทบุคลากร
			$qu_fln = $fln->quFlowNameByType($ftId,'pt',$ps->ps_hire_id);
			if($qu_fln->num_rows()>0) $apfn_id = $qu_fln->row()->apfn_id;
		}

		if($apfn_id == ''){ //เส้นทางอนุมัติตามหน่วยงาน
			$dept->dept_id = $ps->ps_dept_id;
			$dept->get_by_key(true);

			$qu_fln = $fln->quFlowNameByType($ftId,'dm',$ps->ps_dept_id);
			if($qu_fln->num_rows()>0) $apfn_id = $qu_fln->row()->apfn_id;

			else if($dept->dept_parent_id!=0){
				if($ps->checkDeptHavePerson($dept->dept_parent_id)){
					$qu_fln = $fln->quFlowNameByType($ftId,'dm',$dept->dept_parent_id);
					if($qu_fln->num_rows()>0) $apfn_id = $qu_fln->row()->apfn_id;
				}
			}
		}

		if($apfn_id == ''){ //เส้นทางอนุมัติทั่วไป (default)
			$qu_fln = $fln->quFlowNameByType($ftId,'df');
			if($qu_fln->num_rows()>0) $apfn_id = $qu_fln->row()->apfn_id;
		}

		if($apfn_id == ''){
			return 0;
		}else{
			//========== หาประเภทเส้นทางที่ต้องใช้ในการอนุมัติ ==========//
			$i=0;
			$rs_fl = $fl->rsFlowLine($apfn_id);
			//echo $fl->hr->last_query();//die;
			if($rs_fl->num_rows()>0){
				foreach ($rs_fl->result() as $row){
					if($row->apfl_apdept_id == 0){//หน่วยงานตามโครงสร้าง
						$dept_parent_id = $ps->ps_dept_id;
						while($dept_parent_id!=0){
						// echo $fl->hr->last_query();die;
							//echo "sdf";

							$deptper = $dept_parent_id;
							$rs_PersonCh = $al->CheckdeptPerson($deptper,$ps_id);

							if($rs_PersonCh->num_rows() > 0){
								//foreach($rs_PersonCh->result() as $rowPerson){
									$rowPerson = $rs_PersonCh->first_row();
									$al->apfp_seq = ++$i;
									$al->apfp_dept_id = $rowPerson->dept_id;//$dept_parent_id;
									$al->apfp_apdept_id = 0;
									$al->apfp_apact_id = $row->apfl_apact_id;
									$al->apfp_status = 'W';
									$al->apfp_bill_type = $bill_type;
									$al->apfp_bill_id = $bill_id;
									$al->apfp_ps_approve_id = 0;
									$al->apfp_approve_date = '0000-00-00';
									$al->apfp_opinion = '';
									if($al->get_by_key()->num_rows() == 0 ){
										$al->insert();
									}

									//$dept_parent_id = $rs_PersonCh->row()->dept_parent_id;
								//}

								//if($ca->checkPersonActive($dept_parent_id,$ps_id)){
							}//else {//$dept_parent_id=0;
							$dept->dept_id = $deptper;
							$dept->get_by_key(true);
							$dept_parent_id = $dept->dept_parent_id;

						}

					}else{
						//$fps->checkPersonActive($row->apfl_apdept_id,$ps_id);
							$rs_PersonCh_line = $al->rsFlowPersonActive_Line(0,$row->apfl_apdept_id,$ps_id);
							//echo $al->hr->last_query();
							if($rs_PersonCh_line->num_rows() > 0){
								$al->apfp_seq = ++$i;
								$al->apfp_dept_id = 0;
								$al->apfp_apdept_id = $row->apfl_apdept_id;
								$al->apfp_apact_id = $row->apfl_apact_id;
								$al->apfp_status = 'W';
								$al->apfp_bill_type = $bill_type;
								$al->apfp_bill_id = $bill_id;
								$al->apfp_ps_approve_id = 0;
								$al->apfp_approve_date = '0000-00-00';
								$al->apfp_opinion = '';
								//if(type == "")
								if($al->get_by_key()->num_rows() == 0 ){
									$al->insert();
								}
							}
					}
				}
			}
			return ($i>=1) ? 1 : 0;
		}
	}

	function countLeaveDate($sDate, $eDate, $ps_id=0){
	
		$this->load->model($this->config->item('hr_dir').'m_calendar','cld');
		$cld = $this->cld;
		
		$cntDate = 0;
		
		while($sDate<=$eDate){
			list($s_y, $s_m, $s_d) = preg_split("[-]", $sDate);
			$tmpM=(int)$s_m; $tmpD=(int)$s_d;

			$dayInMonth = GetNumDateInMonth($tmpM,$s_y);
			if($tmpD <= $dayInMonth){//เป็นวันที่มีอยู่จริง

				//เช็คว่าเป็นวันเสาร์-อาทิตย์หรือไม่
				$today  = mktime(0, 0, 0, $s_m, $s_d, $s_y);
				$holiday = date("D",$today);

				$cDate = (string)($s_y).'-'.$s_m.'-'.$s_d;

				if(!$cld->checkHoliday($cDate) && $holiday!="Sat" && $holiday!="Sun"){//ไม่ใช่วันหยุด

				//if(!$cld->checkHoliday($cDate) and $hpp->check_holiday_by_person_id_date('Y',$cDate,$ps_id)->num_rows==0){//ไม่ใช่วันหยุดในปฏิทิน

					$cntDate++;
				}

				$tmpD+=1;
			}

			if($tmpD > $dayInMonth){
				$tmpM+=1; $tmpD=1;
				if($tmpM > 12){
					$tmpM=1; $s_y+=1;
				}
			}
			//$numI++;
			$sDate = (string)($s_y)."-".substr("0".$tmpM,-2,2)."-".substr("0".$tmpD,-2,2);
		}
		return $cntDate;
	}
	
	/*
	* get_place2
	* output query place
	* @input q
	* @output query place
	* @author Narupak krinsopon
	* @Create Date 2560-12-22
	*/
	function get_place2(){
		if(trim($this->input->post('q')) == ""){
			echo "test";
		}

        $this->load->model($this->config->item("hr_dir").'m_hr_place', 'mp');

		$arr = array();
        $rs_place = $this->mp->get_place_by_name($this->input->post('q'));
		if($rs_place->num_rows() > 0){
			foreach($rs_place->result() as $key => $row){
				$arr[$key]["place_id"] = $row->place_id;
				$arr[$key]["place_name"] = $row->place_name.'<br>'.$row->place_name_en;
				$arr[$key]["name"] = $row->place_name;
			}
			echo json_encode($arr);
		}
	}

	// function get_adline_position(){
		// if(trim($this->input->post('q')) == ""){
			// echo "test2";
		// }
		// $this->load->model($this->config->item("hr_dir").'m_hr_adline_position', 'alp');
		// $arr_alp = array();
        // $rs_alp = $this->alp->get_adline_by_name($this->input->post('q'));
		// if($rs_alp->num_rows() > 0){
			// foreach($rs_alp->result() as $key => $row){
				// $arr_alp[$key]["alp_id"] = $row->alp_id;
				// $arr_alp[$key]["alp_name"] = $row->alp_name.'<br>'.$row->alp_name_en;
				// $arr_alp[$key]["name"] = $row->alp_name;
			// }
			// echo json_encode($arr_alp);
		// }
	// }
	/*
	* get_position_number
	* output query position
	* @input q
	* @output query position
	* @author Narupak krinsopon
	* @Create Date 2560-12-22
	*/
	function get_position_number(){
		if(trim($this->input->post('q')) == ""){
			echo "test2";
		}
		$this->load->model($this->config->item('hr_dir')."m_hr_position","pos");
		$arr_pos = array();
        $rs_pos = $this->pos->get_pos_by_name($this->input->post('q'));
		if($rs_pos->num_rows() > 0){
			foreach($rs_pos->result() as $key => $row){
				$arr_pos[$key]["pos_id"] = $row->pos_id;
				$arr_pos[$key]["pos_name"] = $row->pos_name.'<br>'.$row->pos_name_en;
				$arr_pos[$key]["name"] = $row->pos_name;
			}
			echo json_encode($arr_pos);
		}
	}

	function get_leave($seqId){
		$this->load->model($this->config->item('hr_dir').$this->config->item('leave_dir').'m_leave_history','lhis');
		$hl = $this->lhis;

		$hl->quLeaveJoinType($seqId,true);

		header ('Content-type: text/html; charset=utf-8');

		echo "ได้รับอนุญาตให้".$hl->leave_name."&nbsp;&nbsp;ตั้งแต่วันที่&nbsp;".fullDate2($hl->lhis_start_date)."&nbsp;ถึงวันที่&nbsp;".fullDate2($hl->lhis_end_date)."&nbsp;&nbsp;รวม&nbsp;".$hl->lhis_num_day."&nbsp;วัน&nbsp;นั้น";
		echo "<input type='hidden' id='seqId' name='seqId' value='".$seqId."' />";
	}

	public function process($ps_id ='5911', $date=''){
		$date = $date == '' ? date("Y-m-d") : $date;
		$time = strtotime(date("Y-m-d H:i:s"));
		$this->load->model($this->config->item('hr_dir')."m_hr_time_in_out","tio");
		$this->load->model($this->config->item('hr_dir')."m_hr_work_time_attendance_config","wtac");
		$this->load->model($this->config->item('hr_dir')."m_hr_person","ps");
		$this->load->model($this->config->item('hr_dir').'m_calendar','cld');

		$qu_tio = $this->tio->get_status_maxdate($ps_id, $date);

		$wtac_id 	= $this->get_work_time($ps_id,$date);
		//echo "<br>";
		$this->wtac->wtac_id = $wtac_id;
		$this->wtac->get_by_key(true);
		$out_time = strtotime($date." ".$this->wtac->wtac_out_time);

        if($qu_tio->num_rows()>0){ //มีข้อมูลการลงเวลา
			if($qu_tio->row()->tio_flag != 'S' OR $qu_tio->row()->tio_status == 20 OR $qu_tio->row()->tio_status == 102){
			$this->tio->tio_id = $qu_tio->row()->tio_id;
			$this->tio->get_by_key(true);

			//ตรวจสอบวันทำงาน
			strtoupper(date("D",strtotime($date)));
			$arr_day = explode(",",$this->wtac->wtac_work_day);

			$check = true;
			foreach($arr_day as $val){
				if(strtoupper(date("D",strtotime($date))) == $val){
					$check = false;
					break;
				}
			}
			//วันหยุดนักขัตฤกษ์
			if($this->cld->checkHoliday($date)){
				$this->tio->tio_status = 96;
				$this->tio->update();
			}
			//วันหยุดประจำสัปดาห์
			else if($check){
				$this->tio->tio_status = 99;
				$this->tio->update();
			}else if($this->wtac->wtac_check == 'N'){
				$status = $this->check_not_timestamp($ps_id, $wtac_id, $date);
				$this->tio->tio_status = $status==20 ? 10 : $status;
				$this->tio->update();
			}else if(($qu_tio->row()->tio_in != "00:00:00") && ($qu_tio->row()->tio_out != "00:00:00")){ //ประมวลผลการเข้าทำงานเต็มวัน
				$this->tio->tio_status = $this->process_full_day($wtac_id, $qu_tio->row()->tio_in, $qu_tio->row()->tio_out,$ps_id,$date);
//				echo "full";
				$this->tio->update();
			}else if($qu_tio->row()->tio_in != "00:00:00" and $time <= $out_time){ //ประมวลผลการเข้าทำงาน
//				echo "half";
				$this->tio->tio_status = $this->process_half_day($wtac_id, $qu_tio->row()->tio_in);
				$this->tio->update();
			}elseif($qu_tio->row()->tio_in != "00:00:00" and $qu_tio->row()->tio_out == "00:00:00" and $time > $out_time){
//				เข้างานแต่ไม่มีเวลาออกงาน ให้เชคเพิ่มว่าไปราชการหรือมีใบลาหรือเปล่า
				//$this->tio->tio_status = 101;
				$status = "";
				$status = $this->check_not_timestamp($ps_id, $wtac_id, $date);
				if($status==20){
					if($qu_tio->row()->tio_in <= $this->wtac->wtac_enter_time){
						$this->tio->tio_status = 101;
					}else{
						$this->tio->tio_status = 104;
					}
				}
				// $this->tio->tio_status = $status==20 ? 101 : $status;
				$this->tio->update();
			}else{
//				echo "not";
				$this->tio->tio_status = $this->check_not_timestamp($ps_id, $wtac_id, $date);
				$this->tio->update();
			}
			}else{
				//รายบุคคล
			}
		}else{
			$this->tio->tio_ps_id			=	$ps_id;

			$this->ps->ps_id = $ps_id;
			$this->ps->get_by_key(true);

			$this->tio->tio_date			=	$date;
			$this->tio->tio_in				=	"00:00:00";
			$this->tio->tio_out				=	"00:00:00";
			$this->tio->tio_hire_id				= 	$this->ps->ps_hire_id;
			$this->tio->tio_ft_id			= 	0;
			$this->tio->tio_flag			= 	'C';
			$this->tio->tio_remark			= 	'';
			$this->tio->tio_user_update		= 	$this->session->userdata('UsPsCode');
			$this->tio->tio_update			= 	getNowDate();
			$this->tio->tio_ot_hour_amount 	= 	'';
			$this->tio->tio_otf_id			= 	0;
			$this->tio->tio_late			= 	'00:00:00';
			$this->tio->tio_early			= 	'00:00:00';
			$this->tio->tio_status 			= 	$this->check_not_timestamp($ps_id, $wtac_id, $date);
			//echo 'insert'.$tio->tio_date ;
			$this->tio->insert();
			//check leave การลา

			//check develop การไปพัฒนา / ไปราชการ

			//ไม่ต้องลงเวลา
		}
    }

	public function get_work_time($ps_id,$date){ // หารูปแบบการลงเวลาทำงาน (wtac_id)
		$this->load->model($this->config->item('hr_dir')."m_hr_person","ps");
		$this->load->model($this->config->item('hr_dir')."m_hr_work_time_attendance_config","wtac");
		$this->load->model($this->config->item('hr_dir')."M_hr_person_group","psg");
		$this->ps->ps_id = $ps_id;
		$rs_ps = $this->ps->get_by_key()->row();

		//$gp_id = $this->psg->get_group_id($ps_id, $date)->first_row(); //รอวิธีการหาค่าของกลุ่ม
		if($this->psg->get_group_id($ps_id, $date)->num_rows()>0){
			$gp_id = $this->psg->get_group_id($ps_id, $date)->first_row()->pg_gp_id;
		}else{
			$gp_id = 0;
		}
		$get_wtac = $this->wtac->get_key_wtac_by_atid_codeid($ps_id, $gp_id, $rs_ps->ps_hire_id, $rs_ps->ps_dept_id,$date);

		//return (($get_wtac->first_row()->wtac_id==5)?false:$get_wtac->first_row()->wtac_id);
		return $get_wtac->first_row()->wtac_id;
	}

	//ประมวลผลครึ่งวัน
	public function process_half_day($wtac_id, $tio_in){
		$this->load->model($this->config->item('hr_dir')."m_hr_work_time_attendance_config","wtac");
		$this->wtac->wtac_id = $wtac_id;
		$rs_wtac = $this->wtac->get_by_key()->row();
		if($tio_in <= $rs_wtac->wtac_enter_time){
			return 10;
		}else if($tio_in <= $rs_wtac->wtac_late_time){
			return 11;
		}
	}

	//ประมวลผลเต็มวัน
	public function process_full_day($wtac_id, $tio_in, $tio_out,$ps_id,$date){
		$this->load->model($this->config->item('hr_dir')."m_hr_work_time_attendance_config","wtac");
		$this->load->model($this->config->item('hr_dir').$this->config->item('leave_dir').'m_leave_history','lhis');
		$this->wtac->wtac_id = $wtac_id;
		$rs_wtac = $this->wtac->get_by_key()->row();
		// pre($rs_wtac);
		if(($tio_in <= $rs_wtac->wtac_enter_time) && ($tio_out >= $rs_wtac->wtac_out_time)){ //กลุ่มมาทำงานปกติ
			//echo "ปกติ";
			return 10;
		}else if($this->lhis->rs_leave_active($ps_id,$date)->num_rows()>0){//ลาครึ่งวัน
			return (4).$this->lhis->rs_leave_active($ps_id,$date)->row()->lhis_leave_id;
		}else if(($tio_in <= $rs_wtac->wtac_enter_time) && ($tio_out < $rs_wtac->wtac_out_time)){ //กลุ่มออกก่อนเวลา
			if($tio_out < $rs_wtac->wtac_late_time){ //ออกก่อนสาย
				//echo "ออกก่อนเวลาสาย";
				return 22;
			}else if(($tio_out >= $rs_wtac->wtac_late_time) && ($tio_out <= $rs_wtac->wtac_half_day_time)){ //ออกก่อนเวลาทำงานครึ่งวันเช้า
				return 18;
				//echo "ออกก่อนเวลาทำงานครึ่งวันเช้า";
			}else if(($tio_out > $rs_wtac->wtac_half_day_time) && ($tio_out < $rs_wtac->wtac_out_time)){ //ออกก่อนเวลาปกติ
				//echo "ออกก่อนเวลาปกติ";
				return 14;
			}
		}else if(($tio_in > $rs_wtac->wtac_enter_time) && ($tio_out >= $rs_wtac->wtac_out_time)){ //กลุ่มเข้างานสาย/เข้างานครึ่งวัน
			//echo "<br>".$tio_in;
			//echo "<br>".$rs_wtac->wtac_late_time;
			if($tio_in <= $rs_wtac->wtac_late_time){ //สาย
				//echo "สาย";
				return 11;
			}else if(($tio_in > $rs_wtac->wtac_late_time) && ($tio_in <= $rs_wtac->wtac_half_day_time)){ //เข้างานครึ่งบ่าย
				//echo "เข้างานครึ่งบ่าย";
				return 12;
			}
		}else if(($tio_in > $rs_wtac->wtac_enter_time) && ($tio_out < $rs_wtac->wtac_out_time)){ //สายและออกก่อนเวลา
			if($tio_out < $rs_wtac->wtac_late_time){ //ไม่มาทำงาน
				//echo "ไม่มาทำงาน";
				return 20;
			// }else if($tio_out < $rs_wtac->wtac_bf_out_half_time){ //สายออกก่อนครึ่งวัน
				// echo "สายออกก่อนครึ่งวัน";
				// return 19;
			}else if($tio_out < $rs_wtac->wtac_half_day_time){ //สายออกก่อนครึ่งวัน
				//echo "สายออกก่อนครึ่งวัน";
				return 19;
			//}else if($tio_out < $rs_wtac->wtac_bf_out_time){ //สายทำงานครึ่งวัน
				//echo "สายทำงานครึ่งวัน";
			}else{
				return 15;
				//echo "สายและออกก่อนเวลา";
			}
		}
	}

	function get_address(){
		if(trim($this->input->post('q')) == ""){
			echo "";
		}

        $this->load->model($this->config->item("hr_dir").'m_hr_district', 'mdt');

		$arr = array();
        $rs_address = $this->mdt->get_address($this->input->post('q'));
		if($rs_address->num_rows() > 0){
			foreach($rs_address->result() as $key => $row){
				$arr[$key]["dist_id"] = $row->dist_id;
				$arr[$key]["dist_name"] = $row->dist_name;
				$arr[$key]["name"] = "อ.".$row->amph_name." จ.".$row->pv_name;
				$arr[$key]["amph_name"] = $row->amph_name;
				$arr[$key]["amph_id"] = $row->amph_id;
				$arr[$key]["pv_id"] = $row->pv_id;
				$arr[$key]["pv_name"] = $row->pv_name;
			}
			echo json_encode($arr);
		}
	}

	function get_education_dg(){
		if(trim($this->input->post('q')) == ""){
			echo "test";
		}

        $this->load->model($this->config->item("hr_dir").'m_hr_education_degree', 'med');

		$arr = array();
        $rs_degree = $this->med->get_education_degree($this->input->post('q'));
		if($rs_degree->num_rows() > 0){
			foreach($rs_degree->result() as $key => $row){
				$arr[$key]["edudg_id"] = $row->edudg_id;
				$arr[$key]["edudg_name"] = $row->edudg_name.($row->edudg_abbr!=""?"(".$row->edudg_abbr.")":"");
				$arr[$key]["edudg_name_en"] = $row->edudg_name_en."(".$row->edudg_abbr_en.")";
			}
			echo json_encode($arr);
		}
	}
	function get_education_mj(){
		if(trim($this->input->post('q')) == ""){
			echo "test";
		}

        $this->load->model($this->config->item("hr_dir").'m_hr_education_major', 'mej');

		$arr = array();
        $rs_major = $this->mej->get_education_major2($this->input->post('q'));
		if($rs_major->num_rows() > 0){
			foreach($rs_major->result() as $key => $row){
				$arr[$key]["edumj_id"] = $row->edumj_id;
				$arr[$key]["edumj_name"] = $row->edumj_name;
				$arr[$key]["edumjt_icon"] = $row->edumjt_icon;
				$arr[$key]["edumjt_color"] = $row->edumjt_color;
				$arr[$key]["edumjt_id"] = $row->edumjt_id;
			}
			echo json_encode($arr);
		}
	}

	public function check_not_timestamp($ps_id, $wtac_id, $date){ //ตรวจสอบกรณีที่ไม่มีข้อมูลการลงเวลาทำงาน
		$this->load->model($this->config->item('hr_dir')."m_hr_work_time_attendance_config","wtac");
		$this->load->model($this->config->item('hr_dir').'m_calendar','cld');
		$this->load->model($this->config->item('hr_dir').$this->config->item('leave_dir').'m_leave_history','lhis');
		$this->load->model($this->config->item('hr_dir').'M_dev_developperson','devps');
		$this->load->model($this->config->item('hr_dir').'M_hr_education_leave','eduleave');

		$this->wtac->wtac_id = $wtac_id;
		$this->wtac->get_by_key(true);


		$arr_day = explode(",",$this->wtac->wtac_work_day);
		$check = true;
		foreach($arr_day as $val){
			if(strtoupper(date("D",strtotime($date))) == $val){
				$check = false;
				break;
			}
		}
		//วันหยุดนักขัตฤกษ์
		if($this->cld->checkHoliday($date)){
			return 96;
		}
		//วันหยุดประจำสัปดาห์
		else if($check){
			return 99;
		}
		//ไม่ต้องลงเวลาทำงาน
		else if($this->wtac->wtac_check == 'N'){
			return 10;
		}
		//ลา
		else if($this->lhis->rs_leave_active($ps_id,$date)->num_rows()>0){
			return (3).$this->lhis->rs_leave_active($ps_id,$date)->row()->lhis_leave_id;
		}

		//ไปราชการ
		else if($this->devps->rs_ps_go_work($ps_id,$date)->num_rows()>0){
			return 23;
		}
		//ลาศึกษาต่อ
		else if($this->eduleave->qu_ps_education_leave($ps_id,$date)->num_rows()>0){
			return 8;
		}

		//ขาด
		else{
			return 20;
		}
	}

	function get_config()
	{
		$rs_config = $this->hr->query("select * from hr_config");
		//$this->config->set_item('txt_ok', 'item_value');
		foreach($rs_config->result() as $row){
			$this->hr_config[$row->cf_key] = json_decode($row->cf_value);
			$this->config->set_item($row->cf_key, json_decode($row->cf_value));
			//echo $row->cf_key."=>".json_decode($row->cf_value)."<br>";
		}
	}


	function report_position(){
		$rs_kp = $this->hr->query("
			select ps_fname,ps_lname,hr_kp_position_history.*
			from
			hr_kp_position_history
			left join hr_person
				ON ps_id = kppos_ps_id");
		echo "<table style='border-collapse: collapse;'>";
		foreach($rs_kp->result_array() as $key=>$val){
			echo "<tr style='border: 1px solid black;'>";
			foreach($val as $key2=>$val2){
				echo "<td style='border: 1px solid black;'>";
				echo $val2;
				echo "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}

	function get_person_ajax(){
		if(trim($this->input->post('q')) == ""){
			die;
		}

        $this->load->model($this->config->item("hr_dir").'reward/M_rs_user', 'mus');

		$arr = array();
        $rs_us = $this->mus->getByLikeName($this->input->post('q'));
        echo "<pre>";
        print_r($rs_us->result());die;
		if($rs_us->num_rows() > 0){
			foreach($rs_us->result() as $key => $row){
				$arr[$key]["us_id"] = $row->us_id;
				$arr[$key]["name"] = $row->ps_fname." ".$row->ps_lname."<br />".$row->ps_fname_en." ".$row->ps_lname_en;
				$arr[$key]["author"] = $row->ps_fname." ".$row->ps_lname;
				$arr[$key]["dpId"] = $row->dpID;
				$arr[$key]["dpName"] = $row->dpName;
				$ph_str = '';
				if($row->psd_work_phone){
					$ph_str .= $row->psd_work_phone;
					if($row->psd_ex_phone){
						$ph_str .= "(".$row->psd_ex_phone.")";
					}
				}
				$arr[$key]["phone"] = $ph_str;
				$arr[$key]["emailAddr"] = $row->psd_email;
			}
			echo json_encode($arr);
		}
    }
}
}
?>