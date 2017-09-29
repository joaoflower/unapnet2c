<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
//		$sEstudia['num_mat'] = $_GET['rNum_mat'];
//		$sEstudia['num_mat'] = $_GET['rNum_mat'];
		
//		$sEstudia = "";
		$sCurso = "";
		$sCurmat = "";
		$sCurapto = "";

		$vQuery = "Select tip_doc, num_doc, fch_nac, sexo, est_civ, ";
		$vQuery .= "cod_nac, cod_dep, cod_prv, cod_dis, direc, fono, mod_ing, fch_ing, celular ";
		$vQuery .= "from unapnet.estudiante where num_mat = '{$sEstudia['num_mat']}' and ";
		$vQuery .= "cod_car = '{$sEstudia['cod_car']}' and con_est = '5' ";
		$cEstudia = fQuery($vQuery);
		if($aEstudia = $cEstudia->fetch_array())
		{			
			$sEstudia['tip_doc'] = $aEstudia['tip_doc'];
			$sEstudia['num_doc'] = $aEstudia['num_doc'];
			$sEstudia['fch_nac'] = $aEstudia['fch_nac'];
			$sEstudia['dia'] = substr($aEstudia['fch_nac'], 8, 2);
			$sEstudia['mes'] = substr($aEstudia['fch_nac'], 5, 2);
			$sEstudia['ano'] = substr($aEstudia['fch_nac'], 2, 2);
			$sEstudia['sexo'] = $aEstudia['sexo'];
			$sEstudia['est_civ'] = $aEstudia['est_civ'];
			$sEstudia['cod_nac'] = $aEstudia['cod_nac'];
			$sEstudia['cod_dep'] = $aEstudia['cod_dep'];
			$sEstudia['cod_prv'] = $aEstudia['cod_prv'];
			$sEstudia['cod_dis'] = $aEstudia['cod_dis'];
			$sEstudia['direc'] = $aEstudia['direc'];
			$sEstudia['fono'] = $aEstudia['fono'];
			$sEstudia['mod_ing'] = $aEstudia['mod_ing'];
			$sEstudia['fch_ing'] = $aEstudia['fch_ing'];
			$sEstudia['celular'] = $aEstudia['celular'];
			
			$cEstudia->close();
			$sUsercoo['safetymatri'] = TRUE;
		}
		else
		{
			$cEstudia->close();
			header("Location:ing_getestu.php");
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
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>	
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
			alert("El Número de Documento no puede estar vacio ... !");
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
				alert("El Número de Documento debe ser numérico ... !");
				document.fData.rNum_doc.focus();
				return false;
			}
			else
			{
				if(document.fData.rNum_doc.value.length != 8)
				{
					alert("El Número de DNI debe de ser 8 caracteres ... !");
					document.fData.rNum_doc.focus();
					return false;
				}
			}
		}		
		if(document.fData.rTip_doc.value == "02" && document.fData.rNum_doc.value.length != 10)
		{
			alert("El Número de una Libreta Militar debe de ser de 10 caracteres ... !");
			document.fData.rNum_doc.focus();
			return false;
		}

		if(document.fData.rDia.value == "")
		{
			alert("El Día de Nacimiento no puede estar vacio ... !");
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
			alert("El Día de nacimiento debe ser numérico ... !");
			document.fData.rDia.focus();
			return false;
		}

		if(document.fData.rAno.value == "")
		{
			alert("El Año de Nacimiento no puede estar vacio ... !");
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
			alert("El Año de nacimiento debe ser numérico ... !");
			document.fData.rAno.focus();
			return false;
		}

		if ((cMes == "01" || cMes == "03" || cMes == "05" || cMes == "07" || cMes == "08" || cMes == "10" || cMes == "12" ) &&
			(document.fData.rDia.value > 31 || document.fData.rDia.value < 1))
		{
			alert("El Día de nacimiento no es valido ... !");
			document.fData.rDia.focus();
			return false;
		}
		if ((cMes == "04" || cMes == "06" || cMes == "09" || cMes == "11" ) &&
			(document.fData.rDia.value > 30 || document.fData.rDia.value < 1))
		{
			alert("El Día de nacimiento no es valido ... !");
			document.fData.rDia.focus();
			return false;
		}
		if ((cMes == "02") && (document.fData.rDia.value > 28 || document.fData.rDia.value < 1) &&
			document.fData.rAno.value % 4 != 0)
		{
			alert("El Día de nacimiento no es valido ... !");
			document.fData.rDia.focus();
			return false;
		}
		if ((cMes == "02") && (document.fData.rDia.value > 29 || document.fData.rDia.value < 1) &&
			document.fData.rAno.value % 4 == 0)
		{
			alert("El Día de nacimiento no es valido ... !");
			document.fData.rDia.focus();
			return false;
		}
		if(document.fData.rDirec.value == "")
		{
			alert("La dirección no puede estar vacia ... !");
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
			alert("El Teléfono debe ser numérico ... !");
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
			alert("El Celular debe ser numérico ... !");
			document.fData.rCelular.focus();
			return false;
		}

		return true;
	}
//-->
</script>
</head>

<body >
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	<div class="wordcen" id="body1">
		<form action="ing_savest.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	  <span class="wordi">
	  <? if($sUsercoo['error1']) echo $sUsercoo['msnerror'];  $sUsercoo['error1'] = false;?>
      </span>	  
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Datos principales del Estudiante </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg"><table width="400" border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
			<tr>
              <td width="75" class="wordder">Estudiante : </td>
              <td class="wordizqb"><?=$sEstudia['num_mat']?> - <?=$sEstudia['paterno']?> <?=$sEstudia['materno']?>, <?=$sEstudia['nombres']?></td>
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
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Datos de Ingreso</th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg"><table width="500" border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
              <tr>
                <td width="70" class="wordder">Modalidad : </td>
                <td width="180" class="wordizqb"><select name="rMod_ing" id="rMod_ing"> 
					<?=fviewmoding($sEstudia['mod_ing'])?>
                </select></td>
                <td width="70" class="wordder">Fecha : </td>
                <td width="180" class="wordizqb"><select name="rFch_ing" id="rFch_ing">
					<?=fviewfechaing($sEstudia['fch_ing'])?>
                </select></td>
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
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Datos Personales del estudiante </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg"><table width="500" border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
              <tr>
                <td width="70" class="wordder">Tipo Docum.</td>
                <td width="180" class="wordizq"><select name="rTip_doc" id="select5">
                  <?=fviewtipodoc($sEstudia['tip_doc'])?>
                </select></td>
                <td width="70" class="wordder">Num. Doc. : </td>
                <td width="180" class="wordizq"><input name="rNum_doc" type="text" class="texto" id="rNum_doc" value="<?=$sEstudia['num_doc']?>" size="10" maxlength="10"></td>
              </tr>
              <tr>
                <td class="wordder">Fecha Nac. : </td>
                <td class="wordizq"><input name="rDia" type="text" class="texto" id="rDia" value="<?=$sEstudia['dia']?>" size="2" maxlength="2">                  
                  <select name="rMes" class="ocombo" id="select6">
    <?=fviewmes($sEstudia['mes'])?>
  </select>
19
<input name="rAno" type="text" class="texto" id="rAno" value="<?=$sEstudia['ano']?>" size="2" maxlength="2"></td>
                <td class="wordder">Sexo : </td>
                <td class="wordizq"><select name="rSexo" id="select3">
                  <?=fviewsexo($sEstudia['sexo'])?>
                                </select></td>
              </tr>
              <tr>
                <td class="wordder">Estado Civil : </td>
                <td class="wordizq"><select name="rEst_civ" id="select4">
                    <?=fviewestcivil($sEstudia['est_civ'])?>
                </select>                </td>
                <td class="wordder">Direcci&oacute;n : </td>
                <td class="wordizq"><input name="rDirec" type="text" class="texto" id="rNum_doc3" value="<?=$sEstudia['direc']?>" size="28" maxlength="50"></td>
              </tr>
              <tr>
                <td class="wordder">Tel&eacute;fono : </td>
                <td class="wordizq"><input name="rFono" type="text" class="texto" id="rNum_doc4" value="<?=$sEstudia['fono']?>" size="10" maxlength="10"></td>
                <td class="wordder">Celular : </td>
                <td class="wordizq"><input name="rCelular" type="text" class="texto" id="rNum_doc5" value="<?=$sEstudia['celular']?>" size="10" maxlength="10"></td>
              </tr>
              <tr>
                <td height="24" colspan="4" class="wordder"><iframe width="500"  name ="frameUbigeo"  height="50" id="frameUbigeo" src="ing_ubigeo.php"  scrolling="no" frameborder="0" >
                </iframe><input name="rCod_nac" type="hidden" id="rCod_nac" value="">
                <input name="rCod_dep" type="hidden" id="rCod_dep" value="">
                <input name="rCod_prv" type="hidden" id="rCod_prv" value="">
                <input name="rCod_dis" type="hidden" id="rCod_nac42" value=""></td>
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
        </form>
		
		<a href="" title="Guardar" class="linkboton" onClick = "if(verify()){ document.fData.submit();} return false;"><img src="../images/bsave.png" width="100" height="24"></a> 
  <a href="ing_getestu.php" title="Cancelar" class="linkboton" ><img src="../images/bcancel.png" width="100" height="24"></a>
		
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>