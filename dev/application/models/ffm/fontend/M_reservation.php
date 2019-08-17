<?php 
    include_once(__dir__."/../M_field_reservation.php");
    class M_reservation extends  M_field_reservation{
        function __construct(){
            parent::__construct(); 
            
        }
    function get_all_reservation(){
        $sql="SELECT * 
              FROM field_reservation
              LEFT JOIN reservation_status ON reservation_status.rs_id=field_reservation.fr_status
              LEFT JOIN football_field ON football_field.ff_id=field_reservation.fr_status
              ORDER BY field_reservation.fr_id;
            ";
        $query = $this->ffm->query($sql);
        
        return $query ;    
    }

    function change_status(){
        $sql="UPDATE field_reservation
				SET	fr_status=? 
                WHERE fr_id=? "
                ;
        $query = $this->ffm->query($sql,array(4,$this->fr_id));
    }
//ไม่ใช่
    function get_by_code($ps_id){
        $sql = "SELECT * 
                FROM $this->hr_db.hr_person
                JOIN $this->hr_db.hr_person_detail ON hr_person_detail.psd_ps_id = hr_person.ps_id
                JOIN $this->hr_db.hr_district ON hr_district.dist_id = hr_person_detail.psd_addhome_dist_id
                JOIN $this->hr_db.hr_amphur ON hr_amphur.amph_id = hr_person_detail.psd_addhome_amph_id
                JOIN $this->hr_db.hr_province ON hr_province.pv_id = hr_person_detail.psd_addhome_pv_id
                WHERE hr_person.ps_id = ?";
        $query = $this->ffm->query($sql,array($ps_id));
        return $query;
    }
    function get_all_field(){
        $sql = "SELECT *
                FROM $this->ffm_db.football_field";
        $query = $this->ffm->query($sql);
        return $query;
    }
    
    function get_pv(){
        $sql = "SELECT *
                FROM $this->hr_db.hr_province";
        $query = $this->ffm->query($sql);
        return $query;
    }

    function get_amph($pv_id){
        $sql = "SELECT *
                FROM $this->hr_db.hr_amphur
                JOIN $this->hr_db.hr_province ON hr_province.pv_id = hr_amphur.amph_id 
                WHERE pv_id = ?";
        $query = $this->ffm->query($sql,array($pv_id));
        return $query;
    }
    function get_prefix(){
        $sql = "SELECT *
                FROM $this->hr_db.hr_prefix";
        $query = $this->ffm->query($sql);
        return $query;       
    }
    function get_dist($amph_id){
        $sql = "SELECT *
                FROM $this->hr_db.hr_district
                JOIN $this->hr_db.hr_amphur ON hr_amphur.amph_id = hr_district.dist_id
                WHERE amph_id = ?";
        $query = $this->ffm->query($sql,array($amph_id));
        return $query;
    }

    function get_time(){
        $sql = "SELECT *
                FROM $this->ffm_db.cost_config";
        $query = $this->ffm->query($sql);
        return $query;
    }

    function get_By_fleid(){
        $sql = "SELECT 	*
                FROM $this->ffm_db.field_reservation
                JOIN $this->ffm_db.football_field ON field_reservation.fr_ff_id = football_field.ff_id
                WHERE field_reservation.fr_status = 2 ";
        $query = $this->ffm->query($sql);
        return $query;
    }
    function get_By_fleid2(){
        $sql = "SELECT 	*
                FROM $this->ffm_db.field_reservation
                JOIN $this->ffm_db.football_field ON field_reservation.fr_ff_id = football_field.ff_id
                WHERE field_reservation.fr_status = 2 AND 	fr_start_date = ? AND fr_ff_id = ?";
        $query = $this->ffm->query($sql,array($this->$fr_start_date,$this->$fr_ff_id));
        return $query;
    }
}
?>
