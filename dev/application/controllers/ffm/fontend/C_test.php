<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../../UMS_Controller.php");

class C_test extends  UMS_Controller{
	function __construct(){
        parent::__construct();  
    }
    function show(){
        $this->load->model('/ffm/fontend/M_reservation','mr');
        $data['qu_mr'] = $this->mr->get_prefix()->result();
        $data['qu_fleid'] = $this->mr->get_all_field()->result();
        $this->output_frontend('ffm/fontend/view_show',$data);
    }
    function show2(){
        $this->load->model('/ffm/fontend/M_reservation','mr');
        $data['qu_mr'] = $this->mr->get_By_fleid()->result();
        $this->output_frontend('ffm/fontend/ui_celender',$data);
    }

    function get(){
        $this->load->model('/ffm/fontend/M_reservation','mr');
        $data  = $this->mr->get_By_fleid()->result();
        echo Json_encode($data);
    }
    

    function get_address(){
        if(trim($this->input->post('q')) == ""){
            echo "test";
        }

        //$this->load->model($this->config->item("hr_dir").'m_hr_district', 'mdt');
        $this->load->model('ffm/fontend/for_test/M_complain_font','mdt');

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

    function get_football_field()
    {
        
    }
    
}