<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if(!empty($_POST['rSec_gru']) and !empty($_POST['rCod_esp']))
		{
			$vSec_gru = $_POST['rSec_gru'];
			$vCod_esp = $_POST['rCod_esp'];
			
			$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
			$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
			
			$vQuery = "Update $tEstumat set sec_gru = '$vSec_gru', cod_esp = '$vCod_esp' ";
			$vQuery .= "where num_mat = '{$sEstudia['num_mat']}' and per_aca = '{$sUsercoo['per_aca']}' " ;
			$bResult = fInupde($vQuery);
			
			//-------------LOG----------------------
			$tLogestumat = "unapnet.logestumat{$sUsercoo['ano_aca']}";
			$vQuery = "Insert into $tLogestumat (num_mat, cod_car, ano_aca, per_aca, pln_est, cod_esp, sec_gru, mod_mat, ";
			$vQuery .= "crd_mat, tur_est, cod_usu, cod_log, fch_log, dir_ip) values " ;
			$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sUsercoo['ano_aca']}', ";
			$vQuery .= "'{$sUsercoo['per_aca']}', '{$sEstudia['pln_est']}', '{$sEstudia['cod_esp']}', ";
			$vQuery .= "'{$sEstudia['sec_gru']}', '{$sEstudia['mod_mat']}', '{$sEstudia['crd_mat']}', ";
			$vQuery .= "'{$sEstudia['tur_est']}', '{$sUsercoo['cod_usu']}', '02', now(), '{$sUsercoo['ip']}' ) ";
			$bResult = fInupde($vQuery);
			//--------------------------------------
			
			if(!empty($_POST['rTodos']))
			{
				$vQuery = "Update $tCurmat set sec_gru = '$vSec_gru' where num_mat = '{$sEstudia['num_mat']}' and " ;
				$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' ";
				$bResult = fInupde($vQuery);
			}			
		}
		header("Location:edt_viewmatri.php?rNum_mat={$sEstudia['num_mat']}&rCod_car={$sEstudia['cod_car']}");
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
