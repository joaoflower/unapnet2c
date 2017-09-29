<?php
	session_start();	
	include "include/function.php";
	include "include/funcsql.php";
	
	if (fsafetylogin())
	{
		session_register("sCarrera");
		session_register("sPeriodo");
		
		//-------------------------------------------------------------------------
		//$vQuery = "Select cod_car, car_des from unapnet.carrera where (cod_car < '37' or cod_car = '56' or cod_car = '65' or cod_car = '66') and cod_car <> '19'";
		$vQuery = "Select cod_car, car_des from unapnet.carrera ";
		$cCarrera = fQuery($vQuery);
		while($aCarrera = $cCarrera->fetch_array())
			$sCarrera[$aCarrera['cod_car']] = $aCarrera['car_des'];
//		$cCarrera->close();
		
		//-------------------------------------------------------------------------
		$vQuery = "Select per_aca, per_des, abr_per from unapnet.periodo";
		$cPeriodo = fQuery($vQuery);
		while($aPeriodo = $cPeriodo->fetch_array())
		{
			$sPeriodo[$aPeriodo['per_aca']]['per_des'] = $aPeriodo['per_des'];
			$sPeriodo[$aPeriodo['per_aca']]['abr_per'] = $aPeriodo['abr_per'];
		}
		//$cPeriodo->close();
				
	}
	else
	{
		header("Location:index.php");
	}	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Un@p.Net2</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<STYLE type=text/css>
@import url( style/unapnet2.css );
</STYLE>
<script language="JavaScript" type="text/JavaScript">
<!--

	window.moveTo(0,0);
	if (document.all)
   {
      top.window.resizeTo(screen.availWidth,screen.availHeight);
   }
   else if (document.layers||document.getElementById)
   {
      if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth)
      {
         top.window.outerHeight = screen.availHeight;
         top.window.outerWidth = screen.availWidth;
      }
   }

	function MM_reloadPage(init) {  //reloads the window if Nav4 resized
	  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
		document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
	  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
	}
	MM_reloadPage(true);
	function cerrar() 
	{
		var ventana = window.self;
		ventana.opener = window.self;
		parent.close();
	}
	function verify()
	{
		var cont = 0;
		var marcado = false;
		for(cont = 0; cont < <?=$sUsercoo['can_car']?>; cont++)
		{
			if(document.fData.rCod_car[cont].checked)
				marcado = true;
		}
		if (marcado == false)
		{
			alert("Seleccione una Carrera Profesional ...!");
			return false;
		}
		return true;
	}

</script>
</head>
<body >
	<center>
	<form action="verifyselcar.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	<div id="bodyselectcar">
		<div class="headercol"><img name="logo2" src="images/cabezaselectcar.jpg" width="350" height="70" border="0" alt=""></div>
		<div class="headercol">
			<table width="240" border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">

					<tr>
					  <th width="20">&nbsp; </th>
					  <th width="20">C</th>
					  <th width="200">Denominaci&oacute;n</th>
					</tr>
					<? 	$vCont = 1;	foreach($sAcceso as $vCod_Car => $aAcceso) { ?>
					<tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?> >
					  <td><input name="rCod_car" type="radio" class="radio" value="<?=$vCod_Car?>" <?=($sUsercoo['cod_car'] == $vCod_Car ? "checked":"")?>></td>
					  <td><?=$vCod_Car?></td>
					  <td class="wordizq"><?=ucwords(strtolower($sCarrera[$vCod_Car]))?></td>
	  		  </tr>
					<? $vCont++; 	} ?>
		  </table>
	  	</div>
		<div class="headercol">
		<table width="110" border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
          <tr>
            <th width="110">A&ntilde;o Acad. </th>
          </tr>
          <tr>
            <td align="center"><select name="rAno_aca" id="rAno_aca">
			<?php 
				if(empty($sUsercoo['ano_aca']))		$sUsercoo['ano_aca'] = '2009';
				for($vCont = 2009; $vCont >= 1999; $vCont--)
				{
					echo "<option value=\"$vCont\" " .($sUsercoo['ano_aca'] == $vCont ? "Selected":""). ">$vCont</option>\n";
				}
			?>
            </select></td>
          </tr>
          <tr>
            <th>Periodo</th>
          </tr>
          <tr>
            <td align="center"><select name="rPer_aca" id="rPer_aca">
				<? if(!empty($sUsercoo['per_aca'])) echo fviewperiodo($sUsercoo['per_aca']); 	else 	echo fviewperiodo('01');?>
            </select></td>
          </tr>
          <tr>
            <td align="center"><input name="Submit" type="submit" class="boton" value="Aceptar" onClick = "if(verify()){ document.fData.submit();} return false"></td>
          </tr>
          <tr>
            <td align="center"><a href="" onClick="cerrar()" title="Cancelar" class="linkboton" ><img src="images/bcancel.png" width="100" height="24"></a></td>
          </tr>
        </table>
		</div>
	</div>
	</form>
	</center>
</body>
</html>