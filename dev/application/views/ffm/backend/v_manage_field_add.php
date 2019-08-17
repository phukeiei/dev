<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
             <h2><i class="ti  ti-pencil-alt"></i>เพิ่มสนาม</h2>
            <div class="panel-ctrls"></div>
		</div>
		<div class="panel-body">
            <form method = "POST" onsubmit = "return validate()" action = "<?php echo site_url('/'.$dir.'/Field_manage/insert_field');?>">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ชื่อสนาม:</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name= "ff_name" id ="ff_name">
                        </div>
                    
                        <label class="col-sm-2 control-label">จำนวนคนที่รองรับ:</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name= "ff_size" id = "ff_size"> 
                        </div>
                    </div>   
                    <div class="form-group">
                    <label class="col-sm-2 control-label">สถานะ:</label>
                        
						<label class="radio-inline icheck">
							<input type="radio" value="Y" name="ff_status" checked="checked"> เปิดใช้งาน
						</label>
						<label class="radio-inline icheck">
							<input type="radio" value="N" name="ff_status"> ปิดใช้งาน
						</label>
						
                    </div>  
                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">ชนิดสนาม</label>
                        <div class="col-sm-8">
                            <label class="radio-inline icheck">
                                <input type="radio" id="inlineradio1" value="option1" name="optionsRadiosInline"> สนามหญ้าเทียม
                            </label>
                            <label class="radio-inline icheck">
                                <input type="radio" id="inlineradio1" value="option1" name="optionsRadiosInline"> สนามปูน
                            </label>
                        </div>
                    </div>  -->   
                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">สถานที่ตั้ง:</label>
                        <div class="col-sm-3">
                            <textarea class="form-control"></textarea>
                        </div>
                    </div>   -->
                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">รูปภาพ:</label>
                        <div class="col-sm-3">
                            <input type="file" class="form-control">
                        </div>
                    </div>  
                </div> -->
            
        </div>	<!-- panel-body -->
        <div class="panel-footer">
            <div style="float: left;">
                 <button class="btn btn-danger btn_iserl tooltips" title="คลิกปุ่มเพื่อยกเลิกข้อมูล" onclick="window.location='<?php echo site_url('/'.$dir.'/Field_manage');?>'" ><span>ยกเลิก</span></button>
            </div>
        
            <div style="float: right;">
                <button class="btn btn-success btn_iserl tooltips" title="คลิกปุ่มเพื่อบันทึกข้อมูล" ><span>บันทึก</span></button>
            </div>
            </form>
        </div>
	</div>	
</div>	
<!-- 19-05-2562 -->
<script>
	function validate(){
		var check = 0;
		var name = document.getElementById('ff_name').value;
		var size = document.getElementById('ff_size').value;
		if(name == ""){
			new PNotify({
								title: 'กรุณากรอกชื่อสนาม',
								text: '',
								type: 'danger',
								icon: 'ti ti-close',
								styling: 'fontawesome'
							});
							// PNotify();
			check++
		}
		
		if(size == ""){
			new PNotify({
								title: 'กรุณากรอกจำนวนคนที่รองรับ',
								text: '',
								type: 'danger',
								icon: 'ti ti-close',
								styling: 'fontawesome'
							});
							// PNotify();
			check++
		}
		if(check != 0){
			return false;
		}
		// return// false;
    }
    function get_name_type_by_id(id){
        var nametype = document.getElementById("complain-"+id).value; 
        console.log(nametype);
        document.getElementById("edit_name_type").value = nametype;
        document.getElementById("id_comment").value = id;
        }

 </script>