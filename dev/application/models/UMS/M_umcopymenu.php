<?php

include_once("My_model.php");

class M_umcopymenu extends My_model {
	
	public $StID;
	public $StNameT;
	public $StNameE;
	public $StAbbrT;
	public $StAbbrE;
	public $StDesc;
	public $StURL;
	public $StIcon;

	public $MnStID;
	public $MnID;
	public $MnSeq;
	public $MnIcon;
	public $MnNameT;
	public $MnNameE;
	public $MnURL;
	public $MnDesc;
	public $MnToolbar;
	public $MnToolbarSeq;
	public $MnToolbarIcon;
	public $MnParentMnID;
	public $MnLevel;
	
	public $last_insert_id;
	
	function checkSystem($sitechk,$StID){
		$sql ="SELECT * FROM ".$sitechk."_umsdb.umsystem WHERE StID=?";
		$query = $this->ums->query($sql,array($StID));
		return $query;
	}
	
	function insert_system($sitechk){
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO ".$sitechk."_umsdb.umsystem (StID, StNameT, StNameE, StAbbrT, StAbbrE, StDesc, StURL, StIcon)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
		
		 
		$this->ums->query($sql, array($this->StID, $this->StNameT, $this->StNameE, $this->StAbbrT, $this->StAbbrE, $this->StDesc, $this->StURL, $this->StIcon));
		$this->last_insert_id = $this->ums->insert_id();
	}
	
	
	function checkSystemMenu($sitechk,$MnStID,$MnID,$MnURL)
	{
		$sql = "SELECT * FROM ".$sitechk."_umsdb.ummenu WHERE MnStID = ?  AND MnURL = ?";
		$query = $this->ums->query($sql,array($MnStID,$MnURL));
		return $query;
	}
	
	function insert_menu($sitechk) {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO ".$sitechk."_umsdb.ummenu (MnStID, MnSeq, MnIcon, MnNameT, MnNameE, MnURL, MnDesc, MnToolbar, MnToolbarSeq, MnToolbarIcon, MnParentMnID, MnLevel)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		 
		$this->ums->query($sql, array($this->MnStID, $this->MnSeq, $this->MnIcon, $this->MnNameT, $this->MnNameE, $this->MnURL, $this->MnDesc, $this->MnToolbar, $this->MnToolbarSeq, $this->MnToolbarIcon, $this->MnParentMnID, $this->MnLevel));
		$this->last_insert_id = $this->ums->insert_id();
	}
	
	function get_by_key_import(){	
		$sql = "SELECT * 
				FROM umsystem 
				where StNameT = ?";
		$query = $this->ums->query($sql, array($this->StNameT));
		//if ( $withSetAttributeValue ) {
			//$this->row2attribute( $query->row() );
	//	} else {
			return $query ;
		//}
	//	return $sql ;
		
	}
	
	function get_by_keymenu_import() {	
		$sql = "SELECT * 
				FROM ummenu 
				where MnStID = ?";
		$query = $this->ums->query($sql, array($this->MnStID));
		//if ( $withSetAttributeValue ) {
			//$this->row2attribute( $query->row() );
	//	} else {
			return $query ;
		//}
	//	return $sql ;
		
	}
	
	
	function get_all_copy($st) {	
		$sql = "SELECT * ,(MnID % 10000)+1 as ID , (MnParentMnID % 10000)+1 as ParentID
				FROM ummenu as a
				left join umsystem as b
				on a.MnStId = b.StID
				where a.MnStId = $st
				order by a.MnStId,a.MnSeq";
		$query = $this->ums->query($sql);
		//if ( $withSetAttributeValue ) {
			//$this->row2attribute( $query->row() );
	//	} else {
			return $query ;
		//}
	//	return $sql ;	
	}
	
	function get_by_key_copy($st) {	
		$sql = "SELECT * ,(MnID % 10000)+1 as ID , (MnParentMnID % 10000)+1 as ParentID
				FROM ummenu as a
				left join umsystem as b
				on a.MnStId = b.StID
				where a.MnID = $st
				order by a.MnStId,a.MnSeq";
		$query = $this->ums->query($sql);
		//if ( $withSetAttributeValue ) {
			//$this->row2attribute( $query->row() );
	//	} else {
			return $query ;
		//}
	//	return $sql ;
		
	}
	
	function get_dpnotin(){
		$sql = "SELECT * FROM umdepartment WHERE dpID NOT IN (1,14)";
		$query = $this->ums->query($sql);
		return $query;
	}
	
}

?>