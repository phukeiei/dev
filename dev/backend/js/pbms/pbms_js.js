/*
fn เชค br ใน textarea
@Author : Jiranun
@Date : October 17, 2016
@Detail : Putting comma on number by onkeyup
@Param : -
@return : number format
@syntax: class=\"form-control chk_number\"
*/

function onCheckTextarea(this_id) {
    var key = window.event.keyCode;

    // If the user has pressed enter
    //console.log(key);
	if (key === 13) { //13=enter, 165 = shift
        document.getElementById(this_id).value = document.getElementById(this_id).value + " ";
		event.preventDefault();		
        return false;
    }
    else {
        return true;
    }
}

	
/*
fn เชค number แล้วใส่ comma
@Author : Jiranun
@Date : October 17, 2016
@Detail : Putting comma on number by onkeyup
@Param : -
@return : number format
@syntax: class=\"form-control chk_number\"
*/

$(document).on('keyup', '.chk_number', function() {
    var x = $(this).val();
    $(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
});


/*
fn validate_form_pbms : เชคว่ามีการกรอกข้อมูลหรือไม่
@Author : Jiranun
@Date : June 30, 2016
@Detail : Validate element in form
@Param : form (ID of tag form)
@return : true or false
@syntax: validate_form('frm_save') กรณีไว้นอก form  or validate_form(this.form.id) กรณีไว้ใน form 
		และทั้ง 2 กรณีให้ ใส่ validate ไว้ใน tag ที่ต้องการ 
		และ ใส่ id ให้ div ที่เป็น parent ของ tag ที่ validate และ คำว่า 'validate' ให้กับ element input ที่ต้องการตรวจสอบ
*/
function validate_form_pbms(forms){
	//console.log(forms);
	var elementform = document.getElementById(forms);
	var chk_valid =0;
	for (var i = 0; i < elementform.elements.length; i++){	
		var attr = elementform[i].hasAttribute("validate");
		// For some browsers, `attr` is undefined; for others, `attr` is false. Check for both.
		if (typeof attr !== typeof undefined && attr !== false) {
			 // Element has this attribute
			 //console.log("validate:" + ele); //validate
			 if(elementform[i].tagName != "BUTTON" && elementform[i].tagName != "button"){
				//console.log(elementform[i].type);
				
				var elem = elementform[i];
				var elem_id = elementform[i].id;//get id of element
				var prev_ele = $("#"+elem_id).parent().attr("id");//get id of previous elements
				//console.log("validate:" + prev_ele+" : "+elementform[i].value);
				
				
				/*
				Case : กรณีเป็น tag select 	
				Date : Oct 10, 2016
				Editor : Jiranun
				*/					
				//console.log( elementform[i].tagName);
				if(elementform[i].tagName == "select" || elementform[i].tagName == "SELECT"){
					var selector = document.getElementById(elem_id);
					var selector_value = selector[selector.selectedIndex].value;
					//console.log(elem_id + " = " +selector_value);
					
					//เมื่อไม่มีค่า
					if(selector_value == "" || selector_value ==0 ){
						if( $(elem).hasClass("select2")){
							var searchEles = document.getElementById(prev_ele).children;						
							$(searchEles).each(function( index ) {
								if( $( this ).attr("id")  == "s2id_"+elem_id ){
									var sub_ele = document.getElementById($( this ).attr("id")).children;
									//console.log(sub_ele);
									$(sub_ele).each(function( sub_index ) {
										if( $(sub_ele).hasClass("select2-offscreen")){
											var sub_id = $( this ).attr("id");
											$( this ).css("background","#fbe8e5");
											$( this ).css("border-color","#f69988");
										}
									});//end sub element sub_ele
								}
							});//end element searchEles
							
						}else if( $(elem).hasClass("select2-offscreen")){
							var ele_node = document.getElementById(prev_ele);
							
							if( $("#"+prev_ele).children().length ) {
								//console.log("!empty");
								var ele_node = document.getElementById(prev_ele).children;
								$(ele_node).each(function( index ) {
									if( $( this ).attr("id")  == "s2id_"+elem_id ){
										var sub_ele = document.getElementById($( this ).attr("id")).children;
										
										$(sub_ele).each(function( sub_index ) {
											if( $(sub_ele).hasClass("select2-offscreen")){
												var sub_id = $( this ).attr("id");
												$( this ).css("background","#fbe8e5");
												$( this ).css("border-color","#f69988");
											}
										});//end sub element sub_ele
									}
								});//end element ele_node	
							}else{
								var ele_parent = $("#"+ elem_id).prev(); 
								$(ele_parent).each(function( sub_index ) {
									
									if( $( this ).attr("id")  == "s2id_"+elem_id ){
										var sub_ele = document.getElementById($( this ).attr("id")).children;
										
										$(sub_ele).each(function( sub_index ) {
											if( $(sub_ele).hasClass("select2-offscreen")){
												var sub_id = $( this ).attr("id");
												$( this ).css("background","#fbe8e5");
												$( this ).css("border-color","#f69988");
											}
										});//end sub element sub_ele
									}
								});//end sub element sub_ele
								
							}
							
						}
						chk_valid++;
					}//end check null value
					else{
						//เมื่อมีค่า
						if( $(elem).hasClass("select2") ){
							var searchEles = document.getElementById(prev_ele).children;
							
							$(searchEles).each(function( index ) {
								if( $( this ).attr("id")  == "s2id_"+elem_id ){
									var sub_ele = document.getElementById($( this ).attr("id")).children;
									//console.log(sub_ele);
									$(sub_ele).each(function( sub_index ) {
										if( $(sub_ele).hasClass("select2-offscreen")){										
											$( this ).css("background","transparent");
											$( this ).css("border-color","#e0e0e0");
										}
									});//end sub element sub_ele
								}
							});//end element searchEles
							
						}else if( $(elem).hasClass("select2-offscreen")){
							var ele_node = document.getElementById(prev_ele);
							
							if( $("#"+prev_ele).children().length ) {
								//console.log("!empty");
								var ele_node = document.getElementById(prev_ele).children;
								$(ele_node).each(function( index ) {
									if( $( this ).attr("id")  == "s2id_"+elem_id ){
										var sub_ele = document.getElementById($( this ).attr("id")).children;
										
										$(sub_ele).each(function( sub_index ) {
											if( $(sub_ele).hasClass("select2-offscreen")){
												var sub_id = $( this ).attr("id");
												$( this ).css("background","transparent");
												$( this ).css("border-color","#e0e0e0");
											}
										});//end sub element sub_ele
									}
								});//end element ele_node	
							}else{
								var ele_parent = $("#"+ elem_id).prev(); 
								$(ele_parent).each(function( sub_index ) {
									
									if( $( this ).attr("id")  == "s2id_"+elem_id ){
										var sub_ele = document.getElementById($( this ).attr("id")).children;
										
										$(sub_ele).each(function( sub_index ) {
											if( $(sub_ele).hasClass("select2-offscreen")){
												var sub_id = $( this ).attr("id");
												$( this ).css("background","transparent");
												$( this ).css("border-color","#e0e0e0");
											}
										});//end sub element sub_ele
									}
								});//end sub element sub_ele
								
							}
							
						}
							
					}//end check has value
					
					
					
					
					
				}else if(elementform[i].type == "radio"){
				/*
				Case : กรณีเป็น radio type	
				Date : Sep 9, 2016
				Editor : Jiranun
				*/	
				
					var radio_ele = $("#"+ elem_id).parent().offsetParent().attr("id"); //get id of previous elements
					
					var num_true = 0;
					var num_false = 0;
					var ele_radio = document.getElementsByName(elementform[i].name);
						//console.log(ele_radio.length);
						$.each(ele_radio,function(index,obj){
							
							//console.log(document.getElementById(obj.id).checked);
							if(document.getElementById(obj.id).checked == false){
								//console.log("false " + obj.id);
								$("#"+radio_ele).addClass("has-error");
								num_false++;
							}else{
								num_true++;
							}							
							
						});
						//console.log("num_true:"+num_true + ", num_false:"+num_false);
						if(num_false == ele_radio.length){
							chk_valid++;
						}else if(num_true < ele_radio.length && num_true >0){
							$("#"+radio_ele).removeClass("has-error");
						}
						
					
				}//end check type radio. 
				else{
					//Tag INPUT ,...
					if(elementform[i].value == "" ){
						$("#"+elem_id).css("background","#fbe8e5");
						$("#"+elem_id).css("border-color","#f69988");
						//$("#"+prev_ele).addClass("has-error");
						chk_valid++;
					}//check null value
					else{
						$("#"+elem_id).css("background","transparent");
						$("#"+elem_id).css("border-color","#e0e0e0");
						//$("#"+prev_ele).removeClass("has-error");
					}
				}//end check tag main
				
				
			}//end check console.log(elementform[i].tagName);
		}
	}//end for
	
	
	//console.log("chk_valid: " + chk_valid);
	if(chk_valid > 0){
		//console.log(chk_valid);
		return false;
	}else{
		//console.log("else:" + chk_valid);
		//กรณีเอาไว้นอก form
		//$("#"+forms).submit();
		return true;		
	}

}//end fn validate_pbms_form

/* fn call_notice 
 * Call notification on page
 * @input: str("Title"),str_desc("that description."), type_class("success")
 * @output: Saved Success.
 * @author: Jiranun
 * @Create Date: 2559-08-10
 * Example: call_notice("แจ้งเตือน", "ไม่พบข้อมูลของบุคคลนี้ในฐานข้อมูล" ,"warning");
*/
function call_notice(str_title,str_desc,type_class){
	//alert(type_class);
	//ชื่อกล่องแจ้งเตือน Title 
	if(str_title ==""){
		str_title = "Notice";
	}
	//อธิบายการแจ้งเตือนนั้น 
	if(str_desc ==""){
		str_desc = "Check me out! I'm a notice.";
	}
		
	//Class สีในการแสดงข้อมูล
	var icon = "ti-info-alt";
	if(type_class == "success"){
		icon = "ti-face-smile";
	}else if(type_class == "warning"){
		icon = "ti-help-alt";
	}else if(type_class == "danger" || type_class == "error" ){
		type_class = "error";
		icon = "ti-close";
	}else if(type_class == ""){
		type_class = "info";
		icon = "ti-info-alt";
	}
	
	//type_class = "success";
	new PNotify({
		title: str_title,
		text: str_desc,
		type: type_class,
		icon: "ti "+ icon,		
		/*width: "100%",*/
		styling: 'fontawesome',
		shadow: false,
		animate_speed: 'fast',
		destroy: true,
		offset: 20,
		spacing: 10,
		z_index: 1031,
		delay: 5000,
		timer: 1000
		
	});
}//end fn notification

/* fn pbms_call_modal 
 * Call modal on page
 * @input: title_modal("Title modal"),modal_id("panel_id"),flag_reset(Flag that reset form in panel Y:N)
 * @output: Display modal.
 * @author: Jiranun
 * @Create Date: 2559-09-29
 * Example: pbms_call_modal("เพิ่มข้อมูล", "panel","Y")
*/
function pbms_call_modal(title_modal, modal_id,flag_reset){	
	//console.log(modal_id+" : "+title_modal);
	//$("#modal-title").text(title_modal);
	var flag = "";
	if(flag_reset == "" || flag_reset == "Y"){
		flag = "Y";
		var form_id = $("#" + modal_id).find("form").attr("id");		
		
		
		//Reset form that in panel modal
		$("#" + form_id).trigger('reset'); //--> jquery
		//document.getElementById(form_id).reset(); --> js
		//console.log("form_id:" + form_id);
	}else{
		flag = "N";
	}
		
	$("#" + modal_id).modal({ 
	  "backdrop"  : 'static', // This disable for click outside event
	  "keyboard"  : false,
	  "resizable": false,
	  "show"      : true  // ensure the modal is shown immediately
	});
	$("#" + modal_id).find('.modal-title').text(title_modal);
	
}//end fn pbms_call_modal

/* fn pbms_confirm 
 * Call confirm box
 * @input: message_str("message"),label_confirm("name btn")
 * @output: return true/false from btn confirm 
 * @author: Jiranun
 * @Create Date: 2559-10-03
 * Example: pbms_confirm("คุณต้องการลบข้อมูลนี้ ?", "ลบ", function(check){
				if(check == true){
					// Statement when confirm == true    
				}				           
			});
*/
function pbms_confirm(message_str,label_confirm,callback){
	 var options = {            
        message: message_str
    };
	var btn_confirm = "primary";
	if(label_confirm.includes("ตกลง")){
		btn_confirm = "primary";
	}else if(label_confirm.includes("บันทึก")){
		btn_confirm = "success";
	}else if(label_confirm.includes("ลบ")){
		btn_confirm = "danger";
	}
	//console.log(btn_confirm);
    options.buttons = {
        cancel: {
            label: "ยกเลิก",
            className: "btn-inverse pull-left",
            callback: function(result) {
                callback(false);
            }
        },
        main: {
            label: label_confirm,
            className: "btn-"+btn_confirm+" pull-right",
            callback: function (result) {
                callback(true);
            }
        }
    };
    bootbox.dialog(options);	
}//end fn pbms_confirm


/* pbms_get_attr_by_form 
 * Getting attribute name of from id
 * @input: frm_id (form id)
 * @output: list of attr("name")
 * @author: Jiranun
 * @Create Date: 2559-10-11
 */
function pbms_get_attr_by_form(frm_id){
	var elementform = document.getElementById(frm_id);
	var ele_name = [];
	$.each(elementform,function(index,obj){
		if(obj.tagName != "BUTTON" && obj.tagName != "button" && obj.hasAttribute("name")){
			ele_name.push(obj.getAttribute("name"))
			//console.log(ele_name);
		}
	});
	//console.log(ele_name)
	return ele_name;
}//end fn pbms_get_attr_by_form


function datepicker(start_id,finish_id){
	//console.log(start_id + ":" +finish_id);
	// datapicker
	var d = new Date();
	var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() + 543);
   			
   		// กรณีต้องการใส่ปฏิทินลงไปมากกว่า 1 อันต่อหน้า ก็ให้มาเพิ่ม Code ที่บรรทัดด้านล่างด้วยครับ (1 ชุด = 1 ปฏิทิน)
   		$("#"+start_id).datepicker({ 
		todayBtn:  1,
        autoclose: true,
		}).on('changeDate', function (selected) {
			var minDate = new Date(selected.date.valueOf());
			
			$("#"+finish_id).datepicker('setStartDate', minDate);
		});
		
   		$("#"+finish_id).datepicker({ 		
		}).on('changeDate', function (selected) {
			var maxDate = new Date(selected.date.valueOf());
			$("#"+start_id).datepicker('setStartDate', maxDate);
		});
}//datepicker