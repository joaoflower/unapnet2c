<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vObs_not = $_GET['rObs_not'];
	
		$sUsercoo['obs_not'] = $vObs_not;
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
