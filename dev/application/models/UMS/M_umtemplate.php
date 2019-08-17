<?php

include_once("Da_umtemplate.php");

class M_umtemplate extends Da_umtemplate {

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
				FROM umtemplate 
				$orderBy";
		$query = $this->db->query($sql);
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
	function get_default($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umtemplate 
				WHERE temID=0";
		$query = $this->ums->query($sql);
		return $query ;
		
	}
	function get_by_key_sys($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umtemplate 
				WHERE StID=?";
		$query = $this->ums->query($sql, array($this->StID));
		return $query ;
		
	}
	function get_by_key_sys_join_icon($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM umtemplate LEFT JOIN umicon
				ON umtemplate.HeadIcon = umicon.IcName 
				WHERE StID=?";
		$query = $this->ums->query($sql, array($this->StID));
		return $query ;
		
	}
	function get_count_by_sys($withSetAttributeValue=FALSE) {	
		$sql = "SELECT count(temID) 
				FROM umtemplate 
				WHERE StID=?";
		$query = $this->ums->query($sql, array($this->StID));
		return $query ;
		
	}
	function updateHead() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umtemplate 
				SET	HeadIcon=?, HeightHeadTop=?, MarginHeadTop=?, ColorHeadTop=?, ColorHeadBottom=?, ColorTopButton=? ,ColorBottomButton=?  
				WHERE StID=?";
		$this->ums->trans_begin();
		$this->ums->query($sql, array($this->HeadIcon ,$this->HeightHeadTop ,$this->MarginHeadTop ,$this->ColorHeadTop ,$this->ColorHeadBottom ,$this->ColorTopButton ,$this->ColorBottomButton ,$this->StID));
		if ($this->ums->trans_status() === FALSE)
			{
				$this->ums->trans_rollback();
			}
			else
			{
				$this->ums->trans_commit();
			}
	}

	
	function get_ID($withSetAttributeValue=FALSE) {
		$sql = "SELECT temID 
				FROM umtemplate 
				WHERE StID=?";
		$query = $this->ums->query($sql, array($this->StID));
		return $query ;
			
	}
	function add_default(){
		$sql = "INSERT INTO umtemplate (temID, StID, HeadIcon, HeightHeadTop, MarginHeadTop, ColorHeadTop, ColorHeadBottom, ColorTopButton, ColorBottomButton)
				VALUES(?, ?, 'UMSBUU-10.png', '58','0', '#94cbe0', '#eee8e8', 'white', 'black')";
				
		$query = $this->ums->query($sql, array($this->temID, $this->StID));
		return $query;
	}
	
	function get_icon($withSetAttributeValue=FALSE) {	
		$sql = "SELECT HeadIcon
				FROM umtemplate
				WHERE StID=?";
		$query = $this->ums->query($sql, array($this->StID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	function set_to_default(){
		$sql = "insert into umtemplate select * from umtemplate where temID=0";
		$query = $this->ums->query($sql);
		return $query;
	}
	function edit_StID(){
		$sql ="UPDATE umtemplate 
				SET	StID=? WHERE StID=0 and temID != 0";
		$query = $this->ums->query($sql,array($this->StID));
		return $query;
		
		
	}
	
	// add your functions here

} // end class M_umtemplate
?>
