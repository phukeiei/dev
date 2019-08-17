<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../../UMS_Controller.php");

class C_reservation extends  UMS_Controller{
	function __construct(){
        parent::__construct();  
    }
    function Export_reservation_form(){
        $this->load->model('/ffm/fontend/M_reservation','Ms');
        $data['rs_Ms'] = $this->Ms->get_by_code($this->session->userdata('UsPsCode'))->row();
        $data['qu_Ms'] = $this->Ms->get_all_field()->result();
        $data['time'] = $this->Ms->get_time()->result();
        $this->output_frontend('/ffm/fontend/ffm_reservation_form',$data);
    }

    function Export_reservation_form_non_member(){
        $this->load->model('/ffm/fontend/M_reservation','Ms');
        $data['qu_Ms'] = $this->Ms->get_pv()->result();
        $this->output_frontend('/ffm/fontend/ffm_reservation_form_non_member',$data);
    }

    function get_amphur_By_Id($pv_id){
        $this->load->model('/ffm/fontend/M_reservation','Ms');
        $amph = $this->Ms->get_amph($pv_id)->result();
        echo json_encode($amph);
    }

    function get_dist_By_Id($amph_id){
        $this->load->model('/ffm/fontend/M_reservation','Ms');
        $dist = $this->Ms->get_amph($amph_id)->result();
        echo json_encode($dist);
    }
    function insert_reservation_form(){
        $this->load->model('/ffm/fontend/M_reservation','Ms');
        $time = $this->input->POST('time');
        $data = $this->Ms->get_time()->result();
            foreach($data as $row){
                if($row->cc_id == $data){
                    $this->Ms->fr_start_time = $row->cc_start_time;
                    $this->Ms->fr_end_time = $row->cc_end_time;
                }
            }
        $this->Ms->fr_start_time = 0;
        $this->Ms->fr_end_time = 0;
        $this->Ms->fr_ff_id = $this->input->POST('field');
        $this->Ms->fr_ps_id= $this->input->POST('person_id');
        $this->Ms->fr_first_name = $this->input->POST('person_name');
        $this->Ms->fr_last_name = $this->input->POST('person_lname');
        $this->Ms->fr_address = $this->input->POST('adress');
        $this->Ms->fr_moo = 0;
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
        redirect('/ffm/fontend/C_downloadpdf/export_pdf_With_Data');
    }
}