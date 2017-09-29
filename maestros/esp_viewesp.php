<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{
		$sUsercoo['upin'] = 'i';
		$sEspecial = "";
		
		$vQuery = "Select cod_esp, pln_est, esp_nom from unapnet.especial where cod_car = '{$sUsercoo['cod_car']}' and cod_esp <> '' order by pln_est, cod_esp";
		$cEspecial = fQuery($vQuery);
		while($aEspecial = $cEspecial->fetch_array())
		{
			$sEspecial[$aEspecial['pln_est'].$aEspecial['cod_esp']]['cod_esp'] = $aEspecial['cod_esp'];
			$sEspecial[$aEspecial['pln_est'].$aEspecial['cod_esp']]['pln_est'] = $aEspecial['pln_est'];
			$sEspecial[$aEspecial['pln_est'].$aEspecial['cod_esp']]['esp_nom'] = $aEspecial['esp_nom'];
		}
		$cEspecial->close();
		
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

	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Especialidades</th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th scope="col">&nbsp;Plan&nbsp;</th>
              <th scope="col">&nbsp;Sistema&nbsp;</th>
              <th scope="col">&nbsp;Cod.&nbsp; </th>
              <th scope="col">&nbsp;Nombre especialidad&nbsp;</th>
            </tr>
            <? 	$vCont = 1;	 if(!empty($sEspecial)) foreach($sEspecial as $vPln_esp => $vEspecial) { ?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
              <td class="wordcen"><?=$vEspecial['pln_est']?></td>
              <td class="wordizq">&nbsp;<?=$sTiposist[$sPlan[$vEspecial['pln_est']]]?>&nbsp;</td>
              <td class="wordcen"><a href="" ><?=$vEspecial['pln_est'].'-'.$vEspecial['cod_esp']?></a></td>
              <td class="wordizq">&nbsp;<?=$vEspecial['esp_nom']?>&nbsp;</td>
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
	  <a href="esp_getespe.php" title="Nuevo Curso" class="linkboton"><img src="../images/bnuevoespe.png" width="100" height="24" /></a>

	<div id="ddatos">
	
	
	</div>

	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>