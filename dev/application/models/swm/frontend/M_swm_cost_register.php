<!--
*
*Swm_cost_register
*Model M_swm_cost_register
*@author Pattarakorn Pamornchart
*@Create Date 2562-05-18
*

<?php
include_once(dirname(__FILE__)."/../Da_swm_cost_register.php");

class M_swm_cost_register extends Da_swm_cost_register {
	
	/*
	*get_all  user's data from database
	*input Option order by 
	*output User's information
	*@author Pattarakorn Pamornchart
	*@Create Date 2562-05-18
	*/
	
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
				FROM swm_cost_register 
				$orderBy";
		$query = $this->swm->query($sql);
		return $query;
	}
	
	/*
	*get_options option show on box is "-----เลือก-----"
	*input state option (y/n)
	*output option on dropdown
	*@author Pattarakorn Pamornchart
	*@Create Date 2562-05-18
	*/
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

} // end class M_swm_cost_register
?>