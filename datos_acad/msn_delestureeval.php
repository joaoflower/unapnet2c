<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{		
		$sEstudia['num_mat'] = $_GET['rNum_mat'];
		
		$vQuery = "Select concat(paterno, ' ', materno, ', ', nombres) as nombre from unapnet.estudiante ";
		$vQuery .= "where num_mat = '{$sEstudia['num_mat']}' and cod_car = '{$sUsercoo['cod_car']}' ";
				
		$cEstudia = fQuery($vQuery);
		if($aEstudia = $cEstudia->fetch_array())
		{	
			$sEstudia['nombre'] = $aEstudia['nombre'];	
		}	
		else
		{	header("Location:../index.php");	}			
		
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
//		document.fData.rPln_est.focus();
	}
	function cerrar(pReturn)
	{
		document.fData.rReturn.value = pReturn;
		window.close();
	}
//-->
</script>
</head>

<body onLoad="start();" onUnload="window.returnValue = document.fData.rReturn.value">
<div class="headerow">
	<div class="headercol"><img src="../images/cabe_r1_c1.jpg" width="565" height="21"></div>
</div>
<div class="headerow">
	<div class="headercol"><img name="cabe_r2_c1" src="../images/cabe_r2_c1.jpg" width="770" height="3" border="0" alt=""></div>
</div>
<div class="headerow">
	<div class="headercol"><img name="cabe_r3_c1" src="../images/cabe_r3_c1.jpg" width="203" height="18" border="0" alt=""></div>
	<div class="headermsn"><span class="wordizqb">[<?=$sCarrera[$sUsercoo['cod_car']]?>]</span></div>
</div>
<br>

<form action="" method="get" name="fData" id="fData">
	<input name="rReturn" type="hidden" id="rReturn" value="1">
  <div align="center" class="">
		�Est�s seguro de que deseas ELIMINAR el examen de Reevaluaci&oacute;n: <br> 
		del estudiante: <b><?=$sEstudia['nombre']?></b> <br>
		del curso: <b><?=$sEstudia['nom_cur']?></b> <br>		
		de la especialidad: <b><?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']?></b><br>
		del grupo: <b><?=$sGrupo[$sEstudia['sec_gru']]?></b> ?		
		<br>
		<br>
  </div>
	<div align="center">
	<a href="" title="Eliminar" class="linkboton" onClick = "cerrar('1'); return false"><img src="../images/bok.png" width="100" height="24"></a>
    <a href="" title="Cancelar" class="linkboton" onClick = "cerrar('2'); return false"><img src="../images/bundo.png" width="100" height="24"></a>	</div>
</form>

</body>
</html>