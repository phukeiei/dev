<?php

include_once("Da_umpermission.php");

class M_umpermission extends Da_umpermission {

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
				FROM umpermission 
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
	
	/* this function use to show menu in personal permission
	function get_menu_people($lv) {	
		$sql = "SELECT * FROM ummenu left join umpermission on ummenu.MnID= umpermission.pmMnID
		where (gpGpID is null or gpGpID=?) and MnStID=? and MnLevel=? ORDER BY MnStID ASC,MnSeq ASC ,MnParentMnID ASC,MnID ASC ";//, gpMnID=?";
		$query = $this->ums->query($sql, array($this->gpGpID, $this->MnStID,$lv));
		return $query ; 
	}
	*/
	// Function from A.Wittawas
/* this stuff don't know
	function RSByUsIDX($usid,$x){
		$sql = "SELECT pmMnID
				FROM umpermission
				WHERE pmUsID = ?
				AND pmX = ?";
		$result = $this->ums->query($sql, array($usid,$x));
		return $result;
	}
*/
	function SearchByKey($mnid){
		$sql = "SELECT * 
				FROM umpermission 
				WHERE pmUsID = ? 
				AND pmMnID = ?";
		$result = $this->ums->query($sql, array($this->session->userdata('UsID'), $mnid));
		if($result->num_rows()<>0){
			return $result->row_array();
		}else{
			return false;
		}
	}
	
	function SelectByKeyAndroid($mnid,$usid){
		$sql = "SELECT * 
				FROM umpermission 
				WHERE pmUsID = ? 
				AND pmMnID = ?";
		$result = $this->ums->query($sql, array($usid, $mnid));
		if($result->num_rows()<>0){
			return $result->row_array();
		}else{
			return false;
		}
	}
} // end class M_umpermission
?>
