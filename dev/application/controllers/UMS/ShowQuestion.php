<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class ShowQuestion extends UMS_Controller {

// Create __construct for load model use in this controller
	public function __construct(){
		//call parent::__construct() for use $this->load
		parent::__construct();
		$this->load->model('UMS/m_umquestion');
		//$this->load->model('UMS/m_umsystem');
		//$this->load->model('{UMS/m_umgpermission');
		//$this->load->model('UMS/m_ummenu');
	}
	
	// Create output for Easy to call View in 1 line..
	/*public function output($data){
	// Show All Part of This Web
		$this->load->view('template/header');
		$this->load->view('template/topbar');
		$this->load->view('template/toolbar');
		$this->load->view('UMS/v_showQuestion',$data);
		$this->load->view('template/footer');
	}*/
	
	
	public function index(){
		$data['OK'] = 0;
	// Show All Part of This System
		$data['question']  = $this->m_umquestion->show_all();
	// Show Option in Insert Form
		//$data['opt'] = $this->m_umsystem->get_all();
	// Output
		$this->output('UMS/v_showQuestion',$data);
	
	}
	
	public function add(){
		$id=$this->m_umquestion->getLastID();
		foreach($id->result_array() as $last_id){
			$last=$last_id['QsID'];
		}
	// Insert into umquestion
		$this->m_umquestion->QsID = $last+1;
		$this->m_umquestion->QsDescT = $this->input->post('QsDescT');
		$this->m_umquestion->QsDescE = $this->input->post('QsDescE');
	$uniq = $this->m_umquestion->get_uniq()->row_array();
	if($uniq <> NULL)
	{
		$data['OK'] = 2;
	}
	else
	{
		$data['OK'] = 1;
		$this->m_umquestion->insert();
		// Save History
			$sql="";
			$newdata = $this->m_umquestion->get_by_id($last+1);
			foreach ( $newdata->result_array() as $new)
			{
				$sql = "(".$new['QsID'].",".$new['QsDescT'].",".$new['QsDescE'].")";
				break;
			}
			$desc = "insert umquestion (QsID, QsDescT, QsDescE)";
			$HtID = $this->m_umhistory->insert("umgroup",NULL,$sql,$new['QsID'],$desc);
	}
		// Save Log
			$this->m_umlog->adddata("umquestion",$HtID);
		// Show All Part of This System
			$data['question']  = $this->m_umquestion->show_all();
		// Output
			$this->output('UMS/v_showQuestion',$data);
	}
	
	public function edit($QsID){
		$ID = str_replace("_","/",$QsID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$QsID = $this->encryption->decrypt($ID);
	// call old data want to edit
		$this->m_umquestion->QsID = $QsID;
		$data['QsID'] = $QsID;
		$data['edit'] = $this->m_umquestion->get_by_key_with_sys();
	// Show All Question in This System
		$data['question'] = $this->m_umquestion->show_all();  
	// Show Option in Insert Form
		//$data['opt'] = $this->m_umsystem->get_all();
	// Show Output!! to Edit Data
		//$this->load->view('template/header');
		//$this->load->view('template/topbar');
		//$this->load->view('template/toolbar');
		$this->output('UMS/v_showQuestion_edit',$data);
		//$this->load->view('template/footer');
	}
	
	public function update($QsID){
	$ID = str_replace("_","/",$QsID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$QsID = $this->encryption->decrypt($ID);
	// Save Backup
		$oldsql="";
		$olddata = $this->m_umquestion->get_by_id($QsID);
		foreach ( $olddata->result_array() as $old)
		{
			$oldsql = "(".$old['QsID'].",".$old['QsDescT'].",".$old['QsDescE'].")";
			break;
		}
		
	// Update to umquestion
		$this->m_umquestion->QsID = $QsID;
		$this->m_umquestion->QsDescT = $this->input->post('QsDescT');
		$this->m_umquestion->QsDescE = $this->input->post('QsDescE');
		$uniq = $this->m_umquestion->get_uniq_with_ID()->row_array();
		if($uniq <> NULL)
		{
			$data['OK'] = 2;
		}
		else
		{
			$data['OK'] = 1;	
			
			$this->m_umquestion->update();
		// Save History
			$sql="";
			$newdata = $this->m_umquestion->get_by_id($QsID);
			foreach ( $newdata->result_array() as $new)
			{
				$sql = "(".$new['QsID'].",".$new['QsDescT'].",".$new['QsDescE'].")";
				break;
			}
			$desc = "update umquestion (QsID, QsDescT, QsDescE)";
			$HtID = $this->m_umhistory->insert("umgroup",$oldsql,$sql,$new['QsID'],$desc);
		// Save Log
			$this->m_umlog->updatedata("umquestion",$HtID);
		}
		// Show All Part of This System
		$data['question']  = $this->m_umquestion->show_all();
		
		// Output
			$this->output('UMS/v_showQuestion',$data);
	}
	
	
	public function remove($QsID){
	// Save History
		$oldsql="";
		$olddata = $this->m_umquestion->get_by_id($QsID);
		foreach ( $olddata->result_array() as $old)
		{
			$oldsql = "(".$old['QsID'].",".$old['QsDescT'].",".$old['QsDescE'].")";
			break;
		}
		$desc = "insert umquestion (QsID, QsDescT, QsDescE)";
		$HtID = $this->m_umhistory->insert("umgroup",$oldsql,NULL,$old['QsID'],$desc);
	// Save Log
		$this->m_umlog->deletedata("umquestion",$HtID);
	// Remove into umquestion
		$this->m_umquestion->QsID=$QsID;
		$this->m_umquestion->delete();
	// refresh to index()
		redirect('UMS/showQuestion', 'refresh');
		$this->load->view('template/header');
		$this->load->view('template/topbar');
		$this->load->view('template/toolbar');
		$this->load->view('UMS/v_showQuestion');
		$this->load->view('template/footer');
		
	}
	
	}
	?>
