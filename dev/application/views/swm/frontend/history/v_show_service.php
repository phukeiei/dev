<div class="col-md-12">
      <!-- Tabs with icons on Card -->
  <div class="card card-nav-tabs">
    <div class="card-header card-header-primary">
      <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
      <div class="nav-tabs-navigation">
        <div class="nav-tabs-wrapper">
        <h2><center>ประวัติการเข้าใช้บริการ</h2>
        </div>
      </div>
    </div>
    <div class="card-body "> 
      <div class="tab-content text-center">
        <table border="1" class="table table-bordered table-hover table-striped m-n">
          <thead>
            <tr>
              <th ><center><font size=5>ลำดับ</font></th>
              <th ><center><font size=5>วันที่เข้าใช้บริการ</font></th> 
              <th ><center><font size=5>เวลาเข้าใช้บริการ</font></th>
            </tr>
          </thead>
          <tbody>
          <?php 
          if($rs_data_service->num_rows() > 0 ){
            foreach($rs_data_service->result() as $index => $row)  { ?>                                                                                                                                                        
              <tr>
                <td> <?php echo $index+1; ?></td>
                <td> <?php echo fullDate2($row->sa_create_date); ?></td>
                <td><?php echo $row->sa_time; ?></td>
              </tr>
              <?php 
                }
          }else{ ?>
            <tr><td colspan='3'>ไม่พบข้อมูลการใช้บริการ</td><tr>
          <?php }  ?>
          </tbody>
        </table>            
      </div>
      <div class="panel-footer">
          <div class="col-md-12">
              <a class="btn btn-inverse" href="<?php echo site_url('/swm/frontend/Swm_show_service'); ?>">ย้อนกลับ</a>
          </div>
      </div>
    </div>
  </div>
   <!-- End Tabs with icons on Card -->
</div>
