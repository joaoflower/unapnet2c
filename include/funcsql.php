<?php
	function fInupde($pQuery)
	{
		global $sConedb;
		$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
		$xSerdata->query('BEGIN');
		$cResult = $xSerdata->query($pQuery);
		if ($cResult) $xSerdata->query('COMMIT');
		else $xSerdata->query('ROLLBACK');
		$xSerdata->close();
		return $cResult;
	}
	
	function fQuery($pQuery)
	{
		global $sConedb;
		$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
		return $xSerdata->query($pQuery);
	}
	function fCountq($pQuery)
	{
		global $sConedb;
		$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
		$cQuery = $xSerdata->query($pQuery);
		return $cQuery->num_rows;
	}
	function fQuery2($pQuery)
	{
/*		global $sConedb;
		$xSerdata = mysql_connect($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
		return mysql_query($pQuery, $xSerdata);*/
	}
	
	function fMatricular()
	{
		global $sConedb, $sUsercoo, $sEstudia, $sCurmat2;
		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$bResult = FALSE;

		if(!empty($sCurmat2)) 
		{
			$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
			
			$vFecha = fFecha();
			$sEstudia['fch_mat'] = $vFecha;
			$vQuery = "Insert into $tEstumat (num_mat, cod_car, pln_est, niv_est, sec_gru, tur_est, ano_aca, per_aca, cod_esp, ";
			$vQuery .= "mod_mat, fch_mat, cod_usu, tot_crd, tip_mat, max_crd, obs_est) values ";
			$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sEstudia['pln_est']}', '{$sEstudia['niv_est']}', ";
			$vQuery .= "'{$sEstudia['sec_gru']}', ";
			$vQuery .= "'1', '{$sUsercoo['ano_aca']}', '{$sUsercoo['per_aca']}', '{$sEstudia['cod_esp']}', ";
			$vQuery .= "'{$sEstudia['mod_mat']}', '$vFecha', '{$sUsercoo['cod_usu']}', {$sEstudia['tot_crd']}, '01', ";
			$vQuery .= "{$sEstudia['max_crd']}, '{$sEstudia['obs_est']}')";
			
			$xSerdata->query('BEGIN');
			$bResult = $xSerdata->query($vQuery);
			if($bResult)
			{
				foreach($sCurmat2 as $vCod_cur => $aCurmat)
				{
					$vQuery = "Insert Into $tCurmat (num_mat, cod_car, pln_est, cod_cur, ano_aca, per_aca, mod_mat, ";
					$vQuery .= "sec_gru, tur_est, cod_usu, cur_obli) values " ;
					$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sEstudia['pln_est']}', ";
					$vQuery .= "'$vCod_cur', '{$sUsercoo['ano_aca']}', '{$sUsercoo['per_aca']}', '{$aCurmat['mod_mat']}', ";
					$vQuery .= "'{$aCurmat['sec_gru']}', '{$aCurmat['tur_est']}', '{$sUsercoo['cod_usu']}', '{$aCurmat['cur_obli']}')";
					
					$bResult = $xSerdata->query($vQuery);
					if(!$bResult)
					{
						$xSerdata->query('ROLLBACK');
						return $bResult;
					}
				}
				$xSerdata->query('COMMIT');				
			}
			else
			{
				$xSerdata->query('ROLLBACK');
			}
			$xSerdata->close();
		}
		return $bResult;
	}
	function fMatricularrg()
	{
		global $sConedb, $sUsercoo, $sEstudia, $sCurmat2;
		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$bResult = FALSE;

		if(!empty($sCurmat2)) 
		{
			$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
			
			$vFecha = fFecha();
			$vQuery = "Insert into $tEstumat (num_mat, cod_car, pln_est, niv_est, sec_gru, tur_est, ano_aca, per_aca, cod_esp, ";
			$vQuery .= "mod_mat, fch_mat, cod_usu, tot_crd, tip_mat, max_crd, obs_est) values ";
			$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sEstudia['pln_est']}','{$sEstudia['niv_est']}', ";
			$vQuery .= "'{$sEstudia['sec_gru']}' , ";
			$vQuery .= "'1', '{$sUsercoo['ano_aca']}', '{$sUsercoo['per_aca']}', '{$sEstudia['cod_esp']}', ";
			$vQuery .= "'{$sEstudia['mod_mat']}', '$vFecha', '{$sUsercoo['cod_usu']}', 0.00, '01', ";
			$vQuery .= "0.00, '{$sEstudia['obs_est']}')";
			
			$xSerdata->query('BEGIN');
			$bResult = $xSerdata->query($vQuery);
			if($bResult)
			{
				foreach($sCurmat2 as $vCod_cur => $aCurmat)
				{
					$vQuery = "Insert Into $tCurmat (num_mat, cod_car, pln_est, cod_cur, ano_aca, per_aca, mod_mat, ";
					$vQuery .= "sec_gru, tur_est, cod_usu, cur_obli) values " ;
					$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sEstudia['pln_est']}', ";
					$vQuery .= "'$vCod_cur', '{$sUsercoo['ano_aca']}', '{$sUsercoo['per_aca']}', '{$aCurmat['mod_mat']}', ";
					$vQuery .= "'{$aCurmat['sec_gru']}', '{$aCurmat['tur_est']}', '{$sUsercoo['cod_usu']}', ";
					$vQuery .= "'{$aCurmat['cur_obli']}')";
					
					$bResult = $xSerdata->query($vQuery);
					if(!$bResult)
					{
						$xSerdata->query('ROLLBACK');
						return $bResult;
					}
				}
				$xSerdata->query('COMMIT');				
			}
			else
			{
				$xSerdata->query('ROLLBACK');
			}
			$xSerdata->close();
		}
		return $bResult;
	}
	function fMatricurso()
	{
		global $sConedb, $sUsercoo, $sEstudia, $sCurmat2;
		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$bResult = FALSE;

		if(!empty($sCurmat2)) 
		{
			$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
						
			$vQuery = "Update $tEstumat set tot_crd = {$sEstudia['tot_crd2']} where num_mat = '{$sEstudia['num_mat']}' and ";
			$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' ";
			
			$xSerdata->query('BEGIN');
			$bResult = $xSerdata->query($vQuery);
			if($bResult)
			{
				//-------------LOG----------------------
				$tLogestumat = "unapnet.logestumat{$sUsercoo['ano_aca']}";
				$vQuery = "Insert into $tLogestumat (num_mat, cod_car, ano_aca, per_aca, pln_est, cod_esp, sec_gru, mod_mat, ";
				$vQuery .= "crd_mat, tur_est, cod_usu, cod_log, fch_log, dir_ip) values " ;
				$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sUsercoo['ano_aca']}', ";
				$vQuery .= "'{$sUsercoo['per_aca']}', '{$sEstudia['pln_est']}', '{$sEstudia['cod_esp']}', ";
				$vQuery .= "'{$sEstudia['sec_gru']}', '{$sEstudia['mod_mat']}', '{$sEstudia['tot_crd']}', ";
				$vQuery .= "'{$sEstudia['tur_est']}', '{$sUsercoo['cod_usu']}', '02', now(), '{$sUsercoo['ip']}' ) ";
				$bResult = fInupde($vQuery);
				//--------------------------------------
			
				foreach($sCurmat2 as $vCod_cur => $aCurmat)
				{
					$vQuery = "Insert Into $tCurmat (num_mat, cod_car, pln_est, cod_cur, ano_aca, per_aca, mod_mat, ";
					$vQuery .= "sec_gru, tur_est, cod_usu, cur_obli) values " ;
					$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sEstudia['pln_est']}', ";
					$vQuery .= "'$vCod_cur', '{$sUsercoo['ano_aca']}', '{$sUsercoo['per_aca']}', '{$aCurmat['mod_mat']}', ";
					$vQuery .= "'{$aCurmat['sec_gru']}', '{$aCurmat['tur_est']}', '{$sUsercoo['cod_usu']}', '{$aCurmat['cur_obli']}')";
					
					$bResult = $xSerdata->query($vQuery);
					if(!$bResult)
					{
						$xSerdata->query('ROLLBACK');
						return $bResult;
					}
					//-------------LOG----------------------
					$tLogcurmat = "unapnet.logcurmat{$sUsercoo['ano_aca']}";
					$vQuery = "Insert into $tLogcurmat (num_mat, cod_car, ano_aca, per_aca, pln_est, cod_cur, sec_gru, ";
					$vQuery .= "mod_mat, tur_est, cod_usu, cod_log, fch_log, dir_ip) values " ;
					$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sUsercoo['ano_aca']}', ";
					$vQuery .= "'{$sUsercoo['per_aca']}', '{$sEstudia['pln_est']}', '$vCod_cur', ";
					$vQuery .= "'{$aCurmat['sec_gru']}', '{$aCurmat['mod_mat']}',  ";
					$vQuery .= "'{$aCurmat['tur_est']}', '{$sUsercoo['cod_usu']}', '01', now(), '{$sUsercoo['ip']}' ) ";
					$bResult = fInupde($vQuery);
					//--------------------------------------
				}
				$xSerdata->query('COMMIT');				
			}
			else
			{
				$xSerdata->query('ROLLBACK');
			}
			$xSerdata->close();
		}
		return $bResult;
	}

?>