<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vCod_cur = $_GET['rCod_cur'];
		$vNot_cur = $_GET['rNot_cur'];
		
		$sNotas[$vCod_cur] = $vNot_cur;
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
