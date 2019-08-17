<?php

include_once("My_model.php");

class Da_umsystem extends My_model {		
	
	// PK is StID
	
	public $StID;
	public $StNameT;
	public $StNameE;
	public $StAbbrT;
	public $StAbbrE;
	public $StDesc;
	public $StURL;
	public $StIcon;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umsystem (StID, StNameT, StNameE, StAbbrT, StAbbrE, StDesc, StURL, StIcon)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
		
		 
		$this->ums->query($sql, array($this->StID, $this->StNameT, $this->StNameE, $this->StAbbrT, $this->StAbbrE, $this->StDesc, $this->StURL, $this->StIcon));
		$this->last_insert_id = $this->ums->insert_id();
		
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umsystem 
				SET	StNameT=?, StNameE=?, StAbbrT=?, StAbbrE=?, StDesc=?, StURL=?, StIcon=? 
				WHERE StID=?";	
		
		 
		$this->ums->query($sql, array($this->StNameT, $this->StNameE, $this->StAbbrT, $this->StAbbrE, $this->StDesc, $this->StURL, $this->StIcon, $this->StID));
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umsystem
				WHERE StID=?";
		
		 
		$this->ums->query($sql, array($this->StID));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umsystem 
				WHERE StID=?";
		$query = $this->ums->query($sql, array($this->StID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
	
}	 //=== end class Da_umsystem
?>
