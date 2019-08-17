	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// require(dirname(__FILE__).'/../../../UMS_Controller.php'); //สำหรับ Camp ที่หอ
 require(dirname(__FILE__).'/../../UMS_Controller.php'); //สำหรับ Camp
/*
* Controller Dashboard
* @Auther : Jiramate Phuaphan
* @Edit Last Date : 
*/
class Dashboard extends UMS_Controller {
	public $path;
	public $data;
	function __construct(){
		parent::__construct();
		if(base_url() == "https://10.80.39.16/Camp/"){
			$this->path = "/60160157/ffm/backend";
			$this->data['dir'] = "/60160157/ffm/backend";
		}else if(base_url() == "http://10.80.39.251/ossd/"){
			$this->path = "/ffm/backend"; //แก้ชื่อตรงนี้ เช่น backend_ชื่อเล่น
			$this->data['dir'] = "/ffm/backend"; //แก้ชื่อตรงนี้ เช่น backend_ชื่อเล่น
		}
	}

	///////////////////////////////////////////////////////////////////////////////////////////

	function index(){
		$this->v_dashboard();
	}

	function v_dashboard()
	{
		$this->load->model($this->path.'/M_field_reservation', 'mgd');
		$this->load->model($this->path.'/M_football_field', 'ffd');
		$this->load->model($this->path.'/M_complain', 'cpd');
		
		$this->data['fr_all'] = $this->mgd->get_data_price()->result(); 
		$this->data['fr_a'] = $this->mgd->get_data_user()->result(); 
		$this->data['ff_all'] = $this->ffd->get_table()->result(); 
		$this->data['cp_all'] = $this->cpd->get_table_complain()->result(); 
		$this->output($this->path.'/v_dashboard',$this->data);
	}

	function get_total_of_customer($year){
		$this->load->model($this->path.'/M_field_reservation', 'mfr');
		$j=1;
		 for($i=0;$i<12;$i++){	
			$qu_mfr[$j] = $this->mfr->get_total_of_customer($year,$j)->result();
			//echo $year."NULL".$j ;
			//  if(count($qu_mfr)<=0){
			// 	echo "NULL" ;
			//  }
			$j++;
		 }
		// var_dump($qu_mfr);
		echo json_encode($qu_mfr);
	}
	function get_total_of_income($year){
		$this->load->model($this->path.'/M_field_reservation', 'mfr');
		$j=1;
		 for($i=0;$i<12;$i++){	
			$qu_mfr[$j] = $this->mfr->get_total_of_income($year,$j)->result();
			//echo $year."NULL".$j ;
			//  if(count($qu_mfr)<=0){
			// 	echo "NULL" ;
			//  }
			$j++;
		 }
		// var_dump($qu_mfr);
		echo json_encode($qu_mfr);
	}
	
}//end class
?>