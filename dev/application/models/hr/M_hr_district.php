<?php
/*
 * m_hr_district
 * Model for Manage about hr_district Table.
 * Copyright (c) 2559. Information System Engineering Research Laboratory.
 * @Author Chain_Chaiwat
 * @Create Date 2559-07-01
*/
include_once("Da_hr_district.php");

class M_hr_district extends Da_hr_district {

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
				FROM ".$this->hr_db.".hr_district 
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
	 * get amphur by province_id and amphur_id
	 * 
	 */
	function get_by_amph_pv(){
		$sql = "SELECT *  
				FROM ".$this->hr_db.".hr_district
				WHERE dist_amph_id = ? AND dist_active ='Y'";
		$query = $this->hr->query($sql, array($this->dist_amph_id));
		
		return $query ;
	}
	
	/*
	 * get amphur by dist_active
	 * 
	 */
	
	function get_by_active($active='Y'){
		
		$sql = "SELECT * 
				FROM ".$this->hr_db.".hr_district 
				WHERE dist_active = ".$active;
		$query = $this->hr->query($sql);
		return $query;
	}

	/*
	* update active
	* update dist_active is "N"(not active) in database after form delete 
	* @input dist_id
	* @output -
	* @author Sarun
	* @Create Date 2559-06-22
	*/
	function update_active($active){
		$sql = "UPDATE ".$this->hr_db.".`hr_district` 
				SET `dist_active` = '".$active."' 
				WHERE `hr_district`.`dist_id` = ?;";
		$query = $this->hr->query($sql,array($this->dist_id));
	}

	/*
	* get_all_by_active
	* select dist data by active is "Y"(active)
	* @input dist_active
	* @output dist data
	* @author Sarun
	* @Create Date 2559-06-22
	*/
	function get_all_by_active($active="Y"){
		$sql = "SELECT * 
				FROM ".$this->hr_db.".hr_district 
				WHERE dist_active = '$active'";
		$query = $this->hr->query($sql);
		return $query;
	}
	
	/*
	* search
	* search by dist_name, dist_pv_id and dist_amph_id. if dist_active=Y.
	* @input dist_name, dist_pv_id and dist_amph_id
	* @output dist_name and dist_name_en
	* @author Sarun
	* @Create Date 2559-07-06
	*/
	function search(){
		if($this->dist_pv_id==""){ $pv ='%';}//search by province_id
		else{ $pv = $this->dist_pv_id ;}
		if($this->dist_amph_id==""){ $amph ='%';}//search by amphur_id
		else{ $amph = $this->dist_amph_id ;}
		$sql = "SELECT *
				FROM ".$this->hr_db.".hr_district 
				WHERE dist_name LIKE '%".$this->dist_name."%'
				AND dist_pv_id LIKE '".$pv."'
				AND dist_amph_id LIKE '".$amph."' 
				AND dist_active='Y'";
		$query = $this->hr->query($sql);
		//echo $this->hr->last_query();
		return $query;
	}
	/*
	* search
	* search by dist_name, dist_pv_id and dist_amph_id. if dist_active=Y.
	* @input dist_name, dist_pv_id and dist_amph_id
	* @output dist_name and dist_name_en
	* @author Sarun
	* @Create Date 2559-07-06
	*/
	function get_address($keyword){
		$dist = explode(" ",$keyword);
		$str = isset($dist[1]) ? " and (amph_name like '%".$dist[1]."%' OR pv_name like '%".$dist[1]."%') " : "";
		$sql = "SELECT *
				FROM hr_district
				LEFT JOIN hr_amphur 
					ON dist_amph_id = amph_id
				LEFT JOIN hr_province
					ON dist_pv_id = pv_id
				WHERE dist_name LIKE ? $str
				LIMIT 6";
			return $this->hr->query($sql,'%'.$dist[0].'%');
	}

} // end class M_hr_district
?>