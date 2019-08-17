<?php

include_once(dirname(__FILE__)."/../Da_swm_user.php");

class M_swm_user extends Da_swm_user {

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
				FROM swm_user 
				$orderBy";
		$query = $this->swm->query($sql);
		return $query;
	}

	//get all member not regis
	public function get_all_user_not_regis()
	{
		$sql = "SELECT * FROM $this->hr_db.`hr_person` WHERE ps_id not in (SELECT su_ps_id FROM $this->swm_db.`swm_user`)";
		$query = $this->swm->query($sql);

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

	//
	public function get_all_member()
	{
		$sql = "SELECT su_code,ps_fname,ps_lname,ss_name,su_create_date,YEAR(CURDATE())-YEAR(psd_birthdate)  as age
		from $this->swm_db.swm_user AS  s1
		LEFT join $this->swm_db.swm_status AS s2
		on s1.su_state = s2.ss_id
		LEFT JOIN $this->hr_db.hr_person AS s3
		on s1.su_ps_id = s3.ps_id
		LEFT JOIN $this->hr_db.hr_person_detail AS s4
		on s3.ps_id = s4.psd_ps_id";
		$query = $this->swm->query($sql);

		return $query;
	}

	//get all member not regis
	/*public function get_user_by_ps_id()
	{

		$sql = "SELECT * FROM $this->hr_db.`hr_person` WHERE ps_id not in (SELECT su_ps_id FROM $this->swm_db.`swm_user`)
		AND ps_id = ?";
		$query = $this->swm->query($sql, array($this->su_ps_id));

		return $query;
	}
*/
    //get all member not regis
/*
	public function get_user_by_ps_id_full()
	{

		$sql = "SELECT * 
		FROM $this->hr_db.`hr_person` AS h1 
		LEFT JOIN $this->hr_db.`hr_person_detail` AS h2
		ON h1.
		WHERE ps_id not in (SELECT su_ps_id FROM $this->swm_db.`swm_user`)
		AND ps_id = ?";
		$query = $this->swm->query($sql, array($this->su_ps_id));

		return $query;
	}
	
	// add your functions here

} // end class M_swm_user
*/
?>