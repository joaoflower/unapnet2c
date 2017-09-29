<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vNom_esp = trim($_POST['rNom_esp']);
		$sUsercoo['pln_est'] = $_POST['rPln_est'];
		
		if($sUsercoo['upin'] == 'u')
		{		
			$vQuery = "Update unapnet.curso set cod_cat = '$vCod_cat', nom_cur = '$vNom_cur', nom_ofi = '$vNom_ofi', ";
			$vQuery .= "niv_est = '$vNiv_est', sem_anu = '$vSem_anu', cod_esp = '$vCod_esp', hrs_teo = $vHrs_teo, ";
			$vQuery .= "hrs_pra = $vHrs_pra, hrs_tot = '$vHrs_tot', crd_cur = $vCrd_cur, tip_cur = '$vTip_cur', ";
			$vQuery .= "tip_pre = '$vTip_pre', crd_prq = $vCrd_prq where cod_cur = '{$sUsercoo['cod_cur']}' and ";
			$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sUsercoo['pln_est']}' ";
		}
		elseif($sUsercoo['upin'] == 'i') 
		{
			$vQuery = "Select max(cod_esp) as cod_esp from unapnet.especial where cod_car = '{$sUsercoo['cod_car']}' and ";
			$vQuery .= "pln_est = '{$_POST['rPln_est']}' ";
			$cMax = fQuery($vQuery);
			if($aMax = $cMax->fetch_array())
			{
				$aMax['cod_esp']++;
				if(strlen($aMax['cod_esp']) == 1)				
					$aMax['cod_esp'] = '0'.$aMax['cod_esp'];
			}
			$sUsercoo['cod_espx'] = (empty($aMax['cod_esp'])?'01':$aMax['cod_esp']);
		
			$vQuery = "Insert into unapnet.especial (cod_esp, pln_est, cod_car, esp_nom ) values ";
			$vQuery .= "('{$sUsercoo['cod_espx']}', '{$_POST['rPln_est']}', '{$sUsercoo['cod_car']}', '$vNom_esp' ) ";
		}

		$cResult = fInupde($vQuery);

		if($cResult)
		{
			header("Location:esp_viewesp.php");
		}
		else
		{
			header("Location:esp_getespe.php");
		}
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
