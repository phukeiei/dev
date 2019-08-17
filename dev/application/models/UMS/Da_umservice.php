<?php

include_once("My_model.php");

class Da_umservice extends My_model {		
	
	// PK is SvID
	
	public $SvID;
	public $SvNameT;
	public $SvNameE;
	public $SvURL;
	public $SvIcon;
	public $SvTarget;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umservice (SvID, SvNameT, SvNameE, SvURL, SvIcon)
				VALUES(?, ?, ?, ?, ?)";
		
		 
		$this->ums->query($sql, array($this->SvID, $this->SvNameT, $this->SvNameE, $this->SvURL, $this->SvIcon, $this->SvTarget));
		$this->last_insert_id = $this->ums->insert_id();
		
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umservice 
				SET	SvNameT=?, SvNameE=?, SvURL=?, SvIcon=? 
				WHERE SvID=?";	
		
		 
		$this->ums->query($sql, array($this->SvNameT, $this->SvNameE, $this->SvURL, $this->SvIcon, $this->SvID));
		
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umservice
				WHERE SvID=?";
		
		 
		$this->ums->query($sql, array($this->SvID));
		
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umservice 
				WHERE SvID=?";
		$query = $this->ums->query($sql, array($this->SvID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_umservice
?>
