<?php

include_once("Da_umnotification.php");

class M_umnotification extends Da_umnotification {

	/*
	 * aOrderBy = array('fieldname' => 'ASC|DESC', ... )
	 */
	function get_all($max=100){
		$sql = "SELECT * ,DATE_FORMAT(checkin, '%d/%m/%Y') as checkindate
				FROM umnotification left join umgroup 
				on no_wgid = GpID
				where state_id!=0 and no_usid=? 
				order by state_id desc,checkindate desc
				LIMIT 0 , $max";
		$query = $this->ums->query($sql,array($this->session->userdata('UsID')));
		return $query;
	}
	function get_all_with_sys(){
		$sql = "SELECT *,DATE_FORMAT(checkin, '%d/%m/%Y') as checkindate
				FROM umnotification left join umgroup 
				on no_wgid = GpID left join umsystem
				on GpStID = StID
				where state_id!=0 and no_usid=? 
				order by state_id desc,checkindate desc";
		$query = $this->ums->query($sql,array($this->session->userdata('UsID')));
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
	function get_news(){
		$sql = "SELECT count(*) as news FROM `umnotification` where state_id=2 and no_usid=?  group by (state_id) ";
		$query = $this->ums->query($sql,array($this->session->userdata('UsID')));
		if($query->num_rows() > 0){
			$num = $query->row_array();
			return $num['news'];
		}
	}
	
	function read($id){
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umnotification 
				SET	state_id=?, state_name=?, system_state=?
				WHERE id=?";	
		$this->ums->query($sql, array(1,"อ่านแล้ว", $this->system_state,$id));	
	}
	function remove($id){
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umnotification 
				SET	state_id=?, state_name=?, system_state=?
				WHERE id=?";	
		$this->ums->query($sql, array(0,"ลบทิ้ง", $this->system_state,$id));	
	}
	function get_url($ID){
		$sql = "SELECT * 
				FROM umnotification 
				where id=? ";
		$query = $this->ums->query($sql,array($ID));
		return $query;
	}
	// add your functions here

} // end class M_umnotification
?>
