<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	

	if(fsafetyselcar2())
	{
		$vTot_mat = 0;
		$sPDF = "";
		$sEstupdf = "";		
		$aTipsist = "";
		
		if(!empty($sAcceso))
		foreach($sAcceso as $vCod_car => $aAcceso) 				
		{				
			/*if($vCod_car <= '56' and $vCod_car != '19' and $vCod_car != '38' and $vCod_car != '47' and $vCod_car != '50' and $vCod_car != '51' and $vCod_car != '53' and $vCod_car != '62' and $vCod_car != '63' and $vCod_car != '64' and $vCod_car != '70' and $vCod_car != '73' and $vCod_car != '74' and $vCod_car != '75' and $vCod_car != '66')*/
			if(($vCod_car <= '36' and $vCod_car != '19') or $vCod_car == '56')
			{
				$tEstumat = "unapnet.estumat".$vCod_car.$sUsercoo['ano_aca'];	
				$vQuery = "select distinct pl.tip_sist ";
				$vQuery .= "from $tEstumat em left join unapnet.plan pl on em.cod_car = pl.cod_car and ";
				$vQuery .= "em.pln_est = pl.pln_est where em.per_aca = '{$sUsercoo['per_aca']}' ";
				$cTipsis = fQuery($vQuery);
				while($aTipsis = $cTipsis->fetch_array())
				{
					$aTipsist[$aTipsis['tip_sist']] = $aTipsis['tip_sist'];
				}
				$cTipsis->close();
			}
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
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>	

//-->
</script>
</head>

<body >
	<? include "../include/header1.php"; ?>
	<? include "../include/mreportes.php"; ?>
	
	<div class="wordcen" id="body1">
	  <form action="" method="post" enctype="multipart/form-data" name="fCambio" id="fCambio"> 

<?
	asort($aTipsist);
	if(!empty($aTipsist))
	foreach($aTipsist as $vTip_sist => $vTip_sist2) 
	{
		if($vTip_sist == '1')
		{
?>

	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Resumen de matriculados por Niveles [<?=$sTiposist[$vTip_sist]?>] </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
	  
		 <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="20">C</th>
              <th width="190">Escuela Profesional </th>
              <th width="20">SN</th>
              <th width="20">01</th>
              <th width="20">02</th>
              <th width="20">03</th>
              <th width="20">04</th>
              <th width="20">05</th>
              <th width="20">06</th>
              <th width="20">07</th>
              <th width="35">Tot</th>
            </tr>
			<?				
				$vCont = 1;
				$vTot_mat = 0;
				
				$sCanestu = "";
				$vCantimod = "";				
				
				$vCantimod['ss'] = 0;
				$vCantimod['01'] = 0;
				$vCantimod['02'] = 0;
				$vCantimod['03'] = 0;
				$vCantimod['04'] = 0;
				$vCantimod['05'] = 0;
				$vCantimod['06'] = 0;
				$vCantimod['07'] = 0;
				$vCantimod['08'] = 0;
				$vCantimod['09'] = 0;
				$vCantimod['10'] = 0;
				$vCantimod['11'] = 0;
				$vCantimod['12'] = 0;
				
				if(!empty($sAcceso))
				foreach($sAcceso as $vCod_car => $aAcceso) 				
				{				
					//if($vCod_car <= '56' and $vCod_car != '19' and $vCod_car != '38' and $vCod_car != '47' and $vCod_car != '50' and $vCod_car != '51' and $vCod_car != '53' and $vCod_car != '62' and $vCod_car != '63' and $vCod_car != '64')
					if(($vCod_car <= '36' and $vCod_car != '19') or $vCod_car == '56')
					{
						$sCanestu = "";
						
						$tEstumat = "unapnet.estumat".$vCod_car.$sUsercoo['ano_aca'];
	
						$vQuery = "select pl.tip_sist, em.niv_est, count(*) as canti ";
						$vQuery .= "from $tEstumat em left join unapnet.plan pl on em.cod_car = pl.cod_car and ";
						$vQuery .= "em.pln_est = pl.pln_est ";
						$vQuery .= "where em.per_aca = '{$sUsercoo['per_aca']}' and pl.tip_sist = '$vTip_sist' ";
						$vQuery .= "group by tip_sist, niv_est";
			
						$cModcan = fQuery($vQuery);
						while($aModcan = $cModcan->fetch_array())
						{
							if(empty($aModcan['niv_est']))
								$sCanestu['ss'] = $aModcan['canti'];
							else							
								$sCanestu[$aModcan['niv_est']] = $aModcan['canti'];
						}
						$vTot_mat += $sCanestu['ss']+$sCanestu['01']+$sCanestu['02']+$sCanestu['03']+$sCanestu['04']+$sCanestu['05']+$sCanestu['06']+$sCanestu['07']+$sCanestu['08']+$sCanestu['09']+$sCanestu['10']+$sCanestu['11']+$sCanestu['12'];
						
						$vCantimod['ss'] += $sCanestu['ss'];
						$vCantimod['01'] += $sCanestu['01'];						
						$vCantimod['02'] += $sCanestu['02'];
						$vCantimod['03'] += $sCanestu['03'];
						$vCantimod['04'] += $sCanestu['04'];
						$vCantimod['05'] += $sCanestu['05'];
						$vCantimod['06'] += $sCanestu['06'];
						$vCantimod['07'] += $sCanestu['07'];
						$vCantimod['08'] += $sCanestu['08'];						
						$vCantimod['09'] += $sCanestu['09'];
						$vCantimod['10'] += $sCanestu['10'];
						$vCantimod['11'] += $sCanestu['11'];
						$vCantimod['12'] += $sCanestu['12'];
	
						$sPDF[$vCod_car.$vTip_sist]['cod_car'] = $vCod_car;
						$sPDF[$vCod_car.$vTip_sist]['tip_sist'] = $vTip_sist;
						$sPDF[$vCod_car.$vTip_sist]['ss'] = $sCanestu['ss'];
						$sPDF[$vCod_car.$vTip_sist]['01'] = $sCanestu['01'];						
						$sPDF[$vCod_car.$vTip_sist]['02'] = $sCanestu['02'];
						$sPDF[$vCod_car.$vTip_sist]['03'] = $sCanestu['03'];
						$sPDF[$vCod_car.$vTip_sist]['04'] = $sCanestu['04'];
						$sPDF[$vCod_car.$vTip_sist]['05'] = $sCanestu['05'];
						$sPDF[$vCod_car.$vTip_sist]['06'] = $sCanestu['06'];
						$sPDF[$vCod_car.$vTip_sist]['07'] = $sCanestu['07'];
						$sPDF[$vCod_car.$vTip_sist]['08'] = $sCanestu['08'];
						$sPDF[$vCod_car.$vTip_sist]['09'] = $sCanestu['09'];
						$sPDF[$vCod_car.$vTip_sist]['10'] = $sCanestu['10'];
						$sPDF[$vCod_car.$vTip_sist]['11'] = $sCanestu['11'];
						$sPDF[$vCod_car.$vTip_sist]['12'] = $sCanestu['12'];
						$sPDF[$vCod_car.$vTip_sist]['total'] = $sCanestu['ss']+$sCanestu['01']+$sCanestu['02']+$sCanestu['03']+$sCanestu['04']+$sCanestu['05']+$sCanestu['06']+$sCanestu['07']+$sCanestu['08']+$sCanestu['09']+$sCanestu['10']+$sCanestu['11']+$sCanestu['12'];
				?>						
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordcen"><?=$vCod_car?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sCarrera[$vCod_car]))?></td>
              <td class="wordder"><?=$sCanestu['ss']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['01']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['02']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['03']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['04']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['05']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['06']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['07']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['ss']+$sCanestu['01']+$sCanestu['02']+$sCanestu['03']+$sCanestu['04']+$sCanestu['05']+$sCanestu['06']+$sCanestu['07']+$sCanestu['08']+$sCanestu['09']+$sCanestu['10']+$sCanestu['11']+$sCanestu['12']?>&nbsp;</td>
            </tr>
			<?	$vCont++;	}	}	?>	
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;</td>
              <td class="wordizq">&nbsp;</td>
              <th>SN</th>
              <th>01</th>
              <th>02</th>
              <th>03</th>
              <th>04</th>
              <th>05</th>
              <th>06</th>
              <th>07</th>
              <th>Tot</th>
            </tr>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;</td>
              <td class="wordderb">TOTAL : </td>
              <td class="wordder"><?=$vCantimod['ss']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['01']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['02']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['03']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['04']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['05']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['06']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['07']?>&nbsp;</td>
              <td class="wordder"><?=$vTot_mat?>&nbsp;</td>
            </tr>
          </table>
			  
		  </td>
          <td background="../images/ventana_r2_c4.jpg"></td>
        </tr>
        <tr>
          <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
          <td background="../images/ventana_r4_c2.jpg"></td>
          <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
        </tr>
      </table>	 
	    <?	
			$sEstupdf['ss'.$vTip_sist] = $vCantimod['ss'];
			$sEstupdf['01'.$vTip_sist] = $vCantimod['01'];			
			$sEstupdf['02'.$vTip_sist] = $vCantimod['02'];
			$sEstupdf['03'.$vTip_sist] = $vCantimod['03'];
			$sEstupdf['04'.$vTip_sist] = $vCantimod['04'];
			$sEstupdf['05'.$vTip_sist] = $vCantimod['05'];
			$sEstupdf['06'.$vTip_sist] = $vCantimod['06'];
			$sEstupdf['07'.$vTip_sist] = $vCantimod['07'];
			$sEstupdf['08'.$vTip_sist] = $vCantimod['08'];
			$sEstupdf['09'.$vTip_sist] = $vCantimod['09'];
			$sEstupdf['10'.$vTip_sist] = $vCantimod['10'];
			$sEstupdf['11'.$vTip_sist] = $vCantimod['11'];
			$sEstupdf['12'.$vTip_sist] = $vCantimod['12'];
			$sEstupdf['total'.$vTip_sist] = $vCantimod['ss']+$vCantimod['01']+$vCantimod['02']+$vCantimod['03']+$vCantimod['04']+$vCantimod['05']+$vCantimod['06']+$vCantimod['07']+$vCantimod['08']+$vCantimod['09']+$vCantimod['10']+$vCantimod['11']+$vCantimod['12'];
		
			?>	
		<a href="prnresmatriniv.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" border="0" /></a>		

<?
		}
		else	//if($vTipsist == '2')
		{
		
?>		
		
			  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Resumen de matriculados por Seemstres [<?=$sTiposist[$vTip_sist]?>]</th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
	  
		 <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="20">C</th>
              <th width="190">Escuela Profesional </th>
              <th width="20">SS</th>
              <th width="20">01</th>
              <th width="20">02</th>
              <th width="20">03</th>
              <th width="20">04</th>
              <th width="20">05</th>
              <th width="20">06</th>
              <th width="20">07</th>
              <th width="20">08</th>
              <th width="20">09</th>
              <th width="20">10</th>
              <th width="20">11</th>
              <th width="20">12</th>
              <th width="35">Tot</th>
            </tr>
			<?				
				$vCont = 1;
				$vTot_mat = 0;
				
				$sCanestu = "";
				$vCantimod = "";
				$vCantimod['ss'] = 0;
				$vCantimod['01'] = 0;
				$vCantimod['02'] = 0;
				$vCantimod['03'] = 0;
				$vCantimod['04'] = 0;
				$vCantimod['05'] = 0;
				$vCantimod['06'] = 0;
				$vCantimod['07'] = 0;
				$vCantimod['08'] = 0;
				$vCantimod['09'] = 0;
				$vCantimod['10'] = 0;
				$vCantimod['11'] = 0;
				$vCantimod['12'] = 0;
				
				if(!empty($sAcceso))
				foreach($sAcceso as $vCod_car => $aAcceso) 				
				{				
					//if($vCod_car < '65' and $vCod_car != '19' and $vCod_car != '38' and $vCod_car != '47' and $vCod_car != '50' and $vCod_car != '51' and $vCod_car != '53' and $vCod_car != '62' and $vCod_car != '63' and $vCod_car != '64')
					if(($vCod_car <= '36' and $vCod_car != '19') or $vCod_car == '56')
					{
						$sCanestu = "";
						
						$tEstumat = "unapnet.estumat".$vCod_car.$sUsercoo['ano_aca'];
	
						$vQuery = "select pl.tip_sist, em.niv_est, count(*) as canti ";
						$vQuery .= "from $tEstumat em left join unapnet.plan pl on em.cod_car = pl.cod_car and ";
						$vQuery .= "em.pln_est = pl.pln_est ";
						$vQuery .= "where em.per_aca = '{$sUsercoo['per_aca']}' and pl.tip_sist = '$vTip_sist' ";
						$vQuery .= "group by tip_sist, niv_est";
			
						$cModcan = fQuery($vQuery);
						while($aModcan = $cModcan->fetch_array())
						{
							if(empty($aModcan['niv_est']))
								$sCanestu['ss'] = $aModcan['canti'];
							else							
								$sCanestu[$aModcan['niv_est']] = $aModcan['canti'];
						}
						$cModcan->close();
						$vTot_mat += $sCanestu['ss']+$sCanestu['01']+$sCanestu['02']+$sCanestu['03']+$sCanestu['04']+$sCanestu['05']+$sCanestu['06']+$sCanestu['07']+$sCanestu['08']+$sCanestu['09']+$sCanestu['10']+$sCanestu['11']+$sCanestu['12'];
						
						$vCantimod['ss'] += $sCanestu['ss'];
						$vCantimod['01'] += $sCanestu['01'];						
						$vCantimod['02'] += $sCanestu['02'];
						$vCantimod['03'] += $sCanestu['03'];
						$vCantimod['04'] += $sCanestu['04'];
						$vCantimod['05'] += $sCanestu['05'];
						$vCantimod['06'] += $sCanestu['06'];
						$vCantimod['07'] += $sCanestu['07'];
						$vCantimod['08'] += $sCanestu['08'];						
						$vCantimod['09'] += $sCanestu['09'];
						$vCantimod['10'] += $sCanestu['10'];
						$vCantimod['11'] += $sCanestu['11'];
						$vCantimod['12'] += $sCanestu['12'];
	
						$sPDF[$vCod_car.$vTip_sist]['cod_car'] = $vCod_car;
						$sPDF[$vCod_car.$vTip_sist]['tip_sist'] = $vTip_sist;
						$sPDF[$vCod_car.$vTip_sist]['ss'] = $sCanestu['ss'];
						$sPDF[$vCod_car.$vTip_sist]['01'] = $sCanestu['01'];						
						$sPDF[$vCod_car.$vTip_sist]['02'] = $sCanestu['02'];
						$sPDF[$vCod_car.$vTip_sist]['03'] = $sCanestu['03'];
						$sPDF[$vCod_car.$vTip_sist]['04'] = $sCanestu['04'];
						$sPDF[$vCod_car.$vTip_sist]['05'] = $sCanestu['05'];
						$sPDF[$vCod_car.$vTip_sist]['06'] = $sCanestu['06'];
						$sPDF[$vCod_car.$vTip_sist]['07'] = $sCanestu['07'];
						$sPDF[$vCod_car.$vTip_sist]['08'] = $sCanestu['08'];
						$sPDF[$vCod_car.$vTip_sist]['09'] = $sCanestu['09'];
						$sPDF[$vCod_car.$vTip_sist]['10'] = $sCanestu['10'];
						$sPDF[$vCod_car.$vTip_sist]['11'] = $sCanestu['11'];
						$sPDF[$vCod_car.$vTip_sist]['12'] = $sCanestu['12'];
						$sPDF[$vCod_car.$vTip_sist]['total'] = $sCanestu['ss']+$sCanestu['01']+$sCanestu['02']+$sCanestu['03']+$sCanestu['04']+$sCanestu['05']+$sCanestu['06']+$sCanestu['07']+$sCanestu['08']+$sCanestu['09']+$sCanestu['10']+$sCanestu['11']+$sCanestu['12'];
				?>						
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordcen"><?=$vCod_car?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sCarrera[$vCod_car]))?></td>
              <td class="wordder"><?=$sCanestu['ss']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['01']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['02']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['03']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['04']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['05']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['06']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['07']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['08']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['09']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['10']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['11']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['12']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['ss']+$sCanestu['01']+$sCanestu['02']+$sCanestu['03']+$sCanestu['04']+$sCanestu['05']+$sCanestu['06']+$sCanestu['07']+$sCanestu['08']+$sCanestu['09']+$sCanestu['10']+$sCanestu['11']+$sCanestu['12']?>&nbsp;</td>
            </tr>
			<?	$vCont++;	}	}	?>	
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;</td>
              <td class="wordizq">&nbsp;</td>
              <th>SS</th>
              <th>01</th>
              <th>02</th>
              <th>03</th>
              <th>04</th>
              <th>05</th>
              <th>06</th>
              <th>07</th>
              <th>08</th>
              <th>09</th>
              <th>10</th>
              <th>11</th>
              <th>12</th>
              <th>Tot</th>
            </tr>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;</td>
              <td class="wordderb">TOTAL : </td>
              <td class="wordder"><?=$vCantimod['ss']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['01']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['02']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['03']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['04']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['05']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['06']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['07']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['08']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['09']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['10']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['11']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['12']?>&nbsp;</td>
              <td class="wordder"><?=$vTot_mat?>&nbsp;</td>
            </tr>
          </table>
			  
		  </td>
          <td background="../images/ventana_r2_c4.jpg"></td>
        </tr>
        <tr>
          <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
          <td background="../images/ventana_r4_c2.jpg"></td>
          <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
        </tr>
      </table>	 
	    <?	
			$sEstupdf['ss'.$vTip_sist] = $vCantimod['ss'];
			$sEstupdf['01'.$vTip_sist] = $vCantimod['01'];			
			$sEstupdf['02'.$vTip_sist] = $vCantimod['02'];
			$sEstupdf['03'.$vTip_sist] = $vCantimod['03'];
			$sEstupdf['04'.$vTip_sist] = $vCantimod['04'];
			$sEstupdf['05'.$vTip_sist] = $vCantimod['05'];
			$sEstupdf['06'.$vTip_sist] = $vCantimod['06'];
			$sEstupdf['07'.$vTip_sist] = $vCantimod['07'];
			$sEstupdf['08'.$vTip_sist] = $vCantimod['08'];
			$sEstupdf['09'.$vTip_sist] = $vCantimod['09'];
			$sEstupdf['10'.$vTip_sist] = $vCantimod['10'];
			$sEstupdf['11'.$vTip_sist] = $vCantimod['11'];
			$sEstupdf['12'.$vTip_sist] = $vCantimod['12'];
			$sEstupdf['total'.$vTip_sist] = $vCantimod['ss']+$vCantimod['01']+$vCantimod['02']+$vCantimod['03']+$vCantimod['04']+$vCantimod['05']+$vCantimod['06']+$vCantimod['07']+$vCantimod['08']+$vCantimod['09']+$vCantimod['10']+$vCantimod['11']+$vCantimod['12'];
		
			?>	
		<a href="prnresmatrisem.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" border="0" /></a>		
		
<?
		}
	}
?>
		
	  </form>
	  
	  <div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
	</div>
	
	<? include "../include/pie1.php"; ?>

</body>
</html>