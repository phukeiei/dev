<?php
/*
* Swm_status
* Control Status
* @input    -
* @output   id,name,lastname,age
* @author   Kanathip Phithaskilp
* @Update   Kanathip Phithaskilp
* @Update Date  2562-5-17
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/../../UMS_Controller.php");

class Swm_status extends  UMS_Controller
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
    * Show main menu
    * @input  -
    * @output -
    * @author Kanathip Phithaskilp
    * @Create Date 2562-5-17
    */
    public function index()
    {
    
        $data['user'] = $this->user;
        $this->output_fancy('swm/backend/manage_member/v_edit_status', $data);
    }
    /*
    * showstatus
    * show status all member 
    * @input -
    * @output id,name,lname,age
    * @author Kanathip Phithaskilp
    * @Create Date 2562-5-17
    */
    public function show_status() //show status all member
    {
        $data['status'] = $this->get_all_member();
        $this->output('swm/backend/manage_member/v_show_status', $data);
    }
    /*
    * showstatus
    * show form edit status
    * @input -
    * @output -
    * @author Kanathip Phithaskilp
    * @Create Date 2562-5-17
    */
    public function get_status()
    {
        $this->load->model('swm/backend/M_swm_status','status');
        return $this->status->get_status();
    }
    public function edit_status() //editstatus
    {
        $this->load->model('swm/backend/M_swm_status','status');
        $id['id'] = $this->input->POST('id');
        $data['sta'] = $this->status->get_id($id);
        $data['status'] = $this->get_status();
        $this->output('swm/backend/manage_member/v_edit_status',$data); //showeditstatus    

    }
    public function get_all_member()
    {
        $this->load->model('swm/backend/M_swm_status','status');
        return $this->status->get_all_member();
    }
    public function set_status()
    {
        $this->load->model('swm/backend/M_swm_status','status');
        $data = array(
                
            "id" => $this->input->POST('id'),
            "sta" => $this->input->POST('status'),
            "comment" => $this->input->POST('comment')
        );
        $this->status->set_status($data);
        $this->status->comment($data);
        $this->show_status();
    }
}
