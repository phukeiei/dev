jQuery(document).ready(function($) {
	
	//-- เลือกกรอกปีที่ได้รับทุน พ.ศ.
	$(":text[id='rs_year_published_th']").blur(function(){
		var intRegex = /^\d{4}$/;
		tmp_value = $(this).val().replace(/\s+/g,'');
		
		if($.isNumeric(tmp_value) == true && intRegex.test(tmp_value) == true){
		//if(this.value != '' && this.value > 0){
			var year = parseInt($(this).val()) - 543;
			$(":text[id='rs_year_published']").val(year);
		}
		else{
			$(":text[id='rs_year_published']").val("");
			//$(this).val("");
		}
	});
	
	//-- เลือกกรอกปีที่ได้รับทุน ค.ศ.
	$(":text[id='rs_year_published']").blur(function(){
		var intRegex = /^\d{4}$/;
		tmp_value = $(this).val().replace(/\s+/g,'');
		
		if($.isNumeric(tmp_value) == true && intRegex.test(tmp_value) == true){
		//if(this.value != '' && this.value > 0){
			var year = parseInt($(this).val()) + 543;
			$(":text[id='rs_year_published_th']").val(year);
		}
		else{
			$(":text[id='rs_year_published_th']").val("");
			//$(this).val("");
		}
	});
	
	// delete research file
	$(".MultiFile-label a.delete_rf").click(function(){
		if(!confirm("คุณต้องการลบไฟล์แน่นอนใช่หรือไม่")){
			return false;
		}
		id = $(this).attr("id");
		var obj = $(this).parents("div:first");
		$.post(delFileRs_url,{rf_id:id},function(data){
			obj.remove();
		});
	});
	
	// delete academic file
	$(".MultiFile-label a.delete_acdf").click(function(){
		if(!confirm("คุณต้องการลบไฟล์แน่นอนใช่หรือไม่")){
			return false;
		}
		id = $(this).attr("id");
		var obj = $(this).parents("div:first");
		$.post(delFileAcd_url,{acdf_id:id},function(data){
			obj.remove();
		});
	});
	
	// delete ig_cs file
	$(".MultiFile-label a.delete_ig_cs").click(function(){
		if(!confirm("คุณต้องการลบไฟล์แน่นอนใช่หรือไม่")){
			return false;
		}
		id = $(this).attr("id");
		var obj = $(this).parents("div:first");
		$.post(delFileIgCs_url,{igcsf_id:id},function(data){
			obj.remove();
		});
	});
	
	// delete ig_acds file
	$(".MultiFile-label a.delete_ig_acds").click(function(){
		if(!confirm("คุณต้องการลบไฟล์แน่นอนใช่หรือไม่")){
			return false;
		}
		id = $(this).attr("id");
		var obj = $(this).parents("div:first");
		$.post(delFileIgAcds_url,{igacdsf_id:id},function(data){
			obj.remove();
		});
	});
	
	// delete ig_mt file
	$(".MultiFile-label a.delete_ig_mt").click(function(){
		if(!confirm("คุณต้องการลบไฟล์แน่นอนใช่หรือไม่")){
			return false;
		}
		id = $(this).attr("id");
		var obj = $(this).parents("div:first");
		$.post(delFileIgMt_url,{igmtf_id:id},function(data){
			obj.remove();
		});
	});
	
	// delete ig_rs file
	$(".MultiFile-label a.delete_ig_rs").click(function(){
		if(!confirm("คุณต้องการลบไฟล์แน่นอนใช่หรือไม่")){
			return false;
		}
		id = $(this).attr("id");
		var obj = $(this).parents("div:first");
		$.post(delFileIgRs_url,{igrsf_id:id},function(data){
			obj.remove();
		});
	});
	
	// delete ig_ot file
	$(".MultiFile-label a.delete_ig_ot").click(function(){
		if(!confirm("คุณต้องการลบไฟล์แน่นอนใช่หรือไม่")){
			return false;
		}
		id = $(this).attr("id");
		var obj = $(this).parents("div:first");
		$.post(delFileIgOt_url,{igotf_id:id},function(data){
			obj.remove();
		});
	});
	
	// delete employment file
	$(".MultiFile-label a.delete_ep").click(function(){
		if(!confirm("คุณต้องการลบไฟล์แน่นอนใช่หรือไม่")){
			return false;
		}
		id = $(this).attr("id");
		var obj = $(this).parents("div:first");
		$.post(delFileEp_url,{epf_id:id},function(data){
			obj.remove();
		});
	});
	
	//--ลบไฟล์แนบหลักฐานการได้รับคะแนน CNEU
	$(".MultiFile-label a.delete_cneuf").click(function(){
		if(!confirm("คุณต้องการลบไฟล์แน่นอนใช่หรือไม่")){
			return false;
		}
		id = $(this).attr("id");
		var obj = $(this).parents("div:first");
		$.post(delFileCneu_url,{ascf_id:id},function(data){
			obj.remove();
		});
	});
	
	//--เอกสารผลประเมินโครงการ
	$(".MultiFile-label a.delete_assf").click(function(){
		if(!confirm("คุณต้องการลบไฟล์แน่นอนใช่หรือไม่")){
			return false;
		}
		id = $(this).attr("id");
		var obj = $(this).parents("div:first");
		$.post(delFileAss_url,{asaf_id:id},function(data){
			obj.remove();
		});
	});
	
	// delete acdservice file
	$(".MultiFile-label a.delete_acds").click(function(){
		if(!confirm("คุณต้องการลบไฟล์แน่นอนใช่หรือไม่")){
			return false;
		}
		id = $(this).attr("id");
		var obj = $(this).parents("div:first");
		$.post(delFileAcds_url,{acdsf_id:id},function(data){
			obj.remove();
		});
	});
	
	// delete maintaining file
	$(".MultiFile-label a.delete_mtf").click(function(){
		if(!confirm("คุณต้องการลบไฟล์แน่นอนใช่หรือไม่")){
			return false;
		}
		id = $(this).attr("id");
		var obj = $(this).parents("div:first");
		$.post(delFileMt_url,{mtf_id:id},function(data){
			obj.remove();
		});
	});

	/*
	//-- โครงการวิจัย
	$(":text[id^='rs_parent_rs_title']").autocomplete(project_url, {
		selectFirst: false
	});
	$(":text[id^='rs_parent_rs_title']").result(function(event, data, formatted) {
		if (data)
			$(this).parent().find(':hidden[id^="rs_parent_rs_id"]').val(data[1]);
	});
	$(":text[id^='rs_parent_rs_title']").blur(function(){
		chkChangeTxt($(this),$(this).parent().find(':hidden[id^="rs_parent_rs_id"]'));
	});
	
	//-- คณะผู้วิจัย
	$(":text[name^='au_ps_name']").autocomplete(rsc_url, {
		selectFirst: false
	});
	$(":text[name^='au_ps_name']").blur(function(){
		var result = chkChangeTxt($(this),$(this).parent().find(':hidden[name^="au_ps_id"]'));
		if(result == false) {
			$(this).parent().find(':hidden[name^="au_ps_id"]').val("");
			$(this).parents("tr:first").children("td:eq(3)").children(":text").attr({"value":"","readonly":""}).siblings(":hidden").val("");
		}
	});
	$(":text[name^='au_ps_name']").result(function(event, data, formatted) {
		if (data)
			$(this).parent().find(':hidden[name^="au_ps_id"]').val(data[1]);
	});

	$(":text[id^='jn_name_en']").autocomplete(jn_url, {
		selectFirst: false
	});
	$(":text[id^='jn_name_en']").result(function(event, data, formatted) {
		if (data)
			$(this).parent().find(':hidden[id^="rs_jn_id"]').val(data[1]);
	});
	$(":text[id^='jn_name_en']").blur(function(){
		chkChangeTxt($(this),$(this).parent().find(':hidden[id^="rs_jn_id"]'));
	});
	
	$(":text[id^='cont_pj_name']").autocomplete(cont_pj_url, {
		selectFirst: false
	});
	$(":text[id^='cont_pj_name']").result(function(event, data, formatted) {
		if (data)
			$(this).parent().find(':hidden[id^="cont_pj_id"]').val(data[1]);
	});
	$(":text[id^='cont_pj_name']").blur(function(){
		chkChangeTxt($(this),$(this).parent().find(':hidden[id^="cont_pj_id"]'));
	});
	
	*/
	
	//$("#cancle").click(hideCancle);
});

function sendPost (frmId, value, url, target, conf) {
	if(conf.length>0){
		if(!confirm(conf))
			return false;
	}
	var html = "";
	if(url != "")
	{
		if (jQuery("#"+frmId).length > 0) {
			jQuery("#"+frmId).attr("action",url);
		}
		else {
			jQuery("body").append("<form action=\""+url+"\" id=\""+frmId+"\" method=\"post\" ></form>")
		}
	}
	if (target != "") {
		jQuery("#"+frmId).attr("target",target);
	}
	if (value != "") {
		jQuery.each(value,function(index,value){
			if(jQuery("#"+frmId).find("input:hidden[name='"+index+"']").length == 0)
			{
				html += "<input type='hidden' name='"+index+"' value='"+value+"' id='"+index+"' />";
			}else{
				jQuery("input:hidden[name='"+index+"']").val(value);
			}
			temp = index;
		});
	}
	jQuery("#"+frmId).append(html).trigger("submit");
}

function confirmDel (msg) {
	if(msg == ""){
		msg = "คุณต้องการลบข้อมูลแน่นอนใช่หรือไม่?";
	} else {
		msg = "คุณต้องการลบ \""+msg+"\" แน่นอนใช่หรือไม่?";
	}
	
	if (confirm(msg)) {
		return true;
	} else {
		return false;
	}
}

function newXmlHttp () {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && document.createElement) {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

/* GET AJAX TO INPUT FORM */
function get_ajax(url, id){
	xmlhttp = newXmlHttp();
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById(id).value = xmlhttp.responseText;
}

/* GET AJAX TO OBJECT FORM */
function get_ajax2(url, id){
	xmlhttp = newXmlHttp();
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById(id).innerHTML = xmlhttp.responseText;
	jQuery('select.chzn-select').select2();
}

/*function hideCancle () {
	var id = document.getElementById("cancle");
	var page = jQuery(id).attr("get");
	id.style.display = "none";
	
	if(page == "bd_rt"){
		// จัดการข้อมูลประเภทการวิจัย
		jQuery("#rt_name_en").val("");
		jQuery("#rt_name_th").val("");
		jQuery("#rt_id").val("");
	}
	else if(page == "bd_fu"){
		// จัดการข้อมูลหน่วยงานให้ทุน/แหล่งทุน
		get_ajax(fuSeq_url, "fu_seq");
		jQuery("#fu_name").val("");
		jQuery("#fu_abbr").val("");
		jQuery("#fu_wk31t_id").val("");
		jQuery("input[name^='fp_pjs_id']").attr("checked", false);
		jQuery("input[name^='fp_pjs2_id']").attr("checked", false);
		jQuery("#fu_id").val("");
	}
	else if(page == "bd_jn"){
		// จัดการข้อมูลวารสาร
		get_ajax(jnSeq_url, "jn_seq");
		jQuery("#jn_name_en").val("");
		jQuery("#jn_name_th").val("");
		jQuery("#jn_issn").val("");
		jQuery("#jn_jd_id").val("");
		jQuery("input[name='jn_if_id']").attr("checked", false);
		jQuery("#jn_id").val("");
	}
}*/

function get_research_subtype (rt_id) {
	var url = rst_url + "/" + rt_id.value;
	
	xmlhttp = newXmlHttp();
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("rs_rst_id").innerHTML = xmlhttp.responseText;
	jQuery('select.chzn-select').select2();
}
		
function get_subject (sg_id) {
	var url = sj_url + "/" + sg_id.value;
	
	xmlhttp = newXmlHttp();
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("rs_sj_id").innerHTML = xmlhttp.responseText;
	//jQuery('.chzn-select').chosen();
}

/*function get_integration_subtype (igt_id, id) {
	var url = igs_url + "/" + igt_id + "/" + id;
	xmlhttp = newXmlHttp();
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("igs_id").innerHTML = xmlhttp.responseText;
	jQuery("#ig_div").css("display","none");
	jQuery(".ig_table").css("display","none");
}*/

// START AUTOCOMPLETE
function acLink(id){
	var data = globaldata[id];
	if(get == "get_researcher"){			//-- ดึงชื่อนักวิจัย สำหรับเพิ่มคณะผู้วิจัย
		//set value in Author
		obj.parents("tr:first").find("input[name^=au_ps_id]").val(data.us_id);
		obj.parents("tr:first").find("input[name^=au_ps_name]").val(data.author);
		//set value in department
		obj.parents("tr:first").find("input[name^=au_dp_id]").val(data.dpId);
		obj.parents("tr:first").find("input[name^=au_dp_name]").attr({"value":data.dpName});
		obj.parents("tr:first").find("input[name^=au_phone]").attr({"value":data.phone});
		obj.parents("tr:first").find("input[name^=au_email]").attr({"value":data.emailAddr});
	}
	else if(get == "get_cont_project"){		//-- ดึงชื่อโครงการวิจัยต่อเนื่อง
		obj.parents("div:first").find("input[name=cont_pj_id]").val(data.rs_id);
		obj.parents("div:first").find("input[name=cont_pj_name]").val(data.rs_title);
	}
	else if(get == "get_journal"){			//-- ดึงชื่อวารสารที่มีทั้งหมด
		obj.parents("div:first").find("input[name=rs_jn_id]").val(data.jn_id);
		obj.parents("div:first").find("input[name=jn_name_en]").val(data.jn_name);
	}
	else if(get == "get_project"){			//-- ดึงชื่อโครงการวิจัย
		obj.parents("div:first").find("input[name=rs_parent_rs_id]").val(data.rs_id);
		obj.parents("div:first").find("input[name=rs_parent_rs_title]").val(data.rs_title);
	}
	else if(get == "get_project2ep"){		//-- ดึงชื่อโครงการวิจัย ในเมนูบันทึกการนำไปใช้ประโยชน์
		obj.parents("div:first").find("input[name=ep_parent_rs_id]").val(data.rs_id);
		obj.parents("div:first").find("input[name=ep_parent_rs_title]").val(data.rs_title);
		
		if(obj.parents("div.da-panel-content").find("textarea[name=ep_title_th]").hasClass("ckeditor")){
			//--ตรวจสอบว่า textarea ใช้ plugin class='ckeditor' หรือไม่?
			//--แทนค่าลงใน ckeditor
			obj.parents("div.da-panel-content").find("textarea[name=ep_title_th]").next("div.cke").find("iframe").contents().find("body p").text(data.rs_title_th);
		} else {
			//--แทนค่าลงใน textarea ได้เลย
			obj.parents("div.da-panel-content").find("textarea[name=ep_title_th]").text(data.rs_title_th);
		}
		
		if(obj.parents("div.da-panel-content").find("textarea[name=ep_title_en]").hasClass("ckeditor")){
			//--ตรวจสอบว่า textarea ใช้ plugin class='ckeditor' หรือไม่?
			//--แทนค่าลงใน ckeditor
			obj.parents("div.da-panel-content").find("textarea[name=ep_title_en]").next("div.cke").find("iframe").contents().find("body p").text(data.rs_title_en);
		} else {
			//--แทนค่าลงใน textarea ได้เลย
			obj.parents("div.da-panel-content").find("textarea[name=ep_title_en]").text(data.rs_title_en);
		}
	}
	else if(get == "get_project2ig"){		//-- ดึงชื่อโครงการวิจัย ในเมนูบันทึกการบูรณาการงานวิจัย
		obj.parents("div:first").find("input[name=ig_rs_id]").val(data.rs_id);
		obj.parents("div:first").find("input[name=ig_rs_name]").val(data.rs_title);
	}
	else if(get == "get_acdservice2ig"){	//-- ดึงชื่อโครงการบริการวิชาการ ในเมนูบันทึกการบูรณาการงานบริการวิชาการ
		obj.parents("div:first").find("input[name=ig_acds_id]").val(data.acds_id);
		obj.parents("div:first").find("input[name=ig_acds_name]").val(data.name);
		obj.parents("div.da-panel-content").find("input[name=ig_start_date]").val(data.start_date);
		obj.parents("div.da-panel-content").find("input[name=ig_end_date]").val(data.end_date);
	}
	else if(get == "get_maintaining2ig"){	//-- ดึงชื่อโครงการทำนุบำรุงฯ ในเมนูบันทึกการบูรณาการงานทำนุบำรุงฯ
		obj.parents("div:first").find("input[name=ig_mt_id]").val(data.mt_id);
		obj.parents("div:first").find("input[name=ig_mt_name]").val(data.name);
		obj.parents("div.da-panel-content").find("input[name=ig_start_date]").val(data.start_date);
		obj.parents("div.da-panel-content").find("input[name=ig_end_date]").val(data.end_date);
	}
	else if(get == "get_igcourse"){			//-- ดึงชื่อวิชา สำหรับบูรณาการกับรายวิชา
		obj.parents("tr:first").find("input[name^=cs_id]").val(data.cs_id);
		obj.parents("tr:first").find("input[name^=cs_no]").val(data.cs_no);
		obj.parents("tr:first").find("input[name^=cs_name]").val(data.cs_name);
	}
	else if(get == "get_igacdservice"){		//-- ดึงชื่อโครงการฯ สำหรับบูรณาการกับโครงการบริการวิชาการ
		obj.parents("tr:first").find("input[name^=acds_id]").val(data.acds_id);
		obj.parents("tr:first").find("input[name^=acds_name]").val(data.name);
	}
	else if(get == "get_igmaintaining"){	//-- ดึงชื่อโครงการฯ สำหรับบูรณาการกับโครงการทำนุบำรุงฯ
		obj.parents("tr:first").find("input[name^=mt_id]").val(data.mt_id);
		obj.parents("tr:first").find("input[name^=mt_name]").val(data.name);
	}
	else if(get == "get_igresearch"){	//-- ดึงชื่อโครงการฯ สำหรับบูรณาการกับโครงการวิจัย
		obj.parents("tr:first").find("input[name^=rs_id]").val(data.rs_id);
		obj.parents("tr:first").find("input[name^=rs_name]").val(data.rs_title);
	}
	else if(get == "get_otherpart"){	//--ดึงชื่อประเภทการบูรณาการด้านอื่นๆ
		obj.parents("tr:first").find("input[name^=igp_id]").val(data.igp_id);
		obj.parents("tr:first").find("input[name^=ig_otpart_name]").val(data.name);
	}
	else if(get == "get_person"){	//-- ดึงชื่อบุคลากร สำหรับเพิ่มผู้เข้าร่วมโครงการ
		//set value in Author
		obj.parents("tr:first").find("input[name^=au_ps_id]").val(data.ps_id);
		obj.parents("tr:first").find("input[name^=au_ps_name]").val(data.author);
		//set value in department
		obj.parents("tr:first").find("input[name^=au_dp_id]").val(data.dpId);
		obj.parents("tr:first").find("input[name^=au_dp_name]").attr({"value":data.dpName});
		obj.parents("tr:first").find("input[name^=au_phone]").attr({"value":data.phone});
		obj.parents("tr:first").find("input[name^=au_email]").attr({"value":data.emailAddr});
	}
	else if(get == "get_maintaining2cont"){	//-- ดึงชื่อโครงการทำนุบำรุง เพื่อเพิ่มกิจกรรมภายใต้โครงการ
		obj.parents("div:first").find("input[name^=mt_parent_mt_id]").val(data.mt_id);
		obj.parents("div:first").find("input[name^=mt_parent_mt_name]").val(data.mt_name);
	}
	else if(get == "get_acdservice2cont"){	//-- ดึงชื่อโครงการบริการวิชาการ เพื่อเพิ่มกิจกรรมภายใต้โครงการ
		obj.parents("div:first").find("input[name^=acds_parent_acds_id]").val(data.acds_id);
		obj.parents("div:first").find("input[name^=acds_parent_acds_name]").val(data.acds_name);
	}
	$(".autocomplete-block").remove();
}

function acStart(obj){
	if(get == "get_researcher"){			//-- ดึงชื่อนักวิจัย สำหรับเพิ่มคณะผู้วิจัย
		au_ps_id = obj.parent().find("input[name^=au_ps_id]").val();
		if(au_ps_id > 0){
			obj.parents("tr:first").find("input[name^=au_ps_id]").val("");
			//obj.parents("tr:first").find("input[name^=au_ps_name]").val("");
			obj.parents("tr:first").find("input[name^=au_dp_id]").val("");
			obj.parents("tr:first").find("input[name^=au_dp_name]").attr({"value":""});		
			obj.parents("tr:first").find("input[name^=au_phone]").attr({"value":""});
			obj.parents("tr:first").find("input[name^=au_email]").attr({"value":""});
		}
	}
	else if(get == "get_journal"){			//-- ดึงชื่อวารสารที่มีทั้งหมด
		rs_jn_id = obj.parent().find("input[name=rs_jn_id]").val();
		if(rs_jn_id > 0){
			obj.parents("div:first").find("input[name=rs_jn_id]").val("");
			obj.parents("div:first").find("input[name=jn_name_en]").val("");
		}
	}
	else if(get == "get_project"){			//-- ดึงชื่อโครงการวิจัย
		rs_parent_rs_id = obj.parent().find("input[name=rs_parent_rs_id]").val();
		if(rs_parent_rs_id > 0){
			obj.parents("div:first").find("input[name=rs_parent_rs_id]").val("");
			obj.parents("div:first").find("input[name=rs_parent_rs_title]").val("");
		}
	}
	else if(get == "get_project2ep"){		//-- ดึงชื่อโครงการวิจัย ในเมนูบันทึกการนำไปใช้ประโยชน์
		ep_parent_rs_id = obj.parent().find("input[name=ep_parent_rs_id]").val();
		if(ep_parent_rs_id > 0){
			obj.parents("div:first").find("input[name=ep_parent_rs_id]").val("");
		}
	}
	else if(get == "get_project2ig"){		//-- ดึงชื่อโครงการวิจัย ในเมนูบันทึกการบูรณาการงานวิจัย
		ig_rs_id = obj.parent().find("input[name=ig_rs_id]").val();
		if(ig_rs_id > 0){
			obj.parents("div:first").find("input[name=ig_rs_id]").val("");
			obj.parents("div:first").find("input[name=ig_rs_name]").val("");
		}
	}
	else if(get == "get_acdservice2ig"){	//-- ดึงชื่อโครงการบริการวิชาการ ในเมนูบันทึกการบูรณาการงานบริการวิชาการ
		ig_acds_id = obj.parent().find("input[name=ig_acds_id]").val();
		if(ig_acds_id > 0){
			obj.parents("div:first").find("input[name=ig_acds_id]").val("");
			obj.parents("div:first").find("input[name=ig_acds_name]").val("");
			obj.parents("div.da-panel-content").find("input[name=ig_start_date]").val("");
			obj.parents("div.da-panel-content").find("input[name=ig_end_date]").val("");
		}
	}
	else if(get == "get_maintaining2ig"){	//-- ดึงชื่อโครงการทำนุบำรุงฯ ในเมนูบันทึกการบูรณาการงานทำนุบำรุงฯ
		ig_mt_id = obj.parent().find("input[name=ig_mt_id]").val();
		if(ig_mt_id > 0){
			obj.parents("div:first").find("input[name=ig_mt_id]").val("");
			obj.parents("div:first").find("input[name=ig_mt_name]").val("");
			obj.parents("div.da-panel-content").find("input[name=ig_start_date]").val("");
			obj.parents("div.da-panel-content").find("input[name=ig_end_date]").val("");
		}
	}	
	else if(get == "get_igcourse"){			//-- ดึงชื่อวิชา สำหรับบูรณาการกับรายวิชา
		cs_id = obj.parent().find("input[name^=cs_id]").val();
		if(cs_id > 0){
			obj.parents("tr:first").find("input[name^=cs_id]").val("");
			//obj.parents("div:first").find("input[name^=cs_name]").val("");
		}
	}
	else if(get == "get_igacdservice"){		//-- ดึงชื่อโครงการฯ สำหรับบูรณาการกับโครงการบริการวิชาการ
		acds_id = obj.parent().find("input[name^=acds_id]").val();
		if(acds_id > 0){
			obj.parents("tr:first").find("input[name^=acds_id]").val("");
			//obj.parents("div:first").find("input[name^=acds_name]").val("");
		}
	}
	else if(get == "get_igmaintaining"){	//-- ดึงชื่อโครงการฯ สำหรับบูรณาการกับโครงการทำนุบำรุงฯ
		mt_id = obj.parent().find("input[name^=mt_id]").val();
		if(mt_id > 0){
			obj.parents("tr:first").find("input[name^=mt_id]").val("");
			//obj.parents("div:first").find("input[name^=mt_name]").val("");
		}
	}
	else if(get == "get_igresearch"){	//-- ดึงชื่อโครงการฯ สำหรับบูรณาการกับโครงการวิจัย
		rs_id = obj.parent().find("input[name^=rs_id]").val();
		if(rs_id > 0){
			obj.parents("tr:first").find("input[name^=rs_id]").val("");
			//obj.parents("div:first").find("input[name^=rs_name]").val("");
		}
	}
	else if(get == "get_otherpart"){	//--ดึงชื่อประเภทการบูรณาการด้านอื่นๆ
		igp_id = obj.parent().find("input[name^=igp_id]").val();
		if(igp_id > 0){
			obj.parents("tr:first").find("input[name^=igp_id]").val("");
			//obj.parents("div:first").find("input[name^=ig_otpart_name]").val("");
		}
	}
	else if(get == "get_person"){	//-- ดึงชื่อบุคลากร สำหรับเพิ่มผู้เข้าร่วมโครงการ
		au_ps_id = obj.parent().find("input[name^=au_ps_id]").val();
		if(au_ps_id > 0){
			obj.parents("tr:first").find("input[name^=au_ps_id]").val("");
			//obj.parents("tr:first").find("input[name^=au_ps_name]").val("");
			obj.parents("tr:first").find("input[name^=au_dp_id]").val("");
			obj.parents("tr:first").find("input[name^=au_dp_name]").attr({"value":""});		
			obj.parents("tr:first").find("input[name^=au_phone]").attr({"value":""});
			obj.parents("tr:first").find("input[name^=au_email]").attr({"value":""});
		}
	}
	else if(get == "get_maintaining2cont"){	//-- ดึงชื่อโครงการทำนุบำรุง เพื่อเพิ่มกิจกรรมภายใต้โครงการ
		mt_id = obj.parent().find("input[name^=mt_parent_mt_id]").val();
		if(mt_id > 0){
			obj.parents("div:first").find("input[name^=mt_parent_mt_id]").val("");
			//obj.parents("tr:first").find("input[name^=mt_parent_mt_name]").val("");
		}
	}
	else if(get == "get_acdservice2cont"){	//-- ดึงชื่อโครงการบริการวิชาการ เพื่อเพิ่มกิจกรรมภายใต้โครงการ
		acds_id = obj.parent().find("input[name^=acds_parent_acds_id]").val();
		if(acds_id > 0){
			obj.parents("div:first").find("input[name^=acds_parent_acds_id]").val("");
			//obj.parents("tr:first").find("input[name^=acds_parent_acds_name]").val("");
		}
	}
}
// END AUTOCOMPLETE

//-- การบูรณาการฯ
function set_ig_with (obj) {
	//jQuery("input[name='ig_rs_name']").attr({"igs_id":obj.value, value:""});	//-- ลบชื่อโครงการวิจัย
	//jQuery("input[name='ig_rs_id']").val("");
	//jQuery("input[name='ig_acds_name']").attr({"igs_id":obj.value, value:""});	//-- ลบชื่อโครงการบริการวิชาการ
	//jQuery("input[name='ig_acds_id']").val("");
	//jQuery("input[name='ig_mt_name']").attr({"igs_id":obj.value, value:""});	//-- ลบชื่อโครงการทำนุบำรุงฯ
	//jQuery("input[name='ig_mt_id']").val("");
	jQuery("#ig_div").css("display","none");
	jQuery(".ig_table").css("display","none");
	
	if(obj.value == 1){	//-- บูรณาการกับรายวิชา
		jQuery("#ig_div").css("display","");
		jQuery("#cs_table").css("display","");
		jQuery("input[name^=cs_name]").addClass("required");
		jQuery("input[name^=cs_id]").addClass("required");
		// igs_id = 2
		jQuery("textarea[name^=acds_name]").removeClass("required");
		jQuery("textarea[name^=igacds_note]").removeClass("required");
		// igs_id = 3
		jQuery("textarea[name^=mt_name]").removeClass("required");
		jQuery("textarea[name^=igmt_note]").removeClass("required");
		// igs_id = 4
		jQuery("textarea[name^=rs_name]").removeClass("required");
		jQuery("textarea[name^=igrs_note]").removeClass("required");
	}
	else if(obj.value == 2){	//-- บูรณาการกับโครงการบริการวิชาการ
		jQuery("#ig_div").css("display","");
		jQuery("#acds_table").css("display","");
		jQuery("textarea[name^=acds_name]").addClass("required");
		jQuery("textarea[name^=igacds_note]").addClass("required");
		// igs_id = 1
		jQuery("input[name^=cs_name]").removeClass("required");
		jQuery("input[name^=cs_id]").removeClass("required");
		// igs_id = 3
		jQuery("textarea[name^=mt_name]").removeClass("required");
		jQuery("textarea[name^=igmt_note]").removeClass("required");
		// igs_id = 4
		jQuery("textarea[name^=rs_name]").removeClass("required");
		jQuery("textarea[name^=igrs_note]").removeClass("required");
	}	
	else if(obj.value == 3){	//-- บูรณาการกับโครงการทำนุบำรุงฯ
		jQuery("#ig_div").css("display","");
		jQuery("#mt_table").css("display","");
		jQuery("textarea[name^=mt_name]").addClass("required");
		jQuery("textarea[name^=igmt_note]").addClass("required");
		// igs_id = 1
		jQuery("input[name^=cs_name]").removeClass("required");
		jQuery("input[name^=cs_id]").removeClass("required");
		// igs_id = 2
		jQuery("textarea[name^=acds_name]").removeClass("required");
		jQuery("textarea[name^=igacds_note]").removeClass("required");
		// igs_id = 4
		jQuery("textarea[name^=rs_name]").removeClass("required");
		jQuery("textarea[name^=igrs_note]").removeClass("required");
	}
	else if(obj.value == 4){	//-- บูรณาการกับโครงการวิจัย
		jQuery("#ig_div").css("display","");
		jQuery("#rs_table").css("display","");
		jQuery("textarea[name^=rs_name]").addClass("required");
		jQuery("textarea[name^=igrs_note]").addClass("required");
		// igs_id = 1
		jQuery("input[name^=cs_name]").removeClass("required");
		jQuery("input[name^=cs_id]").removeClass("required");
		// igs_id = 2
		jQuery("textarea[name^=acds_name]").removeClass("required");
		jQuery("textarea[name^=igacds_note]").removeClass("required");
		// igs_id = 3
		jQuery("textarea[name^=mt_name]").removeClass("required");
		jQuery("textarea[name^=igmt_note]").removeClass("required");
	}
}
		
		
		
		
		
		
		
		

		
		
		
		
		
		




/*     ------------------------------      */
function resetHidden (obj, target) {
	if (!jQuery(obj).val())
		jQuery("#"+target).val("");
}

function chkChangeTxt (obj, hidden) {
	var dn = "data_"+obj.attr("name");
	if (jQuery.data(document.body,dn) != null) {
		if (obj.val() != jQuery.data(document.body,dn)) {
			hidden.val("");
			jQuery.removeData(document.body,dn);
			return false;
		}else
			return true;
	}else{
		hidden.val("");
		return false;
	}
	//return true;
}

function fillData (obj) {
	//var srcId = jQuery(obj).attr("name");
	//alert(srcId);
	if (jQuery(obj).val() == "" )
		return false;

	jQuery.ajax({
		url: dp_url,
		type: "POST",
		async:false,
		dataType : "json",
		data: "au_ps_id="+jQuery(obj).val(),
		success: function(data){
			jQuery(obj).parents("tr:first").children("td:eq(4)").children(":text").attr({"value":data["name"],"readonly":"readonly"})
				.siblings(":hidden").val(data["id"]);
		}
	});
}

function show_all () {
	var bullet = document.getElementsByTagName("img");
	var img = document.getElementById("image_minus");
	var elem = document.getElementsByTagName("tbody");
	
	for (i = 1; i < bullet.length; i++) {
		var id = document.getElementById(bullet[i].id);
		if (id) {
			id.src = img.value;
		}
	}
	
	for (i = 1; i < elem.length; i++) {
		var id = document.getElementById(elem[i].id);
		id.style.display = "inline";
	}
}

function hide_all (img_name) {
	var bullet = document.getElementsByTagName("img");
	var img = document.getElementById("image_plus");
	var elem = document.getElementsByTagName("tbody");
	
	for (i = 1; i < bullet.length; i++) {
		var id = document.getElementById(bullet[i].id);
		if (id) {
			id.src = img.value;
		}
	}
	
	for (i = 1; i < elem.length; i++) {
		var id = document.getElementById(elem[i].id);
		id.style.display = "none";
	}
}

function show_hide (id, img_name) {
	var plus = document.getElementById("image_plus");
	var minus = document.getElementById("image_minus");
	var bullet = document.getElementById('bullet_' + id);
	
	var id = document.getElementById(id);
	if (id.style.display == "none") {
		id.style.display = "inline";
		bullet.src = minus.value;
	} else {
		id.style.display = "none";
		bullet.src = plus.value;
	}
}

function isvaliddate(txtStart, txtEnd, msg) {
	var retval = true;
	var ArrayStartDay = txtStart.split("/");
	var ArrayStopDay = txtEnd.split("/");
	var StartDay = ArrayStartDay[2] + ArrayStartDay[1] + ArrayStartDay[0];
	var StopDay = ArrayStopDay[2] + ArrayStopDay[1] + ArrayStopDay[0];
	var msg = (msg) ? msg : "วันที่ไม่ถูกต้อง";
	
	if(StartDay > StopDay) {
		alert(msg);
		retval = false;
	}
	
	return retval;
}

/*function doCheckAll(form, do_check) {
	for(var i=0; i<form.length; i++) {
		if(form.elements[i].type == 'checkbox')
			form.elements[i].checked = do_check;
	}
}*/

function preAjax (url, type) {
	if (type == "")
		type = "html";
	jQuery.ajaxSetup({
			url: url,
			type: "POST",
			dataType : type
	});
}

function fillTextNoId (url, postVal, target) {
	if (jQuery("#"+postVal).val() == "" )
		return false;
	jQuery.ajax({
		url: url,
		type: "POST",
		data: "prefixId="+postVal,
		success: function(data){
			jQuery("#"+target).val(data);
		}
	});
}

function switchShow (tarId, flag) {
	if (flag)
		jQuery("#"+tarId).show();
	else
		jQuery("#"+tarId).hide();
}