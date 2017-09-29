<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if($sUsercoo['safetymatri2'])
		{
			$vPln_est = $_POST['rPln_est'];
			$vCod_esp = $_POST['rCod_esp'];
			$vSec_gru = $_POST['rSec_gru'];
			if(!empty($sPlan[$vPln_est]) and !empty($sEspecial[$vPln_est.$vCod_esp]['cod_esp']))
			{
				$sEstudia['pln_est'] = $vPln_est;
				$sEstudia['cod_esp'] = $vCod_esp;
				$sEstudia['tip_sist'] = $sPlan[$vPln_est];
				$sEstudia['mod_mat'] = '01';
				$sEstudia['max_crd'] = fMaxcrding($sEstudia['pln_est']);;
				$sEstudia['tot_apro'] = 0;
				$sEstudia['all_crd'] = 0;
				$sEstudia['sec_gru'] = $vSec_gru;
				
				//--------------------------------------------------------------------
				$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
				$tCurso = "unapnet.curso";
				
				$vQuery = "select sum(cu.crd_cur) as all_crd from $tNota no left join unapnet.curso cu on ";
				$vQuery .= "no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
				$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and no.pln_est = '{$sEstudia['pln_est']}' and ";
				$vQuery .= "no.cod_car = '{$sUsercoo['cod_car']}' and no.not_cur > 10  ";
				$cNotall = fQuery($vQuery);	
				if($aNotall = $cNotall->fetch_array())
				{
					if($aNotall['all_crd'] > 0)
						$sEstudia['all_crd'] = $aNotall['all_crd'];			
				}				
				$sEstudia['sem_anu'] = fSemestudia($sEstudia['pln_est'], $sEstudia['all_crd'] + $sEstudia['max_crd']);
				//--------------------------------------------------------------------
				
				$sCurso = "";
				$vQuery = "select cod_cur, cod_cat, nom_cur, sem_anu, cod_esp, crd_cur, tip_pre, tip_cur, crd_prq ";
				$vQuery .= "from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sEstudia['pln_est']}' ";
				$vQuery .= "and (cod_esp = '00' or cod_esp = '{$sEstudia['cod_esp']}') order by sem_anu, cod_cur";
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
				$sEstudia['ingreg'] = 'i';
				header("Location:selectcurso.php");
			}			
			else
				header("Location:ing_matri1.php");
		}
		else
			header("Location:ing_getestu.php");
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
