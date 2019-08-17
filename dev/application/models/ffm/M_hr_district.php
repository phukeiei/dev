<?php

class M_hr_district extends CI_Model {


    public $dist_id;
    public $dist_name;
    public $dist_name_en;
    public $dist_amph_id;
    public $dist_pv_id;
    public $dist_pos_code;
    public $dist_active;
  
  

	function __construct() {
		parent::__construct();

	}
	
    function insert() {
		$sql = "INSERT INTO $this->db_ossd.hr_district (dist_id,dist_name,dist_name_en,dist_amph_id,dist_pv_id,dist_pos_code,dist_active)
				VALUES(?,?,?,?,?,?,?)";
		$this->db->query($sql, array($this->dist_id,$this->dist_name,$this->dist_name_en,$this->dist_amph_id,$this->dist_pv_id,$this->dist_pos_code,$this->dist_active));
		
    }
    function delete() {
		
		$sql = "DELETE FROM $this->db_ossd.hr_district
				WHERE dist_id=?";
		$this->db->query($sql, array($this->dist_id));
    }
    function update() {
		$sql = "UPDATE $this->db_ossd.hr_district 
				SET	dist_id=?
                ,dist_name=?
                ,dist_name_en=?
                ,dist_amph_id=?
                ,dist_pv_id=?
                ,dist_pos_code=?
                ,dist_active=?
					
				WHERE dist_id = ?";	
		$this->db->query($sql, array($this->dist_id,$this->dist_name,$this->dist_name_en,$this->dist_amph_id,$this->dist_pv_id,$this->dist_pos_code,$this->dist_active,$this->dist_id));	
	}
    
	
    






	}



?>