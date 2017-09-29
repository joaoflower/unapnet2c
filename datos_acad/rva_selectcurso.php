<?php
	session_start();
	include "../include/function.php";
	
	if(fsafetyselcar())
	{
		$sUsercoo['safetymatri'] = FALSE;
		$sUsercoo['safetymatri2'] = FALSE;
		$sUsercoo['safetymatri3'] = FALSE;
		$sUsercoo['safetymatri4'] = FALSE;
		$sEstudia = "";
		$sUsercoo['hiscon'] = 'c';
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
		document.fData.rNom_cur.focus();
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
	  <form action="rva_saveestu.php" method="post" enctype="multipart/form-data" name="fData" id="fData">	  
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Reevaluaciones y/o Aplazados </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="0" class="tabled">
                <tr>
                  <th width="15" class="wordizq">&nbsp;</th>
                  <th width="35" class="wordizq">Plan</th>
                  <th width="35" class="wordizq">Cod</th>
                  <th width="260" class="wordizq">Nombre de Curso </th>
                  <th width="35" class="wordizq">Niv</th>
                  <th width="35" class="wordizq">Sem</th>
                  <th width="20" class="wordizq">Es</th>
                  <th width="47" class="wordizq">Grupo</th>
                  <th width="16" class="wordizq">&nbsp;</th>
                </tr>
                <tr>
                  <th class="wordizq">&nbsp;</th>
                  <th class="wordizq"><input name="rPln_est" type="text" class="texto" id="rPln_est" size="1" maxlength="2"  onBlur="searchreevalcurso();" ></th>
                  <th class="wordizq"><input name="rCod_cur" type="text" class="texto" id="rCod_cur" size="1" maxlength="3"  onBlur="searchreevalcurso();" ></th>
                  <th class="wordizq"><input name="rNom_cur" type="text" class="texto" id="rNom_cur" onBlur="searchreevalcurso();" size="45" maxlength="40" ></th>
                  <th class="wordizq"><input name="rNiv_est" type="text" class="texto" id="rNiv_est" size="1" maxlength="2" onBlur="searchreevalcurso();" ></th>
                  <th class="wordizq"><input name="rSem_anu" type="text" class="texto" id="rSem_anu" size="1" maxlength="2" onBlur="searchreevalcurso();" ></th>
                  <th class="wordizq">&nbsp;</th>
                  <th class="wordizq">&nbsp;</th>
                  <th class="wordizq">&nbsp;</th>
                </tr>
                <tr>
                  <td colspan="9" class="wordder"></td>
                </tr>
            </table>
            <div id="dresultado"></div></td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>
	    <div id="ddatos"></div>
		<div id="ddatos2"></div>
		<a href="rva_selectsem.php" title="Ver reevaluaciones" class="linkboton"><img src="../images/bviewreeval.png" width="100" height="24"></a>
		
  </form>
</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>