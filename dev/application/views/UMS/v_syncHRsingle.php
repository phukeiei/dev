<!-- Last Edited : 19/02/2559 -->
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
	var jqxhr = $.get( "syncHRsingle/search", function() {//alert( "success" );
	})
	.done(function(data) {
		$("#sync_table").html(data);
		$("#sync_form").fadeIn('slow');
		$("#history_form").hide();
		$(".da-button-row").show();
		running_user = new Array();
		check_all_user();
	})
	.fail(function() { notics_error();
	})
	.always(function() {//alert( "finished" );
	});
}
function sync_single(){
	var firstname,lastname;
	if($("#firstname").val()){
		firstname = $("#firstname").val();
	}else{
		firstname = "0";
	}
	if($("#lastname").val()){
		lastname = $("#lastname").val();
	}else{
		lastname = "0";
	}
	var jqxhr = $.post( "<?php echo base_url(); ?>index.php/UMS/syncHRsingle/search_single", { first: firstname, last: lastname } )
	.done(function(data) {
		$("#sync_table").html(data);
		$("#sync_form").fadeIn('slow');
		$("#history_form").hide();
		$(".da-button-row").show();
		running_user = new Array();
		check_all_user();
	})
	.fail(function() {
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
	notics_succuess();
	// alert("Delete Complete");
}
function valid(e){
	var username = $(e).parent().children(".user").val();
	if(username.length > 4)
	{
		var url = "syncHRsingle/check_username/"+username;
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
		.fail(function() { notics_error();
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

function notics_succuess(){
	new PNotify({title: 'New Thing',
		title: 'สำเร็จ',
		text: 'ลบข้อมูลเรียบร้อย',
		type: 'success',
		icon: 'ti ti-check',
		styling: 'fontawesome'
	});
}

function notics_error(){
	new PNotify({title: 'New Thing',
		title: 'พบข้อผิดพลาด',
		text: 'ไม่สามารถนำเข้าข้อมูลได้ เนื่องการเชื่อมต่อฐานข้อมูลผิดพลาด หรือไม่พบข้อมูลในฐานข้อมูล',
		type: 'error',
		icon: 'ti ti-close',
		styling: 'fontawesome'
	});
}

</script>
<div class="row">
	<div style="cursor:pointer" class="col-md-3 col-md-offset-3" onClick="sync()">
		<div class="info-tile tile-warning">
			<div class="tile-icon"><i class="ti ti-import"></i></div>
			<div class="tile-heading"><span>Sync</span></div>
			<div class="tile-body"><span>Sync</span></div>
		</div>
	</div>
	<div class="col-md-3">
		<div style="cursor:pointer" class="info-tile tile-success" onClick="history()">
			<div class="tile-icon"><i class="fa fa-history"></i></div>
			<div class="tile-heading"><span>History</span></div>
			<div class="tile-body"><span>History</span></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal">
			<div class="panel-heading">
				<h2><i class="fa fa-search" style="font-size:26px"></i><?php echo nbs(2); ?>ค้นหารายชื่อผู้ใช้ </h2>
			</div>
			<div class="panel-body">
				<form id="search_data" class="form-horizontal row-border daform" >
				<div class="form-group">
					<label class="col-sm-1 control-label">ชื่อ</label>
					<div class="col-sm-4">
						<input type="text" placeholder="ชื่อ" name="firstname" id="firstname" class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-1 control-label">นามสกุล</label>
					<div class="col-sm-4">
						<input type="text" placeholder="นามสกุล" name="lastname" id="lastname" class="form-control">
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="col-sm-12 col-sm-offset-0">
					<div class="btn-toolbar">
						<input class="btn-inverse btn pull-left" type="reset" value="เคลียร์ข้อมูล">
						<input class="btn-success btn pull-right" type="button" id="search" value="ค้นหา" onclick="sync_single()">
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<div class="row" id="sync_form" style="display:none">
	<div class="col-md-12">
		<div class="panel panel-teal">
			<div class="panel-heading">
				<h2><i class="fa fa-users" style="font-size:26px"></i><?php echo nbs(2); ?>รายชื่อผู้ใช้  </h2>
			</div>
			<form id="sync_data" class="da-form" onsubmit="return submit_it();" method="post" action="<?php echo base_url(); ?>index.php/UMS/syncHRsingle/syncing" >
			<div class="panel-body">
				<table class="table table-striped table-bordered" cellspacing="0" width="100%">
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
			</div>
			<div class="panel-footer">
				<div class="col-sm-12 col-sm-offset-0">
					<div class="btn-toolbar">
						<input class="btn-inverse btn pull-left" type="reset" value="เคลียร์ข้อมูล">
						<input class="btn-danger btn pull-right" type="button" value="ยกเลิก" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showUser'">
						<input class="btn-success btn pull-right" type="Submit" value="บันทึก" onclick="sync_single()">
					</div>
				</div>
			</div>
			</form>
		</div>
    </div>
 </div>

 <div class="row" id="history_form" style="display:none">
	<div class="col-md-12">
		<div class="panel panel-teal">
			<div class="panel-heading">
				<h2><i class="fa fa-newspaper-o" style="font-size:26px"></i><?php echo nbs(2); ?>รายงานการเชื่อมต่อข้อมูล  </h2>
			</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered" cellspacing="0" width="100%">
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
							<td><a href="<?php echo base_url()."index.php/UMS/syncHRsingle/filedownload/".$file['syncFilename'];?>"><img src="<?php echo base_url(); ?>/images/icons/color/disk.png" /></a>
							<!--a href="#"><img src="/images/icons/color/cross.png" /></a-->
							</td>
						</tr>
						<?php }}?>
					</tbody>
				</table>
			</div>
		</div>
    </div>
 </div>
