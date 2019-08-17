<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading panel_heading_iserl"> 
            <h2><i class="fas fa-user-cog"></i>เมนูระบบ</h2>
        </div>
        <div class="panel-body">
        <br>
             <div class="col-md-4">
                <div class="panel panel-green" style="cursor:pointer" onclick="window.location='<?php echo site_url('/'.$dir.'/Dashboard');?>'">
                    <div class="panel-body hover">
                        <img width="42" height="42" src="http://10.80.39.251/ossd/index.php/UMS/getIcon?type=menu&image=Icon-2.png" alt="" />
                        &nbsp&nbsp;&nbsp;รายงานผล					
                    </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="panel panel-green" style="cursor:pointer" onclick="window.location='<?php echo site_url('/'.$dir.'/Field_manage');?>'">
                    <div class="panel-body hover">
                        <img width="42" height="42" src="http://10.80.39.251/ossd/index.php/UMS/getIcon?type=menu&image=Icon-13.png" alt="" />
                        &nbsp&nbsp;&nbsp;จัดการสนาม					
                    </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="panel panel-green" style="cursor:pointer" onclick="window.location='<?php echo site_url('/'.$dir.'/Field_reservation');?>'">
                    <div class="panel-body hover">
                        <img width="42" height="42" src="http://10.80.39.251/ossd/index.php/UMS/getIcon?type=menu&image=Icon-40.png" alt="" />
                        &nbsp;&nbsp;&nbsp;จัดการคำร้องขอใช้สนาม						
                    </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="panel panel-green" style="cursor:pointer" onclick="window.location='<?php echo site_url('/'.$dir.'/Complain');?>'">
                    <div class="panel-body hover">
                        <img width="42" height="42" src="http://10.80.39.251/ossd/index.php/UMS/getIcon?type=menu&image=Icon-19.png" alt="" />
                        &nbsp;&nbsp;&nbsp;จัดการความคิดเห็นการใช้สนามของผู้ใช้					
                    </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="panel panel-green" style="cursor:pointer" onclick="window.location='<?php echo site_url('/'.$dir.'/Bill');?>'">
                    <div class="panel-body hover">
                        <img width="42" height="42" src="http://10.80.39.251/ossd/index.php/UMS/getIcon?type=menu&image=Icon-45.png" alt="" />
                        &nbsp;&nbsp;&nbsp;จัดการใบเสร็จ						
                    </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="panel panel-green" style="cursor:pointer"onclick="window.location='<?php echo site_url('/'.$dir.'/History');?>'">
                    <div class="panel-body hover">
                        <img width="42" height="42" src="http://10.80.39.251/ossd/index.php/UMS/getIcon?type=menu&image=Icon-11.png" alt="" />
                        &nbsp;&nbsp;&nbsp;ประวัติ						
                    </div>
                </div>
                </div>
            
        </div>	 <!-- panel-body -->
    </div>	
</div>	
<style>
.hover:hover, .hover:active:hover, .hover:focus {
    outline: none;
    background-color: #17bab8;
    color: #ffffff;
}
</style>