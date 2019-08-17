<?php

/*
*Swm_register
*Control register
*@input    -
*@output   -
*@author   Supak Pukdam
*@Update   Supak Pukdam
*@Update Date  2562-05-17
*/

if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/../../UMS_Controller.php");
class Swm_register extends  UMS_Controller
{

    public $user;

    function __construct()
    {
        parent::__construct();
    }

    /*
        * index
        * Show main menu
        * @input  -
        * @output admin menu
        * @author Supak Pukdam
        * @Update Date  2562-05-17
    */
    public function index()
    {
        $this->output('swm/backend/v_main');
    }
    /*
        *regis_table_show
        *show table contains data from user who aren't swimming pool member
        *@input -
        *@output -
        *@output code ,username,firstname,lastname
        *@author -
        *@Create Date 2562-05-17
    */
    public function regis_table_show(){
        $this->load->model('swm/backend/M_swm_user','msu');

        $data['rs_userdata'] = $this->msu->get_all_user_not_regis()->result_array();
      
        $this->output('swm/backend/register/v_regis_table_show',$data);
    }

    /*
        * regis_form_input
        * Show form register
        * @input  -
        * @output regis member form
        * @author Supak Pukdam
        * @Update Date  2562-05-17
    */
    public function regis_form_input()
    {
        $data['ps_id'] = $this->input->post('ps_id');
        $this->load->model('swm/backend/M_swm_user', 'msu');
        $this->msu->su_ps_id = $data['ps_id'];
        $data['qu_user'] = $this->msu->get_user_detail_by_psd_id()->result();

        $data['rs_prefix'] = $this->msu->get_prefix()->result_array();

        foreach ($data['qu_user'] as $key) {
            if ($key->psd_cellphone == NULL) {
                $key->psd_cellphone = "-";
            }
            if ($key->pf_name == NULL) {
                $key->pf_name = "-";
            }
            if ($key->ps_fname == NULL) {
                $key->pf_fname = "-";
            }
            if ($key->ps_lname == NULL) {
                $key->pf_lname = "-";
            }
            if ($key->psd_birthdate == NULL) {
                $key->psd_birthdate = "-";
            }
            if ($key->age == NULL) {
                $key->age = "-";
            }
        }
        $this->output('swm/backend/register/v_regis_form_input', $data);
    }

     public function insert_person()
    {
        // pre($this->input->post());
        $data['user_post'] =  $this->input->post();
        $this->load->model('swm/backend/M_swm_user', 'msu');
        $this->msu->su_ps_id = $this->input->post('ps_id');

        $data['user_ps_id'] =  $this->msu->get_user_detail_by_psd_id()->result();

        $data['exp_date'] = substr($this->input->post('reg_date'), 6);
        $data['exp_date'] = (int)$data['exp_date'] + 1;
        $data['exp_date'] = substr($this->input->post('reg_date'), 0, 6) . $data['exp_date'];

        //$this->msu->get_by_key(true);
      //  pre($data['user_post']);
    //    pre($data['user_ps_id']);
     //   pre($data['exp_date']);

        //die;

        // $time = strtotime();$this->input->post('reg_date')
        $tmp = explode("/", trim(html_entity_decode($this->input->post('reg_date'))));
        // echo $tmp."<br>";
        $data['date_id'] = substr($tmp[2], -2) . $tmp[1] . "%";
        // echo $tmp[2].':'.$tmp[1];
        // die;
        $code = $this->msu->get_last_user_id($data['date_id'])->row()->su_code;
       // echo (int)$code + 1;

        // echo "<br>".$data['user_post']['reg_prefix'];
        //die;
        $dd = explode("/", $data['exp_date']);
        $dd = ((int)$dd[2] - 543) . "-" . $dd[1] . "-" . $dd[0];
       // echo $dd;
        // die;
        $this->msu->su_code = (int)$code + 1;
        $this->msu->su_contact_pf_id = $data['user_post']['reg_prefix'];
        $this->msu->su_contact_fname = $data['user_post']['reg_ref_fname'];
        $this->msu->su_contact_lname = $data['user_post']['reg_ref_lname'];
        $this->msu->su_tel = $data['user_post']['reg_ref_tel'];
        $this->msu->su_birthday = $data['user_post']['psd_birthdate;'];
        $this->msu->su_old_state = 2;
        $this->msu->su_state = 2;
        $this->msu->su_expire_date = $dd;
        $this->msu->su_anit_cost = '500';
        $this->msu->su_workplaceu_id = "";
        $this->msu->su_work = $data['user_post']['reg_job'];
        $this->msu->su_ps_id = $data['user_post']['ps_id'];
        $this->msu->su_tel_contact = $data['user_post']['reg_ref_tel'];;

        //$this->msu->swm->trans_begin();
        // $this->msu->insert();   <-------------------------------
        //echo '<br>' . $this->msu->last_insert_id;
        //$this->msu->swm->trans_rollback();
        $this->msu->insert();
        $this->r_pdf($data['user_post'],$data['user_ps_id'],$data['exp_date']);
        /*$this->msu->su_workplace .= "xx";*/
        
        //$this->index();
        
    }

    public function r_pdf($user_post,$user_ps_id,$exp_date)
    {

        // echo "<h1>check</h1>";

        $data['user_post'] = $user_post;
        $data['user_ps_id'] = $user_ps_id[0];
        $data['exp'] = $exp_date;
        //pre($data['user_ps_id']);
        //die;
        //$this->loadview('swm/backend/register/v_regis_form_new', $data,true);

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);

        $mpdf->useAdobeCJK = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        // Write some HTML code:
        //$this->load->view('swm/backend/register/v_pdf', $data);
        //die;
        // $this->load->view('swm/backend/register/v_pdf', $data);

        $this->load->model('swm/backend/M_swm_user', 'msu');
        $data['qu_user'] = $this->msu->get_profile($data['user_ps_id']->ps_id);
        // pre($this->msu->swm->last_query());
        // pre($data['qu_user']);
        // $data['tt'] = $this->msu->swm->last_query();
        //pre($data['qu_user']);
        //die;
        $mpdf->WriteHTML($this->load->view('swm/backend/register/v_pdf', $data,TRUE));

        // Output a PDF file directly to the browser
        $mpdf->Output();
    }
}
