<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$aCat_pag = $_POST['rCat_pag'];	
		$vCont2 = 1;
		$sUsercoo['cod_pag'] = "";
		
		if(empty($aCat_pag))
			header("Location:pag_selectcate.php");

		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";	
		if(!empty($aCat_pag)) foreach($aCat_pag as $vCod_pag => $vCod_pag2)
		{
			if($vCont2 > 1)
				$sUsercoo['cod_pag'] .= ", ";
			$sUsercoo['cod_pag'] .= $sTarifapago[$vCod_pag]['des_pag'];
			$vCont2++;
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
<script type="text/javascript" src="../script/ggw3.js"></script>
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>
//-->
</script>
</head>

<body>
	<? include "../include/header1.php"; ?>
	<? include "../include/mreportes.php"; ?>
	
	<div class="wordcen" id="body1">
	
	<?
		$vCont = 1;
		$sEstupdf = "";
		$vPln_est = "";
		$vSem_anu = "";
		$vTotal = 0;
		$bDobles = FALSE;
		
		$vQuery = "select pa.num_mat, es.paterno, es.materno, es.nombres, pa.num_reb, pa.fch_pag, ";
		$vQuery .= "up.nombres as caja, pa.mon_pag, count(*) as canti ";
		$vQuery .= "from unapnet.pago2006 pa left join unapnet.estudiante es on pa.num_mat = es.num_mat and ";
		$vQuery .= "pa.cod_car = es.cod_car left join unapnet.usupago up on pa.cod_usu = up.cod_usu ";
		$vQuery .= "where pa.con_reb = '1' and pa.cod_car = '{$sUsercoo['cod_car']}' and ";
		$vQuery .= "pa.num_mat in (select distinct num_mat from $tEstumat) and (";
		
		$vCont2 = 1;
		if(!empty($aCat_pag)) foreach($aCat_pag as $vCod_pag => $vCod_pag2)
		{
			if($vCont2 > 1)
				$vQuery .= "or ";	
			$vQuery .= " pa.cod_pag = '$vCod_pag' ";
			$vCont2++;
		}

		$vQuery .= ") group by pa.num_mat, pa.cod_pag having canti > 1 order by es.paterno, es.materno, es.nombres, pa.num_reb ";
		if(fCountq($vQuery) > 0)
			$bDobles = TRUE;
		
		if($bDobles)
		{
	?>
	
	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Categoria [<?=ucwords(strtolower($sUsercoo['cod_pag']))?>]
          </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
		  <span class="wordi"> LOS SIGUIENTES ESTUDIANTES TIENEN RECIBOS DUPLICADOS.<br>
		  LLEVE LOS RECIBOS DE ESTOS ESTUDIANTES DONDE JUAN PARA CORREGIRLOS.<br>
		  JUAN ESTAR&Aacute; ESPER&Aacute;NDOLO EN LA OFICINA DE TECNOLOGIA INFORMATICA (OTI).<br>
		  ES LA &Uacute;NICA FORMA DE SACAR UN REPORTE SIN ERRORES.
		  </span>
		  <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
	  <tr>
		<th width="25" scope="col">N&deg;</th>
		<th width="45" scope="col">N&deg; mat</th>
		<th width="230" scope="col">Apellidos y Nombres </th>
		<th width="50" scope="col">N&deg; Rec</th>
		<th width="40" scope="col">Caja</th>
	    <th width="130" scope="col">Fecha</th>
	    <th width="40" scope="col">Monto</th>
	    <th width="15" scope="col">Cn</th>
	  </tr>
		<?	
			$cEstumat = fQuery($vQuery);
			while($aEstumat = $cEstumat->fetch_array())
			{		
				$vTotal += $aEstumat['mon_pag'];
				$sEstupdf[$aEstumat['num_mat'].$aEstumat['num_reb']]['num_est'] = $vCont;
				$sEstupdf[$aEstumat['num_mat'].$aEstumat['num_reb']]['num_mat'] = $aEstumat['num_mat'];
				$sEstupdf[$aEstumat['num_mat'].$aEstumat['num_reb']]['nombre'] = "{$aEstumat['paterno']} {$aEstumat['materno']}, {$aEstumat['nombres']}"; 		
				$sEstupdf[$aEstumat['num_mat'].$aEstumat['num_reb']]['num_reb'] = $aEstumat['num_reb'];
				$sEstupdf[$aEstumat['num_mat'].$aEstumat['num_reb']]['caja'] = $aEstumat['caja'];
				$sEstupdf[$aEstumat['num_mat'].$aEstumat['num_reb']]['fch_pag'] = fFechastd($aEstumat['fch_pag']);
				$sEstupdf[$aEstumat['num_mat'].$aEstumat['num_reb']]['mon_pag'] = $aEstumat['mon_pag'];
		?>
	  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
		<td class="wordcen"><?=$vCont?></td>
		<td class="wordcen"><?=$aEstumat['num_mat']?></td>
		<td class="wordizq">&nbsp;<?=ucwords(strtolower($aEstumat['paterno'].", ".$aEstumat['materno'].", ".$aEstumat['nombres']))?></td>
		<td class="wordizq">&nbsp;<?=$aEstumat['num_reb']?></td>
		<td class="wordizq">&nbsp;<?=ucwords(strtolower($aEstumat['caja']))?></td>
	    <td class="wordizq">&nbsp;<?=fFechastd($aEstumat['fch_pag'])?></td>
	    <td class="wordder"><?=$aEstumat['mon_pag']?>&nbsp;</td>
	    <td class="wordder"><?=$aEstumat['canti']?>&nbsp;</td>
	  </tr>
	  <?	$vCont++;	
	  		}	  ?>	
	  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
	    <td colspan="6" class="wordderb">TOTAL : </td>
	    <td class="wordder"><?=$vTotal?>&nbsp;</td>
	    <td class="wordder">&nbsp;</td>
	  </tr>
	    <?	$sUsercoo['mon_tot'] = $vTotal;	?>
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
		}
		else
		{
	?>
	
	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Categoria [<?=ucwords(strtolower($sUsercoo['cod_pag']))?>]
          </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
		  
		  <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
	  <tr>
		<th width="25" scope="col">N&deg;</th>
		<th width="45" scope="col">N&deg; mat</th>
		<th width="230" scope="col">Apellidos y Nombres </th>
		<th width="50" scope="col">N&deg; Rec</th>
		<th width="40" scope="col">Caja</th>
	    <th width="130" scope="col">Fecha</th>
	    <th width="40" scope="col">Monto</th>
	  </tr>
		<?				
			$vQuery = "select pa.num_mat, es.paterno, es.materno, es.nombres, pa.num_reb, pa.fch_pag, ";
			$vQuery .= "up.nombres as caja, pa.mon_pag ";
			$vQuery .= "from unapnet.pago2006 pa left join unapnet.estudiante es on pa.num_mat = es.num_mat and ";
			$vQuery .= "pa.cod_car = es.cod_car left join unapnet.usupago up on pa.cod_usu = up.cod_usu ";
			$vQuery .= "where pa.con_reb = '1' and pa.cod_car = '{$sUsercoo['cod_car']}' and ";
			$vQuery .= "pa.num_mat in (select distinct num_mat from $tEstumat) and (";
			
			$vCont2 = 1;
			if(!empty($aCat_pag)) foreach($aCat_pag as $vCod_pag => $vCod_pag2)
			{
				if($vCont2 > 1)
					$vQuery .= "or ";	
				$vQuery .= " pa.cod_pag = '$vCod_pag' ";
				$vCont2++;
			}

			$vQuery .= " ) order by es.paterno, es.materno, es.nombres, pa.num_reb ";
			$cEstumat = fQuery($vQuery);
			while($aEstumat = $cEstumat->fetch_array())
			{		
				$vTotal += $aEstumat['mon_pag'];
				$sEstupdf[$aEstumat['num_mat'].$aEstumat['num_reb']]['num_est'] = $vCont;
				$sEstupdf[$aEstumat['num_mat'].$aEstumat['num_reb']]['num_mat'] = $aEstumat['num_mat'];
				$sEstupdf[$aEstumat['num_mat'].$aEstumat['num_reb']]['nombre'] = "{$aEstumat['paterno']} {$aEstumat['materno']}, {$aEstumat['nombres']}"; 		
				$sEstupdf[$aEstumat['num_mat'].$aEstumat['num_reb']]['num_reb'] = $aEstumat['num_reb'];
				$sEstupdf[$aEstumat['num_mat'].$aEstumat['num_reb']]['caja'] = $aEstumat['caja'];
				$sEstupdf[$aEstumat['num_mat'].$aEstumat['num_reb']]['fch_pag'] = fFechastd($aEstumat['fch_pag']);
				$sEstupdf[$aEstumat['num_mat'].$aEstumat['num_reb']]['mon_pag'] = $aEstumat['mon_pag'];
		?>
	  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
		<td class="wordcen"><?=$vCont?></td>
		<td class="wordcen"><?=$aEstumat['num_mat']?></td>
		<td class="wordizq">&nbsp;<?=ucwords(strtolower($aEstumat['paterno'].", ".$aEstumat['materno'].", ".$aEstumat['nombres']))?></td>
		<td class="wordizq">&nbsp;<?=$aEstumat['num_reb']?></td>
		<td class="wordizq">&nbsp;<?=ucwords(strtolower($aEstumat['caja']))?></td>
	    <td class="wordizq">&nbsp;<?=fFechastd($aEstumat['fch_pag'])?></td>
	    <td class="wordder"><?=$aEstumat['mon_pag']?>&nbsp;</td>
	  </tr>
	  <?	$vCont++;	
	  		}	  ?>	
	  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
	    <td colspan="6" class="wordderb">TOTAL : </td>
	    <td class="wordder"><?=$vTotal?>&nbsp;</td>
	    </tr>
	    <?	$sUsercoo['mon_tot'] = $vTotal;	?>
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
		}
	?>
	  
	  <a href="prnrelapag.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" border="0" /></a>
	  <a href="prnrelapagx.php" class="enlace1"><img src="../images/bexport.png" width="100" height="24" border="0" /></a>
	  <a href="pag_selectcate.php" class="enlace1"><img src="../images/bviewcate.png" width="100" height="24" border="0" /></a>
	<div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>

	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>