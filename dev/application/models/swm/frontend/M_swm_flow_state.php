<?php
/*
*Get_state
*Model flow_state
*@author Phattanan chawalitsuwan
*@Create Date 2562-05-18
*/
include_once(dirname(__FILE__)."/../Da_swm_flow_state.php");

class M_swm_flow_state extends Da_swm_flow_state {

	/*
	 * aOrderBy = array('fieldname' => 'ASC|DESC', ... )
	 */
	 
	 /*
	 *get all user's data  form database
	 *input option Order By
	 *output information of user
	 *@author Phattanan Chawalitsuwan
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
				FROM swm_flow_state 
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
	 *Input state option (y/n)
	 *Output option on dropdawn
	 *@author Phattanan Chawalitsuwan
	 *@Create Date 2562-05-18
	 0
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

} // end class M_swm_flow_state
?>