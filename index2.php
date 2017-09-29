<?php
	session_start();
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
	function enfocar()
	{
		document.fLogin.rLogin.focus();
		//document.fdata.rLogin.select();
	}
	
	function verify()
	{
		var Continuar = 1;
		var jj = 0;
		var ch = '8';

		if(document.fLogin.rLogin.value.length < 4 )
		{
			alert("El Login debe de tener al menos 4 caracteres ... !");
			document.fLogin.rLogin.focus();
			return false;
		}
		for (jj = 0; jj < document.fLogin.rLogin.value.length; jj++)
		{
				ch = document.fLogin.rLogin.value.substring (jj, jj + 1);
				if ( ch == ' ')
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El Login no debe de tener espacios en blanco ... !");
			document.fLogin.rLogin.focus();
			return false;
		}
		ch = document.fLogin.rLogin.value.substring (0,1);
		if (!(ch >= "a" && ch <= "z"))
		{
			alert("El el primer caracter debe ser una letra del abecedario en minuscula ... !");
			document.fLogin.rLogin.focus();
			return false;
		}
		Continuar = 1;
		for (jj = 0; jj < document.fLogin.rLogin.value.length; jj++)
		{
				ch = document.fLogin.rLogin.value.substring (jj, jj + 1);
				if ( !((ch >= "a" && ch <= "z") || (ch == "_") || (ch == "-") || (ch >= "0" && ch <= "9")) )
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("En el Login existen caracteres que no son validos o estan en mayuscula");
			document.fLogin.rLogin.focus();
			return false;
		}
        if(document.fLogin.rPasswd.value.length < 4 )
		{
			alert("La Contraseña debe de tener al menos 4 caracters ... !");
			document.fLogin.rPasswd.focus();
			return false;
		}
		return true;
	}

//-->
</script>
</head>
<body onLoad="enfocar();">
	<center>
	<form action="verify.php" method="post" enctype="multipart/form-data" name="fLogin" id="fLogin"> 
	<div id="bodylogin">
		<div class="headercol"><img name="logo1" src="images/cabezalogin.jpg" width="300" height="70" border="0" alt=""></div>	
		<div class="collogin">			
				<span class="wordi"><? if ($sUsercoo['errorl']) echo $sUsercoo['msnerror'];  $sUsercoo['msnerror'] = "";?></span>			  
				<table width="250" border="0" cellpadding="2" cellspacing="0" class="tabled">

					<tr>
					  <td class="wordderb">Login : </td>
					  <td class="wordizq"><input name="rLogin" type="text" class="texto" id="rLogin" value="<?=$sUsercoo['login']?>" size="15" maxlength="20"></td>
					</tr>
					<tr>
					  <td class="wordderb">Contrase&ntilde;a : </td>
					  <td class="wordizq"><input name="rPasswd" type="password" class="texto" id="rPasswd" size="10" maxlength="15"></td>
					</tr>
					<tr>
					  <td colspan="2" align=center>
					  <a href="" title="Continuar" class="linkboton" onClick = "if(verify()){ document.fLogin.submit();} return false"><img src="images/benter.png" width="100" height="24"></a> 
	  <a href="" onClick="cerrar()" title="Cancelar" class="linkboton" ><img src="images/bcancel.png" width="100" height="24"></a></td>
				  </tr>
			  </table>
		  
		</div>
	  </div>
	  </form>	  
	</center>
	
	<!-- Search Google -->
	<center>
	</center>
	<!-- Search Google -->


</body>
</html>
