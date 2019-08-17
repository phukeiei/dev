<?php

include_once("My_model.php");

class Da_umwgroup extends My_model {		
	
	// PK is WgID
	
	public $WgID;
	public $WgNameT;
	public $WgNameE;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umwgroup (WgID, WgNameT, WgNameE)
				VALUES(?, ?, ?)";
		 
		$this->ums->query($sql, array($this->WgID, $this->WgNameT, $this->WgNameE));
		$this->last_insert_id = $this->ums->insert_id();
		
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umwgroup 
				SET	WgNameT=?, WgNameE=? 
				WHERE WgID=?";	
		 
		$this->ums->query($sql, array($this->WgNameT, $this->WgNameE, $this->WgID));
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umwgroup
				WHERE WgID=?";
		 
		$this->ums->query($sql, array($this->WgID));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umwgroup 
				WHERE WgID=?";
		$query = $this->ums->query($sql, array($this->WgID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	function get_id(){
		$sql = "SELECT * FROM umwgroup WHERE WgNameT=? and WgNameE=?";
		$query = $this->ums->query($sql,array($this->WgNameT,$this->WgNameE));
		return $query->row_array();
		
	}
}	 //=== end class Da_umwgroup
?>
