<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// require(dirname(__FILE__).'/../../../UMS_Controller.php'); //สำหรับ Camp ที่หอ
require(dirname(__FILE__).'/../../UMS_Controller.php'); //สำหรับ Camp
/*
* Controller Home
* @Auther : Jiramate Phuaphan
* @Edit Last Date : 
*/
class Service extends UMS_Controller {
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

	function calculate_cost($start_time = '', $end_time = '', $field = 1, $type = 1, $return_type = 1){
        
        $start_time = '09:00:00';
        $end_time = '20:00:00';
        $field = 1;
        $type = 1;

        $this->load->model($this->path.'/M_service', 'ms');

        $this->ms->start_time = $start_time;
        $this->ms->end_time = $end_time;
        $this->ms->field = $field;
        $this->ms->type = $type;

        $time = $this->ms->get_time()->result();

        foreach($time AS $index => $row) {
            $s_time = new DateTime();
            $e_time = new DateTime();
            if ($index == 0) {
                $n_start_time = $start_time;
                $n_end_time = $end_time;

                if ($n_start_time < $row->cc_start_time) {
                    $n_start_time = $row->cc_start_time;
                }

                if ($n_end_time > $row->cc_end_time) {
                    $n_end_time = $row->cc_end_time;
                }
                    
            } else if ($index == sizeof ($time) - 1) {
                $n_start_time = $row->cc_start_time;
                $n_end_time = $end_time;

                if ($n_end_time > $row->cc_end_time) {
                    $n_end_time = $row->cc_end_time;
                }
            } else {
                $n_start_time = $row->cc_start_time;
                $n_end_time = $row->cc_end_time;
            }

            $start_time_array = explode(':', $n_start_time);
            $end_time_array = explode(':', $n_end_time);

            $s_time->setTime($start_time_array[0], $start_time_array[1], $start_time_array[2] );
            $e_time->setTime($end_time_array[0], $end_time_array[1], $end_time_array[2] );

            $time_diff = $s_time->diff($e_time)->h;

            $price = $time_diff * $row->cc_cost;
            $row->price = $price;
            $row->s_time = $start_time;
            $row->e_time = $end_time;
                
        }

        if ($return_type == 1) {
            echo json_encode($time);
        } else {
            return $time;
        }
        
	}
}//end class
?>