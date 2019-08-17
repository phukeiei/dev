<?php

include_once("application/models/ffm/M_complain.php");

class M_complain_font extends M_complain {

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
				FROM complain 
				$orderBy";
		$query = $this->db->query($sql);
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
			$opt[$row->PK_FIELD] = $row->FIELD_NAME;
		}
		return $opt;
	}
	
	function get_address($keyword){
		$dist = explode(" ",$keyword);
		$str = isset($dist[1]) ? " and (amph_name like '%".$dist[1]."%' OR pv_name like '%".$dist[1]."%') " : "";
		$sql = "SELECT *
				FROM ".$this->hr_db.".hr_district
				LEFT JOIN ".$this->hr_db.".hr_amphur 
					ON dist_amph_id = amph_id
				LEFT JOIN ".$this->hr_db.".hr_province
					ON dist_pv_id = pv_id
				WHERE dist_name LIKE ? $str
				LIMIT 6";
			return $this->ffm->query($sql,'%'.$dist[0].'%');
	}
	
	// add your functions here

} // end class M_complain
?>