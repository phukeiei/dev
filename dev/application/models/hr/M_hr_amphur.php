<?php
/*
 * m_hr_amphur
 * Model for Manage about hr_amphur Table.
 * Copyright (c) 2559. Information System Engineering Research Laboratory.
 * @Author Chain_Chaiwat
 * @Create Date 2559-07-01
*/
include_once("Da_hr_amphur.php");

class M_hr_amphur extends Da_hr_amphur {

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
				FROM ".$this->hr_db.".hr_amphur 
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
			$opt[$row->amph_id] = $row->amph_name;
		}
		return $opt;
	}
	
	
	// add your functions here
	
	
	/*
	* get_by_province
	* get district by amphur_id and province_id that dist_active ='Y' AND dist_status ='1'
	* @input dist_amph_id, dist_pv_id
	* @output dist_id, dist_name, dist_amp_id, dist_pv_id  
	* @author Siwanon
	* @Create Date 2559-06-23
	*/
	function get_by_province(){
		$sql = "SELECT *
				FROM ".$this->hr_db.".hr_amphur
				WHERE amph_pv_id=? AND amph_active ='Y'";
		$query = $this->hr->query($sql, array($this->amph_pv_id));
		//print_r($this->hr->last_query());
		return $query ;
	}
	
	/*
	* get_by_active
	* get district by dist_active = Y
	* @input -
	* @output dist_id, dist_name, dist_amp_id, dist_pv_id  
	* @author Siwanon
	* @Create Date 2559-06-23
	*/
	function get_by_active($active='Y'){
		
		$sql = "SELECT * 
				FROM ".$this->hr_db.".hr_amphur 
				WHERE amph_active = ".$active;
		$query = $this->hr->query($sql);
		return $query;
	}
	
		/*
	* update active
	* update amph_active is "N"(not active) in database after form delete 
	* @input amph_id
	* @output -
	* @author Sarun
	* @Create Date 2559-06-22
	*/
	function update_active($active){
		$sql = "UPDATE ".$this->hr_db.".`hr_amphur` 
				SET `amph_active` = '".$active."' 
				WHERE `hr_amphur`.`amph_id` = ?;";
		$query = $this->hr->query($sql,array($this->amph_id));
	}

	/*
	* get_all_by_active
	* select amphur data by active is "Y"(active)
	* @input amph_active
	* @output amphur data
	* @author Sarun
	* @Create Date 2559-06-22
	*/
	function get_all_by_active($active="Y"){
		$sql = "SELECT * 
				FROM ".$this->hr_db.".hr_amphur 
				WHERE amph_active = '$active'";
		$query = $this->hr->query($sql);
		return $query;
	}
	
	/*
	* search
	* search by amph_name, amph_pv_id. if amph_active=Y.
	* @input amph_name and amph_pv_id
	* @output amph_name and amph_name_en
	* @author Sarun
	* @Create Date 2559-07-07
	*/
	function search(){
		if($this->amph_pv_id==""){ $pv ='%';}//search by province_id
		else{ $pv = $this->amph_pv_id ;}
		$sql = "SELECT *
				FROM ".$this->hr_db.".hr_amphur
				WHERE amph_name LIKE '%".$this->amph_name."%'
				AND amph_pv_id LIKE '".$pv."' 
				AND amph_active='Y'";
		$query = $this->hr->query($sql);
		return $query;
	}

} // end class M_hr_amphur
?>