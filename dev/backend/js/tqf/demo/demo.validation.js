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
			$("#ValDegree").chosen().bind("change", function(){
				$("#validate-degree").validate().element($(this));
			});
			$("#edGUnis").chosen().bind("change", function(){
				$("#validate-edu").validate().element($(this));
			});
			$("#vali_crs").chosen().bind("change", function(){
				$("#index_tqf3").validate().element($(this));
			});
			$("#sub_id").chosen().bind("change", function(){
				$("#index_tqf3").validate().element($(this));
			});
			  
			/*$("#ed_Pre_dy").chosen();
			$("#ed_Pre_s").chosen();
			$("#ed_Co_dy").chosen();
			$("#ed_Co_s").chosen();*/
		}
		
		if($.fn.spinner) {
			$("#da-ex-val-spin").spinner();
		}
/***************************************standard***********/
			if($.fn.validate) {
				$("#da-ex-validate1").validate({
					rules: {
						nameTh: {
							required: true,
							fontTH: true
						}, 
						nameEn: {
							required: true,
							fontEN: true
						}, 
						codeTh: {
							fontTH: true
						}, 
						codeEn: {
							fontEN: true
						}
						
					}, 
					
				invalidHandler: function(form, validator) {
						var errors = validator.numberOfInvalids();
						if (errors) {
							var message = errors == 1
							? 'เกิดข้อผิดพลาด 1 ที่'
							: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
							$("#da-ex-val1-error").html(message).show();
						} else {
							$("#da-ex-val1-error").hide();
							$.jGrowl("ระบบได้ทำการบันทึกเรียบร้อยแล้ว", {position: "bottom-right"});
						}
					}
				});
			
			$("#validate-degree").validate({
				rules: {
					nameTh: {
						required: true,
						fontTH: true
					}, 
					nameEn: {
						required: true,
						fontEN: true
					}, 
					ValDegree: {
						required: true
					},
					codeTh: {
						fontTH: true
					}, 
					codeEn: {
						fontEN: true
					}
				}, 
				
			invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valdeg-error").html(message).show();
					} else {
						$("#valdeg-error").hide();
					}
				}
			});

			$("#validate-faculty").validate({
				rules: {
					nameTh: {
						required: true,
						fontTH: true
					}, 
					nameEn: {
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
						$("#valfac-error").html(message).show();
					} else {
						$("#valfac-error").hide();
					}
				}
			});

			$("#validate-campus").validate({
				rules: {
					cam_name: {
						required: true,
						fontTH: true
					}
				}, 
				
			invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valcam-error").html(message).show();
						if(errors == 0){  alert('okkkkk'); }
					} else {
						$("#valcam-error").hide();
					}
				}
			});
			///////////////////มคอ.3////////////////
			$("#validate-em3").validate({
				rules: {
					em3_name: {
						required: true
					}
				}, 
				
			invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valem3-error").html(message).show();
						if(errors == 0){  alert('okkkkk'); }
					} else {
						$("#valem3-error").hide();
					}
				}
			});
			///////////////////////////////////////
			$("#validate-AFFILIATE").validate({
				rules: {
					AFL_NAME_TH: {
						required: true,
						fontTH: true
					},
					AFL_NAME_EN: {
						fontEN: true
					}
				}, 
				
			invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valcam-error").html(message).show();
					} else {
						$("#valcam-error").hide();
					}
				}
			});
			$("#validate-university").validate({
				rules: {
					nameTh: {
						required: true,
						fontTH: true
					}, 
					nameEn: {
						required: true,
						fontEN: true
					}, 
					codeTh: {
						required: true,
						fontTH: true
					}, 
					codeEn: {
						fontEN: true
					},
					tel: {
						digits: true
					},
					cam_id:{
						required:true
					}
					
				}, 
				
			invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valuni-error").html(message).show();
					} else {
						$("#valuni-error").hide();
					}
				}
			});

			$("#validate-department").validate({
				rules: {
					nameTh: {
						required: true,
						fontTH: true
					}, 
					nameEn: {
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
						$("#valdep-error").html(message).show();
					} else {
						$("#valdep-error").hide();
					}
				}
			});

			$("#validate-discipline").validate({
				rules: {
					nameTh: {
						required: true,
						fontTH: true
					}, 
					nameEn: {
						required: true,
						fontEN: true
					}, 
					codeTh: {
						fontTH: true
					}, 
					codeEn: {
						fontEN: true
					}
					
				}, 
				
			invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valdis-error").html(message).show();
					} else {
						$("#valdis-error").hide();
					}
				}
			});
/************************************end standard and start base*****************************/

			$("#validate-base").validate({
				rules: {
					courseName: {
						required: true,
						fontTH: true
					}, 
					courseNameEN: {
						required: true,
						fontEN: true
					}, 
					year: {
						required: true,
						digits: true
					}, 
					numYear: {
						required: true,
						digits: true,
						range:[2,10]
					}
					
				}, 
				
			invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valbase-error").html(message).show();
					} else {
						$("#valbase-error").hide();
					}
				}
			});

/**********************************end base and start managebase********************************/


			$("#validate-MBQ").validate({
				rules: {
					qual_name: {
						required: true
					}, 
					branch_name: {
						required: true
					}
					
				}, 
				
			invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'เกิดข้อผิดพลาด 1 ที่'
						: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
						$("#valMBQ-error").html(message).show();
					} else {
						$("#valMBQ-error").hide();
					}
				}
			});

/***************************************end managebase and start education************************/			
			$("#validate-edu").validate({
				rules: {
					ed_G_Uni_s: {
						required: true
					}, 
					ed_G_NumCourseTH_tb: {
						required: true,
						fontTH: true
					},
					ed_G_NumCourseEN_tb: {
						fontEN: true
					}, 
					ed_G_NameTH_tb: {
						required: true,
						fontTH: true
					}, 
					ed_G_NameEN_tb: {
						fontEN: true
					}, 
					ed_G_Group_s: {
						required: true
					}, 
					ed_G_Unit_tb: {
						required: true, 
						digits: true
					},
					ed_G_Unit_tb1: {
						required: true, 
						digits: true
					},
					ed_G_Unit_tb2: {
						required: true, 
						digits: true
					},
					ed_G_Unit_tb3: {
						required: true, 
						digits: true
					},
					ed_G_DesTH_ta: {
						required: true,
						fontTH: true
					}, 
					ed_G_DesEN_ta: {
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
						$("#valedu-error").html(message).show();
					} else {
						$("#valedu-error").hide();
					}
				}
			});
			
/*****************************end education and start section21******************************/

			$("#validate-sec21").validate({
					rules: {
						s2_1_4_tf: {
							digits: true
						}
					}, 
					
				invalidHandler: function(form, validator) {
						var errors = validator.numberOfInvalids();
						if (errors) {
							var message = errors == 1
							? 'เกิดข้อผิดพลาด 1 ที่'
							: 'เกิดข้อผิดพลาด ' + errors + ' ที่';
							$("#val21-error").html(message).show();
						} else {
							$("#val21-error").hide();
						}
					}
				});

/****************************end section21*****************************************/
/***************************************TQF3 base*********************************************/			

$("#index_tqf3").validate({
				ignore: '.ignore', 
				rules: {
					sub_id: {
						required: true
					}, 
					vali_crs: {
						required: true
					}
				}
			});
			
/***************************************end TQF3 base*********************************************/			
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