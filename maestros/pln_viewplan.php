<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if(!empty($_GET['rPln_est']))
			$sUsercoo['pln_est'] = $_GET['rPln_est'];
		if(!empty($sUsercoo['pln_est']))
		{
			$sNiv_sem = "";
			$sRequ = "";
			$sRequ2 = "";
			$vPln_est = $sUsercoo['pln_est'];
			//$sUsercoo['pln_est'] = $vPln_est;
			
			$vQuery = "Select niv_est, sem_anu from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and ";
			$vQuery .= "pln_est = '{$sUsercoo['pln_est']}' order by niv_est, sem_anu";
			$cNiv_sem = fQuery($vQuery);
			while($aNiv_sem = $cNiv_sem->fetch_array())
			{
				$sNiv_sem[$aNiv_sem['niv_est'].$aNiv_sem['sem_anu']]['niv_est'] = $aNiv_sem['niv_est'];
				$sNiv_sem[$aNiv_sem['niv_est'].$aNiv_sem['sem_anu']]['sem_anu'] = $aNiv_sem['sem_anu'];
			}

			$vQuery = "Select pln_est, cod_cur, cur_pre from unapnet.requ where cod_car = '{$sUsercoo['cod_car']}' and ";
			$vQuery .= "pln_est = '{$sUsercoo['pln_est']}' order by cod_cur";
			$cRequ = fQuery($vQuery);
			while($aRequ = $cRequ->fetch_array())
			{
				if(!empty($sRequ[$aRequ['cod_cur']]))
				{
					$sRequ[$aRequ['cod_cur']] .= "<br>{$aRequ['pln_est']}-{$aRequ['cur_pre']} ";
					$sRequ2[$aRequ['cod_cur']] .= ", {$aRequ['pln_est']}-{$aRequ['cur_pre']} ";
				}
				else
				{
					$sRequ[$aRequ['cod_cur']] = "{$aRequ['pln_est']}-{$aRequ['cur_pre']}";
					$sRequ2[$aRequ['cod_cur']] = "{$aRequ['pln_est']}-{$aRequ['cur_pre']}";
				}
			}
			$vQuery = "Select max(cod_cur) as cod_cur from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and ";
			$vQuery .= "pln_est = '{$sUsercoo['pln_est']}' ";
			$cMax = fQuery($vQuery);
			if($aMax = $cMax->fetch_array())
			{
				$aMax['cod_cur']++;
				if(strlen($aMax['cod_cur']) == 1)				
					$aMax['cod_cur'] = '00'.$aMax['cod_cur'];
				if(strlen($aMax['cod_cur']) == 2)				
					$aMax['cod_cur'] = '0'.$aMax['cod_cur'];
			}
			$sUsercoo['cod_curx'] = $aMax['cod_cur'];
			$sUsercoo['cod_cur'] = "";
			$sUsercoo['upin'] = 'i';
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
<?	if(!empty($sNiv_sem))	
		  		$sPDF = "";
				$vContador = 1;
		  		foreach($sNiv_sem as $vNiv_sem2 => $vNiv_sem)	
				{	
					$vTip_cur = "";	$vCod_esp = "";
					$sPDF[$vContador]['header'] = TRUE;
					
					if(!empty($vNiv_sem['niv_est']))
						$sPDF[$vContador]['nom_cur'] = "NIVEL: {$sNivel[$vNiv_sem['niv_est']]} - ";
					if(!empty($vNiv_sem['sem_anu']))
						$sPDF[$vContador]['nom_cur'] .= "SEMESTRE: {$sNivel[$vNiv_sem['sem_anu']]}";
					$vContador++;
				?>
<table border="0" cellpadding="0" cellspacing="0" id="ventana">
            <tr>
              <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
              <th align="center" background="../images/ventana_r1_c2.jpg" >Nivel : <?=$sNivel[$vNiv_sem['niv_est']]?> - Semestre : <?=$sSemestre[$vNiv_sem['sem_anu']]?> </th>
              <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
            </tr>
            <tr>
              <td background="../images/ventana_r2_c1.jpg"></td>
              <td background="../images/ventana_r2_c2.jpg" class="wordcen">
			  <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                  <tr>
                    <th width="25" scope="col">C&oacute;d</th>
                    <th width="280" scope="col">Curso</th>
                    <th width="20" scope="col">Es</th>
                    <th width="20" scope="col">HT</th>
                    <th width="20" scope="col">HP</th>
                    <th width="20" scope="col">TH</th>
                    <th width="30" scope="col">Crd</th>
                    <th width="20" scope="col">TC</th>
                    <th width="50" scope="col">Requ</th>
                    <th width="16" scope="col">&nbsp;</th>
                    <th width="16" scope="col">&nbsp;</th>
                  </tr>
                  <? 	$vCont = 1;	
				  		$vSub_tit = "";
				  		$vQuery = "Select pln_est, cod_cur, cod_cat, nom_cur, cod_esp, hrs_teo, hrs_pra, hrs_tot, crd_cur, ";
						$vQuery .= "tip_cur, crd_prq from unapnet.curso ";
						$vQuery .= " where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sUsercoo['pln_est']}' and ";
						$vQuery .= "niv_est = '{$vNiv_sem['niv_est']}' and sem_anu = '{$vNiv_sem['sem_anu']}' and con_cur = '1' ";
						$vQuery .= "order by tip_cur, cod_esp, cod_cur ";
						$cCurso = fQuery($vQuery);
						while($aCurso = $cCurso->fetch_array())
						{ 
							if($aCurso['crd_prq'] > 0)
							{
								if(!empty($sRequ[$aCurso['cod_cur']])) 
								{
									$sRequ[$aCurso['cod_cur']] .= ", <BR>" .$aCurso['crd_prq']. " crd. ";
									$sRequ2[$aCurso['cod_cur']] .= ", " .$aCurso['crd_prq']. " crd. ";
								}
								else
								{
									$sRequ[$aCurso['cod_cur']] = $aCurso['crd_prq']. " crd. ";
									$sRequ2[$aCurso['cod_cur']] = $aCurso['crd_prq']. " crd. ";
								}
							}
							
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
									<td colspan="10" class="wordizqb"><?=$vSub_tit?></td>
			    </tr>
								<?	}
							}
							if(!($aCurso['cod_esp'] == $vCod_esp))
							{
								$vSub_tit = "";
								$vCod_esp = $aCurso['cod_esp'];
								if(!($aCurso['cod_esp'] == '00'))
								{	
									$sPDF[$vContador]['header'] = TRUE;
									$sPDF[$vContador]['nom_cur'] = "MENSION: ".$sEspecial[$sUsercoo['pln_est'].$vCod_esp]['esp_nom'];
									$vContador++;
								?>
								  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\""; $vCont++;	?>>
									<td class="wordcen">&nbsp;</td>
									<td colspan="10" class="wordizqb">Menci&oacute;n: <?=ucwords(strtolower($sEspecial[$sUsercoo['pln_est'].$vCod_esp]['esp_nom']))?></td>
								  </tr>
								<?								
								}
							}
							$sPDF[$vContador]['cur_pln'] = $aCurso['cod_cat'];
							$sPDF[$vContador]['nom_cur'] = $aCurso['nom_cur'];
							$sPDF[$vContador]['cod_esp'] = $aCurso['cod_esp'];
							$sPDF[$vContador]['hrs_teo'] = $aCurso['hrs_teo'];
							$sPDF[$vContador]['hrs_pra'] = $aCurso['hrs_pra'];
							$sPDF[$vContador]['hrs_tot'] = $aCurso['hrs_tot'];
							$sPDF[$vContador]['crd_cur'] = $aCurso['crd_cur'];
							if(!empty($sRequ[$aCurso['cod_cur']])) 
							{
								$sPDF[$vContador]['cur_pre'] = $sRequ2[$aCurso['cod_cur']]; 
							}
							else 
							{
								$sPDF[$vContador]['cur_pre'] = "NINGUNO";
							}
							$vContador++;
					?>                  
				  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                    <td class="wordcen"><a href="pln_viewcurso.php?rCod_cur=<?=$aCurso['cod_cur']?>"><?=$aCurso['cod_cur']?></a></td>
                    <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCurso['nom_cur']))?></td>
                    <td class="wordcen"><?=$aCurso['cod_esp']?></td>
                    <td class="wordcen"><?=$aCurso['hrs_teo']?></td>
                    <td class="wordcen"><?=$aCurso['hrs_pra']?></td>
                    <td class="wordcen"><?=$aCurso['hrs_tot']?></td>
                    <td class="wordcen"><?=$aCurso['crd_cur']?></td>
                    <td class="wordcen"><?=$aCurso['tip_cur']?></td>
                    <td class="wordizq"><? if(!empty($sRequ[$aCurso['cod_cur']])) echo $sRequ[$aCurso['cod_cur']]; else echo "Ninguno";	?></td>
                    <td class="wordcen"><a href="pln_viewcurso.php?rCod_cur=<?=$aCurso['cod_cur']?>" class="enlaceb"><img src="../images/browse.png" alt="Mostrar informaci&oacute;n" width="16" height="16" /></a></td>
				    <td class="wordcen"><a href="" onclick="del_curso('<?=$aCurso['cod_cur']?>'); return false;" class="enlaceb"><img src="../images/drop.png" alt="Eliminar" width="16" height="16" /></a></td>
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
		  <?	}	?>
		  <a href="pln_getcurso.php" title="Nuevo Curso" class="linkboton"><img src="../images/bnuevocur.png" width="100" height="24" /></a>
		  <a href="prnplanx.php" class="enlace1"><img src="../images/bexport.png" width="100" height="24" border="0" /></a>
		  <a href="prnplan.php" title="Imprimir plan de Estudios" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" /></a>
		  
<div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>