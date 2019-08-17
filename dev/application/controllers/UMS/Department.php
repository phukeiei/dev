<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class department extends UMS_Controller {
	public function __construct(){
		//call parent::__construct() for use $this->load
		parent::__construct();
		$this->load->model('UMS/m_umdepartment');

		} 

	public function index(){
		$data['OK'] = 0;
	// Show All department
		$data['department'] = $this->m_umdepartment->show_all();
	// Show Option in Insert Form

	//Output!
		$this->output('UMS/v_department',$data);
	}

	public function add(){
	// Insert into umgroup
		$this->m_umdepartment->dpID = "";
		$this->m_umdepartment->dpName = $this->input->post('dpName');


		$uniq = $this->m_umdepartment->get_uniq()->row_array();
		if($uniq <> NULL)
		{
			$this->ums->trans_rollback();
			$data['OK'] = 2;
		}
		else
		{
			$data['OK'] = 1;
			$this->m_umdepartment->insert();
			$new = $this->m_umdepartment->get_by_dp_name($this->input->post('dpName'));
			$sql = "(".$new['dpID'].",".$new['dpName'].")";
			$desc = "insert umdepartment (dpID, dpName)";
			$HtID = $this->m_umhistory->insert("umdepartment",NULL,$sql,$new['dpID'],$desc);
			//save log
			$this->m_umlog->adddata("umdepartment",$HtID);
			//transaction
			$this->ums->trans_commit();

		}
		// Show All department
		$data['department'] = $this->m_umdepartment->show_all();
		//Output!
		$this->output('UMS/v_department',$data);
	}

		public function edit($dpID){
		$ID = str_replace("_","/",$dpID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$dpID = $this->encrypt->decode($ID);
	// call old data want to edit
		$this->m_umdepartment->dpID = $dpID;
		$data['dpID'] = $dpID;
		$data['edit'] = $this->m_umdepartment->get_by_key_with_sys()->row_array();
	// Show All department in This System
		$data['department'] = $this->m_umdepartment->show_all();
	// Show Option in Insert Form
		//$data['opt'] = $this->m_umsystem->get_all();
		//$data['sysname']=$this->m_umgroup->show_all()->result_array();
		//$data['persys'] = $this->m_umgroupdefault->get_perSystem($dpID)->result_array();
	// Show Output!! to Edit Data
		$this->output('UMS/v_department_edit',$data);
	}

		public function update($dpID){
		$ID = str_replace("_","/",$dpID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$dpID = $this->encrypt->decode($ID);
	// save backup data
		$old = $this->m_umdepartment->get_by_dp_id($dpID);
		$oldsql = "(".$old['dpID'].",".$old['dpName'].")";
	// Update to umgroup
		$this->m_umdepartment->dpID = $dpID;
		$this->m_umdepartment->dpName = $this->input->post('dpName');
		$uniq = $this->m_umdepartment->get_uniq_with_ID()->row_array();

		if($uniq <> NULL)
		{
			$this->ums->trans_rollback();
			$data['OK'] = 2;
		}
		else
		{
			$data['OK'] = 1;
			$this->m_umdepartment->update();
		//history
			$new = $this->m_umdepartment->get_by_dp_id($dpID);
			$sql = "(".$new['dpID'].",".$new['dpName'].")";
			$desc = "update umdepartment (dpID, dpName)";
			$HtID = $this->m_umhistory->insert("umdepartment",$oldsql,$sql,$new['dpID'],$desc);
		//save log
			$this->m_umlog->updatedata("umdepartment",$HtID);
		}
		// Show All department
		$data['department'] = $this->m_umdepartment->show_all();
		//Output!
		$this->output('UMS/v_department',$data);

	}

		public function remove($dpID){
		$this->ums->trans_begin();
	//Save History
		$old = $this->m_umdepartment->get_by_dp_id($dpID);
		$oldsql = "(".$old['dpID'].",".$old['dpName'].")";
		$desc = "delete umdepartment (dpID, dpName)";
		$HtID = $this->m_umhistory->insert("umdepartment",$oldsql,NULL,$old['dpID'],$desc);
	// Save Log
		$this->m_umlog->deletedata("umdepartment",$HtID);
	// Remove into department
		$this->m_umdepartment->dpID=$dpID;
		$this->m_umdepartment->delete();
		if($this->ums->trans_status() === false)
		{
			$this->ums->trans_rollback();
			$this->output('error');
		}
		else
		{
			$this->ums->trans_commit();
	// refresh to index()

		redirect('UMS/department', 'refresh');
		}

		// Show All department
		$data['department'] = $this->m_umdepartment->show_all();
		//Output!
		$this->output('UMS/v_department',$data);

	}

}

?>
