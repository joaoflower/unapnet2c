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
		$sUsercoo['hiscon'] = 'c';
		$sUsercoo['obs_not'] = "";
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
	function del_nota(pln_est, cod_cur, mod_not, ano_aca, per_aca)
	{
		var vReturn;
		var vAtributo;
		vAtributo = "center=yes; dialogHeight=210px; dialogWidth=530px; dialogLeft=px; dialogTop=px; ";
		vAtributo += "help=no; status=no; scroll=no; resizable=no; font-family=Arial; font-size=11px";

		vReturn = window.showModalDialog("msn_delnota.php?rPln_est="+pln_est+"&rCod_cur="+cod_cur+"&rMod_not="+mod_not+"&rAno_aca="+ano_aca+"&rPer_aca="+per_aca, "mensaje", vAtributo);
		if(vReturn == '1')
		{
			delnotaest();
		}
	}
	
	
//-->
</script>
<script type="text/javascript" src="../script/ggw3.js"></script>
</head>

<body onLoad="enfocar();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmaestros.php"; ?>
	
<div class="wordcen" id="body1">
	  <form action="" method="post" enctype="multipart/form-data" name="fData" id="fData">	  
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Habilitar cursos - Planes de Estudio </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			<tr>
              <td class="wordder">Plan de Estudios : </td>
              <td width="300" class="wordizq"><select name="rPln_est" id="rPln_est" onChange="hac_getgrupo(this.value)" onFocus="hac_getgrupo(this.value)">
			  	<?=fviewplan('')?>
                </select></td>
            </tr>
			<tr>
			  <td class="wordder">Grupo : </td>
			  <td class="wordizq"  id="xGrupo"><select name="rSec_gru" id="rSec_gru" disabled="disabled">
			    <option value="99">Seleccione Plan de Estudios ...</option>                  
                </select></td>
		    </tr>
			<tr>
              <td class="wordder">Semestre : </td>
			  <td class="wordizq"  id="xSemestre"><select name="rSem_anu" id="rSem_anu" disabled="disabled">
                  <option value="99" selected>Seleccione Grupo ...</option>
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
	    <div id="ddatos"></div>
		
  </form>
</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>