<?php

include_once("Ffm_model.php");

class Da_field_reservation extends Ffm_model {
	
	// PK is fr_id
	
	public $fr_id;
	public $fr_ff_id;
	public $fr_start_time;
	public $fr_end_time;
	public $fr_ps_id;
	public $fr_first_name;
	public $fr_last_name;
	public $fr_address;
	public $fr_moo;
	public $fr_dist_id;
	public $fr_amph_id;
	public $fr_pv_id;
	public $fr_tel;
	public $fr_project;
	public $fr_start_date;
	public $fr_end_date;
	public $fr_hour;
	public $fr_minute;
	public $fr_cost;
	public $fr_status;
	public $fr_write_date;
	public $fr_number;
	public $fr_fr_id;
	public $fr_update;
	public $fr_user_update;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO field_reservation (fr_id, fr_ff_id, fr_start_time, fr_end_time, fr_ps_id, fr_first_name, fr_last_name, fr_address, fr_moo, fr_dist_id, fr_amph_id, fr_pv_id, fr_tel, fr_project, fr_start_date, fr_end_date, fr_hour, fr_minute, fr_cost, fr_status, fr_write_date, fr_number, fr_fr_id, fr_update, fr_user_update)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$this->ffm->query($sql, array($this->fr_id, $this->fr_ff_id, $this->fr_start_time, $this->fr_end_time, $this->fr_ps_id, $this->fr_first_name, $this->fr_last_name, $this->fr_address, $this->fr_moo, $this->fr_dist_id, $this->fr_amph_id, $this->fr_pv_id, $this->fr_tel, $this->fr_project, $this->fr_start_date, $this->fr_end_date, $this->fr_hour, $this->fr_minute, $this->fr_cost, $this->fr_status, $this->fr_write_date, $this->fr_number, $this->fr_fr_id, $this->fr_update, $this->fr_user_update));
		$this->last_insert_id = $this->ffm->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE field_reservation 
				SET	fr_ff_id=?, fr_start_time=?, fr_end_time=?, fr_ps_id=?, fr_first_name=?, fr_last_name=?, fr_address=?, fr_moo=?, fr_dist_id=?, fr_amph_id=?, fr_pv_id=?, fr_tel=?, fr_project=?, fr_start_date=?, fr_end_date=?, fr_hour=?, fr_minute=?, fr_cost=?, fr_status=?, fr_write_date=?, fr_number=?, fr_fr_id=?, fr_update=?, fr_user_update=? 
				WHERE fr_id=?";	
		$this->ffm->query($sql, array($this->fr_ff_id, $this->fr_start_time, $this->fr_end_time, $this->fr_ps_id, $this->fr_first_name, $this->fr_last_name, $this->fr_address, $this->fr_moo, $this->fr_dist_id, $this->fr_amph_id, $this->fr_pv_id, $this->fr_tel, $this->fr_project, $this->fr_start_date, $this->fr_end_date, $this->fr_hour, $this->fr_minute, $this->fr_cost, $this->fr_status, $this->fr_write_date, $this->fr_number, $this->fr_fr_id, $this->fr_update, $this->fr_user_update, $this->fr_id));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM field_reservation
				WHERE fr_id=?";
		$this->ffm->query($sql, array($this->fr_id));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM field_reservation 
				WHERE fr_id=?";
		$query = $this->ffm->query($sql, array($this->fr_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_field_reservation
?>