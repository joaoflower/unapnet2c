<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		
		/*if(!empty($_GET['rPln_est']))
			$sUsercoo['pln_est'] = $_GET['rPln_est'];*/
		
		if(!empty($_GET['rNum_mat']))
			$vNum_mat = $_GET['rNum_mat'];
		else
			$vNum_mat = $sEstudia['num_mat'];	
		
		$sEstudia = "";
		$sCurso = "";
		$sCurmat = "";
		$sCurmat2 = "";
		$sCurapto = "";
		$sCurso = "";
		$sAnoper = "";
		$sNotapdf = "";
		$sPDF = "";
		$sNotapro = "";
		$sFechacta = "";
		
		$vQuery = "Select num_mat, paterno, materno, nombres from unapnet.estudiante where num_mat = '$vNum_mat' and ";
		$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' ";
		$cEstudia = fQuery($vQuery);
		if($aEstudia2 = $cEstudia->fetch_array())
		{
			$sEstudia['num_mat'] = $aEstudia2['num_mat'];
			$sEstudia['paterno'] = $aEstudia2['paterno'];
			$sEstudia['materno'] = $aEstudia2['materno'];
			$sEstudia['nombres'] = $aEstudia2['nombres'];
			
			$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
			
			$bUltmat = FALSE;
			$vAno_ini = substr($sEstudia['num_mat'], 0, 2);
			if($vAno_ini < '50') 
				$vAno_ini = "20$vAno_ini";
			else
				$vAno_ini = "1999";
				
			for($vAno_aca = $sUsercoo['ano_aca']; $vAno_aca >= $vAno_ini and !$bUltmat; $vAno_aca--)
			{
				$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}$vAno_aca";
				$vQuery = "Select per_aca, pln_est, cod_esp from $tEstumat where num_mat = '{$sEstudia['num_mat']}' ";
				$vQuery .= "order by per_aca desc";
				
				$cEstumat = fQuery($vQuery);
				while($aEstumat = $cEstumat->fetch_array())
				{
					$sEstudia['pln_est'] = $aEstumat['pln_est'];
					$sEstudia['cod_esp'] = $aEstumat['cod_esp'];					
					$bUltmat = TRUE;
					break;
				}				
			}
		}
		else
		{
			header("Location:not_getestu.php");
		}
		
/*		$vQuery = "select max(pln_est) as pln_est from $tNota where num_mat = '{$sEstudia['num_mat']}'";
		$cPlanest = fQuery($vQuery);
		if($aPlanest = $cPlanest->fetch_array())
		{
			$sUsercoo['pln_est'] = $aPlanest['pln_est'];
		}*/
		
		
		if(!empty($sEstudia['pln_est']))
		{
			$vQuery = "select cod_cur, not_cur, mod_not, cod_act, ano_aca, per_aca, cur_con, obs_not, fch_reg from $tNota ";
			$vQuery .= "where num_mat = '{$sEstudia['num_mat']}' and pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "not_cur > 10 ";
			$cNotapro = fQuery($vQuery);
			while($aNotapro = $cNotapro->fetch_array())
			{
				$sNotapro[$aNotapro['cod_cur']]['not_cur'] = $aNotapro['not_cur'];
				$sNotapro[$aNotapro['cod_cur']]['mod_not'] = $aNotapro['mod_not'];
				$sNotapro[$aNotapro['cod_cur']]['cod_act'] = $aNotapro['cod_act'];
				$sNotapro[$aNotapro['cod_cur']]['ano_aca'] = $aNotapro['ano_aca'];
				$sNotapro[$aNotapro['cod_cur']]['per_aca'] = $aNotapro['per_aca'];
				$sNotapro[$aNotapro['cod_cur']]['cur_con'] = $aNotapro['cur_con'];
				$sNotapro[$aNotapro['cod_cur']]['obs_not'] = $aNotapro['obs_not'];
				$sNotapro[$aNotapro['cod_cur']]['fch_reg'] = $aNotapro['fch_reg'];
			}
			$cNotapro->close();
			
			$sNiv_sem = "";
			$sRequ = "";
			
/*			$vQuery = "Select niv_est, sem_anu from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and ";
			$vQuery .= "pln_est = '{$sEstudia['pln_est']}' order by niv_est, sem_anu";
			$cNiv_sem = fQuery($vQuery);
			while($aNiv_sem = $cNiv_sem->fetch_array())
			{
				$sNiv_sem[$aNiv_sem['niv_est'].$aNiv_sem['sem_anu']]['niv_est'] = $aNiv_sem['niv_est'];
				$sNiv_sem[$aNiv_sem['niv_est'].$aNiv_sem['sem_anu']]['sem_anu'] = $aNiv_sem['sem_anu'];
			}*/
			
			//--------------------------------------------------------------------
			$vQuery = "select sum(cu.crd_cur) as all_crd from $tNota no left join unapnet.curso cu on ";
			$vQuery .= "no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
			$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and no.pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "no.cod_car = '{$sUsercoo['cod_car']}' ";
			$cNotall = fQuery($vQuery);	
			if($aNotall = $cNotall->fetch_array())
				$sEstudia['all_crdm'] = $aNotall['all_crd'];
			$cNotall->close();
			
			//--------------------------------------------------------------------
			$vQuery = "select sum(cu.crd_cur) as all_crd from $tNota no left join unapnet.curso cu on ";
			$vQuery .= "no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
			$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and no.pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "no.cod_car = '{$sUsercoo['cod_car']}' and no.not_cur > 10";
			$cNotall = fQuery($vQuery);	
			if($aNotall = $cNotall->fetch_array())
				$sEstudia['all_crd'] = $aNotall['all_crd'];	
			$cNotall->close();
				
			//--------------------------------------------------------------------
			$vQuery = "select sum(cu.crd_cur) as all_crd from $tNota no left join unapnet.curso cu on ";
			$vQuery .= "no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
			$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and no.pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "no.cod_car = '{$sUsercoo['cod_car']}' and no.not_cur <= 10";
			$cNotall = fQuery($vQuery);	
			if($aNotall = $cNotall->fetch_array())
				$sEstudia['all_crdd'] = $aNotall['all_crd'];	
			$cNotall->close();
				
			//--------------------------------------------------------------------
			$vQuery = "select sum(cu.crd_cur * no.not_cur) as tot_prm  from $tNota no left join unapnet.curso cu on ";
			$vQuery .= "no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
			$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and no.pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "no.cod_car = '{$sUsercoo['cod_car']}' ";
			$cNotall = fQuery($vQuery);	
			if($aNotall = $cNotall->fetch_array())
				$sEstudia['tot_prm'] = round($aNotall['tot_prm'] / $sEstudia['all_crdm'], 2);
			$cNotall->close();
				
			//--------------------------------------------------------------------
			$vQuery = "select sum(cu.crd_cur * no.not_cur) as prm_acu from $tNota no left join unapnet.curso cu on ";
			$vQuery .= "no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
			$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and no.pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "no.cod_car = '{$sUsercoo['cod_car']}' and no.not_cur > 10";
			$cNotall = fQuery($vQuery);	
			if($aNotall = $cNotall->fetch_array())
				$sEstudia['prm_acu'] = round($aNotall['prm_acu'] / $sEstudia['all_crd'], 3);	
			$cNotall->close();
						
			$sEstudia['sem_anu'] = fSemestudia($sEstudia['pln_est'], $sEstudia['all_crd'] + $sEstudia['max_crd']);



		}
		else
		{
			header("Location:pln_selectplan.php");
		}
		
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

<?
	$vCont = 1;
	$vContador = 1;
	$sPDF = "";
	
?>

<table border="0" cellpadding="0" cellspacing="0" id="ventana">
            <tr>
              <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
              <th align="center" background="../images/ventana_r1_c2.jpg" >Plan <?=$sEstudia['pln_est']?> - <?=$sTiposist[$sPlan[$sEstudia['pln_est']]]?></th>
              <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
            </tr>
            <tr>
              <td background="../images/ventana_r2_c1.jpg"></td>
              <td background="../images/ventana_r2_c2.jpg" class="wordcen">
			  <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th width="70" scope="col">Total Cred. </th>
                  <th width="70" scope="col">Cr&eacute;d. Apr. </th>
                  <th width="70" scope="col">Cr&eacute;d. Des. </th>
                  <th width="70" scope="col">Total Prom </th>
                  <th width="70" scope="col">Prom Acum </th>
                  <th width="70" scope="col">Semestre</th>
                </tr>
                <tr class="celinpar" >
                  <td class="wordderb"><?=$sEstudia['all_crdm']?>&nbsp;</td>
                  <td class="wordderb"><?=$sEstudia['all_crd']?>&nbsp;</td>
                  <td class="wordderb"><?=$sEstudia['all_crdd']?>&nbsp;</td>
                  <td class="wordderb"><?=$sEstudia['tot_prm']?>&nbsp;</td>
                  <td class="wordderb"><?=$sEstudia['prm_acu']?>&nbsp;</td>
                  <td class="wordderb"><?=$sSemestre[$sEstudia['sem_anu']]?>&nbsp;</td>
                </tr>
            </table>
			  <table width="580" border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                  <tr>
                    <th width="25" scope="col">C&oacute;d</th>
                    <th width="220" scope="col">Curso</th>
                    <th width="30" scope="col">Crd</th>
                    <th width="20" scope="col">Not</th>
                    <th width="80" scope="col">Mod</th>
                    <th width="40" scope="col">Acta</th>
                    <th width="60" scope="col">Fecha</th>
                    <th width="60" scope="col">Periodo</th>
                    <th width="16" scope="col">&nbsp;</th>
                  </tr>
                  <? 	$vCont = 1;	
				  		$vSub_tit = "";
						$vNiv_est = "";
						$vSem_anu = "";
						$vNom_cur = "";
				  		$vQuery = "Select pln_est, cod_cur , cod_cat, nom_ofi as nom_cur, cod_esp, crd_cur, tip_cur, ";
						$vQuery .= "niv_est, sem_anu from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and ";
						$vQuery .= "pln_est = '{$sEstudia['pln_est']}' and con_cur = '1' ";
						
						if($bUltmat and ($sUsercoo['cod_car'] != '01' and $sUsercoo['cod_car'] != '02' and $sUsercoo['cod_car'] != '32') )
						{
							$vQuery .= "and (cod_esp = '00' or cod_esp = '{$sEstudia['cod_esp']}') ";
						}
						
						$vQuery .= "order by niv_est, sem_anu, tip_cur, cod_esp, cod_cur ";
						$cCurso = fQuery($vQuery);
						while($aCurso = $cCurso->fetch_array())
						{ 
							//------------- Diferente semestre y/o nivel ----------------
							if($vNiv_est != $aCurso['niv_est'] or $vSem_anu != $aCurso['sem_anu'])
							{
								$vNiv_est = $aCurso['niv_est'];
								$vSem_anu = $aCurso['sem_anu'];
								
								$vTip_cur = "";	$vCod_esp = "";
								$sPDF[$vContador]['header'] = TRUE;
								$sPDF[$vContador]['semestre'] = TRUE;
								
								if(!empty($aCurso['niv_est']))
									$sPDF[$vContador]['nom_cur'] = "NIVEL: {$sNivel[$aCurso['niv_est']]} - ";
								if(!empty($aCurso['sem_anu']))
									$sPDF[$vContador]['nom_cur'] .= "SEMESTRE: {$sSemestre[$aCurso['sem_anu']]}";
								$vContador++;
							?>
								<tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\""; $vCont++;	?>>
								   <td class="wordcen">&nbsp;</td>
								   <td colspan="8" class="wordizqb">Nivel: <?=$sNivel[$aCurso['niv_est']]?> - Semestre: <?=$sSemestre[$aCurso['sem_anu']]?></td>
							    </tr>
							<?
							}
							
							//------------------ Diferente tipo de curso ------------------
							if(!($aCurso['tip_cur'] == $vTip_cur))
							{								
								$vSub_tit = "";
								$vTip_cur = $aCurso['tip_cur'];
								switch($vTip_cur)
								{
									case '02': $vSub_tit = "ELECTIVO: ";
										if($aCurso['cod_esp'] == '00')	$vSub_tit .= ucwords(strtolower($sAreaca['02']));
										else $vSub_tit .= ucwords(strtolower($sAreaca['03']));
										$sPDF[$vContador]['header'] = TRUE;
										$sPDF[$vContador]['nom_cur'] = strtoupper($vSub_tit);
										$vContador++;
										break;
									case '03': $vSub_tit = "OPTATIVO: " .ucwords(strtolower($sAreaca['03']));
										$sPDF[$vContador]['header'] = TRUE;
										$sPDF[$vContador]['nom_cur'] = strtoupper($vSub_tit);
										$vContador++;
										break;
								}
								if(!empty($vSub_tit))
								{	?>
								 
								 <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\""; $vCont++;	?>>
									<td class="wordcen">&nbsp;</td>
									<td colspan="8" class="wordizqb"><?=$vSub_tit?></td>
			    </tr>
								<?	}
							}
							//------------------- Diferente Especialidad ------------------------
							if(!($aCurso['cod_esp'] == $vCod_esp))
							{
								$vSub_tit = "";
								$vCod_esp = $aCurso['cod_esp'];
								if(!($aCurso['cod_esp'] == '00'))
								{	
									$sPDF[$vContador]['header'] = TRUE;
									$sPDF[$vContador]['nom_cur'] = "MENSION: ".$sEspecial[$sEstudia['pln_est'].$vCod_esp]['esp_nom'];
									$vContador++;
								?>
								  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\""; $vCont++;	?>>
									<td class="wordcen">&nbsp;</td>
									<td colspan="8" class="wordizqb">Mensi&oacute;n: <?=ucwords(strtolower($sEspecial[$sEstudia['pln_est'].$vCod_esp]['esp_nom']))?></td>
								  </tr>
								<?								
								}
							}
							
							if($sNotapro[$aCurso['cod_cur']]['mod_not'] == '04')
								$vNom_cur = $aCurso['nom_cur']." (Por: ".ucwords(strtolower($sNotapro[$aCurso['cod_cur']]['cur_con'])).")";
							else
								$vNom_cur = $aCurso['nom_cur'];							
							
							$sPDF[$vContador]['cur_pln'] = $aCurso['pln_est']."-".$aCurso['cod_cur'];
							$sPDF[$vContador]['nom_cur'] = $vNom_cur;
							$sPDF[$vContador]['cod_esp'] = $aCurso['cod_esp'];
							$sPDF[$vContador]['crd_cur'] = $aCurso['crd_cur'];
							$sPDF[$vContador]['not_cur'] = $sNotapro[$aCurso['cod_cur']]['not_cur'];
							$sPDF[$vContador]['mod_not'] = $sNotapro[$aCurso['cod_cur']]['mod_not'];
							$sPDF[$vContador]['cod_act'] = $sNotapro[$aCurso['cod_cur']]['cod_act'];
							$sPDF[$vContador]['ano_aca'] = $sNotapro[$aCurso['cod_cur']]['ano_aca'];
							$sPDF[$vContador]['per_aca'] = $sNotapro[$aCurso['cod_cur']]['per_aca'];							
							$sPDF[$vContador]['obs_not'] = $sNotapro[$aCurso['cod_cur']]['obs_not'];
							
							$vContador++;
							
					?>                  
				  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                    <td class="wordcen"><?=$aCurso['cod_cur']?></td>
                    <td class="wordizq">&nbsp;<?=ucwords(strtolower($vNom_cur))?></td>
                    <td class="wordder"><?=$aCurso['crd_cur']?>&nbsp;</td>
                    <td class="wordder"><span class ="<?	if($sNotapro[$aCurso['cod_cur']]['not_cur'] < 11) echo "notades"; else echo "notapro" ?>"><?=$sNotapro[$aCurso['cod_cur']]['not_cur']?></span>&nbsp;</td>
                    <td class="wordizq">&nbsp;<?=ucwords(strtolower($sModnot[$sNotapro[$aCurso['cod_cur']]['mod_not']]))?>&nbsp;</td>
                    <td class="wordcen"><?=$sNotapro[$aCurso['cod_cur']]['cod_act']?></td>
                    <td class="wordcen"><?=(empty($sNotapro[$aCurso['cod_cur']]['fch_reg'])?'':fFechad($sNotapro[$aCurso['cod_cur']]['fch_reg']))?></td>
                    <td class="wordizq">&nbsp;<?=$sNotapro[$aCurso['cod_cur']]['ano_aca']?>-<?=$sPeriodo[$sNotapro[$aCurso['cod_cur']]['per_aca']]['abr_per']?>&nbsp;</td>
				    <td class="wordizq"><a href="" onclick="editnotaestplan('<?=$aCurso['pln_est']?>', '<?=$aCurso['cod_cur']?>', '<?=$sNotapro[$aCurso['cod_cur']]['mod_not']?>', '<?=$sNotapro[$aCurso['cod_cur']]['ano_aca']?>', '<?=$sNotapro[$aCurso['cod_cur']]['per_aca']?>', '<?=(empty($sNotapro[$aCurso['cod_cur']]['not_cur'])?'i':'u')?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Modificar datos de la Nota" width="16" height="16" /></a></td>
			      </tr>                  
                  <? $vCont++; 	} ?>
              </table></td>
              <td background="../images/ventana_r2_c4.jpg"></td>
            </tr>
            <tr>
              <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
              <td background="../images/ventana_r4_c2.jpg"></td>
              <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
            </tr>
</table>
		  <a href="prnnotaplan.php" title="Imprimir plan de Estudios" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" /></a>
		  <a href="prncerestug.php" title="Imprimir Certificado de Estudios" class="linkboton" target="frPdf"><img src="../images/bpcerestu.png" width="100" height="24" border="0" /></a>
		  <?
		  	
		  	if($sUsercoo['cod_car'] == '01' or $sUsercoo['cod_car'] == '02' or $sUsercoo['cod_car'] == '03' or $sUsercoo['cod_car'] == '05' or $sUsercoo['cod_car'] == '08' or $sUsercoo['cod_car'] == '10' or $sUsercoo['cod_car'] == '15' or $sUsercoo['cod_car'] == '26' or $sUsercoo['cod_car'] == '11' or $sUsercoo['cod_car'] == '14' or $sUsercoo['cod_car'] == '04' or $sUsercoo['cod_car'] == '25' or $sUsercoo['cod_car'] == '23' or $sUsercoo['cod_car'] == '24' or $sUsercoo['cod_car'] == '36' or $sUsercoo['cod_car'] == '06' or $sUsercoo['cod_car'] == '07' or $sUsercoo['cod_car'] == '12' or $sUsercoo['cod_car'] == '13' or $sUsercoo['cod_car'] == '18' or $sUsercoo['cod_car'] == '20' or $sUsercoo['cod_car'] == '21' or $sUsercoo['cod_car'] == '30' or $sUsercoo['cod_car'] == '31' or $sUsercoo['cod_car'] == '16' or $sUsercoo['cod_car'] == '17' or $sUsercoo['cod_car'] == '09' or $sUsercoo['cod_car'] == '28' or $sUsercoo['cod_car'] == '29' or $sUsercoo['cod_car'] == '56' or $sUsercoo['cod_car'] == '32' or $sUsercoo['cod_car'] == '33' or $sUsercoo['cod_car'] == '34' or $sUsercoo['cod_car'] == '27')
			{				
		  ?>
		  <a href="prnplanestug.php" title="Imprimir plan de Estudios para Grados" class="linkboton" target="frPdf"><img src="../images/bpplanestu.png" width="100" height="24" /></a>
		  <?
		  	}
		  ?>
		  
		  
<div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>