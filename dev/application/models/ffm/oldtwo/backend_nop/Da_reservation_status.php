<?php

include_once("Ffm_model.php");

class Da_reservation_status extends Ffm_model {
	
	// PK is rs_id
	
	public $rs_id;
	public $rs_name;
	public $rs_active;
	public $rs_update;
	public $rs_user_update;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO reservation_status (rs_id, rs_name, rs_active, rs_update, rs_user_update)
				VALUES(?, ?, ?, ?, ?)";
		$this->ffm->query($sql, array($this->rs_id, $this->rs_name, $this->rs_active, $this->rs_update, $this->rs_user_update));
		$this->last_insert_id = $this->ffm->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE reservation_status 
				SET	rs_name=?, rs_active=?, rs_update=?, rs_user_update=? 
				WHERE rs_id=?";	
		$this->ffm->query($sql, array($this->rs_name, $this->rs_active, $this->rs_update, $this->rs_user_update, $this->rs_id));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM reservation_status
				WHERE rs_id=?";
		$this->ffm->query($sql, array($this->rs_id));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM reservation_status 
				WHERE rs_id=?";
		$query = $this->ffm->query($sql, array($this->rs_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_reservation_status
?>