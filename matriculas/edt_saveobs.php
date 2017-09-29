<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vObs_est = trim($_GET['rObs_est']);
		
		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		
		$vQuery = "Update $tEstumat set obs_est = '$vObs_est' ";
		$vQuery .= "where num_mat = '{$sEstudia['num_mat']}' and per_aca = '{$sUsercoo['per_aca']}'";
		$bResult = fInupde($vQuery);
		
		$sEstudia['obs_est'] = $vObs_est;
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
