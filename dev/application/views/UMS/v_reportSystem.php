<script type="text/javascript">
$(function () {<?php $fivecount = 0; $fourcount = 0; $threecount = 0; $twocount = 0; $onecount = 0; $nowcount = 0;

?>
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'จำนวนการเข้าใช้ในช่วงเวลา 6 เดือนล่าสุด'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [<?php $fivemonthago = date('M',strtotime('-5 month'));
											$fourmonthago = date('M',strtotime('-4 month'));
											$threemonthago = date('M',strtotime('-3 month'));
											$twomonthago = date('M',strtotime('-2 month'));
											$onemonthago = date('M',strtotime('-1 month'));
											$now = date('M',strtotime('now'));?>
                    '<?php echo $fivemonthago;?>',
                    '<?php echo $fourmonthago;?>',
                    '<?php echo $threemonthago;?>',
                    '<?php echo $twomonthago;?>',
                    '<?php echo $onemonthago;?>',
                    '<?php echo $now;?>'
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'จำนวนครั้งที่เข้าใช้ระบบ'
                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: '#FFFFFF',
                align: 'left',
                verticalAlign: 'top',
                x: 100,
                y: 70,
                floating: true,
                shadow: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +' ครั้ง';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
                series: [{
                name: '<?php echo $systemname;?>',<?php 
							foreach($log as $count){
							$date = date("M",strtotime($count['LogTime']));
								if($date == $fivemonthago){
									$fivecount+=1;
								}
								else if($date == $fourmonthago){
									$fourcount+=1;
								}
								else if($date == $threemonthago){
									$threecount+=1;
								}
								else if($date == $twomonthago){
									$twocount+=1;
								}
								else if($date == $onemonthago){
									$onecount+=1;
								}
								else if($date == $now){
									$nowcount+=1;
								}
								else{
								}						
							}?>
                data: [<?php echo $fivecount;?>,<?php echo $fourcount;?>,<?php echo $threecount;?>,<?php echo $twocount;?>,<?php echo $onecount;?>,<?php echo $nowcount;?>]
            }]
        });
    });
    
});
</script>
<script src="<?php echo base_url();?>js/ums/highcharts.js"></script>
<div class="row">
	<div class="col-md-3">
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><i class="fa fa-database" style="font-size:26px"></i><?php echo nbs(2);?><?php foreach($system as $temp){ $sysname = $temp['StNameT']; }?>
											<b><?php echo $sysname;?></b></h2>
				<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.form-group"}'></div>
			
			</div>
			<div class="panel-body">
				<?php foreach($system as $sys){ ?>
					<div class="col-md-12">
					<a href="<?php echo base_url();?>index.php/UMS/showReport/reportByGroup/<?php echo $sys['GpID'].'/'.$sys['StID'];?>"">
						<div class="info-tile tile-warning">
							<img width="35px" height="35px" src="<?php echo base_url();?>images/1378991964_people - Copy.png" alt="" />
							<?php echo nbs(2); ?><span class="value"><?php echo $sys['GpNameT']." ".$sys['num']." "."คน";?></span>
						</div>
					</a>	
				</div>
				<?php }?>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><i class="fa fa-bar-chart" style="font-size:26px"></i><?php echo nbs(2);?>จำนวนการเข้าใช้ระบบ</h2>
				<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.form-group"}'></div>
			</div>
			<div class="panel-body">
				<div id="container" style="min-width: 450px; height: 450px; margin: 10 auto">
				
				</div>
			</div>
		</div>	   
	</div>
</div>
