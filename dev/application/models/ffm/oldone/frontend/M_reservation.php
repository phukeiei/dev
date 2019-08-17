<?php 
    include_once(__dir__."/../M_field_reservation.php");
    class M_reservation extends  M_field_reservation{

        public $Starttime;
	    public $Endtime;
        public $number;
        public $fr_id;
        public $fr_ps_id;

        function __construct(){
            parent::__construct(); 
            
        }
    function get_all_reservation(){
        $sql="SELECT * 
              FROM field_reservation
              LEFT JOIN reservation_status ON reservation_status.rs_id=field_reservation.fr_status
              LEFT JOIN football_field ON football_field.ff_id=field_reservation.fr_status
              WHERE field_reservation.fr_ps_id = ?
              ORDER BY field_reservation.fr_id
              
            ";
        $query = $this->ffm->query($sql,array($this->fr_ps_id));
        return $query ;    
    }

    function change_status(){
        $sql="UPDATE field_reservation
				SET	fr_status=? 
                WHERE fr_id=? ";
        $query = $this->ffm->query($sql,array(4,$this->fr_id));
    }
//ไม่ใช่
    function get_by_code($ps_id){
        $sql = "SELECT * 
                FROM $this->hr_db.hr_person
                LEFT JOIN $this->hr_db.hr_person_detail ON hr_person_detail.psd_ps_id = hr_person.ps_id
                LEFT JOIN $this->hr_db.hr_district ON hr_district.dist_id = hr_person_detail.psd_addhome_dist_id
                LEFT JOIN $this->hr_db.hr_amphur ON hr_amphur.amph_id = hr_person_detail.psd_addhome_amph_id
                LEFT JOIN $this->hr_db.hr_province ON hr_province.pv_id = hr_person_detail.psd_addhome_pv_id
                LEFT JOIN $this->hr_db.hr_prefix ON hr_prefix.pf_id = hr_person.ps_pf_id
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

    function get_By_fleid_all(){
        $sql = "SELECT * FROM `football_field` WHERE ff_status = 'Y'";
        $query = $this->ffm->query($sql);
        return $query;
    }
    function get_By_fleid($fr_ff_id){
        $sql = "SELECT  *
                FROM field_reservation
                LEFT JOIN football_field ON field_reservation.fr_ff_id = football_field.ff_id
                LEFT JOIN ossd_hrdb.hr_prefix ON hr_prefix.pf_id = field_reservation.pf_id
                WHERE field_reservation.fr_status = 2 AND fr_ff_id = $fr_ff_id";
        $query = $this->ffm->query($sql);
        return $query;
    }
    function get_By_field2(){
        $sql = "SELECT 	*
                FROM $this->ffm_db.field_reservation
                LEFT JOIN $this->ffm_db.football_field ON field_reservation.fr_ff_id = football_field.ff_id
                WHERE field_reservation.fr_status = 2 AND 	field_reservation.fr_start_date = ? AND field_reservation.fr_ff_id = ?";
        $query = $this->ffm->query($sql,array($this->fr_start_date,$this->fr_ff_id));
        return $query;
    }

    function get_namefleid_date()
    {
        $sql = "SELECT 
                field_reservation.fr_ff_id AS FFid,fr_id,
                football_field.ff_name AS FFname,
                field_reservation.fr_start_date AS Startdate,
                field_reservation.fr_end_date AS Enddate,
                field_reservation.fr_start_time AS Starttime,
                field_reservation.fr_end_time AS Endtime,
                field_reservation.fr_number AS number
                FROM football_field
                LEFT JOIN field_reservation ON football_field.ff_id = field_reservation.fr_ff_id
                WHERE field_reservation.fr_id = ?";
        $query = $this->ffm->query($sql,array($this->fr_id));
        //echo $this->ffm->last_query();
        return $query;
    }

    function update_fr_start_time_fr_end_time_fr_number() {
		$sql = "UPDATE field_reservation
				SET	fr_start_time = ? 
                    , fr_end_time = ?
					, fr_number = ?
				WHERE  field_reservation.fr_id = ?";	
		$this->ffm->query($sql, array($this->Starttime,$this->Endtime,$this->number,$this->fr_id));	
    }
    
    


}
?>