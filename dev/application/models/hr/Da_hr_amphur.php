<?php
/*
 * da_hr_amphur
 * Model for Manage about hr_amphur Table.
 * Copyright (c) 2559. Information System Engineering Research Laboratory.
 * @Author Chain_Chaiwat
 * @Create Date 2559-07-01
*/
include_once("hr_model.php");

class Da_hr_amphur extends Hr_model {

	// PK is amph_id

	public $amph_id;
	public $amph_name;
	public $amph_name_en;
	public $amph_pv_id;
	public $amph_status;
	public $amph_active;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}

	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO ".$this->hr_db.".hr_amphur (amph_name, amph_name_en, amph_pv_id, amph_active)
				VALUES(?, ?, ?, ?)";
		$this->hr->query($sql, array( $this->amph_name, $this->amph_name_en, $this->amph_pv_id, $this->amph_active));
		$this->last_insert_id = $this->hr->insert_id();
	}

	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE ".$this->hr_db.".hr_amphur
				SET	amph_name=?, amph_name_en=?, amph_pv_id=?
				WHERE amph_id=?";
		$this->hr->query($sql, array($this->amph_name, $this->amph_name_en, $this->amph_pv_id, $this->amph_id));
	}

	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM ".$this->hr_db.".hr_amphur
				WHERE amph_id=?";
		$this->hr->query($sql, array($this->amph_id));
	}

	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {
		$sql = "SELECT *
				FROM ".$this->hr_db.".hr_amphur
				WHERE amph_id=?";
		$query = $this->hr->query($sql, array($this->amph_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}

}	 //=== end class Da_hr_amphur
?>
