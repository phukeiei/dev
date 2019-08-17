<?php
/*
 * m_hr_person_detail
 * Model for Manage about hr_person_detail Table.
 * Copyright (c) 2559. Information System Engineering Research Laboratory.
 * @Author Chain_Chaiwat
 * @Create Date 2559-06-27
 */
include_once("Da_hr_person_detail.php");

class M_hr_person_detail extends Da_hr_person_detail {

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
				FROM ".$this->hr_db.".hr_person_detail
				$orderBy";
		$query = $this->hr->query($sql);
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


	/*
	* get_by_id
	* get data by id form table hr_person_detail
	* @input psd_ps_id
	* @output 	`psd_gd_id`,`psd_birthdate, psd_birth_pv_id,`psd_blood_id`,`psd_reli_id`,`psd_race_id`
				,`psd_nation_id`,`psd_psst_id`,`psd_id_card_no`,`psd_passport_no
				,`psd_tax_no`,`psd_account_no`,`psd_ba_id`,`psd_picture`
	* @author Siwanon
	* @Create Date 2559-07-08
	*/
	function get_by_id(){
		$sql = "SELECT psd_ps_id,psd_gd_id,psd_birthdate,psd_birth_pv_id,psd_blood_id,psd_reli_id,psd_race_id
			,psd_nation_id,psd_psst_id,psd_id_card_no,psd_passport_no
            ,psd_tax_no,psd_account_no,psd_ba_id,psd_picture
			FROM ".$this->hr_db.".hr_person_detail
			WHERE psd_ps_id=?;";
		$query = $this->hr->query($sql, array($this->psd_ps_id));
		return $query;
	}

	/*
	* insert_id
	* insert id to hr_person_detail
	* @input ps_id
	* @output 	`psd_gd_id`,`psd_birthdate,`psd_blood_id`,`psd_reli_id`,`psd_race_id`
				,`psd_nation_id`,`psd_psst_id`,`psd_id_card_no`,`psd_passport_no
				,`psd_tax_no`,`psd_account_no`,`psd_ba_id`,`psd_picture`
	* @author Siwanon
	* @Create Date 2559-07-08
	*/
	function update_profile(){
			// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE ".$this->hr_db.".hr_person_detail 
				SET	psd_tax_no=?, psd_id_card_no=?, psd_passport_no=?, psd_picture=?, psd_blood_id=?, psd_reli_id=?, psd_nation_id=?, psd_race_id=?, psd_psst_id=?, psd_birthdate=?, psd_birth_pv_id=?, psd_gd_id=?, psd_account_no=?, psd_ba_id=?, psd_facebook=?, psd_twitter=?, psd_website=?, psd_email=?, psd_moral=?, psd_interest=?
				WHERE psd_ps_id=?";	
		$this->hr->query($sql, array( $this->psd_tax_no, $this->psd_id_card_no, $this->psd_passport_no, $this->psd_picture, $this->psd_blood_id, $this->psd_reli_id, $this->psd_nation_id, $this->psd_race_id, $this->psd_psst_id, $this->psd_birthdate, $this->psd_birth_pv_id, $this->psd_gd_id, $this->psd_account_no, $this->psd_ba_id, $this->psd_facebook, $this->psd_twitter, $this->psd_website, $this->psd_email, $this->psd_moral, $this->psd_interest, $this->psd_ps_id));	

	}
	
	/*
	* insert_address to hr_person_detail
	* @input ps_id
	* @output 	psd_addhome_no, psd_addhome_pv_id, psd_addhome_amph_id, psd_addhome_dist_id, psd_addhome_zipcode,
				psd_addcur_no, psd_addcur_pv_id, psd_addcur_amph_id, psd_addcur_dist_id, psd_addcur_zipcode,
				psd_phone, psd_cellphone, psd_work_phone, psd_ex_phone.
	* @author Sarun
	* @Create Date 2559-07-28
	*/
	function update_address(){
		$sql = "UPDATE ".$this->hr_db.".hr_person_detail 
				SET	psd_addhome_no=?, psd_addhome_pv_id=?, psd_addhome_amph_id=?, psd_addhome_dist_id=?, psd_addhome_zipcode=?,
				psd_addcur_no=?, psd_addcur_pv_id=?, psd_addcur_amph_id=?, psd_addcur_dist_id=?, psd_addcur_zipcode=?,
				psd_phone=?, psd_cellphone=?, psd_work_phone=?, psd_ex_phone=?
				WHERE psd_ps_id=?";	
		$this->hr->query($sql, array( $this->psd_addhome_no, $this->psd_addhome_pv_id, $this->psd_addhome_amph_id, $this->psd_addhome_dist_id, $this->psd_addhome_zipcode, 
		$this->psd_addcur_no, $this->psd_addcur_pv_id, $this->psd_addcur_amph_id, $this->psd_addcur_dist_id, $this->psd_addcur_zipcode,
		$this->psd_phone, $this->psd_cellphone, $this->psd_work_phone, $this->psd_ex_phone, $this->psd_ps_id));	

	}
	
	
	/*
	* get_picture
	* get picture name by psd_ps_id
	* @input psd_ps_id
	* @output `psd_picture`
	* @author Siwanon
	* @Create Date 2559-07-08
	*/
	function get_picture(){
		$sql = "SELECT psd_picture 
				FROM ".$this->hr_db.".`hr_person_detail`
				WHERE psd_ps_id = ?;";
		$query = $this->hr->query($sql,array($this->psd_ps_id));
		return $query;
	}
	
	function insert_id(){
			$sql = "INSERT INTO ".$this->hr_db.".hr_person_detail (psd_ps_id)
							VALUES(?)";
			$this->hr->query($sql, array($this->psd_ps_id));
			$this->last_insert_id = $this->hr->insert_id();
	}
	
	function update_resume() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE ".$this->hr_db.".hr_person_detail
				SET	 psd_first_admid_date=?
				WHERE psd_ps_id=?";
		$this->hr->query($sql, array( $this->psd_first_admid_date, $this->psd_ps_id));
		//echo $this->hr->last_query();die;
	}
	
	
	/*
	* get_person_detail_by_ps_id
	* Get person detail by ps_id form database 
	* @input    -
	* @output 	*	
	* @author Ilada Paisarn
	* @Create Date 2559-09-19
	*/
	function get_person_detail_by_ps_id($personId){
		$sql = "SELECT psd_birthdate
				FROM ".$this->hr_db.".hr_person_detail
				WHERE psd_ps_id = $personId";
		$query = $this->hr->query($sql, array($this->psd_ps_id));	
		return $query ;	
	}
	
	/*
	* update_birthdate_ps
	* update birthdate person detail by ps_id form database 
	* @input    psd_ps_id
				psd_birthdate
	* @output 	-	
	* @author Ilada Paisarn
	* @Create Date 2559-09-22
	*/
	function update_birthdate_ps($personId,$brithdate){
		$sql = "UPDATE ".$this->hr_db.".hr_person_detail
				SET psd_birthdate = '$brithdate'
				WHERE psd_ps_id = $personId";
		$query = $this->hr->query($sql, array($this->psd_ps_id,$this->psd_birthdate));	
		return $query ;	
	}
	
	function insert_ps_id() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "INSERT INTO ".$this->hr_db.".`hr_person_detail` (`psd_ps_id`, `psd_dp_id`, `psd_tax_no`, `psd_id_card_no`, `psd_passport_no`, `psd_picture`
		, `psd_blood_id`, `psd_reli_id`, `psd_nation_id`, `psd_race_id`, `psd_psst_id`, `psd_birthdate`, `psd_birth_pv_id`, `psd_gd_id`, `psd_account_no`
		, `psd_ba_id`, `psd_moral`, `psd_interest`, `psd_facebook`, `psd_twitter`, `psd_website`, `psd_email`, `psd_cellphone`, `psd_phone`, `psd_ex_phone`
		, `psd_work_phone`, `psd_lodge_id`, `psd_lodge_no`, `psd_lodge_phone`, `psd_lodge_electric_id`, `psd_lodge_water_id`, `psd_lodge_telephone_id`
		, `psd_addcur_no`, `psd_addcur_pv_id`, `psd_addcur_amph_id`, `psd_addcur_dist_id`, `psd_addcur_zipcode`, `psd_addhome_no`, `psd_addhome_pv_id`
		, `psd_addhome_amph_id`, `psd_addhome_dist_id`, `psd_addhome_zipcode`, `psd_first_admid_date`) 
		VALUES (?, '1', ' ', ' ', ' ', ' ', '1', '1', '1', '1', '1', '0000-00-00', '1', '1', ' ', '1', NULL, NULL, '', ''
		, '', '', '', '', '', '', '1', '', '', NULL, NULL, NULL, '', '1', '1', '1', '', '', '1', '1', '1', '', ?);";
		$this->hr->query($sql, array(  $this->psd_ps_id,$this->psd_first_admid_date));
		//echo $this->hr->last_query();die;
	}

		/*
	* get_picture
	* @input hr_person_detail
	* @output `psd_picture`
	* @author Supagit
	* @Create Date 2560-06-18
	*/
	function get_data_show_resume(){
		$sql = "SELECT *
				FROM $this->hr_db.hr_person_detail
					LEFT JOIN $this->hr_db.hr_gender ON psd_gd_id = gd_id
					LEFT JOIN $this->hr_db.hr_person ON psd_ps_id = ps_id

				WHERE psd_ps_id = ?;
				";
		$qry = $this->hr->query($sql,array($this->psd_ps_id));
		return $qry;
	}

	function get_data_show_resume2(){
		$sql = "SELECT *
				FROM $this->hr_db.hr_person
				WHERE ps_id = 1144;
				";
		$qry = $this->hr->query($sql);
		return $qry;
	}
		function get_data_show_resume3(){
		$sql = "SELECT *
				FROM $this->hr_db.hr_position
					LEFT JOIN $this->hr_db.hr_adline_position ON pos_id = ps_pos_id
				WHERE psd_ps_id = ?;
				";
		$qry = $this->hr->query($sql,array($this->psd_ps_id));
		return $qry;
	}


		/*
	* get_gender
	* @author Samatcha
	*/


} // end class M_hr_person_detail
?>
