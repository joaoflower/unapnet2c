<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{
		$sEstudia = "";
		$sEstudia['pln_est'] = $_GET['rPln_est'];
		$sEstudia['cod_cur'] = $_GET['rCod_cur'];
		$sEstudia['sec_gru'] = $_GET['rSec_gru'];
		$sEstudia['mod_not'] = $_GET['rMod_not'];
		$sEstudia['ano_aca'] = $sUsercoo['ano_aca'];
		$sEstudia['per_aca'] = $sUsercoo['per_aca'];

		$tApla = "unapnet.apla{$sUsercoo['ano_aca']}";
		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
		$tActa = "unapnet.acta{$sUsercoo['ano_aca']}";
		$tCarga = "unapnet.carga{$sUsercoo['ano_aca']}";
		
		$vQuery = "Select curso.nom_cur, curso.niv_est, curso.sem_anu, curso.cod_esp ";
		$vQuery .= "from unapnet.curso ";
		$vQuery .= "where curso.cod_car = '{$sUsercoo['cod_car']}' and curso.pln_est = '{$sEstudia['pln_est']}' and ";
		$vQuery .= "curso.cod_cur = '{$sEstudia['cod_cur']}' ";

		$cCurmat = fQuery($vQuery);
		if($aCurmat = $cCurmat->fetch_array())
		{			
			$sEstudia['nom_cur'] = $aCurmat['nom_cur'];
			$sEstudia['niv_est'] = $aCurmat['niv_est'];
			$sEstudia['sem_anu'] = $aCurmat['sem_anu'];
			$sEstudia['cod_esp'] = $aCurmat['cod_esp'];
		}	
		else
		{
			header("Location:../index.php");
		}		
		
		$vQuery = "Select cod_act from $tActa ";
		$vQuery .= "where cod_car = '{$sUsercoo['cod_car']}' and per_aca = '{$sUsercoo['per_aca']}' and ";
		$vQuery .= "pln_est = '{$sEstudia['pln_est']}' and cod_cur = '{$sEstudia['cod_cur']}' and ";
		$vQuery .= "sec_gru = '{$sEstudia['sec_gru']}' and mod_mat = '{$sEstudia['mod_not']}' ";

		$cActa = fQuery($vQuery);
		if($aActa = $cActa->fetch_array())
		{			
			$sEstudia['cod_act'] = $aActa['cod_act'];
		}	
				
		///
		$vQuery = "Select ca.cod_prf, concat(do.paterno, ' ', do.materno, ', ', do.nombres) as nombre ";
		$vQuery .= "from $tCarga ca left join unapnet.docente do on ca.cod_prf = do.cod_prf ";
		$vQuery .= "where ca.cod_car = '{$sUsercoo['cod_car']}' and ca.per_aca = '{$sUsercoo['per_aca']}' and ";
		$vQuery .= "ca.pln_est = '{$sEstudia['pln_est']}' and ca.cod_cur = '{$sEstudia['cod_cur']}' and ";
		$vQuery .= "ca.sec_gru = '{$sEstudia['sec_gru']}' and ca.mod_mat = '{$sEstudia['mod_not']}' ";

		$cDocente = fQuery($vQuery);
		if($aDocente = $cDocente->fetch_array())
		{			
			$sEstudia['nom_doc'] = $aDocente['nombre'];
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
		viewreevalnota();
		//document.fData.rPln_est.focus();
	}
	function del_estureeval(num_mat)
	{
		var vReturn;
		var vAtributo;
		vAtributo = "center=yes; dialogHeight=210px; dialogWidth=530px; dialogLeft=px; dialogTop=px; ";
		vAtributo += "help=no; status=no; scroll=no; resizable=no; font-family=Arial; font-size=11px";

		vReturn = window.showModalDialog("msn_delestureeval.php?rNum_mat="+num_mat, "mensaje", vAtributo);
		if(vReturn == '1')
		{
			window.location.href = "rva_delestureeval.php";
		}
	}

//-->
</script>
</head>

<body onLoad="start();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmaestros.php"; ?>
	
<div class="wordcen" id="body1">
		<form action="rva_saveestu.php" method="post" enctype="multipart/form-data" name="fData" id="fData">
		<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Datos del Curso de Reevaluaci&oacute;n y/o Aplazado </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="1" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			<tr>
              <td width="120" class="wordder">Plan-C&oacute;digo:</td>
              <td width="110" class="tdcampo">&nbsp;<?=$sEstudia['cod_cur']?>-<?=$sEstudia['pln_est']?></td>
              <td width="120" class="wordder">Acta:</td>
              <td width="110" class="tdcampo">&nbsp;<?=(empty($sEstudia['cod_act'])?"NO EMITIDO":$sEstudia['cod_act'])?></td>
			</tr>
			<tr>
			  <td class="wordder">Nombre de Curso:</td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['nom_cur']?></td>
	        </tr>
			<tr>
			  <td class="wordder">Nivel:</td>
			  <td class="tdcampo">&nbsp;<?=$sNivel[$sEstudia['niv_est']]?></td>
			  <td class="wordder">Semestre:</td>
			  <td class="tdcampo">&nbsp;<?=$sSemestre[$sEstudia['sem_anu']]?></td>
			</tr>
			<tr>
			  <td class="wordder">Especialidad:</td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']?></td>
	        </tr>
			<tr>
              <td class="wordder">Grupo: </td>
			  <td class="tdcampo">&nbsp;<?=$sGrupo[$sEstudia['sec_gru']]?></td>
			  <td class="wordder">Modalidad:</td>
			  <td class="tdcampo">&nbsp;<?=$sModnot[$sEstudia['mod_not']]?></td>
		    </tr>
			<tr>
			  <td class="wordder">Docente:</td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['nom_doc']?></td>
		    </tr>
			
			<tr>
			  <td colspan="4" class="wordcen"></td>
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