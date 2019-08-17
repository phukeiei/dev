<?php

include_once("Da_ummenu.php");

class M_ummenu extends Da_ummenu {

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
				FROM ummenu 
				$orderBy";
		$query = $this->ums->query($sql);
		return $query;
	}
	
	function get_all_join_icon($aOrderBy=""){
		$orderBy = "";
		if ( is_array($aOrderBy) ) {
			$orderBy.= "ORDER BY "; 
			foreach ($aOrderBy as $key => $value) {
				$orderBy.= "$key $value, ";
			}
			$orderBy = substr($orderBy, 0, strlen($orderBy)-2);
		}
		$sql = "SELECT * 
				FROM ummenu 
				LEFT JOIN umicon 
				on ummenu.MnIcon = umicon.IcName 
				$orderBy";
		$query = $this->ums->query($sql);
		return $query;
	}
	
	public function add_db($insert){
		
		return 
		$this->ums->trans_begin();
		$this->ums->insert('ummenu',$insert);
			if ($this->ums->trans_status() === FALSE)
				{
					$this->ums->trans_rollback();
				}
				else
				{
					$this->ums->trans_commit();
				}
		
		
		}
	
	/*
	 * create array of pk field and value for generate select list in view, must edit PK_FIELD and FIELD_NAME manually
	 * the first line of select list is '-----เลือก-----' by default.
	 * if you do not need the first list of select list is '-----เลือก-----', please pass $optional parameter to other values. 
	 * you can delete this function if it not necessary.
	 */
	function get_options($stid,$mnid,$lv){
		$sql = "SELECT *
				FROM ummenu
				WHERE MnStID = ?
				AND MnParentMnID LIKE ?
				AND MnLevel = ?
				ORDER BY MnID";
		$result = $this->ums->query($sql, array($stid,$mnid,$lv));
	//	echo $this->ums->last_query();
		return $result;
	}
	
	// add your functions here
	
	function get_menu ($stid,$gpid,$usid,$mnid,$lv){
		$sql = "SELECT *
				FROM ummenu
				JOIN umsystem ON MnStID = StID
				WHERE MnStID = ?
				AND (MnParentMnID = ? OR MnParentMnID IS NULL)
				AND MnLevel = ?
				AND MnID NOT IN 
				(
					SELECT distinct gp.gpMnID
					FROM umgpermission gp
					join ummenu mn ON gp.gpMnID = mn.MnID
					WHERE gp.gpGpID = ?
					AND mn.MnLevel = ?
					AND gp.gpX = 0
				)
				AND MnID NOT IN 
				(
					SELECT distinct pm.pmMnID
					FROM umpermission pm
					JOIN ummenu mn ON pm.pmMnID = mn.MnID
					WHERE pm.pmUsID = ?
					AND mn.MnLevel = ?
					AND pm.pmX = 0
				)
				ORDER BY MnSeq";
		$result = $this->ums->query($sql, array($stid,$mnid,$lv,$gpid,$lv,$usid,$lv));
		//echo $this->ums->last_query();
		return $result;
	}
	
	function get_by_key_with_sys($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM ummenu
				WHERE MnStID=?";
		$query = $this->ums->query($sql, array($this->MnStID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	function get_by_key_with_sys1($withSetAttributeValue=FALSE) {	
		$sql = "SELECT MnID 
				FROM ummenu 
				WHERE MnStID=?";
		$query = $this->ums->query($sql, array($this->MnStID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
	function updateSeq() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE ummenu 
				SET MnSeq=? 
				WHERE MnID=?";
		$this->ums->trans_begin();
		$this->ums->query($sql, array($this->MnSeq, $this->MnID));
			if ($this->ums->trans_status() === FALSE)
				{
					$this->ums->trans_rollback();
				}
				else
				{
					$this->ums->trans_commit();
				}
	}
	
	function get_by_key_with_menu($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM ummenu
				WHERE MnID=?";
		$query = $this->ums->query($sql, array($this->MnID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	function get_by_key_with_stid($StID) {	
		$sql = "SELECT MnID,MnNameT,MnLevel 
				FROM ummenu
				WHERE MnStID=?
				order by MnSeq";
		$query = $this->ums->query($sql, array($StID));
		return $query ;
	}
	
	function get_menu_lv($stid,$gpid,$usid,$lv){
		$sql = "SELECT *
				FROM ummenu
				LEFT JOIN umicon 
				on  ummenu.MnIcon = umicon.IcName
				JOIN umsystem ON MnStID = StID
				WHERE MnStID = ?
				AND MnLevel = ?
				AND MnID NOT IN 
				(
					SELECT distinct gp.gpMnID
					FROM umgpermission gp
					join ummenu mn ON gp.gpMnID = mn.MnID
					WHERE gp.gpGpID = ?
					AND mn.MnLevel = ?
					AND gp.gpX = 0
				)
				AND MnID NOT IN 
				(
					SELECT distinct pm.pmMnID
					FROM umpermission pm
					JOIN ummenu mn ON pm.pmMnID = mn.MnID
					WHERE pm.pmUsID = ?
					AND mn.MnLevel = ?
					AND pm.pmX = 0
				)
				ORDER BY MnSeq";
		$result = $this->ums->query($sql, array($stid,$lv,$gpid,$lv,$usid,$lv));
		return $result;
	}
	function get_menu_url($mnid)
	{
		$sql = "SELECT * FROM ummenu WHERE MnID = ? ";
		$result = $this->ums->query($sql,$mnid);
		if($result->num_rows() >0)
		{
			return $result->row_array();
		}
		else
		{
			return false;
		}
	}
	function get_MnID($MnNameT,$MnStID)
	{
		$sql ="SELECT * FROM ummenu WHERE MnNameT = ? and MnStID = ?";
		$query = $this->ums->query($sql,array($MnNameT,$MnStID));
		foreach($query->result_array() as $mn)
		{
			return $mn['MnID'];
		}
	}
	function get_submenu($mnid)
	{
		$sql ="SELECT * FROM ummenu LEFT JOIN umicon 
				on ummenu.MnIcon = umicon.IcName WHERE MnParentMnID = ? and MnStID = ? 
				AND MnID NOT IN 
				(
					SELECT distinct gp.gpMnID
					FROM umgpermission gp
					join ummenu mn ON gp.gpMnID = mn.MnID
					WHERE gp.gpGpID = ?
					AND gp.gpX = 0
				)
				AND MnID NOT IN 
				(
					SELECT distinct pm.pmMnID
					FROM umpermission pm
					JOIN ummenu mn ON pm.pmMnID = mn.MnID
					WHERE pm.pmUsID = ?
					AND pm.pmX = 0
				)
				order by (ummenu.MnSeq)";
		$query = $this->ums->query($sql,array($mnid,$this->session->userdata('StID'),$this->session->userdata('GpID'),$this->session->userdata('UsID')));
		return $query;
	}
	function get_sidebar_path($MnID)
	{
		$path = array();
		$sql = "SELECT * FROM ummenu INNER JOIN umicon 
				on umicon.IcName = ummenu.MnIcon WHERE MnID = ? and MnStID = ? ";
		$thismenu = $this->ums->query($sql,array($this->session->userdata('MnID'),$this->session->userdata('StID')))->row_array();
		if(isset($thismenu['MnParentMnID'])){ 
		while($thismenu['MnParentMnID'] != 0)
		{
			$sql = "SELECT * FROM ummenu WHERE MnID = ?";
			$thismenu = $this->ums->query($sql,array($thismenu['MnParentMnID']))->row_array();
			array_push($path,$thismenu);
		}
		rsort($path);
		return $path;
		}
	}
	function get_uniq()
	{
		$sql = "SELECT * FROM ummenu WHERE MnStID = ? AND MnParentMnID = ? AND(MnNameT = ? OR MnNameE = ?)";
		$query = $this->ums->query($sql,array($this->MnStID ,$this->MnParentMnID ,$this->MnNameT , $this->MnNameE));
		return $query;
	}
	function get_uniq_with_MnID()
	{
		$sql = "SELECT * FROM ummenu WHERE MnStID = ? AND MnID != ? AND MnParentMnID = ? AND(MnNameT = ? OR MnNameE = ?)";
		$query = $this->ums->query($sql,array($this->MnStID ,$this->MnID ,$this->MnParentMnID ,$this->MnNameT , $this->MnNameE));
		return $query;
	}

	function get_submenu2()
	{
		$sql ="SELECT * FROM ummenu LEFT JOIN umicon 
				on ummenu.MnIcon = umicon.IcName 
				WHERE MnStID = ? and MnParentMnID = (SELECT MnParentMnID FROM ummenu WHERE MnID = ?)";
		$query = $this->ums->query($sql,array($this->session->userdata('StID'),$this->session->userdata('MnID')));
		return $query;
	}
	
	
} // end class M_ummenu
?>
