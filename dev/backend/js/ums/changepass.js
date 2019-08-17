/*
 * Show System 
 *
 * This file is part of ShowSystem.php.
 * 
 *
 * Development Started:
 * June 22, 2013
 * Last Update:
 * June 12, 2013
 *
 */

(function($) {
	$(document).ready(function(e) {
		
		$("#da-ex-dialog-form-div").dialog({
			autoOpen: false, 
			title: "Change Password", 
			modal: true, 
			width: "640", 
			buttons: [{
					text: "Submit", 
					click: function() {
						$( this ).find('form#da-ex-dialog-form-val').submit();
					}}]
		}).find('form').validate({
			rules: {
				reqField: {
					required: true
				}, 
				picture: {
					required: true, 
					accept: ['jpeg', 'jpg', 'png', 'gif']
				}, 
				dateField: {
					required: true, 
					date: true
				}, 
				gender: {
					required: true
				}
			}, 
			invalidHandler: function(form, validator) {
				var errors = validator.numberOfInvalids();
				if (errors) {
					var message = errors == 1
					? 'You missed 1 field. It has been highlighted'
					: 'You missed ' + errors + ' fields. They have been highlighted';
					$("#da-validate-error").html(message).show();
				} else {
					$("#da-validate-error").hide();
				}
			}
		});
		
		$("#da-ex-dialog").bind("click", function(event) {
			$("#da-ex-dialog-div").dialog("option", {modal: false}).dialog("open");
			event.preventDefault();
		});
		$("#da-ex-dialog-modal").bind("click", function(event) {
			$("#da-ex-dialog-div").dialog("option", {modal: true}).dialog("open");
			event.preventDefault();
		});
		$("#da-ex-dialog-form").bind("click", function(event) {
			$("#da-ex-dialog-form-div").dialog("option", {modal: true}).dialog("open");
			event.preventDefault();
		});
		
	});
}) (jQuery);