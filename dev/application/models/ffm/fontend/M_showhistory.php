<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/../M_field_reservation.php");


class M_showhistory extends  M_field_reservation
{

    public $ps_id;
    public $year;


    
    function __construct()
    {
        parent::__construct();
    }
    function getdata()
    {

        $sql = "SELECT month(fr_start_date) AS date,fr_ps_id AS id,SUM(fr_hour) AS hours
            FROM field_reservation
            WHERE year(fr_start_date)= ? AND fr_ps_id = ?
            GROUP BY month(fr_start_date)";
        $query = $this->ffm->query($sql, array($this->year, $this->ps_id));
        return $query;
    }
    function getyear()
    {
        $sql = "SELECT year(fr_start_date)+543 AS year
            FROM field_reservation
           WHERE fr_ps_id = ?
           GROUP BY year(fr_start_date)
           ORDER BY year ";
        $query = $this->ffm->query($sql, array($this->ps_id));
        return $query;
    }
}
