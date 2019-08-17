<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../../UMS_Controller.php");

class C_list_reservation extends  UMS_Controller{
	function __construct(){
        parent::__construct();  
    }

    function Export_list_reservation(){
        $this->load->model('ffm/fontend/M_reservation','Mr');
        $data['rs_Mr']=$this->Mr->get_all_reservation()->result();
        $this->output_frontend("ffm/fontend/ffm_list_reservation",$data);
    }

    function delete_reservation($fr_id){
        $this->load->model('ffm/fontend/M_reservation','Mr');
        $Mr=$this->Mr;
        $Mr->fr_id = $fr_id;
        $Mr->change_status();
        redirect('ffm/fontend/C_list_reservation/Export_list_reservation');
    }
    
	function Export_edit_reservation(){
        $this->output_frontend("ffm/fontend/ffm_edit_reservation");
    }   

}