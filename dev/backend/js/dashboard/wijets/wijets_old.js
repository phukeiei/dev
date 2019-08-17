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
										'<div class="info-tile my-element" style="background-color:'+val.tile_bgcolor+';">';
										if(val.is_expand!='false' && (typeof val.is_expand != 'undefined')){
						html_txt +=			'<button class="btn btn-midnightblue btn-sm expand-button-new wrap" expand-path="'+val.is_expand.link+'" data-param="'+val.is_expand.param+'"><i class="fa fa-search"></i></button>';
										}
						html_txt +=			'<div class="tile-icon" style="color: '+val.tile_icocolor+';"><i class="'+val.tile_icon+'"></i></div>'+
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
										'<h2 style="color:'+val.pn_hd_text_color+';">'+val.pn_hd_text+'</h2>';
										if(typeof val.is_expand != 'undefined'){
											if(val.is_expand!='false' && val.is_expand.link !=''){
					html_txt +=					'<button class="btn btn-midnightblue btn-sm pull-right expand-panel" expand-path="'+val.is_expand.link+'" data-param="'+val.is_expand.param+'"><i class="fa fa-search tooltips" data-original-title="ดูทั้งหมด"></i></button>';
											}
										}
				html_txt +=			'</div>'+
									'<div class="panel-body my-content">'+
										'<div id="gpContainer'+index+'">gpContainer'+index+'</div>'+
									'</div>'+
								'</div>'+
							'</div>';
					id_array.push('gpContainer'+index);
					if(val.chart_type == 'ch1'){
						grp_data[index] = {'data' : {'series': val.chart_data,'chart_type':val.chart_type , 'chart_unit': val.chart_unit}};
					}else if(val.chart_type == 'ch2'){
						grp_data[index] = {'data' : {'series': val.chart_data,'chart_cate':val.chart_cate,'chart_type' : val.chart_type, 'chart_sub_type' : val.chart_sub_type , 'chart_unit': val.chart_unit}}
					}else if(val.chart_type == 'ch3'){
						grp_data[index] = {'data' : {'series': val.chart_data,'chart_cate':val.chart_cate,'chart_type' : val.chart_type, 'chart_unit': val.chart_unit}}
					}else if(val.chart_type == 'eqs_sp1'){
						grp_data[index] = {'data' : {'series': val.chart_data,'chart_type':val.chart_type,'chart_cate':val.chart_cate}};
					}else if(val.chart_type == 'hr_countNurse' || val.chart_type == 'acd_sp1' || val.chart_type == 'ma_sp1'){
						grp_data[index] = {'data' : {'series': val.chart_data, 'chart_type':val.chart_type}};
					}else if(val.chart_type == 'rs_sp1'){
						grp_data[index] = {'data' : {'series': val.chart_data, 'chart_type':val.chart_type, 'chart_cate':val.chart_cate}};
					}
				}
				if(val.widget_style == 'table-card'){
					if(val.table_type == '1'){
						var i=0;
						html_txt += '<div class="col-md-'+val.pn_size+'">'+
													'<div class="panel panel-danger">'+
														'<div class="panel-heading" style="background-color:'+val.pn_hd_color+';">'+
															'<h2 style="color:'+val.pn_hd_text_color+';">'+val.pn_hd_text+'</h2>'+
														'</div>'+
														'<div class="panel-body my-content">'+
															'<div class="table-responsive">'+
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
						html_txt +=								'<span class="label label-'+tbody_val.label.color_type+'">'+tbody_val.label.text+'</span>';
																		}
						html_txt +=							'</td>';
																		if(tbody_val.col2 == 'progress') {
						html_txt +=								'<td width="60%">'+
																				'<div class="progress m-n">'+
																					'<div class="progress-bar" style="width:'+tbody_val.progress_len+'%;"></div>'+
																				'</div>'+
																			'</td>';
																			} else {
						html_txt +=								'<td class="text-right">'+tbody_val.col2+'</td>';
																			}
																		if(tbody_val.is_expand.link != '' && (typeof tbody_val.is_expand != 'undefined')){
						html_txt +=								'<td class="text-right">'+tbody_val.col3+'</td>'+
																	 		'<td class="text-right"><button class="btn btn-midnightblue btn-sm expand-button-new" data-param="'+tbody_val.is_expand.param+'" expand-path="'+tbody_val.is_expand.link+'"><i class="fa fa-search"></i></button></td>';
																		}
						html_txt +=								'</tr>';
																	});
						html_txt +=						'</tbody>'+
																'</table>'+
															'</div>'+
														'</div>'+
													'</div>'+
												'</div>';
					} if(val.table_type == '2') {
						var i=0;
						if(val.table_detail == 'graduation'){
						html_txt += '<div class="col-md-'+val.pn_size+'">'+
													'<div class="panel panel-danger">'+
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
												html_txt += '<div class="col-md-'+val.pn_size+'">'+
																			'<div class="panel panel-danger">'+
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
						console.log('down there');
						$.each(val.table_data.tb_row_body[i].tbody, function( ex_temp, ex_val ) {
							console.log( ex_temp + ": " + ex_val );
						});
						html_txt += '<div class="col-md-'+val.pn_size+'">'+
													'<div class="panel panel-danger">'+
														'<div class="panel-heading" style="background-color:'+val.pn_hd_color+';">'+
															'<h2 style="color:'+val.pn_hd_text_color+';">'+val.pn_hd_text+'</h2>'+
														'</div>'+
														'<div class="panel-body my-content">'+
															'<div class="table-responsive">'+
																'<table class="table table-bordered table-hover my-table">'+
																	'<thead>'+
																		'<tr>';
																		$.each(val.table_data.tb_row_head[i].main_th, function( main_th_temp, main_th_val ) {
						html_txt +=								'<th rowspan="'+main_th_val.th.rowspan+'" colspan="'+main_th_val.th.colspan+'" class="text-center" style="vertical-align: middle !important;">'+main_th_val.th.data+'</th>';
																		});
						html_txt +=							'</tr>'+
																		'<tr>';
																		$.each(val.table_data.tb_row_head[i].sub_th, function( sub_th_temp, sub_th_val ) {
						html_txt +=								'<th class="text-center">'+sub_th_val+'</th>';
																		});
						html_txt +=							'</tr>'+
																	'</thead>'+
																	'<tbody>'+
																		'<tr>';
																		$.each(val.table_data.tb_row_body[i].tbody, function( tbody_temp, tbody_val ) {
					html_txt +=									'<td rowspan="'+tbody_val.td.rowspan+'" colspan="'+tbody_val.td.colspan+'" class="text-center complex_ele" expand-path="">'+tbody_val.td.data+'</td>';
																		});
						html_txt +=							'</tr>'+
																	'</tbody>'+
																'</table>'+
															'</div>'+
														'</div>'+
													'</div>'+
												'</div>';
					}
					if(val.table_type == 'rs_sp1'){

						var table_rows = '';
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
							'</div>';
					}
				}
				if(val.widget_style == 'bg-sp1'){
					
					function gen_holy_tab(tab_data, sorterarizational){
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
									console.log(tab_sub);
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
						holy_tab += '<div class="col-md-'+val.pn_size+'">';
						holy_tab += '<div class="panel panel-midnightblue" data-widget=\'{"draggable": "false"}\' style="visibility: visible;"> '+
			 				'<div class="panel-heading" style="background-color:#37474f">'+
								'<h2>'+
									'<ul class="nav nav-tabs">'+
										list_nav+
									'</ul>'+
								'</h2>'+
								'<div class="input-group-btn" align="right">'+
									'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">'+sorterarizational+' <i class="fa fa-angle-down"></i></button>'+
									'<ul class="dropdown-menu pull-right">'+
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
					var temp_massive_data = val.tab_data;
					var cond_g = 'max';
					html_txt += gen_holy_tab(val.tab_data, 'มากที่สุด');

					$("body").on('click', '.holy_sorting', function(){
						var cond = $(this).attr('cond');
						if(cond_g != cond){
							cond_g = cond;
							$.each(temp_massive_data, function(index, tab){
								$.each(tab.child, function(index_sub, tab_sub){
									tab_sub.data.reverse();
								});
							})
							//$(this).parents('.input-group-btn').find('button').html($(this).text());
							//alert($(this).parents('.input-group-btn').find('button').html());
							//alert($(this).parent().parent().closest('button').html());
							var new_tabs = gen_holy_tab(temp_massive_data, $(this).text());
							var place_belong = $(this).parent().parent().parent().parent().parent().parent().parent();
							//$(this).parent().parent().parent().parent().parent().parent().parent().html(new_tabs);
							$(this).parent().parent().parent().parent().parent().parent().remove();
							place_belong.append(new_tabs);
						}
					});
					$("body").on('click', '.need_more', function(){
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
				selectVal = $('option:selected', this).attr('my-path');
				selectText = $(this).find("option:selected").text();
		        var widget = $(this).closest('[data-widget]');
		        widget.append('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
				var path = $('option:selected', this).attr('my-path');

		        $.post( path , { path:path , param:$(this).val() , curId:flag })
		        .done(function (data) {
					//console.log(data);
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
		        $.post( selectType , { path:selectType , param:$(this).val() , curId:flag })
		        .done(function (data) {
					//console.log(data);
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
					});
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
		var size_of_font = '16px';
		var test = new Array();
		var test2 = new Array();
		console.log(payload);
		Highcharts.setOptions({
		    lang: {
		        thousandsSep: ','
		    }
		});
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
				var unit = (typeof payload.chart_unit  !== 'undefined' )?payload.chart_unit:'รายการ';
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
					},xAxis: {
						labels: {
			                style: {
			                    fontSize: size_of_font,
			                }
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
							//format: '<span style="font-size: 14px">{point.name}</span><br><span style="font-size: 14px">{point.y} '+unit+'</span>',
							formatter: function() {
								return  '<span style="font-size: 14px">'+this.point.name+'</span><br><span style="font-size: 14px">'+Highcharts.numberFormat(this.y)+' '+unit+'</span>';//Highcharts.numberFormat(this.y, 2, '.');
							}
						},
						data: payload.series
					}]
				});
			}

		}else if(payload.chart_type=='ch2'){
			var stacking_status = false;
			var unit = (typeof payload.chart_unit  !== 'undefined' )?payload.chart_unit:'Rainfall (mm)';
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
                  
						}

					},
					yAxis: {
						min: 0,
						title: {
							text: unit
						}
					},
					tooltip: {
						headerFormat: '<span style="font-size:10px">{point.key}</span><table style="width:150px">',
						pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
							'<td style="padding:0"><b>{point.y} '+unit+' </b></td></tr>',
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
		}else if(payload.chart_type=='ch3'){
			var stacking_status = false;
			var unit = (typeof payload.chart_unit  !== 'undefined' )?payload.chart_unit:'Rainfall (mm)';
			if(payload.chart_sub_type != ''){
				stacking_status = 'normal';
			}
			console.log(stacking_status);
			if(widget.find('#'+param).length > 0){
				$(widget.find('#'+param)).highcharts({
					chart: {
						type: 'line'
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
                  
						}

					},
					yAxis: {
						min: 0,
						title: {
							text: unit
						}
					},
					tooltip: {
						headerFormat: '<span style="font-size:10px">{point.key}</span><table style="width:150px">',
						pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
							'<td style="padding:0"><b>{point.y:.1f} '+unit+'</b></td></tr>',
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
					credits:{
						text:"iserl",
						href: "www.google.com",
					},
			        series: [{
			            name: 'อาจารย์พยาบาลประจำ',
			            colorByPoint: true,
			            data: data_m
			        }],
			        drilldown: {
			            series: data_sub
			        }
			    });
			} //end param > 0
		}else if(payload.chart_type == 'acd_sp1' || payload.chart_type == 'ma_sp1'){
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
						text: 'ปีงบประมาณ'
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
						text: 'จำนวนอาจารย์ (คน)'
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
					enabled: true,
					formatter: function() {
						return '<b>' + this.point.name +'</b><br/>' + 
						'จำนวน ' + this.y + ' คน';
					}
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
							formatter: function() {
								return this.y;
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
				}
			});
		}else if(payload.chart_type=='rs_sp1'){
			var stacking_status = false;
			
			if(widget.find('#'+param).length > 0){

				var colors = Highcharts.getOptions().colors;
				var series = [];
				categories = [];
				$.each(payload.series, function(index, val){
					var sub_data = [];
					$.each(val.child, function(index2, val2){
						if(index == 0){
							categories.push(val2.subyear);
						}
						sub_data.push({subname: val.name,
										subyear: val2.subyear,
										y: val2.y,
										dtail: '<table border="0" width="200px;" ><tr><td nowrap colspan="6"><b>ปีงบประมาณ&nbsp;พ.ศ.&nbsp;'+val2.subyear+'</b></td></tr><tr><td nowrap style="color:#4572A7;"><b>'+val.name+'&nbsp;&nbsp;&nbsp;</b></td><td nowrap style="color:#4572A7;"><b>&nbsp;จำนวน</b></td><td nowrap style="text-align:right;color:#4572A7;"><b>&nbsp;'+val2.y+'</b></td><td nowrap style="color:#4572A7;"><b>&nbsp;รายการ</b></td><td colspan="2" >&nbsp;</td></tr></table>',
										parent_id: val.id});
					
					});
					series.push({name: val.name, 
									data: sub_data,
									color: colors[index+6] });
				});

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
							text: 'ปีงบประมาณ (พ.ศ.)'
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
						headerFormat: '',
						pointFormat: '{point.dtail}',
						footerFormat: '',
						shadow: false,
						shared: false,
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
									if(this.y > 0){
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
			                        	var head=this.subname + ' (ปีงบประมาณ ' + this.subyear + ')';
			                        	var id = this.parent_id;
			                        	var year = this.subyear;
			                        	var path = "https://"+window.location.hostname+'/pcksite/index.php/dashboard/Test_data/rs_sp_table';
			                        	 //var widget = $(this).closest('[data-widget]');

								        $.post( path , { path:path , title:head, id:id, year:year, curId:flag })
								        .done(function (data) {
											$.when(draw_card(data)).done(function (arg1){
												widget.find('.panel-loading').remove();
												var widget_area = widget.find('.panel-body').parents('.panel-body');
												widget_area.find('#dwnxx2').remove();
												widget_area.append(arg1.html_text);
												widget_area.find('.dataTable').dataTable();

												//console.log($(widget_area).find('table').text());

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
					},
					series: series,
					navigation: {
						buttonOptions: {
							enabled: false
						}
					}
				});
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
		        series: data
		      });
			
			} //else type chart
		}//else type chart
		//$('.highcharts-xaxis-labels').find('text').css('font-size', '20px');
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
	var da_path = window.location.href.split('/');
	var the_path = da_path[0]+'//'+da_path[2]+'/'+da_path[3];

	$("body").on("click" , '#saveButton' , function(){
		var temp = $.parseJSON(JSON.stringify(localStorage));
		var widget_grp = $('#grp_name_input').val();
		var test = {};
		$.each(temp,function(index,val){
			var grp_name = index.split(".");
			if(grp_name[0]==widget_grp){
				test[grp_name[1]+'.'+grp_name[2]] = val;
			}
		});
		console.log(JSON.stringify(test));
		 $.post( the_path+'/index.php/dashboard/Data_management/save_config', {  param1: JSON.stringify(test), grp_name:widget_grp }, function(data, textStatus, xhr) {

		 }).done( function(data) {
		 	console.log('data:'+data);
		 });
		//self.make();
	});
	var load_local = function(){
		var widget_grp = $('#grp_name_input').val();
		$.post(the_path+'/index.php/dashboard/Data_management/load_config', { type:'r',grp_name:widget_grp }, function(data, textStatus, xhr) {

		}).done( function(data) {
			var obj = JSON.parse(data);
			var json_text = JSON.parse(obj.result[0].json_text);
			console.log(json_text); 
			$.each(json_text,function(index,val){
				localStorage.setItem(widget_grp+'.'+index, val);
			});
			self.Mymake();
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
		//self.make();
	});
	$("body").on('click', '.open_link', function(){
		var path = $(this).attr('path');
		var param = $(this).attr('param');
		openLink(path, param);
	});
	var counter=0;
	load_local();
	this.make = function (settings) { }
	this.Mymake = function (settings) {
		//localStorage.clear().promise();
		//load_local();
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
		$( "body" ).on( "click", '.expand-button-new,.expand-panel', function( event ) {
			//console.log($(this).parent().find('.tile-body')[0].outerHTML);
			
			file_name = ($(this).attr('expand-path')===undefined)?'test.html':$(this).attr('expand-path');
			var parameter = $(this).data('param');
			// var src_file = "expand/"+file_name;
			// var text = '';5
			 var temp = $($(this).parent().find('.tile-heading')).text();
			 $('#myModal').find('.modal-dialog').css({'width':'100%'});
			 $('#myModal').find('.modal-body').html('<div class="panel-loading"><div class="panel-loader-circular"></div></div>');
			 $('#myModal').find('.modal-body').css('min-height', '300px');
			 $.post(file_name, {param:parameter} ,function(data) {
			 	$('#myModal').find('.panel-loading').fadeOut(300, function() { $(this).remove(); });
			 	$('#myModal').find('.modal-title').html(temp);
			 	$('#myModal').find('.modal-body').html(data);
			 	
			 });
			 $('#a-togle').click();
			 
			//var text = $($(this).parent()[0].outerHTML).find("#mytable").removeClass('example')[0].outerHTML;
			//$('#modal-iframe').modal({show:true})
			//$('#modal-iframe').on('shown.bs.modal',function(){      //correct here use 'shown.bs.modal' event which comes in bootstrap3
			  //$(this).find('iframe').attr('src',file_name);
			//});
			event.preventDefault();
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
					        
							$.post( selectType , { path:selectType , curId:flag })
					        .done(function (data) {
								//console.log(data);
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
								});
					        }).fail(function(){
					        	alert("error");
					        });
					  //       $.post("call_ajax_text", {param:selectType,curId:flag,data_seq:post_data})
					  //       .done(function (data) {
					  //       	if(selectType==6 || selectType == 10){
					  //       		var json_obj = JSON.parse(data);
	    		// 					widget.find('.panel-body').html(json_obj.html);
					  //       		makePlot(widget,selectType,json_obj.payload);
					  //       	}else{
					  //       		widget.find('.panel-body').html(data);
						 //        	if(selectType == 4){
						 //        		makeDataTable(widget);
						 //        	}else if(selectType==13 || selectType==14 ||selectType==15||selectType==16 || selectType==17||selectType==18){
							//     		makePlot(widget,selectType,'');
							//     	}
					  //       	}

							// 	$(widget.find('.info-tile,.panel'))
						 //        .css('visibility', 'visible')
						 //        .velocity('transition.slideUpIn', {stagger: 50});

					  //       	widget.find('.panel-loading').remove();
					  //       	setTimeout( function(){
					  //       		if($("#checkPage").length){
							//         	$.each($("div[gp]"),function(index, el) {
							// 				var temp = JSON.parse($(this).attr('gp'));
							// 				var current = $(this);
							// 				var flag = false;
							// 				$.each(temp, function(index, val) {
							// 					if(val != "gp1" && flag != true){
							// 						$(current).closest('.row.child').hide();
							// 					}else{
							// 						flag = true;
							// 						$(current).closest('.row.child').show();
							// 					}
							// 				});
							// 			});
							// 			//console.log("qqqq");
							//         }
					  //       	}, 1550 );

					  //       	var myElement = $(widget.find('.my-element'));

					  //       	$.each(myElement, function(index, val) {
					  //       		if(relationValue){
				   //      				$(val).attr('relate-obj', relationValue);
				   //      			}
				   //      			if($(val).hasClass('danger')){
				   //      				var backgroundInterval = setInterval(function(){
							// 		    	$(val).toggleClass("backgroundRed");
							// 			},1550)
				   //      			}

				   //      		});
					  //       	if(panelColor){
					  //       		var myElement = $(widget.find('.my-element'));
					  //       		$.each(myElement, function(index, val) {
					  //       			$(val).css('background-color', panelColor);
					  //       		});
					  //       	}


					  //       }).fail(function(){
					  //       	alert("error");
					  //       }).always(function() {

							// });


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
