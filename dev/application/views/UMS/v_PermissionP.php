<script type="text/javascript" src="<?php echo base_url(); ?>/js/ums/permission.js"></script>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal">
			<div class="panel-heading">
				<?php foreach($show as $show){?>
				<h2><img src="<?php echo base_url(); ?>/images/icons/black/16/users.png" alt="" /><?php echo nbs(2);?>กำหนดกลุ่มระบบงานของผู้ใช้ &nbsp &nbsp<?php echo $show['StNameT'];?> &nbsp &nbsp &nbsp(กลุ่มงาน<?php echo $show['GpNameT'];?>) &nbsp ของ <?php foreach($name as $name){ echo $name['UsName']; }?></h2>
				<?php } ?>	
				<div class="panel-ctrls"></div>
			</div>
			<form class="form-horizontal row-border" method="post" action="<?php echo base_url(); ?>index.php/UMS/perMissionP/upPer" >
				<div class="page-body">
					<table class="table table-striped">
									
						<thead>
							<tr>
								<th width="5%">#</th>
								<th width="70%">ชื่อเมนูที่เข้าถึง</th>
								<th width="5%">X</th>
								<th width="5%">C</th>
								<th width="5%">R</th>
								<th width="5%">U</th>
								<th width="5%">D</th>
							</tr>
						</thead>
						<tbody>
						 
						<?php $i=1;
							foreach ($menu as $menu) { ?>
							<tr>
								<td><?php echo $i; ?></td>
								<?php 
								if($menu['MnLevel']== 0)
								{?><td><b><?php echo $menu['MnNameT']; ?></b></td><?php }
								 
								else if($menu['MnLevel']== 1)
								{?><td> &nbsp; <?php echo $menu['MnNameT']; ?></td><?php
								}								
								else
								{?><td>&nbsp; &nbsp; &nbsp; &nbsp;<?php echo $menu['MnNameT']; ?></td><?php } ?>
								
								<input type="hidden" name ="MnStID" value = "<?php echo $menu['MnStID']; ?>">
								<input type="hidden" name ="UsID" value = "<?php echo $UsID; ?>">
								
								<?php 
								
								$x ="checked";
								$c ="checked";													
								$r ="checked";
								$u ="checked";
								$d ="checked";
								$xcrud_control = "11111";
								
								foreach($permission as $per){
									if($checkper == 1){
										if($menu['MnID'] == $per['pmMnID']){
											$x = ($per['pmX']==1)? "checked" : "";
											$c = ($per['pmC']==1)? "checked" : "";
											$r = ($per['pmR']==1)? "checked" : "";
											$u = ($per['pmU']==1)? "checked" : "";
											$d = ($per['pmD']==1)? "checked" : "";
											$xcrud_control[0] = ($per['pmX']==1)? "1" : "0";
											$xcrud_control[1] = ($per['pmC']==1)? "1" : "0";
											$xcrud_control[2] = ($per['pmR']==1)? "1" : "0";
											$xcrud_control[3] = ($per['pmU']==1)? "1" : "0";
											$xcrud_control[4] = ($per['pmD']==1)? "1" : "0";
										}
									}
									else{
										if($menu['MnID'] == $per['gpMnID']){
											$x = ($per['gpX']==1)? "checked" : "";
											$c = ($per['gpC']==1)? "checked" : "";
											$r = ($per['gpR']==1)? "checked" : "";
											$u = ($per['gpU']==1)? "checked" : "";
											$d = ($per['gpD']==1)? "checked" : "";
											$xcrud_control[0] = ($per['gpX']==1)? "1" : "0";
											$xcrud_control[1] = ($per['gpC']==1)? "1" : "0";
											$xcrud_control[2] = ($per['gpR']==1)? "1" : "0";
											$xcrud_control[3] = ($per['gpU']==1)? "1" : "0";
											$xcrud_control[4] = ($per['gpD']==1)? "1" : "0";
										}
									}
								}
								?>
								<td>
									<input type="checkbox" name = "<?php echo $menu['MnID'];?>x" id="<?php echo $menu['MnID'];?>x" <?php echo $x; ?>>
								</td>
								<td>
									<input type="checkbox" name = "<?php echo $menu['MnID'];?>c" id="<?php echo $menu['MnID'];?>c" <?php echo $c; ?>>
								</td>
								<td>
									<input type="checkbox" name = "<?php echo $menu['MnID'];?>r" id="<?php echo $menu['MnID'];?>r" <?php echo $r; ?>>
								</td>
								<td>
									<input type="checkbox" name = "<?php echo $menu['MnID'];?>u" id="<?php echo $menu['MnID'];?>u" <?php echo $u; ?>>
								</td>
								<td>
									<input type="checkbox" name = "<?php echo $menu['MnID'];?>d" id="<?php echo $menu['MnID'];?>d" <?php echo $d; ?>>
									<input type="hidden" id="hidden<?php echo $menu['MnID'];?>control" name="hidden<?php echo $menu['MnID'];?>control" value="<?php echo $xcrud_control;?>" >
								</td>
								
							</tr>
							<?php //break;
							$i+=1;}?>
						</tbody>						
					</table>
				</div>
				<div class="panel-footer">
					<input  id="submit" class="btn-success btn pull-right" type="submit"  name="submit" value="บันทึก" ></input>
				</div>
			</form>
		</div>
	</div>
</div>
 