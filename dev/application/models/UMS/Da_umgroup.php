<?php

include_once("My_model.php");

class Da_umgroup extends My_model {		
	
	// PK is GpID
	
	public $GpID;
	public $GpNameT;
	public $GpNameE;
	public $GpDesc;
	public $GpStID;

	public $last_insert_id;
	public $last_insert_GpNameT;

	function __construct() {
		parent::__construct() ;
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umgroup (GpID, GpNameT, GpNameE, GpDesc, GpStID)
				VALUES(?, ?, ?, ?, ?)";
		
		 
		$this->ums->query($sql, array($this->GpID, $this->GpNameT, $this->GpNameE, $this->GpDesc, $this->GpStID));
		$this->last_insert_id = $this->ums->insert_id();
		$this->last_insert_GpNameT = $this->GpNameT;
		//echo $this->last_insert_GpNameT;
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umgroup 
				SET	GpNameT=?, GpNameE=?, GpDesc=?, GpStID=? 
				WHERE GpID=?";	
		
		 
		$this->ums->query($sql, array($this->GpNameT, $this->GpNameE, $this->GpDesc, $this->GpStID, $this->GpID));

	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umgroup
				WHERE GpID=?";
		
		 
		$this->ums->query($sql, array($this->GpID));

	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umgroup 
				WHERE GpID=?";
		$query = $this->ums->query($sql, array($this->GpID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
	function get_by_id($GpID)
	{
		$sql ="SELECT *
				FROM umgroup
				WHERE GpID=?";
		$query = $this->ums->query($sql,$GpID);
		return $query;
	}
	function get_by_GpNameT($GpNameT)
	{
		$sql ="SELECT *
				FROM umgroup
				WHERE GpNameT=?";
		$query = $this->ums->query($sql,$GpNameT);
		return $query;
	}
}	 //=== end class Da_umgroup
?>
