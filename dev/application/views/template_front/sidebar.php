<div id="wrapper">
    <div id="layout-static">
		<div class="static-sidebar-wrapper sidebar-default">
            <div class="static-sidebar">
                <div class="sidebar">
					<div class="widget">
						<div class="widget-body">
							<div class="userinfo">
								<div class="avatar">
									<?php if(isset($pic)){ ?>
										<img src="<?php echo $pic;?>" class="img-responsive img-circle"> 
									<?php }else{ ?>
										<!--<img src="<?php echo base_url();?>images/OPEN_SAMs/img/person.png" class="img-responsive img-circle">-->
										<img src="<?php echo base_url();?>backend/images/default.png" class="img-responsive img-circle"> <!-- edit by naruecha 17/03/2017 -->
									<?php }?>
								</div>
								<div class="info">
									<span class="username"><?php echo $this->session->userdata('UsName'); ?></span><br>
									<span class="useremail"><?php echo $this->session->userdata('GpName')." ".$this->session->userdata('dpName'); ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="widget stay-on-collapse" id="widget-sidebar">
						<nav role="navigation" class="widget-body" >
							<ul class="acc-menu" style="width:500px">
								<li class="nav-separator"><span style="fonts-size:25px">Menu</span></li>
								<li style="width:500px"><a href="<?php echo base_url();?>index.php/gear"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-home fa-stack-1x fa-inverse"></i></span><span>&emsp;Home</span></a></li>
							    <?php 
								if(isset($mainmenu)){                          
									foreach($mainmenu as $mn){ 
										$url=(($mn['MnURL'] == "" || $mn['MnURL'] == "#" || $mn['MnURL'] == "-")?  "#!" : $mn['MnURL'] ); ?>
								<li style="width:500px">
                                <a href="<?php echo (($mn['MnURL'] == "" || $mn['MnURL'] == "" || $mn['MnURL'] == "-" || $mn['MnURL']== "#")?  "#!" :base_url()."index.php/UMS_Controller/setMenu/".$mn['MnID']);?>">
                                    <!-- Icon Container -->
									<?php if($mn['MnIcon']==null){}
									else{
										$path = $this->config->item('uploads_url');
										$pathString = $path."menu&image=".$mn['MnIcon'];
									?>
										<img width="37" height="37" src="<?php echo $pathString; ?>" alt="ระบบงาน-เมนู" />
									<?php }?>
										
                                        <?php 
										if($this->session->userdata('Language')=="EN"){
											echo $mn['MnNameE'];
										}else{
											echo $mn['MnNameT'];
									}?>
                                </a>
								<?php if($url=="#!"){?>  
								<ul class="acc-menu" style="width:445px">
								<?php foreach($submenu as $sub){
                                    if($sub['MnParentMnID'] == $mn['MnID']){?>
                                    <li style="width:445px"><a href="<?php echo base_url()."index.php/"?>UMS_Controller/setMenu/<?php echo $sub['MnID'];?>">
                                    
									<?php if($sub['MnIcon']==null){?>
										
									<?php }else{
												$path = $this->config->item('uploads_url');
												$pathString = $path."menu&image=".$sub['MnIcon'];
									?>
										<img width="30" height="30" src="<?php echo $pathString; ?>" alt="ระบบงาน-เมนู" />
									<?php }?>
									<?php if($this->session->userdata('Language')=="EN"){
											echo $sub['MnNameE'];
										}else{
											echo $sub['MnNameT'];
									}?></a></li>
                                    
                                <?php }}?>
								</ul>
                            <?php }?>
                            </li>
									
									<?php }}?>
							</ul>
						</nav>
					</div>
				</div>
            </div>
        </div>
		<div class="static-content-wrapper">
			<div class="static-content">
				<div class="page-content">