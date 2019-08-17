/*!
 * wijets v0.1.2
 * http://ndevrstudios.com
 *
 * by Shifat Adnan
 * adnan.pri@gmail.com
 *
 * Copyright (c) 2014, Ndevr Studios Ltd.
 * All rights reserved
 *
 */

$.wijets = new function () {
	var self = this;
	var flag = '';
	var key_lang = 'en';
	//var key_lang = $('#th-btn').val(); // set default language
	this.actionDefinitions = {};

	this.registerAction = function (definition) {
		self.actionDefinitions[definition.handle] = definition;
	};

	var relation = function(container) {
    	var sample_array = $('.drilldown');
    	//console.log($(container));
    	var txt = '<select class="relation_select">';
    	txt += '<option value="">กรุณาเลือก</option>'
    	$.each(sample_array,function(index, el) {
    		var ele = $(el).closest('[data-widget]');
    		var num = $(ele).attr('data-seq');
    		txt += '<option value="'+(num)+'">element '+num+'</option>';
    	});
    	txt += '</select>';
    	return txt;
	}

	$.fn.pushWidgetControls = function () {
		var controlsContainer = $(this).closest('[data-widget]').find('[data-widget-controls]');
		//console.log($(this).data('actionDefinition').handle);
		if (controlsContainer.data('currentControls') == $(this).data('actionDefinition').handle) return null;

		if($(this).data('actionDefinition').handle == 'relation'){
			var controlsHtml = $(relation(controlsContainer));
		}else{
			var controlsHtml = $($(this).data('actionDefinition').controls);
		}
		controlsContainer.data('currentControls', $(this).data('actionDefinition').handle);

		if (controlsContainer.children().length) {
			var controlsHtml = $($(this).data('actionDefinition').controls);
			controlsHtml.hide();
			controlsContainer.append(controlsHtml);
			controlsHtml.show();
			// .slideDown(null, 'linear', function () {
			// });
				controlsContainer.parent().toggleClass('editbox-open');

			controlsHtml.siblings().hide();//.slideUp(null, 'linear', function () {
				// $(this).remove();
			// });
		} else {
			controlsHtml.show();
			controlsContainer.append(controlsHtml);
			controlsContainer.slideDown(100, 'linear', function () {
				controlsContainer.parent().toggleClass('editbox-open');
			});
		}


		return controlsHtml;
	};

	$.fn.hideWidgetControls = function (withEffect) {
		var controlsContainer = $(this).closest('[data-widget]').find('[data-widget-controls]');
		if (withEffect) {
			controlsContainer.slideUp(100, 'linear', function () {
				controlsContainer.empty();
				controlsContainer.data('currentControls', "");
				controlsContainer.parent().toggleClass('editbox-open');
			});
		} else {
			controlsContainer.empty();
			controlsContainer.hide();
			controlsContainer.data('currentControls', "");
			controlsContainer.parent().toggleClass('editbox-open');
		}
	};

	$.fn.getWidgetState = function (state) {
		var currentState = undefined;
		var widgetParameters = $($(this).data('parentWidget')).data('widgetParameters');
		if (widgetParameters) { // there are parameters
			// check in localStorage
			if (widgetParameters.id) {
				// //console.log($($(this).data('parentWidget')).data('widgetId')+'.'+state);
				currentState = localStorage.getItem($($(this).data('parentWidget')).data('widgetId')+'.'+state);
			} else {
				currentState = widgetParameters[state];
			}
		}
		return currentState;
	};

	$.fn.setWidgetState = function (state, value) {
		var widgetParameters = $($(this).data('parentWidget')).data('widgetParameters');
		if (widgetParameters) { // there are parameters
			// has persistence
			if (widgetParameters.id) {
				localStorage.setItem($($(this).data('parentWidget')).data('widgetId')+'.'+state, value);
				return true;
			} else {
				return false;
			}
		}
		return false;
	};

	var openLink = function (path, param) {		
		var text = '';
		var temp = '';
		$('#myModal').find('.modal-body').append('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
		$.post( path , param )
		  .done(function( data ) {
		    $('#myModal').find('.modal-title').html(temp);
			$('#myModal').find('.modal-body').html(data);
		  });
		$('#a-togle').click();
		$('#myModal').find('.panel-loading').remove();
	};

	// default actions
	this.registerAction( {
		handle: "collapse",
		html: '<span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span>',
		onClick: function () {
			$(this).find('i').toggleClass('ti-angle-down').toggleClass('ti-angle-up');
			var params = $(this).data('actionParameters');
			if (!params.target) params.target = '.panel-body';
			var visible = $(this).closest('[data-widget]').find(params.target).is(':visible');

        	$(this).closest('[data-widget]').find(params.target).slideToggle(100, 'linear', function () {
        		$(this).closest('[data-widget]').toggleClass('panel-collapsed');
        	});

			$(this).setWidgetState('collapsed', visible);
		},
		onInit: function () {
			var params = $(this).data('actionParameters');
			if (params.containerClass) {
				$(this).addClass(params.containerClass);
			}
			if ($(this).getWidgetState('collapsed') == "true") {
				if (!params.target) params.target = '.panel-body';
				$(this).find('i').toggleClass('ti-angle-down').toggleClass('ti-angle-up');
				$(this).closest('[data-widget]').find(params.target).hide();
				$(this).closest('[data-widget]').addClass('panel-collapsed');
			}
		}
	});

	var draw_card = function(data){
		if(data!=''){
			var json_obj = JSON.parse(data);
			var html_txt = '';
			var id_array = [];
			var grp_data = [];
			$.each(json_obj,function(index,val){
				var pn_size = (typeof val.pn_size != 'undefined')? val.pn_size : '';
				var tile_bgcolor = (typeof val.tile_bgcolor != 'undefined')? val.tile_bgcolor : '';
				var tile_icocolor = (typeof val.tile_icocolor != 'undefined')? val.tile_icocolor : '';
				var tile_icon = (typeof val.tile_icon != 'undefined')? val.tile_icon : '';

				if(val.widget_style == 'tile-card'){
						html_txt += '<div class="col-md-'+val.pn_size+'">'+
										'<div class="info-tile my-element" style="background-color:'+val.tile_bgcolor+';">'+
											'<div class="tile-icon" style="color: '+val.tile_icocolor+';"><i class="'+val.tile_icon+'"></i></div>'+
											'<div class="tile-heading" style="color: black;"><span>'+val.tile_heading+'</span></div>'+
											'<div class="tile-body"><span>'+val.tile_body+'</span></div>'+
											'<div class="tile-footer"><span class="text-danger">'+val.tile_footer+'</span></div>'+
										'</div>'+
									'</div>';
					}
				if(val.widget_style == 'chart-card'){
				html_txt += '<div class="col-md-'+val.pn_size+'">'+
								'<div class="panel panel-danger">'+
									'<div class="panel-heading" style="background-color:'+val.pn_hd_color+';">'+
										'<h2>'+val.pn_hd_text+'</h2>'+
									'</div>'+
									'<div class="panel-body my-content">'+
										'<div id="gpContainer'+index+'">gpContainer'+index+'</div>'+
									'</div>'+
								'</div>'+
							'</div>';
					id_array.push('gpContainer'+index);
					if(val.chart_type == 'ch1'){
						grp_data[index] = {'data' : {'series': val.chart_data,'chart_type':val.chart_type}};
					}else if(val.chart_type == 'ch2'){
						grp_data[index] = {'data' : {'series': val.chart_data,'chart_cate':val.chart_cate,'chart_type' : val.chart_type, 'chart_sub_type' : val.chart_sub_type}}
					}else if(val.chart_type == 'eqs_sp1'){
						grp_data[index] = {'data' : {'series': val.chart_data,'chart_type':val.chart_type,'chart_cate':val.chart_cate}};

					}
				}
				if(val.widget_style == 'table-card'){
					if(val.table_type == '1'){
						var i=0;
						html_txt += '<div class="col-md-'+val.pn_size+'">'+
													'<div class="panel panel-danger">'+
														'<div class="panel-heading">'+
															'<h2>'+val.pn_hd_text+'</h2>'+
														'</div>'+
														'<div class="panel-body my-content">'+
															'<div class="table-responsive">'+
																'<table class="table browsers m-n">'+
																	'<thead>'+
																		'<tr>'+
																			'<th colspan="4" class="text-center">'+val.table_data.tb_detail+'</th>'+
																		'</tr>'+
																	'</thead>'+
																	'<tbody>';
																	for(i = 0;i < val.table_data.tb_row.length;i++){
						html_txt +=	 						'<tr>'+
																		'<td class="text-left">'+val.table_data.tb_row[i].col1+'</td>';
																		if(val.table_data.tb_row[i].col2 == 'progress') {
						html_txt +=								'<td width="60%">'+
																				'<div class="progress m-n">'+
																					'<div class="progress-bar" style="width:'+val.table_data.tb_row[i].progress_len+'%;"></div>'+
																				'</div>'+
																			'</td>';
																			} else {
						html_txt +=								'<td class="text-right">'+val.table_data.tb_row[i].col2+'</td>';
																			}
						html_txt +=								'<td class="text-right">'+val.table_data.tb_row[i].col3+'</td>'+
																	 		'<td class="text-right"><button class="btn btn-midnightblue btn-sm expand-button" expand-path=""><i class="fa fa-search"></i></button></td>'+
																		'</tr>';
																		}
						html_txt +=						'</tbody>'+
																'</table>'+
															'</div>'+
														'</div>'+
													'</div>'+
												'</div>';
					}
					if(val.table_type == '2'){
						var i=0;
						html_txt += '<div class="col-md-'+val.pn_size+'">'+
													'<div class="panel panel-danger">'+
														'<div class="panel-heading">'+
															'<h2>'+val.pn_hd_text+'</h2>'+
														'</div>'+
														'<div class="panel-body my-content">'+
															'<div class="table-responsive">'+
																'<table class="table browsers m-n">'+
																	'<thead>'+
																		'<tr>'+
																			'<th rowspan="2" class="text-center" style="vertical-align: middle !important;">'+val.table_data.tb_row[i].sub_th1+'</th>'+
																			'<th class="text-center" colspan="4">'+val.table_data.tb_detail+'</th>'+
																		'</tr>'+
																		'<tr>'+
																			'<th class="text-center">'+val.table_data.tb_row[i].sub_th2+'</th>'+
																			'<th class="text-center">'+val.table_data.tb_detail+'</th>'+
																			'<th class="text-center">'+val.table_data.tb_detail+'</th>'+
																			'<th class="text-center">'+val.table_data.tb_detail+'</th>'+
																			'<th class="text-center">'+val.table_data.tb_detail+'</th>'+
																		'</tr>'+
																	'</thead>'+
																	'<tbody>'+
																	'<tr>'+
																		'<td class="text-center">'+val.table_data.tb_detail+'</td>'+
																		'<td class="text-center">'+val.table_data.tb_detail+'</td>'+
																		'<td class="text-center">'+val.table_data.tb_detail+'</td>'+
																		'<td class="text-center">'+val.table_data.tb_detail+'</td>'+
																		'<td class="text-center">'+val.table_data.tb_detail+'</td>'+
																		'<td class="text-center">'+val.table_data.tb_detail+'</td>'+
																	'</tr>'+
																	'</tbody>'+
																'</table>'+
															'</div>'+
														'</div>'+
													'</div>'+
												'</div>';
					}
				}
				if(val.widget_style == 'special-card'){
				html_txt += '<div class="row">'+
								'<div class="col-md-6">'+
									'<div class="panel panel-danger">'+
										'<div class="panel-heading" style="background-color:'+val.pn_hd_color+';">'+
											'<h2>จำนวนครุภัณฑ์ที่จะหมดอายุภายใน 2 ปี จำแนกตามประเภท</h2>'+
										'</div>'+
										'<div class="panel-body my-content">'+
											'<div id="gpContainer'+index+'">gpContainer'+index+'</div>'+
										'</div>'+
									'</div>'+
								'</div>'+
								'<div class="col-md-6">'+
									'<div class="panel panel-danger">'+
										'<div class="panel-heading" style="background-color:'+val.pn_hd_color+';">'+
											'<h2>รายการครุภัณฑ์ที่คาดว่าจะหมดอายุภายใน 2 ปี</h2>'+
										'</div>'+
										'<div class="panel-body my-content">'+
											'<table id="dataTableReport" class="table table-striped table-bordered" >'+
												'<thead>'+
													'<tr class="default">'+
														'<th class="text-center">ชื่อครุภัณฑ์</th>'+
														'<th class="text-center">เลขครุภัณฑ์</th>'+
														'<th class="text-center">วันที่ซื้อ</th>'+
														'<th class="text-center">วันที่หมดอายุ</th>'+
													'</tr>'+
												'</thead>'+
												'<tbody id="table_report" style="font-size: 80%;">'+
													'<tr>'+
														'<td colspan="4"><center>no date select</center></td>'+
													'</tr>'+
												'</tbody>'+
											'</table>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>';
					id_array.push('gpContainer'+index);
					grp_data[index] = {'data' : {'series': val.chart_data,'chart_type':val.chart_type,'chart_cate':val.chart_cate,'chart_dataTable':val.chart_dataTable}};
				}
			});
			var return_data = {'html_text' : html_txt , 'id_array' : id_array , 'grp_data' : grp_data};
			return return_data;
		}else{
			return 'Data invalid';
		}
	}
	this.registerAction( {
		handle: "edit",
		html: '<span class="button-icon"><i class="ti ti-pencil"></i></span>',
		controls: $('#test_portal').html(),
		onClick: function () {
			var button = $(this);
			var controls = button.pushWidgetControls();
			var selectVal;
			var selectText;
			$(".select").on('change', function(event) {
				event.preventDefault();

				button.closest('[data-widget]').find('h2').html($(this).find("option:selected").text());
				selectVal = $(this).val();
				selectText = $(this).find("option:selected").text();
		        var widget = $(this).closest('[data-widget]');
		        widget.append('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
				var path = $('option:selected', this).attr('my-path');

		        $.post( path , { path:path , param:$(this).val() , curId:flag })
		        .done(function (data) {
					console.log(data);
					$.when(draw_card(data)).done(function (arg1){
						widget.find('.panel-loading').remove();
						widget.find('.panel-body').html(arg1.html_text).promise().done(function(){

							$.each(arg1.id_array,function(index,val){
								console.log(arg1.grp_data[index].data);
								makePlot(widget.find('.panel-body'),val,arg1.grp_data[index].data);
							});
						});


						$(".panel").css('visibility', 'visible');
						$(".table").css('visibility', 'visible');
						$(".info-tile").css('visibility', 'visible');
					});
		        }).fail(function(){
		        	alert("error");
		        });
			});
			$(".check").on('click', function(event) {
				event.preventDefault();
				button.setWidgetState('headerTitle', selectText);
				button.setWidgetState('selectType',	selectVal);
				button.hideWidgetControls(true);
			});
			if (controls) {
				$(controls).val(button.closest('[data-widget]').find('h2').html());
			} else {
				button.hideWidgetControls(true);
			}
		},
		onInit: function () {
			var headerTitle = $(this).getWidgetState('headerTitle');
			var selectType = $(this).getWidgetState('selectType');




			if (headerTitle) {
				$(this).closest('[data-widget]').find('h2').html(headerTitle);
			}
			if(selectType){
				var widget = $(this).closest('[data-widget]');
				var panelColor = $(this).getWidgetState('panelColor');
		        widget.append('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
		        $.post("call_ajax_text", {param:selectType,curId:flag,lang:key_lang})
		        .done(function (data) {

		        	if(selectType==6 || selectType == 10){
		        		var json_obj = JSON.parse(data);
						widget.find('.panel-body').html(json_obj.html);
					    makePlot(widget,selectType,json_obj.payload);
					}else{
		        		widget.find('.panel-body').html(data);
		        		if(selectType == 4){
		        			makeDataTable(widget);
		        		}else if(selectType==13 || selectType==14|| selectType==15||selectType==16 || selectType==17||selectType==18){
				    		makePlot(widget,selectType,'');
				    	}

		        	}
		        widget.find('.panel-loading').remove();
	        	if(panelColor){
					myElement = widget.find('.my-element');
	        		$.each(myElement, function(index, val) {
	        			$(val).css('background-color', panelColor);
	        		});
	        	}
		        }).fail(function(){
		        	alert("error");
		        }).promise().done(function(){
						$(function () {
							$(".sortable").sortable({
								revert: false,
								cursor:"move",
								scroll: false,
								opacity: 0.5,
								start: function(e, ui){
									ui.placeholder.height(ui.item.height());
									$(ui.item).find('.panel-heading').css('height','48px');
						    },
								stop: function( event, ui ) {
									var text = '';
									$.each($(ui.item).closest('.row').find('.pos'),function(index,val){
										text = text + ($(this).data('seq')) + ',';
									});
									var post = $($(ui.item).closest('.panel')).find('span.button-icon').eq(4);
									post.setWidgetState('post_data',text);
									//$("#grp_pos_input").val(text);
								}
							});
						$(".sortable").disableSelection();
					});
					$(".panel").css('visibility', 'visible');
					$(".table").css('visibility', 'visible');
				});
			}
		}
	});

	this.registerAction( {
		handle: "mycolorpicker",
		html: '<span class="button-icon"><i class="ti ti-palette"></i></span>',
		controls: '<div class="range-step"></div><ul class="panel-color-list">'+
			'<li><span data-style="panel-info"></span></li>'+
			'<li><span data-style="panel-primary"></span></li>'+
			'<li><span data-style="panel-blue"></span></li>'+
			'<li><span data-style="panel-indigo"></span></li>'+
			'<li><span data-style="panel-deeppurple"></span></li>'+
			'<li><span data-style="panel-purple"></span></li>'+
			'<li><span data-style="panel-pink"></span></li>'+
			'<li><span data-style="panel-danger"></span></li>'+
			'<li><span data-style="panel-teal"></span></li>'+
			'<li><span data-style="panel-green"></span></li>'+
			'<li><span data-style="panel-success"></span></li>'+
			'<li><span data-style="panel-lime"></span></li>'+
			'<li><span data-style="panel-yellow"></span></li>'+
			'<li><span data-style="panel-warning"></span></li>'+
			'<li><span data-style="panel-orange"></span></li>'+
			'<li><span data-style="panel-deeporange"></span></li>'+
			'<li><span data-style="panel-midnightblue"></span></li>'+
			'<li><span data-style="panel-bluegray"></span></li>'+
			'<li><span data-style="panel-bluegraylight"></span></li>'+
			'<li><span data-style="panel-black"></span></li>'+
			'<li><span data-style="panel-gray"></span></li>'+
			'<li><span data-style="panel-default"></span></li>'+
			'<li><span data-style="panel-white"></span></li>'+
			'<li><span data-style="panel-brown"></span></li>'+
		'</ul>',
		onClick: function () {
			var button = $(this);
			var controls = button.pushWidgetControls();
			var opacity = 1;
			$(".range-step").ionRangeSlider({
			    min: 1,
			    max: 100,
			    step: 1,
			    prefix: "opacity: ",
			    postfix: " %",
			    from: 100,
			    hideMinMax: true,
			    prettify: true,
			    onChange: function (obj) {
			    	console.log(obj.fromNumber);
			    	opacity = obj.fromNumber/100;
			    	var widget = button.closest('[data-widget]');
			    	//bgcolor += (', '+opacity+' )');
			    	//widget.find('.my-element').css('background-color', $(this).css('background-color'));
			    }
			});

			if (controls) {
				controls.find('li span').bind('click', function (e) {
					var widget = button.closest('[data-widget]');
					var bgcolor = $(this).css('background-color').substring(0,$(this).css('background-color').length-1);
					bgcolor += (', '+opacity+' )');
					widget.find('.my-element').css('background-color', bgcolor);
					widget.removeClass('panel-default panel-inverse panel-bluegray panel-bluegraylight panel-black panel-white panel-gray panel-yellow panel-deeporange panel-lime panel-success panel-pink panel-deeppurple panel-green panel-info panel-teal panel-primary panel-midnightblue panel-warning panel-orange panel-danger panel-brown panel-magenta panel-purple panel-indigo panel-blue')
						.addClass($(this).attr('data-style'));
					$(button).setWidgetState('headerStyle', $(this).attr('data-style'));
					$(button).setWidgetState('panelColor', bgcolor);

				});
			} else {
				button.hideWidgetControls(true);
			}
		},
		onInit: function () {
			var headerStyle = $(this).getWidgetState('headerStyle');

			if (headerStyle) {
				var widget = $(this).closest('[data-widget]');
				widget.removeClass('panel-default panel-inverse panel-bluegray panel-bluegraylight panel-black panel-white panel-gray panel-yellow panel-deeporange panel-lime panel-success panel-pink panel-deeppurple panel-green panel-info panel-teal panel-primary panel-midnightblue panel-warning panel-orange panel-danger panel-brown panel-magenta panel-purple panel-indigo panel-blue')
					.addClass(headerStyle);
			}
		}
	});

	// dummy actions - coming soon
	this.registerAction( {
	    handle: "expand",
	    html: '<span class="button-icon has-bg"><i class="ti ti-fullscreen"></i></span>',
	    onClick: function () {
	    	var button = $(this);
	    	var widget = button.closest('[data-widget]');

	        bootbox.alert("Coming Soon at Avalon! Expand your panel to make it go fullscreen!")
	    }
	});

	this.registerAction( {
	    handle: "refresh",
	    html: '<span class="button-icon"><i class="ti ti-reload"></i></span>',
	    onClick: function () {
	        var params = $(this).data('actionParameters');
	        var widget = $(this).closest('[data-widget]');
	        widget.append('<div class="panel-loading"><div class="panel-loader-' + params.type + '"></div></div>');
	        widget.find('.panel-body').load(params.url, function () {
	        	widget.find('.panel-loading').remove();
	        });
	    }
    });

    this.registerAction( {
	    handle: "relation",
	    html: '<span class="button-icon"><i class="ti ti-new-window"></i></span>',
	    controls: '',
	    onClick: function () {
	    	var button = $(this);
			var controls = button.pushWidgetControls();
	        var params = $(this).data('actionParameters');
	        var widget = $(this).closest('[data-widget]');
	        var myElement = $(widget.find('.my-element'));

        	$('.relation_select').on('change' , function(){
        		$(button).setWidgetState('relationValue', $(this).val());
        		//console.log($(button).getWidgetState('relationValue'));
        	});
	        if (controls) {
				controls.find('li span').bind('click', function (e) {
					var widget = button.closest('[data-widget]');
				});
			} else {
				button.hideWidgetControls(true);
			}
	    }
    });

	this.registerAction( {
	    handle: "separator",
	    html: '<i class="separator">'
	});

	this.registerAction( {
	    handle: "close",
	    html: '<span class="button-icon"><i class="ti ti-close"></i></span>',
	    onClick: function () {
	        bootbox.alert("Coming Soon at Avalon!")
	    }
	});

	var makeDataTable = function(widget){
		//alert("S");
		$(widget.find(".example")).dataTable({
	    	"language": {
				    		"lengthMenu": "_MENU_"
			    		},
    		 "scrollY": "100px",
        	 "scrollCollapse": true,
	    });
	}

	var num = function(){
			return (Math.floor(Math.random() * 100) + 1);
		}

	var makePlot = function (widget,param,payload){
		var test = new Array();
		var test2 = new Array();
		console.log(payload);
        if(payload.chart_type == 'ch1'){
			if(widget.find('#'+param).length > 0){
			   Highcharts.getOptions().plotOptions.pie.colors = (function () {
					var colors = [],
						base = Highcharts.getOptions().colors[0],
						i;

					for (i = 0; i < 10; i += 1) {
						// Start out with a darkened base color (negative brighten), and end
						// up with a much brighter color
						colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
					}
					return colors;
				}());

				var colors = [],
					base = Highcharts.getOptions().colors[0],
					i;

				for (i = 0; i < 4; i += 1) {
					// Start out with a darkened base color (negative brighten), and end
					// up with a much brighter color
					colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
				}

				// Build the chart
				$(widget.find('#'+param)).highcharts({
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false,
						type: 'pie'
					},
					title: {
						text: '',
						style: {
							display: 'none'
						}
					},
					tooltip: {
						headerFormat: '<span style="font-size: 14px">{point.key}</span><br>',
						pointFormat: '<span style="font-size: 20px" align="right">{point.y:.2f}</span>',
						style: {
							display: 'none'
						}
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: true,
								distance: 0
							},
							showInLegend: false,
						}
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'middle',
						floating: false,
						backgroundColor: '#FFFFFF',
					},
					credits: {
						enabled: false
					},
					series: [{
						name: '',
						colorByPoint: true,
						dataLabels: {
							enabled: true,
							format: '<span style="font-size: 14px">{point.name}</span><br><span style="font-size: 14px">฿{point.y}</span>',
							//formatter: function() {
							//	return  Highcharts.numberFormat(this.y, 2, '.');
							//}
						},
						data: payload.series
					}]
				});
			}

		}else if(payload.chart_type=='ch2'){
			var stacking_status = false;
			console.log(payload.chart_sub_type);
			if(payload.chart_sub_type != ''){
				stacking_status = 'normal';
			}
			console.log(stacking_status);
				if(widget.find('#'+param).length > 0){
					$(widget.find('#'+param)).highcharts({
						chart: {
							type: 'column'
						},
						title: {
							text: 'Monthly Average Rainfall'
						},
						subtitle: {
							text: 'Source: WorldClimate.com'
						},
						xAxis: {
							categories: payload.chart_cate,
							crosshair: true
						},
						yAxis: {
							min: 0,
							title: {
								text: 'Rainfall (mm)'
							}
						},
						tooltip: {
							headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
							pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
								'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
							footerFormat: '</table>',
							shared: true,
							useHTML: true
						},
						plotOptions: {
							column: {
								stacking: stacking_status,
								pointPadding: 0.2,
								borderWidth: 0
							}
						},
						series: payload.series
					}); //end hgc
				} //end param > 0
			}else if(payload.chart_type=='eqs_sp1'){
				if(widget.find('#'+param).length > 0){
						if(typeof DataTableModal1 !== 'undefined'){
							$('#modal_datatable_all_tools_of_year').dataTable().fnClearTable();
							$('#modal_datatable_all_tools_of_year').dataTable().fnDestroy();
						}
						DataTableModal1 = $('#modal_datatable_all_tools_of_year').dataTable({
							lengthMenu: [
									[ 5, 10, 25, 50, -1 ],
									[ "5 แถว",'10 แถว', '25 แถว', '50 แถว', 'ทั้งหมด' ]
							],
							pageLength: 5,
							"oLanguage": {
										"sLengthMenu": "\_MENU_",
										"oPaginate": {
																	"sNext": "ถัดไป",//ปุ่มหน้าถัดไป
																	"sPrevious": "ย้อนกลับ"
										}
							},
							"destroy": true
						});
						$('#DataTable2 .dataTables_filter input').attr('placeholder','ค้นหา...');
						//DOM Manipulation to move datatable elements integrate to panel
						$('#DataTable2 .panel-ctrls').append($('#DataTable2 .dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
						$('#DataTable2 .panel-ctrls').append($('#DataTable2 .dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");
						$('#DataTable2 .panel-footer').append($("#DataTable2 .dataTable+.row"));
						$('#DataTable2 .dataTables_info').parent().attr("class","col-sm-5");
						$('#DataTable2 .dataTables_paginate').parent().attr("class","col-sm-7");
						$('#DataTable2 .dataTables_paginate>ul.pagination').addClass("pull-right m-n btn-xs");



						dataModal1 = payload.series.dataModal1;

				      cat = payload.chart_cate;
				      data = [
				        {
				          name: 'จำนวน',
									point : {
										events : {
											click : function(){
												var category = this.category;
												DataTableModal1.fnClearTable();
												$.each(dataModal1[this.id],function(){
													var temp = [];
													temp.push(this.name);
													temp.push(this.number);
													temp.push(this.price);
													temp.push(this.date);
													temp.push(this.expDate);
													temp.push(this.status);
													DataTableModal1.fnAddData(temp);
												});
												DataTableModal1.fnDraw();
												$("#modal_all_tools_of_year #DataTable2 .panel-heading h2").text("รายงานครุภัณฑ์ประเภท"+ category +"ทั้งหมด");
												$('#modal_all_tools_of_year .modal-title').html("<strong>รายงานครุภัณฑ์ประเภท"+ category +"ทั้งหมด</strong>");
												$('#modal_all_tools_of_year').modal();
											}
										}
									},
									data:payload.series.data
				          //data: [85,60,25,90,120,40,35,80,25]
				        }
				      ];
				      chart_title = "";
				      chart_x_title = "ประเภทครุภัณฑ์";
				      chart_y_title = "จำนวน";
				      $(widget.find('#'+param)).highcharts({
				          chart: {
				              type: 'column'
				          },
				          title: {
				              text: chart_title
				          },
				          subtitle: {
				              text: ''
				          },
				          xAxis: {
				              categories: cat,
				              title: {
				                  text: chart_x_title,
				                  align: 'high'
				              }
				          },
				          yAxis: {
				              min: 0,
				              title: {
				                  text: chart_y_title,
				                  align: 'high'
				              },
				              labels: {
				                  overflow: 'justify'
				              }
				          },
				          tooltip: {
											headerFormat : '<span style="font-size: 12px"><strong>{point.key}</strong></span><br/>',
				              valueSuffix: " "+"หน่วย"
				          },
				          plotOptions: {
				            column: {
				              dataLabels: {
				                  enabled: true,
				                  color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'black'
				              }
				            }
				          },
				          legend: {
										enabled: false,
				            layout: 'horizontal',
				            align: 'center',
				            verticalAlign: 'bottom',
				            floating: false
				          },
				          credits: {
				              enabled: false
				          },
				          series: data
				      }); //end hgc
				} //end param > 0
			}else if(payload.chart_type=='eqs_sp2'){
				if(widget.find('#'+param).length > 0){
					console.log("down there!");
					console.log(payload.chart_dataTable);
					cat = payload.chart_cate;
						dataTable = payload.chart_dataTable;
						var myfunc = function (){
							//set default table_report
							$(widget.find("#table_report")).html("");
							$.each(dataTable,function(){
								$.each(this,function(){
									var tr = $("<tr>");
									var td_1 = $("<td>").text(this.name);
									var td_2 = $("<td>").text(this.number);
									var td_3 = $("<td>").text(this.buyDate);
									var td_4 = $("<td>").text(this.expDate);
									$(tr).append(td_1).append(td_2).append(td_3).append(td_4);
									$(widget.find("#table_report")).append(tr);
								})
							});
							//
						}
						myfunc();
						var MyDataTable;
						var myfunc2 = function (){
							MyDataTable = $(widget.find("#dataTableReport")).dataTable({
								lengthMenu: [
										[ 5, 10, 25, 50, -1 ],
										[ "5 แถว",'10 แถว', '25 แถว', '50 แถว', 'ทั้งหมด' ]
								],
								pageLength: 5,
								"oLanguage": {
											"sLengthMenu": "\_MENU_",
											"oPaginate": {
																		"sNext": "ถัดไป",//ปุ่มหน้าถัดไป
																		"sPrevious": "ย้อนกลับ"
											}
								}
							});
							$(widget.find("#DataTable1 .dataTables_filter input"))
							$(widget.find("#DataTable1 .dataTables_filter input")).attr('placeholder','ค้นหา...');
							//DOM Manipulation to move datatable elements integrate to panel
							$(widget.find("#DataTable1 .panel-ctrls")).append($('#DataTable1 .dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
							$(widget.find("#DataTable1 .panel-ctrls")).append($('#DataTable1 .dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");
							$(widget.find("#DataTable1 .panel-footer")).append($("#DataTable1 .dataTable+.row"));
							$(widget.find("#DataTable1 .dataTables_info")).parent().attr("class","col-sm-5");
							$(widget.find('#DataTable1 .dataTables_paginate')).parent().attr("class","col-sm-7");
							$(widget.find('#DataTable1 .dataTables_paginate>ul.pagination')).addClass("pull-right m-n btn-xs");

						}

						myfunc2();

			      data = [{
			            name: 'จำนวน',
			            colorByPoint: true,
									point : {
										events : {
											select : function(){
												MyDataTable.fnClearTable();
												$.each(dataTable[this.id],function(){
													var temp = [];
													temp.push(this.name);
													temp.push(this.number);
													temp.push(this.buyDate);
													temp.push(this.expDate);
													MyDataTable.fnAddData(temp);
												});
												MyDataTable.fnDraw();
											},
											unselect : function(){
												MyDataTable.fnClearTable();
												$.each(dataTable,function(){
													$.each(this,function(){
														var temp = [];
														temp.push(this.name);
														temp.push(this.number);
														temp.push(this.buyDate);
														temp.push(this.expDate);
														MyDataTable.fnAddData(temp);
													});
												});
												MyDataTable.fnDraw();
											}
										}
									},
			            data: payload.series
			        }];
			      chart_title = "";
			      chart_x_title = "ประเภท";
			      chart_y_title = "จำนวน";
			      $(widget.find('#'+param)).highcharts({
			          chart: {
			            plotBackgroundColor: null,
			            plotBorderWidth: null,
			            plotShadow: false,
			            type: 'pie'
			        },
			        title: {
			            text: chart_title
			        },
			        tooltip: {
									headerFormat : '<span style="font-size: 12px"><strong>{point.key}</strong></span><br/>',
			            pointFormat: '{series.name}: <b>{point.y:.0f} หน่วย</b>'
			        },
							credits:{
								enabled: false
							},
			        plotOptions: {
			            pie: {
			                allowPointSelect: true,
			                cursor: 'pointer',
			                dataLabels: {
			                    enabled: true,
			                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
			                    style: {
			                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			                    }
			                }
			            }
			        },
			        series: data
			      });
				
				}
			}//else type chart

	    }
	// helpers
	var getUniques = function (arr) {
	   var u = {}, a = [];
	   for(var i = 0, l = arr.length; i < l; ++i){
		  if(u.hasOwnProperty(arr[i])) {
			 continue;
		  }
		  a.push(arr[i]);
		  u[arr[i]] = 1;
	   }
	   return a;
	};
	var backgroundInterval2 = null;
	var ajax_call = function(widget,param){
		widget.append('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
	    $.post("call_ajax_text", {param:param,curId:flag})
	    .done(function (data) {
	    	if(param==6 || param == 10){
	    		var json_obj = JSON.parse(data);
	    		widget.find('.panel-body').html(json_obj.html);
	    			makePlot(widget,param,json_obj.payload);

	    	}else{
				widget.find('.panel-body').hide().html(data).fadeIn(1000);
		    	if(param == 4){
		    		makeDataTable(widget);
		    	}else if(param==13 || param==14 || param == 15 || param == 16 || param==17||param==18){
		    		makePlot(widget,param,'');
		    	}
		    	if($($('body').find('.my-element')).hasClass('danger')){

		    		if(backgroundInterval2) {
				        clearInterval(backgroundInterval2);
				    }
    				backgroundInterval2 = setInterval(function(){
				    	$($('body').find('.danger')).toggleClass("backgroundRed");
					},1550);
    			}
	    	}
	    	widget.find('.panel-loading').remove();

	    }).fail(function(){
	    	alert("error");
	    });
	}
	var complex_fn = function(ele,event){
		var relateObj = $(ele).attr('relate-obj');
		var param = $(ele).attr('my-param');
		var target_ele = $("#panel-container").find(".my-content")[parseInt(relateObj)];
		//alert("asdasd");
		//console.log(ele.parent().html());
		widget = $(target_ele).closest('[data-widget]');
		widget.append('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
		ajax_call(widget,param);
	}
	// primary entrypoint
	$("body").on("change" , '#e1' , function(){
		flag = ($(this).val()==''?0:$(this).val());
		self.make();
	});
	$("body").on("click" , '#saveButton' , function(){
		//console.log(JSON.stringify(localStorage));
		$.post('call_datac', { type:'w', param1: JSON.stringify(localStorage) }, function(data, textStatus, xhr) {

		}).done( function(data) {
			//console.log(data);
		});
		//self.make();
	});
	$('body').on('click' , '#test-link' , function(){
			openLink('https://10.51.4.23',{a:'5'});
		});
	var load_local = function(){
		$.post('call_data', { type:'r' }, function(data, textStatus, xhr) {

		}).done( function(data) {
			console.log(data);
			var obj = JSON.parse(data);
			$.each(obj, function(index, val) {
				 localStorage.setItem(index , val);
				 //console.log(index , val);
			});
		});
	}
	$("body").on("click" , '#loadButton' , function(){
		load_local();
		//self.make();
	});

	var counter=0;
	this.make = function (settings) {
		//localStorage.clear().promise();
		load_local();
		flag = ($('#e1').val()==''?0:$('#e1').val());
		//console.log("debug"+$.fn.velocity);
		settings = settings? settings:{};

		var widgetGroups = $('[data-widget-group]').map(function() {
			return $(this).data('widget-group');
		}).get();

		var uniqueWidgetGroups = getUniques (widgetGroups);
		$( "body" ).on( "click", ".my-element>.tile-body" , function( event ) {
			//complex_fn($(this).parent(),event);

			var gp = $(this).parent().attr('custom-gp');

			$.each($("div[gp]"),function(index, el) {
				//console.log("gp:"+gp+" :: target_gp:"+$(this).attr('gp'));
				var temp = JSON.parse($(this).attr('gp'));
				var current = $(this);
				var flag = false;
				$.each(temp, function(index, val) {

					if(val != gp && flag != true){
						$(current).closest('.row.child').hide();
					}else{
						flag = true;
						$(current).closest('.row.child').show();
					}
					//console.log((val != gp) + ","+ (flag));
				});
			});
			$("div.my-element").removeClass('active');
			$(this).parent().addClass('active');
			$('html, body').animate({
		        scrollTop: $("#line-section").offset().top-50
		    }, 1000);
		    $(".panel").css('visibility', 'visible');
		    $(".table").css('visibility', 'visible');
		    $(".info-tile").css('visibility', 'visible');
		});
		$( "body" ).on( "click", ".my-element.parent-con>.tile-body" , function( event ) {
			complex_fn($(this).parent(),event);
		});
		$( "body" ).on( "click", ".complex_ele" , function( event ) {
			event.preventDefault();
			var href = $(this).attr('href');
			console.log($(this).data('post'));
			var post = $(this).data('post');
			var max = $(this).data('max');
			//href = href.substring(1);
			var expand = $(this).attr('expand-path');
			var parent = $(this).closest('.row');
			console.log(post);
			var target = parent.find(href);
			$(parent.find('.complex_ele')).removeClass('select');
			$(this).addClass('select');
			target.find('.panel-body').hide();
			$.post('expand/'+expand, post )
		    .done(function (data) {

		    	target.find('.panel-body').html(data).fadeIn(700);
		    }).fail(function(){
		    	alert("error");
		    });
			//complex_fn($(this).parent(),event);

		});
		$( "body" ).on( "click", '.expand-button', function( event ) {
			//console.log($(this).parent().find('.tile-body')[0].outerHTML);
			file_name = ($(this).attr('expand-path')===undefined)?'test.html':$(this).attr('expand-path');
			var src_file = "expand/"+file_name;
			var text = '';
			var temp = $($(this).parent().find('.tile-heading')).text();
			$('#myModal').find('.modal-body').append('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
			$.get(src_file, function(data) {
				$('#myModal').find('.modal-title').html(temp);
				$('#myModal').find('.modal-body').html(data);
			});
			$('#a-togle').click();
			$('#myModal').find('.panel-loading').remove();
			//var text = $($(this).parent()[0].outerHTML).find("#mytable").removeClass('example')[0].outerHTML;

			event.preventDefault();
		});
		$.each($('[data-widget]'), function () {
			var widgetGroup = $(this).closest('[data-widget-group]').attr('data-widget-group');
			try {
				var params = $(this).attr('data-widget');
				var widgetId = undefined;
				if (params.length>0) {
					params = $.parseJSON(params);
					$(this).data('widgetParameters', params);
					if (params && params.id) {
						widgetId = widgetGroup+'.'+params.id;
						$(this).data('widgetId', widgetId);
						if(localStorage.getItem(widgetId+'.selectType') != undefined){ //check old parameter
							var selectType = localStorage.getItem(widgetId+'.selectType');
							var panelColor = localStorage.getItem(widgetId+'.panelColor');
							var post_data = localStorage.getItem(widgetId+'.post_data');
							var relationValue = localStorage.getItem(widgetId+'.relationValue');
							var widget = $(this).closest('[data-widget]');

					        widget.append('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
					        $.post("call_ajax_text", {param:selectType,curId:flag,data_seq:post_data})
					        .done(function (data) {
					        	if(selectType==6 || selectType == 10){
					        		var json_obj = JSON.parse(data);
	    							widget.find('.panel-body').html(json_obj.html);
					        		makePlot(widget,selectType,json_obj.payload);
					        	}else{
					        		widget.find('.panel-body').html(data);
						        	if(selectType == 4){
						        		makeDataTable(widget);
						        	}else if(selectType==13 || selectType==14 ||selectType==15||selectType==16 || selectType==17||selectType==18){
							    		makePlot(widget,selectType,'');
							    	}
					        	}

								$(widget.find('.info-tile,.panel'))
						        .css('visibility', 'visible')
						        .velocity('transition.slideUpIn', {stagger: 50});

					        	widget.find('.panel-loading').remove();
					        	setTimeout( function(){
					        		if($("#checkPage").length){
							        	$.each($("div[gp]"),function(index, el) {
											var temp = JSON.parse($(this).attr('gp'));
											var current = $(this);
											var flag = false;
											$.each(temp, function(index, val) {
												if(val != "gp1" && flag != true){
													$(current).closest('.row.child').hide();
												}else{
													flag = true;
													$(current).closest('.row.child').show();
												}
											});
										});
										//console.log("qqqq");
							        }
					        	}, 1550 );

					        	var myElement = $(widget.find('.my-element'));

					        	$.each(myElement, function(index, val) {
					        		if(relationValue){
				        				$(val).attr('relate-obj', relationValue);
				        			}
				        			if($(val).hasClass('danger')){
				        				var backgroundInterval = setInterval(function(){
									    	$(val).toggleClass("backgroundRed");
										},1550)
				        			}

				        		});
					        	if(panelColor){
					        		var myElement = $(widget.find('.my-element'));
					        		$.each(myElement, function(index, val) {
					        			$(val).css('background-color', panelColor);
					        		});
					        	}


					        }).fail(function(){
					        	alert("error");
					        }).always(function() {

							});


						}
					}

					if (params.draggable == "false") {
						$(this).attr('data-widget-static', '');
					} else {
						$(this).removeAttr('data-widget-static');
					}

					if (params.id) { // there is persistence to deal with

						for (var prop in params) {
							if (prop == "id") continue;
							if (params.hasOwnProperty(prop)) {
								if (localStorage.getItem(widgetId+'.'+prop) == undefined) {
									// store parameter from mark up for the first time
									localStorage.setItem(widgetId+'.'+prop, params[prop]);
									//console.log(widgetId+'.'+prop, params[prop]);
								}
							}
						}
					}
				}
			} catch (e) {
				//console.log(e);
			}

		}).promise().done(function(){
			//console.log("aaaa");
			$('.info-tile,.panel')
	        .css('visibility', 'visible')
	        .velocity('transition.slideUpIn', {stagger: 50});
	        $('.tooltips').tooltip({ container: 'body' });
		});


		// make sortable
		// for (var i = uniqueWidgetGroups.length - 1; i >= 0; i--) {
			// $('[data-widget-group="'+uniqueWidgetGroups[i]+'"]').sortable( {
				// connectWith: '[data-widget-group="'+uniqueWidgetGroups[i]+'"]',
				// items: '[data-widget]:not([data-widget-static])',
				// placeholder: "panel-placeholder",
				// handle: settings.handle? settings.handle:'.panel-heading',
				// start: function(e, ui) {
					// ui.placeholder.height(ui.helper.outerHeight()-4);
					// ui.placeholder.width(ui.helper.outerWidth());
				// },
			// });
		// };

		$('[data-actions-container]')
		.each( function () {
			var elem = $(this);
			var attrs = [];
			$.each( this.attributes, function () {
				attrs.push(this);
			});
			if(!$.browser.chrome) attrs.reverse();
			$.each( attrs, function () {
				// //console.log( this.name.substr(11) );
				if (this.name.substr(0, 12) == "data-action-") {
					var actionName = this.name.substr(12);
					 //console.log( elem.html() );
					if (self.actionDefinitions[actionName] !== undefined && counter==0) {
						var btn = $(self.actionDefinitions[actionName].html);
						elem.append(btn);
						try {
							var params = elem.attr('data-action-'+actionName);
							if (params.length==0) {
								params = '{}'; // empty object
							}
							btn.data('actionParameters', $.parseJSON(params));
						} catch (e) {
							//console.log(e);
						}
						btn.data('actionDefinition', self.actionDefinitions[actionName]);
						btn.data('parentWidget', btn.closest('[data-widget]'));
						if (self.actionDefinitions[actionName].onClick) {
							btn.click( function () {
								self.actionDefinitions[actionName].onClick.call(this);
							});
						}
						if (self.actionDefinitions[actionName].onInit) {
							self.actionDefinitions[actionName].onInit.call(btn);
						}
					}
				}
			});
		});
		counter++;
	};

	return this;
};
