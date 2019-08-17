<?php

include_once("Da_umforgotpassword.php");

class M_umforgotpassword extends Da_umforgotpassword {

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
				$orderBy	";
		$query = $this->ums->query($sql);
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
	
	
	function check_user($id)
	{
		$sql="SELECT * FROM umuser WHERE UsLogin='$id' and UsActive=1";
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
	
	function check_email($email)
	{
	$sql="SELECT * FROM umuser WHERE UsName=? and UsEmail=? ";
		$email=md5("O]O".$email."O[O");
		$query = $this->ums->query($sql,array($this->session->userdata('UsName'),$email));

		if($query->num_rows()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	
}
	
	


 // end class M_umuser
?>
