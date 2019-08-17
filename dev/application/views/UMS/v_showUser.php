<script type="text/javascript" src="<?php echo base_url(); ?>backend/js/ums/showUserAdd.js"></script>
<script type="text/javascript"> $(function() { $("#tabs").tabs(); }); </script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/js/ums/permissionuser.js"></script>		
<script type="text/javascript">
$(document).ready(function()
{	
	$('#example').DataTable( {
		destroy: true,
		"processing": true,
		"serverSide": true,
		"ajax": '<?php echo base_url(); ?>index.php/UMS/showUser/processing_user'
	});
	
});
function getname (name) 
	{
		document.getElementById("da-ex-dialog-modal").value = name;
		$("#da-ex-dialog-div").dialog( "close" );
	}					
	function removeuser(UsID)
	{
		var web="<?php echo base_url()?>index.php/UMS/showUser/remove/"+UsID;
		bootbox.confirm("คุณต้องการลบหรือไม่?", function(result) {
			if(result==true){
				window.location.href=web;
			}
		});
	}	
</script>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-teal">
				<div class="panel-heading">
					<h2><i class="fa fa-users" style="font-size:26px"></i><?php echo nbs(2);?>รายชื่อผู้ใช้</h2>
				</div>
				<div class="panel-body">
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th><center>No.</center></th>
								<th width="26%">ชื่อ-นามสกุล</th>
								<th width="15%">ชื่อเข้าใช้ระบบ</th>
								<th width="36%">หน่วยงาน</th>
								<th width="15%"><center>ดำเนินการ</center>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>			
			</div>			
		</div>			
	</div>			
				
