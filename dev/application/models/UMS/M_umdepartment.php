<?php

include_once("Da_umdepartment.php");

class M_umdepartment extends Da_umdepartment {

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
				FROM umdepartment 
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
		FROM umdepartment 
		$orderBy";
		$query = $this->ums->query($sql);
		return $query;
	}
	
	function get_by_key_with_sys($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umdepartment
				WHERE dpID=?";
		$query = $this->ums->query($sql, array($this->dpID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	function get_by_dp_name($dpName){
		$sql = "SELECT * 
				FROM umdepartment
				WHERE dpName = ? ";
		$query = $this->ums->query($sql,array($dpName));
		return $query->row_array();
	}
	function get_by_dp_id($dpID){
		$sql = "SELECT * 
				FROM umdepartment
				WHERE dpID = ? ";
		$query = $this->ums->query($sql,array($dpID));
		return $query->row_array();
	}
	function get_uniq()
	{
		$sql = "SELECT * FROM umdepartment WHERE dpName = ?";
		$query = $this->ums->query($sql,array($this->dpName));
		return $query;
	}
	function get_uniq_with_ID()
	{
		$sql = "SELECT * FROM umdepartment WHERE dpID != ? AND dpName = ?";
		$query = $this->ums->query($sql,array($this->dpID,$this->dpName));
		return $query;
	}
} // end class  
?>
