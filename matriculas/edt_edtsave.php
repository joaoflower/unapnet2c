<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if(!empty($_POST['rSec_gru']) )
		{
			$vSec_gru = $_POST['rSec_gru'];			
			
			$vMod_mat = $sCurmat[$sEstudia['cod_cur']]['mod_mat'];
			$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
			if(empty($_POST['rTodos']))
			{
				$vQuery = "Update $tCurmat set sec_gru = '$vSec_gru' ";
				$vQuery .= "where num_mat = '{$sEstudia['num_mat']}' and per_aca = '{$sUsercoo['per_aca']}' and " ;
				$vQuery .= "cod_cur = '{$sEstudia['cod_cur']}' and mod_mat = '$vMod_mat'";
			}
			else
			{
				$vQuery = "Update $tCurmat set sec_gru = '$vSec_gru' where num_mat = '{$sEstudia['num_mat']}' and " ;
				$vQuery .= "per_aca = '{$sUsercoo['per_aca']}'";
			}
			$bResult = fInupde($vQuery);
		}
		header("Location:edt_viewmatri.php?rNum_mat={$sEstudia['num_mat']}&rCod_car={$sEstudia['cod_car']}");
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
