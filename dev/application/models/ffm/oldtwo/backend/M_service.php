<?php

include_once("Da_type_complain.php");

class M_service extends Da_type_complain {

	
	
	////////////////////FRZ ADD 19/05/62
	function update_comment(){
		$sql = "UPDATE type_complain 
				SET	tp_complain=? 
				WHERE tp_id=?";	
		$this->ffm->query($sql, array($this->tp_complain, $this->tp_id));	
    }
    
    function get_time() {
        $sql = 'SELECT * FROM cost_config'
                .' WHERE ((cc_start_time BETWEEN ? AND ? '
                .' OR cc_end_time BETWEEN ? AND ?) '
                .' AND cc_status LIKE "Y" AND cc_type = ? AND cc_ff_id = ?) OR'
                .' ((? BETWEEN cc_start_time AND cc_end_time OR ? BETWEEN cc_start_time AND cc_end_time)'
                .' AND cc_status LIKE "Y" AND cc_type = ? AND cc_ff_id = ?)';
        $result = $this->ffm->query($sql, array(
            $this->start_time,
            $this->end_time,
            $this->start_time,
            $this->end_time,
            $this->type,
            $this->field,
            $this->start_time,
            $this->end_time,
            $this->type,
            $this->field,
        ));

        // echo $sql;
        // echo $this->start_time;
        // echo    $this->end_time;
        // echo     $this->start_time;
        // echo     $this->end_time;
        // echo    $this->type;
        // echo     $this->field;

        return $result;
    }

} // end class M_type_complain
?>