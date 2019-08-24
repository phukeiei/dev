 <?php
/*
*
*Swm_register
*controller show_form_register
*@author Isarapong Jenkan , Tiwakorn Hedmuin
*@Create Date 2562-05-17
*
*/

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/Swm_front_end_controller.php");
class Swm_register extends  Swm_front_end_controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	
/*
*
*show_form_register
*show form register
*input UsName
*output Data register
*@Create Date 2562-05-17
*
*/
	public function index()
	{
		$this->load->model("swm/frontend/M_swm_user","msu");
		$msu = $this->msu;
		$rs_ps_id = $msu->get_ps_id_by_su_state()->result();
		$ps_id = $this->session->userdata("UsPsCode");
		$result_auth = true;
		foreach($rs_ps_id as $key => $row){
			if($row->su_ps_id == $ps_id){
				$result_auth = false;
			}
		}
		$data["result_auth"] = $result_auth;
		$data["ps_id"] = $ps_id;
		$data['user']=$this->user;
		$this->output_frontend('swm/frontend/register/v_register',$data);
	}

	public function show_form_register()
    { 
		$data['header_title'] = "";
		$this->load->model("swm/frontend/M_swm_user", "msu");
		$ps_id = $this->session->userdata("UsPsCode");
		$rs_data_person = $this->msu->get_data_ps($ps_id)->result();
		$data['rs_data_person'] = $rs_data_person;
		
        $this->output_frontend("swm/frontend/register/v_form_regis_data",$data);
    }

/*
*
*show_form_register_input
*input data form register
*input -
*output -
*@Create Date 2562-05-17
*
*/
	public function show_form_register_input()
    { 
		$this->load->model("swm/frontend/M_swm_user", "msu");
		$data["opt_prefix"] = $this->msu->get_prefix();
		$data['header_title'] = "";
        $this->output_frontend("swm/frontend/register/v_form_regis_input",$data);
    }



/*
*
*load_user
*load data from database
*input -
*output -
*author Tiwakorn Hedmuin
*@Create Date 2562-05-19
*
*/
	function load_user(){
		$this->load->model("swm/frontend/M_swm_user","msu");
		$msu = $this->msu;
		$rs_us_group = $msu->get_all()->result();
		$data['username'] = $this->user['UsName'];
		$data['rs_us_group'] = $rs_us_group;
		// echo $this->view;
		// echo "<br>".$this->model;
		// echo "<br>".$this->controller;
		// echo "<br>---------------------------------<br>";
		// echo $this->config->item('swm_folder');
		// echo "<br>".$this->config->item('swm_folder_front');
		// echo "<br>".$this->config->item('swm_folder_back');
		$this->output_frontend("swm/frontend/register/v_form_regis_data",$data);
		pre($data);	
    }
	
/*
*
*insert_su_data
*input data form register to database
*input data form register
*output -
*author Tiwakorn Hedmuin
*@Create Date 2562-05-19
*
*/
	function insert_su_data(){
		$this->load->model($this->model."M_swm_user","msu");
		
		$su_work = $this->input->post('su_work');
		$su_workplace = $this->input->post('su_workplace');
		// $su_tel = $this->input->post('su_tel');
		$su_contact_fname = $this->input->post('su_contact_fname');
		$su_contact_lname = $this->input->post('su_contact_lname');
		$su_tel_contact = $this->input->post('su_tel_contact');
		// echo "fdgd".$this->input->post('su_contact_pf_id');
		// pre($this->input->post());
		
		$su_ps_id = $this->session->userdata('UsPsCode');
		// die;
		$data['rs_data_person'] = $rs_data_person = $this->msu->get_data_ps($su_ps_id)->result();
				
		$this->msu->su_ps_id = $su_ps_id;
		$this->msu->su_tel = '';  //เอาข้อมูลมาเหมือนวันเกิด
		$this->msu->su_code = $this->gen_su_code();
		$this->msu->su_birthday = $rs_data_person[0]->psd_birthdate;
		$this->msu->su_work = $su_work;
		$this->msu->su_workplace = $su_workplace;
		$this->msu->su_tel_contact = $su_tel_contact;
		$this->msu->su_tel_contact = $su_tel_contact;
		$this->msu->su_contact_pf_id = $this->input->post('su_contact_pf_id');
		$this->msu->su_contact_fname = $su_contact_fname;
		$this->msu->su_contact_lname = $su_contact_lname;
		$this->msu->su_state = 1; // สถานะรออนุมัติ
		$this->msu->su_create_date = Date('Y-m-d');
		$this->msu->su_anit_cost = 300.00; //ผิด

		$next_year = strtotime("next year");
		$this->msu->su_expire_date = Date('Y-m-d', $next_year);
		
		//upload img
		$config['file_name']          	= $this->msu->su_code;
		$config['overwrite']          	= TRUE;
		$config['upload_path']          = APPPATH . 'views/swm/frontend/IMG/Profile/';
		$config['allowed_types']		= '*';//'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		$this->load->library('upload', $config);
		
		$this->upload->do_upload('profile_img');

		//upload img
		/*$data['upload'] = array('upload_data' => $this->upload->data());
		pre($data['upload']);*/

		$this->msu->insert();
		//$this->output_frontend($this->view."register/v_form_regis_data",$data);
		
		redirect('swm/frontend/Swm_register/download_pdf','refresh');
	}

	function download_pdf()
	{
		$this->load->model($this->model."M_swm_user","msu");

		$ps_data = $this->msu->get_data_ps($this->session->userdata("UsPsCode"))->result();
		$data['full_name'] = $ps_data[count($ps_data)-1]->full_name;
		$data['birthdate'] = fullDateTH3($ps_data[count($ps_data)-1]->psd_birthdate);
		$data['age'] = calAge3($ps_data[count($ps_data)-1]->psd_birthdate);
		
		$data['addcur_no'] = $ps_data[count($ps_data)-1]->psd_addcur_no;
		$data['district'] = $ps_data[count($ps_data)-1]->dist_name;
		$data['amphur'] = $ps_data[count($ps_data)-1]->amph_name;
		$data['province'] = $ps_data[count($ps_data)-1]->pv_name;
		$data['zipcode'] = $ps_data[count($ps_data)-1]->psd_addcur_zipcode;

		//$data['su_code'] = '6205090';
		$data['su_code'] = $ps_data[count($ps_data)-1]->su_code;
		$data['career'] = $ps_data[count($ps_data)-1]->su_work;
		$data['phone_no'] = $ps_data[count($ps_data)-1]->psd_cellphone;

		$data['contact_full_name'] = $ps_data[count($ps_data)-1]->contact_full_name;
		$data['contact_phone_no'] = $ps_data[count($ps_data)-1]->su_tel_contact;

		$data['create_date'] = fullDateTH3($ps_data[count($ps_data)-1]->su_create_date);
		$data['expire_date'] = fullDateTH3($ps_data[count($ps_data)-1]->su_expire_date);

		$data['application_pdf'] = $this->load->view('swm/frontend/register/v_application_pdf', $data, true);
		$data['member_card_pdf'] = $this->load->view('swm/frontend/register/v_member_card_pdf', $data, true);
		
		$this->output_frontend('swm/frontend/register/v_download_pdf', $data);	
		
	}

	function print_application_pdf()
    {
		$this->load->model($this->model."M_swm_user","msu");

		$ps_data = $this->msu->get_data_ps($this->session->userdata("UsPsCode"))->result();
		$data['full_name'] = $ps_data[count($ps_data)-1]->full_name;
		$data['birthdate'] = fullDateTH3($ps_data[count($ps_data)-1]->psd_birthdate);
		$data['age'] = calAge3($ps_data[count($ps_data)-1]->psd_birthdate);
		
		$data['addcur_no'] = $ps_data[count($ps_data)-1]->psd_addcur_no;
		$data['district'] = $ps_data[count($ps_data)-1]->dist_name;
		$data['amphur'] = $ps_data[count($ps_data)-1]->amph_name;
		$data['province'] = $ps_data[count($ps_data)-1]->pv_name;
		$data['zipcode'] = $ps_data[count($ps_data)-1]->psd_addcur_zipcode;

		$data['su_code'] = $ps_data[count($ps_data)-1]->su_code;
		$data['career'] = $ps_data[count($ps_data)-1]->su_work;
		$data['phone_no'] = $ps_data[count($ps_data)-1]->psd_cellphone;

		$data['contact_full_name'] = $ps_data[count($ps_data)-1]->contact_full_name;
		$data['contact_phone_no'] = $ps_data[count($ps_data)-1]->su_tel_contact;

		$data['create_date'] = fullDateTH3($ps_data[count($ps_data)-1]->su_create_date);
		$data['expire_date'] = fullDateTH3($ps_data[count($ps_data)-1]->su_expire_date);


        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);

        $mpdf->useAdobeCJK = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;

        $mpdf->WriteHTML($this->load->view('swm/frontend/register/v_application_pdf', $data,TRUE));

        $mpdf->Output();
	}
	
	function print_member_card_pdf()
    {
		$this->load->model($this->model."M_swm_user","msu");

		$ps_data = $this->msu->get_data_ps($this->session->userdata("UsPsCode"))->result();
		$data['full_name'] = $ps_data[count($ps_data)-1]->full_name;
		$data['birthdate'] = fullDateTH3($ps_data[count($ps_data)-1]->psd_birthdate);
		$data['age'] = calAge3($ps_data[count($ps_data)-1]->psd_birthdate);
		
		$data['addcur_no'] = $ps_data[count($ps_data)-1]->psd_addcur_no;
		$data['district'] = $ps_data[count($ps_data)-1]->dist_name;
		$data['amphur'] = $ps_data[count($ps_data)-1]->amph_name;
		$data['province'] = $ps_data[count($ps_data)-1]->pv_name;
		$data['zipcode'] = $ps_data[count($ps_data)-1]->psd_addcur_zipcode;

		$data['su_code'] = $ps_data[count($ps_data)-1]->su_code;
		$data['career'] = $ps_data[count($ps_data)-1]->su_work;
		$data['phone_no'] = $ps_data[count($ps_data)-1]->psd_cellphone;

		$data['contact_full_name'] = $ps_data[count($ps_data)-1]->contact_full_name;
		$data['contact_phone_no'] = $ps_data[count($ps_data)-1]->su_tel_contact;

		$data['create_date'] = fullDateTH3($ps_data[count($ps_data)-1]->su_create_date);
		$data['expire_date'] = fullDateTH3($ps_data[count($ps_data)-1]->su_expire_date);


        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);

        $mpdf->useAdobeCJK = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;

        $mpdf->WriteHTML($this->load->view('swm/frontend/register/v_member_card_pdf', $data,TRUE));

        $mpdf->Output();
    }


/*
*
*function gen_su_code
*generate su_code
*input -
*output -
*author Tiwakorn Hedmuin
*@Create Date 2562-05-19
*
*/	
	function gen_su_code(){
		$this->load->model("swm/frontend/M_swm_user","msu");
		$msu = $this->msu;
		$data['last_id'] = $msu->get_last_user_id();
		$year = date("Y")+543;
		$month = date("m");
		$sub_year = substr($year,2);
		$last_id = "";
		foreach($data['last_id']->result() as $row){
			$last_id = $row->su_code;
		}
		$month_id = substr($last_id,2,-3);
		$year_id = substr($last_id,0,2);
		if(($last_id == '')||($last_id == NULL)||($month != $month_id)||($sub_year != $year_id)){
			$su_code = $sub_year.$month.str_pad(1,3,"0",STR_PAD_LEFT);	
		}else{
			$su_code = substr($last_id,4);
			$su_code = $sub_year.$month.str_pad($su_code+1,3,"0",STR_PAD_LEFT);	
		}
	return $su_code;
	}

}
?>
