<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vRes_aut = $_POST['rRes_aut'];
		$tReso = "unapnet.reso{$sUsercoo['ano_aca']}";
		
		if(!empty($vRes_aut))
		{
			$vQuery = "update $tReso set res_aut = '$vRes_aut' ";
			$vQuery .= "where pln_est = '{$sEstudia['pln_est']}' and cod_cur = '{$sEstudia['cod_cur']}' and ";
			$vQuery .= "sec_gru = '{$sEstudia['sec_gru']}' and mod_mat = '{$sEstudia['mod_mat']}' and ";
			$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and ano_aca = '{$sUsercoo['ano_aca']}' and ";
			$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' ";
			$cResult = fInupde($vQuery);
		}
		header("Location:res_viewreso.php");
	}
	else
	{
		header("Location:../index.php");
	}			
			
?>