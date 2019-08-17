<!--
*
*Swm_front_end_controller
*controller main
*@author Tiwakorn Hedmuin
*@Create Date 2562-05-17
*@Update Date 2562-05-21
*
--> 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../../UMS_Controller.php");
class Swm_front_end_controller extends  UMS_Controller{

    public $user;
	protected $view;
	protected $model;
	protected $controller; 

	function __construct(){
        parent::__construct();
		
		$this->swm =$this->load->database('swm', TRUE);
        $this->user = $this->session->all_userdata();
		$this->view = $this->config->item('swm_folder').$this->config->item('swm_folder_front');
		$this->model = $this->config->item('swm_folder').$this->config->item('swm_folder_front');
		$this->controller = $this->config->item('swm_folder').$this->config->item('swm_folder_front');
        //$this->swm = $this->load->database('swm',ture);      
    }
    
    
    /* ตัวอย่างการโหลด และเรียกใช้ model*/
    function testload(){
		$this->load->model("swm/frontend/M_swm_user_group","msug");
		$msug = $this->msug;
		$rs_us_group = $msug->get_all()->result();
		// pre($rs_us_group);
		
		// echo $this->view;
		// echo "<br>".$this->model;
		// echo "<br>".$this->controller;
		// echo "<br>---------------------------------<br>";
		// echo $this->config->item('swm_folder');
		// echo "<br>".$this->config->item('swm_folder_front');
		// echo "<br>".$this->config->item('swm_folder_back');
		$this->output_frontend($this->view.'test');
    }
    
	
/*
*
*load main.php
*show main.php
*@author Tiwakorn Hedmuin
*@Create Date 2562-05-18
*Update Date 2562-05-20
*
*/
    /*public function index()
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
        $this->output_frontend('swm/frontend/main',$data);
    }*/



/*
*
*load main.php
*show main.php
*@author Tiwakorn Hedmuin
*@Create Date 2562-05-18
*Update Date 2562-05-20
*
*/
	public function newIndex()
    {
        $this->load->view('swm/frontend/main');
      
    }
	

//TEST FUNCTION
/*    public function showallmember()
    {
        $data['id'] = array ( "60160164","60160153","60160175","60160203" );
        $data['name'] = array( "Tiwakorn","Kwanchai","Pattarakorn","Atikom" );
        $data['lname'] = array( "Hedmuin","Nontawichit","Pamornchart","Wongwan" );
        $data['age'] = array( "20","20","20","20" );
        $this->output("swm/frontend/showmember.php",$data);
    }
    public function showstatus()
    {
		$data['id'] = array ( "60160164","60160153","60160175","60160203" );
        $data['name'] = array( "Tiwakorn","Kwanchai","Pattarakorn","Atikom" );
        $data['lname'] = array( "Hedmuin","Nontawichit","Pamornchart","Wongwan" );
        $data['age'] = array( "20","20","20","20" );
        $this->output("swm/frontend/showstatus",$data);
    }
*/
//END TEST FUNCTION


    public function test()
    {
        pre($this->user);
		echo $this->user['UsLogin'];
		echo $this->user['UsName'];
    }
	
	function gen_datadic($table='ossd_swmdb')
	{
		echo "<style>	table tr td {font-family: \"TH SarabunPSK\";font-size:21}
						table tr th {font-family: \"TH SarabunPSK\";font-size:21}
			</style>";
		$test = $this->swm->query("	SELECT TABLE_NAME,TABLE_COMMENT
									FROM INFORMATION_SCHEMA.TABLES
									WHERE TABLE_SCHEMA = '".$table."'
									Group by TABLE_NAME");

		$i=0;
		echo '<meta http-equiv=Content-Type content="text/html; charset=utf-8">';
		foreach($test->result() as $row)
		{
			echo "<table border=1 style='border-collapse:collapse' width='100%'>";
			echo "<tr>";
			echo "<td colspan='2'><b>ชื่อตารางภาษาอังกฤษ</b></td>";
			echo "<td colspan='5'>".$row->TABLE_NAME."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td colspan='2'><b>คำอธิบาย</b></td>";
			echo "<td colspan='5'>".$row->TABLE_COMMENT."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td colspan='2'><b>คีย์หลัก (PK)</b></td>";
			$sql_key = 'SELECT COLUMN_NAME
						FROM  INFORMATION_SCHEMA.`KEY_COLUMN_USAGE`
						WHERE TABLE_NAME =  "'.$row->TABLE_NAME.'"
						AND TABLE_SCHEMA =  "'.$table.'"
						AND CONSTRAINT_NAME =  "PRIMARY"';
			$key_array = array();
			foreach($this->swm->query($sql_key)->result() as $row_key)
			{
				array_push($key_array,$row_key->COLUMN_NAME);
			}
			echo "<td colspan='5'>".implode(",",$key_array)."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>ลำดับ</th>";
			echo "<th>ชื่อคอลัมน์</th>";
			echo "<th>ประเภท</th>";
			echo "<th>ขนาด</th>";
			echo "<th>กำหนดค่า</th>";
			echo "<th>รายละเอียด</th>";
			echo "<th>ตัวอย่างข้อมูล</th>";
			echo "</tr>";
			$i = 0;
			$sql = "SELECT * FROM INFORMATION_SCHEMA.`COLUMNS` WHERE `TABLE_NAME` LIKE '".$row->TABLE_NAME."' AND TABLE_SCHEMA =  '".$table."'";
			$test2 = $this->swm->query($sql);

			foreach($test2->result() as $row2 )
			{
				echo "<tr>";
				echo "<td align='center'>".++$i."</td>";
				echo "<td>".$row2->COLUMN_NAME."</td>";
				echo "<td align='center'>".strtoupper($row2->DATA_TYPE)."</td>";
				$data = explode(" ",$row2->COLUMN_TYPE);
				echo "<td align='center'>".str_replace(array($row2->DATA_TYPE,"(",")"),"",$data[0])."</td>";
				echo "<td align='center'>".$row2->COLUMN_DEFAULT."</td>";
				echo "<td>".$row2->COLUMN_COMMENT."</td>";
				/* if($row2->DATA_TYPE=="int"){
					$max = 3;
				}else $max=1;
					$sql = "select distinct `".$row2->COLUMN_NAME."` from `".$row->TABLE_NAME."` WHERE `".$row2->COLUMN_NAME."` != '0000-00-00' and `".$row2->COLUMN_NAME."` != '' and `".$row2->COLUMN_NAME."` not like '0000%' order by `".$row2->COLUMN_NAME."`desc limit 0,".$max;
					$arr = $this->hr->query($sql)->result_array();
					$arr2 = array();
				foreach($arr as $key=>$val){
					$arr2[$key] = $val[$row2->COLUMN_NAME];
					}
				$sample = implode(", ",$arr2); */
				/* if(strlen($sample)>300){
					$sample = substr($sample,1,300)."...";
					} */
				//}else{
					//$sample = "";
				//}
				//echo "<td>".$sample."</td>";
				echo "<td></td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "<br><br>";
		}

	}

	function gen_datadic_word($table='ossd_swmdb'){
		header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment; filename=testing.doc");
		$this->gen_datadic($table);
	}
	
}