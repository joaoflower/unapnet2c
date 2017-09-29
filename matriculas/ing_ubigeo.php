<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";

	$vFile ="ing_ubigeo.php";
	if(fsafetyselcar())
	{
		if (!empty($_POST['rCod_nac'])) $sEstudia['cod_nac'] = $_POST['rCod_nac'];
		if (!empty($_POST['rCod_dep'])) $sEstudia['cod_dep'] = $_POST['rCod_dep'];
		if (!empty($_POST['rCod_prv'])) $sEstudia['cod_prv'] = $_POST['rCod_prv'];
		if (!empty($_POST['rCod_dis'])) $sEstudia['cod_dis'] = $_POST['rCod_dis'];
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
	function scriptUbigeo(){
		document.frmLibUbigeo.submit();	
}
//-->
</script>
</head>

<body background="../images/ventana_r2_c2.jpg" >
<table width="500" border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
  <form action="<?=$vFile.'?'.SID?>" method="post" name="frmLibUbigeo">
  <tr>
    <td width="70" class="wordder">Nacionalid. : </td>
    <td width="180" class="wordizq"><select name="rCod_nac" id="select4"  onChange="scriptUbigeo();">
        <?=fviewnacional($sEstudia['cod_nac'])?>
      </select></td>
    <td width="70" class="wordder">Departam. : </td>
    <td width="180" class="wordizq"><select name="rCod_dep" id="rCod_dep"  onChange="scriptUbigeo();">
      <?=fviewdepartam($sEstudia['cod_dep'])?>
        </select></td>
  </tr>
  <tr>
    <td class="wordder">Provincia :  : </td>
    <td class="wordizq"><select name="rCod_prv" id="rCod_prv"  onChange="scriptUbigeo();">
      <?=fviewprovinc($sEstudia['cod_dep'], $sEstudia['cod_prv'])?>
        </select></td>
    <td class="wordder">Distrito  : </td>
    <td class="wordizq"><select name="rCod_dis" id="rCod_dis" onChange="scriptUbigeo();">
      <?=fviewdistrito($sEstudia['cod_dep'], $sEstudia['cod_prv'], $sEstudia['cod_dis'])?>
        </select></td>
  </tr>
  </form>
</table>
</body>
</html>
