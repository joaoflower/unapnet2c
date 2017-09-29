<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{
		$vCod_cur = $sUsercoo['cod_cur'];

		$vQuery = "delete from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sUsercoo['pln_est']}' and ";
		$vQuery .= "cod_cur = '$vCod_cur' ";

		$cResult = fInupde($vQuery);
	
		header("Location:pln_selectplan.php");
	}
	else
	{
		header("Location:../index.php");
	}			
			
?>