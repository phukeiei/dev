<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<style>
.hover:hover, .hover:active:hover, .hover:focus {
    outline: none;
    background-color: #17bab8;
    color: #ffffff;
}
</style>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_heading_iserl"> 
			<h2><i class="fas fa-history"></i>ประวัติ</h2>
        </div>
		<div class="panel-body">
            <br>
             <div class="col-md-4">
				<div class="panel panel-green" style="cursor:pointer" onclick="window.location='<?php echo site_url('/'.$dir.'/History/v_history_user');?>'">
					<div class="panel-body hover">
                        <img width="42" height="42" src="http://10.80.39.251/ossd/index.php/UMS/getIcon?type=menu&image=Icon-44.png" alt="" />
                        &nbsp;&nbsp;&nbsp;ประวัติผู้ใช้สนาม					
                    </div>
				</div>
            </div>
            <div class="col-md-4">
				<div class="panel panel-green" style="cursor:pointer" onclick="window.location='<?php echo site_url('/'.$dir.'/History/v_history_field');?>'">
					<div class="panel-body hover">
                        <img width="42" height="42" src="http://10.80.39.251/ossd/index.php/UMS/getIcon?type=menu&image=Icon-1.png" alt="" />
                        &nbsp;&nbsp;&nbsp;ประวัติการใช้สนาม						
                    </div>
				</div>
            </div>
            <div class="col-md-4">
				<div class="panel panel-green" style="cursor:pointer" onclick="window.location='<?php echo site_url('/'.$dir.'/History/v_history_income');?>'">
					<div class="panel-body hover">
                        <img width="42" height="42" src="http://10.80.39.251/ossd/index.php/UMS/getIcon?type=menu&image=Icon-45.png" alt="" />
                        &nbsp;&nbsp;&nbsp;สรุปรายได้						
                    </div>
				</div>
			</div>
        </div>	 <!-- panel-body -->
        <div class="panel-footer">
            <div class="col-md-3">
                <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Home');?>'"><span>ย้อนกลับ</span></button>
            </div>	
        </div>
	</div>	
</div>	
