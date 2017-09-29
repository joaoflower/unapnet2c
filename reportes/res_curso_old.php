<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	

	if(fsafetyselcar())
	{
		$sPDF = "";
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vQuery = "select distinct pln_est from $tCurmat where per_aca = '{$sUsercoo['per_aca']}'";
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
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>	
	function cambio(){
		document.fCambio.submit();	
	}
//-->
</script>
</head>

<body >
	<? include "../include/header1.php"; ?>
	<? include "../include/mreportes.php"; ?>
	
	<div class="wordcen" id="body1">
	  <form action="niv_select.php" method="post" enctype="multipart/form-data" name="fCambio" id="fCambio"> 
	  <?
	  	if(!empty($sPlnesp))
		foreach($sPlnesp as $vPlnesp => $aPlnesp)
		{
			
	  ?>
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Matriculados - Plan:            <?=$sEspecial[$vPlnesp]['esp_nom']?></th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
		  <?	

			$vQuery = "select distinct curso.cod_cur, curso.nom_cur ";
			$vQuery .= "from $tCurmat left join unapnet.curso on $tCurmat.cod_car = curso.cod_car and ";
			$vQuery .= "$tCurmat.pln_est = curso.pln_est and $tCurmat.cod_cur = curso.cod_cur "; 
			$vQuery .= "where per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "$tCurmat.pln_est = '{$aPlnesp['pln_est']}' order by cod_cur";
			$cCurso = fQuery($vQuery);
			while($aCurso = $cCurso->fetch_array())
			{
		  ?>
		  <span class="wordb">Curso: 
		  <?=$aCurso['nom_cur']?>
		  </span>		  <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="80">Grupo</th>
              <th width="60">Coord.</th>
              <th width="60">Internet</th>
              <th width="60">Total</th>
            </tr>
			<?
				$vSubtotal = 0;
				$vCont = 1;
				$tCurtut = "unapnet.curtut{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
				
				$vQuery = "Select sec_gru, count(*) as canti from $tCurmat where per_aca = '{$sUsercoo['per_aca']}' and ";
				$vQuery .= "pln_est = '{$aPlnesp['pln_est']}' and cod_cur = '{$aCurso['cod_cur']}' group by sec_gru";
				$cModmat = fQuery($vQuery);
				while($aModmat = $cModmat->fetch_array())
				{
					$sInternet = "";					
					$vQuery = "Select sec_gru, count(*) as canti from $tCurtut where per_aca = '{$sUsercoo['per_aca']}' and ";
					$vQuery .= "pln_est = '{$aPlnesp['pln_est']}' and cod_cur = '{$aCurso['cod_cur']}' and sec_gru = '{$aModmat['sec_gru']}' and ";
					$vQuery .= "num_mat not in (select num_mat from $tCurmat where per_aca = '{$sUsercoo['per_aca']}' and ";
					$vQuery .= "pln_est = '{$aPlnesp['pln_est']}' and cod_cur = '{$aCurso['cod_cur']}' and sec_gru = '{$aModmat['sec_gru']}') group by sec_gru";
					$cModmat2 = fQuery($vQuery);
					while($aModmat2 = $cModmat2->fetch_array())
					{
						$sInternet[$aModmat2['sec_gru']] = $aModmat2['canti'];
					}
					
					$sPDF[$aCurso['cod_cur'].$aModmat['sec_gru']]['cod_cur'] = $aCurso['cod_cur'];
					$sPDF[$aCurso['cod_cur'].$aModmat['sec_gru']]['nom_cur'] = $aCurso['nom_cur'];
					$sPDF[$aCurso['cod_cur'].$aModmat['sec_gru']]['sec_gru'] = $sGrupo[$aModmat['sec_gru']];
					$sPDF[$aCurso['cod_cur'].$aModmat['sec_gru']]['canti'] = $aModmat['canti'];
					$sPDF[$aCurso['cod_cur'].$aModmat['sec_gru']]['icanti'] = $sInternet[$aModmat['sec_gru']];
					$vSubtotal += $aModmat['canti'] + $sInternet[$aModmat['sec_gru']];
					
			?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordder"><?=$sGrupo[$aModmat['sec_gru']]?> :</td>
              <td class="wordder"><?=$aModmat['canti']?>&nbsp;</td>
              <td class="wordder"><?=$sInternet[$aModmat['sec_gru']]?>&nbsp;</td>
              <td class="wordder"><?=$aModmat['canti']+$sInternet[$aModmat['sec_gru']]?>&nbsp;</td>
            </tr>
			<?	$vCont++;	}	?>
            <tr>
              <td class="wordderb">&nbsp;</td>
              <td class="wordderb">&nbsp;</td>
              <td class="wordderb">TOTAL : </td>
              <td class="wordderb"><?=$vSubtotal?>&nbsp; </td>
            </tr>
          </table>
		  <?	}	?>		  </td>
          <td background="../images/ventana_r2_c4.jpg"></td>
        </tr>
        <tr>
          <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
          <td background="../images/ventana_r4_c2.jpg"></td>
          <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
        </tr>
      </table>
	  <?	}	?>
	  <a href="prnrescurso.php" class="enlace1">&lt; Imprimir &gt;</a>
	  </form>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>