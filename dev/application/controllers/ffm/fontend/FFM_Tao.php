<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../../UMS_Controller.php");
class FFM_Tao extends  UMS_Controller{
    function __construct(){
        parent::__construct();  
    }
    function Export_ffm_user_04_03_01(){
        $this->output_frontend("ffm/fontend/ffm_edit_reservation");
    }
    function insert1(){

       // $cp_tp_id = $this->input->post('cp_tp_id');
        $cp_complain =$this->input->post('complain');
       
        $this->load->model('ffm/fontend/M_tao', 'tt');
        $tt = $this->tt;
        //$may->cp_tp_id = $cp_tp_id ;
        $tt->cp_complain = $cp_complain;


        $tt->insert();

        redirect('');
       

    }
}