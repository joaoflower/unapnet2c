<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$aCurso = "";
		if($sUsercoo['upin'] == 'i')
		{
			/*$sUsercoo['pln_est'] = '10';
			$vQuery = "Select max(cod_esp) as cod_esp from unapnet.especial where cod_car = '{$sUsercoo['cod_car']}' and ";
			$vQuery .= "pln_est = '{$sUsercoo['pln_est']}' ";
			$cMax = fQuery($vQuery);
			if($aMax = $cMax->fetch_array())
			{
				$aMax['cod_esp']++;
				if(strlen($aMax['cod_esp']) == 1)				
					$aMax['cod_esp'] = '0'.$aMax['cod_esp'];
			}
			$sUsercoo['cod_espx'] = (empty($aMax['cod_esp'])?'01':$aMax['cod_esp']);*/
			$sUsercoo['upin'] = 'i';
			
			$aCurso['cod_car'] = $sUsercoo['cod_car'];
			$aCurso['pln_est'] = $sUsercoo['pln_est'];
			//$aCurso['cod_esp'] = $sUsercoo['cod_espx'];
			$aCurso['nom_esp'] = '';
			
			//$sUsercoo['cod_esp'] = $sUsercoo['cod_espx'];
		}		
		else
		{
			$vQuery = "Select * from unapnet.especial where cod_esp = '{$sUsercoo['cod_esp']}' and ";
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
		<form action="esp_saveesp.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Edici&oacute;n de Especialidad </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			<tr>
              <td width="130" class="wordder">Plan :</td>
              <td width="110" class="wordizqb"><select name="rPln_est" id="rPln_est" >
                <?=fviewplan($sUsercoo['pln_est'])?>
              </select></td>
              <td width="120" class="wordder">:</td>
              <td width="110" class="wordizqb">&nbsp;</td>
			</tr>
			<tr>
			  <td class="wordder">Nombre de Curso:</td>
			  <td colspan="3" class="wordizq"><input name="rNom_esp" type="text" class="texto" id="rNom_esp" value="<?=$aCurso['nom_esp']?>" size="60" maxlength="50" onBlur="fupper(this); fcopynamecurso();"></td>
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
    <a href="esp_viewesp.php" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a></div>
	<? include "../include/pie1.php"; ?>

</body>
</html>