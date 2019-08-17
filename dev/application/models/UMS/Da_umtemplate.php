<?php
include_once("My_model.php");
class Da_umtemplate extends My_model {		
	
	// PK is temID
	
	public $temID;
	public $StID;
	public $HeadIcon;
	public $HeightHeadTop;
	public $MarginHeadTop;
	public $ColorHeadTop;
	public $ColorHeadBottom;
	public $ColorTopButton;
	public $ColorBottomButton;
	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO umtemplate (temID, StID, HeadIcon, HeightHeadTop, MarginHeadTop, ColorHeadTop, ColorHeadBottom, ColorTopButton, ColorBottomButton)
				VALUES(?, ?, ?, ?, ?, ?, ?)";
		
		 
		$this->ums->query($sql, array($this->temID, $this->StID, $this->HeadIcon, $this->HeightHeadTop, $this->MarginHeadTop, $this->ColorHeadTop, $this->ColorHeadBottom, $this->ColorTopButton, $this->ColorBottomButton));
		$this->last_insert_id = $this->ums->insert_id();
		
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umtemplate 
				SET	StID=?, HeaedIcon=?, HeightHeadTop=?, MarginHeadTop=?, ColotHeadTop=?, ColorHeadBottom=?, ColorTopButton=?, ColorBottomButton=? 
				WHERE temID=?";	
		
		 
		$this->ums->query($sql, array($this->StID, $this->HeadIcon, $this->HeightHeadTop, $this->MarginHeadTop, $this->ColorHeadTop, $this->ColorHeadBottom, $this->ColorTopButton, $this->ColorBottomButton, $this->temID));
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM umtemplate
				WHERE StID=?";
		
		 
		$this->ums->query($sql, array($this->StID));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umtemplate 
				WHERE temID=?";
		$query = $this->db->query($sql, array($this->temID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_umtemplate
?>
