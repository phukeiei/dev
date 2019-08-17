<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../Ffm_Controller.php");
class C_controller_ajax extends  Ffm_Controller{
    function __construct(){
        parent::__construct();  
    }
    function get_by_value($data1,$data2){
        $this->load->model('/ffm/fontend/M_reservation','Mr');
        $this->Mr->fr_start_date = $data1;
        $this->Mr->fr_ff_id = $data2;
        $informtable = $this->Mr->get_By_fleid()->result();
        echo Json_encode($informtable);
    }
    
}