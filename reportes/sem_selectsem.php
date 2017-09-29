<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{
		$sPln_mat = "";
		$aPln_mat = "";
		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vQuery = "Select distinct pln_est from $tEstumat where per_aca = '{$sUsercoo['per_aca']}' order by pln_est ";
		$cPln_mat = fQuery($vQuery);
		while($aPln_mat = $cPln_mat->fetch_array())		
		{
			$sPln_mat[$aPln_mat['pln_est']] = $aPln_mat['pln_est'];
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
	<form action="sem_viewestu.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	<?
		if(!empty($sPln_mat))
		foreach($sPln_mat as $vPln_est => $aPln_mat)
		{
	?>
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Plan : <?=$vPln_est." - ".$sTiposist[$sPlan[$vPln_est]]?></th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
              <tr>
                <th width="20">&nbsp;</th>
                <th width="20">C</th>
                <th width="90"><?=(($sPlan[$vPln_est]=='2')?'Semestre':'Nivel')?> </th>
                <th width="250"> Especialidad / Menci&oacute;n </th>
                <th width="30">Cant</th>
              </tr>
              <?				
				$vCont = 1;
				$vTotal = 0;
				$vQuery = "Select niv_est, cod_esp, count(*) as canti from $tEstumat ";
				$vQuery .= "where pln_est = '$vPln_est' and per_aca = '{$sUsercoo['per_aca']}' ";
				$vQuery .= "group by niv_est, cod_esp order by niv_est, cod_esp ";
				$cCredisem = fQuery($vQuery);
				while($aCredisem = $cCredisem->fetch_array())
				{
					$vTotal += $aCredisem['canti'];
			?>
              <tr <? if($aCredisem['niv_est'] % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)">
                <td><input name="rSem_anu[<?=$vPln_est?><?=$aCredisem['niv_est']?><?=$aCredisem['cod_esp']?>]" type="checkbox" class="check" value="<?=$vPln_est?><?=$aCredisem['niv_est']?><?=$aCredisem['cod_esp']?>"></td>
                <td class="wordcen">&nbsp;<?=$aCredisem['niv_est']?></td>
                <td class="wordizq">&nbsp;<?=ucwords(strtolower($sSemestre[$aCredisem['niv_est']]))?></td>
                <td class="wordizq">&nbsp;<?=ucwords(strtolower($sEspecial[$vPln_est.$aCredisem['cod_esp']]['esp_nom']))?></td>
                <td class="wordder"><?=$aCredisem['canti']?>&nbsp;</td>
              </tr>
			  <?
				$vCont++;	}
			?>
              <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)">
                <td colspan="4" class="wordderb">TOTAL : </td>
                <td class="wordder"><?=$vTotal?>&nbsp;</td>
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
	<?
		}
	?>
	  </form>
	 <a href="" title="Generar Listado de estudiantes" class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bgenerar.png" width="100" height="24"></a>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>