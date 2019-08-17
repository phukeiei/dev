<?php
/*	UMS Version 1.71 Update 12/03/2557
	add popup() and submenu()
	Copyright (C) 2013 by UMS Team ,Software Engineering of Burapha University.
	This program is free software;you can redistribute it and/or modify it under the terms of the GNU General Public License version 2
	as published by the Free Software Foundation*/
class Speical_Controller extends CI_Controller{	
	public function __construct()
	{ 
		parent::__construct();
		$this->load->library('encrypt');
		$this->load->model('UMS/m_umshowprofile','');
		$this->load->model('UMS/m_umpermission','');
		$this->load->model('UMS/m_umgpermission','');
		$this->load->model('UMS/m_ummenu','');
		$this->load->model('UMS/m_umuser','');
		$this->load->model('UMS/m_umgroup','');
		$this->load->model('UMS/m_umhistory','');
		$this->load->model('UMS/m_umlog','');
		$this->load->model('UMS/m_umtemplate','');
		$this->load->model("UMS/m_umicon");
		$this->load->model("UMS/m_umnotification");// for notification
		$this->ums = $this->load->database('ums', TRUE);
		force_ssl();
		if(!$this->session->userdata('Language')){
			$this->session->set_userdata('Language',"TH");
		}

	}
	function index(){
		$this->output('error');
	}
	/*	header()=> This Function is show the header of the website and user informations
	[[Be Careful]] ,If you want to override.
		The UMS Team have working with config the header by don't coding and Easy to Use.
		it's coming soon in next version....*/
	function header()
	{	
		if($this->session->userdata('UsID')&&$this->config->item('notification_on')=="on") 
		{																					
			$data['news_notification'] = $this->m_umnotification->get_news();			//	for notification
			$data['notification'] = $this->m_umnotification->get_all()->result_array();	//	for notification
		}

		if($this->session->userdata('StID') == null){
			$this->m_umtemplate->StID = 0;
		}else{
			$this->m_umtemplate->StID = $this->session->userdata('StID');
		}
		$data['tem'] = $this->m_umtemplate->get_by_key_sys_join_icon()->row_array();
		if($data['tem']==null){
			$this->m_umtemplate->StID = $this->session->userdata('StID');
			$this->m_umtemplate->add_default();
			$data['tem'] = $this->m_umtemplate->get_by_key_sys_join_icon()->row_array();
		}
		$icon['temp'] = $this->m_umtemplate->get_icon()->result_array();
		foreach($icon['temp'] as $temp){
			$iconname = $temp['HeadIcon'];
		}
		//echo $temp;
		$this->m_umicon->IcName = $iconname;
		$data['Icon'] = $this->m_umicon->get_by_name()->row_array();
		$this->load->view('template/header',$data);
	}
	function header_nologin() 
	{
		if($this->session->userdata('StID') == null){
		$this->m_umtemplate->StID = 0;
		}else{
		$this->m_umtemplate->StID = $this->session->userdata('StID');
		}
		$data['tem'] = $this->m_umtemplate->get_by_key_sys()->row_array();
		if($data['tem']==null){
			$this->m_umtemplate->StID = $this->session->userdata('StID');
			$this->m_umtemplate->add_default();
			$data['tem'] = $this->m_umtemplate->get_by_key_sys()->row_array();
		}
		$icon['temp'] = $this->m_umtemplate->get_icon()->result_array();
		foreach($icon['temp'] as $temp){
			$iconname = $temp['HeadIcon'];
		}
		//echo $temp;
		$this->m_umicon->IcName = $iconname;
		$data['Icon'] = $this->m_umicon->get_by_name()->row_array();
		$this->load->view('template/header_no_login',$data);
		
	}
	function javascript()
	{
		$this->load->view('template/javascript');
	}
	/* 	topbar() => This Function is show Search box and path of website 
		If your system can go to main path by Hyperlink set data Here!! */
	function topbar()
	{	
		if($this->session->userdata('GpID')&&$this->session->userdata('StID'))
		{
			$GpID=$this->session->userdata('GpID');
			$StID=$this->session->userdata('StID');
			$UsID=$this->session->userdata('UsID');
			$data['mainmenu'] = $this->m_ummenu->get_menu_lv($StID,$GpID,$UsID,0)->result_array();
			$data['submenu'] = $this->m_ummenu->get_menu_lv($StID,$GpID,$UsID,1)->result_array();
			if($this->session->userdata('MnID'))
			{
				$data['sidebarpath'] = $this->m_ummenu->get_sidebar_path($this->session->userdata('MnID'));	
			}
			$this->load->view('template/topbar',$data);
		}
		else
		{
			if($this->session->userdata('MnID'))
			{
				$data['sidebarpath'] = $this->m_ummenu->get_sidebar_path($this->session->userdata('MnID'));	
			}
			$this->load->view('template/topbar');
		}
		
	}
	function topbarnew()
	{	
		if($this->session->userdata('GpID')&&$this->session->userdata('StID'))
		{
			$GpID=$this->session->userdata('GpID');
			$StID=$this->session->userdata('StID');
			$UsID=$this->session->userdata('UsID');
			
			$data['mainmenu'] = $this->m_ummenu->get_submenu2()->result_array();
			
			$data['submenu'] = $this->m_ummenu->get_menu_lv($StID,$GpID,$UsID,2)->result_array();
			
			if($this->session->userdata('MnID'))
			{
				$data['sidebarpath'] = $this->m_ummenu->get_sidebar_path($this->session->userdata('MnID'));	
			}
			$this->load->view('template/topbar_new',$data);
		}
		else
		{
			$this->load->view('template/topbar_new');
		}
		
	}
	/*	toolbar() => This Function is show Menu of This workgroup can use in this system
	[[Be Careful]] ,If you want to override
		The UMS Team working with config the icon of all menu 
		it's coming soon in next version....
		*** this version didn't check personnal permission*/
	function sidebar()
	{	
		$this->load->view('template/sidebar');
	}
	// checkUser() => This Function is check session of This user login or not? return true and false
	function checkUser()
	{
		if($this->session->userdata('UsID'))
			return true;
		else
			return false;
	}
	// footer() => This Function is show normal footer 
	function footer()
	{
		$this->load->view('template/footer');
	}

	/*	output(body,data) => This function use to show result of screen
		body is content area want to show 
		data is item want to show in content area*/
	function output($body='',$data='')
	{
		$this->setCRUD($this->session->userdata('MnID'));
		if($this->checkUser())
		{
			$this->header();
			$this->javascript();
			$this->topbar();
			$this->load->view($body,$data);
			$this->footer();
		}
		else
		{// this no login or login
			$this->header_nologin();
			$this->javascript();
			$this->topbar();
			$this->load->view($body,$data);
			$this->footer();
		}
	}
	//  fuction use for HR and REG 
	//  for system that have many Menu
	function outputnew($body='',$data='')
	{
		$this->setCRUD($this->session->userdata('MnID'));
		if($this->checkUser())
		{
			$this->header();
			$this->javascript();
			$this->topbarnew();
			$this->load->view($body,$data);
			$this->footer();
		}
		else
		{
			$this->load->view('Gear/login');
		}
	}

	/* setCRUD(MenuID) => This function
		set Permission of Menu is using by User
		C => Can Create
		R => Can Read
		U => Can Update
		D => Can Delete
		credit : Wittawas Puntumchinda*/
	function setCRUD($mnid)
	{	// for set Permission in the menu
		$X = 1;
        $C = 1;
        $R = 1;
        $U = 1;
        $D = 1;
		//check on Person's Permission
        $person = $this->m_umpermission->SearchByKey($mnid); 
		// if query found may be in 5 permission have empty slot
        if ($person){
            $X = $person['pmX'];
            $C = $person['pmC'];
            $R = $person['pmR'];
            $U = $person['pmU'];
            $D = $person['pmD'];
        } else {// check on WorkGroup's Permission
            $Group = $this->m_umgpermission->SearchByKey($mnid); 
			// if query found may be in 5 permission have empty slot
            if ($Group){
                $X = $Group['gpX'];
                $C = $Group['gpC'];
                $R = $Group['gpR'];
                $U = $Group['gpU'];
                $D = $Group['gpD'];
            }
        }
		//set data session to use menu 
        $data = array(	'X' => $X, 
                    'C' => $C,
                    'R' => $R,
                    'U' => $U,
                    'D' => $D);
        $this->session->set_userdata($data);
		// this session didn't destory 
		// UpGrade in next Version
        return 0;
	}
	/*	setMenu(MenuID) => This function is setting session of menu is using by user now!*/
	public function setMenu($mnid)
	{	/*old
		$this->session->unset_userdata('MnID');
		$this->session->unset_userdata('MnNameT');
		$this->session->unset_userdata('MnLevel');
		$this->session->unset_userdata('MnURL');
		$this->session->set_userdata('MnID',$mnid);
		$menu = $this->m_ummenu->get_menu_url($this->session->userdata('MnID'));
		$this->session->set_userdata('MnNameT',$menu['MnNameT']);
		$this->session->set_userdata('MnLevel',$menu['MnLevel']);
		$this->session->set_userdata('MnURL',$menu['MnURL']);
		if(($menu['MnURL'] == "" || $menu['MnURL'] == "#" || $menu['MnURL'] == "-"))
		{
			redirect(base_url()."index.php/UMS_Controller/submenu",'refresh');
		}
		else
		{
			redirect(base_url()."index.php/".$menu['MnURL'],'refresh');
		}*/
		$this->session->unset_userdata('MnID');
		$this->session->unset_userdata('MnNameT');
		$this->session->unset_userdata('MnNameE');
		$this->session->unset_userdata('MnLevel');
		$this->session->unset_userdata('MnURL');
		$this->session->set_userdata('MnID',$mnid);
		$menu = $this->m_ummenu->get_menu_url($this->session->userdata('MnID'));
		$this->session->set_userdata('MnNameT',$menu['MnNameT']);
		$this->session->set_userdata('MnNameE',$menu['MnNameE']);
		$this->session->set_userdata('MnLevel',$menu['MnLevel']);
		$this->session->set_userdata('MnURL',$menu['MnURL']);
		if(($menu['MnURL'] == "" || $menu['MnURL'] == "#" || $menu['MnURL'] == "-"))
		{
			redirect(base_url()."index.php/UMS_Controller/submenu",'refresh');
		}
		else
		{
			redirect(base_url()."index.php/".$menu['MnURL'],'refresh');
		}
	}
	function fancy()
	{	
		
		$this->load->view('template/fancy');
	}
	function output_fancy($body='',$data='')
	{
		$this->setCRUD($this->session->set_userdata('MnID'));
		if($this->checkUser())
		{
			$this->fancy();
			$this->javascript();
			
			$this->load->view($body,$data);
			
		
		}
		else
		{
			$this->load->view('Gear/login');
		}
	} 
	public function popup($view,$data)
	{
		$this->load->view('template/popup',$data);
	}
	
	public function submenu()
	{	//submenu
		$data['MnSub'] = $this->m_ummenu->get_submenu();
		$this->output('template/v_showsubmenu',$data);
	}
	public function home()
	{
		$this->output("template/v_home");
	}
}

?>