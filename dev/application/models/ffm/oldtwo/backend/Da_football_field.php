<?php

include_once("Ffm_model.php");

class Da_football_field extends Ffm_model {
	
	// PK is ff_id
	
	public $ff_id;
	public $ff_name;
	public $ff_size;
	public $ff_status;
	public $ff_update;
	public $ff_user_update;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO football_field (ff_id, ff_name, ff_size, ff_status, ff_update, ff_user_update)
				VALUES(?, ?, ?, ?, ?, ?)";
		$this->ffm->query($sql, array($this->ff_id, $this->ff_name, $this->ff_size, $this->ff_status, $this->ff_update, $this->ff_user_update));
		$this->last_insert_id = $this->ffm->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE football_field 
				SET	ff_name=?, ff_size=?, ff_status=?, ff_update=?, ff_user_update=? 
				WHERE ff_id=?";	
		$this->ffm->query($sql, array($this->ff_name, $this->ff_size, $this->ff_status, $this->ff_update, $this->ff_user_update, $this->ff_id));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM football_field
				WHERE ff_id=?";
		$this->ffm->query($sql, array($this->ff_id));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM football_field 
				WHERE ff_id=?";
		$query = $this->ffm->query($sql, array($this->ff_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_football_field
?>