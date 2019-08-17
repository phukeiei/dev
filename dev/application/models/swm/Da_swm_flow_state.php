<?php

include_once(dirname(__FILE__)."/Swm_model.php");

class Da_swm_flow_state extends Swm_model {		
	
	// PK is sfs_id
	
	public $sfs_id;
	public $sfs_create_date;
	public $sfs_su_id;
	public $sfs_ss_id;
	public $sfs_comment;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO ".$this->swm_db.".swm_flow_state (sfs_id, sfs_create_date, sfs_su_id, sfs_ss_id, sfs_comment)
				VALUES(?, ?, ?, ?, ?)";
		$this->swm->query($sql, array($this->sfs_id, $this->sfs_create_date, $this->sfs_su_id, $this->sfs_ss_id, $this->sfs_comment));
		$this->last_insert_id = $this->swm->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE ".$this->swm_db.".swm_flow_state 
				SET	sfs_create_date=?, sfs_su_id=?, sfs_ss_id=?, sfs_comment=? 
				WHERE sfs_id=?";	
		$this->swm->query($sql, array($this->sfs_create_date, $this->sfs_su_id, $this->sfs_ss_id, $this->sfs_comment, $this->sfs_id));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM ".$this->swm_db.".swm_flow_state
				WHERE sfs_id=?";
		$this->swm->query($sql, array($this->sfs_id));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM ".$this->swm_db.".swm_flow_state 
				WHERE sfs_id=?";
		$query = $this->swm->query($sql, array($this->sfs_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_swm_flow_state
?>
