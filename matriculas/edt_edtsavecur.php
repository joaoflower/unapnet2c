<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if(!empty($_POST['rSec_gru']) and !empty($_POST['rMod_mat']))
		{
			if($_POST['rMod_mat'] == $sCurmat[$sEstudia['cod_cur']]['mod_mat'] or $_POST['rMod_mat'] == '16' or $_POST['rMod_mat'] == '10')
			{				
				$vSec_gru2 = $_POST['rSec_gru'];	
				$vMod_mat2 = $_POST['rMod_mat'];					
				
				$vSec_gru = $sCurmat[$sEstudia['cod_cur']]['sec_gru'];
				$vMod_mat = $sCurmat[$sEstudia['cod_cur']]['mod_mat'];
				$vTur_est = $sCurmat[$sEstudia['cod_cur']]['tur_est'];				
				
				$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
				if(!empty($_POST['rTodos']))
				{					
					if(!empty($sCurmat))
					foreach($sCurmat as $vCod_cur => $aCurmat)
					{
						$vSec_gru = $aCurmat['sec_gru'];
						$vMod_mat = $aCurmat['mod_mat'];
						$vTur_est = $aCurmat['tur_est'];
						
						//-------------LOG----------------------
						$tLogcurmat = "unapnet.logcurmat{$sUsercoo['ano_aca']}";
						$vQuery = "Insert into $tLogcurmat (num_mat, cod_car, ano_aca, per_aca, pln_est, cod_cur, sec_gru, ";
						$vQuery .= "mod_mat, tur_est, cod_usu, cod_log, fch_log, dir_ip) values " ;
						$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sUsercoo['ano_aca']}', ";
						$vQuery .= "'{$sUsercoo['per_aca']}', '{$sEstudia['pln_est']}', '$vCod_cur', ";
						$vQuery .= "'$vSec_gru', '$vMod_mat',  ";
						$vQuery .= "'$vTur_est', '{$sUsercoo['cod_usu']}', '02', now(), '{$sUsercoo['ip']}' ) ";
						$bResult = fInupde($vQuery);
						//--------------------------------------
					}					
					$vQuery = "Update $tCurmat set sec_gru = '$vSec_gru2' where num_mat = '{$sEstudia['num_mat']}' and " ;
					$vQuery .= "per_aca = '{$sUsercoo['per_aca']}'";
				}
				else
				{
					//-------------LOG----------------------
					$tLogcurmat = "unapnet.logcurmat{$sUsercoo['ano_aca']}";
					$vQuery = "Insert into $tLogcurmat (num_mat, cod_car, ano_aca, per_aca, pln_est, cod_cur, sec_gru, ";
					$vQuery .= "mod_mat, tur_est, cod_usu, cod_log, fch_log, dir_ip) values " ;
					$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sUsercoo['ano_aca']}', ";
					$vQuery .= "'{$sUsercoo['per_aca']}', '{$sEstudia['pln_est']}', '{$sEstudia['cod_cur']}', ";
					$vQuery .= "'$vSec_gru', '$vMod_mat',  ";
					$vQuery .= "'$vTur_est', '{$sUsercoo['cod_usu']}', '02', now(), '{$sUsercoo['ip']}' ) ";
					$bResult = fInupde($vQuery);
					//--------------------------------------
					
					$vQuery = "Update $tCurmat set sec_gru = '$vSec_gru2', mod_mat = '$vMod_mat2' ";
					$vQuery .= "where num_mat = '{$sEstudia['num_mat']}' and per_aca = '{$sUsercoo['per_aca']}' and " ;
					$vQuery .= "pln_est = '{$sEstudia['pln_est']}' and cod_cur = '{$sEstudia['cod_cur']}' and ";
					$vQuery .= "mod_mat = '$vMod_mat'";
				}
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
