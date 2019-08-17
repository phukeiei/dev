<?php
// Config  Sha 
$config['sha_folder']  = "sha/";
$config['sha_folder_front']  = "frontend/";
$config['sha_folder_back']  = "backend/";

$config['sha_parents_relationship']  = array( '1'=>'อยู่ร่วมกัน' , '2'=>'แยกกันอยู่' , '3'=>'หย่า'
, '4'=>'บิดาหรือมารดาถึงแก่กรรม' , '5'=>'บิดาและมารดาถึงแก่กรรม' , '6'=>'บิดาหรือมารดาแต่งงานใหม่' , '7'=>'บิดาและมารดาแต่งงานใหม่'
 , '8'=>'อื่นๆ' );
$config['sha_live_with']  = array( '1'=>'บิดาและมารดา' , '2'=>'บิดา' , '3'=>'มารดา' , '4'=>'ญาติ'  ); 
$config['sha_photos_directory']  = '/var/www/uploads/tsp60/Municipality/sha/photos/';

$config['sha_app_status']  = array( '1'=>'บันทึกข้อมูลนักเรียน' , '2'=>'บันทึกข้อมูลที่อยู่' , '3'=>'บันทึกข้อมูลผู้ปกครอง' , '4'=>'บันทึกข้อมูลสถานะผู้ปกครอง' , '5'=>'ยืนยันใบสมัคร');
$config['sha_process_status']  = array( '1'=>'รอผลการคัดเลือก' , '2'=>'ผ่านการคัดเลือก' , '3'=>'ไม่ผ่านการคัดเลือก' );
$config['sha_report_to_status']  = array( ''=>'รอผลรายงานตัว' ,  'Y'=>'มารายานตัว' , 'N'=>'ไม่มารายานตัว'   );

?>