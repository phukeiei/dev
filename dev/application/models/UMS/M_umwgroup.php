<?php

include_once("Da_umwgroup.php");

class M_umwgroup extends Da_umwgroup {

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
				FROM umwgroup 
				$orderBy";
		$query = $this->ums->query($sql);
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
	function show_all()
	{
		$orderBy="";
		$sql = "SELECT * 
		FROM umwgroup 
		$orderBy";
		$query = $this->ums->query($sql);
		return $query;
	}
	
	function get_by_key_with_sys($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umwgroup
				WHERE WgID=?";
		$query = $this->ums->query($sql, array($this->WgID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}

	function get_by_key_with_wg(){
		$sql = "SELECT * 
				FROM umwgroup
				WHERE WgID=?";
		$query = $this->ums->query($sql,array($this->session->userdata('UsWgID')));
		return $query;
	}

	function get_uniq()
	{
		$sql = "SELECT * FROM umwgroup WHERE WgNameT = ? OR WgNameE = ?";
		$query = $this->ums->query($sql,array($this->WgNameT,$this->WgNameE));
		return $query;
	}
	function get_uniq_with_ID()
	{
		$sql = "SELECT * FROM umwgroup WHERE WgID != ? AND (WgNameT = ? OR WgNameE = ?)";
		$query = $this->ums->query($sql,array($this->WgID,$this->WgNameT,$this->WgNameE));
		return $query;
	}
} // end class M_umwgroup
?>
