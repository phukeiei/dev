<?php
/*
*
*Swm_manage_su_data
*controller show management data
*@author Isarapong Jenkan
*@Create Date 2562-05-18
*Update Date 2562-05-20
*
*/

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/Swm_front_end_controller.php");
class Swm_manage_su_data extends  Swm_front_end_controller{	
	
	
	
	function __construct(){
        parent::__construct();
        $this->user = $this->session->all_userdata();
    }
/*
*
*show_su_data
*show information user
*input -
*output data user
*@Create Date 2562-05-18
*Update Date 2562-05-20
*
*/
	function show_su_data(){
		$this->load->model($this->model.'M_swm_user','msu'); 
		$msu = $this->msu;
		$id_user = ($this->session->userdata('UsPsCode')) ? $this->session->userdata('UsPsCode') : 0;
		$rs_data = $msu->get_data_hr($id_user);
		// echo $msu->swm->last_query();
		if($rs_data->num_rows() > 0){
			// pre($rs_data->result());
			$data['full_name'] = $rs_data->row()->full_name;
			$data['birthdate'] = fullDateTH3($rs_data->row()->psd_birthdate);//1998-09-23
			$data['age'] = calAge3($rs_data->row()->psd_birthdate);
			$data['phone'] = $rs_data->row()->psd_cellphone;
			$data['work'] = $rs_data->row()->su_work;
			$data['workplace'] = $rs_data->row()->su_workplace;
			
			//contact
			// su_contact_pf_id,
				// su_contact_fname,
				// su_contact_lname,
				// echo $rs_data->row()->con_pf_name;
			$con_pf = ($rs_data->row()->su_contact_pf_id != 0) ? $rs_data->row()->con_pf_name :'';
			$con_fname = ($rs_data->row()->su_contact_fname) ? $rs_data->row()->su_contact_fname :'';
			$con_lname = ($rs_data->row()->su_contact_lname) ? $rs_data->row()->su_contact_lname :'';
			$data['contact_full_namee'] = ($con_fname) ? $con_pf.$con_fname." ".$con_lname : '-';
			// echo substr($rs_data->row()->su_tel_contact,0,3);
			// echo substr($rs_data->row()->su_tel_contact,3,7);
			$data['contact_tell'] = substr($rs_data->row()->su_tel_contact,0,3)."-".substr($rs_data->row()->su_tel_contact,3,7);
			$data['create_date'] = fullDateTH3($rs_data->row()->su_create_date);
			
			//address
			$data['address'] = ($rs_data->row()->psd_addcur_no) ? $rs_data->row()->psd_addcur_no : '-';
			$data['province'] = ($rs_data->row()->pv_name) ? " จังหวัด ".$rs_data->row()->pv_name : '';
			$data['ampn'] = ($rs_data->row()->amph_name) ? " อำเภอ ".$rs_data->row()->amph_name : '';
			$data['district'] = ($rs_data->row()->dist_name) ? " ตำบล ".$rs_data->row()->dist_name : '';
			$data['zipcode'] = ($rs_data->row()->psd_addcur_zipcode) ? " รหัสไปรษณี ".$rs_data->row()->psd_addcur_zipcode : '';
			
		}else{
			$data['full_name'] = "-";
			// $data['lname'] = 'หีดมั่น'
			$data['birthdate'] = "-";
			$data['age'] = "-";
			$data['phone'] = "-";
			$data['work'] = "-";
			$data['workplace'] = "-";
			$data['contact_full_namee'] = "-";
			$data['contact_tell'] = "-";
			$data['create_date'] = "-";
			$data['address'] = "-";
			$data['province'] = "";
			$data['ampn'] = "";
			$data['district'] = "";
			$data['zipcode'] = "";
		}
		$this->output_frontend($this->view."user_data/v_show_su_data",$data);
    }
	
	public function show_su_data_fancy()
    { 
		// $data['id'] = $this->user['su_id'];
		$this->load->model($this->model.'M_swm_user','msu'); 
		$msu = $this->msu;
		$id_user = ($this->session->userdata('UsPsCode')) ? $this->session->userdata('UsPsCode') : 0;
		$rs_data = $msu->get_data_hr($id_user);
		if($rs_data->num_rows() > 0){
			pre($rs_data->result());
			$data['full_name'] = $rs_data->row()->full_name;
			// $data['lname'] = 'หีดมั่น';
			$data['birthdate'] = fullDateTH3($rs_data->row()->psd_birthdate);//1998-09-23
			$data['age'] = calAge3($rs_data->row()->psd_birthdate);
			$data['phone'] = $rs_data->row()->psd_cellphone;
			$data['work'] = $rs_data->row()->su_work;
			$data['workplace'] = $rs_data->row()->su_workplace;
			$data['contact_full_namee'] = $rs_data->row()->contact_full_name;
			$data['contact_tell'] = $rs_data->row()->su_tel_contact;
			$data['create_date'] = fullDateTH3($rs_data->row()->su_create_date);
			$data['address'] = ($rs_data->row()->psd_addcur_no) ? $rs_data->row()->psd_addcur_no : '-';
			$data['province'] = ($rs_data->row()->pv_name) ? "จังหวัด".$rs_data->row()->pv_name : '';
			$data['ampn'] = ($rs_data->row()->amph_name) ? "อำเภอ ".$rs_data->row()->amph_name : '';
			$data['district'] = ($rs_data->row()->dist_name) ? "ตำบล ".$rs_data->row()->dist_name : '';
			$data['zipcode'] = ($rs_data->row()->psd_addcur_zipcode) ? "รหัสไปรษณี".$rs_data->row()->psd_addcur_zipcode : '';
			
		}else{
			$data['full_name'] = "-";
			// $data['lname'] = 'หีดมั่น'
			$data['birthdate'] = "-";
			$data['age'] = "-";
			$data['phone'] = "-";
			$data['work'] = "-";
			$data['workplace'] = "-";
			$data['contact_full_namee'] = "-";
			$data['contact_tell'] = "-";
			$data['create_date'] = "-";
			$data['address'] = "-";
			$data['province'] = "";
			$data['ampn'] = "";
			$data['district'] = "";
			$data['zipcode'] = "";
		}
		
        $this->output_frontend($this->view."user_data/v_show_su_data",$data);
    }
	
/*
*
*show_su_data
*show information user
*input -
*output data user
*author Tiwakorn Hedmuin
*Create Date 2562-05-20
*
*/
	public function load_view_form_edit()
    { 
		$this->load->model('swm/frontend/M_swm_user','msu'); 
		$msu = $this->msu;
		$id_user = ($this->session->userdata('UsPsCode')) ? $this->session->userdata('UsPsCode') : 0;
		$data['opt_prefix'] = $msu->get_prefix();
		$rs_data = $msu->get_data_hr($id_user);
		if($rs_data->num_rows() > 0){
			$data['rs_user_data'] = $rs_data;
			$data['full_name'] = $rs_data->row()->full_name;
			$data['birthdate'] = fullDateTH3($rs_data->row()->psd_birthdate);//1998-09-23
			$data['age'] = calAge3($rs_data->row()->psd_birthdate);
			$data['phone'] = $rs_data->row()->psd_cellphone;
			$data['work'] = $rs_data->row()->su_work;
			$data['workplace'] = $rs_data->row()->su_workplace;
			
			//contact
			$data['contact_full_namee'] = ($rs_data->row()->contact_full_name) ? $rs_data->row()->contact_full_name : '-';
			// echo substr($rs_data->row()->su_tel_contact,0,3);
			// echo substr($rs_data->row()->su_tel_contact,3,7);
			$data['contact_tell'] = substr($rs_data->row()->su_tel_contact,0,3)."-".substr($rs_data->row()->su_tel_contact,3,7);
			$data['create_date'] = fullDateTH3($rs_data->row()->su_create_date);
			
			//address
			$data['address'] = ($rs_data->row()->psd_addcur_no) ? $rs_data->row()->psd_addcur_no : '-';
			$data['province'] = ($rs_data->row()->pv_name) ? " จังหวัด ".$rs_data->row()->pv_name : '';
			$data['ampn'] = ($rs_data->row()->amph_name) ? " อำเภอ ".$rs_data->row()->amph_name : '';
			$data['district'] = ($rs_data->row()->dist_name) ? " ตำบล ".$rs_data->row()->dist_name : '';
			$data['zipcode'] = ($rs_data->row()->psd_addcur_zipcode) ? " รหัสไปรษณี ".$rs_data->row()->psd_addcur_zipcode : '';
			
		}else{
			$data['rs_user_data'] = NULL;
			$data['full_name'] = "-";
			// $data['lname'] = 'หีดมั่น'
			$data['birthdate'] = "-";
			$data['age'] = "-";
			$data['phone'] = "-";
			$data['work'] = "-";
			$data['workplace'] = "-";
			$data['contact_full_namee'] = "-";
			$data['contact_tell'] = "-";
			$data['create_date'] = "-";
			$data['address'] = "-";
			$data['province'] = "";
			$data['ampn'] = "";
			$data['district'] = "";
			$data['zipcode'] = "";
		}
		
		$this->output_frontend($this->view."user_data/v_form_edit",$data);
	}
	/*
*
*show_su_data
*show Update_edit_su_data
*input data user
*output -
*@author Phattanan Chawalitsuwan
*@Create Date 2562-05-19
*Update Date 2562-05-21
*/
	function edit_data_register(){
		$this->load->model($this->model.'M_swm_user','msu'); 
		$msu = $this->msu;
		$msu->su_id = $this->input->post('su_id');
		$msu->get_by_key(true);
		
		$msu->su_work = $this->input->post('su_work');
		$msu->su_workplace = $this->input->post('su_workplace');
		$msu->su_contact_pf_id = $this->input->post('su_contact_pf_id');
		$msu->su_contact_fname = $this->input->post('su_contact_fname');
		$msu->su_contact_lname = $this->input->post('su_contact_lname');
		$msu->su_tel_contact = $this->input->post('su_tel_contact');
		$msu->update();
		// pre($this->input->post());
		
		$this->show_su_data();
	}

	
	
}
?>
