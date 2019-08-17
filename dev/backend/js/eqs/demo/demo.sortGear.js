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
		$("table#da-ex-datatable-numberpaging").dataTable({sPaginationType: "full_numbers"});
		$("table#da-ex-datatable-default").dataTable();
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
		$( ".da-panel-content" ).disableSelection();
	});
}) (jQuery);