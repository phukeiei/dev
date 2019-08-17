<?php

include_once(dirname(__FILE__) . "/../Da_swm_user.php");

class M_swm_user extends Da_swm_user
{

	/*
	 * aOrderBy = array('fieldname' => 'ASC|DESC', ... )
	 */
	function get_all($aOrderBy = "")
	{
		$orderBy = "";
		if (is_array($aOrderBy)) {
			$orderBy .= "ORDER BY ";
			foreach ($aOrderBy as $key => $value) {
				$orderBy .= "$key $value, ";
			}
			$orderBy = substr($orderBy, 0, strlen($orderBy) - 2);
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
	function get_options($optional = 'y')
	{
		$qry = $this->get_all();
		if ($optional == 'y') $opt[''] = '-----เลือก-----';
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
	public function get_user_by_ps_id_not_regis()
	{

		$sql = "SELECT * FROM $this->hr_db.`hr_person` WHERE ps_id not in (SELECT su_ps_id FROM $this->swm_db.`swm_user`)
		AND ps_id = ?";
		$query = $this->swm->query($sql, array($this->su_ps_id));

		return $query;
	}

	//get all member not regis
	public function get_user_detail_by_psd_id()
	{

		$sql = "SELECT ps_id,pf_name ,
		ps_fname ,
		ps_lname,
		psd_birthdate,
		psd_cellphone ,
		YEAR(CURDATE())-YEAR(psd_birthdate) as age,
		psd_addcur_no,
		pv_name,
		amph_name,
		dist_name,
		psd_addcur_zipcode
		FROM $this->hr_db.`hr_person` AS h1 
		LEFT JOIN $this->hr_db.`hr_person_detail` AS h2
		ON h1.ps_id = h2.psd_ps_id
		LEFT JOIN $this->hr_db.`hr_prefix` AS h3
		ON h1.ps_pf_id = h3.pf_id
		LEFT JOIN $this->hr_db.`hr_province` AS h4
		ON h2.psd_addcur_pv_id = h4.pv_id
		LEFT JOIN $this->hr_db.`hr_amphur` AS h5
		ON h2.psd_addcur_amph_id = h5.amph_id
		LEFT JOIN $this->hr_db.`hr_district` AS h6
		ON h2.psd_addcur_dist_id = h6.dist_id
		WHERE h1.ps_id not in (SELECT su_ps_id FROM $this->swm_db.`swm_user`)
		AND ps_id = ?";
		$query = $this->swm->query($sql, array($this->su_ps_id));

		return $query;
	}

	//get all member not regis
	public function get_prefix()
	{

		$sql = "SELECT pf_id,pf_name FROM $this->hr_db.`hr_prefix` WHERE pf_active = 'Y'";
		$query = $this->swm->query($sql);

		return $query;
	}

	public function get_all_user_swm()
	{
		$sql = "SELECT su_ps_id, su_code,
		ps_fname,ps_lname,
		su_birthday as age,su_create_date,
		ss_name , ss_id
		FROM $this->swm_db.swm_user as a1
		LEFT JOIN $this->swm_db.swm_status as a2
		ON a1.su_state = a2.ss_id
		LEFT JOIN $this->hr_db.hr_person as a3
		ON a1.su_ps_id = a3.ps_id
		LEFT JOIN $this->hr_db.hr_person_detail as a4
		ON a3.ps_id = a4.psd_ps_id
		";

		$query = $this->swm->query($sql);
		return $query;
	}
 
	public function get_last_user_id($id) 
	{
		$sql = "
		SELECT su_code
		FROM swm_user
		WHERE su_code LIKE ?
		ORDER BY su_code DESC LIMIT 1	  
			 ";
		$query = $this->swm->query($sql, array($id));
		return $query;
	}

	function search(){
		$sql = "SELECT su_id, su_code, YEAR(CURDATE())-YEAR(psd_birthdate) as age
				FROM $this->swm_db.swm_user
				LEFT JOIN $this->hr_db.hr_person_detail ON psd_ps_id = su_ps_id
				WHERE su_code LIKE ?";
		$query = $this->swm->query($sql, array($this->su_code));
		return $query;
	}
	public function get_profile($psid)
	{
		$sql = "SELECT u.su_code as su_code,u.su_id,hr.ps_id as id,pre.pf_name as prefix,hr.ps_fname as fname ,hr.ps_lname as lname ,
		hrp.psd_birthdate as birthday ,u.su_work as job ,u.su_tel as tel ,
		hrp.psd_addcur_no as addr,p.pv_name as province , hrp.psd_addcur_zipcode as zipcode ,
		u.su_contact_fname as cfname , u.su_contact_lname as clname , u.su_create_date as regdate,
		hra.amph_name as amphor , hd.dist_name as dist , u.su_tel_contact as ctel

        FROM $this->hr_db.hr_person as hr
		LEFT JOIN $this->swm_db.swm_user as u
		ON u.su_ps_id = hr.ps_id
		LEFT JOIN  $this->hr_db.hr_person_detail as hrp
		ON hrp.psd_ps_id = hr.ps_id
		LEFT JOIN  $this->hr_db.hr_province as p
		ON p.pv_id = hrp.psd_addcur_pv_id
		LEFT JOIN $this->hr_db.hr_district as hd
		ON hd.dist_id = hrp.psd_addcur_dist_id
		LEFT JOIN  $this->hr_db.hr_amphur as hra
		ON hra.amph_id = hrp.psd_addcur_amph_id
		LEFT JOIN  $this->hr_db.hr_prefix as pre
		ON hr.ps_pf_id = pre.pf_id

		WHERE hr.ps_id = ".$psid." 
		Limit 1
		";
		// echo $sql;

		$query = $this->swm->query($sql);
 			return $query->result_array();

	}


	// add your functions here

} // end class M_swm_user
