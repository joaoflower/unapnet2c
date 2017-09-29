<?php
	function finit()
	{
		//global $sConeun, $sConedb, $sCarrera, $sTipousu, $sTipodoc, $sSexo, $sMes, $sEstcivil, $sFacultad, $sNacional;
		global $sConedb;
		
/*		$sConedb['host'] = '10.1.1.138';
		$sConedb['user'] = 'todos';
		$sConedb['passwd'] = 'master2005';*/
/*		$sConedb['host'] = 'localhost';
		$sConedb['user'] = 'root';
		$sConedb['passwd'] = 'mysql';*/
/*		$sConedb['host'] = '10.1.1.138';
		$sConedb['user'] = 'master';
		$sConedb['passwd'] = 'master';*/

		//---	data2
		$sConedb['host'] = '10.1.1.134';
		$sConedb['user'] = 'coordinador';
		$sConedb['passwd'] = '1433b02926dfe56b';
		//---
		//---	intranet2
/*		$sConedb['host'] = 'localhost';
		$sConedb['user'] = 'master';
		$sConedb['passwd'] = 'master';*/
		//---
	}
	
	function fpassword($pPasswd)
	{
		$vQuery = "Select password('$pPasswd') as passwd";
		$cPasswd = fQuery($vQuery);
		if($aPasswd = $cPasswd->fetch_array())
			return $aPasswd['passwd'];
	}
	function fold_password($pPasswd)
	{
		$vQuery = "Select old_password('$pPasswd') as passwd";
		$cPasswd = fQuery($vQuery);
		if($aPasswd = $cPasswd->fetch_array())
			return $aPasswd['passwd'];
	}
	function fsafetylogin()
	{
		global $sUsercoo;
		if($sUsercoo['safetylogin'] == '*25740E18E08CC91F492F1B38E5413E1B85E32A01')
			return TRUE;
		else
			return FALSE;
	}
	function fverifyselcar()
	{
		//http://intranet.unap.edu.pe/unapnet2c/
		global $sUsercoo, $sAcceso, $sPeriodo;
		if(!empty($sAcceso[$sUsercoo['cod_car']]) and substr($_SERVER['HTTP_REFERER'], 0, 38) === "http://intranet.unap.edu.pe/unapnet2c/")
			if($sUsercoo['ano_aca'] >= 1999 and $sUsercoo['ano_aca'] <= 2009 )
				if(!empty($sPeriodo[$sUsercoo['per_aca']]))
					return true;
		return false;		
	}
	function fsafetyselcar()
	{
		global $sUsercoo;
		if(fsafetylogin())
		{
			if($sUsercoo['safetyselcar'] == '*25740E18E08CC91F492F1B38E5413E1B85E32A01' and substr($_SERVER['HTTP_REFERER'], 0, 38) === "http://intranet.unap.edu.pe/unapnet2c/")
				return TRUE;
			else
				return FALSE;
		}
		return false;
	}
	function fsafetyselcar2()
	{
		global $sUsercoo;
		if(fsafetylogin())
		{
			if($sUsercoo['safetyselcar'] == '*25740E18E08CC91F492F1B38E5413E1B85E32A01')
				return TRUE;
			else
				return FALSE;
		}
		return false;
	}
	function fviewperiodo($pPer_Aca)
	{
		global $sPeriodo;
		$vReturn = '';

		foreach($sPeriodo as $vPer_Aca => $vPeriodo)
		{
			$vReturn .= "<option value='$vPer_Aca'";
			if ($vPer_Aca == $pPer_Aca) $vReturn .= " Selected";
			$vReturn .= " >{$vPeriodo['per_des']}</option> \n";
		}
		return $vReturn;
	}
	function fviewmoding($pMod_ing)
	{
		global $sModing;
		$vReturn = '';

		foreach($sModing as $vMod_ing => $vIng_des)
		{
			$vReturn .= "<option value='$vMod_ing'";
			if ($vMod_ing == $pMod_ing) $vReturn .= " Selected";
			$vReturn .= " >$vIng_des</option> \n";
		}
		return $vReturn;
	}
	function fviewfechaing($pFch_ing)
	{
		global $sFching;
		$vReturn = '';

		foreach($sFching as $vFch_ing => $vFch_des)
		{
			$vReturn .= "<option value='$vFch_ing'";
			if ($vFch_ing == $pFch_ing) $vReturn .= " Selected";
			$vReturn .= " >$vFch_des</option> \n";
		}
		return $vReturn;
	}
	function fviewtipodoc($pTip_doc)
	{
		global $sTipodoc;
		$vReturn = '';

		foreach($sTipodoc as $vTip_doc => $vDoc_des)
		{
			$vReturn .= "<option value='$vTip_doc'";
			if ($vTip_doc == $pTip_doc) $vReturn .= " Selected";
			$vReturn .= " >$vDoc_des</option> \n";
		}
		return $vReturn;
	}
	function fviewmes($pMes)
	{
		global $sMes;
		$vReturn = '';

		foreach($sMes as $vMes => $vMes_Des)
		{
			if (strlen($vMes) == 2)
			{
				$vReturn .= "<option value='$vMes'";
				if ($vMes == $pMes) $vReturn .= " Selected";
				$vReturn .= " >$vMes_Des</option> \n";
			}
		}
		return $vReturn;
	}
	function fviewsexo($pSexo)
	{
		global $sSexo;
		$vReturn = '';

		foreach($sSexo as $vSexo => $vSex_Des)
		{
			$vReturn .= "<option value='$vSexo'";
			if ($vSexo == $pSexo) $vReturn .= " Selected";
			$vReturn .= " >$vSex_Des</option> \n";
		}
		return $vReturn;
	}
	function fviewestcivil($pEst_civ)
	{
		global $sEstcivil;
		$vReturn = '';

		foreach($sEstcivil as $vEst_civ => $vEst_Des)
		{
			$vReturn .= "<option value='$vEst_civ'";
			if ($vEst_civ == $pEst_civ) $vReturn .= " Selected";
			$vReturn .= " >$vEst_Des</option> \n";
		}
		return $vReturn;
	}
	function fviewnacional($pCod_nac)
	{
		global $sNacional;
		$vReturn = '';

		foreach($sNacional as $vCod_nac => $vNac_des)
		{
			$vReturn .= "<option value='$vCod_nac'";
			if ($vCod_nac == $pCod_nac) $vReturn .= " Selected";
			$vReturn .= " >$vNac_des</option> \n";
		}
		return $vReturn;
	}
	function fviewdepartam($pCod_dep)
	{
		$vReturn = "<option value=''>Seleccione ...</option>\n";

		$vQuery = "Select cod_dep, dep_nom from unapnet.departam where not cod_dep = ''";
		$cDepartam = fQuery($vQuery);
		while($aDepartam = $cDepartam->fetch_array())
		{
			$vReturn .= "<option value=\"{$aDepartam['cod_dep']}\"";
			if ($aDepartam['cod_dep'] == $pCod_dep) $vReturn .= " Selected";
			$vReturn .= " >{$aDepartam['dep_nom']}</option> \n";
		}
		$cDepartam->close();
		return $vReturn;
	}
	function fviewprovinc($pCod_dep, $pCod_prv)
	{
		$vReturn = "<option value=''>Seleccione ...</option>\n";

		$vQuery = "Select cod_prv, prv_nom from unapnet.provinc where cod_dep = '{$pCod_dep}' and not cod_prv = ''";
		$cProvinc = fQuery($vQuery);
		while($aProvinc = $cProvinc->fetch_array())
		{
			$vReturn .= "<option value=\"{$aProvinc['cod_prv']}\"";
			if ($aProvinc['cod_prv'] == $pCod_prv) $vReturn .= " Selected";
			$vReturn .= " >{$aProvinc['prv_nom']}</option> \n";
		}
		$cProvinc->close();
		return $vReturn;
	}
	function fviewdistrito($pCod_dep, $pCod_prv, $pCod_dis)
	{
		$vReturn = "<option value=''>Seleccione ...</option>\n";

		$vQuery = "Select cod_dis, dis_nom from unapnet.distrito where cod_dep = '{$pCod_dep}' and cod_prv = '{$pCod_prv}' and not cod_dis = ''";
		$cDistrito = fQuery($vQuery);
		while($aDistrito = $cDistrito->fetch_array())
		{
			$vReturn .= "<option value=\"{$aDistrito['cod_dis']}\"";
			if ($aDistrito['cod_dis'] == $pCod_dis) $vReturn .= " Selected";
				$vReturn .= " >{$aDistrito['dis_nom']}</option> \n";
		}
		$cDistrito->close();
		return $vReturn;
	}
	function fviewplan($pPln_est)
	{
		global $sPlan, $sTiposist;		
		$vReturn = "<option value=''>Seleccione ...</option>\n";

		foreach($sPlan as $vPln_est => $vTip_sist)
		{
			$vReturn .= "<option value='$vPln_est'";
			if ($vPln_est == $pPln_est) $vReturn .= " Selected";
			$vReturn .= " >$vPln_est-{$sTiposist[$vTip_sist]}</option> \n";
		}
		return $vReturn;
	}
	
	function fviewmodnot($pMod_not)
	{
		global $sModnot;
		$vReturn = '';

		foreach($sModnot as $vMod_not => $vNot_des)
		{
			$vReturn .= "<option value='$vMod_not'";
			if ($vMod_not == $pMod_not) $vReturn .= " Selected";
			$vReturn .= " >$vNot_des</option> \n";
		}
		return $vReturn;
	}
	
	function fviewplanrep($pPln_est)
	{
		global $sPlan, $sTiposist, $sUsercoo;		
		$vReturn = "<option value=''>Seleccione ...</option>\n";

		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vQuery = "Select distinct pln_est from $tCurmat where per_aca = '{$sUsercoo['per_aca']}'";
		$cCurmat = fQuery($vQuery);
		while($aCurmat = $cCurmat->fetch_array())
		{
			$vReturn .= "<option value='{$aCurmat['pln_est']}'";
			if ($aCurmat['pln_est'] == $pPln_est) $vReturn .= " Selected";
			$vReturn .= " >{$aCurmat['pln_est']}-{$sTiposist[$sPlan[$aCurmat['pln_est']]]}</option> \n";
		}
		return $vReturn;
	}
	function fviewplanrepniv($pPln_est)
	{
		global $sPlan, $sTiposist, $sUsercoo;		
		$vReturn = "<option value=''>Seleccione ...</option>\n";

		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vQuery = "Select distinct pln_est from $tEstumat where per_aca = '{$sUsercoo['per_aca']}'";
		$cEstumat = fQuery($vQuery);
		while($aEstumat = $cEstumat->fetch_array())
		{
			$vReturn .= "<option value='{$aEstumat['pln_est']}'";
			if ($aEstumat['pln_est'] == $pPln_est) $vReturn .= " Selected";
			$vReturn .= " >{$aEstumat['pln_est']}-{$sTiposist[$sPlan[$aEstumat['pln_est']]]}</option> \n";
		}
		return $vReturn;
	}
	function fviewespecial($pPln_est, $pCod_esp)
	{
		global $sEspecial;
		$vReturn = "<option value=''>Seleccione ...</option>\n";

		foreach($sEspecial as $vCod_esp => $vEspecial)
		{
			if($vEspecial['pln_est'] == $pPln_est)
			{
				$vReturn .= "<option value='{$vEspecial['cod_esp']}'";
				if ($vEspecial['cod_esp'] == $pCod_esp) $vReturn .= " Selected";
				$vReturn .= " >{$vEspecial['esp_nom']}</option> \n";
			}
		}
		return $vReturn;
	}
	function fviewespecialrep($pPln_est, $pCod_esp)
	{
		global $sEspecial, $sUsercoo;
		$vReturn = "<option value=''>Seleccione ...</option>\n";
		$vReturn .= "<option value='99'";
		if ($pCod_esp == '99')
			$vReturn .= " Selected ";
		$vReturn .= ">TODOS</option>\n";
		
		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vQuery = "Select distinct cod_esp from $tEstumat where per_aca = '{$sUsercoo['per_aca']}' and pln_est = '$pPln_est'";
		$cEstumat = fQuery($vQuery);
		while($aEstumat = $cEstumat->fetch_array())
		{
			$vReturn .= "<option value='{$aEstumat['cod_esp']}'";
			if ($aEstumat['cod_esp'] == $pCod_esp) $vReturn .= " Selected";
			$vReturn .= " >{$sEspecial[$pPln_est.$aEstumat['cod_esp']]['esp_nom']}</option> \n";
		}
		return $vReturn;
	}
	function fviewespecialing($pPln_est, $pCod_esp)
	{
		global $sEspecial, $sUsercoo;
		$vReturn = "<option value=''>Seleccione ...</option>\n";
		
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
//		$vQuery = "Select distinct cod_esp from $tCurmat where per_aca = '{$sUsercoo['per_aca']}' and pln_est = '$pPln_est'";
		$vQuery = "Select distinct cod_esp from $tCurmat left join unapnet.curso on ";
		$vQuery .= "$tCurmat.cod_car = curso.cod_car and $tCurmat.pln_est = curso.pln_est and ";
		$vQuery .= "$tCurmat.cod_cur = curso.cod_cur ";
		$vQuery .= "where $tCurmat.pln_est = '$pPln_est'";
		
		$cCurmat = fQuery($vQuery);
		while($aCurmat = $cCurmat->fetch_array())
		{
			$vReturn .= "<option value='{$aCurmat['cod_esp']}'";
			if ($aCurmat['cod_esp'] == $pCod_esp) $vReturn .= " Selected";
			$vReturn .= " >{$sEspecial[$pPln_est.$aCurmat['cod_esp']]['esp_nom']}</option> \n";
		}
		return $vReturn;
	}
	function fviewespecial2($pPln_est, $pCod_esp)
	{
		global $sEspecial;

		foreach($sEspecial as $vCod_esp => $vEspecial)
		{
			if($vEspecial['pln_est'] == $pPln_est)
			{
				$vReturn .= "<option value='{$vEspecial['cod_esp']}'";
				if ($vEspecial['cod_esp'] == $pCod_esp) $vReturn .= " Selected";
				$vReturn .= " >{$vEspecial['cod_esp']}-".ucwords(strtolower($vEspecial['esp_nom']))."</option> \n";
			}
		}
		return $vReturn;
	}
	function fviewgrupo($pSec_gru)
	{
		global $sGrupo;

		foreach($sGrupo as $vSec_gru => $vSec_des)
		{
			$vReturn .= "<option value='$vSec_gru'";
			if ($vSec_gru == $pSec_gru) $vReturn .= " Selected";
			$vReturn .= " >$vSec_des</option> \n";
		}
		return $vReturn;
	}
	function fviewgrupohabi($pAno_aca, $pPer_aca, $pCod_car, $pPln_est, $pCod_cur, $pSec_gru)
	{
		$vReturn = "";
		$tHabicurso = "unapnet.habicurso".$pAno_aca;
		$tCurmat = "unapnet.curmat".$pCod_car.$pAno_aca;

		$vQuery = "select ha.sec_gru, gr.sec_des, if(isnull(cc.canti), ha.can_vac, ha.can_vac - cc.canti) as vaca ";
		$vQuery .= "from $tHabicurso ha left join ";
		$vQuery .= "(  select pln_est, cod_cur, sec_gru, count(*) as canti ";
		$vQuery .= "   from $tCurmat ";
		$vQuery .= "   where ano_aca = '$pAno_aca' and per_aca = '$pPer_aca' and pln_est = '$pPln_est' and ";
		$vQuery .= "         cod_cur = '$pCod_cur' group by pln_est, cod_cur, sec_gru ) cc ";
		$vQuery .= "on ha.pln_est = cc.pln_est and ha.cod_cur = cc.cod_cur and ha.sec_gru = cc.sec_gru ";
		$vQuery .= "left join unapnet.grupo gr on ha.sec_gru = gr.sec_gru ";		
		$vQuery .= "where ha.per_aca = '$pPer_aca' and ha.cod_car = '$pCod_car' and ha.pln_est = '$pPln_est' and ";
		$vQuery .= "ha.cod_cur = '$pCod_cur' and (ha.can_vac > cc.canti or isnull(cc.canti)) ";
		
		$cResult = fQuery($vQuery);
		while($aResult = $cResult->fetch_array())
		{
			$vReturn .= "<option value='{$aResult['sec_gru']}' ".($aResult['sec_gru'] == $pSec_gru?" Selected ":"");
			$vReturn .= " >".$aResult['sec_des']."-".$aResult['vaca']."</option> \n";
		}
		return $vReturn;
	}	
	function fviewgrupocur($pSec_gru)
	{
		global $sGrupo;

		foreach($sGrupo as $vSec_gru => $vSec_des)
		{
			$vReturn .= "<option value='$vSec_gru'";
			if ($vSec_gru == $pSec_gru) $vReturn .= " Selected";
			$vReturn .= " >".ucwords(strtolower($vSec_des))."</option> \n";
		}
		return $vReturn;
	}
	function fviewgruposel($pSec_gru)
	{
		global $sGrupo;

		$vReturn = "<option value=''>Seleccione ...</option>\n";
		foreach($sGrupo as $vSec_gru => $vSec_des)
		{
			$vReturn .= "<option value='$vSec_gru'";
			if ($vSec_gru == $pSec_gru) $vReturn .= " Selected";
			$vReturn .= " >$vSec_des</option> \n";
		}
		return $vReturn;
	}
	function fviewgruporep($pSec_gru, $pPln_est, $pCod_cur)
	{
		global $sGrupo , $sUsercoo;
		$vReturn = "<option value=''>Seleccione ...</option>\n";
		$vReturn .= "<option value='99'";
		if ($pSec_gru == '99')
			$vReturn .= " Selected ";
		$vReturn .= ">TODOS</option>\n";
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vQuery = "Select distinct sec_gru from $tCurmat where pln_est = '$pPln_est' and cod_cur = '$pCod_cur' and per_aca = '{$sUsercoo['per_aca']}'";
		$cGrupo = fQuery($vQuery);
		while($aGrupo = $cGrupo->fetch_array())
		{
			$vReturn .= "<option value='{$aGrupo['sec_gru']}'";
			if ($aGrupo['sec_gru'] == $pSec_gru) $vReturn .= " Selected";
			$vReturn .= " >{$sGrupo[$aGrupo['sec_gru']]}</option> \n";
		}
		return $vReturn;
	}
	function fviewgruporepniv($pSec_gru, $pPln_est, $pCod_esp)
	{
		global $sGrupo , $sUsercoo;
		$vReturn = "<option value=''>Seleccione ...</option>\n";
		$vReturn .= "<option value='99'";
		if ($pSec_gru == '99')
			$vReturn .= " Selected ";
		$vReturn .= ">TODOS</option>\n";
		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vQuery = "Select distinct sec_gru from $tEstumat where pln_est = '$pPln_est' and per_aca = '{$sUsercoo['per_aca']}' ";
		if(!($pCod_esp == '99'))
			$vQuery .= " and cod_esp = '$pCod_esp' ";
		$cGrupo = fQuery($vQuery);
		while($aGrupo = $cGrupo->fetch_array())
		{
			$vReturn .= "<option value='{$aGrupo['sec_gru']}'";
			if ($aGrupo['sec_gru'] == $pSec_gru) $vReturn .= " Selected";
			$vReturn .= " >{$sGrupo[$aGrupo['sec_gru']]}</option> \n";
		}
		return $vReturn;
	}
	function fviewgrupoing($pSec_gru, $pPln_est, $pCod_cur)
	{
		global $sGrupo , $sUsercoo;
		$vReturn = "<option value=''>Seleccione ...</option>\n";
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vQuery = "Select distinct sec_gru from $tCurmat where pln_est = '$pPln_est' and cod_cur = '$pCod_cur' and per_aca = '{$sUsercoo['per_aca']}'";
		$cGrupo = fQuery($vQuery);
		while($aGrupo = $cGrupo->fetch_array())
		{
			$vReturn .= "<option value='{$aGrupo['sec_gru']}'";
			if ($aGrupo['sec_gru'] == $pSec_gru) $vReturn .= " Selected";
			$vReturn .= " >{$sGrupo[$aGrupo['sec_gru']]}</option> \n";
		}
		return $vReturn;
	}
	function fviewmodmatrep($pMod_mat, $pPln_est, $pCod_esp, $pSec_gru)
	{
		global $sModmat , $sUsercoo;
		$vReturn = "<option value=''>Seleccione ...</option>\n";
		$vReturn .= "<option value='99'";
		if ($pMod_mat == '99')
			$vReturn .= " Selected ";
		$vReturn .= ">TODOS</option>\n";
		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vQuery = "Select distinct mod_mat from $tEstumat where pln_est = '$pPln_est' and per_aca = '{$sUsercoo['per_aca']}' ";
		if(!($pCod_esp == '99'))
			$vQuery .= " and cod_esp = '$pCod_esp' ";
		if(!($pSec_gru == '99'))
			$vQuery .= " and sec_gru = '$pSec_gru' ";
		$cModmat = fQuery($vQuery);
		while($aModmat = $cModmat->fetch_array())
		{
			$vReturn .= "<option value='{$aModmat['mod_mat']}'";
			if ($aModmat['mod_mat'] == $pMod_mat) $vReturn .= " Selected";
			$vReturn .= " >{$sModmat[$aModmat['mod_mat']]['mod_des']}</option> \n";
		}
		return $vReturn;
	}
	function fviewmodmatcarga($pMod_mat)
	{
		$aModmat['99'] = "REG-OBS-CUARTA MAT.";
		$aModmat['01'] = "REGULAR";
		$aModmat['07'] = "OBSERVADO";
		$aModmat['08'] = "CUARTA MAT.";
		$aModmat['05'] = "ESPECIAL";
		$aModmat['09'] = "VACACIONAL";
		$aModmat['10'] = "EXTRAORDINARIO";
		$aModmat['12'] = "REEVALUACION";
		$aModmat['16'] = "DIRIGIDO";
		
		$vReturn = "<option value=''>Seleccione ...</option>\n";
		
		foreach($aModmat as $vMod_mat => $vMod_des)
		{
			$vReturn .= "<option value='$vMod_mat'";
			if ($vMod_mat == $pMod_mat) $vReturn .= " Selected";
				$vReturn .= " >$vMod_des</option> \n";
		}
		return $vReturn;
	}
	function fviewmodmatest($pMod_mat)
	{
		$aModmat['01'] = "REGULAR";
		$aModmat['02'] = "REPITENTE";
		$aModmat['05'] = "ESPECIAL";
		$aModmat['09'] = "VACACIONAL";
		$aModmat['10'] = "EXTRAORDINARIO";
		
		foreach($aModmat as $vMod_mat => $vMod_des)
		{
			$vReturn .= "<option value='$vMod_mat'";
			if ($vMod_mat == $pMod_mat) $vReturn .= " Selected";
				$vReturn .= " >$vMod_des</option> \n";
		}
		return $vReturn;
	}
	function fviewmodmatcur($pMod_mat)
	{
		$aModmat['01'] = "REGULAR";
		$aModmat['02'] = "REPITENTE";
		$aModmat['03'] = "DE CARGO";
		$aModmat['04'] = "NIVELACION";
		$aModmat['05'] = "ESPECIAL";
		$aModmat['09'] = "VACACIONAL";
		$aModmat['10'] = "EXTRAORDINARIO";
		
		foreach($aModmat as $vMod_mat => $vMod_des)
		{
			$vReturn .= "<option value='$vMod_mat'";
			if ($vMod_mat == $pMod_mat) $vReturn .= " Selected";
				$vReturn .= " >".ucwords(strtolower($vMod_des))."</option> \n";
		}
		return $vReturn;
	}
	function fviewmodnoting($pSec_gru, $pPln_est, $pCod_cur, $pMod_not)
	{
		global $sModnot, $sUsercoo;
		$aModnot = '';
		$vReturn = "<option value=''>Seleccione ...</option>\n";
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vQuery = "Select distinct mod_not ";
		$vQuery .= "from $tCurmat left join unapnet.modmat on $tCurmat.mod_mat = modmat.mod_mat ";
		$vQuery .= "where pln_est = '$pPln_est' and cod_cur = '$pCod_cur' and ";
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and sec_gru = '$pSec_gru' order by mod_not";
		$cCurmat = fQuery($vQuery);
		while($aCurmat = $cCurmat->fetch_array())
		{
			$vReturn .= "<option value='{$aCurmat['mod_not']}'";
			if ($aCurmat['mod_not'] == $pMod_not) $vReturn .= " Selected";
			$vReturn .= " >{$sModnot[$aCurmat['mod_not']]}</option> \n";
		}
		return $vReturn;
	}
	function fviewturno($pTur_est)
	{
		global $sTurno;

		foreach($sTurno as $vTur_est => $vTur_des)
		{
			$vReturn .= "<option value='$vTur_est'";
			if ($vTur_est == $pTur_est) $vReturn .= " Selected";
			$vReturn .= " >$vTur_des</option> \n";
		}
		return $vReturn;
	}
	function fviewtipcur($pTip_cur)
	{
		global $sTipcur;

		foreach($sTipcur as $vTip_cur => $vCur_des)
		{
			$vReturn .= "<option value='$vTip_cur'";
			if ($vTip_cur == $pTip_cur) $vReturn .= " Selected";
			$vReturn .= " >".ucwords(strtolower($vCur_des))."</option> \n";
		}
		return $vReturn;
	}
	function fviewtippre($pTip_pre)
	{
		global $sTippre;

		foreach($sTippre as $vTip_pre => $vPre_des)
		{
			$vReturn .= "<option value='$vTip_pre'";
			if ($vTip_pre == $pTip_pre) $vReturn .= " Selected";
			$vReturn .= " >".ucwords(strtolower($vPre_des))."</option> \n";
		}
		return $vReturn;
	}
	function fviewsemhora($pPln_est, $pSem_anu)
	{
		global $sSemestre, $sUsercoo;
		$vReturn = "<option value=''>Seleccione ...</option>\n";
		$vQuery = "Select distinct sem_anu from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '$pPln_est'";
		$cPln_est = fQuery($vQuery);
		while($aPln_est = $cPln_est->fetch_array())
		{
			$vReturn .= "<option value='{$aPln_est['sem_anu']}'";
			if ($aPln_est['sem_anu'] == $pSem_anu) $vReturn .= " Selected";
			$vReturn .= " >{$sSemestre[$aPln_est['sem_anu']]}</option> \n";
		}
		return $vReturn;
	}
	function fviewsemestreing($pPln_est, $pCod_esp, $pSem_anu)
	{
		global $sSemestre, $sUsercoo;
		$vReturn = "<option value=''>Seleccione ...</option>\n";
		
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vQuery = "Select distinct sem_anu from $tCurmat left join unapnet.curso on ";
		$vQuery .= "$tCurmat.cod_car = curso.cod_car and $tCurmat.pln_est = curso.pln_est and ";
		$vQuery .= "$tCurmat.cod_cur = curso.cod_cur ";
		$vQuery .= "where $tCurmat.pln_est = '$pPln_est' and curso.cod_esp = '$pCod_esp' ";
		$vQuery .= "order by sem_anu";
		
		$cCurmat = fQuery($vQuery);
		while($aCurmat = $cCurmat->fetch_array())
		{
			$vReturn .= "<option value='{$aCurmat['sem_anu']}'";
			if ($aCurmat['sem_anu'] == $pSem_anu) $vReturn .= " Selected";
			$vReturn .= " >{$sSemestre[$aCurmat['sem_anu']]}</option> \n";
		}
		return $vReturn;
	}
	function fviewcurso($pPln_est, $pCod_cur)
	{
		global $sUsercoo;
		$vQuery = "Select nom_cur from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '$pPln_est' and ";
		$vQuery .= "cod_cur = '$pCod_cur' ";
		$cCurso = fQuery($vQuery);
		if($aCurso = $cCurso->fetch_array())
			$vReturn = $aCurso['nom_cur'];
		return $vReturn;
	}
	function fviewcursohora($pPln_est, $pSem_anu, $pCod_cur, $pCod_esp)
	{
		global $sUsercoo;
		$vReturn = "<option value=''>Seleccione ...</option>\n";
		$vQuery = "Select cod_cur, nom_cur from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '$pPln_est' and ";
		$vQuery .= "sem_anu = '$pSem_anu' and cod_esp = '$pCod_esp'";
		$cCurso = fQuery($vQuery);
		while($aCurso = $cCurso->fetch_array())
		{
			$vReturn .= "<option value='{$aCurso['cod_cur']}'";
			if ($aCurso['cod_cur'] == $pCod_cur) $vReturn .= " Selected";
			$vReturn .= " >{$aCurso['nom_cur']}</option> \n";
		}
		return $vReturn;
	}
	function fviewcursorep($pPln_est, $pCod_cur, $pCod_esp)
	{
		global $sUsercoo;
		$vReturn = "<option value=''>Seleccione ...</option>\n";
		$vQuery = "Select cod_cur, nom_cur from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '$pPln_est' and ";
		$vQuery .= "cod_esp = '$pCod_esp'";
		$cCurso = fQuery($vQuery);
		while($aCurso = $cCurso->fetch_array())
		{
			$vReturn .= "<option value='{$aCurso['cod_cur']}'";
			if ($aCurso['cod_cur'] == $pCod_cur) $vReturn .= " Selected";
			$vReturn .= " >{$aCurso['nom_cur']}</option> \n";
		}
		return $vReturn;
	}
	function fviewcursoing($pPln_est, $pCod_esp, $pSem_anu, $pCod_cur)
	{
		global $sSemestre, $sUsercoo;
		$vReturn = "<option value=''>Seleccione ...</option>\n";
		
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vQuery = "Select distinct curso.cod_cur, nom_cur from $tCurmat left join unapnet.curso on ";
		$vQuery .= "$tCurmat.cod_car = curso.cod_car and $tCurmat.pln_est = curso.pln_est and ";
		$vQuery .= "$tCurmat.cod_cur = curso.cod_cur ";
		$vQuery .= "where $tCurmat.pln_est = '$pPln_est' and curso.cod_esp = '$pCod_esp' and curso.sem_anu = '$pSem_anu' ";
		$vQuery .= "order by cod_cur";
		
		$cCurmat = fQuery($vQuery);
		while($aCurmat = $cCurmat->fetch_array())
		{
			$vReturn .= "<option value='{$aCurmat['cod_cur']}'";
			if ($aCurmat['cod_cur'] == $pCod_cur) $vReturn .= " Selected";
			$vReturn .= " >{$aCurmat['nom_cur']}</option> \n";
		}
		return $vReturn;
	}
	
	function fviewnivel($pNiv_est)
	{
		global $sNivel;

		$vReturn .= "<option value=''";
		if (empty($pNiv_est)) $vReturn .= " Selected";
		$vReturn .= " >Sin Nivel</option> \n";
		
		foreach($sNivel as $vNiv_est => $vNiv_des)
		{
			$vReturn .= "<option value='$vNiv_est'";
			if ($vNiv_est == $pNiv_est) $vReturn .= " Selected";
			$vReturn .= " >".ucwords(strtolower($vNiv_des))."</option> \n";
		}
		return $vReturn;
	}
	function fviewnivelmat($pNiv_est, $pMax_niv)
	{
		global $sNivel;

		foreach($sNivel as $vNiv_est => $vNiv_des)
		{
			if($vNiv_est <= $pMax_niv)
			{
				$vReturn .= "<option value='$vNiv_est'";
				if ($vNiv_est == $pNiv_est) $vReturn .= " Selected";
				$vReturn .= " >".$vNiv_des."</option> \n";
			}
		}
		return $vReturn;
	}
	function fviewsemestre($pSem_anu)
	{
		global $sSemestre;

		$vReturn .= "<option value=''";
		if (empty($pSem_anu)) $vReturn .= " Selected";
		$vReturn .= " >Sin Semestre</option> \n";
		
		foreach($sSemestre as $vSem_anu => $vSem_des)
		{
			$vReturn .= "<option value='$vSem_anu'";
			if ($vSem_anu == $pSem_anu) $vReturn .= " Selected";
			$vReturn .= " >".ucwords(strtolower($vSem_des))."</option> \n";
		}
		return $vReturn;
	}
	
	function fMaxcrding($pPln_est)
	{
		global $sCredisem;
		return $sCredisem[$pPln_est."01"]['crd_sem'];
	}
	
	function fModcurso ($pVeces)
	{
		global $sEstudia;
//		if($sEstudia['mod_mat'] == '07')
	//		return '07';		
		switch ($pVeces)			
		{
			case 0: 
			case 1: return '01';
			case 2: return '18';
			case 3: return '08';
			case 4: return '11';
			case 5: return '13';
			case 6: return '14';
			case 7: return '15';
			case 8: return '20';
			case 9: return '21';
			case 10: return '22';
			case 11: return '23';
			case 12: return '24';
			case 13: return '25';
			case 14: return '26';
			case 15: return '27';
			case 16: return '28';
			case 17: return '29';
			case 18: return '30';
			case 19: return '31';
		}
/*		//anho 2005
		switch ($pVeces)			
		{
			case 0: 
			case 1: return '01';
			case 2: return '07';
			case 3: return '08';
			case 4: return '11';
			case 5: return '13';
			case 6: return '14';
			case 7: 
			case 8: 
			case 9: return '15';
		}
	*/
	}
	function fModestudia ($pVeces, $pPromedio, $pCrdapro, $pCrddes)
	{
		global $sEstudia, $sUsercoo, $sCredicar;
		
		switch ($pVeces)			
		{
			case 0: 
			case 1: $sEstudia['mod_mat'] = '01';	break;
			case 2: $sEstudia['mod_mat'] = '18';	break;
			case 3: $sEstudia['mod_mat'] = '08';	break;
			case 4: $sEstudia['mod_mat'] = '11';	break;
			case 5: $sEstudia['mod_mat'] = '13';	break;
			case 6: $sEstudia['mod_mat'] = '14';	break;
			case 7: $sEstudia['mod_mat'] = '15';	break;
			case 8: $sEstudia['mod_mat'] = '20';	break;
			case 9: $sEstudia['mod_mat'] = '21';	break;
			case 10: $sEstudia['mod_mat'] = '22';	break;
			case 11: $sEstudia['mod_mat'] = '23';	break;
			case 12: $sEstudia['mod_mat'] = '24';	break;
			case 13: $sEstudia['mod_mat'] = '25';	break;
			case 14: $sEstudia['mod_mat'] = '26';	break;
			case 15: $sEstudia['mod_mat'] = '27';	break;
			case 16: $sEstudia['mod_mat'] = '28';	break;
			case 17: $sEstudia['mod_mat'] = '29';	break;
			case 18: $sEstudia['mod_mat'] = '30';	break;
			case 19: $sEstudia['mod_mat'] = '31';	break;			
		}
		switch ($pVeces)			
		{
			case 0: case 1:
				if($pCrdapro > $sCredicar[$sEstudia['pln_est']]['crd_min'])
				{	$sEstudia['max_crd'] = $sCredicar[$sEstudia['pln_est']]['crd_max'];
					if($pPromedio >= $sCredicar[$sEstudia['pln_est']]['prd_mn1'] and 
						$pPromedio <= $sCredicar[$sEstudia['pln_est']]['prd_mx1'])	
						$sEstudia['max_crd'] = $sCredicar[$sEstudia['pln_est']]['crd_p1'];
					if($pPromedio > $sCredicar[$sEstudia['pln_est']]['prd_mn2'])		
						$sEstudia['max_crd'] = $sCredicar[$sEstudia['pln_est']]['crd_p2'];							
				}
				else
				{	$sEstudia['max_crd'] = $sCredicar[$sEstudia['pln_est']]['crd_max']; 	}
				break;
			case 2: case 3: case 4: case 5: case 6: case 7: case 8: case 9: case 10: case 11: case 12: case 13: case 14: case 15: case 16: case 17: case 18: case 19:
				if($pCrddes > $sCredicar[$sEstudia['pln_est']]['crd_des'])
				{	//$sEstudia['max_crd'] = $pCrddes;	
					$sEstudia['max_crd'] = 18;
				}
				else
				{	$sEstudia['max_crd'] = $sCredicar[$sEstudia['pln_est']]['crd_max'];	}
				break;
			 	
		}			
	
		
/*		switch ($sUsercoo['cod_car'])
		{
			case '16': case '17':
				switch ($pVeces)			
				{
					case 0: case 1:
						if($pCrdapro > 16)
						{	$sEstudia['max_crd'] = 28;
							if($pPromedio > 13)		$sEstudia['max_crd'] = 32;
							if($pPromedio >= 12 and $pPromedio <= 13)	$sEstudia['max_crd'] = 30;		}
						else
						{	$sEstudia['max_crd'] = 28; 	}
						break;
					case 2: 
						if($pCrddes > 14)
						{	$sEstudia['max_crd'] = $pCrddes;	}
						else
						{	$sEstudia['max_crd'] = 28;	}
						break;
					case 3: case 4: case 5: case 6: case 7: case 8: case 9:
					case 10: $sEstudia['max_crd'] = 16;	break;					
				}			
				break;
			case '18':
				switch ($pVeces)			
				{
					case 0: case 1:
						if($pCrdapro > 16)
						{	$sEstudia['max_crd'] = 25;
							if($pPromedio > 13)		$sEstudia['max_crd'] = 29;
							if($pPromedio >= 12 and $pPromedio <= 13)	$sEstudia['max_crd'] = 27;		}
						else
						{	$sEstudia['max_crd'] = 25; 	}
						break;
					case 2: 
						if($pCrddes > 12)
						{	$sEstudia['max_crd'] = $pCrddes;	}
						else
						{	$sEstudia['max_crd'] = 25;	}
						break;
					case 3: case 4: case 5: case 6: case 7: case 8: case 9:
					case 10: $sEstudia['max_crd'] = 16;	break;					
				}
				break;
			case '20': case '21':
				switch ($pVeces)			
				{
					case 0: case 1:
						if($pCrdapro > 16)
						{	$sEstudia['max_crd'] = 26;
							if($pPromedio > 13)		$sEstudia['max_crd'] = 30;
							if($pPromedio >= 12 and $pPromedio <= 13)	$sEstudia['max_crd'] = 28;		}
						else
						{	$sEstudia['max_crd'] = 26; 	}
						break;
					case 2: 
						if($pCrddes > 13)
						{	$sEstudia['max_crd'] = $pCrddes;	}
						else
						{	$sEstudia['max_crd'] = 26;	}
						break;
					case 3: case 4: case 5: case 6: case 7: case 8: case 9:
					case 10: $sEstudia['max_crd'] = 16;	break;	
				}
				break;
			case '27':
				switch ($pVeces)			
				{
					case 0: case 1:
						if($pCrdapro > 16)
						{	$sEstudia['max_crd'] = 24;
							if($pPromedio > 13)		$sEstudia['max_crd'] = 28;
							if($pPromedio >= 12 and $pPromedio <= 13)	$sEstudia['max_crd'] = 26;		}
						else
						{	$sEstudia['max_crd'] = 24; 	}
						break;
					case 2: 
						if($pCrddes > 12)
						{	$sEstudia['max_crd'] = $pCrddes;	}
						else
						{	$sEstudia['max_crd'] = 24;	}
						break;
					case 3: case 4: case 5: case 6: case 7: case 8: case 9:
					case 10: $sEstudia['max_crd'] = 17;	break;
				}			
				break;
			default:
				switch ($pVeces)			
				{
					case 0: case 1:
						if($pCrdapro > 16)
						{	$sEstudia['max_crd'] = 24;
							if($pPromedio > 13)		$sEstudia['max_crd'] = 28;
							if($pPromedio >= 12 and $pPromedio <= 13)	$sEstudia['max_crd'] = 26;		}
						else
						{	$sEstudia['max_crd'] = 24; 	}
						break;
					case 2: 
						if($pCrddes > 12)
						{	$sEstudia['max_crd'] = $pCrddes;	}
						else
						{	$sEstudia['max_crd'] = 24;	}
						break;
					case 3: case 4: case 5: case 6: case 7: case 8: case 9:
					case 10: $sEstudia['max_crd'] = 16;	break;
				}			
				break;
		}*/
		
		
		
/*		anho 2005 con anmistias
		switch ($pVeces)			
		{
			case 0: 
			case 1: $sEstudia['mod_mat'] = '01';	break;
			case 2: $sEstudia['mod_mat'] = '07';	break;
			case 3: $sEstudia['mod_mat'] = '08';	break;
			case 4: $sEstudia['mod_mat'] = '11';	break;
			case 5: $sEstudia['mod_mat'] = '13';	break;
			case 6: $sEstudia['mod_mat'] = '14';	break;
			case 7: 
			case 8:
			case 9: $sEstudia['mod_mat'] = '15';	break;
		}
		switch ($sUsercoo['cod_car'])
		{
			case '16': case '17':
				switch ($pVeces)			
				{
					case 0: case 1:
						if($pCrdapro > 16)
						{	$sEstudia['max_crd'] = 28;
							if($pPromedio > 13)		$sEstudia['max_crd'] = 32;
							if($pPromedio > 12 and $pPromedio <= 13)	$sEstudia['max_crd'] = 30;		}
						else
						{	$sEstudia['max_crd'] = 28; 	}
						break;
					case 2: $sEstudia['max_crd'] = 24;	break;
					case 3: case 4: case 5: case 6: case 7: case 8:
					case 9: $sEstudia['max_crd'] = 16;	break;
				}			
				break;
			case '18':
				switch ($pVeces)			
				{
					case 0: case 1:
						if($pCrdapro > 16)
						{	$sEstudia['max_crd'] = 25;
							if($pPromedio > 13)		$sEstudia['max_crd'] = 29;
							if($pPromedio > 12 and $pPromedio <= 13)	$sEstudia['max_crd'] = 27;		}
						else
						{	$sEstudia['max_crd'] = 25; 	}
						break;
					case 2: $sEstudia['max_crd'] = 24;	break;
					case 3: case 4: case 5: case 6: case 7: case 8:
					case 9: $sEstudia['max_crd'] = 16;	break;
				}
				break;
			case '20': case '21':
				switch ($pVeces)			
				{
					case 0: case 1:
						if($pCrdapro > 16)
						{	$sEstudia['max_crd'] = 26;
							if($pPromedio > 13)		$sEstudia['max_crd'] = 30;
							if($pPromedio > 12 and $pPromedio <= 13)	$sEstudia['max_crd'] = 28;		}
						else
						{	$sEstudia['max_crd'] = 26; 	}
						break;
					case 2: $sEstudia['max_crd'] = 24;	break;
					case 3: case 4: case 5: case 6: case 7: case 8:
					case 9: $sEstudia['max_crd'] = 16;	break;
				}
				break;
			default:
				switch ($pVeces)			
				{
					case 0: case 1:
						if($pCrdapro > 16)
						{	$sEstudia['max_crd'] = 24;
							if($pPromedio > 13)		$sEstudia['max_crd'] = 28;
							if($pPromedio > 12 and $pPromedio <= 13)	$sEstudia['max_crd'] = 26;		}
						else
						{	$sEstudia['max_crd'] = 24; 	}
						break;
					case 2: $sEstudia['max_crd'] = 24;	break;
					case 3: case 4: case 5: case 6: case 7: case 8:
					case 9: $sEstudia['max_crd'] = 16;	break;
				}			
				break;
		}
		
*/
		
		
		
/*		//El primer trabajo
		switch ($pVeces)			
		{
			case 0: 
				if($pCrdapro > 16)
				{					
					$sEstudia['max_crd'] = 24;
					if($pPromedio > 13)
						$sEstudia['max_crd'] = 28;
					if($pPromedio > 12 and $pPromedio <= 13)
						$sEstudia['max_crd'] = 26;		
				}
				else
				{	
					$sEstudia['max_crd'] = 24;
				}
				break;
			case 1: $sEstudia['max_crd'] = 24;	break;
			case 2: $sEstudia['max_crd'] = 24;	break;
			case 3: 
			case 4: 
			case 5:
			case 6:
			case 7:
			case 8:
			case 9: $sEstudia['max_crd'] = 16;	break;
		}			*/
	}
	function fSemestudia ($pPln_est, $pAll_crd)
	{
		global $sCredisem;
		foreach($sCredisem as $vPln_sem => $aCredisem)
		{
			if($pPln_est == $aCredisem['pln_est'])
			{
				if($pAll_crd >= $aCredisem['crd_ini'] and $pAll_crd <= $aCredisem['crd_fin'])
					return $aCredisem['sem_anu'];
			}
		}
		
	}
	function fModestudiarig($pCurdes3)
	{
		global $sEstudia, $sUsercoo;
		
		if($pCurdes3 > 4)
		{
			$sEstudia['mod_mat'] = '02';
			$sEstudia['niv_est'] = $sEstudia['niv_est2'];
		}
		else
		{
			if($sEstudia['niv_est2'] == $sEstudia['max_niv'])
			{
				$sEstudia['mod_mat'] = '05';
				$sEstudia['niv_est'] = $sEstudia['niv_est2'];
			}
			else
			{
				$sEstudia['mod_mat'] = '01';
				switch ($pVeces)			
				{
					case '01': $sEstudia['niv_est'] = '02';	break;
					case '02': $sEstudia['niv_est'] = '03';	break;
					case '03': $sEstudia['niv_est'] = '04';	break;
					case '04': $sEstudia['niv_est'] = '05';	break;
					case '05': $sEstudia['niv_est'] = '06';	break;
					case '06': $sEstudia['niv_est'] = '07';	break;
				}
			}
		}

	}
	function fFecha()
	{
		$vFecha = getdate(time());
//		return "{$vFecha['year']}-{$vFecha['mon']}-{$vFecha['mday']} {$vFecha['hours']}:{$vFecha['minutes']}:{$vFecha['seconds']}";
		$vQuery = "Select now() as fch_mat";
		$cFecha = fQuery($vQuery);
		if($aFecha = $cFecha->fetch_array() )
			return $aFecha['fch_mat'];
	}
	function fFechastd($pFecha)
	{
		$vFecha = $pFecha;
		$vAmpm = "";
		$vReturn = substr($vFecha, 8, 2)."/".substr($vFecha, 5, 2)."/".substr($vFecha, 0, 4)." ";
		if(substr($vFecha, 11, 2) == '00')
		{
			$vHora = '12';	$vAmpm = 'AM';
		}
		if(substr($vFecha, 11, 2) >= '01' and substr($vFecha, 11, 2) <= '11')
		{
			$vHora = substr($vFecha, 11, 2);	$vAmpm = 'AM';
		}
		if(substr($vFecha, 11, 2) == '12')
		{
			$vHora = substr($vFecha, 11, 2);	$vAmpm = 'PM';
		}
		if(substr($vFecha, 11, 2) >= '13' and substr($vFecha, 11, 2) <= '23')
		{
			$vHora = substr($vFecha, 11, 2) - 12;
			$vHora = ((strlen((string)$vHora) == 1)?'0':'').(string)$vHora;
			$vAmpm = 'PM';
		}
		
		$vReturn .= $vHora.":".substr($vFecha, 14, 2).":".substr($vFecha, 17, 2)." ".$vAmpm;
		return $vReturn;
	}
	
	function fFechad($pFecha)
	{
		$vFecha = $pFecha;
		$vReturn = substr($vFecha, 8, 2)."/".substr($vFecha, 5, 2)."/".substr($vFecha, 0, 4);
		return $vReturn;
	}
	function fFechamy($pFecha)
	{
		$vFecha = $pFecha;
		$vReturn = substr($vFecha, 6, 4)."-".substr($vFecha, 3, 2)."-".substr($vFecha, 0, 2);
		return $vReturn;
	}
	
	function fviewubigeo($pCod_nac, $pCod_dep, $pCod_prv, $pCod_dis)
	{
		global $sNacional;
		$vReturn = "{$sNacional[$pCod_nac]} ";
		$vQuery = "Select dep_nom from unapnet.departam where cod_dep = '$pCod_dep' ";
		$cDepartam = fQuery($vQuery);
		if($aDepartam = $cDepartam->fetch_array() )
			$vReturn .= "- {$aDepartam['dep_nom']} ";
		$cDepartam->close();
			
		$vQuery = "Select prv_nom from unapnet.provinc where cod_prv = '$pCod_prv' and cod_dep = '$pCod_dep'";
		$cProvinc = fQuery($vQuery);
		if($aProvinc = $cProvinc->fetch_array() )
			$vReturn .= "- {$aProvinc['prv_nom']}";
		$cProvinc->close();
		
		$vQuery = "Select dis_nom from unapnet.distrito where cod_dis = '$pCod_dis' and cod_dep = '$pCod_dep' and cod_prv = '$pCod_prv' ";
		$cDistrito = fQuery($vQuery);
		if($aDistrito = $cDistrito->fetch_array() )
			$vReturn .= "- {$aDistrito['dis_nom']}";
		$cDistrito->close();
		return  $vReturn;
	}
	

?>
