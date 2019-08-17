<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../Ffm_Controller.php");
class Controller_ajax extends  Ffm_Controller{
    function __construct(){
        parent::__construct();  
    }
    function get_by_value(){
        $this->load->model('/ffm/frontend/M_reservation','Mr');
        $this->Mr->fr_start_date = splitDateForm1($this->input->POST("start_date","/"));
        $this->Mr->fr_ff_id = $this->input->POST("field");
        $informtable = $this->Mr->get_By_field2()->result();
        echo Json_encode($informtable);
    }
    
}