<?php
	session_start();
	include "../include/function.php";
	
	if(fsafetyselcar())
	{
/*		$sUsercoo['pln_est'] = "";
		$sUsercoo['sem_anu'] = "";
		$sUsercoo['sec_gru'] = "";
		$sUsercoo['tur_est'] = "";
		$sUsercoo['cod_cur'] = "";*/
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

//-->
</script>
</head>

<body >
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	
	<div class="wordcen" id="body1">
	  <iframe width="475"  name ="frameCambio"  height="360" id="frameCambio" src="hor_plancur.php"  scrolling="no" frameborder="0"  > </iframe>
	  <input name="rPln_est" type="hidden" id="rPln_est" value="">
				<input name="rCod_esp" type="hidden" id="rCod_esp" value="">
	  
</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>