<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vPln_est = $_GET['rPln_est'];
		$vCod_cur = $_GET['rCod_cur'];

		if(!empty($vPln_est) and !empty($vCod_cur))		
		{
			$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
			$vQuery = "delete from $tNota where num_mat = '{$sEstudia['num_mat']}' and ";
			$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and pln_est = '$vPln_est' and cod_cur = '$vCod_cur' and ";
			$vQuery .= "mod_not = '04'";
			$vResult = fInupde($vQuery);			
		}
		header("Location:con_viewnota.php");
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
