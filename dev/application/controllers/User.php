<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class User extends UMS_Controller{
	public function __construct()
	{
		parent::__construct();
	} 

	public function ChangePassword()
	{ 
		$data['OK'] = 0;
		$this->output('Gear/changepass',$data);
	}
	
	public function CheckPassChange()
	{ 
		$data['OK'] = 0;
		$this->output('Gear/passchange',$data);
	}
	
	function checkchange()
	{
		
		if($this->m_umuser->check_pass($_POST['oldpass']))
		{
			$data['OK'] = 2;
			$this->m_umuser->changepass(md5("O]O".$_POST['newpass']."O[O"));
			$this->output('Gear/success',$data);
			//redirect('gear', 'refresh');
		}
		else
		{
			$data['OK'] = 1;
			$this->output('Gear/changepass',$data);
		}
		
	}
	
	public function ViewProfile()
	{
		
	}
}

?>