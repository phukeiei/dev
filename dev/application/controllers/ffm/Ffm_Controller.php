<?php
/*
 * ffm_controller
 * Main Controller
 * Copyright (c) 2559. Information System Engineering Research Laboratory.
 * @Author Phanuphan
 * @Create Date 2562-05-15
 */
include_once('application/controllers/UMS_Controller.php');

if(!defined("Ffm_Controller")){
	define("Ffm_Controller","Ffm_Controller");

class Ffm_Controller extends UMS_Controller {

	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->hr =$this->load->database('ffm', TRUE);
    }
	
	public function index()
    {

        $this->outputs( 'v_main' );
    }

	public function javascript()
	{
  		parent::javascript();
  		$this->load->view($this->config->item("hr_dir").'v_javascript');
  	}
	// function footer()
	// {
		// parent::footer();
		// $this->load->view($this->config->item('hr_dir').'v_footer');
	// }

	// public function outputs($v)
	// {
		// $body = $this->config->item("hr_dir").$v;
		// parent::output($body,$this->data);
	// }

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

	function gen_datadic($table='ossd_ffmdb')
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
		header("Content-Disposition: attachment; filename=".$table."_datadict.doc");
		$this->gen_datadic($table);
	}

	function gen_datadic_excel($table='pck_hrdb'){
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=".$table."_datadict.xls");
		$this->gen_datadic($table);
	}

	function calculate_cost($start_time = '', $end_time = '', $field = '', $type = '', $return_type = ''){

		if ($start_time == '') {
			$start_time = $this->input->post('start_time');
		}
		if ($end_time == '') {
			$end_time = $this->input->post('end_time');
		}
		if ($field == '') {
			$field = $this->input->post('field');
		}
		if ($type == '') {
			$type = $this->input->post('type');
		}
		if ($return_type == '') {
			$return_type = $this->input->post('return_type');
		}

		// pre($_POST);

		// echo $start_time;

        $this->load->model('ffm/backend/M_service', 'ms');

        $this->ms->start_time = $start_time;
        $this->ms->end_time = $end_time;
        $this->ms->field = $field;
        $this->ms->type = $type;

		$time = $this->ms->get_time()->result();
		
		// pre($time);

        foreach($time AS $index => $row) {
            $s_time = new DateTime();
            $e_time = new DateTime();
            if ($index == 0) {
                $n_start_time = $start_time;
                $n_end_time = $end_time;

                if ($n_start_time < $row->cc_start_time) {
                    $n_start_time = $row->cc_start_time;
                }

                if ($n_end_time > $row->cc_end_time) {
                    $n_end_time = $row->cc_end_time;
                }
                    
            } else if ($index == sizeof ($time) - 1) {
                $n_start_time = $row->cc_start_time;
                $n_end_time = $end_time;

                if ($n_end_time > $row->cc_end_time) {
                    $n_end_time = $row->cc_end_time;
                }
            } else {
                $n_start_time = $row->cc_start_time;
                $n_end_time = $row->cc_end_time;
            }

            $start_time_array = explode(':', $n_start_time);
            $end_time_array = explode(':', $n_end_time);

            $s_time->setTime($start_time_array[0], $start_time_array[1], $start_time_array[2] );
            $e_time->setTime($end_time_array[0], $end_time_array[1], $end_time_array[2] );

			$time_diff = $s_time->diff($e_time)->h;
			
			if ($time_diff == 0) {
				$time_diff = 1;
			}

            $price = $time_diff * $row->cc_cost;
            $row->price = $price;
            $row->s_time = $start_time;
            $row->e_time = $end_time;
                
        }

        if ($return_type == 1) {
            echo json_encode($time);
        } else {
            return $time;
        }
        
	}
	
	// public function output_frontend($v,$data,$test=0)
	// {
		// $body = $v;
		// parent::output_frontend($body,$data);
	// }

}
}
?>