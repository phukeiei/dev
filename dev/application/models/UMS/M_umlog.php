<?php

include_once("Da_umlog.php");

class M_umlog extends Da_umlog{

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
				FROM umlog 
				$orderBy";
		$query = $this->ums->query($sql);
		return $query;
	}
	
	/*
	 * create array of pk field and value for generate select list in view, must edit PK_FIELD and FIELD_NAME manually
	 * the first line of select list is '-----àÅ×Í¡-----' by default.
	 * if you do not need the first list of select list is '-----àÅ×Í¡-----', please pass $optional parameter to other values. 
	 * you can delete this function if it not necessary.
	 */
	function get_options($optional='y') {
		$qry = $this->get_all();
		if ($optional=='y') $opt[''] = '-----àÅ×Í¡-----';
		foreach ($qry->result() as $row) {
			$opt[$row->PK_FIELD] = $row->FIELD_NAME;
		}
		return $opt;
	}

	function get_time_between($TimeFrom,$TimeTo)
	{
		$sql = "SELECT * FROM `umlog` 
		WHERE LogUsID=? and date(LogTime) 
		between ? AND ?";// yy/mm/dd
		$query = $this->ums->query($sql,array($this->session->userdata('UsID'),$TimeFrom,$TimeTo));
		return $query;
	}
	
	function get_time_between_specific_user($TimeFrom,$TimeTo,$UsLogin,$UsName)
	{
		if($UsName)	
			$option = "and UsName like '%".$UsName."%' ";
		else
			$option = "";
		if($UsLogin)
			$option .="and UsLogin like '%".$UsLogin."%' ";
		else
			$option .= "";
		$sql = "SELECT * FROM umlog INNER JOIN umuser
		ON umuser.UsID=umlog.LogUsID
		WHERE date(LogTime) 
		between ? AND ? ".$option;// yy/mm/dd
		$query = $this->ums->query($sql,array($TimeFrom,$TimeTo));
		// echo $this->ums->last_query();
		return $query;
	}
	
	function get_count(){
		$sql = "SELECT count(*) as many 
				FROM umuser 
				";
		$query = $this->ums->query($sql);
		return $query;
	}
	
	function get_log_action_report($StNameT)
	{
		$option = "LogAction like '%".$StNameT."' ";
		$sql = "SELECT LogUsID , LogTime , LogAction  FROM umlog
					where ".$option;
		$query = $this->ums->query($sql);
		return $query;
	}
	
	function get_log_action_report_android()
	{
		$sql = "SELECT LogUsID , LogTime , LogAction  FROM umlog
					where LogAction like 'เข้าใช้สิทธิ์%'";
		$query = $this->ums->query($sql);
		return $query->result_array();
	}
	
	function get_log_action_report_edit_android()
	{
		$sql = "SELECT LogUsID , LogTime , LogAction  FROM umlog
					where LogAction like '%ข้อมูลลงในตาราง%'";
		$query = $this->ums->query($sql);
		return $query->result_array();
	}
	
	// add your functions here
} // end class M_umlog
?>
