<?php

include_once("My_model.php");

class Da_umquestion extends My_model {		
	
	// PK is QsID
	
	public $QsID;
	public $QsDescT;
	public $QsDescE;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umquestion (QsID, QsDescT, QsDescE)
				VALUES(?, ?, ?)";
		
		 
		$this->ums->query($sql, array($this->QsID, $this->QsDescT, $this->QsDescE));
		$this->last_insert_id = $this->ums->insert_id();
		
		
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umquestion 
				SET	QsDescT=?, QsDescE=? 
				WHERE QsID=?";	
		
		 
		$this->ums->query($sql, array($this->QsDescT, $this->QsDescE, $this->QsID));
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umquestion
				WHERE QsID=?";
		
		 
		$this->ums->query($sql, array($this->QsID));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umquestion 
				WHERE QsID=?";
		$query = $this->ums->query($sql, array($this->QsID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	function get_by_id($qsID)
	{
		$sql = "SELECT * 
				FROM umquestion 
				WHERE QsID=?";
		$query = $this->ums->query($sql, array($qsID));
		return $query ;

	}
	
}	 //=== end class Da_umquestion
?>
