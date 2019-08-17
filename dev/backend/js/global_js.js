function vprint(){
	window.print();
}
function chkDisable(ele,obj){
	alert(jQuery(obj).val());
	jQuery(obj).attr("value",true);
	if(jQuery(ele).attr("disabled")==true){
		jQuery(ele).attr("disabled",false);
		jQuery(obj).attr("value",false);
	}else{
		jQuery(ele).attr("disabled",true);
		jQuery(obj).attr("value",true);
	}
}
function popUp(url){
	strOption = "scrollbars=yes,left=0,top=0,width=500,height=500";
	window.open(url,"",strOption);
}
function clearFrm(frm,txtexcept,opt){
	var frmId = "#"+frm;
	jQuery(frmId+" :input").each(function(index){
		if(txtexcept.indexOf(jQuery(this).attr("id")) < 0){
			switch(this.type){
				case "password":
				case "text":
				case "select-one":
				case "textarea":
				case "hidden":
					jQuery(this).val("");
					break;
				case "checkbox":
				case "radio":
					this.checked = false;
			}
		}
	});
	if(opt != ""){
		jQuery.each(opt,function(id,tag){
			jQuery(tag+".#"+id).empty();
		});
	}
}

function setSuccessMsg(msg,flag){
//	var jflag = parseInt(flag);
	var html = "<div id='msgBox'";
	if(flag ==1)
		html += " class=\"success\">";
	else
		html += " class=\"fail\">";

	html += msg+"</div>";
	jQuery(html).appendTo("body").delay(2000).fadeOut(1000);
}

function calBirthDate(birthDate)
{
	var nowDate = new Date();
	var bDate = birthDate.split("/");
	var resultDate = Array();
	var firstDateOnMonth = new Date( nowDate.getFullYear() , nowDate.getMonth() , 1 );
	var firstDateNextMonth = new Date( nowDate.getFullYear() , nowDate.getMonth()+1 , 1 );
	var timeVary = firstDateNextMonth.getTime() - firstDateOnMonth.getTime();
	var dayVary = timeVary / (1000*60*60*24) ;
	var nDate = Array();
		nDate[0] = nowDate.getDate();
		nDate[1] = nowDate.getMonth()+1;
		nDate[2] = nowDate.getFullYear();
	resultDate[2] = nDate[2] - bDate[2];
	resultDate[1] = nDate[1] - bDate[1];
	if(resultDate[1] < 0 && resultDate[2] > 0)
	{
		resultDate[1] += 12;
		resultDate[2] -= 1;
	}
	resultDate[0] = nDate[0] - bDate[0];
	if(resultDate[0] < 0 && resultDate[1] > 0 )
	{
		resultDate[0] += dayVary;
		resultDate[1] -= 1;
	}
	return resultDate[2]+" ปี  "+resultDate[1]+" เดือน  "+resultDate[0]+" วัน";
}
function calNumDay(srcDate,destDate,target,optMsg)
{
	var temp = (jQuery(":hidden[name='"+srcDate+"']").val()).split("/");
	var sDate = new Date(temp[2]+"/"+temp[1]+"/"+temp[0]);
	var temp = (jQuery(":hidden[name='"+destDate+"']").val()).split("/");
	var dDate = new Date(temp[2]+"/"+temp[1]+"/"+temp[0]);
	var time = dDate.getTime() - sDate.getTime();
	var numDay = time/(1000*60*60*24);
	jQuery("#"+target).append(optMsg+" "+numDay);
}
	
/* *********************************************************************
 ** *** Chaiwat Chain Create 2016/05/13 ********************************
 ** function post(path, params, target, method) ************************
 ** path  : URL ********************************************************
 ** params: Value is array *********************************************
 ** target: target {"_blank", "_self", "_parent"} **********************
 ** method: {"POST", "GET"} ********************************************
 ** ----------------------------------------------------------------- **
 ** Example ************************************************************
 ** post(path,{val1: "1", val2:"2", valn:"n"},[target],[method]); **
 ***********************************************************************
 */
function post(path, params, target, method) {
	
    target = target || "_self"; // Set target to post by default if not specified.
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    form.setAttribute("target", target);

    for(var key in params) {
		 if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
			form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}


/* **************************************************
 * ** Chain Chaiwat - Create 2016/06/01 *************
 * ** function download_doc - ใช้สำหรับดาวน์โหลดเอกสาร  *******
 * ** Param : file (ชื่อไฟล์เอกสารที่จัดเก็บใน server)
 * ** Param : rename (ชื่อไฟล์เอกสาร ที่ต้องการเปลี่ยนชื่อก่อนดาวน์โหลด){ถ้ามี}
 **************************************************** */
function download_doc(path,file,rename){
	if(typeof rename!="undefined"){
		rename='&rename='+rename;
	}else{
		rename='';
	}
	window.open(path+'doc&doc='+file+rename, '_blank');
}

$(document).ready(function() {
		
		// $('.datatableTH th').attr('style','font-family: "TH SarabunPSK";font-size: 26px; padding-top: 0px;padding-bottom: 0px;');
		// $('.datatableTH tr td').attr('style','font-family: "TH SarabunPSK";font-size: 26px; padding-top: 0px;padding-bottom: 0px;');
		//$('.panel-body').attr('style','font-family: "TH SarabunPSK";font-size: 26px; padding-top: 0px;padding-bottom: 0px;');
		//$('.dataTables_empty').attr('style','font-family: "TH SarabunPSK";font-size: 26px; padding-top: 0px;padding-bottom: 0px;');
		/* $(".datatableTH tr").hover(function(){
			$(this).find("td").attr('style','font-family: "TH SarabunPSK";font-size: 40px; padding-top: 0px;padding-bottom: 0px;font-weight: bold');
			}, function(){
			$(this).find("td").attr('style','font-family: "TH SarabunPSK";font-size: 26px; padding-top: 0px;padding-bottom: 0px;');
		}); */

		/*var dataTable = $('.datatableTH').dataTable({
			"lengthMenu":  [ [10 , 25, 50, 100, -1], ["10 รายการ", "25 รายการ", "50 รายการ", "100 รายการ", "ทั้งหมด"] ],
			"language": {
				"info": "แสดงรายการที่ _START_ ถึงรายการที่ _END_ จาก _TOTAL_ รายการ",
				"lengthMenu": "แสดง _MENU_",
				"paginate": {
					"next": "หน้าต่อไป",
					"previous": "ก่อนหน้า"
				},
				"infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
				//"search": "<tr><td><b>กรอกสิ่งที่ต้องการค้นหา&nbsp;</b>_INPUT_</td></tr>",
				"searchPlaceholder": "Search...",
				"infoEmpty": "<font color='red' style=\"font-family:'TH SarabunPSK'; font-size:26px;\">*** ไม่พบข้อมูล ***</font>",
				"zeroRecords":    "<center><font color='red' style=\"font-family:'TH SarabunPSK'; font-size:26px;\">*** ไม่พบข้อมูล ***</font></center>",
			},
			"columnDefs": [ {
				"targets": 'no-sort',
				"orderable": false,
			} ],
		//================================================================
		//Button export Print & Excel
		//================================================================
			dom: 'lengthMenu Bfrtip',
			buttons: [
				{
					extend: 'excel',
					text: "<i style='font-size: 22px;' title='ส่งออก excel' class='fa fa-file-excel-o tooltips'></i>",
					title: 'excel',
					action: function (e, dt, button, config) {
						config.title = button.parent().parent().parent().find('h2').html();

						//go export
						$.fn.dataTable.ext.buttons.excelHtml5.action(e, dt, button, config);

					}
				},
				{
					extend: 'print',
					text: "<i style='font-size: 22px;' title='พิมพ์'  class='fa fa-print tooltips'></i>",
					title: 'print',
					customize: function (win) {
						$(win.document.body).css({
							'font-weight': '600',
							"font-family": "'TH SarabunPSK', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif"
						});

						$(win.document.body).find('table').css({
							"font-size": "16pt",
							"line-height": "1.45",
							"color": "#616161"
						});
					},
					action: function (e, dt, button, config) {
						config.title = button.parent().parent().parent().find('h2').html();

						//go export
						$.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
					}
				}
			],
		//================================================================
			stateSave: true
		});*/
/*
		$('.dataTables_filter input').attr('placeholder','ค้นหา...');
		$('.dataTables_info').attr('style','font-family: "TH SarabunPSK";font-size: 25px; padding-top: 0px;padding-bottom: 0px;');
		$('.pagination').attr('style','font-family: "TH SarabunPSK";font-size: 25px; padding-top: 0px;padding-bottom: 0px;');
		$('.dataTables_length, .dataTables_filter').attr('style','font-family: "TH SarabunPSK";font-size: 25px; padding-top: 0px;padding-bottom: 0px;');
		$('.dataTables_length').children().children().attr('style','font-family: "TH SarabunPSK";font-size: 25px; padding-top: 0px;padding-bottom: 0px;color:#616161; width:122px');

		//DOM Manipulation to move datatable elements integrate to panel
		$('.separator').remove();
		$('.panel-ctrls').append($('.dt-buttons').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
		$('.panel-ctrls').append("<i class='separator pull-right'></i>");
		$('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
		$('.panel-ctrls').append("<i class='separator'></i>");
		//$('.panel-ctrls').append("<i class='separator'></i>");
		$('.panel-ctrls').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");
		//$('.dataTables_length').removeClass("form-control");
		
		// $('.dataTables_info').remove();
	
		$('.panel-ctrls-center').find("select").removeClass("form-control");*/
		$('.panel-ctrls-center').css('visibility', 'visible');

		$('.panel-ctrls-center').find('input[type=search]').wrap('<div class="input-icon right"></div>');
		$('.panel-ctrls-center').find('input[type=search]').before('<i class="fa fa-times" id = "time_btn" style="display:none;"></i>');

		$('.panel-footer').append($(".dataTable+.row"));
/*		
		//================================================================
		//Button export Print & Excel
		//================================================================
		$('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");
		$('.buttons-excel').addClass("btn btn-social btn-android-alt");
		$('.buttons-print').addClass("btn btn-social btn-facebook-alt");
		
		$('.panel-ctrls .dt-buttons').attr('style', "margin:8px 0 !important;");
		
		$('.buttons-print').attr('style', "margin-left:4px;");
		
		$('.buttons-print').click(function () {
			$(this).parent().parent().parent().find('h2').html();
		});
		//================================================================

		//$('.panel-ctrls').find("select").removeClass("form-control");
		
		$('.pagination').on( 'click', function () {
			$('.panel-ctrls').find("input.form-control").css("width","10em");
			$("input.-cformontrol").css("font-size","25px");
			$('.form-control').css('font-size','25px');
			$('select.form-control').css('padding-top','0px');
			$.each($(".select2"),function(){
				$(this).select2("destroy");
			})
			$(".select2").select2();
			$( ".datepicker" ).datepicker();
			$(".pp_timepicker").timepicker({
				minuteStep: 5,
				showInputs: false,
				disableFocus: true,
				showSeconds:true,
				showMeridian: false
			});
		});
		$('.panel-ctrls').on( 'change', function () {

			$('.panel-ctrls').find("input.form-control").css("width","10em");
			$("input.-cformontrol").css("font-size","25px");
			$('.form-control').css('font-size','25px');
			$('select.form-control').css('padding-top','0px');
			$.each($(".select2"),function(){
				$(this).select2("destroy");
			})
			$(".select2").select2();
			$( ".datepicker" ).datepicker();
			$(".pp_timepicker").timepicker({
				minuteStep: 5,
				showInputs: false,
				disableFocus: true,
				showSeconds:true,
				showMeridian: false
			});
		});
		*/
		$('.dataTables_filter input').keyup(function() {
			if($(this).val() != ""){
				$('#time_btn').show();
			}else{
				$('#time_btn').hide();
			}
		});

		$('#time_btn').click(function() {
			$('.dataTables_filter input').val('');
			$('#time_btn').hide();
			dataTable.fnFilter('');
		});
/*
		$('.panel-ctrls').on( 'keyup', function () {

			$('.panel-ctrls').find("input.form-control").css("width","10em");
			$("input.-cformontrol").css("font-size","25px");
			$('.form-control').css('font-size','25px');
			$('select.form-control').css('padding-top','0px');
			$.each($(".select2"),function(){
				$(this).select2("destroy");
			})
			$(".select2").select2();
			$( ".datepicker" ).datepicker();
			$(".pp_timepicker").timepicker({
				minuteStep: 5,
				showInputs: false,
				disableFocus: true,
				showSeconds:true,
				showMeridian: false
			});
		});
		$('.datatableTH').on( 'click', function () {
			$('.panel-ctrls').find("input.form-control").css("width","10em");
			$("input.-cformontrol").css("font-size","25px");
			$('.form-control').css('font-size','25px');
			$('select.form-control').css('padding-top','0px');
			$.each($(".select2"),function(){
				$(this).select2("destroy");
			})
			$(".select2").select2();
			$( ".datepicker" ).datepicker();
			$(".pp_timepicker").timepicker({
				minuteStep: 5,
				showInputs: false,
				disableFocus: true,
				showSeconds:true,
				showMeridian: false
			});
		});
*/
		$('.pp_timepicker').timepicker({
		minuteStep: 5,
		showInputs: false,
		disableFocus: true,
		showSeconds:true,
		showMeridian: false
	});
	$('.input-th').on( 'keypress', function (e) {
		console.log(e.keyCode);
		console.log(String.fromCharCode(e.keyCode))
		console.log(e.which);
		console.log(e.key);
		console.log(e.charCode);
	});
});
//เชคเลขบัตรประจำตัวประชาชน
function checkFomatIdCard(id){
	if(id.length != 13) return false;
		for(i=0, sum=0; i < 12; i++)
			sum += parseFloat(id.charAt(i))*(13-i); if((11-sum%11)%10!=parseFloat(id.charAt(12)))
		return false; 
	return true;
}