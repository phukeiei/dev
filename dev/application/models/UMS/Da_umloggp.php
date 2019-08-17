<?php
include_once("My_model.php");
class Da_umloggp extends My_model{
	//PK is LogID
	public $id;
	public $UsID;
	public $GpID;
	public $status;
	public $start_time;
	public $end_time;
	
	public $last_insert_id;
	
	function __construct(){
		parent::__construct();
	}
	
	function insert(){
		$sql = "INSERT INTO `umloggp` (`id`, `UsID`, `GpID`, `status`, `start_time`, `end_time`) 
		VALUES ('0', ?, ?, '1', CURDATE(), NULL)";
		 
		$this->ums->query($sql,array($this->UsID,$this->GpID));
		$this->last_insert_id = $this->ums->insert_id();
	}

	function update(){
		$sql = " Update umloggp
				SET end_time=CURDATE(), status='0'
				Where UsID=? and GpID=? and status='1'";
		$this->ums->query($sql,array($this->UsID,$this->GpID));
		
	}
	function delete(){
		$sql = " DELETE FROM umloggp
				WHERE id=?";
		
		 
		$this->ums->query($sql, array($this->id));
	}

}
?>
