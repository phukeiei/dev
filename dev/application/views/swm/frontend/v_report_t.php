<!DOCTYPE html>
<html>
<head>
</head>
<body>

<br>
 
<table border = "1" class="table table-bordered table-hover table-striped m-n">
          <thead>
            <tr>
              <th><center><font size =5>ลำดับ</font></th>
              <th ><center><font size=5>วันที่เข้าใช้บริการ</font></th> 
              <th ><center><font size=5>เวลาเข้าใช้บริการ</font></th>
			  <th ><center><font size=5>สถานะ</font></th>
			  <th ><center><font size=5>อายุ</font></th>
			  
            </tr>
          </thead>
          <tbody>
<?php 
            foreach($rs_data_service as $index => $row)  { ?>                                                                                                                                                        
              <tr> 
                <td> <?php echo $index+1; ?></td> 
                <td> <?php echo fullDate2($row->sa_create_date); ?></td>
                <td> <?php echo $row->sa_time; ?></td>
				<td> <?php echo $row->ss_name; ?></td>
				<td> <?php echo calAge3($row->su_birthday); ?></td>
              </tr>
			 
			<?php }?>
			  </tbody>
        </table>      
		
		</body>
		</html>