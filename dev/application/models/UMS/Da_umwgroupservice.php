<?php

include_once("My_model.php");

class Da_umwgroupservice extends My_model {		
	
	// PK is WsID
	
	public $WsID;
	public $WsWgID;
	public $WsSvID;

	public $last_insert_id;

	function __construct() {
		parent::Model();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umwgroupservice (WsID, WsWgID, WsSvID)
				VALUES(?, ?, ?)";
		 
		$this->ums->query($sql, array($this->WsID, $this->WsWgID, $this->WsSvID));
		$this->last_insert_id = $this->ums->insert_id();
		
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umwgroupservice 
				SET	WsWgID=?, WsSvID=? 
				WHERE WsID=?";
		
		$this->ums->query($sql, array($this->WsWgID, $this->WsSvID, $this->WsID));
		
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umwgroupservice
				WHERE WsID=?";
		$this->ums->query($sql, array($this->WsID));
		
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umwgroupservice 
				WHERE WsID=?";
		$query = $this->ums->query($sql, array($this->WsID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_umwgroupservice
?>
