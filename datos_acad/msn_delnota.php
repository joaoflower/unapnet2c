<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{		
		$sEstudia['pln_est'] = $_GET['rPln_est'];
		$sEstudia['cod_cur'] = $_GET['rCod_cur'];
		$sEstudia['mod_not'] = $_GET['rMod_not'];
		$sEstudia['ano_aca'] = $_GET['rAno_aca'];
		$sEstudia['per_aca'] = $_GET['rPer_aca'];
		
		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
		
		$vQuery = "Select curso.nom_cur, curso.niv_est, curso.sem_anu, curso.cod_esp, $tNota.not_cur ";
		$vQuery .= "from unapnet.curso left join $tNota on curso.cod_car = $tNota.cod_car and curso.pln_est = $tNota.pln_est and ";
		$vQuery .= "curso.cod_cur = $tNota.cod_cur ";
		$vQuery .= "where curso.cod_car = '{$sUsercoo['cod_car']}' and curso.pln_est = '{$sEstudia['pln_est']}' and ";
		$vQuery .= "curso.cod_cur = '{$sEstudia['cod_cur']}' and $tNota.mod_not = '{$sEstudia['mod_not']}' and ";
		$vQuery .= "$tNota.ano_aca = '{$sEstudia['ano_aca']}' and $tNota.per_aca = '{$sEstudia['per_aca']}' and ";
		$vQuery .= "$tNota.num_mat = '{$sEstudia['num_mat']}' ";

		$cNota = fQuery($vQuery);
		if($aNota = $cNota->fetch_array())
		{			
			$sEstudia['nom_cur'] = $aNota['nom_cur'];
			$sEstudia['niv_est'] = $aNota['niv_est'];
			$sEstudia['sem_anu'] = $aNota['sem_anu'];
			$sEstudia['cod_esp'] = $aNota['cod_esp'];
			$sEstudia['not_cur'] = $aNota['not_cur'];
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
		¿Estás seguro de que deseas ELIMINAR la Nota: <br> 
		del curso: <b><?=$sEstudia['nom_cur']?></b> <br>
		de la especialidad: <b><?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']?></b><br>
		del a&ntilde;o: <b><?=$sEstudia['ano_aca']?></b> del periodo: <b><?=$sPeriodo[$sEstudia['per_aca']]['per_des']?></b><br>
		de la modalidad: <b><?=$sModnot[$sEstudia['mod_not']]?></b>, con nota: <span class ="<? if($sEstudia['not_cur'] < 11) echo "notades"; else echo "notapro" ?>"><?=$sEstudia['not_cur']?></span> ?		
		<br>
		<br>
  </div>
	<div align="center">
	<a href="" title="Eliminar" class="linkboton" onClick = "cerrar('1'); return false"><img src="../images/bok.png" width="100" height="24"></a>
    <a href="" title="Cancelar" class="linkboton" onClick = "cerrar('2'); return false"><img src="../images/bundo.png" width="100" height="24"></a>	</div>
</form>

</body>
</html>