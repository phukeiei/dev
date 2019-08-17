<?php 
/*
* Swm_member_config
* Control member config
* @input    id,age,total
* @output   id,age,total
* @author   Kanyarat Rodtong
* @Update   Kanyarat Rodtong
* @Update Date  2562-5-17
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../../UMS_Controller.php");

class Swm_price_config extends  UMS_Controller{

    public $user;
	function __construct(){
        parent::__construct();
        $this->user = $this->session->userdata();
        //$this->swm = $this->load->database('swm',ture);      
    }
  /*
    * index
    * show menu member config
    * @input    id,age,total
    * @output   id,age,total
    * @author   Kanyarat Rodtong
    * @Update   Kanyarat Rodtong
    * @Update Date  2562-5-17
    * @Create Date  2562-5-18
 */
    function index()
    {
        $this->output('swm/backend/price_config/v_price_config');
    }
 /*
    * member config
    * show  member config
    * @input    id,age,total
    * @output   id,age,total
    * @author   Kanyarat Rodtong
    * @Update   Kanyarat Rodtong
    * @Update Date  2562-5-17
    * @Create Date  2562-5-18
 */
    function register_price_config()
    {
        $this->output('swm/backend/price_config/v_register_price_config');
    }
    //ราคาสระ
    function user_price_config()
    {

        $this->load->model('swm/backend/M_swm_cost_pool', 'mcp');
        $mcp = $this->mcp;
        $data['rs_cost_pool'] = $mcp->get_cost_pool_detail()->result();
        $data['rs_cost_pool_nonmember'] = $mcp->get_cost_pool_detail_nonmember()->result();

        $data['tmp_arr'] = array();
        $data['tmp_arr_nonmember'] = array();

        foreach($data['rs_cost_pool'] as $row){	

            $data['tmp_arr'][$row->scp_reference][] = $row;
            if($row->scp_age_min == 0){
                $row->scp_age_min = "อายุต่ำกว่า 18 ปี";
            }
            else if($row->scp_age_min == 18){
                $row->scp_age_min = "อายุ 1 8 ปีขึ้นไป";
            }
        }

        foreach($data['rs_cost_pool_nonmember'] as $row){	

            $data['tmp_arr_nonmember'][$row->scp_reference][] = $row;
            if($row->scp_age_min == 0){
                $row->scp_age_min = "อายุต่ำกว่า 18 ปี";
            }
            else if($row->scp_age_min == 18){
                $row->scp_age_min = "อายุ 1 8 ปีขึ้นไป";
            }
        }

        //pre($data['tmp_arr']);
        $this->output('swm/backend/price_config/v_user_price_config',$data);

    }

    
    function user_price_config_change_ajax()
    {
        $scp_reference = $this->input->post('scp_reference');

        //echo $scp_reference;

        $this->load->model('swm/backend/M_swm_cost_pool', 'mcp');
        $mcp = $this->mcp;

        $mcp->scp_reference = $scp_reference;

        $mcp->update_cost_pool();

        echo json_encode($scp_reference);

    }

    function user_price_config_change_active_ajax()
    {
        $scp_sug_id = $this->input->post('scp_sug_id');

        $this->load->model('swm/backend/M_swm_cost_pool', 'mcp');
        $mcp = $this->mcp;

        $mcp->scp_sug_id = $scp_sug_id;

        $mcp->update_cost_pool_active();

        echo json_encode($scp_sug_id);

    }

    function user_config_insert()
    {
        $age_member_min = $this->input->post('age_member_min');
        $age_member_max = $this->input->post('age_member_max');
        $member_total = $this->input->post('member_total');

        $age_nonmember_min = $this->input->post('age_nonmember_min');
        $age_nonmember_max = $this->input->post('age_nonmember_max');
        $nonmember_total = $this->input->post('nonmember_total');

        echo "--- สมาชิก ---"."<br>";
        echo "อายุน้อย"."<br>";
        echo $age_member_min."<br>";
        echo $age_member_max."<br>";
        echo $member_total."<br>";
        echo "อายุเยอะ"."<br>";
        echo $age_nonmember_min."<br>";
        echo $age_nonmember_max."<br>";
        echo $nonmember_total."<br>";

        $scp_sug_id = 2;

        $this->load->model('swm/backend/M_swm_cost_pool', 'mcp');
        $mcp = $this->mcp;

        $mcp->scp_sug_id = $scp_sug_id;
        $data['rs_scp_reference'] = $mcp->search_scp_reference()->result();

        //pre($data['rs_scp_reference']);

        // foreach ($data['rs_scp_reference'] as $key ) {
        //     if( $key->scp_reference ){

        //     }
        // }
        // $num = 0;
        // for ($i=0; $i < count($data['rs_scp_reference']) ; $i++) { 
        //     if($i==0) {
        //         $num = $data['rs_scp_reference'][$i];
        //     }
        // }

        // echo $num;



        // $this->load->model('swm/Da_swm_cost_pool', 'dcp');
        // $dcp = $this->dcp;

        // $dcp->scp_age_min = $age_member_min;
        // $dcp->scp_age_max = $age_member_max;
        // $dcp->scp_cost = $member_total;
        
        // $dcp->scp_sug_id = $member_total;
        // $dcp->scp_reference = $age_member_min;
        // $dcp->scp_is_active = $age_member_min;
        // $dcp->scp_create_date = $age_member_min;
        // $dcp->scp_update_date = $age_member_min;
    }


}