<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class ShowWGroup extends UMS_Controller {
	public function __construct(){
		//call parent::__construct() for use $this->load
		parent::__construct();
		$this->load->model('UMS/m_umwgroup');
		$this->load->model('UMS/m_umsystem');
		$this->load->model('UMS/m_umgroup');
		$this->load->model('UMS/m_umgroupdefault');
	}

	public function index(){
	$data['OK'] = 0;
	// Show All WGroup 
		$data['wgroup'] = $this->m_umwgroup->show_all();  
	// Show Option in Insert Form
		$data['opt'] = $this->m_umsystem->get_all();
		$data['sysname']=$this->m_umgroup->show_all()->result_array();
	//Output!
		$this->output('UMS/v_ShowWGroup',$data);
	}
	
	public function add(){
	// Insert into umgroup
		$this->m_umwgroup->WgID = "";
		$this->m_umwgroup->WgNameT = $this->input->post('WgNameT');
		$this->m_umwgroup->WgNameE = $this->input->post('WgNameE');
		$this->ums->trans_begin();
		$uniq = $this->m_umwgroup->get_uniq()->row_array();
		if($uniq <> NULL)
		{
			$this->ums->trans_rollback();
			$data['OK'] = 2;
		}
		else
		{
			$data['OK'] = 1;
			$this->m_umwgroup->insert();
			$GdWgID =$this->m_umwgroup->get_id(); // insert will return the key
			$data['search'] = $this->m_umgroup->show_all()->result_array();
			foreach($data['search'] as $search){
				if($_POST["hidden".$search['GpID']] == 1){
						$this->m_umgroupdefault->GdWgID = $GdWgID['WgID'];
						$this->m_umgroupdefault->GdGpID = $search['GpID'];
						$this->m_umgroupdefault->insert();
				}	
			}
			//commit transaction
			$this->ums->trans_commit();
		}
		// Show All WGroup 
			$data['wgroup'] = $this->m_umwgroup->show_all(); 
		// Show Option in Insert Form
			$data['opt'] = $this->m_umsystem->get_all();
			$data['sysname']=$this->m_umgroup->show_all()->result_array();
		//Output!
			$this->output('UMS/v_ShowWGroup',$data);
	}
	
		public function edit($WgID){
		$ID = str_replace("_","/",$WgID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$WgID = $this->encryption->decrypt($ID);
		
	// call old data want to edit
		$this->m_umwgroup->WgID = $WgID;
		$data['WgID'] = $WgID;
		$data['edit'] = $this->m_umwgroup->get_by_key_with_sys()->row_array();
	// Show All WGroup in This System
		$data['wgroup'] = $this->m_umwgroup->show_all();  
	// Show Option in Insert Form
		$data['opt'] = $this->m_umsystem->get_all();
		$data['sysname']=$this->m_umgroup->show_all()->result_array();
		$data['persys'] = $this->m_umgroupdefault->get_perSystem($WgID)->result_array();
	// Show Output!! to Edit Data
		$this->output('UMS/v_ShowWGroup_edit',$data);
	}
	
		public function update($WgID){
		$ID = str_replace("_","/",$WgID);
		$ID = str_replace(":","+",$ID);
		$ID = str_replace("~","=",$ID);
		$WgID = $this->encryption->decrypt($ID);
	// Update to umgroup
		$this->m_umwgroup->WgID = $WgID;
		$this->m_umwgroup->WgNameT = $this->input->post('WgNameT');
		$this->m_umwgroup->WgNameE = $this->input->post('WgNameE');
		$this->ums->trans_begin();
		$uniq = $this->m_umwgroup->get_uniq_with_ID()->row_array();
		
		if($uniq <> NULL)
		{
			$this->ums->trans_rollback();
			$data['OK'] = 2;
		}
		else
		{
			$data['OK'] = 1;
			$this->m_umwgroup->update();
			$data['search'] = $this->m_umgroup->show_all()->result_array();
			foreach($data['search'] as $search){	
				if($_POST["hidden".$search['GpID']] == 1){
					if(!$this->m_umgroupdefault->search_check($search['GpID'],$WgID)){
						$this->m_umgroupdefault->GdWgID = $WgID;
						$this->m_umgroupdefault->GdGpID = $search['GpID'];
						$this->m_umgroupdefault->insert();
					}
				}
				else{
					if($this->m_umgroupdefault->search_check($search['GpID'],$WgID)){
						$this->m_umgroupdefault->GdWgID = $WgID;
						$this->m_umgroupdefault->GdGpID = $search['GpID'];
						$this->m_umgroupdefault->delete();
					}	
				}
			}
		//commit transaction
			$this->ums->trans_commit();
		}
		// Show All WGroup 
			$data['wgroup'] = $this->m_umwgroup->show_all(); 
		// Show Option in Insert Form
			$data['opt'] = $this->m_umsystem->get_all();
			$data['sysname']=$this->m_umgroup->show_all()->result_array();
		//Output!
			$this->output('UMS/v_ShowWGroup',$data);
	}
	public function remove($WgID){
	$this->ums->trans_begin();
	// Remove into umgroup
	
		$this->m_umgroupdefault->delete_all_wgroup($WgID);
		$this->m_umwgroup->WgID=$WgID;
		$this->m_umwgroup->delete();
		if($this->ums->trans_status() === false)
		{
			$this->ums->trans_rollback();
			$this->output('error');
		}
		else
		{
			$this->ums->trans_commit();
			// refresh to index()
			redirect('UMS/showWGroup', 'refresh');
		}
	}
	
}	

?>
