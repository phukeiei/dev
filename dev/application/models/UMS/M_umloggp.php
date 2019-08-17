<?php

include_once("Da_umloggp.php");

class M_umloggp extends Da_umloggp{

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
				FROM umloggp 
				$orderBy";
		$query = $this->ums->query($sql);
		return $query;
	}
	
	/*
	 * create array of pk field and value for generate select list in view, must edit PK_FIELD and FIELD_NAME manually
	 * the first line of select list is '-----?????-----' by default.
	 * if you do not need the first list of select list is '-----?????-----', please pass $optional parameter to other values. 
	 * you can delete this function if it not necessary.
	 */
	function get_options($optional='y') {
		$qry = $this->get_all();
		if ($optional=='y') $opt[''] = '-----?????-----';
		foreach ($qry->result() as $row) {
			$opt[$row->PK_FIELD] = $row->FIELD_NAME;
		}
		return $opt;
	}

	function get_loggp_all()
	{
		$sql = "	SELECT UsName ,StNameT, GpNameT ,umgroup.GpID, status , start_time , end_time FROM umloggp
					left join umgroup on umloggp.GpID = umgroup.GpID
					left join umuser on umloggp.UsID = umuser.UsID
					left join umsystem on umgroup.GpStID = umsystem.StID
					";
		$query = $this->ums->query($sql);
		return $query;
	}
	// add your functions here
} // end class M_umloggp
?>
