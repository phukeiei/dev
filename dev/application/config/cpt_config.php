<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* ************ Main ******************* */
$config['cpt_folder']  = "cpt/";
$config['cpt_uploads_dir']  = "/var/www/uploads/tsp60/Municipality/".$config['cpt_folder'];
$config["cpt_module_report"] 	= $config["cpt_folder"]."report/";	

/************* Database ********************/
$config["cpt_dbname"] 	= "tsp60_cptdb"; // ชื่อฐานข้อมูล cpt
$config["hr_dbname"] 	= "tsp60_hrdb";	//db hr 	จัดการข้อมูลบุคคลากร
/* Variable option */
$config["cpt_year_option"] = array(   
							array(	"key"	=> "bgyCalendar",
									"name"	=> "ปีปฏิทิน",
									"flag_ocms" => false
							
							),
							array(	"key"	=> "bgyBudget", 
									"name"	=> "ปีงบประมาณ",
									"flag_ocms" => true
							),
							array(	"key"	=> "bgyAcademic",
									"name" 	=> "ปีการศึกษา",
									"flag_ocms" => true
							)						 
						);	
?>