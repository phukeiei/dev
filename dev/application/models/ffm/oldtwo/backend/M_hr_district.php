<?php

include_once("Ffm_model.php");
class M_hr_district extends Ffm_model {


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
		$sql = "INSERT INTO hr_district (dist_id,dist_name,dist_name_en,dist_amph_id,dist_pv_id,dist_pos_code,dist_active)
				VALUES(?,?,?,?,?,?,?)";
		$this->ffm->query($sql, array($this->dist_id,$this->dist_name,$this->dist_name_en,$this->dist_amph_id,$this->dist_pv_id,$this->dist_pos_code,$this->dist_active));
		
    }
    function delete() {
		
		$sql = "DELETE FROM hr_district
				WHERE dist_id=?";
		$this->ffm->query($sql, array($this->dist_id));
    }
    function update() {
		$sql = "UPDATE hr_district 
				SET	dist_id=?
                ,dist_name=?
                ,dist_name_en=?
                ,dist_amph_id=?
                ,dist_pv_id=?
                ,dist_pos_code=?
                ,dist_active=?
					
				WHERE dist_id = ?";	
		$this->ffm->query($sql, array($this->dist_id,$this->dist_name,$this->dist_name_en,$this->dist_amph_id,$this->dist_pv_id,$this->dist_pos_code,$this->dist_active,$this->dist_id));	
	}
    
  function get_table(){
    $sql ="SELECT *
    FROM hr_district" ;
    $query = $this->ffm->query($sql);
    // var_dump($query) ;
    // die();
    return $query;
  }

  function get_bapa($data){
    $sql ="SELECT *
    FROM hr_district
    where dist = $data" ;
    $query = $this->ffm->query($sql);
    // var_dump($query) ;
    // die();
    return $query;
  }

  function get_not_bapa($data){
    $sql ="SELECT *
    FROM hr_district
    where NOT dist_id = $data" ;
    $query = $this->ffm->query($sql);
    // var_dump($query) ;
    // die();
    return $query;
  }
    
    






	}



?>