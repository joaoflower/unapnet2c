<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$sPDF = "";
		$sEstupdf = "";
		$sPlnesp = "";
		$aActaemi = "";
		$aDocente = "";
		$sUsercoo['acta'] = "ACTAS NO EMITIDAS";
		
		$tActa = "unapnet.acta{$sUsercoo['ano_aca']}";
		$tCarga = "unapnet.carga{$sUsercoo['ano_aca']}";
		$tApla = "unapnet.apla{$sUsercoo['ano_aca']}";
		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		
		$vQuery = "select distinct pln_est from $tEstumat where cod_car = '{$sUsercoo['cod_car']}' and ";
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' order by pln_est ";
		$cPlnesp = fQuery($vQuery);
		while($aPlnesp = $cPlnesp->fetch_array())
		{
			$sPlnesp[$aPlnesp['pln_est']]['pln_est'] = $aPlnesp['pln_est'];
		}				
		
		$vQuery = "select cod_car, ano_aca, per_aca, pln_est, sec_gru, cod_cur, mod_mat ";
		$vQuery .= "from $tActa ";
		$vQuery .= "where cod_car = '{$sUsercoo['cod_car']}' and per_aca = '{$sUsercoo['per_aca']}' ";
		$cActas = fQuery($vQuery);
		while($aActas = $cActas->fetch_array())
		{
			$aActaemi[$aActas['pln_est'].$aActas['sec_gru'].$aActas['cod_cur'].$aActas['mod_mat']] = TRUE;
		}
		
		$vQuery = "select ca.cod_car, ca.ano_aca, ca.per_aca, ca.pln_est, ca.sec_gru, ca.cod_cur, ca.mod_mat,  ";
		$vQuery .= "concat(do.paterno, ' ', do.materno, ', ', do.nombres) as nombre ";
		$vQuery .= "from $tCarga ca left join unapnet.docente do on ca.cod_prf = do.cod_prf ";
		$vQuery .= "where ca.cod_car = '{$sUsercoo['cod_car']}' and per_aca = '{$sUsercoo['per_aca']}' ";
		$cDocen = fQuery($vQuery);
		while($aDocen = $cDocen->fetch_array())
		{
			$aDocente[$aDocen['pln_est'].$aDocen['sec_gru'].$aDocen['cod_cur'].$aDocen['mod_mat']] = $aDocen['nombre'];
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
          <th align="center" background="../images/ventana_r1_c2.jpg" >Actas NO emitidas del Plan : <?=$vPlnesp?> - <?=$sTiposist[$sPlan[$vPlnesp]]?></th>
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

				$vQuery = "(select distinct cm.cod_car, cm.ano_aca, cm.per_aca, cm.pln_est, cu.niv_est, cu.sem_anu, ";
				$vQuery .= "cm.sec_gru, cu.cod_esp, cm.cod_cur, cu.nom_cur, mm.mod_act as mod_mat ";
				$vQuery .= "from $tCurmat cm left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
				$vQuery .= "left join unapnet.curso cu on cm.cod_car = cu.cod_car and cm.pln_est = cu.pln_est and ";
				$vQuery .= "cm.cod_cur = cu.cod_cur ";
				$vQuery .= "where cm.cod_car = '{$sUsercoo['cod_car']}' and cm.per_aca = '{$sUsercoo['per_aca']}' and ";
				$vQuery .= "cm.pln_est = '$vPlnesp') union ";
				$vQuery .= "(select distinct ap.cod_car, ap.ano_aca, ap.per_aca, ap.pln_est, cu.niv_est, cu.sem_anu, ";
				$vQuery .= "ap.sec_gru, cu.cod_esp, ap.cod_cur, cu.nom_cur, ap.mod_mat ";
				$vQuery .= "from $tApla ap left join unapnet.curso cu on ap.cod_car = cu.cod_car and ";
				$vQuery .= "ap.pln_est = cu.pln_est and ap.cod_cur = cu.cod_cur ";
				$vQuery .= "where ap.cod_car = '{$sUsercoo['cod_car']}' and ap.per_aca = '{$sUsercoo['per_aca']}' and ";
				$vQuery .= "ap.pln_est = '$vPlnesp') ";
				$vQuery .= "order by cod_car, pln_est, niv_est, sem_anu, sec_gru, cod_esp, cod_cur, mod_mat";
				$cCurmat = fQuery($vQuery);
				while($aCurmat = $cCurmat->fetch_array())
				{			
				  if(!$aActaemi[$aCurmat['pln_est'].$aCurmat['sec_gru'].$aCurmat['cod_cur'].$aCurmat['mod_mat']])
				  {
					if($vSem_anu != $aCurmat['sem_anu'] or $vNiv_est != $aCurmat['niv_est'] or $vSec_gru != $aCurmat['sec_gru'])
					{
						$vSem_anu = $aCurmat['sem_anu'];
						$vNiv_est = $aCurmat['niv_est'];
						$vSec_gru = $aCurmat['sec_gru'];		
			?>	
			
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)"> 
              <td>&nbsp;</td>
              <td colspan="4" class="wordizqb">Nivel : <?=$sNivel[$aCurmat['niv_est']]?> - Semestre : <?=$sSemestre[$aCurmat['sem_anu']]?> - Grupo : <?=$sGrupo[$aCurmat['sec_gru']]?></td>
            </tr>
            <?
					}
					if($vCod_esp != $aCurmat['cod_esp'])
					{
						$vCod_esp = $aCurmat['cod_esp'];
						if($vCod_esp != '00')
						{
			?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)">
              <td>&nbsp;</td>
              <td colspan="4" class="wordizqb">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Menci&oacute;n: <?=$sEspecial[$aCurmat['pln_est'].$aCurmat['cod_esp']]['esp_nom']?></td>
            </tr>
			<?
						}
					}
					
				$sPDF[$aCurmat['pln_est'].$aCurmat['cod_cur'].$aCurmat['sec_gru'].$aCurmat['mod_mat']]['pln_est'] = $aCurmat['pln_est'];
				$sPDF[$aCurmat['pln_est'].$aCurmat['cod_cur'].$aCurmat['sec_gru'].$aCurmat['mod_mat']]['cod_cur'] = $aCurmat['cod_cur'];
				$sPDF[$aCurmat['pln_est'].$aCurmat['cod_cur'].$aCurmat['sec_gru'].$aCurmat['mod_mat']]['niv_est'] = $aCurmat['niv_est'];
				$sPDF[$aCurmat['pln_est'].$aCurmat['cod_cur'].$aCurmat['sec_gru'].$aCurmat['mod_mat']]['sem_anu'] = $aCurmat['sem_anu'];
				$sPDF[$aCurmat['pln_est'].$aCurmat['cod_cur'].$aCurmat['sec_gru'].$aCurmat['mod_mat']]['cod_esp'] = $aCurmat['cod_esp'];
				$sPDF[$aCurmat['pln_est'].$aCurmat['cod_cur'].$aCurmat['sec_gru'].$aCurmat['mod_mat']]['nom_cur'] = $aCurmat['nom_cur'];
				$sPDF[$aCurmat['pln_est'].$aCurmat['cod_cur'].$aCurmat['sec_gru'].$aCurmat['mod_mat']]['sec_gru'] = $aCurmat['sec_gru'];
				$sPDF[$aCurmat['pln_est'].$aCurmat['cod_cur'].$aCurmat['sec_gru'].$aCurmat['mod_mat']]['mod_mat'] = $aCurmat['mod_mat'];
				$sPDF[$aCurmat['pln_est'].$aCurmat['cod_cur'].$aCurmat['sec_gru'].$aCurmat['mod_mat']]['nombre'] = $aDocente[$aCurmat['pln_est'].$aCurmat['sec_gru'].$aCurmat['cod_cur'].$aCurmat['mod_mat']];


					
			?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)">
              <td class="wordcen"><?=$aCurmat['cod_cur']?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCurmat['nom_cur']))?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aDocente[$aCurmat['pln_est'].$aCurmat['sec_gru'].$aCurmat['cod_cur'].$aCurmat['mod_mat']]))?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sModnot[$aCurmat['mod_mat']]))?></td>
              <td class="wordcen"><?=$aCurmat['cod_act']?></td>
            </tr>
			<?
				  $vCont++;	
				  }
				}
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
	<a href="act_selectrep.php" title="Seleccionar reporte de Acta" class="linkboton" ><img src="../images/bviewacta.png" width="100" height="24" border="0" /></a>
	  <div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
	
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>