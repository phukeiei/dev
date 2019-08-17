<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../../UMS_Controller.php");

class C_list_reservation extends  UMS_Controller{
	function __construct(){
        parent::__construct();  
    }

    function Export_list_reservation(){
        $this->load->model('ffm/frontend/M_reservation','Mr'); // แก้
       $fr_ps_id = $this->session->userdata('UsPsCode');
        
        $M = $this->Mr;

       $M->fr_ps_id=$fr_ps_id;
        
        
        $data['rs_Mr']=$this->Mr->get_all_reservation()->result();
        $this->output_frontend("ffm/frontend/ffm_list_reservation",$data);
    }

    function delete_reservation($fr_id){
        $this->load->model('ffm/frontend/M_reservation','Mr');
        $Mr=$this->Mr;
        $Mr->fr_id = $fr_id;
        $Mr->change_status();
        redirect('ffm/frontend/C_list_reservation/Export_list_reservation');
    }
    
	function Export_edit_reservation(){
        $this->output_frontend("ffm/frontend/ffm_edit_reservation");
    }   

    function send_file(){
        redirect('/ffm/frontend/C_list_reservation/Export_list_reservation/');
    }
}
