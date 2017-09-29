<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if($sUsercoo['safetymatri3'])
		{
			$vTot_cur = 0;
			$aCurdes = $_POST['rCurdes'];
			$aCurobli = $_POST['rCurobli'];

			$sEstudia['obs_est'] = $_POST['rObs_est'];
			
			if(!empty($aCurdes)) foreach($aCurdes as $vCod_cur => $vCod_cur2)
			{
				if($sCurapto[$vCod_cur])
				{
					$vGrupo = "rGrupo$vCod_cur";
					$vGrupo2 = $_POST[$vGrupo];
					$sCurmat2[$vCod_cur]['sec_gru'] = $vGrupo2;
					
					$vModmat = "rModmat$vCod_cur";
					$vModmat2 = $_POST[$vModmat];
					$sCurmat2[$vCod_cur]['mod_mat'] = $vModmat2;
										
					$sCurmat2[$vCod_cur]['tur_est'] = '1';
					$vTot_cur++;
				}
			}
			
			if(!empty($aCurobli)) foreach($aCurobli as $vCod_cur => $vCod_cur2)
			{
				if($sCurapto[$vCod_cur])
				{
					$vGrupo = "rGrupo$vCod_cur";
					$vGrupo2 = $_POST[$vGrupo];
					$sCurmat2[$vCod_cur]['sec_gru'] = $vGrupo2;					
				  	
					$vModmat = "rModmat$vCod_cur";
					$vModmat2 = $_POST[$vModmat];
					$sCurmat2[$vCod_cur]['mod_mat'] = $vModmat2;
										
					$sCurmat2[$vCod_cur]['tur_est'] = '1';
					$vTot_cur++;
				}
			}	
			
			if($vTot_cur > 0)
			{
				$sEstudia['tot_crd'] = 0;
				if(fMatricularrg())
				{
					$sUsercoo['safetymatri3'] = FALSE;
					$sUsercoo['safetymatri4'] = TRUE;
					header("Location:viewmatri.php");
				}
				else
				{
					header("Location:selectcursorg.php");
				}
			}
			else
			{
				header("Location:selectcursorg.php");
			}	

		}
		else
			header("Location:ing_getestu.php");
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>