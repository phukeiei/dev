/*
 * Dandelion Admin v1.2 - Charts Demo JS
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
		if($.plot) {
			drawLineChart($("#da-ex-flot-line"));
			drawStackedChart($("#da-ex-flot-stacked"));
			drawPieChart($("#da-ex-flot-pie"));
			drawDonutChart($("#da-ex-flot-donut"));

			function showTooltip(x, y, contents) {
				$('<div id="tooltip">' + contents + '</div>').css( {
					position: 'absolute',
					display: 'none',
					top: y + 5,
					left: x + 5,
					padding: '4px',
					color: "#ffffff", 
					'background-color': '#000',
					opacity: 0.75, 
					'border-radius': '3px'
				}).appendTo("body").fadeIn(200);
			}
			
			function drawLineChart(el) {
				var 
					s = [100, 35, 35, 30, 105, 40, 35, 30, 40, 20, 15], 
					p = [12, 6, 0, 9, 15, 3, 18, 3, 6, 7, 9], 
					v = [54, 105, 35, 45, 75, 6, 20, 15, 30, 35, 45], 
					sales = [], 
					supportRequests = [], 
					pageViews = [], 
					previousPoint = null;
				for(var i = 0; i < s.length; i++) {
					sales.push([new Date(2012, 5, i + 1), s[i]]);
					supportRequests.push([new Date(2012, 5, i + 1), p[i]]);
					pageViews.push([new Date(2012, 5, i + 1), v[i]]);
				}
				
				var data = [
					{ data: sales, label: "Sales", color: "#E15656"}, 
					{ data: supportRequests, label: "Support Requests", color: "#A6D037"}, 
					{ data: pageViews, label: "Page Views", color: "#61A5E4"}
				], opts = {
					series: {
						lines: { show: true }, 
						points: { show: true }
					},
					xaxis: {
						mode: "time", 
						min: (new Date(2012, 5, 1)).getTime(),
						max: (new Date(2012, 5, 11)).getTime()
					}, 
					grid: { 
						hoverable: true, 
						clickable: true, 
						borderWidth: null
					}
				};
				
				$.plot(el, data, opts);
				el.bind("plothover", function (event, pos, item) {
					if (item) {
						if (previousPoint != item.dataIndex) {
							previousPoint = item.dataIndex;
							
							$("#tooltip").remove();
							var x = item.datapoint[0], 
								y = Math.round(item.datapoint[1]);
							
							var dt = new Date(x);
							showTooltip(item.pageX, item.pageY, y + " " + item.series.label.toLowerCase() + " on " + dt.toLocaleDateString());
						}
					}
					else {
						$("#tooltip").remove();
						previousPoint = null;            
					}
				});
			}
			
			function drawStackedChart(el) {
				var d1 = [];
				for (var i = 0; i <= 10; i += 1)
					d1.push([i, parseInt(Math.random() * 30)]);
			
				var d2 = [];
				for (var i = 0; i <= 10; i += 1)
					d2.push([i, parseInt(Math.random() * 30)]);
			
				var d3 = [];
				for (var i = 0; i <= 10; i += 1)
					d3.push([i, parseInt(Math.random() * 30)]);
					
				var opts = {
					series: {
						stack: true, 
						bars: {
							show: true, 
							barWidth: 0.4
						}
					}, 
					grid: {
						borderWidth: 0
					}
				};
				
				$.plot(el, [{data: d1, color: "#E15656"}, {data: d2, color: "#A6D037"}, {data: d3, color: "#61A5E4"}], opts);
			}
			
			function drawPieChart(el) {
			alert('ok');
				var data = [
					{label: "Dandelions", data: 41, color: "#E15656"}, 
					{label: "Roses", data: 55, color: "#EA799B"}, 
					{label: "Orchids", data: 12, color: "#FAB241"}, 
					{label: "Dahlia", data: 11, color: "#61A5E4"}, 
					{label: "Tulp", data: 66, color: "#656565"}, 
					{label: "Sakura", data: 11, color: "#A6D037"}
				];            
				
				var opts = {
					series: {
						pie: {
							show: true
						}
					}
				};
				$.plot(el, data, opts);
			}
			
			function drawDonutChart(el) {
				var data = [
					{label: "American", data: 41, color: "#E15656"}, 
					{label: "Dutch", data: 55, color: "#EA799B"}, 
					{label: "Japanese", data: 12, color: "#FAB241"}, 
					{label: "Korean", data: 11, color: "#61A5E4"}, 
					{label: "French", data: 66, color: "#656565"}, 
					{label: "Chinese", data: 11, color: "#A6D037"}
				];
				
				var opts = {
					series: {
						pie: {
							show: true, 
							innerRadius: 0.4, 
							label: {
								show: true, 
								radius: 0.9
							}
						}
					}, 
					legend: {
						show: false
					}
				};
				$.plot(el, data, opts);
			}
		}
	});
	
})(jQuery);
