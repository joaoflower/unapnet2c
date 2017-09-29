<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	$vFile ="niv_select.php";
	if(fsafetyselcar2())
	{
		if (!empty($_POST['rPln_est'])) $sUsercoo['pln_est'] = $_POST['rPln_est'];
		if (!empty($_POST['rCod_esp'])) $sUsercoo['cod_esp'] = $_POST['rCod_esp'];
		if (!empty($_POST['rSec_gru'])) $sUsercoo['sec_gru'] = $_POST['rSec_gru'];
		if (!empty($_POST['rMod_mat'])) $sUsercoo['mod_mat'] = $_POST['rMod_mat'];

		$sHorario = "";
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
	function cambio(){
		document.fCambio.submit();	
	}
//-->
</script>
</head>

<body >
	<? include "../include/header1.php"; ?>
	<? include "../include/mreportes.php"; ?>
	
	<div class="wordcen" id="body1">
	  <form action="niv_select.php" method="post" enctype="multipart/form-data" name="fCambio" id="fCambio"> 
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Estudiantes por Niveles </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="0" class="tabled">
            <tr>
              <td width="100" class="wordder">Plan de Estudios : </td>
              <td width="350" class="wordizq">
                <select name="rPln_est" id="select" onChange="cambio();">
                  <?=fviewplanrepniv($sUsercoo['pln_est'])?>
                </select></td>
            </tr>
            <tr>
              <td class="wordder">Especialidad : </td>
              <td class="wordizq"><select name="rCod_esp" id="rCod_esp" onChange="cambio();">
                <?=fviewespecialrep($sUsercoo['pln_est'], $sUsercoo['cod_esp'])?>
              </select></td>
            </tr>
            <tr>
              <td class="wordder">Grupo : </td>
              <td class="wordizq"><select name="rSec_gru" id="rSec_gru" onChange="cambio();">
                  <?=fviewgruporepniv( $sUsercoo['sec_gru'], $sUsercoo['pln_est'], $sUsercoo['cod_esp'])?>
              </select></td>
            </tr>
            <tr>
              <td class="wordder">Modalidad : </td>
              <td class="wordizq"><select name="rMod_mat" id="select3" onChange="cambio();">
                  <?=fviewmodmatrep($sUsercoo['mod_mat'], $sUsercoo['pln_est'], $sUsercoo['cod_esp'], $sUsercoo['sec_gru'])?>
                                          </select></td>
            </tr>
          </table>
		  <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                  <tr>
                    <th width="30" scope="col">Nro</th>
                    <th width="50" scope="col">Num.mat</th>
                    <th width="270" scope="col">Apellidos y Nombres </th>
                    <th width="80" scope="col">Mod.</th>
                    <th width="70" scope="col">De</th>
                  </tr>
					<?		$vCont = 1;
						$aEstu = "";
						$sEstupdf = "";
						$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
						$vQuery = "Select estudiante.num_mat, estudiante.paterno, estudiante.materno, estudiante.nombres, mod_mat ";
						$vQuery .= "from $tEstumat left join unapnet.estudiante on $tEstumat.num_mat = estudiante.num_mat and ";
						$vQuery .= "$tEstumat.cod_car = estudiante.cod_car ";
						$vQuery .= "where pln_est = '{$sUsercoo['pln_est']}' and per_aca = '{$sUsercoo['per_aca']}' ";
						if(!($sUsercoo['cod_esp'] == '99'))
							$vQuery .= "and cod_esp = '{$sUsercoo['cod_esp']}' ";
						if(!($sUsercoo['sec_gru'] == '99'))
							$vQuery .= "and sec_gru = '{$sUsercoo['sec_gru']}' ";
						if(!($sUsercoo['mod_mat'] == '99'))
							$vQuery .= "and mod_mat = '{$sUsercoo['mod_mat']}' ";
						$vQuery .= "order by paterno, materno, nombres";
						$cEstumat = fQuery($vQuery);
						while($aEstumat = $cEstumat->fetch_array())
						{
							$aEstu[$aEstumat['num_mat']] = TRUE;
							$sEstupdf[$aEstumat['num_mat']]['num_est'] = $vCont;
							$sEstupdf[$aEstumat['num_mat']]['num_mat'] = $aEstumat['num_mat'];
							$sEstupdf[$aEstumat['num_mat']]['nombre'] = "{$aEstumat['paterno']} {$aEstumat['materno']}, {$aEstumat['nombres']}";
							$sEstupdf[$aEstumat['num_mat']]['mod_mat'] = $sModmat[$aEstumat['mod_mat']]['mod_des'];							
					?>
                  <tr  <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
                    <td class="wordcen"><?=$vCont?></td>
                    <td class="wordcen"><?=$aEstumat['num_mat']?></td>
                    <td class="wordizq">&nbsp;<?=$aEstumat['paterno']?> <?=$aEstumat['materno']?>, <?=$aEstumat['nombres']?></td>
                    <td class="wordizq">&nbsp;<?=$sModmat[$aEstumat['mod_mat']]['mod_des']?></td>
                    <td class="wordizq">&nbsp;Coordinaci&oacute;n</td>
                  </tr>
				  <?	$vCont++;	}	?>
				  
				  <?		
						$tEstumat = "unapnet.estutut{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
						$vQuery = "Select estudiante.num_mat, estudiante.paterno, estudiante.materno, estudiante.nombres, mod_mat ";
						$vQuery .= "from $tEstumat left join unapnet.estudiante on $tEstumat.num_mat = estudiante.num_mat and ";
						$vQuery .= "$tEstumat.cod_car = estudiante.cod_car ";
						$vQuery .= "where pln_est = '{$sUsercoo['pln_est']}' and per_aca = '{$sUsercoo['per_aca']}' ";
						if(!($sUsercoo['cod_esp'] == '99'))
							$vQuery .= "and cod_esp = '{$sUsercoo['cod_esp']}' ";
						if(!($sUsercoo['sec_gru'] == '99'))
							$vQuery .= "and sec_gru = '{$sUsercoo['sec_gru']}' ";
						if(!($sUsercoo['mod_mat'] == '99'))
							$vQuery .= "and mod_mat = '{$sUsercoo['mod_mat']}' ";
						$vQuery .= " order by paterno, materno, nombres";
						if($sUsercoo['ano_aca'] == '2005')
						{
						$cEstumat = fQuery($vQuery);
						while($aEstumat = $cEstumat->fetch_array())
						{
							if(!$aEstu[$aEstumat['num_mat']])
							{
								$sEstupdf[$aEstumat['num_mat']]['num_est'] = $vCont;
								$sEstupdf[$aEstumat['num_mat']]['num_mat'] = $aEstumat['num_mat'];
								$sEstupdf[$aEstumat['num_mat']]['nombre'] = "{$aEstumat['paterno']} {$aEstumat['materno']}, {$aEstumat['nombres']}";
								$sEstupdf[$aEstumat['num_mat']]['mod_mat'] = $sModmat[$aEstumat['mod_mat']]['mod_des'];								
					?>
                  <tr  <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
                    <td class="wordcen"><?=$vCont?></td>
                    <td class="wordcen"><?=$aEstumat['num_mat']?></td>
                    <td class="wordizq"><?=$aEstumat['paterno']?> <?=$aEstumat['materno']?>, <?=$aEstumat['nombres']?></td>
                    <td class="wordizq"><?=$sModmat[$aEstumat['mod_mat']]['mod_des']?></td>
                    <td class="wordizq">Internet</td>
                  </tr>
				  <?	$vCont++;	}	}	}?>
                </table>
		  
		  </td>
          <td background="../images/ventana_r2_c4.jpg"></td>
        </tr>
        <tr>
          <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
          <td background="../images/ventana_r4_c2.jpg"></td>
          <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
        </tr>
      </table>
	  </form>
	  <a href="prnrelanivel.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" /></a>
	  <div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
	</div>	
	<? include "../include/pie1.php"; ?>

</body>
</html>