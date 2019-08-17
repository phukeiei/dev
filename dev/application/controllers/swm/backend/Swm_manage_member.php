<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/../../UMS_Controller.php");
class Swm_manage_member extends  UMS_Controller
{

    public $user;

    function __construct()
    {
        parent::__construct();
        $this->user = $this->session->userdata();   
    }
    function index()
    {
        $this->output('swm/backend/manage_member/v_manage_member');
    }

    public function member_table_show()
    {
        $this->load->model('swm/backend/M_swm_user', 'msu');
        $data['rs_userdata'] = $this->msu->get_all_user_swm()->result();

        foreach ($data['rs_userdata'] as $key) {
            if ($key->ps_fname == NULL) {
                $key->ps_fname = "-";
            }
            if ($key->ps_lname == NULL) {
                $key->ps_lname = "-";
            }
            if ($key->ss_name == NULL) {
                $key->ss_name = "-";
            }
        }
        $this->output('swm/backend/manage_member/v_member_table_show', $data);
    }
    public function member_data_show($ps){
        $this->load->model('swm/backend/M_swm_user','msu');
        $id = $ps;
        $data['show'] = $this->msu->get_profile($id);
       
        $this->output('/swm/backend/manage_member/v_member_data_show',$data);
    }
    public function member_data_edit($su_ps)
    {
        $this->load->model('swm/backend/M_swm_user','msu');
        $id = $su_ps;   
        $data['show'] = $this->msu->get_profile($id);
        $this->output('/swm/backend/manage_member/v_member_data_edit', $data);
    }
    public function member_data_update()
    {
        $this->load->model('swm/backend/M_swm_user','msu');
        $check = array(
                "id"=>$this->input->post('checkid'),
                "job" =>$this->input->post('cjob'),
                "fname" =>$this->input->post('cfname'),
                "lname" =>$this->input->post('clname'),
                "tel" =>$this->input->post('ctel')
        );
        $this->msu->update_swm($check);
        $this->member_table_show();  
    }


}
