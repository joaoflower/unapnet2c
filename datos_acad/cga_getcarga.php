<?php
	session_start();
	include "../include/function.php";
	
	if(fsafetyselcar())
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
<script type="text/javascript" src="../script/ggw3.js"></script>
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>	
	function enfocar()
	{
		document.fData.rPaterno.focus();
		//document.fdata.rLogin.select();
	}
	
	
//-->
</script>
</head>

<body onLoad="enfocar();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmaestros.php"; ?>
	
<div class="wordcen" id="body1">
	  <form action="cga_savecarga.php" method="post" enctype="multipart/form-data" name="fData" id="fData">
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Docentes Universitarios</th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="0" class="tabled">
                <tr>
                  <th width="20" class="wordizq">&nbsp;</th>
                  <th width="60" class="wordizq">Cod.doc</th>
                  <th width="140" class="wordizq">Paterno</th>
                  <th width="140" class="wordizq">Materno</th>
                  <th width="170" class="wordizq">Nombres</th>
                  <th width="16" class="wordizq">&nbsp;</th>
                </tr>
                <tr>
                  <th class="wordizq	">&nbsp;</th>
                  <th class="wordizq	"><input name="rCod_prf" type="text" class="texto" id="rCod_prf" size="7" maxlength="7"  onBlur="searchcargadoc();" >
                  </span></th>
                  <th class="wordizq"><input name="rPaterno" type="text" class="texto" id="rPaterno" onBlur="searchcargadoc();" size="20" maxlength="20" ></th>
                  <th class="wordizq"><input name="rMaterno" type="text" class="texto" id="rMaterno" size="20" maxlength="20" onBlur="searchcargadoc();" ></th>
                  <th class="wordizq"><input name="rNombres" type="text" class="texto" id="rNombres" size="25" maxlength="30" onBlur="searchcargadoc();" ></th>
                  <th class="wordizq">&nbsp;</th>
                </tr>
				</table>
				<div id="dresultado"></div>
			</td>
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
	  <a href="cga_selectsem.php" title="Ver Carga" class="linkboton" ><img src="../images/bviewcarga.png" width="100" height="24"></a>
</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>