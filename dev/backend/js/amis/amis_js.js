$(document).ready(function (){
	//$(".chzn-select").chosen();
	// $("input[type=submit]").on("click",function (){
	// 	$(this).hide();
	// 	$("input[type=button][name=cancel], input[type=reset]").hide();
	// 	$(this).after("<span style='float:right;color:green;'><b>กำลังดำเนินการ..</b></span>");
	// }); 
	$(".dont").attr("title","ห้าม");
	$('#tabledata').DataTable( { 
		language: {
			"paginate": {
			  "next": "หน้าถัดไป",
			  "previous": "ก่อนหน้านี้"
			},
			"info": "แสดง _START_ ถึง _END_ ของ _TOTAL_ รายการ",
			"lengthMenu": "แสดง _MENU_ รายการ",
			"zeroRecords":    "<span class='error'><center>ไม่พบข้อมูล</center></span>",
			"infoEmpty": "ไม่มีรายการที่ค้นพบ ",
			"infoFiltered": "(จากทั้งหมด _MAX_ รายการ)"
		}
	} );

	$('.dataTables_filter input').attr('placeholder','ค้นหา');
});

function sendHttpPost(url,params){
	return $.post(url,params);
}
function sendHttpGet(url,params){
	return $.get(url,params);
}
function sendForm(url,data,action){
	var input = "";
	$.each(data, function (index, value){
		input += "<input type='hidden' name='"+index+"' value='"+value+"'/>";
	});
	var form = "<form action='"+url+"' id='hideForm' method='"+action+"' style='display:none;'>"+input+"</form>";
	$("body").append(form);
	$("#hideForm").submit();
}

/*
jQuery(document).ready(function (){
	
	jQuery(".chzn-select").chosen();
	jQuery("input[type=submit]").on("click",function (){
		jQuery(this).hide();
		jQuery("input[type=button][name=cancel], input[type=reset]").hide();
		jQuery(this).after("<span style='float:right;color:green;'><b>กำลังดำเนินการ..</b></span>");
	});
	jQuery(".dont").attr("title","ห้าม");

});
function sendHttpPost(url,params){
	return jQuery.post(url,params);
}
function sendHttpGet(url,params){
	return jQuery.get(url,params);
}
function sendForm(url,data,action){
	var input = "";
	jQuery.each(data, function (index, value){
		input += "<input type='hidden' name='"+index+"' value='"+value+"'/>";
	});
	var form = "<form action='"+url+"' id='hideForm' method='"+action+"' style='display:none;'>"+input+"</form>";
	jQuery("body").append(form);
	jQuery("#hideForm").submit();
}

*/

