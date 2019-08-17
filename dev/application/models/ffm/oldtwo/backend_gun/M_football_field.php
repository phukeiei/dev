<?php

include_once("Da_football_field.php");

class M_football_field extends Da_football_field {

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
				FROM football_field 
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
	function get_table(){
		
		$sql = "SELECT * 
				FROM football_field
				WHERE ff_status != 'D'";
		$query = $this->ffm->query($sql);
		return $query;
	}
	
	// add your functions here
	// แอมเพิ่ม function edit วันที่ 19/05/2562
	function edit(){
		$sql = "UPDATE football_field 
				SET	ff_name=?, ff_size=?, ff_status=?, ff_update=?, ff_user_update=? 
				WHERE ff_id=?";	
		$this->ffm->query($sql, array($this->ff_name, $this->ff_size, $this->ff_status, $this->ff_update, $this->ff_user_update, $this->ff_id));
		
	}

	function update_status() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE football_field 
				SET	ff_status=?
				WHERE ff_id=?";	
		$this->ffm->query($sql, array($this->ff_status,$this->ff_id));	
	}


} // end class M_football_field
?>