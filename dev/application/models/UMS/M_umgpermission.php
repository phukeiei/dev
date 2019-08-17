<?php

include_once("Da_umgpermission.php");

class M_umgpermission extends Da_umgpermission {

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
				FROM umgpermission 
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
	function get_menu_group($lv) {	
		$sql = "SELECT * FROM ummenu left join umgpermission on ummenu.MnID= umgpermission.gpMnID
		where (gpGpID is null or gpGpID=?) and MnStID=? and MnLevel=? and (gpX=1 or gpX is null) ORDER BY MnStID ASC,MnSeq ASC ,MnParentMnID ASC,MnID ASC ";//, gpMnID=?";
		$query = $this->ums->query($sql, array($this->gpGpID, $this->MnStID,$lv));
		return $query ;
	}
	
	function SearchByKey($mnid){
		$sql = "SELECT * 
				FROM umgpermission 
				WHERE gpGpID = ? 
				AND gpMnID = ?";
		$result = $this->ums->query($sql, array($this->session->userdata('GpID'), $mnid));
		if($result->num_rows()<>0){
			return $result->row_array();
		}else{
			return false;
		}
	}
	function SearchByKeyAndroid($mnid,$gpid){
		$sql = "SELECT * 
				FROM umgpermission 
				WHERE gpGpID = ? 
				AND gpMnID = ?";
		$result = $this->ums->query($sql, array($gpid, $mnid));
		if($result->num_rows()<>0){
			return $result->row_array();
		}else{
			return false;
		}
	}
	function Remove_by_gpMnID(){
		$sql = "DELETE FROM umgpermission 
				WHERE gpMnID=?";
		$this->ums->trans_begin();
		$this->ums->query($sql, array($this->gpMnID));
		if ($this->ums->trans_status() === FALSE)
			{
				$this->ums->trans_rollback();
			}
			else
			{
				$this->ums->trans_commit();
			}
	}
} // end class M_umgpermission
?>
