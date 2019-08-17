<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// require(dirname(__FILE__).'/../../../UMS_Controller.php'); //สำหรับ Camp ที่หอ
require(dirname(__FILE__).'/../../UMS_Controller.php'); //สำหรับ Camp
/*
* Controller Bill
* @Auther : Jiramate Phuaphan
* @Edit Last Date : 
*/
class Bill extends UMS_Controller {
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
	
	function index(){
		$this->v_bill();
	}
	
	function v_bill()
	{
		$this->load->model($this->path.'/M_field_reservation', 'mfr');
		$this->data['bill_data'] = $this->mfr->get_data_for_bill()->result();
		$this->output($this->path.'/v_bill',$this->data);
	}

	function v_bill_payment($id)
	{
		$this->data['get_fr_id'] = $id;
		$this->output($this->path.'/v_bill_payment',$this->data);
	}
	function get_bill_json_by_id($id){
		$this->load->model($this->path.'/M_field_reservation', 'mfr');
		$fr_id = $this->input->post("fr_id");
		$bill_data = $this->mfr->get_data_for_bill_by_id($id)->result();
		foreach($bill_data AS $row) {
			$row->in_area = check_in_area($row->fr_moo, $row->fr_dist_id);
			// echo $row->fr_moo.' '.$row->fr_dist_id;
		}
		echo json_encode($bill_data,JSON_UNESCAPED_UNICODE );
	}

	function save_bill() {
		$data = $this->input->post('data');
		$this->load->model($this->path.'/M_field_reservation', 'mfr');
		$main_id = 0;

		foreach($data AS $index => $row) {
			if ($index == 0) {
				$main_id = $row['id'];
			}
			if ($row['id'] != '') {
				$this->mfr->id = $row['id'];
				$this->mfr->update_bill();
			} else {
				$this->mfr->main_id = $main_id;
				$this->mfr->end_time = $row['end_time'];
				$this->mfr->start_time = $row['start_time'];
				$this->mfr->cost = $row['cost'];
				$id = $this->mfr->insert_special();
				// echo $id;
				if ($row['in_area']) {
					$row['in_area'] = 1;
				} else {
					$row['in_area'] = 2;
				}
				$cost_array = $this->calculate_cost($row['start_time'], $row['end_time'], $row['field_id'], $row['in_area'], 2);
				// pre($cost_array);
				foreach($cost_array AS $index => $sub_row) {
					if ($index == 0) {
						$this->mfr->start_time = $row['start_time'];
						$this->mfr->end_time = $sub_row->e_time;
					} else if ($index == sizeof($cost_array) - 1) {
						$this->mfr->start_time = $sub_row->s_time;
						$this->mfr->end_time = $row['end_time'];
					} else {
						$this->mfr->start_time = $sub_row->e_time;
						$this->mfr->end_time = $sub_row->e_time;
					}
					$this->mfr->sub_id = intval($id);
					$this->mfr->cost = $sub_row->cc_cost;
					$this->mfr->hour = $sub_row->hour;
					$this->mfr->seq = $index + 1;

					$this->mfr->insert_cost_detail();
				}
			}
		}
	}

	function calculate_cost($start_time = '', $end_time = '', $field = '', $type = '', $return_type = ''){

		if ($start_time == '') {
			$start_time = $this->input->post('start_time');
		}
		if ($end_time == '') {
			$end_time = $this->input->post('end_time');
		}
		if ($field == '') {
			$field = $this->input->post('field');
		}
		if ($type == '') {
			$type = $this->input->post('type');
		}
		if ($return_type == '') {
			$return_type = $this->input->post('return_type');
		}

        $this->load->model('ffm/backend/M_service', 'ms');

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
			
			if ($time_diff == 0) {
				$time_diff = 1;
			}

			$price = $time_diff * $row->cc_cost;
			$row->hour = $time_diff;
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


}//end class Bill
?>