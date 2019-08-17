<!--
*
*
*controller main
*@author Tiwakorn Hedmuin
*@Create Date 2562-05-17
*
-->
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../../UMS_Controller.php");
class Test extends  UMS_Controller{

    public $user;
	protected $view;
	protected $model;
	protected $controller; 

	function __construct(){
        parent::__construct();
        $this->user = $this->session->all_userdata();
		$this->view = $this->config->item('swm_folder').$this->config->item('swm_folder_front');
		$this->model = $this->config->item('swm_folder').$this->config->item('swm_folder_front');
		$this->controller = $this->config->item('swm_folder').$this->config->item('swm_folder_front');
        //$this->swm = $this->load->database('swm',ture);      
    }

    public function show_view_print(){
        $this->output_frontend($this->view."TEST/v_form_print_register.php");
    }

    public function test_session()
    {
        pre($this->user);
		echo $this->user['UsLogin'];
		echo $this->user['UsName'];
    }

    public function test_get_data_hr(){
        $this->load->model("swm/frontend/M_swm_user", "msu");
        $su_ps_id = $this->session->userdata("UsPsCode");
        $rs_data_person = $this->msu->get_data_hr($su_ps_id);
        $data['rs_data_person'] = $rs_data_person->result();
        $this->output_frontend($this->view."TEST/v_test_data_hr.php", $data, true);
    }
    
    public function test_report_register(){
        $this->output($this->view."TEST/v_report_register.php");
    }
}