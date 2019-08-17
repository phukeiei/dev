<?php

include_once("My_model.php");

class Da_umuser extends My_model {		
	
	// PK is UsID
	
	public $UsID;
	public $UsName;
	public $UsLogin;
	public $UsPassword;
	public $UsPsCode;
	public $UsWgID;
	public $UsQsID;
	public $UsAnswer;
	public $UsEmail;
	public $UsActive;
	public $UsAdmin;
	public $UsDesc;
	public $UsPwdExpDt;
	public $UsUpdDt;
	public $UsUpdUsID;
	public $UsSessionID;
	public $UsDpID;

	public $last_insert_id;
	public $HRDB = "pi_hrdb";
	public $UMDB = "pi_umsdb";
	
	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umuser (UsID, UsName, UsLogin, UsPassword, UsPsCode, UsWgID, UsQsID, UsAnswer, UsEmail, UsActive, UsAdmin, UsDesc, UsPwdExpDt, UsUpdDt, UsUpdUsID, UsSessionID,UsDpID)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
		 
		$this->ums->query($sql, array($this->UsID, $this->UsName, $this->UsLogin, $this->UsPassword, $this->UsPsCode, $this->UsWgID, $this->UsQsID, $this->UsAnswer, $this->UsEmail, $this->UsActive, $this->UsAdmin, $this->UsDesc, $this->UsPwdExpDt, $this->UsUpdDt, $this->UsUpdUsID, $this->UsSessionID, $this->UsDpID));
		$this->last_insert_id = $this->ums->insert_id();
		
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umuser 
				SET	UsName=?, UsLogin=?, UsPsCode=?, UsWgID=?, UsQsID=?, UsAnswer=?, UsEmail=?, UsActive=?, UsAdmin=?, UsDesc=?, UsPwdExpDt=?, UsUpdDt=?, UsUpdUsID=?, UsSessionID=? ,UsDpID=?
				WHERE UsID=?";	
		 
		$this->ums->query($sql, array($this->UsName, $this->UsLogin, $this->UsPsCode, $this->UsWgID, $this->UsQsID, $this->UsAnswer, $this->UsEmail, $this->UsActive, $this->UsAdmin, $this->UsDesc, $this->UsPwdExpDt, $this->UsUpdDt, $this->UsUpdUsID, $this->UsSessionID, $this->UsDpID , $this->UsID));
	}

	function updateAdmin() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umuser 
				SET	UsName=?, UsLogin=?, UsPsCode=?, UsPassword=?, UsWgID=?, UsQsID=?, UsAnswer=?, UsEmail=?, UsActive=?, UsAdmin=?, UsDesc=?, UsPwdExpDt=?, UsUpdDt=?, UsUpdUsID=?, UsSessionID=? ,UsDpID=?
				WHERE UsID=?";	
		 
		$this->ums->query($sql, array($this->UsName, $this->UsLogin, $this->UsPsCode, $this->UsPassword, $this->UsWgID, $this->UsQsID, $this->UsAnswer, $this->UsEmail, $this->UsActive, $this->UsAdmin, $this->UsDesc, $this->UsPwdExpDt, $this->UsUpdDt, $this->UsUpdUsID, $this->UsSessionID, $this->UsDpID , $this->UsID));
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umuser
				WHERE UsID=?";
		 
		$this->ums->query($sql, array($this->UsID));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umuser 
				WHERE UsID=?";
		$query = $this->ums->query($sql, array($this->UsID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	function get_by_id($UsID)
	{
		$sql ="SELECT *
				FROM umuser
				WHERE UsID=?";
		$query = $this->ums->query($sql,$UsID);
		return $query;
	}
	
	function changepass($mdpass)
	{
		$sql ="UPDATE umuser
				SET UsPassword=?
				WHERE UsID=?";
		 
		$this->ums->query($sql,array($mdpass,$this->session->userdata('UsID')));
		
	}
	
	function get_by_id_with_wgroup($UsID)
	{
		$sql ="SELECT * 
			FROM umuser inner join umwgroup on umwgroup.WgID=umuser.UsWgID
			WHERE UsID=?";
		$query = $this->ums->query($sql,$UsID);
		return $query;
	}
	
	function get_by_not_in_WgID($WgID)
	{ // อันใหม่เอาแค่ชื่อกลุ่มผู้ใช้ ที่ไม่ใช้ทีมพัฒนาระบบ ม. บูรพา และผู้ดูและระบบ
		// $sql ="select * from umwgroup 
		// where WgID !=(SELECT UsWgID 
			// FROM umuser
			// WHERE UsID=? )";
		$sql ="select * from umwgroup WHERE WgID NOT IN($WgID)";
		$query = $this->ums->query($sql);
		return $query;	
	}
	
	function get_all_WgID(){
		$sql ="select * from umwgroup";
		$query = $this->ums->query($sql);
		return $query;
	}
	
	function get_by_id_with_question($UsID)
	{
		$sql ="SELECT * 
			FROM umuser inner join umquestion on umquestion.QsID=umuser.UsQsID
			WHERE UsID=?";
		$query = $this->ums->query($sql,$UsID);
		return $query;
	}
	function get_by_not_in_QsID($UsID)
	{
		$sql ="select * from umquestion 
		where QsID !=(SELECT UsQsID 
			FROM umuser
			WHERE UsID=?)";
		$query = $this->ums->query($sql,$UsID);
		return $query;	
	}
	function get_by_id_with_department($UsID)
	{
		$sql ="SELECT * 
			FROM umuser inner join umdepartment on umdepartment.dpID=umuser.UsDpID
			WHERE UsID=?";
		$query = $this->ums->query($sql,$UsID);
		return $query;
	}
	function get_by_not_in_dpID($UsID)
	{
		$sql ="select * from umdepartment 
		where dpID !=(SELECT UsDpID 
			FROM umuser
			WHERE UsID=?)";
		$query = $this->ums->query($sql,$UsID);
		return $query;	
	}
	function get_by_many_add($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umuser 
				WHERE UsPsCode=? and UsName=? and UsWgID=? and UsLogin=? and UsEmail=? ";
		$query = $this->ums->query($sql, array($this->UsPsCode,$this->UsName,$this->UsWgID,$this->UsLogin,$this->UsEmail));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	function SearchByKey()
	{
		$sql ="SELECT *
				FROM umuser
				WHERE UsID=?";
		$query = $this->ums->query($sql,array($this->UsID));
		return $query;
	}
	function get_count_wg($wgid){
		$sql="SELECT count(*) as wgcount from umuser where UsWgID =? ";
		$query = $this->ums->query($sql,array($wgid));
		return $query;
	}
	function get_by_wgid($wgid){
		$sql="SELECT * from umuser where UsWgID =? ";
		$query = $this->ums->query($sql,array($wgid));
		return $query;
	}
	function get_user_not_own_group($gpid,$wgid){
		$sql="select * from umuser where UsWgID = ? and UsID not in (select UgUsID from umusergroup where UgGpID = ?)";
		$query = $this->ums->query($sql,array($wgid,$gpid));
		return $query;
	}
	function get_report_by_system($UgGpID)
	{
		$sql ="SELECT StID,StNameT,GpID,GpNameT,dpName, adminposName, UsName, UsLogin 
				FROM ".$this->UMDB.".umusergroup 
				left join ".$this->UMDB.".umuser on UgUsID=UsID 
				left join ".$this->UMDB.".umdepartment on UsDpID=dpID 
				left join ".$this->UMDB.".umgroup on UgGpID=GpID
				left join ".$this->UMDB.".umsystem on GpStID=StID
				left join ".$this->HRDB.".Person psn on UsPsCode=personId 
				left join ".$this->HRDB.".Adminpos adp on psn.adminposId=adp.adminposId
				WHERE UgGpID=?";
		$query = $this->ums->query($sql,array($UgGpID));
		return $query;	
	}


}	 //=== end class Da_umuser
?>
