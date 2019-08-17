<script>
$(document).ready(function(){
	$('body').on('click', '#selectAll', function () {
				// console.log($(this).hasClass('allChecked'));
				if ($(this).hasClass('allChecked')) {
					$('.tb_menu').find('input[type="checkbox"]').prop('checked', false);
					$(this).text('เลือกทั้งหมด').attr('class','btn btn-success pull-right');
				} else {
					// console.log($(this));
					$('.tb_menu').find('input[type="checkbox"]').prop('checked', true);
					$(this).attr('class','btn btn-primary pull-right allChecked');
					$(this).text('ยกเลิกทั้งหมด');
				}
				// $(this).toggleClass('allChecked');
				
	});   
	
	$('.tb_menu tbody ').on('click', 'tr', function () {
		$(this).find('td:eq(0) input[type="checkbox"]').trigger('click');
	});
	
});   
	
	
function count_check(){
    console.log(1);
    var i=0;
    var arr_data = new Array();
    $('input[name="stid[]"]:checked').each(function(){
        
        arr_data.push($(this).val());
        i++;
    });
    console.log(i);
    console.log(arr_data);
    $('#count_check').html(i);
}
// function clear(){
	
    // $('input[type="checkbox"]').attr("checked",false);
// }
// function check_all(){
    // $('input[type="checkbox"]').attr("checked",true);
// }


function check_parent(parent,id){
    // console.log(parent);
    var i=0;
    if($('#idm'+parent).prop("checked")==true){
        if(id!=parent){
            $('input[id="ids'+parent+'"]:checked').each(function(){
                i++;
            });
            if(i==0){
                $('#idm'+parent).prop("checked",false);
            }
        }
        //$('#idm'+parent).removeAttr("checked");
        //$('#idm'+parent).attr("checked",false);
    }else{
        $('#idm'+parent).prop("checked",true);
    }
   
}

function check_child(parent,id){
    // console.log(parent);
    // console.log(id);
    var i=0;
   
    if($('#idm'+id).prop("checked")==true){
        $('.ids'+id).prop("checked",true);
        
        //$('#idm'+parent).removeAttr("checked");
        //$('#idm'+parent).attr("checked",false);
    }else{
        $('.ids'+id).prop("checked",false);
        
    }
   
}


function go_export_sub_excel(attr_type) {
   
	if(attr_type=='export'){
		$("#formmenu").submit();
    }else{
		$('#exampleModal').modal('hide')
		 $("#formmenu").attr('action','<?php echo site_url("UMS/CopySystemmenu/test_import_another/")?>');
		 $('#site-to').val($('#selector1').val());
		 $("#formmenu").submit();
	}
}

function export_modal(){
	$('#exampleModal').modal('toggle');
}
</script>
    <style>
        td#main{
            color:red;
        }
        </style>
<?php $tab = "&nbsp;&nbsp;&nbsp;&nbsp;"; //echo "<pre>";
//print_r($menu1); ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-blue">
			<div class="panel-heading">
				<h2><i class="fa fa-database" style="font-size:26px"></i><?php echo nbs(2);?>ข้อมูลระบบ</h2>
				
				
			</div>
			<div class="panel-body no-padding" >
			<form id="formmenu"action="<?php echo site_url("UMS/CopySystemmenu/export_excel/")?>" method="post">
				<table  class="table table-striped table-bordered tb_menu" cellspacing="0" width="100%">
					<tbody>
                        <?php 
                        $ID = 0;
                        //echo "<pre>";
                        //print_r ($menu1);
                        
                        foreach($menu1 as $main ){
                            if ($main['MnStID']!==NULL){
                                if ($main['MnStID']!== $ID && $main['MnStID']!==NULL){
						?>
                                <tr>
                                    <td id = "main"> 
										<?php echo $main['StNameT'];?>
										 <?php echo $tab; ?>
										<button type="button" class="btn btn-success pull-right" id="selectAll" >เลือกทั้งหมด</button>
                                    </td>
                                </tr>
                        <?php   }

                                if ($main['MnLevel']==0||$main['MnParentMnID']==NULL){ ?>
                                    <tr>
                                        <td>
                                    <?php echo $tab; ?>
                                    <input type = "checkbox" onchange="check_child(<?php echo $main['MnParentMnID']; ?>,<?php echo $main['MnID']; ?>)" name= "stid[]" id="idm<?php echo $main['MnID']?>" value="<?php echo $main['MnID']; ?>">
                                    <?php echo $main['MnNameT'];?>
											
                                        </td>
                                    </tr>
                                    <?php foreach ($menu1 as $sub) {
                                        if($sub['MnParentMnID']==$main['MnID']) {  ?>
                                        <tr>
                                            <td>
                                                <?php echo $tab.$tab; ?>
                                                <input type = "checkbox" onchange="check_parent(<?php echo $sub['MnParentMnID']; ?>,<?php echo $sub['MnID']; ?>)" name= "stid[]" class="ids<?php echo $sub['MnParentMnID']?>" id="ids<?php echo $sub['MnParentMnID']?>" value="<?php echo $sub['MnID']; ?>">
                                                <?php echo "&emsp;".$sub['MnNameT'];?>
                                            </td>
                                        </tr>
                                    <?php } 
                                    } ?>
                        <?php  } 
                                $ID = $main['MnStID'];
                            }
                        } ?> 
                        <input type = "hidden" value = "<?php echo $main['MnStID']?>" name="sy_id" id = "sy_id">
                        <input type = "hidden" value = "" id = "site-to" name="site-to">
                    </tbody>
                </table>
			</div>
			<div class="panel-footer">
				
				
				<!--<button type="button" class="btn btn-danger-alt btn-lg pull-right" onclick="go_export_sub_excel('')">Import To Other Site</button>-->
				<button type="button" class="btn btn-danger-alt btn-lg pull-right" onclick="export_modal('')">Import To Other Site</button>
				<button type="button" class="pull-right btn btn-info-alt btn-lg" onclick="go_export_sub_excel('export')"  target="_blank">
                        <i style='font-size: 16px;' title='ส่งออก excel' class='fa fa-file-excel-o tooltips'>  ส่งออก</i>
				</button>
				
				<a href="<?php echo site_url("UMS/CopySystemmenu/")?>" class="pull-left btn btn-inverse btn-lg">ย้อนกลับ</a>
				<form>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เลือก site ที่ต้องการ export </h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">	
        </button>
      </div>
      <div class="modal-body">
		<div class="form-horizontal">
		
		<div class="form-group">
			<label for="selector1" class="col-sm-2 control-label"></label>
			<div class="col-sm-8">
				<select name="selector1" id="selector1" class="form-control">
					<?php foreach($rs_site as $row_dp){
					?>
						<option value="<?php echo $row_dp->dpNameEnAbbr;?>"><?php echo $row_dp->dpName;?></option>
						
					<?php } ?>
				</select>
			</div>
		</div>
			
		
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="go_export_sub_excel('')">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!--<link href="<?php echo base_url();?>css/ums/panel.css" rel="stylesheet" type="text/css">-->				