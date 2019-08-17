<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->

    <!--Load the AJAX API-->
    <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
 -->
 <script type="text/javascript" src="<?php echo base_url('/js/bootstrap-datepicker-thai.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/js/bootstrap-datepicker.th.js'); ?>"></script>



<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
             <h2><i class="fas fa-history"></i>สรุปรายงานการเข้าใช้สนาม</h2>
            <div class="panel-ctrls"></div>
            
		</div>
		<div class="panel-body">
        <div data-widget-group="group1" >
    <div class="row">

    <div class=" col-md-10 col-sm-offset-2">
    
    <table style="width:90%" class="table table-hover m-n dataTable-Export" cellspacing="0">
	<thead>
		<tr>
			<th style="width:10%">ลำดับ</th>
            <th style="width:10%"></th>
			<th style="width:25%">สนาม</th>
			<th style="width:25%">จำนวนผู้เข้าใช้ (คน)</th>
			<th style="width:20%">รายได้ (บาท)</th>
           
		</tr>
	</thead>
	<tbody>
    <?php $index = 0 ; 
      foreach($fd_date as $row){
          $index++;  ?>

<tr>   
<td class = "text-center">  <?php echo $index ;?>  </td> 
<td class = "text-center" > <?php echo abbreDate2($row->fr_start_date) ; ?> </td>
<td>   <?php echo $row->ff_name ;?> </td>
<td class = "text-center">  <?php echo $row->cout ;?> </td>
<td class="text-right">  <?php echo number_format($row->cost,2) ;?>  </td>


</tr>
<?php } ?>

		</tbody>
</table>

    </div>
        

                            </div> <!-- .container-fluid -->
                        </div> <!-- #page-content -->
                    </div>


    </div>	
</div>	
<div class="col-md-3">
<button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/History/v_history');?>'"><span>ย้อนกลับ</span></button>
</div>	    
<!-- 
 /Switcher -->
    <!-- Load site level scripts -->
