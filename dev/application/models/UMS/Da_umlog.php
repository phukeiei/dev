<?php
include_once("My_model.php");
class Da_umlog extends My_model{
	//PK is LogID
	public $LogID;
	public $LogTime;
	public $LogIP;
	public $LogUsID;
	public $LogAction;
	public $LogHtID="";
	
	public $last_insert_id;
	
	function __construct(){
		parent::__construct();
	}
	
	function insert(){
		$sql = " INSERT INTO umlog (LogID,LogTime,LogIP,LogUsID,LogAction,LogHtID)
				 VALUES( , ,?,?,?,?);";
		
		 
		$this->ums->query($sql,array($this->input->ip_address(),$this->session->userdata('UsID'),$this->LogAction,$this->LogHtID));
		$this->last_insert_id = $this->ums->insert_id();
	}
	function delete(){
		$sql = " DELETE FROM umlog
				WHERE LogID=?";
		
		 
		$this->ums->query($sql, array($this->LogID));
	}
	// Get By User ID
	function get_by_ID(){
		$sql = "SELECT * 
				FROM umlog 
				WHERE LogUsID= ?
                ORDER BY (LogTime) DESC";
		$query = $this->ums->query($sql, array($this->session->userdata('UsID')));
		return $query ;
	}
	// Get By Using Time 
	// This Function is not complete yet because when search by time 
	// it want 2 variable time-start and time-end
	function get_by_Time(){
		$sql = "SELECT * 
				FROM umlog 
				WHERE LogTime=?";
		$query = $this->ums->query($sql, array($this->LogTime));
		return $query ;
	}
	// Get By Using IP Address
	function get_by_IP(){
		$sql = "SELECT * 
				FROM umlog 
				WHERE LogIP=?";
		$query = $this->ums->query($sql, array($this->LogIP));
		return $query ;
	}
	function login(){
		$sql = " INSERT INTO umlog (LogID,LogTime,LogIP,LogUsID,LogAction)
				 VALUES('',CURRENT_TIMESTAMP,?,?,?);";
		 
		$this->LogAction = "เข้าสู่ระบบ สำเร็จ";
		$this->ums->query($sql,array($this->input->ip_address(),$this->session->userdata('UsID'),$this->LogAction));
		$this->last_insert_id = $this->ums->insert_id();
	}
	
	function wrongpass($UsID){
		$sql = " INSERT INTO umlog (LogID,LogTime,LogIP,LogUsID,LogAction)
				 VALUES('',CURRENT_TIMESTAMP,?,?,?);";
		 
		$this->LogAction = "ไม่สามารถเข้าสู่ระบบ รหัสผ่านผิด";
		$this->ums->query($sql,array($this->input->ip_address(),$UsID,$this->LogAction));
		$this->last_insert_id = $this->ums->insert_id();		
	}
	
	function loginfailed(){
		$sql = " INSERT INTO umlog (LogID,LogTime,LogIP,LogUsID,LogAction)
				 VALUES('',CURRENT_TIMESTAMP,?,?,?);";
		 
		$this->LogAction = "ไม่สามารถเข้าสู่ระบบ ไม่มีผู้ใช้นี้";
		$this->ums->query($sql,array($this->input->ip_address(),0,$this->LogAction));
		$this->last_insert_id = $this->ums->insert_id();
	}
	function logout(){
		$sql = " INSERT INTO umlog (LogID,LogTime,LogIP,LogUsID,LogAction)
				 VALUES('',CURRENT_TIMESTAMP,?,?,?);";
		 
		$this->LogAction = "ออกจากระบบ สำเร็จ";
		$this->ums->query($sql,array($this->input->ip_address(),$this->session->userdata('UsID'),$this->LogAction));
		$this->last_insert_id = $this->ums->insert_id();
	}
	function getgear($GpName,$SysName)
	{
		$sql = " INSERT INTO umlog (LogID,LogTime,LogIP,LogUsID,LogAction)
				 VALUES('',CURRENT_TIMESTAMP,?,?,?);";
		 
		$this->LogAction = "เข้าใช้สิทธิ์ ".$GpName." ใน ".$SysName;
		$this->ums->query($sql,array($this->input->ip_address(),$this->session->userdata('UsID'),$this->LogAction));
		$this->last_insert_id = $this->ums->insert_id();
	}
	function adddata($table,$HtID)
	{
		$sql = " INSERT INTO umlog (LogID,LogTime,LogIP,LogUsID,LogAction,LogHtID)
				 VALUES('',CURRENT_TIMESTAMP,?,?,?,?);";
		
		 
		$this->LogAction = "เพิ่มข้อมูลลงในตาราง ".$table;
		$this->ums->query($sql,array($this->input->ip_address(),$this->session->userdata('UsID'),$this->LogAction,$HtID));
		$this->last_insert_id = $this->ums->insert_id();
	}
	function updatedata($table,$HtID)
	{
		$sql = " INSERT INTO umlog (LogID,LogTime,LogIP,LogUsID,LogAction,LogHtID)
				 VALUES('',CURRENT_TIMESTAMP,?,?,?,?);";
		
		 
		$this->LogAction = "แก้ไขข้อมูลลงในตาราง ".$table;
		$this->ums->query($sql,array($this->input->ip_address(),$this->session->userdata('UsID'),$this->LogAction,$HtID));
		$this->last_insert_id = $this->ums->insert_id();
	}
	function deletedata($table,$HtID)
	{
		$sql = " INSERT INTO umlog (LogID,LogTime,LogIP,LogUsID,LogAction,LogHtID)
				 VALUES('',CURRENT_TIMESTAMP,?,?,?,?);";
		
		 
		$this->LogAction = "ลบข้อมูลลงในตาราง ".$table;
		$this->ums->query($sql,array($this->input->ip_address(),$this->session->userdata('UsID'),$this->LogAction,$HtID));
		$this->last_insert_id = $this->ums->insert_id();
	}
	function changepermission($GpID)
	{
		$sql = " INSERT INTO umlog (LogID,LogTime,LogIP,LogUsID,LogAction,LogHtID)
				 VALUES('',CURRENT_TIMESTAMP,?,?,?,?);";
		
		 
		$this->LogAction = "เปลี่ยนสิทธิ์การใช้ ".$GpID;
		$this->ums->query($sql,array($this->input->ip_address(),$this->session->userdata('UsID'),$this->LogAction,NULL));
		$this->last_insert_id = $this->ums->insert_id();
		
	}
}
?>
