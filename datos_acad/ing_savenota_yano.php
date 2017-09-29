<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
		
		$vQuery = "Select num_mat, $tCurmat.mod_mat ";
		$vQuery .= "from $tCurmat left join unapnet.modmat on $tCurmat.mod_mat = modmat.mod_mat ";
		$vQuery .= "where $tCurmat.pln_est = '{$sUsercoo['pln_est']}' and $tCurmat.per_aca = '{$sUsercoo['per_aca']}' and ";
		$vQuery .= "$tCurmat.cod_cur = '{$sUsercoo['cod_cur']}' and $tCurmat.sec_gru = '{$sUsercoo['sec_gru']}' and ";
		$vQuery .= "modmat.mod_not = '{$sUsercoo['mod_not']}' order by num_mat";
		$cCurmat = fQuery($vQuery);
		while($aCurmat = $cCurmat->fetch_array())
		{
			$vNot_cur = "rNot_cur".$aCurmat['num_mat'];
			$vNota = $$vNot_cur;
			if(empty($vNota))
				$vNota = 0;
			
			
			$vFecha = fFecha();
			$vQuery = "Select num_mat, not_cur ";
			$vQuery .= "from $tNota where num_mat = '{$aCurmat['num_mat']}' and cod_car = '{$sUsercoo['cod_car']}' and ";
			$vQuery .= "pln_est = '{$sUsercoo['pln_est']}' and cod_cur = '{$sUsercoo['cod_cur']}' and ";
			$vQuery .= "mod_not = '{$sUsercoo['mod_not']}' and ano_aca = '{$sUsercoo['ano_aca']}' and ";
			$vQuery .= "per_aca = '{$sUsercoo['per_aca']}'";
			$cNota = fQuery($vQuery);
			if($aNota = $cNota->fetch_array())
			{
				$vQuery = "Update $tNota set not_cur = $vNota where num_mat = '{$aCurmat['num_mat']}' and cod_car = '{$sUsercoo['cod_car']}' and ";
				$vQuery .= "pln_est = '{$sUsercoo['pln_est']}' and cod_cur = '{$sUsercoo['cod_cur']}' and ";
				$vQuery .= "mod_not = '{$sUsercoo['mod_not']}' and ano_aca = '{$sUsercoo['ano_aca']}' and ";
				$vQuery .= "per_aca = '{$sUsercoo['per_aca']}'";
				$vReturn = fInupde($vQuery);
			}
			else
			{
				$vQuery = "Insert Into $tNota (num_mat, cod_car, pln_est, cod_cur, mod_not, ano_aca, per_aca, mod_mat, not_cur, ";
				$vQuery .= "fch_not, cod_usu, mod_ing) values ";
				$vQuery .= "('{$aCurmat['num_mat']}', '{$sUsercoo['cod_car']}', '{$sUsercoo['pln_est']}', '{$sUsercoo['cod_cur']}', ";
				$vQuery .= "'{$sUsercoo['mod_not']}', '{$sUsercoo['ano_aca']}', '{$sUsercoo['per_aca']}', '{$aCurmat['mod_mat']}', ";
				$vQuery .= "$vNota, '$vFecha', '{$sUsercoo['cod_usu']}', '01')";
				$vReturn = fInupde($vQuery);
			}	
			header("Location:ing_select.php");
		}
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>