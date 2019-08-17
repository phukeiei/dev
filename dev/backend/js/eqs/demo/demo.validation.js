/*
 * Dandelion Admin v1.2 - Form Validation JS
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
		if($.fn.chosen) {
			$("#da-ex-val-chzn").chosen().bind("change", function(){
				$("#da-ex-validate3").validate().element($(this));
			});
		}
		
		if($.fn.spinner) {
			$("#da-ex-val-spin").spinner();
		}
		
		if($.fn.validate) {
			
			
			$("#da-ex-validate2").validate({
				rules: {
					minl1: {
						required: true, 
						minlength: 5
					}, 
					maxl1: {
						required: true, 
						maxlength: 5
					}, 
					rangel1: {
						required: true, 
						rangelength: [5, 10]
					}, 
					min1: {
						required: true, 
						digits: true, 
						min: 5
					}, 
					max1: {
						required: true, 
						digits: true, 
						max: 5
					}, 
					range1: {
						required: true, 
						digits: true, 
						range: [5, 10]
					}
				}, 
				invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'You missed 1 field. It has been highlighted'
						: 'You missed ' + errors + ' fields. They have been highlighted';
						$("#da-ex-val2-error").html(message).show();
					} else {
						$("#da-ex-val2-error").hide();
					}
				}
			});
			$("#validate-System").validate({
				rules: {
					StNameT: {
						required: true,
						fontTH:	true
					}, 
					StNameE:{
						required: true,
						fontEN: true
					},
					StAbbrT:{
						fontTH: true
					},
					StAbbrE:{
						fontEN: true
					},
					StURL:{
						required: true
					}
					
				}, 
				invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valSys-error").html(message).show();
					} else {
						$("#valSys-error").hide();
					}
				}
			});
			$("#validate-Icon").validate({
				rules: {
					IcName: {
						required: true,
						fontEN: true
					}, 
					IcPic:{
						required: true,
						accept: ['.jpeg','.png']
					}
				}, 
				invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valIcon-error").html(message).show();
					} else {
						$("#valIcon-error").hide();
					}
				}
			});
			$("#validate-WGSer").validate({
				rules: {
					WgNameT: {
						required: true,
						fontTH: true
					}, 
					WgNameE: {
						required: true,
						fontEN: true
					}
					
				}, 
				invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valWGSer-error").html(message).show();
					} else {
						$("#valWGSer-error").hide();
					}
				}
			});
			$("#validate-WG").validate({
				rules: {
					GpNameT: {
						required: true,
						fontTH: true
					},
					GpNameE: {
						required: true,
						fontEN: true
					},
					GpStID:{
						required: true
						
					}
					
				}, 
				invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valWG-error").html(message).show();
					} else {
						$("#valWG-error").hide();
					}
				}
			});
			$("#validate-Q").validate({
				rules: {
					QsID: {
						required: true,
						digits: true
					}, 
					QsDescT:{
						required: true,
						fontTH: true
					},
					QsDescE:{
						required: true,
						fontEN: true
					}
					
				}, 
				invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valQ-error").html(message).show();
					} else {
						$("#valQ-error").hide();
					}
				}
			});
			$("#validate-Service").validate({
				rules: {
					SvNameT: {
						required: true,
						fontTH: true
					}, 
					SvNameE:{
						required: true,
						fontEN: true
					},
					SvURL:{
						required: true
					},
					SvIcon:{
						required: true
					}
					
				}, 
				invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valS-error").html(message).show();
					} else {
						$("#valS-error").hide();
					}
				}
			});
			$("#validate-GService").validate({
				rules: {
					WgNameT: {
						required: true,
						fontTH: true
						}, 
					WgNameE:{
						required: true,
						fontEN: true
					}
					
					
				}, 
				invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valGS-error").html(message).show();
					} else {
						$("#valGS-error").hide();
					}
				}
			});
			
			$("#validate-Menu").validate({
				rules: {
					MnNameE: {
						required: true,
						fontEN: true
					}, 
					MnNameT:{
						required: true
					},
					MnURL:{
						required: true
					}
					
					
				}, 
				invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valMenu-error").html(message).show();
					} else {
						$("#valMenu-error").hide();
					}
				}
			});
			$("#da-ex-validate3").validate({
				ignore: '.ignore', 
				rules: {
					gender: {
						required: true
					}, 
					sport: {
						required: true
					}, 
					file1: {
						required: true, 
						accept: ['.jpeg']
					}, 
					dd1: {
						required: true
					}, 
					chosen1: {
						required: true
					}, 
					spin1: {
						required: true, 
						min: 5, 
						max: 10
					}
				}
			});
			
			$("#da-ex-validate4").validate({
				rules: {
					email: {
						required: true, 
						email: true
					}, 
					pass2: {
						required: true, 
						minlength: 5
					}, 
					cpass2: {
						required: true, 
						minlength: 5, 
						equalTo: '#pass2'
					}, 
					address: {
						required: "#souvenirs:checked"
					}
				}
			});
			
			$("#validate-chpass").validate({
				rules: {
					oldpass: {
						required: true
					}, 
					newpass: {
						required: true//, 
						//minlength: 8
					}, 
					newpass2: {
						required: true, 
						//minlength: 8 ,
						equalTo: '#newpass'
					}
					
				}, 
				invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valch-error").html(message).show();
					} else {
						$("#valch-error").hide();
					}
				}
			});
			$("#validate-User").validate({
				rules: {
					UsName: {
						required: true
					}, 
					UsLogin: {
						required: true,
						minlenght: 8,
						fontEN: true
					}, 
					UsPassword: {
						required: true, 
						minlength: 6 ,
						maxlenght: 20
					},
					UsPsCode: {
						required: true,
						minlenght: 8
					},
					UsWgID: {
						required: true
					},
					UsQsID: {
						required: true
					},
					UsAnswer: {
						required: true
					},
					UsEmail: {
						required: true,
						email: true
					},
					UsDpID:	{
						required: true
					}
					
					
					
				}, 
				invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valUser-error").html(message).show();
					} else {
						$("#valUser-error").hide();
					}
				}
			});
			$("#da-ex-wizard-form").validate({
				rules: {
					group: {
						required: true
					}, 
					UsPsCode: {
						required: true
					}, 
					UsPassword: {
						required: true
					},
					cpass: {
						required: true
					},
					UsName: {
						required: true,
						
					},
					UsWgID: {
						required: true
					},
					UsEmail: {
						required: true,
						email: true
					}
					
					
					
				}, 
				invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valwizard-error").html(message).show();
					} else {
						$("#valwizard-error").hide();
					}
				}
			});
		}
	});
}) (jQuery);