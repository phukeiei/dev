<?php
$mpdf = new \Mpdf\Mpdf();

// Define the Header/Footer before writing anything so they appear on the first page
$mpdf->SetHTMLHeader('
<div style="text-align: right; font-weight: bold;">
    My document
</div>');

$mpdf->WriteHTML('
<h>แบบฟอร์ม</h>
');

$mpdf->Output();
?>