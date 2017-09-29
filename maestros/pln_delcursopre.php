<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{
		$vCur_pre = $sUsercoo['cur_pre'];

		$vQuery = "delete from unapnet.requ where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sUsercoo['pln_est']}' and ";
		$vQuery .= "cod_cur = '{$sUsercoo['cod_cur']}' and cur_pre = '$vCur_pre' ";

		$cResult = fInupde($vQuery);
	
		header("Location:pln_viewcurso.php");
	}
	else
	{
		header("Location:../index.php");
	}			
			
?>