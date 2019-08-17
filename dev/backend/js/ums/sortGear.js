/*
 * Dandelion Admin v1.2 - Table Demo JS
 *
 * This file is part of Dandelion Admin, an Admin template build for sale at ThemeForest.
 * For questions, suggestions or support request, please mail me at maimairel@yahoo.com
 *
 * Development Started:
 * March 25, 2012
 * Last Update:
 * July 25, 2012
 *
 */
 
(function($) {
	$(document).ready(function(e) {
	
	// set Link to Div Permission
	$(".Permission").each(function(){
		
		$(this).bind("click");
		$(this).click(function(){
			$( "#progressbar" ).progressbar({
				value: 100
			});
			window.location.href=$(this).attr("href");
		});
	});
	// Set Sorting item
		$( ".da-panel-content" ).sortable({ 
			connectWith: ".da-panel-content",placeholder: "ui-state-highlight"
			});
				$( ".System" ).addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
							.find( ".System-header" )
							.addClass( "ui-widget-header ui-corner-all" )
							.end()
							.find( ".System-content" );
				$( ".System-header .ui-icon" ).click(function() {
					$( this ).parents( ".System:first" ).find( ".System-content" ).toggle();
				});
	// Close Sorting off & Hide Close Button
		$(".da-panel-content").sortable("disable");	
		$("#close").hide();
	/* 	when click sorting button
		set link off div Permission
		hide sorting button
		sorting item enable
		show close button
	*/
		$("#sorting").click(function(){
				$(".Permission").each(function(){
					$(this).unbind("click");
				});
				$("#sorting").hide();
				$("#close").show();
				$(".System").css("border-color","green");
				$(".da-panel-content").sortable("enable");
				$( ".da-panel-content" ).disableSelection();
		});
	/*  when click close button 
		set link on div Permission agian
		hide close button
		show sort button 
	*/
		$("#close").click(function(){
			$(".Permission").each(function(){
				$(this).bind("click");
				$(this).click(function(){
					window.location.href=$(this).attr("href");
				});
			});
			$("#close").hide();
			$("#sorting").show();
			$(".System").css("border-color","");
			$(".da-panel-content").sortable("disable");
		// This code is use to save change of sorting
			function save_array(divs){
				var a =[];
				for (var i=0; i<divs.length ;i++)
				{
					a.push(divs[i].innerHTML);
				}
				return a.join("?");
			}
			var cook = save_array($(".System-header").get());

			var params = { contents : cook };
			$.ajax({
                url: "gear/saveGear",
                type: "POST",
				data: params,
				success: function(result){
					alert("Success");
                },
				fail: function(result){
					alert("failed");
				},
				done: function(result){
					alert("done");
				}
			});
		
		});
		
		

	});
}) (jQuery);