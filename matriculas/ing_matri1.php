<?php
	session_start();
	include "../include/function.php";
	
	if(fsafetyselcar())
	{
		if($sUsercoo['safetymatri2'])
		{
//			fMaxcrding();
		}
		else
			header("Location:ing_getestu.php");
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

	function verify()
	{
		document.fData.rPln_est.value = document.frameCambio.fCambio.rPln_est.value;
		document.fData.rCod_esp.value = document.frameCambio.fCambio.rCod_esp.value;
		return true;
	}
//-->
</script>
</head>

<body>
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	
	<div class="wordcen" id="body1">
	  <form action="ing_matri2.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Datos principales del Estudiante </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg"><table width="400" border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <td width="75" class="wordder">Estudiante : </td>
                  <td class="wordizqb"><?=$sEstudia['num_mat']?>
            -
              <?=$sEstudia['paterno']?>
              <?=$sEstudia['materno']?>
              ,
              <?=$sEstudia['nombres']?></td>
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
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Plan de Estudios y Especialidad </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><iframe width="400"  name ="frameCambio"  height="50" id="frameCambio" src="ing_planesp.php"  scrolling="no" frameborder="0" >
                </iframe><input name="rPln_est" type="hidden" id="rPln_est" value="">
				<input name="rCod_esp" type="hidden" id="rCod_esp" value="">
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
          <th align="center" background="../images/ventana_r1_c2.jpg" >Condici&oacute;n de Matr&iacute;cula Actual </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table width="220" border="0" cellpadding="1" cellspacing="0" class="tabled">
              <tr>
                <td width="110" class="wordder">Modalidad : </td>
                <td class="wordizqb">Regular</td>
              </tr>
              <tr>
                <td class="wordder">M&aacute;ximo de cr&eacute;ditos  : </td>
                <td class="wordizqb"><?=$sEstudia['max_crd']?> cr&eacute;ditos </td>
              </tr>
              <tr>
                <td class="wordder">Grupo : </td>
                <td class="wordizqb"><select name="rSec_gru" id="rSec_gru">
                      <?=fviewgrupo('01')?>
					  </select></td>
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
	  <a href="" title="Continuar" class="linkboton" onClick = "if(verify()){ document.fData.submit();} return false;"><img src="../images/bcontinue.png" width="100" height="24"></a> 
	  <a href="reg_getestu.php" title="Cancelar" class="linkboton" ><img src="../images/bcancel.png" width="100" height="24"></a
	></div>
	<? include "../include/pie1.php"; ?>

</body>
</html>