<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{		
		$tReso = "unapnet.reso{$sUsercoo['ano_aca']}";
		
		$vQuery = "delete from $tReso where pln_est = '{$sEstudia['pln_est']}' and ";
		$vQuery .= "cod_cur = '{$sEstudia['cod_cur']}' and sec_gru = '{$sEstudia['sec_gru']}' and ";
		$vQuery .= "mod_mat = '{$sEstudia['mod_mat']}' and cod_car = '{$sUsercoo['cod_car']}' and ";
		$vQuery .= "ano_aca = '{$sUsercoo['ano_aca']}' and per_aca = '{$sUsercoo['per_aca']}' ";

		$cResult = fInupde($vQuery);
		if($cResult)
		{
			header("Location:res_viewreso.php");
		}
		else
		{
			header("Location:../index.php");
		}
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
