<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('UMS_Controller.php');
class Groupassign extends UMS_Controller{
// last edited : 27/03/2557 11:40
	public function __construct(){
		parent::__construct();
		$this->load->model('UMS/m_umuser');
		$this->load->model('UMS/m_umsystem');
		$this->load->model('UMS/m_umpermission');
		$this->load->model('UMS/m_ummenu');
		$this->load->model('UMS/m_umusergroup');
		$this->load->model('UMS/m_umgroup');
		$this->load->model('UMS/m_umwgroup');
		$this->load->model('UMS/m_umquestion');
		$this->load->model('UMS/m_umdepartment');
		$this->load->model('UMS/da_umloggp');
		$this->load->model('UMS/da_umsync');
		$this->load->model('UMS/m_umgroupdefault');
		$this->load->library('mpdf');
	}

	public function index() {
		$data['wgroup'] = $this->m_umwgroup->get_all();
		$data['syncfile'] = $this->da_umsync->get_all_groupadd();
		$this->output('UMS/v_groupassign',$data);
	}
	public function search($wgid){
		$wgroup_count = $this->m_umuser->get_count_wg($wgid)->row_array();
		// Show Option in Insert Form
		$sysname=$this->m_umgroup->show_all()->result_array();
		$persys = $this->m_umgroupdefault->get_perSystem($wgid)->result_array();
		header ('Content-type: text/html; charset=utf-8');
		echo '<input type="hidden" name="wgid" value="'.$wgid.'" />';
		echo '<label class="da-form-label">จำนวนผู้ใช้ในกลุ่ม</label>
            <div class="da-form-item">'.$wgroup_count['wgcount'].'</div>';
		echo '<div class="da-form-row"><table class="da-table"><tbody>';		
		foreach($sysname as $sys) {
			$check = "";
			$hdcheck = 0;
			foreach($persys as $per){
				if($sys['GpID'] == $per['GpID']){
					$check = "checked";
					$hdcheck = 1;
				}
			}

			echo '<tr><td><input type="checkbox" name = "'.$sys["GpID"].'" id="'.$sys["GpID"].'"'.$check.' onchange="checkboxselect('.$sys["GpID"].')"> 
				<input type="hidden" name = "hidden'.$sys['GpID'].'" value = "'.$hdcheck.'"></td>
				<td>'.$sys['StNameT'].'&nbsp; ( '.$sys['GpNameT'].' )</td></tr>';
		}
		echo '</tbody></table></div>';
		echo '<div class="da-button-row">
			<input id="submit" class="da-button green" type="submit" value="บันทึก" name="submit"></input>
			</div>';
	}
	public function addgroup(){
		//echo $this->input->post('wgid').'<br />';
		$wgid = $this->input->post('wgid');
		$wguser = $this->m_umuser->get_by_wgid($wgid);
		/* DEBUGGER
		foreach($wguser->result_array() as $user){
			echo $user['UsID'].' '; 
			echo $user['UsName'].'<br />';
		}
		*/
		//init pdf header
		$pdf_no=1;
		$pdf_header = "<h1>Group Add Information</h1><br />";
		$pdf_thead = "<table border='1'><tr><td>No.</td><td>FirstName LastName</td><td>Username</td><td>Group</td><td>System</td></tr>";
		$pdf_endtable ="</table>";
		$pdf_content ="";
		//
		$allgroup = $this->m_umgroup->show_all();
		foreach($allgroup->result_array() as $allgp){
			if($this->input->post('hidden'.$allgp['GpID']) == 1){
				//echo $allgp['GpID'].' '.$allgp['GpNameT'].'<br />';
				$user = $this->m_umuser->get_user_not_own_group($allgp['GpID'],$wgid);
				foreach($user->result_array() as $usr){
					/* DEBUGGER
					echo $usr['UsID'].' '; 
					echo $usr['UsName'].'<br />';
					*/
					$this->m_umusergroup->UgID = 1;
					$this->m_umusergroup->UgGpID = $allgp['GpID'];
					$this->m_umusergroup->UgUsID = $usr['UsID'];
					$this->m_umusergroup->insert();
					// Save History
					$sqlgp = "( 1 , ".$allgp['GpID']." , ".$usr['UsID']." )";
					$desc = "insert umusergroup ( UgID , UgGpID , UgUsID )";
					$HtID = $this->m_umhistory->insert("umusergroup",NULL,$sqlgp,$usr['UsID'],$desc);
					// Save Log
					$this->m_umlog->adddata("umusergroup",$HtID);
					// Save Group Log
					$this->da_umloggp->UsID = $usr['UsID'];
					$this->da_umloggp->GpID = $allgp['GpID'];
					$this->da_umloggp->insert();
					//edit here generate pdf 
					$pdf_content .= "<tr><td>".$pdf_no++."</td><td>".$usr['UsName']."</td><td>".$usr['UsLogin']."</td><td>".$allgp['GpNameT']."</td><td>".$allgp['StAbbrE']."</td></tr>";
				
				}
			}
		}
		//edit here generate pdf 
		if($pdf_no > 1){
			$this->mpdf->useAdobeCJK = true;
			$this->mpdf->SetAutoFont(AUTOFONT_ALL);
			$this->mpdf->WriteHTML($pdf_header.$pdf_thead.$pdf_content.$pdf_endtable);
			$filename = "groupadd".date("Ymdhi");
			$this->mpdf->Output('/home/umsuser/uploads/ums/umspdf/'.$filename.'.pdf','F');
			$this->da_umsync->insert($filename);
		}
		redirect('UMS/groupassign','refresh');
	}
	
}
?>