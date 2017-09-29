<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	$vFile ="cur_select.php";
	if(fsafetyselcar())
	{
		if (!empty($_POST['rPln_est'])) $sUsercoo['pln_est'] = $_POST['rPln_est'];
		if (!empty($_POST['rSem_anu'])) $sUsercoo['sem_anu'] = $_POST['rSem_anu'];
		if (!empty($_POST['rCod_esp'])) $sUsercoo['cod_esp'] = $_POST['rCod_esp'];
		if (!empty($_POST['rSec_gru'])) $sUsercoo['sec_gru'] = $_POST['rSec_gru'];
		if (!empty($_POST['rCod_cur'])) $sUsercoo['cod_cur'] = $_POST['rCod_cur'];
/*		$sUsercoo['pln_est'] = $_POST['rPln_est'];
		$sUsercoo['sem_anu'] = $_POST['rSem_anu'];
		$sUsercoo['sec_gru'] = $_POST['rSec_gru'];
		$sUsercoo['tur_est'] = $_POST['rTur_est'];
		$sUsercoo['cod_cur'] = $_POST['rCod_cur'];*/
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
	  <form action="cur_select.php" method="post" enctype="multipart/form-data" name="fCambio" id="fCambio"> 
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Estudiantes por Curso </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table width="450" border="0" cellpadding="1" cellspacing="0" class="tabled">
            <tr>
              <td width="100" class="wordder">Plan de Estudios : </td>
              <td width="350" class="wordizq">
                <select name="rPln_est" id="select" onChange="cambio();">
                  <?=fviewplanrep($sUsercoo['pln_est'])?>
                </select></td>
            </tr>
            <tr>
              <td class="wordder">Especialidad : </td>
              <td class="wordizq"><select name="rCod_esp" id="rCod_esp" onChange="cambio();">
                  <?=fviewespecial($sUsercoo['pln_est'], $sUsercoo['cod_esp'])?>
              </select></td>
            </tr>
            <tr>
              <td class="wordder">Semestre : </td>
              <td class="wordizq"><select name="rSem_anu" id="rSem_anu" onChange="cambio();">
                <?=fviewsemhora($sUsercoo['pln_est'], $sUsercoo['sem_anu'])?>
              </select></td>
            </tr>
            <tr>
              <td class="wordder">Curso : </td>
              <td class="wordizq"><select name="rCod_cur" id="select3" onChange="cambio();">
                  <?=fviewcursohora($sUsercoo['pln_est'], $sUsercoo['sem_anu'], $sUsercoo['cod_cur'], $sUsercoo['cod_esp'])?>
                                          </select></td>
            </tr>
            <tr>
              <td class="wordder">Grupo : </td>
              <td class="wordizq"><select name="rSec_gru" id="rSec_gru" onChange="cambio();">
                  <?=fviewgruporep( $sUsercoo['sec_gru'], $sUsercoo['pln_est'], $sUsercoo['cod_cur'])?>
              </select></td>
            </tr>
            <tr>
              <td colspan="2" class="wordcen">			                    </td>
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
						$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
						$vQuery = "Select estudiante.num_mat, estudiante.paterno, estudiante.materno, estudiante.nombres, mod_mat ";
						$vQuery .= "from $tCurmat left join unapnet.estudiante on $tCurmat.num_mat = estudiante.num_mat and ";
						$vQuery .= "$tCurmat.cod_car = estudiante.cod_car ";
						$vQuery .= "where pln_est = '{$sUsercoo['pln_est']}' and per_aca = '{$sUsercoo['per_aca']}' and cod_cur = '{$sUsercoo['cod_cur']}' ";
						if($sUsercoo['sec_gru'] == '99')
							$vQuery .= "order by paterno, materno, nombres";
						else
							$vQuery .= "and sec_gru = '{$sUsercoo['sec_gru']}' order by paterno, materno, nombres";
						$cCurmat = fQuery($vQuery);
						while($aCurmat = $cCurmat->fetch_array())
						{
							$aEstu[$aCurmat['num_mat']] = TRUE;
							$sEstupdf[$aCurmat['num_mat']]['num_est'] = $vCont;
							$sEstupdf[$aCurmat['num_mat']]['num_mat'] = $aCurmat['num_mat'];
							$sEstupdf[$aCurmat['num_mat']]['nombre'] = "{$aCurmat['paterno']} {$aCurmat['materno']}, {$aCurmat['nombres']}";
							$sEstupdf[$aCurmat['num_mat']]['mod_mat'] = $sModmat[$aCurmat['mod_mat']]['mod_des'];							
					?>
                  <tr  <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
                    <td class="wordcen"><?=$vCont?></td>
                    <td class="wordcen"><?=$aCurmat['num_mat']?></td>
                    <td class="wordizq">&nbsp;<?=$aCurmat['paterno']?> <?=$aCurmat['materno']?>, <?=$aCurmat['nombres']?></td>
                    <td class="wordizq">&nbsp;<?=$sModmat[$aCurmat['mod_mat']]['mod_des']?></td>
                    <td class="wordizq">&nbsp;Coordinaci&oacute;n</td>
                  </tr>
				  <?	$vCont++;	}	?>
				  
				  <?		
						$tCurmat = "unapnet.curtut{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
						$vQuery = "Select estudiante.num_mat, estudiante.paterno, estudiante.materno, estudiante.nombres, mod_mat ";
						$vQuery .= "from $tCurmat left join unapnet.estudiante on $tCurmat.num_mat = estudiante.num_mat and ";
						$vQuery .= "$tCurmat.cod_car = estudiante.cod_car ";
						$vQuery .= "where pln_est = '{$sUsercoo['pln_est']}' and per_aca = '{$sUsercoo['per_aca']}' and cod_cur = '{$sUsercoo['cod_cur']}' ";
						if($sUsercoo['sec_gru'] == '99')
							$vQuery .= "order by paterno, materno, nombres";
						else
							$vQuery .= "and sec_gru = '{$sUsercoo['sec_gru']}' order by paterno, materno, nombres";
						if($sUsercoo['ano_aca'] == '2005')
						{
						$cCurmat = fQuery($vQuery);
						while($aCurmat = $cCurmat->fetch_array())
						{
							if(!$aEstu[$aCurmat['num_mat']])
							{
								$sEstupdf[$aCurmat['num_mat']]['num_est'] = $vCont;
								$sEstupdf[$aCurmat['num_mat']]['num_mat'] = $aCurmat['num_mat'];
								$sEstupdf[$aCurmat['num_mat']]['nombre'] = "{$aCurmat['paterno']} {$aCurmat['materno']}, {$aCurmat['nombres']}";
								$sEstupdf[$aCurmat['num_mat']]['mod_mat'] = $sModmat[$aCurmat['mod_mat']]['mod_des'];							
					?>
                  <tr  <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
                    <td class="wordcen"><?=$vCont?></td>
                    <td class="wordcen"><?=$aCurmat['num_mat']?></td>
                    <td class="wordizq"><?=$aCurmat['paterno']?> <?=$aCurmat['materno']?>, <?=$aCurmat['nombres']?></td>
                    <td class="wordizq"><?=$sModmat[$aCurmat['mod_mat']]['mod_des']?></td>
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
	  <a href="prnrelacurso.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" /></a><a href="prnrelacursox.php" class="enlace1">&lt; Exportar Excel &gt;</a>
	  <div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>