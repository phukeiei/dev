<?php 
     if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    require_once(dirname(__FILE__)."/../M_complain.php");
    class M_complains extends  M_complain{

        function __construct(){
            parent::__construct();  
        }
        
        function insert_data() {
            $sql = "INSERT INTO complain (cp_tp_id,cp_complain)
                    VALUES(?,?)";
            $this->ffm->query($sql, array($this->cp_tp_id,$this->cp_complain));
            $this->last_insert_id = $this->ffm->insert_id();
            
	    }

        function get_tp() {
            $sql = "SELECT *
                    FROM type_complain 
                    WHERE tp_active = 'y' ";
            $query = $this->ffm->query($sql);
            return $query;
        }
            

    }
?>