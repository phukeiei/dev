<?php
//https://10.51.4.23/pcksite/index.php/hr/getIcon?type=doc&image=000.jpg
// include(dirname(__FILE__)."/../../config/hr_config.php");
// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
// echo dirname($_SERVER['PHP_SELF']);
// echo ">>".$config['hr_title']."<<";die;
		if (isset($_GET['type']) && isset( $_GET['image'])){
			$type =  $_GET['type'];
			$image =  $_GET['image'];
			$path = "/var/www/uploads/tsp60/hr/{$type}/{$image}";
			//$path = $this->config->item("hr_upload_folder")."{$type}/{$image}";
			if (is_readable($path)) {
				$info = getimagesize($path);
				if ($info !== FALSE) {
					header("Content-type: {$info['mime']}");
					readfile($path);
					exit();
				}
			}
		}
?>