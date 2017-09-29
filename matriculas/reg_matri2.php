<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if($sUsercoo['safetymatri2'])
		{
			$vMod_mat = $_POST['rMod_mat'];
			$vSec_gru = $_POST['rSec_gru'];
			if(!empty($sModmat[$vMod_mat]['mod_des']))
			{
				if($vMod_mat == '16' or $vMod_mat == '09' or $vMod_mat == '10' or $vMod_mat == '06')
					$sEstudia['mod_mat'] = $vMod_mat;
				$sEstudia['sec_gru'] = $vSec_gru;
				
				$sCurso = "";
				$vQuery = "select cod_cur, cod_cat, nom_cur, sem_anu, cod_esp, crd_cur, tip_pre, tip_cur, crd_prq ";
				$vQuery .= "from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sEstudia['pln_est']}' ";
				$vQuery .= " and con_cur = '1' ";
				if ($sUsercoo['cod_car'] == '01' or $sUsercoo['cod_car'] == '02' or $sUsercoo['cod_car'] == '32')
				{
					$vQuery .= " order by sem_anu, cod_cur";
				}
				else
				{
					$vQuery .= "and (cod_esp = '00' or cod_esp = '{$sEstudia['cod_esp']}') order by sem_anu, cod_cur";
				}
				
				$cCurso = fQuery($vQuery);
				while($aCurso = $cCurso->fetch_array())
				{
					$sCurso[$aCurso['cod_cur']]['cod_cat'] = $aCurso['cod_cat'];
					$sCurso[$aCurso['cod_cur']]['nom_cur'] = $aCurso['nom_cur'];
					$sCurso[$aCurso['cod_cur']]['sem_anu'] = $aCurso['sem_anu'];
					$sCurso[$aCurso['cod_cur']]['cod_esp'] = $aCurso['cod_esp'];
					$sCurso[$aCurso['cod_cur']]['crd_cur'] = $aCurso['crd_cur'];
					$sCurso[$aCurso['cod_cur']]['tip_pre'] = $aCurso['tip_pre'];
					$sCurso[$aCurso['cod_cur']]['tip_cur'] = $aCurso['tip_cur'];
					$sCurso[$aCurso['cod_cur']]['crd_prq'] = $aCurso['crd_prq'];
				}
				
				$sUsercoo['safetymatri2'] = FALSE;
				$sUsercoo['safetymatri3'] = TRUE;
				$sEstudia['ingreg'] = 'r';
				header("Location:selectcurso.php");
			}			
			else
				header("Location:reg_matri1.php");
		}
		else
			header("Location:reg_getestu.php");
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
