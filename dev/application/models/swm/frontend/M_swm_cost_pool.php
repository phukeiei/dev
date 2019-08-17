<?php
/*
*
*cost_pool
*Model M_swm_cost_pool
*@author Manita Doungrassamee
*@author Chanikan Khamruang
*@Create Date 2562-05-18
*
*/
include_once(dirname(__FILE__)."/../Da_swm_cost_pool.php");

class M_swm_cost_pool extends Da_swm_cost_pool {

	/*
	 * get_all
	 * get_all_value
	 * @author Manita Doungrassamee
	 * @Create Date 2562-05-18
	 */
	 
	 /*aOrderBy = array('fieldname' => 'ASC|DESC', ... )
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
				FROM swm_cost_pool 
				$orderBy";
		$query = $this->swm->query($sql);
		return $query;
	}
	
	
	/*
	 * get_options
	 * get value of options
	 * @author Chanikan Khamruang
	 * @Create Date 2562-05-18
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

} // end class M_swm_cost_pool
?>
