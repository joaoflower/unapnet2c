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
	function start()
	{
		document.fData.rPln_est.focus();
	}
	function del_curso(pCurso)
	{
		var vReturn;
		var vAtributo;
		vAtributo = "center=yes; dialogHeight=180px; dialogWidth=530px; dialogLeft=px; dialogTop=px; ";
		vAtributo += "help=no; status=no; scroll=no; resizable=no; font-family=Arial; font-size=11px";

		vReturn = window.showModalDialog("msn_del.php?rCod_cur="+pCurso, "mensaje", vAtributo);
		if(vReturn == '1')
		{
			window.location.href = "pln_delcurso.php";
		}
	}
//-->
</script>
</head>

<body onLoad="start();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmaestros.php"; ?>
	
	<div class="wordcen" id="body1">
		<form action="" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Seleccione el a&ntilde;o Acad&eacute;mico </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			<tr>
              <td class="wordder">A&ntilde;o Acad&eacute;mico </td>
              <td class="wordizq">&nbsp;
                <select name="rAno_aca" id="rAno_aca" onChange="viewingresano(this.value)" onFocus="viewingresano(this.value)">
                  <option value="2000">2000</option>
                  <option value="2001">2001</option>
                  <option value="2002">2002</option>
                  <option value="2003">2003</option>
                  <option value="2004">2004</option>
                  <option value="2005">2005</option>
                  <option value="2006">2006</option>
                  <option value="2007">2007</option>
                  <option value="2008" selected>2008</option>
                </select>&nbsp;</td>
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
	  <div id="dresultado"></div>
	  </form>	  
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>