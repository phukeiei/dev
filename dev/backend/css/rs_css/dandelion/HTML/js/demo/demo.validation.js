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
 
 /*
 (function($) {
	$(document).ready(function(e) {
		if($.fn.validate) {
			$(this).find(".required").each(function(index) {
				$(this).validate();
			}
		}
	});
}) (jQuery);
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
			$("#da-ex-validate1").validate({
				rules: {
					/* จัดการข้อมูลประเภทการวิจัย */
					rt_name_en: {
						required: true
					},
					rt_name_th: {
						required: true
					},
					/* จัดการข้อมูลหน่วยงานให้ทุน/แหล่งทุน */
					fu_seq: {
						required: true,
						digits: true
					},
					fu_name: {
						required: true
					},
					fu_wk31t_id: {
						required: true
					},
					/* จัดการข้อมูลวารสาร */
					jn_seq: {
						required: true,
						digits: true
					},
					jn_name_en: {
						required: true
					},
					jn_jd_id: {
						required: true
					},
					/* demo */
					req1: {
						required: true
					}, 
					email1: {
						required: true, 
						email: true
					}, 
					url1: {
						required: true, 
						url: true
					}, 
					pass1: {
						required: true, 
						minlength: 5
					}, 
					cpass1: {
						required: true, 
						minlength: 5, 
						equalTo: '#pass1'
					}, 
					digits1: {
						required: true, 
						digits: true
					}
				}, 
				invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'You missed 1 field. It has been highlighted'
						: 'You missed ' + errors + ' fields. They have been highlighted';
						$("#da-ex-val1-error").html(message).show();
					} else {
						$("#da-ex-val1-error").hide();
					}
				}
			});
			
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
		}
	});
}) (jQuery);