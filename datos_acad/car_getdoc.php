<?php
	session_start();
	include "../include/function.php";
	
	if(fsafetyselcar())
	{
		$sUsercoo['safetymatri'] = FALSE;
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
	function enfocar()
	{
		document.fData.rNum_mat.focus();
		//document.fdata.rLogin.select();
	}
//-->
</script>
<script type="text/javascript" src="ggw3.js"></script> 
</head>

<body onLoad="enfocar();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	
	<div class="wordcen" id="body1">
	  <form action="not_search.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Docentes Universitarios </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="0" class="tabled">
            <tr>
              <td class="wordizq">N&uacute;m. Matr </td>
              <td class="wordizq">Paterno:</td>
              <td class="wordizq">Materno</td>
              <td class="wordizq">Nombres:</td>
            </tr>
            <tr>
              <td width="60" class="wordizq	">
                <input name="rNum_mat" type="text" class="texto" id="rNum_mat" size="6" maxlength="6"  onBlur="searchdoc();" >
              </span></td>
              <td width="100" class="wordizq"><input name="rPaterno" type="text" class="texto" id="rPaterno" size="15" maxlength="20" onBlur="searchdoc();" ></td>
              <td width="100" class="wordizq"><input name="rMaterno" type="text" class="texto" id="rMaterno" size="15" maxlength="20" onBlur="searchdoc();" ></td>
              <td width="150" class="wordizq"><input name="rNombres" type="text" class="texto" id="rNombres" size="20" maxlength="30" onBlur="searchdoc();" ></td>
            </tr>
            <tr>
              <td colspan="4" class="wordder">
			  <div id="dresultado"></div>
              </td>
            </tr>
            <tr>
              <td class="wordder">&nbsp;</td>
              <td class="wordizq">&nbsp;</td>
              <td class="wordizq">&nbsp;</td>
              <td class="wordizq">&nbsp;</td>
            </tr>
            <tr align="center">
              <td colspan="4"><input name="submit" type="submit" class="boton" value="Buscar"></td>
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
	  <br>
	  <br>
	  <p>&nbsp;</p>
	  </form>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>