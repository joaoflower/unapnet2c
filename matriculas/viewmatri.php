<?php
	session_start();
	include "../include/function.php";
	
	if(fsafetyselcar())
	{
		if($sUsercoo['safetymatri4'])
		{
			$sUsercoo['safetymatri4'] = FALSE;
		}
		else
			header("Location:reg_getestu.php");
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
		document.fData.rPln_est.value = document.frameCambio.fCambio.rPln_est.value;
		document.fData.rCod_esp.value = document.frameCambio.fCambio.rCod_esp.value;
		return true;
	}
//-->
</script>
</head>

<body>
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	
	<div class="wordcen" id="body1">
	  <form action="prnficha.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
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
                  <td colspan="3" class="wordizqb"><?=$sEstudia['num_mat']?>
            -
              <?=$sEstudia['paterno']?>
              <?=$sEstudia['materno']?>
            ,
            <?=$sEstudia['nombres']?></td>
                </tr>
                <tr>
                  <td class="wordder">Plan : </td>
                  <td class="wordizqb"><?=$sEstudia['pln_est']?> - <?=$sTiposist[$sEstudia['tip_sist']]?></td>
                  <td class="wordder">Semestre:</td>
                  <td class="wordizqb"><?=$sSemestre[$sEstudia['niv_est']]?></td>
                </tr>
                <tr>
                  <td class="wordder">Especialidad : </td>
                  <td colspan="3" class="wordizqb"><?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']?></td>
                </tr>
                <tr>
                  <td class="wordder">Modalidad : </td>
                  <td width="125" class="wordizqb"><?=$sModmat[$sEstudia['mod_mat']]['mod_des']?></td>
                  <td width="80" class="wordder">Total  Cred : </td>
                  <td class="wordizqb"><?=$sEstudia['tot_crd']?>
            cr&eacute;ditos</td>
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
	    <? if(!empty($sCurmat2)) {?>
        <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Cursos Matriculados</th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table width="550" border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th width="50" scope="col">C&oacute;d.</th>
                  <th scope="col">Curso</th>
                  <th width="60" scope="col">Sem.</th>
                  <th width="60" scope="col">Mod.</th>
                  <th width="50" scope="col">Grupo</th>
                  <th width="35" scope="col">Cred.</th>
                </tr>
                <? 	$vCont = 1; $sCursopdf = ""; 	if(!empty($sCurmat2))	foreach($sCurmat2 as $vCod_cur => $aCurmat) { 
				
						$sCursopdf[$vCod_cur]['num_cur'] = $vCont;
						$sCursopdf[$vCod_cur]['niv_est'] = $sCurso[$vCod_cur]['niv_est'];
						$sCursopdf[$vCod_cur]['sem_anu'] = $sSemestre[$sCurso[$vCod_cur]['sem_anu']];
						$sCursopdf[$vCod_cur]['nom_cur'] = $sCurso[$vCod_cur]['nom_cur'];						
						$sCursopdf[$vCod_cur]['sec_gru'] = $sGrupo[$aCurmat['sec_gru']];
						$sCursopdf[$vCod_cur]['mod_mat'] = $sModmat[$aCurmat['mod_mat']]['mod_des'];
						$sCursopdf[$vCod_cur]['crd_cur'] = $sCurso[$vCod_cur]['crd_cur'];
				
				?>
                <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
                  <td class="wordizq">&nbsp;
                      <?=$sCurso[$vCod_cur]['cod_cat']?></td>
                  <td class="wordizq">&nbsp;
                      <?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?></td>
                  <td class="wordizq">&nbsp;
                      <?=ucwords(strtolower($sSemestre[$sCurso[$vCod_cur]['sem_anu']]))?></td>
                  <td class="wordizq">&nbsp;
				  	  <?=ucwords(strtolower($sModmat[$aCurmat['mod_mat']]['mod_des']))?></td>
                  <td class="wordizq">&nbsp;
				  	  <?=ucwords(strtolower($sGrupo[$aCurmat['sec_gru']]))?></td>
                  <td class="wordizq">&nbsp;
                      <?=$sCurso[$vCod_cur]['crd_cur']?></td>
                </tr>
                <? $vCont++; 	} ?>
            </table></td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>
        <? } ?>
		<a href="<?=($sEstudia['ingreg'] == 'i'?"ing_getestu.php":"reg_getestu.php")?>" title="Nueva Matr&iacute;cula" class="linkboton"><img src="../images/bnuevomatri.png" width="100" height="24"></a>
		<a href="prnficha<?=($sUsercoo['cod_fac'] == 18?'epg':'')?>.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24"></a>
	  </form>
	  <div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>