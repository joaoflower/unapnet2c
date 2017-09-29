<?php
	session_start();
	include "../include/function.php";
	
	if(fsafetyselcar2())
	{
		$sUsercoo['safetymatri'] = FALSE;
		$sUsercoo['safetymatri2'] = FALSE;
		$sUsercoo['safetymatri3'] = FALSE;
		$sUsercoo['safetymatri4'] = FALSE;
		$sEstudia = "";
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
	function enfocar()
	{
		document.fData.rNum_mat.focus();
		//document.fdata.rLogin.select();
	}
	function verify()
	{
		document.fData.rPln_est.value = document.frameCambio.fCambio.rPln_est.value;
		document.fData.rCod_esp.value = document.frameCambio.fCambio.rCod_esp.value;
		return true;
	}
	
//-->
</script>
<script type="text/javascript" src="../script/ggw3.js"></script>
</head>

<body onLoad="enfocar();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmaestros.php"; ?>
	
<div class="wordcen" id="body1">
	  <form action="ing_getdata.php" method="post" enctype="multipart/form-data" name="fData" id="fData">	  
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Matr&iacute;cula de Estudiantes Ingresantes </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="0" class="tabled">
                <tr>
                  <th width="15" class="wordizq">&nbsp;</th>
                  <th width="60" class="wordizq">N&deg; Mat. </th>
                  <th width="140" class="wordizq">Paterno</th>
                  <th width="140" class="wordizq">Materno</th>
                  <th width="170" class="wordizq">Nombres</th>
                  <th width="16" class="wordizq">&nbsp;</th>
                </tr>
                <tr>
                  <th class="wordizq	">&nbsp;</th>
                  <th class="wordizq	"><input name="rNum_mat" type="text" class="texto" id="rNum_mat" size="6" maxlength="6"  onBlur="searchmingest();" >
                  </span></th>
                  <th class="wordizq"><input name="rPaterno" type="text" class="texto" id="rPaterno" onBlur="searchmingest();" size="20" maxlength="20" ></th>
                  <th class="wordizq"><input name="rMaterno" type="text" class="texto" id="rMaterno" size="20" maxlength="20" onBlur="searchmingest();" ></th>
                  <th class="wordizq"><input name="rNombres" type="text" class="texto" id="rNombres" size="25" maxlength="30" onBlur="searchmingest();" ></th>
                  <th class="wordizq">&nbsp;</th>
                </tr>
                <tr>
                  <td colspan="6" class="wordder"><div id="dresultado"></div></td>
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
	    <div id="ddatos"></div>
  </form>
</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>