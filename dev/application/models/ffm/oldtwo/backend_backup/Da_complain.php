<?php
include_once("Ffm_model.php");
class Da_complain extends Ffm_model {
	
	// PK is cp_id
	
	public $cp_id;
	public $cp_tp_id;
	public $cp_fr_id;
	public $cp_complain;
	public $cp_update;
	public $cp_user_update;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO complain (cp_id, cp_tp_id, cp_fr_id, cp_complain, cp_update, cp_user_update)
				VALUES(?, ?, ?, ?, ?, ?)";
		$this->ffm->query($sql, array($this->cp_id, $this->cp_tp_id, $this->cp_fr_id, $this->cp_complain, $this->cp_update, $this->cp_user_update));
		$this->last_insert_id = $this->db->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE complain 
				SET	cp_tp_id=?, cp_fr_id=?, cp_complain=?, cp_update=?, cp_user_update=? 
				WHERE cp_id=?";	
		$this->ffm->query($sql, array($this->cp_tp_id, $this->cp_fr_id, $this->cp_complain, $this->cp_update, $this->cp_user_update, $this->cp_id));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM complain
				WHERE cp_id=?";
		$this->ffm->query($sql, array($this->cp_id));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM complain 
				WHERE cp_id=?";
		$query = $this->ffm->query($sql, array($this->cp_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_complain
?>