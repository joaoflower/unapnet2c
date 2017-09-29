<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vNum_mat = $_GET['rNum_mat'];
		$vNot_cur = $_GET['rNot_cur'];
		
		$sNotas[$vNum_mat] = $vNot_cur;
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
