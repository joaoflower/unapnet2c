<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$aCurso = "";
		if($sUsercoo['upin'] == 'i')
		{
			$aCurso['cod_car'] = $sUsercoo['cod_car'];
			$aCurso['pln_est'] = $sUsercoo['pln_est'];
			$aCurso['cod_cur'] = $sUsercoo['cod_curx'];
			$aCurso['cod_cat'] = '';
			$aCurso['nom_cur'] = '';
			$aCurso['nom_ofi'] = '';
			$aCurso['hrs_teo'] = 0;
			$aCurso['hrs_pra'] = 0;
			$aCurso['hrs_tot'] = 0;
			$aCurso['crd_cur'] = 0;
			$aCurso['crd_prq'] = 0;
			
			$sUsercoo['cod_cur'] = $sUsercoo['cod_curx'];
		}		
		else
		{
			$vQuery = "Select * from unapnet.curso where cod_cur = '{$sUsercoo['cod_cur']}' and ";
			$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sUsercoo['pln_est']}' ";
			$cCurso = fQuery($vQuery);
			if(!($aCurso = $cCurso->fetch_array()))
			{
				header("Location:../index.php");
			}
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
		var docu = document.fData;
		if(<?=$sPlan[$sUsercoo['pln_est']]?> == 1)
		{
			docu.rCrd_cur.disabled = "disabled";
			docu.rCrd_prq.disabled = "disabled";
		}	
		document.fData.rCod_cat.focus();
	}
	function totalhora()
	{		
		var docu = document.fData;
		docu.rHrs_tot.value = parseInt(docu.rHrs_teo.value) + parseInt(docu.rHrs_pra.value);
		if(<?=$sPlan[$sUsercoo['pln_est']]?> == 2)
			docu.rCrd_cur.value = parseInt(docu.rHrs_teo.value) + (parseInt(docu.rHrs_pra.value) * 0.5);
	}	
	function fcopynamecurso()
	{
		if(document.fData.rNom_ofi.value.length == 0)
		{
			document.fData.rNom_ofi.value = document.fData.rNom_cur.value
		}
		
	}
	
//-->
</script>
</head>

<body onLoad="start();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmaestros.php"; ?>
	
<div class="wordcen" id="body1">
		<form action="pln_savecurso.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Edici&oacute;n de Curso </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			<tr>
              <td width="130" class="wordder">C&oacute;digo:</td>
              <td width="110" class="wordizqb"><?=$aCurso['cod_cur']?></td>
              <td width="120" class="wordder">Plan:</td>
              <td width="110" class="wordizqb"><?=$aCurso['pln_est']?></td>
			</tr>
			<tr>
			  <td class="wordder">Sistema Curricular:  </td>
			  <td class="wordizqb"><?=$sTiposist[$sPlan[$aCurso['pln_est']]]?></td>
		      <td class="wordder">C&oacute;digo de Cat&aacute;logo: </td>
		      <td class="wordizq"><input name="rCod_cat" type="text" class="texto" id="rCod_cat" value="<?=$aCurso['cod_cat']?>" size="6" maxlength="6"></td>
			</tr>
			<tr>
			  <td class="wordder">Nombre de Curso:</td>
			  <td colspan="3" class="wordizq"><input name="rNom_cur" type="text" class="texto" id="rNom_cur" value="<?=$aCurso['nom_cur']?>" size="60" maxlength="50" onBlur="fupper(this); fcopynamecurso();"></td>
	        </tr>
			<tr>
			  <td class="wordder">Nombre Completo:</td>
			  <td colspan="3" class="wordizq"><textarea name="rNom_ofi" cols="65" rows="3" id="rNom_ofi" onBlur="fupper(this)"><?=trim($aCurso['nom_ofi'])?></textarea></td>
	        </tr>
			<tr>
			  <td class="wordder">Nivel:</td>
			  <td class="wordizq"><select name="rNiv_est" id="rNiv_est">
                <?=fviewnivel($aCurso['niv_est'])?>
              </select></td>
			  <td class="wordder">Semestre:</td>
			  <td class="wordizq"><select name="rSem_anu" id="rSem_anu">
                <?=fviewsemestre($aCurso['sem_anu'])?>
                            </select></td>
			</tr>
			<tr>
			  <td class="wordder">Especialidad:</td>
			  <td colspan="3" class="wordizq"><select name="rCod_esp" id="rCod_esp">
                <?=fviewespecial2($aCurso['pln_est'], $aCurso['cod_esp'])?>
                            </select></td>
	        </tr>
			<tr>
			  <td class="wordder">Horas te&oacute;ricas:</td>
			  <td class="wordizq"><input name="rHrs_teo" type="text" class="texto" id="rHrs_teo" value="<?=$aCurso['hrs_teo']?>" size="2" maxlength="2" onBlur="totalhora()"></td>
		      <td class="wordder">Horas pr&aacute;cticas: </td>
		      <td class="wordizq"><input name="rHrs_pra" type="text" class="texto" id="rHrs_pra" value="<?=$aCurso['hrs_pra']?>" size="2" maxlength="2"  onBlur="totalhora()"></td>
			</tr>
			<tr>
			  <td class="wordder">Total de Horas:</td>
			  <td class="wordizq"><input name="rHrs_tot" type="text" class="texto" id="rHrs_tot" value="<?=$aCurso['hrs_tot']?>" size="2" maxlength="2" disabled="disabled"></td>
		      <td class="wordder">Cr&eacute;ditos:</td>
		      <td class="wordizq"><input name="rCrd_cur" type="text" class="texto" id="rCrd_cur" value="<?=$aCurso['crd_cur']?>" size="5" maxlength="5"></td>
			</tr>
			<tr>
			  <td class="wordder">Tipo de Curso:</td>
			  <td class="wordizq"><select name="rTip_cur" id="rTip_cur">
                <?=fviewtipcur($aCurso['tip_cur'])?>
                            </select></td>
		      <td class="wordder">Tipo de Prerequisito:</td>
		      <td class="wordizq"><select name="rTip_pre" id="rTip_pre">
                <?=fviewtippre($aCurso['tip_pre'])?>
                            </select></td>
			</tr>
			<tr>
			  <td class="wordder">Cr&eacute;ditos de prerequisito:</td>
			  <td class="wordizq"><input name="rCrd_prq" type="text" class="texto" id="rCrd_prq" value="<?=$aCurso['crd_prq']?>" size="5" maxlength="5"></td>
		      <td class="wordder">&nbsp;</td>
		      <td class="wordizq">&nbsp;</td>
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
  <a href="" title="Guardar curso" class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
    <a href="pln_selectplan.php" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a></div>
	<? include "../include/pie1.php"; ?>

</body>
</html>