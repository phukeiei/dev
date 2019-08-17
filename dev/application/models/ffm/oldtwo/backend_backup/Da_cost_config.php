<?php

include_once("Ffm_model.php");

class Da_cost_config extends Ffm_model {
	
	// PK is cc_id
	
	public $cc_id;
	public $cc_ff_id;
	public $cc_start_time;
	public $cc_end_time;
	public $cc_cost;
	public $cc_update;
	public $cc_user_update;
	public $cc_status;
	public $cc_type;
	

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO cost_config ( cc_ff_id, cc_start_time, cc_end_time, cc_cost, cc_user_update,cc_status,cc_type)
				VALUES(?, ?, ?, ?, ?, ?, ?)";
		$this->ffm->query($sql, array( $this->cc_ff_id, $this->cc_start_time, $this->cc_end_time, $this->cc_cost, $this->cc_user_update, $this->cc_status, $this->cc_type));
		$this->last_insert_id = $this->ffm->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE cost_config 
				SET	cc_ff_id=?, cc_start_time=?, cc_end_time=?, cc_cost=?, cc_update=?, cc_user_update=? 
				WHERE cc_id=?";	
		$this->ffm->query($sql, array($this->cc_ff_id, $this->cc_start_time, $this->cc_end_time, $this->cc_cost, $this->cc_update, $this->cc_user_update, $this->cc_id));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM cost_config
				WHERE cc_id=?";
		$this->ffm->query($sql, array($this->cc_id));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM cost_config 
				WHERE cc_id=?";
		$query = $this->ffm->query($sql, array($this->cc_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_cost_config
?>