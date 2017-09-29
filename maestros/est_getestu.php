<?php
	session_start();
	include "../include/function.php";
	
	if(fsafetyselcar2())
	{
		$sUsercoo['safetymatri'] = FALSE;
		$sUsercoo['safetymatri2'] = FALSE;
		$sUsercoo['safetymatri3'] = FALSE;
		$sUsercoo['safetymatri4'] = FALSE;
		$sEstudia = "";
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
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>	
	function enfocar()
	{
		document.fData.rNum_mat.focus();
		//document.fdata.rLogin.select();
	}
	function verify()
	{
		document.fData.rCod_nac.value = document.frameUbigeo.frmLibUbigeo.rCod_nac.value;
		document.fData.rCod_dep.value = document.frameUbigeo.frmLibUbigeo.rCod_dep.value;
		document.fData.rCod_prv.value = document.frameUbigeo.frmLibUbigeo.rCod_prv.value;
		document.fData.rCod_dis.value = document.frameUbigeo.frmLibUbigeo.rCod_dis.value;
		
		var Continuar = 1;
		var jj = 0;
		var ch = '8';
		var cMes = document.fData.rMes.value;

		if(document.fData.rNum_doc.value == "")
		{
			alert("El N�mero de Documento no puede estar vacio ... !");
			document.fData.rNum_doc.focus();
			return false;
		}
		if(document.fData.rTip_doc.value == "01")
		{
			for (jj = 0; jj < document.fData.rNum_doc.value.length; jj++)
			{
					ch = document.fData.rNum_doc.value.substring (jj, jj + 1);
					if ( !(ch >= "0" && ch <= "9"))
						Continuar = 0;
			}
			if(!Continuar)
			{
				alert("El N�mero de Documento debe ser num�rico ... !");
				document.fData.rNum_doc.focus();
				return false;
			}
			else
			{
				if(document.fData.rNum_doc.value.length != 8)
				{
					alert("El N�mero de DNI debe de ser 8 caracteres ... !");
					document.fData.rNum_doc.focus();
					return false;
				}
			}
		}		
		if(document.fData.rTip_doc.value == "02" && document.fData.rNum_doc.value.length != 10)
		{
			alert("El N�mero de una Libreta Militar debe de ser de 10 caracteres ... !");
			document.fData.rNum_doc.focus();
			return false;
		}

		if(document.fData.rDia.value == "")
		{
			alert("El D�a de Nacimiento no puede estar vacio ... !");
			document.fData.rDia.focus();
			return false;
		}
		Continuar = 1;
		for (jj = 0; jj < document.fData.rDia.value.length; jj++)
		{
				ch = document.fData.rDia.value.substring (jj, jj + 1);
				if ( !(ch >= "0" && ch <= "9"))
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El D�a de nacimiento debe ser num�rico ... !");
			document.fData.rDia.focus();
			return false;
		}

		if(document.fData.rAno.value == "")
		{
			alert("El A�o de Nacimiento no puede estar vacio ... !");
			document.fData.rAno.focus();
			return false;
		}
		Continuar = 1;
		for (jj = 0; jj < document.fData.rAno.value.length; jj++)
		{
				ch = document.fData.rAno.value.substring (jj, jj + 1);
				if ( !(ch >= "0" && ch <= "9"))
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El A�o de nacimiento debe ser num�rico ... !");
			document.fData.rAno.focus();
			return false;
		}

		if ((cMes == "01" || cMes == "03" || cMes == "05" || cMes == "07" || cMes == "08" || cMes == "10" || cMes == "12" ) &&
			(document.fData.rDia.value > 31 || document.fData.rDia.value < 1))
		{
			alert("El D�a de nacimiento no es valido ... !");
			document.fData.rDia.focus();
			return false;
		}
		if ((cMes == "04" || cMes == "06" || cMes == "09" || cMes == "11" ) &&
			(document.fData.rDia.value > 30 || document.fData.rDia.value < 1))
		{
			alert("El D�a de nacimiento no es valido ... !");
			document.fData.rDia.focus();
			return false;
		}
		if ((cMes == "02") && (document.fData.rDia.value > 28 || document.fData.rDia.value < 1) &&
			document.fData.rAno.value % 4 != 0)
		{
			alert("El D�a de nacimiento no es valido ... !");
			document.fData.rDia.focus();
			return false;
		}
		if ((cMes == "02") && (document.fData.rDia.value > 29 || document.fData.rDia.value < 1) &&
			document.fData.rAno.value % 4 == 0)
		{
			alert("El D�a de nacimiento no es valido ... !");
			document.fData.rDia.focus();
			return false;
		}
		if(document.fData.rDirec.value == "")
		{
			alert("La direcci�n no puede estar vacia ... !");
			document.fData.rDirec.focus();
			return false;
		}
		Continuar = 1;
		for (jj = 0; jj < document.fData.rFono.value.length; jj++)
		{
				ch = document.fData.rFono.value.substring (jj, jj + 1);
				if ( !(ch >= "0" && ch <= "9"))
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El Tel�fono debe ser num�rico ... !");
			document.fData.rFono.focus();
			return false;
		}
		Continuar = 1;
		for (jj = 0; jj < document.fData.rCelular.value.length; jj++)
		{
				ch = document.fData.rCelular.value.substring (jj, jj + 1);
				if ( !(ch >= "0" && ch <= "9"))
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El Celular debe ser num�rico ... !");
			document.fData.rCelular.focus();
			return false;
		}
		return true;		
	}
	function verifyname()
	{
		if(document.fData.rRes_cam.value == "")
		{
			alert("Tiene que ingresar la RESOLUCION RECTORAL u otro documento que acredite el Cambio del Nombre");
			document.fData.rRes_cam.focus();
			return false;
		}
		return true;		
	}
	
//-->
</script>
<script type="text/javascript" src="../script/ggw3.js"></script>
</head>

<body onLoad="enfocar();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmaestros.php"; ?>
	
<div class="wordcen" id="body1">
	  <form action="est_search.php" method="post" enctype="multipart/form-data" name="fData" id="fData">	  
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Estudiantes Universitarios</th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="0" class="tabled">
                <tr>
                  <th width="15" class="wordizq">&nbsp;</th>
                  <th width="60" class="wordizq">N&deg; Mat. </th>
                  <th width="140" class="wordizq">Paterno</th>
                  <th width="140" class="wordizq">Materno</th>
                  <th width="170" class="wordizq">Nombres</th>
                  <th width="16" class="wordizq">&nbsp;</th>
                </tr>
                <tr>
                  <th class="wordizq	">&nbsp;</th>
                  <th class="wordizq	"><input name="rNum_mat" type="text" class="texto" id="rNum_mat" size="6" maxlength="6"  onBlur="searchest();" >
                  </span></th>
                  <th class="wordizq"><input name="rPaterno" type="text" class="texto" id="rPaterno" onBlur="searchest();" size="20" maxlength="20" ></th>
                  <th class="wordizq"><input name="rMaterno" type="text" class="texto" id="rMaterno" size="20" maxlength="20" onBlur="searchest();" ></th>
                  <th class="wordizq"><input name="rNombres" type="text" class="texto" id="rNombres" size="25" maxlength="30" onBlur="searchest();" ></th>
                  <th class="wordizq">&nbsp;</th>
                </tr>
                <tr>
                  <td colspan="6" class="wordder"><div id="dresultado"></div></td>
                </tr>
            </table></td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>
	    <div id="ddatos"></div>
	  </form>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>