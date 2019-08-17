<?php

/*
 *  $moo , $tam
 */
function check_in_area($moo = 0, $district = 0)
{
    $ci =& get_instance();
    $moo = intval($moo);
    $district = intval($district);
    if ($district == 7052) { // ตำบลบ้านเกาะ
        switch ($moo) {
            case 4:
                return true;
                break;
            default:
                break;
        }
    }
    /*
    else {
        $hr = $ci->load->database('hr',true);
        $hr_db = $hr->database;
        $ps_id =  $ci->session->userdata('UsPsCode');
        if($ps_id != ""){
            $sql = "SELECT ps_in_area FROM `{$hr_db}`.`hr_person` WHERE ps_id = ?";
            $query = $hr->query($sql, array($ps_id));
            if($query->row()->ps_in_area == 'Y')
                return true;
        }
    }
    */
    return false;
}