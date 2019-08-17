<?php

include_once("My_model.php");

class Da_umshowprofile extends My_model {		
	
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

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umuser (UsID, UsName, UsLogin, UsPassword, UsPsCode, UsWgID, UsQsID, UsAnswer, UsEmail, UsActive, UsAdmin, UsDesc, UsPwdExpDt, UsUpdDt, UsUpdUsID, UsSessionID)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		
		 
		$this->ums->query($sql, array($this->UsID, $this->UsName, $this->UsLogin, $this->UsPassword, $this->UsPsCode, $this->UsWgID, $this->UsQsID, $this->UsAnswer, $this->UsEmail, $this->UsActive, $this->UsAdmin, $this->UsDesc, $this->UsPwdExpDt, $this->UsUpdDt, $this->UsUpdUsID, $this->UsSessionID));
		$this->last_insert_id = $this->ums->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umuser 
				SET	UsName=?, UsLogin=?, UsPassword=?, UsPsCode=?, UsWgID=?, UsQsID=?, UsAnswer=?, UsEmail=?, UsActive=?, UsAdmin=?, UsDesc=?, UsPwdExpDt=?, UsUpdDt=?, UsUpdUsID=?, UsSessionID=? 
				WHERE UsID=?";	
		
		 
		$this->ums->query($sql, array($this->UsName, $this->UsLogin, $this->UsPassword, $this->UsPsCode, $this->UsWgID, $this->UsQsID, $this->UsAnswer, $this->UsEmail, $this->UsActive, $this->UsAdmin, $this->UsDesc, $this->UsPwdExpDt, $this->UsUpdDt, $this->UsUpdUsID, $this->UsSessionID, $this->UsID));
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
}	 //=== end class Da_umuser
?>
