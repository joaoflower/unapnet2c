<?php
	session_start();
	include "include/function.php";
	include "include/funcsql.php";	

	if (fsafetylogin())
	{
		$sUsercoo['cod_car'] = $_POST['rCod_car'];
		$sUsercoo['ano_aca'] = $_POST['rAno_aca'];
		$sUsercoo['per_aca'] = $_POST['rPer_aca'];
		
		if(fverifyselcar())
		{
			$sAreaca = "";
			$sCodhora = "";
			$sCondestu = "";
			$sEspecial = "";
			$sEstcivil = "";
			$sFacultad = "";
			$sGrupo = "";
			$sModing = "";
			$sModingn = "";
			$sModmat = "";
			$sModnot = "";
			$sNacional = "";
			$sNivel = "";
			$sNivusu = "";
			$sPlan = "";
			$sSemestre = "";
			$sTipcur = "";
			$sTipodoc = "";
			$sTipomat = "";
			$sTiposist = "";
			$sTippre = "";
			$sTurno = "";
			$sCredisem = "";
			$sCredicar = "";
			
			$sExocar = "";
			$sExoestu = "";
			$sApemat = "";
			$sRatmat = "";
			
			$sGradocar = "";
			$sCuadropro = "";
			
			//-------------------------------------------------------------------------
			$vQuery = "Select cod_are, are_des from unapnet.areaca where cod_are <> ''";
			$cAreaca = fQuery($vQuery);
			while($aAreaca = $cAreaca->fetch_array())
				$sAreaca[$aAreaca['cod_are']] = $aAreaca['are_des'];
			$cAreaca->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select cod_hor, hrs_ini, hrs_fin, tur_est from unapnet.codhora where cod_hor <> ''";
			$cCodhora = fQuery($vQuery);
			while($aCodhora = $cCodhora->fetch_array())
			{
				$sCodhora[$aCodhora['cod_hor']]['hrs_ini'] = $aCodhora['hrs_ini'];
				$sCodhora[$aCodhora['cod_hor']]['hrs_fin'] = $aCodhora['hrs_fin'];
				$sCodhora[$aCodhora['cod_hor']]['tur_est'] = $aCodhora['tur_est'];
			}
			$cCodhora->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select con_est, con_des from unapnet.condestu where con_est <> ''";
			$cCondestu = fQuery($vQuery);
			while($aCondestu = $cCondestu->fetch_array())
				$sCondestu[$aCondestu['con_est']] = $aCondestu['con_des'];
			$cCondestu->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select cod_esp, pln_est, esp_nom from unapnet.especial where cod_car = '{$sUsercoo['cod_car']}' and cod_esp <> '' order by pln_est, cod_esp";
			$cEspecial = fQuery($vQuery);
			while($aEspecial = $cEspecial->fetch_array())
			{
				$sEspecial[$aEspecial['pln_est'].$aEspecial['cod_esp']]['cod_esp'] = $aEspecial['cod_esp'];
				$sEspecial[$aEspecial['pln_est'].$aEspecial['cod_esp']]['pln_est'] = $aEspecial['pln_est'];
				$sEspecial[$aEspecial['pln_est'].$aEspecial['cod_esp']]['esp_nom'] = $aEspecial['esp_nom'];
			}
			$cEspecial->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select est_civ, est_des from unapnet.estcivil where est_civ <> ''";
			$cEstcivil = fQuery($vQuery);
			while($aEstcivil = $cEstcivil->fetch_array())
				$sEstcivil[$aEstcivil['est_civ']] = $aEstcivil['est_des'];
			$cEstcivil->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select cod_fac from unapnet.carrera where cod_car = '{$sUsercoo['cod_car']}' and cod_fac <> ''";
			$cCarrera = fQuery($vQuery);
			while($aCarrera = $cCarrera->fetch_array())
				$sUsercoo['cod_fac'] = $aCarrera['cod_fac'];
			$cCarrera->close();
			
			if(!empty($sUsercoo['cod_fac']))
			{
				$vQuery = "Select cod_fac, fac_des from unapnet.facultad where cod_fac = '{$sUsercoo['cod_fac']}' and cod_fac <> ''";
				$cFacultad = fQuery($vQuery);
				while($aFacultad = $cFacultad->fetch_array())
					$sFacultad[$aFacultad['cod_fac']] = $aFacultad['fac_des'];
				$cFacultad->close();
			}
			
			//-------------------------------------------------------------------------
			$vQuery = "Select sec_gru, sec_des from unapnet.grupo where sec_gru <> '' and sec_gru < '50'";
			$cGrupo = fQuery($vQuery);
			while($aGrupo = $cGrupo->fetch_array())
				$sGrupo[$aGrupo['sec_gru']] = $aGrupo['sec_des'];
			$cGrupo->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select mod_ing, ing_des from unapnet.moding where mod_ing <> ''";
			$cModing = fQuery($vQuery);
			while($aModing = $cModing->fetch_array())
				$sModing[$aModing['mod_ing']] = $aModing['ing_des'];
			$cModing->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select mod_ing, ing_des from unapnet.modingn where mod_ing <> ''";
			$cModingn = fQuery($vQuery);
			while($aModingn = $cModingn->fetch_array())
				$sModingn[$aModingn['mod_ing']] = $aModingn['ing_des'];
			$cModingn->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select mod_mat, mod_des, mod_not from unapnet.modmat where mod_mat <> ''";
			$cModmat = fQuery($vQuery);
			while($aModmat = $cModmat->fetch_array())
			{
				$sModmat[$aModmat['mod_mat']]['mod_des'] = $aModmat['mod_des'];
				$sModmat[$aModmat['mod_mat']]['mod_not'] = $aModmat['mod_not'];
			}
			$cModmat->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select mod_not, not_des from unapnet.modnot where mod_not <> ''";
			$cModnot = fQuery($vQuery);
			while($aModnot = $cModnot->fetch_array())
				$sModnot[$aModnot['mod_not']] = $aModnot['not_des'];
			$cModnot->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select niv_est, niv_des from unapnet.nivel where niv_est <> ''";
			$cNivel = fQuery($vQuery);
			while($aNivel = $cNivel->fetch_array())
				$sNivel[$aNivel['niv_est']] = $aNivel['niv_des'];
			$cNivel->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select cod_nac, nac_des from unapnet.nacional where not cod_nac = ''";
			$cNacional = fQuery($vQuery);
			while($aNacional = $cNacional->fetch_array())
				$sNacional[$aNacional['cod_nac']] = $aNacional['nac_des'];
			$cNacional->close();

			//-------------------------------------------------------------------------
			$vQuery = "Select niv_usu, niv_des from unapnet.nivusu where niv_usu <> ''";
			$cNivusu = fQuery($vQuery);
			while($aNivusu = $cNivusu->fetch_array())
				$sNivusu[$aNivusu['niv_usu']] = $aNivusu['niv_des'];
			$cNivusu->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select pln_est, tip_sist from unapnet.plan where cod_car = '{$sUsercoo['cod_car']}' and pln_est <> ''";
			$cPlan = fQuery($vQuery);
			while($aPlan = $cPlan->fetch_array())
				$sPlan[$aPlan['pln_est']] = $aPlan['tip_sist'];
			$cPlan->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select sem_anu, sem_des from unapnet.semestre where sem_anu <> ''";
			$cSemestre = fQuery($vQuery);
			while($aSemestre = $cSemestre->fetch_array())
				$sSemestre[$aSemestre['sem_anu']] = $aSemestre['sem_des'];
			$cSemestre->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select tip_cur, cur_des from unapnet.tipcur where tip_cur <> ''";
			$cTipcur = fQuery($vQuery);
			while($aTipcur = $cTipcur->fetch_array())
				$sTipcur[$aTipcur['tip_cur']] = $aTipcur['cur_des'];
			$cTipcur->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select tip_doc, doc_des from unapnet.tipodoc where tip_doc <> ''";
			$cTipodoc = fQuery($vQuery);
			while($aTipodoc = $cTipodoc->fetch_array())
				$sTipodoc[$aTipodoc['tip_doc']] = $aTipodoc['doc_des'];
			$cTipodoc->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select tip_mat, tip_des from unapnet.tipomat where tip_mat <> ''";
			$cTipomat = fQuery($vQuery);
			while($aTipomat = $cTipomat->fetch_array())
				$sTipomat[$aTipomat['tip_mat']] = $aTipomat['tip_des'];
			$cTipomat->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select tip_sist, sis_des from unapnet.tiposist where tip_sist <> ''";
			$cTiposist = fQuery($vQuery);
			while($aTiposist = $cTiposist->fetch_array())
				$sTiposist[$aTiposist['tip_sist']] = $aTiposist['sis_des'];
			$cTiposist->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select tip_pre, pre_des from unapnet.tippre where tip_pre <> ''";
			$cTippre = fQuery($vQuery);
			while($aTippre = $cTippre->fetch_array())
				$sTippre[$aTippre['tip_pre']] = $aTippre['pre_des'];
			$cTippre->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select tip_pre, pre_des from unapnet.tippre where tip_pre <> ''";
			$cTippre = fQuery($vQuery);
			while($aTippre = $cTippre->fetch_array())
				$sTippre[$aTippre['tip_pre']] = $aTippre['pre_des'];
			$cTippre->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select tur_est, tur_des from unapnet.turno where tur_est <> ''";
			$cTurno = fQuery($vQuery);
			while($aTurno = $cTurno->fetch_array())
				$sTurno[$aTurno['tur_est']] = $aTurno['tur_des'];
			$cTurno->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select * from unapnet.credisem where cod_car = '{$sUsercoo['cod_car']}' ";
			$cCredisem = fQuery($vQuery);
			while($aCredisem = $cCredisem->fetch_array())
			{
				$sCredisem[$aCredisem['pln_est'].$aCredisem['sem_anu']]['pln_est'] = $aCredisem['pln_est'];
				$sCredisem[$aCredisem['pln_est'].$aCredisem['sem_anu']]['sem_anu'] = $aCredisem['sem_anu'];
				$sCredisem[$aCredisem['pln_est'].$aCredisem['sem_anu']]['crd_sem'] = $aCredisem['crd_sem'];
				$sCredisem[$aCredisem['pln_est'].$aCredisem['sem_anu']]['crd_ini'] = $aCredisem['crd_ini'];
				$sCredisem[$aCredisem['pln_est'].$aCredisem['sem_anu']]['crd_fin'] = $aCredisem['crd_fin'];
			}
			$cCredisem->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select * from unapnet.credicar where cod_car = '{$sUsercoo['cod_car']}' ";
			$cCredicar = fQuery($vQuery);
			while($aCredicar = $cCredicar->fetch_array())
			{
				$sCredicar[$aCredicar['pln_est']]['crd_max'] = $aCredicar['crd_max'];
				$sCredicar[$aCredicar['pln_est']]['crd_p1'] = $aCredicar['crd_p1'];
				$sCredicar[$aCredicar['pln_est']]['crd_p2'] = $aCredicar['crd_p2'];
				$sCredicar[$aCredicar['pln_est']]['crd_obs'] = $aCredicar['crd_obs'];
				$sCredicar[$aCredicar['pln_est']]['crd_min'] = $aCredicar['crd_min'];
				$sCredicar[$aCredicar['pln_est']]['crd_des'] = $aCredicar['crd_des'];
				$sCredicar[$aCredicar['pln_est']]['prd_2sc'] = $aCredicar['prd_2sc'];
				$sCredicar[$aCredicar['pln_est']]['prd_mn1'] = $aCredicar['prd_mn1'];
				$sCredicar[$aCredicar['pln_est']]['prd_mx1'] = $aCredicar['prd_mx1'];
				$sCredicar[$aCredicar['pln_est']]['prd_mn2'] = $aCredicar['prd_mn2'];
				$sCredicar[$aCredicar['pln_est']]['prd_mx2'] = $aCredicar['prd_mx2'];
			}
			$cCredicar->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select * from unapnet.tarifapago where per_aca = '{$sUsercoo['per_aca']}' and ano_aca = '{$sUsercoo['ano_aca']}' ";
			$cTarifapago = fQuery($vQuery);
			while($aTarifapago = $cTarifapago->fetch_array())
			{
				$sTarifapago[$aTarifapago['cod_pag']]['des_pag'] = $aTarifapago['des_pag'];
				$sTarifapago[$aTarifapago['cod_pag']]['mon_pag'] = $aTarifapago['mon_pag'];
				$sVecesdes[$aTarifapago['vec_dsp']] = $aTarifapago['cod_pag'];
			}
			$cTarifapago->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select cod_car, con_exo from unapnet.exocar where ano_aca = '{$sUsercoo['ano_aca']}' and ";
			$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and cod_car = '{$sUsercoo['cod_car']}'";
			$cExocar = fQuery($vQuery);
			while($aExocar = $cExocar->fetch_array())
				$sExocar[$aExocar['cod_car']] = $aExocar['con_exo'];
			$cExocar->close();
				
			//-------------------------------------------------------------------------
			$vQuery = "Select cod_car, con_ape from unapnet.apemat where ano_aca = '{$sUsercoo['ano_aca']}' and ";
			$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and cod_car = '{$sUsercoo['cod_car']}'";
			$cApemat = fQuery($vQuery);
			while($aApemat = $cApemat->fetch_array())
				$sApemat[$aApemat['cod_car']] = $aApemat['con_ape'];
			$cApemat->close();
				
			//-------------------------------------------------------------------------
			$vQuery = "Select cod_car, con_rat from unapnet.ratmat where ano_aca = '{$sUsercoo['ano_aca']}' and ";
			$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and cod_car = '{$sUsercoo['cod_car']}'";
			$cRatmat = fQuery($vQuery);
			while($aRatmat = $cRatmat->fetch_array())
				$sRatmat[$aRatmat['cod_car']] = $aRatmat['con_rat'];
			$cRatmat->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select cod_car, con_res from unapnet.resmat where ano_aca = '{$sUsercoo['ano_aca']}' and ";
			$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and cod_car = '{$sUsercoo['cod_car']}'";
			$cResmat = fQuery($vQuery);
			while($aResmat = $cResmat->fetch_array())
				$sResmat[$aResmat['cod_car']] = $aResmat['con_res'];
			$cResmat->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select cod_car, con_mdf from unapnet.mdfmat where ano_aca = '{$sUsercoo['ano_aca']}' and ";
			$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and cod_car = '{$sUsercoo['cod_car']}'";
			$cMdfmat = fQuery($vQuery);
			while($aMdfmat = $cMdfmat->fetch_array())
				$sMdfmat[$aMdfmat['cod_car']] = $aMdfmat['con_mdf'];
			$cMdfmat->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select cod_car, grado from unapnet.carrera where cod_car = '{$sUsercoo['cod_car']}'";
			$cGradocar = fQuery($vQuery);
			while($aGradocar = $cGradocar->fetch_array())
				$sGradocar[$aGradocar['cod_car']] = $aGradocar['grado'];
			$cGradocar->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select cod_car, pln_est, crd_pro from unapnet.credicar where cod_car = '{$sUsercoo['cod_car']}'";
			$cCuadropro = fQuery($vQuery);
			while($aCuadropro = $cCuadropro->fetch_array())
				$sCuadropro[$aCuadropro['pln_est']] = $aCuadropro['crd_pro'];
			$cCuadropro->close();
			
			//-------------------------------------------------------------------------
			$sSexo['1'] = 'Masculino';
			$sSexo['2'] = 'Femenino';
			
			//-------------------------------------------------------------------------
			$sMes['01'] = 'Enero';
			$sMes['1'] = 'Enero';
			$sMes['02'] = 'Febrero';
			$sMes['2'] = 'Febrero';
			$sMes['03'] = 'Marzo';
			$sMes['3'] = 'Marzo';
			$sMes['04'] = 'Abril';
			$sMes['4'] = 'Abril';
			$sMes['05'] = 'Mayo';
			$sMes['5'] = 'Mayo';
			$sMes['06'] = 'Junio';
			$sMes['6'] = 'Junio';
			$sMes['07'] = 'Julio';
			$sMes['7'] = 'Julio';
			$sMes['08'] = 'Agosto';
			$sMes['8'] = 'Agosto';
			$sMes['09'] = 'Setiembre';
			$sMes['9'] = 'Setiembre';
			$sMes['10'] = 'Octubre';
			$sMes['11'] = 'Noviembre';
			$sMes['12'] = 'Diciembre';		
			
			//-------------------------------------------------------------------------
			$sFching['2005-01-30'] = '30 de Enero del 2005';
			$sFching['2005-02-23'] = '23 de Febrero del 2005';
			$sFching['2005-03-05'] = '05 de Marzo del 2005';
			$sFching['2005-04-03'] = '03 de Abril del 2005';
			$sFching['2005-05-07'] = '07 de Mayo del 2005';
			$sFching['2005-10-28'] = '28 de Octubre del 2005';
			$sFching['2006-01-08'] = '08 de Enero del 2006';
			$sFching['2006-01-22'] = '22 de Enero del 2006';	
			$sFching['2006-02-19'] = '19 de Febrero del 2006';
			$sFching['2006-04-23'] = '23 de Abril del 2006';
			$sFching['2006-05-21'] = '21 de Mayo del 2006';
			$sFching['2007-01-11'] = '11 de Enero del 2007';
			$sFching['2007-01-30'] = '30 de Enero del 2007';
			$sFching['2007-03-04'] = '04 de Marzo del 2007';
			$sFching['2007-06-24'] = '24 de Junio del 2007';
			$sFching['2007-07-15'] = '15 de julio del 2007';
			$sFching['2007-04-01'] = '01 de abril del 2007';
			$sFching['2007-08-05'] = '05 de agosto del 2007';
			$sFching['2008-04-20'] = '20 de abril del 2008';
			$sFching['2008-07-20'] = '20 de julio del 2008';
			$sFching['2008-10-26'] = '26 de octubre del 2008';
			$sFching['2009-01-17'] = '17 de enero del 2009';
			$sFching['2009-01-31'] = '31 de enero del 2009';
			$sFching['2009-06-07'] = '07 de junio del 2009';
			$sFching['2009-09-13'] = '13 de setiembre del 2009';
						
			$sUsercoo['safetyselcar'] = '*25740E18E08CC91F492F1B38E5413E1B85E32A01';
			header("Location:administracion/");
		}
		else
		{
			header("Location:index.php");
		}
	}
	else
	{
		header("Location:index.php");
	}		
?>