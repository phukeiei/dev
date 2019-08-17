<?php

include_once("My_model.php");

class Da_umicon extends My_model {		
	
	// PK is IcName
	
	public $IcID;
	public $IcName;
	public $IcType;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umicon (IcID, IcName, IcType)
				VALUES(?, ?, ?)";
		
		 
		$this->ums->query($sql, array($this->IcID, $this->IcName, $this->IcType));
		$this->last_insert_id = $this->ums->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umicon 
				SET	IcID=?, IcType=? 
				WHERE IcName=?";	
		
		 
		$this->ums->query($sql, array($this->IcID, $this->IcType, $this->IcName));
		
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umicon
				WHERE IcID=?";
		
		 
		$this->ums->query($sql, array($this->IcID));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umicon 
				WHERE IcID=?";
		$query = $this->ums->query($sql, array($this->IcID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_umicon
?>
