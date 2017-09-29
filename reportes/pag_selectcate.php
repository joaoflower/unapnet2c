<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{

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
	<form action="pag_viewestu.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 

	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Pago de Matr&iacute;cula </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
              <tr>
                <th width="20">&nbsp;</th>
                <th width="20">C</th>
                <th width="250">Categoria de Pago </th>
                <th width="30">Cant</th>
              </tr>
              <?				
				$vCont = 1;
				$vTotal = 0;
				$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
				$vQuery = "select pa.cod_pag, tp.des_pag, count(*) as canti ";
				$vQuery .= "from unapnet.pago2006 pa left join unapnet.tarifapago tp on pa.cod_pag = tp.cod_pag ";
				$vQuery .= "where pa.con_reb = '1' and pa.cod_car = '{$sUsercoo['cod_car']}' and pa.num_mat in ";
				$vQuery .= "(select distinct num_mat from $tEstumat) group by cod_pag order by cod_pag";
				$cCatepago = fQuery($vQuery);
				while($aCatepago = $cCatepago->fetch_array())
				{
					$vTotal += $aCatepago['canti'];
			?>
              <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)">
                <td><input name="rCat_pag[<?=$aCatepago['cod_pag']?>]" type="checkbox" class="check" value="<?=$aCatepago['cod_pag']?>"></td>
                <td class="wordcen">&nbsp;<?=$aCatepago['cod_pag']?></td>
                <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCatepago['des_pag']))?></td>
                <td class="wordder"><?=$aCatepago['canti']?>&nbsp;</td>
              </tr>
			  <?
				$vCont++;	}
			?>
              <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)">
                <td colspan="3" class="wordderb">TOTAL : </td>
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

	  </form>
	 <a href="" title="Generar Listado de estudiantes" class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bgenerar.png" width="100" height="24"></a>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>