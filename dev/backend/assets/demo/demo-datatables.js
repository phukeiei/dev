// -------------------------------
// Initialize Data Tables
// -------------------------------

$(document).ready(function () {
	$('.datatableTH').attr('class','table table-striped table-bordered table_iserl no-footer table-hover dataTable-Export');
    $('#example').dataTable({
        "language": {
            "lengthMenu": "_MENU_",
            "zeroRecords": "ไม่พบรายการ",
            "info": "แสดงหน้าที่ _PAGE_ จากทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "ไม่พบรายการ",
            "infoFiltered": "(พบข้อมูล _TOTAL_ รายการจากทั้งหมด _MAX_ รายการ)",
            "paginate": {
              "next": "หน้าต่อไป",
              "previous": "ก่อนหน้า"
            }
        }
    });

    /** add new datatable */
    $('.dataTable-Export').dataTable({
        "language": {
            "lengthMenu": "_MENU_",
			"zeroRecords": "ไม่พบรายการ",
			"info": "แสดงหน้าที่ _PAGE_ จากทั้งหมด _PAGES_ หน้า",
			"infoEmpty": "ไม่พบรายการ",
			"infoFiltered": "(พบข้อมูล _TOTAL_ รายการจากทั้งหมด _MAX_ รายการ)",
            "paginate": {
              "next": "หน้าต่อไป",
              "previous": "ก่อนหน้า"
            }			
        },
        dom: 'lengthMenu Bfrtip',
        buttons: [
            {

                extend: 'excel',
                text: "<i style='font-size: 20px; color: #258429; ' title='ส่งออก excel' class='fa fa-file-excel-o tooltips'></i>",
                title: 'excel',
                action: function (e, dt, button, config) {
                    config.title = button.parent().parent().parent().find('h2').html();

                    //go export
                    $.fn.dataTable.ext.buttons.excelHtml5.action(e, dt, button, config);

                }
            },
            {
                extend: 'print',
                text: "<i style='font-size: 20px; color: #000;' title='พิมพ์'  class='ti ti-printer'></i>",
                title: 'print',
                customize: function (win) {
                    $(win.document.body).css({
                        'font-weight': '600',
                        "font-family": "'TH SarabunPSK', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif"
                    });

                    $(win.document.body).find('table').css({
                        "font-size": "16pt",
                        "line-height": "1.45",
                        "color": "#616161"
                    });
                },
                action: function (e, dt, button, config) {
                    config.title = button.parent().parent().parent().find('h2').html();

                    //go export
                    $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                }
            }
        ]

    });

    $('.dataTables_filter input').attr('placeholder', 'ค้นหา');

    //DOM Manipulation to move datatable elements integrate to panel
    $('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
    $('.panel-ctrls').append("<i class='separator pull-right'></i>");
    $('.panel-ctrls').append($('.dataTables_length').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
    $('.panel-ctrls').append("<i class='separator pull-right'></i>");
    $('.panel-ctrls').append($('.dt-buttons').addClass("pull-right")).find("label").addClass("panel-ctrls-center");

    $('.buttons-excel').addClass("btn btn-default btn_check_iserl tooltips");
    $('.buttons-print').addClass("btn btn-default btn_check_iserl tooltips");

    $('.panel-ctrls .dt-buttons').attr('style', "margin:8px 0 !important;");

    $('.buttons-print').attr('style', "margin-left:4px;");

    $('.buttons-print').click(function () {
        $(this).parent().parent().parent().find('h2').html();
    });

    $('.panel-footer').append($(".dataTable+.row"));
    $('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");


});
function make_dataTable_export_byId(id_name){
	var datatable = $('#'+id_name).DataTable({
         "language": {
            "lengthMenu": "_MENU_",
			"zeroRecords": "ไม่พบรายการ",
			"info": "แสดงหน้าที่ _PAGE_ จากทั้งหมด _PAGES_ หน้า",
			"infoEmpty": "ไม่พบรายการ",
			"infoFiltered": "(พบข้อมูล _TOTAL_ รายการจากทั้งหมด _MAX_ รายการ)",
            "paginate": {
              "next": "หน้าต่อไป",
              "previous": "ก่อนหน้า"
            }			
        },
        dom: 'lengthMenu Bfrtip',
        buttons: [
            {

                extend: 'excel',
                text: "<i style='font-size: 20px; color: #258429; ' title='ส่งออก excel' class='fa fa-file-excel-o tooltips'></i>",
                title: 'excel',
                action: function (e, dt, button, config) {
                    config.title = button.parent().parent().parent().find('h2').html();

                    //go export
                    $.fn.dataTable.ext.buttons.excelHtml5.action(e, dt, button, config);

                }
            },
            {
                extend: 'print',
                text: "<i style='font-size: 20px; color: #000;' title='พิมพ์'  class='ti ti-printer'></i>",
                title: 'print',
                customize: function (win) {
                    $(win.document.body).css({
                        'font-weight': '600',
                        "font-family": "'TH SarabunPSK', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif"
                    });

                    $(win.document.body).find('table').css({
                        "font-size": "16pt",
                        "line-height": "1.45",
                        "color": "#616161"
                    });
                },
                action: function (e, dt, button, config) {
                    config.title = button.parent().parent().parent().find('h2').html();

                    //go export
                    $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                }
            }
        ]

    });

    $('.dataTables_filter input').attr('placeholder', 'ค้นหา');

    //DOM Manipulation to move datatable elements integrate to panel
    $('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
    $('.panel-ctrls').append("<i class='separator pull-right'></i>");
    $('.panel-ctrls').append($('.dataTables_length').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
    $('.panel-ctrls').append("<i class='separator pull-right'></i>");
    $('.panel-ctrls').append($('.dt-buttons').addClass("pull-right")).find("label").addClass("panel-ctrls-center");

    $('.buttons-excel').addClass("btn btn-default btn_check_iserl tooltips");
    $('.buttons-print').addClass("btn btn-default btn_check_iserl tooltips");

    $('.panel-ctrls .dt-buttons').attr('style', "margin:8px 0 !important;");

    $('.buttons-print').attr('style', "margin-left:4px;");

    $('.buttons-print').click(function () {
        $(this).parent().parent().parent().find('h2').html();
    });

    $('.panel-footer').append($(".dataTable+.row"));
    $('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");

	return datatable;
}


function make_dataTable_export_by_classname(class_name){ 
	var datatable = $('.'+class_name).DataTable({
         "language": {
            "lengthMenu": "_MENU_",
			"zeroRecords": "ไม่พบรายการ",
			"info": "แสดงหน้าที่ _PAGE_ จากทั้งหมด _PAGES_ หน้า",
			"infoEmpty": "ไม่พบรายการ",
			"infoFiltered": "(พบข้อมูล _TOTAL_ รายการจากทั้งหมด _MAX_ รายการ)",
            "paginate": {
              "next": "หน้าต่อไป",
              "previous": "ก่อนหน้า"
            }			
        },
        dom: 'lengthMenu Bfrtip',
        buttons: [
            {

                extend: 'excel',
                text: "<i style='font-size: 20px; color: #258429; ' title='ส่งออก excel' class='fa fa-file-excel-o tooltips'></i>",
                title: 'excel',
                action: function (e, dt, button, config) {
                    config.title = button.parent().parent().parent().find('h2').html();

                    //go export
                    $.fn.dataTable.ext.buttons.excelHtml5.action(e, dt, button, config);

                }
            },
            {
                extend: 'print',
                text: "<i style='font-size: 20px; color: #000;' title='พิมพ์'  class='ti ti-printer'></i>",
                title: 'print',
                customize: function (win) {
                    $(win.document.body).css({
                        'font-weight': '600',
                        "font-family": "'TH SarabunPSK', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif"
                    });

                    $(win.document.body).find('table').css({
                        "font-size": "16pt",
                        "line-height": "1.45",
                        "color": "#616161"
                    });
                },
                action: function (e, dt, button, config) {
                    config.title = button.parent().parent().parent().find('h2').html();

                    //go export
                    $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                }
            }
        ]

    });

    $('.dataTables_filter input').attr('placeholder', 'ค้นหา');

    //DOM Manipulation to move datatable elements integrate to panel
    $('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
    $('.panel-ctrls').append("<i class='separator pull-right'></i>");
    $('.panel-ctrls').append($('.dataTables_length').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
    $('.panel-ctrls').append("<i class='separator pull-right'></i>");
    $('.panel-ctrls').append($('.dt-buttons').addClass("pull-right")).find("label").addClass("panel-ctrls-center");

    $('.buttons-excel').addClass("btn btn-default btn_check_iserl tooltips");
    $('.buttons-print').addClass("btn btn-default btn_check_iserl tooltips");

    $('.panel-ctrls .dt-buttons').attr('style', "margin:8px 0 !important;");

    $('.buttons-print').attr('style', "margin-left:4px;");

    $('.buttons-print').click(function () {
        $(this).parent().parent().parent().find('h2').html();
    });

    $('.panel-footer').append($(".dataTable+.row"));
    $('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");

	return datatable;
}

function make_muti_dataTable_export_byId(id_name,id_panel){//รับ id ของ table และ id ของ panel

	var datatable = $('#'+id_name).DataTable({
         "language": {
            "lengthMenu": "_MENU_",
			"zeroRecords": "ไม่พบรายการ",
			"info": "แสดงหน้าที่ _PAGE_ จากทั้งหมด _PAGES_ หน้า",
			"infoEmpty": "ไม่พบรายการ",
			"infoFiltered": "(พบข้อมูล _TOTAL_ รายการจากทั้งหมด _MAX_ รายการ)",
            "paginate": {
              "next": "หน้าต่อไป",
              "previous": "ก่อนหน้า"
            }
        },
        dom: 'lengthMenu Bfrtip',
        buttons: [
            {

                extend: 'excel',
                text: "<i style='font-size: 20px; color: #258429; ' title='ส่งออก excel' class='fa fa-file-excel-o tooltips'></i>",
                title: 'excel',
                action: function (e, dt, button, config) {
                    config.title = button.parent().parent().parent().find('h2').html();

                    //go export
                    $.fn.dataTable.ext.buttons.excelHtml5.action(e, dt, button, config);

                }
            },
            {
                extend: 'print',
                text: "<i style='font-size: 20px; color: #000;' title='พิมพ์'  class='ti ti-printer'></i>",
                title: 'print',
                customize: function (win) {
                    $(win.document.body).css({
                        'font-weight': '600',
                        "font-family": "'TH SarabunPSK', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif"
                    });

                    $(win.document.body).find('table').css({
                        "font-size": "16pt",
                        "line-height": "1.45",
                        "color": "#616161"
                    });
                },
                action: function (e, dt, button, config) {
                    config.title = button.parent().parent().parent().find('h2').html();

                    //go export
                    $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                }
            }
        ]

    });

    $('#'+id_panel+' .dataTables_filter input').attr('placeholder', 'ค้นหา');

    //DOM Manipulation to move datatable elements integrate to panel
    $('#'+id_panel+' .panel-ctrls').append($('#'+id_panel+' .dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
    $('#'+id_panel+' .panel-ctrls').append("<i class='separator pull-right'></i>");
    $('#'+id_panel+' .panel-ctrls').append($('#'+id_panel+' .dataTables_length').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
    $('#'+id_panel+' .panel-ctrls').append("<i class='separator pull-right'></i>");
    $('#'+id_panel+' .panel-ctrls').append($('#'+id_panel+' .dt-buttons').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
	//console.log('#'+id_panel+' .panel-ctrls');
    $('#'+id_panel+' .buttons-excel').addClass("btn btn-default btn_check_iserl tooltips");
    $('#'+id_panel+' .buttons-print').addClass("btn btn-default btn_check_iserl tooltips");

    $('#'+id_panel+' .panel-ctrls .dt-buttons').attr('style', "margin:8px 0 !important;");

    $('#'+id_panel+' .buttons-print').attr('style', "margin-left:4px;");

    $('#'+id_panel+' .buttons-print').click(function () {
        $(this).parent().parent().parent().find('h2').html();
    });

    $('#'+id_panel+' .panel-footer').append($(".dataTable+.row"));
    $('#'+id_panel+' .dataTables_paginate>ul.pagination').addClass("pull-right m-n");
	
	return datatable;
}