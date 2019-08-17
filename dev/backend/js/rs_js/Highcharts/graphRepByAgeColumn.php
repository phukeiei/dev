<?php
	include_once "template.php";
	showHeader();
	include_once "../../class/clsConnection.php";
	include_once "../../class/clsDB.php";
	include_once "../global1.php";
	include_once "../link/function.php";
	include_once "../class/clsperson.php";

	$oPs = new Person($oC);

	$num_psall = 0;

	$arr_age = array();
	$arr_age[0]["typeName"] = "[&lt;20]";
	$arr_age[1]["typeName"] = "[20-30]";
	$arr_age[2]["typeName"] = "[31-40]";
	$arr_age[3]["typeName"] = "[41-50]";
	$arr_age[4]["typeName"] = "[51-60]";
	
	$num_type = 5;
	for($i=0;$i<$num_type;$i++){
		$arr_age[$i]["numPs"] = 0;
	}	

	$oPs->RSPersonJoinPersonT();
	$numRows = $oPs->numRows;

	while($result = $oPs->GetResult()){
		$deptId = $result['personId'];
		$birthDate = $result['birthDate'];

		if($birthDate == "0000-00-00"){ 
			$brYear = 0;
		}
		else{
			list($brYear,$brMonth,$brDay) = explode(",",time_diff3(splitDateDbL($birthDate),splitDateDbL(getNowDateTh())));
		}

		if($brYear < 20){
			$arr_age[0]["numPs"] += 1;
		}
		else if($brYear >= 20 && $brYear <=30){
			$arr_age[1]["numPs"] += 1;
		}
		else if($brYear > 30 && $brYear <=40){
			$arr_age[2]["numPs"] += 1;
		}
		else if($brYear > 40 && $brYear <=50){
			$arr_age[3]["numPs"] += 1;
		}
		else{
			$arr_age[4]["numPs"] += 1;
		}	

		$num_psall++;
	}

	$xData = array();
	$yData = array();

	$color_id = 0;
	for($i=0;$i<$num_type;$i++){

		if($num_psall!=0) $percent = number_format(($arr_age[$i]["numPs"] * 100 / $num_psall),2);
		else $percent = 0;

		if($color_id >= 9){
			$color_id = 0;
		}
		if($i == $num_type-1){
			// end of array			
			$xData[$i] = "'".$arr_age[$i]["typeName"]."'";
			$yData[$i] = "{ y: ".$percent.", color: colors[".$color_id."], num: '".$arr_age[$i]["numPs"]."'}";
		}
		else{
			$xData[$i] = "'".$arr_age[$i]["typeName"]."',";
			$yData[$i] = "{ y: ".$percent.", color: colors[".$color_id."], num: '".$arr_age[$i]["numPs"]."'},";
		}
		$color_id++;
	}
?>
<script type="text/javascript" src="../source/jquery_v1.8.3.js"></script>
<script type="text/javascript">
	$(function () {

		var colors = Highcharts.getOptions().colors,
			categories = [
				<?php
					foreach($xData as $x_key => $x_val){
						echo $x_val;
					}
				?>
				],
            name = "ประเภทบุคลากร",
			data = [
				<?php
					foreach($yData as $y_key => $y_val){
						echo $y_val;
					}
				?>
				];

		var chart;
		$(document).ready(function() {
			// Build the chart
			chart = new Highcharts.Chart({
				chart: {
					renderTo: 'container',
					width: 650,
					height: 450,
					type: 'column'
				},
				credits: {
					enabled: false
				},
				title: {
					margin: 30,
					text: 'ร้อยละจำนวนบุคลากรจำแนกตามอายุของบุคลากร',
					style: {
						color: '#000000',
						fontWeight: 'bold'
					}
				},
				xAxis: {
					categories: categories,
					title: {
						text: 'ช่วงอายุบุคลากร (ปี)'
					}
				},
				yAxis: {
					min: 0,
					title: {
						text: 'ร้อยละจำนวนบุคลากร'
					},
					gridLineWidth: 0.5
				},
				legend: {
					enabled: false
				},
				tooltip: {
					formatter: function() {
						return ''+
							'<b>อายุ '+ this.x   +' ปี</b> <br/>ร้อยละ '+this.y
					}
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0,
						dataLabels: {
							enabled: true,
							rotation: 0,
							color: '#000000',
							align: 'center',
							y: -5,
							style: {
								fontSize: '13px',
								fontFamily: 'Verdana, sans-serif'
							},
							formatter: function() {
								return this.y + '% (' + this.point.num + ' คน)';
							}
						}
					}
				},
				series: [{
					name: name,
					data: data,
				}],
				navigation: {
					buttonOptions: {
						enabled: false
					}
				},
				/*exporting: {
					type: 'image/jpeg'
				}*/
			});
		});

		// button handler
		$('#button').click(function() {
			chart.exportChart();
		});
	});

	/*function exportWord(){
		var type = 1;
		window.open('graphPrintByHire1.php?type='+type);
	}*/
</script>

<style type="text/css">}
	table.etable {
		border-spacing: 0px;
		background-color: white;
	}
	table.etable th {
		border-spacing: 0px;
		padding: 5px;
		background-color: #B9D3EE;
	}
	table.etable td {
		border-spacing: 0px;
		padding: 5px;
	}
</style>

<table width="740" border="0" align="center" cellspacing="0">
  <!--DWLayoutTable-->
  <tr> 
    <td width="740" height="713" valign="top"><br> <fieldset>
      <legend><font size="2" color="<?php echo $GLOBALS["COLOR_FONT_3"];?>"><a href="?mm=1">รายงานกราฟ</a> 
	  <img src="../picture/ico3.gif" align="absmiddle" border="0">กราฟแท่งแสดงร้อยละจำนวนบุคลากรจำแนกตามช่วงอายุของบุคลากร</font></legend>
      <div align="center">

		<br />

		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
		<!--DWLayoutTable-->
		<tr>
			<td colspan="2" align="center" style="padding:0px 0px 20px 0px;" >
				<strong><font color="<?php echo $GLOBALS["COLOR_FONT_3"];?>" size="3">รายงานร้อยละจำนวนบุคลากร จำแนกตามอายุของบุคลากร</font></strong>
			</td>
		</tr>
		<tr> 
		  <td style="padding:15px 0px 5px 0px;" colspan="2" align="center" ><font size="2" color="<?php echo $GLOBALS['COLOR_FONT_4'];?>"> <?php echo $GLOBALS["COLLEGENAME"]; ?></font></td>
		</tr>
		<tr> 
		  <?php
			/*$day = ChangeArabicnumeralToThainumeral(convertDayNumberToString(date('d')));
			$month = convertMonthNumberToString(date('m'));
			$year = ChangeArabicnumeralToThainumeral(date('Y')+543);*/
			$day = convertDayNumberToString(date('d'));
			$month = convertMonthNumberToString(date('m'));
			$year = date('Y')+543;
		  ?>
		  <td style="padding:15px 0px 5px 0px;" colspan="2" align="center" ><font size="2" color="<?php echo $GLOBALS['COLOR_FONT_4'];?>"> ณ&nbsp;วันที่&nbsp;<?php echo $day; ?>&nbsp;<?php echo $month; ?>&nbsp;<?php echo $year; ?></font></td>
		</tr>
		<!-- <tr>
			<td colspan="2" align="right" style="padding:0px 0px 20px 0px;" >
				<input type="button" disabled="disabled" name="exportW" value="ส่งออกเป็น Word" onclick="exportWord();">
			</td>
		</tr> -->
		</table>

		<div width="95%" align="center">
			<script src="../Highcharts/js/highcharts.js"></script>
			<script src="../Highcharts/js/modules/exporting.js"></script>
			<div id="container"></div>
			<!--<button id="button">Export chart</button>-->

			<br/>
			<br/>

			<table width="98%" align="center" class="etable" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left"><strong><font size="2" color="<?php echo $GLOBALS['COLOR_FONT_4'];?>">อายุบุคลากร</font></strong></td>
					<?php
						if(!empty($arr_age)){
							foreach($arr_age as $a_key => $a_val){
								echo "<th align=\"center\"><strong><font size=\"2\" color=\"{$GLOBALS['COLOR_FONT_4']}\">".$a_val["typeName"]."</font></strong></th>";
							}
						}
					?>
					<th align="center"><strong><font size="2" color="<?php echo $GLOBALS['COLOR_FONT_4'];?>">รวมทั้งหมด</font></strong></th>
				</tr>
				<tr>
					<td align="left"><strong><font size="2" color="<?php echo $GLOBALS['COLOR_FONT_4'];?>">จำนวนบุคลากร(คน)</font></strong></td>
					<?php
						if(!empty($arr_age)){
							foreach($arr_age as $b_key => $b_val){
								//$num_ps = ($b_val["numPs"] > 0) ? $b_val["numPs"] : '-';
								echo "<td align=\"center\"><strong><font size=\"2\" color=\"{$GLOBALS['COLOR_FONT_4']}\">".$b_val["numPs"]."</font></strong></td>";
							}
						}
					?>
					<td align="center"><strong><font size="2" color="<?php echo $GLOBALS['COLOR_FONT_4'];?>"><?php echo ($numRows > 0) ? ($numRows) : '-'; ?></font></strong></td>
				</tr>
			</table>
			
			<br/>

		</div>
      </fieldset></td>
  </tr>
  <tr> 
    <td height="153">&nbsp;</td>
  </tr>
  <tr> 
    <td height="43" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
</table>

<?php
showFooter();
?>
