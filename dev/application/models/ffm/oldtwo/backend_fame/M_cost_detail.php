<?php

include_once("Da_cost_detail.php");

class M_cost_detail extends Da_cost_detail {

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
				FROM cost_detail 
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
			$opt[$row->PK_FIELD] = $row->FIELD_NAME;
		}
		return $opt;
	}
	
	// add your functions here

	function get_table_bill(){
		$sql = "SELECT pf_name,ps_fname,ps_lname,ps_in_area,ff_name,cd_start_time,cd_end_time,cd_update
		FROM cost_detail
		LEFT JOIN field_reservation ON  fr_id = cd_fr_id
		LEFT JOIN football_field ON ff_id = fr_ff_id
		LEFT JOIN ossd_hrdb.hr_person ON  hr_person.ps_id = fr_ps_id
		LEFT JOIN ossd_hrdb.hr_prefix ON hr_prefix.pf_id = hr_person.ps_pf_id";
		$query = $this->ffm->query($sql);
		return $query;
	}

} // end class M_cost_detail
?>