<?php

include_once("Da_type_complain.php");

class M_type_complain extends Da_type_complain {

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
				FROM type_complain 
				WHERE tp_active = 'Y'
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
	
	function insert(){
		
		$sql = "INSERT INTO type_complain (tp_complain,tp_active)
				VALUES(?,'Y')";
		$this->ffm->query($sql, array($this->tp_complain));
		$this->last_insert_id = $this->ffm->insert_id();
	}
	function complain_update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE type_complain 
				SET	tp_active='N'
				WHERE tp_id=?";	
		$this->ffm->query($sql, array($this->tp_id));

	}
	
	////////////////////FRZ ADD 19/05/62
	function update_comment(){
		$sql = "UPDATE type_complain 
				SET	tp_complain=? 
				WHERE tp_id=?";	
		$this->ffm->query($sql, array($this->tp_complain, $this->tp_id));	
		

	}

} // end class M_type_complain
?>