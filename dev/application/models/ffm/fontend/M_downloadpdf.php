<?php 
     if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    require_once(dirname(__FILE__)."/../M_field_reservation.php");
    class M_downloadpdf extends  M_field_reservation{
        function __construct(){
            parent::__construct();  
        }

        function Mpdf($id){
        	$sql = "SELECT *
			FROM field_reservation
			LEFT JOIN hr_amphur ON field_reservation.fr_amph_id = hr_amphur.amph_id
			LEFT JOIN hr_district ON field_reservation.fr_dist_id = hr_district.dist_id
			LEFT JOIN hr_province ON field_reservation.fr_pv_id = hr_province.pv_id
			WHERE fr_id = $id" ;
            $query = $this->ffm->query($sql);
            return $query;
        }

        function checkbox(){
            $sql = "SELECT *
            FROM cost_detail
            LEFT JOIN field_reservation ON cost_detail.cd_fr_id = field_reservation.fr_ff_id" ;
            $query = $this->ffm->query($sql);
            return $query;
        }
    }
?>