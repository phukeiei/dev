jQuery.extend(jQuery.expr[':'], {
    focus: function(element) { 
        return element == document.activeElement; 
    }
});
jQuery(document).ready(function(){
	jQuery(".preventDf").click(function(event){
		event.preventDefault();
	});
	jQuery('#btnClear').click(function(){
		jQuery('#btnClear').parents('form').find(':text:not(.calendarDateInput),:hidden').attr('value','').end().find('select:not(.calendarDateInput)').children().removeAttr('selected').end().attr('value','');
		jQuery('div.error').remove();
//alert(jQuery('#btnClear').parents('form').find(':text,:hidden').length);
	});
	jQuery('.link').hover(function(){
		jQuery(this).addClass('hover');
	},function(){
		jQuery(this).removeClass('hover');
	});
	jQuery('.preSubmit').click(function(){
		jQuery('#s_id').attr('value',jQuery(this).next(':hidden').attr('value'));
		jQuery('#s_id').parents('form').trigger('submit');	
	});
	jQuery('input[class^="required"],select.required').blur(function(event){
		jQuery(this).next('span').children('.error').remove();
		if(jQuery(this).attr('class') == 'required-thai'){
			if(!/^[ก-๙ 0-9 . ( ) / -]+$/.test(this.value)){
				jQuery(this).next('span.error').append('<div class="error">กรุณาป้อนและควรป้อนเป็นภาษาไทยเท่านั้น</div>');
				return false;
			}else{
				jQuery(this).next('span.error').children('.error').remove();
				return true;
			}	
		}else if(jQuery(this).attr('class')=='required-eng'){
			if(!/^[a-z A-Z 0-9 . ( ) / -]+$/.test(this.value)){
				jQuery(this).next('span.error').append('<div class="error">กรุณาป้อนและควรป้อนเป็นภาษาอังกฤษเท่านั้น</div>');
				return false;
			}else{
				jQuery(this).next('span.error').children('.error').remove();
				return true;
			}			
		}else if(jQuery(this).attr('class')=='required-float'){
			if(!/^[0-9 .]+$/.test(this.value)){
				jQuery(this).next('span.error').append('<div class="error">กรุณาป้อนและควรป้อนเป็นตัวเลขเท่านั้น</div>');
				return false;
			}else{ 
				jQuery(this).next('span.error').children('.error').remove();
				return true;
			}
		}else if(jQuery(this).attr('class')=='required-int'){
			if(!/^[0-9]+$/.test(this.value)){
				jQuery(this).next('span.error').append('<div class="error">กรุณาป้อนและควรป้อนเป็นตัวเลขเท่านั้น</div>');
				return false;
			}else{
				jQuery(this).next('span.error').children('.error').remove();
				return true;
			}
		}else{
			if(this.value == ''){
				jQuery(this).next('span.error').append('<div class="error">กรุณาป้อนข้อมูล</div>');
				return false;				
			}else{
				jQuery(this).next('span.error').children('.error').remove();
				return true;
			}
		}
	});
/*	jQuery('form.chkBeforeSubmit').submit(function(){
		jQuery('input[class^="required"]').trigger('blur');
		var numError = jQuery('div.error',this).length;
		if(numError)
			return false;
	});
*/
	jQuery('table.table tbody tr').hover(function(){
		jQuery(this).addClass('trHover');
	},function(){
		jQuery(this).removeClass('trHover');
	});
	jQuery('table.tablePrint').find('td.optCol').remove();
});
function clearAttr(attr){
	jQuery.each(attr,function(index,value){
		jQuery("#"+index).attr(value,null);
	});
}
function pre_submit(id){
	jQuery('#s_id').attr('value',id);
	jQuery('#s_id').parents('form').trigger('submit');
}
function preSubmitAdv(id,frm,action){
	var $s_id = jQuery('#s_id');
	$s_id.attr('value',id);
	jQuery(frm).children().find(':text').attr('value','').end().find('select').children().removeAttr('selected').end().attr('value','');
	jQuery(frm).unbind();
	if(action == "" )
		jQuery(frm).trigger("submit");
	else{
		
		jQuery(frm).attr('action',action).trigger('submit');
	}
}
function preSubmitMHd(arr,frm,action){
//	jQuery('#btnClear').parents('form').find(':text').attr('value','').end().find('select').children().removeAttr('selected').end().attr('value','');
//	jQuery(frm).unbind();
	jQuery("#"+frm).children().find(":text").val(null).end().find("select").children().attr("selected","");
	jQuery.each(arr,function(key,value){
		if(jQuery("#"+key).length == 0)
			jQuery("#"+frm).append("<input type=\"hidden\" name=\""+key+"\" id=\""+key+"\" value=\""+value+"\"/>");
		else
			jQuery("#"+key).attr("value",value);
		//alert(key+" have "+jQuery("#"+key).length+" value = "+jQuery("#"+key).val());
	});
	if(action == "")
		jQuery("#"+frm).trigger("submit");
	else
		jQuery("#"+frm).attr("action",action).trigger("submit");
}
function confirmDel(id,frm,action){
	fnc = '';
	if(confirm("คุณต้องการลบใช่หรือไม") == true)
		if(fnc == ""){
			
			preSubmitAdv(id,frm,action);
		}
		else 
			fnc(id,frm,action);
}
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
/*function sendPost(frmId,value,url){
	var html = "";
	jQuery.each(value,function(index,value){
		if(jQuery("#"+frmId).find("input:hidden[name='"+index+"']").length == 0)
			html += "<input type='hidden' name='"+index+"' value='"+value+"' id='"+index+"' />";
		else
			jQuery("input:hidden[name='"+index+"']").val(value);
		temp = index;
	});
	if (url != '')
		jQuery("#"+frmId).attr("action",url);
	jQuery("#"+frmId).append(html).trigger("submit");
}*/
function sendPost(frmId, value, url, target) {
	var html = "";
	if(url != "")
	{
		if (jQuery("#"+frmId).length > 0) {
			jQuery("#"+frmId).attr("action",url);
		}
		else {
			jQuery("body").append("<form action=\""+url+"\" id=\""+frmId+"\" method=\"post\" ></form>")
		}
	}
	if (target != "") {
		jQuery("#"+frmId).attr("target",target);
	}
	if (value != "") {
		jQuery.each(value,function(index,value){
			if(jQuery("#"+frmId).find("input:hidden[name='"+index+"']").length == 0)
			{
				html += "<input type='hidden' name='"+index+"' value='"+value+"' id='"+index+"' />";
			}else{
				jQuery("input:hidden[name='"+index+"']").val(value);
			}
			temp = index;
		});
	}
	jQuery("#"+frmId).append(html).trigger("submit");
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

function isDecimal(ele){//check valid กรอกได้เฉพาะจำนวนทศนิยมที่ไม่ติดลบ
	val=document.getElementById(ele).value;
	if(val!=""){
		if(!(parseFloat(val,10)==(val*1))){ 
			alert("กรอกได้เฉพาะตัวเลขและจุดทศนิยมเท่านั้น !");
			document.getElementById(ele).value="";
			return false;
		}else if((val.indexOf("-")!=-1)){ 
			alert("กรอกได้เฉพาะตัวเลขและจุดทศนิยมเท่านั้น !");
			document.getElementById(ele).value="";
			return false;
		}
	}	
}

function isNumberic(ele){//เฉพาะจำนวนนับ
	val=document.getElementById(ele).value;
	if(val!=""){
		if(!(parseFloat(val,10)==(val*1))){ 
			alert("กรอกได้เฉพาะตัวเลขเท่านั้น !");
			document.getElementById(ele).value="";
			return false;
		}else if((val.indexOf(".")!=-1) || (val.indexOf("-")!=-1)){ 
			alert("กรอกได้เฉพาะตัวเลขเท่านั้น !");
			document.getElementById(ele).value="";
			return false;
		}
	}	
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

 // var date = new Date();
/*		resultDate[0] = nDate[0] - parseInt(bDate[0]);
		if(resultDate[0] < 0 ){
			resultDate[0] += 30;
			nDate[1] -= 1;
		}
		resultDate[1] = nDate[1] - parseInt(bDate[1]);
		if(resultDate[1] < 1 && nDate[2] > 0){
//			resultDate[1] += 12;
//			nDate[2] -= 1;
		}else if(resultDate[1] < 1 && nDate[2] < 0)
			resultDate[1] += 12;
		resultDate[2] = nDate[2] - parseInt(bDate[2]);
*/
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
