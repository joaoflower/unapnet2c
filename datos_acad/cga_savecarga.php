<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$aCurcarga = $_POST['rCurcarga'];
		$tCarga = "unapnet.carga{$sUsercoo['ano_aca']}";
		$tCargaint = "unapnet.cargaint{$sUsercoo['ano_aca']}";
		
		if(!empty($aCurcarga)) foreach($aCurcarga as $vPln_cur => $vCod_cur2)
		{
			$vPln_est = substr($vPln_cur, 0, 2);
			$vCod_cur = substr($vPln_cur, 2, 3);
			$vSec_gru = substr($vPln_cur, 5, 2);
			$vMod_mat = substr($vPln_cur, 7, 2);
			
			$vQuery = "Insert into $tCarga (pln_est, cod_cur, sec_gru, mod_mat, cod_prf, cod_car, ano_aca, per_aca) values ";
			$vQuery .= "('$vPln_est', '$vCod_cur', '$vSec_gru', '$vMod_mat', ";
			$vQuery .= "'{$sUsercoo['cod_prf']}','{$sUsercoo['cod_car']}','{$sUsercoo['ano_aca']}','{$sUsercoo['per_aca']}')";
			$cResult = fInupde($vQuery);
			
			$vQuery = "Insert into $tCargaint (pln_est, cod_cur, sec_gru, mod_mat, cod_prf, cod_car, ano_aca, per_aca) values ";
			$vQuery .= "('$vPln_est', '$vCod_cur', '$vSec_gru', '$vMod_mat', ";
			$vQuery .= "'{$sUsercoo['cod_prf']}','{$sUsercoo['cod_car']}','{$sUsercoo['ano_aca']}','{$sUsercoo['per_aca']}')";
			$cResult = fInupde($vQuery);
		}
		header("Location:cga_selectsem.php");
	}
	else
	{
		header("Location:../index.php");
	}			
			
?>