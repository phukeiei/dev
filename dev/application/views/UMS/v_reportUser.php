<style type="text/css"> .onmouse:hover{background-color:#f2efef;}</style>

<?php  
		foreach($system as $systemp){
			$lastarray = $systemp['StNameT'];
			
			}
		  ?>
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: ''
            },
            tooltip: {
        	    pointFormat: '<b>{point.name}</b>: {point.percentage} %',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    size: '75%',
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        percentageDecimals: 2,
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'คิดเป็น',
                data: [ <?php foreach($system as $syspercen){
										if($syspercen['StNameT'] == NULL){
											$syspercen['StNameT'] = 'อื่นๆ';
										}
										$temp = ($syspercen['num'] * 100) / $many; 
										$percen = round($temp,2);?>
										['<?php echo $syspercen['StNameT']; ?>',<?php echo $percen;?>]
										<?php if($syspercen['StNameT'] == $lastarray){
													echo "";
										}
										else{
											echo ",";
										} }?>
                    /*['Firefox',   25.0],
                    ['IE',       46.8],
					{
                        name: 'Chrome',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    }
					,
                    ['Safari',    8.5],
                    ['Opera',     6.2],
                    ['Others',   0.7]*/
                ]
            }]
        });
    });
    
});
		</script>
<script src="<?php echo base_url();?>js/ums/highcharts.js"></script>
<div class="row">
	<div class="col-md-9">
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><i class="fa fa-area-chart" style="font-size:26px"></i><?php echo nbs(2);?>อัตราส่วนผู้ใช้ทุกระบบ</h2>
				<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.form-group"}'></div>
			</div>
			<div class="panel-body">
				<div id="container" style="min-width: 450px; height: 450px; margin: 10 auto">
				</div>
			</div>
		</div>	   
	</div>
	<div class="col-md-3">
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><i class="fa fa-users" style="font-size:26px"></i><?php echo nbs(2);?>รายงานผู้ใช้ในระบบ</h2>
				<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.form-group"}'></div>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<a href="#">
						<div class="info-tile tile-warning">
							<img width="35px" height="35px" src="<?php echo base_url();?>images/1378991964_people - Copy.png" alt="" />
							<?php echo nbs(2); ?><span class="value">ผู้ใช้ทั้งหมด <?php echo $many." คน";?></span>
						</div>	
					</a>
				</div>
				<?php foreach ($system as $sys) { 
						if($sys['ColorHeadTop']){
							$bgcl = $sys['ColorHeadTop'];
						}
						else{
							$bgcl = "#656565";
						}
						if($sys['StIcon']){
							$hic = $sys['StIcon'];
						}
						else{
							$hic = "cog.png";
						}
						if($sys['StNameT'] == NULL){
							$sys['StNameT'] = 'อื่นๆ';
						}	
						$path = $this->config->item('uploads_url');
						$pathString = $path."system&image=".$hic;
				?>
				<div class="col-md-12">
					<a href="<?php echo base_url();?>index.php/UMS/showReport/reportSystem/<?php echo $sys['StID'];?>">
						<div class="info-tile tile-warning">
							<img width="35px" height="35px" src="<?php echo $pathString; ?>" alt="" />
							<?php echo nbs(2); ?><span class="value"><?php echo $sys['StNameT']." ".$sys['num']." คน";?></span>
						</div>
					</a>	
				</div>
				<?php }?>
			</div>
		</div>
	</div>	
</div>	  