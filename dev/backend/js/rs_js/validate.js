/********************************************************************************
* Software:	Validation Demo														*
*			Developed For OPEN AR(OPEN Academic and Research Management System)	*
* Version:	1.0 (TH)															*
* Date:		2013-09-18															*
* Author:	meuzicxx @ ISERL													*
* License:	Opensource															*
*																				*
* You may use, modify and redistribute this software as you wish.				*
*********************************************************************************/
var numMsgError = 0;	//--จำนวน error
var countForFocus = 0;	//--ใช้ตรวจสอบการ focus
var msgError = '';

$(document).ready(function(){  
	$("form#da-ex-validate1").submit(validate);	//--กดปุ่มบันทึก
	$(".after-validate").on({
		//--มี event หลังจากที่เกิด validate แล้ว
		keyup: function(){checkMethodByElement($(this));},
		change: function(){if($(this).is('select')) checkMethodByElement($(this));},
		/*click: function(){checkMethodByElement($(this))}*/
	});
	
	function validate(){
		//--เป็นฟังก์ชั่นเริ่มต้นการตรวจสอบ validate ใช้สำหรับกรณีที่กดปุ่ม submit
		
		numMsgError = 0;
		countForFocus = 0;	//--focus ใหม่ทุกครั้งที่กดปุ่มันทึก
		clearAllValidate();	//--ลบการแจ้งเตือนทั้งหมดออก เมื่อกดปุ่มบันทึก
		
		$(this).find(".validate").each(function(index){
			checkMethodByElement($(this));
			
			//--เพิ่มคลาส after-validate สำหรับทุก element เพื่อใช้ไว้ตรวจสอบ event หลังการ validate
			$(this).addClass("after-validate");
			
			//--ตรวจสอบการกรอกชื่อวารสาร
			/*if($(this).attr("name") == "jn_name_en"){
				if($(this).parents("div").find("input[name=rs_jn_id]").val() == ""){
					msgError = messagesValidErrorByMethod("choose_journal", $(this), 0, 0);
					addValidateForElement($(this));
				}
				else{
					clearValidateForElement($(this));
				}
			}*/
		});
		
		//--ตรวจสอบคณะผู้ทำผลงานวิจัย
		var arr_au = [];
		var sum_percent = 0;
		var has_percent = false;
		if(!$("#pnt_table").hasClass("noCheckPs")){
			$(this).find("input[name^='au_ps_name']").each(function(index){
				//--ตรวจสอบชื่อซ้ำ
				value = $(this).next("input:hidden[name^='au_ps_id']").val();
				if(value != ''){
					if(arr_au.indexOf(value) >= 0){
						//--ค่าซ้ำ
						msgDup = $("#pnt_table").attr("msgDup");
						if(typeof msgDup != 'undefined'){
							msgError = msgDup;
						}else{
							msgError = messagesValidErrorByMethod("dup_author", $(this), 0, 0);
						}
						addValidateForProcessError($(this));
					}
					else{
						arr_au.push(value);
					}
				}
				
				//--ตรวจสอบสัดส่วนห้ามเกิน 100%
				obj = $(this).parents("tr:first").find("input[name^=au_percent]");
				sum_percent += parseFloat(obj.val());
				
				if(sum_percent > 100){
					msgError = messagesValidErrorByMethod("more_percent", obj, 0, 0);
					addValidateForProcessError(obj);
				}
				
				has_percent = true;
			});
			
			//--ผลรวมทั้งหมดต้องไม่น้อยกว่า 100%
			if(has_percent == true && sum_percent < 100){
				//obj = $(this).find().parents("tr:first").find("input[name^=au_percent]");
				msgError = messagesValidErrorByMethod("less_percent", obj, 0, 0);
				addValidateForProcessError(obj);
			}
		}
		
		return checkSumErrorValid();
	}
	
	function checkMethodByElement(element){
		//--เป็นฟังก์ชั่นใช้สำหรับตรวจสอบ method โดยแยกตามชนิดของ element หรือ แอททริบิวท์ for ตามที่กำหนด
		var success = true;
		msgError = '';
	
		
		//--ตรวจสอบ attr genid หากยังไม่มี ให้เพิ่มให้ใหม่
		genid = element.attr("genid");
		if(typeof genid == 'undefined'){
			genid = generateRandomId();
			element.attr("genid", genid);
		}
		
		method = element.attr("for");
		
		//--ตรวจสอบ attr param1 และ param2 หากไม่มี ให้กำหนดค่าเป็นศูนย์
		param1 = element.attr("param1");
		param2 = element.attr("param2");
		if(typeof param1 == 'undefined'){
			param1 = 0;
		}
		if(typeof param2 == 'undefined'){
			param2 = 0;
		}
				
		//--ตรวจสอบ method ของ element
		if(element.is(':checkbox')){
			//success = checkValidByMethod("checked", element.checked, element, param1, param2);
		}
		else if(element.is(':radio')){
			/*value = '';
			if(element.length > 0){
				value = element.length;
			}*/
			alert("Radio");
			success = checkValidByMethod("required", element.val(), element, 0, 0);
		}
		else if(element.is('select') || element.is('input') || element.is('textarea')){
			//success = checkValidByMethod("required", element.val(), element, 0, 0);	//--เช็คค่าว่างสำหรับทุก element
			if(typeof method != 'undefined' && success == true){
				var str = method.replace(/\s+/g,'');	//--สำหรับตัดช่องว่างทิ้ง
				var lines = str.split(',');
				for(var s=0; s<lines.length; s++) {
					if(success == false){
						break;
					}
					if(lines[s] == "autocp"){
						//--ตรวจสอบ auto complete จากค่า hidden (method='autoElem') 
						autoElem = element.attr("autoElem");
						if(typeof autoElem == 'undefined'){
							obj = element;
							//alert("IF:");
						}
						else{
							
							obj = element.parents("div").find("input:hidden[name^='"+autoElem+"']");
							//alert("ELSE="+obj.parent().html());
							
						}
						success = checkValidByMethod(lines[s], obj.val(), obj, 0, 0);
					}else{
						if(element.hasClass("ckeditor")){
							//--ตรวจสอบค่าจาก textarea ที่ใช้ plugin class='ckeditor'
							//alert(element.text());
							var value = element.next("div.cke").find("iframe").contents().find("body p").text();
							success = checkValidByMethod(lines[s], value, element, 0, 0);
						}else{
							success = checkValidByMethod(lines[s], element.val(), element, param1, param2);
						}
					}
				}
			}
		}
		
		//--ตรวจว่ามี error หรือไม่
		if(success == false){
			addValidateForElement(element);
		}
		else{
			clearValidateForElement(element);
		}
	}
	
	function checkValidByMethod(method, value, element, param1, param2){
		//--เป็นฟังก์ชั่นใช้สำหรับตรวจสอบ validate โดยเช็คแยกตามกรณีของ method ที่ต้องการ
		var success = true;
		if(method == 'email'){
			var emailRegex = /[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
			if($.trim(value) != "" && emailRegex.test(value) == false){
				success = false;
			}
		}
		else if(method == 'decimal'){
			//--ต้องเป็นตัวเลข และทศนิยมไม่เกิน 2 ตำแหน่ง และห้ามมีช่อง
			var decimalRegex = /^\d*\.?\d{0,2}$/;	//--มีทศนิยมไม่เกิน 2 ตำแหน่ง และเป็นตัวเลข
			var spaceRegex = /\s+/g;	//--ห้ามมีช่องว่าง
			var fzeroRegex = /^(0[0-9])/;	//--ตัวแรกห้ามเป็นศูนย์
			if(decimalRegex.test(value) == false || spaceRegex.test(value) == true || fzeroRegex.test(value) == true){
				success = false;
			}
		}
		else if(method == 'year'){
			//--ต้องเป็นตัวเลขเท่านั้น และมีความยาว 4 ตัวเท่านั้น
			var regex = /^\d{4}$/;	
			tmp_value = element.val().replace(/\s+/g,'');	//--สำหรับตัดช่องว่างทิ้ง
			if($.isNumeric(tmp_value) == false || regex.test(tmp_value) == false){
				success = false;
			}
		}
		else if(method == 'dateDD/MM/YYYY'){
			//--รูปแบบต้องเป็น วันที่/เดือน/ปี
			var dateDDMMYYYRegex = /^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.]([1-9])\d\d\d$/;	//--DD/MM/YYYY
			var spaceRegex = /\s+/g;	//--ห้ามมีช่องว่าง
			if(spaceRegex.test(value) == true || dateDDMMYYYRegex.test(value) == false){
				success = false;
			}
		}
		else if(method == 'dateYYYY/MM/DD'){
		
		}
		else if(method == 'number'){
			var intRegex = /^\d+$/;
			tmp_value = element.val().replace(/\s+/g,'');	//--สำหรับตัดช่องว่างทิ้ง
			if(!intRegex.test(tmp_value)){
				success = false;
			}
		}
		else if(method == 'maxclength'){
		
		}
		else if(method == 'minclength'){
		
		}
		else if(method == 'maxnlength'){
		
		}
		else if(method == 'minnlength'){
		
		}
		else if(method == 'range'){
		
		}
		else if(method == 'max'){
			// $( "input:checked" ).length;
		}
		else if(method == 'min'){
		
		}
		else if(method == 'equalclength'){
		
		}
		else if(method == 'equalnlength'){
			element.val().replace(/ /g,'');
			if(element.val().length != param1){
				success = false;
			}
		}
		else{
			//--method = 'required'
			if($.trim(value) == ""){
				success = false;
			}
		}
		
		if(success == false){
			//--กำหนดค่าที่ต้องการแสดง error
			msgError = messagesValidErrorByMethod(method, element, param1, param2);
		}
		return success;
	}
	
	function addValidateForElement(element){
		//--เป็นฟังก์ชั่นใช้สำหรับแสดงการแจ้งเตือนกรณีที่กรอกข้อมูลผิดพลาด
		
		//--กำหนดจุดโฟกัส สำหรับ element แรกที่เกิด validate เท่านั้น
		if(countForFocus == 0){
			if(element.hasClass("chzn-select")){
				//--สำหรับ dropdown ที่ใช้ css class='chzn-select'
				element.next("div.chzn-container").find("a.chzn-single").focus();
			}else if(element.hasClass("ckeditor")){
				//--สำหรับ textarea ที่ใช้ plugin class='ckeditor'
				element.next("div.cke").find("iframe").contents().find("body").focus();
			}else{
				element.focus();
			}
			countForFocus = countForFocus + 1;
		}
		
		//--ตรวจสอบว่า element นี้ มีข้อความแจ้งเตือนอยู่แล้วหรือไม่ หากมีแล้วจะแสดงข้อความใหม่ทับไปเลย
		var genid = element.attr("genid");
		if($("body").find("label.validate_error#validate_"+genid).html() == null){
			if(element.hasClass("chzn-select")){
				//--สำหรับ dropdown ที่ใช้ css class='chzn-select'
				element.next("div.chzn-container").addClass("validerror");
				element.next("div.chzn-container").after("<label class=\"validate_error\" id=\"validate_"+genid+"\" style=\"white-space: normal;\" >"+msgError+"</label>" );
			}else if(element.hasClass("ckeditor")){
				//--สำหรับ textarea ที่ใช้ plugin class='ckeditor'
				element.next("div.cke").addClass("validerror");
				element.next("div.cke").after("<label class=\"validate_error\" id=\"validate_"+genid+"\" style=\"white-space: normal;\" >"+msgError+"</label>" );
			}else{
				element.after( "<label class=\"validate_error\" id=\"validate_"+genid+"\" style=\"white-space: normal;\" >"+msgError+"</label>" );
				element.addClass("validerror");
			}
		}
		else{
			$("body").find("label.validate_error#validate_"+genid).text(msgError);
		}
		$("body").find("label.validate_error#validate_"+genid).fadeIn("slow");
		numMsgError += 1;
	}
	
	function addValidateForProcessError(element){
		//--เป็นฟังก์ชั่นใช้สำหรับแสดงการแจ้งเตือนกรณีที่ตรวจสอบค่าที่กรอกแล้วผิดพลาด (คนละส่วนกับ class='validate')
		
		//--กำหนดจุดโฟกัส สำหรับ element แรกที่เกิด validate เท่านั้น
		if(countForFocus == 0){
			if(element.hasClass("chzn-select")){
				//--สำหรับ dropdown ที่ใช้ css class='chzn-select'
				element.next("div.chzn-container").find("a.chzn-single").focus();
			}else{
				element.focus();
			}
			countForFocus = countForFocus + 1;
		}
		
		//--ตรวจสอบ attr genid หากยังไม่มี ให้เพิ่มให้ใหม่
		genid = element.attr("genid");
		if(typeof genid == 'undefined'){
			genid = generateRandomId();
			element.attr("genid", genid);
		}
		
		//--ตรวจสอบว่า element นี้ มีข้อความแจ้งเตือนอยู่แล้วหรือไม่ หากมีแล้วจะไม่แสดงทับ
		if($("body").find("label.validate_error#validate_"+genid).html() == null){
			if(element.hasClass("chzn-select")){
				//--สำหรับ dropdown ที่ใช้ css class='chzn-select'
				element.next("div.chzn-container").addClass("validerror");
				element.next("div.chzn-container").after("<label class=\"validate_error\" id=\"validate_"+genid+"\" style=\"white-space: normal;\" >"+msgError+"</label>" );
			}
			else{
				element.after( "<label class=\"validate_error\" id=\"validate_"+genid+"\" style=\"white-space: normal;\" >"+msgError+"</label>" );
				element.addClass("validerror"); //--ต้องใส่ใน input ไม่ใช่ hidden
			}
			
			$("body").find("label.validate_error#validate_"+genid).fadeIn("slow");
			numMsgError += 1;
		}
	}
	
	function clearValidateForElement(element){
		//--เป็นฟังก์ชั่นใช้สำหรับลบการแจ้งเตือนกรณีที่กรอกข้อมูลถูกต้องและครบถ้วนแล้ว
		if(element.hasClass("validerror") || element.next("div.chzn-container").hasClass("validerror") || element.next("div.cke").hasClass("validerror")){
			if(element.hasClass("chzn-select")){
				//--สำหรับ dropdown ที่ใช้ css class='chzn-select'
				element.next("div.chzn-container").removeClass("validerror");
			}else if(element.hasClass("ckeditor")){
				//--สำหรับ textarea ที่ใช้ plugin class='ckeditor'
				element.next("div.cke").removeClass("validerror");
			}else{
				element.removeClass("validerror");
			}
				
			var genid = element.attr("genid");
			$("body").find("label.validate_error#validate_"+genid).fadeOut("slow",function(){$(this).remove()});
			//numMsgError -= 1;
		}
	}
	
	/*function clearValidateForProcessError(element){
		//--ตรวจสอบ attr genid หากยังไม่มี ให้เพิ่มให้ใหม่
		genid = element.attr("genid");
		if(typeof genid == 'undefined'){
			genid = generateRandomId();
			element.attr("genid", genid);
		}
		
		//--เป็นฟังก์ชั่นใช้สำหรับลบการแจ้งเตือนกรณีที่กรอกข้อมูลถูกต้องและครบถ้วนแล้ว(คนละส่วนกับ class='validate')
		if(element.hasClass("validerror") || element.next("div.chzn-container").hasClass("validerror")){
			if(element.hasClass("chzn-select")){
				//--สำหรับ dropdown ที่ใช้ css class='chzn-select'
				element.next("div.chzn-container").removeClass("validerror");
			}else{
				element.removeClass("validerror");
			}
				
			var genid = element.attr("genid");
			$("body").find("label.validate_error#validate_"+genid).fadeOut("slow",function(){$(this).remove()});
			//numMsgError -= 1;
		}
	}*/
	
	function clearAllValidate(){
		//--เป็นฟังก์ชั่นใช้สำหรับลบการแจ้งเตือนทั้งหมดออก เมื่อกดปุ่มบันทึก
		$("body").find(".validerror").each(function(index){
			$(this).removeClass("validerror");
			$(this).next("label.validate_error").remove();
		});
	}
	
	function checkSumErrorValid(){
		//--เป็นฟังก์ชั่นใช้สำหรับตรวจสอบว่ามี validate หรือไม่ หากมีต้องตัดโปรเซสทั้งหมด (return false)
		if(numMsgError > 0){
			var message = numMsgError == 1
			? 'เกิดข้อผิดพลาด 1 ที่ กรุณากรอกข้อมูลให้ถูกต้องตามข้อความสีแดงที่แสดงให้เห็น'
			: 'เกิดข้อผิดพลาด ' + numMsgError + ' ที่ กรุณากรอกข้อมูลให้ถูกต้องตามข้อความสีแดงที่แสดงให้เห็น';
			$("#da-ex-val1-error").html(message).show();
			return false;
		}
		else{
			$("#da-ex-val1-error").hide();
			return true;
		}
	}
	
	function messagesValidErrorByMethod(method, element, param1, param2){
		//--เป็นฟังก์ชั่นสำหรับแสดงค่าที่ผิดพลาด ตามประเภท method นั้นๆ
		switch(method){
			case 'email': 
				return "รูปแบบอีเมล์ไม่ถูกต้อง";
			case 'year':
				return "รูปแบบปีไม่ถูกต้อง";
			case 'decimal':
				return "ต้องเป็นตัวเลข ทดทศนิยมไม่เกิน 2 ตำแหน่ง";
			case 'more_percent':
				return "สัดส่วนรวมต้องไม่เกิน 100";
			case 'less_percent':
				return "สัดส่วนรวมต้องเท่ากับ 100";
			case 'dateDD/MM/YYYY': 
				return "รูปแบบวันที่ไม่ถูกต้อง";
			case 'dateYYYY/MM/DD': 
				return "รูปแบบวันที่ไม่ถูกต้อง";
			case 'number': 
				return "กรุณาป้อนเฉพาะตัวเลขเท่านั้น";
			case 'maxclength': 
				return "ต้องมีอักขระ ความยาวไม่ต่ำกว่า " + param1 + " ตัว";
			case 'minclength': 
				return "ต้องมีอักขระ ความยาวไม่เกิน " + param1 + " ตัว";
			case 'maxnlength': 
				return "ต้องเป็นตัวเลข ความยาวไม่ต่ำกว่า " + param1 + " ตัว";
			case 'minnlength': 
				return "ต้องเป็นตัวเลข ความยาวไม่เกิน " + param1 + " ตัว";
			case 'range': 
				return "ค่าต้องอยู่ระหว่าง " + param1 + " ถึง " + param2 + " เท่านั้น";
			case 'max': 
				return "ค่าต้องไม่ต่ำกว่า " + param1;
			case 'min': 
				return "ค่าต้องไม่สูงกว่า " + param1;
			case 'equalclength': 
				return "ต้องเป็นตัวอักขระ ความยาวเท่ากับ " + param1 + " ตัว เท่านั้น";
			case 'equalnlength': 
				return "ต้องเป็นตัวเลข ความยาวเท่ากับ " + param1 + " ตัว เท่านั้น";
			case 'dup_author':
				return "ชื่อผู้ทำผลงานวิจัยซ้ำ";
			case 'autocp':
				title = element.attr("autoMsg");
				if(typeof title == 'undefined'){
					title = "";
				}
				return "กรุณาเลือก"+title+"จาก auto complete เท่านั้น";
			case 'choose_journal':
				return "กรุณาเลือกวารสารจาก auto complete เท่านั้น";
			default:
				//--method = 'required'
				title = element.attr("requiredMsg");
				if(typeof title == 'undefined'){
					title = "กรุณากรอกข้อมูล";
				}
				return title;
		}
	}
	
	function generateRandomId(){
		//--เป็นฟังก์ชั่นใช้สำหรับ generate id ที่ไม่ซ้ำ ให้กับแอททริบิวท์ genid
		var string;
		string = "gen" + generateRandomChar() + generateRandomChar() + generateRandomChar();
		
		var count = 0;
		$('form#da-ex-validate1').find("[genid~='"+string+"']").each(function(index) {
			count++;
		});
			
		while(count > 0){
			string += generateRandomChar();
			
			count = 0;
			$('form#da-ex-validate1').find("[genid~='"+string+"']").each(function(index) {
				count++;
			});
		}
		return string;
    }
	
	function generateRandomChar(){
		//--เป็นฟังก์ชั่นใช้สำหรับ random อักขระทีละตัวอักษร
		var chars, newchar, rand;
		chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		rand = Math.floor(Math.random() * chars.length);
		return newchar = chars.substring(rand, rand + 1);
    }
});