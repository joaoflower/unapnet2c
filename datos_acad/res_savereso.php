<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$aCurreso = $_POST['rCurreso'];
		$vRes_aut = $_POST['rRes_aut'];
		$tReso = "unapnet.reso{$sUsercoo['ano_aca']}";
		
		if(!empty($aCurreso)) foreach($aCurreso as $vPln_cur => $vCod_cur2)
		{
			$vPln_est = substr($vPln_cur, 0, 2);
			$vCod_cur = substr($vPln_cur, 2, 3);
			$vSec_gru = substr($vPln_cur, 5, 2);
			$vMod_mat = substr($vPln_cur, 7, 2);
			
			$vQuery = "Insert into $tReso (pln_est, cod_cur, sec_gru, mod_mat, cod_car, ano_aca, per_aca, res_aut) values ";
			$vQuery .= "('$vPln_est', '$vCod_cur', '$vSec_gru', '$vMod_mat', ";
			$vQuery .= "'{$sUsercoo['cod_car']}','{$sUsercoo['ano_aca']}','{$sUsercoo['per_aca']}', '$vRes_aut')";
			$cResult = fInupde($vQuery);
		}
		header("Location:res_viewreso.php");
	}
	else
	{
		header("Location:../index.php");
	}			
			
?>