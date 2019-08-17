<?php

include_once("Da_umgroupdefault.php");

class M_umgroupdefault extends Da_umgroupdefault {

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
				FROM umgroupdefault 
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
	function delete_by_GdGpID() {
		$sql = "DELETE FROM umgroupdefault
				WHERE GdGpID=?";
		
		$this->ums->trans_begin();
		$this->ums->query($sql, array($GdGpID));
		if ($this->ums->trans_status() === FALSE)
		{
			$this->ums->trans_rollback();
		}
		else
		{
			$this->ums->trans_commit();
		}
	}
	// add your functions here
	function get_by_default($WgID){
		$sql = "SELECT * FROM  umgroupdefault
				WHERE GdWgID = ?";
		$query = $this->ums->query($sql,array($WgID));
		return $query;
	}
} // end class M_umgroupdefault
?>
