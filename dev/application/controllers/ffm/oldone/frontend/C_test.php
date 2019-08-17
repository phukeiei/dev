<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../Ffm_Controller.php");

class C_test extends  Ffm_Controller{
	function __construct(){
        parent::__construct();  
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
    function show2(){
        $this->load->model('/ffm/frontend/M_reservation','mr');
        $data['qu_mr'] = $this->mr->get_By_fleid(10)->result();
        $this->output_frontend('ffm/frontend/ui_celender',$data);
    }

    function get(){
		$this->load->model('/ffm/frontend/M_reservation','mr');
        $data  = $this->mr->get_By_fleid($this->input->post("fr_ff_id"))->result();
        echo Json_encode($data);
    }

    function get_all(){
		$this->load->model('/ffm/frontend/M_reservation','mr');
        $data  = $this->mr->get_By_fleid_all()->result();
        echo Json_encode($data);
    }
    

    function get_address(){
        if(trim($this->input->post('q')) == ""){
            echo "test";
        }

        //$this->load->model($this->config->item("hr_dir").'m_hr_district', 'mdt');
        $this->load->model('ffm/frontend/for_test/M_complain_font','mdt');

        $arr = array();
        $rs_address = $this->mdt->get_address($this->input->post('q'));
        if($rs_address->num_rows() > 0){
            foreach($rs_address->result() as $key => $row){
                $arr[$key]["dist_id"] = $row->dist_id;
                $arr[$key]["dist_name"] = $row->dist_name;
                $arr[$key]["name"] = "อ.".$row->amph_name." จ.".$row->pv_name;
                $arr[$key]["amph_name"] = $row->amph_name;
                $arr[$key]["amph_id"] = $row->amph_id;
                $arr[$key]["pv_id"] = $row->pv_id;
                $arr[$key]["pv_name"] = $row->pv_name;
                $arr[$key]["dist_pos_code"] = $row->dist_pos_code;
            }
            echo json_encode($arr);
        }
    }

    function insert_reservation_form(){
        $this->load->model('/ffm/frontend/M_reservation','Ms');        
        $this->Ms->pf_id = $this->input->POST('prefix');             
        $this->Ms->fr_start_time = 00;
        $this->Ms->fr_end_time = 00;
        $this->Ms->fr_ff_id = $this->input->POST('field');
        $this->Ms->fr_ps_id= NULL;
        $this->Ms->fr_first_name = $this->input->POST('fname');
        $this->Ms->fr_last_name = $this->input->POST('lname');
        $this->Ms->fr_address = $this->input->POST('adress');
        $this->Ms->fr_moo = $this->input->POST('moo');
        $this->Ms->fr_dist_id = $this->input->POST('dist_id');
        $this->Ms->fr_amph_id = $this->input->POST('amph_id');
        $this->Ms->fr_pv_id = $this->input->POST('pv_id');
        $this->Ms->fr_tel = $this->input->POST('phone');
        $this->Ms->fr_project = $this->input->POST('project');
        $this->Ms->fr_start_date = $this->input->POST('date1'); 
        $this->Ms->fr_end_date = $this->input->POST('date2');
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
    function Export_v_from(){
        
               
        $this->output_frontend('ffm/frontend/v_show_from');
        
    }

}