<?php

/*
*Information_User
*Model Da_user
*@author Yaowapa Pongpadcha
*@Creat Date 2562-05-18
*/
include_once(dirname(__FILE__)."/../Da_swm_user.php");

class M_swm_user extends Da_swm_user {

	/*
	 * aOrderBy = array('fieldname' => 'ASC|DESC', ... )
	 */

	 /*
	 *get all user data from database 
	 *input option order by
	 *output information of user
	 *@author Yaowapa Pongpadcha
	 *@Creat Date 2562-05-18
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
	
	/*
	 * create array of pk field and value for generate select list in view, must edit PK_FIELD and FIELD_NAME manually
	 * the first line of select list is '-----เลือก-----' by default.
	 * if you do not need the first list of select list is '-----เลือก-----', please pass $optional parameter to other values. 
	 * you can delete this function if it not necessary.
	 */

	  /*
	 *Select option prefix_name
	 *input status option (y/n)
	 *output option on dropdown
	 *@author Tiwakorn Hedmuin
	 *@Creat Date 2562-05-18
	 */
	function get_options_prefix($optional='y') {
		$qry = $this->get_prefix();
		if ($optional=='y') $opt[''] = '-----เลือก-----';
		foreach ($qry->result() as $row) {
			$opt[$row->pf_id] = $row->pf_name;
		}
		return $opt;
	}
	
	// add your functions here
	
	/*
	 *get_data_hr
	 *input -
	 *output data from database
	 *@author Isarapong Jenkan
	 *@Creat Date 2562-05-20
	 */
	function get_data_hr($id_user){
		$sql = "SELECT
				ps_id,
				su_id,
				hr_pf.pf_name,
				ps_fname,
				ps_lname,
				CONCAT(hr_pf.pf_name,ps_fname,' ',ps_lname) AS full_name,
				su_code,
				su_work,
				su_workplace,
				psd_birthdate,
				psd_cellphone,
				psd_addcur_no,
				pv_name,
				amph_name,
				dist_name,
				psd_addcur_zipcode,
				su_contact_pf_id,
				su_contact_fname,
				su_contact_lname,
				ph_user.pf_name as con_pf_name,
				CONCAT(ph_user.pf_name,su_contact_fname,' ',su_contact_lname) AS contact_full_name,
				su_create_date,
				su_expire_date,
				su_tel_contact,
				ss_name
			FROM ".$this->swm_db.".swm_user
				LEFT JOIN ".$this->hr_db.".hr_person
					ON ps_id = su_ps_id
				LEFT JOIN ".$this->hr_db.".hr_prefix AS ph_user
					ON su_contact_pf_id = ph_user.pf_id
				LEFT JOIN ".$this->hr_db.".hr_prefix AS hr_pf
					ON ps_pf_id = hr_pf.pf_id
				LEFT JOIN ".$this->hr_db.".hr_person_detail 
					ON ps_id = psd_ps_id
				LEFT JOIN ".$this->hr_db.".hr_province
					ON psd_addcur_pv_id = pv_id
				LEFT JOIN ".$this->hr_db.".hr_amphur
					ON psd_addcur_amph_id = amph_id
				LEFT JOIN ".$this->hr_db.".hr_district
					ON psd_addcur_dist_id = dist_id
				LEFT JOIN ".$this->swm_db.".swm_status
					ON ss_id = su_state
				WHERE ps_id = ".$id_user;
			$query = $this->swm->query($sql); 
	 	return $query;
	}

	/*
		*get_data_ps
		*input -
		*output data from database
		*@author Isarapong Jenkan
		*@Creat Date 2562-05-20
	 */
	function get_data_ps($id_user){
		$sql = "SELECT
				ps_id,
				su_id,
				hr_pf.pf_name,
				ps_fname,
				ps_lname,
				CONCAT(hr_pf.pf_name,ps_fname,' ',ps_lname) AS full_name,
				su_code,
				su_work,
				su_workplace,
				psd_birthdate,
				psd_cellphone,
				psd_addcur_no,
				pv_name,
				amph_name,
				dist_name,
				psd_addcur_zipcode,
				su_contact_pf_id,
				su_contact_fname,
				su_contact_lname,
				CONCAT(ph_user.pf_name,su_contact_fname,' ',su_contact_lname) AS contact_full_name,
				su_create_date,
				su_expire_date,
				su_tel_contact,
				ss_name
			FROM ".$this->hr_db.".hr_person
				LEFT JOIN ".$this->swm_db.".swm_user
					ON ps_id = su_ps_id
				LEFT JOIN ".$this->hr_db.".hr_prefix AS ph_user
					ON su_contact_pf_id = ph_user.pf_id
				LEFT JOIN ".$this->hr_db.".hr_prefix AS hr_pf
					ON ps_pf_id = hr_pf.pf_id
				LEFT JOIN ".$this->hr_db.".hr_person_detail 
					ON ps_id = psd_ps_id
				LEFT JOIN ".$this->hr_db.".hr_province
					ON psd_addcur_pv_id = pv_id
				LEFT JOIN ".$this->hr_db.".hr_amphur
					ON psd_addcur_amph_id = amph_id
				LEFT JOIN ".$this->hr_db.".hr_district
					ON psd_addcur_dist_id = dist_id
				LEFT JOIN ".$this->swm_db.".swm_status
					ON ss_id = su_state
				WHERE ps_id = ".$id_user;
			$query = $this->swm->query($sql); 
	 	return $query;
	}


	/*
	 *get user data logining 
	 *output information of user
	 *@author Khwanchai Nontawichit
	 *@Creat Date 2562-05-19
	 */
	 public function get_by_ps_id(){
		$sql="
				SELECT *
				FROM swm_user
				WHERE su_ps_id=?		  
			 ";
		$query = $this->swm->query($sql,array($this->su_ps_id)); 
	 return $query;
	 }

	 public function get_last_user_id(){
		$sql="
				SELECT su_code
				FROM swm_user
				ORDER BY su_code DESC LIMIT 1	  
			 ";
		$query = $this->swm->query($sql,array($this->su_code)); 
	 return $query;
	 }
	 
	 function get_prefix(){
		$sql="SELECT * 
				FROM ".$this->hr_db.".hr_prefix 
				WHERE pf_active = 'Y'";
		$query = $this->swm->query($sql); 
		return $query;
	 }
	 
	  
	  
/*
*
*function get_ps_id_by_su_state
*get_ps_id_by_su_state
*input -
*output -
*author Tiwakorn Hedmuin
*@Create Date 2562-05-20
*
*/	  
	  
	  function get_ps_id_by_su_state(){
		$sql="	SELECT su_ps_id, su_state
				FROM swm_user
				WHERE su_state IN (1,2)";
		$query = $this->swm->query($sql); 
		return $query;
	 }
} // end class M_swm_user

/*function get_report_register
* get report register
* input -
* output report register
* @author Pattarakorn Pamornchart
* @create date 2562-05-21
*/
	function get_report_register(){
		$sql=" SELECT su_create_date,su_expire_date,su_code
		FROM swm_user
		ORDER BY su_code";
		$query = $this->swm->query($sql);
		return $query;
	}
?>
