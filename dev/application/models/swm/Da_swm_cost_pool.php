<?php

include_once(dirname(__FILE__)."/Swm_model.php");

class Da_swm_cost_pool extends Swm_model {		
	
	// PK is scp_id
	
	public $scp_id;
	public $scp_age_min;
	public $scp_age_max;
	public $scp_cost;
	public $scp_sug_id;
	public $scp_reference;
	public $scp_is_active;
	public $scp_create_date;
	public $scp_update_date;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO ".$this->swm_db.".swm_cost_pool (scp_id, scp_age_min, scp_age_max, scp_cost, scp_sug_id, scp_reference, scp_create_date, scp_update_date)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
		$this->swm->query($sql, array($this->scp_id, $this->scp_age_min, $this->scp_age_max, $this->scp_cost, $this->scp_sug_id, $this->scp_reference, $this->scp_create_date, $this->scp_update_date));
		$this->last_insert_id = $this->swm->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE ".$this->swm_db.".swm_cost_pool 
				SET	scp_age_min=?, scp_age_max=?, scp_cost=?, scp_sug_id=?, scp_reference=?, scp_create_date=?, scp_update_date=? 
				WHERE scp_id=?";	
		$this->swm->query($sql, array($this->scp_age_min, $this->scp_age_max, $this->scp_cost, $this->scp_sug_id, $this->scp_reference, $this->scp_create_date, $this->scp_update_date, $this->scp_id));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM ".$this->swm_db.".swm_cost_pool
				WHERE scp_id=?";
		$this->swm->query($sql, array($this->scp_id));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM ".$this->swm_db.".swm_cost_pool 
				WHERE scp_id=?";
		$query = $this->swm->query($sql, array($this->scp_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_swm_cost_pool
?>