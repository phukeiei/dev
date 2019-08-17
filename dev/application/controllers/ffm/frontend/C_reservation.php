<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../Ffm_Controller.php");

class C_reservation extends  Ffm_Controller{
	function __construct(){
        parent::__construct();  
    }
    function Export_reservation_form(){ 
            $this->load->model('/ffm/frontend/M_reservation','mr');
            $data['qu_mr'] = $this->mr->get_prefix()->result();
            $data['qu_fleid'] = $this->mr->get_all_field()->result();
            $ps_id = $this->session->userdata("UsPsCode");
            //$data['table'] = $this->load->view('ffm/frontend/ui_celender',true);
            $this->load->model('hr/M_hr_person_detail','psd');
            $this->psd->psd_ps_id = $ps_id;
            $this->psd->get_by_key(true);
            $data['picture'] = $this->psd->psd_picture;
            $this->output_frontend('ffm/frontend/view_show',$data);
    }
    function show(){
        $this->load->model('/ffm/frontend/M_reservation','mr');
        $data['qu_mr'] = $this->mr->get_prefix()->result();
        $data['qu_fleid'] = $this->mr->get_all_field()->result();
        $ps_id = $this->session->userdata("UsPsCode");
        //$data['table'] = $this->load->view('ffm/frontend/ui_celender',true);
		$this->load->model('hr/M_hr_person_detail','psd');
		$this->psd->psd_ps_id = $ps_id;
        $this->psd->get_by_key(true);
        $data['picture'] = $this->psd->psd_picture;
        $this->output_frontend('ffm/frontend/view_show',$data);
    }

    function get_amphur_By_Id($pv_id){
        $this->load->model('/ffm/frontend/M_reservation','Ms');
        $amph = $this->Ms->get_amph($pv_id)->result();
        echo json_encode($amph);
    }

    function get_dist_By_Id($amph_id){
        $this->load->model('/ffm/frontend/M_reservation','Ms');
        $dist = $this->Ms->get_amph($amph_id)->result();
        echo json_encode($dist);
    }
    function insert_reservation_form(){
        $this->load->model('/ffm/frontend/M_reservation','Ms');
        $time = $this->input->POST('time');
        $data = $this->Ms->get_time()->result();
        
        $this->Ms->fr_start_time = 0;
        $this->Ms->fr_end_time = 0;
        $this->Ms->fr_ff_id = $this->input->POST('field');
        $this->Ms->fr_ps_id= $this->input->POST('person_id');
        $this->Ms->fr_first_name = $this->input->POST('person_name');
        $this->Ms->fr_last_name = $this->input->POST('person_lname');
        $this->Ms->fr_address = $this->input->POST('adress');
        $this->Ms->fr_moo = $this->input->POST('moo');
        $this->Ms->fr_dist_id = $this->input->POST('dist_id');
        $this->Ms->fr_amph_id = $this->input->POST('amph_id');
        $this->Ms->fr_pv_id = $this->input->POST('pv_id');
        $this->Ms->fr_tel = $this->input->POST('phone');
        $this->Ms->fr_project = $this->input->POST('project_name');
        $this->Ms->fr_start_date = getNowDate(); 
        $this->Ms->fr_end_date = getNowDate();
        $this->Ms->fr_hour = 0;
        $this->Ms->fr_minute = 0;
        $this->Ms->fr_cost = 0;
        $this->Ms->fr_status = 1;
        $this->Ms->fr_write_date = getNowDate();
        $this->Ms->fr_number = 10;
        $this->Ms->fr_fr_id = NULL;
        $this->Ms->fr_update = getNowDate();
        $this->Ms->fr_user_update = $this->session->userdata('UsID');
     
        $this->Ms->insert();
        redirect('/ffm/frontend/C_downloadpdf/export_pdf_With_Data');
    }

    
}