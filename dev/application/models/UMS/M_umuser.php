<?php

include_once("Da_umuser.php");

class M_umuser extends Da_umuser {

	/*
	 * aOrderBy = array('fieldname' => 'ASC|DESC', ... )
	 */
	function get_all($aOrderBy=""){
		$orderBy = "";
		if ( is_array($aOrderBy) ) {
			$orderBy.= "ORDER BY "; 
			foreach ($aOrderBy as $key => $value) {
				$orderBy.= "CONVERT($key USING tis620) $value, ";
			}
			$orderBy = substr($orderBy, 0, strlen($orderBy)-2);
		}
		$sql = "SELECT * FROM umuser inner join umdepartment on umdepartment.dpID=umuser.UsDpID $orderBy	";
		$query = $this->ums->query($sql);
		return $query;
	}
	function get_all_android(){
		$sql = "SELECT * 
				FROM umuser inner join umdepartment on umdepartment.dpID=umuser.UsDpID order by UsName LIMIT 0,300";
		$query = $this->ums->query($sql);
		return $query;
	}
	
	function get_all_with_dp(){
		$sql = "SELECT * 
				FROM umuser inner join umdepartment on umdepartment.dpID=umuser.UsDpID
				WHERE UsDpID=?";
		$query = $this->ums->query($sql,array($this->session->userdata('UsDpID')));
		return $query;
	}
	
	function get_all_with_user(){
		$sql = "SELECT UsName, UsLogin, umuser.UsDpID FROM umuser inner join umdepartment on umdepartment.dpID=umuser.UsDpID
				";
		$query = $this->ums->query($sql,array($this->session->userdata('UsDpID')));
		return $query;
	}
	/*
	 * create array of pk field and value for generate select list in view, must edit PK_FIELD and FIELD_NAME manually
	 * the first line of select list is '-----àÅ×Í¡-----' by default.
	 * if you do not need the first list of select list is '-----àÅ×Í¡-----', please pass $optional parameter to other values. 
	 * you can delete this function if it not necessary.
	 */
	function get_options($optional='y') {
		$qry = $this->get_all();
		if ($optional=='y') $opt[''] = '-----àÅ×Í¡-----';
		foreach ($qry->result() as $row) {
			$opt[$row->PK_FIELD] = $row->FIELD_NAME;
		}
		return $opt;
	}
	
	// add your functions here
	function check_login($id,$passwd)
	{
		$sql="SELECT * FROM umuser inner join umdepartment on umuser.UsDpID = umdepartment.dpID WHERE UsLogin='$id' and UsPassword='$passwd' and UsActive=1";
		$query = $this->ums->query($sql);
		
		if($query->num_rows()>0)
		{
			return $query;
		}
		else
		{
			return false;
		}
	}
	function check_login_android($id,$passwd)
	{
		$sql="SELECT * FROM umuser inner join umdepartment on umuser.UsDpID = umdepartment.dpID WHERE UsLogin=? and UsPassword=? and UsActive=1 and UsAdmin=1";
		$query = $this->ums->query($sql,array($id,$passwd));
		
		if($query->num_rows()>0)
		{
			return $query;
		}
		else
		{
			return false;
		}
	}
	function getuserinfo($UsID)
	{
		$sql="SELECT UsID,UsName,UsLogin,WgNameT,UsEmail FROM umuser inner join umdepartment on umuser.UsDpID = umdepartment.dpID WHERE UsLogin=? ";
		$query = $this->ums->query($sql,array($UsID));
		
		if($query->num_rows()>0)
		{
			return $query;
		}
		else
		{
			return false;
		}
	}
	
	function check_user($id) 
	{ 
		$sql="SELECT * FROM umuser inner join umdepartment on umuser.UsDpID = umdepartment.dpID WHERE UsLogin='$id' and UsActive=1";
		$query = $this->ums->query($sql);
		
		if($query->num_rows()>0)
		{
			return $query;
		}
		else
		{
			return false;
		}
	}
	
	function check_pass($pass)
	{

		$sql="SELECT * FROM umuser WHERE UsID=? and UsPassword=? ";
		$passwd=md5("O]O".$pass."O[O");
		$query = $this->ums->query($sql,array($this->session->userdata('UsID'),$passwd));

		if($query->num_rows()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	
	}
	function forgotpassword() {
		$this->load->view('template/header');
		$this->load->view('template/topbar');
		$this->load->view('template/toolbar');
		$this->load->view('UMS/v_forgotpassword',$data);
		$this->load->view('template/footer');
		}
	
	function senntoemail($name,$email){
		$strSQL = "SELECT * FROM sentEmail WHERE username = '".trim($name)."' 
		OR email = '".trim($email)."' ";
		$query = $this->ums->query($strSQL);
		$objRow = $query->num_rows();
		$objResult = $query->result_array();

		if($objRow==0)
		{
			return 0;
				 //echo "Not Found Username or Email!"; 
		}
		else
		{
				// "Your password send successful.<br>Send to mail : ".$objResult[0]["email"];	
				
				 $strTo = $objResult[0]["email"]; 
				 $strSubject = "Your Account information username and password."; 
				 $strHeader = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 // 
				 $strHeader .= "From: se.buu.ac.th;\nReply-To: se.buu.ac.th"; 
				 $strMessage = "";
				 $strMessage .= "Welcome : ".$objResult[0]["username"]."<br>";
				 $strMessage .= "Username : ".$objResult[0]["username"]."<br>"; 
				 $strMessage .= "Password : ".$objResult[0]["password"]."<br>"; 
				 $strMessage .= "================================="; 
				ini_set("sendmail_from",$strTo);
				$flgSend = mail($strTo,$strSubject,$strMessage,$strHeader);   	  	
			return 1;
		}
}
	
	function get_ID_by_name()
	{
		$sql = "SELECT UsID 
				FROM umuser 
				WHERE UsName = ?";
		$query = $this->ums->query($sql,array($this->UsName));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
		
	}
	function get_by_dp()
	{
		$sql = "SELECT * FROM umuser inner join umdepartment on umdepartment.dpID=umuser.UsDpID WHERE UsDpID = ?";
		$query = $this->ums->query($sql,array($this->UsDpID));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
		
	}
	
	function  show($data){
		$this->load->view('template/header');
		$this->load->view('template/topbar');
		$this->load->view('template/toolbar');
		$this->load->view('UMS/v_senttoemail',$data);
		$this->load->view('template/footer');
	
	
	}
	public function search() {
	
	
		if($strSearch=="Y"){
			$sql="select * from umuser Where ".$Search2." like '%".$Search."%' "; // à¸„à¸³à¸ªà¸±à¹ˆà¸‡à¸„à¹‰à¸™à¸«à¸²
				}else{
					$sql="select * from umuser";
				}
					$Qtotal = mysql_query($sql);
	}
	function checkUserByPsId ($ps_id) {
		$sql = "select * from umuser where UsPsCode =?";
		$result = $this->ums->query($sql, array($ps_id));
		if ($result->num_rows() <> 0) {
			return $result->row_array();
		} else {
			return false;
		}
	}

	function qryUmUserByUsPsCode($usPsCode){
		$sql = "select * from umuser where UsPsCode =?";
		$query = $this->ums->query($sql, array($usPsCode));
		return $query;
	}
	function check_username($username)
	{
	  $sql = "SELECT count(UsLogin) as num
			  FROM umuser
			  WHERE UsLogin = ?";
	  $query = $this->ums->query($sql, array($username));
	  return $query->row()->num;
	}
	function get_lastid()
	{
		$sql = "SELECT MAX(UsID) AS id FROM umuser";
		$query = $this->ums->query($sql);
		if($query->num_rows())
		{
			$row = $query->row();
			return $row->id;
		}
		else
		{
			return '0';
		}
	}
	function insert_ps() {
		$sql = "INSERT INTO umuser (UsID, UsName, UsLogin, UsPassword, UsPsCode, UsWgID, UsQsID, UsAnswer, UsEmail, UsActive, UsAdmin, UsDesc, UsPwdExpDt, UsUpdDt, UsUpdUsID, UsSessionID,UsDpID)
					VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
			 
			$this->ums->query($sql, array($this->UsID, $this->UsName, $this->UsLogin, $this->UsPassword, $this->UsPsCode, $this->UsWgID, $this->UsQsID, $this->UsAnswer, $this->UsEmail, $this->UsActive, $this->UsAdmin, $this->UsDesc, $this->UsPwdExpDt, $this->UsUpdDt, $this->UsUpdUsID, $this->UsSessionID, $this->UsDpID));
			$this->last_insert_id = $this->ums->insert_id();

		$sql = "INSERT INTO umusergroup (UgID,UgGpID, UgUsID)
				VALUES(?,?, ?)";
		$this->ums->query($sql, array(($this->last_id_umu()+1),$this->config->item('eoff_group_ps'), $this->last_insert_id));

	}
	
	function select_from_UsID ($usid) {
		$sql = "select * from umuser where UsID =?";
		$result = $this->ums->query($sql, array($usid));
		if ($result->num_rows() <> 0) {
			return $result->row_array();
		} else {
			return false;
		}
	}
	
	function resetpassword() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE umuser 
				SET	UsPassword=?
				WHERE UsID=?";	
		$this->ums->query($sql, array($this->UsPassword, $this->UsID));
	}

	function getAllForJSON($sWhere, $sOrder, $sLimit, $aColumns){
		
		$sql = "SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
				FROM umuser inner join umdepartment on umdepartment.dpID=umuser.UsDpID 
				$sWhere $sOrder	$sLimit";
		$query = $this->ums->query($sql);
		return $query ;
	}
	
	function getFound(){
		$sql="SELECT FOUND_ROWS() as found";
		$query = $this->ums->query($sql);
		return $query;
	}
	
	function getRowAll($primaryKey,$table){
		$sql = "SELECT COUNT(".$primaryKey.") as countall
				FROM   ".$table."";
		$query = $this->ums->query($sql);
		return $query;
	}
	function testselect() {
		$sql = "SELECT UsName,StID,StNameT,GpNameT,GpID,dpID,dpName
				FROM umuser
				LEFT JOIN umusergroup ON umuser.UsID = umusergroup.UgUsID 
				LEFT JOIN umgroup ON umusergroup.UgGpID = umgroup.GpID
				LEFT JOIN umsystem ON umgroup.GpStID = umsystem.StID
				LEFT JOIN umdepartment ON umuser.UsDpID = umdepartment.dpID
				WHERE StID=? AND UsDpID=?";	
		$this->ums->query($sql, array($this->StID, $this->UsDpID));
	}
	
	function select_by_email($email){
		$sql="SELECT * FROM umuser WHERE UsEmail='$email'";
		$query = $this->ums->query($sql);
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}
}
 // end class M_umuser
?>
