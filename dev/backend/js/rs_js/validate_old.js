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

$(document).ready(function(){  
	//validate
	$("form#da-ex-validate1").submit(validate);
	$(".after-validate").live({
		keyup: function(){clearValidate($(this))},
		change: function(){clearValidate($(this))},
	});
	var flag = 0;
	var count = 0;
	/*
	if($(this).is(":radio")){ 
			return click: function(){clearValidate($(this))}
		} 
		else if($(this).is(":checkbox")){ 
			change: function(){clearValidate($(this))} 
		} 
		else if($(this).is("select")){ 
			change: function(){clearValidate($(this))} 
		} 
		else{ 
			keyup: function(){clearValidate($(this))}
		}
	*/
	
	function validate(e){
		$(this).find(".validate2").each(function(index) {
			title = $(this).attr("requiredMsg");
			genid = $(this).attr("genid");
			if(typeof genid == 'undefined'){
				genid = generate_random_id();
				$(this).attr("genid", genid);
			}
			
			
			//genid = "gen111"; //attr("genid", genid)
			
			/*$("body").find(".validate2").each(i, function(tmp_index) {
				alert(i);
			});*/
			//alert($(this).attr("name") + ":" + genid + "=>>" + $("body").attr("genid").val(genid).length);
			
			if(typeof title == 'undefined'){
				title = "กรุณาป้อนข้อมูล";
			}
			
			require = $(this).attr("for");
			
			//alert($(this).attr("name") + "=" + $(this).val());
			
			//require = $(this).attr("for");
			/*if($(this).attr("name")=="rs_rt_id"){
				alert("type=" + $(this).is('select'));
				alert("value=" + $(this).val());
			}*/
			// $(this).attr("name")=="rs_title_en" 
			/*if($(this).hasClass("chzn-select")){
				//divid = $(this).attr("id");
				//$("body").find("div#"+divid+"__chzn")
				//e.preventDefault();
				alert($(this).val());
			}
			else*/ 
			if (($(this).is(':checkbox') && $(this).checked == false) || $.trim($(this).val()) == "") {
				
				// Focus first
				if(count == 0){
					if($(this).hasClass("chzn-select")){
						//-- select
						$(this).next("div.chzn-container").find("a.chzn-single").focus();
					}else{
						$(this).focus();
					}
					count = count + 1;
				}
				//if($("body").find("span.validate_error#validate_"+title).html()==null){
				if($("body").find("label.validate_error#validate_"+genid).html()==null){
					/*this_offset = $(this).offset();
					this_width = $(this).width();
					span_left = this_offset.left+this_width+16;
					span_top = this_offset.top-10;*/
					msgError = title;
					
					if($(this).hasClass("chzn-select")){
						//-- select
						$(this).next("div.chzn-container").addClass("validerror");
						$(this).next("div.chzn-container").after("<label class=\"validate_error\" id=\"validate_"+genid+"\" >"+msgError+"</label>" );
					}else{
						$(this).after( "<label class=\"validate_error\" id=\"validate_"+genid+"\" >"+msgError+"</label>" );
						$(this).addClass("validerror");
					}
					//$("body").append("<span class=\"validate_error\" style=\"left:"+span_left+"px;top:"+span_top+"px;\">"+msgError+"</span>");
					
					$(this).addClass("after-validate");
					$(".validate_error").fadeIn("slow");
					//alert(msgError);
				}
				flag += 1;
				
			} else {
				//$("body").find("span.validate_error#validate_"+title).fadeOut("slow",function(){$(this).remove()});
				$(this).removeAttr("genid");
				$("body").find("label.validate_error#validate_"+genid).fadeOut("slow",function(){$(this).remove()});
			}
		});
		
		if(flag > 0){
			var message = flag == 1
			? 'เกิดข้อผิดพลาด 1 จุด (ตามข้อความสีแดงที่แสดงให้เห็น) กรุณากรอกข้อมูลให้ถูกต้องและครบถ้วน'
			: 'เกิดข้อผิดพลาด ' + flag + ' จุด (ตามข้อความสีแดงที่แสดงให้เห็น) กรุณากรอกข้อมูลให้ถูกต้องและครบถ้วน';
			$("#da-ex-val1-error").html(message).show();
			
			return false;
		} else {
			$("#da-ex-val1-error").hide();
		}
	}
	
	function check_valid(method, value, element, param){
		switch(method){
			case 'required':
				switch( element.nodeName.toLowerCase() ) {
					case 'select':
						// could be an array for select-multiple or a string, both are fine this way
						var val = $(element).val();
						return val && val.length > 0;
					case 'input':
						if ( checkable(element) )
							return this.getLength(value, element) > 0;
					default:
						return $.trim(value).length > 0;
				}
		}
		
		
		/*required: function(value, element, param) {
			// check if dependency is met
			if ( !this.depend(param, element) )
				return "dependency-mismatch";
			switch( element.nodeName.toLowerCase() ) {
			case 'select':
				// could be an array for select-multiple or a string, both are fine this way
				var val = $(element).val();
				return val && val.length > 0;
			case 'input':
				if ( this.checkable(element) )
					return this.getLength(value, element) > 0;
			default:
				return $.trim(value).length > 0;
			}
		},*/
		
	}
	
	function clearValidate(obj){
		//alert(obj.attr("name") + "=" + obj.val());
		
		if ((obj.is(':checkbox') && obj.checked == true) || $.trim(obj.val()) != "") {
			var genid = obj.attr("genid");
			
			//$("body").find("span.validate_error#validate_"+title).fadeOut("slow",function(){obj.remove()});
			if(obj.hasClass("chzn-select")){
				//-- select
				obj.next("div.chzn-container").removeClass("validerror");
			}else{
				obj.removeClass("validerror");
			}
			
			//obj.removeClass("validerror");
			
			$("body").find("label.validate_error#validate_"+genid).fadeOut("slow",function(){$(this).remove()});
		}
		else{
			method = obj.attr("for");
			param = obj.attr("genid");
			if(obj.is(':checkbox')){
				check_valid("checked", obj.checked, obj, 0);
			}
			else if(obj.is(':radio')){
				check_valid("checked", obj.checked, obj, 0);
			}
			else if(obj.is('select')){
				check_valid("selected", obj.val(), element, param);
			}
			else if(obj.is('input') || obj.is('textarea')){
				check_valid(method, obj.val(), element, param);
			}
		}
	}
	
	function generate_random_id(){
		var string;
		string = "gen" + generate_random_char() + generate_random_char() + generate_random_char();
		/*while ($("body").attr("genid", string).length > 0) {
			string += generate_random_char();
		}*/
		return string;
    }
	
	function generate_random_char(){
		var chars, newchar, rand;
		chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		rand = Math.floor(Math.random() * chars.length);
		return newchar = chars.substring(rand, rand + 1);
    }
});