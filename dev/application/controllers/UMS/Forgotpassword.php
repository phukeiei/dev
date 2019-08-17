<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('NoLogin_Controller.php');
class Forgotpassword extends NoLogin_Controller {	
public function __construct(){
parent::__construct();
		$this->load->model('UMS/m_umuser');
}
	
	public function index(){
		// print_r($this->session->all_userdata());
		$data['OK'] = 0;
		//$data['mail']  = $this->m_umforgotpassword->get_all();
		// $Link = "index.php/UMS/forgotpassword/mail3";
		// echo base_url().md5($Link); 
		$data['pass'] = $this->generatePassword();
		$this->output('UMS/v_extras-forgotpassword',$data);
	}
		
	function generatePassword($length = 9, $add_dashes = false, $available_sets = 'lud')
{
	$sets = array();
	if(strpos($available_sets, 'l') !== false)
		$sets[] = 'abcdefghjkmnpqrstuvwxyz';
	if(strpos($available_sets, 'u') !== false)
		$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
	if(strpos($available_sets, 'd') !== false)
		$sets[] = '23456789';
	$all = '';
	$password = '';
	foreach($sets as $set)
	{
		$password .= $set[array_rand(str_split($set))];
		$all .= $set;
	}
	$all = str_split($all);
	for($i = 0; $i < $length - count($sets); $i++)
		$password .= $all[array_rand($all)];
		$password = str_shuffle($password);
	if(!$add_dashes)
		return $password;
		$dash_len = floor(sqrt($length));
		$dash_str = '';
	while(strlen($password) > $dash_len)
	{
		$dash_str .= substr($password, 0, $dash_len) . '-';
		$password = substr($password, $dash_len);
	}
	$dash_str .= $password;
	return $dash_str;
}	
	
	public function mail()
	{
		$this->load->library('email');
			$email=$this->input->post('email');	
			$return = $this->m_umuser->select_by_email($email);
			// print_r($return); 
			if($return){
				// echo $return->UsID;
				$data['pass'] = $this->generatePassword();
				$this->m_umuser->UsPassword = md5("O]O".$data['pass']."O[O");
				$this->m_umuser->UsID = $return->UsID;
				$this->m_umuser->resetpassword();
				$this->email->from('amnard@buu.ac.th', 'SMEs');//ตั้งชื่อและที่อยู่อีเมล์ของคนที่กำลังจะส่งอีเมล์
				
				// echo $email; die;
				// $username=$this->input->post('username');
				$this->email->to($email); //กำหนดที่อยู่ E-mail ของผู้รับ
				//$this->email->cc('sayamon@buu.ac.th');//กำหนดที่อยู่ E-mail ของผู้รับ
				//$this->email->bcc('sayamon@buu.ac.th');//กำหนดที่อยู่ E-mail ของผู้รับ
				$this->email->subject('ยืนยันการเปลี่ยนรหัสผ่าน'); //กำหนดหัวเรื่องอีเมล
				/*$this->email->message 
				( 'ตามที่ท่านขอเปลี่ยนรหัสผ่านการเข้าสู่ระบบ user management systems โปรดคลิ๊กเพื่อเข้าสู่ระบบ  '.'<a href="'.index.php/UMS/forgotpassword/mail3/.';');*/
				$Link = "index.php/UMS/forgotpassword/mail3";
				// echo md5($Link);
				$this->email->message('ตามที่ท่านขอเปลี่ยนรหัสผ่านการเข้าสู่ระบบ ทางผู้ดูแลระบบได้เปลี่ยนรหัสผ่านของท่านเป็น '.$data['pass'].' กรุณาเปลี่ยนรหัสผ่านหลังจากเข้าสู่ระบบแล้ว');
					
				//( 'ตามที่ท่านขอเปลี่ยนรหัสผ่านการเข้าสู่ระบบ user management systems   ' .base_url() . 'index.php/UMS/forgotpassword/mail3'.'/ หรือเข้าสู่ระบบ user management systems '. base_url() .'');
				
				
			/*	$this->email->message 
				( 'ตามที่ท่านขอเปลี่ยนรหัสผ่านการเข้าสู่ระบบ user management systems ขอให้ท่านทำการยืนยันการเปลี่ยนรหัสผ่าน  <a href="'.base_url().'"index.php/UMS/forgotpassword/mail3/"> คลิ๊กที่นี่ </a>');*/
				
				
				//echo $this->email->message('<a href="'.base_url().'"index.php/UMS/forgotpassword/mail3/"> คลิ๊กที่นี่ </a>';);
				

				//กำหนดข้อความเนื้อหาภายในอีเมล์
				
				$this->email->send();//ฟังก์ชันส่งเมล์ คืนค่าเป็นตรรกะ TRUE หรือ FALSE ขึ้นอยู่กับการส่งสำเร็จหรือผิดพลาด สามารถใช้มันอยู่ในเงื่อนไขได้
				//echo $this->email->print_debugger();//ส่งกลับสตริงที่มีข้อความใด ๆ ที่เซิร์ฟเวอร์ส่วนหัวของอีเมลและหลักฐานทางอีเมล์ ที่เป็นประโยชน์สำหรับการแก้จุดบกพร่อง
		
				$data['OK'] = 0;
				$this->output('UMS/v_showmail2',$data);
				}else{
				$data['OK'] = 1;
				$this->output('UMS/v_extras-forgotpassword',$data);
				}
}

public function mail3(){
		$data['OK'] = 1;
		$this->output('UMS/v_showmail3',$data);
}


public function update(){

	$this->m_umuser->UsLogin = $this->input->post('UsLogin');
	$this->m_umuser->UsPassword = $this->input->post('password');
	$this->m_umuser->update();
		$data['OK'] = 1;
		$data['username']  = $this->m_umuser->update_mail();

		
		$this->output('UMS/v_showmail4',$data);
}






}
?>