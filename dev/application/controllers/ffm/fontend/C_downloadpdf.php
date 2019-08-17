<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../../UMS_Controller.php");
class C_downloadpdf extends  UMS_Controller{
	function __construct(){
        parent::__construct();  
    }


    function export_pdf(){
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $ignore_table_width = true;
        $ignore_table_percents = true;

        $mpdf->WriteHTML('
        <




        ');//เขียนข้อมูล PDF
        $mpdf->Output(); //ปิดpdf
    }



        /*
         * @Name        Function : getMBStrSplit
         * @Discription : ฟังชั่นที่ทำงานแปลงรุปแบบ string
         * @Input       : ชุดตัวอักษร
         * @Output      : รุปแบบ string แบบใหม่
         * @Author      :  Jiranuwat
         * @Create      Date : 26-1-2562
         */
        // Convert a string to an array with multibyte string
         function getMBStrSplit($string, $split_length = 1){
            mb_internal_encoding('UTF-8');
            mb_regex_encoding('UTF-8'); 
            
            $split_length = ($split_length <= 0) ? 1 : $split_length;
            $mb_strlen = mb_strlen($string, 'utf-8');
            $array = array();
            $i = 0; 
            
            while($i < $mb_strlen)
            {
                $array[] = mb_substr($string, $i, $split_length);
                $i = $i+$split_length;
            }
            return $array;
        }
        /*
         * @Name        Function : getSubStrTH
         * @Discription : ฟังชั่นที่ทำงานแปลงชุดตัวอักษรเป็นภาษาไทย
         * @Input       : ชุดตัวอักษร
         * @Output      : ชุดตัวอักษรเป็นภาษาไทย
         * @Author      :  Jiranuwat
         * @Create      Date : 26-1-2562
         */
        // Get part of string for Character Thai
         function getSubStrTH($string)
        {           
            $array = $this->getMBStrSplit($string);
            $count = 0;
            $action =1;
                    // echo $string;
                    // echo $count;
            for($i=0; $i < count($array); $i++)
            {
                $ascii = ord(iconv("UTF-8", "TIS-620", $array[$i] ));
                //echo $ascii.$array[$i]."<br>";
                if( ($ascii == 209 ||  ($ascii >= 212 && $ascii <= 218 ) || ($ascii >= 231 && $ascii <= 238 )) && $action)
                {
                    //$start++;
                     ++$count;
                    $action = 0;
                    continue;
                }
                $action=1;
                }
            return (strlen($string)/3)-$count;
        }
        /*
         * @Name        Function : StringToDot
         * @Discription : ฟังชั่นที่ทำงานเพื่มจุดหลังชุดตัวอักษร
         * @Input       : ชุดตัวอักษร
         * @Output      : มีจุดหลังชุดตัวอักษร
         * @Author      :  Jiranuwat
         * @Create      Date : 26-1-2562
         */
         function StringToDot($string,$num)
        {
            $dot ='';
            for($i = 0 ; $i< $num-($this->getSubStrTH($string)*1.65);$i++){
                $dot .= '.';
            }
            $dot .= $string;
            for($i = 0 ; $i< $num-($this->getSubStrTH($string)*1.65);$i++){
                $dot .= '.';
            }
            return $dot;
        }
        /*
         * @Name        Function : CalHour
         * @Discription : ฟังชั่นที่ทำงานคำนวณชั่วโมง
         * @Input       : ชั่วโมง สองชุด
         * @Output      : ชั่วโมงอยู่ในช่วงเวลา
         * @Author      :  ข
         * @Create      Date : 19-5-2562
         */
        function CalHour($time_start,$time_end,$start,$end){
            $hour_one = 0;
            $hour_two = 0;
            if(intval($time_start)<$start){
                $hour_one = $start;
            }
            else{
                $hour_one = $time_start;
            }
            if(intval($time_end)>$end){
                $hour_two = $end;
            }
            else{
                $hour_two = $time_end;
            }
            $result = $hour_two-$hour_one;
            if($result <0){
                $result=0;
            }
            return $result;
        }

        function CheckChecked($num){
            if($num>0){
                return "checked='checked'";
            }
        }

        function export_pdf_With_Data(){
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $ignore_table_width = true;
        $ignore_table_percents = true;
        
		$this->load->model('ffm/fontend/M_downloadpdf','md');
        $result = $this->md->Mpdf(1)->result();
        //pre($result);
        // Define the Header/Footer before writing anything so they appear on the first page
        $mpdf->SetHTMLHeader('
        <div style="text-align: center; font-weight: bold;">
        </div>');//หัวกระดาษ
        $date = fullDateTH3($result[0]->fr_start_date);

        $result_date = (explode(" ",$date));
        $date_start = (explode(":",$result[0]->fr_start_time));
        $date_end = (explode(":",$result[0]->fr_end_time));
        $mpdf->WriteHTML('
       
        ');//เขียนข้อมูล PDF
        $mpdf->Output(); //ปิดpdf
    }
}
?>