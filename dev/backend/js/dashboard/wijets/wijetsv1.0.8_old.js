/*!
 * wijets v0.1.2
   wijets-dashboard v.1.0.5 
 * http://ndevrstudios.com
 *
 * by Shifat Adnan
 * adnan.pri@gmail.com
 *
 * Copyright (c) 2014, Ndevr Studios Ltd.
 * All rights reserved
 *
 v.1.0.7
 Replace Date:: 30 Nov 2016 : 2:21 PM;
 Replacer:: Nattaphol
 Comment:: New Widget Style "Free text"
 -- 
 v.1.0.6
 Replace Date:: 22 Nov 2016 : 09:35 AM;
 Replacer:: Pichi
 Comment:: fixed rs_sp.
 -- 
 v.1.0.5
 Replace Date:: 22 Nov 2016 : 09:35 AM;
 Replacer:: Nattaphol Boonseng
 Comment:: Merge & Clean some code.
 --
 v.1.0.0
 Replace Date::  Nov 2016 : 12:19 AM;
 Replacer:: Nattaphol Boonseng;
 Comment:: Test metric.;
--
v.0.0.0
 Replace Date::  Nov 2016 : 9:19 AM;
 Replacer:: Nattaphol Boonseng;
 Comment:: Update version control.;
 */

$.wijets = new function () {
	var self = this;
	var flag = '';
	var key_lang = 'en';
	var page_id = 4;
	var index_the_great = 0;
	var temp_massive_data = [];
	//var key_lang = $('#th-btn').val(); // set default language
	this.actionDefinitions = {};

	this.registerAction = function (definition) {
		self.actionDefinitions[definition.handle] = definition;
	};

	var relation = function(container) {
    	var sample_array = $('.drilldown');
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

	var is_switch = function(path){
		var result='';
		if(switch_flag){
			result = curl_path;
		}else{
			result = path;
		}
		return result;
	}


	$.fn.pushWidgetControls = function () {
		var controlsContainer = $(this).closest('[data-widget]').find('[data-widget-controls]');
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
			controlsContainer.parent().toggleClass('editbox-open');
			controlsHtml.siblings().hide();
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
	var qa_gen = function(data){
		metric = '';
		$.each(data, function(qa_index, qa_val) {
				metric += '&nbsp;'+qa_val.type+'&nbsp';
				var counter = 0;
			 $.each(qa_val.metric, function(metric_index, metric_val) {
			 	counter++;
			 	 metric += ' <a href=\'#\' class=\'metric_system\' data-num=\''+metric_val+'\' data-bid=\''+qa_val.bid+'\' data-year=\''+qa_val.year+'\'>'+metric_val+'</a>';
			 	 if(counter < qa_val.metric.length){
			 	 	metric +=',';
			 	 }
			 });
		});
		return metric;
	}
	var draw_card = function(data){
		if(data!=''){
			try {
				var json_obj = JSON.parse(data);
			}catch(e){
				console.log(e);
				return false;
			}
			var html_txt = '';
			var id_array = [];
			var grp_data = [];
			var data_st = [];
			var book_name = [];
			var book_year = [];
			var kpi_val = [];
			var kpi_key = [];
			html_txt += '<div class="row row-fluid" style="">';
			$.each(json_obj,function(index,val){
				var pn_size = (typeof val.pn_size != 'undefined')? val.pn_size : '';
				var tile_bgcolor = (typeof val.tile_bgcolor != 'undefined')? val.tile_bgcolor : '';
				var tile_icocolor = (typeof val.tile_icocolor != 'undefined')? val.tile_icocolor : '';
				var tile_icon = (typeof val.tile_icon != 'undefined')? val.tile_icon : '';
				var widget_kpi = (typeof val.widget_kpi != 'undefined')? val.widget_kpi : '';
				var data_qa = (typeof val.qa != 'undefined')? val.qa : '';
				if(val.widget_style == 'tile-card'){
					if(data_qa != ''){
						metric = qa_gen(data_qa);
						html_txt += '<div class="col-md-'+val.pn_size+' metric-tooltips" data-toggle="tooltip" data-html="true" title="'+metric+'">';
					}else{
						html_txt += '<div class="col-md-'+val.pn_size+'" >';
					}

						html_txt +=	'<div class="info-tile my-element" style="background-color:'+val.tile_bgcolor+';">';
										if(val.is_expand!='false' && (typeof val.is_expand != 'undefined')){
											var i_frame = 0;
											var header = '';
											if(typeof val.is_expand.iframe != 'undefined'){ i_frame = 1; }
											if(typeof val.is_expand.header != 'undefined'){ header = val.is_expand.header; }
						html_txt += '<div class="btn-group btn-right" role="group">'+
													'<button type="button" class="btn btn-default-alt btn-sm pull-right expand-panel" expand-path="'+val.is_expand.link+'" i_frame="'+i_frame+'" data-param="'+val.is_expand.param+'" header_title="'+header+'"><i class="fa fa-search tooltips" data-original-title="ดูทั้งหมด"></i></button>'+
													//'<button type="button" class="btn btn-default-alt btn-sm pull-right book-icon" data-toggle="modal" data-id="'+index_the_great+'" data-target="#kpi_modal"><i class="fa fa-book tooltips"></i></button>'+
												'</div>';
										}
						html_txt +=	'<div class="tile-icon" style="color: '+val.tile_icocolor+';"><i class="'+val.tile_icon+'" aria-hidden="true"></i></div>'+
													'<div class="tile-heading" style="color: black;"><span>'+val.tile_heading+'</span></div>'+
													'<div class="tile-body"><span>'+val.tile_body+'</span></div>'+
													'<div class="tile-footer"><span class="text-danger">'+val.tile_footer+'</span></div>';
													if(typeof val.widget_kpi != 'undefined'){
													$.each(val.widget_kpi, function(key, value) {
															book_name.push(key);
															book_year.push(value.year);
															kpi_val.push(key);
															kpi_val[key] = [];
															kpi_key.push(key);
															kpi_key[key] = [];
															$.each(value.list, function(key2, value2) {
																kpi_key[key].push(key2);
																kpi_val[key].push(value2);
															});
						html_txt +=	'<input type="hidden" id="key_'+key+'_'+index_the_great+'" class="kpi_key_'+index_the_great+'" value="'+kpi_key[key]+'" />'+
												'<input type="hidden" id="value_'+key+'_'+index_the_great+'" class="kpi_value_'+index_the_great+'" value="'+kpi_val[key]+'" />';
												count = 0;
													});
												}
						html_txt +=	'<input type="hidden" class="book_name_'+index_the_great+'" value="'+book_name+'" />'+
												'<input type="hidden" class="book_year_'+index_the_great+'" value="'+book_year+'" />'+
					 								'</div>'+
												'</div>';
						book_name = [];
						kpi_val = [];
						kpi_key = [];
						book_year = [];
				}
				if(val.widget_style == 'tiles-card'){
					if(data_qa != ''){
						metric = qa_gen(data_qa);
						html_txt += '<div class="col-md-'+val.pn_size+' metric-tooltips" data-toggle="tooltip" data-html="true" title="'+metric+'">';
					}else{
						html_txt += '<div class="col-md-'+val.pn_size+'" >';
					}
					html_txt += '<h3 style=" border-radius:20px; background-color:'+val.pn_hd_color+'; text-align:center;" >&nbsp;'+val.tiles_heading+'&nbsp;</h3>';
					$.each(val.tiles_tile, function(index_sub, tile){
					html_txt +=		'<div class="info-tile my-element" style="background-color:'+tile.tile_bgcolor+';">';
									if(tile.is_expand!='false' && (typeof tile.is_expand != 'undefined')){
										var i_frame = 0;
										var header = '';
										if(typeof tile.is_expand.iframe != 'undefined'){ i_frame = 1; }
										if(typeof tile.is_expand.header != 'undefined'){ header = tile.is_expand.header; }
					html_txt +=			'<button class="btn btn-midnightblue btn-sm expand-button-new wrap" expand-path="'+tile.is_expand.link+'" i_frame="'+i_frame+'" data-param="'+tile.is_expand.param+'" header_title="'+header+'"><i class="fa fa-search"></i></button>';
									}
					html_txt +=			'<div class="tile-icon" style="color: '+tile.tile_icocolor+';"><i class="'+tile.tile_icon+'"></i></div>'+
										'<div class="tile-heading" style="color: black;"><span>'+tile.tile_heading+'</span></div>'+
										'<div class="tile-body"><span>'+tile.tile_body+'</span></div>'+
										'<div class="tile-footer"><span class="text-danger">'+tile.tile_footer+'</span></div>'+
									'</div>';
					});
					html_txt +=	'</div>';
				}
				if(val.widget_style == 'chart-card'){
					if(data_qa != ''){
						metric = qa_gen(data_qa);
						html_txt += '<div class="col-md-'+val.pn_size+' metric-tooltips" data-toggle="tooltip" data-html="true" title="'+metric+'">';
					}else{
						html_txt += '<div class="col-md-'+val.pn_size+'" >';
					}
				html_txt += '<div class="panel panel-danger">'+
									'<div class="panel-heading" style="background-color:'+val.pn_hd_color+';">'+
										'<h2 style="color:'+val.pn_hd_text_color+';">'+val.pn_hd_text+'</h2>';
										if(val.is_expand!='false' && (typeof val.is_expand != 'undefined')){
											var i_frame = 0;
											var header = '';
											if(typeof val.is_expand.iframe != 'undefined'){ i_frame = 1; }
											if(typeof val.is_expand.header != 'undefined'){ header = val.is_expand.header; }
					html_txt +=			'<button class="btn btn-midnightblue btn-sm expand-button-new wrap" expand-path="'+val.is_expand.link+'" i_frame="'+i_frame+'" data-param="'+val.is_expand.param+'" header_title="'+header+'" ><i class="fa fa-search"></i></button>';
											}
				html_txt +=			'</div>'+
									'<div class="panel-body my-content">'+
										'<div id="gpContainer'+index_the_great+'">gpContainer'+index_the_great+'</div>'+
									'</div>'+
								'</div>'+
							'</div>';
					id_array.push('gpContainer'+index_the_great);
					if(val.chart_type == 'ch1' || val.chart_type == 'ch4'){
						grp_data.push({'data' : {'series': val.chart_data,'chart_type':val.chart_type ,  'show_legend': val.show_legend,'xaxis_tile':val.xaxis_tile, 'chart_unit': val.chart_unit, 'tooltip':val.tooltip }});
					}else if(val.chart_type == 'ch2' || val.chart_type == 'ch_drill'){
						grp_data.push({'data' : {'series': val.chart_data,'chart_cate':val.chart_cate,'show_legend': val.show_legend,'xaxis_tile':val.xaxis_tile,'chart_type' : val.chart_type, 'chart_sub_type' : val.chart_sub_type , 'chart_unit': val.chart_unit , 'chart_share' : val.chart_share ,'tooltip':val.tooltip,'chart_no_k':val.chart_no_k }});
					}else if(val.chart_type == 'ch3'){
						grp_data.push({'data' : {'series': val.chart_data,'chart_cate':val.chart_cate,'show_legend': val.show_legend,'xaxis_tile':val.xaxis_tile,'chart_type' : val.chart_type, 'chart_unit': val.chart_unit ,'tooltip':val.tooltip}});
					}else if(val.chart_type == 'eqs_sp1' || val.chart_type == 'eqs_sp2' || val.chart_type == 'ch_tbz'){
						grp_data.push({'data' : {'series': val.chart_data,'chart_type':val.chart_type,'chart_cate':val.chart_cate ,'xaxis_tile':val.xaxis_tile, 'chart_unit': val.chart_unit,'tooltip':val.tooltip}});
					}else if(val.chart_type == 'hr_countNurse' || val.chart_type == 'acd_sp1' || val.chart_type == 'ma_sp1'){
						var chart_x_name = '';
						if(typeof val.chart_x_name != 'undefined'){ 
							chart_x_name = val.chart_x_name;
						}
						grp_data.push({'data' : {'series': val.chart_data, 'chart_type':val.chart_type,'chart_unit': val.chart_unit, 'chart_x_name':chart_x_name}});
					}else if(val.chart_type == 'hr_sp1'){ //
						grp_data.push({'data' : {'series': val.chart_data, 'chart_type':val.chart_type, 'year_now':val.chart_year_now}});
					}else if(val.chart_type == 'rs_sp1' || val.chart_type == 'ch_modal'){
						var chart_x_name = '';
						if(typeof val.chart_x_name != 'undefined'){ 
							chart_x_name = val.chart_x_name;
						}
						var chart_modal_iframe =0;
						if(typeof val.chart_modal_iframe != 'undefined'){ 
							chart_modal_iframe = val.chart_modal_iframe;
						}
						grp_data.push({'data' : {'series': val.chart_data, 'chart_type':val.chart_type, 'chart_cate':val.chart_cate, 'chart_table_link':val.chart_table_link, 'chart_x_name':chart_x_name, 'chart_modal_iframe':chart_modal_iframe }});
					}
				}
				if(val.widget_style == 'table-card'){
					if(val.table_type == '1'){
						var i=0;
						var is_tableFade = (typeof val.table_fade !== undefined && !val.table_fade)?false:true;

						if(data_qa != ''){
							metric = qa_gen(data_qa);
							html_txt += '<div class="col-md-'+val.pn_size+' metric-tooltips" data-toggle="tooltip" data-html="true" title="'+metric+'">';
						}else{
							html_txt += '<div class="col-md-'+val.pn_size+'" >';
						}
						html_txt += '<div class="panel panel-danger">'+
														'<div class="panel-heading" style="background-color:'+val.pn_hd_color+';">'+
															'<h2 style="color:'+val.pn_hd_text_color+';">'+val.pn_hd_text+'</h2>';
						if(is_tableFade){
						html_txt +=							'<div class="input-group-btn" align="right">'+
																'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">'+val.table_btn_name.head+' <i class="fa fa-angle-down"></i></button>'+
																'<ul class="dropdown-menu pull-right custom-menu">';
						$.each(val.table_btn_name.tail, function(tail_index	, tail_val) {
						html_txt +=									'<li><a href="#a'+tail_index+'">'+tail_val+'</a></li>';
						});
						html_txt +=								'</ul>'+
															'</div>';
						}
						html_txt +=					'</div>'+
														'<div class="panel-body my-content">';
						if(!is_tableFade){
						html_txt +=							'<div class="table-responsive">'+
																'<table class="table browsers m-n">'+
																	'<thead>'+
																		'<tr>'+
																			'<th colspan="5" class="text-center">'+val.table_data.tb_detail+'</th>'+
																		'</tr>'+
																	'</thead>'+
																	'<tbody>';
																	$.each(val.table_data.tb_row, function( tbody_temp, tbody_val ) {

						html_txt +=	 						'<tr>'+
																		'<td class="text-left">'+tbody_val.col1+'</td>'+
																		'<td class="text-left">';
																		if(tbody_val.label.show == 'true'){
																			var bg_txt = '';
																			if(typeof tbody_val.label.color_bg != 'undefined' && tbody_val.label.color_type != ''){
																				bg_txt = 'style="background-color:'+tbody_val.label.color_bg+'"';
																			}
						html_txt +=								'<span class="label label-'+tbody_val.label.color_type+'" '+bg_txt+'>'+tbody_val.label.text+'</span>';
																		}
						html_txt +=							'</td>';
																		if(tbody_val.col2 == 'progress') {
						html_txt +=								'<td width="60%">'+
																				'<div class="progress m-n" style="height:25px;text-align:center;">'+
																					'<b style="position: absolute;" class="hidden-xs">'+tbody_val.progress_len+'%</b>'+
																					'<div class="progress-bar" style="width:'+tbody_val.progress_len+'%; font-size:18px;"></div>'+
																				'</div>'+
																			'</td>';
																			} else {
						html_txt +=								'<td class="text-right">'+tbody_val.col2+'</td>';
																			}
																		if(tbody_val.is_expand.link != '' && (typeof tbody_val.is_expand != 'undefined')){
																			var i_frame = 0;
																			var header = '';
																			if(typeof tbody_val.is_expand.iframe != 'undefined'){ i_frame = 1; }
																			if(typeof tbody_val.is_expand.header != 'undefined'){ header = tbody_val.is_expand.header; }
						html_txt +=								'<td class="text-right">'+tbody_val.col3+'</td>'+
																	 		'<td class="text-right"  style="width:5%;"><button class="btn btn-midnightblue btn-sm expand-button-new" i_frame="'+i_frame+'" data-param="'+tbody_val.is_expand.param+'" expand-path="'+tbody_val.is_expand.link+'" header_title="'+header+'"><i class="fa fa-search"></i></button></td>';
																		}
						html_txt +=								'</tr>';
																	});
						html_txt +=						'</tbody>'+
																'</table>'+
															'</div>';
														}else if(val.table_fade != ''){
						$.each(val.table_data, function(tb_index, tb_val) {
						html_txt +=							'<div class="table-responsive">'+
											  					'<table class="table browsers m-n" id="a'+tb_index+'" '+((i!=0)?' style="display:none"':'')+'>'+
											  						'<tbody>'+
											  							'<tr>'+
											  								'<th colspan="5" class="text-center">'+tb_val.tb_detail+'</th>'+
											  							'</tr>';
						$.each(tb_val.tb_row, function(row_index, row_val) {

						html_txt +=	 						'<tr>'+
																		'<td class="text-left">'+row_val.col1+'</td>'+
																		'<td class="text-left">';
																		if(row_val.label.show == 'true'){
						html_txt +=								'<span class="label label-'+row_val.label.color_type+'">'+row_val.label.text+'</span>';
																		}
						html_txt +=							'</td>';
																		if(row_val.col2 == 'progress') {
						html_txt +=								'<td width="60%">'+
																				'<div class="progress m-n" style="height:25px;text-align:center;">'+
																					'<b style="position: absolute;">'+row_val.progress_len+'%</b>'+
																					'<div class="progress-bar" style="width:'+row_val.progress_len+'%; font-size:18px;"></div>'+
																				'</div>'+
																			'</td>';
																			} else {
						html_txt +=								'<td class="text-right">'+row_val.col2+'</td>';
																			}
																		
						html_txt +=								'<td class="text-right">'+row_val.col3+'</td>'+
																	 		'<td class="text-right" style="width:5%;">';
																	 		if((typeof row_val.is_expand != 'undefined')){
																			var i_frame = 0;
																			var header = '';
																			if(typeof row_val.is_expand.iframe != 'undefined'){ i_frame = 1; }
																			if(typeof row_val.is_expand.header != 'undefined'){ header = row_val.is_expand.header; }
																	 		if( row_val.is_expand.link != ''){
						html_txt +=									 			'<button class="btn btn-midnightblue btn-sm expand-button-new" i_frame="'+i_frame+'" data-param="'+row_val.is_expand.param+'" expand-path="'+row_val.is_expand.link+'" header_title="'+header+'" ><i class="fa fa-search"></i></button>';
																	 		}
						html_txt +=									 		'</td>';
																		}
						html_txt +=								'</tr>';
						});
						html_txt +=		  							'</tbody>'+
											  					'</table>'+
												            '</div>';
												            i++;
						});				
														}
						html_txt +=						'</div>'+
													'</div>'+
												'</div>';
					} if(val.table_type == '2') {
						var i=0;
						if(val.table_detail == 'graduation'){
							if(data_qa != ''){
							metric = qa_gen(data_qa);
							html_txt += '<div class="col-md-'+val.pn_size+' metric-tooltips" data-toggle="tooltip" data-html="true" title="'+metric+'">';
						}else{
							html_txt += '<div class="col-md-'+val.pn_size+'" >';
						}
						html_txt += '<div class="panel panel-danger">'+
														'<div class="panel-heading" style="background-color:'+val.pn_hd_color+';">'+
															'<h2 style="color:'+val.pn_hd_text_color+';">'+val.pn_hd_text+'</h2>'+
														'</div>'+
														'<div class="panel-body my-content">'+
															'<div class="table-responsive">'+
																'<table class="table table-bordered table-hover my-table">'+
																	'<thead>'+
																		'<tr>'+
																			'<th rowspan="2" class="text-center" style="vertical-align: middle !important;">'+val.table_data.main_th1+'</th>'+
																			'<th class="text-center" colspan="5">'+val.table_data.sub_th_detail+'</th>'+
																		'</tr>'+
																		'<tr>'+
																			'<th class="text-center">'+val.table_data.sub_th1+'</th>'+
																			'<th class="text-center">'+val.table_data.sub_th2+'</th>'+
																			'<th class="text-center">'+val.table_data.sub_th3+'</th>'+
																			'<th class="text-center">'+val.table_data.sub_th4+'</th>'+
																			'<th class="text-center">'+val.table_data.sub_th5+'</th>'+
																		'</tr>'+
																	'</thead>'+
																	'<tbody>';
																	$.each(val.table_data.tb_row, function( tbody_temp, tbody_val ) {
						html_txt +=						'<tr>'+
																		'<td class="text-center complex_ele" expand-path="">'+tbody_val.col1+'</td>'+
																		'<td class="text-center complex_ele" expand-path="">'+tbody_val.col2+'</td>'+
																		'<td class="text-center complex_ele" expand-path="">'+tbody_val.col3+'</td>'+
																		'<td class="text-center complex_ele" expand-path="">'+tbody_val.col4+'</td>'+
																		'<td class="text-center complex_ele" expand-path="">'+tbody_val.col5+'</td>'+
																		'<td class="text-center complex_ele" expand-path="">'+tbody_val.col6+'</td>'+
																	'</tr>';
																});
						html_txt +=						'</tbody>'+
																'</table>'+
															'</div>'+
														'</div>'+
													'</div>'+
												'</div>';
											} else if(val.table_detail == 'remained') {
												if(data_qa != ''){
													metric = qa_gen(data_qa);
													html_txt += '<div class="col-md-'+val.pn_size+' metric-tooltips" data-toggle="tooltip" data-html="true" title="'+metric+'">';
												}else{
													html_txt += '<div class="col-md-'+val.pn_size+'" >';
												}
												html_txt += '<div class="panel panel-danger">'+
																				'<div class="panel-heading" style="background-color:'+val.pn_hd_color+';">'+
																					'<h2 style="color:'+val.pn_hd_text_color+';">'+val.pn_hd_text+'</h2>'+
																				'</div>'+
																				'<div class="panel-body my-content">'+
																					'<div class="table-responsive">'+
																						'<table class="table table-bordered table-hover my-table">'+
																							'<thead>'+
																								'<tr>'+
																									'<th rowspan="2" class="text-center" style="vertical-align: middle !important;">'+val.table_data.main_th1+'</th>'+
																									'<th rowspan="2" class="text-center" style="vertical-align: middle !important;">'+val.table_data.main_th2+'</th>'+
																									'<th class="text-center" colspan="4">'+val.table_data.sub_th_detail+'</th>'+
																									'<th rowspan="2" class="text-center" style="vertical-align: middle !important;width:15%;">'+val.table_data.main_th3+'</th>'+
																								'</tr>'+
																								'<tr>'+
																									'<th class="text-center">'+val.table_data.sub_th1+'</th>'+
																									'<th class="text-center">'+val.table_data.sub_th2+'</th>'+
																									'<th class="text-center">'+val.table_data.sub_th3+'</th>'+
																									'<th class="text-center">'+val.table_data.sub_th4+'</th>'+
																								'</tr>'+
																							'</thead>'+
																							'<tbody>';
																							$.each(val.table_data.tb_row, function( tbody_temp, tbody_val ) {
												html_txt +=						'<tr>'+
																								'<td class="text-center complex_ele" expand-path="">'+tbody_val.col1+'</td>'+
																								'<td class="text-center complex_ele" expand-path="">'+tbody_val.col2+'</td>'+
																								'<td class="text-center complex_ele" expand-path="">'+tbody_val.col3+'</td>'+
																								'<td class="text-center complex_ele" expand-path="">'+tbody_val.col4+'</td>'+
																								'<td class="text-center complex_ele" expand-path="">'+tbody_val.col5+'</td>'+
																								'<td class="text-center complex_ele" expand-path="">'+tbody_val.col6+'</td>'+
																								'<td class="text-center complex_ele" expand-path="">'+tbody_val.col7+'</td>'+
																							'</tr>';
																						});
												html_txt +=						'</tbody>'+
																						'</table>'+
																					'</div>'+
																				'</div>'+
																			'</div>'+
																		'</div>';
											}
					} if(val.table_type == 'special') {
						var i=0;
						if(data_qa != ''){
							metric = qa_gen(data_qa);
							html_txt += '<div class="col-md-'+val.pn_size+' metric-tooltips" data-toggle="tooltip" data-html="true" title="'+metric+'">';
						}else{
							html_txt += '<div class="col-md-'+val.pn_size+'" >';
						}
						html_txt +=  '<div class="panel panel-danger">'+
														'<div class="panel-heading" style="background-color:'+val.pn_hd_color+';">'+
															'<h2 style="color:'+val.pn_hd_text_color+';">'+val.pn_hd_text+'</h2>';
							if(val.is_expand!='false' && (typeof val.is_expand != 'undefined')){
												var i_frame = 0;
												var header = '';
												if(typeof val.is_expand.iframe != 'undefined'){ i_frame = 1; }
												if(typeof val.is_expand.header != 'undefined'){ header = val.is_expand.header; }
						html_txt +=			'<button class="btn btn-midnightblue btn-sm expand-button-new wrap" expand-path="'+val.is_expand.link+'" i_frame="'+i_frame+'" data-param="'+val.is_expand.param+'" header_title="'+header+'" ><i class="fa fa-search"></i></button>';
												}								
						html_txt +=						'</div>'+
														'<div class="panel-body my-content">'+
															'<div class="table-responsive">'+
																'<table class="table table-bordered table-hover my-table" id="table_number_'+index_the_great+'">'+
																	'<thead>'+
																		'<tr>';
																		$.each(val.table_data.tb_row_head[i].main_th, function( main_th_temp, main_th_val ) {
																			var td_attr = (typeof main_th_val.th.attr === undefined)?'':main_th_val.th.attr;
																			var td_data = (typeof main_th_val.th.data === undefined)?'':main_th_val.th.data;
						html_txt +=								'<th '+td_attr+'>'+td_data+'</th>';
																		});
						html_txt +=							'</tr>';

																		if(typeof val.table_data.tb_row_head[i].sub_th != 'undefined'){
						html_txt +=							'<tr>';
																		$.each(val.table_data.tb_row_head[i].sub_th, function( sub_th_temp, sub_th_val ) {
						html_txt +=								'<th class="text-center">'+sub_th_val+'</th>';
																		});
						html_txt +=							'</tr>';
																		}
						html_txt +=							'</thead>'+
																	'<tbody>';
																		$.each(val.table_data.tb_row_body, function( tbody_temp, tbody_val ) {
																			var tbody_me = tbody_val.tbody;
																			var tbody_attr = (typeof tbody_val.attr === undefined)?'':tbody_val.attr;
						html_txt +=										'<tr '+tbody_attr+'>';
																			$.each(tbody_me, function(index_me, val_me) {
																			var td_attr = (typeof val_me.td.attr === undefined)?'':val_me.td.attr;
																			var td_data = (typeof val_me.td.data === undefined)?'':val_me.td.data;
						html_txt +=										'<td '+td_attr+'>'+td_data+'</td>';

																			});
						html_txt +=							'</tr>';
																		});
						html_txt +=							'</tbody>'+
																'</table>'+
															'</div>'+
														'</div>'+
													'</div>'+
												'</div>';
						if(val.table_data.datatable == true){
							id_array.push('table_number_'+index_the_great);
							grp_data.push({'data' : {'chart_type':'tabledata'}});
						}
					}
					if(val.table_type == 'rs_sp1'){
						/*var table_rows = '';
						$.each(val.table_data.tb_row, function(index, tr){
							var persons = '';
							var num_ps = tr.persons.length;
							$.each(tr.persons, function(index2, ps){
								persons += ps;
								if(num_ps != index2+1){
									persons += '<br/>';
								}
							});
							table_rows += '<tr>';
								table_rows += '<td class="aCenter" >'+(index+1)+'</td>'
								table_rows += '<td class="aLeft" ><a href="javascript:void(0);" title="คลิกดูรายละเอียด" class="open_link" param="'+tr.rs_id+'" path="https://10.51.4.23/pcksite/index.php/dashboard/Db_controller/view2" ><strong>'+tr.rs_name+'</strong></a></td>';
								table_rows += '<td class="aLeft" nowrap="nowrap">'+persons+'</td>';
							table_rows += '</tr>';
						});
						html_txt += '<div class="col-md-6" id="dwnxx2">'+
							'<div class="panel  panel panel-blue" data-widget=\'{"draggable": "false"}\'>'+
								'<div class="panel-heading"  style="background-color:'+val.pn_hd_color+';" >'+
									'<h2><span id="dwn2_title">'+val.pn_hd_text+'</span></h2>'+
									'<div class="panel-ctrls" data-actions-container="" data-action-collapse=\'{"target": ".panel-body"}\'></div>'+
								'</div>'+
								'<div class="panel-body scroll-pane" style="height: 450px;">'+
									'<div class="scroll-content">'+

									'<table class="table table-striped table-bordered dataTable no-footer" id="example">'+
										'<thead>'+
											'<tr>'+
												'<th style="vertical-align:middle;background-color: #89A236;color:#FCFFF3;"><b>ลำดับที่</b></th> '+
												'<th style="vertical-align:middle;background-color: #89A236;color:#FCFFF3;"><b>ชื่อผลงาน</b></th>'+
												'<th style="vertical-align:middle;background-color: #89A236;color:#FCFFF3;"><b>คณะผู้ทำผลงาน</b></th>'+
											'</tr>'+
										'</thead>'+
										'<tbody>'+
											table_rows+
										'</tbody>'+
									'</table>'+
									'</div>'+
								'</div>'+
							'</div>';*/
						var thr = '';
						$.each(val.table_data.thr, function(thrdex, thrval){
							var th = '';
							$.each(thrval.th, function(thdex, thval){
								th += '<th '+thval.attr+' >'+thval.text+'</th>';
							});
							thr += '<tr '+thrval.thr_attr+'>'+th+'</tr>';
						});
						table_rows = '';
						if(typeof val.table_data.tr != 'undefined'){
							var link_tr ='';
							var link_trigger ='';
							if(typeof val.is_expand != 'undefined'){
								link_tr = 'expand-path="'+val.is_expand.link+'"';
								link_trigger = 'class="expand-button-new"';
							}
							$.each(val.table_data.tr, function(trdex, trval){
								var td = '';
								var param_tr = '';
								if(typeof trval.param != 'undefined'){
									param_tr = 'data-param="'+trval.param+'"';
								}

								$.each(trval.td, function(tddex, tdval){
									td += '<td '+tdval.attr+' >'+tdval.text+'</td>';
								});
								table_rows += '<tr '+link_tr+' '+link_trigger+' '+param_tr+' '+trval.tr_attr+'>'+td+'</tr>';
							});
						}
						html_txt += '';
						if(data_qa != ''){
							$.each(data_qa, function(qa_index, qa_val) {
									metric = qa_val.type+'&nbsp';
									var counter = 0;
								 $.each(qa_val.metric, function(metric_index, metric_val) {
									counter++;
									 metric += ' <a href=\'#\' class=\'metric_system\' data-num=\''+metric_val+'\' data-bid=\''+qa_val.bid+'\' data-year=\''+qa_val.year+'\'>'+metric_val+'</a>';
									 if(counter < qa_val.metric.length){
										metric +=',';
									 }
								 });
							});
							html_txt += '<div class="col-md-'+val.pn_size+' metric-tooltips" data-toggle="tooltip" data-html="true" title="'+metric+'"  id="dwnxx2">';
						}else{
							html_txt += '<div class="col-md-'+val.pn_size+'"  id="dwnxx2">';
						}
						html_txt += '<div class="panel  panel panel-blue" data-widget=\'{"draggable": "false"}\'>'+
								'<div class="panel-heading"  style="background-color:'+val.pn_hd_color+';" >'+
									'<h2><span style="color:'+val.pn_hd_text_color+';" id="dwn2_title">'+val.pn_hd_text+'</span></h2>'+
									'<div class="panel-ctrls" data-actions-container="" data-action-collapse=\'{"target": ".panel-body"}\'></div>'+
								'</div>'+
								'<div class="panel-body '+val.pn_div_class+'" style="background:'+val.pn_color+'">'+
									'<table class="table table-striped table-bordered dataTable no-footer" id="example">'+
										'<thead>'+
											thr+
										'</thead>'+
										'<tbody>'+
											table_rows+
										'</tbody>'+
									'</table>'+
								'</div>'+
							'</div>'+
						'</div>';
					}
					if(val.table_type == 'basic-npad'){
						var thr = '';
						$.each(val.table_data.thr, function(thrdex, thrval){
							var th = '';
							$.each(thrval.th, function(thdex, thval){
								th += '<th '+thval.attr+' >'+thval.text+'</th>';
							});
							thr += '<tr '+thrval.thr_attr+'>'+th+'</tr>';
						});
						table_rows = '';
						if(typeof val.table_data.tr != 'undefined'){
							var link_tr ='';
							var link_trigger ='';
							if(typeof val.is_expand != 'undefined'){
								link_tr = 'expand-path="'+val.is_expand.link+'"';
								var i_frame = 0;
								var header = '';
								if(val.is_expand.iframe == 1 ){
									i_frame = 1;
								}
								if(typeof val.is_expand.header != 'undefined'){ header = val.is_expand.header; }
								link_trigger = 'class="expand-button-new"  i_frame="'+i_frame+'" header_title="'+header+'" ';
							}
							$.each(val.table_data.tr, function(trdex, trval){
								var td = '';
								var param_tr = '';
								if(typeof trval.param != 'undefined'){
									param_tr = 'data-param="'+trval.param+'"';
								}

								$.each(trval.td, function(tddex, tdval){
									td += '<td '+tdval.attr+' >'+tdval.text+'</td>';
								});
								table_rows += '<tr '+link_tr+' '+link_trigger+' '+param_tr+' '+trval.tr_attr+'>'+td+'</tr>';
							});
						}
						if(data_qa != ''){
							$.each(data_qa, function(qa_index, qa_val) {
									metric = qa_val.type+'&nbsp';
									var counter = 0;
								 $.each(qa_val.metric, function(metric_index, metric_val) {
									counter++;
									 metric += ' <a href=\'#\' class=\'metric_system\' data-num=\''+metric_val+'\' data-bid=\''+qa_val.bid+'\' data-year=\''+qa_val.year+'\'>'+metric_val+'</a>';
									 if(counter < qa_val.metric.length){
										metric +=',';
									 }
								 });
							});
							html_txt += '<div class="col-md-'+val.pn_size+' metric-tooltips" data-toggle="tooltip" data-html="true" title="'+metric+'"  id="dwnxx2">';
						}else{
							html_txt += '<div class="col-md-'+val.pn_size+'"  id="dwnxx2">';
						}
						html_txt += ''+
							'<div class="panel  panel panel-blue" data-widget=\'{"draggable": "false"}\'>'+
								'<div class="panel-heading"  style="background-color:'+val.pn_hd_color+';color:'+val.pn_hd_text_color+';" >'+
									'<h2><span id="dwn2_title">'+val.pn_hd_text+'</span></h2>'+
									'<div class="panel-ctrls" data-actions-container="" data-action-collapse=\'{"target": ".panel-body"}\'></div>'+
								'</div>'+
								'<div class="panel-body " style="background:'+val.pn_color+'">'+
									'<table class="table table-hover table-striped table-bordered dataTable no-footer" id="table_number_'+index_the_great+'">'+
										'<thead>'+
											thr+
										'</thead>'+
										'<tbody>'+
											table_rows+
										'</tbody>'+
									'</table>'+
								'</div>'+
							'</div>'+
						'</div>';

						id_array.push('table_number_'+index_the_great);
						grp_data.push({'data' : {'chart_type':'tabledata'}});
					}
					if(val.table_type == 'tqf_sp1'){
						var table_rows = '';
						var current_crs = 0;
						if(val.course.length > 0){
							$.each(val.course, function(index_c, crs){
								if(crs.select =='checked'){
									current_crs = crs.id;
								}
								table_rows += '<tr>'+
												'<td style="text-align:center;">'+
												'<input type="radio" value="'+crs.id+'" name="course_is_so_goods" class="select_da_course" '+crs.select+' />'+
													'<input type="hidden" id="the_current_course" value="'+current_crs+'" />'+
												'</td>'+
												'<td style="text-align:center;">'+(index_c+1)+'</td>'+
												'<td>'+crs.name+'</td>'+
												'<td style="text-align:center;"><i style="cursor:pointer;" class="fa fa-search expand-button-new" expand-path="'+val.tqf_detail_path+'" data-param="'+crs.id+'" i_frame="0"></i></td>'+
											'</tr>';
							});
						}else{
							table_rows += '<tr><td colspan="4" style="text-align:center;">ไม่มีข้อมูลหลักสูตร</td></tr>';
						}

						html_txt += ''+
						'<div class="col-md-'+val.pn_size+'" id="tqf_base_table">'+
							'<div class="panel  panel panel-blue" data-widget=\'{"draggable": "false"}\'>'+
								'<div class="panel-heading"  style="background-color:'+val.pn_hd_color+';color:'+val.pn_hd_text_color+';" >'+
									'<h2><span id="dwn2_title">'+val.pn_hd_text+'</span></h2>'+
									'<div class="panel-ctrls" data-actions-container="" data-action-collapse=\'{"target": ".panel-body"}\'></div>'+
								'</div>'+
								'<div class="panel-body" style="background:'+val.pn_color+'">'+
									'<input type="hidden" id="tqf_link" value="'+val.tqf_path+'" />'+
									'<table class="table table-striped table-bordered dataTable no-footer " >'+
										'<thead>'+
											'<tr>'+
												'<th style="text-align:center;background-color: #fff;"><b>เลือก</b></th> '+
												'<th style="text-align:center;background-color: #fff;"><b>ลำดับ</b></th>'+
												'<th style="text-align:center;background-color: #fff;"><b>ชื่อหลักสูตร</b></th>'+
												'<th style="text-align:center;background-color: #fff;"><b>รายละเอียด</b></th>'+
											'</tr>'+
										'</thead>'+
										'<tbody>'+
											table_rows+
										'</tbody>'+
									'</table>'+

								'</div>'+
							'</div>'+
						'</div>';


					}
				}
				if(val.widget_style == 'bg-sp1'){
					temp_massive_data = val.tab_data;
					//var cond_g = 'max';
					html_txt += gen_holy_tab(val.tab_data, 'มากที่สุด', val.pn_size);

					
				}
				if(val.widget_style == 'special-card'){
				html_txt += '<div class="row">'+
								'<div class="col-md-6">'+
									'<div class="panel panel-danger">'+
										'<div class="panel-heading" style="background-color:'+val.pn_hd_color+';">'+
											'<h2 style="color:'+val.pn_hd_text_color+';">จำนวนครุภัณฑ์ที่จะหมดอายุภายใน 2 ปี จำแนกตามประเภท</h2>'+
										'</div>'+
										'<div class="panel-body my-content">'+
											'<div id="gpContainer'+index_the_great+'">gpContainer'+index_the_great+'</div>'+
										'</div>'+
									'</div>'+
								'</div>'+
								'<div class="col-md-6">'+
									'<div class="panel panel-danger">'+
										'<div class="panel-heading" style="background-color:'+val.pn_hd_color+';">'+
											'<h2 style="color:'+val.pn_hd_text_color+';">รายการครุภัณฑ์ที่คาดว่าจะหมดอายุภายใน 2 ปี</h2>'+
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
					id_array.push('gpContainer'+index_the_great);
					grp_data.push({'data' : {'series': val.chart_data,'chart_type':val.chart_type,'chart_cate':val.chart_cate,'chart_dataTable':val.chart_dataTable}});
				}
				if(val.widget_style == 'tab-card'){
					var list_nav = '';
					var tab_content = '';
					$.each(val.tab_data, function(index, tab){
						var inner_card = '';
						$.when(draw_card(JSON.stringify(tab.inner_card))).done(function (arg1){
							inner_card = arg1.html_text;
							$.each(arg1.id_array,function(index_g,val){
								id_array.push(val);
								grp_data.push(arg1.grp_data[index_g]);
							});
						});
						var tab_class = '';
						var list_nav_sub = '';
						var tab_content_sub = '';
						if(index == 0) tab_class='active';
						var icon = '';
						if(typeof tab.icon != 'undefined') icon = '<i class="ti ti-'+tab.icon+'"></i>';
						list_nav += '<li class="'+tab_class+'"><a href="#tab-1-'+index+'" data-toggle="tab">'+icon+' '+tab.tab_name+'</a></li>';

						tab_content += '<div class="tab-pane '+tab_class+'" id="tab-1-'+index+'">'+
										'<div class="col-md-12">'+
											'<div class="tab-container tab-default">'+
												'<div class="panel-body">'+
													inner_card+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>';
					});
					html_txt += '<div class="col-md-'+val.pn_size+'">';
					html_txt += '<div class="panel panel-midnightblue" data-widget=\'{"draggable": "false"}\' style="visibility: visible;"> '+
						'<div class="panel-heading" style="background-color:'+val.pn_hd_color+'">'+
							'<h2>'+
								'<ul class="nav nav-tabs">'+
									list_nav+
								'</ul>'+
							'</h2>'+
							'<div class="input-group-btn" align="right">'+
								'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">ohly <i class="fa fa-angle-down"></i></button>'+
								'<ul class="dropdown-menu pull-right" >'+
									'<li><a href="javascript:void(0)" class="holy_sorting" cond="max">มากที่สุด</a></li>'+
									'<li><a href="javascript:void(0)" class="holy_sorting"  cond="min" >น้อยที่สุด</a></li>'+
								'</ul>'+
							'</div>'+
						  '</div>'+
						  '<div class="panel-body">'+
						  	'<div class="tab-content">'+
						  		tab_content+
						  	'</div>'+
						  '</div>'+
							'</div>'+
						'</div>'+
					'</div>';
					html_txt += '</div>';
				}
				if(val.widget_style == 'great-card'){
					var inner_card = '';
					$.when(draw_card(JSON.stringify(val.inner_card))).done(function (arg1){
						inner_card = arg1.html_text;
						$.each(arg1.id_array,function(index_g,val){
							id_array.push(val);
							grp_data.push(arg1.grp_data[index_g]);
						});
					});
					var regret = '';
					var regret_path = '';
					if(typeof val.re_great != 'undefined'){
						regret_path = ' regret_path="'+val.re_great.path+'" ';
						if(typeof val.re_great.multi == 'undefined' || !val.re_great.multi){
							regret += '<div class="col-sm-2">';
							regret += '<select id="greater-card'+index_the_great+'" class="re_the_great form-control" style="text-align:center; display:inline-block;font-size:16px; height:39px;" >';
							$.each(val.re_great.details, function(ingret, vagret){
								var selecto = '';
								if(val.re_great.default == vagret.param){
									selecto = 'selected';
								}

								regret += '<option '+selecto+' value="'+vagret.param+'">'+vagret.name+'</option>';
							});
							regret += '</select>';
							regret += '</div>';
						}else{
							$.each(val.re_great.details, function(ndex, re_data){
								regret += '<div class="col-sm-2">'
								regret += '<select id="greater-card'+index_the_great+'" class="re_the_great form-control" style="text-align:center; display:inline-block;font-size:16px; height:39px;" >';
								$.each(re_data.data, function(ingret, vagret){
									var selecto = '';
									if(re_data.default == vagret.param){
										selecto = 'selected';
									}

									regret += '<option '+selecto+' value="'+vagret.param+'">'+vagret.name+'</option>';
								});
								regret += '</select>';
								regret += '</div>';
							});
						}
					}
					var expand = '';
					if(typeof val.is_expand != 'undefined' && val.is_expand!=false){
						var i_frame = 0;
						var header = '';
						if(typeof val.is_expand.iframe != 'undefined'){ i_frame = 1; }
						if(typeof val.is_expand.header != 'undefined'){ header = val.is_expand.header; }
						expand = '<button class="btn btn-midnightblue btn-sm expand-button-new wrap" expand-path="'+val.is_expand.link+'" i_frame="'+i_frame+'" data-param="'+val.is_expand.param+'" header_title="'+header+'"><i class="fa fa-search"></i></button>'
					}

					html_txt += '<div class="col-md-'+val.pn_size+' oh-the-great-card">'+
									'<div class="panel panel-danger">'+
										'<div class="panel-heading" style="background-color:'+val.pn_hd_color+';" '+regret_path+'>'+
											'<h2 style="color:'+val.pn_hd_text_color+';">'+val.pn_hd_text+'</h2>'+regret+expand+'';
							html_txt +=	'</div>'+
										'<div class="panel-body my-content the-great-card-panel" style="background:'+val.pn_color+'">'+
											inner_card+
										'</div>'+
									'</div>'+
								'</div>';

				}
				if(val.widget_style == 'fr-txt'){

					html_txt += '<div class="col-md-'+val.pn_size+'">';
					if(typeof val.pn_hd_status != 'undefined' && val.pn_hd_status == true){
					html_txt +=		'<div class="panel panel-danger">'+								
										'<div class="panel-heading" style="background-color:'+val.pn_hd_color+';">'+
															'<h2 style="color:'+val.pn_hd_text_color+';">'+val.pn_hd_text+'</h2>'+
														'</div>'+
									'<div class="panel-body my-content">';
								}
													
								if(typeof val.text != 'undefined' && val.text != ''){
					html_txt += '<span>'+val.text+'</span>';				
								}
					if(typeof val.pn_hd_status != 'undefined' && val.pn_hd_status == 'true'){
					html_txt += '</div></div>';
					}
					html_txt +=	'</div>';
				}
				if(val.widget_style == 'ea-pie'){
					var data_percent = (typeof val.data_percent != 'undefined')?val.data_percent:'';
					var txt_1 = (typeof val.data_txt_1 != 'undefined')?val.data_txt_1:'Total A';
					var txt_2 = (typeof val.data_txt_2 != 'undefined')?val.data_txt_2:'Total B';
					var val_1 = (typeof val.data_val_1 != 'undefined')?val.data_val_1:'N/A';
					var val_2 = (typeof val.data_val_2 != 'undefined')?val.data_val_2:'N/A';
					html_txt += '<div class="col-md-'+val.pn_size+'">';
					var temptext = '';
					temptext += 	'<div class="panel panel-midnightblue widget-progress">'+
				                		'<div class="panel-heading">'+
					                    '<h2 style="color:'+val.pn_hd_text_color+';">'+val.pn_hd_text+'</h2>'+
					                '</div>'+
					                '<div class="panel-body" style="min-height:250px;">'+
										'<div class="easypiechart mb-md" id="progress_'+index_the_great+'" data-percent="'+data_percent+'" style="width:'+val.chart_data.size+'px;">'+
											'<span class="percent-non"></span>'+
										'</div>'+
					                '</div>'+
					                '<div class="panel-footer">'+
										'<div class="tabular">'+
											'<div class="tabular-row">'+
												'<div class="tabular-cell">'+
													'<span class="status-total">'+txt_1+'</span>'+
													'<span class="status-value" style="color:'+val.chart_data.barColor+';"><strong>'+val_1+'</strong></span>'+
												'</div>'+
												'<div class="tabular-cell">'+
													'<span class="status-pending">'+txt_2+'</span>'+
													'<span class="status-value" style="color:'+val.chart_data.trackColor+';"><strong>'+val_2+'</strong></span>'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'+
			            		'</div></div>';
			            		html_txt += temptext;
					id_array.push('progress_'+index_the_great);
					grp_data.push({'data' : {
												'chart_type': 'ea-pie',
												'percent': val.chart_data.data_all,
												'barColor': val.chart_data.barColor,
												'trackColor': val.chart_data.trackColor,
                								'scaleColor': val.chart_data.scaleColor,
							                	'scaleLength': val.chart_data.scaleLength,
							                	'lineCap': val.chart_data.lineCap,
							                	'lineWidth': val.chart_data.lineWidth,
							               		'size': val.chart_data.size, }
							               	});

				}
				index_the_great++;
			});
			html_txt += '</div>';
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
			$('select.search_sel').select2('destroy');
			$('select.search_sel').select2({
					matcher: function(term, text, opt){
			        var matcher = opt.parent('select').select2.defaults.matcher;
			        return matcher(term, text) || (opt.parent('optgroup').length && matcher(term, opt.parent('optgroup').attr("label")));
			    }
			});
			if (controls) {
				$(controls).val(button.closest('[data-widget]').find('h2').html());
			} else {
				button.hideWidgetControls(true);
			}
			$(".select").on('change', function(event) {
				event.preventDefault();

				button.closest('[data-widget]').find('h2').html($(this).find("option:selected").text());
				selectVal = $('option:selected', this).attr('my-path');
				selectId = $('option:selected', this).data('id');
				selectText = $(this).find("option:selected").text();
		        var widget = $(this).closest('[data-widget]');
		        widget.append('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
				var path = $('option:selected', this).attr('my-path');
				
		        $.post( is_switch(path) , { path:path , param:$(this).val() , curId:flag })
		        .done(function (data) {
		        	console.log("ccc");
					try {


					$.when(draw_card(data)).done(function (arg1){
						widget.find('.panel-loading').remove();
						widget.find('.panel-body').html(arg1.html_text).promise().done(function(){

							$.each(arg1.id_array,function(index,val){
								//console.log(arg1.grp_data[index].data);

								makePlot(widget.find('.panel-body'),val,arg1.grp_data[index].data);
							});
						});
						$(".panel").css('visibility', 'visible');
						$(".table").css('visibility', 'visible');
						$(".info-tile").css('visibility', 'visible');
						$('.tooltips').tooltip({ container: 'body' });	
					}); } catch(err){
						widget.find('.panel-loading').remove();
						console.log(err);
						widget.find('.panel-body').html('<div class="alert alert-dismissable alert-danger"><i class="ti ti-close"></i>&nbsp;ไม่สามารถแสดงข้อมูลได้กรุณาติดต่อผู้แลระบบ</div>');
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
						$('.tooltips').tooltip({ container: 'body' });
						//$(".sortable").disableSelection();
					});
					$(".panel").css('visibility', 'visible');
					$(".table").css('visibility', 'visible');
					$('.tooltips').tooltip({ container: 'body' });
					event.preventDefault();
					button.setWidgetState('headerTitle', selectText);
					button.setWidgetState('selectType',	selectVal);
					button.setWidgetState('selectId',	selectId);
					button.hideWidgetControls(true);
				});


			});
			$(".check").on('click', function(event) {
				event.preventDefault();
				button.setWidgetState('headerTitle', selectText);
				button.setWidgetState('selectType',	selectVal);
				button.hideWidgetControls(true);
			});

		},
		onInit: function () {
			var headerTitle = $(this).getWidgetState('headerTitle');
			var selectType = $(this).getWidgetState('selectType');
			var selectParam = $(this).getWidgetState('selectParam');

			if (headerTitle) {
				$(this).closest('[data-widget]').find('h2').html(headerTitle);
			}
			if(selectType){
				var widget = $(this).closest('[data-widget]');
				var panelColor = $(this).getWidgetState('panelColor');
		        widget.append('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
		        $.post( is_switch(selectType)  , { path:selectType , param:selectParam , curId:flag })
		        .done(function (data) {

					$.when(draw_card(data)).done(function (arg1){
						if(arg1){
						widget.find('.panel-loading').remove();
						widget.find('.panel-body').html(arg1.html_text).promise().done(function(){

							$.each(arg1.id_array,function(index,val){
								//console.log(arg1.grp_data[index].data);

								makePlot(widget.find('.panel-body'),val,arg1.grp_data[index].data);
							});
						});

						$(".panel").css('visibility', 'visible');
						$(".table").css('visibility', 'visible');
						$(".info-tile").css('visibility', 'visible');
						$('.tooltips').tooltip({ container: 'body' });
						}else{
							widget.find('.panel-loading').remove();
							widget.find('.panel-body').html('<div class="alert alert-dismissable alert-danger"><i class="ti ti-close"></i>&nbsp;ไม่สามารถแสดงข้อมูลได้กรุณาติดต่อผู้แลระบบ</div>');
						}
					});
		        }).fail(function(){
		        	widget.find('.panel-loading').remove();
					widget.find('.panel-body').html('<div class="alert alert-dismissable alert-danger"><i class="ti ti-close"></i>&nbsp;ไม่สามารถแสดงข้อมูลได้กรุณาติดต่อผู้แลระบบ</div>');
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
						//$(".sortable").disableSelection();
					});
					$(".panel").css('visibility', 'visible');
					$(".table").css('visibility', 'visible');
					$('.tooltips').tooltip({ container: 'body' });
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
			    	opacity = obj.fromNumber/100;
			    	var widget = button.closest('[data-widget]');
			    }
			});
console.log(controls);
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
	    handle: "hidewidget",
	    html: '<span class="button-icon has-bg "><i class="fa fa-eye-slash"></i></span>',
	    onClick: function () {
	    	var button = $(this);
	    	var widget = button.closest('[data-widget]');
	    	var state = false;
	    	$(this).find('i').toggleClass('text-danger');
	    	if($(this).find('i').hasClass('text-danger')){
	    		state = true;
	    	}else{
	    		state = false;
	    	}
	    	button.setWidgetState('hidewidget',	state);

	        bootbox.alert($(this).getWidgetState('hidewidget'));
	    },
		onInit: function () {
				//alert($(this).getWidgetState('hidewidget'));
				var widget = $(this).closest('[data-widget]');
				if($(this).getWidgetState('hidewidget')=='true'){
					//alert('s');
					$(this).find('i').addClass('text-danger');
				}else{
					//$(this).find('i').removeClass('text-danger');
				}
		}
	});

	this.registerAction( {
	    handle: "refresh",
	    html: '<span class="button-icon"><i class="ti ti-reload"></i></span>',
	    onClick: function () {
	        var params = $(this).data('actionParameters');
	        var widget = $(this).closest('[data-widget]');
	        widget.append('<div class="panel-loading"><div class="panel-loader-' + params.type + '"></div></div>');
	        self.Mymake();
	        widget.find('.panel-loading').remove();
	    }
    });

    this.registerAction( {
	    handle: "relation",
	    html: '<span class="button-icon"><i class="fa fa-crop"></i></span>',
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
		var size_of_font = '16px';
		var test = new Array();
		var test2 = new Array();
		//console.log(payload);
		var xaxis_tile = (typeof payload.xaxis_tile  !== 'undefined' )?payload.xaxis_tile:'';
		var show_legend  = (typeof payload.show_legend  !== 'undefined' )?payload.show_legend:false;
		var unit = (typeof payload.chart_unit  !== 'undefined' )?payload.chart_unit:'หน่วย';
		var tooltipHead = '<span style="font-size: 14px">{point.key}</span><br>';
    var toolPoint = '<span style="font-size: 20px" align="right">จำนวน {point.y} '+unit+'</span>';
    var align = (typeof payload.align  !== 'undefined' )?payload.align:'center';
    var verticalAlign = (typeof payload.verticalAlign  !== 'undefined' )?payload.verticalAlign:'bottom';
    var layout = (typeof payload.layout  !== 'undefined' )?payload.layout:'horizontal';
		console.log(payload.verticalAlign);
        if(payload.chart_type == 'ch1'){
        	if(typeof payload.tooltip !== 'undefined'){

        		tooltipHead = (typeof payload.tooltip.headerFormat  !== 'undefined' )?payload.tooltip.headerFormat:'<span style="font-size: 14px">{point.key}</span><br>';
        		toolPoint = (typeof payload.tooltip.pointFormat !== 'undefined' )?payload.tooltip.pointFormat:'<span style="font-size: 20px" align="right">{point.y} '+unit+'</span>';
        	}
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
						plotShadow: true,
						type: 'pie'
					},
					credits: {
						enabled: false
					},
					title: {
						text: '',
						style: {
							display: 'none'
						}
					},xAxis: {

						labels: {
			                style: {
			                    fontSize: size_of_font,
			                }
						},
						title: {
							text: xaxis_tile
						}
					},
					tooltip: {
						headerFormat: tooltipHead,
						pointFormat: toolPoint,
						// style: {
						// 	display: 'none'
						// }
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
				                enabled: true,
				                formatter: function () {
				                	//console.log(this);
				                	return '<b>'+this.key+'</b><br> จำนวน '+convert_unit(this.y)+' '+unit+' ('+(this.percentage).toFixed(2)+'% )';
				                },
				                //format: '<b>{point.name}</b><br> จำนวน {point.y} '+unit+' ({point.percentage:.1f}%)',
				                style: {
				                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
				                }
				            },
							showInLegend: show_legend,
						}
					},
					legend: {
						layout: layout,
						align: align,
						verticalAlign: verticalAlign,
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
							format: '<span style="font-size: 20px">{point.name}</span><br><span style="font-size: 14px">{point.y:,.f} '+unit+'</span>',
							//formatter: function() {
							//	return  Highcharts.numberFormat(this.y, 2, '.');
							//}
						},
						data: payload.series
					}],
					exporting: {
				        chartOptions: {
				            plotOptions: {
				                series: {
				                    dataLabels: {
				                        enabled: true
				                    }
				                }
				            }
				        }
				    }
				});
			}

		}else if(payload.chart_type=='ch2'){
			var stacking_status = false;
			var share = true;
			if(typeof payload.chart_share  !== 'undefined' ){
				if(payload.chart_share == 'false'){
					share = false;
				}
			}
			toolPoint = '<span style="font-size: 17px" align="right">{series.name} {point.y} '+unit+'</span><br/>';
			if(typeof payload.tooltip !== 'undefined'){
        		tooltipHead = (typeof payload.tooltip.headerFormat  !== 'undefined' )?payload.tooltip.headerFormat:'<span style="font-size: 14px">{point.key}</span><br>';
        		toolPoint = (typeof payload.tooltip.pointFormat !== 'undefined' )?payload.tooltip.pointFormat:'<span style="font-size: 20px" align="right">{point.y} '+unit+'</span><br/>';
        	}
        	var data_label = true;
			if(payload.chart_sub_type != ''){
				stacking_status = 'normal';
				data_label = false;
			}
			//console.log(stacking_status);
			if(widget.find('#'+param).length > 0){
				$(widget.find('#'+param)).highcharts({
					chart: {
						type: 'column'
					},
					credits: {
						enabled: false
					},
					title: {
						text: ''
					},
					subtitle: {
						text: ''
					},
					xAxis: {
						categories: payload.chart_cate,
						crosshair: true,
						labels: {
			                style: {
			                    fontSize: size_of_font,
			                }

						},
						title: {
							text: xaxis_tile
						}
					},
					yAxis: {
						min: 0,
						allowDecimals: false,
						title: {
							text: unit
						},
			            stackLabels: {
			                enabled: true,
			                style: {
			                    fontWeight: 'bold',
			                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
			                }
			            }
					},
					tooltip: {
						headerFormat: tooltipHead,
						pointFormat: toolPoint,
						shared: share
						//useHTML: true
					},
					plotOptions: {
						column: {
							stacking: stacking_status,
							pointPadding: 0.2,
							borderWidth: 0,
							dataLabels: {
			                    enabled: data_label,
			                    //rotation: -70,
			                    formatter: function () {
			                    	if(typeof payload.chart_no_k == 'undefined' || payload.chart_no_k == false){
				                    	if(this.y > 9999){
					                    	if(this.y > 999999){
						                    	var num_m = this.y / 1000000
									            return  num_m.toFixed(2) + 'M';
									        }else{
									        	var num_m = this.y / 1000
									            return  num_m.toFixed(2) + 'K';
									        }
									    }else{
									    	return  this.y;
									    }
									}else{
										return this.y.toFixed(0).replace(/./g, function(c, i, a) {
									        return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
									    });
										//return  this.y;
									}
						        }
			                }
						}
					},
					legend: {
						layout: layout,
						align: align,
						verticalAlign: verticalAlign,
						floating: false,
						backgroundColor: '#FFFFFF',
					},
					series: payload.series,
					exporting: {
				        chartOptions: {
				            plotOptions: {
				                series: {
				                    dataLabels: {
				                        enabled: true
				                    }
				                }
				            }
				        }
				    }
				}); //end hgc
			} //end param > 0
		}else if(payload.chart_type=='ch3'){
			var stacking_status = false;
			
			if(payload.chart_sub_type != ''){
				stacking_status = 'normal';
			}
			toolPoint = '<span style="font-size: 17px" align="right">{series.name} {point.y} '+unit+'</span><br/>';
			if(typeof payload.tooltip !== 'undefined'){

        		tooltipHead = (typeof payload.tooltip.headerFormat  !== 'undefined' )?payload.tooltip.headerFormat:'<span style="font-size: 14px">{point.key}</span><br>';
        		toolPoint = (typeof payload.tooltip.pointFormat !== 'undefined' )?payload.tooltip.pointFormat:'<span style="font-size: 20px" align="right">จำนวน {point.y} '+unit+'</span><br/>';
        	}
			//console.log(stacking_status);
			if(widget.find('#'+param).length > 0){
				$(widget.find('#'+param)).highcharts({
					
					credits: {
						enabled: false
					},
					title: {
						text: ''
					},
					subtitle: {
						text: ''
					},
					xAxis: {
						categories: payload.chart_cate,
						crosshair: true,
						labels: {
			                style: {
			                    fontSize: size_of_font,
			                }

						},
						title: {
							text: xaxis_tile
						}

					},
					yAxis: {
						min: 0,
						title: {
							text: unit
						}
					},
					tooltip: {
						headerFormat: tooltipHead,
						pointFormat: toolPoint,
						shared: true,
						useHTML: true
					},
					plotOptions: {
						line: {
							allowPointSelect: true
						},
						series: {
				            dataLabels: {
				                enabled: true,
				                overflow: 'none'
				            }
				        }
					},
					legend: {
						layout: layout,
						align: align,
						verticalAlign: verticalAlign,
						floating: false,
						backgroundColor: '#FFFFFF',
					},
					series: payload.series,
					exporting: {
				        chartOptions: {
				            plotOptions: {
				                series: {
				                    dataLabels: {
				                        enabled: true
				                    }
				                }
				            }
				        }
				    }
				}); //end hgc
				console.log('hrr');
			} //end param > 0
		}else if(payload.chart_type=='ch4'){
			if(typeof payload.tooltip !== 'undefined'){

        		tooltipHead = (typeof payload.tooltip.headerFormat  !== 'undefined' )?payload.tooltip.headerFormat:'<span style="font-size: 14px">{point.key}</span><br>';
        		toolPoint = (typeof payload.tooltip.pointFormat !== 'undefined' )?payload.tooltip.pointFormat:'<span style="font-size: 20px" align="right">{point.y} '+unit+'</span>';
        	}
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
				var ttemp = [
				                ['Firefox',   10.38],
				                ['IE',       56.33],
				                ['Chrome', 24.03],
				                ['Safari',    4.77],
				                ['Opera',     0.91]
				            ];
				console.log(ttemp);
				console.log(payload.series);
				// Build the chart
				$(widget.find('#'+param)).highcharts({
					chart: {
			            plotBackgroundColor: null,
			            plotBorderWidth: 0,
			            plotShadow: false,
			            type: 'pie'
			        },
					title: {
						text: '',
						style: {
							display: 'none'
						}
					},xAxis: {

						labels: {
			                style: {
			                    fontSize: size_of_font,
			                }
						},
						title: {
							text: xaxis_tile
						}
					},
					tooltip: {
						headerFormat: tooltipHead,
						pointFormat: toolPoint,
						// style: {
						// 	display: 'none'
						// }
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
				                enabled: true,
				                formatter: function () {
				                	
				                	return '<b>'+this.key+'</b><br> จำนวน '+convert_unit(this.y)+' '+unit+' ('+(this.percentage).toFixed(2)+' %)';
				                },
				                //format: '<b>{point.name}</b><br> จำนวน {point.y} '+unit+' ({point.percentage:.1f}%)',
				                style: {
				                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
				                }
				            },
							showInLegend: show_legend,
							startAngle: -90,
			                endAngle: 270,
			                center: ['50%', '50%']
						}
					},
					credits: {
						enabled: false
					},
					legend: {
						layout: layout,
						align: align,
						verticalAlign: verticalAlign,
						floating: false,
						backgroundColor: '#FFFFFF',
					},
					series: [{
						name: 'Browser share',
            			innerSize: '50%',
						data: payload.series//ttemp
					}],
					exporting: {
				        chartOptions: {
				            plotOptions: {
				                series: {
				                    dataLabels: {
				                        enabled: true
				                    }
				                }
				            }
				        }
				    }
				});

			}
		}else if(payload.chart_type=='ea-pie'){
			if(widget.find('#'+param).length > 0){
				console.log('.easypiechart#'+param);
				try {
		            $(widget.find('.easypiechart#'+param)).easyPieChart({
		                barColor: payload.barColor,
		                trackColor: payload.trackColor,
		                scaleColor: payload.scaleColor,
		                scaleLength: payload.scaleLength,
		                lineCap: payload.lineCap,
		                lineWidth: payload.lineWidth,
		                size: payload.size,
		                onStep: function(from, to, percent) {
		                    $(this.el).find('.percent-non').css('width',payload.size+'px');
		                    $(this.el).find('.percent-non').css('line-height',payload.size+'px');
		                    $(this.el).find('.percent-non').text(payload.percent);
		                }
		            });
		        } catch(e) {console.log(e);}
			}
		}else if(payload.chart_type=='eqs_sp1'){
			if(widget.find('#'+param).length > 0){
					if(typeof DataTableModal1 !== 'undefined'){
						//$('#modal_datatable_all_tools_of_year').dataTable().fnClearTable();
						//$('#modal_datatable_all_tools_of_year').dataTable().fnDestroy();
					}else{
						DataTableModal1 = $('#modal_datatable_all_tools_of_year').dataTable({
							"columnDefs": [
							      { "'word-break": "break-all" , "targets" : 6 }
							    ],
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
					}
					$('#DataTable2 .dataTables_filter input').attr('placeholder','ค้นหา...');
					//DOM Manipulation to move datatable elements integrate to panel
					$('#DataTable2 .panel-ctrls').append($('#DataTable2 .dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
					$('#DataTable2 .panel-ctrls').append($('#DataTable2 .dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");
					$('#DataTable2 .panel-footer').append($("#DataTable2 .dataTable+.row"));
					$('#DataTable2 .dataTables_info').parent().attr("class","col-sm-5");
					$('#DataTable2 .dataTables_paginate').parent().attr("class","col-sm-7");
					$('#DataTable2 .dataTables_paginate>ul.pagination').addClass("pull-right m-n btn-xs");

					var dataModal1 = {};
					dataModal1['dm'+index_the_great] = payload.series.dataModal1;
					var xss = index_the_great;


			      //cat = payload.chart_cate;
			      data = payload.series.data;
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
			              //categories: cat,
			              title: {
			                  text: chart_x_title,
			                  align: 'high'
			              },
		                  labels:
		                        {
		                            enabled: false
		                        }
			          },
			          yAxis: {
			              min: 0,
			              title: {
			                  text: chart_y_title,
			                  align: 'high'
			              }
			          },
			          tooltip: {
						  headerFormat : '<span style="font-size: 12px"><strong>ประเภทครุภัณฑ์</strong></span><br/>',
						  valueSuffix: " "+"หน่วย"                
					  },
			          plotOptions: {
						column: {
						  dataLabels: {
							  enabled: true,
							  color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'black'
						  },
						  events : {
							click : function(){
								var temp_current = this;
								var category = this.name;
								$('#modal_all_tools_of_year #DataTable2 .panel-heading h2').text('รายงานครุภัณฑ์ประเภท'+ category +'ทั้งหมด');
								$('#modal_all_tools_of_year .modal-title').html('<strong>รายงานครุภัณฑ์ประเภท'+ category +'ทั้งหมด</strong>');
								$(widget).append('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
								$.when( $('#modal_all_tools_of_year').modal() ).done(function( ) {
								  process_data(temp_current, dataModal1['dm'+xss], DataTableModal1);
								});
								
								
								$(widget).find('.panel-loading').remove();
								
								//$('#modal_all_tools_of_year').modal();
							},
                        	mouseOver: function () {
                        		$('body').css('cursor','pointer');
                        	},
                        	mouseOut: function () {
                        		$('body').css('cursor','default');
                        	}
						}
						}
			              
					  },
					  legend: {
						enabled: true,
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom',
						floating: false
					  },
					  credits: {
						  enabled: false
					  },
			  			series: data,
			  			exporting: {
					        chartOptions: {
					            plotOptions: {
					                series: {
					                    dataLabels: {
					                        enabled: true
					                    }
					                }
					            }
					        }
					    }
			      }); //end hgc
			} //end param > 0
		}else if(payload.chart_type=='ch_tbz'){
			if(typeof payload.tooltip !== 'undefined'){

        		tooltipHead = (typeof payload.tooltip.headerFormat  !== 'undefined' )?payload.tooltip.headerFormat:'<span style="font-size: 14px">{series.name}</span><br>';
        		toolPoint = (typeof payload.tooltip.pointFormat !== 'undefined' )?payload.tooltip.pointFormat:'<span style="font-size: 20px" align="right">จำนวน {point.y} '+unit+'</span>';
        	}else{
        		tooltipHead = '<span style="font-size: 14px">ประเภท{series.name}</span><br>';
        	}
			if(widget.find('#'+param).length > 0){
				//$('#modal_datatable_zoom > thead').find('tr').html(html_txt);
				//console.log($('#modal_datatable_zoom > tbody').find('tr').html());
			
					var tb_name = payload.series.chart_cate_label;
					var dataModalZoom = {};
					dataModalZoom['dm'+index_the_great] = payload.series.dataModel;
					var tb_head = {};
					tb_head['dm'+index_the_great] = payload.series.table_head;
					var lss = index_the_great;


			      //cat = payload.chart_cate;
			      data = payload.series.data;
			      chart_title = "";
			      //chart_x_title = "ประเภทครุภัณฑ์";
			      chart_y_title = "จำนวน";
			      
			      var ex = $(widget.find('#'+param)).highcharts({
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
			              //categories: cat,
			              title: {
			                  text: xaxis_tile,
			                  align: 'high'
			              },
		                  labels:
		                        {
		                            enabled: false
		                        }
			          },
			          yAxis: {
			              min: 0,
			              title: {
			                  text: unit,
			                  align: 'high'
			              }
			          },
			          tooltip: {
							headerFormat: tooltipHead,
							pointFormat: toolPoint,
							shared: share
							//useHTML: true
						},
			          plotOptions: {
						column: {
						  dataLabels: {
							  enabled: true,
							  color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'black'
						  },
						  events : {
							click : function(){
								
								var temp_current = this;
								console.log(temp_current);
								var category = this.name;
								if(typeof dataModel !== 'undefined'){
									dataModel.dataTable().fnDestroy();
								}
								var tb_h = ''; var tb_b = '';
								$.each(tb_head['dm'+lss],function(index,val){
									tb_h += '<th>'+val+'</th>';
									tb_b += '<th>'+val+'</th>';
								});
								$('#modal_datatable_zoom > thead').find('tr').html(tb_h);
								$('#modal_datatable_zoom > tbody').find('tr').html(tb_b);
								dataModel = $('#modal_datatable_zoom').dataTable({
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
								$('#table_zoom_place .dataTables_filter input').attr('placeholder','ค้นหา...');
								//DOM Manipulation to move datatable elements integrate to panel
								// $('#table_zoom_place .panel-ctrls').append($('#table_zoom_place .dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
								// $('#table_zoom_place .panel-ctrls').append($('#table_zoom_place .dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");
								// $('#table_zoom_place .panel-footer').append($("#table_zoom_place .dataTable+.row"));
								// $('#table_zoom_place .dataTables_info').parent().attr("class","col-sm-5");
								// $('#table_zoom_place .dataTables_paginate').parent().attr("class","col-sm-7");
								// $('#table_zoom_place .dataTables_paginate>ul.pagination').addClass("pull-right m-n btn-xs");
								if(tb_name === undefined || tb_name === null){
									
									$('#modal_table_zoom #table_zoom_place .panel-heading h2').text('');
									$('#modal_table_zoom .modal-title').html('<strong></strong>');
								}else{
									// $('#modal_table_zoom #table_zoom_place .panel-heading h2').text(tb_name[temp_current.index]);
									$('#modal_table_zoom .modal-title').html('<strong>'+ tb_name[temp_current.index] +'</strong>');
								}
								
								$(widget).append('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
								num = tb_head['dm'+lss].length;
								$.when( $('#modal_table_zoom').modal() ).done(function( ) {
								  process_data2(temp_current, dataModalZoom['dm'+lss], dataModel,num);
								});
								
								
								$(widget).find('.panel-loading').remove();
								
								//$('#modal_all_tools_of_year').modal();
							},
                        	mouseOver: function () {
                        		$('body').css('cursor','pointer');
                        	},
                        	mouseOut: function () {
                        		$('body').css('cursor','default');
                        	}
						}
						}
			              
					  },
					  legend: {
						enabled: true,
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom',
						floating: false
					  },
					  credits: {
						  enabled: false
					  },
			  series: data,
					  exporting: {
		        chartOptions: {
		            plotOptions: {
		                series: {
		                    dataLabels: {
		                        enabled: true
		                    }
		                }
		            }
		        }
		    }
			      }); //end hgc
			} //end param > 0
		}else if(payload.chart_type=='hr_countNurse'){
			if(widget.find('#'+param).length > 0){
				var data_m = [];
				var data_sub = [];
				var data_sub_sub = [];
				$.each(payload.series, function(index, val){
					var drill = '';
					if(typeof val.child != 'undefined' && val.child != '' && typeof val.id != 'undefined' && typeof val.id != ''){
						drill = val.id;
						data_sub_sub = [];
						$.each(val.child, function(cdex, cval){
							data_sub_sub.push({
								name: cval.name,
								y: cval.y,
								color: cval.color
							})
						});
					}

					data_m.push({
						name: val.name,
						y: val.y,
						color: val.color,
						drilldown: drill
					});



					data_sub.push({
						name: val.name,
						id: drill,
						data: data_sub_sub
					});

				});
				$(widget.find('#'+param)).highcharts({
			        chart: {
			            type: 'pie'
			        },
			        title: false,
			        plotOptions: {
			            series: {
			                dataLabels: {
			                    enabled: true,
			                    format: '{point.name}: {point.y} คน'
			                }
			            }
			        },
			        xAxis: {
						labels: {
			                style: {
			                    fontSize: size_of_font,
			                }
						}
					},
			        tooltip: {
			            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			            pointFormat: '<span style="color:{point.color}">{point.name} <br>จำนวน</span>: <b>{point.y} คน</b><br/>คิดเป็น: <b>{point.percentage:.2f} %</b><br/>'
			        },
					credits: {
						enabled: false
					},
			        series: [{
			            name: 'อาจารย์พยาบาลประจำ',
			            colorByPoint: true,
			            data: data_m
			        }],
			        drilldown: {
			            series: data_sub
			        },
			        exporting: {
				        chartOptions: {
				            plotOptions: {
				                series: {
				                    dataLabels: {
				                        enabled: true
				                    }
				                }
				            }
				        }
				    }
			    });
			} //end param > 0
		}else if(payload.chart_type == 'acd_sp1' || payload.chart_type == 'ma_sp1'){

			toolPoint = '<span style="font-size: 17px" align="right">จำนวน {point.y} '+unit+'</span><br/>';
			if(typeof payload.tooltip !== 'undefined'){
        		tooltipHead = (typeof payload.tooltip.headerFormat  !== 'undefined' )?payload.tooltip.headerFormat:'<span style="font-size: 14px">{point.key}</span><br>';
        		toolPoint = (typeof payload.tooltip.pointFormat !== 'undefined' )?payload.tooltip.pointFormat:'<span style="font-size: 20px" align="right">{point.y} '+unit+'</span><br/>';
        	}

			var data_m = [];
			var data_sub = [];
			var data_sub_sub = [];
			$.each(payload.series, function(index, val){
				var drill = '';

				if(typeof val.child != 'undefined' && val.child != '' && typeof val.id != 'undefined' && typeof val.id != ''){
					data_sub_sub = [];
					drill = val.id;
					$.each(val.child, function(cdex, cval){
						data_sub_sub.push({
							name: cval.name,
							y: cval.y,
							color: cval.color
						})
					});
				}
				data_sub.push({
					name: val.name,
					id: val.id,
					data: data_sub_sub
				});

				data_m.push({
					name: val.name,
					y: val.y,
					color: val.color,
					drilldown: drill
				});

			});
			$(widget.find('#'+param)).highcharts({
				chart: {
					type: 'column',
					backgroundColor: '#FFFFFF',
					borderWidth: 1,
					borderColor: '#CDBE70',
					plotShadow: false
				},
				credits: {
					enabled: false
				},
				title: {
					margin: 50,
					text: ''
				},
				xAxis: {
					type: 'category',
					title: {
						text: payload.chart_x_name+' (พ.ศ.)'
					},
					labels: {
			            style: {
			                fontSize: size_of_font,
			               }
					}
				},
				yAxis: {
					min: 0,
					title: {
						text: unit
					},
					plotLines: [{
						value: 0,
						width: 1,
						color: '#808080'
					}]
				},
				legend: {
					enabled: false
				},
				tooltip: {
					headerFormat: tooltipHead,
					pointFormat: toolPoint,
					shared: share
					//useHTML: true
				},
				plotOptions: {
					column: {
						//pointPadding: 0.2,
						borderWidth: 0,
						dataLabels: {
							enabled: true,
							rotation: 0,
							color: '#000000',
							align: 'center',
							y: -5,
							style: {
								fontSize: '13px',
								fontFamily: 'Verdana, sans-serif'
							},
							formatter: function () {
			                	if(this.y > 999){
				                	if(this.y > 999999){
					                	var num_m = this.y / 1000000
							            return  num_m.toFixed(2) + 'M';
							        }else{
							        	var num_m = this.y / 1000
							            return  num_m.toFixed(2) + 'K';
							        }
							    }else{
							    	return  this.y;
							    }
						    }
						}
					}
				},
				series: [{
					name: '',
					data: data_m
				}],
				drilldown: {
					series: data_sub
				},
				navigation: {
					buttonOptions: {
						enabled: false
					}
				},
				exporting: {
			        chartOptions: {
			            plotOptions: {
			                series: {
			                    dataLabels: {
			                        enabled: true
			                    }
			                }
			            }
			        }
			    }
			});
		}else if(payload.chart_type=='ch_drill'){
			if(typeof payload.tooltip !== 'undefined'){
        		tooltipHead = (typeof payload.tooltip.headerFormat  !== 'undefined' )?payload.tooltip.headerFormat:'<span style="font-size: 14px">{point.key}</span><br>';
        		toolPoint = (typeof payload.tooltip.pointFormat !== 'undefined' )?payload.tooltip.pointFormat:'<span style="font-size: 20px" align="right">{point.y} '+unit+'</span>';
        	}
        	/*else{
        		toolPoint = '<span style="color:{point.color}">{point.name} <br>จำนวน</span>: <b>{point.y} '+unit+'</b><br/>คิดเป็น: <b>{point.percentage:.2f} %</b><br/>';
        	}*/
			if(widget.find('#'+param).length > 0){
				var data_m = [];
				var data_sub = [];
				var data_sub_sub = [];
				$.each(payload.series, function(index, val){
					var drill = '';
					if(typeof val.child != 'undefined' && val.child != '' && typeof val.id != 'undefined' && typeof val.id != ''){
						drill = val.id;
						data_sub_sub = [];
						$.each(val.child, function(cdex, cval){
							data_sub_sub.push({
								name: cval.name,
								y: cval.y,
								color: cval.color,
								amount: cval.amount
							})
						});
					}

					data_m.push({
						name: val.name,
						y: val.y,
						color: val.color,
						drilldown: drill,
						amount: val.amount
					});



					data_sub.push({
						name: val.name,
						id: drill,
						data: data_sub_sub
					});

				});
				$(widget.find('#'+param)).highcharts({
			        chart: {
			            type: 'pie'
			        },
			        title: false,
			        plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: true,
								//distance: 0
							},
							showInLegend: show_legend,
						}
					},
					lang: {
						drillUpText: 'กลับ'
					},
			        xAxis: {
			        	categories: payload.chart_cate,
						labels: {
			                style: {
			                    fontSize: size_of_font,
			                }
						},title: {
							text: xaxis_tile
						}
					},
			        tooltip: {
			            headerFormat: tooltipHead,
			            pointFormat: toolPoint
			        },
					credits: {
						enabled: false
					},
			        series: [{
			            name: '',
			            colorByPoint: true,
			            dataLabels: {
							enabled: true,
							format: '<span style="font-size: 20px">{point.name}</span><br><span style="font-size: 14px">{point.y:,.f}'+unit+'</span>',
						},
			            data: data_m
			        }],
			        drilldown: {
			            series: data_sub
			        },
			        exporting: {
				        chartOptions: {
				            plotOptions: {
				                series: {
				                    dataLabels: {
				                        enabled: true
				                    }
				                }
				            }
				        }
				    }
			    });
			} //end param > 0
		}else if(payload.chart_type=='rs_sp1'){
			var stacking_status = false;

			if(widget.find('#'+param).length > 0){

				var colors = Highcharts.getOptions().colors;
				var series = [];
				categories = [];
				console.log(colors);
				tooltipHead = '<span style="font-size: 18px">'+payload.chart_x_name+' พ.ศ.{point.key}</span><br>';
        		//toolPoint = '<span style="font-size: 16px;color:{point.color};"><span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y} ({point.percentage}%)</b></span><br/>';				
        		toolPoint = '<span style="font-size: 16px;color:{point.color};"><span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y}</b></span><br/>';				

				$.each(payload.series, function(index, val){
					var sub_data = [];
					$.each(val.child, function(index2, val2){
						if(index == 0){
							categories.push(val2.subyear);
						}
			
						sub_data.push({subname: val.name,
										subyear: val2.subyear,
										y: val2.y,
										percentage: val2.percentage,
										color: colors[index],
										//dtail: '<table border="0" width="200px;" ><tr><td nowrap colspan="6"><b>'+payload.chart_x_name+'&nbsp;พ.ศ.&nbsp;'+val2.subyear+'</b></td></tr><tr><td nowrap style="color:#4572A7;"><b>'+val.name+'&nbsp;&nbsp;&nbsp;</b></td><td nowrap style="color:#4572A7;"><b>&nbsp;จำนวน</b></td><td nowrap style="text-align:right;color:#4572A7;"><b>&nbsp;'+val2.y+'</b></td><td nowrap style="color:#4572A7;"><b>&nbsp;รายการ</b></td><td colspan="2" >&nbsp;</td></tr></table>',
										param: val2.param});

					});
					series.push({name: val.name,
									data: sub_data,
									color: colors[index] });
				});

				html_sp = '<div class="col-md-6" id="tb_for'+index_the_great+'" style="display:none">'+
							'<div class="panel  panel panel-blue" data-widget=\'{"draggable": "false"}\'>'+
								'<div class="panel-heading"  style="background-color:;" >'+
									'<h2><span id="dwn2_title"></span></h2>'+
									'<div class="panel-ctrls" data-actions-container="" data-action-collapse=\'{"target": ".panel-body"}\'></div>'+
								'</div>'+
								'<div class="panel-body scroll-pane" style="height: 450px;">'+
									'<div class="scroll-content">'+
									'</div>'+
								'</div>'+
							'</div>';

				$(widget).closest('.panel-body.my-content.sortable').append(html_sp);
				//index_the_great++;
				$(widget.find('#'+param)).highcharts({
					chart: {
						renderTo: 'container1',
						/*width: 200,
						height: 200,*/
						type: 'column',
						backgroundColor: '#FFFFFF',
						borderWidth: 1,
						borderColor: '#CDBE70',
						plotShadow: false
					},
					credits: {
						enabled: false
					},
					title: {
						margin: 10,
						text: ''
					},
					xAxis: {
						categories: categories,
						title: {
							text: payload.chart_x_name+' (พ.ศ.)'
						},
						labels: {
			                style: {
			                    fontSize: size_of_font,
			                }
						}
					},
					yAxis: {
						min: 0,
						maxPadding: 0.3,
						title: {
							text: 'จำนวนผลงานวิจัย (รายการ)'
						}
					},
					tooltip: {
						headerFormat: tooltipHead,
						pointFormat: toolPoint,
						footerFormat: '',
						shadow: false,
						shared: true,
						useHTML: true
					},
					plotOptions: {
						column: {
							pointPadding: 0.2,
							borderWidth: 0,
							dataLabels: {
								enabled: true,
								rotation: 0,
								color: '#000000',
								align: 'center',
								y: -5,
								style: {
									fontSize: '13px',
									fontFamily: 'Verdana, sans-serif'
								},
								formatter: function() {
									if (this.y > 0){
										return this.y;
									}
								}
							}
						},
			            series: {
			                cursor: 'pointer',
			                point: {
			                    events: {
			                        click: function () {
			                        	if(payload.chart_table_link != ''){
			                        	var head=this.subname + ' ('+payload.chart_x_name+' ' + this.subyear + ')';
			                        	var param=this.param;
			                        	var path = payload.chart_table_link;
			                        	 //var widget = $(this).closest('[data-widget]');
								        $.post( is_switch(path)  , { path:path , title:head, param:param, curId:flag })
								        .done(function (data) {
											$.when(draw_card(data)).done(function (arg1){
												var widget_area = $(widget).closest('.panel-body.my-content.sortable');
												widget.find('.panel-loading').remove();
												//var widget_area = widget.find('.panel-body').closest('.panel-body');
												widget_area.find('#dwnxx2').remove();
												widget_area.append(arg1.html_text);
												widget_area.find('.dataTable').dataTable();
												$(".panel").css('visibility', 'visible');
												$(".table").css('visibility', 'visible');
												$(".info-tile").css('visibility', 'visible');
											});
								        }).fail(function(){
								        	alert("error");
								        });
								    	}
			                        }
			                    }
			                }
			            }
					},
					series: series,
					navigation: {
						buttonOptions: {
							enabled: false
						}
					},
					exporting: {
				        chartOptions: {
				            plotOptions: {
				                series: {
				                    dataLabels: {
				                        enabled: true
				                    }
				                }
				            }
				        }
				    }
				});
			} //end param > 0
		}else if(payload.chart_type=='ch_modal'){
			var stacking_status = false;

			if(widget.find('#'+param).length > 0){

				var colors = Highcharts.getOptions().colors;
				var series = [];
				categories = [];
				console.log(colors);
				tooltipHead = '<span style="font-size: 18px">'+payload.chart_x_name+' {point.key}</span><br>';
        		//toolPoint = '<span style="font-size: 16px;color:{point.color};"><span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y} ({point.percentage}%)</b></span><br/>';				
        		toolPoint = '<span style="font-size: 16px;color:{point.color};"><span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y}</b></span><br/>';				

				$.each(payload.series, function(index, val){
					var sub_data = [];
					$.each(val.child, function(index2, val2){
						if(index == 0){
							categories.push(val2.subyear);
						}
			
						sub_data.push({subname: val.name,
										subyear: val2.subyear,
										y: val2.y,
										percentage: val2.percentage,
										color: colors[index],
										//dtail: '<table border="0" width="200px;" ><tr><td nowrap colspan="6"><b>'+payload.chart_x_name+'&nbsp;พ.ศ.&nbsp;'+val2.subyear+'</b></td></tr><tr><td nowrap style="color:#4572A7;"><b>'+val.name+'&nbsp;&nbsp;&nbsp;</b></td><td nowrap style="color:#4572A7;"><b>&nbsp;จำนวน</b></td><td nowrap style="text-align:right;color:#4572A7;"><b>&nbsp;'+val2.y+'</b></td><td nowrap style="color:#4572A7;"><b>&nbsp;รายการ</b></td><td colspan="2" >&nbsp;</td></tr></table>',
										param: val2.param});

					});
					series.push({name: val.name,
									data: sub_data,
									color: colors[index] });
				});

				html_sp = '<div class="col-md-6" id="tb_for'+index_the_great+'" style="display:none">'+
							'<div class="panel  panel panel-blue" data-widget=\'{"draggable": "false"}\'>'+
								'<div class="panel-heading"  style="background-color:;" >'+
									'<h2><span id="dwn2_title"></span></h2>'+
									'<div class="panel-ctrls" data-actions-container="" data-action-collapse=\'{"target": ".panel-body"}\'></div>'+
								'</div>'+
								'<div class="panel-body scroll-pane" style="height: 450px;">'+
									'<div class="scroll-content">'+
									'</div>'+
								'</div>'+
							'</div>';

				$(widget).closest('.panel-body.my-content.sortable').append(html_sp);
				//index_the_great++;
				$(widget.find('#'+param)).highcharts({
					chart: {
						renderTo: 'container1',
						/*width: 200,
						height: 200,*/
						type: 'column',
						backgroundColor: '#FFFFFF',
						borderWidth: 1,
						borderColor: '#CDBE70',
						plotShadow: false
					},
					credits: {
						enabled: false
					},
					title: {
						margin: 10,
						text: ''
					},
					xAxis: {
						categories: categories,
						title: {
							text: payload.chart_x_name+' (พ.ศ.)'
						},
						labels: {
			                style: {
			                    fontSize: size_of_font,
			                }
						}
					},
					yAxis: {
						min: 0,
						maxPadding: 0.3,
						title: {
							text: 'จำนวนผลงานวิจัย (รายการ)'
						}
					},
					tooltip: {
						headerFormat: tooltipHead,
						pointFormat: toolPoint,
						footerFormat: '',
						shadow: false,
						shared: true,
						useHTML: true
					},
					plotOptions: {
						column: {
							pointPadding: 0.2,
							borderWidth: 0,
							dataLabels: {
								enabled: true,
								rotation: 0,
								color: '#000000',
								align: 'center',
								y: -5,
								style: {
									fontSize: '13px',
									fontFamily: 'Verdana, sans-serif'
								},
								formatter: function() {
									if (this.y > 0){
										return this.y;
									}
								}
							}
						},
			            series: {
			                cursor: 'pointer',
			                point: {
			                    events: {
			                        click: function () {
			                        	if(payload.chart_table_link != ''){
				                        	var head=this.subname + ' ('+payload.chart_x_name+' ' + this.subyear + ')';
				                        	var param=this.param;
				                        	var path = payload.chart_table_link;
				                        	 //var widget = $(this).closest('[data-widget]');
									        $.post( is_switch(path)  , { path:path , param:param, curId:flag })
									        .done(function (data) {
												
									        }).fail(function(){
									        	alert("error");
									        });

									        file_name = ($(this).attr('expand-path')===undefined)?'test.html':$(this).attr('expand-path');
											var temp = $($(this).parent().find('.tile-heading')).text();
											var h_title = head;
											if(h_title != '') temp = h_title;
											$('#myModal').find('.modal-dialog').css({'width':'100%'});
											$('#myModal').find('.modal-body').html('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
											$('#myModal').find('.modal-body').css('min-height', '300px');
											if(payload.chart_modal_iframe != 1){
												$.post(path, {param:param} ,function(data) {
													$('#myModal').find('.modal-title').html(temp);
													$('#myModal').find('.modal-body').html(data);
												});
											}else{
												var H = window.innerHeight*0.73;
												var frame = '<form id="open_frame" action="'+path+'" method="post" target="framdal"><input type="hidden" name="param" value="'+param+'" /></form>';
													frame += '<iframe style="width:100%;height:'+H+'px;" name="framdal" class="framdal" frameBorder="0" src=""></iframe>';
													//$('#myModal').find('.modal-body').empty();
													$('#myModal').find('.modal-body').html(frame);
													$('#open_frame').submit();
													$('#myModal').find('.modal-title').html(temp);

													$('.modal-footer').append('<button style="float:left" type="button" class="btn btn-midnightblue-alt frame_back" id="frame_back">กลับ</button>');
											}
											$('#myModal').find('.panel-loading').fadeOut(300, function() { $(this).remove(); });
											$('#myModal').modal();
											event.preventDefault();
								    	}
			                        }
			                    }
			                }
			            }
					},
					series: series,
					navigation: {
						buttonOptions: {
							enabled: false
						}
					},
					exporting: {
				        chartOptions: {
				            plotOptions: {
				                series: {
				                    dataLabels: {
				                        enabled: true
				                    }
				                }
				            }
				        }
				    }
				});
			} //end param > 0
		}else if(payload.chart_type=='hr_sp1'){
			if(widget.find('#'+param).length > 0){
				var data_nurse_fail = payload.series.da_nurse_f;
				var data_nurse_pass = payload.series.da_nurse_p;
				var data_sup_fail = payload.series.da_sup_f;
				var data_sup_pass = payload.series.da_sup_p;
				var data_nurse_hour = payload.series.nurse_hour;
				var data_sup_hour = payload.series.sup_hour;
				var data_nurse_count = payload.series.nurse_count;
				var data_sup_count = payload.series.sup_count;
				var yearnow = payload.year_now;
				$(widget.find('#'+param)).highcharts({
			        chart: {
			            type: 'column'
			        },

			        title: false,

			        xAxis: {
			            categories: [(yearnow - 3),(yearnow - 2), (yearnow -1), yearnow]
			        },

			        yAxis: {
			            allowDecimals: false,
			            min: 0,
			            title: {
			                text: 'จำนวน (คน)'
			            },
						stackLabels: {
			                enabled: true,
			                style: {
			                    fontWeight: 'bold',
			                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
			                }
						}
			        },

			        tooltip: {
			            formatter: function () {
			                var str = '<b>' + this.x + '</b><br/>' +
			                    this.series.name + ': ' + this.y + '<br/>' +
			                    'รวม: ' + this.point.stackTotal;
							if(this.y>0 && (typeof this.point.list != "undefined" && this.point.list != null)){
								str += '<br><b>ประกอบด้วย<br>' + this.point.list + '</b>';
							}
							return str;
			            }
			        },

			        plotOptions: {
			            column: {
			                stacking: 'normal',
							dataLabels: {
			                    enabled: true,
			                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'black',
			                    style: {
			                        textShadow: '0 0 3px white'
			                    }
			                },
							cursor: 'pointer',
							point: {
								events: {
									click: function() {
										function get_str (year, name,count) //ใช้สำหรับกดแล้วแสดงชื่อคนที่ไม่ผ่านการพัฒนา
										{

											for(i=0;i<=3;i++)
											{
												if(year == (yearnow - i) && name == "อ.พยาบาลประจำสายสอน/ไม่ผ่าน" && count== data_nurse_count[i])
												{
													str = data_nurse_hour[i];
												}
												else if(year == (yearnow - i) && name == "สายสนับสนุน/ไม่ผ่าน" && count == data_sup_count[i])
												{
													str = data_sup_hour[i];
												}
											}
											return str;
										}
										if(this.y>0 && (typeof this.list != "undefined" && this.list != null)){
											var str = "";
											str = get_str(this.category,this.series.name,this.y); //ส่วนของการกดแล้วขึ้นชื่อคนที่ไม่ผ่านการพัฒนา
											$("#myModal").find('.modal-title').html('รายชื่อบุคลากรที่ยังไม่ผ่านการพัฒนา');
											$("#myModal").find('.modal-body').attr('id','data_list');
											$("#data_list").html(str);
											$("#myModal").modal({
											  "backdrop"  : false,
											  "keyboard"  : true,
											  "show"      : true  // ensure the modal is shown immediately
											});//.draggable();
											$("#myModal").draggable({
												 handle: ".modal-header"
											});
										}
									}
								}
							},
			            },
			        },
					credits: {
						enabled: false
					},
			        series: [data_nurse_fail,data_nurse_pass,data_sup_fail,data_sup_pass],
			        exporting: {
				        chartOptions: {
				            plotOptions: {
				                series: {
				                    dataLabels: {
				                        enabled: true
				                    }
				                }
				            }
				        }
				    }
			    });
			}
		}else if(payload.chart_type=='eqs_sp2'){
			if(widget.find('#'+param).length > 0){
				//console.log("down there!");
				//console.log(payload.chart_dataTable);
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
												MyDataTable.fnAddData(temp,false);
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
													MyDataTable.fnAddData(temp,false);
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
		        credits: {
					enabled: false
				},
		        xAxis: {
					labels: {
			             style: {
			                 fontSize: size_of_font,
			             }
					}
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
		                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
		                        fontSize: size_of_font
		                    }
		                }
		            }
		        },
		        series: data,
		        exporting: {
			        chartOptions: {
			            plotOptions: {
			                series: {
			                    dataLabels: {
			                        enabled: true
			                    }
			                }
			            }
			        }
			    }
		      });

			} //else type chart
		}else if(payload.chart_type=='tabledata'){
			$('#'+param).dataTable({
				"destroy": true
			});
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
		var temp = $.parseJSON(JSON.stringify(localStorage));
		var widget_grp = page_id;
		var arr_temp = [];
		var arr = {};
		var i =0,j =0;
		$.each(temp,function(index,val){
			var grp_name = index.split(".");
			if(grp_name[0]==widget_grp){
				var widName =  grp_name[2];
				var test = {};
				(!arr[grp_name[1]])?arr[grp_name[1]]={}:'';
				arr[grp_name[1]][widName] = val;
			}
		});
		console.log(arr);
		 $.post( the_path+'/index.php/dashboard/Data_management/save_config2', {  param1: JSON.stringify(arr), grp_name: page_id }, function(data, textStatus, xhr) {

		 }).done( function(data) {
		 	alert('Save เรียบร้อย');
		 });
	});
	var load_local = function(){
		localStorage.clear();
		var widget_grp = $('#grp_name_input').val();
		if($('#data_page_id').val()!=""){
			page_id = $('#data_page_id').val();
			widget_grp = page_id;
			//alert(page_id);
		}
		$.post(the_path+'/index.php/dashboard/Data_management/load_config2', { type:'r',grp_name:page_id }, function(data, textStatus, xhr) {

		}).done( function(data) {
			try{
				var obj = JSON.parse(data);
				//var json_text = JSON.parse(pg.json_text);
				self.page_id = obj.id;
				$.each(obj.result,function(index,val){
					console.log('g');
					console.log(widget_grp+'.'+val.config_hide);
					localStorage.setItem(widget_grp+'.'+val.config_widget_name+'.draggable', 'false');
					localStorage.setItem(widget_grp+'.'+val.config_widget_name+'.headerTitle', val.link_name);
					localStorage.setItem(widget_grp+'.'+val.config_widget_name+'.selectType', val.link_path);
					localStorage.setItem(widget_grp+'.'+val.config_widget_name+'.selectParam', val.link_value);
					localStorage.setItem(widget_grp+'.'+val.config_widget_name+'.selectId', val.link_id);
					var state = (val.config_hide == '0')?false:true;
					localStorage.setItem(widget_grp+'.'+val.config_widget_name+'.hidewidget', state);
				});
				self.Mymake();
			}catch(e){
				self.Mymake();
			}
		});
	}
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
	$("body").on("click" , '#loadButton' , function(){
		load_local();
	});
	$("body").on('click', '.open_link', function(){
		var path = $(this).attr('path');
		var param = $(this).attr('param');
		openLink(path, param);
	});
	$("body").on("click",".metric_system",function(){
		event.preventDefault();
		var path = metric_path;
		var num = $(this).data('num');
		var year = $(this).data('year');
		var bid = $(this).data('bid');
		file_name = path;

		var temp = 'รายละเอียดตัวบ่งชี้และ เกณฑ์การประเมิน';
		$('#myModal').find('.modal-dialog').css({'width':'100%'});
		$('#myModal').find('.modal-body').html('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
		$('#myModal').find('.modal-body').css('min-height', '300px');

		var H = window.innerHeight*0.73;
		var frame = '<form id="open_frame" action="'+file_name+'" method="post" target="framdal">'+
						'<input type="hidden" name="num" value="'+num+'" />'+
						'<input type="hidden" name="year" value="'+year+'" />'+
						'<input type="hidden" name="bid" value="'+bid+'" />'+
					'</form>';
			frame += '<iframe style="width:100%;height:'+H+'px;" name="framdal" class="framdal" frameBorder="0" src=""></iframe>';
			//$('#myModal').find('.modal-body').empty();
		$('#myModal').find('.modal-body').html(frame);
		$('#open_frame').submit();
		$('#myModal').find('.modal-title').html(temp);

		$('.modal-footer').append('<button style="float:left" type="button" class="btn btn-midnightblue-alt frame_back" id="frame_back">กลับ</button>');

		$('#myModal').find('.panel-loading').fadeOut(300, function() { $(this).remove(); });
		$('#myModal').modal();
		event.preventDefault();
    	//window.open(path, "popupWindow", "width=500,height=500,scrollbars=yes");
	});
	var counter=0;
	load_local();
	this.make = function (settings) { }
	this.Mymake = function (settings) {
		flag = ($('#e1').val()==''?0:$('#e1').val());
		settings = settings? settings:{};

		var widgetGroups = $('[data-widget-group]').map(function() {
			return $(this).data('widget-group');
		}).get();

		var uniqueWidgetGroups = getUniques (widgetGroups);
		/*$( "body" ).on( "click", ".my-element>.tile-body" , function( event ) {

			var gp = $(this).parent().attr('custom-gp');

			$.each($("div[gp]"),function(index, el) {
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
		});*/
		
		$( "body" ).on( "click", '.expand-button-new,.expand-panel,.complex_ele', function( event ) {

			file_name = ($(this).attr('expand-path')===undefined)?'test.html':$(this).attr('expand-path');
			var parameter = $(this).data('param');
			var temp = $($(this).parent().find('.tile-heading')).text();
			var h_title = $(this).attr('header_title');
			if(h_title != '') temp = h_title;
			$('#myModal').find('.modal-dialog').css({'width':'100%'});
			$('#myModal').find('.modal-body').html('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
			$('#myModal').find('.modal-body').css('min-height', '300px');
			if($(this).attr('i_frame') != 1){
				$.post(file_name, {param:parameter} ,function(data) {
					$('#myModal').find('.modal-title').html(temp);
					$('#myModal').find('.modal-body').html(data);
				});
			}else{
				var H = window.innerHeight*0.73;
				var frame = '<form id="open_frame" action="'+file_name+'" method="post" target="framdal"><input type="hidden" name="param" value="'+parameter+'" /></form>';
					frame += '<iframe style="width:100%;height:'+H+'px;" name="framdal" class="framdal" frameBorder="0" src=""></iframe>';
					//$('#myModal').find('.modal-body').empty();
					$('#myModal').find('.modal-body').html(frame);
					$('#open_frame').submit();
					$('#myModal').find('.modal-title').html(temp);

					$('.modal-footer').append('<button style="float:left" type="button" class="btn btn-midnightblue-alt frame_back" id="frame_back">กลับ</button>');
			}
			$('#myModal').find('.panel-loading').fadeOut(300, function() { $(this).remove(); });
			$('#myModal').modal();
			event.preventDefault();
		});
		$( "body" ).on( "click", '#frame_back', function() {
			$('#open_frame').submit();
		});
		$('#myModal').on('hidden.bs.modal', function () {
		  	$('#frame_back').remove();
			$('.frame_back').remove();
		})
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
		$(document.body).on('click','.select_da_course', function(){
			var current_crs = $(this).parent().find( "#the_current_course" ).val();
			var path = $( "#tqf_link" ).val();
			//alert(current_crs);
			if(current_crs != $(this).val()){
				var place_belong = $(this).parents('.oh-the-great-card').parent();
				place_belong.empty();
				var widget = $(place_belong.parents('[data-widget]')[0]);
				widget.append('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
				$.post( is_switch(path) , { path:path , crs_id:$(this).val() , curId:flag })
		        .done(function (data) {
					//console.log(data);
					$.when(draw_card(data)).done(function (arg1){
						widget.find('.panel-loading').remove();
						place_belong.html(arg1.html_text).promise().done(function(){
							$.each(arg1.id_array,function(index,val){
								makePlot(widget.find('.panel-body'),val,arg1.grp_data[index].data);
							});
						});
						$(".panel").css('visibility', 'visible');
						$(".table").css('visibility', 'visible');
						$(".info-tile").css('visibility', 'visible');
					});
		        }).fail(function(){
		        	alert("error");
		        })
		    }
		});
		$(document.body).on('change','.re_the_great', function(){

			var select_boxs = $(this).parent().parent().find('select');
			var parameter = ''; 
			if(select_boxs.length > 1){
				$.each(select_boxs, function(index, box){
					parameter += $(box).val()+'_';
				});
				parameter = parameter.slice(0, -1);
			}else{
				var parameter = $(this).val();
			}

			var path = $(this).closest('.panel-heading').attr('regret_path');
			
			var widget = $(this).closest('[data-widget]');
			var great_card = $(this).closest('.panel').find('.the-great-card-panel');
			great_card.empty();
			great_card.append('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
			$.post( is_switch(path) , { path:path , parameter:parameter , curId:flag })
		    .done(function (data) {
				$.when(draw_card(data)).done(function (arg1){
					great_card.find('.panel-loading').remove();
					great_card.html(arg1.html_text).promise().done(function(){
						$.each(arg1.id_array,function(index,val){
							makePlot(widget.find('.panel-body'),val,arg1.grp_data[index].data);
						});
					});
					$(".panel").css('visibility', 'visible');
					$(".table").css('visibility', 'visible');
					$(".info-tile").css('visibility', 'visible');
				});
		    }).fail(function(){
		    	alert("error");
		    })
		});
		
		var cond_g = 'max';
		$("body").on('click', '.holy_sorting', function(){
			var cond = $(this).attr('cond');
			if(cond_g != cond){
				cond_g = cond;
				$.each(temp_massive_data, function(index, tab){
					$.each(tab.child, function(index_sub, tab_sub){
						tab_sub.data.reverse();
					});
				})
				var pn_size = $(this).parent().parent().attr('pn_size');
				var new_tabs = gen_holy_tab(temp_massive_data, $(this).text(), pn_size);
				var place_belong = $(this).parent().parent().parent().parent().parent().parent().parent();
				$(this).parent().parent().parent().parent().parent().parent().remove();
				place_belong.append(new_tabs);
			}
		});
		$("body").on('click', '.need_more', function(){
			console.log(temp_massive_data);
			$('#myModal').find('.modal-title').html($(this).attr('title'));

			var indexs = $(this).parents('.tab-pane').attr('id').split('-');
			var index1st = indexs[1];
			var index2nd = indexs[2];

			var row_data = temp_massive_data[index1st].child[index2nd];
			var data_table = '';
			data_table += '<table class="table table-bordered m-n" cellspacing="0" >'+
							'<tbody>';

			$.each(row_data.data, function(index, row){
				data_table += '<tr>';
				$.each(row, function(index2, cell){
					data_table += '<td ';
					if(typeof row_data.column_width[index2] != 'undefined') data_table += ' width="'+row_data.column_width[index2]+'" ';
					if(typeof cell.class != 'undefined') data_table += ' class="'+cell.class+'" ';
					if(typeof cell.align != 'undefined') data_table += ' align="'+cell.align+'" ';

					data_table += ' >'+
								cell.text+
							'</td>';
				})
				data_table += '</tr>';
			});
			data_table += '</tbody>'+
						'</table>';

			$('#myModal').find('.modal-body').html(data_table);
			$('#myModal').modal('show');
			$('#myModal').find('.panel-loading').remove();
		});

		$.each($('[data-widget]'), function (index) {
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
						//alert(widgetId+'.hidewidget');
						if(localStorage.getItem(widgetId+'.selectType') != undefined ){ //check old parameter
							var selectType = localStorage.getItem(widgetId+'.selectType');
							var panelColor = localStorage.getItem(widgetId+'.panelColor');
							var selectParam = localStorage.getItem(widgetId+'.selectParam');
							var post_data = localStorage.getItem(widgetId+'.post_data');
							var relationValue = localStorage.getItem(widgetId+'.relationValue');
							var widget = $(this).closest('[data-widget]');
							console.log('x:'+selectParam);

		       				widget.append('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
					        try {

							$.post( is_switch(selectType) , { path:selectType , param:selectParam , curId:flag })
					        .done(function (data) {
								//console.log(data);
								$.when(draw_card(data)).done(function (arg1){
									if(arg1){

										widget.find('.panel-loading').remove();
										widget.find('.panel-body').html(arg1.html_text).promise().done(function(){
											$.each(arg1.id_array,function(index,val){
												//console.log(arg1.grp_data[index].data);
												makePlot(widget.find('.panel-body'),val,arg1.grp_data[index].data);
											});
										});
									$(".panel").css('visibility', 'visible');
									$(".table").css('visibility', 'visible');
									$(".info-tile").css('visibility', 'visible');
									$('.tooltips').tooltip({ container: 'body' });
									}else{
										widget.find('.panel-loading').remove();
										widget.find('.panel-body').html('<div class="alert alert-dismissable alert-danger"><i class="ti ti-close"></i>&nbsp;ไม่สามารถแสดงข้อมูลได้กรุณาติดต่อผู้แลระบบ</div>');
									}
									$('.metric-tooltips').tooltip({trigger: 'manual'}).tooltip('show');
								});
					        }).fail(function(){
					        	widget.find('.panel-body').html("error");
					        });
					        }
							catch(err) {
								alert('c');
							}
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
								}
							});
							$('.tooltips').tooltip({ container: 'body' });
							//$(".sortable").disableSelection();
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
									localStorage.setItem(widgetId+'.'+prop, params[prop]);
								}
							}
						}
					}
				}
			} catch (e) {
			}

		}).promise().done(function(){
			// $('.info-tile,.panel')
	  //       .css('visibility', 'visible')
	  //       .velocity('transition.slideUpIn', {stagger: 50});
	        $('.tooltips').tooltip({ container: 'body' });
		});

		$('[data-actions-container]')
		.each( function () {
			var elem = $(this);
			var attrs = [];
			$.each( this.attributes, function () {
				attrs.push(this);
			});
			if(!$.browser.chrome) attrs.reverse();
			$.each( attrs, function () {
				if (this.name.substr(0, 12) == "data-action-") {
					var actionName = this.name.substr(12);
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
function gen_holy_tab(tab_data, sorterarizational, pn_size){
	var holy_tab = '';
	var list_nav = '';
	var tab_content = '';
	$.each(tab_data, function(index, tab){
		var tab_class = '';
		var list_nav_sub = '';
		var tab_content_sub = '';
		if(index == 0) tab_class='active';
		var icon = '';
		if(typeof tab.icon != 'undefined') icon = '<i class="ti ti-'+tab.icon+'"></i>';
		list_nav += '<li class="'+tab_class+'"><a href="#tab-1-'+index+'" data-toggle="tab">'+icon+' '+tab.name+'</a></li>';

		$.each(tab.child, function(index_sub, tab_sub){
			var tab_class_sub = '';
			var no_more = true;
			if(index_sub == 0) tab_class_sub = 'active';
			list_nav_sub += '<li class="'+tab_class_sub+'"><a href="#1-'+index+'-'+index_sub+'" data-toggle="tab">'+tab_sub.name+'</a></li>';
			var tr = '';

			$.each(tab_sub.data, function(index_tr, row){
				var td = '';
				$.each(row, function(index_td, cell){
					td += '<td ';
					if(typeof tab_sub.column_width[index_td] != 'undefined') td += ' width="'+tab_sub.column_width[index_td]+'" ';
					if(typeof cell.class != 'undefined') td += ' class="'+cell.class+'" ';
					if(typeof cell.align != 'undefined') td += ' align="'+cell.align+'" ';
					td += ' >';
					td += cell.text;
					td += '</td>';
				})
				tr += '<tr>'+
						td+
					'</tr>';
				if(index_tr == 9){
					no_more = false;
					return false;
				}
			});
			if (no_more == false){ //เกิน 10
				if(typeof tab_sub.title != 'undefined') var the_title = tab_sub.title
				var colspan = tab_sub.data[0].length;
				tr += '<tr>'+
						'<td colspan="'+colspan+'" align="right"><a href="javascript:void(0)" class="need_more" title="'+the_title+'"><span class="text-default">ดูทั้งหมด</span> <i class="ti ti-new-window"></i></a></td>'+
					'</tr>';
			}

			tab_content_sub += '<div class="tab-pane '+tab_class_sub+'" id="1-'+index+'-'+index_sub+'">'+
						'<table class="table">'+
							'<tbody>'+
								tr+
							'</tbody>'+
						'</table>'+
					'</div>';

		});
		tab_content += '<div class="tab-pane '+tab_class+'" id="tab-1-'+index+'">'+
						'<div class="col-md-12">'+
							'<div class="tab-container tab-default">'+
								'<ul class="nav nav-tabs">'+
									list_nav_sub+
								'</ul>'+
								'<div class="tab-content">'+
									tab_content_sub+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>';
	});
	holy_tab += '<div class="col-md-'+pn_size+'">';
	holy_tab += '<div class="panel panel-midnightblue" data-widget=\'{"draggable": "false"}\' style="visibility: visible;"> '+
		'<div class="panel-heading" style="background-color:#37474f">'+
			'<h2>'+
				'<ul class="nav nav-tabs">'+
					list_nav+
				'</ul>'+
			'</h2>'+
			'<div class="input-group-btn" align="right">'+
				'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">'+sorterarizational+' <i class="fa fa-angle-down"></i></button>'+
				'<ul class="dropdown-menu pull-right" pn_size="'+pn_size+'">'+
					'<li><a href="javascript:void(0)" class="holy_sorting" cond="max">มากที่สุด</a></li>'+
					'<li><a href="javascript:void(0)" class="holy_sorting"  cond="min" >น้อยที่สุด</a></li>'+
				'</ul>'+
			'</div>'+
		  '</div>'+
		  '<div class="panel-body">'+
		  	'<div class="tab-content">'+
		  		tab_content+
		  	'</div>'+
		  '</div>'+
			'</div>'+
		'</div>'+
	'</div>';
	holy_tab += '</div>';
	return holy_tab;
}
function process_data(element, dataModal1, DataTableModal1){
	DataTableModal1.fnClearTable();
	$.each(dataModal1[element.index],function(){
		var temp = [];
		temp.push(this.name);
		temp.push(this.number);
		temp.push(this.price);
		temp.push(this.date);
		temp.push(this.expDate);
		temp.push(this.status);
		temp.push(this.detail);
		DataTableModal1.fnAddData(temp,false);
	});
	DataTableModal1.fnDraw();
}
function process_data2(element, dataModal1, dataTable , tb_head){
	dataTable.fnClearTable();
	if(dataModal1[element.index] != null){
		$.each(dataModal1[element.index],function(index){
				var keys = Object.keys( this );
				var temp = [];
				for(i=0;i<tb_head;i++){
					temp.push(this[keys[i]]);
				}
				if(index == 2){
					console.log(temp);
				}
				dataTable.fnAddData(temp,false);
		});
	}
	dataTable.fnDraw();
}
function convert_unit(point_y){
	if(point_y > 9999){
    	if(point_y > 999999){
        	var num_m = point_y / 1000000
            return  num_m.toFixed(2) + 'M';
        }else{
        	var num_m = point_y / 1000
            return  num_m.toFixed(2) + 'K';
        }
    }else{
    	return  point_y;
    }						
}