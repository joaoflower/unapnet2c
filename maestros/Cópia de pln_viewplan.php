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
			$vPln_est = $sUsercoo['pln_est'];
			//$sUsercoo['pln_est'] = $vPln_est;
			
			$vQuery = "Select niv_est, sem_anu from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '$vPln_est' ";
			$vQuery .= "order by niv_est, sem_anu";
			$cNiv_sem = fQuery($vQuery);
			while($aNiv_sem = $cNiv_sem->fetch_array())
			{
				$sNiv_sem[$aNiv_sem['niv_est'].$aNiv_sem['sem_anu']]['niv_est'] = $aNiv_sem['niv_est'];
				$sNiv_sem[$aNiv_sem['niv_est'].$aNiv_sem['sem_anu']]['sem_anu'] = $aNiv_sem['sem_anu'];
			}

			$vQuery = "Select pln_est, cod_cur, cur_pre from unapnet.requ where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '$vPln_est' order by cod_cur";
			$cRequ = fQuery($vQuery);
			while($aRequ = $cRequ->fetch_array())
			{
				if(!empty($sRequ[$aRequ['cod_cur']]))
					$sRequ[$aRequ['cod_cur']] .= ", {$aRequ['pln_est']}-{$aRequ['cur_pre']}";
				else
					$sRequ[$aRequ['cod_cur']] = "{$aRequ['pln_est']}-{$aRequ['cur_pre']}";
			}
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Un@p.Net2</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<script language="JavaScript" src="../script/function.js"></script>
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>	
//-->
</script>
</head>

<body >
	<? include "../include/header1.php"; ?>
	<? include "../include/mmaestros.php"; ?>
	
	<div class="wordcen" id="body1">
		<form action="pln_gettipo.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	      <table border="0" cellpadding="0" cellspacing="0" id="ventana">
            <tr>
              <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
              <th align="center" background="../images/ventana_r1_c2.jpg" >Planes de Estudio </th>
              <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
            </tr>
            <tr>
              <td background="../images/ventana_r2_c1.jpg"></td>
              <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                  <tr>
                    <td width="100" class="wordder">Plan de Estudios : </td>
                    <td width="100" class="wordizqb"><?=$vPln_est?> - <?=$sTiposist[$sPlan[$vPln_est]]?></td>
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
              <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                  <tr>
                    <th width="45" scope="col">C&oacute;d</th>
                    <th width="40" scope="col">Cat.</th>
                    <th width="280" scope="col">Curso</th>
                    <th width="20" scope="col">Es</th>
                    <th width="20" scope="col">HT</th>
                    <th width="20" scope="col">HP</th>
                    <th width="20" scope="col">TH</th>
                    <th width="30" scope="col">Crd</th>
                    <th width="20" scope="col">TC</th>
                    <th width="70" scope="col">Requ</th>
                  </tr>
                  <? 	$vCont = 1;	
				  		$vSub_tit = "";
				  		$vQuery = "Select pln_est,cod_cur,cod_cat,nom_cur, cod_esp, hrs_teo, hrs_pra, hrs_tot, crd_cur, tip_cur ";
						$vQuery .= "from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '$vPln_est' and ";
						$vQuery .= "niv_est = '{$vNiv_sem['niv_est']}' and sem_anu = '{$vNiv_sem['sem_anu']}' ";
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
									<td colspan="2" class="wordcen">&nbsp;</td>
									<td colspan="8" class="wordizqb"><?=$vSub_tit?></td>
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
									<td colspan="2" class="wordcen">&nbsp;</td>
									<td colspan="8" class="wordizqb">Mensi&oacute;n: <?=ucwords(strtolower($sEspecial[$sUsercoo['pln_est'].$vCod_esp]['esp_nom']))?></td>
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
								$sPDF[$vContador]['cur_pre'] = $sRequ[$aCurso['cod_cur']]; 
							else 
								$sPDF[$vContador]['cur_pre'] = "NINGUNO";
							$vContador++;
					?>                  
				  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                    <td class="wordcen"><a href="" ><?=$aCurso['pln_est'].'-'.$aCurso['cod_cur']?></a></td>
                    <td class="wordcen"><?=$aCurso['cod_cat']?></td>
                    <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCurso['nom_cur']))?></td>
                    <td class="wordcen"><?=$aCurso['cod_esp']?></td>
                    <td class="wordcen"><?=$aCurso['hrs_teo']?></td>
                    <td class="wordcen"><?=$aCurso['hrs_pra']?></td>
                    <td class="wordcen"><?=$aCurso['hrs_tot']?></td>
                    <td class="wordcen"><?=$aCurso['crd_cur']?></td>
                    <td class="wordcen"><?=$aCurso['tip_cur']?></td>
                    <td class="wordizq"><? if(!empty($sRequ[$aCurso['cod_cur']])) echo $sRequ[$aCurso['cod_cur']]; else echo "Ninguno";	?></td>
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
          <input name="Submit" type="submit" class="boton" value="Modificar tipo de curso">
          <a href="prnplan.php" class="enlace1" title="Imprimir Historial de Notas">&lt; Imprimir &gt;</a>        
	  </form>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>