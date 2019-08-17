<?php
/*	UMS Version 1.2
	Copyright (C) 2013 by UMS Team ,Software Engineering of Burapha University.
	This program is free software;you can redistribute it and/or modify it under the terms of the GNU General Public License version 2
	as published by the Free Software Foundation*/
class NoLogin_Controller extends CI_Controller{
	public function __construct()
	{ 
		parent::__construct();
		$this->load->model('UMS/m_umshowprofile','');
		$this->load->model('UMS/m_umpermission','');
		$this->load->model('UMS/m_umgpermission','');
		$this->load->model('UMS/m_ummenu','');
		$this->load->model('UMS/m_umuser','');
		$this->load->model('UMS/m_umgroup','');
		$this->load->model('UMS/m_umhistory','');
		$this->load->model('UMS/m_umlog','');
		$this->load->model('UMS/m_umtemplate','');
		if(!$this->session->userdata('Language')){
			$this->session->set_userdata('Language',"TH");
		}

	}  
	/*	header()=> This Function is show the header of the website and user informations
	[[Be Careful]] ,If you want to override.
		The UMS Team have working with config the header by don't coding and Easy to Use.
		it's coming soon in next version....*/
	function header()
	{	
		if($this->session->userdata('UsID')) 
		{
			$data['user'] = $this->m_umuser->get_by_id($this->session->userdata('UsID'))->result_array();
		}
		if($this->session->userdata('GpID'))
		{
			$data['workgroup'] = $this->m_umgroup->get_by_id($this->session->userdata('GpID'))->result_array();
		}
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
		$this->load->view('template/topbar');
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
		$this->header();
		$this->javascript();
		$this->load->view($body,$data);
		$this->footer();
	}
	public function index()
	{
		$this->output('UMS/v_home');
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

        return 0;
	}
	/*	setMenu(MenuID) => This function is setting session of menu is using by user now!*/
	public function setMenu($mnid)
	{
		$this->session->unset_userdata('MnID');
		$this->session->set_userdata('MnID',$mnid);
		$menu = $this->m_ummenu->get_menu_url($this->session->userdata('MnID'));
		redirect(base_url()."index.php/".$menu['MnURL'],'refresh');

	}
	public function popup($view='',$data='')
	{
		$data['content'] = $this->load->view($view,$data,true);
		$this->load->view('template/popup',$data);
	}
	public function test()
	{
		$this->popup('UMS/v_home');
	}

}

?>