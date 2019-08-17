                    <script type="text/javascript">
					function timerIncrement() {
						idleTime = idleTime + 1;
						if (idleTime >= idleMax) { window.location="<?php echo base_url();?>/index.php/gear/logout";}
					}
					
					$(document).ready(function() {
					/*
					idleMax = 15;// Logout after 15 minutes of IDLE
					idleTime = 0;
						var idleInterval = setInterval(function() {timerIncrement();}, 60000); 
						$(this).mousemove(function (e) {idleTime = 0;});
						$(this).keypress(function (e) {idleTime = 0;});
					*/
						$( "#progressbar" ).progressbar({value: 0});
						$("").niceScroll();
						
						$("#da-sidebar a").click(function(){
							if($(this).attr("value") != "#")
							{ 	$( "#progressbar" ).progressbar({value: 1});
								var item = $(this);
								$("#progressbar .ui-progressbar-value").animate({ width: "100%" },
									{	
										complete: function() {
										window.location.href=item.attr("value");
								}});
								
							} 
						});
                      $('.slidemarginleft p').click(function() {
                        var $marginLefty = $(this).next();
                        $marginLefty.animate({
                          marginLeft: parseInt($marginLefty.css('marginLeft'),10) == 0 ?
                            $marginLefty.outerWidth() :
                            0
                        });
                      });
                    });
					
                    
                    </script>
					<style type="text/css"> 
.onmouse:hover{background-color:#f2efef;}
</style>
                        <style type="text/css">
                        .SlideMenu {
                          position: relative;
                          width: 215px;
                        }
                        .SlideMenu .inner {
                          background: none repeat scroll 0 0 #FFFFFF;
                          position: absolute;
                          width:215px;
						  margin-top:-16px;
                          margin-left:-241px;
                          height:560px;
                          overflow-x: hidden;
                          top: 18;
                          bottom: -555;
                          right: 0;
                          left: 0;
                          box-shadow:1px 0px 1px rgba(0, 0, 0, .3);
                        }
						
                    </style>
			
			<div id="da-header-bottom" style="background:<?= $tem['ColorHeadBottom']?>;">
                <!-- Container -->
                <div class="da-container clearfix" >
                     <?php 
                            if(isset($mainmenu)){
							if($this->session->userdata('MnID')){?>   
                	<div id="da-search" class="slidemarginleft">
						<p style="margin-bottom:0px">
							<a style="color: grey; text-decoration: none;" href="javascript:void(0)">
                                <span class="list-menu-image"><img src="<?php echo base_url(); ?>/images/icons/<?php echo $tem['ColorBottomButton']?>/32/new-list.png"></span>
                                <span class="list-menu-name" style="color:<?php echo $tem['ColorBottomButton']?>;">เมนู</span>
                            </a>
						</p>
                        <div id="da-sidebar" class="SlideMenu" >
                            <div class="inner" style="margin-top:5px">
                                <div id="da-main-nav" class="da-button-container" >
								<ul>  
                            <?php 
                            
                            foreach($mainmenu as $mn){
                                $url=(($mn['MnURL'] == "" || $mn['MnURL'] == "#" || $mn['MnURL'] == "-")?  "#" : $mn['MnURL'] ); ?>
                            <li>
                                <a value="<?php echo (($mn['MnURL'] == "" || $mn['MnURL'] == "" || $mn['MnURL'] == "-" || $mn['MnURL']== "#")?  "#" :base_url()."index.php/UMS_Controller/setMenu/".$mn['MnID']);?>">
                                    <!-- Icon Container -->
                                    <span class="da-nav-icon">
									<?php if($mn['MnIcon']==null){?>
										
									<?php }else{
												$path = $this->config->item('uploads_url');
												$pathString = $path."menu&image=".$mn['MnIcon'];
									?>
										<img src="<?php echo $pathString; ?>" alt="ระบบงาน-เมนู" />
									<?php }?>
                                    </span>
                                        <?php echo $mn['MnNameT'];?>
                                </a> 
                            <?php if($url=="#"){?>  
								<ul class="closed">
                                <?php foreach($submenu as $sub){
                                    if($sub['MnParentMnID'] == $mn['MnID']){?>
                                    <li><a value="<?php echo base_url()."index.php/"?>UMS_Controller/setMenu/<?php echo $sub['MnID'];?>">
                                    <span class="da-nav-icon">
									<?php if($sub['MnIcon']==null){?>
										
									<?php }else{
												$path = $this->config->item('uploads_url');
												$pathString = $path."menu&image=".$sub['MnIcon'];
									?>
										<img src="<?php echo $pathString; ?>" alt="ระบบงาน-เมนู" />
									<?php }?>
                                    </span>
									<?php echo $sub['MnNameT']?></a></li>
                                    
                                <?php }}?>
								</ul>
                            <?php }?>
                            </li>
                            <?php }?>
                        </ul>
                        
                    </div>
                            </div>
                        </div>
                    </div>
					<?php }} ?>
                	
                    <!-- Breadcrumbs -->
                    <div id="da-breadcrumb-<?php echo $tem['ColorBottomButton']?>">
                        <ul>
                            <li><a href="<?php echo base_url(); ?>index.php/gear"><img src="<?php echo base_url(); ?>/images/icons/<?php echo $tem['ColorBottomButton']?>/16/home.png" alt="Home" />Portal</a></li>
							<?php if($this->session->userdata('SysName')){?>
							<li><a href="<?php echo base_url()."index.php/".$this->session->userdata('HOME')?>"><?php echo $this->session->userdata('SysName');?></a></li>
							<?php 
									if(isset($sidebarpath)){
										foreach($sidebarpath as $path){?>
										<li><a href="<?php echo base_url()."index.php/UMS_Controller/setMenu/".$path['MnID'];?>"><?php echo $path['MnNameT'];?></a></li>
										<?php }
									} ?>
							<li><a href="<?php echo base_url()."index.php/".$this->session->userdata('MnURL')?>"><?php echo $this->session->userdata('MnNameT');?></a></li>
							<?php } ?>	
							<!--<li>ข้อมูลกลุ่มระบบงาน-กำหนดสิทธิ์ 
								<ul class="da-header-dropdown">
									
									<li class="item"><a href="</?php echo base_url();?>index.php/gear">Home</a></li>
									<li class="item"><a href="</?php echo base_url();?>index.php/UMS/showProfile">Profile</a></li>
									<li class="item"><a href="#">Settings</a></li>
									<li class="item"><a href="</?php echo base_url();?>index.php/user/ChangePassword">Change Password</a></li>
									
								</ul>
							</li>
							-->
                        </ul>
                    </div>
                    
                </div>
            </div>
			
			
		</div>
<div id="progressbar"></div>
<!-- Content -->
<div id="content">
      