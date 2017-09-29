<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
/*		$vPln_est = $_POST['rPln_est'];
		$vCod_esp = $_POST['rCod_esp'];
		$vSem_anu = $_POST['rSem_anu'];
		$vCod_cur = $_POST['rCod_cur'];*/
		$vPln_est = $sUsercoo['pln_est'];
		$vCod_esp = $sUsercoo['cod_esp'];
		$vSem_anu = $sUsercoo['sem_anu'];
		$vCod_cur = $sUsercoo['cod_cur'];
		$vNot_cur = $_POST['rNot_cur'];
		if(!empty($vPln_est) and !empty($vCod_esp) and !empty($vSem_anu) and !empty($vCod_cur) and ($vNot_cur > 10 and $vNot_cur < 21) )		
		{
			$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
			$vQuery = "Select not_cur from $tNota where num_mat = '{$sEstudia['num_mat']}' and ";
			$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and pln_est = '$vPln_est' and cod_cur = '$vCod_cur' and ";
			$vQuery .= "mod_not = '04'";
			$cNota = fQuery($vQuery);
			if($aNota = $cNota->fetch_array())
			{
				$vQuery = "update $tNota set not_cur = $vNot_cur where num_mat = '{$sEstudia['num_mat']}' and ";
				$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and pln_est = '$vPln_est' and cod_cur = '$vCod_cur' and ";
				$vQuery .= "mod_not = '04'";
			}
			else
			{			
				$vQuery = "Insert into $tNota (num_mat, cod_car, pln_est, cod_cur, mod_not, ano_aca, per_aca, not_cur) values ";
				$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '$vPln_est', '$vCod_cur', '04', '0000', '00', $vNot_cur)";
			}
			$vResult = fInupde($vQuery);
			if($vResult)
				header("Location:con_viewnota.php");
			else
				header("Location:con_addnota.php");
		}
		else
		{
			header("Location:con_addnota.php");
		}
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
