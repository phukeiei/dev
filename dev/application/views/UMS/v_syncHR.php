<!-- Last Edited : 29/04/2557 15:25-->
				<script type="text/javascript" src="<?php echo base_url(); ?>js/ums/showUserAdd.js"></script>
				<script type="text/javascript"> $(function() { $("#tabs").tabs(); }); </script>
				<script type="text/javascript" src="<?php echo base_url(); ?>js/ums/permission.js"></script>
<script type="text/javascript">
function removeuser(UsID)
{
	var web="<?php echo base_url(); ?>index.php/UMS/showUser/remove/"+UsID;
	if(confirm("คุณต้องการลบหรือไม่?")==true){
     window.location.href=web;
   }
	else
	{
		return false;
	}
}	
</script>
<script>
function submit_it(){
	var check = 0;
	$(".check").each(function(e){
		check += 1;
	})
	if(check != 0){
		return false;
	}else{
		return true;
	}
}
// this version add user one by one
var running_user = new Array();
function sync(){
	var jqxhr = $.get( "syncHR/search", function() {//alert( "success" );
	})
	.done(function(data) {
		$("#sync_table").html(data);
		$("#sync_form").fadeIn('slow');
		$("#history_form").hide();
		$(".da-button-row").show();
		running_user = new Array();
		check_all_user();
	})
	.fail(function() { alert( "error" );
	})
	.always(function() {//alert( "finished" );
	});
}
function history(){
	$("#history_form").fadeIn('slow');
	$("#sync_form").hide();
}
function check_all_user(){
	var sync_table = document.getElementById("sync_table");
	var row = sync_table.rows.length;
	$('.check').each(function(){
		valid(this);
	});
	
}
function clear_data(){
	$(".da-button-row").hide();
	var Parent = document.getElementById("sync_table");
	while(Parent.hasChildNodes())
	{
		Parent.removeChild(Parent.firstChild);
	}
	var row = document.getElementById("sync_table").insertRow();
	row.setAttribute("align","center");
	var cell = row.insertCell();
	cell.setAttribute("colspan",4);
	cell.innerHTML = "-- Empty --";
}
function delete_row(e){
    e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
	alert("Delete Complete");
}
function valid(e){
	var username = $(e).parent().children(".user").val();
	if(username.length > 4)
	{
		var url = "syncHR/check_username/"+username;
		var jqxhr = $.get( url, function() {//alert( "success" );
		})
		.done(function(data) {
			if(data==1){//usable
				var count=0;
				for(var i = 0 ; i < running_user.length;i++)
				{
					if(username == running_user[i])
					{
						count++;
					}
				}
				if(count==0){
					running_user.push(username);
					$(e).parent().children(".user").css("border","none");
					$(e).parent().children("b").remove();
					$(e).parent().append("<b style='color:green;' >ok!</b>");
					$(e).remove();
					
				}
				else{
					$(e).parent().children("b").remove();
					$(e).parent().append("<b style='color:red;' >can't use!</b>");
				}
				
			}else{// can't use
				$(e).parent().children("b").remove();
				$(e).parent().append("<b style='color:red;' >can't use!</b>");
			}
		})
		.fail(function() { alert( "error" );
		})
		.always(function() {//alert( "finished" );
		});
	}
	else if(username.length==0)
	{
		$(e).parent().children("b").remove();
		$(e).parent().append("<b style='color:red;' >Can't Empty!!</b>");
	}
	else
	{
		$(e).parent().children("b").remove();
		$(e).parent().append("<b style='color:red;' >Too Short!!</b>");
	}
}

</script>				
				<!-- Main Content Wrapper -->
                <div id="da-content-wrap" class="clearfix">
                
                	<!-- Content Area -->
                	<div id="da-content-area">
						<div class="grid_1" style="margin-left:250px">
						   <div class="da-panel-widget">
							  <ul class="da-summary-stat">
								 <li>
									<a href="#" onClick="sync()">
									<span class="da-summary-icon" style="background-color:#ea799b;">
									<img src="<?php echo base_url();?>images/icons/white/32/magnifying_glass.png" alt="ข้อมูลประวัติ" />
									</span>
									<span class="da-summary-text">
									<span class="value">Sync</span>
									</span></br>
									</a>
								 </li>
							  </ul>
						   </div>
						</div>
						<div class="grid_1">
						   <div class="da-panel-widget">
							  <ul class="da-summary-stat">
								 <li>
									<a href="#" onClick="history()">
									<span class="da-summary-icon" style="background-color:#ea799b;">
									<img src="<?php echo base_url();?>images/icons/white/32/magnifying_glass.png" />
									</span>
									<span class="da-summary-text">
									<span class="value">History</span>
									</span></br>
									</a>
								 </li>
							  </ul>
						   </div>
						</div>
						
                	<!-- Content Area -->
<div id="sync_form" style="display:none" >
                    	<div class="grid_4_center">
                        	<div class="da-panel ">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/black/32/users_2.png" alt="" />
                                        รายชื่อผู้ใช้ 
                                    </span>
                                    
                                </div>
								
                                <div class="da-panel-content">
									<form id="sync_data" class="da-form" onsubmit="return submit_it();" method="post" action="<?php echo base_url(); ?>index.php/UMS/syncHR/syncing" >
										
										  
									   
										<table id="da-ex-datatable" class="da-table">
											<thead>
												<tr>
													<th width="25%">ชื่อ-นามสกุล</th>
													<th width="25%">E-Mail</th>
													<th width="20%">ชื่อเข้าใช้ระบบ</th>
													<th width="7%">ดำเนินการ</th>
												</tr>
											</thead>
											<tbody id="sync_table">
												<tr><td colspan="4">Empty Data To Sync</td>
												</tr>

											</tbody>										
										</table>	
										<div class="da-button-row">
											<input id="clear" class="da-button gray left" type="reset" value="เคลียร์ข้อมูล" name="clear" onclick="clear_data()"></input>
											<input id="submit" class="da-button green" type="submit"  value="บันทึก" name="submit"></input>
											<input id="cancel" class="da-button red" type="button" onclick="window.location.href=''" value="ยกเลิก" name="cancle"></input>
										</div>
									</form>
                                </div>								
                            </div>
                        </div>
						
</div>			
                	<!-- Content Area -->
<div id="history_form" style="display:none" >
                    	<div class="grid_4_center">
                        	<div class="da-panel ">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/black/32/users_2.png" alt="" />
                                        รายงานการเชื่อมต่อข้อมูล 
                                    </span>
                                    
                                </div>
								
                                <div class="da-panel-content">
									<form class="da-form" action="#" >
										
										  
									   
										<table id="da-ex-datatable" class="da-table">
											<thead>
												<tr>
													<th width="7%">No.</th>
													<th width="25%">Filename</th>
													<th width="15%">User</th>
													<th width="20%">Time</th>
													<th width="7%">ดำเนินการ</th>
												</tr>
											</thead>
											<tbody id="sync_table">
												<?php if($syncfile->num_rows() < 1){?>
													<tr><td colspan="5">Empty Data To Sync</td></tr>
												<?php }else{ $i=1;
														foreach($syncfile->result_array() as $file){?>
												<tr>
													<td><?php echo $i++;?></td>
													<td><?php echo $file['syncFilename'];?></td>
													<td><?php echo $file['UsLogin'];?></td>
													<td><?php echo $file['syncTime'];?></td>
													<td><a href="<?php echo base_url()."index.php/UMS/syncHR/filedownload/".$file['syncFilename'];?>"><img src="<?php echo base_url(); ?>/images/icons/color/disk.png" /></a>
														<!--a href="#"><img src="/images/icons/color/cross.png" /></a-->
													</td>
												</tr>
												<?php }}?>
											</tbody>										
										</table>		
									</form>
                                </div>								
                            </div>
                        </div>
						
</div>		

                    </div>
                    
                </div>



