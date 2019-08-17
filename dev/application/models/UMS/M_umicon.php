<?php

include_once("Da_umicon.php");

class M_umicon extends Da_umicon {

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
				FROM umicon 
				$orderBy order by IcID ";
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
	function get_by_type($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umicon 
				WHERE IcType=?";
		$query = $this->ums->query($sql, array($this->IcType));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
	function get_by_name($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umicon 
				WHERE IcName=?";
		$query = $this->ums->query($sql, array($this->IcName));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
	function get_date_by_name($withSetAttributeValue=FALSE) {	
		$sql = "SELECT IcDate 
				FROM umicon 
				WHERE IcName=?";
		$query = $this->ums->query($sql, array($this->IcName));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
} // end class M_umicon
?>
