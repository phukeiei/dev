<?php
/*
* M_swm_attend
* Model M_swm_attend
*@author Khwanchai Nontawichit
*@Create Date 2562-05-18
*/
include_once(dirname(__FILE__)."/../Da_swm_attend.php");

class M_swm_attend extends Da_swm_attend {

	/* 
	*get data service from database
	*input  ps_id of user
	*output information service of user
	*@author Yaowapa Pongpadcha
	*@Create Date 2562-05-18	
	*/
	function get_data_service($session_id){
		#su_ps_id,su_code,sa_create_date
		$sql = "SELECT * 
				FROM ".$this->swm_db.".swm_attend
				LEFT JOIN ".$this->swm_db.".swm_user ON swm_attend.sa_su_id = swm_user.su_id
				WHERE su_ps_id=	".$session_id;
		$query = $this->swm->query($sql);
		return $query;
	}
	/*
	 * aOrderBy = array('fieldname' => 'ASC|DESC', ... )
	 */
	 /*
	 *get all user data from database 
	 *input option order by
	 *output information of user
	 *@author Yaowapa Pongpadcha
	 *@Creat Date 2562-05-18
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
				FROM swm_attend 
				$orderBy";
		$query = $this->swm->query($sql);
		return $query;
	}
	
	/*
	 * create array of pk field and value for generate select list in view, must edit PK_FIELD and FIELD_NAME manually
	 * the first line of select list is '-----เลือก-----' by default.
	 * if you do not need the first list of select list is '-----เลือก-----', please pass $optional parameter to other values. 
	 * you can delete this function if it not necessary.
	 */

	 /* 
	 *Select option show on box is "-----เลือก-----"
	 *input status option (y/n)
	 *output option on dropdown
	 *@author Yaowapa Pongpadcha
	 *@Creat Date 2562-05-18
	 */
	function get_options($optional='y') {
		$qry = $this->get_all();
		if ($optional=='y') $opt[''] = '-----เลือก-----';
		foreach ($qry->result() as $row) {
			$opt[$row->PK_FIELD] = $row->FIELD_NAME;
		}
		return $opt;
	}
	
	/* 
	*get time user attend
	*input  startDate, endDate, startAge, endAge, state
	*output information of attend user
	*@author Manita Doungrassamee
	*@Create Date 2562-05-20	
	*/

	function get_time_us_attend($startDate = "", $endDate = "", $startAge = "", $endAge = "", $state = ""){
		$whereDate = "";
		$whereAge = "";
		$whereState = "";
		
		if($startDate != "" || $endDate != ""){
			$whereDate = "AND (sa_create_date BETWEEN '$startDate' AND '$endDate')";
		}
		if($startAge != "" || $endAge != ""){
			$whereAge = "(age BETWEEN $startAge AND $endAge) ".$whereDate;
		}else{
			$whereAge = substr($whereDate, 3);
		}
		if($state != ""){
			$whereState = "WHERE su_state IN ($state)        HAVING ".$whereAge;
		}else{
			$whereState = "WHERE ".$whereAge;
			$whereState = substr($whereState, 0, 0);
		}

		if($whereAge == "" ){
			$whereState = substr($whereState, 0,25);
		}
		

		$sql = "SELECT (YEAR(CURDATE()) - YEAR(psd_birthdate)) AS age , sa_create_date, sa_time, sa_real_cost, ss_name, psd_birthdate
				FROM ".$this->swm_db.".swm_attend
				LEFT JOIN ".$this->swm_db.".swm_user ON su_id = sa_su_id
				LEFT JOIN ".$this->swm_db.".swm_status ON su_state = ss_id
				LEFT JOIN ".$this->hr_db.".hr_person_detail ON su_ps_id = psd_ps_id ".$whereState;

		$query = $this->swm->query($sql);
		return $query;
	}
	
	
	// add your functions here

} // end class M_swm_attend
?>