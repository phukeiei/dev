<?php

include_once("Ffm_model.php");

class Da_cost_detail extends Ffm_model {
	
	// PK is cd_fr_id, cd_seq
	
	public $cd_fr_id;
	public $cd_seq;
	public $cd_start_time;
	public $cd_end_time;
	public $cd_hour;
	public $cd_minute;
	public $cd_cost;
	public $cd_update;
	public $cd_user_update;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO cost_detail (cd_fr_id, cd_seq, cd_start_time, cd_end_time, cd_hour, cd_minute, cd_cost, cd_update, cd_user_update)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$this->ffm->query($sql, array($this->cd_fr_id, $this->cd_seq, $this->cd_start_time, $this->cd_end_time, $this->cd_hour, $this->cd_minute, $this->cd_cost, $this->cd_update, $this->cd_user_update));
		$this->last_insert_id = $this->ffm->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE cost_detail 
				SET	cd_start_time=?, cd_end_time=?, cd_hour=?, cd_minute=?, cd_cost=?, cd_update=?, cd_user_update=? 
				WHERE cd_fr_id=?, cd_seq=?";	
		$this->ffm->query($sql, array($this->cd_start_time, $this->cd_end_time, $this->cd_hour, $this->cd_minute, $this->cd_cost, $this->cd_update, $this->cd_user_update, $this->cd_fr_id, $this->cd_seq));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM cost_detail
				WHERE cd_fr_id=?, cd_seq=?";
		$this->ffm->query($sql, array($this->cd_fr_id, $this->cd_seq));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM cost_detail 
				WHERE cd_fr_id=?, cd_seq=?";
		$query = $this->ffm->query($sql, array($this->cd_fr_id, $this->cd_seq));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_cost_detail
?>