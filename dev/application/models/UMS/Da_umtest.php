<?php

include_once("My_model.php");

class Da_umtest extends My_model {		
	
	// PK is ID_TEST
	
	public $ID_TEST;
	public $TestnameT;
	public $TestnameE;
	public $Testno;
	

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umtest (ID_TEST, TestnameT, TestnameE,Testno)
				VALUES(?, ?, ?,?)";
		
		 
		$this->ums->query($sql, array($this->ID_TEST, $this->TestnameT, $this->TestnameE, $this->Testno));
		$this->last_insert_id = $this->ums->insert_id();
		
		
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umtest
				SET	TestnameT=?, TestnameE=?, Testno=?
				WHERE ID_TEST=?";	
		
		 
		$this->ums->query($sql, array($this->TestnameT, $this->TestnameE, $this->ID_TEST));
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umtest
				WHERE ID_TEST=?";
		
		 
		$this->ums->query($sql, array($this->ID_TEST));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umtest
				WHERE ID_TEST=?";
		$query = $this->ums->query($sql, array($this->ID_TEST));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	function get_by_id($ID_TEST)
	{
		$sql = "SELECT * 
				FROM umtest
				WHERE ID_TEST=?";
		$query = $this->ums->query($sql, array($ID_TEST));
		return $query ;

	}
	
	
}	 //=== end class Da_umTEST
?>
