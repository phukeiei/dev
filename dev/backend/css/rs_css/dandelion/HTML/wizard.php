<?php

if(isset($_POST['daWizard']))
{
	echo json_encode(array('success'=>true, 'ip_address'=>$_SERVER['REMOTE_ADDR'], 'data'=>$_POST['daWizard']));
}
else
	echo json_encode(array('success'=>false, 'message'=>'No Data'));
