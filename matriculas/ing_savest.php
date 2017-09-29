<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{		
		if($sUsercoo['safetymatri'])
		{
			$sEstudia['tip_doc'] = $_POST['rTip_doc'];
			$sEstudia['num_doc'] = $_POST['rNum_doc'];
			$sEstudia['dia'] = $_POST['rDia'];
			$sEstudia['mes'] = $_POST['rMes'];
			$sEstudia['ano'] = $_POST['rAno'];
			$sEstudia['fec_nac'] = "19{$sEstudia['ano']}-{$sEstudia['mes']}-{$sEstudia['dia']}";
			$sEstudia['sexo']    = $_POST['rSexo'];
			$sEstudia['est_civ'] = $_POST['rEst_civ'];
			$sEstudia['cod_nac'] = $_POST['rCod_nac'];
			$sEstudia['cod_dep'] = $_POST['rCod_dep'];
			$sEstudia['cod_prv'] = $_POST['rCod_prv'];
			$sEstudia['cod_dis'] = $_POST['rCod_dis'];
			$sEstudia['direc']   = $_POST['rDirec'];
			$sEstudia['fono']    = $_POST['rFono'];
			$sEstudia['mod_ing'] = $_POST['rMod_ing'];
			$sEstudia['fch_ing'] = $_POST['rFch_ing'];
			$sEstudia['celular'] = $_POST['rCelular'];
			
			$vQuery = "update unapnet.estudiante set tip_doc = '{$sEstudia['tip_doc']}', num_doc = '{$sEstudia['num_doc']}', ";
			$vQuery .= "fch_nac = '{$sEstudia['fec_nac']}', sexo = '{$sEstudia['sexo']}', est_civ = '{$sEstudia['est_civ']}', ";
			$vQuery .= "cod_nac = '{$sEstudia['cod_nac']}', cod_dep = '{$sEstudia['cod_dep']}', cod_prv = '{$sEstudia['cod_prv']}', ";
			$vQuery .= "cod_dis = '{$sEstudia['cod_dis']}', direc = '{$sEstudia['direc']}', fono = '{$sEstudia['fono']}', ";
			$vQuery .= "mod_ing = '{$sEstudia['mod_ing']}', fch_ing = '{$sEstudia['fch_ing']}', celular = '{$sEstudia['celular']}' ";
			$vQuery .= "where num_mat = '{$sEstudia['num_mat']}' and cod_car = '{$sUsercoo['cod_car']}'";
			
			$bUpdate = fInupde($vQuery);
			if($bUpdate)
			{
				$sUsercoo['safetymatri'] = FALSE;
				$sUsercoo['safetymatri2'] = TRUE;
				header("Location:ing_matri1.php");
			}
			else
			{
				$sUsercoo['errorl'] = TRUE;
				$sUsercoo['msnerror'] = 'ERROR, NO SE GUARDARON LOS DATOS';
				header("Location:ing_getdata.php");
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