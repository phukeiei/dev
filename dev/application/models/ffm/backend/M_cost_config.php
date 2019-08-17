<?php

include_once("Da_cost_config.php");

class M_cost_config extends Da_cost_config {

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
				FROM cost_config 
				$orderBy";
		$query = $this->ffm->query($sql);
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

	function get_data_by_ff_id(){
		$sql = "SELECT * 
				FROM cost_config
				WHERE cc_ff_id = $this->cc_ff_id AND cc_status != 'N'
				ORDER BY cc_start_time ASC
				";
		$query = $this->ffm->query($sql);
		return $query;
	}

	function update_status_false($id){
		$sql = "UPDATE cost_config a
		SET a.cc_status = 'N'
		WHERE cc_ff_id IN (SELECT cc_ff_id 
						FROM (select * from cost_config) b	
						WHERE b.cc_ff_id = $id AND b.cc_status != 'N')";
		$query = $this->ffm->query($sql);
	}



	

} // end class M_cost_config
?>