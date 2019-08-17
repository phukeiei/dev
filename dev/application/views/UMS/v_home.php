<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2>
					<ul class="nav nav-tabs">
						<?php foreach($mainmenu as $key =>$MnMain){ ?>
						<?php if($this->session->userdata('Language')=="EN"){?>
							<li class="<?php if($key ==0){echo "active";}?>"><a href="#tab<?php echo $key;?>" data-toggle="tab"><?php echo $MnMain['MnNameE'];?></a></li>
						<?php }else{ ?>
							<li class="<?php if($key ==0){echo "active";}?>"><a href="#tab<?php echo $key;?>" data-toggle="tab"><?php echo $MnMain['MnNameT'];?></a></li>
						<?php } }?>
					</ul>
				</h2>
			</div>
			<div class="panel-body">
				<div class="tab-content">
					<?php foreach($mainmenu as $key =>$MnMain){ ?>
					<div class="tab-pane <?php if($key ==0){echo "active";}?>" id="tab<?php echo $key;?>">
						<?php foreach($submenu as $MnSub){
							if($MnSub['MnParentMnID'] == $MnMain['MnID']){?>
							<div class="col-md-4">
								<div class="panel panel-green" style="cursor:pointer" onclick='window.location="<?php echo base_url();?>index.php/UMS_Controller/setMenu/<?php echo $MnSub['MnID'];?>"'>
									<div class="panel-heading">
										<h2>
											<?php
												if($this->session->userdata('Language')=="EN"){
													echo $MnSub['MnNameE'];
												}else{
													echo $MnSub['MnNameT'];
											}?>
										</h2>
									</div>
									<div class="panel-body" >
										<?php $path = $this->config->item('uploads_url');
											  $pathString = $path."menu&image=".$MnSub['MnIcon']; ?>
										<img height="42" width="42" src="<?php echo $pathString; ?>" alt="" />
										<?php
											if($this->session->userdata('Language')=="EN"){
												echo $MnSub['MnNameE'];
											}else{
												echo $MnSub['MnNameT'];
											}?>
									</div>
								</div>
							</div>
						<?php }}?>
					</div><?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
