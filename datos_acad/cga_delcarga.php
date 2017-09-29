<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{		
		$tCarga = "unapnet.carga{$sUsercoo['ano_aca']}";
		
		$vQuery = "delete from $tCarga where pln_est = '{$sEstudia['pln_est']}' and ";
		$vQuery .= "cod_cur = '{$sEstudia['cod_cur']}' and sec_gru = '{$sEstudia['sec_gru']}' and ";
		$vQuery .= "mod_mat = '{$sEstudia['mod_mat']}' and cod_prf = '{$sEstudia['cod_prf']}' and ";
		$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and ano_aca = '{$sUsercoo['ano_aca']}' and ";
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' ";

		$cResult = fInupde($vQuery);
		if($cResult)
		{
			header("Location:cga_selectsem.php");
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
