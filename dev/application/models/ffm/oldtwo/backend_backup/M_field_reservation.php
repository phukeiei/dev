<?php

include_once("Da_field_reservation.php");

class M_field_reservation extends Da_field_reservation {

	/*
	 * aOrderBy = array('fieldname' => 'ASC|DESC', ... )
	 */
	function get_all($aOrderBy=""){
		$orderBy = "";
		if ( is_array($aOrderBy) ) {
			$orderBy.= "ORDER BY "; 
			foreach ($aOrderBy as $key => $value) {
				$orderBy.= "$key $value, ";
			}
			$orderBy = substr($orderBy, 0, strlen($orderBy)-2);
		}
		$sql = "SELECT * 
				FROM field_reservation 
				$orderBy";
		$query = $this->ffm->query($sql);
		return $query;
	}

	/*
	 * create array of pk field and value for generate select list in view, must edit PK_FIELD and FIELD_NAME manually
	 * the first line of select list is '-----เลือก-----' by default.
	 * if you do not need the first list of select list is '-----เลือก-----', please pass $optional parameter to other values. 
	 * you can delete this function if it not necessary.
	 */
	function get_options($optional='y') {
		$qry = $this->get_all();
		if ($optional=='y') $opt[''] = '-----เลือก-----';
		foreach ($qry->result() as $row) {
			$opt[$row->ff_id] = $row->ff_name;
		}
		return $opt;
	}
	
	// add your functions here

	function get_data(){
		$sql = "SELECT *  
				FROM field_reservation" ;
	
		$query = $this->ffm->query($sql);
		return $query;
	}
	function get_data_price(){
		$sql = "SELECT *  
				FROM field_reservation
				where Extract(YEAR from fr_write_date )  = Extract(YEAR from NOW())" ;
	
		$query = $this->ffm->query($sql);
		return $query;
	}
	function get_data_user(){
			$sql = "SELECT A.fr_id AS id_a , B.fr_id AS id_b,Extract(DAY from B.fr_write_date )
			FROM field_reservation A, field_reservation B
			WHERE A.fr_id = B.fr_fr_id 
			and Extract(DAY from B.fr_write_date )  = Extract(DAY from NOW() )
			and Extract(MONTH from B.fr_write_date )  = Extract(MONTH from NOW() )
			and 	Extract(YEAR from B.fr_write_date )  = Extract(YEAR from NOW() )					
			GROUP by id_a" ;

		$query = $this->ffm->query($sql);
		return $query;
	}

	//แสดงรายการคำร้อง
	//จิรเมธ พั่วพันธ์ 60160157
	function get_data_reservation($field,$date){
		if(isset($field)){	
			$sql =	"SELECT * 
			FROM field_reservation
			LEFT JOIN reservation_status ON fr_status = rs_id
			LEFT JOIN football_field ON fr_ff_id = ff_id
			INNER JOIN cost_detail ON fr_id = cd_fr_id  
			LEFT JOIN ossd_hrdb.hr_person ON fr_ps_id = ps_id
			LEFT JOIN ossd_hrdb.hr_prefix ON hr_prefix.pf_id = field_reservation.pf_id
			WHERE ff_id = $field AND fr_start_date = $date
				";
			$query = $this->ffm->query($sql);
		}else{
			$sql =	"SELECT * 
			FROM field_reservation
			LEFT JOIN reservation_status ON fr_status = rs_id
			LEFT JOIN football_field ON fr_ff_id = ff_id
			INNER JOIN cost_detail ON fr_id = cd_fr_id  
			LEFT JOIN ossd_hrdb.hr_person ON fr_ps_id = ps_id
			LEFT JOIN ossd_hrdb.hr_prefix ON hr_prefix.pf_id = field_reservation.pf_id
				";
			$query = $this->ffm->query($sql);
		}
		
		return $query;
	}


	//แสดงจำนวนคนจองใน ปี เดือน ที่รับค่ามา
	//จิรเมธ พั่วพันธ์ 60160157
	function get_total_of_customer($year,$month){
		$sql =	"SELECT  extract(MONTH  from A.fr_write_date)AS YearMonth, COUNT(DISTINCT(A.fr_id) ) as total
				FROM field_reservation A, field_reservation B
				WHERE A.fr_id = B.fr_fr_id AND   extract(YEAR  from A.fr_write_date) = $year AND   extract(MONTH  from A.fr_write_date) = $month 
				";
		$query = $this->ffm->query($sql);
		return $query;
	}
	
	
	function get_total_of_income($year,$month){
		$sql =	"SELECT  extract(MONTH  from fr_write_date)AS YearMonth, SUM(fr_cost ) as total
					FROM field_reservation
					WHERE extract(YEAR  from fr_write_date) =  $year AND   extract(MONTH  from fr_write_date) = $month 
				";
		$query = $this->ffm->query($sql);
		return $query;
	}

	function update_status($status) {	
		if($status == 2){
			$sql = "SELECT *
					FROM field_reservation
					LEFT JOIN cost_detail ON fr_id = cd_fr_id  
					WHERE fr_id = $this->fr_id";
			$query = $this->ffm->query($sql)->row();		
			$sql = "UPDATE field_reservation a 
					SET a.fr_status=4 
					WHERE fr_id IN (SELECT fr_id 
									FROM (select * from field_reservation) b 
									LEFT JOIN cost_detail ON b.fr_id = cd_fr_id 
									WHERE cd_start_time BETWEEN '$query->cd_start_time' AND '$query->cd_end_time'
									OR cd_end_time BETWEEN '$query->cd_start_time' AND '$query->cd_end_time')";			
			$this->ffm->query($sql);
		}
		$sql = "UPDATE field_reservation 
				SET	fr_status=? 
				WHERE fr_id=?";	
		$this->ffm->query($sql, array($status,$this->fr_id));
		
	}

	// function get_check_time(){
	// 	$sql =	"SELECT * 
	// 			FROM field_reservation
	// 			LEFT JOIN reservation_status ON fr_status = rs_id
	// 			LEFT JOIN football_field ON fr_ff_id = ff_id
	// 			LEFT JOIN cost_detail ON ff_id = cd_fr_id  
	// 			WHERE cd_start_time BETWEEN '09:00:00' AND '12:00:00'";	
	// 	$query = $this->ffm->query($sql);
	// 	return $query;
	// }

	// function get_time(){
	// 	$sql =	"SELECT * 
	// 			FROM field_reservation
	// 			LEFT JOIN reservation_status ON fr_status = rs_id
	// 			LEFT JOIN football_field ON fr_ff_id = ff_id
	// 			LEFT JOIN cost_detail ON ff_id = cd_fr_id  
	// 			WHERE = fr_id";	
	// 	$query = $this->ffm->query($sql);
	// 	return $query;
	// }
} // end class M_field_reservation
?>