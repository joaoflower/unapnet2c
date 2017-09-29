<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{		
		$tHabicurso = "unapnet.habicurso{$sUsercoo['ano_aca']}";
		
		$vQuery = "delete from $tHabicurso where pln_est = '{$sEstudia['pln_est']}' and ";
		$vQuery .= "cod_cur = '{$sEstudia['cod_cur']}' and sec_gru = '{$sEstudia['sec_gru']}' and ";
		$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and per_aca = '{$sUsercoo['per_aca']}' ";

		$cResult = fInupde($vQuery);
		if($cResult)
		{
			header("Location:hac_viewcurso.php");
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
