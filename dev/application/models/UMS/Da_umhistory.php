<?php
include_once("My_model.php");
class Da_umhistory extends My_model{
	//PK is LogID
	public $HtID;		
	public $HtUSID;		// Who?
	public $HtTime;		// When?
	public $HtTable;	// What's table?
	public $HtOld;	// Old Data
	public $HtNew;	// New Data
	public $HtDtID; // History Data ID
	
	public $last_insert_id;
	
	function __construct(){
		parent::__construct();
	}
	
	function insert($table,$old,$new,$id,$desc){
		$sql = " INSERT INTO umhistory (HtID,HtUsID,HtTime,HtTable,HtOld,HtNew,HtDtID,HtDesc)
				 VALUES('',?,CURRENT_TIMESTAMP,?,?,?,?,?)";
		 
		$this->ums->query($sql,array($this->session->userdata('UsID'),$table,$old,$new,$id,$desc));
		$this->last_insert_id = $this->ums->insert_id();
		return $this->last_insert_id;
	}
	function delete(){
		$sql = " DELETE FROM umhistory
				WHERE HtID=?";
		
		 
		$this->ums->query($sql, array($this->LogID));
	}
	// Get By User ID
	function get_by_ID(){
		$sql = "SELECT * 
				FROM umhistory 
				WHERE HtUsID=?";
		$query = $this->ums->query($sql, array($this->session->userdata('UsID')));
		return $query ;
	}
	// Get By Using Time 
	// This Function is not complete yet because when search by time 
	// it want 2 variable time-start and time-end
	function get_by_Time(){
		$sql = "SELECT * 
				FROM umhistory 
				WHERE HtTime=?";
		$query = $this->ums->query($sql, array($this->LogTime));
		return $query ;
	}
}
?>
