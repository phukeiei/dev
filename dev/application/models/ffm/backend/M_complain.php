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

	// แสดงรายการความคิดเห็น : กัน 
	function get_table_complain(){
		$sql = "SELECT *
		FROM complain
		left join type_complain on tp_id = cp_tp_id
		left join field_reservation on fr_ps_id = cp_fr_id
		left join football_field on fr_ff_id = ff_id
		left join ossd_hrdb.hr_person on hr_person.ps_id = cp_fr_id
		left join ossd_hrdb.hr_prefix on hr_prefix.pf_id = hr_person.ps_pf_id";
		
		$query = $this->ffm->query($sql);
		return $query;
	}
	

} // end class M_complain
?>