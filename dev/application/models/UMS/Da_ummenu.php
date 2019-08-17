<?php

include_once("My_model.php");

class Da_ummenu extends My_model {		
	
	// PK is MnID
	
	public $MnStID;
	public $MnID;
	public $MnSeq;
	public $MnIcon;
	public $MnNameT;
	public $MnNameE;
	public $MnURL;
	public $MnDesc;
	public $MnToolbar;
	public $MnToolbarSeq;
	public $MnToolbarIcon;
	public $MnParentMnID;
	public $MnLevel;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO ummenu (MnStID, MnID, MnSeq, MnIcon, MnNameT, MnNameE, MnURL, MnDesc, MnToolbar, MnToolbarSeq, MnToolbarIcon, MnParentMnID, MnLevel)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		
		 
		$this->ums->query($sql, array($this->MnStID, $this->MnID, $this->MnSeq, $this->MnIcon, $this->MnNameT, $this->MnNameE, $this->MnURL, $this->MnDesc, $this->MnToolbar, $this->MnToolbarSeq, $this->MnToolbarIcon, $this->MnParentMnID, $this->MnLevel));
		$this->last_insert_id = $this->ums->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE ummenu 
				SET	MnStID=?, MnSeq=?, MnIcon=?, MnNameT=?, MnNameE=?, MnURL=?, MnDesc=?, MnToolbar=?, MnToolbarSeq=?, MnToolbarIcon=?, MnParentMnID=?, MnLevel=? 
				WHERE MnID=?";	
		
		 
		$this->ums->query($sql, array($this->MnStID, $this->MnSeq, $this->MnIcon, $this->MnNameT, $this->MnNameE, $this->MnURL, $this->MnDesc, $this->MnToolbar, $this->MnToolbarSeq, $this->MnToolbarIcon, $this->MnParentMnID, $this->MnLevel, $this->MnID));
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM ummenu
				WHERE MnID=?";
		
		 
		$this->ums->query($sql, array($this->MnID));
	}
	function deleteBySystem() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM ummenu
				WHERE MnStID=?";
		
		 
		$this->ums->query($sql, array($this->MnStID));
	}	
	/*
	 * You have to assign primary key value before call this function.
	 */
	 function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM ummenu 
				WHERE MnStID=?
				order by MnSeq";
		$query = $this->ums->query($sql, array($this->MnStID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	 
	function get_by_key_order($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM ummenu 
				WHERE MnStID=? 
				ORDER BY MnStID ASC,MnSeq ASC ,MnParentMnID ASC,MnID ASC, MnLevel ASC";
		$query = $this->ums->query($sql, array($this->MnStID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
	function get_all_path($MnID) {	
		$sql = "SELECT * 
				FROM ummenu
				WHERE MnStID=? and (MnID=? OR MnParentMnID =?)
				ORDER BY MnLevel ASC";
		$query = $this->ums->query($sql, array($this->session->userdata('StID'),$MnID,$MnID));
		return $query;
	}
	 
	
	
}	 //=== end class Da_ummenu
?>
