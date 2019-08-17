<style>
.center {
    text-align: center;
}
</style>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-content">
                <h2 class="card-title" style="text-align: center;">รายการแสดงการจอง</h2>
                        <div style=" display: inline; float: right; ">
                            <a href="<?php echo site_url('/ffm/frontend/C_test/show');?>" class= "btn btn-finish btn-fill btn-success btn-wd"> + ทำเรื่องจองสนาม</a>
                        </div>
            </div>
            <div class="col-sm-12">

                <div class="panel-body no-padding table-hover ">
                    <div class="center">
                        <table class="table table-striped">
                            <thead>
                                <tr class="info">
                                    <th style="color:black;">ลำดับ</th>
                                    <th style="color:black;">วันที่</th>
                                    <th style="color:black;">เวลา</th>
                                    <th style="color:black;">สนาม</th>
                                    <th style="color:black;">สถานะการจอง</th>

                                    <th style="color:black;">แก้ไข/ยกเลิก/ดาวน์โหลด</th>
                                    <th style="color:black;">แสดงความคิดเห็น</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index=1;
        
                foreach($rs_Mr as $row){
                    if($row->fr_status == 4 ){
                    }else if($this->session->userdata('UsPsCode') == $row->fr_ps_id){
                    ?>
                                <tr>
                                    <td><?php echo $index; ?></td>
                                    <td><?php echo fullDateTH3($row->fr_start_date); ?> </td>
                                    <td><?php echo $row->fr_start_time."-".$row->fr_end_time ?> </td>
                                    <td><?php echo $row->ff_name?></td>
                                    <td><?php echo $row->rs_name?></td>

                                    <td><?php if($row->fr_status !=2){?>
                                        <a rel="tooltip" class="btn btn-success btn-link btn-just-icon btn-sm"
                                            href="<?php echo site_url('/ffm/frontend/C_edit_reservation/Export_edit_reservation/'.$row->fr_id);?>"
                                            value="<?php echo $row->fr_id; ?>">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <?php } ?>



                                        <a rel="tooltip" class="btn btn-danger btn-link btn-just-icon btn-sm"
                                            href="<?php echo site_url('/ffm/frontend/C_list_reservation/delete_reservation/'.$row->fr_id);?>">
                                            <i class="material-icons">close</i>
                                        </a>
                                        <a  rel="tooltip"
                                            class="btn btn-danger btn-link btn-just-icon btn-sm"
                                            href="<?php echo site_url('/ffm/frontend/C_downloadpdf/export_pdf_With_Data/'.$row->fr_id);?>">
                                            <i class="material-icons">library_books</i>
                                        </a>
                                    </td>
                                    <td>
                                        <a rel="tooltip" class="btn btn-danger btn-link btn-just-icon btn-sm"
                                            href="<?php echo site_url('/ffm/frontend/C_complains/Export_ffm_complains_member/'.$row->fr_id);?>">
                                            <i class="material-icons">email</i>
                                        </a>
                                    </td>
                                </tr>
                                <?php $index++;}
                }?>
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>