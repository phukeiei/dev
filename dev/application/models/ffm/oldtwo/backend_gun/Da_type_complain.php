<?php

include_once("Ffm_model.php");

class Da_type_complain extends Ffm_model {
	
	// PK is tp_id
	
	public $tp_id;
	public $tp_complain;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO type_complain (tp_id, tp_complain)
				VALUES(?, ?)";
		$this->ffm->query($sql, array($this->tp_id, $this->tp_complain));
		$this->last_insert_id = $this->db->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE type_complain 
				SET	tp_complain=? 
				WHERE tp_id=?";	
		$this->ffm->query($sql, array($this->tp_complain, $this->tp_id));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM type_complain
				WHERE tp_id=?";
		$this->ffm->query($sql, array($this->tp_id));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM type_complain 
				WHERE tp_id=?";
		$query = $this->ffm->query($sql, array($this->tp_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_type_complain
?>