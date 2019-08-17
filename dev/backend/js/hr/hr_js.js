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