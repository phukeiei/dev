<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading panel_table_iserl">
             <h2><i class="ti ti-settings"></i></i>จัดการประเภทความคิดเห็น</h2>
            <div class="panel-ctrls"></div>
        </div>
        <div class="panel-body">    
            <div class="col-md-3">
                <button class="btn btn-social btn-google btn_iserl tooltips ti ti-plus" title="คลิกปุ่มเพื่อเพิ่มประเภทความคิดเห็น" data-toggle="modal" href="#myModal" ><span> เพิ่มประเภทความคิดเห็น</span></button>
                <br><br>
            </div>
            
            <div class="col-md-12  col-sm-offset-2">
            <table style="width:65%" class="table table-striped table-bordered table_iserl no-footer table-hover dataTable-Export" cellspacing="0">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ประเภทความคิดเห็น</th>
                        <th>ดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index=0; foreach($rs as $row){ $index++  ?>
                        
                    <tr>
                        <td class="text-center" width="10%"><?php echo $index;?></td>  
                        <td style='text-align: left !important' width="30%"><?php echo $row->tp_complain;?></td>
                        <td class="text-center" width="25%">
                            <a class="btn btn-orange btn_iserl tooltips ti ti-pencil" title="คลิกปุ่มเพื่อแก้ไขข้อมูล" data-toggle="modal" href="#myModal2" onclick="get_name_type_by_id(<?php  echo $row->tp_id;?>) "></a>
                            
                            <a class="btn btn-danger btn_iserl tooltips ti ti-close" title="คลิกปุ่มเพื่อลบข้อมูล" data-toggle="modal" href="#" onclick="delete_complain(<?php echo $row->tp_id;?>);" ></a>
                            <input type="hidden" value = "<?php echo $row->tp_complain ;?>" id = "complain-<?php echo $row->tp_id;?>" >
                        </td>
                    </tr>
                        
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>  <!-- panel-body -->
        <div class="panel-footer">
            <div class="col-md-3">
                <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Complain');?>'"><span>ย้อนกลับ</span></button>
            </div>  
        </div>
    </div>  
</div>  
    
<!-- Modal -->
<form method="POST" onsubmit="return validate()" action="<?php echo site_url($dir.'/Type_complain/insert_complain_type'); ?>" > 
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div style="padding-top:5%" class="form-group">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
		        <div class="panel-heading panel_heading_iserl">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title">เพิ่มประเภทความคิดเห็น</h2>
                </div>
		        <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ชื่อประเภทความคิดเห็น</label>
                            <div class="col-sm-5">
                                <div class="input-group" >  
                                    <input type="text" class="form-control" id="typecomment" name="typecomment">
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-default" style="float:left;" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-success" style="float:right;">บันทึก</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
</form>


<!-- Modal -->
  <!-- FRZ ADD 19/05/62--> 
<form method="POST" action="<?php echo site_url($dir.'/Type_complain/update_complain_type'); ?>" > 
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div style="padding-top:5%" class="form-group">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
		        <div class="panel-heading panel_heading_iserl">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title">แก้ไขประเภทความคิดเห็น</h2>
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ชื่อประเภทความคิดเห็น</label>
                            <div class="col-sm-5">
                                <div class="input-group" >
                                    <!--<span class="input-group-addon"></span> -->
                                    <input type="text" class="form-control" name="typecomment" value ="" id="edit_name_type">
                                    <input type = "hidden" name = "id_comment" id = "id_comment"value ="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-default" style="float:left;" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-success" style="float:right;">บันทึก</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
</form>

<!-- Modal -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
         <form action ="<?php echo site_url('/'.$dir.'/Type_complain/type_complain_delete/' );?>" method="POST"> 
         <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">ลบประเภทความคิดเห็น</h4>
            </div>
            <div class="modal-body">
            
            <input type = "hidden" name = "tp_id" id = "tp_id">
            <center>
                <p>ท่านต้องการลบ</p>
            </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-defult" data-dismiss="modal">ไม่ใช่</button>
                <input type="submit" class="btn btn-danger"  value="ใช่">
                <!--<a class="btn btn-danger" href="<?php echo site_url('/'.$dir.'/Type_complain/type_complain_delete/'.$row->tp_id.'/' );?>">ใช่</a>
            --></div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    function delete_complain(id){
    bootbox.confirm({
        message: "คุณต้องการลบใช่หรือไม่",
        buttons: {
            confirm: {
                label: 'ยืนยัน',
                className: 'btn btn-success btn_iserl tooltips fa fa-check'
            },
            cancel: {
                label: 'ยกเลิก',
                className: 'btn btn-danger btn_iserl tooltips fa fa-times'
            }
        },
        callback: function (result) {
            if(result==true){
               (window.location="<?php echo site_url('/'.$dir.'/Type_complain/type_complain_delete/');?>"+'/'+id);
                    //successs
            }

        }
        
    });  
    }//end fn delete_field
    function validate(){
        var typecomment = document.getElementById('typecomment').value;
        if(typecomment == ""){
            alert('กรุณากรอกชื่อประเภทความคิดเห็น');
            return false;
        }
        
    }
    function get_name_type_by_id(id){
        var nametype = document.getElementById("complain-"+id).value; 
        console.log(nametype);
        document.getElementById("edit_name_type").value = nametype;
        document.getElementById("id_comment").value = id;
        }

    function get_tp_id(tp_id){

    //alert(tp_id);
    document.getElementById("tp_id").value = tp_id;
    //console.log(tp_id);
    //console.log(document.getElementById(tp_id).value);

    }


 </script>

<!--Finish Add -->