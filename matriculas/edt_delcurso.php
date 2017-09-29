<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vCrd_cur = $sCurso[$sEstudia['cod_cur']]['crd_cur'];
		$vMod_mat = $sCurmat[$sEstudia['cod_cur']]['mod_mat'];
		$vSec_gru = $sCurmat[$sEstudia['cod_cur']]['sec_gru'];
		$vTur_est = $sCurmat[$sEstudia['cod_cur']]['tur_est'];
		
		$vQuery = "Delete from $tCurmat where num_mat = '{$sEstudia['num_mat']}' and " ;
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and cod_cur = '{$sEstudia['cod_cur']}' and mod_mat = '$vMod_mat' ";
		$vQuery .= "and cur_obli = ''";
		$bResult = fInupde($vQuery);
		if($bResult)
		{
			//-------------LOG----------------------
			$tLogcurmat = "unapnet.logcurmat{$sUsercoo['ano_aca']}";
			$vQuery = "Insert into $tLogcurmat (num_mat, cod_car, ano_aca, per_aca, pln_est, cod_cur, sec_gru, ";
			$vQuery .= "mod_mat, tur_est, cod_usu, cod_log, fch_log, dir_ip) values " ;
			$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sUsercoo['ano_aca']}', ";
			$vQuery .= "'{$sUsercoo['per_aca']}', '{$sEstudia['pln_est']}', '{$sEstudia['cod_cur']}', ";
			$vQuery .= "'$vSec_gru', '$vMod_mat',  ";
			$vQuery .= "'$vTur_est', '{$sUsercoo['cod_usu']}', '03', now(), '{$sUsercoo['ip']}' ) ";
			$bResult = fInupde($vQuery);
			//--------------------------------------
			
			$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
			if($vCrd_cur >= $sEstudia['tot_crd'])
			{
				$vQuery = "Delete from $tEstumat where  num_mat = '{$sEstudia['num_mat']}' and " ;
				$vQuery .= "per_aca = '{$sUsercoo['per_aca']}'";					
				$bResult = fInupde($vQuery);
				
				//-------------LOG----------------------
				$tLogestumat = "unapnet.logestumat{$sUsercoo['ano_aca']}";
				$vQuery = "Insert into $tLogestumat (num_mat, cod_car, ano_aca, per_aca, pln_est, cod_esp, sec_gru, mod_mat, ";
				$vQuery .= "crd_mat, tur_est, cod_usu, cod_log, fch_log, dir_ip) values " ;
				$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sUsercoo['ano_aca']}', ";
				$vQuery .= "'{$sUsercoo['per_aca']}', '{$sEstudia['pln_est']}', '{$sEstudia['cod_esp']}', ";
				$vQuery .= "'{$sEstudia['sec_gru']}', '{$sEstudia['mod_mat']}', '{$sEstudia['tot_crd']}', ";
				$vQuery .= "'{$sEstudia['tur_est']}', '{$sUsercoo['cod_usu']}', '03', now(), '{$sUsercoo['ip']}' ) ";
				$bResult = fInupde($vQuery);
				//--------------------------------------
			}
			else
			{
				$vNew_crd = $sEstudia['tot_crd'] - $vCrd_cur;
				$vQuery = "Update $tEstumat set tot_crd = '$vNew_crd' where num_mat = '{$sEstudia['num_mat']}' and " ;
				$vQuery .= "per_aca = '{$sUsercoo['per_aca']}'";
				$bResult = fInupde($vQuery);
			}
		}
		header("Location:edt_viewmatri.php?rNum_mat={$sEstudia['num_mat']}&rCod_car={$sEstudia['cod_car']}");
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
