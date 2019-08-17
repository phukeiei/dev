<?php

class M_hr_amphur extends CI_Model {


    public $amph_id;
    public $amph_name;
    public $amph_name_en;
    public $amph_pv_id;
    public $amph_active;
  
  
  

	function __construct() {
		parent::__construct();

	}
	
    function insert() {
		$sql = "INSERT INTO hr_amphur (amph_id,amph_name,amph_name_en,amph_pv_id,amph_active)
				VALUES(?,?,?,?,?)";
		$this->ffm->query($sql, array($this->amph_id,$this->amph_name,$this->amph_name_en,$this->amph_pv_id,$this->amph_active));
		
    }
    function delete() {
		
		$sql = "DELETE FROM hr_amphur
				WHERE amph_id=?";
		$this->ffm->query($sql, array($this->amph_id));
    }
    function update() {
		$sql = "UPDATE hr_amphur 
				SET	amph_id=?
                ,amph_name=?
                ,amph_name_en=?
                ,amph_pv_id=?
                ,amph_active=?
					
				WHERE amph_id = ?";	
		$this->ffm->query($sql, array($this->amph_id,$this->amph_name,$this->amph_name_en,$this->amph_pv_id,$this->amph_active,$this->amph_id));
	}
    
	
    






	}



?>