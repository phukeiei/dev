<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class Showworkgroupsystem extends UMS_Controller{
	// Create __construct for load model use in this controller
	public function __construct(){
		parent::__construct();
		$this->load->model('UMS/m_umgroup');
		$this->load->model('UMS/m_umsystem');
		$this->load->model('UMS/m_umgpermission');
		$this->load->model('UMS/m_ummenu');
	}
	
	public function index(){	
		$data['OK'] = 0;
	// Show All WorkGroup in This System
		$data['workgroup'] = $this->m_umgroup->show_all();  
	// Show Option in Insert Form
		$data['opt'] = $this->m_umsystem->get_all();
	//Output!
		$this->output('UMS/v_showtwomenu2_2',$data);
	}
	
	public function add(){
	// Insert into umgroup
		$this->m_umgroup->GpID = "";
		$this->m_umgroup->GpNameT = $this->input->post('GpNameT');
		$this->m_umgroup->GpNameE = $this->input->post('GpNameE');
		$this->m_umgroup->GpDesc = $this->input->post('GpDesc');
		$this->m_umgroup->GpStID = $this->input->post('GpStID');
		$this->ums->trans_begin();
		$uniq = $this->m_umgroup->get_uniq()->result_array();
	
		if($uniq <> NULL)
		{
			$this->ums->trans_rollback();
			$data['OK']=2;
		}
		else
		{
			$data['OK']=1;
			$this->m_umgroup->insert();
		// Save History
			$sql="";
			$newdata = $this->m_umgroup->get_by_GpNameT($this->input->post('GpNameT'));
			foreach ( $newdata->result_array() as $new)
			{
				if($new['GpStID'] == $this->input->post('GpStID'))
				{
					$sql = "(".$new['GpID'].",".$new['GpNameT'].",".$new['GpNameE'].",".$new['GpDesc'].",".$new['GpStID'].")";
					break;
				}
			}
			$desc = "insert umgroup (GpID, GpNameT, GpNameE, GpDesc, GpStID)";
			$HtID = $this->m_umhistory->insert("umgroup",NULL,$sql,$new['GpID'],$desc);
		// Save Log
			$this->m_umlog->adddata("umgroup",$HtID);
		//commit transaction
			$this->ums->trans_commit();
		
		}
		// Show All WorkGroup in This System
		$data['workgroup'] = $this->m_umgroup->show_all();  
		// Show Option in Insert Form
		$data['opt'] = $this->m_umsystem->get_all();
		//Output!
		$this->output('UMS/v_showWorkGroup',$data);
	}
	
	public function edit($GpID){
		$ID = str_replace("_","/",$GpID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$GpID = $this->encrypt->decode($ID);
	// call old data want to edit
		$this->m_umgroup->GpID = $GpID;
		$data['GpID'] = $GpID;
		$data['edit'] = $this->m_umgroup->get_by_key_with_sys()->result_array();
	// Show All WorkGroup in This System
		$data['workgroup'] = $this->m_umgroup->show_all();  
	// Show Option in Insert Form
		$data['opt'] = $this->m_umsystem->get_all();
	// Show Output!! to Edit Data
		$this->output('UMS/v_showWorkGroup_edit',$data);
	}
	
	public function update($GpID){
		$ID = str_replace("_","/",$GpID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$GpID = $this->encrypt->decode($ID);
	// Save Backup data
		$oldsql="";
		$olddata = $this->m_umgroup->get_by_id($GpID);
		foreach ( $olddata->result_array() as $old)
		{
			$oldsql = "(".$old['GpID'].",".$old['GpNameT'].",".$old['GpNameE'].",".$old['GpDesc'].",".$old['GpStID'].")";
			break;
		}
		
	// Update to umgroup
		$this->m_umgroup->GpID = $GpID;
		$this->m_umgroup->GpNameT = $this->input->post('GpNameT');
		$this->m_umgroup->GpNameE = $this->input->post('GpNameE');
		$this->m_umgroup->GpDesc = $this->input->post('GpDesc');
		$this->m_umgroup->GpStID = $this->input->post('GpStID');
		$this->ums->trans_begin();
		$uniq = $this->m_umgroup->get_uniq_with_ID()->result_array();
		if($uniq <> NULL)
		{
			$this->ums->trans_rollback();
			$data['OK'] = 2;
		}
		else
		{	
			$data['OK'] = 1;
				$this->m_umgroup->update();
			// Save History
				$sql="";
				$newdata = $this->m_umgroup->get_by_id($GpID);
				foreach ( $newdata->result_array() as $new)
				{
					$sql = "(".$new['GpID'].",".$new['GpNameT'].",".$new['GpNameE'].",".$new['GpDesc'].",".$new['GpStID'].")";
					break;
				}
				$desc = "update umgroup (GpID, GpNameT, GpNameE, GpDesc, GpStID)";
				$HtID = $this->m_umhistory->insert("umgroup",$oldsql,$sql,$new['GpID'],$desc);
			// Save Log
				$this->m_umlog->updatedata("umgroup",$HtID);
			//commit transaction
				$this->ums->trans_commit();
			
		}
		// Show All WorkGroup in This System
		$data['workgroup'] = $this->m_umgroup->show_all();  
		// Show Option in Insert Form
		$data['opt'] = $this->m_umsystem->get_all();
		//Output!
		$this->output('UMS/v_showWorkGroup',$data);
	}
	
	
	public function remove($GpID){
	$this->ums->trans_begin();
	// Save History
		$oldsql="";
		$olddata = $this->m_umgroup->get_by_id($GpID);
		foreach ( $olddata->result_array() as $old)
		{
			$oldsql = "(".$old['GpID'].",".$old['GpNameT'].",".$old['GpNameE'].",".$old['GpDesc'].",".$old['GpStID'].")";
			break;

		}
		$desc = "delete umgroup (GpID, GpNameT, GpNameE, GpDesc, GpStID)";
		$HtID = $this->m_umhistory->insert("umgroup",$oldsql,NULL,$old['GpID'],$desc);
	// Save Log
		$this->m_umlog->deletedata("umgroup",$HtID);
	// Remove into umgroup
		$this->m_umgroup->GpID=$GpID;
		$this->m_umgroup->delete();
	if($this->ums->trans_status() === false)
	{
		$this->ums->trans_rollback();
		$this->output('error');
	}
	else
	{
		$this->ums->trans_commit();
		// refresh to index()
		redirect('UMS/showWorkGroup', 'refresh');
	}
	}

	
	
	
}?>