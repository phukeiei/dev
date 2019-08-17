<?php

include_once(dirname(__FILE__)."/Swm_model.php");

class Da_swm_status extends Swm_model {		
	
	// PK is ss_id
	
	public $ss_id;
	public $ss_name;
	public $ss_create_date;
	public $ss_update_date;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO ".$this->swm_db.".swm_status (ss_id, ss_name, ss_create_date, ss_update_date)
				VALUES(?, ?, ?, ?)";
		$this->swm->query($sql, array($this->ss_id, $this->ss_name, $this->ss_create_date, $this->ss_update_date));
		$this->last_insert_id = $this->swm->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE ".$this->swm_db.".swm_status 
				SET	ss_name=?, ss_create_date=?, ss_update_date=? 
				WHERE ss_id=?";	
		$this->swm->query($sql, array($this->ss_name, $this->ss_create_date, $this->ss_update_date, $this->ss_id));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM ".$this->swm_db.".swm_status
				WHERE ss_id=?";
		$this->swm->query($sql, array($this->ss_id));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM ".$this->swm_db.".swm_status 
				WHERE ss_id=?";
		$query = $this->swm->query($sql, array($this->ss_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_swm_status
?>
