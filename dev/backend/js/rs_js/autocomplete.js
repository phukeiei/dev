
var globaldata = "";
var numrow;
var obj;
var get;
var sub_contract = "";
var currentStep = 0;
var edit;
var ig_id;

	$(function(){
		// Autocomplete
		$(document).on("keydown",".autocomplete",function(event) { //onkeydown
			switch(event.keyCode) {
				case 38: 			// up
					moveactive(-1);
					break;
				case 40: 			// down
					moveactive(1);
					break;
				case 9:  			// tab
					$(document).find(".autocomplete-block").each(function(index) {
						acLink(currentStep);				//go to function acLink
					});
					break;
				case 13:			// return
					event.cancelBubble = false;		//stop event 
					event.returnValue = false;		//
					$(document).find(".autocomplete-block").each(function(index) {
						acLink(currentStep);				//go to function acLink
					});
					return false;
					break;
			}
			$(this).attr("autocomplete","off");	//set attribute autocomplete=off
		}).on("keyup",".autocomplete",function(event) { //onkeyup
		
			switch(event.keyCode) {
				case 38: 			// up
				case 40: 			// down
				case 9:  			// tab
				case 13:			// return
				return;
			}
			
			obj = $(this);
			get = obj.attr("get"); 	//set get ,for append url
			key = obj.val();		//set key ,for search
			
			//-- 2013-06-12 (meuzicxx) AUTOCOMPLETE Multi Post Variables
			ig_id = obj.attr("ig_id");
			
			//acStart($(this));
			
			url = ajax_url+get;		// get append url
	/*
			$.post(url, { q: key, igt_id: igt_id},
				function(data) {
					
					if(data != null && data!=''){
						alert(data);
						globaldata = data;
						li = "";
						$.each(data, function(i,item){
							li += "<li class=\"autocomplete-item\" onclick=\"acLink("+i
							+")\"><a href=\"javascript:void(0);\">"+item.name+"</a></li>";		// add to list autocomplete
						});
						$(".autocomplete-block").remove();	//delete block list autocomplete
						if(li == ""){		//if li not value -> stop
							return;
						}
						obj.before("<div class=\"autocomplete-block\"><ul class=\"autocomplete-list\">"
						+li+"</ul></div>"); 	//add list autocomplete to block 
						$("li.autocomplete-item").first().addClass("active");	//li active at first row  
						currentStep = 0;		//first row -> currentStep = 0
					}else {
						
						$(".autocomplete-block").remove();	//delete block list autocomplete
					}
				}
			,"json");
	*/

	$.ajax({
				type: "POST",
				url: url,
				data:  { q: key, ig_id: ig_id},
				dataType: "json",
				success: function(data, textStatus, jqXHR) {
							if(data != null && data!=''){
								globaldata = data;
								li = "";
								$.each(data, function(i,item){
									li += "<li class=\"autocomplete-item\" onclick=\"acLink("+i
									+")\"><a href=\"javascript:void(0);\">"+item.name+"</a></li>";		// add to list autocomplete
								});
								$(".autocomplete-block").remove();	//delete block list autocomplete
								if(li == ""){		//if li not value -> stop
									return;
								}
								obj.before("<div class=\"autocomplete-block\"><ul class=\"autocomplete-list\">"
								+li+"</ul></div>"); 	//add list autocomplete to block 
								$("li.autocomplete-item").first().addClass("active");	//li active at first row  
								currentStep = 0;		//first row -> currentStep = 0
							}else {
								
								$(".autocomplete-block").remove();	//delete block list autocomplete
							}
				},
				error: function(xhr, status, error) {
					//alert ("Error: " + error);
					$(".autocomplete-block").remove();	//delete block list autocomplete
				}
			});
			
		});	
	});


function moveactive(step){
	if(step == -1 && currentStep == 0){ 
		return false;
	}
	if(step == 1 && currentStep == numrow-2){
		return false;
	}
	currentStep = currentStep + step;
	$("li.autocomplete-item").removeClass("active");
	$("li.autocomplete-item:eq("+currentStep+")").addClass("active");
}



