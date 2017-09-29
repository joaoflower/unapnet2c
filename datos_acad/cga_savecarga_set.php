<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$aCurcarga = $_POST['rCurcarga'];
		$tCarga = "unapnet.carga{$sUsercoo['ano_aca']}";
		
		if(!empty($aCurcarga)) foreach($aCurcarga as $vCod_cur => $vCod_cur2)
		{
			
			if($sUsercoo['mod_mat'] == '99')
			{
				
				$vQuery = "Insert into $tCarga (pln_est, cod_cur, sec_gru, mod_mat, cod_prf, cod_car, ano_aca, per_aca) values ";
				$vQuery .= "('{$sUsercoo['pln_est']}', '$vCod_cur', '{$sUsercoo['sec_gru']}', '01', ";
				$vQuery .= "'{$sUsercoo['cod_prf']}','{$sUsercoo['cod_car']}','{$sUsercoo['ano_aca']}','{$sUsercoo['per_aca']}')";
				$cResult = fInupde($vQuery);
			
				$vQuery = "Insert into $tCarga (pln_est, cod_cur, sec_gru, mod_mat, cod_prf, cod_car, ano_aca, per_aca) values ";
				$vQuery .= "('{$sUsercoo['pln_est']}', '$vCod_cur', '{$sUsercoo['sec_gru']}', '07', ";
				$vQuery .= "'{$sUsercoo['cod_prf']}','{$sUsercoo['cod_car']}','{$sUsercoo['ano_aca']}','{$sUsercoo['per_aca']}')";
				$cResult = fInupde($vQuery);
				
				$vQuery = "Insert into $tCarga (pln_est, cod_cur, sec_gru, mod_mat, cod_prf, cod_car, ano_aca, per_aca) values ";
				$vQuery .= "('{$sUsercoo['pln_est']}', '$vCod_cur', '{$sUsercoo['sec_gru']}', '08', ";
				$vQuery .= "'{$sUsercoo['cod_prf']}','{$sUsercoo['cod_car']}','{$sUsercoo['ano_aca']}','{$sUsercoo['per_aca']}')";
				$cResult = fInupde($vQuery);
			}	
			else
			{
				$vQuery = "Insert into $tCarga (pln_est, cod_cur, sec_gru, mod_mat, cod_prf, cod_car, ano_aca, per_aca) values ";
				$vQuery .= "('{$sUsercoo['pln_est']}', '$vCod_cur', '{$sUsercoo['sec_gru']}', '{$sUsercoo['mod_mat']}', ";
				$vQuery .= "'{$sUsercoo['cod_prf']}','{$sUsercoo['cod_car']}','{$sUsercoo['ano_aca']}','{$sUsercoo['per_aca']}')";
				$cResult = fInupde($vQuery);
			}
		}
		header("Location:cga_selectsem.php");
	}
	else
	{
		header("Location:../index.php");
	}			
			
?>