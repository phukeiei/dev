<!--
/*

$user_post,
$user_ps_id,
$exp_date

$key = $user_ps_id[0];
echo $user_post['reg_date'];
echo $key->ps_fname;
echo $key->ps_lname;

*/
-->
<?php

$key = $user_ps_id;
/*echo"<br>";
print_r($user_post);
echo"<br>";
print_r($key);*/
//pre($qu_user);
?>
    <!--h1>ข้อมูลผู้สมัคร</h1>
    <div>วันที่สมัคร : <?php echo $user_post['reg_date']; ?></div>
    <div>คำนำหน้าชื่อ : <?php echo $key->pf_name; ?></div>
    <div>ชื่อ : <?php echo $key->ps_fname; ?></div>
    <div>นามสกุล : <?php echo $key->ps_lname; ?></div>
    <div>อาชีพ : <?php echo $user_post['reg_job']; ?></div>
    <div>สถานที่ทำงาน : <?php echo $user_post['reg_p_job']; ?></div>
    <div>เบอร์โทรศัพท์ : <?php echo $key->psd_cellphone; ?></div>

    <h1>ข้อมูลบุคคลอ้างอิง</h1>
    <div>คำนำหน้าชื่อ : <?php echo ($user_post['reg_prefix'] == "1")?"นาย":"นาง"; ?></div>
    <div>ชื่อ : <?php echo $user_post['reg_ref_fname']; ?></div>
    <div>นามสกุล : <?php echo$user_post['reg_ref_lname']; ?></div>
    <div>เบอร์โทรศัพท์ : <?php echo $user_post['reg_ref_tel']; ?></div-->
    <?php
    /*pre($key );
    pre($user_ps_id);
    pre($user_post);*/

        $dd = explode("-", $qu_user[0]['birthday']);
        $tt= ((int)$dd[0] + 543);
        $dd = $dd[2] . "/" . $dd[1] . "/" . ((int)$dd[0] + 543);

        $dd1 = explode("/", $user_post['reg_date']);
        $age = (((int)date("Y"))+543 - ((int)$dd[0] + 543));
        $tt = (((int)date("Y"))+543 - ($tt));
        
    ?>
<style type="text/css">
.tg  {border:0;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;}
.tg .tg-0lax{text-align:left;vertical-align:top}
.header-text {
    text-align: center !important;
    font-size: 25px
}
li {
    padding-bottom:10px !important;
}
</style>
<table class="tg" width="100%">
  <tr heigth="300">
    <th class="tg-0lax" colspan="2" style="text-align: center;"><span class="header-text">ใบสมัครสมาชิกศูนย์นันทนาการเพื่อประชาชน</span>
    </th>
  </tr>
  <tr>
    <td colspan="2" style="float:right !important;width: 100%;">
        <table class="photo_frame" align="right" style="border: 1px solid black" width="20%">
        <tr>
            <td style="text-align: center;">
            <br><br><p align="center">ติดรูปถ่าย<br><br>ขนาด&nbsp;1&nbsp;นิ้ว</p><br><br><br><br>
            </td>
        </tr>
    </table></td>
  </tr>
  <tr style="height: 0px">
      <td colspan="2"><hr></td>
  </tr>

  <tr>
    <td class="tg-0lax" style="vertical-align: bottom;">&emsp;&emsp;&emsp;&emsp;&emsp;รหัสสมาชิก<br>
    <?php echo str_pad( (isset($qu_user[0]['su_code'])?$qu_user[0]['su_code']:''), 50, ".", STR_PAD_BOTH);?>

    </td>
    <td class="tg-0lax" style="vertical-align: bottom;text-align: right;">
    <br>วันที่ <?php echo str_pad($user_post['reg_date'], 50, ".", STR_PAD_BOTH);?></td>
  </tr>
  <tr>
    <td class="tg-0lax" colspan="2">
        <input type="checkbox"/> เด็กชาย &nbsp; <input type="checkbox"/> เด็กหญิง &nbsp; <input type="checkbox"/> นาย &nbsp; <input type="checkbox"/> นางสาว<br><br>
        ชื่อ <?php echo str_pad($key->ps_fname, 30, ".", STR_PAD_BOTH);?> &emsp;นามสกุล <?php echo str_pad($key->ps_lname , 30, ".", STR_PAD_BOTH);?>&emsp;&emsp; เกิดวันที่ <?php echo str_pad( (isset($dd)?$dd:''), 40, ".", STR_PAD_BOTH);?><br><br>
        อายุ <?php echo str_pad(($tt?$tt:''), 50, ".", STR_PAD_BOTH);?> &emsp;อาชีพ <?php echo str_pad($user_post['reg_job'], 50, ".", STR_PAD_BOTH);?> <br><br>
        สถานที่ทำงาน/สถานศึกษา <?php echo str_pad($user_post['reg_p_job'], 100, ".", STR_PAD_BOTH);?><br><br>
        ที่อยู่ปัจจุบัน <?php echo str_pad((isset($qu_user[0]['addr'])?$qu_user[0]['addr']:''), 50, ".", STR_PAD_BOTH);?> ตำบล <?php echo str_pad((isset($qu_user[0]['dist'])?$qu_user[0]['dist']:''), 50, ".", STR_PAD_BOTH);?><br><br>
        อำเภอ <?php echo str_pad((isset($qu_user[0]['amphor'])?$qu_user[0]['amphor']:''), 45, ".", STR_PAD_BOTH);?> &emsp;จังหวัด <?php echo str_pad((isset($qu_user[0]['province'])?$qu_user[0]['province']:''), 42, ".", STR_PAD_BOTH);?> &emsp;โทร <?php echo str_pad($key->psd_cellphone, 40, ".", STR_PAD_BOTH);?><br><br>
        ผู้ปกครองหรือบุคคลอ้างอิงที่สามารถติดต่อได้ <br><br>
        ชื่อ <?php echo str_pad($user_post['reg_ref_fname'], 45, ".", STR_PAD_BOTH);?> นามสกุล <?php echo str_pad($user_post['reg_ref_lname'], 45, ".", STR_PAD_BOTH);?> โทร <?php echo str_pad($user_post['reg_ref_tel'], 46, ".", STR_PAD_BOTH);?> <br><br>
        &emsp;&emsp;&emsp;มีความประสงค์จะสมัครสมาชิก เพือเข้าใช้ศูนย์นันทนาการเพื่อประชาชน <br><br>
        &emsp;&emsp;&emsp;ข้าพเจ้าได้ทราบระเบียบการปฎิบัติเกี่ยวกับการใช้ศูนย์กีฬาและอุปกรณ์อำนวยความสะดวกประจำสนามกีฬาของเทศบาลฯ&emsp;เป็นที่เข้าใจดีแล้ว&emsp;ทั้งนี้ในการใช้สนามกีฬาต่างๆ&emsp;ให้อยู่ในความรับผิดชอบของข้าพเจ้าเองและจะไม่ก่อให้เกิดความผูกพันหรือความผูกพันหรือความรับผิดชอบแก่เทศบาลตำบลบางปลาในทางกฎหมายไม่ว่าในกรณีใดๆ&emsp;และข้าพเจ้าจะไม่เรียกร้องสิทธิ์ใดๆ&emsp;ทั้งสิ้น <br><br>
        &emsp;&emsp;&emsp;ข้าพเจ้ารับรอง ข้อความข้างต้นนี้เป็นความจริงทุกประการเเละจะถือตามระเบียบโดยเคร่งครัด
  </tr>
  <tr>
    <td style="height: 10px;"></td>
</tr>
  <tr > 
    <td class="tg-0lax" rowspan="1" style="width:50%;text-align: center;border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;">
        <span><b>หลักฐานการสมัคร</b></span>
    </td>
    <td class="tg-0lax" style="text-align: center;">
        ลงชื่อ&nbsp;(<?php echo str_pad('x', 30, "_", STR_PAD_BOTH);?>)&nbsp;ผู้สมัคร<br><br>
        (<?php echo str_pad('x', 30, "_", STR_PAD_BOTH);?>)
    </td>
  </tr>
 
  <tr>
    <td class="tg-0lax" rowspan="1" style="width:50%;text-align: left;border-bottom: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;">
        <ol style="text-align: left !important;">
            <li>ใบสมัครที่กรอกข้อมูลครบถ้วนแล้ว</li>
            <li>รูปถ่ายหน้าตรงไม่สวมหมวก 1 นิ้ว 2 รูป</li>
            <li>สำเนาบัตรประชาชน</li>
            <li>เงินค่าสมัคร</li>
        </ol>
    </td>
    <td class="tg-0lax" style="text-align: center;vertical-align: bottom;">สำหรับเจ้าหน้าที่<br>
    ได้ตรวจสอบหลักฐานถูกต้องแล้ว<br>
    ลงชื่อ&nbsp;(<?php echo str_pad('x', 30, "_", STR_PAD_BOTH);?>)&nbsp;ผู้ตรวจสอบ<br><br>   
    <span style="line-height: 50px;">(<?php echo str_pad('x', 30, "_", STR_PAD_BOTH);?>)</span>
    </td>
  </tr>
</table>