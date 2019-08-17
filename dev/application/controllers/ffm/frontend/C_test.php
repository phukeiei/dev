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
		
        if($this->session->userdata("UsPsCode") !== null){
            $this->load->model('hr/M_hr_person_detail','psd');
            $this->psd->psd_ps_id = $ps_id;
            $this->psd->get_by_key(true);
            $data['picture'] = $this->psd->psd_picture;
        }
        else{
            $data['picture'] = "";
        }
        $this->output_frontend('ffm/frontend/view_show',$data);
    }
    function show2(){
		$this->output_frontend('ffm/frontend/ui_celender',$data);
    }

    function get(){
		$this->load->model('/ffm/frontend/M_reservation','mr');
        $data  = $this->mr->get_By_fleid($this->input->post("fr_ff_id"))->result();
        echo Json_encode($data);
    }
    function get_by_id(){
		$this->load->model('/ffm/frontend/M_reservation','mr');
        $data  = $this->mr->get_By_fleid_by_id($this->input->post("ff_id"))->result();
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
        $this->Ms->pf_id = $this->input->POST('quantity');             
        $this->Ms->fr_start_time = $this->input->POST('time_start');  
        $this->Ms->fr_end_time = $this->input->POST('time_end');  
        $this->Ms->fr_ff_id= $this->input->POST('field');  
        $this->Ms->fr_ps_id = null;  
		if($this->session->userdata('UsPsCode') != null){
			 $this->Ms->fr_ps_id = $this->session->userdata('UsPsCode');
		}
        $this->Ms->fr_first_name = $this->input->POST('fname');  
        $this->Ms->fr_last_name = $this->input->POST('lname');  
        $this->Ms->fr_address = $this->input->POST('adress');  
        $this->Ms->fr_moo = $this->input->POST('moo');  
        $this->Ms->fr_dist_id = $this->input->POST('dist_id');  
        $this->Ms->fr_amph_id = $this->input->POST('amph_id');  
        $this->Ms->fr_pv_id = $this->input->POST('pv_id');  
        $this->Ms->fr_tel = $this->input->POST('phone');  
        $this->Ms->fr_project = $this->input->POST('project');
		$date1 = explode('/', $this->input->POST('date1'));
        $this->Ms->fr_start_date = ($date1[2]-543)."-".$date1[1]."-".$date1[0];    
		$date2 = explode('/', $this->input->POST('date2'));
        $this->Ms->fr_end_date = ($date2[2]-543)."-".$date2[1]."-".$date2[0];  
        $this->Ms->fr_hour = 0;
        $this->Ms->fr_minute = 0;
        $this->Ms->fr_cost = $this->input->POST('price');
        $this->Ms->fr_status = 5;
        $this->Ms->fr_write_date = getNowDate();
        $this->Ms->fr_number = $this->input->POST('total');  ;
        $this->Ms->fr_fr_id = NULL;
        $this->Ms->fr_update = getNowDate();
        $this->Ms->fr_user_update= "0";
		if($this->session->userdata('UsPsCode') != null){
            $this->Ms->fr_user_update = $this->session->userdata('UsPsCode');
       }
        $this->Ms->insert();
        echo $this->Ms->last_insert_id;
        $this->load->model('/ffm/M_cost_detail','Cd');   
        $this->Cd->cd_seq = "1";
        $this->Cd->cd_start_time = $this->input->POST('time_start');
        $this->Cd->cd_end_time = $this->input->POST('time_end');
        $this->Cd->cd_fr_id = $this->Ms->last_insert_id;
		$date1 = explode(':', $this->input->POST('time_start'));   
		$date2 = explode(':', $this->input->POST('time_end'));
        $this->Cd->cd_hour = $date2[0]-$date1[0];
        $this->Cd->cd_minute = "0";
        $this->Cd->cd_cost = $this->input->POST('price');
        $this->Cd->cd_update = getNowDate();
        $this->Cd->cd_user_update= "0";
		if($this->session->userdata('UsPsCode') != null){
            $this->Cd->cd_user_update = $this->session->userdata('UsPsCode');
       }
        $this->Cd->insert();
		
    }
    function Export_v_from(){
        
               
        $this->output_frontend('ffm/frontend/v_show_from');
        
    }

}