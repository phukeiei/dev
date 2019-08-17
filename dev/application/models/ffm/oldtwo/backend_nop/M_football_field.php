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
		$qry = $this->get_all();
		if ($optional=='y') $opt[''] = '-----เลือก-----';
		foreach ($qry->result() as $row) {
			$opt[$row->PK_FIELD] = $row->FIELD_NAME;
		}
		return $opt;
	}
	function get_table(){		
		$sql = "SELECT * 
				FROM football_field";
		$query = $this->ffm->query($sql);
		return $query;
	}
	// add your functions here

	function get_user_in_field($data){
		$sql = "SELECT fr_start_time,fr_end_time,fr_first_name
		FROM field_reservation
		LEFT JOIN football_field on fr_ff_id = fr_id 
		WHERE ff_id = $data";

		$query = $this->ffm->query($sql);
		return $query;
	}
} // end class M_football_field
?>