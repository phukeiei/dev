<?php

include_once("My_model.php");

class Da_umuserservice extends My_model {		
	
	// PK is UuUsID, UuSvID
	
	public $UuID;
	public $UuUsID;
	public $UuSvID;

	public $last_insert_id;

	function __construct() {
		parent::Model();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umuserservice (UuID, UuUsID, UuSvID)
				VALUES(?, ?, ?)";
		 
		$this->ums->query($sql, array($this->UuID, $this->UuUsID, $this->UuSvID));
		$this->last_insert_id = $this->ums->insert_id();
		
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umuserservice 
				SET	UuID=? 
				WHERE UuUsID=?, UuSvID=?";	
		 
		$this->ums->query($sql, array($this->UuID, $this->UuUsID, $this->UuSvID));
		
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umuserservice
				WHERE UuUsID=?, UuSvID=?";
		 
		$this->ums->query($sql, array($this->UuUsID, $this->UuSvID));
		
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umuserservice 
				WHERE UuUsID=?, UuSvID=?";
		$query = $this->ums->query($sql, array($this->UuUsID, $this->UuSvID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_umuserservice
?>
