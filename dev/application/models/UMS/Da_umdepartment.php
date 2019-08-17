<?php

include_once("My_model.php");

class Da_umdepartment extends My_model {		
	
	// PK is dpID
	
	public $dpID;
	public $dpName;


	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umdepartment (dpID, dpName)
				VALUES(?,?)";
		$this->ums->query($sql, array($this->dpID, $this->dpName));
		$this->last_insert_id = $this->ums->insert_id();
		
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umdepartment 
				SET	dpName=?
				WHERE dpID=?";	
		$this->ums->query($sql, array($this->dpName, $this->dpID));
		 
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umdepartment
				WHERE dpID=?";
		 
		$this->ums->query($sql, array($this->dpID));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umdepartment 
				WHERE dpID=?";
		$query = $this->ums->query($sql, array($this->dpID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	function get_id(){
		$sql = "SELECT * FROM umdepartment WHERE dpName=? ";
		$query = $this->ums->query($sql,array($this->dpName));
		return $query->row_array();
		
	}
}	 //=== end class Da_umwgroup
?>
