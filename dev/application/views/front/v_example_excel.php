
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_heading_sub_iserl"> 
			<h2>Excel Example Export and Download File</h2>
		</div>
		<div class="panel-body">
			<pre class="prettyprint linenums">
				

				Link :: https://arjunphp.com/how-to-use-phpexcel-with-codeigniter/
			</pre>
			
			<h2>Read Excel</h2>
			<pre class="prettyprint linenums">
	function ReadFile_excel(){
		$file = '/var/www/uploads/saraban/admin/TEST/just_some_random_name.xls';
		
		//load the excel library
		$this->load->library('excel');
		
		//read file from path
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		
		//get only the Cell Collection
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		
		//extract to a PHP readable array format
		foreach ($cell_collection as $cell) {
			$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
			$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
			$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
		
			//The header will/should be in row 1 only. of course, this can be modified to suit your need.
			if ($row == 1) {
				$header[$row][$column] = $data_value;
			} else {
				$arr_data[$row][$column] = $data_value;
			}
		}
		
		//send the data in an array format
		$data['header'] = $header;
		$data['values'] = $arr_data;
		
		echo json_encode($data);
	}
			</pre>
			<a href="<?php echo site_url('Home/Export_excel');?>" class="btn btn-social btn-google btn_check_iserl tooltips ti ti-search" title="" >ตัวอย่าง Export Excel</a> 
			<a href="<?php echo site_url('Home/ReadFile_excel');?>" class="btn btn-social btn-google btn_check_iserl tooltips ti ti-search" title="" >ตัวอย่าง Read File Excel</a> 
		</div>	
	</div>	
</div>	
	

