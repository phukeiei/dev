<?php

class Swm_model extends CI_model {		
	
	// PK is scp_id
	public $swm;
	public $swm_db;
	public $hr;
	public $hr_db;

	function __construct() {
		parent::__construct();
	    $this->swm		=	$this->load->database('swm', TRUE);
		$this->swm_db	=	$this->swm->database;
		
		$this->hr		=	$this->load->database('hr', TRUE);
		$this->hr_db	=	$this->hr->database;
	}
	
	function row2attribute($rw) {
		foreach ($rw as $key => $value) {
			if ( is_null($value) ) 
				eval("\$this->$key = NULL;");
			else
				$value = str_replace("'","&apos;",$value);
				eval("\$this->$key = '$value';");
		}
	}
	
}	 //=== end class Da_swm_cost_pool
?>