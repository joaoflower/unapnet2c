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
			$vQuery = "select cod_cur, not_cur, mod_not, cod_act, ano_aca, per_aca from $tNota ";
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
			}
			
			$sNiv_sem = "";
			$sRequ = "";
			
			$vQuery = "Select niv_est, sem_anu from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and ";
			$vQuery .= "pln_est = '{$sEstudia['pln_est']}' order by niv_est, sem_anu";
			$cNiv_sem = fQuery($vQuery);
			while($aNiv_sem = $cNiv_sem->fetch_array())
			{
				$sNiv_sem[$aNiv_sem['niv_est'].$aNiv_sem['sem_anu']]['niv_est'] = $aNiv_sem['niv_est'];
				$sNiv_sem[$aNiv_sem['niv_est'].$aNiv_sem['sem_anu']]['sem_anu'] = $aNiv_sem['sem_anu'];
			}

			$vQuery = "Select max(cod_cur) as cod_cur from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and ";
			$vQuery .= "pln_est = '{$sEstudia['pln_est']}' ";
			$cMax = fQuery($vQuery);
			if($aMax = $cMax->fetch_array())
			{
				$aMax['cod_cur']++;
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

<?
	$vCont = 1;
	//--------------------------------------------------------------------
	$vQuery = "select sum(cu.crd_cur) as all_crd from $tNota no left join unapnet.curso cu on ";
	$vQuery .= "no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
	$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and no.pln_est = '{$sEstudia['pln_est']}' and ";
	$vQuery .= "no.cod_car = '{$sUsercoo['cod_car']}' and no.not_cur > 10";
	$cNotall = fQuery($vQuery);	
	if($aNotall = $cNotall->fetch_array())
		$sEstudia['all_crd'] = $aNotall['all_crd'];			
	$sEstudia['sem_anu'] = fSemestudia($sEstudia['pln_est'], $sEstudia['all_crd'] + $sEstudia['max_crd']);
?>
<table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Promedios </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th width="80" scope="col">Categoria</th>
                  <th width="60" scope="col">Cantidad</th>
                </tr>
                <tr class="celinpar" >
                  <td class="wordder">Cr&eacute;ditos : </td>
                  <td class="wordderb"><?=$sEstudia['all_crd']?>&nbsp;</td>
                </tr>
                <tr class="celpar" >
                  <td class="wordder">Semestre : </td>
                  <td class="wordderb"><?=$sSemestre[$sEstudia['sem_anu']]?>&nbsp;</td>
              </tr>
            </table></td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>

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
                    <th width="40" scope="col">C&oacute;d</th>
                    <th width="280" scope="col">Curso</th>
                    <th width="20" scope="col">Es</th>
                    <th width="20" scope="col">Not</th>
                    <th width="80" scope="col">Mod</th>
                    <th width="30" scope="col">Crd</th>
                    <th width="40" scope="col">Acta</th>
                    <th width="55" scope="col">Periodo</th>
                  </tr>
                  <? 	$vCont = 1;	
				  		$vSub_tit = "";
				  		$vQuery = "Select pln_est, cod_cur , cod_cat, nom_cur, cod_esp, crd_cur, tip_cur ";
						$vQuery .= "from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and ";
						$vQuery .= "pln_est = '{$sEstudia['pln_est']}' and ";
						$vQuery .= "niv_est = '{$vNiv_sem['niv_est']}' and sem_anu = '{$vNiv_sem['sem_anu']}' ";
						
						if($bUltmat)
						{
							$vQuery .= "and (cod_esp = '00' or cod_esp = '{$sEstudia['cod_esp']}') ";
						}
						
						$vQuery .= "order by tip_cur, cod_esp, cod_cur ";
						$cCurso = fQuery($vQuery);
						while($aCurso = $cCurso->fetch_array())
						{ 
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
									<td colspan="7" class="wordizqb"><?=$vSub_tit?></td>
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
									$sPDF[$vContador]['nom_cur'] = "MENSION: ".$sEspecial[$sEstudia['pln_est'].$vCod_esp]['esp_nom'];
									$vContador++;
								?>
								  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\""; $vCont++;	?>>
									<td class="wordcen">&nbsp;</td>
									<td colspan="7" class="wordizqb">Mensi&oacute;n: <?=ucwords(strtolower($sEspecial[$sEstudia['pln_est'].$vCod_esp]['esp_nom']))?></td>
								  </tr>
								<?								
								}
							}
							$sPDF[$vContador]['cur_pln'] = $aCurso['pln_est']."-".$aCurso['cod_cur'];
							$sPDF[$vContador]['nom_cur'] = $aCurso['nom_cur'];
							$sPDF[$vContador]['cod_esp'] = $aCurso['cod_esp'];
							$sPDF[$vContador]['crd_cur'] = $aCurso['crd_cur'];
							$sPDF[$vContador]['not_cur'] = $sNotapro[$aCurso['cod_cur']]['not_cur'];
							$sPDF[$vContador]['mod_not'] = $sNotapro[$aCurso['cod_cur']]['mod_not'];
							$sPDF[$vContador]['cod_act'] = $sNotapro[$aCurso['cod_cur']]['cod_act'];
							$sPDF[$vContador]['ano_aca'] = $sNotapro[$aCurso['cod_cur']]['ano_aca'];
							$sPDF[$vContador]['per_aca'] = $sNotapro[$aCurso['cod_cur']]['per_aca'];							
							
							$vContador++;
					?>                  
				  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                    <td class="wordcen"><?=$aCurso['pln_est']?>-<?=$aCurso['cod_cur']?></td>
                    <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCurso['nom_cur']))?></td>
                    <td class="wordcen"><?=$aCurso['cod_esp']?></td>
                    <td class="wordder"><span class ="<?	if($sNotapro[$aCurso['cod_cur']]['not_cur'] < 11) echo "notades"; else echo "notapro" ?>"><?=$sNotapro[$aCurso['cod_cur']]['not_cur']?></span>&nbsp;</td>
                    <td class="wordizq">&nbsp;<?=ucwords(strtolower($sModnot[$sNotapro[$aCurso['cod_cur']]['mod_not']]))?>&nbsp;</td>
                    <td class="wordcen"><?=$aCurso['crd_cur']?></td>
                    <td class="wordcen"><?=$sNotapro[$aCurso['cod_cur']]['cod_act']?></td>
                    <td class="wordizq">&nbsp;<?=$sNotapro[$aCurso['cod_cur']]['ano_aca']?>-<?=$sPeriodo[$sNotapro[$aCurso['cod_cur']]['per_aca']]['abr_per']?>&nbsp;</td>
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
		  <a href="prnnotaplan.php" title="Imprimir plan de Estudios" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" /></a>
		  
<div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>