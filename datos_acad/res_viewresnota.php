<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
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
		$sFechaA = "";
		
		$sUsercoo['hiscon'] = 'h';
		
		$vQuery = "Select num_mat, paterno, materno, nombres, mod_ing from unapnet.estudiante where num_mat = '$vNum_mat' and ";
		$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' ";
		$cEstudia = fQuery($vQuery);
		if($aEstudia2 = $cEstudia->fetch_array())
		{
			$sEstudia['num_mat'] = $aEstudia2['num_mat'];
			$sEstudia['paterno'] = $aEstudia2['paterno'];
			$sEstudia['materno'] = $aEstudia2['materno'];
			$sEstudia['nombres'] = $aEstudia2['nombres'];
			$sEstudia['mod_ing'] = $aEstudia2['mod_ing'];
			
			$vQuery = "Select ano_ing, nro_ins, pun_ing, pun_sob, ord_ing, ord_sob from unapnet.estudata ";
			$vQuery .= "where num_mat = '$vNum_mat' and cod_car = '{$sUsercoo['cod_car']}' ";
			$cEstudata = fQuery($vQuery);
			if($aEstudata = $cEstudata->fetch_array())
			{
				$sEstudia['ano_ing'] = $aEstudata['ano_ing'];
				$sEstudia['nro_ins'] = $aEstudata['nro_ins'];
				$sEstudia['pun_ing'] = $aEstudata['pun_ing'];
				$sEstudia['pun_sob'] = $aEstudata['pun_sob'];
				$sEstudia['ord_ing'] = $aEstudata['ord_ing'];
				$sEstudia['ord_sob'] = $aEstudata['ord_sob'];
			}

			//----------------------------------------------------------
			$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
			$vQuery = "Select distinct ano_aca, per_aca, pln_est from $tNota where num_mat = '{$sEstudia['num_mat']}' order by ano_aca, per_aca";
			$cAnoper = fQuery($vQuery);
			while($aAnoper = $cAnoper->fetch_array())
			{
				$sAnoper[$aAnoper['ano_aca'].$aAnoper['per_aca']]['ano_aca'] = $aAnoper['ano_aca'];
				$sAnoper[$aAnoper['ano_aca'].$aAnoper['per_aca']]['per_aca'] = $aAnoper['per_aca'];
			}			
			
			//--------------- Ultima matricula ----------------------			
			$bUltmat = FALSE;
			$vAno_ini = substr($sEstudia['num_mat'], 0, 2);
			if($vAno_ini < '50') 
				$vAno_ini = "20$vAno_ini";
			else
				$vAno_ini = "1999";
				
			for($vAno_aca = $sUsercoo['ano_aca']; $vAno_aca >= $vAno_ini and !$bUltmat; $vAno_aca--)
			{
				$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}$vAno_aca";
				$vQuery = "Select per_aca, pln_est, cod_esp from $tEstumat where num_mat = '{$sEstudia['num_mat']}' and ";
				$vQuery .= "(per_aca = '00' or per_aca = '01' or per_aca = '02') order by per_aca desc";
				
				$cEstumat = fQuery($vQuery);
				while($aEstumat = $cEstumat->fetch_array())
				{
					$sEstudia['pln_est'] = $aEstumat['pln_est'];
					$sEstudia['cod_esp'] = $aEstumat['cod_esp'];					
					$bUltmat = TRUE;
					break;
				}				
			}
			//-----------------------------------------
			if($bUltmat)
			{
				$vTip_cur = "";	
				$vCod_esp = "";
				$vSem_anu = "";
				$vNiv_est = "";
				$vContador = 1;
				$sPDF = "";
				
				$aNotah = "";
				$aNotac = "";
				$vContn = 1;
				$vCod_cur = "";
				$vCod_curo = "";
				
				//----------------------- Recolectando notas para el historial ----------------
				$vQuery = "Select no.cod_cur, no.not_cur, no.ano_aca, no.per_aca, mn.ord_not, no.cod_act, ";
				$vQuery .= " no.mod_not, no.cur_con, no.obs_not, fch_reg ";
				$vQuery .= "from $tNota no left join unapnet.modnot mn on no.mod_not = mn.mod_not ";
				$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and no.pln_est = '{$sEstudia['pln_est']}' ";
				$vQuery .= "order by cod_cur, ano_aca, per_aca, ord_not ";
				$cNotas = fQuery($vQuery);
				while($aNotas = $cNotas->fetch_array())
				{	
				 	if($vCod_cur != $aNotas['cod_cur'])
					{
						$vCod_cur = $aNotas['cod_cur'];
						$vContn = 1;
					}
					if($aNotas['not_cur'] > 10)
					{
						$aNotah[$aNotas['cod_cur']]['cod_act'] = $aNotas['cod_act'];
						$aNotah[$aNotas['cod_cur']]['fch_reg'] = (empty($aNotas['fch_reg'])?'':fFechad($aNotas['fch_reg']));
					}
						
					$aNotah[$aNotas['cod_cur'].$vContn]['ano_aca'] = $aNotas['ano_aca'];
					$aNotah[$aNotas['cod_cur'].$vContn]['per_aca'] = $aNotas['per_aca'];
					$aNotah[$aNotas['cod_cur'].$vContn]['not_cur'] = (string)(strlen($aNotas['not_cur'])==1?('0'.$aNotas['not_cur']):$aNotas['not_cur']);
					$vContn++;
					if($aNotas['mod_not'] == '04')
						$aNotac[$aNotas['cod_cur']] = " POR: {$aNotas['cur_con']} ({$aNotas['obs_not']})";
					if(($aNotas['mod_not'] == '09' or $aNotas['mod_not'] == '17' or $aNotas['mod_not'] == '13' or $aNotas['mod_not'] == '05' or $aNotas['mod_not'] == '19') and $aNotas['not_cur'] > 10)
						$aNotac[$aNotas['cod_cur']] = " ({$aNotas['obs_not']})";
				}
				$cNotas->close();
				//----------------------------------------------------------------------------------
				
				//--------------------------- Nombre de los cursos --------------------------------
				$vExede = FALSE;
				$vQuery = "Select cod_cur, nom_cur, nom_ofi, cod_esp, crd_cur, tip_cur, niv_est, sem_anu ";
				$vQuery .= "from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sEstudia['pln_est']}' ";
				$vQuery .= "and (cod_esp = '00' or cod_esp = '{$sEstudia['cod_esp']}') and con_cur = '1' ";
				$vQuery .= "order by niv_est, sem_anu, tip_cur, cod_esp, cod_cur ";
				$cCurso = fQuery($vQuery);
				while($aCurso = $cCurso->fetch_array())
				{ 
					$vExede = FALSE;
					//---------- Semestre y/o nivel -----------------------
					if($aCurso['sem_anu'] != $vSem_anu or $aCurso['niv_est'] != $vNiv_est)
					{
						$vSem_anu = $aCurso['sem_anu'];
						$vNiv_est = $aCurso['niv_est'];						
						
						$sPDF[$vContador]['header'] = TRUE;
						$sPDF[$vContador]['sem_anu'] = TRUE;
						
						if($sPlan[$sEstudia['pln_est']] == '1')
						{
							$sEstudia['tip_sist'] = '1';
							$sPDF[$vContador]['nom_cur'] = "NIVEL: {$sNivel[$aCurso['niv_est']]} - ";
						}
						if($aCurso['sem_anu'] == '00')
						{
							$sPDF[$vContador]['nom_cur'] .= "{$sSemestre[$aCurso['sem_anu']]}";
						}
						else
						{	
							$sPDF[$vContador]['nom_cur'] .= "SEMESTRE: {$sSemestre[$aCurso['sem_anu']]}";
						}
						$vContador++;
					}
					//--------------- Tipo de Curso --------------------------
					if(!($aCurso['tip_cur'] == $vTip_cur))
					{
						$vTip_cur = $aCurso['tip_cur'];
						switch($vTip_cur)
						{
							case '02': $sPDF[$vContador]['header'] = TRUE;
								$sPDF[$vContador]['nom_cur'] = "ELECTIVOS: ";
								if($aCurso['cod_esp'] == '00')	$sPDF[$vContador]['nom_cur'] .= $sAreaca['02'];
								else $sPDF[$vContador]['nom_cur'] .= $sAreaca['03'];								
								$vContador++;
								break;
							case '03': $sPDF[$vContador]['header'] = TRUE;
								$sPDF[$vContador]['nom_cur'] = "OPTATIVOS: {$sAreaca['03']}";								
								$vContador++;
								break;
						}
					}
					//--------------- Especialidad -----------------------------
					if(!($aCurso['cod_esp'] == $vCod_esp))
					{
						$vCod_esp = $aCurso['cod_esp'];
						if(!($aCurso['cod_esp'] == '00'))
						{	
							$sPDF[$vContador]['header'] = TRUE;
							$sPDF[$vContador]['nom_cur'] = "MENSION: {$sEspecial[$sEstudia['pln_est'].$vCod_esp]['esp_nom']}";
							$vContador++;
						}
					}
					//------------
/*					if(strlen($sPlan['nom_cur']) <= 65)
							{				
								$this->Cell(93,4, $sPlan['nom_cur'], 0, 0, 'L');
							}
							else
							{
								for($i = 64; $i > 0; $i--)
								{
									if(substr($sPlan['nom_cur'], $i, 1) == ' ')
									{										
										break;
									}
								}																
								$this->Cell(93,4, substr($sPlan['nom_cur'], 0, $i+1), 0, 0, 'L');
								$vNom_cur2 = substr($sPlan['nom_cur'], $i, strlen($sPlan['nom_cur']) - ($i));
							}*/
					//------------		
					$vNom_cur = "";			
					$vNom_cur2 = "";
					$i = 0;
					if(strlen($aCurso['nom_ofi'].$aNotac[$aCurso['cod_cur']]) >= 50)					
					{						
						$vExede = TRUE;
						if(strlen($aCurso['nom_ofi']) >= 50)
						{
							for($i = 50; $i > 0; $i--)
							{
								if(substr($aCurso['nom_ofi'], $i, 1) == ' ')
								{										
									break;
								}
							}																
							$vNom_cur = substr($aCurso['nom_ofi'], 0, $i+1);
							$vNom_cur2 = substr($aCurso['nom_ofi'], $i, strlen($aCurso['nom_ofi']) - ($i));
						}
						else
						{
							$vNom_cur = $aCurso['nom_ofi'];
						}
							
						$sPDF[$vContador]['nom_cur'] = $vNom_cur;
						$sPDF[$vContador]['next'] = TRUE;
					}
					else
					{
						$sPDF[$vContador]['nom_cur'] = $aCurso['nom_ofi'].$aNotac[$aCurso['cod_cur']];
					}
					
					$sPDF[$vContador]['crd_cur'] = $aCurso['crd_cur'];					
					$sPDF[$vContador]['cod_act'] = $aNotah[$aCurso['cod_cur']]['cod_act'];
					$sPDF[$vContador]['fch_reg'] = $aNotah[$aCurso['cod_cur']]['fch_reg'];
					
					$sPDF[$vContador]['not_cur1'] = $aNotah[$aCurso['cod_cur'].'1']['not_cur'];
					$sPDF[$vContador]['ano_per1'] = $aNotah[$aCurso['cod_cur'].'1']['ano_aca'].(($aNotah[$aCurso['cod_cur'].'1']['per_aca']!='00')?('-'.$sPeriodo[$aNotah[$aCurso['cod_cur'].'1']['per_aca']]['abr_per']):'');
					$sPDF[$vContador]['not_cur2'] = $aNotah[$aCurso['cod_cur'].'2']['not_cur'];
					$sPDF[$vContador]['ano_per2'] = $aNotah[$aCurso['cod_cur'].'2']['ano_aca'].(($aNotah[$aCurso['cod_cur'].'2']['per_aca']!='00')?('-'.$sPeriodo[$aNotah[$aCurso['cod_cur'].'2']['per_aca']]['abr_per']):'');
					$sPDF[$vContador]['not_cur3'] = $aNotah[$aCurso['cod_cur'].'3']['not_cur'];
					$sPDF[$vContador]['ano_per3'] = $aNotah[$aCurso['cod_cur'].'3']['ano_aca'].(($aNotah[$aCurso['cod_cur'].'3']['per_aca']!='00')?('-'.$sPeriodo[$aNotah[$aCurso['cod_cur'].'3']['per_aca']]['abr_per']):'');
					$sPDF[$vContador]['not_cur4'] = $aNotah[$aCurso['cod_cur'].'4']['not_cur'];
					$sPDF[$vContador]['ano_per4'] = $aNotah[$aCurso['cod_cur'].'4']['ano_aca'].(($aNotah[$aCurso['cod_cur'].'4']['per_aca']!='00')?('-'.$sPeriodo[$aNotah[$aCurso['cod_cur'].'4']['per_aca']]['abr_per']):'');
					$sPDF[$vContador]['not_cur5'] = $aNotah[$aCurso['cod_cur'].'5']['not_cur'];
					$sPDF[$vContador]['ano_per5'] = $aNotah[$aCurso['cod_cur'].'5']['ano_aca'].(($aNotah[$aCurso['cod_cur'].'5']['per_aca']!='00')?('-'.$sPeriodo[$aNotah[$aCurso['cod_cur'].'5']['per_aca']]['abr_per']):'');
					$sPDF[$vContador]['not_cur6'] = $aNotah[$aCurso['cod_cur'].'6']['not_cur'];
					$sPDF[$vContador]['ano_per6'] = $aNotah[$aCurso['cod_cur'].'6']['ano_aca'].(($aNotah[$aCurso['cod_cur'].'6']['per_aca']!='00')?('-'.$sPeriodo[$aNotah[$aCurso['cod_cur'].'6']['per_aca']]['abr_per']):'');
					
					$vContador++;
					
					if($vExede)
					{
						$sPDF[$vContador]['exede'] = TRUE;
						$sPDF[$vContador]['nom_cur'] = $vNom_cur2.$aNotac[$aCurso['cod_cur']];
						$vContador++;
					}
				}
				$aNotah = "";
				$aNotac = "";
			}
		}
		else
		{
			header("Location:not_getestu.php");
		}
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

	    <? $sNotapdf = "";	
			if(!empty($sAnoper)) foreach($sAnoper as $vAnoper => $aAnoper)	
			{
				$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca']]['niv_est'] = "AÑO ACADÉMICO: {$aAnoper['ano_aca']} - PERIODO: {$sPeriodo[$aAnoper['per_aca']]['per_des']}";
				$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca']]['header'] = TRUE;
		?>
        <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Notas - A&ntilde;o: <?=$aAnoper['ano_aca']?> - Periodo: <?=$sPeriodo[$aAnoper['per_aca']]['per_des']?> </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th width="40" scope="col">C&oacute;d.</th>
                  <th width="15" scope="col">N</th>
                  <th width="15" scope="col">S</th>
                  <th width="15" scope="col">Es</th>
                  <th width="220" scope="col">Curso</th>
                  <th width="20" scope="col">Not</th>
                  <th width="80" scope="col">Mod.</th>
                  <th width="30" scope="col">Crd</th>
                  <th width="40" scope="col">Acta</th>
                  <th width="60" scope="col">Fecha</th>
                  <th width="16" scope="col">&nbsp;</th>
                  <th width="16" scope="col">&nbsp;</th>
                </tr>
                <? 	
					
/*					$sFechaA = "";
					$tActa = "unapnet.acta{$aAnoper['ano_aca']}";
					
					if($aAnoper['ano_aca'] >= '1999')
					{
						$vQuery = "Select no.cod_act, concat(substr(date(ac.fch_act), 9, 2), '/', ";
						$vQuery .= "substr(date(ac.fch_act), 6, 2), '/', substr(date(ac.fch_act), 1, 4)) as fecha ";
						$vQuery .= "from $tNota no left join $tActa ac on no.cod_act = ac.cod_act ";
						$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and no.ano_aca = '{$aAnoper['ano_aca']}' and ";
						$vQuery .= "no.per_aca = '{$aAnoper['per_aca']}'";
						$cFechaA = fQuery($vQuery);
						while($aFechaA = $cFechaA->fetch_array())
						{
							 $sFechaA[$aFechaA["cod_act"]] = $aFechaA["fecha"];
						}
					}*/
					
					$vCont = 1; 
					$vQuery = "Select cu.pln_est, cu.cod_cur, cu.nom_cur, cu.niv_est, cu.sem_anu, ";
					$vQuery .= "no.not_cur, no.mod_not, cu.crd_cur, cu.cod_esp, no.cod_act, no.fch_reg ";
					$vQuery .= "from $tNota no left join unapnet.curso cu on no.pln_est = cu.pln_est and ";
					$vQuery .= "no.cod_cur = cu.cod_cur ";
					$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and no.ano_aca = '{$aAnoper['ano_aca']}' and ";
					$vQuery .= "no.per_aca = '{$aAnoper['per_aca']}' and cu.cod_car = '{$sUsercoo['cod_car']}' ";
					$vQuery .= "order by pln_est, niv_est, sem_anu, cod_esp, cod_cur, mod_not ";
					$cNotas = fQuery($vQuery);
					while($aNotas = $cNotas->fetch_array())
					{ 
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['ano_per'] = "{$aAnoper['ano_aca']}-{$sPeriodo[$aAnoper['per_aca']]['abr_per']}";
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['niv_est'] = $aNotas['niv_est'];
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['sem_anu'] = $aNotas['sem_anu'];
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['cod_cat'] = "{$aNotas['pln_est']}-{$aNotas['cod_cur']}";
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['nom_cur'] = $aNotas['nom_cur'];						
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['mod_not'] = $sModnot[$aNotas['mod_not']];
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['crd_cur'] = $aNotas['crd_cur'];
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['not_cur'] = $aNotas['not_cur'];
				
				?>
                <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                  <td width="40" class="wordcen"><?=$aNotas['pln_est']?>-<?=$aNotas['cod_cur']?></td>
                  <td class="wordcen"><?=$aNotas['niv_est']?></td>
                  <td class="wordcen"><?=$aNotas['sem_anu']?></td>
                  <td class="wordcen"><?=$aNotas['cod_esp']?></td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($aNotas['nom_cur']))?>&nbsp;</td>
                  <td class="wordder"><span class ="<?	if($aNotas['not_cur'] < 11) echo "notades"; else echo "notapro" ?>"><?=$aNotas['not_cur']?></span>&nbsp;</td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($sModnot[$aNotas['mod_not']]))?>&nbsp;</td>
                  <td class="wordder"><?=$aNotas['crd_cur']?>&nbsp;</td>
                  <td class="wordcen"><?=$aNotas['cod_act']?></td>
                  <td class="wordcen"><?=(empty($aNotas['fch_reg'])?'':fFechad($aNotas['fch_reg']))?></td>
                  <td class="wordcen"><a href="" onclick="editnotaest('<?=$aNotas['pln_est']?>', '<?=$aNotas['cod_cur']?>', '<?=$aNotas['mod_not']?>', '<?=$aAnoper['ano_aca']?>', '<?=$aAnoper['per_aca']?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Mostrar informaci&oacute;n" width="16" height="16" /></a></td>
                  <td class="wordcen"><a href="" onclick="del_nota('<?=$aNotas['pln_est']?>', '<?=$aNotas['cod_cur']?>', '<?=$aNotas['mod_not']?>', '<?=$aAnoper['ano_aca']?>', '<?=$aAnoper['per_aca']?>'); return false;" class="enlaceb"><img src="../images/drop.png" alt="Eliminar" width="16" height="16" /></a></td>
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
<? } ?>		 
		<a href="prnnota.php" title="Imprimir Historial de Notas" class="linkboton" target="frPdf"><img src="../images/bphnota.png" width="100" height="24"></a>
		<? if($bUltmat)	{	?>
			<a href="prnhistoacad.php" title="Imprimir Historial Academico" class="linkboton" target="frPdf"><img src="../images/bphacad.png" width="100" height="24"></a>
			<a href="prnhistoacadcon.php" title="Imprimir Historial Academico" class="linkboton" target="frPdf"><img src="../images/bphacadcon.png" width="100" height="24"></a>	  
		<?	}	?>

<div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>