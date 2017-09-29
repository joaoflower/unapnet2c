<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{
		if(!empty($_GET['rCod_cur']))
			$sUsercoo['cod_cur'] = $_GET['rCod_cur'];

		$vQuery = "Select * from unapnet.curso where cod_cur = '{$sUsercoo['cod_cur']}' and cod_car = '{$sUsercoo['cod_car']}' ";
		$vQuery .= "and pln_est = '{$sUsercoo['pln_est']}' ";
		$cCurso = fQuery($vQuery);
		if(!($aCurso = $cCurso->fetch_array()))
		{			
			header("Location:../index.php");
		}					
		$sUsercoo['nom_cur'] = $aCurso['nom_cur'];
		$sUsercoo['sem_anu'] = $aCurso['sem_anu'];
		$sUsercoo['cod_esp'] = $aCurso['cod_esp'];
		$sUsercoo['upin'] = 'u';
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
	function enfocar()
	{
		//document.fData.rPln_est.focus();
	}
	function del_curso(pCurso)
	{
		var vReturn;
		var vAtributo;
		vAtributo = "center=yes; dialogHeight=200px; dialogWidth=530px; dialogLeft=px; dialogTop=px; ";
		vAtributo += "help=no; status=no; scroll=no; resizable=no; font-family=Arial; font-size=11px";

		vReturn = window.showModalDialog("msn_delreq.php?rCur_pre="+pCurso, "mensaje", vAtributo);
		if(vReturn == '1')
		{
			window.location.href = "pln_delcursopre.php";
		}
	}
//-->
</script>
</head>

<body onLoad="enfocar();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmaestros.php"; ?>
	
<div class="wordcen" id="body1">
		<form action="" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Curso: <?=$sUsercoo['nom_cur']?></th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="1" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			<tr>
              <td width="130" class="wordder">C&oacute;digo:</td>
              <td width="110" class="tdcampo">&nbsp;<?=$aCurso['cod_cur']?></td>
              <td width="120" class="wordder">Plan:</td>
              <td width="110" class="tdcampo">&nbsp;<?=$aCurso['pln_est']?></td>
			</tr>
			<tr>
			  <td class="wordder">Sistema Curricular:  </td>
			  <td class="tdcampo">&nbsp;<?=$sTiposist[$sPlan[$aCurso['pln_est']]]?></td>
		      <td class="wordder"><span class="wordder">C&oacute;digo de Cat&aacute;logo: </span></td>
		      <td class="tdcampo">&nbsp;<?=$aCurso['cod_cat']?></td>
			</tr>
			<tr>
			  <td class="wordder">Nombre de Curso:</td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$aCurso['nom_cur']?></td>
	        </tr>
			<tr>
			  <td class="wordder">Nombre Completo:</td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$aCurso['nom_ofi']?></td>
	        </tr>
			<tr>
			  <td class="wordder">Nivel:</td>
			  <td class="tdcampo">&nbsp;<?=$sNivel[$aCurso['niv_est']]?></td>
			  <td class="wordder">Semestre:</td>
			  <td class="tdcampo">&nbsp;<?=$sSemestre[$aCurso['sem_anu']]?></td>
			</tr>
			<tr>
			  <td class="wordder">Especialidad:</td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEspecial[$aCurso['pln_est'].$aCurso['cod_esp']]['esp_nom']?></td>
	        </tr>
			<tr>
			  <td class="wordder">Horas te&oacute;ricas:</td>
			  <td class="tdcampo">&nbsp;<?=$aCurso['hrs_teo']?> horas </td>
		      <td class="wordder">Horas pr&aacute;cticas: </td>
		      <td class="tdcampo">&nbsp;<?=$aCurso['hrs_pra']?> horas </td>
			</tr>
			<tr>
			  <td class="wordder">Total de Horas:</td>
			  <td class="tdcampo">&nbsp;<?=$aCurso['hrs_tot']?> horas </td>
		      <td class="wordder">Cr&eacute;ditos:</td>
		      <td class="tdcampo">&nbsp;<?=$aCurso['crd_cur']?> cr&eacute;ditos </td>
			</tr>
			<tr>
			  <td class="wordder">Tipo de Curso:</td>
			  <td class="tdcampo">&nbsp;<?=$sTipcur[$aCurso['tip_cur']]?></td>
		      <td class="wordder">Tipo de Prerequisito:</td>
		      <td class="tdcampo">&nbsp;<?=$sTippre[$aCurso['tip_pre']]?></td>
			</tr>
			<tr>
			  <td class="wordder">Cr&eacute;ditos de prerequisito:</td>
			  <td class="tdcampo">&nbsp;<?=$aCurso['crd_prq']?></td>
		      <td class="wordder">&nbsp;</td>
		      <td class="wordizq">&nbsp;</td>
			</tr>
			<tr>
			  <td class="wordder">Cursos Prerequisitos: </td>
			  <td colspan="3" class="tdcampocenter">			  	
			  	<table border="1" cellpadding="1" cellspacing="0" class="tabled" bordercolor="#BDD37B">
			  	<?
					$sPre = "";
					$vQuery = "Select requ.cur_pre, curso.nom_cur from unapnet.requ left join unapnet.curso on ";
					$vQuery .= "requ.cod_car = curso.cod_car and requ.pln_est = curso.pln_est and requ.cur_pre = curso.cod_cur ";
					$vQuery .= "where requ.cod_car = '{$sUsercoo['cod_car']}' and requ.pln_est = '{$sUsercoo['pln_est']}' and  ";
					$vQuery .= "requ.cod_cur = '{$sUsercoo['cod_cur']}' ";
					$cRequ = fQuery($vQuery);
					
					while($aRequ = $cRequ->fetch_array())
					{	
						$sPre[$aRequ['cur_pre']] = TRUE;
				?>
                  <tr>
                    <td>&nbsp;<?=$aRequ['cur_pre']?>&nbsp;</td>
                    <td class="wordizqb">&nbsp;<?=$aRequ['nom_cur']?>&nbsp;</td>
                    <td><a href="" onclick="del_curso('<?=$aRequ['cur_pre']?>'); return false;" class="enlaceb"><img src="../images/drop.png" alt="Eliminar" width="16" height="16" /></a>
					</td>
                  </tr>                
				<?						
					}
				?>
				</table>
			  <a href="pln_getcursopre.php" title="Nuevo Pre-requisito" class="linkboton"><img src="../images/bnuevoreq.png" width="100" height="24" /></a>			  </td>
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
	  <a href="pln_getcurso.php" title="Modificar Curso" class="linkboton"><img src="../images/bedit.png" width="100" height="24"></a>
		<a href="pln_selectplan.php" title="Mostrar plan de Estudios" class="linkboton"><img src="../images/bvplan.png" width="100" height="24"></a>
		</form>
		

    </div>
	<? include "../include/pie1.php"; ?>

</body>
</html>