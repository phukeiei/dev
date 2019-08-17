<!--
*
*M_swm_user_group
*Model Da_swm_user_group
*@author Tiwakorn Hedmuin
*@Create Date 2562-05-18
*
-->
<?php

include_once(dirname(__FILE__)."/../Da_swm_user_group.php");

class M_swm_user_group extends Da_swm_user_group {

	/*
	 * aOrderBy = array('fieldname' => 'ASC|DESC', ... )
	*/
	/*
	 *function get_all
	 *get all data from database
	 *input option orderby
	 *output information of  user group
	 *@author Tiwakorn Hedmuin
	 *@Create Date 2562-05-18
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
				FROM swm_user_group 
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
	 *function get_options
	 *get option Y/N from database
	 *input status option Y/N
	 *output option on dropdown
	 *@author Tiwakorn Hedmuin
	 *@Create Date 2562-05-18	
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

} // end class M_swm_user_group
?>