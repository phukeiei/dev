<?php
/*
 * da_hr_person_detail
 * Model for Manage about hr_person_detail Table.
 * Copyright (c) 2559. Information System Engineering Research Laboratory.
 * @Author Chain_Chaiwat
 * @Create Date 2559-06-27
 */
include_once("hr_model.php");

class Da_hr_person_detail extends Hr_model {
	
	// PK is psd_ps_id
	
	public $psd_ps_id;
	public $psd_dp_id;
	public $psd_tax_no;
	public $psd_id_card_no;
	public $psd_passport_no;
	public $psd_picture;
	public $psd_blood_id;
	public $psd_reli_id;
	public $psd_nation_id;
	public $psd_race_id;
	public $psd_psst_id;
	public $psd_birthdate;
	public $psd_birth_pv_id;
	public $psd_gd_id;
	public $psd_account_no;
	public $psd_ba_id;
	public $psd_facebook;
	public $psd_twitter;
	public $psd_website;
	public $psd_email;
	public $psd_cellphone;
	public $psd_phone;
	public $psd_ex_phone;
	public $psd_work_phone;
	public $psd_lodge_id;
	public $psd_lodge_no;
	public $psd_lodge_phone;
	public $psd_addcur_no;
	public $psd_addcur_pv_id;
	public $psd_addcur_amph_id;
	public $psd_addcur_dist_id;
	public $psd_addcur_zipcode;
	public $psd_addhome_no;
	public $psd_addhome_pv_id;
	public $psd_addhome_amph_id;
	public $psd_addhome_dist_id;
	public $psd_addhome_zipcode;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO ".$this->hr_db.".hr_person_detail (psd_ps_id, psd_dp_id, psd_tax_no, psd_id_card_no, psd_passport_no, psd_picture, psd_blood_id, psd_reli_id, psd_nation_id, psd_race_id, psd_psst_id, psd_birthdate, psd_birth_pv_id, psd_gd_id, psd_account_no, psd_ba_id, psd_facebook, psd_twitter, psd_website, psd_email, psd_cellphone, psd_phone, psd_ex_phone, psd_work_phone, psd_lodge_id, psd_lodge_no, psd_lodge_phone, psd_addcur_no, psd_addcur_pv_id, psd_addcur_amph_id, psd_addcur_dist_id, psd_addcur_zipcode, psd_addhome_no, psd_addhome_pv_id, psd_addhome_amph_id, psd_addhome_dist_id, psd_addhome_zipcode)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$this->hr->query($sql, array($this->psd_ps_id, $this->psd_dp_id, $this->psd_tax_no, $this->psd_id_card_no, $this->psd_passport_no, $this->psd_picture, $this->psd_blood_id, $this->psd_reli_id, $this->psd_nation_id, $this->psd_race_id, $this->psd_psst_id, $this->psd_birthdate, $this->psd_birth_pv_id, $this->psd_gd_id, $this->psd_account_no, $this->psd_ba_id, $this->psd_facebook, $this->psd_twitter, $this->psd_website, $this->psd_email, $this->psd_cellphone, $this->psd_phone, $this->psd_ex_phone, $this->psd_work_phone, $this->psd_lodge_id, $this->psd_lodge_no, $this->psd_lodge_phone, $this->psd_addcur_no, $this->psd_addcur_pv_id, $this->psd_addcur_amph_id, $this->psd_addcur_dist_id, $this->psd_addcur_zipcode, $this->psd_addhome_no, $this->psd_addhome_pv_id, $this->psd_addhome_amph_id, $this->psd_addhome_dist_id, $this->psd_addhome_zipcode));
		$this->last_insert_id = $this->hr->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE ".$this->hr_db.".hr_person_detail 
				SET	psd_dp_id=?, psd_tax_no=?, psd_id_card_no=?, psd_passport_no=?, psd_picture=?, psd_blood_id=?, psd_reli_id=?, psd_nation_id=?, psd_race_id=?, psd_psst_id=?, psd_birthdate=?, psd_birth_pv_id=?, psd_gd_id=?, psd_account_no=?, psd_ba_id=?, psd_facebook=?, psd_twitter=?, psd_website=?, psd_email=?, psd_cellphone=?, psd_phone=?, psd_ex_phone=?, psd_work_phone=?, psd_lodge_id=?, psd_lodge_no=?, psd_lodge_phone=?, psd_addcur_no=?, psd_addcur_pv_id=?, psd_addcur_amph_id=?, psd_addcur_dist_id=?, psd_addcur_zipcode=?, psd_addhome_no=?, psd_addhome_pv_id=?, psd_addhome_amph_id=?, psd_addhome_dist_id=?, psd_addhome_zipcode=? 
				WHERE psd_ps_id=?";	
		$this->hr->query($sql, array($this->psd_dp_id, $this->psd_tax_no, $this->psd_id_card_no, $this->psd_passport_no, $this->psd_picture, $this->psd_blood_id, $this->psd_reli_id, $this->psd_nation_id, $this->psd_race_id, $this->psd_psst_id, $this->psd_birthdate, $this->psd_birth_pv_id, $this->psd_gd_id, $this->psd_account_no, $this->psd_ba_id, $this->psd_facebook, $this->psd_twitter, $this->psd_website, $this->psd_email, $this->psd_cellphone, $this->psd_phone, $this->psd_ex_phone, $this->psd_work_phone, $this->psd_lodge_id, $this->psd_lodge_no, $this->psd_lodge_phone, $this->psd_addcur_no, $this->psd_addcur_pv_id, $this->psd_addcur_amph_id, $this->psd_addcur_dist_id, $this->psd_addcur_zipcode, $this->psd_addhome_no, $this->psd_addhome_pv_id, $this->psd_addhome_amph_id, $this->psd_addhome_dist_id, $this->psd_addhome_zipcode, $this->psd_ps_id));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM ".$this->hr_db.".hr_person_detail
				WHERE psd_ps_id=?";
		$this->hr->query($sql, array($this->psd_ps_id));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM ".$this->hr_db.".hr_person_detail 
				WHERE psd_ps_id=?";
		$query = $this->hr->query($sql, array($this->psd_ps_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_hr_person_detail
?>