<?php

include_once("Da_umquestion.php");

class M_umquestion extends Da_umquestion {

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
				FROM umquestion 
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
		FROM umquestion
		$orderBy";
		$query = $this->ums->query($sql);
		return $query;
	}
	
	function get_by_key_with_sys($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umquestion WHERE umquestion.QsID=?"; /*INNER JOIN umsystem
				ON umquestion.QsID =umsystem.StID
				WHERE QsID=?";*/
		$query = $this->ums->query($sql, array($this->QsID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	function getLastID(){
		$sql="SELECT max(QsID)as QsID FROM umquestion";
		$query=$this->db->query($sql);
		return $query;
	}
	function get_uniq(){
		$sql = "SELECT * FROM umquestion WHERE QsDescT =? OR QsDescE = ?";
		$query = $this->ums->query($sql,array($this->QsDescT,$this->QsDescE));
		return $query;
	}
	function get_uniq_with_ID(){
		$sql = "SELECT * FROM umquestion WHERE QsID != ? AND(QsDescT = ? OR QsDescE = ?)";
		$query = $this->ums->query($sql,array($this->QsID, $this->QsDescT,$this->QsDescE));
		return $query;
	}
} // end class M_umquestion
?>
