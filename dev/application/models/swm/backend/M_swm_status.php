<?php

include_once(dirname(__FILE__)."/../Da_swm_status.php");

class M_swm_status extends Da_swm_status {

	/*
	 * aOrderBy = array('fieldname' => 'ASC|DESC', ... )
	 */
	
	public function get_status()
	{
		$sql = "SELECT ss_id,ss_name 
				FROM swm_status
				";
		$query = $this->swm->query($sql);
		return $query->result_array();		
	}
	public function get_all_member()
	{
		$sql = "SELECT u.su_id,u.su_ps_id,hr.ps_fname,hr.ps_lname,u.su_birthday,sta.ss_id,sta.ss_name,pre.pf_id,pre.pf_name
				FROM $this->swm_db.swm_user AS u
				LEFT JOIN $this->hr_db.hr_person AS hr
				ON hr.ps_id = u.su_ps_id
				LEFT JOIN $this->swm_db.swm_status AS sta
				ON u.su_state = sta.ss_id
				LEFT JOIN $this->hr_db.hr_prefix AS pre
				ON pre.pf_id = hr.ps_pf_id
				";
		$query = $this->swm->query($sql);
		return $query->result_array();
	}
	public function get_id($data)
	{
		$sql = "SELECT u.su_id,u.su_ps_id,hr.ps_fname,hr.ps_lname,u.su_birthday,u.su_birthday as regisdate,sta.ss_id,sta.ss_name,pre.pf_id,pre.pf_name,u.su_create_date
				FROM $this->swm_db.swm_user AS u
				LEFT JOIN $this->hr_db.hr_person AS hr
				ON hr.ps_id = u.su_ps_id
				LEFT JOIN $this->swm_db.swm_status AS sta
				ON u.su_state = sta.ss_id
				LEFT JOIN $this->hr_db.hr_prefix AS pre
				ON pre.pf_id = hr.ps_pf_id
				WHERE u.su_id = '".$data['id']."';
				";
		$query = $this->swm->query($sql);
		return $query->result_array();
	}
	public function set_status($data)
	{
		$sql = "UPDATE swm_user
				SET su_state = '".$data['sta']."' 
				WHERE su_id = '".$data['id']."'
				";
		$query = $this->swm->query($sql);
	}
	public function comment($data)
	{
		$sql =" INSERT INTO swm_flow_state (sfs_create_date,sfs_su_id,sfs_ss_id,sfs_comment)
				VALUES (NOW(),'".$data['id']."','".$data['sta']."','".$data['comment']."') 
			 ";
		$query = $this->swm->query($sql);
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
				FROM swm_status 
				$orderBy";
		$query = $this->swm->query($sql);
		return $query;
	}
	
	// add your functions here

} // end class M_swm_status
?>