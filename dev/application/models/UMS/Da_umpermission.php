<?php

include_once("My_model.php");

class Da_umpermission extends My_model {		
	
	// PK is pmUsID, pmMnID
	
	public $pmUsID;
	public $pmMnID;
	public $pmSeq;
	public $pmX;
	public $pmC;
	public $pmR;
	public $pmU;
	public $pmD;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umpermission (pmUsID, pmMnID, pmSeq, pmX, pmC, pmR, pmU, pmD)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
		
		 
		$this->ums->query($sql, array($this->pmUsID, $this->pmMnID, $this->pmSeq, $this->pmX, $this->pmC, $this->pmR, $this->pmU, $this->pmD));
		$this->last_insert_id = $this->ums->insert_id();
		
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umpermission 
				SET	pmSeq=?, pmX=?, pmC=?, pmR=?, pmU=?, pmD=? 
				WHERE pmUsID=? and pmMnID=?";	
		
		 
		$this->ums->query($sql, array($this->pmSeq, $this->pmX, $this->pmC, $this->pmR, $this->pmU, $this->pmD, $this->pmUsID, $this->pmMnID));
		
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umpermission
				WHERE pmUsID=? and pmMnID=?";
		
		 
		$this->ums->query($sql, array($this->pmUsID, $this->pmMnID));
		
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umpermission 
				WHERE pmUsID=?, pmMnID=?";
		$query = $this->ums->query($sql, array($this->pmUsID, $this->pmMnID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
	function get_by_key_with_ID($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umpermission 
				WHERE pmUsID=?";
		$query = $this->ums->query($sql, array($this->pmUsID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
	function search_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umpermission 
				WHERE pmUsID=? and pmMnID=?";
		$query = $this->ums->query($sql, array($this->pmUsID, $this->pmMnID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_umpermission
?>
