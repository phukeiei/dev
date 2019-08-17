<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../Ffm_Controller.php");
class C_complains extends  Ffm_Controller{
    function __construct(){
        parent::__construct();  
    }
    
    function Export_ffm_complains_non_member(){
        $this->output_frontend("ffm/frontend/ffm_complains_non_member");
    }

    function Export_ffm_complains_member(){
        $this->load->model('ffm/fontend/M_complains','Mc');
        $data['qu_Mc'] = $this->Mc->get_tp()->result(); 
        $this->output_frontend('ffm/frontend/ffm_complains_member',$data); 
    }
    
    function insert(){
        
        $cp_tp_id = $this->input->post('type');
        $cp_complain =$this->input->post('cp_complain');
        print_r($cp_tp_id);
        print_r($cp_complain);
        $this->load->model('ffm/frontend/M_complains','Mc');
        $Mc = $this->Mc;
        $Mc->cp_tp_id = $cp_tp_id ;
        $Mc->cp_complain = $cp_complain;

        print_r($Mc->cp_tp_id);
        print_r($Mc->cp_complain);

        $Mc->insert_data();
        
        
    }
     
   
    

    


}