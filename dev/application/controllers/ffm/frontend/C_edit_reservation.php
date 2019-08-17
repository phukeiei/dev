<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../Ffm_Controller.php");

class C_edit_reservation extends  Ffm_Controller{
	function __construct(){
        parent::__construct();  
    }

    function Export_list_reservation(){

        $this->load->model('ffm/frontend/M_reservation','Mr');
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
    
	function Export_edit_reservation($fr_id){
        
        $this->load->model('ffm/frontend/M_reservation','Mr');
        $Mr = $this->Mr;
        $Mr->fr_id = $fr_id;
        $data['edit']= $this->Mr->get_namefleid_date()->result();
        $this->output_frontend("ffm/frontend/ffm_edit_reservation",$data);

    }  
    
    function update_reservation(){
        $this->load->model('ffm/frontend/M_reservation','Mr');

        $Mr=$this->Mr;

        $Mr->Starttime = $this->input->post('Starttime');
        $Mr->Endtime = $this->input->post('Endtime');
        $Mr->number = $this->input->post('number');
        $Mr->fr_id = $this->input->post('fr_id');
        
        $Mr->update_fr_start_time_fr_end_time_fr_number();

        redirect('ffm/frontend/C_list_reservation/Export_list_reservation');
       // $fr_ps_id = $this->session->userdata('UsPsCode');
     //   echo  $fr_id ."/n";
   

   
      //$this->Mr->update_fr_start_time_fr_end_time_fr_number();
        
                //$Mr->fr_id = $fr_id;
        //$Mr->update();
        //redirect('ffm/frontend/C_list_reservation/Export_list_reservation');
    }

}
