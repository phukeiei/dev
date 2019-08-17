<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');

class ShowIcon extends UMS_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('UMS/m_umicon');
		$this->load->helper(array('form', 'url'));
		
	}
	
	public function index(){
		$data['OK'] = 0;
		$data['icon'] = $this->m_umicon->get_all()->result_array();
		$this->output('UMS/v_showIcon',$data);
		/*foreach($data['icon'] as $icon){
			echo $icon['IcID'];
			echo "   ";
			echo $icon['IcName'];
			echo "   ";
			echo $icon['IcType'];
			echo "<br />";
			
		}*/
		
	}
	function upload_file()
	{
		$pathuploads = $this->config->item('uploads_dir');
		$path = $pathuploads.$_POST['IcType'];
		$config['file_name'] = $_POST['IcName'];
		$config['upload_path'] =  $path;
		$config['allowed_types'] = '*';
		// echo $_FILES['IcPic']['type']."<br>";
		// $config['max_size']	= '1024';
		// $config['max_width']  = '1024';
		// $config['max_height']  = '1024';
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('IcPic'))
		{
			$data = array('upload_data' => $this->upload->data());
			$this->m_umicon->IcID = "";
			$this->m_umicon->IcName = $data['upload_data']['file_name'];
			$this->m_umicon->IcType = $_POST['IcType'];
			//$IcDate = date();
			$this->m_umicon->insert();
			$data['OK'] = 1;
			$data['icon'] = $this->m_umicon->get_all()->result_array();
			$this->output('UMS/v_showIcon',$data);
		}
		else
		{
			$data['OK'] = 2;
			$data['icon'] = $this->m_umicon->get_all()->result_array();
			$this->output('UMS/v_showIcon',$data);
		}
	}
	
	public function remove($IcID){
	// Remove into umicon
		$this->m_umicon->IcID=$IcID;
		$data['temp'] = $this->m_umicon->get_by_key()->result_array();
		$pathuploads = $this->config->item('uploads_dir');
		foreach ($data['temp'] as $temp){
		$deletedb = $this->m_umicon->delete();
			if($deletedb = 1){
				$path = $pathuploads.$temp['IcType']."/";
				$deletefile = unlink($path.$temp['IcName']);
			}

		}
	// refresh to index()
		redirect('UMS/showIcon', 'refresh');
		
	}	
}
?>