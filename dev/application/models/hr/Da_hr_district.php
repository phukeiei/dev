<?php
/*
 * da_hr_district
 * Model for Manage about hr_district Table.
 * Copyright (c) 2559. Information System Engineering Research Laboratory.
 * @Author Chain_Chaiwat
 * @Create Date 2559-07-01
*/
include_once("hr_model.php");

class Da_hr_district extends Hr_model {

	// PK is dist_id

	public $dist_id;
	public $dist_name;
	public $dist_name_en;
	public $dist_amph_id;
	public $dist_pv_id;
	public $dist_status;
	public $dist_active;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}

	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO ".$this->hr_db.".hr_district (dist_name, dist_name_en, dist_amph_id, dist_pv_id, dist_active)
				VALUES(?, ?, ?, ?, ?)";
		$this->hr->query($sql, array($this->dist_name, $this->dist_name_en, $this->dist_amph_id, $this->dist_pv_id, $this->dist_active));
		$this->last_insert_id = $this->hr->insert_id();
	}

	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE ".$this->hr_db.".hr_district
				SET	dist_name=?, dist_name_en=?, dist_amph_id=?, dist_pv_id=?
				WHERE dist_id=?";
		$this->hr->query($sql, array($this->dist_name, $this->dist_name_en, $this->dist_amph_id, $this->dist_pv_id, $this->dist_id));
	}

	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM ".$this->hr_db.".hr_district
				WHERE dist_id=?";
		$this->hr->query($sql, array($this->dist_id));
	}

	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {
		$sql = "SELECT *
				FROM ".$this->hr_db.".hr_district
				WHERE dist_id=?";
		$query = $this->hr->query($sql, array($this->dist_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}

}	 //=== end class Da_hr_district
?>
