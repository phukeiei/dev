    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->
    <style>
.hover:hover, .hover:active:hover, .hover:focus {
    outline: none;
    background-color: #17bab8;
    color: #ffffff;
}
</style>


<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
             <h2><i class="fas fa-history"></i>ประวัติการเข้าใช้สนามของศูนย์นันทนาการ (สนามฟุตบอล)</h2>
            <div class="panel-ctrls"></div>
            
		</div>
		<div class="panel-body">
            <div class="form-horizontal">
            <table class="table table-hover m-n dataTable-Export"  id="" cellspacing="0">
                <thead>
                    <tr>
                        <th>ชื่อสนาม</th>
                        <th>ช่วงเวลา</th>
                        <th>จำนวนผู้จองทั้งหมด</th>
                        <th>ชื่อผู้ถูกอนุมัติ</th>
                        <th>ประเภทผู้ใช้</th>
                        <th>ดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>    
          
             <?php   foreach($ff_pp as $row){   ?>
              <tr>
                        <?php if($row->fr_status==2||$row->fr_status==6){ ?>
                            <td>  <?php  echo $row->ff_name ; ?> </td>
                            <td class = "text-center">  <?php  echo substr($row->fr_start_time,0,5)."-".substr($row->fr_end_time,0,5) ; ?> </td>
                            <td class = "text-center">  <?php  echo $row->sum_ ; ?> </td>
                            <td>  <?php  echo $row->pf_name.$row->fr_first_name." ".$row->fr_first_name ; ?> </td>
                            <?php if($row->dist_name=="บ้านเกาะ"){ ?>
                                <td> ภายในเขต </td>
                        <?php  }else{ ?>
                            <td> นอกเขต </td>


                       <?php } ?>
                       <td class = "text-center">
                       <button class="btn btn-social btn-google btn_iserl tooltips ti ti-search" title="คลิกปุ่มเพื่อดูข้อมูล"></button>
                        </td>
                               

                      <?php } ?>


                           </tr> 
                <?php } ?>
          
                </tbody>
            </table>
            </div>   
        </div>	<!-- panel-body -->
        <div class="panel-footer">
            <div class="col-md-3">
                <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/History');?>'"><span>ย้อนกลับ</span></button>
            </div>			
        </div>
    </div>	
</div>	
