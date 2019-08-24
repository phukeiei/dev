<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/../../UMS_Controller.php");
class Swm_report_management extends  UMS_Controller
{

    public $user;

    function __construct()
    {
        parent::__construct();
        $this->user = $this->session->userdata();   
    }
    function index()
    {
        $this->output('swm/backend/report/v_report');
    }


}
