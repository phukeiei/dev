<?php

include_once("My_model.php");
// edit date 26/3/2557 by apipol add table umsync
// edit date 3/1/2557 by apipol
class Da_umsync extends My_model {		
	
	public $last_insert_id;
	public $UsDpID;
	public $HRDB = "swp_hrdb_";
	function __construct() {
		parent::__construct();
	}
	function sync(){
		$sql = "select CONCAT(fName, ' ', lName) as name,emailAddr,fName2,lName2,Person.personId,Person.majortypeId,Person.dpId from (".$this->HRDB.".Person inner join ".$this->HRDB.".PersonT on Person.personId = PersonT.personId) left join umuser on CONCAT(fName, ' ', lName) = umuser.UsName where UsName is null limit 0,20";
		$query = $this->ums->query($sql);
		return $query;
	}
	function sync_single($firstname='0',$lastname='0'){
		if($firstname!='0'){
			if($lastname!='0'){
				$sql = "select CONCAT(fName, ' ', lName) as name,emailAddr,fName2,lName2,Person.personId,Person.majortypeId,Person.dpId from (".$this->HRDB.".Person inner join ".$this->HRDB.".PersonT on Person.personId = PersonT.personId) left join umuser on CONCAT(fName, ' ', lName) = umuser.UsName 
				where UsName is null and fName like ? and lName like ?  limit 0,20";  
				$query = $this->ums->query($sql,'%'.$firstname.'%','%'.$lastname.'%');
				return $query;
			}else{
				$sql = "select CONCAT(fName, ' ', lName) as name,emailAddr,fName2,lName2,Person.personId,Person.majortypeId,Person.dpId from (".$this->HRDB.".Person inner join ".$this->HRDB.".PersonT on Person.personId = PersonT.personId) left join umuser on CONCAT(fName, ' ', lName) = umuser.UsName 
				where UsName is null and fName like ?  limit 0,20";  
				$query = $this->ums->query($sql,'%'.$firstname.'%');
				return $query;
			}
		}else{
			if($lastname!='0'){
				$sql = "select CONCAT(fName, ' ', lName) as name,emailAddr,fName2,lName2,Person.personId,Person.majortypeId,Person.dpId from (".$this->HRDB.".Person inner join ".$this->HRDB.".PersonT on Person.personId = PersonT.personId) left join umuser on CONCAT(fName, ' ', lName) = umuser.UsName 
				where UsName is null and lName like ?  limit 0,20";
				$query = $this->ums->query($sql,'%'.$lastname.'%');
				return $query;
			}else{
				$sql = "select CONCAT(fName, ' ', lName) as name,emailAddr,fName2,lName2,Person.personId,Person.majortypeId,Person.dpId from (".$this->HRDB.".Person inner join ".$this->HRDB.".PersonT on Person.personId = PersonT.personId) left join umuser on CONCAT(fName, ' ', lName) = umuser.UsName where UsName is null limit 0,20";
				$query = $this->ums->query($sql);
				return $query;

			}
		}
		
		
		
	}
	
	function check_username($username){
		$sql = "select UsLogin from umuser where UsLogin=? ";
		$query = $this->ums->query($sql,array($username));
		if($query->num_rows() < 1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function insert($name){
		$sql = "INSERT INTO umsync (syncID,syncFilename,syncUsID,syncTime) values ( '' , ? , ? , NOW())";
		$this->ums->query($sql, array($name,$this->session->userdata('UsID')));
		$this->last_insert_id = $this->ums->insert_id();
	}
	function delete($syncID){
		$sql = "DELETE FROM umsync 
				WHERE syncID=?";
		$this->ums->query($sql, array($syncID));
	}
	function get_all(){
		$sql = "select * FROM umsync inner join umuser on umsync.syncUsID = umuser.UsID ";
		$result = $this->ums->query($sql);
		return $result;
	}
	function get_all_sync(){
		$sql = "select * FROM umsync inner join umuser on umsync.syncUsID = umuser.UsID where syncFilename like 'sync%' ";
		$result = $this->ums->query($sql);
		return $result;
	}
	function get_sync_by_UsID($UsID){
		$sql = "select * FROM umsync LEFT JOIN umuser on umsync.syncUsID = umuser.UsID where umsync.syncUsID =".$UsID."";
		$result = $this->ums->query($sql);
		return $result;
	}
	
	function get_all_groupadd(){
		$sql = "select * FROM umsync inner join umuser on umsync.syncUsID = umuser.UsID where syncFilename like 'groupadd%' ";
		$result = $this->ums->query($sql);
		return $result;
	}
}	 //=== end class Da_umuser
?>
