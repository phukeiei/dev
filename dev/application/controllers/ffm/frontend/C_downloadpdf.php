<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/../Ffm_Controller.php");
class C_downloadpdf extends  Ffm_Controller{
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
        <div style = "font-family:th sarabun psk">
            <div style="text-align:center;font-weight:bold";>คำร้องขอใช้สนามฟุตบอลหญ้าเทียม <br>
            เทศบาลตำบลบางปลา
            </div>
            <div style="text-align:right";>วันที่............เดือน.............................พ.ศ.................</div>
            <div style="text-align:left";>เรียน นายกเทศมนตรีตำบลบางปลา</div>
            <div><dd>ข้าพเจ้า..........................................................................................อยู่บ้านเลขที่................หมู่................</div>
            <div>ตำบล...........................อำเภอ............................จังหวัด.........................เบอร์โทร..............................................</div>
            <div>มีความประสงค์ขอใช้สนามฟุตบอลหญ้าเทียมตำบลบางปลา โคยเสียค่าอัตราบริการตามระเบียบฯ</div>
            <table width="85%" align = "center">
                <tr>
                    <td colspan = "1"></td>
                    <td style="text-align:left";><input type = "checkbox" >
                        เวลา 09.00 - 16.00 น.
                    </td>
                    <td style="text-align:right";>
                        จำนวน .......................... ชั่วโมง
                    </td>
                </tr>
                <tr >
                    <td rowspan = "1"></td>
                </tr>
                <tr>
                    <td colspan = "1"></td>
                    <td style="text-align:left";><input type = "checkbox" >
                        เวลา 19.00 - 21.00 น.
                    </td>
                    <td style="text-align:right";>
                        จำนวน .......................... ชั่วโมง
                    </td>
                </tr>
                <tr >
                    <td rowspan = "1"></td>
                </tr>
                <tr>
                    <td colspan = "1"></td>
                    <td style="text-align:left";><input type = "checkbox" >
                        เวลา หลังเวลา 19.00 น. (ชุมชน)
                    </td>
                    <td style="text-align:right";>
                        จำนวน .......................... ชั่วโมง
                    </td>
                </tr>
                <tr >
                    <td rowspan = "1"></td>
                </tr>
            </table>

            <div>
                <dd><dd>เพื่อใช้ในกิจกรรม/โครงการ.....................................................................................................................
            </div>

            <div>
                <dd><dd>ในวันที่ ........................... เดือน ............................................................ พ.ศ. ......................................
            </div>

            <div>
                <dd><dd>ถึงวันที่ ........................... เดือน ............................................................ พ.ศ. ......................................
            </div>

            <div>
                <dd><dd>รวมเวลา ................................ ชั่วโมง โดยเสียค่าบริการเป็นเงิน ......................................................บาท
            </div>

            <div>
                <dd><dd>จำนวนคน ........................................................ (ประมาณ)
            </div>


            <div>
                <dd>ข้าพเจ้าได้รับทราบระเบียบการใช้สนาม ฯ เรียบร้อยแล้วทุกประการ หากข้าพเจ้าไม่ปฏิบัติตาม ข้าพเจ้ายินดี
            </div>
            <div>
                ให้เทศบาลบางปลาดำเนินการตามที่ควร
            </div>

            <table width="85%">
                <tr>
                    <td colspan = "125"></td>
                    <td style="text-align:left";>
                        ลงชื่อ ................................................. ผู้ขอใช้สนาม
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
                    </td>
                </tr>

                <tr>
                    <td colspan = "3"></td>
                    <td style="text-align:right";>
                    </td>
                </tr>
            </table>

            <table border = "1" width = "100%" style="border-collapse: collapse">
                <tr width = "50%">
                    <td> เรียน รองปลัดเทศบาล
                    <p>( ) อนุญาต</p><br>
                    ( ) ไม่อนุญาต................................................................ <br>
                    ..................................................................................
                    <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;..................................
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ผู้อำนวยการกองการศึกษา)
                    </td>
                    <td>เรียน ปลัดเทศบาล
                    <p>( ) อนุญาต</p><br>
                    ( ) ไม่อนุญาต................................................................ <br>
                    ..................................................................................
                    <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;..................................
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ผู้อำนวยการกองการศึกษา)
                    </td>
                </tr>

                <tr width = "50%">
                    <td> เรียน นายกเทศมนตรีบางปลา
                    <p>( ) อนุญาต</p><br>
                    ( ) ไม่อนุญาต................................................................ <br>
                    ..................................................................................
                    <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;..................................
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ผู้อำนวยการกองการศึกษา)
                    </td>
                    
                    <td> ความเห็นนายกเทศมนตรี
                    <p>( ) อนุญาต</p><br>
                    ( ) ไม่อนุญาต................................................................ <br>
                    ..................................................................................
                    <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;..................................  
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ผู้อำนวยการกองการศึกษา)
                    </td>
                </tr>

            </table>
            <br>

            <table align="right" border = "1" width = "77%" style="border-collapse: collapse">
                <tr width = "50%">
                    <td>
                        <p><b><u>หมายเหตุ</p>
                        <p><b>อัตราค่าบริการ</p>
                            <table width = "100%">
                                <tr width = "50%">
                                    <td>
                                        - 09.00 - 16.00 น.
                                        <br>
                                        - 16.00 - 19.00 น.
                                        <br>
                                        - หลังเวลา 19.00 (ชุมชน)
                                        <br>
                                        - หลังเวลา 19.00 น. (คนภายนอก)
                                    </td>
                                    <td style="text-align:right";>
                                        ชั่วโมงละ ชุมชน 300.- บาท / ทั่วไป 600.- บาท
                                        <br>
                                        ฟรี
                                        <br>
                                        ชั่วโมงละ 500.- บาท
                                        <br>
                                        ชั่วโมงละ 700.- บาท
                                    </td>
                                </tr>
                            </table>
                    </td>
                </tr>
            </table>




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
        function CalDay($time_zero,$timeone,$timetwo,$day){
            $sum = 0;
            for($i=0;$i<=$day;$i++){
                $sum += $time_zero+$timeone+$timetwo;
            }
            return $sum;
        }
        function CheckChecked($num){
            if($num>0){
                return "checked='checked'";
            }
        }

        function export_pdf_With_Data($id="1"){
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $ignore_table_width = true;
        $ignore_table_percents = true;
        
        $this->load->model('ffm/frontend/M_downloadpdf','md');
        $result = $this->md->Mpdf($id)->result();
        //pre($result);die;
        // Define the Header/Footer before writing anything so they appear on the first page
        $mpdf->SetHTMLHeader('
        <div style="text-align: center; font-weight: bold;">
        </div>');//หัวกระดาษ
        $date = fullDateTH3($result[0]->fr_start_date);
        $result_date = (explode(" ",$date));
		
        $time_start = (explode("-",$result[0]->fr_start_date));
        $time_end = (explode("-",$result[0]->fr_end_date));
        $date_start = (explode(":",$result[0]->fr_start_time));
        $date_end = (explode(":",$result[0]->fr_end_time));
        $S_hour_one = 0;
        $S_hour_two = 0;
        if($result[0]->ps_in_area=="N"){
            $S_hour_one = $this->CalHour($date_start[0],$date_end[0],19,21);
        }
        else{
            $S_hour_two = $this->CalHour($date_start[0],$date_end[0],19,21);
        }
		 $now = strtotime($result[0]->fr_start_date);
        $your_date = strtotime($result[0]->fr_end_date);
        $datediff =  $your_date-$now;

        $today = ($datediff / (60 * 60 * 24));
        $mpdf->WriteHTML('
        <div style = "font-family:th sarabun psk">
            <div style="text-align:center;font-weight:bold";>คำร้องขอใช้สนามฟุตบอลหญ้าเทียม <br>
            เทศบาลตำบลบางปลา
            </div>
            <div style="text-align:right";>
          
                วันที่ '.$this->StringToDot($result_date[0],4).'
                เดือน'.$this->StringToDot($result_date[1],20).'
                พ.ศ'.$this->StringToDot($result_date[3],8).'
            </div>
            <div style="text-align:left";>เรียน นายกเทศมนตรีตำบลบางปลา</div>
            <div><dd>
            ข้าพเจ้า'.$this->StringToDot($result[0]->fr_first_name." ".$result[0]->fr_last_name,49).
            'อยู่บ้านเลขที่&nbsp;&nbsp;&nbsp;'.$this->StringToDot($result[0]->fr_address,8).' หมู่'.$this->StringToDot($result[0]->fr_moo,4).'</div>
            <div>ตำบล'.$this->StringToDot($result[0]->dist_name,26).'อำเภอ'.$this->StringToDot($result[0]->amph_name,16).'จังหวัด'.$this->StringToDot($result[0]->pv_name,16).'เบอร์โทร'.$this->StringToDot($result[0]->fr_tel,8).'</div>

            <div>มีความประสงค์ขอใช้สนามฟุตบอลหญ้าเทียมตำบลบางปลา โคยเสียค่าอัตราบริการตามระเบียบฯ</div>
            <table width="85%" align = "center">
                <tr>
                '.'if(){
                    }else{
                        }'.'
                    <td colspan = "1"></td>
                    <td style="text-align:left";><input type = "checkbox" '.$this->CheckChecked($this->CalHour($date_start[0],$date_end[0],9,16)).'>
                        เวลา 09.00 - 16.00 น.
                    </td>
                    <td style="text-align:right";>
                        จำนวน '.$this->StringToDot($this->CalHour($date_start[0],$date_end[0],9,16),16).' ชั่วโมง
                    </td>
                </tr>
                <tr >
                    <td rowspan = "1"></td>
                </tr>
                <tr>
                    <td colspan = "1"></td>
                    <td style="text-align:left";><input type = "checkbox" '.$this->CheckChecked($S_hour_one).'>
                        เวลา 19.00 - 21.00 น.
                    </td>
                    <td style="text-align:right";>
                        จำนวน '.$this->StringToDot($S_hour_one,16).' ชั่วโมง
                    </td>
                </tr>
                <tr >
                    <td rowspan = "1"></td>
                </tr>
                <tr>
                    <td colspan = "1"></td>
                    <td style="text-align:left";><input type = "checkbox" '.$this->CheckChecked($S_hour_two).'>
                        เวลา หลังเวลา 19.00 น. (ชุมชน)
                    </td>
                    <td style="text-align:right";>
                        จำนวน '.$this->StringToDot($S_hour_two,16).' ชั่วโมง
                    </td>
                </tr>
                <tr >
                    <td rowspan = "1"></td>
                </tr>
            </table>

            <div>
                <dd><dd>เพื่อใช้ในกิจกรรม/โครงการ'.$this->StringToDot($result[0]->fr_project,54).'
            </div>

            <div>
                <dd><dd>ในวันที่ '.$this->StringToDot($time_start[2],10).' เดือน '.$this->StringToDot(convertMonthNumberToString($time_start[1]),32).' พ.ศ. '.$this->StringToDot($time_start[0],16).'
            </div>

            <div>
                <dd><dd>ถึงวันที่ '.$this->StringToDot($time_end[2],10).' เดือน '.$this->StringToDot(convertMonthNumberToString($time_end[1]),32).' พ.ศ. '.$this->StringToDot($time_end[0],16).'
            </div>

            <div>
                <dd><dd>รวมเวลา '.$this->StringToDot($this->CalHour($date_start[0],$date_end[0],9,16)+$S_hour_one+$S_hour_two,16).' ชั่วโมง โดยเสียค่าบริการเป็นเงิน '.$this->StringToDot($result[0]->fr_cost,20).'บาท
            </div>

            <div>
                <dd><dd>จำนวนคน '.$this->StringToDot($result[0]->fr_number,16).' (ประมาณ)
            </div>


            <div>
                <dd>ข้าพเจ้าได้รับทราบระเบียบการใช้สนาม ฯ เรียบร้อยแล้วทุกประการ หากข้าพเจ้าไม่ปฏิบัติตาม
            </div>

            <div>
                ข้าพเจ้ายินดีให้เทศบาลบางปลาดำเนินการตามที่ควร
            </div>

            <table width="85%">
                <tr>
                    <td colspan = "110"></td>
                    <td style="text-align:left";>
                        ลงชื่อ ............................................... ผู้ขอใช้สนาม
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
                    </td>
                </tr>

                <tr>
                    <td colspan = "3"></td>
                    <td style="text-align:right";>
                    </td>
                </tr>
            </table>

            <table border = "1" width = "100%" style="border-collapse: collapse">
                <tr width = "50%">
                    <td> เรียน รองปลัดเทศบาล
                    <p>( ) อนุญาต</p><br>
                    ( ) ไม่อนุญาต................................................................ <br>
                    ..................................................................................
                    <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;..................................
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ผู้อำนวยการกองการศึกษา)
                    </td>
                    <td>เรียน ปลัดเทศบาล
                    <p>( ) อนุญาต</p><br>
                    ( ) ไม่อนุญาต................................................................ <br>
                    ..................................................................................
                    <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;..................................
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ผู้อำนวยการกองการศึกษา)
                    </td>
                </tr>

                <tr width = "50%">
                    <td> เรียน นายกเทศมนตรีบางปลา
                    <p>( ) อนุญาต</p><br>
                    ( ) ไม่อนุญาต................................................................ <br>
                    ..................................................................................
                    <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;..................................
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ผู้อำนวยการกองการศึกษา)
                    </td>
                    
                    <td> ความเห็นนายกเทศมนตรี
                    <p>( ) อนุญาต</p><br>
                    ( ) ไม่อนุญาต................................................................ <br>
                    ..................................................................................
                    <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;..................................  
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ผู้อำนวยการกองการศึกษา)
                    </td>
                </tr>

            </table>
            <br>

            <table align="right" border = "1" width = "77%" style="border-collapse: collapse">
                <tr width = "50%">
                    <td>
                        <p><b><u>หมายเหตุ</p>
                        <p><b>อัตราค่าบริการ</p>
                            <table width = "100%">
                                <tr width = "50%">
                                    <td>
                                        - 09.00 - 16.00 น.
                                        <br>
                                        - 16.00 - 19.00 น.
                                        <br>
                                        - หลังเวลา 19.00 (ชุมชน)
                                        <br>
                                        - หลังเวลา 19.00 น. (คนภายนอก)
                                    </td>
                                    <td style="text-align:right";>
                                        ชั่วโมงละ ชุมชน 300.- บาท / ทั่วไป 600.- บาท
                                        <br>
                                        ฟรี
                                        <br>
                                        ชั่วโมงละ 500.- บาท
                                        <br>
                                        ชั่วโมงละ 700.- บาท
                                    </td>
                                </tr>
                            </table>
                    </td>
                </tr>
            </table>

        ');//เขียนข้อมูล PDF
        $mpdf->Output(); //ปิดpdf
    }
}
?>