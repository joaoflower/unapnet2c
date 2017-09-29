<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$aEstureeval = $_POST['rEstureeval'];
		$tApla = "unapnet.apla{$sUsercoo['ano_aca']}";
		$tCarga = "unapnet.carga{$sUsercoo['ano_aca']}";
		$tCargaint = "unapnet.cargaint{$sUsercoo['ano_aca']}";
		
		if(!empty($aEstureeval)) foreach($aEstureeval as $vNum_mat => $vNum_mat2)
		{
			$vQuery = "Insert into $tApla (num_mat, cod_car, pln_est, cod_cur, ano_aca, per_aca, mod_mat, sec_gru, cod_usu) ";
			$vQuery .= "values ('$vNum_mat', '{$sUsercoo['cod_car']}', '{$sEstudia['pln_est']}', '{$sEstudia['cod_cur']}', ";
			$vQuery .= "'{$sUsercoo['ano_aca']}','{$sUsercoo['per_aca']}', '{$sEstudia['mod_not']}', '{$sEstudia['sec_gru']}', ";
			$vQuery .= "'{$sUsercoo['cod_usu']}') ";
			$cResult = fInupde($vQuery);
		}
		if(!empty($cResult))
		{
			//$vCod_prf = ($sPlan[$sEstudia['pln_est']]=='1'?$sEstudia['cod_prf']:"0400000");
			$vCod_prf = $sEstudia['cod_prf'];
			$vQuery = "Insert into $tCarga (pln_est, cod_cur, sec_gru, mod_mat, cod_prf, cod_car, ano_aca, per_aca) values ";
			$vQuery .= "('{$sEstudia['pln_est']}', '{$sEstudia['cod_cur']}', '{$sEstudia['sec_gru']}', '{$sEstudia['mod_not']}', ";
			$vQuery .= "'$vCod_prf','{$sUsercoo['cod_car']}','{$sUsercoo['ano_aca']}','{$sUsercoo['per_aca']}')";
			$cResult = fInupde($vQuery);
			
			$vCod_prf2 = $sEstudia['cod_prf2'];
			$vQuery = "Insert into $tCargaint (pln_est, cod_cur, sec_gru, mod_mat, cod_prf, cod_car, ano_aca, per_aca) values ";
			$vQuery .= "('{$sEstudia['pln_est']}', '{$sEstudia['cod_cur']}', '{$sEstudia['sec_gru']}', '{$sEstudia['mod_not']}', ";
			$vQuery .= "'$vCod_prf2','{$sUsercoo['cod_car']}','{$sUsercoo['ano_aca']}','{$sUsercoo['per_aca']}')";
			$cResult = fInupde($vQuery);
		}
		
		//		header("Location:rva_viewcursodata.php");
		header("Location:rva_viewcursodata.php?rPln_est=".$sEstudia['pln_est']."&rCod_cur=".$sEstudia['cod_cur']."&rSec_gru=".$sEstudia['sec_gru']."&rMod_not=".$sEstudia['mod_not']);
	}
	else
	{
		header("Location:../index.php");
	}			
			
?>