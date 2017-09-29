<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{		
		$tApla = "unapnet.apla{$sUsercoo['ano_aca']}";
		
		$vQuery = "delete from $tApla where num_mat = '{$sEstudia['num_mat']}' and ";
		$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sEstudia['pln_est']}' and ";
		$vQuery .= "cod_cur = '{$sEstudia['cod_cur']}' and ano_aca = '{$sUsercoo['ano_aca']}' and ";
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' ";

		$cResult = fInupde($vQuery);
		if($cResult)
		{
			header("Location:rva_viewcursodata.php?rPln_est=".$sEstudia['pln_est']."&rCod_cur=".$sEstudia['cod_cur']."&rSec_gru=".$sEstudia['sec_gru']."&rMod_not=".$sEstudia['mod_not']);
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
