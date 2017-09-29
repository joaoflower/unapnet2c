<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";

	if(fsafetyselcar())
	{
		$vDia_hor = $_POST['rDia_hor'];
		if(!empty($vDia_hor))
		{
			$tHorario = "unapnet.hora{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
			foreach($vDia_hor as $vDia_hor2)
			{
				$vDia = substr($vDia_hor2, 0, 1);
				$vHora = substr($vDia_hor2, 1, 2);
				$vQuery = "Insert into $tHorario values ('{$sUsercoo['pln_est']}', '{$sUsercoo['cod_cur']}', ";
				$vQuery .= "'{$sUsercoo['sec_gru']}', '$vDia', '$vHora', '{$sUsercoo['per_aca']}', '{$sUsercoo['cod_car']}')";
				fInupde($vQuery);
			}			
		}
		header("Location:hor_plancur.php");
	}
	else
	{
		header("Location:../index.php");
	}	
?>