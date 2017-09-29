<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{		
		$tHorario = "unapnet.hora{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		
		$vQuery = "delete from $tHorario where pln_est = '{$sEstudia['pln_est']}' and ";
		$vQuery .= "cod_cur = '{$sEstudia['cod_cur']}' and sec_gru = '{$sEstudia['sec_gru']}' and ";
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' ";

		$cResult = fInupde($vQuery);
		if($cResult)
		{
			header("Location:hor_viewhora.php");
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
