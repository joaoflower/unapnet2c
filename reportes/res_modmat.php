<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	

	if(fsafetyselcar2())
	{
		$sPDF = "";
		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vQuery = "select distinct pln_est, cod_esp from $tEstumat where per_aca = '{$sUsercoo['per_aca']}'";
		$cPlnesp = fQuery($vQuery);
		while($aPlnesp = $cPlnesp->fetch_array())
		{
			$sPlnesp[$aPlnesp['pln_est'].$aPlnesp['cod_esp']]['pln_est'] = $aPlnesp['pln_est'];
			$sPlnesp[$aPlnesp['pln_est'].$aPlnesp['cod_esp']]['cod_esp'] = $aPlnesp['cod_esp'];
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
          <th align="center" background="../images/ventana_r1_c2.jpg" >Matriculados - Especialidad: <?=$sEspecial[$vPlnesp]['esp_nom']?></th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
		  <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="100">Modalidad</th>
              <th width="60">Cantidad</th>
            </tr>
			<?
				$vSubtotal = 0;
				$vCont = 1;
				$vQuery = "Select mod_mat, count(*) as canti from $tEstumat where per_aca = '{$sUsercoo['per_aca']}' and ";
				$vQuery .= "pln_est = '{$aPlnesp['pln_est']}' and cod_esp = '{$aPlnesp['cod_esp']}' group by mod_mat";
				$cModmat = fQuery($vQuery);
				while($aModmat = $cModmat->fetch_array())
				{
					$sPDF[$vPlnesp.$aModmat['mod_mat']]['pln_esp'] = $vPlnesp;
					$sPDF[$vPlnesp.$aModmat['mod_mat']]['cod_esp'] = $sEspecial[$vPlnesp]['esp_nom'];
					$sPDF[$vPlnesp.$aModmat['mod_mat']]['mod_mat'] = $sModmat[$aModmat['mod_mat']]['mod_des'];
					$sPDF[$vPlnesp.$aModmat['mod_mat']]['canti'] = $aModmat['canti'];
					$vSubtotal += $aModmat['canti'];
			?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordder"><?=$sModmat[$aModmat['mod_mat']]['mod_des']?> :</td>
              <td class="wordder"><?=$aModmat['canti']?>&nbsp;</td>
            </tr>
			<?	$vCont++;	}	?>
            <tr>
              <td class="wordderb">TOTAL : </td>
              <td class="wordderb"><?=$vSubtotal?>&nbsp; </td>
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
	  <?	}	?>
	  <a href="prnresmodmat.php" class="enlace1">&lt; Imprimir &gt;</a>
	  </form>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>