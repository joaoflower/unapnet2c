<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$tReso = "unapnet.reso{$sUsercoo['ano_aca']}";
		
		$sEstudia = "";
		$sEstudia['pln_est'] = $_GET['rPln_est'];
		$sEstudia['cod_cur'] = $_GET['rCod_cur'];
		$sEstudia['sec_gru'] = $_GET['rSec_gru'];
		$sEstudia['mod_mat'] = $_GET['rMod_mat'];
		
		$vQuery = "Select nom_cur, cod_esp from unapnet.curso where cod_cur = '{$sEstudia['cod_cur']}' and ";
		$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sEstudia['pln_est']}' ";
				
		$cCurso = fQuery($vQuery);
		if($aCurso = $cCurso->fetch_array())
		{	
			$sEstudia['nom_cur'] = $aCurso['nom_cur'];	
			$sEstudia['cod_esp'] = $aCurso['cod_esp'];			
		}	
		else
		{	header("Location:../index.php");	}	
		$cCurso->close();
		
		$vQuery = "Select res_aut from $tReso ";
		$vQuery .= "where pln_est = '{$sEstudia['pln_est']}' and cod_cur = '{$sEstudia['cod_cur']}' and ";
		$vQuery .= "sec_gru = '{$sEstudia['sec_gru']}' and mod_mat = '{$sEstudia['mod_mat']}' and ";
		$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and ano_aca = '{$sUsercoo['ano_aca']}' and ";
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}'";
				
		$cReso = fQuery($vQuery);
		if($aReso = $cReso->fetch_array())
		{	
			$sEstudia['res_aut'] = $aReso['res_aut'];				
		}	
		else
		{	header("Location:../index.php");	}	
		$cReso->close();
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
	  <form action="res_updatereso.php" method="post" enctype="multipart/form-data" name="fData" id="fData">
	  
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
                <td width="100" align="right">Plan-Curso: </td>
                <td width="300" class="wordizqb">&nbsp;<?=$sEstudia['pln_est']?>-<?=$sEstudia['cod_cur']?></td>
              </tr>
                <tr>
                  <td align="right">Nombre curso : </td>
                  <td class="wordizqb">&nbsp;<?=$sEstudia['nom_cur']?></td>
                </tr>
                <tr>
                  <td align="right">Especialidad : </td>
                  <td class="wordizqb">&nbsp;<?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']?></td>
                </tr>
                <tr>
                  <td align="right">Grupo : </td>
                  <td class="wordizqb">&nbsp;<?=$sGrupo[$sEstudia['sec_gru']]?></td>
                </tr>
                <tr>
                  <td align="right">Modalidad : </td>
                  <td class="wordizqb">&nbsp;<?=$sModnot[$sEstudia['mod_mat']]?></td>
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
                <td class="wordizqb"><input name="rRes_aut" type="text" class="texto" id="rRes_aut" value="<?=$sEstudia['res_aut']?>" size="60" maxlength="60" onBlur="fupper(this);"></td>
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

		<a href="" title="Guardar " class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
		<a href="res_viewreso.php" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a>		
	  
  </form>
	  <a href="res_viewreso.php" title="Ver Reso" class="linkboton" ><img src="../images/bviewres.png" width="100" height="24"></a></div>
	<? include "../include/pie1.php"; ?>

</body>
</html>