<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$aCurpre = $_POST['rCurpre'];
		
		if(!empty($aCurpre)) foreach($aCurpre as $vCod_cur => $vCod_cur2)
		{
			$vQuery = "Insert into unapnet.requ (cod_car, pln_est, cod_cur, cur_pre) values ";
			$vQuery .= "('{$sUsercoo['cod_car']}', '{$sUsercoo['pln_est']}', '{$sUsercoo['cod_cur']}', '$vCod_cur')";
	
			$cResult = fInupde($vQuery);
	
/*			if($cResult)
			{
				
			}
			else
			{
				header("Location:pln_getcursopre.php");
			}*/
		}
		header("Location:pln_viewcurso.php");
	}
	else
	{
		header("Location:../index.php");
	}			
			
?>