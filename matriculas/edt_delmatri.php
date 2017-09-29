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
			
			$vQuery = "Delete from $tEstumat where  num_mat = '{$sEstudia['num_mat']}' and " ;
			$vQuery .= "per_aca = '{$sUsercoo['per_aca']}'";					
			$bResult = fInupde($vQuery);
			
			//-------------LOG----------------------
			$tLogestumat = "unapnet.logestumat{$sUsercoo['ano_aca']}";
			$vQuery = "Insert into $tLogestumat (num_mat, cod_car, ano_aca, per_aca, pln_est, cod_esp, sec_gru, mod_mat, ";
			$vQuery .= "crd_mat, tur_est, cod_usu, cod_log, fch_log, dir_ip) values " ;
			$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sUsercoo['ano_aca']}', ";
			$vQuery .= "'{$sUsercoo['per_aca']}', '{$sEstudia['pln_est']}', '{$sEstudia['cod_esp']}', ";
			$vQuery .= "'{$sEstudia['sec_gru']}', '{$sEstudia['mod_mat']}', '{$sEstudia['tot_crd']}', ";
			$vQuery .= "'{$sEstudia['tur_est']}', '{$sUsercoo['cod_usu']}', '03', now(), '{$sUsercoo['ip']}' ) ";
			$bResult = fInupde($vQuery);
			//--------------------------------------
		}
		header("Location:edt_getestu.php");
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
