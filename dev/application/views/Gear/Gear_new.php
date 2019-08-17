<div class="section section-basic">
	<div class="container">
		 <div class="row">
			<div class="col-md-12">
				
				<!-- Tabs with icons on Card -->
				<?php foreach($system as $sys) {?>
				<div class="card card-nav-tabs">
					<div class="header header-info">
						<!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
						<div class="nav-tabs-navigation">
							<div class="nav-tabs-wrapper">
								<ul class="nav nav-tabs">
									<li class="active">
										<h3>
											<?php echo $sys['StNameT'];?>
										</h3>
									</li>
								
								</ul>
							</div>
						</div>
					</div>
					<div class="card-content">
						<?php foreach($permission as $gear ){
									if($gear['StNameT'] == $sys['StNameT']){?>
						<div class="col-md-4">
							<div class="card card-raised">
								<div class="card-content">
								
									<h3 class="card-title">	<i class="material-icons">account_box</i> <?php echo $gear['GpNameT'];?></h3>
								
									<a href="<?php echo base_url();?>index.php/gear/setGear/<?php echo $sys['StID']."/".$gear['GpID']."/".str_replace("/",".",$gear['StURL']);?>" class="btn btn-success btn-round">
										View App
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
						<?php }}
					}?>
				<!-- End Tabs with icons on Card -->
			</div>
		</div>
	</div>
</div>