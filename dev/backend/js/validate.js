/*
fn validate_form : เชคว่ามีการกรอกข้อมูลหรือไม่    with submit
@Author : Jiranun
@Date : June 30, 2016
@Detail : Validate element in form
@Param : form (ID of tag form), submit (true => ให้ submit form , false => ไม่ submit)
@return : true or false
@syntax: validate_form('frm_save') กรณีไว้นอก form  or validate_form(this.form.id) กรณีไว้ใน form 
		และทั้ง 2 กรณีให้ ใส่ validate ไว้ใน tag ที่ต้องการ 
		และ ใส่ id ให้ div ที่เป็น parent ของ tag ที่ validate และ คำว่า 'validate' ให้กับ element input ที่ต้องการตรวจสอบ
*/
function validate_form(forms, submit=""){
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
				else if(elementform[i].type == "file"){
				/*
				Case : กรณีเป็น file type	
				Date : June 23, 2017
				Editor : Jiranun
				*/	
					//console.log("file:" + elementform[i].name);
				
					if(elementform[i].value == "" ){								
						var file_ele = $("#"+ elem_id).parent().attr("id");
						//console.log("parent:" +file_ele);
						
						
						var ele_node = $("#"+file_ele).parent().prev();
						$(ele_node).each(function( index ) {							
							if( $( this ).hasClass("uneditable-input") ){
								//console.log(">> :" + $( this ).attr("class"));
								$( this ).css("background","#fbe8e5");
								$( this ).css("border-color","#f69988");
								
							}
						});
						
						var ele_node = $("#"+file_ele).parent().prev().children();
						$(ele_node).each(function( index ) {
							//console.log(">> :" + $( this ).attr("class"));
							if( $( this ).attr("class") == "fileinput-filename"){ //ชื่อไฟล์นำเข้า
								var val_filename = $( this ).text();
								//console.log("val_filename: " + val_filename);
								if(val_filename == "" || val_filename == null){
									//console.log("val_filename: " + val_filename);
									
									$("#"+file_ele).removeClass("btn-default");
									$("#"+file_ele).css("background","#fbe8e5");
									$("#"+file_ele).css("border-color","#f69988");
									
									
									if( $("#"+file_ele).hasClass("btn-file") ){
										//btn แก้ไข
										//console.log(">>:" +$("#"+file_ele).attr("class"));
										if( $("#"+file_ele).hasClass("btn-default") ){
											var ele_sub = $("#"+file_ele).children();
											$(ele_sub).each(function( index ) {	
												console.log(">>>:" + $( this ).attr("class"));
												//if($( this ).attr("class") == "fileinput-new"){
													
													$( this ).css("background","#fbe8e5");
													$( this ).css("border-color","#f69988");
												//}
											});

										}
									}//check hass class btn-file
									
									
									//BTN ลบ
									var ele_sub = $("#"+file_ele).parent().children();
									$(ele_sub).each(function( index ) {										
										if($( this ).hasClass("fileinput-exists") == true){
											//console.log(">>> :" + $( this ).attr("class") + ", text:"+ $( this ).text());
											var txt = $( this ).text();
											if($( this ).hasClass("btn-default") ){
												$( this ).removeClass("btn-default");	
												$( this ).css("background","#fbe8e5");
												$( this ).css("border-color","#f69988");
												$( this ).text(txt).css("color", "black")
											}
										}
									});
									
									
								}//check filename
								
							}//class fileinput-filename
						});
						
						
						chk_valid++;
					}//check null value
					else{
						//console.log("----------- else -----------");
						var file_ele = $("#"+ elem_id).parent().attr("id");
						var ele_node = $("#"+file_ele).parent().prev();
						$(ele_node).each(function( index ) {							
							if( $( this ).hasClass("uneditable-input") ){
								//console.log(">> :" + $( this ).attr("class"));
								$( this ).css("background","transparent");
								$( this ).css("border-color","#e0e0e0");
								
							}
						});
						
						var ele_node = $("#"+file_ele).parent().prev().children();
						$(ele_node).each(function( index ) {
							//console.log(">> :" + $( this ).attr("class"));
							if( $( this ).attr("class") == "fileinput-filename"){
								var val_filename = $( this ).text();
								//console.log("val_filename: " + val_filename);
								if(val_filename != "" || val_filename != null){
									//console.log("val_filename: " + val_filename); //ชื่อไฟล์นำเข้า
									
									$("#"+file_ele).removeClass("btn-default");
									$("#"+file_ele).css("background","transparent");
									$("#"+file_ele).css("border-color","#e0e0e0");
									
									
									if( $("#"+file_ele).hasClass("btn-file") ){
										//btn แก้ไข
										//console.log(">>:" +$("#"+file_ele).attr("class"));
										if( $("#"+file_ele).hasClass("btn-default") ){
											var ele_sub = $("#"+file_ele).children();
											$(ele_sub).each(function( index ) {	
												console.log(">>>:" + $( this ).attr("class"));
												//if($( this ).attr("class") == "fileinput-new"){
													
													$( this ).css("background","transparent");
													$( this ).css("border-color","#e0e0e0");
												//}
											});

										}
									}//check hass class btn-file
									
									
									//BTN ลบ
									var ele_sub = $("#"+file_ele).parent().children();
									$(ele_sub).each(function( index ) {										
										if($( this ).hasClass("fileinput-exists")){
											//console.log(">>> :" + $( this ).attr("class") + ", text:"+ $( this ).text());
											var txt = $( this ).text();
											if($( this ).hasClass("btn-default") == false ){
												$( this ).addClass("btn-default");	
												$( this ).css("background","transparent");
												$( this ).css("border-color","#e0e0e0");
												$( this ).text(txt).css("color", "black")
											}
										}
									});
									
									
								}//check filename
								
							}//class fileinput-filename
						});
						
					}//end check file
					
				
				}//end check type file
				
				
				
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
		if(submit== true || submit == ""){
			$("#"+forms).submit();
		}
		return true;		
	}

}//end fn validate_form



