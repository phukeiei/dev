<?php

include_once("My_model.php");

class Da_umusergroup extends My_model {		
	
	// PK is UgGpID, UgUsID
	
	public $UgID;
	public $UgGpID;
	public $UgUsID;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umusergroup (UgID, UgGpID, UgUsID)
				VALUES(?, ?, ?)";
		 
		$this->ums->query($sql, array($this->UgID, $this->UgGpID, $this->UgUsID));
		$this->last_insert_id = $this->ums->insert_id();
		
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umusergroup 
				SET	UgID=? 
				WHERE UgGpID=?, UgUsID=?";	
		 
		$this->ums->query($sql, array($this->UgID, $this->UgGpID, $this->UgUsID));		
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umusergroup
				WHERE UgGpID=? AND UgUsID=?";
		 
		$this->ums->query($sql, array($this->UgGpID, $this->UgUsID));

	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umusergroup 
				WHERE UgGpID=? AND UgUsID=?";
		$query = $this->ums->query($sql, array($this->UgGpID, $this->UgUsID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_umusergroup
?>
