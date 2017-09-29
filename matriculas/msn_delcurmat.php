<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{		
		$sEstudia['cod_cur'] = $_GET['rCod_cur'];
		
		$vQuery = "Select nom_cur, cod_esp from unapnet.curso where cod_cur = '{$sEstudia['cod_cur']}' and ";
		$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sEstudia['pln_est']}' ";
		$cCurso = fQuery($vQuery);
				
		if($aCurso = $cCurso->fetch_array())
		{			
			$sEstudia['nom_cur'] = $aCurso['nom_cur'];
			$sEstudia['cod_espd'] = $aCurso['cod_esp'];
			
			$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
			$vQuery = "Select mod_mat, sec_gru from $tCurmat where num_mat = '{$sEstudia['num_mat']}' and ";
			$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "cod_cur = '{$sEstudia['cod_cur']}' and per_aca = '{$sUsercoo['per_aca']}'";
			$cCurso = fQuery($vQuery);
					
			if($aCurso = $cCurso->fetch_array())
			{			
				$sEstudia['mod_matd'] = $aCurso['mod_mat'];
				$sEstudia['sec_grud'] = $aCurso['sec_gru'];
			}	
			else
			{
				header("Location:../index.php");
			}			
		}	
		else
		{
			header("Location:../index.php");
		}			
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
		¿Estás seguro que deseas ELIMINAR la matr&iacute;cula: <br> 
		del curso: <b><?=$sEstudia['nom_cur']?></b> <br>
		de la especialidad: <b><?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_espd']]['esp_nom']?></b><br>
		de la modalidad: <b><?=$sModmat[$sEstudia['mod_matd']]['mod_des']?></b><br>
		del grupo: <b><?=$sGrupo[$sEstudia['sec_grud']]?></b> ?		
		<br>
		<br>
  </div>
	<div align="center">
	<a href="" title="Eliminar" class="linkboton" onClick = "cerrar('1'); return false"><img src="../images/bok.png" width="100" height="24"></a>
    <a href="" title="Cancelar" class="linkboton" onClick = "cerrar('2'); return false"><img src="../images/bundo.png" width="100" height="24"></a>	</div>
</form>

</body>
</html>