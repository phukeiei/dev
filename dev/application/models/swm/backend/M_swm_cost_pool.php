<?php

include_once(dirname(__FILE__)."/../Da_swm_cost_pool.php");

class M_swm_cost_pool extends Da_swm_cost_pool {

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
				FROM swm_cost_pool 
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
	 * 
	 * 
	 * 
	 * 
	 */
	function get_cost_pool_detail() {
		$sql = "SELECT scp_id,scp_age_min,scp_age_max,scp_cost,scp_sug_id,scp_reference,scp_is_active
				FROM $this->swm_db.swm_cost_pool 
				WHERE scp_sug_id = 2  
				";
		$query = $this->swm->query($sql);
		return $query;
	}

	/*
	 * 
	 * 
	 * 
	 * 
	 */
	function get_cost_pool_detail_nonmember() {
		$sql = "SELECT scp_id,scp_age_min,scp_age_max,scp_cost,scp_sug_id,scp_reference,scp_is_active
				FROM $this->swm_db.swm_cost_pool 
				WHERE scp_sug_id = 1  
				";
		$query = $this->swm->query($sql);
		return $query;
	}

	/*
	 * 
	 * 
	 * 
	 * 
	 */
	function update_cost_pool() {
		
		$sql = "UPDATE ".$this->swm_db.".swm_cost_pool 
				SET	scp_is_active = 'Y'
				WHERE scp_reference =?";	
		$this->swm->query($sql, array( $this->scp_reference ));	
	}

	/*
	 * 
	 * 
	 * 
	 * 
	 */
	function update_cost_pool_active() {
		
		$sql = "UPDATE ".$this->swm_db.".swm_cost_pool 
				SET	scp_is_active = 'N'
				WHERE scp_sug_id =?";	
		$this->swm->query($sql, array( $this->scp_sug_id ));	
	}

	function search_scp_reference(){
		$sql = "SELECT scp_reference
				FROM $this->swm_db.swm_cost_pool
				WHERE scp_sug_id = ? 
				GROUP BY scp_reference";
		$query = $this->swm->query($sql, array( $this->scp_sug_id ));
		return $query;
	}

	function search(){
		$sql = "SELECT scp_id, scp_cost
				FROM $this->swm_db.swm_cost_pool
				WHERE ? BETWEEN scp_age_min AND scp_age_max
				AND scp_sug_id = ?
				AND scp_is_active = 'Y'";
		$query = $this->swm->query($sql, array($this->ages, $this->user_group));
		return $query;
	}



} // end class M_swm_cost_pool
?>
