<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vQuery = "Select cod_cur ";
		$vQuery .= "from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sUsercoo['pln_est']}' ";
		$cCurso = fQuery($vQuery);
		while($aCurso = $cCurso->fetch_array())
		{
			 $vCod_esp = "rCod_esp{$aCurso['cod_cur']}";
			 $vTip_cur = "rTip_cur{$aCurso['cod_cur']}";
			 $vTip_pre = "rTip_pre{$aCurso['cod_cur']}";
			 if(!empty($_POST[$vCod_esp]) and !empty($_POST[$vTip_cur]) and !empty($_POST[$vTip_pre]))
			 {
			 	$vCod_esp2 = $_POST[$vCod_esp];
				$vTip_cur2 = $_POST[$vTip_cur];
				$vTip_pre2 = $_POST[$vTip_pre];
				
				$vQuery = "Update unapnet.curso set cod_esp = '$vCod_esp2', tip_cur = '$vTip_cur2', tip_pre = '$vTip_pre2' ";
				$vQuery .= "where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sUsercoo['pln_est']}' and ";
				$vQuery .= "cod_cur = '{$aCurso['cod_cur']}' ";
				fInupde($vQuery);
			 }
		}
		header("Location:pln_viewplan.php");
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>