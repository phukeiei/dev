<?php

include_once("Da_umshowprofile.php");

class M_umshowprofile extends Da_umshowprofile {

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
				FROM umuser 
				$orderBy";
		$query = $this->ums->query($sql);
		return $query;
	}

function get_by_group($UgUsID)
	{
		$sql ="SELECT *
				From umusergroup inner join umgroup on umusergroup.UgGpID=umgroup.GpID
				inner join umsystem on umgroup.GpStID=umsystem.StID
				WHERE UgUsID=?";
		$query = $this->ums->query($sql,array($UgUsID));
		return $query;
	}
	
	
	//SELECT * 
//FROM umuser LEFT JOIN umgroup on umuser.UsID=umgroup.GpNameT  
//LEFT JOIN umsystem on umuser.UsID=umsystem.StAbbrE
//WHERE UsID=1
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
	
	function get_by_key($withSetAttributeValue=FALSE) 
	{ 
	$sql = "SELECT * FROM umuser WHERE UsName=? AND UsID=?" ; 
	$query = $this->ums->query($sql, array($this->UsID)); 
	if ( $withSetAttributeValue ) { 
	$this->row2attribute( $query->row() ); } 
	else { return $query ; } 
	}
	// add your functions here
	function check_login($id,$passwd)
	{
		$sql="SELECT * FROM umuser WHERE UsLogin='$id' and UsPassword='$passwd' and UsActive=1";
		$query = $this->ums->query($sql);
		return $query;
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
	$strSQL = "SELECT * FROM umuser WHERE UsName = '".trim($_POST['txtUsername'])."' 
	OR Email = '".trim($_POST['txtEmail'])."' ";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
			echo "Not Found Username or Email!";
	}
	else
	{
			echo "Your password send successful.<br>Send to mail : ".$objResult["Email"];		

			$strTo = $objResult["txtEmail"];
			$strSubject = "Your Account information username and password.";
			$strHeader = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 //
	
			$strMessage = "";
			$strMessage .= "Welcome : ".$objResult["Name"]."<br>";
			$strMessage .= "Username : ".$objResult["Username"]."<br>";
			$strMessage .= "Password : ".$objResult["Password"]."<br>";
			$strMessage .= "=================================<br>";
			
			$flgSend = mail($strTo,$strSubject,$strMessage,$strHeader); 

	}
	
	}
} // end class M_umuser
?>
