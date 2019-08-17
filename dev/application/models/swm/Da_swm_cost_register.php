<?php

include_once(dirname(__FILE__)."/Swm_model.php");

class Da_swm_cost_register extends Swm_model {		
	
	// PK is scr_id
	
	public $scr_id;
	public $scr_age_min;
	public $scr_age_max;
	public $scr_cost;
	public $scr_create_date;
	public $scr_update_date;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO ".$this->swm_db.".swm_cost_register (scr_id, scr_age_min, scr_age_max, scr_cost, scr_create_date, scr_update_date)
				VALUES(?, ?, ?, ?, ?, ?)";
		$this->swm->query($sql, array($this->scr_id, $this->scr_age_min, $this->scr_age_max, $this->scr_cost, $this->scr_create_date, $this->scr_update_date));
		$this->last_insert_id = $this->swm->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE ".$this->swm_db.".swm_cost_register 
				SET	scr_age_min=?, scr_age_max=?, scr_cost=?, scr_create_date=?, scr_update_date=? 
				WHERE scr_id=?";	
		$this->swm->query($sql, array($this->scr_age_min, $this->scr_age_max, $this->scr_cost, $this->scr_create_date, $this->scr_update_date, $this->scr_id));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM ".$this->swm_db.".swm_cost_register
				WHERE scr_id=?";
		$this->swm->query($sql, array($this->scr_id));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM ".$this->swm_db.".swm_cost_register 
				WHERE scr_id=?";
		$query = $this->swm->query($sql, array($this->scr_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_swm_cost_register
?>