<?php

include_once("Da_umsystem.php");

class M_umsystem extends Da_umsystem {

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
				FROM umsystem 
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
				FROM umsystem 
				LEFT JOIN umicon 
				on umsystem.StIcon = umicon.IcName 
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

	public function add_db($insert){
		
		return 
		$this->ums->trans_begin();
		$this->ums->insert('umsystem',$insert);
			if ($this->ums->trans_status() === FALSE)
				{
					$this->ums->trans_rollback();
				}
				else
				{
					$this->ums->trans_commit();
				}
		
		
		}
		
	function get_by_key_sys($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umsystem 
				WHERE StID=?";
		$query = $this->ums->query($sql, array($this->StID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
	function show_all()
	{
		$orderBy="";
		$sql = "SELECT * 
		FROM umsystem
		$orderBy";
		$query = $this->ums->query($sql);
		return $query;
	}
	
	function get_name($Sys)
	{
		$sql = "SELECT * FROM umsystem WHERE StID=?";
		$query = $this->ums->query($sql,array($Sys));
		foreach($query->result_array() as $system)
		{
			return $system['StNameT'];
			
		}
	}
	/*function delete_in_gpermission($gpGpID)
	{
		$sql = "DELETE FROM umgpermission WHERE gpGpID in (?)";
		$this->ums->trans_begin();
		$this->ums->query($sql, array($gpGpID));
		if ($this->ums->trans_status() === FALSE)
			{
				$this->ums->trans_rollback();
			}
			else
			{
				$this->ums->trans_commit();
			}
	}
	function delete_in_permission($pmMnID)
	{
		$sql = "DELETE FROM umpermission WHERE pmMnID in (?)";
		$this->ums->trans_begin();
		$this->ums->query($sql, array($pmMnID));
		if ($this->ums->trans_status() === FALSE)
			{
				$this->ums->trans_rollback();
			}
			else
			{
				$this->ums->trans_commit();
			}
	}
	function delete_in_groupdefault($GdGpID)
	{
		$sql = "DELETE FROM umgroupdefault WHERE GdGpID in (?)";
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
	}*/
	function delete_in_gpermission()
	{
		$sql = "DELETE FROM umgpermission WHERE gpGpID in (SELECT GpID from umgroup where GpStID = ?)";
		$this->ums->trans_begin();
		$this->ums->query($sql, array($this->StID));
		if ($this->ums->trans_status() === FALSE)
			{
				$this->ums->trans_rollback();
			}
			else
			{
				$this->ums->trans_commit();
			}
	}
	function delete_in_permission()
	{
		$sql = "DELETE FROM umpermission WHERE pmMnID in (SELECT MnID FROM ummenu WHERE MnStID = ?)";
		$this->ums->trans_begin();
		$this->ums->query($sql, array($this->StID));
		if ($this->ums->trans_status() === FALSE)
			{
				$this->ums->trans_rollback();
			}
			else
			{
				$this->ums->trans_commit();
			}
	}
	function delete_in_groupdefault()
	{
		$sql = "DELETE FROM umgroupdefault WHERE GdGpID in (SELECT GpID from umgroup where GpStID = ?)";
		$this->ums->trans_begin();
		$this->ums->query($sql, array($this->StID));
		if ($this->ums->trans_status() === FALSE)
			{
				$this->ums->trans_rollback();
			}
			else
			{
				$this->ums->trans_commit();
			}
	}
	function get_id($NameT)
	{
		$sql = "SELECT * FROM umsystem WHERE StNameT like ?";
		$query = $this->ums->query($sql,array($NameT));
		foreach($query->result_array() as $system)
		{
			return $system['StID'];
			
		}
	}
	function get_sys($Sys)
	{
		$sql = "SELECT * FROM umsystem WHERE StID=?";
		$query = $this->ums->query($sql,array($Sys));
		return $query->row_array();
	}
	function get_by_id($StID)
	{
		$sql = "SELECT * FROM umsystem WHERE StID = ?";
		$query = $this->ums->query($sql,array($StID));
		return $query;
	}
	function get_unique()
	{
			$sql = "SELECT * FROM umsystem WHERE StNameT = ? OR StNameE = ?";
			$query = $this->ums->query($sql,array($this->StNameT,$this->StNameE));
			return $query;
	}
	function get_unique_with_ID()
	{
			$sql = "SELECT * FROM umsystem WHERE StID != ? AND (StNameT = ? OR StNameE = ?)";
			$query = $this->ums->query($sql,array($this->StID, $this->StNameT,$this->StNameE));
			return $query;
	}
	
	function get_sys_count(){
		$sql = "SELECT umsystem.StID,StNameT , count(distinct UsID) as num  , StIcon , ColorHeadTop, UsID
					FROM umuser
					left join umusergroup on umuser.UsID = umusergroup.UgUsID 
					left join umgroup on umusergroup.UgGpID = umgroup.GpID
					left join umsystem on umgroup.GpStID = umsystem.StID
					left join umtemplate on umsystem.StID = umtemplate.StID
					left join umicon on umtemplate.HeadIcon = umicon.IcName
					group by StNameT
					order by num DESC
				";
		$query = $this->ums->query($sql);
		return $query;
	}
	
	function get_group_system(){
		$sql = "SELECT umsystem.StID,StNameT , GpNameT, count(GpNameT) as num , GpID
					FROM umuser
					left join umusergroup on umuser.UsID = umusergroup.UgUsID 
					left join umgroup on umusergroup.UgGpID = umgroup.GpID
					left join umsystem on umgroup.GpStID = umsystem.StID
					left join umtemplate on umsystem.StID = umtemplate.StID
					left join umicon on umtemplate.HeadIcon = umicon.IcName
					where umsystem.StID = ? 
					group by GpNameT";
		$query = $this->ums->query($sql,array($this->StID));
		return $query;
	}
	
	function get_by_key_sysGname(){
		$sql = "SELECT umsystem.StID,StNameT , GpNameT, GpID
					FROM umuser
					left join umusergroup on umuser.UsID = umusergroup.UgUsID 
					left join umgroup on umusergroup.UgGpID = umgroup.GpID
					left join umsystem on umgroup.GpStID = umsystem.StID
					left join umtemplate on umsystem.StID = umtemplate.StID
					left join umicon on umtemplate.HeadIcon = umicon.IcName
					where umsystem.StID = ? AND GpID = ? 
					group by GpNameT";
		$query = $this->ums->query($sql,array($this->StID,$this->UgGpID));
		return $query;
	}
	
	function get_user_group(){
		$sql = "SELECT GpID,StNameT , GpNameT , UsName
					FROM umuser
					left join umusergroup on umuser.UsID = umusergroup.UgUsID 
					left join umgroup on umusergroup.UgGpID = umgroup.GpID
					left join umsystem on umgroup.GpStID = umsystem.StID
					where GpID = ?";
		$query = $this->ums->query($sql,array($this->GpID));
		return $query;
	}
	
} // end class M_umsystem
?>
