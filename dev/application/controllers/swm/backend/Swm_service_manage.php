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

if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/../../UMS_Controller.php");

class Swm_service_manage extends  UMS_Controller
{

    public $user;
    function __construct()
    {
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
        $this->output('swm/backend/service_manage/v_service_manage');
    }

    function insert(){
        $sa_su_id = $this->input->post("su_id");
        $sa_scp_id = $this->input->post("scp_id");
        $sa_real_cost = $this->input->post("cost");
        $sa_time = $this->input->post("time");
        $sa_create_date = $this->input->post("date");

        $this->load->model('swm/backend/M_swm_attend', 'msa');
        $this->msa->sa_su_id = $sa_su_id;
        $this->msa->sa_scp_id = $sa_scp_id;
        $this->msa->sa_real_cost = $sa_real_cost;
        $this->msa->sa_time = $sa_time;
        $this->msa->sa_create_date = $sa_create_date;

        $this->msa->insert();

        redirect(site_url('/swm/backend/Swm_service_manage'));
    }
    /*
    * search_member
    * search member
    * @input    memid
    * @output   memdata
    * @author   Kanyarat Rodtong
    * @Update   Kanyarat Rodtong
    * @Update Date  2562-5-17
    * @Create Date  2562-5-18
    */
    function search_member()
    {
        $memid = $this->input->post("memid");

        $this->load->model('swm/backend/M_swm_user', 'msu');
        $this->msu->su_code = $memid;
        $rs_msu = $this->msu->search()->row();

        echo json_encode($rs_msu);
    }

    /*
    * search_member
    * search member
    * @input    memid
    * @output   memdata
    * @author   Kanyarat Rodtong
    * @Update   Kanyarat Rodtong
    * @Update Date  2562-5-17
    * @Create Date  2562-5-18
    */
    function get_cost()
    {
        // 1 is not member , 2 is member
        $isMember = $this->input->post("isMember");
        $ages = $this->input->post("ages");

        $this->load->model('swm/backend/M_swm_cost_pool', 'mscp');
        $this->mscp->ages = $ages;
        $this->mscp->user_group = $isMember;
        $rs_mscp = $this->mscp->search()->row();

        echo json_encode($rs_mscp);
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
 
    function member_config()
    {
        $this->output('swm/backend/v_member_config');
    }
*/
}
