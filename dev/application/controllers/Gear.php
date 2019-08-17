<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('UMS_Controller.php');

class Gear extends UMS_Controller
{
    /* version 1.7 update 11/03/2557 */
    public function __construct()
    {
        parent::__construct();
		if($this->checkUser()){
			$this->load->model('UMS/m_umuser');
			$this->load->model('UMS/m_umusergroup');
			$this->load->model('UMS/m_umsystem');
			$this->load->model('UMS/m_umlog');
		}
    }

    public function index()
    {
        // remove old session off this system
        //$this->session->unset_userdata('GpID');
        //$this->session->unset_userdata('StID');

        $this->session->unset_userdata('HOME');
        $this->session->unset_userdata('URL');
        $this->session->unset_userdata('MnID');
        $this->session->unset_userdata('MnURL');
        $this->session->unset_userdata('MnNameT');
        $this->session->unset_userdata('SysName');
        if ($this->checkUser()) {// Have Session data
            $data['permission'] = $this->m_umusergroup->get_gear()->result_array();
            $data['system'] = $this->m_umusergroup->get_system()->result_array();
            // $data['permission_old'] = $this->m_umusergroup->get_gear_old()->result_array(); //ums เก่า
            // $data['system_old'] = $this->m_umusergroup->get_system_old()->result_array(); //ums เก่า
            /*$date = array();
            foreach($data['system'] as $system){
                $data['temp'] = $system['GpIcon'];
                $this->m_umicon->IcName = $data['temp'];
                $temp = $this->m_umicon->get_date_by_name()->result_array();
            }
            }*/
            $data['save'] = explode("?", get_cookie('gear' . $this->session->userdata('UsID')));
            //$data['save'] = explode("?",$this->session->userdata('save')); old version get savedata from session
            /*foreach($data['save'] as $loop)
            {
                echo $loop;
            } for debugging*/


            // pre($this->session->userdata());
            // echo current_url();
            // die;
            if ($this->session->userdata('UsTypeTmp') == 1) {
                //frontend new tempalte
                // $this->output_frontend($url,$data);

                $url = "";
                if ($this->session->userdata('current_url') != "") {
                    $url = $this->session->userdata('current_url');
                    redirect($url, 'refresh');
                } else {
                    $sys_query = "SELECT * FROM umsystem WHERE StID NOT IN (1) ORDER BY StID ASC";
					$data['rs_sys'] = $this->db->query($sys_query)->result();
					$data['use_slide'] = true;
					$this->output_frontend('front/v_home', $data);
                }

            } else {
                //old template
                $this->output('Gear/Gear', $data);
            }

        } else {
            $this->login();
            //redirect('https://'.base_url().'/index.php/gear/login','refresh');
        }
    }

    public function login()
    {
        force_ssl();

         $sys_query = "SELECT * FROM umsystem WHERE StID NOT IN (1) ORDER BY StID ASC";
//        $sys_query = "SELECT * FROM umsystem  ORDER BY StID ASC";
        $data['rs_sys'] = $this->db->query($sys_query)->result();

//        $this->load->view('Gear/material-login', $data);
        $data['use_slide'] = true;
        if($this->session->flashdata('after_regis')){
            $data['scripts'] = '$(document).ready(function(){
                $(\'#noticeModal\').modal(\'show\')
            })';
        }
        
        $sys_query = "SELECT * FROM umsystem WHERE StID NOT IN (1) ORDER BY StID ASC";
		$data['rs_sys'] = $this->db->query($sys_query)->result();
		$data['use_slide'] = true;
		$this->output_frontend('front/v_home', $data);
        //$this->output_frontend('Gear/material-login',$data);
    }


    public function login_admin()
    {

        force_ssl();
        $this->load->view('Gear/extras-login');

    }

    public function switch_template($type = "")
    {
        if ($type == 1) {
            $this->session->set_userdata('UsTypeTmp', 1);
            $this->session->set_userdata('current_url', "");
        } else {
            $this->session->set_userdata('UsTypeTmp', "");
            $this->session->set_userdata('current_url', "");
        }
        // $this->session->unset_userdata('UsTypeTmp');
        // $this->session->unset_userdata('current_url');


        redirect('gear', 'refresh');
    }

    function checklogin()
    {
		$this->load->model('UMS/m_umuser');
		$this->load->model('UMS/m_umusergroup');
		$this->load->model('UMS/m_umsystem');
		$this->load->model('UMS/m_umlog');
		$username = $this->input->post('username');
		$password = md5("O]O".$this->input->post('password')."O[O");

		// some logic with MD5 to query
		$user = $this->m_umuser->check_login($username,$password);
        // some logic with MD5 to query
        // $user = $this->m_umuser->check_login($_POST['username'], md5("O]O" . $_POST['password'] . "O[O"));
        // check it can log in ?
        if (!$user) {
            if ($this->config->item('ldap_on') == "on") {
                $this->load->library('service_ldap');
                $this->service_ldap->connect();
                if ($this->service_ldap->authenticate($_POST['username'], $_POST['password'])) {
                    $user = $this->m_umuser->check_user($_POST['username']);
                    if (!$user) {
                        $this->m_umlog->loginfailed();
                    } else {
                        $usr = $user->row_array();
                        $this->session->set_userdata('UsID', $usr['UsID']);
                        $this->session->set_userdata('UsPsCode', $usr['UsPsCode']);
                        $this->session->set_userdata('UsLogin', $usr['UsLogin']);
                        $this->session->set_userdata('UsDpID', $usr['UsDpID']);
                        $this->session->set_userdata('UsName', $usr['UsName']);
                        $this->session->set_userdata('dpName', $usr['dpName']);
                        $this->session->set_userdata('UsWgID', $usr['UsWgID']);
                        $this->session->set_userdata('UsAdmin', $usr['UsAdmin']);
                        $this->session->set_userdata('logged_in', TRUE);
                        $this->m_umlog->login();
                    }
                } else {
                    // when log in fail it have 2 case
                    // If it has user but password wrong
                    $user = $this->m_umuser->check_user($_POST['username']);
                    if ($user) {
                        foreach ($user->result_array() as $usr) {
                            $this->m_umlog->wrongpass($usr['UsID']);
                            break;
                        }

                    } // or It don't have Account
                    else {    //
                        $this->m_umlog->loginfailed();
                    }
                }
                $this->service_ldap->close();
            } else {
                // when log in fail it have 2 case
                // If it has user but password wrong
                $user = $this->m_umuser->check_user($_POST['username']);

                if ($user) {
                    foreach ($user->result_array() as $usr) {
                        $this->m_umlog->wrongpass($usr['UsID']);
                        break;
                    }
                } // or It don't have Account
                else {    //
                    $this->m_umlog->loginfailed();
                }
            }
        } else {
            // echo "dddd";die;
            // create a session to log in this main system
            foreach ($user->result_array() as $usr) {
                $this->session->set_userdata('UsID', $usr['UsID']);
                $this->session->set_userdata('UsPsCode', $usr['UsPsCode']);
                $this->session->set_userdata('UsLogin', $usr['UsLogin']);
                $this->session->set_userdata('UsDpID', $usr['UsDpID']);
                $this->session->set_userdata('UsName', $usr['UsName']);
                $this->session->set_userdata('dpName', $usr['dpName']);
                $this->session->set_userdata('UsWgID', $usr['UsWgID']);
                $this->session->set_userdata('UsAdmin', $usr['UsAdmin']);
                $this->session->set_userdata('UsTypeTmp', $this->input->post('type_view'));
                $this->session->set_userdata('current_url', $this->input->post('type_url'));
                $this->session->set_userdata('logged_in', TRUE);
                $this->m_umlog->login();
                break;
            }
        }
        /*if ($_POST['username'] == $_POST['password']) {
            redirect('user/CheckPassChange', 'refresh');
        }*/

        redirect('gear', 'refresh');
    }

    function setGear($StID, $GpID, $URL)
    {    // remove old session off this system
        //$this->session->unset_userdata('GpID');
        //$this->session->unset_userdata('StID');
        //this->create session to set menu is this user have accessable						try this if want to check session echo $StID and echo $GpID;
        $this->session->set_userdata('GpID', $GpID);
        $this->session->set_userdata('StID', $StID);

        // logging
        $GpName = $this->m_umgroup->get_name($GpID);
        $this->session->set_userdata('GpName', $GpName);
        $Sys = $this->m_umsystem->get_sys($StID);
        $URL = str_replace(".", "/", $URL);
        //echo $URL;die;
        $this->session->set_userdata('HOME', $URL);
        $this->session->set_userdata('SysName', $Sys['StAbbrE']);
        $this->m_umlog->getgear($GpName, $Sys['StNameT']);

        //This use input type hidden to post Link of that System to go to it
        redirect($URL, 'refresh');

    }

    function saveGear()
    {
        /*if($this->session->userdata('save')) for old version get save data from session
        {
            $this->session->unset_userdata('save');
        }
        $this->session->set_userdata('save',$this->input->post('contents',TRUE));*/
        delete_cookie('gear' . $this->session->userdata('UsID'));
        set_cookie('gear' . $this->session->userdata('UsID'), $this->input->post('contents', TRUE), 60 * 60 * 24 * 90);
    }

    function logout()
    {
        $this->m_umlog->logout();
        $this->session->unset_userdata('HOME');
        $this->session->unset_userdata('URL');
        $this->session->unset_userdata('MnID');
        $this->session->unset_userdata('MnURL');
        $this->session->unset_userdata('MnNameT');
        $this->session->unset_userdata('UsID');
        $this->session->unset_userdata('GpID');
        $this->session->unset_userdata('StID');
        $this->session->unset_userdata('UsPsCode');
        $this->session->unset_userdata('UsLogin');
        $this->session->unset_userdata('SysName');
        $this->session->unset_userdata('UsName');
        $this->session->unset_userdata('dpName');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('GpName');
        $this->session->unset_userdata('UsWgID');
        $this->session->unset_userdata('UsAdmin');
        redirect('gear', 'refresh');

    }

    function changelang($oldurl)
    {

        if ($this->session->userdata('Language') == "TH") {
            $this->session->set_userdata('Language', "EN");
        } else if ($this->session->userdata('Language') == "EN") {
            $this->session->set_userdata('Language', "TH");
        }
        redirect(str_replace("..", "/", $oldurl), 'refresh');
    }

    function error()
    {
        $this->output('error');
    }

    /**
     * @author jirayus arbking, nattaphol b.
     * @date 10/05/2562
     * @description
     */
    function register()
    {
        $this->input->post('name');
        $this->input->post('username');
        $this->input->post('password');
        // UMS
        // HR

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Username', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        if ($this->form_validation->run() == FALSE)
        {
            echo "fail";
            echo validation_errors();
            
        }
        else
        {
            $name = $this->input->post('name');
            $lname = '';
            // print_r($name);
            $exp_name = explode(' ',$name);
            if(count($exp_name)>1){
                $name = $exp_name[0];
                $lname = $exp_name[1];
            }
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $hr_db = $this->load->database('hr',TRUE);
            $array_property = array('ps_id' => '',
            'ps_pf_id' => null,'ps_fname' => $name,'ps_lname' => $lname,'ps_fname_en' => '','ps_lname_en' => '','ps_nickname' => '','ps_nickname_en' => '','ps_pos_id' => null,'ps_hire_id' => null,'ps_dept_id' => null,'ps_dept_teach_id' => NULL,'ps_admin_id' => null,'ps_admin_teach_id' => NULL,'ps_mjt_id' => null,'ps_code' => null,'ps_salary' => null,'ps_start_date' => date('Y-m-d'),'ps_retire' => null,'ps_status' => '1','ps_out_date' => '0000-00-00','ps_user_update' => null);
            $hr_db->trans_begin();
            $hr_db->insert('hr_person', $array_property);
            $last_hr_id = $hr_db->insert_id();
            $hr_db->insert('hr_person_detail', array('psd_ps_id'=>$last_hr_id)); 
            // $hr_d;
            if($hr_db->trans_status() === false)
            {
                $hr_db->trans_rollback();
                // echo 'hr trans_status false';
                $this->output('error');
            }
            else{
                // echo 'hr trans_status true';
                if($last_hr_id)
                {
                    $this->load->model('UMS/m_umuser');

                    $this->m_umuser->UsID = "";
                    $this->m_umuser->UsPsCode = $last_hr_id;//$this->input->post('UsPsCode');
                    $this->m_umuser->UsName = $name;//$this->input->post('UsName');
                    $this->m_umuser->UsWgID = 12;//$this->input->post('UsWgID');
                    $this->m_umuser->UsLogin = $username;//$this->input->post('UsLogin');
                    $this->m_umuser->UsPassword = md5("O]O".$password."O[O");
                    $this->m_umuser->UsQsID = '';
                    $this->m_umuser->UsDpID = 1;
                    $this->m_umuser->UsAnswer = '';
                    $this->m_umuser->UsEmail = '';
                    $this->m_umuser->UsDesc = '';
                    $this->m_umuser->UsActive = 1;
                    $this->m_umuser->UsAdmin = '';
                    $this->m_umuser->UsPwdExpDt = 0;
                    $this->m_umuser->UsUpdDt = 0;
                    $this->m_umuser->UsUpdUsID = 0;
                    $this->m_umuser->UsSessionID = 0;
                    $this->m_umuser->db->trans_begin();
                    $this->m_umuser->insert();
                    $last_ums_id = $this->m_umuser->last_insert_id;
                    if($this->m_umuser->db->trans_status() === false)
                    {
                        $this->m_umuser->db->trans_rollback();
                        $hr_db->trans_rollback();
                        echo 'um trans_status false';
                        $this->output('error');
                    }
                    else{
                        $this->m_umuser->db->trans_commit();
                        $hr_db->trans_commit();
                        $this->session->set_flashdata('after_regis', true);

                    }
                }
            }
        }
        redirect('Gear/index','refresh');
        
    }

    /**
     * @author jirayus arbking
     * @date 10/05/2562
     */
    function update_profile()
    {
        $data['header_title'] = "About";
        $data['header_description'] = "ข้อมูลส่วนตัว";

        $data['scripts'] = $this->load->view('front/v_about_js','',true);
        $data['styles'] = "  ";
        $data['chk_user'] = $this->checkUser();
        if($data['chk_user']){
            $usID = $this->session->userdata('UsID');
            
            $um_db = $this->load->database('ums',TRUE);
            $um_db->select('*');
            $um_db->from('umuser');
            $um_db->join('ossd_hrdb.hr_person','usPsCode = ps_id','inner');
            $um_db->join('ossd_hrdb.hr_person_detail','psd_ps_id = ps_id','inner');
            $um_db->join('ossd_hrdb.hr_prefix','ps_pf_id = pf_id','left');
            $um_db->where('usID',$usID);
            $tmp = $um_db->get()->row();       
            $data['arr_user'] = array(
                'us_name' => $tmp->UsName,
                'us_fname' => $tmp->ps_fname,
                'us_lname' => $tmp->ps_lname,
                'us_id' => $this->session->userdata('UsID'),
                'us_pscode' => $this->session->userdata('UsPsCode'),
                'us_email' => $tmp->UsEmail,
                'us_birthdate' => $tmp->psd_birthdate,
                'us_gender' => $tmp->pf_name,
                'us_tel' => $tmp->psd_phone,
            );     
            // $user_data = $this
            
            $this->output_frontend('front/v_about',$data);
        }else{
            redirect('Gear/index','refresh');
        }
    }

    function update_profile_json()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('us_id', 'us_id', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            echo "fail";
            echo validation_errors();
        }
        else
        {
            $hr_db = $this->load->database('hr',TRUE);
            $this->load->model('UMS/m_umuser');
            $um_db = $this->m_umuser->ums;

            $this->m_umuser->UsID = $this->input->post('us_id');
            $us_obj = $this->m_umuser->get_by_key();
            
            if($us_obj->num_rows()){
                $hr_db->trans_begin();
                $um_db->trans_begin();
                $arr = $us_obj->row();
                $detail = '';
                if($this->input->post('us_email')){
                    $new_email = $this->input->post('us_email');
                    //hr
                    $hr_db->where('psd_ps_id', $arr->UsPsCode);
                    $hr_db->update('hr_person_detail', array('psd_email'=>$new_email)); 
                    //ums
                    $um_db->where('UsID', $arr->UsID);
                    $um_db->update('umuser', array('UsEmail'=>$new_email)); 
                    $detail = $new_email;
                }

                if($this->input->post('us_birthdate')){
                    $new_bd = $this->input->post('us_birthdate');
                    $date = str_replace('/', '-', $new_bd);
                    $new_bd = date('Y-m-d', strtotime($date));
                    //hr
                    $hr_db->where('psd_ps_id', $arr->UsPsCode);
                    $hr_db->update('hr_person_detail', array('psd_birthdate'=>$new_bd));
                    $detail = $new_bd;
                }

                if($this->input->post('us_tel')){
                    $new_tel = $this->input->post('us_tel');
                    //hr
                    $hr_db->where('psd_ps_id', $arr->UsPsCode);
                    $hr_db->update('hr_person_detail', array('psd_phone'=>$new_tel));
                    $detail = $new_tel;
                }

                if($this->input->post('us_name')&&$this->input->post('us_lname')){
                    $new_name = $this->input->post('us_name');
                    $new_lname = $this->input->post('us_lname');
                    //hr
                    $hr_db->where('ps_id', $arr->UsPsCode);
                    $hr_db->update('hr_person', array('ps_fname'=>$new_name,'ps_lname'=>$new_lname)); 
                    //ums
                    $um_db->where('UsID', $arr->UsID);
                    $um_db->update('umuser', array('usName'=>$new_name.' '.$new_lname)); 
                    $detail = $new_name.' '.$new_lname;
                }
                $res = false;
                if($hr_db->trans_status() === false && $um_db->trans_status() === false){
                    $hr_db->trans_rollback();
                    $um_db->trans_rollback();

                }else{
                    $res = true;
                    $hr_db->trans_commit();
                    $um_db->trans_commit();
                }

                echo json_encode(array('status'=>$res,'detail'=>$detail));
            }
            

            //us_birthdate

            //us_gender

            //password
        }
    }

    function test_my_pdf(){
        $mpdf = new \Mpdf\Mpdf();

        ob_end_clean();
        $x = $this->load->view('front/v_plain','',TRUE);
        $mpdf->charset_in='TIS-620';
        $mpdf->WriteHTML($x);
        $mpdf->addPage();
        $mpdf->WriteHTML($x);


        // Output a PDF file directly to the browser
        $mpdf->Output();
    }
}

?>
