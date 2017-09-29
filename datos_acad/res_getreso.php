<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$tReso = "unapnet.reso{$sUsercoo['ano_aca']}";
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
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
	function enfocar()
	{
		//document.fdata.rLogin.select();
	}
	
	
//-->
</script>
</head>

<body onLoad="enfocar();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmaestros.php"; ?>
	
<div class="wordcen" id="body1">
	  <form action="res_savereso.php" method="post" enctype="multipart/form-data" name="fData" id="fData">
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Documento</th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen">
			<table border="0" cellpadding="0" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                <td align="right">Resoluci&oacute;n : </td>
                <td class="wordizqb"><input name="rRes_aut" type="text" class="texto" id="rRes_aut" value="RESOLUCI&Oacute;N DE DECANATO N&deg; " size="60" maxlength="60" onBlur="fupper(this);"> 
                  Ejm: </td>
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

	$vQuery = "select distinct pln_est from $tCurmat where per_aca = '{$sUsercoo['per_aca']}' and ";
	$vQuery .= "(mod_mat = '05' or mod_mat = '09' or mod_mat = '10' or mod_mat = '16') order by pln_est ";
	$cPlnesp = fQuery($vQuery);
	while($aPlnesp = $cPlnesp->fetch_array())
	{
		$aReso = "";
		$vQuery = "select concat(cod_cur, sec_gru, mod_mat) as csm from $tReso where cod_car = '{$sUsercoo['cod_car']}' and ";
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and pln_est = '{$aPlnesp['pln_est']}'";
		$cReso = fQuery($vQuery);
		while($aReso2 = $cReso->fetch_array())
		{
			$aReso[$aReso2['csm']] = 1;
		}
		$cReso->close();
?>

<table border="0" cellpadding="0" cellspacing="0" id="ventana">
  <tr>
    <th><img src="../images/ventana_r1_c1.jpg" alt="" name="ventana_r1_c1" width="12" height="29" border="0" id="ventana_r1_c1" /></th>
    <th align="center" background="../images/ventana_r1_c2.jpg" >Plan: <?=$aPlnesp['pln_est']."-".$sTiposist[$sPlan[$aPlnesp['pln_est']]]?></th>
    <th><img src="../images/ventana_r1_c4.jpg" alt="" name="ventana_r1_c4" width="11" height="29" border="0" id="ventana_r1_c4" /></th>
  </tr>
  <tr>
    <td background="../images/ventana_r2_c1.jpg"></td>
    <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="0" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
      <tr>
        <th width="20" class="wordcen"></th>
        <th width="20" class="wordizqb">Pln</th>
        <th width="30" class="wordizqb">&nbsp;Cod&nbsp;</th>
        <th width="30" class="wordizqb">Niv</th>
        <th width="20" class="wordizqb">Sm</th>
        <th width="20" class="wordizqb">Esp</th>
        <th width="280" class="wordizqb">&nbsp;Nombre del Curso&nbsp;</th>
        <th width="60" class="wordizqb">&nbsp;Grupo&nbsp;</th>
        <th width="80" class="wordizqb">&nbsp;Modalidad&nbsp;</th>
      </tr>
      <?
		$vQuery = "Select distinct cu.pln_est, cu.cod_cur, cu.niv_est, cu.sem_anu, cu.cod_esp, cu.nom_cur, cm.sec_gru, ";
		$vQuery .= "mm.mod_act from $tCurmat cm left join unapnet.curso cu on ";
		$vQuery .= "cm.cod_car = cu.cod_car and cm.pln_est = cu.pln_est and cm.cod_cur = cu.cod_cur ";
		$vQuery .= "left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
		$vQuery .= "where cm.per_aca = '{$sUsercoo['per_aca']}' and cm.pln_est = '{$aPlnesp['pln_est']}' and ";
		$vQuery .= "(cm.mod_mat = '05' or cm.mod_mat = '09' or cm.mod_mat = '10' or cm.mod_mat = '16')";
		$vQuery .= "order by cu.niv_est, sem_anu, cod_esp, cod_cur, sec_gru ";
		$cCurso = fQuery($vQuery);
		while($aCurso = $cCurso->fetch_array())
		{		
			if(empty($aReso[$aCurso['cod_cur'].$aCurso['sec_gru'].$aCurso['mod_act']]))
			{
	?>
      <tr <? if($aCurso['sem_anu'] % 2 == 0)  echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)">
        <td class="wordcen"><input name="rCurreso[<?=$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru'].$aCurso['mod_act']?>]" type="checkbox" id="rCurReso[<?=$aCurso['cod_cur']?>]" value="checkbox" onClick="pintar(this)" /></td>
        <td class="wordcen">&nbsp;<?=$aCurso['pln_est']?>&nbsp;</td>
        <td class="wordcen">&nbsp;<?=$aCurso['cod_cur']?>&nbsp;</td>
        <td class="wordcen">&nbsp;<?=$aCurso['niv_est']?>&nbsp;</td>
        <td class="wordcen">&nbsp;<?=$aCurso['sem_anu']?>&nbsp;</td>
        <td class="wordcen">&nbsp;<?=$aCurso['cod_esp']?>&nbsp;</td>
        <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCurso['nom_cur']))?>&nbsp;</td>
        <td class="wordizq">&nbsp;<?=ucwords(strtolower($sGrupo[$aCurso['sec_gru']]))?></td>
        <td class="wordizq">&nbsp;<?=ucwords(strtolower($sModnot[$aCurso['mod_act']]))?></td>
      </tr>
      <?
			}	
		}
		$cCurso->close();
		?>
      <tr>
        <td colspan="9" class="wordcen"></td>
      </tr>
    </table></td>
    <td background="../images/ventana_r2_c4.jpg"></td>
  </tr>
  <tr>
    <td><img src="../images/ventana_r4_c1.jpg" alt="" name="ventana_r4_c1" width="12" height="10" border="0" id="ventana_r4_c1" /></td>
    <td background="../images/ventana_r4_c2.jpg"></td>
    <td><img src="../images/ventana_r4_c4.jpg" alt="" name="ventana_r4_c4" width="11" height="10" border="0" id="ventana_r4_c4" /></td>
  </tr>
</table>
<?
	}
?>

		<a href="" title="Guardar " class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
		<a href="res_viewreso.php" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a>		
	  
  </form>
	  <a href="res_viewreso.php" title="Ver Reso" class="linkboton" ><img src="../images/bviewres.png" width="100" height="24"></a></div>
	<? include "../include/pie1.php"; ?>

</body>
</html>