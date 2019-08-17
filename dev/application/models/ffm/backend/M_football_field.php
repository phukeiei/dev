<?php

include_once("Da_football_field.php");

class M_football_field extends Da_football_field {

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
				FROM football_field 
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
		$sql = "SELECT * 
				FROM football_field WHERE ff_status = 'Y' OR ff_status = 'N'
				";
		$qry = $this->ffm->query($sql);
		// if ($optional=='y') $opt[''] = 'ทั้งหมด';
		// foreach ($qry->result() as $row) {
		// 	$opt[$row->ff_id] = $row->ff_name;
		// }
		return $qry;
	}
	function get_table(){
		
		$sql = "SELECT * 
				FROM football_field
				WHERE ff_status != 'D'
				ORDER BY ff_name ASC";
		$query = $this->ffm->query($sql);
		return $query;
	}
	
	// add your functions here
	// แอมเพิ่ม function edit วันที่ 19/05/2562
	function edit(){
		$sql = "UPDATE football_field 
				SET	ff_name=?, ff_size=?, ff_status=?, ff_update=?, ff_user_update=? 
				WHERE ff_id=?";	
		$this->ffm->query($sql, array($this->ff_name, $this->ff_size, $this->ff_status, $this->ff_update, $this->ff_user_update, $this->ff_id));
		
	}

	function update_status() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE football_field 
				SET	ff_status=?
				WHERE ff_id=?";	
		$this->ffm->query($sql, array($this->ff_status,$this->ff_id));	
	}

		function time_count(){

			$sql = "SELECT *,fr_ff_id,COUNT(fr_start_time) as cont ,ff_name
			FROM field_reservation
			LEFT JOIN football_field on ff_id = fr_ff_id
			GROUP by fr_ff_id";
				$query = $this->ffm->query($sql);
				return $query;

		}
		function pp_count(){
   
			$sql = "SELECT fr_status,ff_name,fr_start_time,fr_end_time,COUNT(fr_first_name) as sum_,fr_first_name,fr_last_name,dist_name,pf_name
			FROM field_reservation
			left JOIN hr_district on dist_id = fr_id 
			LEFT JOIN football_field on fr_ff_id = ff_id
			LEFT JOIN ossd_hrdb.hr_prefix ON hr_prefix.pf_id = field_reservation.pf_id
			GROUP BY ff_id,fr_start_time";
  
	   $query = $this->ffm->query($sql);
	   return $query;
		}
	// function get_user_in_field($data){
	// 	$sql = "SELECT fr_start_time,fr_end_time,fr_first_name
	// 	FROM field_reservation
	// 	LEFT JOIN football_field on fr_ff_id = fr_id 
	// 	WHERE ff_id = $data";

	// 	$query = $this->ffm->query($sql);
	// 	return $query;
	// }

} // end class M_football_field
?>