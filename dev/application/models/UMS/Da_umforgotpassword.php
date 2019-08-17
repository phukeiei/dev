<?php

include_once("My_model.php");

class Da_umforgotpassword extends My_model {		
	
	// PK is UsID
	
	
	public $UsName;
	
	public $UsPassword;
	
	public $UsEmail;
	

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	
	
	
	
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umuser 
				WHERE UsName=?";
		$query = $this->ums->query($sql, array($this->UsID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
	
}	 //=== end class Da_umforgotpassword
?>
