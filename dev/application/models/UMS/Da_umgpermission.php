<?php

include_once("My_model.php");

class Da_umgpermission extends My_model {		
	
	// PK is gpGpID, gpMnID
	
	public $gpGpID;
	public $gpMnID;
	public $gpSeq;
	public $gpX;
	public $gpC;
	public $gpR;
	public $gpU;
	public $gpD;
	public $last_insert_id;

	function __construct() {
		parent::__construct();
		echo $this->gpGpID;
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umgpermission (gpGpID, gpMnID, gpSeq, gpX, gpC, gpR, gpU, gpD)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
		
		 
		$this->ums->query($sql, array($this->gpGpID, $this->gpMnID, $this->gpSeq, $this->gpX, $this->gpC, $this->gpR, $this->gpU, $this->gpD));
		$this->last_insert_id = $this->ums->insert_id();
		
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umgpermission 
				SET	gpSeq=?, gpX=?, gpC=?, gpR=?, gpU=?, gpD=? 
				WHERE gpGpID=? and gpMnID=?";	
		
		 
		$this->ums->query($sql, array($this->gpSeq, $this->gpX, $this->gpC, $this->gpR, $this->gpU, $this->gpD, $this->gpGpID, $this->gpMnID));
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umgpermission
				WHERE gpGpID=? and gpMnID=? ";
		
		 
		$this->ums->query($sql, array($this->gpGpID, $this->gpMnID));
	}	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		
		$sql = "SELECT * 
				FROM umgpermission 
				WHERE gpGpID=?";//, gpMnID=?";
		$query = $this->ums->query($sql, $this->gpGpID);
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
	function search_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umgpermission 
				WHERE gpGpID=? and gpMnID=?";
		$query = $this->ums->query($sql, array($this->gpGpID, $this->gpMnID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
		function get_by_key_order($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * FROM ummenu left join umgpermission on ummenu.MnID= umgpermission.gpMnID
		where (gpGpID is null or gpGpID=?) and MnStID=? ORDER BY MnStID ASC,MnSeq ASC ,MnParentMnID ASC,MnID ASC, MnLevel ASC ";//, gpMnID=?";
		$query = $this->ums->query($sql, array($this->gpGpID, $this->MnStID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
		}
}	 //=== end class Da_umgpermission

?>
