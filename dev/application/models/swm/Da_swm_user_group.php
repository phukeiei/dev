<?php

include_once(dirname(__FILE__)."/Swm_model.php");

class Da_swm_user_group extends Swm_model {		
	
	// PK is sug_id
	
	public $sug_id;
	public $sug_name;
	public $sug_create_date;
	public $sug_update_date;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO ".$this->swm_db.".swm_user_group (sug_id, sug_name, sug_create_date, sug_update_date)
				VALUES(?, ?, ?, ?)";
		$this->swm->query($sql, array($this->sug_id, $this->sug_name, $this->sug_create_date, $this->sug_update_date));
		$this->last_insert_id = $this->swm->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE ".$this->swm_db.".swm_user_group 
				SET	sug_name=?, sug_create_date=?, sug_update_date=? 
				WHERE sug_id=?";	
		$this->swm->query($sql, array($this->sug_name, $this->sug_create_date, $this->sug_update_date, $this->sug_id));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM ".$this->swm_db.".swm_user_group
				WHERE sug_id=?";
		$this->swm->query($sql, array($this->sug_id));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM ".$this->swm_db.".swm_user_group 
				WHERE sug_id=?";
		$query = $this->swm->query($sql, array($this->sug_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_swm_user_group
?>
