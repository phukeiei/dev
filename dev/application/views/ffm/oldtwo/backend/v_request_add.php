<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
             <h2><i class="fas fa-history"></i>เพิ่มรายการคำร้องขอใช้สนาม</h2>
            <div class="panel-ctrls"></div>
            
		</div>

        <div class="panel-body">
            <div class="form-horizontal">
                 <div class="form-group">
                    <label class="col-sm-2 control-label">ชื่อผู้ใช้:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control">
                    </div>
                    <label class="col-sm-2 control-label">วันที่จอง:</label>
                    <div class="col-sm-3">
                        <div >
                            <input type="date" class="input-small form-control" name="start1" />
                         
                        </div>
                    </div>
                </div>   
                <div class="form-group">
                <label class="col-sm-2 control-label">สนามที่:</label>
                    <div class="col-sm-3">
                        <div class="input-daterange input-group">
                        <select class="form-control">
                            <option value="">1</option>
                             <option value="">2</option>
                             <option value="">3</option>
                             <option value="">4</option>
                             <option value="">5</option>
                             <option value="">6</option>
                        </select>
                    
                        </div>
                    </div>
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
                </div>     -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">เพิ่มเติม:</label>
                    <div class="col-sm-4">
                         <textarea class="form-control"></textarea>
                    </div>
                </div>  
                            </div>
        </div>	<!-- panel-body -->
        <div class="panel-footer">
            <div style="float: left;">
                 <button class="btn btn-danger btn_iserl tooltips" title="คลิกปุ่มเพื่อยกเลิกข้อมูล" onclick="window.location='<?php echo site_url('/'.$dir.'/Football/v_request_list');?>'" ><span>ยกเลิก</span></button>
            </div>
        
            <div style="float: right;">
                <button class="btn btn-success btn_iserl tooltips" title="คลิกปุ่มเพื่อบันทึกข้อมูล" ><span>บันทึก</span></button>
            </div>
            
        </div>