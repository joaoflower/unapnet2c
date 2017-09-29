<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$sPDF = "";
		$sEstupdf = "";
		$sPlnesp = "";
		$sUsercoo['acta'] = "ACTAS EMITIDAS";
		
		$tActa = "unapnet.acta{$sUsercoo['ano_aca']}";
		
		$vQuery = "select distinct pln_est from $tActa where cod_car = '{$sUsercoo['cod_car']}' and ";
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' order by pln_est ";
		$cPlnesp = fQuery($vQuery);
		while($aPlnesp = $cPlnesp->fetch_array())
		{
			$sPlnesp[$aPlnesp['pln_est']]['pln_est'] = $aPlnesp['pln_est'];
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
	<? include "../include/mdatos_acad.php"; ?>
	
	<div class="wordcen" id="body1">
	
	<form action="" method="get" enctype="multipart/form-data" name="fData" id="fData">
	<?
	  	if(!empty($sPlnesp))
		foreach($sPlnesp as $vPlnesp => $aPlnesp)
		{
			
	  ?>
	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Actas emitidas del Plan : <?=$vPlnesp?> - <?=$sTiposist[$sPlan[$vPlnesp]]?></th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
		  
		 <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="20">C</th>
              <th width="270">Nombre de curso </th>
              <th width="170">Docente</th>
              <th width="70">Modalidad</th>
              <th width="40">Acta</th>
            </tr>		
			<?				
				$vCont = 1;
				$vSem_anu = "";
				$vNiv_est = "";
				$vSec_gru = "";
				$vCod_esp = "00";

				$vQuery = "select ac.cod_car, ac.ano_aca, ac.per_aca, ac.pln_est, cu.niv_est, cu.sem_anu, ac.sec_gru, ";
				$vQuery .= "cu.cod_esp, cu.tip_cur, ac.cod_cur, cu.nom_cur, ac.mod_mat, ";
				$vQuery .= "concat(do.paterno, ' ', do.materno, ', ', do.nombres) as nombre, ac.cod_act, ";
				$vQuery .= "date(ac.fch_act) as fch_act, mn.ord_not ";
				$vQuery .= "from $tActa ac left join unapnet.curso cu on ac.cod_car = cu.cod_car and ";
				$vQuery .= "ac.pln_est = cu.pln_est and ac.cod_cur = cu.cod_cur ";
				$vQuery .= "left join unapnet.docente do on ac.cod_prf = do.cod_prf ";
				$vQuery .= "left join unapnet.modnot mn on ac.mod_mat = mn.mod_not ";
				$vQuery .= "where ac.cod_car = '{$sUsercoo['cod_car']}' and ac.per_aca = '{$sUsercoo['per_aca']}' and ";
				$vQuery .= "ac.pln_est = '$vPlnesp' ";
				$vQuery .= "order by cod_car, pln_est, niv_est, sem_anu, sec_gru, cod_esp, cod_cur, ord_not, mod_mat";
				$cActas = fQuery($vQuery);
				while($aActas = $cActas->fetch_array())
				{			
					if($vSem_anu != $aActas['sem_anu'] or $vNiv_est != $aActas['niv_est'] or $vSec_gru != $aActas['sec_gru'])
					{
						$vSem_anu = $aActas['sem_anu'];
						$vNiv_est = $aActas['niv_est'];
						$vSec_gru = $aActas['sec_gru'];		
			?>	
			
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)"> 
              <td>&nbsp;</td>
              <td colspan="4" class="wordizqb">Nivel : <?=$sNivel[$aActas['niv_est']]?> - Semestre : <?=$sSemestre[$aActas['sem_anu']]?> - Grupo : <?=$sGrupo[$aActas['sec_gru']]?></td>
            </tr>
            <?
					}
					if($vCod_esp != $aActas['cod_esp'])
					{
						$vCod_esp = $aActas['cod_esp'];
						if($vCod_esp != '00')
						{
			?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)">
              <td>&nbsp;</td>
              <td colspan="4" class="wordizqb">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Menci&oacute;n: <?=$sEspecial[$aActas['pln_est'].$aActas['cod_esp']]['esp_nom']?></td>
            </tr>
			<?
						}
					}
					
				$sPDF[$aActas['pln_est'].$aActas['cod_cur'].$aActas['sec_gru'].$aActas['mod_mat']]['pln_est'] = $aActas['pln_est'];
				$sPDF[$aActas['pln_est'].$aActas['cod_cur'].$aActas['sec_gru'].$aActas['mod_mat']]['cod_cur'] = $aActas['cod_cur'];
				$sPDF[$aActas['pln_est'].$aActas['cod_cur'].$aActas['sec_gru'].$aActas['mod_mat']]['niv_est'] = $aActas['niv_est'];
				$sPDF[$aActas['pln_est'].$aActas['cod_cur'].$aActas['sec_gru'].$aActas['mod_mat']]['sem_anu'] = $aActas['sem_anu'];
				$sPDF[$aActas['pln_est'].$aActas['cod_cur'].$aActas['sec_gru'].$aActas['mod_mat']]['cod_esp'] = $aActas['cod_esp'];
				$sPDF[$aActas['pln_est'].$aActas['cod_cur'].$aActas['sec_gru'].$aActas['mod_mat']]['nom_cur'] = $aActas['nom_cur'];
				$sPDF[$aActas['pln_est'].$aActas['cod_cur'].$aActas['sec_gru'].$aActas['mod_mat']]['sec_gru'] = $aActas['sec_gru'];
				$sPDF[$aActas['pln_est'].$aActas['cod_cur'].$aActas['sec_gru'].$aActas['mod_mat']]['mod_mat'] = $aActas['mod_mat'];
				$sPDF[$aActas['pln_est'].$aActas['cod_cur'].$aActas['sec_gru'].$aActas['mod_mat']]['nombre'] = $aActas['nombre'];
				$sPDF[$aActas['pln_est'].$aActas['cod_cur'].$aActas['sec_gru'].$aActas['mod_mat']]['cod_act'] = $aActas['cod_act'];
				$sPDF[$aActas['pln_est'].$aActas['cod_cur'].$aActas['sec_gru'].$aActas['mod_mat']]['fch_act'] = fFechad($aActas['fch_act']);
					
			?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)">
              <td class="wordcen"><?=$aActas['cod_cur']?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aActas['nom_cur']))?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aActas['nombre']))?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sModnot[$aActas['mod_mat']]))?></td>
              <td class="wordcen"><?=$aActas['cod_act']?></td>
            </tr>
			<?
				$vCont++;	}
			?>			
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
	  <?	}	?>	  
	</form>
	
	<a href="prnactaemitida.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" border="0" /></a>
	<a href="act_selectrep.php" title="Seleccionar reporte de Acta" class="linkboton"><img src="../images/bviewacta.png" width="100" height="24" border="0" /></a>
	  <div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
	
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>