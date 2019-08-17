<?php
class Testldap extends CI_Controller{	
	public function __construct()
	{ 
		parent::__construct();
	}
	public function index()
	{
		$this->load->library('service_ldap');
		if($this->service_ldap->connect())
		{
			echo "Connect Server Idap Complete!<br />";
		}
		if($this->service_ldap->authenticate('amnard','welcomeair'))
		{
			echo "User amnard Authentication OK<br />";
		}
		else
		{
			echo "User amnard False<br />";
		}

		if($this->service_ldap->authenticate('srv5','1234@asdf'))
		{
			echo "User srv5 Authentication OK<br />";
		}
		else
		{
			echo "User srv5 False2<br />";
		}
		if($this->service_ldap->authenticate('57920642','0945523472'))
		{
			echo "User 57920642 Authentication OK<br />";
		}
		else
		{
			echo "User 57920642 False3<br />";
		}
		$this->service_ldap->close();
	}
}

?>