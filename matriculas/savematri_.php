<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if($sUsercoo['safetymatri3'])
		{
			$vTot_crd = 0;
			$aCurdes = $_POST['rCurdes'];
			$aCurobli = $_POST['rCurobli'];
			$aCurele = $_POST['rCurele'];
			$aCuropta = $_POST['rCuropta'];	
			$sEstudia['obs_est'] = $_POST['rObs_est'];
			
			if(empty($aCurdes))
			{
				if($sUsercoo['cod_car'] != '27' and $sUsercoo['cod_car'] != '04' and $sUsercoo['cod_car'] != '29' and $sUsercoo['cod_car'] != '01' and $sUsercoo['cod_car'] != '02' and $sUsercoo['cod_car'] != '03'  and $sUsercoo['per_aca'] != '03')
				{
					if(!empty($sCurmat)) foreach($sCurmat as $vCod_cur => $aCurmat)
					{
						$vGrupo = "rGrupo$vCod_cur";
						$vGrupo2 = $_POST[$vGrupo];
						$sCurmat2[$vCod_cur]['sec_gru'] = $vGrupo2;
						$sCurmat2[$vCod_cur]['mod_mat'] = $aCurmat['mod_mat'];
						$sCurmat2[$vCod_cur]['tur_est'] = $aCurmat['tur_est'];
						$sCurmat2[$vCod_cur]['cur_obli'] = $aCurmat['cur_obli'];
						$vTot_crd += $sCurso[$vCod_cur]['crd_cur'];
					}
				}
			}
			else
			{
				if(!empty($sCurmat)) foreach($sCurmat as $vCod_cur => $aCurmat)
				{
					$vGrupo = "rGrupo$vCod_cur";
					$vGrupo2 = $_POST[$vGrupo];
					if(!empty($aCurdes[$vCod_cur]))
					{
						$sCurmat2[$vCod_cur]['sec_gru'] = $vGrupo2;
						$sCurmat2[$vCod_cur]['mod_mat'] = $aCurmat['mod_mat'];
						$sCurmat2[$vCod_cur]['tur_est'] = $aCurmat['tur_est'];
						$sCurmat2[$vCod_cur]['cur_obli'] = $aCurmat['cur_obli'];
						$vTot_crd += $sCurso[$vCod_cur]['crd_cur'];
					}
				}
			}
			
			if(!empty($aCurobli)) foreach($aCurobli as $vCod_cur => $vCod_cur2)
			{
				if($sCurapto[$vCod_cur])
				{
					$vGrupo = "rGrupo$vCod_cur";
					$vGrupo2 = $_POST[$vGrupo];
					$sCurmat2[$vCod_cur]['sec_gru'] = $vGrupo2;					
				  	if($sEstudia['mod_mat'] == '16' or $sEstudia['mod_mat'] == '09' or $sEstudia['mod_mat'] == '10')   
						$sCurmat2[$vCod_cur]['mod_mat'] = $sEstudia['mod_mat'];
					else
						$sCurmat2[$vCod_cur]['mod_mat'] = '01';
					$sCurmat2[$vCod_cur]['tur_est'] = '1';
					$vTot_crd += $sCurso[$vCod_cur]['crd_cur'];
				}
			}					
			if(!empty($aCuropta)) foreach($aCuropta as $vCod_cur => $vCod_cur2)
			{
				if($sCurapto[$vCod_cur])
				{
					$vGrupo = "rGrupo$vCod_cur";
					$vGrupo2 = $_POST[$vGrupo];
					$sCurmat2[$vCod_cur]['sec_gru'] = $vGrupo2;
					if($sEstudia['mod_mat'] == '16' or $sEstudia['mod_mat'] == '09' or $sEstudia['mod_mat'] == '10') 				  						$sCurmat2[$vCod_cur]['mod_mat'] = $sEstudia['mod_mat'];
					else
						$sCurmat2[$vCod_cur]['mod_mat'] = '01';
					$sCurmat2[$vCod_cur]['tur_est'] = '1';
					$vTot_crd += $sCurso[$vCod_cur]['crd_cur'];
				}
			}
			if(!empty($aCurele)) foreach($aCurele as $vCod_cur => $vCod_cur2)
			{
				if($sCurapto[$vCod_cur])
				{
					$vGrupo = "rGrupo$vCod_cur";
					$vGrupo2 = $_POST[$vGrupo];
					$sCurmat2[$vCod_cur]['sec_gru'] = $vGrupo2;
					if($sEstudia['mod_mat'] == '16' or $sEstudia['mod_mat'] == '09' or $sEstudia['mod_mat'] == '10') 			  
						$sCurmat2[$vCod_cur]['mod_mat'] = $sEstudia['mod_mat'];
					else
						$sCurmat2[$vCod_cur]['mod_mat'] = '01';
					$sCurmat2[$vCod_cur]['tur_est'] = '1';
					$vTot_crd += $sCurso[$vCod_cur]['crd_cur'];
				}
			}
			
			if($vTot_crd > 0 and $vTot_crd <= $sEstudia['max_crd'])
			{
				$sEstudia['tot_crd'] = $vTot_crd;
				$sEstudia['niv_est'] = fSemestudia($sEstudia['pln_est'], $sEstudia['all_crd'] + $sEstudia['tot_crd']);
				if(fMatricular())
				{
					$sUsercoo['safetymatri3'] = FALSE;
					$sUsercoo['safetymatri4'] = TRUE;
					header("Location:viewmatri.php");
				}
				else
					header("Location:selectcurso.php");
			}
			else
			{
				header("Location:selectcurso.php");
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