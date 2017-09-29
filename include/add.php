<?php
require('fpdf.php');

$pdf=new FPDF();
$pdf->AddFont('arialn','','arialn.php');
$pdf->AddFont('arialn','B','arialnb.php');
$pdf->AddPage();

?> 