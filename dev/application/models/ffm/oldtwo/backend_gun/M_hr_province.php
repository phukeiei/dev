<?php

class M_hr_province extends CI_Model {


    public $pv_id;
    public $pv_name;
    public $pv_name_en;
    public $pv_zone_id;
    public $pv_active;
    
  
  

	function __construct() {
		parent::__construct();

	}
	
    function insert() {
		$sql = "INSERT INTO hr_province (pv_id,pv_name,pv_name_en,pv_zone_id,pv_active)
				VALUES(?,?,?,?,?)";
		$this->ffm->query($sql, array($this->pv_id,$this->pv_name,$this->pv_name_en,$this->pv_zone_id,$this->pv_active));
		
    }
    function delete() {
		
		$sql = "DELETE FROM .hr_province
				WHERE pv_id=?";
		$this->ffm->query($sql, array($this->pv_id));
    }
    function update() {
		$sql = "UPDATE hr_province 
				SET	pv_id=?
                ,pv_name=?
                ,pv_name_en=?
                ,pv_zone_id=?
                ,pv_active=?
					
				WHERE pv_id = ?";	
		$this->ffm->query($sql, array($this->pv_id,$this->pv_name,$this->pv_name_en,$this->pv_zone_id,$this->pv_active,$this->pv_id));
	}
    
    
	
    






	}



?>