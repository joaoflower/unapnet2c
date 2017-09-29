<?php
	session_start();
	include "../include/function.php";
	
	if(fsafetyselcar())
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
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>
//-->
</script>
</head>

<body>
	<? include "../include/header1.php"; ?>
	<? include "../include/mayuda.php"; ?>
	
	<div class="wordcen" id="body1">Bienvenido <span class="wordb">
    <?=$sUsercoo['nombres']?> 
    <?=$sUsercoo['paterno']?> 
    <?=$sUsercoo['materno']?>
	</span><br>
	  al nuevo Sistema Acad&eacute;mico Un@p.Net2<br>
    Dudas y sugerencias unapnet2@unap.edu.pe</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>