<?php

include_once("Da_complain.php");

class M_complain extends Da_complain {

	/*
	 * aOrderBy = array('fieldname' => 'ASC|DESC', ... )
	 */
	public $tp_id ;
	public $tp_complain;
	


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

	function get_table_complain(){
		$sql = "SELECT pf_name,ps_fname,ps_lname,tp_complain,`cp_update` ,cp_id, cp_complain
		FROM complain 
		LEFT JOIN type_complain ON tp_id = cp_tp_id
        LEFT JOIN ossd_hrdb.hr_person ON ps_id = cp_fr_id
        LEFT JOIN ossd_hrdb.hr_prefix ON pf_id = ps_pf_id";
		$query = $this->ffm->query($sql);
		return $query;
	}
	

} // end class M_complain
?>