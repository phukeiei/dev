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
				where Extract(YEAR from fr_write_date )  = Extract(YEAR from NOW()) AND fr_status = 6" ;
	
		$query = $this->ffm->query($sql);
		return $query;
	}
	function get_data_user(){
			$sql = "SELECT A.fr_id AS id_a , B.fr_id AS id_b, Extract(DAY from B.fr_write_date )
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
			if($field == 'all'){
				$sql =	"SELECT * 
				FROM field_reservation
				LEFT JOIN reservation_status ON fr_status = rs_id
				LEFT JOIN football_field ON fr_ff_id = ff_id
				INNER JOIN cost_detail ON fr_id = cd_fr_id  
				LEFT JOIN ossd_hrdb.hr_person ON fr_ps_id = ps_id
				LEFT JOIN ossd_hrdb.hr_prefix ON hr_prefix.pf_id = field_reservation.pf_id
				WHERE fr_start_date = '$date'
				ORDER BY fr_start_time DESC";
				$query = $this->ffm->query($sql);
				return $query;
			}
			$sql =	"SELECT * 
			FROM field_reservation
			LEFT JOIN reservation_status ON fr_status = rs_id
			LEFT JOIN football_field ON fr_ff_id = ff_id
			INNER JOIN cost_detail ON fr_id = cd_fr_id  
			LEFT JOIN ossd_hrdb.hr_person ON fr_ps_id = ps_id
			LEFT JOIN ossd_hrdb.hr_prefix ON hr_prefix.pf_id = field_reservation.pf_id
			WHERE fr_ff_id = $field AND fr_start_date = '$date'
			ORDER BY fr_start_time DESC";
			$query = $this->ffm->query($sql);
			return $query;
		}else{
			$sql =	"SELECT * 
			FROM field_reservation
			LEFT JOIN reservation_status ON fr_status = rs_id
			LEFT JOIN football_field ON fr_ff_id = ff_id
			INNER JOIN cost_detail ON fr_id = cd_fr_id  
			LEFT JOIN ossd_hrdb.hr_person ON fr_ps_id = ps_id
			LEFT JOIN ossd_hrdb.hr_prefix ON hr_prefix.pf_id = field_reservation.pf_id
			ORDER BY fr_start_time DESC";
			$query = $this->ffm->query($sql);
			return $query;
		}
		
		
	}


	//แสดงกราฟจำนวนคนจองใน ปี เดือน ที่รับค่ามา
	//จิรเมธ พั่วพันธ์ 60160157
	function get_total_of_customer($year,$month){
		$sql =	"SELECT  extract(MONTH  from A.fr_write_date)AS YearMonth, COUNT(DISTINCT(A.fr_id) ) as total
				FROM field_reservation A, field_reservation B
				WHERE A.fr_id = B.fr_fr_id AND   extract(YEAR  from A.fr_write_date) = $year AND   extract(MONTH  from A.fr_write_date) = $month 
				";
		$query = $this->ffm->query($sql);
		return $query;
	}
	
	//แสดงกราฟ
	function get_total_of_income($year,$month){
		$sql =	"SELECT  extract(MONTH  from fr_write_date)AS YearMonth, SUM(fr_cost ) as total
					FROM field_reservation
					WHERE fr_status = 6 AND extract(YEAR  from fr_write_date) =  $year AND   extract(MONTH  from fr_write_date) = $month 
				";
		$query = $this->ffm->query($sql);
		return $query;
	}

	function update_status($status,$date) {	
		if($status == 2){
			$sql = "SELECT *
					FROM field_reservation
					LEFT JOIN cost_detail ON fr_id = cd_fr_id  
					WHERE fr_id = $this->fr_id";
			$query = $this->ffm->query($sql)->row();		
			$sql = "UPDATE field_reservation a 
					SET a.fr_status = 4 
					WHERE fr_id IN (SELECT fr_id 
									FROM (select * from field_reservation) b 
									LEFT JOIN cost_detail ON b.fr_id = cd_fr_id 
									WHERE b.fr_status != 2 AND b.fr_start_date = '$date' AND cd_start_time BETWEEN '$query->cd_start_time' AND '$query->cd_end_time'
									OR cd_end_time BETWEEN '$query->cd_start_time' AND '$query->cd_end_time')";			
			$this->ffm->query($sql);
		}
		$sql = "UPDATE field_reservation 	
				SET	fr_status=? 
				WHERE fr_id=?";	
		$this->ffm->query($sql, array($status,$this->fr_id));
		
	}

	//นพ หน้าincome
	function get_all_price(){
		$sql = "SELECT fr_cost,ff_name ,SUM(fr_cost) as sum_cost,COUNT(fr_first_name) as sum_pp ,fr_first_name,fr_last_name
		FROM field_reservation
		LEFT JOIN football_field on fr_ff_id = ff_id
		where fr_status = 2
        GROUP BY ff_id" ;
	
		$query = $this->ffm->query($sql);
		return $query;
	}
	
	//นพ ส่งรายการประวัติรายได้
	function find_date(){
		$sql ="SELECT fr_start_date,ff_name,COUNT(fr_first_name) as cout ,SUM(fr_cost) as cost 
		FROM field_reservation
		LEFT JOIN football_field on ff_id = fr_ff_id";
		
		
		$query = $this->ffm->query($sql);
		return $query;
		
	}
	//get ใบจอง
	function get_data_for_bill_by_id($id){
		$sql =	"SELECT *
				FROM `field_reservation` 
				LEFT JOIN football_field ON fr_ff_id = ff_id
				WHERE fr_fr_id = $id OR (fr_id = $id AND fr_fr_id IS NULL)";
		$query = $this->ffm->query($sql);
		return $query;

	}

	function get_data_for_reservation_by_id($id){
		$sql =	"SELECT *
				FROM `field_reservation` 
				WHERE fr_id = $id";
		$query = $this->ffm->query($sql);
		return $query;

	}


	//แสดงจำนวนการขอเข้าใช้สนามทั้งหมด :gun
	function get_result_reservation(){
		$sql =	"SELECT pf_name,fr_first_name,fr_last_name ,ps_in_area, COUNT(*) as reservation_count
		FROM field_reservation
        LEFT JOIN ossd_hrdb.hr_person ON hr_person.ps_id = fr_ps_id
        LEFT JOIN ossd_hrdb.hr_prefix ON hr_prefix.pf_id = ps_pf_id
		group by fr_first_name";	
		$query = $this->ffm->query($sql);
		return $query;
	}

	//แสดงจำนวนคำขอของผู้ใช้ที่อนุมัติ :gun
	function get_result_reservation_accep($fr_first_name){
		$sql =	"SELECT fr_status 
		FROM field_reservation
		WHERE fr_status = 2 and fr_first_name='$fr_first_name'";
		$query = $this->ffm->query($sql);
		return $query;
	}

	function update_bill() {
		$sql = 'UPDATE field_reservation SET fr_status = 6 WHERE fr_id = ?';
		$this->ffm->query($sql, array(
			$this->id,
		));
	}

	function insert_special() {
		$sql = 'INSERT INTO field_reservation (fr_start_time, fr_end_time, fr_cost, fr_fr_id)'
				.' VALUES (?, ?, ?, ?)';
		$this->ffm->query($sql, array(
			$this->start_time,
			$this->end_time,
			$this->cost,
			$this->main_id,
		));

		return $this->ffm->insert_id();
	}

	function insert_cost_detail() {
		$sql = 'INSERT INTO cost_detail (cd_fr_id, cd_seq, cd_start_time, cd_end_time, cd_hour, cd_cost)'
				.' VALUES (?, ?, ?, ?, ?, ?)';
		$this->ffm->query($sql, array(
			$this->sub_id,
			$this->seq,
			$this->start_time,
			$this->end_time,
			$this->hour,
			$this->cost,
		));
	}

	function get_data_for_bill(){
		$sql =	"SELECT * 
		FROM field_reservation
		LEFT JOIN football_field ON fr_ff_id = ff_id
		LEFT JOIN ossd_hrdb.hr_person ON hr_person.ps_id = fr_ps_id
        LEFT JOIN ossd_hrdb.hr_prefix ON hr_prefix.pf_id = ps_pf_id
		WHERE fr_status = 2 OR fr_status = 6
		ORDER BY fr_start_date DESC, ff_name , fr_start_time";
		$query = $this->ffm->query($sql);
		return $query;
	}

} // end class M_field_reservation
?>