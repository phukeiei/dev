<?php

include_once("My_model.php");

class Da_umgroupdefault extends My_model {		
	
	// PK is GdGpID, GdWgID
	
	public $GdGpID;
	public $GdWgID;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umgroupdefault (GdGpID, GdWgID)
				VALUES(?, ?)";
		
		 
		$this->ums->query($sql, array($this->GdGpID, $this->GdWgID));
		$this->last_insert_id = $this->ums->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umgroupdefault 
				SET	GdGpID=?, GdWgID=? 
				WHERE GdGpID=? and GdWgID=?";	
		
		 
		$this->ums->query($sql, array($this->GdGpID, $this->GdWgID, $this->GdGpID, $this->GdWgID));
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umgroupdefault
				WHERE GdGpID=? and GdWgID=?";
		
		 
		$this->ums->query($sql, array($this->GdGpID, $this->GdWgID));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umgroupdefault 
				WHERE GdGpID=? and GdWgID=?";
		$query = $this->ums->query($sql, array($this->GdGpID, $this->GdWgID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	function delete_all_wgroup($WgID)
	{
		$sql = "DELETE FROM umgroupdefault
				WHERE GdWgID=?";
		
		 
		$this->ums->query($sql, array($WgID));

	}
	 function search_check($GdGpID,$GdWgID){
		$sql = "SELECT *
					FROM umgroupdefault
					WHERE GdGpID=? and GdWgID=?";
		$query = $this->ums->query($sql,array($GdGpID,$GdWgID));
		if ($query->num_rows() > 0)
		{	
			return true;
		}
		else
		{
			return false;
		}
	 }
	 function get_perSystem($GdWgID)
	 {
		$sql = "SELECT *
				FROM umgroupdefault inner join umgroup 
				on umgroupdefault.GdGpID = umgroup.GpID
				INNER JOIN umsystem
				on umsystem.StID = umgroup.GpStID
				where GdWgID = ?
				";
		
		$query = $this->ums->query($sql,array($GdWgID));
		
		return $query; 
	 }
	
}	 //=== end class Da_umgroupdefault
?>
