<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1],
          ['Zucchini', 1],
          ['Pepperoni', 2]
        ]);

        // Set chart options
        var options = {'title':'How Much Pizza I Ate Last Night',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>


<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_heading_iserl">
			<h2><i class="fas fa-search"></i>สรุปรายได้</h2>
		</div>
		<div class="panel-body">
            <div class="form-horizontal">
                         <div class="form-group">
                    <label class="col-sm-2 control-label">เวลาที่เริ่มต้น</label>
                    <div class="col-sm-3">
                        <div class="input-group date" id="datepicker-pastdisabled">
                            <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                            <input type="date" class="form-control" name="date1">
                        </div>
                    </div>
                    <label class="col-sm-2 control-label">เวลาที่สิ้นสุด</label>
                    <div class="col-sm-3">
                        <div class="input-group date" id="datepicker-pastdisabled">
                            <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                            <input type="date" class="form-control" name="date2">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 col-sm-offset-10">
                    <button class="btn btn-social btn-google btn_iserl tooltips" title="คลิกปุ่มเพื่อค้นหาข้อมูล" ><span> ค้นหา</span></button>
                </div>
            </div> 
		</div>	<!-- panel-body -->
	</div>	
</div>	

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
             <h2><i class="fas fa-history"></i>วันที่ 24/04/2562 ถึง 24/05/2562</h2>
            <div class="panel-ctrls"></div>
            
		</div>
		<div class="panel-body">
        <div data-widget-group="group1" >
    <div class="row">

    <div class="col-md-6">
    <table class="table table-bordered table-hover table-striped m-n" cellspacing="0">
	<thead>
		<tr>
			<th>ลำดับ</th>
			<th>สนาม</th>
			<th>ผู้เข้าใช้</th>
			<th>รายได้</th>
            <th>Print</th>
		</tr>
	</thead>
	<tbody>
		<tr  align = 'center'>
			<td>1</td>
			<td>1</td>
			<td>456 คน</td>
			<td>56,500 บาท</td>
            <td>
            <input  href="#" type="submit" class="btn btn-inverse" value = "Print" onClick="window.print()" </input>
            </td>
		</tr>
		<tr  align = 'center'>
			<td>2</td>
			<td>2</td>
			<td>345 คน</td>
			<td>34,760 บาท</td>
            <td>
            <input  href="#" type="submit" class="btn btn-inverse" value = "Print" onClick="window.print()" </input>
            </td>
	
            
		</tr>
		<tr  align = 'center'>
			<td>3</td>
			<td>3</td>
			<td>389 คน</td>
			<td>49,670 บาท</td>
            <td>
            <input  href="#" type="submit" class="btn btn-inverse" value = "Print" onClick="window.print()" </input>
            </td>
	
		</tr>
	</tbody>
</table>

    </div>
        <div class="col-md-6">
            <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                <div class="panel-heading">
                    <h2>จำนวนผู้เข้าใช้สนาม</h2>
                    <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                </div>
                <div class="panel-body">
                  <div id="bar-example"></div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                <div class="panel-heading">
                    <h2>รายได้ทั้งหมด</h2>
                    <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                </div>
                <div class="panel-body">
                    <div id="line-example"></div>
                </div>
            </div>
        </div>
    </div>


  <!--  <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                <div class="panel-heading">
                    <h2>Donut Graph</h2>
                    <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                </div>
                <div class="panel-body">
                    <div id="donut-example"></div>
                </div>
            </div>
        </div>-->
       <!-- <div class="col-md-6">
            <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                <div class="panel-heading">
                    <h2>Area Graph</h2>
                    <div  class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                </div>
                <div class="panel-body">
                    <div id="area-example"></div>
                    
                </div>
            </div>
        </div>
    </div>
</div> -->

                            </div> <!-- .container-fluid -->
                        </div> <!-- #page-content -->
                    </div>


        </div>	<!-- panel-body -->
    </div>	
</div>	
<div class="col-md-3">
<button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Football/v_history');?>'"><span>ย้อนกลับ</span></button>
</div>	    

<!-- /Switcher -->
    <!-- Load site level scripts -->

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->
<script type="text/javascript" src="https://10.80.39.16/Camp/assets/js/jquery-1.10.2.min.js"></script> 							<!-- Load jQuery -->
<script type="text/javascript" src="https://10.80.39.16/Camp/assets/js/jqueryui-1.10.3.min.js"></script> 							<!-- Load jQueryUI -->
<script type="text/javascript" src="https://10.80.39.16/Camp/assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->
<script type="text/javascript" src="https://10.80.39.16/Camp/assets/js/enquire.min.js"></script> 									<!-- Load Enquire -->

<script type="text/javascript" src="https://10.80.39.16/Camp/assets/plugins/velocityjs/velocity.min.js"></script>					<!-- Load Velocity for Animated Content -->
<script type="text/javascript" src="https://10.80.39.16/Camp/assets/plugins/velocityjs/velocity.ui.min.js"></script>

<script type="text/javascript" src="https://10.80.39.16/Camp/assets/plugins/wijets/wijets.js"></script>     						<!-- Wijet -->

<script type="text/javascript" src="https://10.80.39.16/Camp/assets/plugins/codeprettifier/prettify.js"></script> 				<!-- Code Prettifier  -->
<script type="text/javascript" src="https://10.80.39.16/Camp/assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> 		<!-- Swith/Toggle Button -->

<script type="text/javascript" src="https://10.80.39.16/Camp/assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->

<script type="text/javascript" src="https://10.80.39.16/Camp/assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->

<script type="text/javascript" src="https://10.80.39.16/Camp/assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->

<script type="text/javascript" src="https://10.80.39.16/Camp/assets/js/application.js"></script>
<script type="text/javascript" src="https://10.80.39.16/Camp/assets/demo/demo.js"></script>
<script type="text/javascript" src="https://10.80.39.16/Camp/assets/demo/demo-switcher.js"></script>

<!-- End loading site level scripts -->
    
    <!-- Load page level scripts-->
    
<script type="text/javascript" src="https://10.80.39.16/Camp/assets/plugins/charts-morrisjs/raphael.min.js"></script> <!-- Load Raphael as Dependency -->
<script type="text/javascript" src="https://10.80.39.16/Camp/assets/plugins/charts-morrisjs/morris.min.js"></script>  <!-- Load Morris.js -->

<script type="text/javascript" src="https://10.80.39.16/Camp/assets/demo/demo-morrisjs.js"></script>

    <!-- End loading page level scripts-->

    </body>
</html>