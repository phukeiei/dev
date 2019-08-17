<script>
function removemenu(MnID,count)
{
	var web="<?php echo base_url()?>index.php/UMS/showSystem/removemenu/"+MnID;
	if(count==0){
		bootbox.confirm("คุณต้องการลบหรือไม่?", function(result) {
		  if(result==true){
			  window.location.href=web;
		  }
		});
	}
	else
	{
		alert("เมนูนี้มีเมนูย่อยไม่สามารถลบได้")
		return false
	}
}	

$(document).ready(function(){
	<?php 
		if($OK == 1){?>
			notics_succuess();
	<?php	} 
		if($OK == 2){?>
			notics_error();
	<?php }?>
});

function notics_succuess(){
	new PNotify({title: 'New Thing',
		title: 'Success',
		text: 'บันทึกข้อมูลเสร็จสมบูรณ์',
		type: 'success',
		icon: 'ti ti-check',
		styling: 'fontawesome'
	});
}

function notics_error(){
	new PNotify({title: 'New Thing',
		title: 'เกิดข้อผิดพลาด!',
		text: 'ชื่อเมนูนี้มีอยู่แล้ว กรุณาสร้างใหม่',
		type: 'error',
		icon: 'ti ti-close',
		styling: 'fontawesome'
	});
}
</script>
<link href="<?php echo base_url();?>backend/css/ums/panel.css" rel="stylesheet" type="text/css">				
<script type="text/javascript" src="<?php  echo base_url(); ?>backend/js/ums/demo.tableMenu.js"></script>
	<!-- Main Content Wrapper -->
                	<div class="row">
                    	<div class="grid_4_center">
                        	<div class="da-panel">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
										<i class="fa fa-bars" style="font-size:22px"></i>		กำหนดเมนูระบบ
                                    </span>
                                </div>
								<form method="post" action="<?php  echo base_url(); ?>index.php/UMS/showSystem/SaveSeq">
                                <div class="da-panel-content with-padding">
									
									<?php   foreach( $menu1 as $main ) { 
											$MnID = $this->encryption->encrypt($main['MnID']);
											$ID = str_replace("/","_",$MnID);
											$ID = str_replace("+",":",$ID);
											$MnID = str_replace("=","~",$ID);
											$MnStID = $this->encryption->encrypt($main['MnStID']);
											$ID = str_replace("/","_",$MnStID);
											$ID = str_replace("+",":",$ID);
											$MnStID = str_replace("=","~",$ID);
											
										if ($main['MnLevel']==0||$main['MnParentMnID']==NULL){?>
									<div class="Menu">
										<div class="Menu-header">
											<div class="Desc">
												<?php echo $main['MnNameT'];?>
												<input type="hidden" name="Seq[]" value="<?php echo $main['MnID']?>"/>
											</div>
											<div class="Option">
												<i class="fa fa-plus tooltips" title="เพิ่มข้อมูล" style="cursor:pointer;color:green;font-size:20px" onclick="window.location.href='<?php  echo base_url(); ?>index.php/UMS/showSystem/addMenu/<?php echo $MnID."/".$MnStID;?>' "></i>
												&nbsp;<i class="fa fa-edit tooltips" title="แก้ไขข้อมูล" style="cursor:pointer;color:#1E90FF;font-size:20px" onclick="window.location.href='<?php  echo base_url(); ?>index.php/UMS/showSystem/editMenu/<?php echo $MnID."/".$MnStID;?>'"></i>
												<?php  $count=0;
												foreach($menu1 as $countsub){
													if($countsub['MnParentMnID']==$main['MnID']){
													$count++;}}
												?>
												&nbsp;<i class="fa fa-times-circle tooltips" title="ลบ" style="cursor:pointer;color:red;font-size:20px" onclick='return removemenu(<?php echo $main['MnID']?>,<?php echo $count; ?>);' ></i>
											</div>
										</div>
										<div class="Menu-content">
										<?php foreach ($menu1 as $sub) {
											$MnID = $this->encryption->encrypt($sub['MnID']);
											$ID = str_replace("/","_",$MnID);
											$ID = str_replace("+",":",$ID);
											$MnID = str_replace("=","~",$ID);
											$MnStID = $this->encryption->encrypt($sub['MnStID']);
											$ID = str_replace("/","_",$MnStID);
											$ID = str_replace("+",":",$ID);
											$MnStID = str_replace("=","~",$ID);
											if($sub['MnParentMnID']==$main['MnID']) {  
												$i=0;
												foreach($menu1 as $sub2count) {
												if($sub2count['MnParentMnID']==$sub['MnID']) {
													$i++;
													foreach($menu1 as $sub3count) {
													if($sub3count['MnParentMnID']==$sub2count['MnID']) {
													$i++;
														foreach($menu1 as $sub4count) {
														if($sub4count['MnParentMnID']==$sub3count['MnID']) {
														$i++;
														}}
													}}
												}}
												
											?>
											<div class="SubMenu" style="margin-bottom:<?php echo $i*29.2?>px">
												<div class="Sub-header">
													<div class="Desc">
														<?php  echo $sub['MnNameT']; ?>
														<input type="hidden" name="Seq[]"  value="<?php echo $sub['MnID']?>"/>
													</div>
													<div class="Opt">
														<i class="fa fa-plus tooltips" title="เพิ่มข้อมูล" style="cursor:pointer;color:green;font-size:20px" onclick="window.location.href='<?php  echo base_url(); ?>index.php/UMS/showSystem/addMenu/<?php echo $MnID."/".$MnStID;?>' " ></i>
														&nbsp;<i class="fa fa-edit tooltips" title="แก้ไขข้อมูล" style="cursor:pointer;color:#1E90FF;font-size:20px" onclick="window.location.href='<?php  echo base_url(); ?>index.php/UMS/showSystem/editMenu/<?php echo $MnID."/".$MnStID;?>'"></i>
														<?php  $count=0;
														foreach($menu1 as $countsub2){
														if($countsub2['MnParentMnID']==$sub['MnID']){
														$count++;}}
														?>
														&nbsp;<i class="fa fa-times-circle tooltips" title="ลบ" style="cursor:pointer;color:red;font-size:20px" onclick='return removemenu(<?php echo $sub['MnID']?>,<?php echo $count; ?>);'></i>
													</div>
												</div>
													
												<div class="Sub-content">
													<?php 	foreach ($menu1 as $subsub) {
														$MnID = $this->encryption->encrypt($subsub['MnID']);
														$ID = str_replace("/","_",$MnID);
														$ID = str_replace("+",":",$ID);
														$MnID = str_replace("=","~",$ID);
														$MnStID = $this->encryption->encrypt($subsub['MnStID']);
														$ID = str_replace("/","_",$MnStID);
														$ID = str_replace("+",":",$ID);
														$MnStID = str_replace("=","~",$ID);
													
														if($subsub['MnParentMnID']==$sub['MnID']) { 
													
														$j=0;
														foreach($menu1 as $sub3count) {
														if($sub3count['MnParentMnID']==$subsub['MnID']) {
														$j++;
															foreach($menu1 as $sub4count) {
															if($sub4count['MnParentMnID']==$sub3count['MnID']) {
															$j++;
															}}
														}}
													
													?>
													<div class="SubSubMenu" style="margin-bottom:<?php echo $j*28.5?>px">
														<div class="SubSub-header">
															<div class="SSDesc">
																<?php  echo $subsub['MnNameT']; ?>
																<input type="hidden" name="Seq[]" value="<?php echo $subsub['MnID']?>" />
															</div>
															<div class="SSOpt">
																<i class="fa fa-plus tooltips" title="เพิ่มข้อมูล" style="cursor:pointer;color:green;font-size:20px" onclick="window.location.href='<?php  echo base_url(); ?>index.php/UMS/showSystem/addMenu/<?php echo $MnID."/".$MnStID;?>' " ></i>
																&nbsp;<i class="fa fa-edit tooltips" title="แก้ไขข้อมูล" style="cursor:pointer;color:#1E90FF;font-size:20px" onclick="window.location.href='<?php  echo base_url(); ?>index.php/UMS/showSystem/editMenu/<?php echo $MnID."/".$MnStID;?>'"></i>
																<?php  $count=0;
																foreach($menu1 as $countsub3){
																if($countsub3['MnParentMnID']==$subsub['MnID']){
																$count++;}}
																?>
																&nbsp;<i class="fa fa-times-circle tooltips" title="ลบ" style="cursor:pointer;color:red;font-size:20px" onclick='return removemenu(<?php echo $subsub['MnID']?>,<?php echo $count; ?>);'></i>
															</div>
														</div>
														<div class="SubSub-content">
														<?php 	foreach ($menu1 as $sub3) {
															$MnID = $this->encryption->encrypt($sub3['MnID']);
															$ID = str_replace("/","_",$MnID);
															$ID = str_replace("+",":",$ID);
															$MnID = str_replace("=","~",$ID);
															$MnStID = $this->encryption->encrypt($sub3['MnStID']);
															$ID = str_replace("/","_",$MnStID);
															$ID = str_replace("+",":",$ID);
															$MnStID = str_replace("=","~",$ID);
															if($sub3['MnParentMnID']==$subsub['MnID']) { 
															
															$k=0;
															foreach($menu1 as $sub4count) {
															if($sub4count['MnParentMnID']==$sub3['MnID']) {
															$k++;
															}}
															?>
															<div class="Sub3Menu" style="margin-bottom:<?php echo $k*28.9?>px">
																<div class="Sub3-header">
																	<div class="S3Desc">
																		<?php  echo $sub3['MnNameT']; ?>
																		<input type="hidden" name="Seq[]"  value="<?php echo $sub3['MnID']?>"/>
																	</div>
																	<div class="S3Opt">
																		<i class="fa fa-plus tooltips" title="เพิ่มข้อมูล" style="cursor:pointer;color:green;font-size:20px" onclick="window.location.href='<?php  echo base_url(); ?>index.php/UMS/showSystem/addMenu/<?php echo $MnID."/".$MnStID;?>'"></i>
																		&nbsp;<i class="fa fa-edit tooltips" title="แก้ไขข้อมูล" style="cursor:pointer;color:#1E90FF;font-size:20px" onclick="window.location.href='<?php  echo base_url(); ?>index.php/UMS/showSystem/editMenu/<?php echo $MnID."/".$MnStID;?>'"></i>
																		<?php  $count=0;
																		foreach($menu1 as $countsub4){
																		if($countsub4['MnParentMnID']==$sub3['MnID']){
																		$count++;}}
																		?>
																		&nbsp;<i class="fa fa-times-circle tooltips" title="ลบ" style="cursor:pointer;color:red;font-size:20px" onclick='return removemenu(<?php echo $sub3['MnID']?>,<?php echo $count;?>);'></i>
																	</div>
																</div>
																<div class="Sub3-content">
																<?php 	foreach ($menu1 as $sub4) {
																	$MnID = $this->encryption->encrypt($sub4['MnID']);
																	$ID = str_replace("/","_",$MnID);
																	$ID = str_replace("+",":",$ID);
																	$MnID = str_replace("=","~",$ID);
																	$MnStID = $this->encryption->encrypt($sub4['MnStID']);
																	$ID = str_replace("/","_",$MnStID);
																	$ID = str_replace("+",":",$ID);
																	$MnStID = str_replace("=","~",$ID);
																	if($sub4['MnParentMnID']==$sub3['MnID']) { 
																	?>
																	<div class="Sub4Menu">
																		<div class="Sub4-header">
																			<div class="S4Desc">
																				<?php  echo $sub4['MnNameT']; ?>
																				<input type="hidden" name="Seq[]"  value="<?php echo $sub4['MnID']?>"/>
																			</div>
																			<div class="S4Opt">
																				&nbsp;<i class="fa fa-edit tooltips" title="แก้ไขข้อมูล" style="cursor:pointer;color:#1E90FF;font-size:20px" onclick="window.location.href='<?php  echo base_url(); ?>index.php/UMS/showSystem/editMenu/<?php echo $MnID."/".$MnStID;?>'"></i>
																				<?php  $count=0;
																				foreach($menu1 as $countsub4){
																					if($countsub4['MnParentMnID']==$sub4['MnID']){
																					$count++;}
																				}
																				?>
																				&nbsp;<i class="fa fa-times-circle tooltips" title="ลบ" style="cursor:pointer;color:red;font-size:20px" onclick='return removemenu(<?php echo $sub4['MnID']?>,<?php echo $count; ?>);'></i>
																			</div>
																		</div>
																	</div>
																	<?php  }
																	} ?>
																</div>
															</div>
															<?php  }
															} ?>
														</div>
													</div>
													<?php  }
													} ?>
												</div>
											</div>
											<?php  } }?>
										</div>
									</div>
									<?php }}?>
									
								</div>
								<div class="da-panel-content with-padding">
									<div class="Add">
										<div class="Menu-header">
											<div class="Desc">
												<?php   foreach( $menu1 as $main2 ) {		
														$MnStID = $this->encryption->encrypt($main2['MnStID']);
														$ID = str_replace("/","_",$MnStID);
														$ID = str_replace("+",":",$ID);
														$MnStID = str_replace("=","~",$ID);
												?>
												<input type="hidden" name="MnStID" value="<?php echo $MnStID?>">
												<?php }?>
												<input class="btn-success btn pull-left" type="submit" value="บันทึก" name="submit">
											</div>
											</form>
											<div class="Option">
												<?php   foreach( $menu1 as $main1 ) {		
														$MnStID = $this->encryption->encrypt($main1['MnStID']);
														$ID = str_replace("/","_",$MnStID);
														$ID = str_replace("+",":",$ID);
														$MnStID = str_replace("=","~",$ID);
												?>
									<i class="fa fa-plus tooltips pull-right" title="เพิ่มข้อมูล" style="cursor:pointer;color:green;font-size:20px" onclick="window.location.href='<?php  echo base_url(); ?>index.php/UMS/showSystem/addMain/<?php echo $MnStID;?>' "></i>
                                    <br/>
									<?php  break; } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
