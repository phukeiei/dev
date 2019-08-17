<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('NoLogin_Controller.php');
class Senttoemail extends NoLogin_Controller {

// Create __construct for load model use in this controller
	public function __construct(){
		//call parent::__construct() for use $this->load
		parent::__construct();
		$this->load->model('UMS/m_umuser');
		
	}

	
	
	public function index(){
	// Show All Part of This user
		$data['senttoe-mail']  = $this->m_umuser->get_all(); 	
	// Output
		$this->output('UMS/v_senttoemail',$data);
	
	}
	function not_found(){
		$this->output('UMS/v_notfound');
	}	
	function checkEmail(){
		$name = $this->input->post('txtUsername');
		$email = $this->input->post('txtEmail');
			
		$in = $this->m_umuser->senntoemail($name,$email);
		if($in==1){
			redirect('UMS/senttoemail');
		}
		else{
			redirect('UMS/senttoemail/not_found');
		}
	}
	
	
	public function show($data){
		$this->load->view('template/header');
		$this->load->view('template/topbar');
		$this->load->view('template/toolbar');
		$this->load->view('UMS/v_senttoemail',$data);
		$this->load->view('template/footer');
		redirect('UMS/senttoemail', 'refresh');
	}
		
	public  function senttoemail(){
		$this->load->model('UMS/m_umuser');
	
	}
}
	
	
	
	
	?>