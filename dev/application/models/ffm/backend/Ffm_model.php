<?php
/*
 * ffm_model
 * Model for Manage about ffm_model.
 * Copyright (c) 2559. Information System Engineering Research Laboratory.
 * @Author Phanuphan
 * @Create Date 2562-05-15
*/
class Ffm_model extends CI_Model {
	
	public $ffm;
	public $ffm_db;

	function __construct() {
		parent::__construct();

	    $this->ffm		=	$this->load->database('ffm', TRUE);
		
		$this->ffm_db	=	$this->ffm->database;
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

}

?>