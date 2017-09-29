<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if($sUsercoo['safetymatri'])
		{
			$sEstudia['pln_est'] = $_POST['rPln_est'];
			$sEstudia['cod_esp'] = $_POST['rCod_esp'];
			$sEstudia['tip_sist'] = $sPlan[$sEstudia['pln_est']];
			
			if($sEstudia['tip_sist'] == '1')
			{
				header("Location:reg_matrirg1.php");
			}
			elseif($sEstudia['tip_sist'] == '2')
			{
				header("Location:reg_matri1.php");
			}
		}
		else
			header("Location:reg_getestu.php");
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
