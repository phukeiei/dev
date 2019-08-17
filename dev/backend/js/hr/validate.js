/*
@Author : Jiranun
@Date : June 30, 2016
@Detail : Validate element in form
@Param : form (ID of tag form)
@syntax: validate_form('frm_save') กรณีไว้นอก form  or validate_form(this.form.id) กรณีไว้ใน form ใส่ validate ไว้ใน tag ที่ต้องการ
*/
function validate_form(forms){
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
				var elem = elementform[i];
				var elem_id = elementform[i].id;//get id of element
				var prev_ele = $("#"+elem_id).parent().attr("id");//get id of previous elements
				//console.log("validate:" + prev_ele+" : "+elementform[i].value);
				if(elementform[i].value == ""){
					if( $(elem).hasClass("select2") ){
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
						
						//console.log("#"+elem_id);
					}else{
						$("#"+prev_ele).addClass("has-error");
						
					}
					chk_valid++;
				}else{
					if( $(elem).hasClass("select2") ){
						var searchEles = document.getElementById(prev_ele).children;
						
						$(searchEles).each(function( index ) {
							if( $( this ).attr("id")  == "s2id_"+elem_id ){
								var sub_ele = document.getElementById($( this ).attr("id")).children;
								console.log(sub_ele);
								$(sub_ele).each(function( sub_index ) {
									if( $(sub_ele).hasClass("select2-offscreen")){										
										$( this ).css("background","transparent");
										$( this ).css("border-color","#e0e0e0");
									}
								});//end sub element sub_ele
							}
						});//end element searchEles
						
						//console.log("#"+elem_id);
					}else{
						$("#"+prev_ele).removeClass("has-error");
					}
					
				}
			}//end check console.log(elementform[i].tagName);
		}
	}//end for
	if(chk_valid > 0){
		return false;
	}else{

		//กรณีเอาไว้นอก form
		$("#"+forms).submit();
		return true;
	}

}//end fn validate_form
