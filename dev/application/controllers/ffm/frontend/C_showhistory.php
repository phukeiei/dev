<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/../Ffm_Controller.php");
class C_showhistory extends  Ffm_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('ffm/frontend/M_showhistory','Model');
    }


    function Export_ffm_showhistory()
    {
        $ps_id = $this->session->userdata('UsPsCode');
        $m = $this->Model;
        $m->ps_id = $ps_id;

        $data['year'] = $m->getyear()->result();

        //echo $m->ffm->last_query();
      
		//$data['da'] = "123";
        //$this->output_frontend("ffm/fontend/ffm_showhistory",$data);
        $this->output_frontend("ffm/frontend/ffm_showhistory",$data);
    }
    public function show()
    {        
        $m = $this->Model;
        
        $m->ps_id = $this->input->post("main");
        $m->year = $this->input->post("year")-543;

        //$this->Model->ps_id = $this->$ps_code;
        

        $data =  $this->Model->getdata()->result();


        echo json_encode($data);
      
}
}