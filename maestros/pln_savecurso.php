<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vCod_cat = $_POST['rCod_cat'];
		$vNom_cur = trim($_POST['rNom_cur']);
		$vNom_ofi = trim($_POST['rNom_ofi']);
		$vNiv_est = $_POST['rNiv_est'];
		$vSem_anu = $_POST['rSem_anu'];
		$vCod_esp = $_POST['rCod_esp'];
		$vHrs_teo = $_POST['rHrs_teo'];
		$vHrs_pra = $_POST['rHrs_pra'];
		$vHrs_tot = $vHrs_teo + $vHrs_pra;
		$vCrd_cur = $_POST['rCrd_cur'];
		$vTip_cur = $_POST['rTip_cur'];
		$vTip_pre = $_POST['rTip_pre'];
		$vCrd_prq = $_POST['rCrd_prq'];
		
		$vAcc_cur = $vHrs_tot * 17;
		
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
			$vQuery = "Insert into unapnet.curso (cod_cur, cod_car, pln_est, cod_cat, nom_cur, nom_ofi, sem_anu, ";
			$vQuery .= "cod_esp, hrs_teo, hrs_pra, hrs_tot, crd_cur, dep_aca, cod_are, acc_cur, tip_pre, tip_cur, ";
			$vQuery .= "crd_prq, flg_var, niv_est ) values ";
			$vQuery .= "('{$sUsercoo['cod_cur']}', '{$sUsercoo['cod_car']}', '{$sUsercoo['pln_est']}', '$vCod_cat', ";			
			$vQuery .= "'$vNom_cur', '$vNom_ofi', '$vSem_anu', '$vCod_esp', '$vHrs_teo', '$vHrs_pra', '$vHrs_tot', ";
			$vQuery .= "'$vCrd_cur', '', '', $vAcc_cur, '$vTip_pre', '$vTip_cur', '$vCrd_prq', '', '$vNiv_est') ";
		}

		$cResult = fInupde($vQuery);

		if($cResult)
		{
			header("Location:pln_viewcurso.php");
		}
		else
		{
			header("Location:pln_getcurso.php");
		}
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
