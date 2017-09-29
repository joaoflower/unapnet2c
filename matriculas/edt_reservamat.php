<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		
		$vQuery = "Delete from $tCurmat where num_mat = '{$sEstudia['num_mat']}' and " ;
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' ";
		$bResult = fInupde($vQuery);
		if($bResult)
		{
			$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
			
			$vQuery = "Update $tEstumat set mod_mat = '17', tot_crd = '0', max_crd = '0', tip_mat = '02', ";
			$vQuery .= "obs_est = 'RESERVA DE MATRICULA ' ";
			$vQuery .= "where num_mat = '{$sEstudia['num_mat']}' and per_aca = '{$sUsercoo['per_aca']}'";

			$bResult = fInupde($vQuery);
		}
		header("Location:edt_viewmatri.php?rNum_mat={$sEstudia['num_mat']}&rCod_car={$sEstudia['cod_car']}");
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
