<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vCod_cur = $_GET['rCod_cur'];
		$vCan_vac = $_GET['rCan_vac'];
		
		$sNotas[$vCod_cur] = $vCan_vac;
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
