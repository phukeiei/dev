<?php
/*
 * Hr_model
 * Model for Manage about openhr_model.
 * Copyright (c) 2559. Information System Engineering Research Laboratory.
 * @Author Chain_Chaiwat
 * @Create Date 2559-07-01
*/
class Hr_model extends CI_Model {
	
	public $hr;
	public $hr_db;


	function __construct() {
		parent::__construct();
		
		// config load database
		//-- หากฐานข้อมูลมีการเปลี่ยนแปลง ให้มีตั้งค่าในส่วนนี้ด้วย!!!

//echo $this->session->userdata('UsDpID');

	    $this->hr = $this->load->database('hr', TRUE);
		$this->hr_db = $this->hr->database;
	}
	
	function row2attribute($rw) {
		foreach ($rw as $key => $value) {
			if ( is_null($value) ) 
				eval("\$this->$key = NULL;");
			else
				$value = str_replace("'","&apos;",$value);
				eval("\$this->$key = '$value';");
		}
	}
	
	/* จำนวนข้อมูลหลังจากค้นหา */
	function getFoundForJSON(){
		$sql="SELECT FOUND_ROWS() AS found";
		$query = $this->hr->query($sql);
		return $query;
	}
	
	/*
	/* เอา Query ที่ได้สร้างเป็น array ในรูปแบบ $key=>$value
	/* $qry คือ query ที่ได้มาจาก model
	/* $kye คือ pk ที่ต้องการ
	/* $val คือ ค่าที่ต้องการแสดงใน dropdown
	/* $optional คือ การเลือกว่าจะมีคำสั่งอะไรก่อนข้อมูลหรือไม่ y คือ มีก่อน n คือไม่ต้องมี
	/* $str คือ string ที่ต้องการแสดง
	*/
	function get_options_hr($qry,$key,$val,$optional='y',$str='-----เลือก-----') {
		//$qry = $this->get_all();
		$opt = array();
		if ($optional=='y') $opt[''] = $str;
		foreach ($qry->result() as $row) {
			$opt[$row->$key] = $row->$val;
		}
		return $opt;
	}
	// public function query()
	// {
  		// parent::query();
  		// $query = $this->hr->query($query,$data);
		// $last_query = $this->hr->last_query();
		// $last_query = str_replace("\"","\\\"",$last_query);
		// $this->hr->query("insert into log (log_sql) value (\"".$last_query."\");");
		// /* echo "<script>";
		// echo "console.log('".$this->hr->last_query()."')";
		// echo "</script>"; */
		// return $query;
  	// }
	function hr_query($query,$data){
		$query = $this->hr->query($query,$data);
		// $last_query = $this->hr->last_query();
		// $last_query = str_replace("\"","\\\"",$last_query);
		// $this->hr->query("insert into log (log_sql) value (\"".$last_query."\");");
		/* echo "<script>";
		echo "console.log('".$this->hr->last_query()."')";
		echo "</script>"; */
		return $query;
	}

}

?>