<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";

	$vFile ="con_curnota.php";
	if(fsafetyselcar())
	{
		if (!empty($_POST['rPln_est'])) $sUsercoo['pln_est'] = $_POST['rPln_est'];
		if (!empty($_POST['rCod_esp'])) $sUsercoo['cod_esp'] = $_POST['rCod_esp'];
		if (!empty($_POST['rSem_anu'])) $sUsercoo['sem_anu'] = $_POST['rSem_anu'];
		if (!empty($_POST['rCod_cur'])) $sUsercoo['cod_cur'] = $_POST['rCod_cur'];
/*		if (!empty($_POST['rCod_prv'])) $sEstudia['cod_prv'] = $_POST['rCod_prv'];
		if (!empty($_POST['rCod_dis'])) $sEstudia['cod_dis'] = $_POST['rCod_dis'];*/
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
	function cambio(){
		document.fCambio.submit();	
}
//-->
</script>
</head>

<body background="../images/ventana_r2_c2.jpg" >
<table width="450" border="0" cellpadding="1" cellspacing="0" class="tabled">
	<form action="<?=$vFile.'?'.SID?>" method="post" name="fCambio">
  <tr>
    <td width="100" class="wordder">Plan de Estudios : </td>
    <td width="350" class="wordizq">
      <select name="rPln_est" id="rPln_est" onChange="cambio();">
        <?=fviewplan($sUsercoo['pln_est'])?>
      </select>
    </td>
  </tr>
  <tr>
    <td class="wordder">Especialidad : </td>
    <td class="wordizq"><select name="rCod_esp" id="rCod_esp" onChange="cambio();">
        <?=fviewespecial($sUsercoo['pln_est'], $sUsercoo['cod_esp'])?>
    </select></td>
  </tr>
  <tr>
    <td class="wordder">Semestre : </td>
    <td class="wordizq"><select name="rSem_anu" id="rSem_anu" onChange="cambio();">
        <?=fviewsemhora($sUsercoo['pln_est'], $sUsercoo['sem_anu'])?>
    </select></td>
  </tr>
  <tr>
    <td class="wordder">Curso : </td>
    <td class="wordizq"><select name="rCod_cur" id="rCod_cur" onChange="cambio();">
        <?=fviewcursohora($sUsercoo['pln_est'], $sUsercoo['sem_anu'], $sUsercoo['cod_cur'], $sUsercoo['cod_esp'])?>
    </select></td>
  </tr>
  </form>
</table>
</body>
</html>
