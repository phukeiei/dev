<?php 
     if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    require_once(dirname(__FILE__)."/../M_edit_reservation.php");
    class M_edit_reservation extends  M_edit{

        function __construct(){
            parent::__construct();  
        }

        function get_edit(){
        	$sql = "SELECT *
			FROM field_reservation" ;
            $query = $this->ffm->query($sql);
            return $query;
        }
    }
}
?>