<?php

include_once("My_model.php");

class Da_umnotification extends My_model {		
	
	// PK is id
	
	public $id;
	public $state_id;
	public $state_name;
	public $system_id;
	public $system_state;
	public $messsage;
	public $link;
	public $no_wgid;
	public $priority;
	public $no_usid;
	public $checkin;
	
	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umnotification (id, state_id, state_name, system_id, system_state, messsage, link, no_wgid, priority, no_usid, checkin)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ? , CURDATE() )";
		$this->ums->query($sql, array($this->id, $this->state_id, $this->state_name, $this->system_id, $this->system_state, $this->messsage, $this->link, $this->no_wgid, $this->priority, $this->no_usid));
		$this->last_insert_id = $this->ums->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umnotification 
				SET	state_id=?, state_name=?, system_id=?, system_state=?, messsage=?, link=?, no_wgid=?, priority=?, no_usid=? 
				WHERE id=?";	
		$this->ums->query($sql, array($this->state_id, $this->state_name, $this->system_id, $this->system_state, $this->messsage, $this->link, $this->no_wgid, $this->priority, $this->no_usid, $this->id));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umnotification
				WHERE id=?";
		$this->ums->query($sql, array($this->id));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umnotification 
				WHERE id=?";
		$query = $this->ums->query($sql, array($this->id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_umnotification
?>

