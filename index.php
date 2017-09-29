<?php
	session_start();
	unset($sUsercoo);
	unset($sConedb);
	unset($sAcceso);
	
	unset($sAreaca); 
	unset($sCodhora);
	unset($sCondestu);
	unset($sEspecial);
	unset($sEstcivil);
	unset($sFacultad);
	unset($sGrupo);
	unset($sModing);
	unset($sModingn);
	unset($sModmat);
	unset($sModnot);
	unset($sNacional);
	unset($sNivel);
	unset($sNivusu);
	unset($sPlan);
	unset($sSemestre);
	unset($sTipcur);
	unset($sTipodoc);
	unset($sTipomat);
	unset($sTiposist);
	unset($sTippre);
	unset($sTurno);
	unset($sCredisem);
	unset($sCredicar);
	unset($sTarifapago);
	unset($sVecesdes);
	unset($sExocar);
	unset($sExoestu);
	unset($sApemat);
	unset($sRatmat);
	unset($sResmat);
	unset($sMdfmat);
	
	unset($sEstukey);
	unset($sEstucdo);
	
	unset($sEstudia);
	unset($sMes);
	unset($sSexo);
	unset($sFching);
	unset($sCurso);
	unset($sCurmat);
	unset($sCurmat2);
	unset($sCurmatc);
	unset($sCurapto);
	unset($sCursopdf);
	unset($sEstupdf);
	unset($sNotapdf);
	unset($sPDF);
	
	unset($sGradocar);
	unset($sCuadropro);
	
	session_destroy();

	session_start();
	include "include/function.php";
	include "include/funcsql.php";

	session_register("sUsercoo");
	session_register("sConedb");
	session_register("sAcceso");	
	
	session_register("sAreaca");
	session_register("sCodhora");
	session_register("sCondestu");
	session_register("sEspecial");
	session_register("sEstcivil");
	session_register("sFacultad");
	session_register("sGrupo");
	session_register("sModing");
	session_register("sModingn");
	session_register("sModmat");
	session_register("sModnot");
	session_register("sNacional");
	session_register("sNivel");
	session_register("sNivusu");
	session_register("sPlan");
	session_register("sSemestre");
	session_register("sTipcur");
	session_register("sTipodoc");
	session_register("sTipomat");
	session_register("sTiposist");
	session_register("sTippre");
	session_register("sTurno");
	session_register("sCredisem");
	session_register("sCredicar");
	session_register("sTarifapago");
	session_register("sVecesdes");
	session_register("sExocar");
	session_register("sExoestu");
	session_register("sApemat");
	session_register("sRatmat");
	session_register("sResmat");
	session_register("sMdfmat");
	
	session_register("sEstukey");
	session_register("sEstucdo");
	
	session_register("sEstudia");
	session_register("sMes");
	session_register("sSexo");
	session_register("sFching");
	session_register("sCurso");
	session_register("sCurmat");
	session_register("sCurmat2");
	session_register("sCurmatc");
	session_register("sCurapto");
	session_register("sCursopdf");
	session_register("sEstupdf");
	session_register("sNotapdf");
	session_register("sPDF");
	session_register("sPre");
	session_register("sNotas");
	session_register("sIngnota");
	
	session_register("sGradocar");
	session_register("sCuadropro");

	finit();
//	finitu();	

	$sUsercoo['errorl'] = FALSE;
	$sUsercoo['msnerror'] = '';
//	header("Location:index2.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Un@p.Net2</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
<!--

	function cerrar()
	{
		window.open('index2.php','unapnet2', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=640,height=480'); 
		var ventana = window.self;
		ventana.opener = window.self;
		parent.close();


	}
//-->
</script>
</head>

<body onLoad="cerrar();">
</body>
</html>
